@extends(backpack_view('blank'))

@section('after_scripts')
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

    @include('backpack.filemanager::common_scripts', ['locale' => in_array($locale, array_keys($elfinderConfiguredLanguages)) ? $locale : null])
    @include('backpack.filemanager::common_styles')
    
    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $(document).ready(function() {
            $('#elfinder').elfinder({
                // set your elFinder options here
                commandsOptions: {
                    preference: {
                        langs: @json($elfinderConfiguredLanguages)
                    }
                },
                @if($locale)
                    lang: '{{ $locale }}', // locale
                    @if($locale !== 'en')
                        i18nBaseUrl: '{{ \Illuminate\Support\Str::beforeLast(Basset::getUrl("bp-elfinder-i18n-".$locale), "elfinder.") }}/',
                    @endif
                @endif
                customData: { 
                    _token: '{{ csrf_token() }}'
                },
                url : '{{ route("elfinder.connector") }}',  // connector URL
                soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                cssAutoLoad: false,
            });
        });
    </script>
@endsection

@php
  $breadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    trans('backpack::crud.file_manager') => false,
  ];
@endphp

@section('header')
    <section class="container-fluid" bp-section="page-header">
      <h1 bp-section="page-heading">{{ trans('backpack::crud.file_manager') }}</h1>
    </section>
@endsection

@section('header')
    <section class="header-operation container-fluid animated fadeIn d-flex mb-2 align-items-baseline d-print-none" bp-section="page-header">
        <h1 class="text-capitalize mb-0" bp-section="page-heading">{{ trans('backpack::crud.file_manager') }}</h1>
    </section>
@endsection

@section('content')
        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>
@endsection
