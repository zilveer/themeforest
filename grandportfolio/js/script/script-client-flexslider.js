function getGridSize() {
    return (window.innerWidth <= 480) ? 2 :
           (window.innerWidth < 900) ? 5 : 5;
}
jQuery(window).load(function() {
	var post_carousel_column = 5;
	var post_carousel_column_width = 200;
    
    jQuery('.client_carousel').flexslider({
		      animation: "slide",
		      animationLoop: false,
		      itemWidth: post_carousel_column_width,
		      itemMargin: 0,
		      minItems: getGridSize(),
		      maxItems: getGridSize(),
	    }); 
});