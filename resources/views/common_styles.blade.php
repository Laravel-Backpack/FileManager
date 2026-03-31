<meta charset="utf-8">
<title>File Manager</title>
{{-- elFinder CSS (REQUIRED) --}}
{{-- elFinder images referenced via relative paths from elfinder.min.css --}}
@basset(base_path('vendor/studio-42/elfinder/img/arrows-active.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/arrows-normal.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/crop.gif'), false)
@basset(base_path('vendor/studio-42/elfinder/img/dialogs.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/editor-icons.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/icons-big.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/icons-big.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/icons-small.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/logo.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/progress.gif'), false)
@basset(base_path('vendor/studio-42/elfinder/img/quicklook-bg.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/quicklook-icons.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/resize.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/spinner-mini.gif'), false)
@basset(base_path('vendor/studio-42/elfinder/img/toolbar.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/trashmesh.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_box.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_box.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_dropbox.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_dropbox.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_ftp.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_ftp.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_googledrive.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_googledrive.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_local.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_local.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_network.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_network.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_onedrive.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_onedrive.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_sql.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_sql.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_trash.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_trash.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_zip.png'), false)
@basset(base_path('vendor/studio-42/elfinder/img/volume_icon_zip.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/css/elfinder.min.css'))
{{-- jQuery UI smoothness theme images referenced via relative paths from jquery-ui.min.css --}}
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_glass_75_e6e6e6_1x400.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_glass_75_dadada_1x400.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_glass_65_ffffff_1x400.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_glass_55_fbf9ee_1x400.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_glass_95_fef1ec_1x400.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-bg_highlight-soft_75_cccccc_1x100.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-icons_222222_256x240.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-icons_454545_256x240.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-icons_2e83ff_256x240.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-icons_cd0a0a_256x240.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/images/ui-icons_888888_256x240.png', false)
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/themes/smoothness/jquery-ui.min.css', true, [
    'integrity' => 'sha384-e4Bm/JKXqLbEnnDNLZIbB0u9VBy3H9D+TNdLb22ybxTLsmtWgRhQ3/BKEgJ13zU2',
    'crossorigin' => 'anonymous',
])
@php($elFinderLightTheme = 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/css/theme-gray.min.css')
@basset($elFinderLightTheme, false)
<link
    rel="prefetch"
    href="{{ Basset::getUrl($elFinderLightTheme) }}"
    data-stylesheet-name="elfinder-theme-light"
/>
@php($elFinderDarkTheme = 'https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/css/theme.min.css')
@basset($elFinderDarkTheme, false)
<link
    rel="prefetch"
    href="{{ Basset::getUrl($elFinderDarkTheme) }}"
    data-stylesheet-name="elfinder-theme-dark"
/>
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/loading.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.eot', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/icons-big.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/icons-small.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.woff', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.ttf', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.woff2', false)

@bassetBlock('elfinderCommonStyles.css')
<style>
    .elfinder .elfinder-toolbar .elfinder-button,
    .elfinder .elfinder-toolbar .elfinder-button.ui-state-default,
    .elfinder .elfinder-toolbar .elfinder-button.ui-state-hover,
    .elfinder .elfinder-toolbar .elfinder-button.ui-state-active,
    .elfinder .elfinder-toolbar .elfinder-button.ui-state-focus {
        border: none !important;
        background: transparent !important;
        box-shadow: none !important;
        outline: none !important;
    }
</style>
@endBassetBlock

@bassetBlock('elfinderThemeSwitcherScript.js')
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    const getElfinderStyleLink = (name) => document.querySelector(`[data-stylesheet-name="elfinder-theme-${name}"]`);

    const setElfinderMode = (name) => {
        const darkModeStyleLink = getElfinderStyleLink('dark');
        darkModeStyleLink.rel = name === 'dark' ? 'stylesheet' : 'prefetch';
        const lightModeStyleLink = getElfinderStyleLink('light');
        lightModeStyleLink.rel = name === 'light' ? 'stylesheet' : 'prefetch';
    }

    const colorModeClass = window.parent.colorMode ?? window.colorMode ?? null;
    if (colorModeClass) {
        // Set mode based on configuration and watch for changes
        setElfinderMode(colorModeClass.result);
        colorModeClass.onChange((scheme) => setElfinderMode(scheme));
    } else {
        // Default to light mode
        setElfinderMode('light');
    }
});
</script>
@endBassetBlock

@if($styleBodyElement ?? false)
<script type="module">
    // we dont want to style the body when elfinder is loaded as a component in a backpack view
    // we pass true when loading elfinder inside an iframe to style the iframe body.
    // use the topbar and footbar darker color as the background to ease transitions
    document.body.style.background = '#061325';
    document.body.style.opacity = 1;
</script>
@endif
