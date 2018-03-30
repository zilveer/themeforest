<?php

class WPBakeryShortCode_testimonial extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $title = $order = $page_link = $text_size = $items = $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
        	'title' => '',
        	'text_size' => '',
           	'item_count'	=> '-1',
           	'order'	=> '',
        	'category'		=> '',
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
                
        $items .= '<ul class="testimonials clearfix">';
        
        // PORTFOLIO LOOP
        
        while ( $testimonials->have_posts() ) : $testimonials->the_post();
        	
        	$testimonial_text = get_the_content();
        	$testimonial_cite = get_post_meta($post->ID, 'sf_testimonial_cite', true);
        	
        	$items .= '<li class="testimonial">';
        	$items .= '<div class="testimonial-text">'.do_shortcode($testimonial_text).'</div>'; 
        	$items .= '<cite>'.$testimonial_cite.'</cite>';
        	$items .= '</li>';
        	        
        endwhile;
        
        wp_reset_postdata();
        		
        $items .= '</ul>';
       
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
        
        // PAGINATION
        
        if ($pagination == "yes") {
        
        $items .= '<div class="pagination-wrap">';
        
        if($testimonials->max_num_pages>1){
        	
        	$items .= '<ul>';
        
            for($i=1;$i<=$testimonials->max_num_pages;$i++) {
            	if ($i == $paged) {
            		$items .= '<li><span>'.$i.'</span></li>';
            	} else {
             		$items .= '<li><a href="'. get_permalink() .'page/'.$i.'">'.$i.'</a></li>';
            	}
            }
            
            $items .= '</ul>';
            
        }
        					
        $items .= '</div>';
        
        }       

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);

        $el_class .= ' testimonial';

        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper testimonial-wrap '.$text_size.'">';
        $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading"><span>'.$title.'</span></h3></div>' : '';
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'testimonial', array(
    "name"		=> __("Testimonials", "js_composer"),
    "base"		=> "testimonial",
    "class"		=> "",
    "icon"      => "icon-wpb-testimonial",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
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
            "heading" => __("Pagination", "js_composer"),
            "param_name" => "pagination",
            "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
            "description" => __("Show testimonial pagination (1/1 width element only).", "js_composer")
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