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

Auth::routes();

Route::get('/home', 'Admin\CompaniesController@index')->name('home');

Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function() {
	Route::resource('companies', 'CompaniesController');
	Route::resource('orders', 'OrdersController');
	Route::resource('users', 'UsersController');
});