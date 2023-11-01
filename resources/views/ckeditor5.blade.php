<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
        
    @include('vendor.elfinder.common_scripts')
    @include('vendor.elfinder.common_styles', ['styleBodyElement' => true])
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
    <!-- elFinder initialization (REQUIRED) -->
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    const editor = window.parent.ckeditorInstance,
    elfinderOptions = window.parent.elfinderOptions,
    ntf = editor.plugins.get('Notification'),
    i18 = editor.locale.t,
    // Insert images to editor window
    insertImages = urls => {
        const imgCmd = editor.commands.get('imageUpload');
        if (!imgCmd.isEnabled) {
            ntf.showWarning(i18('Could not insert image at the current position.'), {
                title: i18('Inserting image failed'),
                namespace: 'ckfinder'
            });
            return;
        }
        editor.execute('imageInsert', { source: urls });
    },
    elfinderDefaultOptions = {
        @if($locale)
            lang: '{{ $locale }}', // locale
        @endif
        customData: { 
            _token: '{{ csrf_token() }}'
        },
        url: '{{ route("elfinder.connector") }}',  // connector URL
        soundPath: '{{ Basset::getUrl(base_path("vendor/studio-42/elfinder/sounds")) }}',
        useBrowserHistory : false,
        // Disable auto open
        autoOpen : false,
        resizable: false,
        // set getfile command options
        commandsOptions : {
            getfile: {
                oncomplete : 'close',
                multiple : true
            }
        },
        cssAutoLoad : false,
        getFileCallback : (files, fm) => {
            let imgs = [];
            fm.getUI('cwd').trigger('unselectall');
            $.each(files, function(i, f) {
                if (f && f.mime.match(/^image\//i)) {
                    imgs.push(fm.convAbsUrl(f.url));
                } else {
                    editor.execute('link', fm.convAbsUrl(f.url));
                }
            });
            if (imgs.length) {
                insertImages(imgs);
            }
            
            window.parent.jQuery.colorbox.close();
        }
    };

    var elf = $('#elfinder').elfinder({...elfinderDefaultOptions, ...elfinderOptions}).elfinder('instance');                

    function isElfinderInDarkMode() {
        return typeof window.parent?.colorMode !== 'undefined' && window.parent.colorMode.result === 'dark';
    }

    function setElFinderColorMode() {
        let theme = isElfinderInDarkMode() ? 'dark' : 'default';

        let instance = $('#elfinder').elfinder('instance');
        instance.changeTheme(theme).storage('theme', theme);
    }
});
        </script>
    </head>
    <body style="margin:0;position:absolute;top:0;left:0;width:100%;height:100%;transition: opacity 1s ease-out;opacity: 0;">

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder" style="position:absolute;top:0;left:0;width:100%;height:100%;"></div>

    </body>
</html>
