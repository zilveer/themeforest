<?php

class SwiftPageBuilderShortcode_testimonial_slider extends SwiftPageBuilderShortcode {

    public function content( $atts, $content = null ) {

        $title = $order = $text_size = $items = $el_class = $width = $el_position = '';

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
        	'posts_per_page' => $item_count,
        	'no_found_rows' => 1,
        	);
        	    		
        $testimonials = new WP_Query( $testimonials_args );
        
        if ($autoplay == "yes") {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="yes"><ul class="slides">';
        } else {
        $items .= '<div class="flexslider testimonials-slider content-slider" data-animation="'.$animation.'" data-autoplay="no"><ul class="slides">';
        }
                  
        // TESTIMONIAL LOOP
        
        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        	
        	$testimonial_text = get_the_content();
        	$testimonial_cite = sf_get_post_meta($post->ID, 'sf_testimonial_cite', true);
        	
        	$items .= '<li class="testimonial">';
        	$items .= '<div class="testimonial-text text-'.$text_size.'">'.do_shortcode($testimonial_text).'</div>'; 
        	$items .= '<cite>'.$testimonial_cite.'</cite>';
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul></div>';
       				        
        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
        
        $sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }

        $el_class .= ' testimonial';
        
        // Full width setup
        $fullwidth = false;
        if ($alt_background != "none") {
        $fullwidth = true;
        }
        
		$output .= "\n\t".'<div class="spb_testimonial_slider_widget spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper slider-wrap">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h4 class="spb_heading spb_text_heading"><span>'.$title.'</span></h4></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position, $width, $fullwidth, false, $alt_background) . $output . $this->endRow($el_position, $width, $fullwidth, false);
        
        global $include_carousel;
        $include_carousel = true;
        
        return $output;
    }
}

SPBMap::map( 'testimonial_slider', array(
    "name"		=> __("Testimonials Slider", "swiftframework"),
    "base"		=> "testimonial_slider",
    "class"		=> "spb_testimonial_slider spb_slider",
    "icon"      => "spb-icon-testimonial_slider",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swiftframework"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "swiftframework"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "swiftframework") => "normal", __('Large', "swiftframework") => "large"),
            "description" => __("Choose the size of the text.", "swiftframework")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swiftframework"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show. Leave blank to show ALL testimonials.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials Order", "swiftframework"),
            "param_name" => "order",
            "value" => array(__('Random', "swiftframework") => "rand", __('Latest', "swiftframework") => "date"),
            "description" => __("Choose the order of the testimonials.", "swiftframework")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Testimonials category", "swiftframework"),
            "param_name" => "category",
            "value" => get_category_list('testimonials-category'),
            "description" => __("Choose the category for the testimonials.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider animation", "swiftframework"),
            "param_name" => "animation",
            "value" => array(__('Fade', "swiftframework") => "fade", __('Slide', "swiftframework") => "slide"),
            "description" => __("Choose the animation for the slider.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "swiftframework"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "swiftframework") => "yes", __('No', "swiftframework") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "swiftframework")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "swiftframework"),
            "param_name" => "alt_background",
            "value" => array(__("None", "swiftframework") => "none", __("Alt 1", "swiftframework") => "alt-one", __("Alt 2", "swiftframework") => "alt-two", __("Alt 3", "swiftframework") => "alt-three", __("Alt 4", "swiftframework") => "alt-four", __("Alt 5", "swiftframework") => "alt-five", __("Alt 6", "swiftframework") => "alt-six", __("Alt 7", "swiftframework") => "alt-seven", __("Alt 8", "swiftframework") => "alt-eight", __("Alt 9", "swiftframework") => "alt-nine", __("Alt 10", "swiftframework") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Neighborhood Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swiftframework")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "swiftframework"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "swiftframework")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swiftframework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
        )
    )
) );

?>