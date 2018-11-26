<?php

namespace App\Providers;


use Dot\Categories\Models\Category;
//use Dot\Galleries\Galleries;
use Dot\Galleries\Galleries;
use Dot\Galleries\Models\Gallery;
use Dot\Navigations\Models\Nav;
use Dot\Seasons\Models\Season;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        require app_path('./helper.php');
        $cats = Category::whereHas('seasons', function ($query){
            $query->whereHas('posts');
        })->take(12)->get();

        view()->composer('layouts.partials.header', function ($view) use ($cats) {
            $view->with('cats', $cats);
        });

        view()->composer('extensions.subscribe', function ($view) {

            $slider = Gallery::get()->first();

            $view->with('slider', $slider);
        });

        view()->composer('layouts.partials.footer', function ($view) use ($cats) {
            $view->with('cats', $cats);
            ($nav1 = Nav::with('items')->where(['menu' => "2"])->get());
            ($nav2 = Nav::with('items')->where(['menu' => "7"])->get());
            $view->with('nav1', $nav1);
            $view->with('nav2', $nav2);
        });

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
