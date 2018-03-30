

/************************************************************************/

/* DOM READY --> Begin													*/

/************************************************************************/

jQuery.noConflict();

jQuery(document).ready(function($) {



/* ---------------------------------------------------------------------- */

/*	Navigation

/* ---------------------------------------------------------------------- */



	(function() {



		var $nav = $('.admin-nav'),

			$item = $nav.find("li");



			$item.each(function() {

				$(this).filter(".current").prev().css("border-bottom-color","transparent");

			})

		

	})();



	/* end Navigation */

	

	/* ---------------------------------------------------------------------- */

	/*	Min-height

	/* ---------------------------------------------------------------------- */



	(function() {



		$('.main-holder').css('min-height', $(window).outerHeight() 

			- $('.heading-holder').outerHeight() 

			- $('.sub-heading').outerHeight()

			- $('.footer-holder').outerHeight() - 90

		);



	})();



	/* end Min-height */

	
	

/************************************************************************/

});/* DOM READY --> End		

/************************************************************************/





