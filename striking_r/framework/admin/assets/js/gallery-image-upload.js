function themeImageInsertIntoGallery(id){
	var win = window.dialogArguments || opener || parent || top;

	win.themeGalleryGetImage(id);
	win.tb_remove();
}
function themeImageInsertAllIntoGallery(){
	var win = window.dialogArguments || opener || parent || top;
	var ids = jQuery('[name="gallery_image_ids[]"]').map(function() {
	  return this.value;
	}).get();

	win.themeGalleryGetAllImages(ids);
	win.tb_remove();
}
jQuery(document).ready( function($) {
	if(location.search.indexOf('gallery_image_upload') != -1){
		$('#media-upload #filter').append('<input type="hidden" value="1" name="gallery_image_upload">');
		$('.ml-submit').append('<input type="button" value="Insert all into Gallery" onclick="themeImageInsertAllIntoGallery()" class="button" />');
		$('#media-upload #gallery-settings').remove();
	}
});


function galleryImageUploadSuccess(fileObj, serverData) {
	// if async-upload returned an error message, place it in the media item div and return
	if ( serverData.match('media-upload-error') ) {
		jQuery('#media-item-' + fileObj.id).html(serverData);
		return;
	}

	galleryImagePrepareMediaItem(fileObj, serverData);
	updateMediaForm();

	// Increment the counter.
	if ( jQuery('#media-item-' + fileObj.id).hasClass('child-of-' + post_id) )
		jQuery('#attachments-count').text(1 * jQuery('#attachments-count').text() + 1);
}

function galleryImagePrepareMediaItem(fileObj, serverData) {
	var f = ( typeof shortform == 'undefined' ) ? 1 : 2, item = jQuery('#media-item-' + fileObj.id);
	// Move the progress bar to 100%
	jQuery('.bar', item).remove();
	jQuery('.progress', item).hide();

	try {
		if ( typeof topWin.tb_remove != 'undefined' )
			topWin.jQuery('#TB_overlay').click(topWin.tb_remove);
	} catch(e){}

	// Old style: Append the HTML returned by the server -- thumbnail and form inputs
	if ( isNaN(serverData) || !serverData ) {
		item.append(serverData);
		prepareMediaItemInit(fileObj);
	}
	// New style: server data is just the attachment ID, fetch the thumbnail and form html from the server
	else {
		item.load('async-upload.php', {attachment_id:serverData, fetch:f,gallery_image_upload:1}, function(){prepareMediaItemInit(fileObj);updateMediaForm()});
	}
}