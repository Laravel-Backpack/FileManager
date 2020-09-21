@extends('backpack::layouts.top_left')


@section('after_scripts')
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <!-- elFinder initialization (REQUIRED) -->
        <script type="text/javascript" charset="utf-8">
            // Documentation for client options:
            // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
            $().ready(function() {

                var defaultElfConfig = {
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: {
                        _token: '{{ csrf_token() }}'
                    },
                    url : '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}'
                };

                var overrideConfig = @json(config('elfinder.client_options'));

                $('#elfinder').elfinder(Object.assign(defaultElfConfig, overrideConfig));
            });
        </script>
@endsection

@php
  $breadcrumbs = [
    trans('backpack::crud.admin') => url(config('backpack.base.route_prefix'), 'dashboard'),
    'File Manager' => false,
  ];
@endphp

@section('header')
    <section class="container-fluid">
      <h2>File Manager</h2>
    </section>
@endsection

@section('content')

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

@endsection
