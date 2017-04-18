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
Route::get('/travels/list', 'TravelsController@getTravels');
Route::resource('travels', 'TravelsController');

//reservations
Route::get('/reservations/list', 'ReservationsController@getReservations');
Route::put('/reservations/{reservation}/assigned', 'ReservationsController@updateAssigned');
Route::resource('reservations', 'ReservationsController');

//destinations
Route::get('/destinations/list', 'DestinationsController@getDestinations');

/*Route::middleware('authByRole:subadmin|admin')->group(function ()
{*/
	//Agenda
	Route::get('/agenda', 'AgendaController@index');
	Route::get('/vehicles/list', 'VehiclesController@getVehicles');
    

    //users
	Route::resource('users', 'UsersController');

	//vehicles
	Route::resource('vehicles', 'VehiclesController');

	//destinations
	
	Route::resource('destinations', 'DestinationsController');




	
/*});*/

Auth::routes();

//Route::get('/register', 'Auth\RegisterPatientController@showRegistrationForm');
//Route::post('/register', 'Auth\RegisterPatientController@register');


Route::get('/home', 'HomeController@index');

