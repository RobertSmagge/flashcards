<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::model('map', 'App\Folder');

Route::resource('mappen', 'FolderController', [
    'parameters' => ['mappen' => 'map'],
]);

Route::model('set', 'App\Set');

Route::get('sets/{set}/present/{order}/{part}', [
    'as'   => 'sets.present',
    'uses' => 'SetController@present'
]);

Route::resource('sets', 'SetController', [
    'parameters' => ['sets' => 'set'],
]);

Route::model('card', 'App\Card');

Route::resource('cards', 'CardController', [
    'parameters' => ['cards' => 'card'],
]);
