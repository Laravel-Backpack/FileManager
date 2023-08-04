<!DOCTYPE html>
<html lang="<?= app()->getLocale() ?>">
    <head>
        <meta charset="utf-8">
        <title>elFinder 2.0</title>

        <!-- jQuery and jQuery UI (REQUIRED) -->
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

        <!-- elFinder CSS (REQUIRED) -->
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/elfinder.min.css') ?>">
        <link rel="stylesheet" type="text/css" href="<?= asset($dir.'/css/theme.css') ?>">

        <!-- elFinder JS (REQUIRED) -->
        <script src="<?= asset($dir.'/js/elfinder.min.js') ?>"></script>

        <!-- TinyMCE Popup class (REQUIRED) -->
        <script type="text/javascript" src="<?= asset($dir.'/js/tiny_mce_popup.js') ?>"></script>

        <?php if ($locale) { ?>
            <!-- elFinder translation (OPTIONAL) -->
            <script src="<?= asset($dir."/js/i18n/elfinder.$locale.js") ?>"></script>
        <?php } ?>

        <script type="text/javascript">
            var FileBrowserDialogue = {
                init: function() {
                    // Here goes your code for setting your custom things onLoad.
                },
                mySubmit: function (URL) {
                    var win = tinyMCEPopup.getWindowArg('window');

                    // pass selected file path to TinyMCE
                    win.document.getElementById(tinyMCEPopup.getWindowArg('input')).value = URL;

                    // are we an image browser?
                    if (typeof(win.ImageDialog) != 'undefined') {
                        // update image dimensions
                        if (win.ImageDialog.getImageData) {
                            win.ImageDialog.getImageData();
                        }
                        // update preview if necessary
                        if (win.ImageDialog.showPreviewImage) {
                            win.ImageDialog.showPreviewImage(URL);
                        }
                    }

                    // close popup window
                    tinyMCEPopup.close();
                }
            }

            tinyMCEPopup.onInit.add(FileBrowserDialogue.init, FileBrowserDialogue);

            $().ready(function() {
                var theme = 'default';

                var elf = $('#elfinder').elfinder({
                    // set your elFinder options here
                    <?php if ($locale) { ?>
                        lang: '<?= $locale ?>', // locale
                    <?php } ?>
                    customData: { 
                        _token: '<?= csrf_token() ?>'
                    },
                    url : '<?= route('elfinder.connector') ?>',  // connector URL
                    soundPath: '<?= asset($dir.'/sounds') ?>',
                    getFileCallback: function(file) { // editor callback
                        FileBrowserDialogue.mySubmit(file.url); // pass selected file path to TinyMCE
                    },
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
    <body>

        <!-- Element where elFinder will be created (REQUIRED) -->
        <div id="elfinder"></div>

    </body>
</html>
