/* <![CDATA[ */
(function($){
	
	"use strict";
	
    $(document).ready(function(){
		
		/*
		|--------------------------------------------------------------------------
		| Icon Modal
		|--------------------------------------------------------------------------
		*/
		
		/* move modal to footer */
		$('.ut-modal').insertBefore('#wpfooter');
		
		/* delete meta box */ 
		$('#ut_icon_popup').remove();
		
		var iconbutton = '',
			iconinput  = '';
		
		$(document).on("click", ".ut-add-icon", function(event){ 
			
			event.preventDefault();
			
			iconbutton = $(this),
			iconinput  = $(this).siblings('input:text').first();
			
			$(".ut-modal").fadeIn();
			
		});
		
		
		$(document).on("click", ".close-ut-modal", function(event){ 
			
			event.preventDefault();
			
			$(".ut-modal").fadeOut();
			
		});
		
		$(document).on("click", ".ut-glyphicon", function(event){ 
			
			var icon = $(this).data('icon');
			
			$(iconinput).val(icon);
			$(".ut-modal").fadeOut();
			
			/* update preview */
			preview_shortcode();
		
		});	
			
			
	});

})(jQuery);
 /* ]]> */	