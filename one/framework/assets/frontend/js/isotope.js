(function($) {
	"use strict";

	window.THB_Isotope = function( target, options ) {

		if( ! target.isotope ) {
			return;
		}

		var self = this;

		/**
		 * Target element.
		 *
		 * @type {jQuery}
		 */
		target = $(target);

		/**
		 * Isotope options.
		 *
		 * @type {Object}
		 */
		options = $.extend({
			/**
			 * Isotope options.
			 *
			 * @type {Object}
			 */
			isotope: {},

			/**
			 * Items removal callback.
			 *
			 * @type {Function}
			 */
			callbackRemove: null,

			/**
			 * Items insertion callback.
			 *
			 * @type {Function}
			 */
			callbackInsert: null,

			/**
			 * Style adjustments function.
			 *
			 * @return {Function}
			 */
			styleAdjust: function() {
				if ( window.thb_isotope_styleAdjust !== undefined ) {
					window.thb_isotope_styleAdjust();
				}
				else {
					if ( $("body").hasClass("thb-desktop") ) {
						$( "html" ).css( 'overflow-y', 'scroll' );
					}
				}
			},

			/**
			 * Items selector.
			 *
			 * @type {String}
			 */
			itemSelector: ".item",

			/**
			 * Filter.
			 *
			 * @type {THB_Filter|Boolean}
			 */
			filter: false,

			/**
			 * Transition time.
			 *
			 * @type {Integer}
			 */
			transition_time: 400
		}, options);

		/**
		 * Retrieve the list of items.
		 *
		 * @return {jQuery}
		 */
		this.getItems = function() {
			return target.find( options.itemSelector );
		};

		/**
		 * Filter the Isotope view.
		 *
		 * @param {String} filter
		 */
		this.filter = function( selector ) {
			var opts = options.isotope;
			opts.filter = selector;

			target.isotope( opts );
		};

		/**
		 * Inject new items into the Isotope view.
		 *
		 * @param {String} raw Raw HTML.
		 * @param {Function} callback
		 */
		this.insert = function( raw, callback ) {
			options.callbackInsert = callback;

			$( raw ).imagesLoaded( function() {
				setTimeout( function() {
					target.isotope( 'insert', $( raw ) );
				}, options.transition_time );
			} );
		};

		/**
		 * Remove all the items from the Isotope view.
		 *
		 * @param {Function} callback
		 */
		this.remove = function( callback ) {
			options.callbackRemove = callback;
			target.isotope( 'remove', this.getItems() );
		};

		/**
		 * Refresh the Isotope container.
		 */
		this.refresh = function() {
			target.isotope( 'layout' );
		}

		/**
		 * Initialize the Isotope container.
		 */
		options.styleAdjust();
		$( "body.thb-desktop" ).css( 'overflow-x', 'hidden' );

		$( target ).imagesLoaded( function() {
			var opts = options.isotope;
			opts.itemSelector = options.itemSelector;

			target.isotope( opts );

			$( target ).addClass( "thb-isotope" );

			target.isotope( 'on', 'layoutComplete', function() {
				if ( options.callbackInsert ) {
					setTimeout( function() {
						options.callbackInsert();
						options.callbackInsert = null;
					}, options.transition_time );
				}
			} );

			target.isotope( 'on', 'removeComplete', function() {
				if ( options.callbackRemove ) {
					setTimeout( function() {
						options.callbackRemove();
						options.callbackRemove = null;
					}, options.transition_time );
				}
			} );
		} );

	};

})(jQuery);