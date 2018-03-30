//<![CDATA[
jQuery(document).ready(function($){	
	
	//	Initialize Homepage Slider
	$(".flexslider").flexslider({
		controlNav: false,
		directionNav: true,
		slideshow: false,
		start: function(){
	      $('.loader').hide();
	  	}
	});	
});
//]]>