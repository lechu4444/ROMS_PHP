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

Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'can:admin-access'])
    ->group(function () {
    Route::get('/', 'DashboardController@index')
        ->name('index');

    Route::name('users.')
        ->prefix('users')
        ->middleware(['can:users-manage'])
        ->group(function () {
            Route::get('/', 'UsersController@index')
                ->name('index');
            Route::get('add', 'UsersController@create')
                ->name('add');
            Route::get('edit/{id}', 'UsersController@edit')
                ->name('edit');
            Route::get('profile/{id}', 'UsersController@profile')
                ->name('edit');

            Route::post('add/{id}', 'UsersController@store')
                ->name('add.post');
            Route::post('edit/{id}', 'UsersController@update')
                ->name('edit.post');
            Route::post('delete/{id}', 'UsersController@destroy')
                ->name('delete.post');
        });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
