<?php

namespace Anibalealvarezs\Paladins\Providers;

use Anibalealvarezs\Projectbuilder\Traits\PbServiceProviderTrait;
use Anibalealvarezs\Paladins\Helpers\PsHelpers;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class PsViewServiceProvider extends ServiceProvider
{
    use PbServiceProviderTrait;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Kernel $kernel)
    {
        $this->booter(PsHelpers::DM_NAME, PsHelpers::DM_PACKAGE, PsHelpers::DM_DIR);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
