jQuery(document).ready(function($) {

	// Popup box
	$("#su-generator-button").click(function(){
		$("#su-generator-wrap, #su-generator-overlay").show();
	});
	
	$("#su-generator-close").click(function(){
		$("#su-generator-wrap, #su-generator-overlay").hide();
	});
	
	// Apply chosen
	$('#su-generator-select').chosen({
		no_results_text: $('#su-generator-select').attr('data-no-results-text'),
		allow_single_deselect: true
	});

	// Select shortcode
	$('#su-generator-select').live( "change", function() {
		var queried_shortcode = $('#su-generator-select').find(':selected').val();
		$('#su-generator-settings').addClass('su-loading-animation');
		$('#su-generator-settings').load($('#su-generator-url').val() + '/lib/generator.php?shortcode=' + queried_shortcode, function() {
			$('#su-generator-settings').removeClass('su-loading-animation');
			$(".add-icon-button").click(function(){	
				$("#su-insert-vector-icon").show();
			});

			// Init color pickers
			$('.su-generator-select-color').each(function(index) {
				if( typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function' ){
					$(this).find('.su-generator-select-color-value').wpColorPicker();
				}

			});
		});
	});
	
	$(".add-icon-button").click(function(){
		$("#su-insert-vector-icon").show();
	});
	
	$('.su-moon-icon-list li i').live('click', function(event) { 
		var selected_icon = $(this).attr('class');
		$('.su-generator-select-icon-value').val(selected_icon);
		$('#su-insert-vector-icon').hide();
	});


	// Insert shortcode
	$('#su-generator-insert').live('click', function(event) {
		var queried_shortcode = $('#su-generator-select').find(':selected').val();
		var su_compatibility_mode_prefix = $('#su-compatibility-mode-prefix').val();
		$('#su-generator-result').val('[' + su_compatibility_mode_prefix + queried_shortcode);
		$('#su-generator-settings .su-generator-attr').each(function() {
			if ( $(this).val() !== '' ) {
				$('#su-generator-result').val( $('#su-generator-result').val() + ' ' + $(this).attr('name') + '="' + $(this).val() + '"' );
			}
		});
		$('#su-generator-result').val($('#su-generator-result').val() + ']');

		// wrap shortcode
		if ( $('#su-generator-content').val() != 'false' ) {
			$('#su-generator-result').val($('#su-generator-result').val() + $('#su-generator-content').val() + '[/' + su_compatibility_mode_prefix + queried_shortcode + ']');
		}

		var shortcode = jQuery('#su-generator-result').val();

		// Insert into widget
		if ( typeof window.su_generator_target !== 'undefined' ) {
			jQuery('textarea#' + window.su_generator_target).val( jQuery('textarea#' + window.su_generator_target).val() + shortcode);
			tb_remove();
		}

		// Insert into editor
		else {
			window.send_to_editor(shortcode);
		}
		
		$("#su-generator-wrap, #su-generator-overlay").hide();

		// Prevent default action
		event.preventDefault();
		return false;
	});

	// Widget insertion button click
	jQuery('a[data-page="widget"]').live('click',function(event) {
		window.su_generator_target = jQuery(this).attr('data-target');
	});

});