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

/**
 * Admin Routes
 */
Route::group([
    'as'         => 'admin.',
    'middleware' => ['auth', 'admin'],
    'namespace'  => 'Admin'
], function() {
    Route::get('/admin', ['as' => 'dashboard', 'uses' => 'AdminController@index']);
    Route::resource('beers', 'BeerController');
    Route::resource('dishes', 'DishController');
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController')->only(['index', 'edit', 'update', 'destroy']);
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/create_code', 'AdminController@create_registration_code')->name('create_code');
Route::post('/admin/generate_code', 'AdminController@generate_registration_code')->name('generate_code');
//Route::get('/admin/registration_code', 'AdminController@create_registration_code');
