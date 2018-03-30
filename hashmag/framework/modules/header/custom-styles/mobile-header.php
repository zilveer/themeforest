<?php

if(!function_exists('hashmag_mikado_mobile_header_general_styles')) {
    /**
     * Generates general custom styles for mobile header
     */
    function hashmag_mikado_mobile_header_general_styles() {
        $mobile_header_styles = array();
        if(hashmag_mikado_options()->getOptionValue('mobile_header_height') !== '') {
            $mobile_header_styles['height'] = hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('mobile_header_height')).'px';
        }

        if(hashmag_mikado_options()->getOptionValue('mobile_header_background_color')) {
            $mobile_header_styles['background-color'] = hashmag_mikado_options()->getOptionValue('mobile_header_background_color');
        }

        echo hashmag_mikado_dynamic_css('.mkdf-mobile-header .mkdf-mobile-header-inner', $mobile_header_styles);


		if(hashmag_mikado_options()->getOptionValue('mobile_menu_background_color')) {
			echo hashmag_mikado_dynamic_css(
				'.mkdf-mobile-header .mkdf-mobile-nav',
				array("background-color" => hashmag_mikado_options()->getOptionValue('mobile_menu_background_color'))
			);
		}
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_mobile_header_general_styles');
}

if(!function_exists('hashmag_mikado_mobile_logo_styles')) {
    /**
     * Generates styles for mobile logo
     */
    function hashmag_mikado_mobile_logo_styles() {
        if(hashmag_mikado_options()->getOptionValue('mobile_logo_height') !== '') { ?>
            @media only screen and (max-width: 1000px) {
            <?php echo hashmag_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('mobile_logo_height')).'px !important')
            ); ?>
            }
        <?php }

        if(hashmag_mikado_options()->getOptionValue('mobile_logo_height_phones') !== '') { ?>
            @media only screen and (max-width: 480px) {
            <?php echo hashmag_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-logo-wrapper a',
                array('height' => hashmag_mikado_filter_px(hashmag_mikado_options()->getOptionValue('mobile_logo_height_phones')).'px !important')
            ); ?>
            }
        <?php }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_mobile_logo_styles');
}

if(!function_exists('hashmag_mikado_mobile_icon_styles')) {
    /**
     * Generates styles for mobile icon opener
     */
    function hashmag_mikado_mobile_icon_styles() {
    	
        if(hashmag_mikado_options()->getOptionValue('mobile_icon_color') !== '') {
            echo hashmag_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-menu-opener .mkdf-mobile-opener-icon-holder .mkdf-line',
                array('background-color' => hashmag_mikado_options()->getOptionValue('mobile_icon_color')));
        }

        if(hashmag_mikado_options()->getOptionValue('mobile_icon_hover_color') !== '') {
            echo hashmag_mikado_dynamic_css(
                '.mkdf-mobile-header .mkdf-mobile-menu-opener a:hover .mkdf-mobile-opener-icon-holder .mkdf-line',
                array('background-color' => hashmag_mikado_options()->getOptionValue('mobile_icon_hover_color')));
        }
    }

    add_action('hashmag_mikado_style_dynamic', 'hashmag_mikado_mobile_icon_styles');
}