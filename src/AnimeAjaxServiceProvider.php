<?php

namespace Tannhatcms\AnimeAjax;
use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AnimeAjaxServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Where the route file lives, both inside the package and in the app (if overwritten).
     *
     * @var string
     */
    public $routeFilePath = '/routes/backpack/AnimeAjax.php';

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */

    public function boot()
    {
        // define the routes for the application
        $this->setupRoutes($this->app->router);
        // publish route file
        $this->publishes([__DIR__ . $this->routeFilePath => base_path($this->routeFilePath)], 'routes_AnimeAjax');
        //$this->loadViewsFrom(__DIR__ . '/../resources/views/ajax', 'ajax');
    }
    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        // by default, use the routes file provided in vendor
        $routeFilePathInUse = __DIR__.$this->routeFilePath;

        // but if there's a file with the same name in routes/backpack, use that one
        if (file_exists(base_path().$this->routeFilePath)) {
            $routeFilePathInUse = base_path().$this->routeFilePath;
        }

        $this->loadRoutesFrom($routeFilePathInUse);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {

    }
}