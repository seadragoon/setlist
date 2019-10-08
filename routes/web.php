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

Route::redirect('/', 'index');

Route::get('/index', 'IndexController@index');

Route::get('/generateMaster', 'GenerateMasterController@index');

Route::get('/songs/add', 'SongsController@add');
Route::get('/artists/add', 'ArtistsController@add');

Route::resource('artists', 'ArtistsController');
Route::resource('songs', 'SongsController');
Route::resource('events', 'EventsController');
