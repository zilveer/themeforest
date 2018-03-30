<?php

class SwiftPageBuilderShortcode_team_carousel extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		    $title = $show_hide = $width = $item_class = $el_class = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"category"		=> 'all',
	        	'social_icon_type' => 'dark',
	        	'el_position' => '',
	        	'width' => '1/1',
	        	'el_class' => ''
	        ), $atts));
	        
	       	// CATEGORY SLUG MODIFICATION
	      	if ($category == "All") {$category = "all";}
	        if ($category == "all") {$category = '';}
	        $category_slug = str_replace('_', '-', $category);
		    
    		global $post, $wp_query, $sf_carouselID;
    		
    		if ($sf_carouselID == "") {
    		$sf_carouselID = 1;
    		} else {
    		$sf_carouselID++;
    		}
    		
    		$args=array(
	    		'post_type' => 'team',
	    		'post_status' => 'publish',
	    		'team-category' => $category_slug,
	    		'posts_per_page' => -1,
	    		'ignore_sticky_posts'=> 1,
	    		'no_found_rows' => 1,
    		);
    		$team_members = query_posts($args);
    		
    		$count = $columns = 0;
 		
    		$sidebar_config = sf_get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
    		if (is_singular('portfolio')) {
    		$sidebar_config = "no-sidebars";
    		}
    		
    		if (($sidebar_config == "left-sidebar") || ($sidebar_config == "right-sidebar")) {
    		$item_class = 'span2';
    		} else if ($sidebar_config == "both-sidebars") {
    		$item_class = 'span-bs-quarter';
    		} else {
    		$item_class = 'span3';
    		}
    		
    		if ($width == "1/4") {
    		$columns = 1;
    		} else if ($width == "1/2") {
    		$columns = 2;
    		} else if ($width == "3/4") {
    		$columns = 3;
    		} else {
    		$columns = 4;
    		}
    		
    		$list_class = '';  		
    		if ($show_hide == "yes") { $list_class = 'has-show-hide'; }
    		
    		if( have_posts() ) {
    		
    			$items .= '<div class="carousel-wrap">';
    			$items .= '<div id="carousel-'.$sf_carouselID.'" class="team-members carousel-items '.$list_class.' clearfix" data-columns="'.$columns.'">';
    	
    			while ( have_posts() ) {
    				
    				the_post();
    				
    				$member_name = get_the_title();
    				$member_position = sf_get_post_meta($post->ID, 'sf_team_member_position', true);
    				$member_bio = get_the_content();
    				$member_email = sf_get_post_meta($post->ID, 'sf_team_member_email', true);
    				$member_phone = sf_get_post_meta($post->ID, 'sf_team_member_phone_number', true);
    				$member_twitter = sf_get_post_meta($post->ID, 'sf_team_member_twitter', true);
    				$member_facebook = sf_get_post_meta($post->ID, 'sf_team_member_facebook', true);
    				$member_linkedin = sf_get_post_meta($post->ID, 'sf_team_member_linkedin', true);
    				$member_google_plus = sf_get_post_meta($post->ID, 'sf_team_member_google_plus', true);
    				$member_skype = sf_get_post_meta($post->ID, 'sf_team_member_skype', true);
    				$member_instagram = sf_get_post_meta($post->ID, 'sf_team_member_instagram', true);
    				$member_dribbble = sf_get_post_meta($post->ID, 'sf_team_member_dribbble', true);
    				$member_image = get_post_thumbnail_id();
    				   	
    				$items .= '<div itemscope data-id="id-'. $count .'" class="clearfix carousel-item team-member '.$item_class.'">';
    				
					$img_url = wp_get_attachment_url( $member_image,'full' );
					$image = aq_resize( $img_url, 270, 270, true, false);
					
					$items .= '<figure>';
								if($image) {
									$items .= '<img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
								}
					$items .= '</figure>';
    				
    				$items .= '<h4 class="team-member-name">'. $member_name .'</h4>';
    				$items .= '<h4 class="team-member-position">'. $member_position .'</h4>';
    				$items .= '<div class="team-member-details-wrap">';
    				$items .= '<div class="team-member-bio">'. $member_bio .'</div>';
    				
					if (($member_email) || ($member_phone)) {
					$items .= '<ul class="member-contact">';
					if ($member_email) {
						$items .= '<li><span>'.__("E:", "swiftframework").'</span> <a href="mailto:'.$member_email.'">'.$member_email.'</a></li>';
					}
					if ($member_phone) {
						$items .= '<li><span>'.__("T:", "swiftframework").'</span>'.$member_phone.'</li>';
					}
					$items .= '</ul>'; 
					}
    				
    				if (($member_twitter) || ($member_facebook) || ($member_linkedin) || ($member_google_plus) || ($member_skype) || ($member_instagram) || ($member_dribbble)) {
    				$items .= '<ul class="social-icons '.$social_icon_type.' small">';
    				if ($member_twitter) {
    					$items .= '<li class="twitter"><a href="http://www.twitter.com/'.$member_twitter.'" target="_blank">Twitter</a></li>';
    				}
    				if ($member_facebook) {
    					$items .= '<li class="facebook"><a href="'.$member_facebook.'" target="_blank">Facebook</a></li>';
    				}
    				if ($member_linkedin) {
    					$items .= '<li class="linkedin"><a href="'.$member_linkedin.'" target="_blank">LinkedIn</a></li>';
    				}
    				if ($member_google_plus) {
    					$items .= '<li class="googleplus"><a href="'.$member_google_plus.'" target="_blank">Google+</a></li>';
    				}
    				if ($member_skype) {
    					$items .= '<li class="skype"><a href="skype:'.$member_skype.'" target="_blank">Skype</a></li>';
    				}
    				if ($member_instagram) {
    					$items .= '<li class="instagram"><a href="'.$member_instagram.'" target="_blank">Instagram</a></li>';
    				}
    				if ($member_dribbble) {
    					$items .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$member_dribbble.'" target="_blank">Dribbble</a></li>';
    				}
    				$items .= '</ul>';
    				}
    				   				
    				$items .= '</div>';
    				$items .= '</div>';
    				$count++;
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</div>';
    			
    			$items .= '<a href="#" class="carousel-prev"><i class="fa-chevron-left"></i></a><a href="#" class="carousel-next"><i class="fa-chevron-right"></i></a>';
    			
    			$items .= '</div>';
    			
    		}
    		

            $width = spb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_team_carousel_widget spb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="spb_wrapper">';
            if ($title != '') {
            $output .= "\n\t\t\t".'<h4 class="spb_heading"><span>'.$title.'</span></h4>';
            }
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.spb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_carousel, $include_isotope;
            $include_carousel = true;
            $include_isotope = true;
            
            return $output;
		
    }
}

SPBMap::map( 'team_carousel', array(
    "name"		=> __("Team Carousel", "swiftframework"),
    "base"		=> "team_carousel",
    "class"		=> "team_carousel spb_carousel",
    "icon"      => "spb-icon-team-carousel",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swiftframework"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swiftframework")
	    ),
        array(
            "type" => "select-multiple",
            "heading" => __("Team category", "swiftframework"),
            "param_name" => "category",
            "value" => get_category_list('team-category'),
            "description" => __("Choose the category for the portfolio items.", "swiftframework")
		),
		array(
		    "type" => "dropdown",
		    "heading" => __("Social icon type", "swiftframework"),
		    "param_name" => "social_icon_type",
		    "value" => array(__('Dark', "swiftframework") => "dark", __('Light', "swiftframework") => "light", __('Coloured', "swiftframework") => "coloured"),
		    "description" => __("Choose the social icon type to show.", "swiftframework")
		),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "swiftframework"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "swiftframework")
        )
    )
) );

?>