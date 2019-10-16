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
    Route::resource('admin', 'AdminController', ['as' => 'dashboard'])->only(['index']);
    Route::resource('beers', 'BeerController');
    Route::resource('dishes', 'DishController');
    Route::resource('pdf-menus', 'PDFMenuController')->only(['index', 'store', 'destroy']);
    Route::resource('categories', 'CategoryController');
    Route::resource('users', 'UserController')->only(['index', 'edit', 'update', 'destroy'])->middleware('superuser');
    Route::resource('registration-code', 'RegistrationCodeController')->only(['create', 'store'])->middleware('superuser');
});

Route::get('/', 'HomeController@index')->name('home');
Route::resource('contact', 'ContactController')->only(['store'])->middleware('honeypot');
