jQuery('#option_btn').click(
	function() {
		if(jQuery('#option_wrapper').css('left') != '0px')
		{	
    		jQuery('#option_wrapper').animate({"left": "0px"}, { duration: 500 });
 			jQuery(this).animate({"left": "250px"}, { duration: 500 });
 		}
 		else
 		{
 			var isOpenOption = jQuery.cookie("proxima_demo");
			if(jQuery.type(isOpenOption) === "undefined")
    		{
    			jQuery.cookie("proxima_demo", 1, { expires : 1 });
    		}
 			jQuery('#option_wrapper').animate({"left": "-260px"}, { duration: 500 });
			jQuery('#option_btn').animate({"left": "-2px"}, { duration: 500 });
 		}
	}
);

var isOpenOption = jQuery.cookie("proxima_demo");
if(jQuery.type(isOpenOption) === "undefined")
{
    jQuery('#option_btn').trigger('click');
}