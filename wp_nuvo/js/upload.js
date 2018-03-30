(function($) { "use strict";
jQuery(document).ready(function($){
    if($('.cshero_upload_button').length >= 1) {
        window.cshero_uploadfield = '';

        $('.cshero_upload_button').live('click', function() {
            window.cshero_uploadfield = $('.upload_field', $(this).parent());
            tb_show('Upload', 'media-upload.php?type=file&TB_iframe=true', false);

            return false;
        });

        $('.cshero_clear_button').click(function () {
			var clear_id = $(this).attr("data-id");
			$("#"+clear_id+"").val("");
		})

        window.cshero_send_to_editor_backup = window.send_to_editor;
        window.send_to_editor = function(html) {
            if(window.cshero_uploadfield) {
                var file_url = $('img', html).attr('src');
                if(file_url == undefined){
                	file_url = $("a", '<div>'+html+'<div>').attr("href");
                }
                $(window.cshero_uploadfield).val(file_url);
                var fileExt = '.' + file_url.split('.').pop();
                if(fileExt != undefined){
                	var audio = $("#cs_post_audio_type");
                	var video = $("#cs_post_video_type");
                	if(audio != undefined){
	                	switch (fileExt) {
						case '.mp3':
							$("#cs_post_audio_type").val("mp3");
							break;
						case '.ogg':
							$("#cs_post_audio_type").val("ogg");
							break;
						case '.wav':
							$("#cs_post_audio_type").val("wav");
							break;
	                	}
                	}
                	if (video != undefined){
                		switch (fileExt) {
						case '.mp4':
							$("#cs_post_video_type").val("mp4");
							break;
						case '.webm':
							$("#cs_post_video_type").val("webm");
							break;
						case '.ogg':
							$("#cs_post_video_type").val("ogg");
							break;
	                	}
                	}
                }
                window.cshero_uploadfield = '';

                tb_remove();
            } else {
                window.cshero_send_to_editor_backup(html);
            }
        }
    }
});
})(jQuery);
