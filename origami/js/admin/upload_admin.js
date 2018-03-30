jQuery(document).ready(function() {
	var formfield;
	jQuery('#upload_logo_button').click(function() {
		jQuery('html').addClass('Image');
		formfield = jQuery('#themeteam_logo_upload').attr('name');
		tb_show('','media-upload.php?type=image&TB_iframe=true');
		return false;
	});

	// user inserts file into post. only run custom if user started process using the above process
	// window.send_to_editor(html) is how wp would normally handle the received data
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (formfield) {
			fileurl = jQuery('img',html).attr('src');
			jQuery('#themeteam_logo_upload').val(fileurl);
			tb_remove();
			jQuery('html').removeClass('Image');
		} else {
			window.original_send_to_editor(html);
		}
	};

	var formfield2;
	jQuery('#upload_bg_button').click(function() {
		jQuery('html').addClass('Image');
		formfield2 = jQuery('#themeteam_bg_upload').attr('name');
		tb_show('','media-upload.php?type=image&TB_iframe=true');
		return false;
	});

	// user inserts file into post. only run custom if user started process using the above process
	// window.send_to_editor(html) is how wp would normally handle the received data
	window.original_send_to_editor = window.send_to_editor;
	window.send_to_editor = function(html){
		if (formfield2) {
			fileurl2 = jQuery('img',html).attr('src');
			jQuery('#themeteam_bg_upload').val(fileurl2);
			tb_remove();
			jQuery('html').removeClass('Image');
		} else {
			window.original_send_to_editor(html);
		}
	};

});