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

Route::get('/home', 'HomeController@index')->name('home');

  Route::prefix('user')->group(function() {
     Route::get('/calendario', 'HomeController@listcalendar')->name('user.calendar');
     Route::post('/calendario', 'HomeController@allcalendar')->name('user.allcalendar');
     Route::get('/barbeiros', 'HomeController@barber')->name('user.barbers');
     Route::get('/barbeiros/{barber}/agendar/', 'HomeController@commitcalendar')->name('user.calendar.commit');
     Route::post('/barbeiros/agendar/', 'HomeController@storecalendar')->name('user.calendar.submit');

    Route::get('/barbeiros/agendar/update/{calendar}', 'HomeController@editcalendar')->name('user.calendar.update');
    Route::post('/barbeiros/agendar/update/{calendar}', 'HomeController@updatecalendar')->name('user.calendar.update');
    Route::get('/barbeiros/agendar/delete/{calendar}', 'HomeController@destroycalendar')->name('user.calendar.delete');
  });

  Route::prefix('barbeiro')->group(function() {
    Route::get('/login', 'Auth\BarberLoginController@showLoginForm')->name('barber.login');
    Route::post('/login', 'Auth\BarberLoginController@login')->name('barber.login.submit');
    Route::get('/', 'BarberController@index')->name('barber.dashboard');
    Route::get('/barbeiros', 'BarberController@listbarbers')->name('barber.barbers');
    Route::get('/clientes', 'BarberController@listclients')->name('barber.clients');
    Route::post('/clientes', 'BarberController@allclients')->name('barber.allclients');
    Route::get('/clientes/update/{client}', 'BarberController@editclients')->name('barber.clients.update');
    Route::post('/clientes/update/{client}', 'BarberController@updateclients')->name('barber.clients.update');
    Route::get('/clientes/delete/{client}', 'BarberController@destroyclients')->name('barber.clients.delete');

    Route::get('/agendar/{client}','BarberController@commitcalendar')->name('barber.clients.calendar');
    Route::post('/agendar/','BarberController@storecalendar')->name('barber.clients.calendar.submit');

    Route::get('/barbeiros/add', 'BarberController@create')->name('barber.barbers.add');
    Route::get('/barbeiros/update/{barber}', 'BarberController@edit')->name('barber.barbers.update');
    Route::post('/barbeiros/update/{barber}', 'BarberController@update')->name('barber.barbers.update');
    Route::get('/barbeiros/delete/{barber}', 'BarberController@destroy')->name('barber.barbers.delete');
    Route::get('/services', 'ServiceController@index')->name('barber.services');
    Route::get('/services/add', 'ServiceController@create')->name('barber.services.add');
    Route::post('/services/add', 'ServiceController@store')->name('barber.services.submit');
    Route::get('/services/update/{service}', 'ServiceController@edit')->name('barber.services.update');
    Route::post('/services/update/{service}', 'ServiceController@update')->name('barber.services.update');
    Route::get('/services/delete/{service}', 'ServiceController@destroy')->name('barber.services.delete');
    Route::get('/calendario', 'BarberController@listcalendar')->name('barber.calendar');
    Route::post('/calendario', 'BarberController@allcalendar')->name('barber.allcalendar');
    
    Route::get('/relatorios', 'BarberController@dash')->name('admin.dashboard');

    Route::get('/register', 'Auth\BarberRegisterController@showRegistrationForm')->name('barber.register.form');
    Route::post('/register', 'Auth\BarberRegisterController@create')->name('barber.register');
  });
