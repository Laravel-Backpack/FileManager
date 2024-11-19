{{-- browse server input --}}

@include('crud::fields.inc.wrapper_start')

    <label>{!! $field['label'] !!}</label>
    @include('crud::fields.inc.translatable_icon')
	<div class="input-group">
		<input
			type="text"
			name="{{ $field['name'] }}"
			value="{{ old_empty_or_null($field['name'], '') ??  $field['value'] ?? $field['default'] ?? '' }}"
			data-init-function="bpFieldInitBrowseElement"
			data-elfinder-trigger-url="{{ url(config('elfinder.route.prefix').'/popup') }}"
			@include('crud::fields.inc.attributes')

			@if(!isset($field['readonly']) || $field['readonly']) readonly @endif
		>

		<button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-light btn-sm border popup_selector"><i class="la la-cloud-upload"></i> {{ trans('backpack::crud.browse_uploads') }}</button>
		<button type="button" data-inputid="{{ $field['name'] }}-filemanager" class="btn btn-light btn-sm border clear_elfinder_picker"><i class="la la-eraser"></i> {{ trans('backpack::crud.clear') }}</button>
	</div>
	@if (isset($field['hint']))
        <p class="help-block">{!! $field['hint'] !!}</p>
    @endif

@include('crud::fields.inc.wrapper_end')

{{-- ########################################## --}}
{{-- Extra CSS and JS for this particular field --}}
{{-- If a field type is shown multiple times on a form, the CSS and JS will only be loaded once --}}

	{{-- FIELD CSS - will be loaded in the after_styles section --}}
    @push('crud_fields_styles')
		{{-- include browse server css --}}
		@basset('https://unpkg.com/jquery-colorbox@1.6.4/example2/colorbox.css')
		@basset('https://unpkg.com/jquery-colorbox@1.6.4/example2/images/loading.gif', false)
		@basset('https://unpkg.com/jquery-colorbox@1.6.4/example2/images/controls.png', false)
		@bassetBlock('backpack/pro/fields/browse-field.css')
		<style>
			#cboxContent, #cboxLoadedContent, .cboxIframe {
				background: transparent;
			}
		</style>
		@endBassetBlock
	@endpush

    @push('crud_fields_scripts')
		{{-- include browse server js --}}
		@basset('https://unpkg.com/jquery-colorbox@1.6.4/jquery.colorbox-min.js')
		@bassetBlock('backpack/pro/fields/browse-field.js')
		<script type="text/javascript">
			// this global variable is used to remember what input to update with the file path
			// because elfinder is actually loaded in an iframe by colorbox
			var elfinderTarget = false;

			// function to update the file selected by elfinder
			function processSelectedFile(filePath, requestingField) {
				elfinderTarget.val(filePath.replace(/\\/g,"/"));
				elfinderTarget.trigger('change');
				elfinderTarget = false;
			}

			function bpFieldInitBrowseElement(element) {
				var triggerUrl = element.data('elfinder-trigger-url')
				var name = element.attr('name');

				element.parent('.input-group').children('button.popup_selector').click(function (event) {
				    event.preventDefault();

				    elfinderTarget = element;

				    // trigger the reveal modal with elfinder inside
				    $.colorbox({
				        href: triggerUrl + '/' + name,
				        fastIframe: false,
				        iframe: true,
				        width: '80%',
				        height: '80%'
				    });
				});

				element.bind('select', function(event) { // called on file(s) select/unselect
					element.trigger('change');
				});

				element.parent('.input-group').children('button.clear_elfinder_picker').click(function (event) {
				    event.preventDefault();
				    element.val("").trigger('change');
				});

				element.on('CrudField:disable', function(e) {
					element.parent('.input-group').children('button.popup_selector').prop('disabled','disabled');
					element.parent('.input-group').children('button.clear_elfinder_picker').prop('disabled','disabled');
				});

				element.on('CrudField:enable', function(e) {
					element.parent('.input-group').children('button.popup_selector').removeAttr('disabled');
					element.parent('.input-group').children('button.clear_elfinder_picker').removeAttr('disabled');
				});
			}
		</script>
		@endBassetBlock
	@endpush

{{-- End of Extra CSS and JS --}}
{{-- ########################################## --}}
