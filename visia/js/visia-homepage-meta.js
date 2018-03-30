jQuery( window ).load( function() {

	if ( jQuery( 'label[for="pe_theme_meta_bg__type__0"]' ).hasClass( 'ui-state-active') ) {

		jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeIn(0);
		jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeOut(0);
		jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeOut(0);

	} else if ( jQuery( 'label[for="pe_theme_meta_bg__type__1"]' ).hasClass( 'ui-state-active') ) {

		jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeOut(0);
		jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeIn(0);
		jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeOut(0);

	} else {

		jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeOut(0);
		jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeOut(0);
		jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeIn(0);

	}

	jQuery( 'label[for="pe_theme_meta_bg__type__0"], label[for="pe_theme_meta_bg__type__1"], label[for="pe_theme_meta_bg__type__2"]' ).on( 'click', function(e) {

		if ( jQuery( 'label[for="pe_theme_meta_bg__type__0"]' ).hasClass( 'ui-state-active') ) {

			jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeIn(0);
			jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeOut(0);
			jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeOut(0);

		} else if ( jQuery( 'label[for="pe_theme_meta_bg__type__1"]' ).hasClass( 'ui-state-active') ) {

			jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeOut(0);
			jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeIn(0);
			jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeOut(0);

		} else {

			jQuery( '#pe_theme_meta_bg__gallery_' ).closest( '.option' ).fadeOut(0);
			jQuery( '#pe_theme_meta_bg__background_' ).closest( '.option' ).fadeOut(0);
			jQuery( '#pe_theme_meta_bg__video_' ).closest( '.option' ).fadeIn(0);

		}



	});


});