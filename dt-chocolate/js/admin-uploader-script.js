jQuery(document).ready(function() {
		var formfieldID = '';
		var ste_tmp = '';
		
		jQuery('#upload_image_button').click(function() {
			formfieldID = jQuery('#dt_video');
			
			ste_tmp = window.send_to_editor;
			window.send_to_editor = window.send_to_editor_clone;
			
			tb_show('', jQuery(this).attr('href') );
			return false;
		});

		window.send_to_editor_clone = function(html) {
			var imgurl = jQuery(html.toString()).attr('href');

			formfieldID.val(imgurl);

			window.send_to_editor = ste_tmp;
			tb_remove();
		}
	
		jQuery('#remove_image_button').click(function(){
			jQuery(this).parent().find('#dt_video').attr('value', '');
			return false;
		});
});