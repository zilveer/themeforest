/*
 * wpexEqualHeights v1.0
 *
 * Copyright 2016 WPExplorer.com
 */

( function ( $ ) {

	$.fn.wpexEqualHeights = function( options ) {

		var $items   = this,
			$window  = $( window ),
			$targets = null;

		// Options
		var $settings = $.extend( {
			children         : '',
			mobileBreakPoint : '',
			reset            : false
		}, options );

		// Return if no children found in DOM
		if ( ! $( $settings.children ).length ) return;

		// Function that sets heights
		function setHeights( el, reset ) {

			var $tallest  = 0;

			// Find and loop through target items
			if ( $settings.children ) {

				var $children = el.find( $settings.children ).not( '.vc_row.vc_inner .wpex-vc-column-wrapper' );

				// Loop through children
				$children.each( function() {

					var $child = $( this );

					// Reset height
					if ( reset ) {
						$child.css( 'height', '' );
					}

					// Get tallest item
					$height = $child.outerHeight();
					if ( $height > $tallest ) {
						$tallest = $height;
					}
					
				} );

				// Set height of children
				$children.css( 'height', $tallest +'px' ); 

			}

		}

		// Set heights on init
		$items.each( function() {
			var $this = $( this );
			$this.imagesLoaded( function() {
				setHeights( $this, false );
			} );
		} );

		// Update heights on resize
		$window.resize( function() {
			$items.each( function() {
				setHeights( $( this ), true );
			} );
		} );

		// Chaining?
		//return this;

	}

} ( jQuery ) );