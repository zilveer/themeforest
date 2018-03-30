jQuery(document).ready(function($){
		// Magnific Popup
		var $magnificpopup = $('.magnificpopup');
		if ($magnificpopup.length) {
		
			$('#gallery-alternative').each(function() {
				$(this).magnificPopup({
					delegate: 'a',
					type: 'image',
					gallery:{
						enabled:true,
						tCounter: '<span>%curr% / %total%</span>', // markup of counter
					},
					image: {
						titleSrc: 'data-attribute-caption'
					},
					overflowY: 'hidden',
					//removalDelay: 150,
					//mainClass: 'mfp-fade',
					closeBtnInside: false,
					
					mainClass: 'mfp-zoom-in',
					tLoading: '',
					removalDelay: 500, //delay removal by X to allow out-animation
					callbacks: {
						open: function() {
						  $( '.mfp-preloader' ).append( '<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div>' );
						},
						change: function() {
							if (this.isOpen) {
								this.wrap.addClass('mfp-open');
							}
						},
						imageLoadComplete: function() {
						  var self = this;
						  setTimeout(function() {
							self.wrap.addClass('mfp-image-loaded');
						  }, 16);
						},
						beforeClose: function() {
							if (this.isOpen) {
								this.wrap.removeClass('mfp-open');
							}
						},
						close: function() {
						  this.wrap.removeClass('mfp-image-loadedn');
						},
					},
					
					
					
					
					
				});
			});
		}

		// cache jQuery window
		var $window = jQuery(window);
  
		// cache container
		var $container = jQuery('#gallery-alternative');
		
		// start up isotope with default settings
		var $isotopeItems = jQuery('#gallery-alternative .gallery-alternative-item');
		$isotopeItems.css({ opacity: 0 });
		
		$container.imagesLoaded( function(){
			reLayout();
			$window.smartresize( reLayout );
			
			$('.mt-loader').stop(true,true).fadeOut(200);
			$container.css({ 'opacity': '1', 'visibility': 'visible' });
			$isotopeItems.each(function(i){
				jQuery(this).delay(i*125).animate({'opacity':1},700);
			});
		});
		
		function reLayout() {
  
			//var mediaQueryId = getComputedStyle( document.body, ':after' ).getPropertyValue('content');
			// fix for firefox, remove double quotes "
			//if (navigator.userAgent.match('MSIE 8') == null) {
				//mediaQueryId = mediaQueryId.replace( /"/g, '' );
			//}
			//console.log( mediaQueryId );
			//var windowSize = $window.width();
			
			$container.isotope({
			  //resizable: false, // disable resizing by default, we'll trigger it manually
			  itemSelector : '.gallery-alternative-item',
			  masonry: {
				columnWidth: '.grid-sizer',
				gutter: '.gutter-sizer'
			  }
			}).isotope( 'layout' );

		}
});
