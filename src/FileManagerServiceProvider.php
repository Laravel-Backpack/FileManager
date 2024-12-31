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
        if (! backpack_pro()) {
            Basset::map('bp-jquery-ui-js', 'https://raw.githubusercontent.com/jquery/jquery-ui/refs/tags/1.13.2/dist/jquery-ui.min.js', ['integrity' => 'sha384-4D3G3GikQs6hLlLZGdz5wLFzuqE9v4yVGAcOH86y23JqBDPzj9viv0EqyfIa6YUL', 'crossorigin' => 'anonymous']);
        }

        Basset::map('bp-elfinder-js', 'https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/js/elfinder.min.js', ['integrity' => 'sha384-Ow1wKIUQLS9bOa23gn7yT91nyowDhk2zK1lO7G5Hnxlh3bvTPNH7c5uODf7/jIec', 'crossorigin' => 'anonymous']);
        Basset::map('bp-elfinder-css', 'https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/css/elfinder.min.css', ['integrity' => 'sha384-O+x3Lv203m3W8SILSSf8xt2ryvN+CEx3s9tpGloi3D6UQ+1BkbXPuSxEj7uhKKCs', 'crossorigin' => 'anonymous']);
        Basset::map('bp-elfinder-icons-big', 'https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/img/icons-big.svg', ['integrity' => 'sha384-BWeb84E4ly6GgjPMWRpJNB+I8XpW+xqF9kezQR6PNqXP0pmjHi8iqlGZs0JRgHlu', 'crossorigin' => 'anonymous']);
        Basset::map('bp-elfinder-logo', 'https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/img/logo.png', ['integrity' => 'sha384-mAtths5Wl6rU0MrgaCz2bJRTIG8LhA1pLZ4ZX+Qo9fQRjlKFxb5eLWUO3pZ7Aioq', 'crossorigin' => 'anonymous']);

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
            __DIR__.'/../resources/views/standalonepopup.blade.php' => resource_path('views/vendor/elfinder/standalonepopup.blade.php'),
            __DIR__.'/../resources/views/elfinder.blade.php' => resource_path('views/vendor/elfinder/elfinder.blade.php'),
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
