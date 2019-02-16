<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Card API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your card. These routes
| are loaded by the ServiceProvider of your card. You're free to add
| as many additional routes to this file as your card may require.
|
*/
Route::post('/flush', 'Vink\NovaCacheCard\Http\Controllers\CacheCardController@flush');
Route::post('/cache', 'Vink\NovaCacheCard\Http\Controllers\CacheCardController@forget');
Route::get('/cache', 'Vink\NovaCacheCard\Http\Controllers\CacheCardController@get');
