jQuery(document).ready( function($) {

	function init(widget) {
		widget.find('input.color').colorInput({
		  format:'HEX', 
		  components: {
	        saturation: true,
	        hue: true,
	        alpha: false,
	        extra: true
	      }
		});
	}

	function on_form_update( e, widget_el ) {
		init( widget_el );
	}

	$(document).on('click', '.widget-action, .widget-title', function(){
		init($(this).parents('.widget'));
	});

	$( document ).on( 'widget-updated', on_form_update );
	$( document ).on( 'widget-added', on_form_update );
});