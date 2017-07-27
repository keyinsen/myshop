<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AdminProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('widgets/manage','App\Http\ViewComposers\ManagesComposer');
        View::composer('widgets/admincate','App\Http\ViewComposers\ManagesComposer');
        View::composer('widgets/adordermess','App\Http\ViewComposers\AdordermessComposer');
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
