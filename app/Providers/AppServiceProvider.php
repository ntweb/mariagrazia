<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use View;
use App;
use SEO;

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


        // // Languages        
        View::share ('languages', \LaravelLocalization::getSupportedLocales());

        // // Category
        $query =  \App\Category::active()->whereHas('translations', function ($query) {
                                $query->where('locale', App::getLocale())
                                ->orderBy('title');
                            });
        View::share ('arrCategories', $query->get());

        // forn pagination that have paramenters
        View::share ('pagination_param', array());
        
        // // css above the fold 
        // if (file_exists(public_path('minify/style.min.css')))
        //     View::share ('_above_the_fold_css', file_get_contents(public_path('minify/style.min.css')));

        //**** SEO ****//
        // $data['page'] = page('homepage', '1');
        // SEO::setTitle($data['page']->mtitle);
        // SEO::setDescription($data['page']->mdescription);
        // SEO::opengraph()->setUrl(url()->current());        
        // SEO::opengraph()->addProperty('locale', \LaravelLocalization::getCurrentLocaleRegional());
        // SEO::opengraph()->addProperty('type', 'website');
        // if ($data['page']->img)
        //     SEO::opengraph()->addImage(img($data['page'], 'img'));              
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
