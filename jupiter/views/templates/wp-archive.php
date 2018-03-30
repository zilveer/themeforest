<?php
global $mk_options;

if(shortcode_exists('mk_blog')) {
		echo do_shortcode('
								[mk_blog 
									post_type = 			"'.get_post_type().'"
									style =					"' . $mk_options['archive_loop_style'] . '" 
									grid_image_height =		"' . $mk_options['archive_blog_image_height'] . '" 
									disable_meta = 			"' . $mk_options['archive_blog_meta'] . '" 
									pagination_style = 		"' . $mk_options['archive_pagination_style'] . '"
								]'
						  );
}