jQuery(document).ready(function() {
	
	jQuery("select, input:checkbox").uniform();
	
	//set mp3 upload
	jQuery('#logo-upload').focusin(function() {
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');	
		 window.send_to_editor = function(html) {
			var imagePath = jQuery(html).attr('href');
			tb_remove();
			jQuery('#logo-upload').val(imagePath);			
		};
	});
	
});