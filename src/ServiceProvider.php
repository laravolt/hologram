<?php

namespace Laravolt\Hologram;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Laravolt\Hologram\Repositories\LogRepositoryInterface;

/**
 * Class PackageServiceProvider
 *
 * @package Laravolt\Hologram
 * @see http://laravel.com/docs/master/packages#service-providers
 * @see http://laravel.com/docs/master/providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @see http://laravel.com/docs/master/providers#deferred-providers
     * @var bool
     */
    protected $defer = false;

    protected $requiredProviders = [
        \Laravolt\Suitable\ServiceProvider::class,
    ];

    /**
     * Register the service provider.
     *
     * @see http://laravel.com/docs/master/providers#the-register-method
     * @return void
     */
    public function register()
    {
        $this->app->bind('laravolt.hologram', function(){
            return new Hologram();
        });
    }

    /**
     * Application is booting
     *
     * @see http://laravel.com/docs/master/providers#the-boot-method
     * @return void
     */
    public function boot()
    {
        $this->loadRequiredProviders();

        $this->registerViews();
        $this->registerTranslations();
        $this->registerConfigurations();

        if(! $this->app->routesAreCached() && config('laravolt.hologram.route.enabled')) {
            $this->registerRoutes();
        }

        //$repository = config('laravolt.hologram.repository');
        //$this->app->bind(LogRepositoryInterface::class, $repository);

    }

    /**
     * Register the package views
     *
     * @see http://laravel.com/docs/master/packages#views
     * @return void
     */
    protected function registerViews()
    {
        // register views within the application with the set namespace
        $this->loadViewsFrom($this->packagePath('resources/views'), 'hologram');
        // allow views to be published to the storage directory
        $this->publishes([
            $this->packagePath('resources/views') => base_path('resources/views/vendor/hologram'),
        ], 'views');
    }


    /**
     * Register the package translations
     *
     * @see http://laravel.com/docs/master/packages#translations
     * @return void
     */
    protected function registerTranslations()
    {
        $this->loadTranslationsFrom($this->packagePath('resources/lang'), 'hologram');
    }

    /**
     * Register the package configurations
     *
     * @see http://laravel.com/docs/master/packages#configuration
     * @return void
     */
    protected function registerConfigurations()
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/hologram.php'), 'laravolt.hologram'
        );
        $this->publishes([
            $this->packagePath('config/config.php') => config_path('laravolt/hologram.php'),
        ], 'config');
    }

    /**
     * Register the package routes
     *
     * @warn consider allowing routes to be disabled
     * @see http://laravel.com/docs/master/routing
     * @see http://laravel.com/docs/master/packages#routing
     * @return void
     */
    protected function registerRoutes()
    {
        $router = $this->app['router'];
        require __DIR__.'/../routes/web.php';
    }

    /**
     * Loads a path relative to the package base directory
     *
     * @param string $path
     * @return string
     */
    protected function packagePath($path = '')
    {
        return sprintf("%s/../%s", __DIR__ , $path);
    }

    protected function loadRequiredProviders()
    {
        $loadedProviders = $this->app->getLoadedProviders();

        foreach ($this->requiredProviders as $class) {
            if (!isset($loadedProviders[$class])) {
                $this->app->register($class);
            }
        }
    }

}
