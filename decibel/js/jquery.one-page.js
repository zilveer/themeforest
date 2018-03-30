/*!
 * One Page
 *
 */
/* jshint -W062 */
var WolfThemeOnePageUi =  WolfThemeOnePageUi || {},
	WolfThemeParams =  WolfThemeParams || {},
	console = console || {};

WolfThemeOnePageUi = function( $ ) {

	'use strict';

	return {

		/**
		 * Init UI
		 */
		init : function () {

			var _this = this;

			$( 'body' ).addClass( 'one-paged' );
			this.replaceHref();

			/**
			 * Scroll event
			 */
			$( window ).scroll( function() {
				_this.setActiveMenuItem( $( window ).scrollTop() );
			} );
		},

		/**
		 * Set active menu item for one page menu
		 */
		setActiveMenuItem : function ( scrollTop ) {

			var menuItems = $( '.main-navigation a' ),
				href, hash,
				menuItem,
				$section,
				sectionTop,
				sectionBottom,
				threshold = 150, i;

			for ( i = 0; i < menuItems.length; i++ ) {

				menuItem = $( menuItems[ i ] );

				if ( menuItem.hasClass( 'scroll' ) ) {

					href = menuItem.attr( 'href' );

					if ( href.indexOf( '#' ) !== -1 ) {

						hash = href.substring( href.indexOf( '#' ) + 1 );

						if ( $( '#' + hash ).length ) {

							$section = $( '#' + hash );
							sectionTop = $section.offset().top;
							sectionBottom = sectionTop + $section.height();

							if ( scrollTop < $( '#main' ).offset().top - threshold ) {

								menuItems.parents( 'li' ).removeClass( 'active' );

							} else {
								if ( scrollTop > sectionTop - threshold && scrollTop < sectionBottom - threshold ) {
									menuItems.parents( 'li' ).removeClass( 'active' );
									menuItem.parents( 'li' ).addClass( 'active' );
								}
							}
						}
					}
				}
			}
		},

		replaceHref : function () {

			var i, menuItems = $( '.main-navigation a' ),
				href,
				menuItem;

			for ( i = 0; i < menuItems.length; i++ ) {
				menuItem = $( menuItems[ i ] );

				if ( menuItem.hasClass( 'scroll' ) ) {

					href = menuItem.attr( 'href' );

					if ( href.indexOf( '#' ) !== -1 ) {
						href.replace( /(.*)\#/, '' );
						menuItem.attr( 'href', WolfThemeParams.onePagePage + href );
					}
				}
			}
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		if ( WolfThemeParams.onePageMenu ) {
			WolfThemeOnePageUi.init();
		}
	} );

} )( jQuery );
