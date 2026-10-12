<?php

namespace App\Http\Controllers;

use App\Models\Governor;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GovernorController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:governor-list|governor-create|governor-edit|governor-delete', only: ['index','show']),
            new Middleware('permission:governor-create', only: ['create','store']),
            new Middleware('permission:governor-edit', only: ['edit','update']),
            new Middleware('permission:governor-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $governors = Governor::latest()->get();
        return view('governors.index', compact('governors'));
    }

    public function store(Request $request)
    {
        $request->merge([
            'is_present' => $request->has('is_present') ? 1 : 0,
            'to' => $request->has('is_present') ? null : $request->to,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'from' => 'required|date',
            'to' => 'nullable|date',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->extension();
            $request->image->move(public_path('uploads/governors'), $imageName);
            $data['image'] = 'uploads/governors/' . $imageName;
        }

        Governor::create($data);

        return redirect()->route('governors.index')->with('success', 'Governor added successfully.');
    }

    public function update(Request $request, Governor $governor)
    {
        $request->merge([
            'is_present' => $request->has('is_present') ? 1 : 0,
            'to' => $request->has('is_present') ? null : $request->to,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'from' => 'required|date',
            'to' => 'nullable|date',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($governor->image && file_exists(public_path($governor->image))) {
                unlink(public_path($governor->image));
            }
            $imageName = time() . '_' . $request->image->extension();
            $request->image->move(public_path('uploads/governors'), $imageName);
            $data['image'] = 'uploads/governors/' . $imageName;
        }

        $governor->update($data);

        return redirect()->route('governors.index')->with('success', 'Governor updated successfully.');
    }

    public function destroy(Governor $governor)
    {
        if ($governor->image && file_exists(public_path($governor->image))) {
            unlink(public_path($governor->image));
        }
        
        $governor->delete();

        return redirect()->route('governors.index')->with('success', 'Governor deleted successfully.');
    }
}
