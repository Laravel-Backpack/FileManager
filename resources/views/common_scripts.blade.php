         <!-- jQuery and jQuery UI (REQUIRED) -->
        @basset("https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css")
        @if (!isset ($jquery) || (isset($jquery) && $jquery == true))
        @basset('https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js')
        @endif
        @basset("https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js")

        <!-- elFinder JS (REQUIRED) -->
        {{-- <script src="{{ asset($dir.'/js/elfinder.min.js') }}"></script> --}}
        @basset('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.61/js/elfinder.min.js', true, [
        'integrity' => 'sha512-8r9QT6jiymesvzLUgcWOBw2rh6lEPJNtv9D/NI7F5Tx85Ru29grtU++4uw4MEgG6eN0somSeOShMRKqlqn903A==',
        'crossorigin' => 'anonymous',
        'referrerpolicy' => 'no-referrer',
        ])

        @if($locale)
        <!-- elFinder translation (OPTIONAL) -->
        @basset('https://cdnjs.cloudflare.com/ajax/libs/elfinder/2.1.61/js/i18n/elfinder.'.$locale.'.min.js')
        @endif
