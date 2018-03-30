jQuery(window).load(function(){ 
    var containWidth = jQuery("#portfolio_mixed_filter_wrapper").width();
    jQuery("#portfolio_mixed_filter_wrapper").css("width", containWidth+"px");

    jQuery("#portfolio_mixed_filter_wrapper").masonry({
      itemSelector: ".element",
      isResizable: true,
      columnWidth: Math.floor(jQuery("#portfolio_mixed_filter_wrapper").width()/ 3)
    });
    
    jQuery(window).resize(function () {
    	jQuery("#portfolio_mixed_filter_wrapper").css("width", "100%");
    	var containWidth = jQuery("#portfolio_mixed_filter_wrapper").width();
    	jQuery("#portfolio_mixed_filter_wrapper").css("width", containWidth+"px");
    
    	jQuery("#portfolio_mixed_filter_wrapper").masonry({
    	  itemSelector: ".element",
    	  isResizable: true,
    	  columnWidth: Math.floor(jQuery("#portfolio_mixed_filter_wrapper").width()/ 3)
    	});
    });
    
    jQuery("#portfolio_mixed_filter_wrapper").imagesLoaded( function(){
        jQuery("#portfolio_mixed_filter_wrapper").children(".element").children(".portfolio_type").each(function(){
    	    jQuery(this).addClass("fadeIn");
        });
    });
    
    jQuery("#portfolio_mixed_filter_wrapper").imagesLoaded( function(){
        jQuery("#portfolio_mixed_filter_wrapper").children(".element").children(".gallery_type").each(function(){
    	    jQuery(this).addClass("fadeIn");
        });
    });
});