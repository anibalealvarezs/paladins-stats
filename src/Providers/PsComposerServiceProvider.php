<?php

namespace Anibalealvarezs\Paladins\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\View;

class PsComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(\Illuminate\Contracts\Http\Kernel $kernel)
    {
        // View Composers
        View::composers([
            // 'Anibalealvarezs\Paladins\ViewComposers\ScriptsComposer' => ['paladins::layouts.front.resources.scripts']
        ]);
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
