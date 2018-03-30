/*-----------------------------------------------------------------------------------*/
/*	Custom JS
/*-----------------------------------------------------------------------------------*/
 
(function($) {
			
	/*-----------------------------------------------------------------------------------*/
	/*	Superfish Drop-Down Menu
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().superfish ) {
		
		$('#menu ul').superfish({
			delay: 800,
			animation: { opacity: 'show', height: 'show' },
			speed: 250,
			autoArrows: false,
			dropShadows: false
		});
		 
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/* Lavalamp Navigation effects
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().lavaLamp ) {
			
	    var $blogMenuItem = $('#menu .menu > li > a[href="' + JsObject.blogURL + '"]');
		var $portfolioMenuItem = $('#menu .menu > li > a[href="' + JsObject.portfolioURL + '"]');
			
	    $( '#menu .sub-menu li' ).attr( 'class', 'noLava' ); // Disable the lavalamp effect on the drop-down menu links
	    $( '#menu .current-menu-item, #menu .current-menu-ancestor' ).addClass( 'selectedLava' ); 
	    
	    // Highlight the blog page link in the menu, if present and if the user is viewing a single blog post
	    if(($('body').hasClass('single-post') || $('body').hasClass('archive')) && $blogMenuItem.length) {
	    	$('#menu a').parent().removeClass('selectedLava');
	    	$blogMenuItem.parent().addClass('selectedLava current-menu-item'); 
	    }
	    
	    // Highlight the portfolio page link in the menu, if present and if the user is viewing a single portfolio post
	    if($('body').hasClass('single-portfolio') && $portfolioMenuItem.length) {
	    	$('#menu a').parent().removeClass('selectedLava');
	    	$portfolioMenuItem.parent().addClass('selectedLava current-menu-item'); 
	    }
	    
	    $( "#menu > ul" ).lavaLamp({ fx: "easeOutBack", speed: 700, returnDelay: 800 });
	    
    }
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Item Hover Effect
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().lavaLamp ) {
		
		var numberOfImagesPerRow = JsObject.numberOfProjectsPerRow;
		var positionFromTop = '210px';
		var moveOnHoverOver = '73px';
		var moveOnHoverOut = '-58px';
		
		// Override defaults
		if ( numberOfImagesPerRow == 4 ) {
			positionFromTop = '175px';
			moveOnHoverOver = '57px';
			moveOnHoverOut = '-58px';
		}
		else if ( numberOfImagesPerRow == 2 ) {
			positionFromTop = '330px';
			moveOnHoverOver = '127px';
			moveOnHoverOut = '-58px';
		}
	
		var hoverOverFunction = function() {
			var $this = $( this );
			
			if( $this.is( 'h3' ) ) {
				$this = $( this ).prev();
			}
			
			$this.find( 'img' ).stop().animate( { opacity: 0.05 }, 600, 'easeInOutExpo' );
			$this.find( 'span:first' ).stop().animate( { opacity: 1, top: moveOnHoverOver }, 900, 'easeInOutExpo' );
		} 
		
		var hoverOutFunction = function() {
			var $this = $( this );
			
			if( $this.is( 'h3' ) ) {
				$this = $( this ).prev();
			}
			
			$this.find( 'img' ).stop().animate( { opacity: 1 }, 1500, 'easeInOutCubic' );
			$this.find( 'span:first' ).stop().animate( { opacity: 0, top: moveOnHoverOut }, 900, 'easeInOutExpo', function() { $(this).css( 'top', positionFromTop ); } );
		}
		
		var config = {    
	    	over: hoverOverFunction,    
	     	timeout: 20, 
	     	interval: 130,  
	     	out: hoverOutFunction    
		};
		
		$( '.project-link, .project-link + h3' ).hoverIntent( config );
	
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Slider Next Prev Navigation
	/*-----------------------------------------------------------------------------------*/
	
	var $navLinksDiv = $( '#next-prev-links, .ie8 #slides .next, .ie8 #slides .prev, .ie9 #slides .next, .ie9 #slides .prev' );
	
	var sliderHoverOverFunction = function() {
		if ( !$( 'body' ).hasClass('ie8') ) {
			$navLinksDiv.stop().animate( { opacity: 1 }, 200, 'easeInOutExpo' );
		}
		else {
			$navLinksDiv.css('visibility', 'visible');
		}
	} 
	
	var sliderHoverOutFunction = function() {
		if ( !$( 'body' ).hasClass('ie8') ) {
			$navLinksDiv.stop().animate({ opacity: 0 }, 600, 'easeInOutCubic');
		}
		else {
			$navLinksDiv.css('visibility', 'hidden');
		}
	} 
	
	$( '.slider' ).hover( sliderHoverOverFunction, sliderHoverOutFunction );
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Latest Articles Slider
	/*-----------------------------------------------------------------------------------*/
	
	if ( $( '#latest-articles-slider' ).length && jQuery().slides ) {
		$( '#latest-articles-slider' ).slides({
			play: 4000,
			preload: true,
			slideEasing: 'easeOutSine',
			fadeEasing: 'easeOutSine',
			preloadImage: JsObject.wpURL + '/images/layout/loading.gif',
			effect: 'slide',
			crossfade: true,
			slideSpeed: 400,
			hoverPause: true,
			pause: 1000,
			generateNextPrev: false,
			generatePagination: false,
			paginationClass: 'latest-articles-pagination'
		});			
	}	
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Scroll body to 0px on click
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().scrollTop ) {
		 
		$( '#back-top a' ).click(function () {
			$( 'body,html' ).animate({
				scrollTop: 0
			}, 1000, 'easeOutCubic' );
			return false;
		});
	
	}
	
	
	/*-----------------------------------------------------------------------------------*/
	/*	Modal window
	/*-----------------------------------------------------------------------------------*/
	
	if ( jQuery().leanModal ) {
			
	    $( 'a[href="#modalContactForm"]' ).leanModal({ top : 190, overlay : 0.75 });
	    
	    $( '#modalContactForm h4' ).text( $( 'a[href="#modalContactForm"]' ).first().text() );		
	     
	    $( '#close-reveal-modal' ).click( function( e ) {
			$( '#lean_overlay' ).fadeOut(600);
			$( '#modalContactForm' ).css({ 'display' : 'none' });
		});
		
	}
	
})( jQuery );