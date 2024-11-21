        {{-- jQuery (REQUIRED) --}}
        @if (!isset ($jquery) || (isset($jquery) && $jquery == true))
        @basset('bp-jquery')
        @endif

        {{-- jQuery UI --}}
        @basset('bp-jquery-ui')

        @basset('bp-elfinder-js')

        {{-- elFinder translation (OPTIONAL) --}}
        @if($locale)
                @basset('bp-elfinder-i18n-'.$locale)
        @endif

        {{-- elFinder sounds --}}
        @basset(base_path('vendor/studio-42/elfinder/sounds/rm.wav'))
