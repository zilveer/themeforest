<?php

class WPBakeryShortCode_team_carousel extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $title = $show_hide = $width = $el_class = $output = $filter = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"category"		=> 'all',
	        	"show_hide"	=> '',
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
	    		'post_type' => 'team',
	    		'post_status' => 'publish',
	    		'team-category' => $category_slug,
	    		'posts_per_page' => -1
    		);
    		$team_members = query_posts($args);
    		$count = 0;
    		
    		$list_class = '';  		
    		if ($show_hide == "yes") { $list_class = 'has-show-hide'; }
    		
    		if( have_posts() ) {
    		
    			$items .= '<ul class="team-members carousel-items '.$list_class.' clearfix">';
    	
    			while ( have_posts() ) {
    				
    				the_post();
    				
    				$member_name = get_the_title();
    				$member_position = get_post_meta($post->ID, 'sf_team_member_position', true);
    				$member_bio = get_the_excerpt();
    				$member_email = get_post_meta($post->ID, 'sf_team_member_email', true);
    				$member_phone = get_post_meta($post->ID, 'sf_team_member_phone_number', true);
    				$member_twitter = get_post_meta($post->ID, 'sf_team_member_twitter', true);
    				$member_facebook = get_post_meta($post->ID, 'sf_team_member_facebook', true);
    				$member_linkedin = get_post_meta($post->ID, 'sf_team_member_linkedin', true);
    				$member_google_plus = get_post_meta($post->ID, 'sf_team_member_google_plus', true);
    				$member_skype = get_post_meta($post->ID, 'sf_team_member_skype', true);
    				$member_instagram = get_post_meta($post->ID, 'sf_team_member_instagram', true);
    				$member_dribbble = get_post_meta($post->ID, 'sf_team_member_dribbble', true);
    				$member_image = get_post_thumbnail_id();
    				   	
    				$items .= '<li data-id="id-'. $count .'" class="clearfix team-member four columns">';
    				
					$img_url = wp_get_attachment_url( $member_image,'full' );
					$image = aq_resize( $img_url, 220, 298, true, false);
					
					$items .= '<figure>';
								if($image) {
									$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
								}
					$items .= '</figure>';
    				
    				$items .= '<h4 class="team-member-name">'. $member_name .'</h4>';
    				$items .= '<h5 class="team-member-position">'. $member_position .'</h5>';
    				$items .= '<div class="team-member-details-wrap">';
    				$items .= '<div class="team-member-bio">'. $member_bio .'</div>';
    				
    				if (($member_twitter) || ($member_email) || ($member_phone)) {
    				$items .= '<ul class="member-contact">';
    				if ($member_twitter) {
    					$items .= '<li><span>T:</span> <a href="http://twitter.com/'.$member_twitter.'">@'.$member_twitter.'</a></li>';
    				}
    				if ($member_email) {
    					$items .= '<li><span>E:</span> <a href="mailto:'.$member_email.'">'.$member_email.'</a></li>';
    				}
    				if ($member_phone) {
    					$items .= '<li><span>P:</span>'.$member_phone.'</li>';
    				}
    				$items .= '</ul>'; 
    				}
    				
    				if (($member_twitter) || ($member_facebook) || ($member_linkedin) || ($member_google_plus) || ($member_skype) || ($member_instagram) || ($member_dribbble)) {
    				$items .= '<ul class="social-icons small">';
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
    				$items .= '<a class="read-more" href="'. get_permalink() .'">'. __("Find out more", "swiftframework") .'<i class="icon-chevron-right"></i></a>';
    				$items .= '</li>';
    				$count++;
    			}
    			
    			wp_reset_query();
    					
    			$items .= '</ul>';
    			
    			if ($show_hide == "yes") {
    			$items .= '<div class="tm-toggle-button-wrap clearfix"><a href="#" class="show-hide-bios closed" data-show="'.__("Show Bios", "swiftframework").'" data-hide="'.__("Hide Bios", "swiftframework").'">Show Bios</a></div>';
    			}
    		}
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="wpb_team_carousel_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper carousel-wrap">';
            if ($title != '') {
            $output .= "\n\t\t\t".'<div class="heading-wrap"><h3 class="wpb_heading"><span>'.$title.'</span></h3><div class="carousel-nav"><a href="#" class="carousel-prev"><i class="icon-chevron-left"></i></a><a href="#" class="carousel-next"><i class="icon-chevron-right"></i></a></div></div>';
            } else {
            $output .= "\n\t\t\t".'<div class="heading-wrap"><div class="carousel-nav"><a href="#" class="carousel-prev"><i class="icon-chevron-left"></i></a><a href="#" class="carousel-next"><i class="icon-chevron-right"></i></a></div></div>';
            }
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_carousel;
            $include_carousel = true;
            
            return $output;
		
    }
}

WPBMap::map( 'team_carousel', array(
    "name"		=> __("Team Carousel", "js_composer"),
    "base"		=> "team_carousel",
    "class"		=> "team_carousel wpb_carousel",
    "icon"      => "icon-wpb-team-carousel",
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
            "heading" => __("Team category", "js_composer"),
            "param_name" => "category",
            "value" => get_category_list('team-category'),
            "description" => __("Choose the category for the portfolio items.", "js_composer")
		),
		array(
		    "type" => "dropdown",
		    "heading" => __("Show / Hide Bios Button", "js_composer"),
		    "param_name" => "show_hide",
		    "value" => array(__('No', "js_composer") => "no", __('Yes', "js_composer") => "yes"),
		    "description" => __("Include a button to show/hide the team member bios.", "js_composer")
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