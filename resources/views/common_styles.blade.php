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
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/css/theme.min.css')
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/loading.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.eot', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/icons-big.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/images/icons-small.svg', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.woff', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.ttf', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/font/material.woff2', false)
@basset('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/css/theme-gray.min.css', false)
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
<span data-elfinder-light-theme-url="{{ Basset::getUrl('https://cdn.jsdelivr.net/gh/RobiNN1/elFinder-Material-Theme@3.0.0/Material/css/theme-gray.min.css') }}" style="display:none"></span>
@bassetBlock('elfinderThemeSwitcherScript.js')
<script type="module">
    function getElfinderStyleSheet(main = true) {
    const regex = new RegExp(main ? `RobiNN1\/elFinder-Material-Theme@3.0.0\/Material\/css\/theme\.min\.css` : `RobiNN1\/elFinder-Material-Theme@3.0.0\/Material\/css\/theme-gray\.min\.css`);        const linkElements = document.querySelectorAll('link[rel="stylesheet"]');
        // Find the main elfinder stylesheet
        let selectedLinkElement;
        for (const linkElement of linkElements) {
            if (regex.test(linkElement.href)) {
                selectedLinkElement = linkElement;
                break;
            }
        }
        return selectedLinkElement;
    }

    function addElfinderLightStylesheet() {
        let lightThemeEl = document.querySelector('[data-elfinder-light-theme-url]');
        if (!lightThemeEl) return;
        let lightThemeUrl = lightThemeEl.getAttribute('data-elfinder-light-theme-url');
        if (!lightThemeUrl) return;

        let mainStyleSheet = getElfinderStyleSheet();
        let lightStyleSheet = getElfinderStyleSheet(false);
        // if found append the light mode css to the main theme stylesheet
        if (mainStyleSheet && ! lightStyleSheet) {
            let themeLight = document.createElement('link');
            themeLight.href = lightThemeUrl;
            themeLight.rel = 'stylesheet';
            themeLight.type = 'text/css';
            mainStyleSheet.insertAdjacentElement('afterend', themeLight);
        }
    }

    let colorMode = window.parent.colorMode?.result ?? window.colorMode?.result ?? false;

    if(colorMode !== 'dark') {
        addElfinderLightStylesheet();
    }

    // register a color mode change event so that we remove
    // the light stylesheet when the color mode change
    if(colorMode) {
        let colorModeClass = window.parent.colorMode ?? window.colorMode;
        colorModeClass.onChange(function(scheme) {
            let getMainStylesheet = scheme === 'dark' ? false : true;
            let selectedLinkElement = getElfinderStyleSheet(getMainStylesheet);

            if (! selectedLinkElement) {
                return true;
            }
            // in case we switched to dark mode, remove the ligth theme css
            if(scheme === 'dark') {
                selectedLinkElement.parentNode.removeChild(selectedLinkElement);
                return true;
            }
            addElfinderLightStylesheet()
        });
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
