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

// index
Route::get('/artists', 'ArtistsController@index')->name('artists.index');
Route::get('/songs', 'SongsController@index')->name('songs.index');
Route::get('/events', 'EventsController@index')->name('events.index');
Route::get('/aggregate', 'AggregateController@index')->name('aggregate.index');
// show
Route::get('/artists/{artist_id}', 'ArtistsController@show')->name('artists.show')->where('artist_id', '[0-9]+');
Route::get('/songs/{song_id}', 'SongsController@show')->name('songs.show')->where('song_id', '[0-9]+');
Route::get('/events/{event_id}', 'EventsController@show')->name('events.show')->where('event_id', '[0-9]+');
Route::get('/aggregate/show/{artist_id}', 'AggregateController@show')->name('aggregate.show')->where('artist_id', '[0-9]+');
// search
Route::get('/artists/search', 'ArtistsController@search')->name('artists.search');
Route::get('/songs/search', 'SongsController@search')->name('songs.search');
Route::get('/events/search', 'EventsController@search')->name('events.search');

// twitterログイン
Route::get('auth/twitter', 'Auth\SocialAuthController@redirectToProvider');
Route::get('auth/twitter/callback', 'Auth\SocialAuthController@handleProviderCallback');
Route::get('auth/twitter/logout', 'Auth\SocialAuthController@logout');

// ログインが必要なルート
Route::group(['middleware' => 'auth'], function() {
    Route::get('/artists/add', 'ArtistsController@add')->name('artists.add');
    Route::get('/songs/add', 'SongsController@add')->name('songs.add');
    
    Route::resource('artists', 'ArtistsController', ['only' => ['edit', 'update', 'destroy', 'store']]);
    Route::resource('songs', 'SongsController', ['only' => ['edit', 'update', 'destroy', 'store']]);
    Route::resource('events', 'EventsController', ['only' => ['edit', 'create', 'destroy', 'store']]);
    
    // TODO: 本番に上げる際にはコメントアウトする
    Route::get('/generateMaster', 'GenerateMasterController@index');
});
