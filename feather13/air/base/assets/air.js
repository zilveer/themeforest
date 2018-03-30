jQuery(document).ready(function($) {

	// Fade settings saved notice
	if($('#air-save-notice').length) {
		$('#air-save-notice').delay(4000).fadeOut();
	}

	// Image Select
	if($('.air-image-button').length) {
		var image_field;
		var image_val;
		var image_placeholder;
		$('.air-image-button').each(function() {
			var button = $(this);
			button.click(function() {
				image_field = $(this).siblings('input[type="text"]').attr('name');
				image_placeholder = $(this).siblings('.air-image-placeholder');
				tb_show('','media-upload.php?type=image&TB_iframe=true');
				return false;
			});
			image_val = $(this).siblings('input[type="text"]').val();
			if(image_val) {
				$(this).siblings('.air-image-placeholder').html('<img src="'+image_val+'" />');
			}
		});
		
		// Populate image field with URL; Remove media library
		window.wp_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html) {
			if(image_field) {
				var image_url = $('img',html).attr('src');
				$('input[name="'+image_field+'"]').val(image_url);
				image_placeholder.html('<img src="'+image_url+'" />');
				tb_remove();
				image_field = null;
			} else {
				window.wp_send_to_editor(html);
			}	
		}
	}

	// Colorpicker
	if($('.air-colorpicker').length) {
		$('.air-colorpicker').each(function() {
			var color_div = $(this);
			var color_input = $(this).siblings('input');
			$(color_div).ColorPicker({
				onBeforeShow: function () {
					$(this).ColorPickerSetColor(color_input.val());
				},
				onChange: function (hsb, hex, rgb) {
					$(color_input).val(hex);
					$(color_div).find('div').css('background-color', '#' + hex);
				}
			});
		});
	}

});
