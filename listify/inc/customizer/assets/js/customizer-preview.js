/* global wp, jQuery */
(function($, wp, listifyCustomizerPreview){

	var _window = $(window),
		api = wp.customize;

	if ( ! listifyCustomizerPreview ) {
		return;
	}

	// Add some base methods
	listifyCustomizerPreview = $.extend( listifyCustomizerPreview, {
		//
	} );

	/**
	 * Handle style controls. This includes anything that
	 * outputs custom styles inline via `listify_output_customizer_css`
	 *
	 * @since 1.7.0
	 */
	listifyCustomizerPreview = $.extend( listifyCustomizerPreview, {
		styleControls: {},

		initStyles: function() {
			var self = listifyCustomizerPreview;

			// bind all style controls to our updates
			_.each( self.getStyleControls(), function( value, settingId ) {
				api( settingId, function( setting ) {
					setting.bind( self.retrieveStyles );
				} );
			} );
		},

		/**
		 * Update styles dynamically.
		 *
		 * @since 1.7.0
		 */
		retrieveStyles: function() {
			var self = listifyCustomizerPreview;

			var updatedStyleControls = {};

			_.each( self.getStyleControls(), function( value, settingId ) {
				api( settingId, function( setting ) {
					updatedStyleControls[ settingId ] = setting();
				} );
			});

			var data = {
				'listify-style-controls': updatedStyleControls
			}

			wp.ajax.post( 'listify-customizer-css', data ).done( function( response ) {
				if( response.success !== false ) {
					self.replaceStyles( response );
				}
			} );
		},

		/**
		 * Update the styles in the document
		 *
		 * @since 1.7.0
		 */
		replaceStyles: function( styles ) {
			selector = 'listify-inline-css';

			$( '#' + selector ).remove();

			$( '<div>', {
				id: selector,
				html: '&shy;<style>' + styles + '</style>',
			} ).appendTo( 'body' );
		},

		/**
		 * Out out all active controls, find the ones that relate to CSS.
		 * This is pretty basic and hacky at the moment, and shuold be made more
		 * dynamic in the future.
		 *
		 * @since 1.7.0
		 */
		getStyleControls: function() {
			var self = listifyCustomizerPreview;

			if ( self.styleControls > 1 ) {
				return self.styleControls;
			}

			var extras = [ 
				'background_color', 
				'header_textcolor', 
				'content-box-style', 
				'content-button-style',
				'nav-secondary'
			];

			_.each( api.settings.values, function( value, key ) {
				if( 
						key.match(/color\-/i) || 
						key.match(/typography\-/i) ||
						extras.indexOf( key ) != -1 &&
						! key.match( /\-font\-family/i )
					) { 
					self.styleControls[ key ] = value;
				}
			});

			return self.styleControls;
		}
	} );

	/**
	 * Update the loaded Google Fonts so the updated CSS 
	 * can be utilize properly.
	 *
	 * @since 1.7.0
	 */
	listifyCustomizerPreview = $.extend( listifyCustomizerPreview, {
		typeControls: {},

		initFonts: function() {
			var self = listifyCustomizerPreview;

			// bind all style controls to our updates
			_.each( self.getTypeControls(), function( value, settingId ) {
				api( settingId, function( setting ) {
					setting.bind( self.retrieveFontJson );
				} );
			} );
		},

		/**
		 * Get the JSON we can pass to WebFont
		 *
		 * @since 1.7.0
		 */
		retrieveFontJson: function() {
			var self = listifyCustomizerPreview;

			var updatedTypeControls = {};

			_.each( self.getTypeControls(), function( value, settingId ) {
				api( settingId, function( setting ) {
					updatedTypeControls[ settingId ] = setting();
				} );
			});

			var data = {
				'listify-type-controls': updatedTypeControls
			}

			wp.ajax.post( 'listify-customizer-webfont', data ).done( function( response ) {
				if( response.success !== false ) {
					WebFont.load( response );
				}
			} );
		},

		/**
		 * Out out all active controls, find the ones that load a font family.
		 * This is pretty basic and hacky at the moment, and shuold be made more
		 * dynamic in the future.
		 *
		 * @since 1.7.0
		 */
		getTypeControls: function() {
			var self = listifyCustomizerPreview;

			if ( self.typeControls > 1 ) {
				return self.typeControls;
			}

			_.each( api.settings.values, function( value, key ) {
				if( key.match( /\-font\-family/i ) ) { 
					self.typeControls[ key ] = value;
				}
			});

			return self.typeControls;
		}
	} );

	/**
	 * Update the Google Map dynamically if possible.
	 *
	 * @since 1.7.0
	 */
	listifyCustomizerPreview = $.extend( listifyCustomizerPreview, {
		initMap: function() {
			var self = listifyCustomizerPreview;

			api( 'map-appearance-scheme', function( setting ) {
				setting.bind( self.updateScheme );
			} );
		},

		/**
		 * Get the new JSON to pass to the map.
		 *
		 * @since 1.7.0
		 */
		updateScheme: function() {
			var self = listifyCustomizerPreview;
			var setting = api( 'map-appearance-scheme' );

			if ( ! _.isUndefined( wp.listify.archive.map ) ) {
				var data = {
					'scheme': setting.get()
				}

				wp.ajax.post( 'listify-customizer-map-scheme', data ).done( function( response ) {
					if ( false !== response.success ) {
						wp.listify.archive.map.setOptions( response );
					}
				} );
			}
		}
	} );

	$(document).ready(function() {
		listifyCustomizerPreview.initFonts();
		listifyCustomizerPreview.initStyles();
		listifyCustomizerPreview.initMap();
	});

	// fixed header
	api( 'fixed-header', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).toggleClass( 'fixed-header', to );
		});
	});

	// secondary nav menu
	api( 'nav-secondary', function( value ) {
		value.bind( function( to ) {
			$( '.nav-menu.secondary' ).toggle( to );
		});
	});
	
	// selective refresh
	_window.load( function() {
		var isCustomizeSelectiveRefresh = ( 'undefined' !== typeof wp && wp.customize && wp.customize.selectiveRefresh );

		if ( ! isCustomizeSelectiveRefresh ) {
			return;
		}

		// update salvattore
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function() {
			$.each( $( 'div[data-columns]' ), function() {
				if ( ! $(this).data( 'columns' ) ) {
					salvattore[ 'registerGrid' ]( this );
				}
			} );
		} );

		// update single listing map
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( partial ) {
			if ( wp.listify && wp.listify.listing ) {
				wp.listify.listing.map();
			}
		} );

		// update single listing slider
		wp.customize.selectiveRefresh.bind( 'partial-content-rendered', function( partial ) {
			if ( wp.listify && wp.listify.listing ) {
				wp.listify.listing.gallerySlider();
			}
		} );
	} );

})(jQuery, wp, listifyCustomizerPreview);
