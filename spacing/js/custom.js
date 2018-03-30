/*
 * ---------------------------------------------------------------- 
 *  
 *  Spacing WordPress Theme custom jQuery scripts.
 *  
 * ----------------------------------------------------------------  
 */

jQuery(document).ready(function(){	

/*
 * ---------------------------------------------------------------- 
 *  Dropdown menu
 * ----------------------------------------------------------------  
 */
	
	function mainmenu(){
	jQuery('#navigation li').hover(function(){
		jQuery(this).find('ul:first').css({visibility: "visible",display: "none"}).show(300);
	},function(){
		jQuery(this).find('ul:first').css({visibility: "hidden"});
	});
	}
	
	mainmenu();

/*
 * ---------------------------------------------------------------- 
 *  Thumbnail Over Effect
 * ----------------------------------------------------------------  
 */

	jQuery('.portfolio-thumbnail-holder span').stop().animate({ "opacity": 0 }, 0);
	
	jQuery(".portfolio-thumbnail-holder,.gallery.clearfix").hover(function(){
		jQuery(this).find('div').stop().animate({ opacity: .2 }, 350);
		jQuery(this).find('span').stop().animate({ opacity: 1}, 350);
	}, function(){
		jQuery(this).find('span').stop().animate({ opacity: 0}, 350);	
		jQuery(this).find('div').stop().animate({ opacity: 1 }, 350);
	});
	


/*
 * ---------------------------------------------------------------- 
 *  Opacity Hover
 * ----------------------------------------------------------------  
 */
 
	jQuery('a.opacity-hover, .flickr_badge_image').hover(function() {
		jQuery(this).find('img').stop().animate({ "opacity": .2 }, 350);
	}, function() {
		jQuery(this).find('img').stop().animate({ "opacity": 1 }, 350);
	});	
	
/*
 * ---------------------------------------------------------------- 
 *  Shortcodes
 * ----------------------------------------------------------------  
 */
	
	// Tabs
	
	jQuery(".tabs").tabs();
	
	//
	
	jQuery('.toggle-container').click(function () {
		var text = jQuery(this).children('.toggle-content');
		
		if (text.is(':hidden')) {
			text.slideDown('fast');
			jQuery(this).children('h6').addClass('active');		
		} else {
			text.slideUp('fast');
			jQuery(this).children('h6').removeClass('active');		
		}		
	});

		
/*
 * ---------------------------------------------------------------- 
 *  Responsive Navigation
 * ----------------------------------------------------------------  
 */		
	
	var dropdown = document.getElementById("page_id");
	function onPageChange() {
		if ( dropdown.options[dropdown.selectedIndex].value != 0 ) {
			location.href = dropdown.options[dropdown.selectedIndex].value;
		}
	}
	if(dropdown){
		dropdown.onchange = onPageChange;
	}
		
/*
 * ---------------------------------------------------------------- 
 *  PrettyPhoto
 * ----------------------------------------------------------------  
 */		
 
	function prettyPhoto() {
		jQuery(".gallery a[rel^='gallery']").prettyPhoto({animation_speed:'normal',theme:'pp_default',deeplinking:false,slideshow:3000});
	}
	
	prettyPhoto();
	
		
});