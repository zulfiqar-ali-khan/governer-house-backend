<?php

namespace App\Http\Controllers;

use App\Models\NewAndEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class NewAndEventController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:new-and-event-list|new-and-event-create|new-and-event-edit|new-and-event-delete', only: ['index','show']),
            new Middleware('permission:new-and-event-create', only: ['create','store']),
            new Middleware('permission:new-and-event-edit', only: ['edit','update']),
            new Middleware('permission:new-and-event-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $newsAndEvents = NewAndEvent::latest()->get();
        return view('new-and-events.index', compact('newsAndEvents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'mint' => 'required|string|max:255',
            'date' => 'required|date',
            'thumnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        $data = $request->except(['thumnail_image', 'cover_image']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumnail_image')) {
            $imageName = 'thumb_' . time() . '.' . $request->thumnail_image->extension();
            $request->thumnail_image->move(public_path('uploads/news-events'), $imageName);
            $data['thumnail_image'] = 'uploads/news-events/' . $imageName;
        }

        if ($request->hasFile('cover_image')) {
            $imageName = 'cover_' . time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('uploads/news-events'), $imageName);
            $data['cover_image'] = 'uploads/news-events/' . $imageName;
        }

        NewAndEvent::create($data);

        return redirect()->route('new-and-events.index')->with('success', 'News/Event added successfully.');
    }

    public function update(Request $request, NewAndEvent $newAndEvent)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'mint' => 'required|string|max:255',
            'date' => 'required|date',
            'thumnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
        ]);

        $data = $request->except(['thumnail_image', 'cover_image']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumnail_image')) {
            if ($newAndEvent->thumnail_image && file_exists(public_path($newAndEvent->thumnail_image))) {
                unlink(public_path($newAndEvent->thumnail_image));
            }
            $imageName = 'thumb_' . time() . '.' . $request->thumnail_image->extension();
            $request->thumnail_image->move(public_path('uploads/news-events'), $imageName);
            $data['thumnail_image'] = 'uploads/news-events/' . $imageName;
        }

        if ($request->hasFile('cover_image')) {
            if ($newAndEvent->cover_image && file_exists(public_path($newAndEvent->cover_image))) {
                unlink(public_path($newAndEvent->cover_image));
            }
            $imageName = 'cover_' . time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('uploads/news-events'), $imageName);
            $data['cover_image'] = 'uploads/news-events/' . $imageName;
        }

        $newAndEvent->update($data);

        return redirect()->route('new-and-events.index')->with('success', 'News/Event updated successfully.');
    }

    public function destroy(NewAndEvent $newAndEvent)
    {
        if ($newAndEvent->thumnail_image && file_exists(public_path($newAndEvent->thumnail_image))) {
            unlink(public_path($newAndEvent->thumnail_image));
        }
        if ($newAndEvent->cover_image && file_exists(public_path($newAndEvent->cover_image))) {
            unlink(public_path($newAndEvent->cover_image));
        }
        
        $newAndEvent->delete();

        return redirect()->route('new-and-events.index')->with('success', 'News/Event deleted successfully.');
    }
}
