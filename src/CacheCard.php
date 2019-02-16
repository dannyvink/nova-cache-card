<?php

namespace Vink\NovaCacheCard;

use Laravel\Nova\Card;
use Illuminate\Support\Facades\Storage;

class CacheCard extends Card
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * Sets the default driver to the card meta.
     *
     * @return $this
     */
    public function setCacheMeta()
    {
        return $this->withMeta([
            'defaultDriver' => ucwords(config('cache.default')),
            'cacheSize' => CacheHelpers::getFileCacheSize()
        ]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        $this->setCacheMeta();
        return 'cache-card';
    }
}
