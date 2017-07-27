<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



class HomeProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer('widgets/categorys','App\Http\ViewComposers\CategoryComposer');
      View::composer('widgets/head','App\Http\ViewComposers\HeadComposer');
      View::composer('widgets/search','App\Http\ViewComposers\SearchComposer');
      View::composer('widgets/loginvalide','App\Http\ViewComposers\LoginvalideComposer');
      View::composer('widgets/usertouimg','App\Http\ViewComposers\UserComposer');
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
