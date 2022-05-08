<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Courses;
use App\Http\Controllers\MailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::permission($request->term)->get();
        $users = User::all();
        $archived = User::onlyTrashed()->get();
        $text = 'Users';

        $roleset = '';
        $rolecourse = '';

        return view('admin.users.index', compact('users', 'archived', 'text', 'roleset', 'rolecourse'));
    }

    public function depts(Request $request)
    {
        $users = User::permission($request->course)->permission('access admin')->get();
        $archived = User::permission($request->course)->onlyTrashed()->get();
        $text = $request->course;

        $roleset = 'teacher';
        $rolecourse = $request->course;

        return view('admin.users.index', compact('users', 'archived', 'text', 'roleset', 'rolecourse'));
    }

    public function roledepts(Request $request)
    {
        $users = User::role($request->role)->get();
        $archived = User::role($request->role)->onlyTrashed()->get();

        if($request->role == 'teacher' || $request->role == 'student')
        {
            $text = $request->role.'s';
            $users = User::role($request->role)->get();
        }
        else
        {
            $text = $request->role;
            $users = User::role($request->role)->role('student')->get();
        }

        $roleset = $request->role;
        $rolecourse = '';

        return view('admin.users.index', compact('users', 'archived', 'text', 'roleset', 'rolecourse'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function add(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_verified = 1;
        $user->save();

        if($request->role != 'teacher' && $request->role != 'student' )
        {
            $user->assignRole($request->role);
            $user->assignRole('student');
        }
        else
        {
            $user->assignRole($request->role);
        }

        $user->givePermissionTo($request->course);

        if($user != null)
        { 
            return redirect()->back()->with('status', 'User has been successfully registered.');
        }

        return redirect()->back()->with('status', 'Something went wrong.');
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('admin.users.role', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validated = $request->validate([
            'name' => 'required', 'min:3', 
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'phone' => 'nullable|min:7|max:11'
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');

        if($request->password != null)
        {
            $validate = $request->validate([
                'password' => 'min:6|max:30'
            ]);
    
            $user->password = Hash::make($request->password);
        }
        else
        {

        }

        $user->update($validated);

        return redirect()->back()->with('status', 'User has been updated.');
    }

    public function assignRole(Request $request, User $user)
    {
        if($user->hasRole($request->role))
        {
            return back()->with('status', 'Role is already assigned to this user.');
        }
        $user->assignRole($request->role);
        return back()->with('status', 'Role successfully assigned!');
    }

    public function removeRole(User $user, Role $role)
    {
        if($user->hasRole($role))
        {
            $user->removeRole($role);
            return back()->with('status', 'Role removed from this user.');
        }
        return back()->with('status', 'Role is not assigned to this user.');
    }

    public function givePermission(Request $request, User $user)
    {
        if($user->hasPermissionTo($request->permission))
        {
            return back()->with('status', 'Permission is already assigned to this user.');
        }
        $user->givePermissionTo($request->permission);
        return back()->with('status', 'Permission successfully assigned.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if($user->hasPermissionTo($permission))
        {
            $user->revokePermissionTo($permission);
            return back()->with('status', 'Permission revoked from this user.');
        }
        return back()->with('status', 'Permission is not assigned to this user.');
    }

    public function restore($id)
    {
        $archive = User::onlyTrashed()->findOrFail($id);
        $archive->restore();
        return back()->with('status', 'User has been restored.');
    }

    public function delete(User $user)
    {
        if($user->hasRole('admin'))
        {
            return back()->with('status', 'This is an administrator user, this account cannot be deleted.');
        }
        $user->delete();
        return back()->with('status', 'User has been successfully deleted.');
    }

    public function destroy($id)
    {
        $archive = User::onlyTrashed()->findOrFail($id);
        $archive->forceDelete();
        return back()->with('status', 'User has been permanently deleted.');
    }

    ////////////////////////// user defined methods

    public function profile()
    {
        return view("profile.index");
    }

    public function postProfile(Request $request)
    {
        $user = auth()->user();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        if($request->hasfile('profile_img'))
        {
            $file = $request->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move('uploads/profile_imgs/', $filename);
            $user->profile_img = $filename;
        }

        $user->update();

        return redirect()->back()->with('status', 'Your profile has been updated.');
    }

    public function getSettings()
    {
        return view('profile.settings');
    }

    public function postSettings(Request $request)
    {
        $this->validate($request, [
            'newpassword' => 'required|min:6|max:30|confirmed'
        ]);

        $user = auth()->user();

        $user->update([
            'password' => bcrypt($request->newpassword)
        ]);

        return redirect()->back()->with('status', 'Your password has been successfully changed.');
    }
}
