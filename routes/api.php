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
Route::post('/flush', function (Request $request) {
    /**
     * Throw something in the cache to make sure there is a valid connection. This also ensures that
     * the proper directories have been created for the 'file' cache driver.
     */
    Cache::forever('flushing', true);
    $canCacheSuccessfully = Cache::get('flushing');
    return [
        'success' => $canCacheSuccessfully && Cache::flush(),
        'size' => CacheHelpers::getFileCacheSize()
    ];
});

Route::post('/cache', function (Request $request) {
    $key = $request->get('cacheKey');
    return [
        'success' => Cache::forget($key),
        'key' => htmlentities($key),
        'size' => CacheHelpers::getFileCacheSize()
    ];
});

Route::get('/cache', function (Request $request) {
    $key = $request->get('cacheKey');
    $result = Cache::get($key);
    return [
        'success' => !!$result,
        'key' => htmlentities($key),
        'value' => $result,
        'size' => CacheHelpers::getFileCacheSize()
    ];
});
