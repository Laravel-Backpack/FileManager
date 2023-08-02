<!DOCTYPE html>
<html>
<head>
    
    @include('vendor.elfinder.common_scripts')
    @include('vendor.elfinder.common_styles')

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript">
        var FileBrowserDialogue = {
            init: function() {
                // Here goes your code for setting your custom things onLoad.
            },
            mySubmit: function (file) {
                window.parent.postMessage({
                    mceAction: 'fileSelected',
                    data: {
                        file: file
                    }
                }, '*');
            }
        };

        $().ready(function() {
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
                getFileCallback: function(file) { // editor callback
                    FileBrowserDialogue.mySubmit(file); // pass selected file path to TinyMCE
                },
                themes: {
                    default : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-gray.json',
                    dark : 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme/manifests/material-default.json',
                },
                theme: theme,
                height: $(window).height()
            },
            function(fm, extraObj) {
                fm.bind('open', function() {
                    setElFinderColorMode();
                });
            }).elfinder('instance');

            function isElfinderInDarkMode() {
                return typeof window.parent?.colorMode !== 'undefined' && window.parent.colorMode.result === 'dark';
            }

            function setElFinderColorMode() {
                theme = isElfinderInDarkMode() ? 'dark' : 'default';

                let instance = $('#elfinder').elfinder('instance');
                instance.changeTheme(theme).storage('theme', theme);
            }
        });
    </script>
</head>
<body style="margin:0;top:0;left:0;bottom:0;width:100%;height:100%;">

<!-- Element where elFinder will be created (REQUIRED) -->
<div id="elfinder"></div>

</body>
</html>
