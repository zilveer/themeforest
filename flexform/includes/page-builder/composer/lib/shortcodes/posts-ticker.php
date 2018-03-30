<?php

class WPBakeryShortCode_posts_ticker extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $width = $excerpt_length = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	'title' => '',
	        	"item_count"	=> '4',
	        	"category"		=> '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		global $post, $wp_query;
    		
    		$args=array(
	    		'post_type' => 'post',
	    		'post_status' => 'publish',
	    		'category_name' => $category_slug,
	    		'posts_per_page' => $item_count
       		);
    		$blog_items = query_posts($args);
    		
    		if( have_posts() ) {
    		
    			$items .= '<ul id="posts-ticker" class="news-ticker js-hidden clearfix" data-latesttext="'. __("Latest:", "swiftframework"). '">';
    	
    			while ( have_posts() ) {
    				
    				the_post();
    				
       				$item_title = get_the_title();
    				$post_permalink = get_permalink();
    				    				  
    				$items .= '<li class="news-item">';
    				$items .= '<a href="'.$post_permalink.'" title="'.$item_title.'">'.$item_title.'</a>';
    				$items .= '</li>';
    								    			
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</ul>';
    
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_posts_ticker_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper posts-ticker-wrap">';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    		
    		global $include_ticker;
    		$include_ticker = true;
    		
            $output = $this->startRow($el_position, "ticker-row") . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'posts_ticker', array(
    "name"		=> __("Posts Ticker", "js_composer"),
    "base"		=> "posts_ticker",
    "class"		=> "wpb_posts-ticker",
    "icon"      => "icon-wpb-posts-ticker",
    "params"	=> array(
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "4",
            "description" => __("The number of blog items to show per page.", "js_composer")
        ),
		array(
		  	"type" => "dropdown",
		   	"heading" => __("Posts category", "js_composer"),
		   	"param_name" => "category",
		   	"value" => get_category_list('category'),
		   	"description" => __("Choose the category for the post items.", "js_composer")
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