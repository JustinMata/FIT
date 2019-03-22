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
   return View::make('pages.home');
});

/**
* @TODO: move the logic to a controller and maybe create an adapter
*/
Route::get('/googleApi', function () {

    $client = new Google_Client();
    $client->setApplicationName("Client_Library_Examples");
    $client->setDeveloperKey("YOUR_APP_KEY");

    $service = new Google_Service_Books($client);
    $optParams = array('filter' => 'free-ebooks');
    $results = $service->volumes->listVolumes('Henry David Thoreau', $optParams);

    foreach ($results as $item) {
        echo $item['volumeInfo']['title'], "<br /> \n";
    }
});

/***************************
* STATIC PAGES
***************************/
Route::any('/about', function () {
   return View::make('pages.about');
});

Route::get('/coverage', function () {
   return View::make('pages.coverage');
});

Route::get('/pricing', function () {
   return View::make('pages.pricing');
});

Route::get('/faq', function () {
   return View::make('pages.faq');
});

Route::get('/help', function () {
   return View::make('pages.help');
});
/***************************
* END
***************************/

/***************************
* TESTING PAGES
***************************/

//currently working on them but should be able to successfully create an order and address
Route::get('/order', 'OrderController@make');

Route::get('/cart', function () {
   return View::make('pages.cart');
});

Route::post('/cart', 'OrderController@store');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/***************************
* END
***************************/
