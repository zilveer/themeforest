<?php

class WPBakeryShortCode_testimonial_carousel extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $order = $page_link = $items = $item_class = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
           	'item_count'	=> '-1',
           	'order'	=> '',
        	'category'		=> 'all',
        	'pagination'	=> 'no',
        	'page_link'	=> '',
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = '';
        
        // CATEGORY SLUG MODIFICATION
        if ($category == "All") {$category = "all";}
        if ($category == "all") {$category = '';}
        $category_slug = str_replace('_', '-', $category);
        
        
        // TESTIMONIAL QUERY SETUP
        
		global $post, $wp_query, $carouselID;
		
		if ($carouselID == "") {
		$carouselID = 1;
		} else {
		$carouselID++;
		}
        
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
        
        $sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }
        
        if ($width == "1/1") {
        	if ($sidebars == "both-sidebars") {
        	$item_class = "span6";
        	} else if ($sidebars == "one-sidebar") {
        	$item_class = "span8";
        	} else {
        	$item_class = "span12";
        	}
        } else if ($width == "1/2") {
        	if ($sidebars == "both-sidebars") {
        	$item_class = "span3";
        	} else if ($sidebars == "one-sidebar") {
        	$item_class = "span4";
        	} else {
        	$item_class = "span6";
        	}
        } else if ($width == "3/4") {
        	if ($sidebars == "both-sidebars") {
        	$item_class = "span-bs-threequarter";
        	} else if ($sidebars == "one-sidebar") {
        	$item_class = "span6";
        	} else {
        	$item_class = "span9";
        	}
        } else if ($width == "1/4") {
        	if ($sidebars == "both-sidebars") {
        	$item_class = "span-bs-quarter";
        	} else if ($sidebars == "one-sidebar") {
        	$item_class = "span2";
        	} else {
        	$item_class = "span3";
        	}
        }
                
        $items .= '<ul id="carousel-'.$carouselID.'" class="testimonials carousel-items clearfix" data-columns="1">';
        
        // PORTFOLIO LOOP
        
        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        	
        	$testimonial_text = get_the_content();
        	$testimonial_cite = get_post_meta($post->ID, 'sf_testimonial_cite', true);
        	
        	$items .= '<li class="testimonial carousel-item '.$item_class.' clearfix">';
        	$items .= '<div class="testimonial-text">'.do_shortcode($testimonial_text).'</div>'; 
        	$items .= '<cite>'.$testimonial_cite.'</cite>';
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul>';
       	
       	$items .= '<a href="#" class="prev"><i class="icon-chevron-left"></i></a><a href="#" class="next"><i class="icon-chevron-right"></i></a>';
       	
   		if ($page_link == "yes") {
	        $options = get_option('sf_flexform_options');
	        $testimonials_page = __($options['testimonial_page'], 'swiftframework');
	        if ($testimonials_page) {
	        $testimonials_page_title = get_page_by_path( $testimonials_page );
	        	if (isset($testimonials_page_title)) {
	        		$testimonials_page_id = $testimonials_page_title->ID;   
	        	}
        	}
        
			if ($testimonials_page && isset($testimonials_page_title)) {
				$items .= '<a href="'.get_permalink($testimonials_page_id).'" class="read-more">'.__("More", "swiftframework").'<i class="icon-angle-right"></i></a>';
			}
		}

        $width = wpb_translateColumnWidthToSpan($width);                					        
        $el_class = $this->getExtraClass($el_class);

        $el_class .= ' testimonial';

		$output .= "\n\t".'<div class="wpb_testimonial_carousel_widget wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper carousel-wrap">';
        if ($title != '') {
        $output .= "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading">'.$title.'</h3></div>';
        } else {
        $output .= "\n\t\t\t".'<div class="heading-wrap"></div>';
       	}
        $output .= "\n\t\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $include_carousel, $include_isotope;
        $include_carousel = true;
        $include_isotope = true;
        
        return $output;
    }
}

WPBMap::map( 'testimonial_carousel', array(
    "name"		=> __("Testimonials Carousel", "js_composer"),
    "base"		=> "testimonial_carousel",
    "class"		=> "wpb_testimonial_carousel wpb_carousel",
    "icon"      => "icon-wpb-testimonial_carousel",
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
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show per page. Leave blank to show ALL testimonials.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials Order", "js_composer"),
            "param_name" => "order",
            "value" => array(__('Random', "js_composer") => "rand", __('Latest', "js_composer") => "date"),
            "description" => __("Choose the order of the testimonials.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('testimonials-category'),
            "description" => __("Choose the category for the testimonials.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Testimonials page link", "js_composer"),
            "param_name" => "page_link",
            "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
            "description" => __("Include a link to the testimonials page (which you must choose in the theme options).", "js_composer")
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