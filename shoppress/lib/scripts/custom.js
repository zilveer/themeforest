/////////////////////////////////////// Image Preloader ///////////////////////////////////////


jQuery(function () {
	jQuery('.preload').hide();
});

var i = 0;
var int=0;
jQuery(window).bind("load", function() {
	var int = setInterval("doThis(i)",100);
});

function doThis() {
	var images = jQuery('.preload').length;
	if (i >= images) {
		clearInterval(int);
	}
	jQuery('.preload:hidden').eq(0).fadeIn(400);
	i++;
}


/////////////////////////////////////// Document Ready ///////////////////////////////////////


jQuery(document).ready(function(){

	"use strict";
	

	/////////////////////////////////////// Mobile Navigation Menu ///////////////////////////////////////


	jQuery("<option />", {"selected": "selected", "value": "", "text": gp_script.navigationText}).prependTo(".nav select");
        	
	jQuery(".nav select").change(function() {
		window.location = jQuery(this).find("option:selected").val();
	});
	
	
	/////////////////////////////////////// Mega Menus ///////////////////////////////////////
	
	
	/*************************************** Nav Titles ***************************************/	
	
	jQuery(".sub-menu .nav-title").each(function() {
		jQuery(this).nextUntil(".nav-title").andSelf().wrapAll("<div class='nav-section'></div>");
	});


	/*************************************** Nav Text ***************************************/	
	
	jQuery(".sub-menu .nav-text a").contents().unwrap();
	
	
	/*************************************** Dropdown Signs ***************************************/	

	jQuery(".nav > ul > li").each(function() {
		if(jQuery(this).find("ul").length > 0) {	
			jQuery("<span class='dropdown-sign' />").html("+").appendTo(jQuery(this).children(":first"));		
		}	
	});
	

	/*************************************** Old Nav Widths ***************************************/	
				
	jQuery(".nav > ul > li").not('.megamenu').each(function() {

		if(jQuery(this).find("ul").length > 0) {	
		
			jQuery(this).mouseenter(function() {
			
				var total_width = 0;			
		
				jQuery(this).find(".nav-section").each(function() {				
					total_width += jQuery(this).outerWidth() + 30; 
				});
				
				jQuery(this).find(".sub-menu").css("width",total_width + 40);			

			});
		
		}	
		
	});	
	
	
	/////////////////////////////////////// Lightbox ///////////////////////////////////////


	jQuery("div.gallery-item .gallery-icon a").prepend('<span class="hover-image"></span>');
	jQuery("div.gallery-item .gallery-icon a").attr("rel", "prettyPhoto[gallery]");
	
	jQuery("a[rel^='prettyPhoto']").prettyPhoto({
		theme: 'light_square',
		deeplinking: false,
		social_tools: ''
	});


	/////////////////////////////////////// Image Hover ///////////////////////////////////////


	jQuery('.hover-image, .hover-video').css({'opacity':'0'});
	jQuery("a[rel^='prettyPhoto']").hover(
		function() {
			jQuery(this).find('.hover-image, .hover-video').stop().fadeTo(750, 1);
		},
		function() {
			jQuery(this).find('.hover-image, .hover-video').stop().fadeTo(750, 0);
		}
	);


	/////////////////////////////////////// Back To Top ///////////////////////////////////////


	jQuery(".back-to-top").click(function() {
		jQuery("html, body").animate({ scrollTop: 0 }, 'slow');
	});


	/////////////////////////////////////// Prevent Empty Search - Thomas Scholz http://toscho.de ///////////////////////////////////////


	(function($) {
		$.fn.preventEmptySubmit = function(options) {
			var settings = {
				inputselector: "#searchbar",
				msg          : gp_script.emptySearchText
			};
			if (options) {
				$.extend(settings, options);
			}
			this.submit(function() {
				var s = $(this).find(settings.inputselector);
				if(!s.val()) {
					alert(settings.msg);
					s.focus();
					return false;
				}
				return true;
			});
			return this;
		};
	})(jQuery);

	jQuery('#searchform').preventEmptySubmit();
	
	
});