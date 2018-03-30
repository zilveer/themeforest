/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

( function( api ) {
	var cssTemplate = wp.template( 'monarch-color-scheme' ),
		colorSchemeKeys = [
			'background_color',
			'panels_background_color',
			'main_hue',
			'light_main_hue',
			'light_panels_bg_color'
		],
		colorSettings = [
			'background_color',
			'panels_background_color',
			'main_hue'
		];

	api.controlConstructor.select = api.Control.extend( {
		ready: function() {
			if ( 'color_scheme' === this.id ) {
				this.setting.bind( 'change', function( value ) {
					// Update Background Color.
					api( 'background_color' ).set( colorScheme[value].colors[0] );
					api.control( 'background_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[0] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[0] );

					// Update Header/Sidebar Background Color.
					api( 'panels_background_color' ).set( colorScheme[value].colors[1] );
					api.control( 'panels_background_color' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[1] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[1] );

					// Update Header/Sidebar Text Color.
					api( 'main_hue' ).set( colorScheme[value].colors[2] );
					api.control( 'main_hue' ).container.find( '.color-picker-hex' )
						.data( 'data-default-color', colorScheme[value].colors[2] )
						.wpColorPicker( 'defaultColor', colorScheme[value].colors[2] );
				} );
			}
		}
	} );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api( 'color_scheme' )(), css,
			colors = _.object( colorSchemeKeys, colorScheme[ scheme ].colors );

		// Merge in color scheme overrides.
		_.each( colorSettings, function( setting ) {
			colors[ setting ] = api( setting )();
		});

		// Add additional colors.
		colors.light_main_hue = Color( colors.main_hue ).toCSS( 'rgba', 0.3 );
		colors.light_panels_bg_color = Color( colors.panels_background_color ).toCSS( 'rgba', 0.3 );

		css = cssTemplate( colors );

		api.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	_.each( colorSettings, function( setting ) {
		api( setting, function( setting ) {
			setting.bind( updateCSS );
		} );
	} );
} )( wp.customize );
