<?php

if(!function_exists('libero_mikado_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     */
    function libero_mikado_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('libero_mikado_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('libero_mikado_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function libero_mikado_title_type_class($classes) {
        $id = libero_mikado_get_page_id();

        if(get_post_meta($id, "mkd_title_area_type_meta", true) !== ""){
            $title_type = get_post_meta($id, "mkd_title_area_type_meta", true);
        }else {
            $title_type = libero_mikado_options()->getOptionValue('title_area_type');
        }

		if (libero_mikado_get_meta_field_intersect('title_area_enable_breadcrumbs') == 'yes'){
			$classes[] = 'mkd-title-enabled-breadcrumbs';
		}

        $classes[] = 'mkd-'.$title_type.'-type';

        return $classes;

    }

    add_filter('libero_mikado_title_classes', 'libero_mikado_title_type_class');
}

if(!function_exists('libero_mikado_title_background_image_classes')) {
    function libero_mikado_title_background_image_classes($classes) {
        //init variables
        $id                         = libero_mikado_get_page_id();
        $is_img_responsive 		    = '';
        $is_pattern		 		    = '';
        $is_image_parallax		    = '';
        $is_image_parallax_array    = array('yes', 'yes_zoom');
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = libero_mikado_options()->getOptionValue('title_area_background_image_responsive');
        }

        //get title background image for 404 page
        $lost_title_img = libero_mikado_options()->getOptionValue('404_title_background_image');

        //is title image chosen for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_meta", true) != ""){
            $title_img = get_post_meta($id, "mkd_title_area_background_image_meta", true);
        }elseif (is_404() && $lost_title_img !== '') {
        	$title_img = $lost_title_img;
        }else{
            //take image that is set in theme options
            $title_img = libero_mikado_options()->getOptionValue('title_area_background_image');
        }

        //is image set to be fixed for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_parallax_meta", true) != ""){
            $is_image_parallax = get_post_meta($id, "mkd_title_area_background_image_parallax_meta", true);
        }else{
            //take setting from theme options
            $is_image_parallax = libero_mikado_options()->getOptionValue('title_area_background_image_parallax');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "mkd_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        $is_pattern = libero_mikado_get_meta_field_intersect("title_area_background_as_pattern");

        //is title image set and visible?
        if($title_img !== '' && $show_title_img == true) {
            //is image not responsive and parallax title is set?
            $classes[] = 'mkd-preload-background';
            $classes[] = 'mkd-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'mkd-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'mkd-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'mkd-has-responsive-background';
            }

            if($is_pattern == 'yes'){
            	$classes[] = 'mkd-background-is-pattern';
            }
        }

        return $classes;
    }

    add_filter('libero_mikado_title_classes', 'libero_mikado_title_background_image_classes');
}

if(!function_exists('libero_mikado_title_content_alignment_class')) {
    /**
     * Function that adds class on title based on title content alignmnt option
     * Could be left, centered or right
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function libero_mikado_title_content_alignment_class($classes) {

        //init variables
        $id                      = libero_mikado_get_page_id();
        $title_content_alignment = 'left';

        if(get_post_meta($id, "mkd_title_area_content_alignment_meta", true) != "") {
            $title_content_alignment = get_post_meta($id, "mkd_title_area_content_alignment_meta", true);

        } else {
            $title_content_alignment = libero_mikado_options()->getOptionValue('title_area_content_alignment');
        }

        $classes[] = 'mkd-content-'.$title_content_alignment.'-alignment';

        return $classes;

    }

    add_filter('libero_mikado_title_classes', 'libero_mikado_title_content_alignment_class');
}

if(!function_exists('libero_mikado_title_animation_class')) {
    /**
     * Function that adds class on title based on title animation option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function libero_mikado_title_animation_class($classes) {

        //init variables
        $id                      = libero_mikado_get_page_id();
        $title_animation = 'no';

        if(get_post_meta($id, "mkd_title_area_animation_meta", true) !== "") {
            $title_animation = get_post_meta($id, "mkd_title_area_animation_meta", true);

        } else {
            $title_animation = libero_mikado_options()->getOptionValue('title_area_animation');
        }

        if ( $title_animation != 'no') {
            $classes[] = 'mkd-title-animation';
        }

        $classes[] = 'mkd-animation-'.$title_animation;

        return $classes;

    }

    add_filter('libero_mikado_title_classes', 'libero_mikado_title_animation_class');
}

if(!function_exists('libero_mikado_title_background_image_div_classes')) {
    function libero_mikado_title_background_image_div_classes($classes) {

        //init variables
        $id                         = libero_mikado_get_page_id();
        $is_img_responsive 		    = '';
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true) != "") {
            $is_img_responsive = get_post_meta($id, "mkd_title_area_background_image_responsive_meta", true);
        } else {
            //take value from theme options
            $is_img_responsive = libero_mikado_options()->getOptionValue('title_area_background_image_responsive');
        }

		//get title background image for 404 page
        $lost_title_img = libero_mikado_options()->getOptionValue('404_title_background_image');

        //is title image chosen for current page?
        if(get_post_meta($id, "mkd_title_area_background_image_meta", true) != ""){
            $title_img = get_post_meta($id, "mkd_title_area_background_image_meta", true);
        }elseif (is_404() && $lost_title_img !== '') {
        	$title_img = $lost_title_img;
        }else{
            //take image that is set in theme options
            $title_img = libero_mikado_options()->getOptionValue('title_area_background_image');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "mkd_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is title image set, visible and responsive?
        if($title_img !== '' && $show_title_img == true) {

            //is image responsive?
            if($is_img_responsive == 'yes') {
                $classes[] = 'mkd-title-image-responsive';
            }
            //is image not responsive?
            elseif($is_img_responsive == 'no') {
                $classes[] = 'mkd-title-image-not-responsive';
            }
        }

        return $classes;
    }

    add_filter('libero_mikado_title_classes', 'libero_mikado_title_background_image_div_classes');
}