var xmenu_media_init = function(text_selector, button_selector, wrapper_selector, callback)  {
	var clicked_button = false;
	var input_text = null;
	if ((typeof(wrapper_selector) == 'undefined') || (wrapper_selector == null)) {
		input_text = jQuery(text_selector);
	}
	else {
		input_text = jQuery(text_selector, wrapper_selector);
	}

	jQuery(input_text).each(function (i, input) {
		var button = null;
		if (typeof(wrapper_selector) == 'undefined') {
			button = jQuery(input).next(button_selector);
		}
		else {
			button = jQuery(button_selector, wrapper_selector);
		}
		button.click(function (event) {
			event.preventDefault();
			var selected_img;

			// check for media manager instance
			if(wp.media.frames.gk_frame) {
				wp.media.frames.gk_frame.open();
				wp.media.frames.gk_frame.clicked_button = jQuery(this);
				return;
			}

			// configuration of the media manager new instance
			wp.media.frames.gk_frame = wp.media({
				title: 'Select image',
				multiple: false,
				library: {
					type: 'image'
				},
				button: {
					text: 'Use selected image'
				}
			});
			wp.media.frames.gk_frame.clicked_button = jQuery(this);
			// Function used for the image selection and media manager closing
			var gk_media_set_image = function() {
				var selection = wp.media.frames.gk_frame.state().get('selection');

				// no selection
				if (!selection) {
					return;
				}

				// iterate through selected elements
				selection.each(function(attachment) {
					var url = attachment.attributes.url;
					var old_url = wp.media.frames.gk_frame.clicked_button.prev(input_text).val();
					wp.media.frames.gk_frame.clicked_button.prev(input_text).val(url);
					if (typeof (callback) != "undefined") {
						callback(wp.media.frames.gk_frame.clicked_button.prev(input_text), old_url);
					}
				});
			};

			// closing event for media manger
			//wp.media.frames.gk_frame.on('close', gk_media_set_image);
			// image selection event
			wp.media.frames.gk_frame.on('select', gk_media_set_image);
			// showing media manager
			wp.media.frames.gk_frame.open();
		});
	});
};