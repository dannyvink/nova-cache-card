# Laravel Nova - Cache Management Card

Manage your application's cache from a handy Laravel Nova dashboard card.

## Installation

You can install the package in to any app running [Laravel Nova](https://nova.laravel.com) via Composer:

```bash
composer require vink/nova-cache-card
```

Once installed, you need to add the card to your `NovaServiceProvider.php` file:

```php
// in app/Providers/NovaServiceProvder.php

// ...

public function cards()
{
    return [
        // ...
        new \Vink\NovaCacheCard\CacheCard(),
    ];
}
```

## Usage

A new card will appear on your dashboard giving you control over your applications *default* cache driver. From the card, you can **get** values from the cache, **forget** values from the cache, or even **flush** the whole thing.

![Card Preview](http://dcv.io/projects/nova-cache-card/cache_card.png)

![Cache Viewer](http://dcv.io/projects/nova-cache-card/cache_view.png)

## Important Note

This is an administrative tool used to manage your applications caching. It is **up to YOU** to ensure this card is properly gated for appropriate administrators only. [Fortunately, Nova makes this easy](https://nova.laravel.com/docs/1.0/customization/cards.html#authorization). I am in no way responsible if you manage to flush *very important* cache items down the toilet.

## License

This card is released under the MIT License (MIT). Please see the included [license file](LICENSE.md) for more information.
