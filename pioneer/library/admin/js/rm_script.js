    jQuery(document).ready(function(){
    
    
    	// WIZARD
    	
    	
    	jQuery('#check_select_frontpage').change(function() {
  
  			
  				if(jQuery(this).attr("checked"))
        		{
        		jQuery('#ewiz_front_page_select').fadeIn();
        		jQuery('#ewiz_front_page').fadeTo('slow',0.2);
        		
          		}
          		else{
            	
            	jQuery('#ewiz_front_page_select').fadeOut();
            	jQuery('#ewiz_front_page').fadeTo('slow',1);
            
                }
  				
  				
		});
		
		
		jQuery('#check_select_blogpage').change(function() {
  
  			
  				if(jQuery(this).attr("checked"))
        		{
        		jQuery('#ewiz_blog_page_select').fadeIn();
        		jQuery('#ewiz_blog_page').fadeTo('slow',0.2);
        		
          		}
          		else{
            	
            	jQuery('#ewiz_blog_page_select').fadeOut();
            	jQuery('#ewiz_blog_page').fadeTo('slow',1);
            
                }
  				
  				
		});
    
    
    
	
		
	
		
	

		
	
		
		
	jQuery(".asmSelector").asmSelect({
        sortable: true,
        animate: false,
        addItemTarget: 'bottom'
    });
    
    jQuery(".noSort").asmSelect({
        sortable: true,
        animate: false,
        addItemTarget: 'bottom'
    });
  
    
    
    jQuery('.upload_button').click(function() {
  
				 formfield = jQuery(this).attr('name');
				 formID = jQuery(this).attr('rel');
				 tb_show('', 'media-upload.php?post_id=' + formID +'&type=image&amp;TB_iframe=1');
				 return false;
				});
						
			 	
			 	
				window.send_to_editor = function(html) {
				 			
					imgurl = jQuery(html).attr('href');
				 	jQuery('#' + formfield).val(imgurl);
					tb_remove();
				}
	
			

});