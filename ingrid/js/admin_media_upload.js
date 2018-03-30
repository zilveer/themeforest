jQuery(document).ready(function(){

	// since WP 3.5 -> new media manager
		jQuery('#tp_logo_up').click(function(){
			wp.media.editor.send.attachment = function(props, attachment){
				jQuery('#tp_logo_up_src').val(attachment.url);
				
				jQuery('#upload_logo_preview').css('display','inline');
				jQuery('#upload_logo_preview').attr('src',attachment.url);
			}

			wp.media.editor.open(this);

			return false;
		});
		
		jQuery('#tp_favicon_up').click(function(){
			wp.media.editor.send.attachment = function(props, attachment){
				jQuery('#tp_favicon_up_src').val(attachment.url);				
				
				jQuery('#upload_favicon_preview').css('display','inline');
				jQuery('#upload_favicon_preview').attr('src',attachment.url);
			}

			wp.media.editor.open(this);

			return false;
		});
		
		jQuery('#tp_custom_page_bg_click').click(function(){
			wp.media.editor.send.attachment = function(props, attachment){
				//attachment.url								
				jQuery('#page_bg-custom').css('background-image','url('+attachment.url+')');
				jQuery('#page_bg-custom img').css('display','none');
				jQuery('#tp_custom_page_bg_click input[type=radio]').attr('checked',true);
				jQuery('#form-custom_page_bg').val(attachment.url);
			}
			
			wp.media.editor.open(this);

			return false;
		});
	
	
		jQuery('#tp-fws-select').click(function(){
			var imgs = '';
			var ictr = 0;			
			wp.media.editor.send.attachment = function(props, attachment){							
				if(imgs != ''){
					if(attachment.caption != '' && attachment.caption != undefined){
						imgs = imgs+','+attachment.url+'|'+attachment.caption;
					}else{
						imgs = imgs+','+attachment.url;	
					}
				}else{
					if(attachment.caption != '' && attachment.caption != undefined){
						imgs = attachment.url+'|'+attachment.caption;
					}else{
						imgs = attachment.url;
					}
				}
				ictr++;
				
				
				
				jQuery('.tp-fws-select').html(ictr+' image(s) selected');		
				jQuery('#tp-fws-images').val(imgs);		
			}
			wp.media.editor.open(this);
			
			
			return false;
		});
	
	
		jQuery('#tp-fws-remove').click(function(){
			jQuery('#tp-fws-images').val('');
			jQuery('.tp-fws-select').html('');
			jQuery(this).parent().remove();
			return false;
		});
	
	
	// old media manager WP 3.4		
		jQuery('#tp_logo_up-old').click(function() {  
			window.send_to_editor = function(html) {  
				var image_url = jQuery('img',html).attr('src');  
				jQuery('#tp_logo_up_src').val(image_url);  		
				
				jQuery('#upload_logo_preview').css('display','inline');		
				jQuery('#upload_logo_preview').attr('src',image_url);
				tb_remove();  
			}
		
			tb_show('Upload a logo', 'media-upload.php?post_ID=0&referer=tp_theme_general&type=image&TB_iframe=true', false);  
			return false;  
		});
		
		jQuery('#tp_favicon_up-old').click(function() {  
			window.send_to_editor = function(html) {  
				var image_url = jQuery('img',html).attr('src');  
				jQuery('#tp_favicon_up_src').val(image_url);  		
				
				jQuery('#upload_favicon_preview').css('display','inline');		
				jQuery('#upload_favicon_preview').attr('src',image_url);
				tb_remove();  
			}
		
			tb_show('Upload a favicon', 'media-upload.php?post_ID=0&referer=tp_theme_general&type=image&TB_iframe=true', false);  
			return false;  
		});
		
		jQuery('#tp_custom_page_bg_click-old').click(function(){
			window.send_to_editor = function(html) {  
				var image_url = jQuery('img',html).attr('src');  
				
				jQuery('#page_bg-custom').css('background-image','url('+image_url+')');
				jQuery('#page_bg-custom img').css('display','none');
				jQuery('#tp_custom_page_bg_click-old input[type=radio]').attr('checked',true);
				jQuery('#form-custom_page_bg').val(image_url);
				
				tb_remove();  
			}
		
			tb_show('Upload a background', 'media-upload.php?post_ID=0&referer=tp_theme_general&type=image&TB_iframe=true', false);  
			return false;  
		});

		
		
		var tpfwsi = 0;
		jQuery('#tp-fws-select-old').click(function(){
			window.send_to_editor = function(html) {  
			
				var image_url = jQuery('img',html).attr('src');  				
				var image_cap = jQuery('img',html).attr('title');  				
				var imgs = '';
				
				if(image_cap != ''){
					img = image_url+'|'+image_cap;
				}else{
					img = image_url;
				}
				if(tpfwsi > 0){
					imgs = jQuery('#tp-fws-images').val()+',';
				}
				imgs = imgs+img;
				
				alert(imgs);
				
				tpfwsi++;
				
				jQuery('.tp-fws-select').html(tpfwsi+' image(s) selected');		
				jQuery('#tp-fws-images').val(imgs);		
				tb_remove();  
			}
			
			
			tb_show('Upload slider images', 'media-upload.php?post_ID=1&referer=tp_theme_general&type=image&TB_iframe=true', false);  
			return false;
		});
		
});