<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sections;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SectionsController extends Controller
{
    public function index()
    {
        $sections = Sections::all();
        $roles = Role::all();

        return view('admin.sections.index', compact('sections', 'roles'));
    }

    public function save(Request $request)
    {
        $sections = new Sections;

        $sections->name = $request->input('section-name');
        $sections->id = $request->input('name');

        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Role::create($validated);

        $sections->save();
        return redirect('sections')->with('status', 'Your new section has been added!');
    }

    public function edit($id)
    {
        $permissions = Permission::all();
        
        $section = Sections::findOrFail($id);
        $role = Role::findByName($section->id);

        return view('admin.sections.edit', compact('section', 'permissions', 'role'));
    }

    public function update(Request $request, $id)
    {
        $section = Sections::findOrFail($id);
        $role = Role::findByName($section->id);

        $validated = $request->validate([
            'name' => ['required', 'min:3'], 
            'section-name' => ['required', 'min:3']
        ]);
        
        $section->name = $request->input('section-name');
        $section->id = $request->input('name');
        $section->update();

        $role->update($validated);

        return redirect('sections')->with('status', 'Your section has been updated.');
    }

    public function delete($id)
    {
        $sections = Sections::findOrFail($id);
        $sections->delete();

        $role = Role::findByName($sections->id);
        $role->delete();
        
        return redirect('sections')->with('status', 'Your section has been deleted.');
    }
}
