(function($) {
	var THB_FieldBackground = function( field ) {
		var overlay_display = field.find( "[name*='[overlay_display]']" ),
			overlay_color = field.find( ".thb-overlay-color" ),
			overlay_opacity = field.find( ".thb-overlay-opacity" ),
			overlay = field.find( ".thb-overlay" );

		overlay_color.minicolors({
			change: function( hex ) {
				overlay.css( "background-color", hex );
			}
		});

		// overlay_color.wpColorPicker({
		// 	"change": function( event, ui ) {
		// 		overlay.css( "background-color", overlay_color.wpColorPicker( 'color' ) );
		// 	}
		// });

		overlay_opacity.on( "change", function() {
			overlay.css( "opacity", overlay_opacity.val() );
		} );

		overlay_display.on( "change", function() {
			var checked = $( this ).attr( "value" );

			if ( checked == '1' ) {
				overlay.show();
			}
			else {
				overlay.hide();
			}
		} );

		overlay.css( "background-color", overlay_color.val() );
		overlay.css( "opacity", overlay_opacity.val() );
		overlay.css( "display", overlay_display.val() == '1' ? 'block' : 'none' );
	};

	$( window ).on( "thb_boot_fields", function( e, root ) {
		root.find( ".thb-field-one_background" ).each( function() {
			var field = new THB_FieldBackground( $( this ) );
		} );
	} );
})(jQuery);