@extends(backpack_view('blank'))

@section('after_scripts')
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $().ready(function() {
                var theme = 'default';

                $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                    themes: {
                        default : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-gray.json',
                        dark : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-default.json',
                    },
                    theme: theme
                },
                function(fm, extraObj) {
                    fm.bind('open', function() {
                        setElFinderColorMode();
                    });
                });

                function isElfinderInDarkMode() {
                    return typeof window.parent.colorMode !== 'undefined' && window.parent.colorMode.result === 'dark';
                }

                function setElFinderColorMode() {
                    theme = isElfinderInDarkMode() ? 'dark' : 'default';

                    let instance = $('#elfinder').elfinder('instance');
                    instance.changeTheme(theme).storage('theme', theme);
                }

                if(typeof window.parent.colorMode !== 'undefined') {
                    window.parent.colorMode.onChange(function() {
                        setElFinderColorMode();
                    });
                }
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

@section('content')

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

@endsection
