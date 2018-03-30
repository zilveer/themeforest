<?php

require_once get_template_directory() . '/framework/createit/ctThemeLoader.php';

$c = new ctThemeLoader();
$c->init('secundo');

function roots_setup() {

	// Make theme available for translation
	load_theme_textdomain('ct_theme', get_template_directory() . '/lang');

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support('automatic-feed-links');

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'roots_setup');


/**
 * Wraps content into [row] if required
 * @param $content
 * @return string
 */
function ct_theme_page_content_filter($content) {
	if (is_page() && stripos($content, '[row') === false) {
		return do_shortcode('[row]' . $content . '[/row]');
	}
	return $content;
}

add_filter('the_content', 'ct_theme_page_content_filter');


/**
 * Theme activation
 */

function theme_activation() {
	$theme_data = wp_get_theme();
	//add crop option
	if (!get_option("medium_crop")) {
		add_option("medium_crop", "1");
	} else {
		update_option("medium_crop", "1");
	}

	//add current version
	add_option('secundo_theme_version', $theme_data->get('Version'));
}

theme_activation();

//changes default widgets look
require_once get_template_directory() . '/theme/widgets/default/ctThemeDefaultWidgetsHandler.php';