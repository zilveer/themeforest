<?php

// Remove WordPress automatic formatting
function theme_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content',	'wpautop');
remove_filter('the_content',	'wptexturize');

add_filter('the_content', 'theme_formatter', 99);


// Assign memory limit (set higher limit with extended content: http://core.trac.wordpress.org/ticket/8553)
//@ini_set('pcre.backtrack_limit', 500000);


// Enable shortdoces in sidebar default Text widget
add_filter('widget_text', 'do_shortcode');


require TEMPLATEPATH . '/framework/shortcodes/buttons.php';
require TEMPLATEPATH . '/framework/shortcodes/chart.php';
require TEMPLATEPATH . '/framework/shortcodes/columns.php';
require TEMPLATEPATH . '/framework/shortcodes/misc.php';
require TEMPLATEPATH . '/framework/shortcodes/tables.php';
require TEMPLATEPATH . '/framework/shortcodes/video.php';

?>