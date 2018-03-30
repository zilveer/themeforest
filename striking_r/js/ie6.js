DD_belatedPNG.fix('#feature,#feature .top_shadow, #feature .bottom_shadow,#feature img,.slideimage,#footer,#footer_bottom,#footer .widget ul li,#footer .widget li a');
DD_belatedPNG.fix('#nivo_slider_wrap,.nivo-directionNav a,.nivo-controlNav a,#slider_control_bg');
DD_belatedPNG.fix('#kwicks_shadow,.kwick_shadow,.kwick_frame,.kwick_last_frame');
DD_belatedPNG.fix('#anything_shadow,div.anythingSlider .forward a,div.anythingSlider .back a,div.anythingSlider .thumbNav a');
DD_belatedPNG.fix('#logo img,#page,#page_bottom,#footer_shadow,#sidebar_content,#sidebar_bottom');
DD_belatedPNG.fix('.picture_frame img, .image_frame img, .toggle_title,.ie_png,.picture_frame,.dropcap1,.dropcap2,ul.list1 li, ul.list2 li, ul.list3 li, ul.list4 li, ul.list5 li, ul.list6 li, ul.list7 li, ul.list8 li, ul.list9 li, ul.list10 li, ul.list11 li, ul.list12 li');
DD_belatedPNG.fix('input.text_input,textarea.textarea,#sidebar .widget li a,.widget_recent_comments li span,.tweet_list li,.widget_social img,.icon_text');
DD_belatedPNG.fix('#cboxClose,#cboxNext,#cboxPrevious,#cboxLoadingGraphic,#cboxLoadingOverlay');

jQuery(document).ready(function($) {
    $('.button, .theme_button').hover(

        function() {
            $(this).addClass('hover');
        }, function() {
            $(this).removeClass('hover');
        });
});
