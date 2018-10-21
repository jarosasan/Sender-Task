<?php

Auth::routes();

Route::get('/admin', function () {
    return view('auth.login');
});
Route::get('/', function () {
    return view('users.login');
});

Route::post('/user_login', 'UserLoginController@login')->name('user.login');


Route::middleware('auth', 'role:admin')->group(function() {

    Route::resource('admin/users', 'UsersController');
    Route::resource('admin/plan', 'MealPlanController');
    Route::post('admin/plan/confirm', 'MealPlanController@confirm')->name('plan.confirm');
    Route::resource('admin/meals', 'MealController');
    Route::get('admin/orders', 'OrderController@index')->name('orders.index');
    Route::put('admin/orders/', 'OrderController@update')->name('orders.update');
    Route::get('admin/orders/show', 'OrderController@show')->name('orders.show');
    Route::get('admin/orders/{id}/show', 'OrderController@showOneOrder')->name('orders.show_one');

});

Route::middleware('auth')->group(function() {
    Route::get('user/menu', 'UserMenuController@index')->name('menu.index');
    Route::get('user/menu/create/{day}', 'UserMenuController@create')->name('menu.create');
    Route::post('user/menu/store', 'UserMenuController@store')->name('menu.store');
    Route::get('user/menu/show/{date}', 'UserMenuController@show')->name('menu.show');

});

