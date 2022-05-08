<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Courses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $totals = [
            'teacher' => User::permission('access admin')->count(),
            'student' => User::role('student')->count(),
            'course' => Courses::count(),
        ];
        
        return view('admin.dashboard', compact('totals'));
    }
}
