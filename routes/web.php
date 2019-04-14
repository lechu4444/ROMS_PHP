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
            ->group(function () {
                Route::get('/', 'UsersController@index')->name('index');
                Route::get('get-data', 'UsersController@getData')->name('get-data');
                Route::get('add', 'UsersController@create')->name('add');
                Route::get('edit/{id}', 'UsersController@edit')->name('edit');
                
                Route::post('add', 'UsersController@store')->name('add.post');
                Route::post('edit/{id}', 'UsersController@update')->name('edit.post');
                Route::post('delete/{id}', 'UsersController@destroy')->name('delete.post');
            });
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
