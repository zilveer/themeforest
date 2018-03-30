jQuery(document).ready(function($) {
	"use strict";
	$('#post-formats-select input').change(checkformat);
	$('.wp-post-format-ui .post-format-options > a').click(checkformat);
	videoType();
	audioType();
	checkformat();
	quoteType();

	$("#cs_post_quote_type").change(function() {
		quoteType();
	});

	$("#cs_post_video_source").change(function() {
		videoType();
	});

	$("#cs_post_audio_type").change(function() {
		audioType();
	});

	function checkformat() {
		"use strict";
		var formats = ["gallery","link","image","quote","video","audio","chat"];
		var format = $('#post-formats-select input:checked').attr('value');
		var i = 0;
		for(i = 0; i < formats.length; i++){
			if(formats[i] == format){
				$("#cs_post_"+format+"").css('display', 'block');
			} else {
				$("#cs_post_"+formats[i]+"").css('display', 'none');
			}
		}
	}

	function quoteType() {
		"use strict";
		switch ($("#cs_post_quote_type").val()) {
		case 'custom':
			$("#post_quote_custom").css('display', 'block');
			break;
		default:
			$("#post_quote_custom").css('display', 'none');
			break;
		}
	}

	function audioType() {
		"use strict";
		switch ($("#cs_post_audio_type").val()) {
		case '':
			$("#cs_metabox_field_post_audio_url").css('display', 'none');
			break;
		case 'content':
			$("#cs_metabox_field_post_audio_url").css('display', 'none');
			break;
		default:
			$("#cs_metabox_field_post_audio_url").css('display', 'block');
			break;
		}
	}
	function videoType() {
		"use strict";
		switch ($("#cs_post_video_source").val()) {
		case '':
			$("#cs_video_setting").css('display', 'none');
			break;
		case 'post':
			$("#cs_video_setting").css('display', 'none');
			break;
		case 'media':
			$("#cs_metabox_field_post_video_type").css('display', 'block');
			$("#cs_metabox_field_post_video_url").css('display', 'block');
			$("#cs_metabox_field_post_preview_image").css('display', 'block');
			$("#cs_metabox_field_post_video_youtube").css('display', 'none');
			$("#cs_metabox_field_post_video_vimeo").css('display', 'none');
			$("#cs_video_setting").css('display', 'block');
			break;
		case 'youtube':
			$("#cs_metabox_field_post_video_type").css('display', 'none');
			$("#cs_metabox_field_post_video_url").css('display', 'none');
			$("#cs_metabox_field_post_preview_image").css('display', 'none');
			$("#cs_metabox_field_post_video_youtube").css('display', 'block');
			$("#cs_metabox_field_post_video_vimeo").css('display', 'none');
			$("#cs_video_setting").css('display', 'block');
			break;
		case 'vimeo':
			$("#cs_metabox_field_post_video_type").css('display', 'none');
			$("#cs_metabox_field_post_video_url").css('display', 'none');
			$("#cs_metabox_field_post_preview_image").css('display', 'none');
			$("#cs_metabox_field_post_video_youtube").css('display', 'none');
			$("#cs_metabox_field_post_video_vimeo").css('display', 'block');
			$("#cs_video_setting").css('display', 'block');
			break;
		}
	}
});