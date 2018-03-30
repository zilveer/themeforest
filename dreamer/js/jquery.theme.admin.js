jQuery(document).ready(function() {


/*----------------------------------------------------------------------------------*/
/*	Quote Options
/*----------------------------------------------------------------------------------*/

	var quoteOptions = jQuery('#dreamer-meta-box-quote');
	var quoteTrigger = jQuery('#post-format-quote');
	
	quoteOptions.css('display', 'none');

/*----------------------------------------------------------------------------------*/
/*	Link Options
/*----------------------------------------------------------------------------------*/

	var linkOptions = jQuery('#dreamer-meta-box-link');
	var linkTrigger = jQuery('#post-format-link');
	
	linkOptions.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Audio Options
/*----------------------------------------------------------------------------------*/

	var audioOptions = jQuery('#dreamer-meta-box-audio');
	var audioTrigger = jQuery('#post-format-audio');
	
	audioOptions.css('display', 'none');
	
/*----------------------------------------------------------------------------------*/
/*	Video Options
/*----------------------------------------------------------------------------------*/

	var videoOptions = jQuery('#dreamer-meta-box-video');
	var videoTrigger = jQuery('#post-format-video');
	
	videoOptions.css('display', 'none');

/*----------------------------------------------------------------------------------*/
/*	The Brain
/*----------------------------------------------------------------------------------*/

	var group = jQuery('#post-formats-select input');

	
	group.change( function() {
		
		if(jQuery(this).val() == 'quote') {
			quoteOptions.css('display', 'block');
			dreamerHideAll(quoteOptions);
			
		} else if(jQuery(this).val() == 'link') {
			linkOptions.css('display', 'block');
			dreamerHideAll(linkOptions);
			
		} else if(jQuery(this).val() == 'audio') {
			audioOptions.css('display', 'block');
			dreamerHideAll(audioOptions);
			
		} else if(jQuery(this).val() == 'video') {
			videoOptions.css('display', 'block');
			dreamerHideAll(videoOptions);
			
		} else {
			quoteOptions.css('display', 'none');
			videoOptions.css('display', 'none');
			linkOptions.css('display', 'none');
			audioOptions.css('display', 'none');
		}
		
	});
	
	if(quoteTrigger.is(':checked'))
		quoteOptions.css('display', 'block');
		
	if(linkTrigger.is(':checked'))
		linkOptions.css('display', 'block');
		
	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');
		
	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');
		
	function dreamerHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		notThisOne.css('display', 'block');
	}
});