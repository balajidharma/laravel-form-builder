<?php

namespace BalajiDharma\LaravelFormBuilder;

use BalajiDharma\LaravelFormBuilder\Traits\ValidatesWhenResolved;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class FormBuilderServiceProvider extends ServiceProvider
{
    protected const HTML_ABSTRACT = 'html';

    protected const FORM_ABSTRACT = 'form';

    protected const BUILDER_ABSTRACT = 'laravel-form-builder';

    protected const HELPER_ABSTRACT = 'laravel-form-helper';

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/form-builder.php', 'form-builder'
        );

        $this->registerFormHelper();
        $this->registerFormBuilder();
    }

    /**
     * Register the form helper.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $abstract = static::BUILDER_ABSTRACT;

        $formBuilderClass = $this->getFormBuilderClass();

        $this->app->singleton($abstract, function ($app) use ($formBuilderClass) {
            $formBuilder = new $formBuilderClass($app, $app[static::HELPER_ABSTRACT], $app['events']);
            $formBuilder->setFormClass($this->getPlainFormClass());

            return $formBuilder;
        });

        $this->app->alias($abstract, $formBuilderClass);
        if ($formBuilderClass != FormBuilder::class) {
            $this->app->alias($abstract, FormBuilder::class);
        }

        $this->app->afterResolving(Form::class, function ($object, $app) use ($abstract) {
            $request = $app->make('request');

            if (in_array(ValidatesWhenResolved::class, class_uses($object), true) && $request->method() !== 'GET') {
                $form = $app->make($abstract)->setDependenciesAndOptions($object);
                $form->buildForm();
                $form->redirectIfNotValid();
            }
        });
    }

    /**
     * Register the form helper.
     *
     * @return void
     */
    protected function registerFormHelper()
    {
        $abstract = static::HELPER_ABSTRACT;

        $formHelperClass = $this->getFormHelperClass();

        $this->app->singleton($abstract, function ($app) use ($formHelperClass) {
            $configuration = $app->make(ConfigFactory::class);

            return new $formHelperClass($app['view'], $app['translator'], $configuration);
        });

        $this->app->alias($abstract, $formHelperClass);
        if ($formHelperClass != FormHelper::class) {
            $this->app->alias($abstract, FormHelper::class);
        }
    }

    /**
     * Bootstrap the service.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-form-builder');

        if (app()->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/form-builder.php' => config_path('form-builder.php'),
            ], ['config', 'laravel-form-builder', 'admin-core', 'admin-core-config']);

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-form-builder'),
            ], 'views');
        }
    }

    /**
     * Get the services provided by this provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['laravel-form-builder'];
    }

    /**
     * @return class-string
     */
    protected function getPlainFormClass()
    {
        return $this->app['config']->get('form-builder.plain_form_class', Form::class);
    }

    /**
     * @return class-string
     */
    protected function getFormBuilderClass()
    {
        $expectedClass = FormBuilder::class;
        $defaultClass = FormBuilder::class;

        $class = $this->app['config']->get('form-builder.form_builder_class', $defaultClass);

        if (! class_exists($class)) {
            throw new InvalidArgumentException("Class {$class} does not exist");
        }

        if ($class !== $expectedClass && ! is_subclass_of($class, $expectedClass)) {
            throw new InvalidArgumentException("Class {$class} must extend ".$expectedClass);
        }

        return $class;
    }

    /**
     * @return class-string
     */
    protected function getFormHelperClass()
    {
        $expectedClass = FormHelper::class;
        $defaultClass = FormHelper::class;

        $class = $this->app['config']->get('form-builder.form_helper_class', $defaultClass);

        if (! class_exists($class)) {
            throw new InvalidArgumentException("Class {$class} does not exist");
        }

        if ($class !== $expectedClass && ! is_subclass_of($class, $expectedClass)) {
            throw new InvalidArgumentException("Class {$class} must extend ".$expectedClass);
        }

        return $class;
    }
}
