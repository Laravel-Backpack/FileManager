<?php

namespace Backpack\FileManager\Http\Controllers;

class BackpackElfinderController extends \Barryvdh\Elfinder\ElfinderController
{
    public function showCKeditor5()
    {
        return $this->app['view']
            ->make($this->package . '::ckeditor5')
            ->with($this->getViewVars());
    }
}