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

Route::get('/artists/add', 'ArtistsController@add');
Route::get('/songs/add', 'SongsController@add');

Route::get('/events/search', 'EventsController@search');
Route::get('/artists/search', 'ArtistsController@search');
Route::get('/songs/search', 'SongsController@search');

Route::get('/aggregate', 'AggregateController@index');
Route::get('/aggregate/show/{artist_id}', 'AggregateController@show');

Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show', 'edit', 'update', 'destroy', 'store']]);
Route::resource('songs', 'SongsController', ['only' => ['index', 'show', 'edit', 'update', 'destroy', 'store']]);
Route::resource('events', 'EventsController', ['only' => ['index', 'show', 'edit', 'create', 'destroy', 'store']]);

Route::get('auth/twitter', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::get('auth/twitter/logout', 'Auth\SocialAuthController@logout');
