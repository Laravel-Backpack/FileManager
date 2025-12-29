@php
    $elfinderLanguages = [
        'ar', 'bg', 'ca', 'cs', 'da', 'de', 'el', 'en', 'es', 'fa', 'fo', 'fr', 'fr_CA', 'he', 'hr', 'hu', 'id', 'it', 'ja', 'ko', 'nl', 'no', 'pl', 'pt_BR', 'ro', 'ru', 'si', 'sk', 'sl', 'sr', 'sv', 'tr', 'ug_CN', 'uk', 'vi', 'zh_CN', 'zh_TW',
    ];
    $locales = config('backpack.crud.locales', []);
    $elfinderConfiguredLanguages = [];
    foreach ($locales as $code => $name) {
        if (in_array($code, $elfinderLanguages)) {
            $elfinderConfiguredLanguages[$code] = $name;
        }
    }
    // Add English if not present, as it's the fallback
    if (!array_key_exists('en', $elfinderConfiguredLanguages)) {
            $elfinderConfiguredLanguages['en'] = 'English';
    }

    // Pre-load other configured languages so they are available when switching in UI
    foreach ($elfinderConfiguredLanguages as $lang => $name) {
        if ($lang !== 'en' && $lang !== $locale) {
            try {
                \Backpack\Basset\Facades\Basset::basset('bp-elfinder-i18n-'.$lang, false);
            } catch (\Throwable $e) {}
        }
    }
@endphp
