/* ******************************************************************************* 

	LOGO IN STICKY MENU BAR

********************************************************************************** */  
(function($){
	"use strict"; 

	if( ! $.fn.rt_sticky_navbar_logo ){

		$.fn.rt_sticky_navbar_logo = function(options)
		{ 
				if ( "undefined" == rt_theme_params["sticky_logo"] || "" == rt_theme_params["sticky_logo"] ){
					return false;
				}

				var navigation_bar = $("#navigation_bar");
				var logo_img = $(this).attr("src");
				var home_url = $(this).parents("a").attr("href");
				var site_name = $(this).parents("a").attr("title");
				var sticky_logo_html = $('<div id="sticky_logo"><a href="'+home_url+'" title="'+site_name+'"><img src="'+logo_img+'"></a></div>');

				if( logo_img ){
					return navigation_bar.prepend(sticky_logo_html);
				}
		}
	}
 
	//activate the funtion
	$('#logo img').rt_sticky_navbar_logo(); 
 
})(jQuery); 
