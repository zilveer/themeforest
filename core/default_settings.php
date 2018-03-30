<?php
$wpdb->query("DELETE FROM `".$wpdb->prefix."options` WHERE option_name LIKE '%pp_%'");

$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11323, 'pp_skin', 'light', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11324, 'pp_right_click_text', 'You can enable/disable right click protection using theme admin', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11325, 'pp_ga_id', '', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11326, 'pp_font', 'Oswald', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11327, 'pp_page_font_size', '12', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11328, 'pp_page_header_size', '120', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11329, 'pp_h1_size', '40', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11330, 'pp_h2_size', '32', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11331, 'pp_h3_size', '26', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11332, 'pp_h4_size', '22', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11333, 'pp_h5_size', '18', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11334, 'pp_h6_size', '16', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11335, 'pp_menu_font_size', '14', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11337, 'pp_homepage_slideshow_style', 'flow', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11338, 'pp_homepage_youtube_video_id', 'iIyfibIBpnM', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11339, 'pp_homepage_slideshow_timer', '5', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11340, 'pp_homepage_slideshow_trans', '1', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11341, 'pp_enable_fit_image', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11342, 'pp_enable_reflection', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11343, 'pp_auto_start', 'true', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11344, 'pp_sidebar0', '', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11345, 'pp_contact_email', '', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11346, 'pp_contact_thankyou', 'Thank you! We will get back to you as soon as possible', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11347, 'pp_contact_form', 's:8:\"s:1:\"1\";\";', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11348, 'pp_facebook_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11349, 'pp_twitter_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11350, 'pp_pinterest_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11351, 'pp_instagram_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11352, 'pp_flickr_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11353, 'pp_vimeo_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11354, 'pp_tumblr_username', '#', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11355, 'pp_linkedin_url', '', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11356, 'pp_footer_text', '© Copyright 2013 Core Theme. Powered by Wordpress theme by Peerapong', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11357, 'pp_font_family', 'Oswald', 'yes');");
$wpdb->query("INSERT IGNORE INTO `".$wpdb->prefix."options` (`option_id`, `option_name`, `option_value`, `autoload`) VALUES(11358, 'pp_contact_form_sort_data', 's:54:\"a:4:{i:0;s:1:\"1\";i:1;s:1:\"2\";i:2;s:1:\"5\";i:3;s:1:\"3\";}\";', 'yes');");

?>