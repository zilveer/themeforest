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
        	$testimonial_cite_subtext = sf_get_post_meta($post->ID, 'sf_testimonial_cite_subtext', true);
        	
        	$testimonial_image = rwmb_meta('sf_testimonial_cite_image', 'type=image', $post->ID);
        			
        	foreach ($testimonial_image as $detail_image) {
        		$testimonial_image_url = $detail_image['url'];
        		break;
        	}
        									
        	if (!$testimonial_image) {
        		$testimonial_image = get_post_thumbnail_id();
        		$testimonial_image_url = wp_get_attachment_url( $testimonial_image, 'full' );
        	}
        	
        	$testimonial_image = sf_aq_resize( $testimonial_image_url, 70, 70, true, false);
        	
        	$items .= '<li class="testimonial">';
        	$items .= '<div class="testimonial-text text-'.$text_size.'">'.do_shortcode($testimonial_text).'</div>';
        	if ($testimonial_image) {
        		$items .= '<div class="testimonial-cite has-image">';		
        		$items .= '<img src="'.$testimonial_image[0].'" width="'.$testimonial_image[1].'" height="'.$testimonial_image[2].'" alt="'.$testimonial_cite.'" />';
        		if ($testimonial_cite_subtext != "") {
        		$items .= '<cite>'.$testimonial_cite.'<span>'.$testimonial_cite_subtext.'</span></cite>';
        		} else {
        		$items .= '<cite>'.$testimonial_cite.'</cite>';
        		}
        	} else {
        		$items .= '<div class="testimonial-cite">';		
        		if ($testimonial_cite_subtext != "") {
        		$items .= '<cite>'.$testimonial_cite.'<span>'.$testimonial_cite_subtext.'</span></cite>';
        		} else {
        		$items .= '<cite>'.$testimonial_cite.'</cite>';
        		}
        	}
        	$items .= '</div>';
        	
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
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="spb-heading spb-center-heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position, $width, $fullwidth, false, $alt_background) . $output . $this->endRow($el_position, $width, $fullwidth, false);
        
        global $sf_include_carousel;
        $sf_include_carousel = true;
        
        return $output;
    }
}

SPBMap::map( 'testimonial_slider', array(
    "name"		=> __("Testimonials Slider", "swift-framework-admin"),
    "base"		=> "testimonial_slider",
    "class"		=> "spb_testimonial_slider spb_slider",
    "icon"      => "spb-icon-testimonial_slider",
    "wrapper_class" => "clearfix",
    "params"	=> array(
    	array(
    	    "type" => "textfield",
    	    "heading" => __("Widget title", "swift-framework-admin"),
    	    "param_name" => "title",
    	    "value" => "",
    	    "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
    	),
        array(
            "type" => "dropdown",
            "heading" => __("Text size", "swift-framework-admin"),
            "param_name" => "text_size",
            "value" => array(__('Normal', "swift-framework-admin") => "normal", __('Large', "swift-framework-admin") => "large"),
            "description" => __("Choose the size of the text.", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-framework-admin"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show. Leave blank to show ALL testimonials.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials Order", "swift-framework-admin"),
            "param_name" => "order",
            "value" => array(__('Random', "swift-framework-admin") => "rand", __('Latest', "swift-framework-admin") => "date"),
            "description" => __("Choose the order of the testimonials.", "swift-framework-admin")
        ),
        array(
            "type" => "select-multiple",
            "heading" => __("Testimonials category", "swift-framework-admin"),
            "param_name" => "category",
            "value" => sf_get_category_list('testimonials-category'),
            "description" => __("Choose the category for the testimonials.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Slider autoplay", "swift-framework-admin"),
            "param_name" => "autoplay",
            "value" => array(__('Yes', "swift-framework-admin") => "yes", __('No', "swift-framework-admin") => "no"),
            "description" => __("Select if you want the slider to autoplay or not.", "swift-framework-admin")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Show alt background", "swift-framework-admin"),
            "param_name" => "alt_background",
            "value" => array(__("None", "swift-framework-admin") => "none", __("Alt 1", "swift-framework-admin") => "alt-one", __("Alt 2", "swift-framework-admin") => "alt-two", __("Alt 3", "swift-framework-admin") => "alt-three", __("Alt 4", "swift-framework-admin") => "alt-four", __("Alt 5", "swift-framework-admin") => "alt-five", __("Alt 6", "swift-framework-admin") => "alt-six", __("Alt 7", "swift-framework-admin") => "alt-seven", __("Alt 8", "swift-framework-admin") => "alt-eight", __("Alt 9", "swift-framework-admin") => "alt-nine", __("Alt 10", "swift-framework-admin") => "alt-ten"),
            "description" => __("Show an alternative background around the asset. These can all be set in Theme Options > Asset Background Options. NOTE: This is only available on a page with the no sidebar setup.", "swift-framework-admin")
        ),
        array(
            "type" => "altbg_preview",
            "heading" => __("Alt Background Preview", "swift-framework-admin"),
            "param_name" => "altbg_preview",
            "value" => "",
            "description" => __("", "swift-framework-admin")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swift-framework-admin"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swift-framework-admin")
        )
    )
) );

?>