{{-- jQuery (REQUIRED) --}}
@if (!isset ($jquery) || (isset($jquery) && $jquery == true))
@basset('https://unpkg.com/jquery@3.6.4/dist/jquery.min.js')
@endif

{{-- jQuery UI and Smoothness theme --}}
@bassetArchive('https://github.com/jquery/jquery-ui/archive/refs/tags/1.13.2.tar.gz', 'jquery-ui-1.13.2')
@basset('jquery-ui-1.13.2/jquery-ui-1.13.2/dist/themes/smoothness/jquery-ui.min.css')
@basset('jquery-ui-1.13.2/jquery-ui-1.13.2/dist/jquery-ui.min.js')

{{-- elFinder JS (REQUIRED) --}}
@bassetDirectory(base_path('vendor/studio-42/elfinder/'), 'elfinder-vendor')
@basset('elfinder-vendor/js/elfinder.min.js')

{{-- elFinder translation (OPTIONAL) --}}
@if($locale)
@basset('elfinder-vendor/js/i18n/elfinder.'.$locale.'.js')
@endif

{{-- elFinder sounds --}}
@basset('elfinder-vendor/sounds/rm.wav')
