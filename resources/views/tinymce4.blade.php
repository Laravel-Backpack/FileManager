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
                mySubmit: function (URL) {
                    // pass selected file path to TinyMCE
                    parent.tinymce.activeEditor.windowManager.getParams().setUrl(URL);

                    // close popup window
                    parent.tinymce.activeEditor.windowManager.close();
                }
            }

            $().ready(function() {

                var defaultElfConfig = {
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                    @endif
                    customData: {
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ asset($dir.'/sounds') }}',
                    getFileCallback: function(file) { // editor callback
                        FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
                    }
                };

                var overrideConfig = @json(config('elfinder.client_options'));

                var elf = $('#elfinder').elfinder(Object.assign(defaultElfConfig, overrideConfig)).elfinder('instance');
            });
        </script>
    </head>
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
