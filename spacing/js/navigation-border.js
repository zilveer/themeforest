/*
 * ---------------------------------------------------------------- 
 *  Animated Navigation Border | Credits to Chris Coyier
 * ----------------------------------------------------------------  
 */

jQuery(document).ready(function(){	

	function magicline(){
		
		var $el, leftPos, newWidth,
			$mainNav = jQuery(".menu");
		
		$mainNav.append("<li id='magic-line'></li>");
		
		var $magicLine = jQuery("#magic-line");
		
		if($magicLine){
		$magicLine
			.width(jQuery(".current-menu-item, .current-menu-parent, .current_page_parent").width())
			.css("left", jQuery(".current-menu-item, .current-menu-parent, .current_page_parent").position().left+30)
			jQuery("#magic-line").fadeIn('slow')
			.data("origLeft", $magicLine.position().left)
			.data("origWidth", $magicLine.width());
			
		jQuery(".menu > li").hover(function() {
			$magicLine.stop().animate({
				left: jQuery(this).position().left+30,
				width: jQuery(this).find('a').width()
				
			});
		}, function() {
			$magicLine.stop().animate({
				left: $magicLine.data("origLeft"),
				width: $magicLine.data("origWidth")
			});    
		});
		}
		
	}
	
	magicline();	
		
});