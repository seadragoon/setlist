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

// indexページ
Route::redirect('/', 'index');
Route::get('/index', 'IndexController@index');

// TODO: 本番に上げる際にはコメントアウトする
Route::get('/generateMaster', 'GenerateMasterController@index');

Route::get('/events/search', 'EventsController@search');
Route::get('/artists/search', 'ArtistsController@search');
Route::get('/songs/search', 'SongsController@search');

Route::get('/aggregate', 'AggregateController@index');
Route::get('/aggregate/show/{artist_id}', 'AggregateController@show');

Route::resource('artists', 'ArtistsController', ['only' => ['index', 'show']]);
Route::resource('songs', 'SongsController', ['only' => ['index', 'show']]);
Route::resource('events', 'EventsController', ['only' => ['index', 'show']]);

// twitterログイン
Route::get('auth/twitter', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::get('auth/twitter/logout', 'Auth\SocialAuthController@logout');

// ログインが必要なルート
Route::group(['middleware' => 'auth'], function() {
    Route::get('/artists/add', 'ArtistsController@add');
    Route::get('/songs/add', 'SongsController@add');
    
    Route::resource('artists', 'ArtistsController', ['only' => ['edit', 'update', 'destroy', 'store']]);
    Route::resource('songs', 'SongsController', ['only' => ['edit', 'update', 'destroy', 'store']]);
    Route::resource('events', 'EventsController', ['only' => ['edit', 'create', 'destroy', 'store']]);
});
