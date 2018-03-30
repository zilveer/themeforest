(function ($, window, document, undefined) {
    'use strict';

    jQuery(document).ready(function ($) {

		// Portfolio Select
		jQuery( "select#nnn" ).change(function() {
			var str = "";
			str +=jQuery( "#nnn" ).val();


			if( str == "default"){
				jQuery(".ext-link , .video-link, #project_description, .project_client, .project_website, #single_project_setup").fadeOut(300);
			}
		 
			 if( str == "direct"){
				  jQuery(".video-link").fadeIn(500).css("display","block");
				  jQuery(".ext-link, #project_description, .project_client, .project_website, #single_project_setup").css("display","none");
			}
			
			if( str == "external"){
				jQuery(".ext-link").fadeIn(500).css("display","block");
				jQuery(".video-link, #project_description, .project_client, .project_website, #single_project_setup").css("display","none");
			}
            if( str == "single_page"){
                jQuery(".ext-link").fadeOut(300);
                jQuery("#project_description, .project_client, .project_website, #single_project_setup, .video-link").fadeIn(500).css("display","block");

            }

			
		}).trigger( "change" );
		  
		  

		//Masked Inputs (images as radio buttons)
		jQuery('.of-radio-img').click(function(){
			jQuery(this).parent().parent().find('.of-radio-img').removeClass('radio-img-selected');
			jQuery(this).addClass('radio-img-selected');
		});
		jQuery('.radio-label').hide();
		jQuery('.of-radio-img').show();
		jQuery('.img-radio').hide();  
		
		var i = jQuery("input[type=radio][name=portf_thumbnail]:checked").val();
		
		if (i=="portfolio-small"){
			jQuery("#small").addClass('radio-img-selected'); 
			jQuery("#vertical").removeClass('radio-img-selected');   			
		}
		if (i=="half-vertical"){
			jQuery("#vertical").addClass('radio-img-selected'); 
			jQuery("#small").removeClass('radio-img-selected');   			
		}

	});
   
}());