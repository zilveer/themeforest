jQuery(document).ready( function($) {
	var kenVideoSelector = jQuery('#_ken_video_type');
	var kenVideoIframe = jQuery('#_ken_video_iframe_src').parents('.theme-option').hide();
	var kenVideoMp4 = jQuery('#_ken_video_mp4_src').parents('.theme-option').hide();
	var kenVideoWebm = jQuery('#_ken_video_webm_src').parents('.theme-option').hide();
	var kenVideoOgg = jQuery('#_ken_video_ogg_src').parents('.theme-option').hide();
		
	function kenVideoHandle(value){	
		if(value === 'iframe'){
			kenVideoIframe.show();
			kenVideoMp4.hide();
			kenVideoWebm.hide();
			kenVideoOgg.hide();
		}else if(value === 'html5'){
			kenVideoIframe.hide();
			kenVideoMp4.show();
			kenVideoWebm.show();
			kenVideoOgg.show();
		}else{
			kenVideoIframe.hide();
			kenVideoMp4.hide();
			kenVideoWebm.hide();
			kenVideoOgg.hide();
		}
	}
	kenVideoHandle(kenVideoSelector.val());

	kenVideoSelector.on('change',function(){
		kenVideoHandle(jQuery(this).val());
	});
});
