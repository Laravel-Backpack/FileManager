<?php

namespace Backpack\FileManager\Console\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Illuminate\Console\Command;

class Install extends Command
{
    use PrettyCommandOutput;

    protected $progressBar;

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
        $this->progressBar = $this->output->createProgressBar(4);
        $this->progressBar->minSecondsBetweenRedraws(0);
        $this->progressBar->maxSecondsBetweenRedraws(120);
        $this->progressBar->setRedrawFrequency(1);
        $this->progressBar->start();

        $this->line(' Creating uploads directory');
        switch (DIRECTORY_SEPARATOR) {
            case '/': // unix
                $createUploadDirectoryCommand = ['mkdir', '-p', 'public/uploads'];
                break;
            case '\\': // windows
                if (! file_exists('public\uploads')) {
                    $createUploadDirectoryCommand = ['mkdir', 'public\uploads'];
                }
                break;
        }
        if (isset($createUploadDirectoryCommand)) {
            $this->executeProcess($createUploadDirectoryCommand);
        }

        $this->line(' Publishing elFinder assets');
        $this->executeProcess(['php', 'artisan', 'elfinder:publish']);

        $this->line(' Publishing custom elfinder views');
        $this->executeArtisanProcess('vendor:publish', [
            '--provider' => 'Backpack\FileManager\FileManagerServiceProvider',
        ]);

        $this->line(' Adding sidebar menu item');
        switch (DIRECTORY_SEPARATOR) {
            case '/': // unix
                $this->executeArtisanProcess('backpack:add-sidebar-content', [
                    'code' => '<li class="nav-item"><a class="nav-link" href="{{ backpack_url(\'elfinder\') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans(\'backpack::crud.file_manager\') }}</span></a></li>', ]);
                break;
            case '\\': // windows
                $this->executeArtisanProcess('backpack:add-sidebar-content', [
                    'code' => '<li class="nav-item"><a class="nav-link" href="{{ backpack_url(\'elfinder\') }}"><i class="nav-icon la la-files-o"></i> <span>{{ trans(\'backpack::crud.file_manager\') }}</span></a></li>', ]);
                break;
        }

        $this->progressBar->finish();
        $this->info(' Backpack\FileManager installed.');
    }
}
