//<![CDATA[  
jQuery(document).ready(function() {
	   
    // Searchbar dynamic width 
	$menu_width = jQuery("#menu-main").width();
	$site_width = jQuery(".container").width();
	$search_width = $site_width - 58 - $menu_width;
	jQuery("#main-menu-wrap #searchbar .search-form .s").css("max-width", $search_width);
	
	
	function updateSearchBar() {
		
		$menu_width = jQuery("#menu-main").width();
		$site_width = jQuery(".container").width();
		$search_width = $site_width - 58 - $menu_width;
		jQuery("#main-menu-wrap #searchbar .search-form .s").css("max-width", $search_width);

	}
	
	jQuery(window).resize(function() {
	        updateSearchBar();
	    });

	
	jQuery(".images").prev('.onsale').addClass("single-onsale");
	
    jQuery('a.add_to_cart_button').click(function(){
	
		if(jQuery(this).text() == 'Add to cart') {
			jQuery(this).text('Added');
	    }
	});
	
	// Highlight on Hover
	jQuery('.ufo-recent .recent-thumb, .index-thumb img, #social a, .home-product-thumb-wrap-1, .attachment-shop_thumbnail, #breadcrumb a.home, a.remove, .gallery-image-wrap img').hover(function(){

		jQuery(this).stop(true, true).animate({opacity: 0.8},140);
	    }, function(){
		jQuery(this).stop(true, true).animate({opacity: 1},140);

	});
	
	var recentProduct = jQuery('.home-product-thumb-wrap, .product-thumb-wrap');
	       recentProduct.hover(function(){

	       	jQuery(this).find('.hover').stop(true, true).animate({opacity: 1},100);
	       }, function(){
	       	jQuery(this).find('.hover').stop(true, true).animate({opacity: 0},100);

	       });
 
        
	/*  Add .last class to Footer widgets  */        
	var $footer_widgets_number = jQuery("#footer-widgets div.footer-widget").length;
	var $footer_widgets = jQuery("#footer-widgets div.footer-widget");

	if (!($footer_widgets.length == 0)) {
		jQuery("#footer-widgets .footer-widget").addClass('column-'+$footer_widgets_number);
		$footer_widgets.each(function (index, domEle) {
			
			// domEle == this
			// Set maximum number of widgets in a row
			if( (index+1) >= 5) {
				if ((index+1)%5 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
			} else {
				if ((index+1)%$footer_widgets_number == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
			}
		});
	}
	
	var $author_grid = jQuery(".team-page-grid .author-wrap");

    if (!($author_grid.length == 0)) {
		$author_grid.each(function (index, domEle) {
		// domEle == this
		if ((index+1)%4 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}
		
	/*  Add .last class to Home widgets  */   
       var $home_widget = jQuery("#home-widgets div.home-widget");  
       
       if (!($home_widget.length == 0)) {
		$home_widget.each(function (index, domEle) {
			// domEle == this
			if ((index+1)%3 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}
	
	/*  Add .last class to Home widgets   */ 
       var $home_product = jQuery(".home-no-page .home-products ul.products li.product");  
       
       if (!($home_product.length == 0)) {
		$home_product.each(function (index, domEle) {
			// domEle == this
			if ((index+1)%4 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}
	/*  Add .last class to Home widgets  */   
       var $home_product = jQuery(".home-page-sidebar .home-products ul.products li.product, .archive ul.products li.product"); 
       
       if (!($home_product.length == 0)) {
		$home_product.each(function (index, domEle) {
			// domEle == this
			if ((index+1)%3 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
		});
	}

	// Hover Animation
	jQuery('#social img, #logo, .small-thumb').hover( function(){ jQuery(this).stop(true, true).animate({ opacity: 0.7}, 100)} , function(){jQuery(this).animate({ opacity: 1}, 100)} );

	jQuery('li.product .product-thumb-wrap').hover( function(){ 
	jQuery(this).find('.button').show() } , function(){jQuery(this).find('.button').hide() });             
       	
	/*  SuperFish  */
	jQuery('ul.nav, ul.top').superfish({ 
		delay:       0,                            // one second delay on mouseout 
		animation:   {opacity:'show',height:'show'},  // fade-in and slide-down animation 
		speed:       200,                          // faster animation speed 
		autoArrows:  true,                           // disable generation of arrow mark-up 
		dropShadows: false,                          // disable drop shadows 
		players: ['html','iframe']                           
	});

	
	
	/*  Initialize Shadowbox  */

	Shadowbox.init({   
		overlayColor: "#fff",
	    overlayOpacity: 0.9,
	    autoplayMovies:     false,
	    viewportPadding: 50,
		handleOversize: "drag"
	});

	// Remove H1 Title on category pages
	jQuery('.archive h1.page-title').remove();
	
	var $SingleGalItem = jQuery('.gallery-image-wrap');
	jQuery('.zoom-icon, .link-icon').css('opacity','0');
	$SingleGalItem.hover(function(){

		jQuery(this).find('.zoom-icon, .link-icon').stop(true, true).animate({opacity: 1},100);
	}, function(){
		jQuery(this).find('.zoom-icon, .link-icon').stop(true, true).animate({opacity: 0},100);

	});
	
	jQuery(function(){

	if (!((jQuery(".galleries .two-column .portfolio").length) == 0)) {
			jQuery(".galleries .two-column .portfolio").each(function (index, domEle) {
				// domEle == this
				if ((index+1)%2 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
			});
		};
	});

	jQuery(function(){

		if (!((jQuery(".galleries .three-column .portfolio").length) == 0)) {
				jQuery(".galleries .three-column .portfolio").each(function (index, domEle) {
					// domEle == this
					if ((index+1)%3 == 0) jQuery(domEle).addClass("last").after("<div class='clear'></div>");
				});
			};
		});
	
	jQuery(".sidebar-header").click(function(){
		jQuery(this).next('.widget-content').toggle();
		jQuery(this).toggleClass('widget-toggled');
		
	});
	
});  
//]]>