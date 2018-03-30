jQuery(document).ready(function($){

	var listifyMediaManager = {
		select: function(val, shortcode) {
			var shortcode = wp.shortcode.next( shortcode, val ),
				defaultPostId = wp.media.gallery.defaults.id,
				attachments, selection;

			// Bail if we didn't match the shortcode or all of the content.
			if ( ! shortcode ) {
				return;
			}

			// Ignore the rest of the match object.
			shortcode = shortcode.shortcode;

			if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) )
				shortcode.set( 'id', defaultPostId );

			if ( ! shortcode.attrs.named.ids ) {
				return;
			}

			if ( shortcode.attrs.named.ids.length == 0 ) {
				return;
			}

			attachments = wp.media.gallery.attachments( shortcode );
			selection = new wp.media.model.Selection( attachments.models, {
				props:    attachments.props.toJSON(),
				multiple: true
			});

			selection.gallery = attachments.gallery;

			// Fetch the query's attachments, and then break ties from the
			// query to allow for sorting.
			selection.more().done( function() {
				// Break ties with the query.
				selection.props.set({ query: false });
				selection.unmirror();
				selection.props.unset('orderby');
			});

			return selection;
		},
	}

	wp.media.listifyEditGallery = {

		frame: function() {
			var selection = listifyMediaManager.select($( '#listify_gallery_images' ).val(), 'gallery' );

			this._frame = wp.media({
				id:         'listifyGalleryFrame',
				frame:      'post',
				state:      'gallery-edit',
				editing:    true,
				multiple:   true,
				selection : selection
			});

			this._frame.on( 'update', function(selection) {
				$( '#listify_gallery_images' ).val( '[gallery ids=' + wp.media.gallery.shortcode( selection ).attrs.named.ids.join( ',' ) + ']' );
				$( '.listify-gallery-images' ).html( '' );

				selection.map( function( attachment ) {
					attachment = attachment.toJSON();

					if ( attachment.id ) {
						$( '.listify-gallery-images' ).append('\
							<li class="gallery-preview-image" style="background-image: url(' + attachment.sizes.thumbnail.url + ')" /></li>');
					}
				} );
			});

			return this._frame;
		},

		init: function() {
			$( '.listify-add-gallery-images .manage' ).click(function(e) {
				e.preventDefault();

				wp.media.listifyEditGallery.frame().open();
			});

			$( '.listify-add-gallery-images .remove' ).click(function(e) {
				e.preventDefault();

				$( '#listify_gallery_images' ).val( '[gallery ids=""]' );
				$( '.listify-gallery-images' ).html( '' );
			});
		}
	};

	$( wp.media.listifyEditGallery.init );

});