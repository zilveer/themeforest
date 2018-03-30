<?php
		if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
	global $query_string, $post;
	$post_type = get_post_type();

	
	if($post_type == "gallery") {
		get_template_part("template","gallery");
	} else if($post_type == "events-item") {
		get_template_part("template","events");
	}  else if($post_type == "reviews-item") {
		get_template_part("template","reviews");
	} else {
		get_header();
		get_template_part(THEME_INCLUDES."top");
		get_template_part(THEME_INCLUDES."news");
		get_footer();
	}
?>