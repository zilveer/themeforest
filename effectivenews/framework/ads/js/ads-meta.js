jQuery(document).ready(function($) {
// ad size
    $('[name="mom_ads_meta[ad_size]"]').change(function() {
        if ($(this).val() === 'custom-size') {
            $('.mti_custom_size').slideDown(250);
        } else {
            $('.mti_custom_size').slideUp('fast');
        }
    });
    if ($('[name="mom_ads_meta[ad_size]"]').val() === 'custom-size' ) {
        $('.mti_custom_size').show();
    }

//ads layout
    $('[name="mom_ads_meta[ad_layout]"]').change(function() {
        if ($(this).val() === 'grid') {
            $('.mti_grid_options').slideDown(250);
            $('.mti_rotator_options').slideUp('fast');
        } else if ($(this).val() === 'rotator') {
            $('.mti_rotator_options').slideDown(250);
            $('.mti_grid_options').slideUp('fast');
        } else {
            $('.mti_grid_options').slideUp('fast');
            $('.mti_rotator_options').slideUp('fast');
        }
    });
        if ($('[name="mom_ads_meta[ad_layout]"]').val() === 'grid') {
            $('.mti_grid_options').show();
            $('.mti_rotator_options').hide();
        } else if ($('[name="mom_ads_meta[ad_layout]"]').val() === 'rotator') {
            $('.mti_rotator_options').show();
            $('.mti_grid_options').hide();
        } else {
            $('.mti_grid_options').hide();
            $('.mti_rotator_options').hide();
        }
    
// ad type
    $('.mom-ad-type').change(function() {
            var id = $(this).data('id');
        if ($(this).val() === 'code') {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_code').slideDown(250);
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_image').slideUp('fast');
            $('.mom-ad-gi[data-id="'+id+'"] .ad-type-img').addClass('ad-type-code');
        } else {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_code').slideUp('fast');
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_image').slideDown(250);
            $('.mom-ad-gi[data-id="'+id+'"] .ad-type-img').removeClass('ad-type-code');
        }
    });
    $('.mom-ad-type').each(function() {
        var id = $(this).data('id');
        if ($(this).val() === 'code' ) {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_code').show();
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_image').hide();
            $('.mom-ad-gi[data-id="'+id+'"] .ad-type-img').addClass('ad-type-code');
        }
    });

// ad expire

    $('.mom-ad-expire').change(function() {
            var id = $(this).data('id');
            console.log(id);
        if ($(this).val() === 'yes') {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_expire').slideDown(250);
        } else {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_expire').slideUp('fast');
        }
    });
    $('.mom-ad-expire').each(function() {
        var id = $(this).data('id');
        if ($(this).val() === 'yes' ) {
            $('.mom-ad-gi[data-id="'+id+'"] .mti_ad_expire').show();
        }
    });
//meta group sortable
$('#wpa_loop-ads').sortable({
 placeholder: "mom-group-sort-placeholder",
 handle: ".mgh-handle"
});

}); //end of file