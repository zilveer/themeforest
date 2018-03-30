var mediaUploader = {
	OptionUploaderImageByAttachmentId : function(id,target){
		var win = window.dialogArguments || opener || parent || top;
		win.theme.option.uploader.getImageByAttachmentId(id,target);
		win.tb_remove();
	},
	OptionUploaderImageByUrl : function(target){
		var f = document.forms[0];
		if ( '' == f.src.value)
			return false;
		
		src =  f.src.value;
		title = f.title.value;
		var win = window.dialogArguments || opener || parent || top;
		win.theme.option.uploader.getImageByUrl(src,title,target);
		win.tb_remove();
		return false;
	}
}

jQuery(document).ready( function($) {
	if(location.search.indexOf('option_image_upload') != -1){
		jQuery('#media-upload #filter').append('<input type="hidden" value="1" name="option_image_upload">');
		jQuery('#media-upload #gallery-settings').remove();
	}
});


function optionImageUploadSuccess(fileObj, serverData) {
	// if async-upload returned an error message, place it in the media item div and return
	if ( serverData.match('media-upload-error') ) {
		jQuery('#media-item-' + fileObj.id).html(serverData);
		return;
	}

	optionImagePrepareMediaItem(fileObj, serverData);
	updateMediaForm();

	// Increment the counter.
	if ( jQuery('#media-item-' + fileObj.id).hasClass('child-of-' + post_id) )
		jQuery('#attachments-count').text(1 * jQuery('#attachments-count').text() + 1);
}

function optionImagePrepareMediaItem(fileObj, serverData) {
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
		if(typeof swfu.settings.post_params.target !== 'undefined'){
			item.load('async-upload.php', {attachment_id:serverData, fetch:f,option_image_upload:1,target:swfu.settings.post_params.target}, function(){prepareMediaItemInit(fileObj);updateMediaForm()});
		}else{
			item.load('async-upload.php', {attachment_id:serverData, fetch:f,option_image_upload:1}, function(){prepareMediaItemInit(fileObj);updateMediaForm()});
		}
	}
}