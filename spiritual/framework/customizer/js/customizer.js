jQuery(window).load(function () {
    jQuery('#swm_customizer_loading').delay(1000).fadeOut('slow');
});

jQuery(document).ready(function ($) {

    // Google Fonts show-hide

    var enableGoogleFont = $('#customize-control-swm_google_fonts input');
    var googleFontFields = $('#customize-control-swm_body_font_family,#customize-control-swm_top_nav_font_family,#customize-control-swm_headings_font_family,#customize-control-swm_body_font_weight,#customize-control-swm_top_nav_font_weight,#customize-control-swm_headings_font_weight');

    $('#customize-control-swm_google_fonts input').change(function () {
        if (enableGoogleFont.is(':checked')) {
            googleFontFields.css('display', 'block');
        } else {
            googleFontFields.css('display', 'none');
        }
    });

    if (!enableGoogleFont.is(':checked')) {
        googleFontFields.css('display', 'none');
    }

    // Sub set fileds show-hide

    var enableSubFields = $('#customize-control-swm_google_font_subset input');
    var subSetFields = $('#customize-control-swm_google_font_subset_cyrillic,#customize-control-swm_google_font_subset_greek,#customize-control-swm_google_font_subset_vietnamese');

    $('#customize-control-swm_google_font_subset input').change(function () {
        if (enableSubFields.is(':checked')) {
            subSetFields.css('display', 'block');
        } else {
            subSetFields.css('display', 'none');
        }
    });

    if (!enableSubFields.is(':checked')) {
        subSetFields.css('display', 'none');
    }

    //mini select
    var miniSelectFields = jQuery('label.swm_body_sw,label.swm_top_nav_sw,label.swm_headings_sw');
    miniSelectFields.parent().css({
        'width': '35%',
            'margin': 0
    });

    //show hide top navigation active link arrow sections

    var enableTopNavActiveArrow = $('#customize-control-swm_display_active_link input');

    var activeLinkArrowFields = jQuery('#customize-control-swm_nav_active_link_bg,#customize-control-swm_nav_active_icon_color,#customize-control-swm_active_arrow_opacity,#customize-control-swm_nav_active_icon_info,#customize-control-nav_link_icon1,#customize-control-nav_link_icon2,#customize-control-nav_link_icon3,#customize-control-nav_link_icon4,#customize-control-nav_link_icon5,#customize-control-nav_link_icon6,#customize-control-nav_link_icon7,#customize-control-nav_link_icon8,#customize-control-nav_link_icon9,#customize-control-nav_link_icon10');

    $('#customize-control-swm_display_active_link input').change(function () {
        if (enableTopNavActiveArrow.is(':checked')) {
            activeLinkArrowFields.css('display', 'block');
        } else {
            activeLinkArrowFields.css('display', 'none');
        }
    });

    if (!enableTopNavActiveArrow.is(':checked')) {
        activeLinkArrowFields.css('display', 'none');
    }

    // show hide donate link fields
    var enableDonateLink = $('#customize-control-swm_display_donate_button input');
    var donateLinkFields = $('#customize-control-swm_nav_donate_text_color,#customize-control-swm_nav_donate_background_color,#customize-control-swm_nav_donate_hover_text_color,#customize-control-swm_nav_donate_hover_background_color');

    $('#customize-control-swm_display_donate_button input').change(function () {
        if (enableDonateLink.is(':checked')) {
            donateLinkFields.css('display', 'block');
        } else {
            donateLinkFields.css('display', 'none');
        }
    });

    if (!enableDonateLink.is(':checked')) {
        donateLinkFields.css('display', 'none');
    }

    // show hide parallax background fields
    var enableParallaxScroll = $('#customize-control-swm_enable_parallax_effect input');
    var parallaxFields = $('#customize-control-swm_header_parallax_speed');

    $('#customize-control-swm_enable_parallax_effect input').change(function () {
        if (enableParallaxScroll.is(':checked')) {
            parallaxFields.css('display', 'block');
        } else {
            parallaxFields.css('display', 'none');
        }
    });

    if (!enableParallaxScroll.is(':checked')) {
        parallaxFields.css('display', 'none');
    }

});

jQuery(window).load(function ($) {

    function is_exist_in_obj(field, object) {
        for (var i in object) {
            if (object[i] === field) {
                return (true);
            }
        }
        return (false);
    }

    function getFontWeight(selectField) {

        var fieldID = selectField.data('customize-setting-link').replace(/family/, "weight");
        var fontName = jQuery('option:selected', selectField).val();
        var fontWeight = _wpCustomizeSettings.settings['swm_google_font_weight_list']['value'][fontName];

        jQuery('input[name="_customize-radio-' + fieldID + '"]').each(function () {
            if (!is_exist_in_obj(jQuery(this).val(), fontWeight)) {
                jQuery(this).parent().hide();
            } else {
                jQuery(this).parent().show();
            }
        });

    }

    var checkedTrigger = jQuery('#customize-control-swm_google_fonts input');

    jQuery('select[data-customize-setting-link]').each(function () {
        getFontWeight(jQuery(this));
    }).on('change', function () {
        getFontWeight(jQuery(this));
    });

    if (!checkedTrigger.is(':checked')) {
        getFontWeight(jQuery('select[data-customize-setting-link]'));
    }

    checkedTrigger.change(function () {
        if (checkedTrigger.is(':checked')) {
            getFontWeight(jQuery('select[data-customize-setting-link]'));
        } else if (!checkedTrigger.is(':checked')) {
            getFontWeight(jQuery('select[data-customize-setting-link]'));
        }
    });

});