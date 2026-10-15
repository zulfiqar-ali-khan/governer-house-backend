<?php

namespace App\Http\Controllers;

use \App\Models\ContactUs;
use \App\Models\GovernorMessage;
use \App\Models\NewAndEvent;
use App\Models\GlobalImpact;
use App\Models\KeyInitiative;
use App\Models\NewsLetter;
use App\Models\Slider;
use App\Models\Secretary;
use App\Models\Governor;
use App\Models\Visitor;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        $sliders = Slider::where('active', true)->orderBy('order', 'asc')->take(4)->get();
        $impacts = GlobalImpact::where('active', true)->orderBy('order', 'asc')->take(4)->get();
        $initiatives = KeyInitiative::where('active', true)->orderBy('order', 'asc')->take(6)->get();
        $governorMessage = GovernorMessage::where('active', true)->first();
        $newsAndEvents = NewAndEvent::orderBy('date', 'desc')->take(4)->get();
        $newsLetters = NewsLetter::where('status', 'active')->orderBy('date', 'desc')->take(4)->get();
        return view('website.index', get_defined_vars());
    }

    public function newsLetter(Request $request)
    {
        $selectedMonth = $request->get('month'); // e.g. '2026-10'

        // Get available months that have active newsletters with counts
        $availableMonths = NewsLetter::where('status', 'active')
            ->selectRaw('DATE_FORMAT(date, "%Y-%m") as month_key, DATE_FORMAT(date, "%M %Y") as month_label, count(*) as count')
            ->groupBy('month_key', 'month_label')
            ->orderBy('month_key', 'desc')
            ->get();

        $monthCounts = $availableMonths->pluck('count', 'month_key');
        $totalCount = NewsLetter::where('status', 'active')->count();

        $query = NewsLetter::where('status', 'active')->orderBy('date', 'desc');

        if ($selectedMonth && $selectedMonth !== 'all') {
            $query->whereRaw('DATE_FORMAT(date, "%Y-%m") = ?', [$selectedMonth]);
        }

        $allNewsletters = $query->get();

        // Group newsletters by "Month Year" (e.g. "October 2026")
        $groupedNewsletters = $allNewsletters->groupBy(function ($item) {
            return \Carbon\Carbon::parse($item->date)->format('F Y');
        });

        $featuredNewsletter = $allNewsletters->first();

        // Selected month label if filtered
        $selectedMonthLabel = null;
        if ($selectedMonth && $selectedMonth !== 'all') {
            $matched = $availableMonths->firstWhere('month_key', $selectedMonth);
            $selectedMonthLabel = $matched ? $matched->month_label : null;
        }

        return view('website.news-letter', get_defined_vars());
    }

    public function newsLetterDetail($slug)
    {
        $newsletter = NewsLetter::where('slug', $slug)->firstOrFail();
        $relatedNewsletters = NewsLetter::where('status', 'active')
            ->where('id', '!=', $newsletter->id)
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();
        return view('website.news-letter-detail', get_defined_vars());
    }

    public function formerGovernor()
    {
        $governors = Governor::orderBy('to', 'desc')->get();
        return view('website.former-governor', get_defined_vars());
    }

    public function formerSecretory()
    {
        $secretaries = Secretary::where('type','Principle')->orderBy('to', 'desc')->get();
        return view('website.former-secretory', get_defined_vars());
    }
    public function militarySecretary()
    {
        $secretaries = Secretary::where('type','Military')->orderBy('to', 'desc')->get();
        return view('website.military-secretary', get_defined_vars());
    }
    public function officers()
    {
        $secretaries = Secretary::where('type','Officer')->orderBy('to', 'desc')->get();
        return view('website.officers', get_defined_vars());
    }
    public function organogram()
    {
        return view('website.organogram');
    }

    public function visitors()
    {
        $visitors = Visitor::orderBy('date', 'desc')->get();
        return view('website.governor-house-visiror', get_defined_vars());
    }

    public function history()
    {
        return view('website.history');
    }

    public function news()
    {
        $newsAndEvents = NewAndEvent::orderBy('date', 'desc')->paginate(9);
        return view('website.news', get_defined_vars());
    }

    public function newsDetail($slug)
    {
        $news = NewAndEvent::where('slug', $slug)->firstOrFail();
        $relatedNews = NewAndEvent::where('id', '!=', $news->id)->orderBy('date', 'desc')->take(3)->get();
        return view('website.news-detail', get_defined_vars());
    }

    public function contact()
    {
        return view('website.contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'description' => 'required',
        ]);

        ContactUs::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'description' => $request->description,
        ]);
        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }
}
