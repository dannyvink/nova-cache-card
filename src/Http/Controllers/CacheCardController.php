<?php

namespace Vink\CacheCard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Cache;
use Vink\CacheCard\CacheHelpers;

class CacheCardController extends Controller
{
    public function flush(): array
    {
        /**
         * Throw something in the cache to make sure there is a valid connection. This also ensures that
         * the proper directories have been created for the 'file' cache driver.
         */
        Cache::forever('flushing', true);
        $canCacheSuccessfully = Cache::get('flushing');

        return [
            'success' => $canCacheSuccessfully && Cache::flush(),
            'size' => CacheHelpers::getFileCacheSize(),
        ];
    }

    public function forget(Request $request): array
    {
        $key = $request->get('cacheKey');

        return [
            'success' => Cache::forget($key),
            'key' => htmlentities($key),
            'size' => CacheHelpers::getFileCacheSize(),
        ];
    }

    public function get(Request $request): array
    {
        $key = $request->get('cacheKey');
        $result = Cache::get($key);

        return [
            'success' => (bool)$result,
            'key' => htmlentities($key),
            'value' => $result,
            'size' => CacheHelpers::getFileCacheSize(),
        ];
    }
}
