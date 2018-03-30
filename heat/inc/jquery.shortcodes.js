jQuery(document).ready(function($){
	
	// Tabs shortcode
	var $tabs = $('.tabs');
	
	if( $tabs.length ) {
	
		$tabs.tabs({});
	
	}
	
	// jQuery UI Accordion
	var $accordion = $('.accordion');
	
	var $accordion_collapsible = $('.accordion_collapsible');
	
	if( $accordion.length || $accordion_collapsible.length ) {
		$.ui.accordion.animations.eioe = function(settings) {
			this.slide(settings, {
				easing: "easeInOutExpo",
				duration: 350
			});
		}
	}
	
	if( $accordion.length ) {
	
		$accordion.accordion({
			autoHeight: false,
			animated: 'eioe',
			collapsible: false
		});
		
	}
		
	if( $accordion_collapsible.length ) {	
	
		$accordion_collapsible.accordion({
			autoHeight: false,
			animated: 'eioe',
			collapsible: true,
			active: false
		});
		
	}
	
	// Testimonials
	var $carousel = $('.touchcarousel');
	
	if( $carousel.length ) {
	
		$('.touchcarousel').touchCarousel({
			itemsPerMove: 1,
			snapToItems: true,
			pagingNavControls: false,
			autoplay: true,
			autoplayDelay: 8000,
			autoplayStopAtAction: true,
			scrollbar: false,
			directionNav: true,
			loopItems: true,
			useWebkit3d: true
		});
	
	}

});
