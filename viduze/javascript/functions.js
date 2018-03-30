jQuery(document).ready(function(jQuery){	
	"use strict";
	
    // Target your .container, .wrapper, .post, etc.
	if(jQuery('.fluid-width-video-wrapper').length){
    		 jQuery(".fluid-width-video-wrapper").fitVids();
     }
  
	//tabs
	if(jQuery('#myTab').length){
		jQuery('#myTab a').click(function (e) {
			e.preventDefault();
			jQuery(this).tab('show');
		});
	}
	//ToolTip
	if(jQuery("[data-toggle='tooltip']").length){
		jQuery("[data-toggle='tooltip']").tooltip();
	}
	//Carousel
	if(jQuery("#carousel").length){
		jQuery('#carousel').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			itemWidth: 131,
			itemMargin: 0,
			asNavFor: '#slider'
		});
	}
    //FlexSlider
	if(jQuery("#slider").length){
		jQuery('#slider').flexslider({
			animation: "slide",
			controlNav: false,
			animationLoop: false,
			slideshow: false,
			sync: "#carousel",
			start: function(slider){
			  jQuery('body').removeClass('loading');
			}
		});
	}
	//Jscroll Pane
	if(jQuery(".latest-vidios").length){
		jQuery('.latest-vidios').jScrollPane();
	}
	//Carousel
	if(jQuery(".mycarousel").length){
		jQuery('.mycarousel').jcarousel({
			wrap: 'circular'
		});
	}
	//Gallery Script
	if(jQuery('.play').length){
		jQuery('.play a[rel^="prettyPhoto"]').prettyPhoto({
			animation_speed: 'slow',
			slideshow: 10000,
			hideflash: true
		});
	}
	
	 jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',slideshow:3000, autoplay_slideshow: false});	 
 
  // Accordion
	jQuery("ul.cp-accordion li").each(function(){
		if(jQuery(this).index() > 0){
			jQuery(this).children(".accordion-content").css('display','none');
		}else{
			jQuery(this).find(".accordion-head-image").addClass('active');
		}
		
		jQuery(this).children(".accordion-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")) return "";
				return "active";
			});
			jQuery(this).siblings(".accordion-content").slideDown(function(){
				jQuery(window).trigger('resize');
			});
			jQuery(this).parent().siblings("li").children(".accordion-content").slideUp();
			jQuery(this).parent().siblings("li").find(".active").removeClass("active");
		});
		
	});
	
});

document.createElement('header');
document.createElement('hgroup');
document.createElement('nav');
document.createElement('menu');
document.createElement('section');
document.createElement('article');
document.createElement('aside');
document.createElement('footer');