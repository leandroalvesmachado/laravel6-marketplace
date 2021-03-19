<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
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

        // compartilhando usando classe agora para todas as views do sistema
        // view()->composer('*', 'App\Http\View\Composers\CategoryComposer');

        // compartilhando com view front.blade.php de layouts
        view()->composer('layouts.front', 'App\Http\View\Composers\CategoryComposer');
    }
}
