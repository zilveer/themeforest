( function( $ ) {

	'use strict';

	$( document ).ready( function($) {
		$( document ).ajaxSuccess( function( e, xhr, settings ) {
			var widget_id_base = 'wpex_fontawesome_social_widget';
			if ( settings.data.search( 'action=save-widget' ) != -1 && settings.data.search( 'id_base=' + widget_id_base) != -1 ) {
				stSortServices();
			}
			var widget_id_base2 = 'wpex_social_widget';
			if ( settings.data.search( 'action=save-widget' ) != -1 && settings.data.search( 'id_base=' + widget_id_base2) != -1 ) {
				stSortServices();
			}
		} );
		function stSortServices() {
			$( '.wpex-social-widget-services-list' ).each( function() {
				var id = $( this ).attr( 'id' );
				$( '#'+ id ).sortable( {
					placeholder : "placeholder",
					opacity     : 0.6
				} );
			} );
		}
		stSortServices();
	} );

} ) ( jQuery );