<?php

require_once get_template_directory() . '/framework/createit/ctThemeLoader.php';

$c = new ctThemeLoader();
$c->init('nonus');

function roots_setup() {

	if (function_exists('wpcf7_ajax_loader')) {
		add_filter('wpcf7_ajax_loader', 'wap8_wpcf7_ajax_loader');
		function wap8_wpcf7_ajax_loader() {
			$url = get_template_directory_uri() . '/assets/img/loading.gif';
			return $url;
		}
	}

	// Make theme available for translation
	load_theme_textdomain('ct_theme', get_template_directory() . '/lang');

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support('automatic-feed-links');

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support('post-thumbnails');

	add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio'));

	add_theme_support('custom-header');

	//add size for portfolio items
	add_image_size('thumb_4_cols', 220, 161, true);
	add_image_size('thumb_3_cols', 300, 220, true);
	add_image_size('thumb_2_cols', 460, 337, true);
	add_image_size('thumb_work_slide', 300, 220, true);

	//add size for post items
	add_image_size('thumb_square', 240, 210, true);

	//gallery
	add_image_size('gallery_thumb_2', 570, 350, true);
	add_image_size('gallery_thumb_3', 370, 227, true);
	add_image_size('gallery_thumb_4', 270, 166, true);
	add_image_size('gallery_thumb_6', 170, 104, true);

	require_once CT_THEME_SETTINGS_MAIN_DIR . '/options/ctCustomizeManagerHandler.class.php';
	new ctCustomizeManagerHandler();
}

add_action('after_setup_theme', 'roots_setup');

require_once 'theme/theme_functions.php';