/**
 * Triggers an update of the accent color CSS when a color is changed.
 */

( function() {
	var cssTemplate = wp.template( 'flow-color-scheme' );

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var css, colors = {};
		
		colors[ 'accent_color' ] = wp.customize( 'flow_accent_color' )();
		css = cssTemplate( colors );
		wp.customize.previewer.send( 'update-color-scheme-css', css );
	}

	// Update the CSS whenever a color setting is changed.
	wp.customize( 'flow_accent_color', function( setting ) {
		setting.bind( updateCSS );
	} );

} )();
