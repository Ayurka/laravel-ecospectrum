<?php

namespace App\Providers;

use App\Services\FormService;
use App\Services\InputService;
use Illuminate\Support\ServiceProvider;

class InputServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Input',InputService::class, function ($app) {
            return new InputService();
        });
        $this->app->bind('Form',FormService::class, function ($app) {
            return new FormService();
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
