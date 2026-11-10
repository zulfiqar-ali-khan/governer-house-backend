<?php

namespace App\Http\Controllers;

use App\Models\AdvisoryCouncil;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdvisoryCouncilController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:advisory-council-list|advisory-council-create|advisory-council-edit|advisory-council-delete', only: ['index', 'show']),
            new Middleware('permission:advisory-council-create', only: ['create', 'store']),
            new Middleware('permission:advisory-council-edit', only: ['edit', 'update', 'toggleActive']),
            new Middleware('permission:advisory-council-delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advisoryCouncils = AdvisoryCouncil::orderBy('order', 'asc')->latest()->get();
        return view('advisory-councils.index', compact('advisoryCouncils'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('advisory-councils.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            $destinationPath = public_path('uploads/advisory-councils');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/advisory-councils/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        AdvisoryCouncil::create($data);

        return redirect()->route('advisory-councils.index')->with('success', 'Advisory Council member added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdvisoryCouncil $advisoryCouncil)
    {
        return view('advisory-councils.show', compact('advisoryCouncil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdvisoryCouncil $advisoryCouncil)
    {
        return view('advisory-councils.edit', compact('advisoryCouncil'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdvisoryCouncil $advisoryCouncil)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except(['image']);

        if ($request->hasFile('image')) {
            if ($advisoryCouncil->image && file_exists(public_path($advisoryCouncil->image))) {
                @unlink(public_path($advisoryCouncil->image));
            }
            $destinationPath = public_path('uploads/advisory-councils');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $imageName = time() . '_' . uniqid() . '.' . $request->image->extension();
            $request->image->move($destinationPath, $imageName);
            $data['image'] = 'uploads/advisory-councils/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $advisoryCouncil->update($data);

        return redirect()->route('advisory-councils.index')->with('success', 'Advisory Council member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdvisoryCouncil $advisoryCouncil)
    {
        if ($advisoryCouncil->image && file_exists(public_path($advisoryCouncil->image))) {
            @unlink(public_path($advisoryCouncil->image));
        }
        $advisoryCouncil->delete();

        return redirect()->route('advisory-councils.index')->with('success', 'Advisory Council member deleted successfully.');
    }

    /**
     * Toggle active status.
     */
    public function toggleActive(Request $request, AdvisoryCouncil $advisoryCouncil)
    {
        $advisoryCouncil->active = ($request->active == 'true' || $request->active == 1 || $request->active === true) ? 1 : 0;
        $advisoryCouncil->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully.'
        ]);
    }
}

