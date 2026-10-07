<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SliderController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:slider-list|slider-create|slider-edit|slider-delete', only: ['index','show']),
            new Middleware('permission:slider-create', only: ['create','store']),
            new Middleware('permission:slider-edit', only: ['edit','update', 'toggleActive']),
            new Middleware('permission:slider-delete', only: ['destroy']),
        ];
    }
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except('image');
        
        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/sliders'), $imageName);
            $data['image'] = 'uploads/sliders/' . $imageName;
        }
        
        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'label' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'nullable|integer',
            'active' => 'nullable|boolean',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if($slider->image && file_exists(public_path($slider->image))) {
                unlink(public_path($slider->image));
            }
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('uploads/sliders'), $imageName);
            $data['image'] = 'uploads/sliders/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;
        $data['order'] = $request->order ?? 0;

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if($slider->image && file_exists(public_path($slider->image))) {
            unlink(public_path($slider->image));
        }
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }

    public function toggleActive(Request $request, Slider $slider)
    {
        $slider->active = $request->active == 'true' || $request->active == 1 ? 1 : 0;
        $slider->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }
}
