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
    Route::put('/users/{user}', ['App\Http\Controllers\UserController', 'update'])->name('users.update');
    
    Route::post('/users/add', ['App\Http\Controllers\UserController', 'add'])->name('users.add');
    Route::delete('/users/{user}', ['App\Http\Controllers\UserController', 'delete'])->name('users.delete');

    Route::post('/users/{user}/roles', ['App\Http\Controllers\UserController', 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', ['App\Http\Controllers\UserController', 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', ['App\Http\Controllers\UserController', 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', ['App\Http\Controllers\UserController', 'revokePermission'])->name('users.permissions.revoke');

    Route::get('/d/{course}', ['App\Http\Controllers\UserController', 'depts'])->name('users.depts');
    Route::get('/r/{role}', ['App\Http\Controllers\UserController', 'roledepts'])->name('users.roledepts');

    Route::delete('/users/{id}/destroy', ['App\Http\Controllers\UserController', 'destroy'])->name('users.archive.destroy');
    Route::get('/users/{id}/restore', ['App\Http\Controllers\UserController', 'restore'])->name('users.archive.restore');

    Route::get('/courses', 'App\Http\Controllers\Admin\CoursesController@index');
    Route::post('/save-courses', 'App\Http\Controllers\Admin\CoursesController@save');
    Route::get('/courses/{id}', 'App\Http\Controllers\Admin\CoursesController@edit');
    Route::put('/courses-update/{id}', 'App\Http\Controllers\Admin\CoursesController@update');
    Route::delete('/courses-delete/{id}', 'App\Http\Controllers\Admin\CoursesController@delete');

    Route::get('/sections', ['App\Http\Controllers\Admin\SectionsController', 'index'])->name('sections.index');
    Route::post('/save-sections', ['App\Http\Controllers\Admin\SectionsController', 'save'])->name('sections.save');
    Route::delete('/sections-delete/{id}', ['App\Http\Controllers\Admin\SectionsController', 'delete'])->name('sections.delete');
    Route::get('/sections/{id}', ['App\Http\Controllers\Admin\SectionsController', 'edit'])->name('sections.edit');
    Route::put('/sections-update/{id}', ['App\Http\Controllers\Admin\SectionsController', 'update'])->name('sections.update');

});

Route::group(['middleware' => ['auth', 'role:admin']], function () {

    Route::resource('permission', 'App\Http\Controllers\PermissionController');

    Route::resource('role', 'App\Http\Controllers\RoleController');

});