jQuery(window).load(function() {
"use strict";
//==================== Portfolio Isotope  ========================//
	jQuery('.filterable_portfolio').isotope({
	 	 // options
	  	itemSelector : '.item',
	});

	jQuery('.filterable_portfolio').isotope({ filter: "*" });

	//filtering
	jQuery('.filter-categories a').click(function(){
		jQuery('.filter-categories a').removeClass('selected');
	  	var selector = jQuery(this).attr('data-filter');
	  	jQuery(this).addClass('selected');
	 	jQuery('.filterable_portfolio').isotope({ filter: selector });
	 	return false;
	});

//==================== Portfolio Opening  ========================//
	jQuery("a.portfolio-opening").on('click', function(e) {
	"use strict";
		e.preventDefault();
		var url = jQuery(this).attr("href");
		jQuery.get(url, function(data) {
			jQuery(".portfolio_details").show(600).html(data);
			var scrollTarget = jQuery(".portfolio_details").offset().top;
	        jQuery('html,body').animate({scrollTop:scrollTarget-80}, 1000, "swing");
		});
	});
});	
