jQuery(document).ready(function($){

	// Clone portfolio items to get a second collection for Quicksand plugin
	var $portfolioClone = jQuery(".portfolio-list").clone();

	// Attempt to call Quicksand on every click event handler
	jQuery(".portfolio-filter a").click(function(e){
		
		// Set index to zero and disable prev
		jQuery('.ajax-gallery-navigation').attr('id', '-1');
		jQuery('.ajax-prev').css('opacity','0.8');
		jQuery('.ajax-prev').css('cursor','default');
		
		jQuery(".portfolio-filter li").removeClass("current");	
		
		// Get the class attribute value of the clicked link
		var $filterClass = jQuery(this).parent().attr("class");

		
		if ( $filterClass == "all" ) {
			var $filteredPortfolio = $portfolioClone.find("li");
		} else {
			var $filteredPortfolio = $portfolioClone.find("li[data-type~=" + $filterClass + "]");
		}
		
		// Call quicksand
		jQuery(".portfolio-list").quicksand( $filteredPortfolio, { 
			duration: 800,
			enhancement: function() {
				//get stored value to highlight
				var portfolioID = jQuery('.ajax-gallery-navigation').attr("rel");
				jQuery( '[data-portfolio=portfolio-'+portfolioID+']').addClass('portfolio-displayed');	
			}
		}, function(){
			
			AjaxPortfolio();
			
		});


		jQuery(this).parent().addClass("current");

		// Prevent the browser jump to the link anchor
		e.preventDefault();
	});

});