<?php

class WPBakeryShortCode_team extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $title = $width = $el_class = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"item_count"	=> '12',
	        	"category"		=> '',
	        	'pagination'	=> '',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	        // CATEGORY SLUG MODIFICATION
	        if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		global $post, $wp_query;
    		
    		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    		$team_args=array(
	    		'post_type' => 'team',
	    		'post_status' => 'publish',
	    		'paged' => $paged,
	    		'team-category' => $category_slug,
	    		'posts_per_page' => $item_count,
	    		'ignore_sticky_posts'=> 1
    		);    			    		
    		$team_members = new WP_Query( $team_args );
    		
    		$count = 0;
    		    		
			$items .= '<ul class="team-members clearfix">';
	
			while ( $team_members->have_posts() ) : $team_members->the_post();
				
				$member_name = get_the_title();
				$member_position = get_post_meta($post->ID, 'sf_team_member_position', true);
				$member_image = get_post_thumbnail_id();
				$member_page_link = get_permalink();
				   	
				$items .= '<li data-id="id-'. $count .'" class="clearfix team-member four columns">';
				
				$img_url = wp_get_attachment_url( $member_image,'full' );
				$image = aq_resize( $img_url, 220, 298, true, false);
				
				$items .= '<figure>';
							if($image) {
								$items .= '<a href="'. $member_page_link .'"><img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$member_name.'" /></a>';
							}
				$items .= '</figure>';
				
				$items .= '<h4 class="team-member-name">'. $member_name .'</h4>';
				$items .= '<h5 class="team-member-position">'. $member_position .'</h5>';
				$items .= '<a class="read-more" href="'. $member_page_link .'">'. __("Find out more", "swiftframework") .'<i class="icon-chevron-right"></i></a>';
				$items .= '</li>';
				$count++;
				
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>';
    
   		
    		// PAGINATION
    		
    		if ($pagination == "yes") {
    		
	    		$items .= '<div class="pagination-wrap full-width">';
	    		
	    		$items .= pagenavi($team_members);
	    							
	    		$items .= '</div>';
    		
    		}       
    		
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="team_list_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading">'.$title.'</h3>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            return $output;
		
    }
}

WPBMap::map( 'team', array(
    "name"		=> __("Team", "js_composer"),
    "base"		=> "team",
    "class"		=> "team",
    "icon"      => "icon-wpb-team",
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
            "description" => __("The number of team members to show per page.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Team category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('team-category'),
            "description" => __("Choose the category for the portfolio items.", "js_composer")
		),
		array(
		    "type" => "dropdown",
		    "heading" => __("Pagination", "js_composer"),
		    "param_name" => "pagination",
		    "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
		    "description" => __("Show testimonial pagination.", "js_composer")
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