<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Courses::all();
        return view('admin.courses.index')->with('courses', $courses);
    }

    public function save(Request $request)
    {
        $courses = new Courses;

        $courses->title = $request->input('course-title');
        $courses->id = $request->input('name');
        $courses->description = $request->input('course-description');

        $validated = $request->validate(['name' => ['required', 'min:3']]);
        Permission::create($validated);

        $courses->save();
        return redirect('/courses')->with('status', 'Your new subject has been added!');
    }

    public function edit($id)
    {
        $courses = Courses::findOrFail($id);
        return view('admin.courses.edit')->with('courses', $courses);
    }

    public function update(Request $request, $id)
    {
        $courses = Courses::findOrFail($id);

        $validated = $request->validate(['name' => ['required', 'min:3']]);
        $perm = Permission::findByName($courses->id);
        $perm->update($validated);
        
        $courses->title = $request->input('course-title');
        $courses->id = $request->input('name');
        $courses->description = $request->input('course-description');
        $courses->update();

        return redirect('courses')->with('status', 'Your subject has been updated.');
    }

    public function delete($id)
    {
        $courses = Courses::findOrFail($id);
        $courses->delete();

        $perm = Permission::findByName($courses->id);
        $perm->delete();
        
        return redirect('courses')->with('status', 'Your subject has been deleted.');
    }
}
