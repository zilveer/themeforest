<?php

if (!function_exists('libero_mikado_footer_top_style')) {

    function libero_mikado_footer_top_style(){

        $footer_top_styles = array();

        $background_image = libero_mikado_options()->getOptionValue('footer_top_background_image');
        if($background_image !== '') {
            $footer_top_styles['background-image'] = 'url('.$background_image.')';
        }

        echo libero_mikado_dynamic_css('footer .mkd-footer-top-holder', $footer_top_styles);

    }

    add_action('libero_mikado_style_dynamic', 'libero_mikado_footer_top_style');

}