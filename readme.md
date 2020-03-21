# FileManager

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

Backpack admin interface for files and folder, using [barryvdh/laravel-elfinder](https://github.com/barryvdh/laravel-elfinder). This package _literally_ just:
- creates a ```public/uploads``` folder;
- installs ```barryvdh/laravel-elfinder```;
- publishes an elFinder config and view, for elFinder to play nice with Backpack;
- adds a menu item to the sidebar;

![https://backpackforlaravel.com/uploads/docs-4-0/media_library.png](https://backpackforlaravel.com/uploads/docs-4-0/media_library.png)


## Installation

From your command line, require the package (this will also require barryvdh/laravel-elfinder):

``` bash
composer require backpack/filemanager
```

Then run the install process:

```bash
php artisan backpack:filemanager:install
```

That's it. Hit refresh in your admin panel, and you'll find a new sidebar item pointing to the File Manager.

## Usage

You can use elFinder in Backpack:
- stand-alone, by accessing the ```/admin/elfinder``` route (see screenshot above);
- inside the [```browse```](https://backpackforlaravel.com/docs/4.1/crud-fields#browse), [```browse_multiple```](https://backpackforlaravel.com/docs/4.1/crud-fields#browse_multiple) or [```ckeditor```](https://backpackforlaravel.com/docs/4.1/crud-fields#ckeditor) field types;


## Security

If you discover any security related issues, please email hello@tabacitu.ro instead of using the issue tracker.

## Credits

- [Cristian Tabacitu][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/backpack/filemanager.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/backpack/filemanager.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/backpack/filemanager/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/249020338/shield

[link-packagist]: https://packagist.org/packages/backpack/filemanager
[link-downloads]: https://packagist.org/packages/backpack/filemanager
[link-travis]: https://travis-ci.org/backpack/filemanager
[link-styleci]: https://styleci.io/repos/249020338
[link-author]: https://tabacitu.ro
[link-contributors]: ../../contributors
