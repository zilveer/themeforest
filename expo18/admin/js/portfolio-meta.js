jQuery(document).ready(function() {
	
	function hideAllMetaBox() {
		jQuery('#om-portfolio-meta-box-images, #om-portfolio-meta-box-video, #om-portfolio-meta-box-audio').hide();
	}
	hideAllMetaBox();
	
	jQuery('#om-portfolio-meta-box-type select').change(function(){
		hideAllMetaBox();
		var val=jQuery(this).val();
		if(val == 'image' || val == 'slideshow')
			jQuery('#om-portfolio-meta-box-images').show();
		else if(val == 'audio')
			jQuery('#om-portfolio-meta-box-audio').show();
		else if(val == 'video')
			jQuery('#om-portfolio-meta-box-video').show();

	}).change();
	
});