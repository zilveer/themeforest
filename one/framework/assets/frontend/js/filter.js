(function($) {
	"use strict";

	window.THB_Filter = function( target, options ) {

		var self = this;

		/**
		 * Target element.
		 *
		 * @type {jQuery}
		 */
		target = $(target);

		/**
		 * Filter options.
		 *
		 * @type {Object}
		 */
		options = $.extend({
			/**
			 * True if elements can be filtered by one criteria at a time.
			 *
			 * @type {Boolean}
			 */
			individual: true,

			/**
			 * Filter controls.
			 *
			 * @type {jQuery|String|Boolean}
			 */
			controls: false,

			/**
			 * Filter controls "on" class.
			 *
			 * @type {String}
			 */
			controlsOnClass: "on",

			/**
			 * Items selector.
			 *
			 * @type {String}
			 */
			itemSelector: ".item",

			/**
			 * Visible items class.
			 *
			 * @type {String}
			 */
			visibleClass: "visible",

			/**
			 * Hidden items class.
			 *
			 * @type {String}
			 */
			hiddenClass: "hidden",

			/**
			 * Filter reset.
			 */
			reset: function() {
				self.getItems().removeClass( options.visibleClass + " " + options.hiddenClass );
			},

			/**
			 * Check if the filter can run.
			 *
			 * @return {Boolean}
			 */
			filterCheck: function() {
				return true;
			},

			/**
			 * Filtering action.
			 *
			 * @return {String}
			 */
			filter: function() {
				options.reset();

				var selector = self.getSelector();

				if ( selector !== "" ) {
					self.getItems().filter( selector ).addClass( options.visibleClass );
					self.getItems().not( selector ).addClass( options.hiddenClass );
				}

				return selector;
			}
		}, options);

		/**
		 * Retrieve the list of items to be filtered.
		 *
		 * @return {jQuery}
		 */
		this.getItems = function() {
			return target.find( options.itemSelector );
		};

		/**
		 * Retrieve the current selector value.
		 *
		 * @return {String}
		 */
		this.getSelector = function() {
			return this.selector.join( "" );
		};

		/**
		 * The filter selector.
		 *
		 * @type {Array}
		 */
		this.selector = [];

		/**
		 * Reset the filter.
		 */
		this.reset = function() {
			this.run("");

			if( options.controls !== false ) {
				$(options.controls).find("[data-filter]").removeClass(options.controlsOnClass);
				$(options.controls).find("[data-filter='']").addClass(options.controlsOnClass);
			}
		};

		/**
		 * Perform the filtering action.
		 *
		 * @param {String} filter
		 */
		this.run = function( filter ) {
			if( filter !== undefined ) {
				this.prepareSelector( filter );
			}

			options.filter( this.getSelector() );
		};

		/**
		 * Prepare the selector for the filtering.
		 *
		 * @param {String} filter
		 */
		this.prepareSelector = function( filter ) {
			if( filter === "" ) {
				self.selector = [];
			}
			else {
				var dataFilter = "[data-filter-" + filter + "]",
					index = $.inArray(dataFilter, self.selector);

				if( options.individual ) {
					self.selector = [];
				}

				if( index === -1 ) {
					self.selector.push( dataFilter );
				}
				else {
					self.selector.splice( index, 1 );
				}
			}

			return this.getSelector();
		};

		/**
		 * Initialize the filter.
		 */
		if( options.controls !== false ) {
			var filterItems = $(options.controls).find("[data-filter]"),
				filterResetItem = filterItems.filter("[data-filter='']");

			filterItems.on("click", function() {
				if ( ! options.filterCheck() ) {
					return false;
				}

				var data = $(this).data("filter");

				if( data === "" ) {
					self.reset();
				}
				else {
					if( self.prepareSelector(data) === "" ) {
						self.reset();
					}
					else {
						self.run();

						filterResetItem.removeClass(options.controlsOnClass);

						if( options.individual ) {
							filterItems.not( $(this) ).removeClass(options.controlsOnClass);
						}

						$(this).toggleClass(options.controlsOnClass);
					}
				}

				return false;
			});
		}

	};

})(jQuery);