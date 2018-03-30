<?php
require_once locate_template('config/init.php');
require_once locate_template('config/template_display_function.php');
require_once locate_template('config/functions.php');
require_once locate_template('config/scripts.php');
require_once locate_template('config/layout.php');
require_once locate_template('config/class.php');
require_once locate_template('config/header.php');
require_once locate_template('config/content.php');
require_once locate_template('config/footer.php');
require_once locate_template('config/breadcrumb.php');
require_once locate_template('config/post_navigation.php');
require_once locate_template('config/comment_trackback.php');
require_once locate_template('config/walker_nav_menu.php');
global $wp_version;
if($wp_version >4.0)
{
	require_once locate_template('config/customizer4.x.php');
}else
{
	require_once locate_template('config/customizer.php');
}
// add short code for theme
require_once locate_template('shortcodes/class.shortcodes.php');
$aweinitShortcode = new AWEShortcodes();
 