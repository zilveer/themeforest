<?php

class SwiftPageBuilderShortcode_team_carousel extends SwiftPageBuilderShortcode {

    protected function content($atts, $content = null) {

		    $title = $show_hide = $width = $item_class = $el_class = $profile_link = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"category"		=> 'all',
	        	'excerpt_length' => '60',
	        	'profile_link' => 'yes',
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
    				$member_bio = sf_excerpt($excerpt_length);
    				$custom_excerpt = sf_get_post_meta($post->ID, 'sf_custom_excerpt', true);
    				if ($custom_excerpt != "") {
    					$member_bio = sf_custom_excerpt($custom_excerpt, $excerpt_length);
    				}
    				$member_twitter = sf_get_post_meta($post->ID, 'sf_team_member_twitter', true);
    				$member_facebook = sf_get_post_meta($post->ID, 'sf_team_member_facebook', true);
    				$member_linkedin = sf_get_post_meta($post->ID, 'sf_team_member_linkedin', true);
    				$member_google_plus = sf_get_post_meta($post->ID, 'sf_team_member_google_plus', true);
    				$member_skype = sf_get_post_meta($post->ID, 'sf_team_member_skype', true);
    				$member_instagram = sf_get_post_meta($post->ID, 'sf_team_member_instagram', true);
    				$member_dribbble = sf_get_post_meta($post->ID, 'sf_team_member_dribbble', true);
    				$member_xing = sf_get_post_meta($post->ID, 'sf_team_member_xing', true);
    				$member_image = get_post_thumbnail_id();
    				
    				$items .= '<div itemscope data-id="id-'. $count .'" class="clearfix carousel-item team-member '.$item_class.'">';
    				
					$img_url = wp_get_attachment_url( $member_image,'full' );
					$image = sf_aq_resize( $img_url, 270, 270, true, false);
					$image_alt = esc_attr( sf_get_post_meta($member_image, '_wp_attachment_image_alt', true) );
					
					$items .= '<figure class="standard-style">';
								if ($image) {
									$items .= '<a href="'.get_permalink().'"><img itemprop="image" src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.$image_alt.'" /></a>';
								}
					if (($member_twitter != "") || ($member_facebook != "") || ($member_linkedin != "") || ($member_google_plus != "") || ($member_skype != "") || ($member_instagram != "") || ($member_dribbble != "") || ($member_xing != "")) {
						$items .= '<figcaption><span>'.__("Follow:", "swiftframework").'</span><ul class="social-icons">';
						if ($member_twitter != "") {
							$items .= '<li class="twitter"><a href="http://www.twitter.com/'.$member_twitter.'" target="_blank"><i class="fa-twitter"></i><i class="fa-twitter"></i></a></li>';
						}
						if ($member_facebook != "") {
							$items .= '<li class="facebook"><a href="'.$member_facebook.'" target="_blank"><i class="fa-facebook"></i><i class="fa-facebook"></i></a></li>';
						}
						if ($member_linkedin != "") {
							$items .= '<li class="linkedin"><a href="'.$member_linkedin.'" target="_blank"><i class="fa-linkedin"></i><i class="fa-linkedin"></i></a></li>';
						}
						if ($member_google_plus != "") {
							$items .= '<li class="googleplus"><a href="'.$member_google_plus.'" target="_blank"><i class="fa-google-plus"></i><i class="fa-google-plus"></i></a></li>';
						}
						if ($member_skype != "") {
							$items .= '<li class="skype"><a href="skype:'.$member_skype.'" target="_blank"><i class="fa-skype"></i><i class="fa-skype"></i></a></li>';
						}
						if ($member_instagram != "") {
							$items .= '<li class="instagram"><a href="'.$member_instagram.'" target="_blank"><i class="fa-instagram"></i><i class="fa-instagram"></i></a></li>';
						}
						if ($member_dribbble != "") {
							$items .= '<li class="dribbble"><a href="http://www.dribbble.com/'.$member_dribbble.'" target="_blank"><i class="fa-dribbble"></i><i class="fa-dribbble"></i></a></li>';
						}
						if ($member_xing) {
							$items .= '<li class="xing"><a href="'.$member_xing.'" target="_blank"><i class="fa-xing"></i><i class="fa-xing"></i></a></li>';
						}
						$items .= '</ul></figcaption>';
					}
					$items .= '</figure>';
    				
    				$items .= '<h5 class="team-member-name"><a href="'.get_permalink().'">'. $member_name .'</a></h5>';
    				$items .= '<h5 class="team-member-position">'. $member_position .'</h5>';
    				$items .= '<div class="team-member-details-wrap">';
    				
    				if ( $profile_link == "yes" ) {
    					$items .= '<div class="team-member-bio">'. $member_bio .'<a href="'.get_permalink().'" class="read-more">'.__("View profile", "swiftframework").'</a></div>';   	 
    				} else {
    					$items .= '<div class="team-member-bio">'. $member_bio .'</div>';
    				}
    				
    				
    				   				
    				$items .= '</div>';
    				$items .= '</div>';
    				$count++;
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</div>';
    			
    			$items .= '<a href="#" class="carousel-prev"><i class="ss-navigateleft"></i></a><a href="#" class="carousel-next"><i class="ss-navigateright"></i></a>';
    			
    			$options = get_option('sf_dante_options');
    			if ($options['enable_swipe_indicators']) {
    			$items .= '<div class="sf-swipe-indicator"></div>';
    			}
    			
    			$items .= '</div>';
    		}
    		

            $width = spb_translateColumnWidthToSpan($width);
    		$el_class = $this->getExtraClass($el_class);
            
            $output .= "\n\t".'<div class="spb_team_carousel_widget spb_content_element '.$width.$el_class.'">';
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

SPBMap::map( 'team_carousel', array(
    "name"		=> __("Team Carousel", "swift-framework-admin"),
    "base"		=> "team_carousel",
    "class"		=> "team_carousel spb_carousel",
    "icon"      => "spb-icon-team-carousel",
    "params"	=> array(
	    array(
	        "type" => "textfield",
	        "heading" => __("Widget title", "swift-framework-admin"),
	        "param_name" => "title",
	        "value" => "",
	        "description" => __("Heading text. Leave it empty if not needed.", "swift-framework-admin")
	    ),
        array(
            "type" => "select-multiple",
            "heading" => __("Team category", "swift-framework-admin"),
            "param_name" => "category",
            "value" => sf_get_category_list('team-category'),
            "description" => __("Choose the category for the portfolio items.", "swift-framework-admin")
		),
		array(
		    "type" => "textfield",
		    "heading" => __("Excerpt Length", "swift-framework-admin"),
		    "param_name" => "excerpt_length",
		    "value" => "",
		    "description" => __("The length of the excerpt for each of the team members. Default 60.", "swift-framework-admin")
		),
		array(
		    "type"        => "dropdown",
		    "heading"     => __( "Profile Link", "swift-framework-admin" ),
		    "param_name"  => "profile_link",
		    "value"       => array(
		        __( 'Yes', "swift-framework-admin" ) => "yes",
		        __( 'No', "swift-framework-admin" )  => "no"
		    ),
		    "description" => __( "Select if you'd like the team members to link through to the profile page.", "swift-framework-admin" )
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