
// When DOM is fully loaded
jQuery(document).ready(function($) {


	/* Enable Strict Mode
	 ---------------------------------------------------------------------- */
	"use strict";


	/* Main Settings
	 ---------------------------------------------------------------------- */
	var settings = {
		// Navigation height 
		nav_height: $( '.nav-container' ).css( 'height' ).replace( 'px', '' ),

	};


	/* Detect Touch Device
	 ---------------------------------------------------------------------- */
	(function() {

		if ( Modernizr == 'undefined' ) return;

		if ( Modernizr.touch ) {

			$('body').addClass( 'touch-device' );

		}

	})();


	/* Navigation
	 ---------------------------------------------------------------------- */
	(function() {


		/* Main navigation
	 	 ------------------------- */
		var 
			$nav = $( '#nav' ).children( 'ul' ),
			$nav = $( 'li', $nav );

		// Create top navigation
		$( document ).on( 'mouseenter', '#nav ul li', function() {
				var 
					$this = $( this ),
					$sub  = $this.children( 'ul' );
				if ( $sub.length ) {
					$this.addClass('active');
		            var elm = $('ul:first', this);
		            var off = elm.offset();
		            var l = off.left;
		            var w = elm.width();
		            var docH = $('body').height();
		            var docW = $('body').width();

		            var isEntirelyVisible = (l + w <= docW);

		            if (!isEntirelyVisible) {
		                $sub.addClass('edge');
		            } else {
		                $sub.removeClass('edge');
		            }
		        }
				$sub.stop( true, true ).addClass( 'show-list' );
			}).on( 'mouseleave', '#nav ul li', function() {
				$( this ).removeClass( 'active' ).children( 'ul' ).stop( true, true ).removeClass( 'show-list edge' );
			});


		/* Hash Links
	 	 ------------------------- */
	 	if ( ajax_vars.ajaxed == 0 ) {

	 		// Jump hash after load
	 		var target_hash = location.hash;

	 		var offset = parseInt( $( '#header' ).css( 'height' ), 10 );

	 		if ( target_hash != '' && $( target_hash ).length ) {

	 			var scroll_offset = $( target_hash ).offset().top + offset;
				$( 'html, body' ).animate({
					scrollTop: scroll_offset
				}, 900);
	 		}

	 		$( document ).on( 'click', '#nav a[href*=#], #ajax-container a[href*=#], #slidemenu a[href*=#], #slidebar-content a[href*=#]', function(e){
	 			var that = $( this );
	 			var url = that.attr( 'href' );
	 			var target_hash = location.hash;
				
				if ( that.attr( 'href' ) !== '#' ) {

					var hash = url.split('#')[1];

					if ( hash ) {

						hash = $( this ).attr( 'href' ).replace(/^.*?#/,'');
						hash = '#' + hash;
						
						url = url.replace( hash, '' );
						offset = $( this ).data( 'offset' );
						if ( offset == undefined || offset == '' ) {
					
							offset = parseInt( $( '#header' ).css( 'height' ), 10 );
							offset = -(offset);
						}
					} else {
						hash = '';
					}

					if ( url === '' ) {
						url = ajax_vars.home_url+'/';
					}

					if ( url !== window.location.href.split('#')[0] ) {
						
						window.location.href = url+hash;
						
					} else {
						if ( hash !== '' && hash !== '#' ) {
							var scroll_offset = $( hash ).offset().top + offset;
							$( 'html, body' ).animate({
								scrollTop: scroll_offset
							}, 900);
						}
					}
				}

				e.preventDefault();


	 		} );
	 		
		}


		/* Responsive navigation
	 	 ------------------------- */

		// Auto create responsive menu based on main navigation
		var 
			responsive_nav = $( '#nav' ).clone();

		// Remove dl menu
		$( '#slidemenu-content div ul' ).remove();

		// Add id
		$( '> ul', responsive_nav ).attr( 'id', 'responsive-menu' );
		$( 'ul:not(:first-child)', responsive_nav ).addClass( 'responsive-submenu' );

		// Remove main nav container 
		responsive_nav = responsive_nav.children( 'ul' );

		// Put menu in nav container
		$( '#slidemenu-content div' ).append( responsive_nav );

		// Add ScrollBar
		var slidemenu_scroll = new IScroll( '#slidemenu-content', {
		    mouseWheel: true,
		    interactiveScrollbars: true,
		    scrollbars: 'custom',
		    click: true
		});

		// Close Slide Menu bar before page loaded
		$( '#slidemenu ul a' ).on( 'click', function( e ){
			$( '#slidemenu' ).removeClass( 'is-visible' );
			$( '#slidemenu-layer' ).removeClass( 'is-visible' );
				
		});

		// Slide Menu Panel
		$( '#slidemenu-close, #slidemenu-layer' ).on( 'click', function( e ){
			e.preventDefault();
			$( '#slidemenu' ).removeClass( 'is-visible' );
			$( '#slidemenu-layer' ).removeClass( 'is-visible' );
		});
		$( '#nav-slidemenu' ).on( 'click', function( e ){
			e.preventDefault();
			$( '#slidemenu' ).addClass( 'is-visible' );
			$( '#slidemenu-layer' ).addClass( 'is-visible' );
		});


	})();

	
	/* Small Functions
	 ---------------------------------------------------------------------- */
	(function() {


		/* Slidebar
	 	 ------------------------- */
		if ( $( '#slidebar' ).length ) {

			var slidebar_scroll = new IScroll( '#slidebar-content', {
			    mouseWheel: true,
			    interactiveScrollbars: true,
			    scrollbars: 'custom',
			    click: true
			});

			$( '#slidebar-close, #slidebar-layer' ).on( 'click', function( e ){
				e.preventDefault();
				slidebar_scroll.refresh();
				$( '#slidebar' ).removeClass( 'is-visible' );
				$( '#slidebar-layer' ).removeClass( 'is-visible' );
			});
			$( '#nav-slidebar' ).on( 'click', function( e ){
				e.preventDefault();
				slidebar_scroll.refresh();
				$( '#slidebar' ).addClass( 'is-visible' );
				$( '#slidebar-layer' ).addClass( 'is-visible' );
			});
		}
	

		/* Masonry event hover effect
	 	 ------------------------- */
		$( document ).on('hover', '.event-brick', function(e){
			
			if ( e.type == 'mouseenter' ) {
    			$( this ).addClass( 'active' );
  			}
  			else if ( e.type == 'mouseleave' ) {
    			$( this ).removeClass( 'active' );
  			}
		});


		/* Search
	 	 ------------------------- */
		$( '#nav-search, .close-search' ).on( 'click', function(e){
			$( '#search-wrap' ).toggleClass( 'visible-search' );
			e.preventDefault();
		});


		/* Smooth Scroll
	 	 ------------------------- */
		$( document ).on( 'click', '.smooth-scroll',  function(e){
			var
				$offset = $( this ).data( 'offset' ),
				$id = $( this ).attr( 'href' );

			if ( $offset == undefined || $offset == '' ) {
				$offset = 0;
			} else if ( $offset == 'auto' ) {
				$offset = parseInt( $( '#header' ).css( 'height' ), 10 );
				$offset = -(offset);
			}

			// If element exists
			if ( $( $id ).length ) {
				var scroll_offset = $( $id ).offset().top + $offset;
				$( 'html, body' ).animate({
					scrollTop: scroll_offset
				}, 900);
			}
			e.preventDefault();
		});


	})();


	/* Ajax Actions
	 ---------------------------------------------------------------------- */
	(function() {

		if ( ajax_vars.ajaxed == 0 || window.location.href.indexOf( 'customize.php' ) > -1 ) return false;

		$.WPAjaxLoader({
   			home_url : ajax_vars.home_url,
			theme_uri : ajax_vars.theme_uri,
			dir : ajax_vars.dir,
			permalinks : ajax_vars.permalinks,
			ajax_async : ajax_vars.ajax_async,
			ajax_cache : ajax_vars.ajax_cache,
			ajax_events : ajax_vars.ajax_events,
			ajax_elements : ajax_vars.ajax_elements,
			content : '#ajax-content',
			excludes_links : ajax_vars.ajax_exclude_links,
			reload_scripts : ajax_vars.ajax_reload_scripts,
			loadStart : function() {

				// Close playlist 
				if ( $( '#scamp_player.sp-show-list' ).length ) {
					$( '#scamp_player' ).removeClass( 'sp-show-list' );
				}
				// Close Slidebar after page loaded
				if ( $( '#slidebar' ).length ) {
					$( '#slidebar' ).removeClass( 'is-visible' );
					$( '#slidebar-layer' ).removeClass( 'is-visible' );
				}

				// Remove HTML classes
				$( 'html' ).attr( 'class', '' );
			},
			loadEnd : function(){
				$( 'body' ).addClass( 'wp-ajax-loader' );

			}
		});

		$.WPAjaxLoader.init(function(){});
		
	})();

});