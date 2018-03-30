<?php

if(!function_exists('suprema_qodef_title_classes')) {
    /**
     * Function that adds classes to title div.
     * All other functions are tied to it with add_filter function
     * @param array $classes array of classes
     */
    function suprema_qodef_title_classes($classes = array()) {
        $classes = array();
        $classes = apply_filters('suprema_qodef_title_classes', $classes);

        if(is_array($classes) && count($classes)) {
            echo implode(' ', $classes);
        }
    }
}

if(!function_exists('suprema_qodef_title_type_class')) {
    /**
     * Function that adds class on title based on title type option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function suprema_qodef_title_type_class($classes) {
        $id = suprema_qodef_get_page_id();


        if(suprema_qodef_is_woocommerce_installed() && is_woocommerce()) {
            if(($meta_temp = get_post_meta(suprema_qodef_get_woo_shop_page_id(), "qodef_title_area_type_meta", true)) !== ""){
                $title_type = $meta_temp;
            } else {
                $title_type = suprema_qodef_options()->getOptionValue('title_area_type');
            }
        } else{
            if(is_tag() || is_date() || is_author() || is_category() || is_search()) {
                $title_type = 'breadcrumb';
            }
            else {
                if (($meta_temp = get_post_meta($id, "qodef_title_area_type_meta", true)) !== "") {
                    $title_type = $meta_temp;
                } else {
                    $title_type = suprema_qodef_options()->getOptionValue('title_area_type');
                }
            }
        }
        
        $classes[] = 'qodef-'.$title_type.'-type';

        return $classes;

    }

    add_filter('suprema_qodef_title_classes', 'suprema_qodef_title_type_class');
}

if(!function_exists('suprema_qodef_title_background_image_classes')) {
    function suprema_qodef_title_background_image_classes($classes) {
        //init variables
        $id                         = suprema_qodef_get_page_id();
        $is_img_responsive 		    = '';
        $is_image_parallax		    = '';
        $is_image_parallax_array    = array('yes', 'yes_zoom');
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(($meta_temp = get_post_meta($id, "qodef_title_area_background_image_responsive_meta", true)) != "") {
            $is_img_responsive = $meta_temp;
        } else {
            //take value from theme options
            $is_img_responsive = suprema_qodef_options()->getOptionValue('title_area_background_image_responsive');
        }

        //is title image chosen for current page?
        if(($meta_temp = get_post_meta($id, "qodef_title_area_background_image_meta", true)) != ""){
            $title_img = $meta_temp;
        }else{
            //take image that is set in theme options
            $title_img = suprema_qodef_options()->getOptionValue('title_area_background_image');
        }

        //is image set to be fixed for current page?
        if(($meta_temp = get_post_meta($id, "qodef_title_area_background_image_parallax_meta", true)) != ""){
            $is_image_parallax = $meta_temp;
        }else{
            //take setting from theme options
            $is_image_parallax = suprema_qodef_options()->getOptionValue('title_area_background_image_parallax');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "qodef_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is title image set and visible?
        if($title_img !== '' && $show_title_img == true) {
            //is image not responsive and parallax title is set?
            $classes[] = 'qodef-preload-background';
            $classes[] = 'qodef-has-background';

            if($is_img_responsive == 'no' && in_array($is_image_parallax, $is_image_parallax_array)) {
                $classes[] = 'qodef-has-parallax-background';

                if($is_image_parallax == 'yes_zoom') {
                    $classes[] = 'qodef-zoom-out';
                }
            }

            //is image not responsive
            elseif($is_img_responsive == 'yes'){
                $classes[] = 'qodef-has-responsive-background';
            }
        }

        return $classes;
    }

    add_filter('suprema_qodef_title_classes', 'suprema_qodef_title_background_image_classes');
}

if(!function_exists('suprema_qodef_title_content_alignment_class')) {
    /**
     * Function that adds class on title based on title content alignmnt option
     * Could be left, centered or right
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function suprema_qodef_title_content_alignment_class($classes) {

        //init variables
        $id                      = suprema_qodef_get_page_id();
        $title_content_alignment = 'left';

        if(($meta_temp = get_post_meta($id, "qodef_title_area_content_alignment_meta", true)) != "") {
            $title_content_alignment = $meta_temp;

        } else {
            $title_content_alignment = suprema_qodef_options()->getOptionValue('title_area_content_alignment');
        }

        $classes[] = 'qodef-content-'.$title_content_alignment.'-alignment';

        return $classes;

    }

    add_filter('suprema_qodef_title_classes', 'suprema_qodef_title_content_alignment_class');
}

if(!function_exists('suprema_qodef_title_animation_class')) {
    /**
     * Function that adds class on title based on title animation option
     * @param $classes original array of classes
     * @return array changed array of classes
     */
    function suprema_qodef_title_animation_class($classes) {

        //init variables
        $id                      = suprema_qodef_get_page_id();
        $title_animation = 'no';

        if(($meta_temp = get_post_meta($id, "qodef_title_area_animation_meta", true)) !== "") {
            $title_animation = $meta_temp;

        } else {
            $title_animation = suprema_qodef_options()->getOptionValue('title_area_animation');
        }

        $classes[] = 'qodef-animation-'.$title_animation;

        return $classes;

    }

    add_filter('suprema_qodef_title_classes', 'suprema_qodef_title_animation_class');
}

if(!function_exists('suprema_qodef_title_background_image_div_classes')) {
    function suprema_qodef_title_background_image_div_classes($classes) {

        //init variables
        $id                         = suprema_qodef_get_page_id();
        $is_img_responsive 		    = '';
        $show_title_img			    = true;
        $title_img				    = '';

        //is responsive image is set for current page?
        if(($meta_temp = get_post_meta($id, "qodef_title_area_background_image_responsive_meta", true)) != "") {
            $is_img_responsive = $meta_temp;
        } else {
            //take value from theme options
            $is_img_responsive = suprema_qodef_options()->getOptionValue('title_area_background_image_responsive');
        }

        //is title image chosen for current page?
        if(($meta_temp = get_post_meta($id, "qodef_title_area_background_image_meta", true)) != ""){
            $title_img = $meta_temp;
        }else{
            //take image that is set in theme options
            $title_img = suprema_qodef_options()->getOptionValue('title_area_background_image');
        }

        //is title image hidden for current page?
        if(get_post_meta($id, "qodef_hide_background_image_meta", true) == "yes") {
            $show_title_img = false;
        }

        //is title image set, visible and responsive?
        if($title_img !== '' && $show_title_img == true) {

            //is image responsive?
            if($is_img_responsive == 'yes') {
                $classes[] = 'qodef-title-image-responsive';
            }
            //is image not responsive?
            elseif($is_img_responsive == 'no') {
                $classes[] = 'qodef-title-image-not-responsive';
            }
        }

        return $classes;
    }

    add_filter('suprema_qodef_title_classes', 'suprema_qodef_title_background_image_div_classes');
}