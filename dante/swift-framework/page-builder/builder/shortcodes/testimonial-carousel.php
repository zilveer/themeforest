<?php

class SwiftPageBuilderShortcode_testimonial_carousel extends SwiftPageBuilderShortcode {

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
        
		global $post, $wp_query, $sf_carouselID;
		
		if ($sf_carouselID == "") {
		$sf_carouselID = 1;
		} else {
		$sf_carouselID++;
		}
        
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
        
        $sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
        
        $sidebars = '';
        if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
        $sidebars = 'one-sidebar';
        } else if ($sidebar_config == "both-sidebars") {
        $sidebars = 'both-sidebars';
        } else {
        $sidebars = 'no-sidebars';
        }
        
        global $column_width;
                
        if ($column_width != "") {
        	if ($column_width == "1/1") {
        		if ($sidebars == "both-sidebars") {
        		$item_class = "span6";
        		} else if ($sidebars == "one-sidebar") {
        		$item_class = "span8";
        		} else {
        		$item_class = "span12";
        		}
        	} else if ($column_width == "1/2") {
        		if ($sidebars == "both-sidebars") {
        		$item_class = "span3";
        		} else if ($sidebars == "one-sidebar") {
        		$item_class = "span4";
        		} else {
        		$item_class = "span6";
        		}
        	} else if ($column_width == "3/4") {
        		if ($sidebars == "both-sidebars") {
        		$item_class = "span-bs-threequarter";
        		} else if ($sidebars == "one-sidebar") {
        		$item_class = "span6";
        		} else {
        		$item_class = "span9";
        		}
        	} else if ($column_width == "1/4") {
        		if ($sidebars == "both-sidebars") {
        		$item_class = "span-bs-quarter";
        		} else if ($sidebars == "one-sidebar") {
        		$item_class = "span2";
        		} else {
        		$item_class = "span3";
        		}
        	}
        } else if ($width == "1/1") {
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
                
        $items .= '<div class="carousel-wrap">';
        $items .= '<div id="carousel-'.$sf_carouselID.'" class="testimonials carousel-items clearfix" data-columns="1">';
        
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
        	
        	$items .= '<div class="testimonial carousel-item '.$item_class.' clearfix">';
        	$items .= '<div class="testimonial-text">'.do_shortcode($testimonial_text).'</div>'; 
        	$items .= '<div class="testimonial-cite">';		
        	if ($testimonial_image) {
        	$items .= '<img src="'.$testimonial_image[0].'" width="'.$testimonial_image[1].'" height="'.$testimonial_image[2].'" alt="'.$testimonial_cite.'" />';
        	$items .= '<div class="cite-text has-cite-image"><span class="cite-name">'.$testimonial_cite.'</span><span>'.$testimonial_cite_subtext.'</span></div>';
        	} else {
        	$items .= '<div class="cite-text"><span class="cite-name">'.$testimonial_cite.'</span><span>'.$testimonial_cite_subtext.'</span></div>';
        	}
        	$items .= '</div>';
        	$items .= '</div>';
        	        
        endwhile;
        
        $items .= '</div>';
        	
        $items .= '<a href="#" class="carousel-prev"><i class="fa-chevron-left"></i></a><a href="#" class="carousel-next"><i class="fa-chevron-right"></i></a>';
        
       	$options = get_option('sf_dante_options');
       	if ($options['enable_swipe_indicators']) {
       	$items .= '<div class="sf-swipe-indicator"></div>';
       	}
       	
       	$items .= '</div>';
       	
   		if ($page_link == "yes") {
	        $options = get_option('sf_dante_options');
	        $testimonials_page = __($options['testimonial_page'], 'swiftframework');
	               
			if ($testimonials_page) {
				$items .= '<a href="'.get_permalink($testimonials_page).'" class="read-more">'.__("More", "swiftframework").'<i class="ssnavigate-right"></i></a>';
			}
		}

        $width = spb_translateColumnWidthToSpan($width);                					        
        $el_class = $this->getExtraClass($el_class);

        $el_class .= ' testimonial';

		$output .= "\n\t".'<div class="spb_testimonial_carousel_widget spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper carousel-wrap">';
        if ($title != '') {
        $output .= "\n\t\t\t".'<h3 class="spb-heading"><span>'.$title.'</span></h3>';
        }
        $output .= "\n\t\t\t\t".$items;
        $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> '.$this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        
        global $sf_include_carousel, $sf_include_isotope;
        $sf_include_carousel = true;
        $sf_include_isotope = true;
        
        return $output;
    }
}

SPBMap::map( 'testimonial_carousel', array(
    "name"		=> __("Testimonials Carousel", "swift-framework-admin"),
    "base"		=> "testimonial_carousel",
    "class"		=> "spb_testimonial_carousel spb_carousel",
    "icon"      => "spb-icon-testimonial_carousel",
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
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "swift-framework-admin"),
            "param_name" => "item_count",
            "value" => "6",
            "description" => __("The number of testimonials to show per page. Leave blank to show ALL testimonials.", "swift-framework-admin")
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
            "heading" => __("Testimonials page link", "swift-framework-admin"),
            "param_name" => "page_link",
            "value" => array(__('No', "swift-framework-admin") => "no", __('Yes', "swift-framework-admin") => "yes"),
            "description" => __("Include a link to the testimonials page (which you must choose in the theme options).", "swift-framework-admin")
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