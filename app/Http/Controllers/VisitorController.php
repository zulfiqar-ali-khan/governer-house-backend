<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VisitorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:visitor-list|visitor-create|visitor-edit|visitor-delete', only: ['index', 'show']),
            new Middleware('permission:visitor-create', only: ['create', 'store']),
            new Middleware('permission:visitor-edit', only: ['edit', 'update']),
            new Middleware('permission:visitor-delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitors = Visitor::latest()->get();
        return view('visitors.index', compact('visitors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/visitors'), $imageName);
            $data['image'] = 'uploads/visitors/' . $imageName;
        }

        Visitor::create($data);

        return redirect()->route('visitors.index')->with('success', 'Visitor added successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visitor $visitor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($visitor->image && file_exists(public_path($visitor->image))) {
                unlink(public_path($visitor->image));
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/visitors'), $imageName);
            $data['image'] = 'uploads/visitors/' . $imageName;
        }

        $visitor->update($data);

        return redirect()->route('visitors.index')->with('success', 'Visitor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visitor $visitor)
    {
        if ($visitor->image && file_exists(public_path($visitor->image))) {
            unlink(public_path($visitor->image));
        }

        $visitor->delete();

        return redirect()->route('visitors.index')->with('success', 'Visitor deleted successfully.');
    }
}
