<?php

namespace Kazka\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Kazka\Post;
use Kazka\Category;
use Jenssegers\Date\Date;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Date::setLocale('uk');
        Schema::defaultStringLength(191);

        $index_posts = Post::orderBy('id', 'desc')->take(3)->get();
        view()->composer('index.last-news', function($view) use($index_posts){
            $view->with('index_posts', $index_posts);
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
