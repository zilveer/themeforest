// JavaScript Document
jQuery(document).ready(function() {

	var device = navigator.userAgent.toLowerCase();
	var ios = device.match(/(iphone|ipod|ipad)/);

 //function that returns element's y position
    
    jQuery("nav ul a[href*=#]").on('click', function(e) {
    	var scrollTarget = jQuery(this.hash).offset().top;
      if(scrollTarget)
          e.preventDefault();
      	if(parseInt(scrollTarget) !== parseInt(jQuery(window).scrollTop())) {
      		var intro = jQuery("#intro"),
      			nav2 = jQuery("nav");
    		if (ios) nav2.hide();
	        jQuery('html,body').animate({scrollTop:scrollTarget}, 1500, function(evt) {
		    	if (ios) {
		    		nav2.css({position:'absolute', top:scrollTarget + 0});
		    		var nav2clone = jQuery("nav")
		    		nav2clone.show();
		    	}
			});
		}
    });

    if (ios) {
      	jQuery(document).bind('touchmove',function(){
      		var intro = jQuery("#intro"),
      			nav2 = jQuery("nav");
    		if(intro.height() <= nav2.position().top)
    		{
       			nav2.css({position:'fixed', top:'0'});
       			nav2.show();
       		}
       		else
       			nav2.hide();
  		});   
  	}
});