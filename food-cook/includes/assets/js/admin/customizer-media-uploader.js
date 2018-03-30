// JavaScript Document

jQuery(document).ready(function($) {

	$('.customize-media-uploader .btn-remove').click(function(e) {
		// functionality for remove image/logo button

		// remove the img tag
        $(this).siblings('.md-upload-current-image').children('div').html('');

		// remove the hidden input filed
		// unless you call change() function wordpress will not acknowledge the change and the save button will remain deactive
		$(this).siblings('.md-upload-current-image').children('input[type=hidden]').val('').change();

		// remove the remove button itself
		$(this).hide();

    });

    $('.customize-media-uploader #media-uploader').click(function(e) {

		// formID = $(this).attr( 'rel' );
		var current_item = $(this);
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=1');


			var original_send_to_editor = window.send_to_editor;
			window.send_to_editor = function(html) {
				 var imgurl = jQuery('img',html).attr('src');
				 var name = _uploader.id;
				// console.log(name);
				 current_item.siblings('.md-upload-current-image').children('div').html('<img src="'+imgurl+'">');
				 current_item.siblings('.md-upload-current-image').children('input[type=hidden]').val(imgurl).change();
				 current_item.siblings('.btn-remove').show();
				 tb_remove();
	 			window.send_to_editor = original_send_to_editor;
			}

		return false;
    });
});