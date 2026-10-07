<?php

namespace App\Http\Controllers;

use App\Models\GlobalImpact;
use Illuminate\Http\Request;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GlobalImpactController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:global-impact-list|global-impact-create|global-impact-edit|global-impact-delete', only: ['index','show']),
            new Middleware('permission:global-impact-create', only: ['create','store']),
            new Middleware('permission:global-impact-edit', only: ['edit','update', 'toggleActive']),
            new Middleware('permission:global-impact-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $impacts = GlobalImpact::orderBy('order')->get();
        return view('global-impacts.index', compact('impacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        GlobalImpact::create($data);

        return redirect()->route('global-impacts.index')->with('success', 'Global Impact added successfully.');
    }

    public function update(Request $request, GlobalImpact $globalImpact)
    {
        $request->validate([
            'heading' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $globalImpact->update($data);

        return redirect()->route('global-impacts.index')->with('success', 'Global Impact updated successfully.');
    }

    public function destroy(GlobalImpact $globalImpact)
    {
        $globalImpact->delete();
        return redirect()->route('global-impacts.index')->with('success', 'Global Impact deleted successfully.');
    }

    public function toggleActive(Request $request, GlobalImpact $globalImpact)
    {
        $globalImpact->active = $request->active == 'true' || $request->active == 1 ? 1 : 0;
        $globalImpact->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
