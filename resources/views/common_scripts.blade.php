{{-- jQuery (REQUIRED) --}}
@if (!isset ($jquery) || (isset($jquery) && $jquery == true))
	@basset('https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js', true, [
		'integrity' => 'sha384-Vvooey8iu18IIP2UsBgOl+DI0kQR66LQqPBthxB5y4YqaRgugWOu+vaqwY/AGNAb', 
		'crossorigin' => 'anonymous'
	])
@endif

{{-- jQuery UI and Smoothness theme --}}
@basset('https://raw.githubusercontent.com/jquery/jquery-ui/refs/tags/1.13.2/dist/jquery-ui.min.js', true, [
	'integrity' => 'sha384-4D3G3GikQs6hLlLZGdz5wLFzuqE9v4yVGAcOH86y23JqBDPzj9viv0EqyfIa6YUL', 
	'crossorigin' => 'anonymous'
])

{{-- elFinder JS (REQUIRED) --}}
@basset('https://raw.githubusercontent.com/Studio-42/elFinder/refs/tags/2.1.64/js/elfinder.min.js', true, [
	'integrity' => 'sha384-Ow1wKIUQLS9bOa23gn7yT91nyowDhk2zK1lO7G5Hnxlh3bvTPNH7c5uODf7/jIec', 
	'crossorigin' => 'anonymous'
])

{{-- elFinder translation (OPTIONAL) --}}
@if($locale)
	@basset('bp-elfinder-i18n-'.$locale)
@endif

{{-- elFinder sounds --}}
@basset(base_path('vendor/studio-42/elfinder/sounds/rm.wav'))
