<?php
/**
* @package   Master
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/

// check compatibility
if (version_compare(PHP_VERSION, '5.3', '>=')) {
    // bootstrap warp
    require(__DIR__.'/warp.php');
}

define('TEMPLATEURL', get_template_directory_uri());
define('IMAGES_URL',      TEMPLATEURL.'/images');
define('THEMEURI',      __DIR__);

// Visual composer theme integration
if(function_exists('vc_set_as_theme')) vc_set_as_theme($notifier = true);

// layer slider settings 
add_action('layerslider_ready', 'my_layerslider_overrides');
function my_layerslider_overrides() {
    $GLOBALS['lsAutoUpdateBox'] = false;
}
require_once(dirname(__FILE__).'/lib/breadcrumb-trail/breadcrumb-trail.php');
require_once(dirname(__FILE__).'/lib/breadcrumb.php');
require_once(dirname(__FILE__).'/lib/logo-widget.php');

require_once(dirname(__FILE__).'/lib/helper_functions.php');

//TGM Plugin Activation
if (!class_exists('TGM_Plugin_Activation')) {
	require_once(dirname(__FILE__).'/lib/plugin-activation.php');
}

// Custom Shortcode
if (class_exists('Su_Shortcodes')) {
	require_once(dirname(__FILE__).'/lib/shortcodes.php');
}
// Custom Shortcode Skin
if (!class_exists('Shortcodes_Ultimate_Skins')) {
	require_once(dirname(__FILE__).'/lib/shortcodes-ultimate-skins/shortcodes-ultimate-skins.php');
}

// Add RSS feed links to <head> for posts and comments.
add_theme_support( 'automatic-feed-links' );

/*
 * This theme supports all available post formats by default.
 * See http://codex.wordpress.org/Post_Formats
 */
add_theme_support( 'post-formats', array(
	'audio', 'chat', 'image', 'link', 'quote', 'status', 'video'
));

