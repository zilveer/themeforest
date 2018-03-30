jQuery(document).ready(function($){

    // Display only needed post meta boxes

    var master = $('#post-formats-select input'),
        linkOptions = $('#stag-metabox-link'),
        linkTrigger = $('#post-format-link'),
        galleryOptions = $('#stag-metabox-gallery'),
        galleryTrigger = $('#post-format-gallery'),
        videoOptions = $('#stag-metabox-video'),
        videoTrigger = $('#post-format-video'),
        audioOptions = $('#stag-metabox-audio'),
        audioTrigger = $('#post-format-audio'),
        quoteOptions = $('#stag-metabox-quote'),
        quoteTrigger = $('#post-format-quote');

    function hideAllFormats(){
        linkOptions.css('display', 'none');
        galleryOptions.css('display', 'none');
        videoOptions.css('display', 'none');
        audioOptions.css('display', 'none');
        quoteOptions.css('display', 'none');
    }

    hideAllFormats();

    master.on('change', function(){
        var that = $(this);
        hideAllFormats();
        if(that.val() === 'link'){
            linkOptions.css('display', 'block');
        }else if(that.val() === 'gallery'){
            galleryOptions.css('display', 'block');
        }else if(that.val() === 'video'){
            videoOptions.css('display', 'block');
        }else if(that.val() === 'audio'){
            audioOptions.css('display', 'block');
        }else if(that.val() === 'quote'){
            quoteOptions.css('display', 'block');
        }
    });

    if(linkTrigger.is(':checked')) linkOptions.css('display', 'block');
    if(galleryTrigger.is(':checked')) galleryOptions.css('display', 'block');
    if(videoTrigger.is(':checked')) videoOptions.css('display', 'block');
    if(audioTrigger.is(':checked')) audioOptions.css('display', 'block');
    if(quoteTrigger.is(':checked')) quoteOptions.css('display', 'block');

});