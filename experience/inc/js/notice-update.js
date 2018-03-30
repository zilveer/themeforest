jQuery(document).on( 'click', '.experience-vc-notice', function() {

    jQuery.ajax({
        url: ajaxurl,
        data: {
            action: 'experience_dismiss_notice'
        }
    })

})