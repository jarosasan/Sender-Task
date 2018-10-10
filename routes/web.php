<?php

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

Route::get('/admin', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('users.login');
});

Auth::routes();

Route::get('/admin/dashboard', function(){
    return view('admin.admin');
});

Route::resource('admin/users', 'UsersController');
Route::resource('admin/meals', 'MealController');


Route::get('/home', 'HomeController@index')->name('home');
