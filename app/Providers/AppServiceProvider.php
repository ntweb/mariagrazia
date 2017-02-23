<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use View;
use App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Languages        
        View::share ('languages', \App\Language::all());

        // Category
        $query =  \App\Category::active()->whereHas('translations', function ($query) {
                                $query->where('locale', App::getLocale())
                                ->orderBy('title');
                            });
        View::share ('arrCategories', $query->get());        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
