@php


    // Pre-load other configured languages so they are available when switching in UI
    foreach ($elfinderConfiguredLanguages as $lang => $name) {
        if ($lang !== 'en' && $lang !== $locale) {
            try {
                \Backpack\Basset\Facades\Basset::basset('bp-elfinder-i18n-'.$lang, false);
            } catch (\Throwable $e) {}
        }
    }
@endphp
