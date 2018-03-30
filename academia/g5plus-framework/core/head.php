<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/1/2015
 * Time: 10:27 AM
 */
/*================================================
HEAD META
================================================== */
if (!function_exists('g5plus_head_meta')) {
	function g5plus_head_meta() {
		g5plus_get_template('head-meta');
	}
	add_action('wp_head','g5plus_head_meta',0);
}

/*================================================
SOCIAL META
================================================== */
if (!function_exists('g5plus_add_opengraph_doctype')) {
	function g5plus_add_opengraph_doctype($output) {
		$g5plus_options = &G5Plus_Global::get_options();
		$enable_social_meta = false;
		if (isset($g5plus_options['enable_social_meta'])) {
			$enable_social_meta = $g5plus_options['enable_social_meta'];
		}
		if (!$enable_social_meta) {
			return$output;
		}
		return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';

	}
	add_filter( 'language_attributes', 'g5plus_add_opengraph_doctype' );
}

if (!function_exists('g5plus_social_meta')) {
	function g5plus_social_meta() {
		g5plus_get_template('social-meta');
	}
	add_action( 'wp_head', 'g5plus_social_meta', 5 );
}

