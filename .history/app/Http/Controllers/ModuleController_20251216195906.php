<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    // List all modules
    public function index()
    {
        $manager = auth()->user();
        $modules = Module::where('manager_id', $manager->id)->get();
        return view('manager.modules', ['modules' => $modules]);
    }

    // Student-facing list
    public function studentIndex()
    {
        $modules = Module::all();
        return view('student.modules', ['modules' => $modules]);
    }

    // Store a new module
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|max:50|unique:modules,code',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:modules,color',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            $path = $request->file('picture')->store('modules', 'public');
            $validated['picture'] = $path;
        }

        Module::create($validated);

        return redirect()->route('manager.modules')->with('success', 'Module created successfully!');
    }

    // Update a module
    public function update(Request $request, Module $module)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'code' => 'required|string|max:50|unique:modules,code,' . $module->id,
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/|unique:modules,color,' . $module->id,
            'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('picture')) {
            // Delete old picture if exists
            if ($module->picture) {
                \Storage::disk('public')->delete($module->picture);
            }
            $path = $request->file('picture')->store('modules', 'public');
            $validated['picture'] = $path;
        }

        $module->update($validated);

        return redirect()->route('manager.modules')->with('success', 'Module updated successfully!');
    }

    // Delete a module
    public function destroy(Module $module)
    {
        // Delete picture if exists
        if ($module->picture) {
            \Storage::disk('public')->delete($module->picture);
        }

        $module->delete();

        return redirect()->route('manager.modules')->with('success', 'Module deleted successfully!');
    }
}

