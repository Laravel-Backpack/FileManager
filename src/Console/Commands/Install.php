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

        // Publishing custom elfinder views
        $this->progressBlock('Publishing custom elfinder views');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => FileManagerServiceProvider::class,
        ]);
        $this->closeProgressBlock();

        // Adding sidebar menu item
        $this->progressBlock('Adding menu item');
        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<li class="nav-item"><a class="nav-link" href="{{ backpack_url(\'elfinder\') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans(\'backpack::crud.file_manager\') }}</span></a></li>',
        ]);
        $this->closeProgressBlock();

        // Done
        $url = Str::of(config('app.url'))->finish('/')->append('admin/elfinder');
        $this->infoBlock('Backpack FileManager installation complete.', 'done');
        $this->note("Go to <fg=blue>$url</> to access your filemanager.");
        $this->note('You may need to run <fg=blue>php artisan serve</> to serve your Laravel project.');
        $this->newLine();
    }
}
