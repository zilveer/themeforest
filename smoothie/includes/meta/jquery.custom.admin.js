// All custom JS not relating to theme options goes here

jQuery(document).ready(function($) {

/*----------------------------------------------------------------------------------*/
/*	Display post format meta boxes as needed
/*----------------------------------------------------------------------------------*/

    /* Grab our vars ---------------------------------------------------------------*/
	var audioOptions = $('#cr-metabox-post-audio'),
    	audioTrigger = $('#post-format-audio'),
    	videoOptions = $('#cr-metabox-post-video'),
    	videoTrigger = $('#post-format-video'),
    	galleryOptions = $('#cr-metabox-post-image'),
    	galleryTrigger = $('#post-format-gallery'),
    	linkOptions = $('#cr-metabox-post-link'),
    	linkTrigger = $('#post-format-link'),
    	quoteOptions = $('#cr-metabox-post-quote'),
    	quoteTrigger = $('#post-format-quote'),
    	group = $('#post-formats-select input');

    /* Hide and show sections as needed --------------------------------------------*/
    crHideAll(null);	

	group.change( function() {
	    $that = $(this);
	    
        crHideAll(null);

        if( $that.val() == 'audio' ) {
			audioOptions.css('display', 'block');
		} else if( $that.val() == 'video' ) {
			videoOptions.css('display', 'block');
		} else if( $that.val() == 'gallery' ) {
		    galleryOptions.css('display', 'block');
		} else if( $that.val() == 'link' ) {
		    linkOptions.css('display', 'block');
		} else if( $that.val() == 'quote' ) {
		    quoteOptions.css('display', 'block');
		}

	});

	if(audioTrigger.is(':checked'))
		audioOptions.css('display', 'block');

	if(videoTrigger.is(':checked'))
		videoOptions.css('display', 'block');

    if(galleryTrigger.is(':checked'))
        galleryOptions.css('display', 'block');

    if(linkTrigger.is(':checked'))
        linkOptions.css('display', 'block');

    if(quoteTrigger.is(':checked'))
        quoteOptions.css('display', 'block');

    function crHideAll(notThisOne) {
		videoOptions.css('display', 'none');
		audioOptions.css('display', 'none');
		galleryOptions.css('display', 'none');
		linkOptions.css('display', 'none');
		quoteOptions.css('display', 'none');
    }
    
    
});