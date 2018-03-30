( function( $ ) {
	$( document ).ready( function() {

		$( 'body' ).on( 'click', '.thb-like', function() {
			if ( $( this ).hasClass( "thb-liked" ) ) {
				return false;
			}

			var button = $( this ),
				post_id = button.attr( 'data-post-id' ),
				nonce = button.attr( 'data-nonce' ),
				likes_count = button.find( '.thb-likes-count' ),
				data = {
					"post_id": post_id,
					"action": "thb_like",
					"THB_nonce": nonce
				};

			button.addClass( "thb-liking" );

			$.post( thb_system.ajax_url, data, function( updated_count ) {
				if ( updated_count !== "" ) {
					button.removeClass( "thb-liking" );
					button.addClass( "thb-liked" );
					likes_count.html( updated_count );
				}
			} );

			return false;
		} );

	} );
} )( jQuery );