<?php

namespace App\Http\Controllers;

use App\Models\TalkToGovernor;
use Illuminate\Http\Request;

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
            'message' => 'required|string',
        ]);

        TalkToGovernor::create($request->all());

        return redirect()->back()->with('success', 'Your message has been submitted successfully.');
    }

    // For admin delete
    public function destroy(TalkToGovernor $talkToGovernor)
    {
        $talkToGovernor->delete();
        return redirect()->route('talk-to-governors.index')->with('success', 'Message deleted successfully.');
    }
}
