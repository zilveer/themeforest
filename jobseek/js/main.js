(function($) {
	"use strict";

	$(window).load(function() {
		$("#loader").fadeOut("slow");
	});

	$(document).ready(function() {

		// ====================================================================
		// Navigation

		$('#main-nav').slimmenu({
		    resizeWidth: '767', /* Navigation menu will be collapsed when document width is below this size or equal to it. */
		    initiallyVisible: false, /* Make main navigation menu initially visible on mobile devices without the need to click on expand/collapse icon. */
		    collapserTitle: 'Main Menu', /* Collapsed menu title. */
		    animSpeed: 'medium', /* Speed of the sub menu expand and collapse animation. */
		    easingEffect: null, /* Easing effect that will be used when expanding and collapsing menu and sub menus. */
		    indentChildren: false, /* Indentation option for the responsive collapsed sub menus. If set to true, all sub menus will be indented with the value of the option below. */
		    childrenIndenter: '', /* Responsive sub menus will be indented with this character according to their level. */
		    expandIcon: '', /* An icon to be displayed next to parent menu of collapsed sub menus. */
		    collapseIcon: '' /* An icon to be displayed next to parent menu of expanded sub menus. */
		});

		// ====================================================================
		// Stick footer to bottom

		function stickFooter() {

			$("#content").removeAttr('style');

		    var hContent = $("body").height(); // get the height of your content
		    var hWindow = $(window).height();  // get the height of the visitor's browser window
		    var hDifference = hWindow - hContent;

		    // if the height of your content is bigger than the height of the 
		    // browser window, we have a scroll bar
		    if( hDifference > 0 ) {
		        var adminbar_height = $("#wpadminbar").outerHeight();
		        var header_height = $("#header").outerHeight();
		        var title_height = $("#title").outerHeight();
		        var footer_height = $("#footer").outerHeight();
		        var content_height = hWindow - header_height - footer_height - title_height - adminbar_height;
		        $("#content").attr('style', 'min-height:' + content_height + 'px');
		    } else {
				$("#content").removeAttr('style');
		    }

		}

		stickFooter();

		$(window).resize(function() {
			stickFooter();
		});

		// ====================================================================
		// Carousels

		if( $().owlCarousel ) {

			// Blog Posts Carousel

			$(".featured-jobs").each( function(){

				var columns = parseInt( $(this).attr('data-columns') );
				var autoplay = parseInt( $(this).attr('data-autoplay') );

	            switch (columns) {
	               case 1:
	                  var responsive = { 0:{ items: 1 }, 767:{ items: 1 }, 992:{ items: 1 }, 1200:{ items: 1 }, 1600:{ items: 1 } }
	                  break
	               case 2:
	                  var responsive = { 0:{ items: 1 }, 767:{ items: 2 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               case 3:
	                  var responsive = { 0:{ items: 1 }, 767:{ items: 2 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               default:
	                  var responsive = { 0:{ items: 1 }, 767:{ items: 3 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	            }

	            if( !autoplay ) {
	            	autoplay = false;
	            }

				// Recent Blog Posts Carousel
				$(this).owlCarousel({
					margin: 20,
					loop: true,
					dots: false,
					nav: true,
	           		autoplay: autoplay,
	            	autoplaySpeed: 1000,
					responsive: responsive
				});

			} );

			// Logo Carousel

	        $(".logo-carousel").each(function(){

				var columns  = parseInt( $(this).attr('data-columns') );
				var autoplay = parseInt( $(this).attr('data-autoplay') );

	            if( !autoplay ) {
	            	autoplay = false;
	            }
	            
	            switch ( columns ) {
	               case 1:
	                  var responsive = { 0:{ items: 1 }, 767:{ items: 1 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               case 2:
	                  var responsive = { 0:{ items: 2 }, 767:{ items: 2 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               case 3:
	                  var responsive = { 0:{ items: 2 }, 767:{ items: 2 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               case 4:
	                  var responsive = { 0:{ items: 2 }, 767:{ items: 3 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               case 5:
	                  var responsive = { 0:{ items: 2 }, 767:{ items: 3 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	               default:
	                  var responsive = { 0:{ items: 2 }, 767:{ items: 3 }, 992:{ items: columns }, 1200:{ items: columns }, 1600:{ items: columns } }
	                  break
	            }

	            $(this).owlCarousel({
	                margin: 50,
					loop: true,
					dots: false,
					nav: true,
	            	autoplay: autoplay,
	            	autoplaySpeed: 1000,
	                responsive: responsive
	            });

	        });

		}

		// Testimonials Carousel

		$(".testimonials-carousel").each( function(){

			var autoplay = parseInt( $(this).attr('data-autoplay') );

            if( !autoplay ) {
            	autoplay = false;
            }

			$(this).owlCarousel({
				items: 1,
				margin: 50,
				loop: true,
				dots: false,
				nav: false,
	            autoplay: autoplay,
	            autoplaySpeed: 1500
			});

		} );

		// ====================================================================
		// CSS classes fixing with JS

		$(".job_packages .job-package, .resume_packages .resume-package").first().addClass('active');

		$(".job-package, .resume-package").click(function(event){
			$(".job-package, .resume-package").removeClass('active');
			$(this).addClass('active');
			$("input", this).trigger("click");			
		});

		$(".job-package input, .resume-package input").click(function(event){
			event.stopPropagation();
		});

		// ====================================================================
		// Applying Form Popup

		$('.application_button').unbind('click').magnificPopup({
  			midClick: true,
  			items: {
   				src: '.application_details',
      			type: 'inline'
  				}
		});

		$('.resume_contact_button').unbind('click').magnificPopup({
  			midClick: true,
  			items: {
   				src: '.resume_contact_details', 
      			type: 'inline'
  				}
		});

		$('.logged-in .bookmark-notice').unbind('click').magnificPopup({
  			midClick: true,
  			items: {
   				src: '.wp-job-manager-bookmarks-form',
      			type: 'inline'
  				}
		});

		// Copied this snippet from bookmark.min.js
		$('.job-manager-bookmark-action-delete').click(function() {
			var answer = confirm( job_manager_bookmarks.i18n_confirm_delete );
			if (answer) {
				return true;
			}
			return false;
		});

		// ====================================================================
		// Responsive table

		$('table').not('.woocommerce-checkout-review-order-table').stacktable();

	})

})(jQuery);
