<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \PagSeguro\Library::initialize();
        \PagSeguro\Library::cmsVersion()->setName("Marketplace")->setRelease("1.0.0");
        \PagSeguro\Library::moduleVersion()->setName("Nome")->setRelease("1.0.0");

        // $categories = \App\Category::all(['name', 'slug']);

        // compartilhando para toda a aplicação com view share
        // view()->share('categories', $categories);

        // compartilhando para uma ou mais view com view composer
        // view()->composer(['welcome', 'cart'], function($view) use ($categories) {
        //     $view->with('categories', $categories);
        // });

        // compartilhando para todas as view com view composer
        // view()->composer('*', function($view) use ($categories) {
        //     $view->with('categories', $categories);
        // });

        // compartilhando usando classe agora
        // view()->composer('*', 'App\Http\View\Composers\CategoryComposer');
    }
}
