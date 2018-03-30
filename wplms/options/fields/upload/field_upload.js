jQuery(document).ready(function(){

	
	/*
	 *
	 * VIBE_Options_upload function
	 * Adds media upload functionality to the page
	 *
	 */
	 
	 var header_clicked = false;
	 
	jQuery("img[src='']").attr("src", vibe_upload.url);
	
	jQuery('.vibe-opts-upload').live("click", function() {
		header_clicked = true;
                console.log(header_clicked);
		formfield = jQuery(this).attr('rel-id');
		preview = jQuery(this).prev('img');
                tb_show('', 'media-upload.php?type=image&amp;post_id=0&amp;TB_iframe=true');
		return false;
	});
	
	
	// Store original function
	window.original_send_to_editor = window.send_to_editor;
	
	
	window.send_to_editor = function(html) {
		if (header_clicked) {
			imgurl = jQuery('img',html).attr('src');
                        
			jQuery('#' + formfield).val(imgurl);
			jQuery('#' + formfield).next().fadeIn('slow');
			jQuery('#' + formfield).next().next().fadeOut('slow');
			jQuery('#' + formfield).next().next().next().fadeIn('slow');
			jQuery(preview).attr('src' , imgurl);
			tb_remove();
			header_clicked = false;console.log('1'+header_clicked);
		} else {
			window.original_send_to_editor(html);
                        console.log('2'+header_clicked);
                        
		}
	}
	
	jQuery('.vibe-opts-upload-remove').click(function(){
		$relid = jQuery(this).attr('rel-id');
		jQuery('#'+$relid).val('');
		jQuery(this).prev().fadeIn('slow');
		jQuery(this).prev().prev().fadeOut('slow', function(){jQuery(this).attr("src", vibe_upload.url);});
		jQuery(this).fadeOut('slow');
                header_clicked = false;
	});
});