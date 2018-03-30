<?php

class WPBakeryShortCode_faqs extends WPBakeryShortCode {

    public function content( $atts, $content = null ) {

        $el_class = $width = $el_position = '';

        extract(shortcode_atts(array(
            'el_class' => '',
            'el_position' => '',
            'width' => '1/2'
        ), $atts));

        $output = $items_nav = $items = '';
           
       	// get all the categories from the database
       	$cat_args = array('taxonomy' => 'faqs-category');
       	$cats = get_categories( $cat_args ); 
       	
       	// FAQ NAVIGATION
       	
       	$items_nav .= '<h3>'.__("Browse F.A.Q. Topics", "swiftframework").'</h3>';
       	
       	$items_nav .= '<ul class="faqs-nav clearfix">';
       	foreach ($cats as $cat) {
	       	if ( function_exists( 'icl_object_id' ) ) {
	       		if ( $cat->term_id != icl_object_id( $cat->term_id, 'faqs-category', false, ICL_LANGUAGE_CODE ) ) {
	       			return;
	       		}
       		}
       		$items_nav .= '<li><a href="#'.$cat->slug.'"><i class="icon-list"></i>'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
       	}
       	$items_nav .= '</ul>';
       	
       	
       	// FAQ LISTINGS
         
		foreach ($cats as $cat) {
			
			// setup the category ID
			$cat_id= $cat->term_id;
			
			if ( function_exists( 'icl_object_id' ) ) {
				if ( $cat_id != icl_object_id( $cat_id, 'faqs-category', false, ICL_LANGUAGE_CODE ) ) {
					return;
				}
			}
		
			// Make a header for the cateogry
			$items .= '<h3 class="faq-section-title" id="'.$cat->slug.'">'.$cat->name.'</h3>';
		
			$faqs_args = array(
				'post_type' => 'faqs',
				'post_status' => 'publish',
				'faqs-category' => $cat->slug,
				'posts_per_page' => 100
				);
				    		
			$faqs = new WP_Query( $faqs_args );
						
			$items .= '<ul class="faqs-section clearfix">';
			
			// PORTFOLIO LOOP
			
			while ( $faqs->have_posts() ) : $faqs->the_post();
				
				$faq_title = get_the_title();
				$faq_text = get_the_content_with_formatting();
				
				$items .= '<li class="faq-item">';
				$items .= '<h6>'.$faq_title.'</h6>';
				$items .= '<div class="faq-text">'.do_shortcode($faq_text).'</div>'; 
				$items .= '</li>';
							
			endwhile;
			
			$items .= '<div class="wpb_divider go_to_top_icon1 wpb_content_element "><a class="animate-top" href="#"><i class="icon-arrow-up"></i></a></div>';
			$items .= '</ul>';
			
			
			wp_reset_postdata();
		}

        $el_class = $this->getExtraClass($el_class);
        $width = wpb_translateColumnWidthToSpan($width);
        
        $output .= "\n\t".'<div class="wpb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="wpb_wrapper faqs-wrap">';
        $output .= "\n\t\t\t". $items_nav;
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

WPBMap::map( 'faqs', array(
    "name"		=> __("FAQs", "js_composer"),
    "base"		=> "faqs",
    "class"		=> "",
    "icon"      => "icon-wpb-faqs",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
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