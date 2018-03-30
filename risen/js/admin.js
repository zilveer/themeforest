/**
 * Admin JavaScript
 *
 * This is loaded in WordPress admin (when needed) in order to make user experience better
 */

jQuery(document).ready(function($) {

	/**************************************
	 * Media Uploader for Custom Field
	 **************************************/

	// Open media uploader on button click
	var input_element;
	var file_dialog_interval;
	var meta_uploader_open = false;
	$('.risen-upload-file').on('click', function() {

		// Open uploader dialog
		meta_uploader_open = true;
		var post_id = jQuery('#post_ID').val();
		tb_show('', 'media-upload.php?post_id=' + post_id + '&amp;TB_iframe=true');

		// Input to insert URL into
		input_element = $(this).prev('input');
		
		// Check for closing of media uploader
		// Change "Insert into Post" button
		file_dialog_interval = setInterval(function() {

			// Media uploader dialog was closed
			// This is in case someone closes it some way other than "Use This File" button
			if (!$('#TB_iframeContent').is(':visible')) {

				// Flag it as closed for meta purposes so we can tell main editor to not use it
				// Otherwise images inserted into main editor can go to last meta input
				meta_uploader_open = false;

				// Stop this interval
				// Reset "Insert into Post" button
				clearInterval(file_dialog_interval);
				
			}
			
			// Change "Insert into Post" button to "Use This File"
			$('#TB_iframeContent').contents().find('.savesend .button').val(risen_wp_admin.meta_insert_file_button);
			
		}, 500); // faster than anyone is likely to navigate
		
		return false;
		
	});
	 
	// "Insert Into Post" / "Use This File" button clicked
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html) {

		// Media uploader is open for meta input purposes
		if (meta_uploader_open && input_element.length) {

			// Set URL on input
			var url = $(html).attr('href');
			$(input_element).val(url);			
			
			// Close dialog
			tb_remove();
			
			// Stop the interval and reset "Insert into Post" button
			clearInterval(file_dialog_interval);
			meta_uploader_open = false;
			
		}
		
		// Using uploader for main editor, act normally
		else {
			window.original_send_to_editor(html);
		}
	
	}

	/**************************************
	 * Theme Options
	 **************************************/
	 
	if (risen_wp_admin.options_framework) {

		// Background Type
		if ($('input[name="risen[background_type]"]').length) {
				
			// Initial load
			risen_options_background_type_update();
			
			// Background Type has changed
			$('input[name="risen[background_type]"]').change(function() {
				risen_options_background_type_update();	
			});
						
			// Preset Background Image has changed
			$('#section-background_image_preset').click(function() {
				setTimeout(function() {
					risen_options_background_preset_update();	
				}, 100);
			});

		}
		
		// Fullscreen Background Image Upload
		if ($('input[name="risen[background_image_upload_fullscreen]"]').length) {
				
			// Initial load
			risen_options_background_fullscreen_update();
			
			// Fullscreen has changed
			$('input[name="risen[background_image_upload_fullscreen]"]').change(function() {
				risen_options_background_fullscreen_update();	
			});

		}
		
		// Live Font Preview
		$.each(['body_font', 'menu_font', 'heading_font'], function(index, field) { 

			var section_element = $('#section-' + field + ' .option');

			if ( section_element.length ) { // exists
			
				// Add preview text holder
				var font_preview_class = 'risen-font-preview-' + field;
				section_element.prepend('<p class="risen-font-preview ' + font_preview_class + '">' + risen_wp_admin.font_preview_text + '</p>');

				// On page load - show fonts already selected
				risen_options_font_preview_update(field);

				// On change or keydown...
				$('select[name="risen[' + field + ']"]').bind('change keydown', function() {
					risen_options_font_preview_update(field);
				});

			}
				
		});
		
	}
	 
});

// Show/hide appropriate fields based on Background Type
function risen_options_background_type_update() {

	// First hide all
	jQuery('.background-type-color, .background-type-preset, .background-type-upload').hide();
	
	// Show fields relevant to current type
	var background_type = jQuery('input[name="risen[background_type]"]:checked').val();
	jQuery('.background-type-' + background_type).show();
	
	// Show/hide fields relating to Fullscreen
	risen_options_background_fullscreen_update();
	
	// Hide background color if using a preset that does not support background color
	risen_options_background_preset_update();
	
}

// Show/hide appropriate fields based on Background Fullscreen
function risen_options_background_fullscreen_update() {

	if (jQuery('input[name="risen[background_type]"]:checked').val() == 'upload') {

		var background_fullscreen = jQuery('input[name="risen[background_image_upload_fullscreen]"]:checked').val();
		
		// Fullscreen - hide fields
		if (background_fullscreen) {
			jQuery('.background-no-fullscreen').hide();
		}
		
		// Not fullscreen - show fields
		else {
			jQuery('.background-no-fullscreen').show();
		}
		
	}
	
}

// Show/hide background color based on Preset Background Image
function risen_options_background_preset_update() {

	var background_type = jQuery('input[name="risen[background_type]"]:checked').val();
	if (background_type == 'preset') {
		
		var colorable_background_images = risen_wp_admin.colorable_background_images.split(','); // turn list into array
		var background_image_preset = jQuery('input[name="risen[background_image_preset]"]:checked').val();

		if (!background_image_preset || jQuery.inArray(background_image_preset, colorable_background_images) == -1) { // if no preset image chosen or image is not colorable, hide color picker
			jQuery('#section-background_color').hide();
		} else {
			jQuery('#section-background_color').show();
		}
		
	}

}

// Update font preview for specific field
function risen_options_font_preview_update( field ) {

	var font_select_element = jQuery('select[name="risen[' + field + ']"]');
	var font_name = jQuery(':selected', font_select_element).val();
		
	if (font_name) {
		
		// Make text invisible until font loads
		jQuery('.risen-font-preview-' + field).css('visibility', 'hidden');
		
		// Google WebFont Loader
		WebFont.load({
			google: {
				families: [font_name]
			},
			active: function() {
			
				// Set font on element after loaded, and show it
				jQuery('.risen-font-preview-' + field).css('font-family', "'" + font_name + "'").hide().css('visibility', 'visible').fadeIn('fast');

			},
		});

	}

}
