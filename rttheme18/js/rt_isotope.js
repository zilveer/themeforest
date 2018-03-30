/* ******************************************************************************* 

	RUN ISOTOPE

********************************************************************************** */  
(function($){
	"use strict";
    $.fn.rt_run_isotope = function(options) {
  
		// cache container
		var $holder = $(this).parents('.content_block_background:eq(0)');
		var $container = $(this).find('.portfolio_boxes');
		var $filter_navigation = $(this).find('.filter_navigation');

			$(this).css("paddingTop","1px"); 
			$(this).find(".portfolio_boxes").css({"paddingTop":"1px"});
			$(this).css("opacity",1); 
			$container.isotope({
			itemSelector:'.box', 
			layoutMode: 'fitRows' 
		});

		// filter items when filter link is clicked
		$filter_navigation.find("a").click(function(){
			var selector = $(this).attr('data-filter'); 
			$container.isotope({ filter: selector });
			$container.isotope( 'on', 'layoutComplete',
				function( isoInstance, laidOutItems ) { $.waypoints('refresh'); }
			);

			return false; 
		});

		var $optionLinks = $filter_navigation.find('a');

		$optionLinks.click(function(){
			var $this = $(this);
			
			// don't proceed if already selected
			if ( $this.hasClass('active') ) {
				return false;
			}

			var $optionSet = $this.parents('.filter_navigation');
			$optionSet.find('.active').removeClass('active');
			$this.addClass('active');

			return false;
		}); 
	 
	}; 
})(jQuery);

