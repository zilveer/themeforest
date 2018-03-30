/* Thanks to codestag :: Media Uploader
 * https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
 * */

jQuery(document).ready(function() {
	
	jQuery('#upload_image_button_thumb').click(function(e) {
		
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			 e.preventDefault();
			 
			 var button = jQuery(this);
			 
			 wp.media.editor.send.attachment = function(props, attachment) {
				 
                 imgurl =  attachment.url;
                
                jQuery('#upload_image_thumb').val(imgurl);
					
            };
            
            wp.media.editor.open(button);
            return false;
		}
		
	});
 
	jQuery('#upload_image_button').click(function(e) {
		
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			 e.preventDefault();
			 
			 var button = jQuery(this);
			 
			 wp.media.editor.send.attachment = function(props, attachment) {
				 
                 imgurl =  attachment.url;
                
                 jQuery('#upload_image').val(imgurl);
					
            };
            
            wp.media.editor.open(button);
            return false;
		}
		
	});
	 

	jQuery('#upload_image_button_background').click(function(e) {
		
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			 e.preventDefault();
			 
			 var button = jQuery(this);
			 
			 wp.media.editor.send.attachment = function(props, attachment) {
				 
                 imgurl =  attachment.url;
                
                if(jQuery('#post_type').val() == 'post')
					jQuery('#kingsize_post_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'page')
					jQuery('#kingsize_page_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'portfolio')
					jQuery('#kingsize_portfolio_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'download')
					jQuery('#kingsize_post_background').val(imgurl);	
					
            };
            
            wp.media.editor.open(button);
            return false;
		}
		
	});
	
	/* Mobile Background Upload */
	jQuery('#upload_video_image_button_background').click(function(e) {
		
		if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
			 e.preventDefault();
			 
			 var button = jQuery(this);
			 
			 wp.media.editor.send.attachment = function(props, attachment) {
				 
                 imgurl =  attachment.url;
                
                if(jQuery('#post_type').val() == 'post')
					jQuery('#post_mobile_video_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'page')
					jQuery('#page_mobile_video_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'portfolio')
					jQuery('#portfolio_mobile_video_background').val(imgurl);
				else if(jQuery('#post_type').val() == 'download')
					jQuery('#post_mobile_video_background').val(imgurl);	
					
            };
            
            wp.media.editor.open(button);
            return false;
		}
		
	});
	/* END Mobile Background Upload */


});
