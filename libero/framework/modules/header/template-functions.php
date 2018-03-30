<?php

use Libero\Modules\Header\Lib\HeaderFactory;

if(!function_exists('libero_mikado_get_header')) {
    /**
     * Loads header HTML based on header type option. Sets all necessary parameters for header
     * and defines libero_mikado_header_type_parameters filter
     */
    function libero_mikado_get_header() {

        //will be read from options
        $header_type     = libero_mikado_options()->getOptionValue('header_type');
        $header_behavior = libero_mikado_options()->getOptionValue('header_behaviour');

        extract(libero_mikado_get_page_options());

        if(HeaderFactory::getInstance()->validHeaderObject()) {
            $parameters = array(
                'hide_logo'          => libero_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
                'show_sticky'        => in_array($header_behavior, array(
                    'sticky-header-on-scroll-up',
                    'sticky-header-on-scroll-down-up'
                )) ? true : false,
                'show_fixed_wrapper' => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
                'top_menu_area_background_color' => $top_menu_area_background_color,
                'bottom_menu_area_background_color' => $bottom_menu_area_background_color,
            );

            $parameters = apply_filters('libero_mikado_header_type_parameters', $parameters, $header_type);

            HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
        }
    }
}

if(!function_exists('libero_mikado_get_logo')) {
    /**
     * Loads logo HTML
     *
     * @param $slug
     */
    function libero_mikado_get_logo($slug = '') {

        $slug = $slug !== '' ? $slug : libero_mikado_options()->getOptionValue('header_type');

        if($slug == 'sticky'){
            $logo_image = libero_mikado_options()->getOptionValue('logo_image_sticky');
        }else{
            $logo_image = libero_mikado_options()->getOptionValue('logo_image');
        }

        $logo_image_dark = libero_mikado_options()->getOptionValue('logo_image_dark');
        $logo_image_light = libero_mikado_options()->getOptionValue('logo_image_light');


        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = libero_mikado_get_image_dimensions($logo_image);

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

        libero_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
    }
}

if(!function_exists('libero_mikado_get_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function libero_mikado_get_main_menu($additional_class = 'mkd-default-nav') {
        libero_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('libero_mikado_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function libero_mikado_get_sticky_menu($additional_class = 'mkd-default-nav') {
		libero_mikado_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('libero_mikado_get_sticky_header')) {
    /**
     * Loads sticky header behavior HTML
     */
    function libero_mikado_get_sticky_header() {

        extract(libero_mikado_get_page_options());

        $parameters = array(
            'hide_logo'             => libero_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
            'sticky_header_in_grid' => libero_mikado_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false,
            'sticky_background_color_rgba' => $sticky_background_color_rgba
        );

        libero_mikado_get_module_template_part('templates/behaviors/sticky-header', 'header', '', $parameters);
    }
}

if(!function_exists('libero_mikado_get_mobile_header')) {
    /**
     * Loads mobile header HTML only if responsiveness is enabled
     */
    function libero_mikado_get_mobile_header() {
        if(libero_mikado_is_responsive_on()) {
            $header_type = libero_mikado_options()->getOptionValue('header_type');

            //this could be read from theme options
            $mobile_header_type = 'mobile-header';

            $parameters = array(
                'show_logo'              => libero_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
                'show_navigation_opener' => has_nav_menu('main-navigation')
            );

            libero_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
        }
    }
}

if(!function_exists('libero_mikado_get_mobile_logo')) {
    /**
     * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
     *
     * @param string $slug
     */
    function libero_mikado_get_mobile_logo($slug = '') {

        $slug = $slug !== '' ? $slug : libero_mikado_options()->getOptionValue('header_type');

        //check if mobile logo has been set and use that, else use normal logo
        if(libero_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
            $logo_image = libero_mikado_options()->getOptionValue('logo_image_mobile');
        } else {
            $logo_image = libero_mikado_options()->getOptionValue('logo_image');
        }

        //get logo image dimensions and set style attribute for image link.
        $logo_dimensions = libero_mikado_get_image_dimensions($logo_image);

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

        libero_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
    }
}

if(!function_exists('libero_mikado_get_mobile_nav')) {
    /**
     * Loads mobile navigation HTML
     */
    function libero_mikado_get_mobile_nav() {

        $slug = libero_mikado_options()->getOptionValue('header_type');

        libero_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
    }
}

if(!function_exists('libero_mikado_get_page_options')) {
    /**
     * Gets options from page
     */
    function libero_mikado_get_page_options() {
        $id = libero_mikado_get_page_id();
        $page_options = array();
        $top_menu_area_background_color = '';
        $bottom_menu_area_background_color = '';
        $sticky_background_color = '';
        $sticky_background_color_rgba = '';
        $sticky_background_transparency = '';
        $sticky_grid_background_color = '';
        $sticky_grid_background_transparency = '';

        if(get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true) != '') {
            $top_menu_area_background_color = 'background-color: '.get_post_meta($id, 'mkd_top_menu_area_background_color_header_standard_meta', true);
        }

        if(get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true) != '') {
            $bottom_menu_area_background_color = 'background-color: '.get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true);
        }

        if(get_post_meta($id, 'mkd_sticky_header_background_color_meta', true) != '') {
            $sticky_background_color = get_post_meta($id, 'mkd_sticky_header_background_color_meta', true);
        }

        if(libero_mikado_get_meta_field_intersect('sticky_header_transparency') != '') {
            $sticky_background_transparency = libero_mikado_get_meta_field_intersect('sticky_header_transparency');
        }
        else{
        	$sticky_background_transparency = 1;
        }

        if(libero_mikado_rgba_color($sticky_background_color, $sticky_background_transparency) !== null) {
            $sticky_background_color_rgba = 'background-color:'.libero_mikado_rgba_color($sticky_background_color, $sticky_background_transparency);
        }

        $page_options['top_menu_area_background_color'] = $top_menu_area_background_color;
        $page_options['bottom_menu_area_background_color'] = $bottom_menu_area_background_color;
        $page_options['sticky_background_color_rgba'] = $sticky_background_color_rgba;
        return $page_options;
    }
}