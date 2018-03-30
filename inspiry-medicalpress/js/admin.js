/*-----------------------------------------------------------------------------------*/
/*	Admin side JS
/*-----------------------------------------------------------------------------------*/
jQuery(document).ready(function () {


    /*-----------------------------------------------------------------------------------*/
    /*	To Control Metaboxes based on post format
     /*-----------------------------------------------------------------------------------*/
    var video_meta_box = jQuery('#video-meta-box');
    var gallery_meta_box = jQuery('#gallery-meta-box');
    var url_meta_box = jQuery('#url-meta-box');
    var audio_meta_box = jQuery('#audio-meta-box');
    var quote_meta_box = jQuery('#quote-meta-box');

    var videoTrigger = jQuery('#post-format-video');
    var galleryTrigger = jQuery('#post-format-gallery');
    var linkTrigger = jQuery('#post-format-link');
    var audioTrigger = jQuery('#post-format-audio');
    var quoteTrigger = jQuery('#post-format-quote');

    var group = jQuery('#post-formats-select input');

    if (videoTrigger.is(':checked')) {
        hideAllExcept(video_meta_box);
    }
    else if (galleryTrigger.is(':checked')) {
        hideAllExcept(gallery_meta_box);
    }
    else if (linkTrigger.is(':checked')) {
        hideAllExcept(url_meta_box);
    }
    else if (audioTrigger.is(':checked')) {
        hideAllExcept(audio_meta_box);
    }
    else if (quoteTrigger.is(':checked')) {
        hideAllExcept(quote_meta_box);
    }
    else {
        hideAll();
    }

    group.change(function () {

        if (jQuery(this).val() == 'video') {
            hideAllExcept(video_meta_box);
        }
        else if (jQuery(this).val() == 'gallery') {
            hideAllExcept(gallery_meta_box);
        }
        else if (jQuery(this).val() == 'link') {
            hideAllExcept(url_meta_box);
        }
        else if (jQuery(this).val() == 'audio') {
            hideAllExcept(audio_meta_box);
        }
        else if (jQuery(this).val() == 'quote') {
            hideAllExcept(quote_meta_box);
        }
        else {
            hideAll();
        }

    });

    function hideAllExcept(required_meta_box) {
        hideAll();
        required_meta_box.show();
    }

    function hideAll() {
        video_meta_box.hide();
        gallery_meta_box.hide();
        url_meta_box.hide();
        audio_meta_box.hide();
        quote_meta_box.hide();
    }

});