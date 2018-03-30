jQuery(document).ready(function($) {

	// Custom popup box
	$("#mnky-generator-button").click(function(){
		$("#mnky-generator-wrap, #mnky-generator-overlay").show();
	});
	
	$("#mnky-generator-close").click(function(){
		$("#mnky-generator-wrap, #mnky-generator-overlay").hide();
	});
		
	// Color pickers
	if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
		$('.mnky-generator-select-color-value').wpColorPicker();
	}
	
	// Get HTML code
	$('#mnky-generator-show-html').click( function() { 
		var icon_name = $('.mnky-generator-icon-select input:checked').val(),
		icon_color = $('.mnky-generator-select-color-value').val(),
		icon_size = $('#mnky-generator-icon-size').val(),
		icon_url = $('#mnky-generator-icon-url').val(),
		icon_target = $('.mnky-generator-select-target').val();
		
		if ($('.mnky-generator-select-style').val() !== '' ) { 
			var icon_style = ' ' + $('.mnky-generator-select-style').val(); 
		} else {
			var icon_style = '';
		}
		if ($('.mnky-generator-select-hover').val() !== '' ) {
			var icon_hover = ' hover-' + $('.mnky-generator-select-hover').val();
		} else {
			var icon_hover = '';
		}
		$('#mnky-shortcode-html').show(); 
		
		if ( icon_url !== '' ) {
			$('#mnky-shortcode-html textarea').text('<a href="' + icon_url + '" target="' + icon_target + '"><i class="' + icon_name + icon_style + icon_hover + '" style="color:' + icon_color  + '; font-size:' + icon_size + ';"></i></a>'); 		
		} else {
			$('#mnky-shortcode-html textarea').text('<i class="' + icon_name + icon_style + icon_hover + '" style="color:' + icon_color  + '; font-size:' + icon_size + ';"></i>'); 
		}
	});
	
	$("#mnky-generator-close-html").click(function(){
		$("#mnky-shortcode-html").hide();
	});

	// Insert shortcode
	$('#mnky-generator-insert').live('click', function(event) {
		$('.mnky-generator-icon-select input:checked').addClass("mnky-generator-attr");
		$('.mnky-generator-icon-select input:not(:checked)').removeClass("mnky-generator-attr");
		
		var queried_shortcode = 'v_icon';
		$('#mnky-generator-result').val('[' + queried_shortcode);
		$('.mnky-generator-attr').each(function() {
			if ( $(this).val() !== '' ) {
				$('#mnky-generator-result').val( $('#mnky-generator-result').val() + ' ' + $(this).attr('name') + '="' + $(this).val() + '"' );
			}
		});
		$('#mnky-generator-result').val($('#mnky-generator-result').val() + ']');

		var shortcode = jQuery('#mnky-generator-result').val();

		// Insert into widget
		if ( typeof window.su_generator_target !== 'undefined' ) {
			jQuery('textarea#' + window.su_generator_target).val( jQuery('textarea#' + window.su_generator_target).val() + shortcode);
			tb_remove();
		}

		// Insert into editor
		else {
			window.send_to_editor(shortcode);
		}
		
		$("#mnky-generator-wrap, #mnky-generator-overlay").hide();

		// Prevent default action
		event.preventDefault();
		return false;
	});
});