var upload_block;
jQuery(document).ready(function($){
	$('.sense_upload_image_button').click(function() {
		upload_block = $(this).parent();
		tb_show('Upload Image', 'media-upload.php?referer=siteoptions&amp;type=image&amp;TB_iframe=true&amp;post_id=0', false);
		return false;
	});

	$('.sense_delete_image_button').click(function() {
		var delete_block = jQuery(this).parent();
		delete_block.find('.sense_upload_url').val('');
		delete_block.find('.image_preview').html('');
		$(this).fadeOut();	
		return false;
	});
	
	window.send_to_editor = function(html) {
		url = $('img',html).attr('src');
		upload_block.find('.sense_upload_url').val(url);
		img = $('<img alt = ""/>')
		img.attr('src', url);
		upload_block.find('.image_preview').html('');
		img.appendTo(upload_block.find('.image_preview'));
		upload_block.find('.sense_delete_image_button').fadeIn();
		tb_remove();
	}
	
	
	
});