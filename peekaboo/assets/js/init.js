/*jQuery.noConflict();*/
jQuery( document ).ready( function ($) {

	/*===================================================================================*/
	/*  Quickmenu
	 /*===================================================================================*/
	$( '#quickmenu' ).find( 'li' ).each( function (i) {
		$( this ).addClass( 'quickmenu-item-' + parseInt( 1 + i ) );
	} )

	/*===================================================================================*/
	/*	Scroll to Top
	 /*===================================================================================*/
	$( '#toTop' ).click( function () {
		$( 'body, html' ).animate( {scrollTop: 0}, 300 );
		return false;
	} );

	/*===================================================================================*/
	/*	Venobox
	 /*===================================================================================*/
	if ($().venobox) {

		$( '.pkb-modal' ).venobox();
	}

	/*===================================================================================*/
	/*	Isotope
	/*===================================================================================*/
	if ($().isotope) {

		$( function () {
			var $container = $( '#module-wrapper' ).imagesLoaded( function () {
					$container.isotope( {
						itemSelector: '.module'

					} );
				} ),

				$optionSets = $( '#filter-bar-container #filter-bar' ),
				$optionLinks = $optionSets.find( 'a' );

			$optionLinks.click( function () {
				var $this = $( this );
				// don't proceed if already selected
				if ($this.hasClass( 'selected' )) {
					return false;
				}
				var $optionSet = $this.parents( '#filter-bar' );
				$optionSet.find( '.selected' ).removeClass( 'selected' );
				$this.addClass( 'selected' );

				// make option object dynamically, i.e. { filter: '.my-filter-class' }
				var options = {},
					key = $optionSet.attr( 'data-option-key' ),
					value = $this.attr( 'data-option-value' );
				// parse 'false' as false boolean
				value = value === 'false' ? false : value;
				options[key] = value;
				if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
					// changes in layout modes need extra logic
					changeLayoutMode( $this, options )
				} else {
					// otherwise, apply new options
					$container.isotope( options );
				}

				return false;
			} );

		} );

	}

} );

(function ($) {
	$( window ).load( function (event) {
		$( '.reveal-modal' ).css( {
			"visibility": "hidden",
			"opacity"   : "0"
		} );
	} );
})( jQuery );