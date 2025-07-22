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

        if (is_dir(base_path('resources/views/vendor/backpack/filemanager'))) {
            $this->loadViewsFrom(base_path('resources/views/vendor/backpack/filemanager'), 'backpack.filemanager');
        }

        // Fallback to package views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'backpack.filemanager');

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
            'backpack.filemanager::fields',
        ]);

        ViewNamespaces::addFor('columns', [
            'backpack.filemanager::columns',
        ]);
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing exclusively the elfinder files, not the columns and fields folders
        $this->publishes([
            __DIR__.'/../resources/views/elfinder.blade.php' => resource_path('views/vendor/backpack/filemanager/elfinder.blade.php'),
            __DIR__.'/../resources/views/standalonepopup.blade.php' => resource_path('views/vendor/backpack/filemanager/standalonepopup.blade.php'),
            __DIR__.'/../resources/views/common_scripts.blade.php' => resource_path('views/vendor/backpack/filemanager/common_scripts.blade.php'),
            __DIR__.'/../resources/views/common_styles.blade.php' => resource_path('views/vendor/backpack/filemanager/common_styles.blade.php'),
        ], 'elfinder-views');

        $this->publishes([
            __DIR__.'/../resources/views/columns' => resource_path('views/vendor/backpack/filemanager/columns'),
        ], 'filemanager-columns');

        $this->publishes([
            __DIR__.'/../resources/views/fields' => resource_path('views/vendor/backpack/filemanager/fields'),
        ], 'filemanager-fields');

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
