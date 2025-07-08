<?php

namespace Backpack\FileManager;

use Backpack\Basset\Facades\Basset;
use Backpack\CRUD\ViewNamespaces;
use Barryvdh\Elfinder\ElfinderController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class FileManagerServiceProvider extends ServiceProvider
{
    protected $commands = [
        Console\Commands\Install::class,
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'backpack.elfinder');
        
        $crudLanguages = array_keys(config('backpack.crud.languages', []));
        foreach ($crudLanguages as $language) {
            if ($language === 'en') {
                continue;
            }
            Basset::map('bp-elfinder-i18n-'.$language, 'https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/js/i18n/elfinder.'.$language.'.js');
        }
    }

    public function register()
    {
        $this->app->bind(ElfinderController::class, BackpackElfinderController::class);

        // Add basset view path
        Basset::addViewPath(realpath(__DIR__.'/../resources/views'));

        ViewNamespaces::addFor('fields', [
            'backpack.elfinder::fields',
        ]);

        ViewNamespaces::addFor('columns', [
            'backpack.elfinder::columns',
        ]);
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
            __DIR__.'/../resources/views' => resource_path('views/vendor/backpack/filemanager'),
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
    }
}
