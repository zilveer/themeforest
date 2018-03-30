<?php

class WPBakeryShortCode_clients extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $output = $tax_terms = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'item_count'	=> '-1',
	        	'category'		=> '',
	        	'pagination'	=> 'no',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    // CLIENTS QUERY SETUP
    		
    		global $post, $wp_query;
    		
    		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    		    		
    		$client_args=array(
	    		'post_type' => 'clients',
	    		'post_status' => 'publish',
	    		'paged' => $paged,
	    		'clients-category' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
       		    		
    		$clients_items = new WP_Query( $client_args );
    					
			$items .= '<ul class="clients-items clearfix">';
			
			$client_width = 124;
			$client_height = 124;
			
			// CLIENTS LOOP
			
			while ( $clients_items->have_posts() ) : $clients_items->the_post();
			
				$client_image = get_post_thumbnail_id();
				$client_img_url = wp_get_attachment_url( $client_image, 'full' );
				$client_link_url = get_post_meta($post->ID, 'sf_client_link', true);
				    				
				$items .= '<li class="clearfix client-item">';
				    				
				$items .= '<figure>';
					
				$image = aq_resize( $client_img_url, $client_width, $client_height, true, false);
				
				if($image) {
				
					if ($client_link_url) {
					$items .= '<a href="'.$client_link_url.'" target="_blank"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></a>';
					} else {
					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
					}
					
				}
				
				$items .= '</figure>';
							
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>';
			
			
			// PAGINATION
			
			if ($pagination == "yes") {
			
				$items .= '<div class="pagination-wrap">';
				
				$items .= pagenavi($clients_items);
									
				$items .= '</div>';
			
			}
			
			// PAGE BUILDER OUPUT
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_clients_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper clients-wrap">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading wpb_text_heading">'.$title.'</h3></div>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'clients', array(
    "name"		=> __("Clients", "js_composer"),
    "base"		=> "clients",
    "class"		=> "clients",
    "icon"      => "icon-wpb-clients",
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
            "value" => "12",
            "description" => __("The number of clients to show per page. Leave blank to show ALL clients.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Clients category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('clients-category'),
            "description" => __("Choose the category for the client items.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pagination", "js_composer"),
            "param_name" => "pagination",
            "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
            "description" => __("Show clients pagination.", "js_composer")
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


class WPBakeryShortCode_clients_featured extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		   	$title = $width = $el_class = $output = $wrap_span = $tax_terms = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	'category'		=> '',
	        	'item_count'	=> '5',
	        	'alt_background'	=> 'none',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
		    if ($category == "all") {$category = '';}
		    $category_slug = str_replace('_', '-', $category);
		    
		    // CLIENTS QUERY SETUP
    		
    		global $post, $wp_query;
    		
    		$sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
    		$sidebars = '';
    		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
    		$wrap_span = "span6";
    		$sidebars = 'one-sidebar';
    		} else if ($sidebar_config == "both-sidebars") {
    		$wrap_span = "span4";
    		$sidebars = 'both-sidebars';
    		} else {
    		$wrap_span = "span10";
    		$sidebars = 'no-sidebars';
    		}
       		    		    		
    		$client_args=array(
	    		'post_type' => 'clients',
	    		'post_status' => 'publish',
	    		'clients-category' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
       		    		
    		$clients_items = new WP_Query( $client_args );
    		
    		$items .= '<h4 class="span2">'.$title.'</h4>';
    				
    		$items .= '<div class="featured-clients-items-wrap '.$wrap_span.'">';
			$items .= '<ul class="featured-clients-items row clearfix">';
			
			$client_width = 300;
			$client_height = NULL;
			
			// CLIENTS LOOP
			
			while ( $clients_items->have_posts() ) : $clients_items->the_post();
			
				$client_image = get_post_thumbnail_id();
				$client_img_url = wp_get_attachment_url( $client_image, 'full' );
				$client_link_url = get_post_meta($post->ID, 'sf_client_link', true);
				    				
				$items .= '<li class="clearfix span2">';
				    				
				$items .= '<figure>';
					
				$image = aq_resize( $client_img_url, $client_width, $client_height, true, false);
				
				if($image) {
				
					if ($client_link_url) {
					$items .= '<a href="'.$client_link_url.'" target="_blank"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" /></a>';
					} else {
					$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
					}
					
				}
				
				$items .= '</figure>';
							
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul></div>';
			
			// PAGE BUILDER OUPUT
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            if ($alt_background == "none" || $sidebars != "no-sidebars") {
            $output .= "\n\t".'<div class="wpb_featured_clients_widget wpb_content_element '.$width.$el_class.'">';
            } else {
            $output .= "\n\t".'<div class="wpb_featured_clients_widget wpb_content_element alt-bg '.$alt_background.' '.$width.$el_class.'">';
            }
            
            $output .= "\n\t\t".'<div class="wpb_wrapper clients-wrap row">';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'clients_featured', array(
    "name"		=> __("Clients (Featured)", "js_composer"),
    "base"		=> "clients_featured",
    "class"		=> "clients_featured",
    "icon"      => "icon-wpb-clients-featured",
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
            "heading" => __("Clients category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('clients-category'),
            "description" => __("Choose the category for the client items.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "5",
            "description" => __("The number of clients to show per page. Leave blank to show ALL clients.", "js_composer")
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