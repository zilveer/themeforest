var themeGalleryGetImage,themeGalleryGetAllImages,themeGalleryCompleteEditImage,themeGalleryDeleteImage,themeGalleryImagesSetIds;
(function($){

themeGalleryGetImage = function(attachment_id){
	jQuery.post(ajaxurl, {
		action:'theme-gallery-get-image',
		id: attachment_id, 
		cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( 'Could not insert into gallery. Try a different attachment.' );
		} else {
			jQuery("#images_sortable").append(str);
			themeGalleryImagesSetIds();
		}
	});
	//var field = $('input[value=_thumbnail_id]', '#list-table');
	//if ( field.length > 0 ) {
	//	$('#meta\\[' + field.attr('id').match(/[0-9]+/) + '\\]\\[value\\]').text(id);
	//}
};

themeGalleryGetAllImages = function(attachment_ids){
	jQuery.each(attachment_ids, function() { 
		themeGalleryGetImage(parseInt(this));
	});
};


themeGalleryCompleteEditImage = function(attachment_id){
	jQuery.post(ajaxurl, {
		action:'theme-gallery-get-image',
		id: attachment_id, 
		cookie: encodeURIComponent(document.cookie)
	}, function(str){
		if ( str == '0' ) {
			alert( 'Could not insert into gallery. Try a different attachment.' );
		} else {
			jQuery("#image-"+ attachment_id).replaceWith(str);
			themeGalleryImagesSetIds();
		}
	});
};

themeGalleryDeleteImage = function(attachment_id){
	jQuery("#image-"+ attachment_id).remove();
	themeGalleryImagesSetIds();
};

themeGalleryImagesSetIds = function(){
	var ids = jQuery('#images_sortable').sortable('toArray').toString();
	jQuery('#gallery_image_ids').val(ids);
};

})(jQuery);

jQuery(document).ready( function($) {

	$("#images_sortable").sortable({
		handle: '.handle',
		opacity: 0.6,
		placeholder: 'sort-item-placeholder',
		stop: function(event, ui) {
			themeGalleryImagesSetIds();
		}
	});


	$("#images_sortable").on('click', '.edit-item', function(){
		var id = $(this).parents('.imageItemWrap').attr('id').slice(6);//remove "image-"
		
		tb_show('Edit Image',"media.php?action=edit&attachment_id="+id+"&gallery_edit_image=true&TB_iframe=true");
	})

	$('#images_sortable').on('click', '.delete-item', function(){
		var id = $(this).parents('.imageItemWrap').attr('id').slice(6);//remove "image-"
		
		themeGalleryDeleteImage(id);
	})


	if($('.theme-add-gallery-button').length > 0){
		// thank to http://mikejolley.com/2012/12/using-the-new-wordpress-3-5-media-uploader-in-plugins/
		var file_frame;

		$('.theme-add-gallery-button').on('click', function( event ){
			var button = $(this);

			button.blur();
			event.preventDefault();

			// If the media frame already exists, reopen it.
			if ( file_frame ) {
			  file_frame.open();
			  return;
			}

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
			  title: $( this ).data( 'uploader_title' ),
			  button: {
			    text: $( this ).data( 'uploader_button_text' ),
			  },
			  multiple:  true
			});

			file_frame.on( 'select', function() {
				attachments = file_frame.state().get('selection').toJSON();
				$.each(attachments, function() { 
					themeGalleryGetImage(this.id);
				});
			});

			file_frame.open();
		});
	}
});
