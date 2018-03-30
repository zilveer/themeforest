/*!
 * Masonry Gallery
 *
 */

var WolfThemeGallery = WolfThemeGallery || {};

/* jshint -W062 */
WolfThemeGallery = function ( $ ) {

	'use strict';

	return {

		init : function () {
			this.addOverlay();
			this.masonry();
		},

		addOverlay : function () {
			$( '.masonry-gallery ul li a' ).append( '<span class="gallery-item-overlay" />' );
		},

		masonry : function () {
			var $gallery = $( '.masonry-gallery ul' );

			$gallery.imagesLoaded( function() {
				$gallery.isotope( {
					itemSelector : '.masonry-gallery ul li',
					layout : 'masonry'
				} );
			} );
		}
	};

}( jQuery );

;( function( $ ) {

	'use strict';

	$( document ).ready( function() {
		WolfThemeGallery.init();
	} );
	
} )( jQuery );