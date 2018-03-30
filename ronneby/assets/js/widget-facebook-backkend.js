(function($) {
	'use strict';
	$(document).ready(function() {
		$('.upload_image_button').each(function() {
			var custom_uploader, attachment;
			var $self;
			$self = $(this);
			$self.click(function(e) {
				e.preventDefault();
				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}

				//Extend the wp.media object
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});

				//When a file is selected, grab the URL and set it as the text field's value
				custom_uploader.on('select', function() {
					attachment = custom_uploader.state().get('selection').first().toJSON();
					$self.siblings('.upload_image').val(attachment.url);
					$self.siblings('.image_uploaded').attr('src',attachment.url).css('display','block');
					//console.log($self.siblings('.image_uploaded'));
					custom_uploader.close();
				});

				//Open the uploader dialog
				custom_uploader.open();

			});
		});
		$('.remove_image_button').each(function() {
			var $self = $(this);
			$self.click(function(e) {
				e.preventDefault();
				console.log('delete click');
				var $self = $(this);
				$self.siblings('.upload_image').val('');
				$self.siblings('.image_uploaded').attr('src','').css('display','none');
			});
		});
	});
})(jQuery);