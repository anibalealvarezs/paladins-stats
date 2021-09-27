<?php

namespace Anibalealvarezs\Paladins\Providers;

use Illuminate\Cache\Repository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use PaladinsDev\PHP\PaladinsAPI;
use Halfpetal\Onoi\Illuminate\Cache;

class PsAppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot(Kernel $kernel)
    {
        /* $cacheDriver = new Cache(app(Repository::class));
        $this->app->make(PaladinsAPI::class)::getInstance(config('app.paladins_devid'), config('app.paladins_authkey'), $cacheDriver); */
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            PaladinsAPI::class,
            function ($app) {
                $cacheDriver = new Cache(app(Repository::class));
                return PaladinsAPI::getInstance(config('app.paladins_devid'), config('app.paladins_authkey'), $cacheDriver);
            }
        );
    }
}
