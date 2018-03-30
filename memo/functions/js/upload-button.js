jQuery(document).ready(function() {
	
	jQuery('#tz_post_upload_images').click(function() {
		
	    var tbURL = jQuery('#add_image').attr('href');
	    
	    if(typeof tbURL === 'undefined') {
	        tbURL = jQuery('#content-add_media').attr('href');
	    }
	    
		tb_show('', tbURL);
		return false;
		
	});


	jQuery('#tz_background_image_button').click(function() {
		
		window.send_to_editor = function(html) 
		
		{
			imgurl = jQuery('img',html).attr('src');
			jQuery('#tz_background_image').val(imgurl);
			tb_remove();
		}
	 
	 
		tb_show('', 'media-upload.php?post_id=0&amp;type=image&amp;TB_iframe=true');
		return false;
		
	});

 
});
