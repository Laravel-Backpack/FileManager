<?php

namespace Backpack\FileManager;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class BackpackElfinderController extends \Barryvdh\Elfinder\ElfinderController
{
    public function showPopup($input_id)
    {
        $mimes = request('mimes');

        if (! isset($mimes)) {
            Log::error('Someone attempted to tamper with mime types in elfinder popup. The attempt was blocked.');
            abort(403, 'Unauthorized action.');
        }

        try {
            $mimes = Crypt::decrypt(urldecode(request('mimes')));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Someone attempted to tamper with mime types in elfinder popup. The attempt was blocked.');
            abort(403, 'Unauthorized action.');
        }

        if (! empty($mimes)) {
            request()->merge(['mimes' => urlencode(json_encode($mimes, JSON_UNESCAPED_SLASHES))]);
        } else {
            request()->merge(['mimes' => '']);
        }

        return $this->app['view']
            ->make('backpack.elfinder::::standalonepopup')
            ->with($this->getViewVars())
            ->with(compact('input_id'));
    }

    public function showIndex()
    {
        return $this->app['view']
            ->make('backpack.elfinder::elfinder')
            ->with($this->getViewVars());
    }
}
