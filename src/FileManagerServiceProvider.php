<?php

namespace Backpack\FileManager;

use Backpack\Basset\Facades\Basset;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    protected $commands = [
        \Backpack\FileManager\Console\Commands\Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $config = $this->app['config']->get('elfinder.route', []);
        $config['namespace'] = 'Backpack\FileManager\Http\Controllers';

        $router->group($config, function($router)
        {
			$router->get('ckeditor5', ['as' => 'elfinder.ckeditor5', 'uses' => 'BackpackElfinderController@showCKeditor5']);
        });
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the views.
        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/elfinder'),
        ], 'views');

        // Publishing config file.
        $this->publishes([
            __DIR__.'/../config/elfinder.php' => config_path('elfinder.php'),
        ], 'config');

        // Registering package commands.
        $this->commands($this->commands);

        // Mapping the elfinder prefix, if missing
        if (! Config::get('elfinder.route.prefix')) {
            Config::set('elfinder.route.prefix', Config::get('backpack.base.route_prefix').'/elfinder');
        }

        // Add basset view path
        Basset::addViewPath(realpath(__DIR__.'/../resources/views'));
    }
}
