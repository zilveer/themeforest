jQuery(document).ready(function() {
		
	//set mp3 upload
	jQuery('#mp3-upload').click(function() {
		tb_show('', 'media-upload.php?type=audio&amp;TB_iframe=true');	
		 window.send_to_editor = function(html) {
			var trackPath = jQuery(html).attr('href');
			tb_remove();
			jQuery('#release_mp3_link').val(trackPath);			
		};
	});
	
	
});