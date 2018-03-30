<?php 
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version		1.0.1
 * 
 * Template Functions for Blog & Post
 * Created by CMSMasters
 * 
 */


/* Get Posts Heading Function */
function cmsms_post_heading($cmsms_id, $tag = 'h1', $show = true) { 
	$out = '<header class="cmsms_post_header entry-header">' . 
		'<' . $tag . ' class="cmsms_post_title entry-title">' . 
			'<a href="' . get_permalink() . '">' . cmsms_title($cmsms_id, false) . '</a>' . 
		'</' . $tag . '>' . 
	'</header>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Heading Without Link Function */
function cmsms_post_title_nolink($cmsms_id, $tag = 'h1', $show = true) { 
	$out = '<' . $tag . ' class="cmsms_post_title entry-title">' . 
		cmsms_title($cmsms_id, false) . 
	'</' . $tag . '>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Date Function */
function cmsms_post_date($template_type = 'page', $layout_type = 'default', $show = true) {
	if ($template_type == 'page') {
		if ($layout_type == 'default') {
			$out = '<abbr class="published cmsms_post_date" title="' . get_the_date() . '">' . 
				'<span class="cmsms_day_mon">' . get_the_date('d') . '.' . get_the_date('m') . '</span>' . 
				'<span class="cmsms_year">' . get_the_date('Y') . '</span>' . 
			'</abbr>' . 
			'<abbr class="dn date updated" title="' . get_the_modified_date() . '">' . 
				get_the_modified_date() . 
			'</abbr>';
		} elseif ($layout_type == 'masonry') {
			$out = '<abbr class="published cmsms_post_date cmsms-icon-calendar-8" title="' . get_the_date() . '">' . 
				get_the_date() . 
			'</abbr>' . 
			'<abbr class="dn date updated" title="' . get_the_modified_date() . '">' . 
				get_the_modified_date() . 
			'</abbr>';
		}
	} elseif ($template_type == 'post') {
		$cmsms_option = cmsms_get_global_options();
		
		$out = '';
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_date']) {
			$out .= '<abbr class="published cmsms_post_date cmsms-icon-calendar-8" title="' . get_the_date() . '">' . 
				get_the_date() . 
			'</abbr>' . 
			'<abbr class="dn date updated" title="' . get_the_modified_date() . '">' . 
				get_the_modified_date() . 
			'</abbr>';
		}
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Author Function */
function cmsms_post_author($template_type = 'page', $show = true) {
	if ($template_type == 'page') {
		$out = '<span class="cmsms_post_user_name">' . 
			__('By', 'cmsmasters') . ' ' . 
			'<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" title="' . __('Posts by', 'cmsmasters') . ' ' . get_the_author_meta('display_name') . '" class="vcard author"><span class="fn" rel="author">' . get_the_author_meta('display_name') . '</span></a>' . 
		'</span>';
	} elseif ($template_type == 'post') {
		$cmsms_option = cmsms_get_global_options();
		$out = '';
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_author']) {
			$out .= '<span class="cmsms_post_user_name">' . 
				__('By', 'cmsmasters') . ' ' . 
				'<a href="' . get_author_posts_url(get_the_author_meta('ID')) . '" title="' . __('Posts by', 'cmsmasters') . ' ' . get_the_author_meta('display_name') . '" class="vcard author"><span class="fn" rel="author">' . get_the_author_meta('display_name') . '</span></a>' . 
			'</span>';
		}
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Category Function */
function cmsms_post_category($template_type = 'page', $show = true) {
	if (get_the_category()) {
		if ($template_type == 'page') {
			$out = '<span class="cmsms_post_category">' . 
				__('In', 'cmsmasters') . ' ' . 
				get_the_category_list(', ') . 
			'</span>';
		} elseif ($template_type == 'post') {
			$cmsms_option = cmsms_get_global_options();
			$out = '';
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_cat']) {
				$out .= '<span class="cmsms_post_category">' . 
					__('In', 'cmsmasters') . ' ' . 
					get_the_category_list(', ') . 
				'</span>';
			}
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Tags Function */
function cmsms_post_tags($template_type = 'page', $show = true) {
	if (get_the_tags()) {
		if ($template_type == 'page') {
			$out = '<span class="cmsms_post_tags">' . 
				get_the_tag_list(__('Tags', 'cmsmasters') . ' ', ', ', '') . 
			'</span>';
		} else if ($template_type == 'post') {
			$cmsms_option = cmsms_get_global_options();
			$out = '';
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_tag']) {
				$out .= '<span class="cmsms_post_tags">' . 
					get_the_tag_list(__('Tags', 'cmsmasters') . ' ', ', ', '') . 
				'</span>';
			}
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts Content/Excerpt Function */
function cmsms_post_exc_cont($show = true) {
	$out = cmsms_divpdel('<div class="cmsms_post_content entry-content">' . "\n" . 
		wpautop(theme_excerpt(25, false)) . 
	'</div>' . "\n");
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Like Function */
function cmsms_post_like($template_type = 'page', $show = true) {
	if ($template_type == 'page') {
		$out = cmsmsLike(false);
	} elseif ($template_type == 'post') {
		$cmsms_option = cmsms_get_global_options();
		$out = '';
		
		if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_like']) {
			$out = cmsmsLike(false);
		}
	}
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Posts Comments Function */
function cmsms_post_comments($template_type = 'page', $show = true) {
	if (comments_open()) {
		if ($template_type == 'page') {
			$out = '<a class="cmsms_post_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
		} elseif ($template_type == 'post') {
			$cmsms_option = cmsms_get_global_options();
			$out = '';
			
			if ($cmsms_option[CMSMS_SHORTNAME . '_blog_post_comment']) {
				$out = '<a class="cmsms_post_comments cmsms-icon-comment-6" href="' . get_comments_link() . '" title="' . __('Comment on', 'cmsmasters') . ' ' . get_the_title() . '">' . get_comments_number() . '</a>';
			}
		}
		
		
		if ($show) {
			echo $out;
		} else {
			return $out;
		}
	}
}



/* Get Posts More Button/Link Function */
function cmsms_post_more($cmsms_id, $show = true) {
	$cmsms_post_read_more = get_post_meta($cmsms_id, 'cmsms_post_read_more', true);
	
	
	if ($cmsms_post_read_more == '') {
		$cmsms_post_read_more = __('Read More', 'cmsmasters');
	}
	
	
	$out = '<a class="button cmsms_post_read_more" href="' . get_permalink($cmsms_id) . '">' . $cmsms_post_read_more . '</a>';
	
	
	if ($show) {
		echo $out;
	} else {
		return $out;
	}
}



/* Get Chat Post Function */
function cmsms_post_format_chat($show = true) {
	$out  = '<dl class="cmsms_chat chat">';
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

