<?php

namespace App\Http\Controllers;

use App\Models\GovernorMessage;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GovernorMessageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:governor-message-list|governor-message-create|governor-message-edit|governor-message-delete', only: ['index','show']),
            new Middleware('permission:governor-message-create', only: ['create','store']),
            new Middleware('permission:governor-message-edit', only: ['edit','update', 'toggleActive']),
            new Middleware('permission:governor-message-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $messages = GovernorMessage::latest()->get();
        return view('governor-messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/governor-messages'), $imageName);
            $data['image'] = 'uploads/governor-messages/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;

        $governorMessage = GovernorMessage::create($data);

        // Ensure only one active record
        if ($governorMessage->active) {
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message added successfully.');
    }

    public function update(Request $request, GovernorMessage $governorMessage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($governorMessage->image && file_exists(public_path($governorMessage->image))) {
                unlink(public_path($governorMessage->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/governor-messages'), $imageName);
            $data['image'] = 'uploads/governor-messages/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;

        $governorMessage->update($data);

        // Ensure only one active record
        if ($governorMessage->active) {
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message updated successfully.');
    }

    public function destroy(GovernorMessage $governorMessage)
    {
        if ($governorMessage->image && file_exists(public_path($governorMessage->image))) {
            unlink(public_path($governorMessage->image));
        }
        $governorMessage->delete();

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message deleted successfully.');
    }

    public function toggleActive(Request $request, GovernorMessage $governorMessage)
    {
        $isActive = $request->active == 'true' || $request->active == 1;
        
        $governorMessage->active = $isActive ? 1 : 0;
        $governorMessage->save();

        if ($isActive) {
            // Set all others to inactive
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully. All other messages are now inactive.']);
    }
}
