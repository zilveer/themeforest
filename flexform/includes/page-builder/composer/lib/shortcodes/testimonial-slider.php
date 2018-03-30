<?php

class WPBakeryShortCode_testimonial_slider extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $order = $text_size = $item_count = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'text_size' => '',
           	'item_count'	=> '',
           	'order'	=> '',
        	'category'		=> 'all',
        	'animation'		=> 'fade',
        	'autoplay'		=> 'yes',
            'el_class' => '',
            'alt_background'	=> 'none',
            'el_position' => '',
            'width' => '1/1'
        ), $atts));

        $output = '';
        
        // CATEGORY SLUG MODIFICATION
        if ($category == "All") {$category = "all";}
        if ($category == "all") {$category = '';}
        $category_slug = str_replace('_', '-', $category);
        
        
        // TESTIMONIAL QUERY SETUP
        
        global $post, $wp_query;
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            		
        $testimonials_args = array(
        	'orderby' => $order,
        	'post_type' => 'testimonials',
        	'post_status' => 'publish',
        	'paged' => $paged,
        	'testimonials-category' => $category_slug,
        	'posts_per_page' => $item_count
        	);
        	    		
        $testimonials = new WP_Query( $testimonials_args );
        
        if ($autoplay == "yes") {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="yes"><ul class="slides">';
        } else {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="no"><ul class="slides">';
        }
                  
        // PORTFOLIO LOOP
        
        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        	
        	$testimonial_text = get_the_content();
        	$testimonial_cite = get_post_meta($post->ID, 'sf_testimonial_cite', true);
        	
        	$items .= '<li class="testimonial">';
        	$items .= '<div class="testimonial-text text-'.$text_size.'">'.do_shortcode($testimonial_text).'</div>'; 
        	$items .= '<cite>'.$testimonial_cite.'</cite>';
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul></div>';
       				        
        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }

        $el_class .= ' testimonial';
        
        if ($alt_background == "none" || $sidebars != "no-sidebars") {
		$output .= "\n\t".'<div class="wpb_testimonial_slider_widget wpb_content_element '.$width.$el_class.'">';
        } else {
        $output .= "\n\t".'<div class="wpb_testimonial_slider_widget wpb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';            
        }
        $output .= "\n\t\t".'<div class="wpb_wrapper slider-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading">'.$title.'</h3></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $include_carousel;
        $include_carousel = true;
        
        return $output;
    }
}

WPBMap::map( 'testimonial_slider', array(
    "name"		=> __("Testimonials Slider", "js_composer"),
    "base"		=> "testimonial_slider",
    "class"		=> "wpb_testimonial_slider wpb_slider",
    "icon"      => "icon-wpb-testimonial_slider",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "js_composer"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "js_composer")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "js_composer"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "js_composer") => "normal", __('Large', "js_composer") => "large"),
            "description" => __("Choose the size of the text.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show. Leave blank to show ALL testimonials.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials Order", "js_composer"),
            "param_name" => "order",
            "value" => array(__('Random', "js_composer") => "rand", __('Latest', "js_composer") => "date"),
            "description" => __("Choose the order of the testimonials.", "js_composer")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Testimonials category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('testimonials-category'),
            "description" => __("Choose the category for the testimonials.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider animation", "js_composer"),
            "param_name" => "animation",
            "value" => array(__('Fade', "js_composer") => "fade", __('Slide', "js_composer") => "slide"),
            "description" => __("Choose the animation for the slider.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "js_composer"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "js_composer") => "yes", __('No', "js_composer") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "js_composer"),
            "param_name" => "alt_background",
            "value" => array(__("None", "js_composer") => "none", __("Alt 1", "js_composer") => "alt-one", __("Alt 2", "js_composer") => "alt-two", __("Alt 3", "js_composer") => "alt-three", __("Alt 4", "js_composer") => "alt-four", __("Alt 5", "js_composer") => "alt-five", __("Alt 6", "js_composer") => "alt-six", __("Alt 7", "js_composer") => "alt-seven", __("Alt 8", "js_composer") => "alt-eight", __("Alt 9", "js_composer") => "alt-nine", __("Alt 10", "js_composer") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Flexform Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "js_composer")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "js_composer"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>