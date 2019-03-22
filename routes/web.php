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

Route::get('/', function()
{
   return View::make('pages.home');
});


/***************************
 * STATIC PAGES
 ***************************/
Route::any('/about', function()
{
   return View::make('pages.about');
});

Route::get('/coverage', function()
{
   return View::make('pages.coverage');
});

Route::get('/pricing', function()
{
   return View::make('pages.pricing');
});

Route::get('/faq', function()
{
   return View::make('pages.faq');
});

Route::get('/help', function()
{
   return View::make('pages.help');
});
/***************************
 * END
 ***************************/

/***************************
 * TESTING PAGES
 ***************************/
Route::get('/app', function()
{
   return View::make('layouts.app');
});



Route::get('/order', function () {
    return view('orderForm');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/***************************
 * END
 ***************************/
