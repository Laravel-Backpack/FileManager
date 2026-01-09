<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
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
        @endphp
        @include('backpack.filemanager::common_scripts', ['locale' => in_array($locale, array_keys($elfinderConfiguredLanguages)) ? $locale : null])
        @include('backpack.filemanager::common_styles', ['styleBodyElement' => true])
        <style type="text/css">
        .elfinder-workzone {
            min-height: max-content !important;
        }

        #elfinder {
            height: 100% !important;
            width: 100% !important;
            top:0;
            left: 0;
        }
        </style>

        <script type="text/javascript">
            $(document).ready(function () {
                let elfinderConfig = {
                    cssAutoLoad : false,
                    speed: 100,
                    // set your elFinder options here
                    @if($locale)
                        lang: '{{ $locale }}', // locale
                        @if($locale !== 'en')
                            i18nBaseUrl: '{{ \Illuminate\Support\Str::beforeLast(Basset::getUrl("bp-elfinder-i18n-".$locale), ".elfinder") }}/',
                        @endif
                    @endif
                    customData: { 
                        _token: '{{ csrf_token() }}'
                    },
                    url: '{{ route("elfinder.connector") }}',  // connector URL
                    soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
                    resizable: false,
                    onlyMimes: @json(urldecode(json_decode(request('mimes'))), JSON_UNESCAPED_SLASHES),
                    commandsOptions: {
                        getfile: {
                            multiple: {{ request('multiple') ? 'true' : 'false' }},
                            oncomplete: 'destroy'
                        },
                        preference: {
                            langs: @json($elfinderConfiguredLanguages)
                        }
                    },
                    getFileCallback: (file) => {
                        @if (request()->has('multiple') && request()->input('multiple') == 1)
                            window.parent.processSelectedMultipleFiles(file, '{{ $input_id  }}');
                        @else
                            window.parent.processSelectedFile(file.path, '{{ $input_id  }}');
                        @endif
                        window.parent.jQuery.colorbox.close();
                    },                    
                };
                let elfinderOptions = window.parent.elfinderOptions ?? {};
                var elf = $('#elfinder').elfinder({...elfinderConfig, ...elfinderOptions}).elfinder('instance');

                document.getElementById('elfinder').style.opacity = 1;   
            });          
        </script>
    </head>
    <body style="margin:0;position:absolute;top:0;left:0;width:100%;height:100%;">

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder" style="position:absolute;top:0;left:0;width:100%;height:100%;"></div>
    </body>
</html>
