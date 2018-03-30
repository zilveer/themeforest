jQuery(document).ready(function() {
	jQuery('#option_btn').click(
		function() {
			if(jQuery('#option_wrapper').css('right') != '0px')
			{	
	    		jQuery('#option_wrapper').animate({"right": "0px"}, { duration: 500 });
	 			jQuery(this).animate({"right": "280px"}, { duration: 500 });
	 		}
	 		else
	 		{
	 			var isOpenOption = jQuery.cookie("photome_demo");
				if(jQuery.type(isOpenOption) === "undefined")
	    		{
	    			jQuery.cookie("photome_demo", 1, { expires : 7, path: '/' });
	    		}
	 			jQuery('#option_wrapper').animate({"right": "-290px"}, { duration: 500 });
				jQuery('#option_btn').animate({"right": "-2px"}, { duration: 500 });
	 		}
		}
	);
	
	var isOpenOption = jQuery.cookie("photome_demo");
	if(jQuery.type(isOpenOption) === "undefined")
	{
	    jQuery('#option_btn').trigger('click');
	}
});