(function($) {
	
	$(document).ready(function() {
		$('#gmet_content_wrap').hide();
    	var $bar = $('<div></div>');
        $bar.addClass('quicktags-toolbar');
        $wrap = $('#gmet_content_wrap');
        $wrap.children().css('padding', '5px 15px');
        $wrap.prepend($bar);
        $('#wp-content-editor-tools #content-html').before(
          '<a id="content-gmet" class="wp-switch-editor">' + gmetData.tabTitle + '</a>'
        );
	});
	
	$(document).on('click', '#content-gmet', function(e) {
	e.preventDefault();
		var id = 'content';
		var ed = tinyMCE.get(id);
		var dom = tinymce.DOM;
		$('#wp-content-editor-container, #post-status-info').hide();
		dom.removeClass('wp-content-wrap', 'html-active');
		dom.removeClass('wp-content-wrap', 'tmce-active');
		$(this).addClass('active');
		$('#gmet_content_wrap').show();
	});
	
	$(document).on('click', '#content-tmce, #content-html', function(e) {
		e.preventDefault();
		$('#content-gmet').removeClass('active');
		$('#gmet_content_wrap').hide();
		$('#wp-content-editor-container, #post-status-info').show();
	});

	$(document).on('click', '#copy-button', function(e) {
		shortcode = $(this).prev().val();
		send_to_editor(shortcode);
		e.preventDefault();
		$('#content-gmet').removeClass('active');
		$('#gmet_content_wrap').hide();
		$('#wp-content-editor-container, #post-status-info').show();
	});

	/* Stuff for neat metas */
	jQuery(document).ready(function() {
		jQuery('#standardmetas').hide();
		jQuery('#gallerymetas').hide();
		jQuery('#videometas').hide();

		if (jQuery("#post-format-gallery").is(":checked")) {
			jQuery('#gallerymetas').show();
		}

		if (jQuery("#post-format-0").is(":checked")) {
			jQuery('#standardmetas').show();
		}

		if (jQuery("#post-format-video").is(":checked")) {
			jQuery('#videometas').show();
		}

		jQuery('#post-formats-select input[type="radio"]').click(function(){
			if (jQuery("#post-format-gallery").is(":checked")) {				
				jQuery('#standardmetas').hide();
				jQuery('#videometas').hide();;
				jQuery('#gallerymetas').fadeIn('1000');
			}

			if (jQuery("#post-format-0").is(":checked")) {				
				jQuery('#gallerymetas').hide();
				jQuery('#videometas').hide();
				jQuery('#standardmetas').fadeIn('1000');
			}

			if (jQuery("#post-format-video").is(":checked")) {				
				jQuery('#standardmetas').hide();
				jQuery('#gallerymetas').hide();
				jQuery('#videometas').fadeIn('1000');
			}
        });	

	});

})(jQuery);