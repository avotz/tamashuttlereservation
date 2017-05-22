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

//travels
Route::get('/', 'TravelsController@index');
Route::get('/agenda', 'TravelsController@index');
Route::get('/travels/list', 'TravelsController@getTravels');
Route::get('/travels/export', 'TravelsController@export');
Route::resource('travels', 'TravelsController');

//reservations
Route::get('/reservations/list', 'ReservationsController@getReservations');
Route::put('/reservations/{reservation}/assigned', 'ReservationsController@updateAssigned');
Route::put('/reservations/{reservation}/cancel', 'ReservationsController@cancel');
Route::resource('reservations', 'ReservationsController');

//destinations
Route::get('/destinations/list', 'DestinationsController@getDestinations');
//clients
Route::get('/clients/list', 'ClientsController@getClients');
//hotels
Route::get('/hotels/list', 'HotelsController@getHotels');

Route::middleware('authByRole:admin')->group(function ()
{
	//Agenda
	Route::get('/operations', 'AgendaController@index');
	Route::get('/vehicles/list', 'VehiclesController@getVehicles');
    

    //users
	Route::resource('users', 'UsersController');

	//vehicles
	Route::resource('vehicles', 'VehiclesController');

	//destinations
	
	Route::resource('destinations', 'DestinationsController');

	//clients
	Route::resource('clients', 'ClientsController');

	//hotels
	Route::resource('hotels', 'HotelsController');

	//billing
	Route::resource('billing', 'BillingController');


	
});

Auth::routes();

//Route::get('/register', 'Auth\RegisterPatientController@showRegistrationForm');
//Route::post('/register', 'Auth\RegisterPatientController@register');

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->middleware('authByRole:admin');

Route::get('/home', 'TravelsController@index');

