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
   return View::make('pages.index');
});

Route::get('/home', 'HomeController@index')->name('home');

/***************************
 * STATIC PAGES
 ***************************/
Route::any('/about', function () {
   return View::make('pages.about');
})->name('about');

Route::get('/coverage', function () {
   return View::make('pages.coverage');
})->name('coverage');

Route::get('/pricing', function () {
   return View::make('pages.pricing');
})->name('pricing');

Route::get('/faq', function () {
   return View::make('pages.faq');
})->name('faq');

Route::get('/help', function () {
   return View::make('pages.help');
})->name('help');
/***************************
 * END
 ***************************/

/***************************
 * Authentication Auth::routes();
 ***************************/
// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

Route::get('/driver/register', 'DriverController@showRegistrationForm')->name('registerDriver');
Route::post('/driver/register', 'DriverController@register');

Route::get('/restaurant/register', 'RestaurantController@showRegistrationForm')->name('registerRestaurant');
Route::post('/restaurant/register', 'RestaurantController@register');

// admin routess
Route::get('/admin/dashboard', 'AdminController@index')->name('adminDashboard');


// driver routes
Route::get('/driver/dashboard', 'DriverController@index')->name('driverDashboard');
Route::get('/driver/orders', 'DriverController@show')->name('driverOrders');
Route::get('/driver/map','OrderController@store')->name('driverMap');

// restaurant routes
Route::get('/restaurant/dashboard', 'RestaurantController@index')->name('restaurantDashboard');
Route::get('/restaurant/order', 'OrderController@make')->name('restaurantOrder');
Route::get('/restaurant/orders', 'RestaurantController@show')->name('restaurantOrders');
Route::post('/restaurant/map', 'OrderController@store')->name('driverStore');

/***************************
 * END
 ***************************/

/***************************
 * TESTING PAGES
 ***************************/

//currently working on them but should be able to successfully create an order and address
Route::get('/order', 'OrderController@make')->name('order');

Route::get('/test', 'TestController@test')->name('test');

/***************************
 * END
 ***************************/


/**
 * @TODO: move the logic to a controller and maybe create an adapter
 */
Route::get('/googleApi', function () {

   $params = [
      'origins'        => '1 hacker way, menlo park',
      'destinations'   => '1961 Vining Drive, San Leandro',

   ];

   $response = \GoogleMaps::load('distanceMatrix')
      ->setParam($params)
      ->get();

   var_dump($response);

   $response = \GoogleMaps::load('geocoding')
      ->setParam([
         'address'    => 'santa cruz',
         'components' => [
            'administrative_area'  => 'TX',
            'country'              => 'US',
         ]

      ])
      ->get();
});
