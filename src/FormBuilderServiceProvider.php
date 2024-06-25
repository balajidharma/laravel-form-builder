<?php

namespace BalajiDharma\LaravelFormBuilder;

use BalajiDharma\LaravelFormBuilder\FormBuilder;
use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/form-builder.php', 'form-builder'
        );

        $this->app->bind('laravel-form-builder', function () {
            return new FormBuilder();
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

    }
}
