<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Str;
class NewsLetterController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new \Illuminate\Routing\Controllers\Middleware('permission:newsletter-list|newsletter-create|newsletter-edit|newsletter-delete', only: ['index','show']),
            new \Illuminate\Routing\Controllers\Middleware('permission:newsletter-create', only: ['create','store']),
            new \Illuminate\Routing\Controllers\Middleware('permission:newsletter-edit', only: ['edit','update']),
            new \Illuminate\Routing\Controllers\Middleware('permission:newsletter-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $newsLetters = NewsLetter::latest()->get();
        return view('news-letters.index', compact('newsLetters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'thumnail_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except(['thumnail_image']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumnail_image')) {
            $imageName = 'newsletter_' . time() . '.' . $request->thumnail_image->extension();
            $request->thumnail_image->move(public_path('uploads/newsletters'), $imageName);
            $data['thumnail_image'] = 'uploads/newsletters/' . $imageName;
        }

        NewsLetter::create($data);

        return redirect()->route('news-letters.index')->with('success', 'Newsletter created successfully.');
    }

    public function update(Request $request, NewsLetter $newsLetter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'thumnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        $data = $request->except(['thumnail_image']);
        $data['slug'] = Str::slug($request->title);

        if ($request->hasFile('thumnail_image')) {
            if ($newsLetter->thumnail_image && file_exists(public_path($newsLetter->thumnail_image))) {
                unlink(public_path($newsLetter->thumnail_image));
            }
            $imageName = 'newsletter_' . time() . '.' . $request->thumnail_image->extension();
            $request->thumnail_image->move(public_path('uploads/newsletters'), $imageName);
            $data['thumnail_image'] = 'uploads/newsletters/' . $imageName;
        }

        $newsLetter->update($data);

        return redirect()->route('news-letters.index')->with('success', 'Newsletter updated successfully.');
    }

    public function destroy(NewsLetter $newsLetter)
    {
        if ($newsLetter->thumnail_image && file_exists(public_path($newsLetter->thumnail_image))) {
            unlink(public_path($newsLetter->thumnail_image));
        }
        
        $newsLetter->delete();

        return redirect()->route('news-letters.index')->with('success', 'Newsletter deleted successfully.');
    }
}
