jQuery(document).ready(function(){

	// Menu Navigation
	jQuery('#main-superfish-wrapper ul.sf-menu').supersubs({
		minWidth: 14.5,
		maxWidth: 27,
		extraWidth: 1
	}).superfish({
		delay: 100,
		speed: 'fast',
		animation: {opacity:'show',height:'show'}
	});
	
	// Accordion
	jQuery("ul.gdl-accordion li").each(function(){
		//jQuery(this).children(".accordion-content").css('height', function(){ 
			//return jQuery(this).height(); 
		//});
		
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
			jQuery(this).siblings(".accordion-content").slideDown();
			jQuery(this).parent().siblings("li").children(".accordion-content").slideUp();
			jQuery(this).parent().siblings("li").find(".active").removeClass("active");
		});
	});
	
	// Toggle Box
	jQuery("ul.gdl-toggle-box li").each(function(){
		//jQuery(this).children(".toggle-box-content").css('height', function(){ 
			//return jQuery(this).height(); 
		//});
		jQuery(this).children(".toggle-box-content").not(".active").css('display','none');
		
		jQuery(this).children(".toggle-box-head").bind("click", function(){
			jQuery(this).children().addClass(function(){
				if(jQuery(this).hasClass("active")){
					jQuery(this).removeClass("active");
					return "";
				}
				return "active";
			});
			jQuery(this).siblings(".toggle-box-content").slideToggle();
		});
	});
	
	// Social Hover
	jQuery('.social-icon-wrapper').each(function(){
		if( jQuery(this).hasClass('bottom-slider-on') ){
			jQuery(this).find(".social-icon").hover(function(){
				jQuery(this).animate({ opacity: 0.45 }, 150);
			}, function(){
				jQuery(this).animate({ opacity: 1 }, 150);
			});		
		}else{
			jQuery(this).find(".social-icon").hover(function(){
				jQuery(this).animate({ opacity: 1 }, 150);
			}, function(){
				jQuery(this).animate({ opacity: 0.45 }, 150);
			});
		}
	});
	
	// Scroll Top
	jQuery('div.scroll-top').click(function() {
		  jQuery('html, body').animate({ scrollTop:0 }, { duration: 600, easing: "easeOutExpo"});
		  return false;
	});
	
	// Blog Hover
	jQuery(".blog-thumbnail-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Gallery Hover
	jQuery(".gallery-thumbnail-image img").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 150);
	}, function(){
		jQuery(this).animate({ opacity: 1 }, 150);
	});
	
	// Port Hover
	jQuery("#portfolio-item-holder .portfolio-thumbnail-image-hover").hover(function(){
		jQuery(this).animate({ opacity: 0.55 }, 400, 'easeOutExpo');
		jQuery(this).find('span').animate({ left: '50%'}, 300, 'easeOutExpo');
	}, function(){
		jQuery(this).find('span').animate({ left: '150%'}, 300, 'easeInExpo', function(){
			jQuery(this).css('left','-50%');
		});
		jQuery(this).animate({ opacity: 0 }, 400, 'easeInExpo');
	});
	
	// Price Table
	jQuery(".gdl-price-item").each(function(){
		var max_height = 0;
		jQuery(this).find('.price-item').each(function(){
			if( max_height < jQuery(this).height()){
				max_height = jQuery(this).height();
			}
		});
		jQuery(this).find('.price-item').height(max_height);
		
	});
	jQuery(window).resize(function(){
		jQuery(".gdl-price-item").each(function(){
			var max_height = 0;
			jQuery(this).find('.price-item').each(function(){
				jQuery(this).css('height', 'auto');
				if( max_height < jQuery(this).height()){
					max_height = jQuery(this).height();
				}
			});
			jQuery(this).find('.price-item').height(max_height);
			
		});	
	});

});

jQuery(window).load(function(){

	// Set Portfolio Max Height
	var port_item_holder = jQuery('div#portfolio-item-holder');
	port_item_holder.equalHeights();
	jQuery(window).resize(function(){
		port_item_holder.children().css('height','auto');
		port_item_holder.equalHeights();
	});

});


/* Tabs Activiation
================================================== */
jQuery(document).ready(function() {

	var tabs = jQuery('ul.tabs');

	tabs.each(function(i) {

		//Get all tabs
		var tab = jQuery(this).find('> li > a');
		var tab_content = jQuery(this).next('ul.tabs-content')
		tab.click(function(e) {

			//Get Location of tab's content
			var contentLocation = jQuery(this).attr('data-href');
			
			//Let go if not a hashed one
			if(typeof( contentLocation ) != 'undefined') {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				jQuery(this).addClass('active');

				//Show Tab Content & add active class
				tab_content.children('li[data-href='+ contentLocation +']').fadeIn(200, function(){
					jQuery(window).trigger('resize');
				}).addClass('active').siblings().hide().removeClass('active');

			}
		});
	});
});

/* Equal Height Function
================================================== */
(function($) {
	$.fn.equalHeights = function(px) {
		$(this).each(function(){
			var currentTallest = 0;
			$(this).children().each(function(i){
				if ($(this).height() > currentTallest) { currentTallest = $(this).height(); }
			});
			$(this).children().css({'height': currentTallest}); 
		});
		return this;
	};
})(jQuery);
