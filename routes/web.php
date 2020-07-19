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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/doLogin', 'Auth\LoginController@doLogin')->name('doLogin');

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users-with-status', 'UserController@usersWithStatus');
Route::get('/myrooms/{id}', 'RoomController@getRoomsByUser');
Route::post('/create-room', 'RoomController@createRoom');
Route::post('/join-room', 'RoomController@joinRoom');


Route::get('/conference/{room}/{username}/{password}', 'ConferenceController@index');


Route::get('/conference/{token}/{doctor}', 'ConferenceController@indexWithToken');

//Route::post('/create-conference', 'ConferenceController@createConference');

Route::get('/conference-create/{roompass}/{doctor}/{patient}', 'ConferenceController@create');
Route::post('/conference-create/', 'ConferenceController@store');
Route::get('/thankyou', 'ConferenceController@thankyou');


Route::get('/create-meeting', 'MeetingController@create');
Route::get('/join-meeting', 'MeetingController@join');
Route::post('/meeting', 'MeetingController@meeting');
Route::get('/invitation', 'MeetingController@invitation');
Route::get('/meeting', function(){
	return redirect('/join-meeting');
});
