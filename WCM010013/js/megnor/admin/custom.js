jQuery(document).ready(function() {
	var formfield;

	jQuery('#upload_image_button,#upload_backgroundimage_button,#upload_favicon_icon,#upload_banner').click(function() {
		formfield = jQuery(this).prev().attr('name');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		return false;
		});
	
		window.original_send_to_editor = window.send_to_editor;
		window.send_to_editor = function(html){
	
		if (formfield) {
			fileurl = jQuery(html).attr('href');

			jQuery('#'+formfield).val(fileurl);

			tb_remove();
			formfield = '';

		} else {
			window.original_send_to_editor(html);
		}
	};
});

