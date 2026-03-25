<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public).
    |
    */
    'dir' => ['uploads'],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [
        // 'uploads',
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix' => config('backpack.base.route_prefix', 'admin').'/elfinder',
        'middleware' => ['web', config('backpack.base.middleware_key', 'admin')], //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => null,

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => [],

    /*
    |--------------------------------------------------------------------------
    | Root Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with every root by default.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1#root-options
    |
    */
    'root_options' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Encrypt MIME Types
    |--------------------------------------------------------------------------
    |
    | When enabled, MIME types configured on browse/browse_multiple fields are
    | encrypted before being passed to the frontend, preventing CASUAL URL
    | tampering. Note that this is a UI-level convenience only — NOT A SECURITY MEASURE.
    | Determined users can always bypass client-side restrictions.
    |
    */
    'encrypt_mimes' => true,
];
