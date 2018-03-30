var TaxonomyImagesCreateAssociation;

jQuery( document ).ready( function( ) {
	var ID = 0, below;

	/* Get window that opened the thickbox. */
	below = window.dialogArguments || opener || parent || top;

	if ( null !== below && 'taxonomyImagesPlugin' in below ) {
		/* Set the value of ID. */
		if ( 'tt_id' in below.taxonomyImagesPlugin ) {
			ID = parseInt( below.taxonomyImagesPlugin.tt_id );
			if ( isNaN( ID ) ) {
				ID = 0;
			}
		}
		/* Replace term name. */
		if ( 'term_name' in below.taxonomyImagesPlugin ) {
			jQuery( '.create-association .term-name' ).html( TaxonomyImagesModal.termBefore + below.taxonomyImagesPlugin.term_name + TaxonomyImagesModal.termAfter );
		}
	}

	if ( 0 < ID ) {
		jQuery( 'body' ).addClass( 'taxonomy-images-modal' );

		var buttons = jQuery( '.taxonomy-images-modal .create-association' );

		/* Add hidden input to search form. */
		jQuery( '#filter' ).prepend( '<input type="hidden" name="taxonomy_images_plugin" value="' + ID + '" />' );

		if ( 'image_id' in below.taxonomyImagesPlugin ) {
			buttons.each( function( i, e ) {
				var image_id = jQuery( e ).parent().find( '.taxonomy-image-button-image-id' ).val();
				if ( image_id == below.taxonomyImagesPlugin.image_id ) {
					jQuery( e ).hide();
					jQuery( e ).parent().find( '.remove-association' ).css( 'display', 'inline' );
				}
			} );
		}
	}

	jQuery( '.taxonomy-images-modal .remove-association' ).live( 'click', function () {
		var button = jQuery( this );
		originalText = button.html();
		button.html( TaxonomyImagesModal.removing );

		jQuery.ajax( {
			url: ajaxurl,
			type: "POST",
			dataType: 'json',
			data: {
				'action'   : 'taxonomy_image_plugin_remove_association',
				'wp_nonce' : jQuery( this ).parent().find( '.taxonomy-image-button-nonce-remove' ).val(),
				'tt_id'    : ID
				},
			cache: false,
			success: function ( response ) {
				if ( 'good' === response.status ) {
					button.html( TaxonomyImagesModal.removed ).fadeOut( 200, function() {
						jQuery( this ).hide();
						var selector = parent.document.getElementById( 'taxonomy_image_plugin_' + ID );
						jQuery( selector ).attr( 'src', below.taxonomyImagesPlugin.img_src );
						jQuery( this ).parent().find( '.create-association' ).show();
						jQuery( this ).html( originalText );
					} );
				}
				else if ( 'bad' === response.status ) {
					alert( response.why );
				}
			}
		} );
		return false;
	} );

	jQuery( '.taxonomy-images-modal .create-association' ).live( 'click', function () {
		var button, selector, originalText;
		if ( 0 == ID ) {
			return;
		}

		button = jQuery( this );
		originalText = button.html();
		button.html( TaxonomyImagesModal.associating );

		jQuery.ajax( {
			url      : ajaxurl,
			type     : "POST",
			dataType : 'json',
			data: {
				'action'        : 'taxonomy_image_create_association',
				'wp_nonce'      : jQuery( this ).parent().find( '.taxonomy-image-button-nonce-create' ).val(),
				'attachment_id' : jQuery( this ).parent().find( '.taxonomy-image-button-image-id' ).val(),
				'tt_id'         : parseInt( ID )
				},
			success: function ( response ) {
				if ( 'good' === response.status ) {
					var parent_id = button.parent().attr( 'id' );

					/* Set state of all other buttons. */
					jQuery( '.taxonomy-image-modal-control' ).each( function( i, e ) {
						if ( parent_id == jQuery( e ).attr( 'id' ) ) {
							return true;
						}
						jQuery( e ).find( '.create-association' ).show();
						jQuery( e ).find( '.remove-association' ).hide();
					} );

					selector = parent.document.getElementById( 'taxonomy-image-control-' + ID );

					/* Update the image on the screen below */
					jQuery( selector ).find( '.taxonomy-image-thumbnail img' ).each( function ( i, e ) {
						jQuery( e ).attr( 'src', response.attachment_thumb_src );
					} );

					/* Show delete control on the screen below */
					jQuery( selector ).find( '.remove' ).each( function ( i, e ) {
						jQuery( e ).removeClass( 'hide' );
					} );

					button.show().html( TaxonomyImagesModal.success ).fadeOut( 200, function() {
						var remove = button.parent().find( '.remove-association' );
						if ( undefined !== remove[0] ) {
							jQuery( remove ).css( 'display', 'inline' );
							button.hide();
							button.html( originalText );
						}
					} );
				}
				else if ( 'bad' === response.status ) {
					alert( response.why );
				}
			}
		} );
		return false;
	} );
} );