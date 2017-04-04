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

//Administration routes.
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['customizedAuth', 'admin']], function (){
    Route::get('/', 'AdminController@index')->name('admin');

    //Routes for managing users.
    Route::resource('managingUsers', 'UserController');

    //Route manage Garages
    Route::resource('garages', 'GarageController', ['only' => ['index', 'update', 'destroy', 'show']]);
});

//Partner routes.
Route::group(['namespace' => 'Partner', 'prefix' => 'partner', 'middleware' => ['customizedAuth', 'partner']], function (){
    Route::get('findPlace','GarageController@chosenPlace');
    Route::get('getGarage','GarageController@getGarage');
    Route::get('/indexInactive','GarageController@indexInactive');
    Route::resource('garages','GarageController');
    Route::resource('articles', 'ArticleController');
});

//Home routes.
Route::group(['namespace' => 'Home', 'prefix' => 'home', 'middleware' => ['customizedAuth']], function (){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/myWorld', 'HomeController@myWorld');
    //Routes for home user.
    Route::resource('users', 'UserController', ['except' => [
        'store', 'create', 'destroy', 'show'
    ]]);
});

//Account activation route
Route::get('/accountActive', 'Auth\VerifyAccountController@activateAccount');


