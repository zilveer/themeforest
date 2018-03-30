<?php

use Hue\Modules\Header\Lib\HeaderFactory;

if(!function_exists('hue_mikado_get_header')) {
	/**
	 * Loads header HTML based on header type option. Sets all necessary parameters for header
	 * and defines hue_mikado_header_type_parameters filter
	 */
	function hue_mikado_get_header() {

		//will be read from options
		$header_type     = hue_mikado_get_meta_field_intersect('header_type');
		$header_behavior = hue_mikado_get_meta_field_intersect('header_behaviour');

		extract(hue_mikado_get_page_options());

		if(HeaderFactory::getInstance()->validHeaderObject()) {
			$parameters = array(
				'hide_logo'                        => hue_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
				'show_sticky'                      => in_array($header_behavior, array(
					'sticky-header-on-scroll-up',
					'sticky-header-on-scroll-down-up'
				)) ? true : false,
				'show_fixed_wrapper'               => in_array($header_behavior, array('fixed-on-scroll')) ? true : false,
				'menu_area_background_color'       => $menu_area_background_color,
				'vertical_header_background_color' => $vertical_header_background_color,
				'vertical_header_opacity'          => $vertical_header_opacity,
				'vertical_background_image'        => $vertical_background_image
			);

			$parameters = apply_filters('hue_mikado_header_type_parameters', $parameters, $header_type);

			HeaderFactory::getInstance()->getHeaderObject()->loadTemplate($parameters);
		}
	}
}

if(!function_exists('hue_mikado_get_header_top')) {
	/**
	 * Loads header top HTML and sets parameters for it
	 */
	function hue_mikado_get_header_top() {

		//generate column width class
		switch(hue_mikado_options()->getOptionValue('top_bar_layout')) {
			case ('two-columns'):
				$column_widht_class = 'mkd-'.hue_mikado_options()->getOptionValue('top_bar_two_column_widths');
				break;
			case ('three-columns'):
				$column_widht_class = 'mkd-'.hue_mikado_options()->getOptionValue('top_bar_column_widths');
				break;
		}

		$params = array(
			'column_widths'                     => $column_widht_class,
			'show_widget_center'                => hue_mikado_options()->getOptionValue('top_bar_layout') == 'three-columns' ? true : false,
			'show_header_top'                   => hue_mikado_is_top_bar_enabled(),
			'show_header_top_background_div'    => hue_mikado_get_meta_field_intersect('header_type') == 'header-box' ? true : false,
			'top_bar_in_grid'                   => hue_mikado_get_meta_field_intersect('top_bar_in_grid') == 'yes' ? true : false
		);

		$params = apply_filters('hue_mikado_header_top_params', $params);

		hue_mikado_get_module_template_part('templates/parts/header-top', 'header', '', $params);
	}
}

if(!function_exists('hue_mikado_get_logo')) {
	/**
	 * Loads logo HTML
	 *
	 * @param $slug
	 */
	function hue_mikado_get_logo($slug = '') {

		$slug = $slug !== '' ? $slug : hue_mikado_options()->getOptionValue('header_type');

        $logo_image_dark  = hue_mikado_options()->getOptionValue('logo_image_dark');
        $logo_image_light = hue_mikado_options()->getOptionValue('logo_image_light');

        switch ($slug){
            case 'sticky':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_sticky');
                break;
            case 'divided':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_divided');
                $logo_image_dark  = hue_mikado_options()->getOptionValue('logo_image_divided_dark');
                $logo_image_light = hue_mikado_options()->getOptionValue('logo_image_divided_light');
                break;
            case 'divided-sticky':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_divided_sticky');
                $logo_image_dark  = hue_mikado_options()->getOptionValue('logo_image_divided_dark');
                $logo_image_light = hue_mikado_options()->getOptionValue('logo_image_divided_light');
                break;
            case 'centered':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_centered');
                $logo_image_dark  = hue_mikado_options()->getOptionValue('logo_image_centered_dark');
                $logo_image_light = hue_mikado_options()->getOptionValue('logo_image_centered_light');
                break;
            case 'centered-sticky':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_centered_sticky');
                $logo_image_dark  = hue_mikado_options()->getOptionValue('logo_image_centered_dark');
                $logo_image_light = hue_mikado_options()->getOptionValue('logo_image_centered_light');
                break;
            case 'vertical':
                $logo_image = hue_mikado_options()->getOptionValue('logo_image_vertical');
                break;
            default:
                $logo_image = hue_mikado_options()->getOptionValue('logo_image');
                break;
        }




		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = hue_mikado_get_image_dimensions($logo_image);

		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px;'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		$params = array(
			'logo_image'           => $logo_image,
			'logo_image_dark'      => $logo_image_dark,
			'logo_image_light'     => $logo_image_light,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		hue_mikado_get_module_template_part('templates/parts/logo', 'header', $slug, $params);
	}
}

if(!function_exists('hue_mikado_get_main_menu')) {
	/**
	 * Loads main menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function hue_mikado_get_main_menu($additional_class = 'mkd-default-nav') {
		hue_mikado_get_module_template_part('templates/parts/navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('hue_mikado_get_sticky_menu')) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function hue_mikado_get_sticky_menu($additional_class = 'mkd-default-nav') {
		hue_mikado_get_module_template_part('templates/parts/sticky-navigation', 'header', '', array('additional_class' => $additional_class));
	}
}

if(!function_exists('hue_mikado_get_divided_left_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function hue_mikado_get_divided_left_main_menu($additional_class = 'mkd-default-nav') {
        hue_mikado_get_module_template_part('templates/parts/divided-left-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('hue_mikado_get_divided_right_main_menu')) {
    /**
     * Loads main menu HTML
     *
     * @param string $additional_class addition class to pass to template
     */
    function hue_mikado_get_divided_right_main_menu($additional_class = 'mkd-default-nav') {
        hue_mikado_get_module_template_part('templates/parts/divided-right-navigation', 'header', '', array('additional_class' => $additional_class));
    }
}

if(!function_exists('hue_mikado_get_vertical_main_menu')) {
	/**
	 * Loads vertical menu HTML
	 */
	function hue_mikado_get_vertical_main_menu() {
		hue_mikado_get_module_template_part('templates/parts/vertical-navigation', 'header', '');
	}
}


if(!function_exists('hue_mikado_get_sticky_header')) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function hue_mikado_get_sticky_header($slug = '') {

		$parameters = array(
			'hide_logo'             => hue_mikado_options()->getOptionValue('hide_logo') == 'yes' ? true : false,
			'sticky_header_in_grid' => hue_mikado_options()->getOptionValue('sticky_header_in_grid') == 'yes' ? true : false
		);

		hue_mikado_get_module_template_part('templates/behaviors/sticky-header', 'header', $slug, $parameters);
	}
}

if(!function_exists('hue_mikado_get_mobile_header')) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function hue_mikado_get_mobile_header() {
		if(hue_mikado_is_responsive_on()) {
			$header_type = hue_mikado_options()->getOptionValue('header_type');

			//this could be read from theme options
			$mobile_header_type = 'mobile-header';

			$parameters = array(
				'show_logo'              => hue_mikado_options()->getOptionValue('hide_logo') == 'yes' ? false : true,
				'menu_opener_icon'       => hue_mikado_icon_collections()->getMobileMenuIcon(hue_mikado_options()->getOptionValue('mobile_icon_pack'), true),
				'show_navigation_opener' => has_nav_menu('main-navigation')
			);

			hue_mikado_get_module_template_part('templates/types/'.$mobile_header_type, 'header', $header_type, $parameters);
		}
	}
}

if(!function_exists('hue_mikado_get_mobile_logo')) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 *
	 * @param string $slug
	 */
	function hue_mikado_get_mobile_logo($slug = '') {

		$slug = $slug !== '' ? $slug : hue_mikado_options()->getOptionValue('header_type');

		//check if mobile logo has been set and use that, else use normal logo
		if(hue_mikado_options()->getOptionValue('logo_image_mobile') !== '') {
			$logo_image = hue_mikado_options()->getOptionValue('logo_image_mobile');
		} else {
			$logo_image = hue_mikado_options()->getOptionValue('logo_image');
		}

		//get logo image dimensions and set style attribute for image link.
		$logo_dimensions = hue_mikado_get_image_dimensions($logo_image);

		$logo_height          = '';
		$logo_styles          = '';
		$logo_dimensions_attr = array();
		if(is_array($logo_dimensions) && array_key_exists('height', $logo_dimensions)) {
			$logo_height = $logo_dimensions['height'];
			$logo_styles = 'height: '.intval($logo_height / 2).'px'; //divided with 2 because of retina screens

			if(!empty($logo_dimensions['height']) && $logo_dimensions['width']) {
				$logo_dimensions_attr['height'] = $logo_dimensions['height'];
				$logo_dimensions_attr['width']  = $logo_dimensions['width'];
			}
		}

		//set parameters for logo
		$parameters = array(
			'logo_image'           => $logo_image,
			'logo_dimensions'      => $logo_dimensions,
			'logo_height'          => $logo_height,
			'logo_styles'          => $logo_styles,
			'logo_dimensions_attr' => $logo_dimensions_attr
		);

		hue_mikado_get_module_template_part('templates/parts/mobile-logo', 'header', $slug, $parameters);
	}
}

if(!function_exists('hue_mikado_get_mobile_nav')) {
	/**
	 * Loads mobile navigation HTML
	 */
	function hue_mikado_get_mobile_nav() {

		$slug = hue_mikado_options()->getOptionValue('header_type');

		hue_mikado_get_module_template_part('templates/parts/mobile-navigation', 'header', $slug);
	}
}

if(!function_exists('hue_mikado_get_page_options')) {
	/**
	 * Gets options from page
	 */
	function hue_mikado_get_page_options() {
		$id                                = hue_mikado_get_page_id();
		$page_options                      = array();
		$menu_area_background_color_rgba   = '';
		$menu_area_background_color        = '';
		$menu_area_background_transparency = '';
		$vertical_header_background_color  = '';
		$vertical_header_opacity           = '';
		$vertical_background_image         = '';

		$header_type = hue_mikado_get_meta_field_intersect('header_type', $id);
		switch($header_type) {
			case 'header-standard':

				if(($meta_temp = get_post_meta($id, 'mkd_menu_area_background_color_header_standard_meta', true)) != '') {
					$menu_area_background_color = $meta_temp;
				}

				if(($meta_temp = get_post_meta($id, 'mkd_menu_area_background_transparency_header_standard_meta', true)) != '') {
					$menu_area_background_transparency = $meta_temp;
				}

				if(hue_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency) !== null) {
					$menu_area_background_color_rgba = 'background-color:'.hue_mikado_rgba_color($menu_area_background_color, $menu_area_background_transparency);
				}

				break;

			case 'header-vertical':
				if(($meta_temp = get_post_meta($id, 'mkd_vertical_header_background_color_meta', true)) !== '') {
					$vertical_header_background_color = 'background-color:'.$meta_temp;
				}

				if(get_post_meta($id, 'mkd_disable_vertical_header_background_image_meta', true) == 'yes') {
					$vertical_background_image = 'background-image:none';
				} elseif(($meta_temp = get_post_meta($id, 'mkd_vertical_header_background_image_meta', true)) !== '') {
					$vertical_background_image = 'background-image:url('.$meta_temp.')';
				}

				break;
		}

		$page_options['menu_area_background_color']       = $menu_area_background_color_rgba;
		$page_options['vertical_header_background_color'] = $vertical_header_background_color;
		$page_options['vertical_header_opacity']          = $vertical_header_opacity;
		$page_options['vertical_background_image']        = $vertical_background_image;

		return $page_options;
	}
}