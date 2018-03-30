jQuery(document).ready(function($) {

		function updateBoxes(show,hide) {
			$(hide).stop(true, true).fadeOut(300);
			setTimeout(function() {
				if (show!=='') {
					$(show).stop(true, true).slideDown(300);
				}
			}, 301);
		}

		function checkPost() {
			var current = $("input.post-format:checked").attr("value");
			var boxes = "#post_standard_options, #post_video_options, #post_gallery_options, #post_link_options, #post_audio_options, #post_quote_options";
			updateBoxes("", boxes);
			console.log(current);

			if (current == 0) {
				updateBoxes("#post_standard_options", boxes);
			} else if(current == "video") {
				updateBoxes("#post_video_options", boxes);
			} else if(current == "link") {
				updateBoxes("#post_link_options", boxes);
			}else if(current == "quote") {
				updateBoxes("#post_quote_options", boxes);
			}else if(current == "audio") {
				updateBoxes("#post_audio_options", boxes);
			} else if(current == "gallery") {
				updateBoxes("#post_gallery_options", boxes);
			} else {
				updateBoxes("", boxes);
			}
		}

		// Update on Change
		$("input.post-format").change(checkPost);

		// Update on Load
		$(window).on('load', function() {
			checkPost();
		});
});