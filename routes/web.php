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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function()
{
   return View::make('pages.home');
});

//@REMOVE
Route::get('/app', function()
{
   return View::make('layouts.app');
});

Route::get('/about', function()
{
   return View::make('pages.contact');
});

Route::get('/order', function () {
    return view('orderForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
