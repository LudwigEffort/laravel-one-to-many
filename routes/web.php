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
})->name('home');

Auth::routes();

//Route::get('/home', 'Admin\HomeController@index')->name('home');

Route::middleware('auth') //approfondire il middleware
    ->namespace('Admin')
    ->name('admin.')
    ->prefix('admin')
    ->group(function(){
        Route::get('/', 'PageController@dashboard')->name('dashboard');
        Route::resource('posts', 'PostController');
        Route::resource('categories', 'CategoryController');
    });
