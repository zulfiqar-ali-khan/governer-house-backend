<?php

namespace App\Http\Controllers;

use App\Models\KeyInitiative;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class KeyInitiativeController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:key-initiative-list|key-initiative-create|key-initiative-edit|key-initiative-delete', only: ['index','show']),
            new Middleware('permission:key-initiative-create', only: ['create','store']),
            new Middleware('permission:key-initiative-edit', only: ['edit','update', 'toggleActive']),
            new Middleware('permission:key-initiative-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $initiatives = KeyInitiative::orderBy('order')->get();
        return view('key-initiatives.index', compact('initiatives'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer',
            'link' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        KeyInitiative::create($data);

        return redirect()->route('key-initiatives.index')->with('success', 'Key Initiative added successfully.');
    }

    public function update(Request $request, KeyInitiative $keyInitiative)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required|string|max:255',
            'description' => 'required|string',
            'order' => 'nullable|integer',
            'link' => 'nullable|string|max:255',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $keyInitiative->update($data);

        return redirect()->route('key-initiatives.index')->with('success', 'Key Initiative updated successfully.');
    }

    public function destroy(KeyInitiative $keyInitiative)
    {
        if ($keyInitiative->icon && file_exists(public_path($keyInitiative->icon))) {
            unlink(public_path($keyInitiative->icon));
        }
        $keyInitiative->delete();

        return redirect()->route('key-initiatives.index')->with('success', 'Key Initiative deleted successfully.');
    }

    public function toggleActive(Request $request, KeyInitiative $keyInitiative)
    {
        $keyInitiative->active = $request->active == 'true' || $request->active == 1 ? 1 : 0;
        $keyInitiative->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
