<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.0
 * 
 * Template Functions for Shortcodes
 * Created by CMSMasters
 * 
 */


/**
 * Posts Slider Functions
 */

/* Get Posts Slider Heading Function */
function cmsms_slider_post_heading($cmsms_id, $type = 'post', $tag = 'h1', $show = true, $link_redirect = false, $link_url = false) { 
	if ($type == 'post') {
		$out = '<header class="cmsms_slider_post_header entry-header">' . 
			'<' . $tag . ' class="cmsms_slider_post_title entry-title">' . 
				'<a href="' . get_permalink() . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
			'</' . $tag . '>' . 
		'</header>';
	} elseif ($type == 'project') {
		$out = '<header class="cmsms_slider_project_header entry-header">' . 
			'<' . $tag . ' class="cmsms_slider_project_title entry-title">' . 
				'<a href="' . (($link_redirect == 'true' && $link_url != '') ? $link_url : get_permalink()) . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
			'</' . $tag . '>' . 
		'</header>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Content/Excerpt Function */
function cmsms_slider_post_exc_cont($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = cmsms_divpdel('<div class="cmsms_slider_post_content entry-content">' . "\n" . 
			wpautop(theme_excerpt(20, false)) . 
		'</div>' . "\n");
	} elseif ($type == 'project') {
		$out = cmsms_divpdel('<div class="cmsms_slider_project_content entry-content">' . "\n" . 
			wpautop(theme_excerpt(20, false)) . 
		'</div>' . "\n");
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Date Function */
function cmsms_slider_post_date($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = '<abbr class="published cmsms_slider_post_date cmsms-icon-calendar-8" title="' . get_the_date() . '">' . 
			get_the_date() . 
		'</abbr>' . 
		'<abbr class="dn date updated" title="' . get_the_modified_date() . '">' . 
			get_the_modified_date() . 
		'</abbr>';
	} elseif ($type == 'project') {
		$out = '<abbr class="published cmsms_slider_project_date cmsms-icon-calendar-8" title="' . get_the_date() . '">' . 
			get_the_date() . 
		'</abbr>' . 
		'<abbr class="dn date updated" title="' . get_the_modified_date() . '">' . 
			get_the_modified_date() . 
		'</abbr>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Author Function */
function cmsms_slider_post_author($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = '<span class="cmsms_slider_post_user_name">' . 
			__('By', 'cmsmasters') . ' ' . 
			'<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" title="' . __('Posts by', 'cmsmasters') . ' ' . get_the_author_meta('display_name') . '" class="vcard author"><span class="fn" rel="author">' . get_the_author_meta('display_name') . '</span></a>' . 
		'</span>';
	} elseif ($type == 'project') {
		$out = '<span class="cmsms_slider_project_user_name">' . 
			__('By', 'cmsmasters') . ' ' . 
			'<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" title="' . __('Posts by', 'cmsmasters') . ' ' . get_the_author_meta('display_name') . '" class="vcard author"><span class="fn" rel="author">' . get_the_author_meta('display_name') . '</span></a>' . 
		'</span>';
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Category Function */
function cmsms_slider_post_category($type = 'post', $cmsms_id = false, $taxonomy = false, $show = true) {
	if (get_the_category() || get_the_terms($cmsms_id, $taxonomy)) {
		if ($type == 'post') {
			$out = '<span class="cmsms_slider_post_category">' . 
				__('In ', 'cmsmasters') . 
				get_the_category_list(', ') . 
			'</span>';
		} elseif ($type == 'project') {
			$out = '<span class="cmsms_slider_project_category">' . 
				get_the_term_list($cmsms_id, $taxonomy, '', ', ', '') . 
			'</span>';
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Slider Like Function */
function cmsms_slider_post_like($type = 'post', $show = true) {
	if ($type == 'post') {
		$out = cmsmsLike(false);
	} elseif ($type == 'project') {
		$out = cmsmsLike(false);
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Slider Comments Function */
function cmsms_slider_post_comments($type = 'post', $show = true) {
	if (comments_open()) {
		if ($type == 'post') {
			$out = '<a class="cmsms_slider_post_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
		} elseif ($type == 'project') {
			$out = '<a class="cmsms_slider_project_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Slider Chat Post Function */
function cmsms_slider_post_format_chat($show = true) {
	$out  = '<dl class="cmsms_slider_post_chat chat">';
	$stanzas = get_the_post_format_chat();

	foreach ($stanzas as $stanza) {
		foreach ($stanza as $row) {
			$time = '';
			if (!empty($row['time']))
				$time = sprintf('<time class="cmsms_chat_time chat-timestamp">%s</time>', esc_html($row['time']));

			$out .= sprintf(
				'<div class="cmsms_chat_item">
					<dt class="cmsms_chat_author_time chat-author chat-author-%1$s vcard">%2$s <cite class="cmsms_chat_author fn">%3$s</cite></dt>
					<dd class="cmsms_chat_text chat-text">%4$s</dd>
				</div>',
				esc_attr(sanitize_title_with_dashes($row['author'])), 
				$time,
				esc_html($row['author']),
				$row['message']
			);
		}
	}

	$out .= '</dl>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}

