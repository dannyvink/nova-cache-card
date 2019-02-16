<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
use Vink\CacheCard\CacheHelpers;

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
Route::post('/flush', 'Vink\CacheCard\Http\Controllers\CacheCardController@flush');
Route::post('/cache', 'Vink\CacheCard\Http\Controllers\CacheCardController@forget');
Route::get('/cache', 'Vink\CacheCard\Http\Controllers\CacheCardController@get');
