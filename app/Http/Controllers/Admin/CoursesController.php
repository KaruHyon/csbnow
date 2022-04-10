<?php

namespace App\Http\Controllers\Admin;

use App\Models\Courses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function course()
    {
        $courses = Courses::all();
        return view('admin.courses')->with('courses', $courses);
    }

    public function savecourse(Request $request)
    {
        $courses = new Courses;

        $courses->title = $request->input('course-title');
        $courses->id = $request->input('course-id');
        $courses->description = $request->input('course-description');

        $courses->save();
        return redirect('/courses')->with('status', 'Your new course has been added!');
    }

    public function editcourse($id)
    {
        $courses = Courses::findOrFail($id);
        return view('admin.courses.course-edit')->with('courses', $courses);
    }

    public function updatecourse(Request $request, $id)
    {
        $courses = Courses::findOrFail($id);
        $courses->title = $request->input('course-title');
        $courses->id = $request->input('course-id');
        $courses->description = $request->input('course-description');
        $courses->update();

        return redirect('courses')->with('status', 'Your course has been updated.');
    }

    public function deletecourse($id)
    {
        $courses = Courses::findOrFail($id);
        $courses->delete();
        
        return redirect('courses')->with('status', 'Your course has been deleted.');
    }
}
