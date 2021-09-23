<?php

namespace Anibalealvarezs\Paladins\Providers;

use Anibalealvarezs\Paladins\Helpers\PsHelpers;
use Anibalealvarezs\Projectbuilder\Helpers\PbHelpers;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class PsControllerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register()
    {
        $this->app->make(PbHelpers::PB_VENDOR.'\\'.PsHelpers::DM_PACKAGE.'\Controllers\Paladins\\'.PsHelpers::DM_PREFIX.'PaladinsController');
    }
}
