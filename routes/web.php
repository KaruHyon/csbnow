<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/verify', 'App\Http\Controllers\Auth\RegisterController@verifyUser')->name('verify.user');

Route::group(['middleware' => ['auth', 'permission:access admin']], function () {
    
    /**Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });**/
    Route::get('/dashboard', 'App\Http\Controllers\Admin\DashboardController@dashboard');

    Route::resource('/roles', 'App\Http\Controllers\Admin\RoleController');
    Route::post('/roles/{role}/permissions', ['App\Http\Controllers\Admin\RoleController', 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', ['App\Http\Controllers\Admin\RoleController', 'revokePermission'])->name('roles.permissions.revoke');

    Route::resource('/permissions', 'App\Http\Controllers\Admin\PermissionController');

    Route::get('/profile', 'App\Http\Controllers\UserController@profile')->name('user.profile');
    Route::put('/profile', 'App\Http\Controllers\UserController@postProfile')->name('user.postProfile');
    Route::get('/settings/change', 'App\Http\Controllers\UserController@getSettings')->name('userGetSettings');
    Route::post('/settings/change', 'App\Http\Controllers\UserController@postSettings')->name('userPostSettings');

    Route::get('/users', ['App\Http\Controllers\UserController', 'index'])->name('users.index');
    Route::get('/users/{user}', ['App\Http\Controllers\UserController', 'show'])->name('users.show');
    Route::delete('/users/{user}', ['App\Http\Controllers\UserController', 'delete'])->name('users.delete');
    Route::post('/users/{user}/roles', ['App\Http\Controllers\UserController', 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', ['App\Http\Controllers\UserController', 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', ['App\Http\Controllers\UserController', 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', ['App\Http\Controllers\UserController', 'revokePermission'])->name('users.permissions.revoke');

    Route::get('/d/{course}', ['App\Http\Controllers\UserController', 'depts'])->name('users.depts');
    Route::get('/r/{role}', ['App\Http\Controllers\UserController', 'roledepts'])->name('users.roledepts');

    Route::delete('/users/{id}/destroy', ['App\Http\Controllers\UserController', 'destroy'])->name('users.archive.destroy');
    Route::get('/users/{id}/restore', ['App\Http\Controllers\UserController', 'restore'])->name('users.archive.restore');

    Route::get('/faculty', 'App\Http\Controllers\Admin\DashboardController@registered');
    Route::get('/role-edit/{id}', 'App\Http\Controllers\Admin\DashboardController@roleedit');
    Route::put('/role-update/{id}', 'App\Http\Controllers\Admin\DashboardController@roleupdate');
    Route::delete('/role-delete/{id}', 'App\Http\Controllers\Admin\DashboardController@roledelete');

    Route::get('/courses', 'App\Http\Controllers\Admin\CoursesController@course');
    Route::post('/save-courses', 'App\Http\Controllers\Admin\CoursesController@savecourse');
    Route::get('/courses/{id}', 'App\Http\Controllers\Admin\CoursesController@editcourse');
    Route::put('/courses-update/{id}', 'App\Http\Controllers\Admin\CoursesController@updatecourse');
    Route::delete('/courses-delete/{id}', 'App\Http\Controllers\Admin\CoursesController@deletecourse');

});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::resource('permission', 'App\Http\Controllers\PermissionController');

    Route::resource('role', 'App\Http\Controllers\RoleController');

});