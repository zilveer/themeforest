<?php

use Flow\Modules\Header\Lib\HeaderFactory;

if(!function_exists('flow_elated_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines flow_elated_header_type_parameters filter
     */
    function flow_elated_get_header() {

        //will be read from options
        $header_type     = flow_elated_options()->getOptionValue('header_type');
        $header_behavior = flow_elated_options()->getOptionValue('header_behaviour');

        extract(flow_elated_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => flow_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'menu_area_background_color' => $menu_area_background_color,
                'vertical_header_background_color' => $vertical_header_background_color,
                'vertical_header_opacity' => $vertical_header_opacity,
                'vertical_background_image' => $vertical_background_image
            );

            $parameters = apply_filters('flow_elated_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('flow_elated_get_header_top')) {
    /**
     * Loads header top HTML and sets parameters for it
     */
    function flow_elated_get_header_top() {

        //generate column width class
        switch(flow_elated_options()->getOptionValue('top_bar_layout')) {
            case ('two-columns'):
                $column_widht_class = '50-50';
                break;
            case ('three-columns'):
                $column_widht_class = flow_elated_options()->getOptionValue('top_bar_column_widths');
                break;
        }

        $params = array(
            'column_widths'      => $column_widht_class,
            'show_widget_center' => flow_elated_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
            'show_header_top'    => flow_elated_options()->getOptionValue('top_bar') == 'yes' ? true : false,
            'top_bar_in_grid'    => flow_elated_options()->getOptionValue('top_bar_in_grid') == 'yes' ? true : false
        );

        $params = apply_filters('flow_elated_header_top_params', $params);

        flow_elated_get_module_template_part('templates/parts/header-top', 'header', '', $params);
    }
}

if(!function_exists('flow_elated_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function flow_elated_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : flow_elated_options()->getOptionValue('header_type');

        if($slug == 'sticky'){
            $logo_image = flow_elated_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = flow_elated_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = flow_elated_options()->getOptionValue('logo_image_dark');
        $logo_image_light = flow_elated_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = flow_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens
        }

        $params = array(
            'logo_image'  => $logo_image,
            'logo_image_dark' => $logo_image_dark,
            'logo_image_light' => $logo_image_light,
            'logo_styles' => $logo_styles
        );

        flow_elated_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('flow_elated_get_preloader_logo')) {
    function flow_elated_get_preloader_logo() {
        $logo_image = ''; 

        if (flow_elated_options()->getOptionValue('logo_image') != '') {
            $logo_image = flow_elated_options()->getOptionValue('logo_image');
        } 

        return $logo_image;
    }
}

if(!function_exists('flow_elated_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function flow_elated_get_main_menu($additional_class = 'eltd-default-nav') {
        flow_elated_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('flow_elated_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function flow_elated_get_sticky_menu($additional_class = 'eltd-default-nav') {
		flow_elated_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}


if(!function_exists('flow_elated_get_vertical_main_menu')) {
    /**
     * Loads vertical menu HTML
     */
    function flow_elated_get_vertical_main_menu() {
        flow_elated_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
    }
}



if(!function_exists('flow_elated_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function flow_elated_get_sticky_header() {

        $parameters = array(
            'hide_logo'             => flow_elated_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => flow_elated_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
        );

        flow_elated_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('flow_elated_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function flow_elated_get_mobile_header() {
        if(flow_elated_is_responsive_on()) {
            $header_type = flow_elated_options()->getOptionValue('header_type');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => flow_elated_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'menu_opener_icon'       => flow_elated_icon_collections()->getMobileMenuIcon(flow_elated_options()->getOptionValue('mobile_icon_pack'), true),
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            flow_elated_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('flow_elated_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function flow_elated_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : flow_elated_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if(flow_elated_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = flow_elated_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = flow_elated_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = flow_elated_get_image_dimensions($logo_image);

        $logo_height = '';
        $logo_styles = '';
        if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
            $logo_height = $logo_dimensions['height'];
            $logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens
        }

        //set parameters for logo
        $parameters = array(
            'logo_image'      => $logo_image,
            'logo_dimensions' => $logo_dimensions,
            'logo_height'     => $logo_height,
            'logo_styles'     => $logo_styles
        );

        flow_elated_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('flow_elated_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function flow_elated_get_mobile_nav() {

        $slug = flow_elated_options()->getOptionValue('header_type');

        flow_elated_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('flow_elated_get_page_options')) {
    /**
     * Gets options from page
     */
    function flow_elated_get_page_options() {
        $id = flow_elated_get_page_id();
        $page_options = array();
        $menu_area_background_color_rgba = '';
        $menu_area_background_color = '';
        $menu_area_background_transparency = '';
        $vertical_header_background_color = '';
        $vertical_header_opacity = '';
        $vertical_background_image = '';

        $header_type = flow_elated_options()->getOptionValue('header_type');
        switch ($header_type) {
            case 'header-standard':

                if(($meta_temp = get_post_meta($id, 'eltd_menu_area_background_color_header_standard_meta', true)) != '') {
                    $menu_area_background_color = $meta_temp;
                }

                if(($meta_temp = get_post_meta($id, 'eltd_menu_area_background_transparency_header_standard_meta', true)) != '') {
                    $menu_area_background_transparency = $meta_temp;
                }

                if(flow_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
                    $menu_area_background_color_rgba = 'background-color:'.flow_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);
                }

                break;

            case 'header-vertical':
                if(($meta_temp = get_post_meta($id, 'eltd_vertical_header_background_color_meta', true)) !== '') {
                    $vertical_header_background_color = 'background-color:'.$meta_temp;
                }

                if(($meta_temp = get_post_meta($id, 'eltd_vertical_header_transparency_meta', true)) !== '') {
                    $vertical_header_opacity = 'opacity:'.$meta_temp;
                }

                if(get_post_meta($id, 'eltd_disable_vertical_header_background_image_meta', true) == 'yes'){
                    $vertical_background_image = 'background-image:none';
                }elseif(($meta_temp = get_post_meta($id, 'eltd_vertical_header_background_image_meta', true)) !== ''){
                    $vertical_background_image = 'background-image:url('.$meta_temp.')';
                }

                break;
        }

        $page_options['menu_area_background_color'] = $menu_area_background_color_rgba;
        $page_options['vertical_header_background_color'] = $vertical_header_background_color;
        $page_options['vertical_header_opacity'] = $vertical_header_opacity;
        $page_options['vertical_background_image'] = $vertical_background_image;

        return $page_options;
    }
}