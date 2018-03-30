<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.1
 * 
 * Template Functions for Profiles & Profile
 * Created by CMSMasters
 * 
 */


/* Get Profiles Heading Function */
function cmsms_profile_heading($cmsms_id, $tag = 'h1', $show = true) { 
	$out = '<header class="cmsms_profile_header entry-header">' . 
		'<' . $tag . ' class="cmsms_profile_title entry-title">' . 
			'<a href="' . get_permalink() . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
		'</' . $tag . '>' . 
	'</header>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Profiles Heading Without Link Function */
function cmsms_profile_title_nolink($cmsms_id, $tag = 'h1', $sub_title = false, $tag_sub = 'h5', $show = true) { 
	$out = '<' . $tag . ' class="cmsms_profile_title entry-title">' . 
		cmsms_title($cmsms_id, false) . 
	'</' . $tag . '>';
	
	
	if ($sub_title) {
		$out .= '<' . $tag_sub . ' class="cmsms_profile_subtitle">' . 
			$sub_title . 
		'</' . $tag . '>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}


/* Get Profiles Content/Excerpt Function */
function cmsms_profile_exc_cont($show = true) {
	$out = cmsms_divpdel('<div class="cmsms_profile_content entry-content">' . "\n" . 
		wpautop(theme_excerpt(25, false)) . 
	'</div>' . "\n");
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Profiles Category Function */
function cmsms_profile_category($cmsms_id, $taxonomy, $template_type = 'page', $show = true) {
	if (get_the_terms($cmsms_id, $taxonomy)) {
		if ($template_type == 'page') {
			$out = '<span class="cmsms_profile_category">' . 
				get_the_term_list($cmsms_id, $taxonomy, '', ', ', '') . 
			'</span>';
		} elseif ($template_type == 'post') {
			$cmsms_option = cmsms_get_global_options();
			$out = '';
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_profile_post_cat']) {
				$out = '<div class="profile_details_item">' . 
					'<div class="profile_details_item_title">' . __('Categories', 'cmsmasters') . ':' . '</div>' . 
					'<div class="profile_details_item_desc">' . 
						'<span class="cmsms_profile_category">' . 
							get_the_term_list($cmsms_id, $taxonomy, '', ', ', '') . 
						'</span>' . 
					'</div>' . 
				'</div>';
			}
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Profiles Comments Function */
function cmsms_profile_comments($template_type = 'page', $show = true) {
	if (comments_open()) {
		if ($template_type == 'page') {
			$out = '<a class="cmsms_profile_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
		} elseif ($template_type == 'post') {
			$cmsms_option = cmsms_get_global_options();
			$out = '';
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_profile_post_comment']) {
				$out = '<div class="profile_details_item">' . 
					'<div class="profile_details_item_title">' . __('Comments', 'cmsmasters') . ':' . '</div>' . 
					'<div class="profile_details_item_desc">' . 
						'<a class="cmsms_profile_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>' . 
					'</div>' . 
				'</div>';
			}
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Profiles Features Function */
function cmsms_profile_features($features_position = 'features', $features = '', $features_title = false, $tag = 'h2', $show = true) {
	if (
		!empty($features[1][0]) && 
		!empty($features[1][1])
	) {
		$out = '';
		
		if ($features_position == 'features') {
			$out .= '<div class="profile_features entry-meta">' . 
				($features_title ? '<' . $tag . ' class="profile_features_title">' . $features_title . '</' . $tag . '>' : '');
		}
		
		
		foreach ($features as $feature) {
			if ($feature[0] != '' && $feature[1] != '') {
				$feature_lists = explode("\n", $feature[1]);
				
				$out .= '<div class="profile_' . $features_position . '_item">' . 
					'<div class="profile_' . $features_position . '_item_title">' . $feature[0] . '</div>' . 
					'<div class="profile_' . $features_position . '_item_desc">';
				
						foreach ($feature_lists as $feature_list) {
							$out .= trim($feature_list);
						}
				
					$out .= '</div>' . 
				'</div>';
			}
		}
		
		
		if ($features_position == 'features') {
			$out .= '</div>';
		}
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Profiles Social Icons Function */
function cmsms_profile_social_icons($social_icons, $title_box = false, $tag = 'h2', $show = true) {
	if ($social_icons != '') {
		$out = '<div class="profile_social_icons">';
			if ($title_box) {
				$out .= '<' . $tag . ' class="profile_social_icons_title">' . $title_box . '</' . $tag . '>';
			}
			
			$out .= '<ul class="profile_social_icons_list">';
			
				foreach($social_icons as $social_icon) {
					$social_icon_item = explode('|', str_replace(' ', '', $social_icon));
					
					$social_icon_icon = $social_icon_item[0];
					$social_icon_link = $social_icon_item[1];
					$social_icon_title = $social_icon_item[2];
					$social_icon_target = $social_icon_item[3];
					
					$out .= '<li>' . 
						'<a href="' . $social_icon_link . '" class="' . $social_icon_icon . '" title="' . $social_icon_title . '"' . (($social_icon_target == 'true') ? ' target="_blank"' : '') . '></a>' . 
					'</li>';
				}
			
			$out .= '</ul>' . 
		'</div>';
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}

