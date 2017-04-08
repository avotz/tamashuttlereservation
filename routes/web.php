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

Route::get('/', 'TravelsController@index');
//Route::get('/reservations', 'ReservationsController@index');
Route::get('/reservations/list', 'ReservationsController@getReservations');
Route::put('/reservations/{reservation}/assigned', 'ReservationsController@updateAssigned');
Route::resource('reservations', 'ReservationsController');
Route::get('/agenda', 'AgendaController@index');

Route::get('/vehicles/list', 'VehiclesController@getVehicles');
Route::get('/travels/list', 'TravelsController@getTravels');
Route::resource('travels', 'TravelsController');

Route::middleware('authByRole:admin')->group(function ()
{
	Route::resource('users', 'UsersController');

	Route::resource('vehicles', 'VehiclesController');

	Route::get('/destinations/list', 'DestinationsController@getDestinations');
	Route::resource('destinations', 'DestinationsController');




	
});

Auth::routes();

//Route::get('/register', 'Auth\RegisterPatientController@showRegistrationForm');
//Route::post('/register', 'Auth\RegisterPatientController@register');


Route::get('/home', 'HomeController@index');

