<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        
        @include('vendor.elfinder.common_scripts')
        @include('vendor.elfinder.common_styles')

        <script type="text/javascript">
            $().ready(function () {
                var theme = 'default';

                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                    dialog: {width: 900, modal: true, title: 'Select a file'},
                    resizable: false,
                    onlyMimes: @json(unserialize(urldecode(request('mimes'))), JSON_UNESCAPED_SLASHES),
                    commandsOptions: {
                        getfile: {
                            multiple: {{ request('multiple') ? 'true' : 'false' }},
                            oncomplete: 'destroy'
                        }
                    },
                    getFileCallback: function (file) {
                        @if (request()->has('multiple') && request()->input('multiple') == 1)
                            window.parent.processSelectedMultipleFiles(file, '{{ $input_id  }}');
                        @else
                            window.parent.processSelectedFile(file.path, '{{ $input_id  }}');
                        @endif

                        parent.jQuery.colorbox.close();
                    },
                    themes: {
                        default : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-gray.json',
                        dark : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-default.json',
                    },
                    theme: theme,
                },
                function(fm, extraObj) {
                    fm.bind('open', function() {
                        setElFinderColorMode();
                    });
                }).elfinder('instance');

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

    </head>
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
