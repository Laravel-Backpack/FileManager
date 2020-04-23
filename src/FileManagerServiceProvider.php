<?php

namespace Backpack\FileManager;

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
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'backpack');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'backpack');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
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

        $this->publishes([
            __DIR__.'/../config/elfinder.php'      => config_path('elfinder.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../public/packages/backpack/filemanager/themes/Backpack'      => public_path('packages/backpack/filemanager/themes/Backpack'),
        ], 'public');

        // Registering package commands.
        $this->commands($this->commands);

        // Mapping the elfinder prefix, if missing
        if (! Config::get('elfinder.route.prefix')) {
            Config::set('elfinder.route.prefix', Config::get('backpack.base.route_prefix').'/elfinder');
        }
    }
}
