function linkifyYouTubeURLs(url) {
	var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
	var match = url.match(regExp);
	if (match && match[2].length == 11) {
		return match[2];
	} else {
		return false
	}
}

function linkifyVimeo(url) {
	var regExp = /https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/;
	var match = url.match(regExp)
	if (match) {
		return match[3]
	} else {
		return false
	}
}



jQuery(function ($) {
	var gallery_frame;
	var $estate_image_gallery = $('#estate_image_gallery');
	var $images = $('#estate_images_container').find('ul.product_images');
	var attachment_ids = $($estate_image_gallery).val();


	//update images

	function estate_metabox_images_update() {
		var el_list = $images.children();
		var attachment_ids = '';
		el_list.each(function (index) {
			attachment_ids += (index ? ',' : '') + $(this).data('id');
		});
		$estate_image_gallery.val(attachment_ids);
	}

	//add image to gallery
	$('.gallery_commands a.add_image_btn').on('click', function (event) {
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if (gallery_frame) {
			gallery_frame.open();
			return;
		}
		// Create the media frame.
		gallery_frame = wp.media.frames.downloadable_file = wp.media({
			// Set the title of the modal.
			title   : 'Add Images to Gallery',
			button  : {
				text: 'Add to gallery'
			},
			multiple: true
		});

		gallery_frame.on('select', function () {
			var selection = gallery_frame.state().get('selection');
			selection.map(function (attachment) {
				attachment = attachment.toJSON();
				if (attachment.id) {
					var $new_el = $('<li><img src="' + attachment.url + '" alt=""><a href="#" class="close" title="Remove">&times;</a></li>');
					$new_el.data('id', attachment.id);
					$images.append($new_el);
					attachment_ids = attachment_ids ? attachment_ids + ',' + attachment.id : attachment.id;
					egallery.add({
						id  : attachment.id,
						type: 'image'
					});
				}
			});
			$estate_image_gallery.val(attachment_ids);
		});
		gallery_frame.open();
	});

	//add video to gallery
	$('.gallery_commands a.add_video_btn').on('click', function (event) {
		event.preventDefault();
		var video_url = prompt("Insert video URL (Youtube, Vimeo)", "");
		var video_id, video_type
		if (video_url.length > 0) {
			video_id = linkifyYouTubeURLs(video_url);
			if (video_id) {
				video_type = 'youtube';
			} else {
				video_id = linkifyVimeo(video_url)
				if (video_id) {
					video_type = 'vimeo'
				}
			}
			if (video_id && video_type) {

			}
		}
	});


	/**
	 * Gallery Item's action handling
	 */
	$images.on('click', 'a.close', function (event) {
		event.preventDefault();
		if (confirm('Remove this image ?')) {
			$(this).closest('li').remove();
			estate_metabox_images_update();
		}
	});
	$images.sortable({
		items               : "> li",
		cursor              : "move",
		scrollSensitivity   : 40,
		forcePlaceholderSize: true,
		forceHelperSize     : false,
		helper              : 'clone',
		opacity             : 0.65,
		placeholder         : 'estate_metabox_placeholder',
		cancel              : "input[type=text],textarea",
		update              : function () {
			estate_metabox_images_update();
		}
	});
	//	$images.find('input[type=text],textarea').mousedown(function(e){
	//		e.stopPropagation();
	//	});
});