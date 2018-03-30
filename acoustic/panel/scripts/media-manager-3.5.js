jQuery(document).ready(function($) {
	// Based on https://gist.github.com/4283059
	// also based on the original CSSIgniter script

	var ci_orig = new Object();
	window.ci_orig = ci_orig;

	// Store the original values.
	function ci_backup_send_attachment(){
		window.ci_orig_send_text = wp.media.view.l10n.insertIntoPost;
		window.ci_orig_send_attachment = wp.media.editor.send.attachment;
	}
	// This will be called *after* wp.media.editor.send.attachment has run.
	// Actually it will be called while it returns;
	function ci_restore_send_attachment(){
		wp.media.editor.send.attachment = window.ci_orig_send_attachment;
		wp.media.view.l10n.insertIntoPost = window.ci_orig_send_text;
		// Must not return anything other than implied void.
	}

	// All elements with class .ci-upload become buttons.
	// Use the '.uploaded' class in a *sibling* element to indicate the target field for the image URL.
	// Similarly, '.uploaded-id' is the target for the image ID
	// I.e. button: class="ci-upload" and input: class="uploaded"
	//$('.ci-upload').click(function(event){
	$('body').on('click', '.ci-upload', function(event){
		event.preventDefault();

		ci_backup_send_attachment();

		var button = $(this);
		var target_url = button.siblings('.uploaded');
		var target_id = button.siblings('.uploaded-id');
		
		// Replace the "Insert into [post|page]" button text.
		wp.media.view.l10n.insertIntoPost = ciMediaManager.tUseThisFile;

		// prop holds the info from "Attachment Display Settings" 
		// attachment holds info about the file, such as id, link, caption, etc
		wp.media.editor.send.attachment = function(props, attachment){
			// Assign the selected url to our target. That is, the appropriate url depending on the selected size.
			if(target_url.length > 0){
				// Handle images
				if(attachment.type == 'image') {
					if(typeof attachment.sizes != 'undefined') {
						// Generic case of resizable images
						// props.size holds the user-selected image size.
						target_url.val(attachment.sizes[props.size].url);						
					}
					else {
						// handle images without attachment.sizes set (e.g. icons)
						target_url.val(attachment.url);
					}

					/*
					// Example of specific mime subtype handler.
					else if(attachment.subtype == 'x-icon') {
						// handle .ico format (non-resizable, doesn't have attachment.sizes property
						target_url.val(attachment.url);
					}
					*/
				}
				else {
					// All other filetype cases
					target_url.val(attachment.url);
				}
			}

			// Assign the ID to our target.
			if(target_id.length > 0){
				target_id.val(attachment.id).trigger('change');
			}

			// It's important to restore original functionality.
			// Don't return anything other than implied void, otherwise it will get
			// appended in the editor. Even boolean false, gets added as string into the editor.
			return ci_restore_send_attachment();
		}
		
		var ci_editor = wp.media.editor.open(button);

		return false;
	});




	//
	// CSSIgniter Featured Galleries
	//
	function ci_featgal_backup_functions(){
		window.ci_orig.wp_media_editor_add = wp.media.editor.add;
		window.ci_orig.wp_media_view_l10n_createNewGallery = wp.media.view.l10n.createNewGallery;
		window.ci_orig.wp_media_view_l10n_insertGallery = wp.media.view.l10n.insertGallery;
	}
	function ci_featgal_restore_functions(){
		wp.media.editor.add = window.ci_orig.wp_media_editor_add;
		wp.media.view.l10n.createNewGallery = window.ci_orig.wp_media_view_l10n_createNewGallery;
		wp.media.view.l10n.insertGallery = window.ci_orig.wp_media_view_l10n_insertGallery;
	}

	// Constructs a comma separated list of image IDs, from the currently visible images within the preview area.
	// Also updates the hidden input with the list.
	// Useful for when the user removes or re-arranges images.
	function ci_featgal_UpdateIDs( preview_element )
	{
		var ids = [];
		$(preview_element).children('.thumb').children('img').each(function(){
			ids.push( $(this).data('img-id') );
		});
		
		preview_element.siblings('.ci-upload-to-gallery-ids').val( ids.join(',') );
	}

	// Retrieves a JSON list of IDs and URLs via AJAX, and updates the preview area of the passed gallery container element. 
	function ci_featgal_AJAXUpdate( gallery_container )
	{
		var target_ids = gallery_container.children('.ci-upload-to-gallery-ids');
		var target_preview = gallery_container.children('.ci-upload-to-gallery-preview');

		$.ajax({
			type: "post",
			url: ciMediaManager.ajaxurl,
			data: {
				action: 'ci_featgal_AJAXPreview',
				ids: target_ids.val(),
			},
			dataType: "text",
			beforeSend: function() {
				target_preview.empty().html('<p>'+ ciMediaManager.tLoading +'</p>');
			}, 
			success: function(response){ 

				if(response == 'FAIL')
				{
					target_preview.empty().html('<p>'+ ciMediaManager.tPreviewUnavailable +'</p>');
				}
				else
				{
					// Our response is an object whose properties are key-value pairs.
					// Since JSON doesn't support named keys in arrays, we can't get an
					// array whose keys are IDs and values are URLS.
					// If we do, the keys are sorted numerically and original ordering is lost.
					response = $.parseJSON( response );

					target_preview.empty();
					$.each(response, function(key, value){
						$('<div class="thumb"><img src="'+value.url+'" data-img-id="'+value.id+'"><a href="#" class="close media-modal-icon" title="'+ ciMediaManager.tRemoveFromGallery +'"></a></div>').appendTo( target_preview );
					});
				}
			}//success	
		});//ajax		
		
	}

	// Update the preview areas of all galleries, when the page loads.
	//var post_galleries = $('.ci-media-manager-gallery');
	//if( post_galleries.length > 0 )
	//{
	//	post_galleries.each(function(){
	//		ci_featgal_AJAXUpdate( $(this) );
	//	});
	//}

	// Handle removal of images from the preview area.
	$('body').on('click', '.ci-media-manager-gallery .thumb a.close', function(event){
		event.preventDefault();

		// Store a reference to .ci-media-manager-gallery as we'll not be able to find it later
		// since we are deleting the parent .thumb and we are be able to traverse upwards.
		var container = $(this).parent().parent();

		$(this).parent().remove();

		ci_featgal_UpdateIDs( container );
	});
	
	// Handle re-arranging of images in preview areas.
	var preview_areas = $('.ci-upload-to-gallery-preview');
	if( preview_areas.length > 0 )
	{
		preview_areas.sortable({
			update: function(event, ui){
				ci_featgal_UpdateIDs( $(this) );
			}
		});
	}

	// This is the workhorse function of the featured galleries.
	// Exploits the functionality already provided by the WordPress media manager,
	// by fooling it into thinking that our gallery is a native gallery shortcode.
	$('body').on('click', '.ci-upload-to-gallery', function(event){
		event.preventDefault();

		ci_featgal_backup_functions();
	
		var button = $(this);
		var target_parent = button.parents('.ci-media-manager-gallery');
		var target_ids = button.siblings('.ci-upload-to-gallery-ids');
		var target_rand = button.siblings('p').find('.ci-upload-to-gallery-random > input[type="checkbox"]');

		// Replace the create/update gallery button texts.
		wp.media.view.l10n.insertGallery = ciMediaManager.tUpdateGallery;


		// Check if the `wp.media.gallery` API exists.
		if ( typeof wp === 'undefined' || ! wp.media || ! wp.media.gallery )
			return;

		var gallery = wp.media.gallery,
			frame;

		// If there are no IDs, set to 0 so that the built-in WordPress shortcode won't complain.
		var ids = target_ids.val();
		if( ids.length == 0 )
			ids = '0';

		var rand = target_rand.prop("checked") == true ? 'orderby="rand"' : '';

		// Construct the shortcode that the media manager will read.
		frame = gallery.edit( '[gallery ids="' + ids + '" ' + rand + ' ]' );

		// Handle what happens when the media manager's "Update gallery" button is pressed.
		frame.state('gallery-edit').on( 'update', function( attachments ) {

			var props = attachments.props.toJSON(),
				attrs = _.pick( props, 'orderby', 'order' ),
				shortcode, clone;

			if ( attachments.gallery )
				_.extend( attrs, attachments.gallery.toJSON() );

			// Convert all gallery shortcodes to use the `ids` property.
			// Ignore `post__in` and `post__not_in`; the attachments in
			// the collection will already reflect those properties.
			attrs.ids = attachments.pluck('id');

			// Check if the gallery is randomly ordered.
			if ( attrs._orderbyRandom )
			{
				attrs.orderby = 'rand';
				target_rand.prop("checked", true);
			}
			else
			{
				target_rand.removeProp("checked");
			}
			delete attrs._orderbyRandom;

			// Create a csv list of image IDs into the hidden input.
			target_ids.val( attrs.ids.join(',') );

			// Update the preview area.
			ci_featgal_AJAXUpdate( target_parent );

		}, this );

		// It's important to restore original functionality.
		// Don't return anything other than implied void, otherwise it will get
		// appended in the editor. Even boolean false, gets added as string into the editor.
		ci_featgal_restore_functions();

	});



	//
	// The following code opens the media manager directly on the Create Gallery page,
	// and returns the list of image IDs into a field.
	// There probably is an easier way to achieve this, using
	// this method: https://github.com/thomasgriffin/New-Media-Image-Uploader/blob/master/js/media.js
	//
	// Consider the following code incomplete, buggy, and probably just wrong.
	//
/*
	$('body').on('click', '.ci-upload-to-gallery-create', function(event){
		event.preventDefault();

		ci_featgal_backup_functions();

		var button = $(this);

		var target_ids = button.siblings('.ci-upload-to-gallery-ids');
		var target_rand = button.siblings('.ci-upload-to-gallery-random').children('input[type="checkbox"]');
		
		// Replace the "Insert into [post|page]" button text.
		// We better internationalize this string with wp_localize_script();
		wp.media.view.l10n.createNewGallery = 'Insert images into gallery';
		wp.media.view.l10n.insertGallery = 'Update gallery';

		// prop holds the info from "Attachment Display Settings" 
		// attachment holds info about the file, such as id, link, caption, etc
		wp.media.editor.add = function(id, options){

			var workflows = {};

			var workflow = this.get( id );

			if ( workflow ) // only add once: if exists return existing
				return workflow;

			workflow = workflows[ id ] = wp.media( _.defaults( options || {}, {
				frame:    'post',
				state:    'insert',
				title:    wp.media.view.l10n.addMedia,
				multiple: true
			} ) );

			workflow.on( 'insert', function( selection ) {
				var state = workflow.state();

				selection = selection || state.get('selection');

				if ( ! selection )
					return;

				$.when.apply( $, selection.map( function( attachment ) {
					var display = state.display( attachment ).toJSON();
					return this.send.attachment( display, attachment.toJSON() );
				}, this ) ).done( function() {
					wp.media.editor.insert( _.toArray( arguments ).join("\n\n") );
				});
			}, this );

			workflow.state('gallery-edit').on( 'update', function( attachments ) {

				var props = attachments.props.toJSON(),
					attrs = _.pick( props, 'orderby', 'order' ),
					shortcode, clone;

				if ( attachments.gallery )
					_.extend( attrs, attachments.gallery.toJSON() );

				// Convert all gallery shortcodes to use the `ids` property.
				// Ignore `post__in` and `post__not_in`; the attachments in
				// the collection will already reflect those properties.
				attrs.ids = attachments.pluck('id');

				// Check if the gallery is randomly ordered.
				if ( attrs._orderbyRandom )
				{
					attrs.orderby = 'rand';
					target_rand.prop("checked", true);
				}
				else
				{
					target_rand.removeProp("checked");
				}
				delete attrs._orderbyRandom;

				target_ids.val( attrs.ids.join(',') );

			}, this );

			workflow.setState( workflow.options.state );

			// It's important to restore original functionality.
			// Don't return anything other than implied void, otherwise it will get
			// appended in the editor. Even boolean false, gets added as string into the editor.
			ci_featgal_restore_functions();

			return workflow;

		}

		var options = {
			frame:    'post',
			state:    'gallery',
			title:    wp.media.view.l10n.createGalleryTitle,
			multiple: true
		};

		var ci_editor = wp.media.editor.open(button, options);

		return false;
	});
*/


});
