<meta charset="utf-8">
<title>File Manager</title>
{{-- elFinder CSS (REQUIRED) --}}
@basset(base_path('vendor/studio-42/elfinder/img/icons-big.svg'), false)
@basset(base_path('vendor/studio-42/elfinder/img/logo.png'), false)
@basset(base_path('vendor/studio-42/elfinder/css/elfinder.min.css'))
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
<script type="module">
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
