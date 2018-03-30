<?php

class WPBakeryShortCode_showcase extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $width = $el_class = $output = $items = $image = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	"item_count"	=> '12',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
    		
    		global $post, $wp_query;
    		
    		$args=array(
    		'post_type' => 'showcase',
    		'post_status' => 'publish',
    		'posts_per_page' => $item_count
    		);
    		$showcase_items = query_posts($args);
    		$count = 0;
    		
    		if( have_posts() ) {
    		
    			$items .= '<div class="home-slider-wrap">
    					   <div id="home-slider" class="flexslider">
    					   <ul class="slides">';
    	
    			while ( have_posts() ) {
    				
    				the_post();
    			
    				$items .= '<li>';
    				
    				$thumb = get_post_thumbnail_id();
    				$img_url = wp_get_attachment_url( $thumb,'full' );
   					$image = aq_resize( $img_url, 940, 480, true, false);
    				$slide_link = get_post_meta($post->ID, 'sf_slide_link', true);
    				
    				$items .= '<figure>';
    							if ($slide_link) {
	    							$items .= '<a href="'.$slide_link.'" target="_blank">';
	    							if($image) {
	    								$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
	    							}
    								$items .= '</a>';
    							} else {
    								if($image) {
    									$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
    								}
    							}
    				$items .= '</figure></li>';
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</ul></div></div>';
    
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
           	$output .= "\n\t".'<div class="wpb_showcase_widget wpb_content_element '.$width.$el_class.'">';            
            $output .= "\n\t\t".'<div class="wpb_wrapper showcase-wrap">';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'showcase', array(
    "name"		=> __("Showcase", "js_composer"),
    "base"		=> "showcase",
    "class"		=> "wpb_showcase",
    "icon"      => "icon-wpb-showcase",
    "params"	=> array(
        array(
            "type" => "textfield",
            "class" => "",
            "heading" => __("Number of items", "js_composer"),
            "param_name" => "item_count",
            "value" => "12",
            "description" => __("The number of showcase items to show.", "js_composer")
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

class WPBakeryShortCode_showcase_layerslider extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $width = $el_class = $output = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
	        	"item_count"	=> '12',
	        	"revslider_shortcode"		=> '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
    		   	
    		    $items .= '<div class="home-slider-wrap">';
 				$items .= '[rev_slider '.$revslider_shortcode.']';
    			$items .= '</div>';
      		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
           	$output .= "\n\t".'<div class="wpb_showcase_widget wpb_content_element '.$width.$el_class.'">';            
            $output .= "\n\t\t".'<div class="wpb_wrapper showcase-wrap">';
            $output .= "\n\t\t\t\t".do_shortcode($items);
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'showcase_layerslider', array(
    "name"		=> __("Revolution Slider", "js_composer"),
    "base"		=> "showcase_layerslider",
    "class"		=> "wpb_showcase_layerslider",
    "icon"      => "icon-wpb-showcase-layer",
    "params"	=> array(
        array(
            "type" => "textfield",
            "heading" => __("Revolution Slider Alias", "js_composer"),
            "param_name" => "revslider_shortcode",
            "value" => "",
            "description" => __("Enter the Revolution Slider alias here for the one that you wish to show. This can be found within the Revolution Slider Admin Panel.", "js_composer")
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