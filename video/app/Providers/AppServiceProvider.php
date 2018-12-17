<?php

namespace App\Providers;

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
        //
        config(['domainApi' => 'http://api.video.com/index.php/']);
        config(['domainAdmin' => 'http://admin.video.com/index.php']);
        config(['Year' => '2018']);//查询年月
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
