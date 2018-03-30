<?php

class SwiftPageBuilderShortcode_faqs extends SwiftPageBuilderShortcode {

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
       		$items_nav .= '<li><a href="#'.$cat->slug.'" class="smooth-scroll-link"><i class="ss-rows"></i>'.$cat->name.'<span class="count">'.$cat->count.'</span></a></li>';
       	}
       	$items_nav .= '</ul>';
       	
       	
       	// FAQ LISTINGS
         
		foreach ($cats as $cat) {
			
			// setup the category ID
			$cat_id= $cat->term_id;
		
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
			
			// FAQS LOOP
			
			while ( $faqs->have_posts() ) : $faqs->the_post();
				
				$faq_title = get_the_title();
				$faq_text = get_the_content();
				
				$items .= '<li class="faq-item">';
				$items .= '<h6>'.$faq_title.'</h6>';
				$items .= '<div class="faq-text">'.do_shortcode($faq_text).'</div>'; 
				$items .= '</li>';
							
			endwhile;
			
			$items .= '<div class="spb_divider go_to_top_icon1 spb_content_element "><a class="animate-top" href="#"><i class="ss-up"></i></a></div>';
			$items .= '</ul>';
			
			
			wp_reset_postdata();
		}

        $el_class = $this->getExtraClass($el_class);
        $width = spb_translateColumnWidthToSpan($width);
        
        $output .= "\n\t".'<div class="spb_content_element '.$width.$el_class.'">';
        $output .= "\n\t\t".'<div class="spb_wrapper faqs-wrap">';
        $output .= "\n\t\t\t". $items_nav;
        $output .= "\n\t\t\t". $items;
        $output .= "\n\t\t".'</div> ' . $this->endBlockComment('.spb_wrapper');
        $output .= "\n\t".'</div> ' . $this->endBlockComment($width);

        //
        $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
        return $output;
    }
}

SPBMap::map( 'faqs', array(
    "name"		=> __("FAQs", "swift-framework-admin"),
    "base"		=> "faqs",
    "class"		=> "",
    "icon"      => "spb-icon-faqs",
    "wrapper_class" => "clearfix",
    "controls"	=> "full",
    "params"	=> array(
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