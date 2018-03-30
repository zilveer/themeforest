<?php

if(!function_exists('edgt_header_classes')) {
	/**
	 * Function that acts like filter for header classes based on theme settings
	 * @param array array of classes to add to header tag
	 *
	 * @see apply_filters()
	 */
	function edgt_header_classes($classes = array()) {
		$classes = array('page_header');
		$classes = apply_filters('edgt_header_classes', $classes);

		if(is_array($classes) && count($classes)) {
			echo implode(' ', $classes);
		}
	}
}

if(!function_exists('edgt_transparent_header_class')) {
	/**
	 * Function that adds transparency class to header based on page or theme options
	 * @param array array of classes from main filter
	 * @return array array of classes with added transparent class
	 *
	 * @see edgt_is_default_wp_template()
	 */
	function edgt_transparent_header_class($classes) {
		global $wp_query;
		global $edgt_options;

		$id = $wp_query->get_queried_object_id();

		if(edgt_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		$is_header_transparent  	= false;
		$transparent_values_array 	= array('0.00', '0');
		$is_archive 				= edgt_is_default_wp_template();

		//is header transparent set on current page?
		if(!$is_archive && get_post_meta($id, "edgt_header_color_transparency_per_page", true) !== "") {
			//take value set for current page
			$transparent_header = esc_attr(get_post_meta($id, "edgt_header_color_transparency_per_page", true));
		} elseif(isset($edgt_options['header_background_transparency_initial'])) {
			//take value set in global options
			$transparent_header = $edgt_options['header_background_transparency_initial'];
		}

		//is header completely transparent?
		$is_header_transparent 	= in_array($transparent_header, $transparent_values_array);
		if($is_header_transparent) {
			$classes[]= 'transparent';
		}
		
		//is header transparent on scrolled window?
		if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] !== 'regular' && !in_array($edgt_options['header_background_transparency_sticky'], $transparent_values_array) || !in_array($edgt_options['header_background_transparency_scroll'], $transparent_values_array)) {
			$classes[] = 'scrolled_not_transparent';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_transparent_header_class');
}

if(!function_exists('edgt_with_border_header_class')) {
	/**
	 * Function that adds border class on header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added border class
	 *
	 * @see edgt_is_default_wp_template()
	 */
	function edgt_with_border_header_class($classes) {
		global $edgt_options;

		$header_with_border = isset($edgt_options['header_bottom_border_color']) && $edgt_options['header_bottom_border_color'] != '';
		if($header_with_border) {
			$classes[]= 'with_border';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_with_border_header_class');
}

if(!function_exists('edgt_wide_first_level_menu_bkg_header_class')) {
	/**
	 * Function that shows wide background in 1st level menu 
	 * @param array array of classes from main filter
	 * @return array array of classes with added wide background class
	 *
	 * @see edgt_is_default_wp_template()
	 */
	function edgt_wide_first_level_menu_bkg_header_class($classes) {
		global $edgt_options;

		$edgt_wide_first_level_menu_bkg_header_class = ((isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_hiding") || (isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "stick menu_bottom") ) && isset($edgt_options['enable_menu_wide_background']) && $edgt_options['enable_menu_wide_background'] == 'yes';
		if($edgt_wide_first_level_menu_bkg_header_class) {
			$classes[]= 'first_level_menu_wide_bkg';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_wide_first_level_menu_bkg_header_class');
}

if(!function_exists('edgt_top_header_class')) {
	/**
	 * Function that adds top header class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added top header class
	 */
	function edgt_top_header_class($classes) {
		global $edgt_options;

		$display_header_top = "yes";
		if(isset($edgt_options['header_top_area'])){
			$display_header_top = $edgt_options['header_top_area'];
		}
		if (!empty($_SESSION['edgt_vigor_header_top'])){
			$display_header_top = $_SESSION['edgt_vigor_header_top'];
		}

		if($display_header_top == 'yes') {
			$classes[] = 'has_top';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_top_header_class');
}

if(!function_exists('edgt_has_woocommerce_dropdown_class')) {
	/**
	 * Function that adds woocommerce dropdown class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added woocommerce dropdown class
	 *
	 * @see edgt_is_woocommerce_installed()
	 */
	function edgt_has_woocommerce_dropdown_class($classes) {
		if(is_active_sidebar('woocommerce_dropdown') && edgt_is_woocommerce_installed()) {
			$classes[]= 'has_woocommerce_dropdown ';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_has_woocommerce_dropdown_class');
}

if(!function_exists('edgt_scroll_top_header_class')) {
	/**
	 * Function that adds top header scroll class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added top header scroll class
	 */
	function edgt_scroll_top_header_class($classes) {
		global $edgt_options;

		$header_top_area_scroll = "no";
		if(isset($edgt_options['header_top_area_scroll'])){
			$header_top_area_scroll = $edgt_options['header_top_area_scroll'];
        }

		if($header_top_area_scroll == 'yes') {
			$classes[] = 'scroll_top';
		}

		if($edgt_options['header_top_area_scroll'] == 'no' && $edgt_options['header_top_area'] == 'yes') {
			$classes[]= 'scroll_header_top_area';
		}

		return $classes;
	}

	add_filter('edgt_header_classes' ,'edgt_scroll_top_header_class');
}

if(!function_exists('edgt_center_logo_class')) {
	/**
	 * Function that adds center logo class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added center logo class
	 */
	function edgt_center_logo_class($classes) {
		global $edgt_options;

		if((isset($edgt_options['center_logo_image']) && $edgt_options['center_logo_image'] == 'yes' && $edgt_options['header_bottom_appearance'] !== "stick_with_left_right_menu") || (isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == "fixed_hiding")) {
			$classes[] = 'centered_logo';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_center_logo_class');
}

if(!function_exists('edgt_header_fixed_right_class')) {
	/**
	 * Function that adds fixed header class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added fixed header class
	 */
	function edgt_header_fixed_right_class($classes) {
		if(is_active_sidebar('header_fixed_right')) {
			$classes[]= 'has_header_fixed_right';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_header_fixed_right_class');
}

if(!function_exists('edgt_header_style_class')) {
	/**
	 * Function that adds header style class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added header style class
	 */
	function edgt_header_style_class($classes) {
		global $wp_query;
		global $edgt_options;

		$id = $wp_query->get_queried_object_id();

		if(edgt_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		if(get_post_meta($id, "edgt_header-style", true) != ""){
			$classes[]= get_post_meta($id, "edgt_header-style", true);
		} else if(isset($edgt_options['header_style'])){
			$classes[]= $edgt_options['header_style'];
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_header_style_class');
}

if(!function_exists('edgt_header_style_on_scroll_class')) {
    /**
     * Function that adds header style class to header tag
     * @param array array of classes from main filter
     * @return array array of classes with added header style class
     */
    function edgt_header_style_on_scroll_class($classes) {
        global $wp_query;
        global $edgt_options;

        $id = $wp_query->get_queried_object_id();

        if(edgt_is_woocommerce_page()) {
            $id = get_option('woocommerce_shop_page_id');
        }

        if(get_post_meta($id, "edgt_header-style-on-scroll", true) != ""){
            if(get_post_meta($id, "edgt_header-style-on-scroll", true) == "yes") {
                $classes[] = 'header_style_on_scroll';
            }
        } else if(isset($edgt_options['enable_header_style_on_scroll']) && $edgt_options['enable_header_style_on_scroll'] == 'yes'){
            $classes[]= 'header_style_on_scroll';
        }

        return $classes;
    }

    add_filter('edgt_header_classes', 'edgt_header_style_on_scroll_class');
}

if(!function_exists('edgt_header_class_first_level_bg_color')) {
	/**
	 * Function that adds first level menu background color class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added first level menu background color class
	 */
	function edgt_header_class_first_level_bg_color($classes) {
		global $edgt_options;

		//check if first level hover background color is set
		$has_first_lvl_bg_color = isset($edgt_options['menu_hover_background_color']) && $edgt_options['menu_hover_background_color'] !== '';

		if($has_first_lvl_bg_color) {
			$classes[]= 'with_hover_bg_color';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_header_class_first_level_bg_color');
}

if(!function_exists('edgt_header_bottom_appearance_class')) {
	/**
	 * Function that adds bottom header appearance class to header tag
	 * @param array array of classes from main filter
	 * @return array array of classes with added bottom header appearance class
	 */
	function edgt_header_bottom_appearance_class($classes) {
		global $edgt_options;

        if (isset($_SESSION['edgt_vigor_header_type'])) {
            if ($_SESSION['edgt_vigor_header_type'] == "big") {
                $edgt_options["header_bottom_appearance"] = "stick menu_bottom";
            }
        }

        if(isset($edgt_options['header_bottom_appearance'])){
			$classes[]= $edgt_options['header_bottom_appearance'];
		} else {
			$classes[]= 'fixed';
		}

		return $classes;
	}

	add_filter('edgt_header_classes', 'edgt_header_bottom_appearance_class');
}

if(!function_exists('edgt_header_menu_items_position_class')) {
    /**
     * Function that ajax header animation class to header tag
     * @param array array of classes from main filter
     * @return array of classes with added ajax header animation class
     */
    function edgt_header_menu_items_position_class($classes) {
        global $edgt_options;

        if(isset($edgt_options['header_bottom_appearance']) && $edgt_options['header_bottom_appearance'] == 'stick_with_left_right_menu' && isset($edgt_options['menu_items_position'])){
            $classes[]= $edgt_options['menu_items_position'];
        }

        return $classes;
    }

    add_filter('edgt_header_classes', 'edgt_header_menu_items_position_class');
}

if(!function_exists('edgt_header_paspartu_alignment_class')) {
    /**
     * Function that adds paspartu alignment class to header tag
     * @param array array of classes from main filter
     * @return array of classes with added paspartu alignment class
     */
    function edgt_header_paspartu_alignment_class($classes) {
        global $edgt_options;

        if(isset($edgt_options['paspartu_header_alignment']) && $edgt_options['paspartu_header_alignment'] == 'yes' && isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes'){
            $classes[]= 'paspartu_header_alignment';
        }
		
		if(isset($edgt_options['paspartu_header_inside']) && $edgt_options['paspartu_header_inside'] == 'yes' && isset($edgt_options['paspartu']) && $edgt_options['paspartu'] == 'yes'){
            $classes[]= 'paspartu_header_inside';
        }

        return $classes;
    }

    add_filter('edgt_header_classes', 'edgt_header_paspartu_alignment_class');
}

if(!function_exists('edgt_header_ajax_header_animation_class')) {
    /**
     * Function that ajax header animation class to header tag
     * @param array array of classes from main filter
     * @return array of classes with added ajax header animation class
     */
    function edgt_header_ajax_header_animation_class($classes) {
        global $edgt_options;

        if(edgt_is_ajax_header_animation_enabled()){
            $classes[]= 'ajax_header_animation';
        }

        return $classes;
    }

    add_filter('edgt_header_classes', 'edgt_header_ajax_header_animation_class');
}