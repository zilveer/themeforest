	function runCb(){
			
			var cbstr = '';
					
			jQuery('.cblist_1 input[type=checkbox]:checked').each(function(){
				
					// Needs to be negative value			
					cbstr += '-' + jQuery(this).attr('name') + ',';
		

			});
			
			jQuery('#cbvalue_1').val(cbstr);
		}
		
		
	function runCb2(){
			
			var cbstr = '';
					
			jQuery('.cblist_2 input[type=checkbox]:checked').each(function(){
				
					// Needs to be negative value			
					cbstr += '-' + jQuery(this).attr('name') + ',';
		

			});
			
			jQuery('#cbvalue_2').val(cbstr);
		}


jQuery(document).ready(function(){

		tabPanel();

		jQuery('.cblist_1 input[type=checkbox]').change(function(){

			runCb();
		
		});
		
		jQuery('.cblist_2 input[type=checkbox]').change(function(){

			runCb2();
		
		});		
		
		
		
		
		jQuery('.epic_admin_imagelist a').click(function(){
		
			jQuery(this).parent().parent().find('a').removeClass('active');
		
			var link = jQuery(this).attr('rel');
			var image = jQuery(this).attr('title');
			
			jQuery('#'+ link).val(image) ;
			jQuery(this).addClass('active');
			
			return false;
		
		});
		
		
    	jQuery('.clearimage').click(function(){
		
			jQuery(this).parent().find('a').removeClass('active');		
			
			jQuery(this).parent().find('input[type=hidden]').val('');
			
			return false;
		
		});
    
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
		
		
		
		
		// Theme options panel
    
    	jQuery('.epic_section').hide();
    	jQuery('.epic_section:first').show();
    
    	jQuery('.epic_admin_menu li:first').addClass('active');
    	
    	jQuery('.epic_admin_menu li a').click(function(){
    	
    		var link = jQuery(this).attr('href');
    		//alert(link);
    		
    		jQuery('.epic_section').hide();
    		jQuery('.epic_admin_menu li').removeClass('active');
    		
    		jQuery(this).parent().addClass('active');
    		jQuery(link).fadeIn();
    		jQuery(link).find('.epic_admin_suboptions').hide();
    		//jQuery(link).find('.epic_admin_suboptions:first').slideDown();
    		//jQuery(link).find('.epic_subtitle h3:first').addClass('active');
    		jQuery('.toggledown').show();
    		jQuery('.toggleup').hide();
    		return false;
    	
    	});
    	
    	jQuery('.toggledown').click(function(){
    	
    		jQuery(this).parent().parent().find('.epic_admin_suboptions').slideDown('normal');
    		jQuery(this).parent().parent().find('.epic_subtitle h3').addClass('active');
    		jQuery(this).hide();
    		jQuery('.toggleup').show();
    		return false;
    	
    	});
    	
    	jQuery('.toggleup').click(function(){
    	
    		jQuery(this).parent().parent().find('.epic_admin_suboptions').slideUp('fast');
    		jQuery(this).parent().parent().find('.epic_subtitle h3').removeClass('active');
    		jQuery(this).hide();
    		jQuery('.toggledown').show();
    		return false;
    	
    	});
    	
    	
    	// Show / hide title font options
    	jQuery('#epic_cufon_title_font').parent().hide();
    	jQuery('#epic_google_title_font').parent().hide();
    	jQuery('#epic_google_title_fontfamily').parent().hide();
    	jQuery('#epic_websafe_title_font').parent().hide();
    	
    	
  		showCufonOptions();
		
		showGooglefontOptions();
		
		showWebsafefontOptions();
		
		
		jQuery("#epic_title_font_rendering_0").change(function () {
		
			showCufonOptions();
			
		});
		
		jQuery("#epic_title_font_rendering_1").change(function () {
		
			showGooglefontOptions();
			
		});
		
		jQuery("#epic_title_font_rendering_2").change(function () {
		
			showWebsafefontOptions();
			
		});
		
		function showCufonOptions(){
		
			if (jQuery('#epic_title_font_rendering_0').is(':checked')){
				
				jQuery('#epic_cufon_title_font').parent().show();
  				jQuery('#epic_google_title_font').parent().hide();
    			jQuery('#epic_google_title_fontfamily').parent().hide();
    			jQuery('#epic_websafe_title_font').parent().hide();
			}
		}
		
		function showGooglefontOptions(){
		
			if (jQuery('#epic_title_font_rendering_1').is(':checked')){		
  			
  				jQuery('#epic_cufon_title_font').parent().hide();
  				jQuery('#epic_google_title_font').parent().show();
    			jQuery('#epic_google_title_fontfamily').parent().show();
    			jQuery('#epic_websafe_title_font').parent().hide();
			}
		}
		
		function showWebsafefontOptions(){
		
			if (jQuery('#epic_title_font_rendering_2').is(':checked')){
  			
  				jQuery('#epic_cufon_title_font').parent().hide();
  				jQuery('#epic_google_title_font').parent().hide();
    			jQuery('#epic_google_title_fontfamily').parent().hide();
    			jQuery('#epic_websafe_title_font').parent().show();
			}
		}
		
		
		// Show / hide body font options
    	jQuery('#epic_body_google_font').parent().hide();
    	jQuery('#epic_body_google_fontfamily').parent().hide();
    	jQuery('#epic_body_websafe_font').parent().hide();
    	
    	
  		showGooglefontBodyOptions();
		
		showWebsafefontBodyOptions();
		
		
		jQuery("#epic_body_font_rendering_0").change(function () {
		
			showGooglefontBodyOptions();
			
		});
		
		jQuery("#epic_body_font_rendering_1").change(function () {
		
			showWebsafefontBodyOptions();
			
		});
		
		
				
		function showGooglefontBodyOptions(){
		
			if (jQuery('#epic_body_font_rendering_0').is(':checked')){		
  			
  				jQuery('#epic_body_google_font').parent().show();
    			jQuery('#epic_body_google_fontfamily').parent().show();
    			jQuery('#epic_body_websafe_font').parent().hide();
			}
		}
		
		function showWebsafefontBodyOptions(){
		
			if (jQuery('#epic_body_font_rendering_1').is(':checked')){
  			
  				jQuery('#epic_body_google_font').parent().hide();
    			jQuery('#epic_body_google_fontfamily').parent().hide();
    			jQuery('#epic_body_websafe_font').parent().show();
			}
		}
		
    	
    	
    	
    	
    	jQuery('.toggleup').hide();
    	
		jQuery('.epic_admin_suboptions').slideUp('fast');
		
		jQuery('.epic_subtitle h3 ').click(function(){
		
		
							
			if(jQuery(this).parent().next('.epic_admin_suboptions').css('display')=='none')
				{	
				
					jQuery('.epic_admin_suboptions').slideUp('fast');
					jQuery('.epic_subtitle h3 ').removeClass('active');
					jQuery(this).addClass('active');
				
					
				}
			else
				{	
					jQuery(this).removeClass('active');			
				}
				
			jQuery(this).parent().next('.epic_admin_suboptions').slideToggle('slow');
			
				
});
		


    
    
  
   
	jQuery('.remove_button').click(function() {
  
				 formfield = jQuery(this).attr('name');
				 formID = jQuery(this).attr('rel');
				 jQuery('#'+ formfield).val('');
				 jQuery('#img_'+ formID).fadeOut('slow',function(){
				 
				 	jQuery(this).remove();
				 
				 });
				 
				 return false;
		});
		
		
		
		

});


// TAB PANEL
function tabPanel(){
	
		//Default Action
			jQuery(".tabcontent").hide(); //Hide all content
			jQuery(" .epic_tabnav > li:first").addClass("current-menu-item").fadeIn('fast'); //Activate first tab
			jQuery(".tabcontent:first").show(); //Show first tab content
			
			
			//On Click Event
			jQuery(".epic_tabnav > li").click(function() {
				jQuery(".epic_tabnav > li").removeClass("current-menu-item"); //Remove any "active" class
				jQuery(this).addClass("current-menu-item"); //Add "active" class to selected tab
				jQuery(".tabcontent").hide(); //Hide all content
				var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				jQuery(activeTab).stop().show(); //Fade in the active content
				return false;
			});
			
	
	}
	