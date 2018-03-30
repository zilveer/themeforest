<?php
if(!is_dir(THEMEUPLOAD))
{
	mkdir(THEMEUPLOAD);
}

$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1225, 0, 'pp_skin', 'dark', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1226, 0, 'pp_menu', '1', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1227, 0, 'pp_bg_overlay', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1228, 0, 'pp_right_click_text', 'You can enable or disable image protection via admin panel :)', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1231, 0, 'pp_h1_size', '40', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1232, 0, 'pp_h2_size', '32', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1233, 0, 'pp_h3_size', '26', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1234, 0, 'pp_h4_size', '24', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1235, 0, 'pp_h5_size', '22', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1236, 0, 'pp_h6_size', '18', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1237, 0, 'pp_menu_font_size', '24', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1238, 0, 'pp_sub_menu_font_size', '16', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1239, 0, 'pp_homepage_style', 'f', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1241, 0, 'pp_homepage_slideshow_timer', '5', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1242, 0, 'pp_homepage_slideshow_trans', '1', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1243, 0, 'pp_enable_fit_image', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1244, 0, 'pp_homepage_youtube_video_id', 'iIyfibIBpnM', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1245, 0, 'pp_portfolio_slideshow_timer', '5', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1246, 0, 'pp_portfolio_slideshow_trans', '1', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1247, 0, 'pp_portfolio_enable_fit_image', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1248, 0, 'pp_blog_display_social', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `wp_options` VALUES(1258, 0, 'pp_footer_social', 'true', 'yes');");
?>