<?php

class WPBakeryShortCode_team extends WPBakeryShortCode {

    protected function content($atts, $content = null) {

		    $title = $width = $el_class = $output = $filter = $social_icon_type = $items = $el_position = '';
		
	        extract(shortcode_atts(array(
		        'title' => '',
	        	"item_count"	=> '12',
	        	"category"		=> '',
	        	'social_icon_type' => 'dark',
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
    		
    		$sidebar_config = get_post_meta(get_the_ID(), 'sf_sidebar_config', true);
    		
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
    		    		
			$items .= '<ul class="team-members row clearfix">';
	
			while ( $team_members->have_posts() ) : $team_members->the_post();
				
				$member_name = get_the_title();
				$member_position = get_post_meta($post->ID, 'sf_team_member_position', true);
				$member_bio = get_the_content_with_formatting();
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
				   	
				$items .= '<li data-id="id-'. $count .'" class="clearfix team-member '.$item_class.'">';
				
				$img_url = wp_get_attachment_url( $member_image,'full' );
				$image = aq_resize( $img_url, 270, 270, true, false);
				
				$items .= '<figure>';
							if($image) {
								$items .= '<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" />';
							}
				$items .= '</figure>';
				
				$items .= '<h4 class="team-member-name">'. $member_name .'</h4>';
				$items .= '<h4 class="team-member-position">'. $member_position .'</h4>';
				$items .= '<div class="team-member-details-wrap">';
				$items .= '<div class="team-member-bio">'. do_shortcode($member_bio) .'</div>';
				
				if (($member_email) || ($member_phone)) {
				$items .= '<ul class="member-contact">';
				if ($member_email) {
					$items .= '<li><span>E:</span> <a href="mailto:'.$member_email.'">'.$member_email.'</a></li>';
				}
				if ($member_phone) {
					$items .= '<li><span>P:</span>'.$member_phone.'</li>';
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
				
				$items .= '</li>';
				$count++;
				
			endwhile;
			
			wp_reset_postdata();
					
			$items .= '</ul>';
    
   		
    		// PAGINATION
    		
    		if ($pagination == "yes") {
    		
	    		$items .= '<div class="pagination-wrap">';
	    		
	    		$items .= pagenavi($team_members);
	    							
	    		$items .= '</div>';
    		
    		}       
    		
    		
    		$el_class = $this->getExtraClass($el_class);
            $width = wpb_translateColumnWidthToSpan($width);
            
            $output .= "\n\t".'<div class="team_list_widget wpb_content_element '.$width.$el_class.'">';
            $output .= "\n\t\t".'<div class="wpb_wrapper">';
            $output .= ($title != '' ) ? "\n\t\t\t".'<h3 class="wpb_heading"><span>'.$title.'</span></h3>' : '';
            $output .= "\n\t\t\t\t".$items;
            $output .= "\n\t\t".'</div> '.$this->endBlockComment('.wpb_wrapper');
            $output .= "\n\t".'</div> '.$this->endBlockComment($width);
    
            $output = $this->startRow($el_position) . $output . $this->endRow($el_position);
            
            global $include_isotope;
            global $has_team;
            $include_isotope = true;
            $has_team = true;
            
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
		    "heading" => __("Social icon type", "js_composer"),
		    "param_name" => "social_icon_type",
		    "value" => array(__('Dark', "js_composer") => "dark", __('Light', "js_composer") => "light", __('Coloured', "js_composer") => "coloured"),
		    "description" => __("Choose the social icon type to show.", "js_composer")
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