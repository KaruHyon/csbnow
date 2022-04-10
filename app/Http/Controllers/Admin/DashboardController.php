<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function registered()
    {
        $users = User::all();
        return view('admin.faculty')->with('users', $users);
    }

    public function roleedit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('admin.role-edit')->with('users', $users);
    }

    public function roleupdate(Request $request, $id)
    {
        $users = User::find($id);
        $users->name = $request->input('username');
        $users->usertype = $request->input('usertype');
        $users->update();

        return redirect('/faculty')->with('status', 'Records successfully updated!');
    }

    public function roledelete(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/faculty')->with('status', 'Record has been deleted.');
    }
}
