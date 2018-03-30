jQuery( document ).ready( function(e) {
	var $updateString = '<p><a href="https://theme-fusion.com/avada-doc/install-update/important-update-information/" target="_blank" rel="noopener noreferrer">Check Important Update Notes Before You Update</a><span style="padding:0 10px;">|</span><a href="https://theme-fusion.com/avada-documentation/changelog.txt" target="_blank" rel="noopener noreferrer">Check Changelog Here</a></p>';

   	jQuery( '#update-themes-table .plugin-title > p > strong' ).each( function() {
   		if ( 'Avada' == jQuery( this ).html() ) {
			jQuery( this ).parent().append( $updateString );
		}
	});


	jQuery( '.theme-browser .themes .theme' ).click( function() {
		setTimeout( function() {
			if ( jQuery( '.theme-overlay .theme-name' ).length ) {
				if ( -1 < jQuery( '.theme-overlay .theme-name' ).text().indexOf( 'Avada' ) ) {
					jQuery( '.theme-overlay .theme-info .notice > p > strong' ).append( $updateString );
				}
			}
		}, 10 );
	});
});
