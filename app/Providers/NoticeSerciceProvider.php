<?php

namespace App\Providers;

use App\Tools\Notice;
use Illuminate\Support\ServiceProvider;

class NoticeSerciceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('notice', function($app){
            return new Notice(['wx_uri'=>config('notice.wx_uri'),'wx_url'=>config('notice.wx_url')]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
