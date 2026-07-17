{{-- jQuery (REQUIRED) --}}
@if (!isset ($jquery) || (isset($jquery) && $jquery == true))
	@basset('https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js', true, [
		'integrity' => 'sha384-1H217gwSVyLSIfaLxHbE7dRb3v4mYCKbpQvzx0cegeju1MVsGrX5xXxAvs/HgeFs', 
		'crossorigin' => 'anonymous'
	])
@endif

{{-- jQuery UI and Smoothness theme --}}
@basset('https://cdn.jsdelivr.net/npm/jquery-ui@1.14.2/dist/jquery-ui.min.js', true, [
	'integrity' => 'sha384-tBcEcHGtNy7/Mx08+YxuvQ6v6s0N2jgehtFiT+bLtGwTj/txXtB/L5GqXfggm5sS',
	'crossorigin' => 'anonymous'
])

{{-- elFinder JS (REQUIRED) --}}
@basset(base_path('vendor/studio-42/elfinder/js/elfinder.min.js'))

{{-- elFinder sounds --}}
@basset(base_path('vendor/studio-42/elfinder/sounds/rm.wav'))
