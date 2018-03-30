jQuery(document).ready(function($){
		// cache jQuery window
		var $window = jQuery(window);
  
		// cache container
		var $container = jQuery('#portfolio');
		
		// start up isotope with default settings
		var $isotopeItems = jQuery('#portfolio .hentry');
		$isotopeItems.css({ opacity: 0 });
		
		if ( $container.hasClass("mt-animate_when_almost_visible-enabled") ) {
			if(!(/Android|iPhone|iPad|iPod|BlackBerry|Windows Phone/i).test(navigator.userAgent || navigator.vendor || window.opera)){
				if (typeof jQuery.fn.waypoint !== 'undefined') {
					$container.waypoint(function( direction ) {
						$container.css({ 'opacity': '1', 'visibility': 'visible' });
						$isotopeItems.each(function(i){
							jQuery(this).delay(i*125).animate({'opacity':1},700);
						});
					}, { offset: '85%' });
				}
			} else {
				$container.css({ 'opacity': '1', 'visibility': 'visible' });
				$isotopeItems.each(function(i){
					jQuery(this).delay(i*125).animate({'opacity':1},700);
				});
			}
		}
		
		$container.imagesLoaded( function(){
			reLayout();
			//$window.smartresize( reLayout );
			
			$('.mt-loader').stop(true,true).fadeOut(200);
			if ( $container.hasClass("mt-animate_when_almost_visible-disabled") ) {
				$container.css({ 'opacity': '1', 'visibility': 'visible' });
				$isotopeItems.each(function(i){
					jQuery(this).delay(i*125).animate({'opacity':1},700);
				});
			}
		});
		
		//$window.smartresize( reLayout );
		//jQuery(window).smartresize(function(){
			//setTimeout(function(){
				//reLayout();
			//}, 450 );
		//});
		
		function reLayout() {
  
			//var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			//if (navigator.userAgent.match('MSIE 8') == null) {
				//mediaQueryId = mediaQueryId.replace( /"/g, '' );
			//}
			//console.log( mediaQueryId );
			//var windowSize = $window.width();

			if ( $container.hasClass("margin20") ) {
				gutter = '.gutter-sizer';
			} else {
				gutter = 0;
			}
			
			$container.isotope({
			  //resizable: false, // disable resizing by default, we'll trigger it manually
			  itemSelector : '.hentry',
			  masonry: {
				columnWidth: '.grid-sizer',
				gutter: gutter
			  }
			}).isotope( 'layout' );

		}

		// filter items when filter link is clicked
		jQuery('#filters a').click(function() {
			var selector = jQuery(this).attr('data-filter');
			$container.isotope({ filter: selector });
			
			setTimeout(function(){
				reLayout();
			}, 1000 );
			
			return false;
		});
		
		// set selected menu items
		var $optionSets = jQuery('.option-set'),
			$optionLinks = $optionSets.find('a');
 
			$optionLinks.click(function(){
				var $this = jQuery(this);
				// don't proceed if already selected
				if ( $this.hasClass('selected') ) {
					return false;
				}
				var $optionSet = $this.parents('.option-set');
				$optionSet.find('.selected').removeClass('selected');
				$this.addClass('selected'); 
			});
});
