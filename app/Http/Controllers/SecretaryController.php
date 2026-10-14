<?php

namespace App\Http\Controllers;

use App\Models\Secretary;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SecretaryController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:secretary-list|secretary-create|secretary-edit|secretary-delete', only: ['index','show']),
            new Middleware('permission:secretary-create', only: ['create','store']),
            new Middleware('permission:secretary-edit', only: ['edit','update']),
            new Middleware('permission:secretary-delete', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretaries = Secretary::latest()->get();
        return view('secretaries.index', compact('secretaries'));
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
            'type' => 'required|in:Military,Principle,Officer',
            'phone' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'intercom' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->image->extension();
            $request->image->move(public_path('uploads/secretaries'), $imageName);
            $data['image'] = 'uploads/secretaries/' . $imageName;
        }

        Secretary::create($data);

        return redirect()->route('secretaries.index')->with('success', 'Secretary added successfully.');
    }

    public function update(Request $request, Secretary $secretary)
    {
        $request->merge([
            'is_present' => $request->has('is_present') ? 1 : 0,
            'to' => $request->has('is_present') ? null : $request->to,
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'type' => 'required|in:Military,Principle,Officer',
            'phone' => 'nullable|string|max:255',
            'fax' => 'nullable|string|max:255',
            'intercom' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($secretary->image && file_exists(public_path($secretary->image))) {
                unlink(public_path($secretary->image));
            }
            $imageName = time() . '_' . $request->image->extension();
            $request->image->move(public_path('uploads/secretaries'), $imageName);
            $data['image'] = 'uploads/secretaries/' . $imageName;
        }

        $secretary->update($data);

        return redirect()->route('secretaries.index')->with('success', 'Secretary updated successfully.');
    }

    public function destroy(Secretary $secretary)
    {
        if ($secretary->image && file_exists(public_path($secretary->image))) {
            unlink(public_path($secretary->image));
        }
        
        $secretary->delete();

        return redirect()->route('secretaries.index')->with('success', 'Secretary deleted successfully.');
    }
}
