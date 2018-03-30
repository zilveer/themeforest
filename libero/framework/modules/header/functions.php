<?php

if(!function_exists('libero_mikado_header_register_main_navigation')) {
    /**
     * Registers main navigation
     */
    function libero_mikado_header_register_main_navigation() {
        register_nav_menus(
            array(
                'main-navigation' => esc_html__('Main Navigation', 'libero')
            )
        );
    }

    add_action('after_setup_theme', 'libero_mikado_header_register_main_navigation');
}

if(!function_exists('libero_mikado_get_sticky_header_height')) {
    /**
     * Returns top sticky header height
     *
     * @return bool|int|void
     */
    function libero_mikado_get_sticky_header_height() {
        //sticky menu height, needed only for sticky header on scroll up
        if(libero_mikado_options()->getOptionValue('header_type') !== 'header-vertical' &&
           in_array(libero_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up'))) {

            $sticky_header_height = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sticky_header_height'));

            return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
        }

        return 0;

    }
}

if(!function_exists('libero_mikado_get_sticky_header_height_of_complete_transparency')) {
    /**
     * Returns top sticky header height it is fully transparent. used in anchor logic
     *
     * @return bool|int|void
     */
    function libero_mikado_get_sticky_header_height_of_complete_transparency() {

        if(libero_mikado_options()->getOptionValue('header_type') !== 'header-vertical') {
            if(libero_mikado_options()->getOptionValue('sticky_header_transparency') !== '0') {
                $stickyHeaderTransparent = libero_mikado_options()->getOptionValue('sticky_header_background_color') !== '' &&
                                           libero_mikado_options()->getOptionValue('sticky_header_transparency') === '0';
            }

            if($stickyHeaderTransparent) {
                return 0;
            } else {
                $sticky_header_height = libero_mikado_filter_px(libero_mikado_options()->getOptionValue('sticky_header_height'));

                return $sticky_header_height !== '' ? intval($sticky_header_height) : 60;
            }
        }
        return 0;
    }
}

if(!function_exists('libero_mikado_get_sticky_scroll_amount')) {
    /**
     * Returns top sticky scroll amount
     *
     * @return bool|int|void
     */
    function libero_mikado_get_sticky_scroll_amount() {

        //sticky menu scroll amount
        if(libero_mikado_options()->getOptionValue('header_type') !== 'header-vertical' &&
           in_array(libero_mikado_options()->getOptionValue('header_behaviour'), array('sticky-header-on-scroll-up','sticky-header-on-scroll-down-up'))) {

            $sticky_scroll_amount = libero_mikado_filter_px(libero_mikado_get_meta_field_intersect('scroll_amount_for_sticky'));

            return $sticky_scroll_amount !== '' ? intval($sticky_scroll_amount) : 0;
        }

        return 0;

    }
}