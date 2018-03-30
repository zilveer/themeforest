$ = jQuery.noConflict();
$(document).ready(function(e) {
	'use strict';

	// MEDIA UPLOAD FOR WIDGET

	function media_upload(button_class) {
		'use strict';

	    $('body').on('click',button_class, function(e) {
			var upload_button = $(this);
	    	// If the media frame already exists, reopen it.
		    if ( frame ) {
		      frame.open();
		      return;
		    }
		    
		    // Create a new media frame
		    var frame = wp.media({
		      library: {
		        type: 'image'
		      },
		      multiple: false
		    });

		    frame.on( 'select', function() {
				// Get media attachment details from the frame state
	      		var attachment = frame.state().get('selection').first().toJSON();

				upload_button.parents(".upload-item").find('.custom_media_id').val(attachment.id);
	            upload_button.parents(".upload-item").find('.custom_media_image').attr('src',attachment.url).css('display','block');
	        });

			frame.open();
	        return false;
	    });
	}
	media_upload( '.custom_media_upload');

	$('body').on('click',".custom_media_upload_remove", function(e) {
		$(this).parents(".upload-item").find('.custom_media_id').val("");
	    $(this).parents(".upload-item").find('.custom_media_image').attr('src',"").css('display','none');
	});

	// METABOX

	$(".rwmb-radio:checked").parent().addClass("checked");

	$(".rwmb-input .rwmb-radio").change(function(){
		$(this).parents(".rwmb-input").find("label").removeClass("checked").find(".rwmb-radio:checked").parent().addClass("checked");
	})

	var post_format_input = $('#post-formats-select input[type="radio"]:checked');
	var formatValue = post_format_input.val();
	$("#"+ formatValue + "-options").addClass("format-option").addClass("open");

	$('#post-formats-select input[type="radio"]').change(function(){
		formatValue = $(this).val();
		$(".postbox.format-option").removeClass("open");
		$("#"+ formatValue + "-options").addClass("format-option").addClass("open");
	});

	// Video Options
	var video_list_checked = $("input[name='gorilla_video_list']:checked");
	video_list_open(video_list_checked);
	
	$("input[name='gorilla_video_list']").change(function(){
		video_list_open($(this));
	})

	// Audio Options
	var audio_list_checked = $("input[name='gorilla_audio_list']:checked");
	audio_list_open(audio_list_checked);
	
	$("input[name='gorilla_audio_list']").change(function(){
		audio_list_open($(this));
	})

	// Gallery Options
	var gallery_list_checked = $("input[name='gorilla_gallery_layout']:checked");
	gallery_list_open(gallery_list_checked);
	
	$("input[name='gorilla_gallery_layout']").change(function(){
		gallery_list_open($(this));
	})

});

function video_list_open(video_list_checked){
	'use strict';
	if(video_list_checked.val() == 'native'){
		$(".embed_heading, .embed-video-wrapper").removeClass("open");
		$(".inner_heading, .video-poster-image-wrapper, .video-file-wrapper").addClass("open");
	}
	else if (video_list_checked.val() == 'embed'){
		$(".inner_heading, .video-poster-image-wrapper, .video-file-wrapper").removeClass("open");
		$(".embed_heading, .embed-video-wrapper").addClass("open");
	}
}

function audio_list_open(audio_list_checked){
	'use strict';
	if(audio_list_checked.val() == 'native'){
		$(".embed_heading, .embed-audio-wrapper").removeClass("open");
		$(".inner_heading, .audio-file-wrapper").addClass("open");
	}
	else if (audio_list_checked.val() == 'embed'){
		$(".inner_heading, .audio-file-wrapper").removeClass("open");
		$(".embed_heading, .embed-audio-wrapper").addClass("open");
	}
}

function gallery_list_open(gallery_list_checked){
	'use strict';
	if(gallery_list_checked.val() == 'gallery-thumbnail'){
		$(".gallery_thumb_row_height").addClass("open");
	}
	else if (gallery_list_checked.val() == ''){
		$(".gallery_thumb_row_height").removeClass("open");
	}
}