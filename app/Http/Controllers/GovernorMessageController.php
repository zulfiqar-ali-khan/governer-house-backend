<?php

namespace App\Http\Controllers;

use App\Models\GovernorMessage;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GovernorMessageController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('permission:governor-message-list|governor-message-create|governor-message-edit|governor-message-delete', only: ['index','show']),
            new Middleware('permission:governor-message-create', only: ['create','store']),
            new Middleware('permission:governor-message-edit', only: ['edit','update', 'toggleActive']),
            new Middleware('permission:governor-message-delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $messages = GovernorMessage::latest()->get();
        return view('governor-messages.index', compact('messages'));
    }

    public function create()
    {
        return view('governor-messages.create');
    }

    public function edit(GovernorMessage $governorMessage)
    {
        return view('governor-messages.edit', compact('governorMessage'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'short_description' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'political_career' => 'nullable|string',
            'public_leadership' => 'nullable|string',
            'education_description' => 'nullable|string',
            'education_degree' => 'nullable|string|max:255',
            'family_background' => 'nullable|string',
            'born' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'previous_office' => 'nullable|string|max:255',
            'also_serves_as' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['image', 'ancestry', 'roles']);

        // Default description if empty
        if (empty($data['description'])) {
            $data['description'] = $data['short_description'];
        }

        // Process Ancestry Tree (relation, name, description)
        $ancestryTree = [];
        if ($request->has('ancestry') && is_array($request->ancestry)) {
            foreach ($request->ancestry as $item) {
                $relation = trim($item['relation'] ?? '');
                $name = trim($item['name'] ?? '');
                $desc = trim($item['description'] ?? '');
                if ($relation !== '' || $name !== '' || $desc !== '') {
                    $ancestryTree[] = [
                        'relation' => $relation,
                        'name' => $name,
                        'description' => $desc,
                    ];
                }
            }
        }
        $data['ancestry_tree'] = !empty($ancestryTree) ? $ancestryTree : null;

        // Process Roles of Governor (list of strings)
        $rolesList = [];
        if ($request->has('roles') && is_array($request->roles)) {
            foreach ($request->roles as $role) {
                $roleText = trim($role);
                if ($roleText !== '') {
                    $rolesList[] = $roleText;
                }
            }
        }
        $data['roles_of_governor'] = !empty($rolesList) ? $rolesList : null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $targetDir = public_path('uploads/governor-messages');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $request->image->move($targetDir, $imageName);
            $data['image'] = 'uploads/governor-messages/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;

        $governorMessage = GovernorMessage::create($data);

        // Ensure only one active record
        if ($governorMessage->active) {
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message and Profile added successfully.');
    }

    public function update(Request $request, GovernorMessage $governorMessage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'from' => 'nullable|date',
            'to' => 'nullable|date',
            'short_description' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'political_career' => 'nullable|string',
            'public_leadership' => 'nullable|string',
            'education_description' => 'nullable|string',
            'education_degree' => 'nullable|string|max:255',
            'family_background' => 'nullable|string',
            'born' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'previous_office' => 'nullable|string|max:255',
            'also_serves_as' => 'nullable|string|max:255',
        ]);

        $data = $request->except(['image', 'ancestry', 'roles']);

        if (empty($data['description'])) {
            $data['description'] = $data['short_description'];
        }

        // Process Ancestry Tree
        $ancestryTree = [];
        if ($request->has('ancestry') && is_array($request->ancestry)) {
            foreach ($request->ancestry as $item) {
                $relation = trim($item['relation'] ?? '');
                $name = trim($item['name'] ?? '');
                $desc = trim($item['description'] ?? '');
                if ($relation !== '' || $name !== '' || $desc !== '') {
                    $ancestryTree[] = [
                        'relation' => $relation,
                        'name' => $name,
                        'description' => $desc,
                    ];
                }
            }
        }
        $data['ancestry_tree'] = !empty($ancestryTree) ? $ancestryTree : null;

        // Process Roles of Governor
        $rolesList = [];
        if ($request->has('roles') && is_array($request->roles)) {
            foreach ($request->roles as $role) {
                $roleText = trim($role);
                if ($roleText !== '') {
                    $rolesList[] = $roleText;
                }
            }
        }
        $data['roles_of_governor'] = !empty($rolesList) ? $rolesList : null;

        if ($request->hasFile('image')) {
            if ($governorMessage->image && file_exists(public_path($governorMessage->image))) {
                @unlink(public_path($governorMessage->image));
            }
            $imageName = time() . '.' . $request->image->extension();
            $targetDir = public_path('uploads/governor-messages');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $request->image->move($targetDir, $imageName);
            $data['image'] = 'uploads/governor-messages/' . $imageName;
        }

        $data['active'] = $request->has('active') ? 1 : 0;

        $governorMessage->update($data);

        // Ensure only one active record
        if ($governorMessage->active) {
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message and Profile updated successfully.');
    }

    public function destroy(GovernorMessage $governorMessage)
    {
        if ($governorMessage->image && file_exists(public_path($governorMessage->image))) {
            @unlink(public_path($governorMessage->image));
        }
        $governorMessage->delete();

        return redirect()->route('governor-messages.index')->with('success', 'Governor Message deleted successfully.');
    }

    public function toggleActive(Request $request, GovernorMessage $governorMessage)
    {
        $isActive = $request->active == 'true' || $request->active == 1;
        
        $governorMessage->active = $isActive ? 1 : 0;
        $governorMessage->save();

        if ($isActive) {
            GovernorMessage::where('id', '!=', $governorMessage->id)->update(['active' => 0]);
        }

        return response()->json(['success' => true, 'message' => 'Status updated successfully. All other messages are now inactive.']);
    }
}
