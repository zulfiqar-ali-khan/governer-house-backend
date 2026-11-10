<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GalleryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:gallery-list|gallery-create|gallery-edit|gallery-delete', only: ['index', 'show']),
            new Middleware('permission:gallery-create', only: ['create', 'store']),
            new Middleware('permission:gallery-edit', only: ['edit', 'update', 'toggleActive']),
            new Middleware('permission:gallery-delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Gallery::orderBy('order', 'asc')->latest()->get();
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/galleries');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/galleries/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        Gallery::create($data);

        return redirect()->route('galleries.index')->with('success', 'Gallery item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        return view('galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($gallery->image && file_exists(public_path($gallery->image))) {
                @unlink(public_path($gallery->image));
            }
            $destinationPath = public_path('uploads/galleries');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/galleries/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $gallery->update($data);

        return redirect()->route('galleries.index')->with('success', 'Gallery item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists(public_path($gallery->image))) {
            @unlink(public_path($gallery->image));
        }
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Gallery item deleted successfully.');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Request $request, Gallery $gallery)
    {
        $gallery->active = ($request->active == 'true' || $request->active == 1 || $request->active === true) ? 1 : 0;
        $gallery->save();

        return response()->json([
            'success' => true,
            'message' => 'Gallery status updated successfully.'
        ]);
    }
}
