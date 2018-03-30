<?php

if(!function_exists('hue_mikado_header_class')) {
	/**
	 * Function that adds class to header based on theme options
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added header class
	 */
	function hue_mikado_header_class($classes) {
		$header_type = hue_mikado_get_meta_field_intersect('header_type', hue_mikado_get_page_id());

		$classes[] = 'mkd-'.$header_type;

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_header_class');
}

if(!function_exists('hue_mikado_header_behaviour_class')) {
	/**
	 * Function that adds behaviour class to header based on theme options
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added behaviour class
	 */
	function hue_mikado_header_behaviour_class($classes) {
        $id = hue_mikado_get_page_id();
        $header_behaviour = hue_mikado_get_meta_field_intersect('header_behaviour', $id);

		$classes[] = 'mkd-'.$header_behaviour;

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_header_behaviour_class');
}

if(!function_exists('hue_mikado_mobile_header_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_mobile_header_class($classes) {
		$classes[] = 'mkd-default-mobile-header';

		$classes[] = 'mkd-sticky-up-mobile-header';

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_mobile_header_class');
}

if(!function_exists('hue_mikado_header_class_first_level_bg_color')) {
	/**
	 * Function that adds first level menu background color class to header tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added first level menu background color class
	 */
	function hue_mikado_header_class_first_level_bg_color($classes) {

		//check if first level hover background color is set
		if(hue_mikado_options()->getOptionValue('menu_hover_background_color') !== '') {
			$classes[] = 'mkd-menu-item-first-level-bg-color';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_header_class_first_level_bg_color');
}

if(!function_exists('hue_mikado_menu_dropdown_appearance')) {
	/**
	 * Function that adds menu dropdown appearance class to body tag
	 *
	 * @param array array of classes from main filter
	 *
	 * @return array array of classes with added menu dropdown appearance class
	 */
	function hue_mikado_menu_dropdown_appearance($classes) {

		if(hue_mikado_options()->getOptionValue('menu_dropdown_appearance') !== 'default') {
			$classes[] = 'mkd-'.hue_mikado_options()->getOptionValue('menu_dropdown_appearance');
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_menu_dropdown_appearance');
}

if(!function_exists('hue_mikado_header_skin_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_header_skin_class($classes) {

		$id = hue_mikado_get_page_id();

		if(($meta_temp = get_post_meta($id, 'mkd_header_style_meta', true)) !== '') {
			$classes[] = 'mkd-'.$meta_temp;
		} else if(hue_mikado_options()->getOptionValue('header_style') !== '') {
			$classes[] = 'mkd-'.hue_mikado_options()->getOptionValue('header_style');
		}

		return $classes;

	}

	add_filter('body_class', 'hue_mikado_header_skin_class');

}

if(!function_exists('hue_mikado_header_scroll_style_class')) {

	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_header_scroll_style_class($classes) {

		if(hue_mikado_get_meta_field_intersect('enable_header_style_on_scroll') == 'yes') {
			$classes[] = 'mkd-header-style-on-scroll';
		}

		return $classes;

	}

	add_filter('body_class', 'hue_mikado_header_scroll_style_class');

}

if(!function_exists('hue_mikado_header_global_js_var')) {
	/**
	 * @param $global_variables
	 *
	 * @return mixed
	 */
	function hue_mikado_header_global_js_var($global_variables) {

		$global_variables['mkdTopBarHeight']                   = hue_mikado_get_top_bar_height();
		$global_variables['mkdStickyHeaderHeight']             = hue_mikado_get_sticky_header_height();
		$global_variables['mkdStickyHeaderTransparencyHeight'] = hue_mikado_get_sticky_header_height_of_complete_transparency();

		return $global_variables;
	}

	add_filter('hue_mikado_js_global_variables', 'hue_mikado_header_global_js_var');
}

if(!function_exists('hue_mikado_header_per_page_js_var')) {
	/**
	 * @param $perPageVars
	 *
	 * @return mixed
	 */
	function hue_mikado_header_per_page_js_var($perPageVars) {
		$id = hue_mikado_get_page_id();

		$perPageVars['mkdStickyScrollAmount']           = hue_mikado_get_sticky_scroll_amount();
		$perPageVars['mkdStickyScrollAmountFullScreen'] = get_post_meta($id, 'mkd_scroll_amount_for_sticky_fullscreen_meta', true) === 'yes';

		return $perPageVars;
	}

	add_filter('hue_mikado_per_page_js_vars', 'hue_mikado_header_per_page_js_var');
}

if(!function_exists('hue_mikado_full_width_wide_menu_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_full_width_wide_menu_class($classes) {
		if(hue_mikado_options()->getOptionValue('enable_wide_menu_background') === 'yes') {
			$classes[] = 'mkd-full-width-wide-menu';
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_full_width_wide_menu_class');
}

if(!function_exists('hue_mikado_header_bottom_border_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_header_bottom_border_class($classes) {
		$id = hue_mikado_get_page_id();

		$disable_border_standard = hue_mikado_get_meta_field_intersect('menu_area_border_header_standard',$id) == 'no';
		if($disable_border_standard) {
			$classes[] = 'mkd-header-standard-border-disable';
		}

        $disable_grid_border_standard = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_standard',$id) == 'no';
        if($disable_grid_border_standard) {
            $classes[] = 'mkd-header-standard-in-grid-border-disable';
        }

        $disable_border_minimal = hue_mikado_get_meta_field_intersect('menu_area_border_header_minimal',$id) == 'no';
        if($disable_border_minimal) {
            $classes[] = 'mkd-header-minimal-border-disable';
        }

        $disable_grid_border_minimal = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_minimal',$id) == 'no';
        if($disable_grid_border_minimal) {
            $classes[] = 'mkd-header-minimal-in-grid-border-disable';
        }

        $disable_border_divided = hue_mikado_get_meta_field_intersect('menu_area_border_header_divided',$id) == 'no';
        if($disable_border_divided) {
            $classes[] = 'mkd-header-divided-border-disable';
        }

        $disable_grid_border_divided = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_divided',$id) == 'no';
        if($disable_grid_border_divided) {
            $classes[] = 'mkd-header-divided-in-grid-border-disable';
        }

        $disable_logo_border_centered = hue_mikado_get_meta_field_intersect('logo_area_border_header_centered',$id) == 'no';
        if($disable_logo_border_centered) {
            $classes[] = 'mkd-header-centered-logo-border-disable';
        }

        $disable_menu_border_centered = hue_mikado_get_meta_field_intersect('menu_area_border_header_centered',$id) == 'no';
        if($disable_menu_border_centered) {
            $classes[] = 'mkd-header-centered-menu-border-disable';
        }

        $disable_logo_grid_border_centered = hue_mikado_get_meta_field_intersect('logo_area_in_grid_border_header_centered',$id) == 'no';
        if($disable_logo_grid_border_centered) {
            $classes[] = 'mkd-header-centered-logo-in-grid-border-disable';
        }

        $disable_menu_grid_border_centered = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_centered',$id) == 'no';
        if($disable_menu_grid_border_centered) {
            $classes[] = 'mkd-header-centered-menu-in-grid-border-disable';
        }

        $disable_logo_border_standard_extended = hue_mikado_get_meta_field_intersect('logo_area_border_header_standard_extended',$id) == 'no';
        if($disable_logo_border_standard_extended) {
            $classes[] = 'mkd-header-standard-extended-logo-border-disable';
        }

        $disable_menu_border_standard_extended = hue_mikado_get_meta_field_intersect('menu_area_border_header_standard_extended',$id) == 'no';
        if($disable_menu_border_standard_extended) {
            $classes[] = 'mkd-header-standard-extended-menu-border-disable';
        }

        $disable_logo_grid_border_standard_extended = hue_mikado_get_meta_field_intersect('logo_area_in_grid_border_header_standard_extended',$id) == 'no';
        if($disable_logo_grid_border_standard_extended) {
            $classes[] = 'mkd-header-standard-extended-logo-in-grid-border-disable';
        }

        $disable_menu_grid_border_standard_extended = hue_mikado_get_meta_field_intersect('menu_area_in_grid_border_header_standard_extended',$id) == 'no';
        if($disable_menu_grid_border_standard_extended) {
            $classes[] = 'mkd-header-standard-extended-menu-in-grid-border-disable';
        }

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_header_bottom_border_class');
}

if(!function_exists('hue_mikado_get_top_bar_styles')) {
	/**
	 * Sets per page styles for header top bar
	 *
	 * @param $styles
	 *
	 * @return array
	 */
	function hue_mikado_get_top_bar_styles($styles) {
		$id            = hue_mikado_get_page_id();
		$class_prefix  = hue_mikado_get_unique_page_class();
		$top_bar_style = array();

		$top_bar_bg_color = get_post_meta($id, 'mkd_top_bar_background_color_meta', true);

		$top_bar_selector = array(
			$class_prefix.' .mkd-top-bar, '.$class_prefix.' .mkd-top-bar-background'
		);

		if($top_bar_bg_color !== '') {
			$top_bar_transparency = get_post_meta($id, 'mkd_top_bar_background_transparency_meta', true);
			if($top_bar_transparency === '') {
				$top_bar_transparency = 1;
			}

			$top_bar_style['background-color'] = hue_mikado_rgba_color($top_bar_bg_color, $top_bar_transparency);
		}

        if(get_post_meta($id, 'mkd_top_bar_border_meta', true) == 'no'){
            $top_bar_style['border-bottom'] = '0';
        }else if(get_post_meta($id, 'mkd_top_bar_border_meta', true) == 'yes' && get_post_meta($id, 'mkd_top_bar_border_color_meta', true) !== ''){
            $top_bar_style['border-bottom'] = '1px solid '.get_post_meta($id, 'mkd_top_bar_border_color_meta', true);
        }


		$styles[] = hue_mikado_dynamic_css($top_bar_selector, $top_bar_style);

		return $styles;
	}

	add_filter('hue_mikado_add_page_custom_style', 'hue_mikado_get_top_bar_styles');
}

if(!function_exists('hue_mikado_top_bar_skin_class')) {
	/**
	 * @param $classes
	 *
	 * @return array
	 */
	function hue_mikado_top_bar_skin_class($classes) {
		$id           = hue_mikado_get_page_id();
		$top_bar_skin = get_post_meta($id, 'mkd_top_bar_skin_meta', true);

		if($top_bar_skin !== '') {
			$classes[] = 'mkd-top-bar-'.$top_bar_skin;
		}

		return $classes;
	}

	add_filter('body_class', 'hue_mikado_top_bar_skin_class');
}