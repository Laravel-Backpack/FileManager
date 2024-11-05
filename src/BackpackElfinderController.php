<?php

namespace Backpack\FileManager;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class BackpackElfinderController extends \Barryvdh\Elfinder\ElfinderController
{
    public function showPopup($input_id)
    {
        $mimes = request('mimes');

        try {
            $mimes = Crypt::decrypt(urldecode(request('mimes')));
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Someone attempted to tamper with mime types in elfinder popup. The attempt was blocked.');
            abort(403, 'Unauthorized action.');
        }

        request()->merge(['mimes' => urlencode(serialize( $mimes))]);

        return $this->app['view']
            ->make($this->package.'::standalonepopup')
            ->with($this->getViewVars())
            ->with(compact('input_id'));
    }
}
