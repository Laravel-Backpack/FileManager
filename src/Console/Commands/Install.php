<?php

namespace Backpack\FileManager\Console\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Backpack\FileManager\FileManagerServiceProvider;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Install extends Command
{
    use PrettyCommandOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backpack:filemanager:install
                                {--timeout=300} : How many seconds to allow each process to run.
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install elFinder interface for Backpack.';

    /**
     * Execute the console command.
     *
     * @return mixed Command-line output
     */
    public function handle()
    {
        $this->infoBlock('Installing Backpack FileManager', 'Step 1');

        // Creating uploads directory
        $this->progressBlock('Creating uploads directory');
        File::ensureDirectoryExists('public/uploads');
        $this->closeProgressBlock();

        // Publishing elfinder config file
        $this->progressBlock('Publishing the config file');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => FileManagerServiceProvider::class,
            '--tag' => 'config',
        ]);
        $this->closeProgressBlock();

        // Adding sidebar menu item
        $this->progressBlock('Adding menu item');
        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item :title="trans(\'backpack::crud.file_manager\')" icon="la la-files-o" :link="backpack_url(\'elfinder\')" />',
        ]);
        $this->closeProgressBlock();

        // Done
        $url = Str::of(config('app.url'))->finish('/')->append('admin/elfinder');
        $this->infoBlock('Backpack FileManager installation complete.', 'done');
        $this->note('Go to <fg=blue>$url</> to access your filemanager.');
        $this->note('You may need to run <fg=blue>php artisan serve</> to serve your Laravel project.');
        $this->newLine();
    }
}
