(function($) {
	"use strict";

	window.THB_Lightbox = function() {

		/**
		 * Images in galleries.
		 *
		 * @type {string}
		 */
		this.galleriesSelector = ".thb-gallery, .gallery, .thb-images-container, .tiled-gallery";

		/**
		 * Images.
		 *
		 * @type {string}
		 */
		this.imagesSelector = '.thb-lightbox[href*=".jpg"],.thb-lightbox[href*=".png"],.thb-lightbox[href*=".gif"],.thb-lightbox[href*=".jpeg"],.hentry a[href*=".jpg"],.hentry a[href*=".png"],.hentry a[href*=".gif"],.hentry a[href*=".jpeg"]';
		this.imagesSelector = this.imagesSelector.replace( /,/g, ':not(.nothumb),' );
		this.imagesSelector += ':not(.nothumb)';

		/**
		 * Initialize the lightbox component.
		 */
		this.init = function( target ) {
			this["galleries"] = $( this.galleriesSelector, target );
			this["images"] = $( this.imagesSelector, target ).not( this.galleries.find("a") );
		};

		/**
		 * Add new elements to the target set.
		 *
		 * @param {jQuery|string} new_elements
		 */
		this.add = function( new_elements ) {
			new_elements = $(new_elements);

			this["images"] = this["images"].add( new_elements );
		};

	};
})(jQuery);