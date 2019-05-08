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
})->name('home');

/***************************
 * Authentication Auth::routes();
 ***************************/
// Authentication Routes...
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Auth\LoginController@login')->name('login');
Route::post('admin/logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('role');
Route::post('register', 'Auth\RegisterController@register')->name('register');

/***************************
 * END
 ***************************/

/***************************
 * Authenticated routes
 ***************************/
Route::middleware(['auth'])->group(function () {
    // admin routes

    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('/admin/dashboard', 'AdminController@index')->name('adminDashboard');
        Route::post('/admin/changeDriver', 'AdminController@changeDriver')->name('adminChangeDriver');
    });

    // driver routes
    Route::group(['middleware' => ['role:admin|driver']], function () {
        Route::get('/driver/dashboard', 'DriverController@index')->name('driverDashboard');
        Route::get('/driver/orders', 'DriverController@show')->name('driverOrders');
        Route::post('/driver/cancel', 'OrderController@cancel')->name('driverOrderCancel');
        Route::post('driver/deliver', 'DriverController@deliver')->name('driverOrderDeliver');
        Route::get('/driver/map', 'MapController@show')->name('driverMap');
        Route::post('/driver/location', 'DriverController@updateLocation')->name('driverUpdateLocation');
    });

    // restaurant routes
    Route::group(['middleware' => ['role:admin|restaurant']], function () {
        Route::get('/restaurant/dashboard', 'RestaurantController@index')->name('restaurantDashboard');
        Route::get('/restaurant/order', 'OrderController@make')->name('restaurantOrder');
        Route::get('/restaurant/orders', 'RestaurantController@show')->name('restaurantOrders');
        Route::post('/restaurant/order', 'OrderController@store')->name('restaurantOrderStore');
        Route::post('/restaurant/cancel', 'OrderController@cancel')->name('restaurantOrderCancel');
        Route::post('/restaurant/delete', 'OrderController@delete')->name('restaurantOrderDelete');
        Route::get('/restaurant/map', 'MapController@show')->name('restaurantMap');
        Route::post('/restaurant/map/order', 'MapController@select')->name('restaurantMapOrder');
    });
});
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

/***************************
 * END
 ***************************/
