<?php

if(!function_exists('hue_mikado_footer_bg_image_styles')) {
    /**
     * Outputs background image styles for footer
     */
    function hue_mikado_footer_bg_image_styles() {
        $background_image = hue_mikado_options()->getOptionValue('footer_background_image');

        if($background_image !== '') {
            $footer_bg_image_styles['background-image'] = 'url('.$background_image.')';

            echo hue_mikado_dynamic_css('body.mkd-footer-with-bg-image .mkd-page-footer', $footer_bg_image_styles);
        }
    }

    add_action('hue_mikado_style_dynamic', 'hue_mikado_footer_bg_image_styles');
}
