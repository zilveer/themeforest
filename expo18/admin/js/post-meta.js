jQuery(document).ready(function() {
	
	function hideAllMetaBox() {
		jQuery('#om-post-meta-box-quote, #om-post-meta-box-link, #om-post-meta-box-video, #om-post-meta-box-audio').hide();
	}
	hideAllMetaBox();
	
	jQuery('#post-formats-select input').change(function(){
		hideAllMetaBox();
		var type=jQuery(this).val();
		jQuery('#om-post-meta-box-'+type).show();
	});
	
	jQuery('#post-formats-select input:checked').change();
	
});