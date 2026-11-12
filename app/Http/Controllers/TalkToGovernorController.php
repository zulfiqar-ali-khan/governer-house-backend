<?php

namespace App\Http\Controllers;

use App\Mail\CitizenTalkToGovernorMail;
use App\Mail\GovernorNewSubmissionMail;
use App\Models\TalkToGovernor;
use App\Rules\ReCaptcha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class TalkToGovernorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:talk-to-governor-list|talk-to-governor-delete', only: ['index','show']),
            new Middleware('permission:talk-to-governor-delete', only: ['destroy']),
        ];
    }

    // For admin view
    public function index()
    {
        $messages = TalkToGovernor::latest()->get();
        return view('talk-to-governors.index', compact('messages'));
    }

    // For frontend submission
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile_number' => 'required|string|max:30',
            'cnic' => 'nullable|string|max:25',
            'district' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'document' => 'nullable|file|mimes:pdf|max:10240', // Max 10MB
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // Max 5MB each
            'consent' => 'accepted',
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ], [
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
            'consent.accepted' => 'Please confirm that the information provided is accurate and consent to its processing.',
            'document.max' => 'The PDF document size must not exceed 10 MB.',
            'images.max' => 'You can attach up to 3 images only.',
            'images.*.max' => 'Each image size must not exceed 5 MB.',
        ]);

        do {
            $referenceNumber = 'GOV-' . date('ymd') . '-' . strtoupper(Str::random(4));
        } while (TalkToGovernor::where('reference_number', $referenceNumber)->exists());

        $documentPath = null;
        if ($request->hasFile('document')) {
            $docFile = $request->file('document');
            $docName = 'doc_' . time() . '_' . Str::random(6) . '.' . $docFile->getClientOriginalExtension();
            $docDir = public_path('uploads/talk-to-governors/documents');
            if (!file_exists($docDir)) {
                mkdir($docDir, 0755, true);
            }
            $docFile->move($docDir, $docName);
            $documentPath = 'uploads/talk-to-governors/documents/' . $docName;
        }

        $imagePaths = [];
        if ($request->hasFile('images')) {
            $imgDir = public_path('uploads/talk-to-governors/images');
            if (!file_exists($imgDir)) {
                mkdir($imgDir, 0755, true);
            }
            foreach ($request->file('images') as $idx => $imgFile) {
                if ($idx >= 3) break;
                $imgName = 'img_' . time() . '_' . $idx . '_' . Str::random(6) . '.' . $imgFile->getClientOriginalExtension();
                $imgFile->move($imgDir, $imgName);
                $imagePaths[] = 'uploads/talk-to-governors/images/' . $imgName;
            }
        }

        $submission = TalkToGovernor::create([
            'reference_number' => $referenceNumber,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_number' => $request->mobile_number,
            'cnic' => $request->cnic,
            'district' => $request->district,
            'category' => $request->category,
            'subject' => $request->subject,
            'message' => $request->message,
            'document' => $documentPath,
            'images' => !empty($imagePaths) ? $imagePaths : null,
        ]);

        // Trigger 2 emails:
        // 1. Acknowledgment email to the citizen who submitted the form
        // 2. Notification email to the Governor / Secretariat
        try {
            $citizenEmail = config('mail.citizen_mail_override') ?: $submission->email;
            if (!empty($citizenEmail)) {
                Mail::to($citizenEmail)->send(new CitizenTalkToGovernorMail($submission));
            }

            $governorEmail = config('mail.governor_email', env('GOVERNOR_EMAIL'));
            if (!empty($governorEmail)) {
                Mail::to($governorEmail)->send(new GovernorNewSubmissionMail($submission));
            }
        } catch (\Throwable $e) {
            Log::error('Talk to Governor Email Sending Error: ' . $e->getMessage(), [
                'reference_number' => $referenceNumber,
                'error' => $e->getMessage(),
            ]);
        }

        return redirect()->back()
            ->with('success', 'Your message has been submitted successfully! Your tracking Reference Number is ' . $referenceNumber . '.')
            ->with('reference_number', $referenceNumber);
    }

    // For admin delete
    public function destroy(TalkToGovernor $talkToGovernor)
    {
        if ($talkToGovernor->document && file_exists(public_path($talkToGovernor->document))) {
            @unlink(public_path($talkToGovernor->document));
        }

        if (is_array($talkToGovernor->images)) {
            foreach ($talkToGovernor->images as $img) {
                if ($img && file_exists(public_path($img))) {
                    @unlink(public_path($img));
                }
            }
        }

        $talkToGovernor->delete();
        return redirect()->route('talk-to-governors.index')->with('success', 'Message deleted successfully.');
    }
}
