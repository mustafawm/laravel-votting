<?php
Route::auth();

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index');

Route::get('/community', 'CommunityLinksController@index');
Route::post('/community', 'CommunityLinksController@store');
Route::get('/community/{channel}', 'CommunityLinksController@index');

Route::post('/votes/{link}', 'VotesController@store');
