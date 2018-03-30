(function($){
gallerySort = {
//	var gallerySortable, gallerySortableInit, desc = false;

	// get_selected_media(document.posts-filter.list)
	init : function() { // gallerySortableInit
		gallerySortable = $('#the-list').sortable( {
			items: 'tr',
			placeholder: 'sorthelper',
			axis: 'y',
			distance: 2
		} );
	},

	hidden : function(name, value, f) {
		  $('<input>').attr({
			  type: 'hidden',
			  name: name,
			  id: name,
			  value: value
		  }).appendTo(f);
	},

	getMedia : function(gName, lName) {
		var l = $('#' + lName); // image list
		var g = $('#' + gName); // gallery object

		$('input[name="media[]"]', l).each(function() { 
			shibaMediaForm.hidden('media[]', $(this).val(), g);
		});
	}
};


// Object for creating WordPress 3.5 media upload menu 
// for adding ids within a gallery object
wp.media.shibaMlibEditGallery = {
	
	frame: function() {
		if ( this._frame )
			return this._frame;

		var selection = this.select();
		this._frame = wp.media({
			id:			'my-frame',				   
			frame:     	'post',
			state:     	'gallery-edit',
			title:     	wp.media.view.l10n.editGalleryTitle,
			editing:   	true,
			multiple:  	true,
			selection: 	selection
		});

		var controller = this._frame.states.get('gallery-edit');

		// Turn off sortable
		controller.set('sortable', false);

		// Turn off refreshContent callback so we do not throw a null error on 
		// frame.router.get()
		controller.get('selection').on( 'remove reset', function() {
			var controller = wp.media.shibaMlibEditGallery._frame.states.get('gallery-edit');
			this.off('remove reset', controller.refreshContent, controller);
		});

		// Don't display gallery settings
		controller.frame.on( 'content:create', function() {
			var controller = wp.media.shibaMlibEditGallery._frame.states.get('gallery-edit');

			controller.frame.off( 'content:render:browse', controller.gallerySettings, controller );
		});
											 
		this._frame.on( 'update', 
					   function() {
			var controller = wp.media.shibaMlibEditGallery._frame.states.get('gallery-edit');
			var library = controller.get('library');
			// Need to get all the attachment ids for gallery
			var ids = library.pluck('id');

//				console.log(ids);
			// send ids to server
			wp.media.post( 'shiba-mlib-gallery-update', {
				nonce:  	wp.media.view.settings.post.nonce, 
				html:   	wp.media.shibaMlibEditGallery.link,
				post_id: 	wp.media.view.settings.post.id,
				ids: 		ids
			}).done( function() {
				window.location = wp.media.shibaMlibEditGallery.link;
			});

			// Turn off refreshContent callback so we do not throw a null error 
			controller.off('reset'); 
			
		});

		return this._frame;
	},


	// Gets initial gallery-edit images. Function modified from wp.media.gallery.edit
	// From wp-includes/js/media-editor.js.source.html
	select: function() {
		var shortcode = wp.shortcode.next( 'gallery', wp.media.view.settings.shibaMlib.shortcode ),
			defaultPostId = wp.media.gallery.defaults.id,
			attachments, selection;

		// Bail if we didn't match the shortcode or all of the content.
		if ( ! shortcode )
			return;

		// Ignore the rest of the match object.
		shortcode = shortcode.shortcode;

		if ( _.isUndefined( shortcode.get('id') ) && ! _.isUndefined( defaultPostId ) )
			shortcode.set( 'id', defaultPostId );

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

	init: function() {
		$('#upload-and-attach-link').click( function( event ) {
			var $el = $(this);
			wp.media.shibaMlibEditGallery.link = $el.data('updateLink');
			event.preventDefault();

			wp.media.shibaMlibEditGallery.frame().open();

		});
		
	}
	
	
}; 
	
$(document).ready(function(){
	// initialize sortable
	gallerySort.init();
	
	$('#submitdiv #publish, #submitdiv #save-post').click(function(e) {
		gallerySort.getMedia('post', 'gallery-list');
	});
	
	$( wp.media.shibaMlibEditGallery.init );
});


})(jQuery);