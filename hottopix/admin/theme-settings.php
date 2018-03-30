<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$shortname = "ht";

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

if ( is_admin() ) {

$home_layout = array("Widgets","Blog");

$ad_layout = array("Wide","Right of Logo");

$head_layout = array("Wide","Boxed");

$logo_loc = array("Small in navigation","Large");

}

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* General Settings */
$options[] = array( "name" => __('General Settings','framework_localize'),
			"type" => "heading");

if (isset($head_layout)) {
$options[] = array( "name" => __('Header Layout','mvp-text'),
			"desc" => __('Select the layout for the header & navigation of your site.','mvp-text'),
			"id" => $shortname."_head_layout",
			"std" => "Boxed",
			"type" => "select",
			"options" => $head_layout);
}

if (isset($logo_loc)) {
$options[] = array( "name" => __('Logo Location','framework_localize'),
			"desc" => __('Set the location of your logo. NOTE: The navigation logo option is only available with the Wide header layout.','framework_localize'),
			"id" => $shortname."_logo_loc",
			"std" => "Small in navigation",
			"type" => "select",
			"options" => $logo_loc);
}

$options[] = array( "name" => __('Logo','framework_localize'),
			"desc" => __('Select a file to appear as the logo for your site.','framework_localize'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo in Navigation','mvp-text'),
			"desc" => __('If you are displaying your logo above the navigation, you can upload a separate logo that will appear in the floating navigation bar as you scroll down the page on desktop computers. It will also appear on mobile and tablet devices. The maximum recommended dimensions of this logo is 200x50.','mvp-text'),
			"id" => $shortname."_logo_nav",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo Height','framework_localize'),
			"desc" => "Set the height of the logo container (in pixels). Enter a number (ex. 100), but DO NOT include 'px' at the end (ex. 100px).",
			"id" => $shortname."_logo_height",
			"std" => "100",
			"type" => "text");

$options[] = array( "name" => __('Custom Favicon','framework_localize'),
			"desc" => __('Upload a 16x16px PNG/GIF image that will represent your website\'s favicon.','framework_localize'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");


$options[] = array( "name" => __('Tracking Code','framework_localize'),
			"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
			"id" => $shortname."_tracking",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Custom CSS','framework_localize'),
			"desc" => "Enter your custom CSS here. You will not lose any of the CSS you enter here if you update the theme to a new version.",
			"id" => $shortname."_customcss",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Toggle Responsiveness','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the responsiveness of the theme.",
			"id" => $shortname."_respond",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Featured Posts Section on Category Pages','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Featured Posts section from the category pages.",
			"id" => $shortname."_featured_cat",
			"std" => "true",
			"type" => "checkbox");


/* Theme Color Settings */
$options[] = array( "name" => __('Color Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Primary Theme Color','framework_localize'),
			"desc" => __('Primary color for the site.','framework_localize'),
			"id" => $shortname."_primary_theme",
			"std" => "#e91b23",
			"type" => "color");

$options[] = array( "name" => __('Main Menu Background Color','framework_localize'),
			"desc" => __('The background color of the main menu.','framework_localize'),
			"id" => $shortname."_menu_color",
			"std" => "#333333",
			"type" => "color");

$options[] = array( "name" => __('Primary Link Color','framework_localize'),
			"desc" => __('Primary link color for the site.','framework_localize'),
			"id" => $shortname."_link_color",
			"std" => "#fa4b2a",
			"type" => "color");

/* Font Settings */
$options[] = array( "name" => __('Font Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Main Menu Font','framework_localize'),
			"desc" => __('Enter the font name for the main menu.','framework_localize'),
			"id" => $shortname."_menu_font",
			"std" => "Open Sans Condensed",
			"type" => "text");

$options[] = array( "name" => __('Featured Posts Font','framework_localize'),
			"desc" => __('Enter the font name for the Featured Posts section on the homepage and category pages.','framework_localize'),
			"id" => $shortname."_featured_posts",
			"std" => "Oswald",
			"type" => "text");

$options[] = array( "name" => __('General Headline Font','framework_localize'),
			"desc" => __('Enter the font name for the general headline font used in widgets, archive pages and page/post titles.','framework_localize'),
			"id" => $shortname."_headlines",
			"std" => "Oswald",
			"type" => "text");


/* Homepage Settings */
$options[] = array( "name" => __('Homepage Settings','framework_localize'),
			"type" => "heading");

if (isset($home_layout)) {
$options[] = array( "name" => __('Homepage Layout','framework_localize'),
			"desc" => __('Select your homepage layout.','framework_localize'),
			"id" => $shortname."_home_layout",
			"std" => "1",
			"type" => "select",
			"options" => $home_layout);
}

$options[] = array( "name" => __('Homepage Featured Posts Tag Slug','framework_localize'),
			"desc" => __('Enter the Tag Slug of the Tag you want associated with the Featured Posts section. Posts with this Tag will be displayed in the Featured Posts section at the top of the homepage.','framework_localize'),
			"id" => $shortname."_slider_tags",
			"std" => "1",
			"type" => "text");

/* News Ticker Settings */
$options[] = array( "name" => __('News Ticker Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('News Ticker Tag Slug','framework_localize'),
			"desc" => __('Enter the Tag Slug of the Tag you want associated with the News Ticker. Posts with tags in this field will show up in the News Ticker.','framework_localize'),
			"id" => $shortname."_ticker_tags",
			"std" => "1",
			"type" => "text");

$options[] = array( "name" => __('Maximum News Ticker Items','framework_localize'),
			"desc" => "Set the maximum number of items (posts) to appear in the News Ticker.",
			"id" => $shortname."_ticker_num",
			"std" => "10",
			"type" => "text");


/* Article Settings */
$options[] = array( "name" => __('Article Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show Featured Image In Posts?','framework_localize'),
			"desc" => __('Uncheck this box if you would like to remove the featured image thumbnail from all posts.','framework_localize'),
			"id" => $shortname."_featured_img",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Social Sharing Buttons?','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the social sharing buttons from all posts.",
			"id" => $shortname."_socialbox",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Author Info?','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the author info box from the bottom of the posts.",
			"id" => $shortname."_author_box",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Previous/Next Post Links?','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the links to the previous/next posts below each article.",
			"id" => $shortname."_prev_next",
			"std" => "true",
			"type" => "checkbox");


/* Social Media Settings */
$options[] = array( "name" => __('Social Media Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Facebook','framework_localize'),
			"desc" => "Enter the full URL of your Facebook Page here.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Twitter','framework_localize'),
			"desc" => "Enter the full URL of your Twitter Page here.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Pinterest','framework_localize'),
			"desc" => "Enter the full URL of your Pinterest Page here.",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram','framework_localize'),
			"desc" => "Enter the full URL of your Instagram Page here.",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus','framework_localize'),
			"desc" => "Enter  the full URL of yoru Google Plus Page here.",
			"id" => $shortname."_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Tumblr','framework_localize'),
			"desc" => "Enter the full URL of your Tumblr Page here.",
			"id" => $shortname."_tumblr",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Youtube','framework_localize'),
			"desc" => "Enter the full URL of your Youtube Page here.",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linkedin','framework_localize'),
			"desc" => "Enter the full URL of your Linkedin Page here.",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Custom RSS Link','mvp-text'),
			"desc" => "If you want to replace the default RSS link with a custom RSS link (like Feedburner), enter the URL here.",
			"id" => $shortname."_rss",
			"std" => "",
			"type" => "text");


/* Ad Management Settings */
$options[] = array( "name" => __('Ad Management','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "The 300x250 and 160x600 ad units are controlled via Widgets.",
			"type" => "info");

if (isset($ad_layout)) {
$options[] = array( "name" => __('Leaderboard Ad Location','framework_localize'),
			"desc" => __('Select whether to display your leaderboard ad above your logo or to the right of the logo.','framework_localize'),
			"id" => $shortname."_ad_layout",
			"std" => "Wide",
			"type" => "select",
			"options" => $ad_layout);
}

$options[] = array( "name" => __('Leaderboard Ad Code','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_leader_ad",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Responsive Ad Area Below Article','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense) to activate the responsive ad area that will be displayed below the content of each article.",
			"id" => $shortname."_article_ad",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Wallpaper Ad Image URL','framework_localize'),
			"desc" => "Enter the URL for your wallpaper ad image. Wallpaper ad code should be a minimum of 1280px wide. Please see the theme documentation for more on wallpaper ad specifications.",
			"id" => $shortname."_wall_ad",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Wallpaper Ad URL','framework_localize'),
			"desc" => "Enter the URL for your wallpaper ad click-through.",
			"id" => $shortname."_wall_url",
			"std" => "",
			"type" => "text");


/* Footer Settings */
$options[] = array( "name" => __('Footer Info','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Copyright Text','framework_localize'),
			"desc" => "Here you can enter any text you want (eg. copyright text)",
			"id" => $shortname."_copyright",
			"std" => "Copyright &copy; 2013 Hot Topix Theme. Theme by MVP Themes, powered by Wordpress.",
			"type" => "textarea");



update_option('of_template',$options);

update_option('of_shortname',$shortname);

}
}
?>