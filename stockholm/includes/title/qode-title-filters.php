<?php

if(!function_exists('qode_title_classes')) {
	/**
	 * Function that adds classes to title div.
	 * All other functions are tied to it with add_filter function
	 * @param array $classes array of classes
	 */
	function qode_title_classes($classes = array()) {
		$classes = array();
		$classes = apply_filters('qode_title_classes', $classes);

		if(is_array($classes) && count($classes)) {
			echo implode(' ', $classes);
		}
	}
}

if(!function_exists('qode_title_position_class')) {
	/**
	 * Function that adds class on title based on title position option
	 * Could be left, centered or right
	 * @param $classes original array of classes
	 * @return array changed array of classes
	 */
	function qode_title_position_class($classes) {
		global $qode_options;
		global $wp_query;

		//init variables
		$id 			= $wp_query->get_queried_object_id();
		$title_position = 'left';

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		if(get_post_meta($id, "qode_page_title_position", true) != "") {
			$title_position = get_post_meta($id, "qode_page_title_position", true);

		} else {
			$title_position = $qode_options['page_title_position'];
		}

		$classes[] = 'position_'.$title_position;

		return $classes;
	}

	add_filter('qode_title_classes', 'qode_title_position_class');
}

if(!function_exists('qode_title_background_image_classes')) {
	function qode_title_background_image_classes($classes) {
		global $qode_options;
		global $wp_query;

		//init variables
		$id 					= $wp_query->get_queried_object_id();
		$is_img_responsive 		= '';
		$is_image_fixed			= '';
		$is_image_fixed_array 	= array('yes', 'yes_zoom');
		$show_title_img			= true;
		$title_img				= '';

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		//is responsive image is set for current page?
		if(get_post_meta($id, "qode_responsive-title-image", true) != "") {
			$is_img_responsive = get_post_meta($id, "qode_responsive-title-image", true);
		} else {
			//take value from theme options
			$is_img_responsive = $qode_options['responsive_title_image'];
		}

		//is title image chosen for current page?
		if(get_post_meta($id, "qode_title-image", true) != ""){
			$title_img = get_post_meta($id, "qode_title-image", true);
		}else{
			//take image that is set in theme options
			$title_img = $qode_options['title_image'];
		}

		//is image set to be fixed for current page?
		if(get_post_meta($id, "qode_fixed-title-image", true) != ""){
			$is_image_fixed = get_post_meta($id, "qode_fixed-title-image", true);
		}else{
			//take setting from theme options
			$is_image_fixed = $qode_options['fixed_title_image'];
		}

		//is title image hidden for current page?
		if(get_post_meta($id, "qode_show-page-title-image", true) == "yes") {
			$show_title_img = false;
		}

		//is title image set and visible?
		if($title_img !== '' && $show_title_img == true) {
			//is image not responsive and parallax title is set?
			if($is_img_responsive == 'no' && in_array($is_image_fixed, $is_image_fixed_array)) {
				$classes[] = 'has_fixed_background';

				if($is_image_fixed == 'yes_zoom') {
					$classes[] = 'zoom_out';
				}
			}
			//is image not responsive and parallax title isn't set?
			elseif($is_img_responsive == 'no') {
				$classes[] = 'has_background';
			}
		}

		return $classes;
	}

	add_filter('qode_title_classes', 'qode_title_background_image_classes');
}

if(!function_exists('qode_title_text_is_hidden_class')) {
	function qode_title_text_is_hidden_class($classes) {
		global $qode_options;
		global $wp_query;

		//init variables
		$id 				= $wp_query->get_queried_object_id();

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		if(get_post_meta($id, "qode_show-page-title-text", true) == "yes") {
			$classes[] = 'without_title_text';
		}

		return $classes;
	}

	add_filter('qode_title_classes', 'qode_title_text_is_hidden_class');
}

if(!function_exists('qode_title_breadcrumb_type_class')) {
    function qode_title_breadcrumb_type_class($classes) {
        global $qode_options;
        global $wp_query;

        //init variables
        $id 			= $wp_query->get_queried_object_id();

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

        $title_type = "standard_title";
        if(get_post_meta($id, "qode_page_title_type", true) != ""){
            $title_type = get_post_meta($id, "qode_page_title_type", true);
        }else if(is_404()){
            $title_type = "breadcrumbs_title";
        }else{
            $title_type = $qode_options['title_type'];
        }

        $classes[] = $title_type;

        return $classes;
    }

    add_filter('qode_title_classes', 'qode_title_breadcrumb_type_class');
}

if(!function_exists('qode_title_background_color_class')) {
	function qode_title_background_color_class($classes) {
		global $qode_options;
		global $wp_query;

		//init variables
		$id 			= $wp_query->get_queried_object_id();
		$title_image	= '';
		$title_bg_color = '';

		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		//is title image chosen for current page?
		if(get_post_meta($id, "qode_title-image", true) != ""){
			$title_img = get_post_meta($id, "qode_title-image", true);
		}else{
			//take image that is set in theme options
			$title_img = $qode_options['title_image'];
		}

		//is title background color set?
		if(get_post_meta($id, "qode_page-title-background-color", true) != ""){
			$title_bg_color = get_post_meta($id, "qode_page-title-background-color", true);
		}else{
			//take background color from
			$title_bg_color = $qode_options['title_background_color'];
		}

		if($title_bg_color !== '' && $title_img === '') {
			$classes[] = 'with_background_color';
		}

		return $classes;
	}

	add_filter('qode_title_classes', 'qode_title_background_color_class');
}

if(!function_exists('qode_title_text_background_class')) {
	function qode_title_text_background_class($classes) {
		global $qode_options;
		global $wp_query;

		//init variables
		$id 			= $wp_query->get_queried_object_id();
		$title_class = '';
		if(qode_is_woocommerce_page()) {
			$id = get_option('woocommerce_shop_page_id');
		}

		if(get_post_meta($id, "qode_page-title-text-background-color", true) != ""){
			$title_class = 'with_title_text_bg_color';
		}else if(isset($qode_options['title_text_background_color']) && $qode_options['title_text_background_color'] !=''){
			$title_class = "with_title_text_bg_color";
		}

		$classes[] = $title_class;

		return $classes;
	}

	add_filter('qode_title_classes', 'qode_title_text_background_class');
}