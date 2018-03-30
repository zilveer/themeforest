/*global jQuery, document, avadaredux*/

(function( $ ) {
	'use strict';

	avadaredux.field_objects = avadaredux.field_objects || {};
	avadaredux.field_objects.ace_editor = avadaredux.field_objects.ace_editor || {};

	avadaredux.field_objects.ace_editor.init = function( selector ) {
		if ( ! selector ) {
			selector = $( document ).find( '.avadaredux-group-tab:visible' ).find( '.avadaredux-container-ace_editor:visible' );
		}

		$( selector ).each( function() {
			var el     = $( this ),
			    parent = el;

			if ( ! el.hasClass( 'avadaredux-field-container' ) ) {
				parent = el.parents( '.avadaredux-field-container:first' );
			}
			if ( parent.is( ':hidden' ) ) { // Skip hidden fields
				return;
			}
			if ( parent.hasClass( 'avadaredux-field-init' ) ) {
				parent.removeClass( 'avadaredux-field-init' );
			} else {
				return;
			}

			el.find( '.ace-editor' ).each( function( index, element ) {
				var area      = element,
				    params    = JSON.parse( $( this ).parent().find( '.localize_data' ).val() ),
				    editor    = $( element ).attr( 'data-editor' ),
				    aceeditor = ace.edit( editor ),
				    parent    = '';

				aceeditor.setTheme( 'ace/theme/chrome' );
				aceeditor.getSession().setMode( 'ace/mode/' + $( element ).attr( 'data-mode' ) );

				if ( el.hasClass( 'avadaredux-field-container' ) ) {
					parent = el.attr( 'data-id' );
				} else {
					parent = el.parents( '.avadaredux-field-container:first' ).attr( 'data-id' );
				}

				aceeditor.setOptions( params );
				aceeditor.on(
					'change', function( e ) {
						$( '#' + area.id ).val( aceeditor.getSession().getValue() );
						avadaredux_change( $( element ) );
						aceeditor.resize();
					}
				);
			});
		});
	};
})( jQuery );
