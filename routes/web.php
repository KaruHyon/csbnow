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

Route::group(['middleware' => ['auth', 'admin']], function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    });

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
