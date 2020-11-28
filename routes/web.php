<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
//Route::get('/future_events', 'HomeController@futureEvents')->name('future_events');
Route::get('/list_events/{past}', 'HomeController@listEvents')->name('list_events');
Route::get('/event/{id}', 'HomeController@view')->name('event');
    
    Route::middleware('auth')->group(function(){
        Route::resource('events', 'EventController');
    });
