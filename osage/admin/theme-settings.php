<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){

//Theme Shortname
$shortname = "mvp";

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

if ( is_admin() ) {

//Access the WordPress Categories via an Array
$tt_categories = array();  
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");

//Access the custom Scoreboard Categories via an Array
$tt_tax = array();  
$scores = get_terms('scores_cat', array( 'hide_empty' => 0 ));
foreach ($scores as $score) {
$tt_tax[$score->slug] = $score->slug;}
$tax_tmp = array_unshift($tt_tax, "Select a category:");

$site_layout = array("Full-Width","Boxed");

$home_layout = array("Blog","Widgets","Widgets and Blog");

$logo_loc = array("Small in navigation","Left of leaderboard","Wide below leaderboard");

$feat_slider = array("Full-Width","Standard");

$admin_images = get_template_directory_uri() . '/admin/images/';

}

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* General Settings */
$options[] = array( "name" => __('General','framework_localize'),
			"type" => "heading");

if (isset($logo_loc)) {
$options[] = array( "name" => __('Site Layout','framework_localize'),
			"desc" => __('Choose between a full-width or a boxed layout.','framework_localize'),
			"id" => $shortname."_site_layout",
			"std" => "Small in navigation",
			"type" => "select",
			"options" => $site_layout);
}

if (isset($logo_loc)) {
$options[] = array( "name" => __('Logo Location','framework_localize'),
			"desc" => __('Set the location of your logo.','framework_localize'),
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

$options[] = array( "name" => __('Number of posts per page','framework_localize'),
			"desc" => "Set the number of posts per page that you want displayed on the Homepage Blog and the Latest News Template.",
			"id" => $shortname."_posts_num",
			"std" => "10",
			"type" => "text");

$options[] = array( "name" => __('Toggle Responsiveness','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the responsiveness of the theme.",
			"id" => $shortname."_respond",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Toggle Sticky Sidebar','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Sticky Sidebar feature.",
			"id" => $shortname."_sticky_sidebar",
			"std" => "false",
			"type" => "checkbox");

$options[] = array( "name" => __('Toggle Infinite Scroll','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Infinite Scroll feature.",
			"id" => $shortname."_infinite_scroll",
			"std" => "true",
			"type" => "checkbox");


/* Theme Color Settings */
$options[] = array( "name" => __('Colors','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Primary Theme Color','framework_localize'),
			"desc" => __('Primary color for the site.','framework_localize'),
			"id" => $shortname."_primary_theme",
			"std" => "#ba1f24",
			"type" => "color");

$options[] = array( "name" => __('Main Menu Background Color','framework_localize'),
			"desc" => __('The background color of the main menu.','framework_localize'),
			"id" => $shortname."_menu_color",
			"std" => "#111111",
			"type" => "color");

$options[] = array( "name" => __('Main Menu Text Color','framework_localize'),
			"desc" => __('The text color of the main menu.','framework_localize'),
			"id" => $shortname."_menu_text",
			"std" => "#aaaaaa",
			"type" => "color");

$options[] = array( "name" => __('Heading Background Color','framework_localize'),
			"desc" => __('The background color of the section headers.','framework_localize'),
			"id" => $shortname."_heading_color",
			"std" => "#111111",
			"type" => "color");

$options[] = array( "name" => __('Primary Link Color','framework_localize'),
			"desc" => __('Primary link color for the site.','framework_localize'),
			"id" => $shortname."_link_color",
			"std" => "#0d3a80",
			"type" => "color");

$options[] = array( "name" => __('Link Hover Color','framework_localize'),
			"desc" => __('Link hover color for the site.','framework_localize'),
			"id" => $shortname."_link_hover",
			"std" => "#ba1f24",
			"type" => "color");

/* Font Settings */
$options[] = array( "name" => __('Fonts','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Featured Slider Headline Font','framework_localize'),
			"desc" => __('Enter the font name for the main headline in the Featured Slider section on the homepage and category pages.','framework_localize'),
			"id" => $shortname."_slider_headline",
			"std" => "Open Sans",
			"type" => "text");

$options[] = array( "name" => __('Main Menu Font','framework_localize'),
			"desc" => __('Enter the font name for the main menu.','framework_localize'),
			"id" => $shortname."_menu_font",
			"std" => "Oswald",
			"type" => "text");

$options[] = array( "name" => __('General Headline Font','framework_localize'),
			"desc" => __('Enter the font name for the general headline font used in widgets, archive pages and page/post titles.','framework_localize'),
			"id" => $shortname."_headline_font",
			"std" => "Bitter",
			"type" => "text");


/* Featured Slider Settings */
$options[] = array( "name" => __('Home Featured Slider','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_home_slider",
			"std" => "In order to utilize these functions, you will have to set up your homepage as a static page. Please refer to the Installing Demo Data section of the documentation for more information.",
			"type" => "info");

$options[] = array( "name" => __('Show Featured Slider?','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Featured Slider from the homepage.",
			"id" => $shortname."_slider",
			"std" => "true",
			"type" => "checkbox");

if (isset($feat_slider)) {
$options[] = array( "name" => __('Featured Slider Layout','framework_localize'),
			"desc" => __('Select between a full-width image layout or standard image layout.','framework_localize'),
			"id" => $shortname."_slider_layout",
			"std" => "Full-Width",
			"type" => "select",
			"options" => $feat_slider);
}

$options[] = array( "name" => __('Featured Slider Tag Slug','framework_localize'),
			"desc" => __('Enter the Tag Slug of the Tag you want associated with the Featured Slider section. Posts with this Tag will be displayed in the Featured Slider at the top of the homepage.','framework_localize'),
			"id" => $shortname."_slider_tags",
			"std" => "featured",
			"type" => "text");

$options[] = array( "name" => __('Maximum Featured Slider Items','framework_localize'),
			"desc" => "Set the maximum number of items (posts) to appear in the Featured Slider.",
			"id" => $shortname."_slider_num",
			"std" => "6",
			"type" => "text");


/* Homepage Body Settings */
$options[] = array( "name" => __('Home Body Layout','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_home_body",
			"std" => "In order to utilize these functions, you will have to set up your homepage as a static page. Please refer to the Installing Demo Data section of the documentation for more information.",
			"type" => "info");

if (isset($home_layout)) {
$options[] = array( "name" => __('Homepage Layout','framework_localize'),
			"desc" => __('Select your layout for the body of the homepage.','framework_localize'),
			"id" => $shortname."_home_layout",
			"std" => "1",
			"type" => "select",
			"options" => $home_layout);
}

$options[] = array( "name" => __('Homepage Blog Heading','framework_localize'),
			"desc" => "Set the heading above the blog layout on the homepage.",
			"id" => $shortname."_blog_header",
			"std" => "More Headlines",
			"type" => "text");

if (isset($admin_images)) {
$options[] = array( "name" => __('Homepage Blog Layout','framework_localize'),
			"desc" => __('If you chose the Blog-style homepage layout, you can choose between two different layout options: The large image, or the horizontal list.','framework_localize'),
			"id" => $shortname."_blog_layout",
			"std" => "large",
			"type" => "images",
			"options" => array(
				'list' => $admin_images . 'list.gif',
				'large' => $admin_images . 'large.gif'
				));
}


/* Scoreboard Settings */
$options[] = array( "name" => __('Scoreboard Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show Scoreboard?','framework_localize'),
			"desc" => __('Uncheck this box if you would like to remove the scoreboard.','framework_localize'),
			"id" => $shortname."_show_scoreboard",
			"std" => "false",
			"type" => "checkbox");

$options[] = array( "name" => __('Name of Category 1','framework_localize'),
			"desc" => "Set the name of the 1st category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name1",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 1','framework_localize'),
			"desc" => __('Select the 1st category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat1",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 2','framework_localize'),
			"desc" => "Set the name of the 2nd category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name2",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 2','framework_localize'),
			"desc" => __('Select the 2nd category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat2",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 3','framework_localize'),
			"desc" => "Set the name of the 3rd category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name3",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 3','framework_localize'),
			"desc" => __('Select the 3rd category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat3",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 4','framework_localize'),
			"desc" => "Set the name of the 4th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name4",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 4','framework_localize'),
			"desc" => __('Select the 4th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat4",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 5','framework_localize'),
			"desc" => "Set the name of the 5th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name5",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 5','framework_localize'),
			"desc" => __('Select the 5th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat5",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 6','framework_localize'),
			"desc" => "Set the name of the 6th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name6",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 6','framework_localize'),
			"desc" => __('Select the 6th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat6",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 7','framework_localize'),
			"desc" => "Set the name of the 7th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name7",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 7','framework_localize'),
			"desc" => __('Select the 7th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat7",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 8','framework_localize'),
			"desc" => "Set the name of the 8th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name8",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 8','framework_localize'),
			"desc" => __('Select the 8th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat8",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 9','framework_localize'),
			"desc" => "Set the name of the 9th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name9",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 9','framework_localize'),
			"desc" => __('Select the 9th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat9",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 10','framework_localize'),
			"desc" => "Set the name of the 10th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name10",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 10','framework_localize'),
			"desc" => __('Select the 10th category for your scoreboard.','framework_localize'),
			"id" => $shortname."_score_cat10",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}


/* Featured Posts Settings */
$options[] = array( "name" => __('Featured Posts Settings','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Featured Posts Tag Slug','framework_localize'),
			"desc" => __('Enter the Tag Slug of the Tag you want associated with the Featured Posts section. Posts with tags in this field will show up in the four (4) posts Below the Featured Slider.','framework_localize'),
			"id" => $shortname."_feat_post_tags",
			"std" => "1",
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
			"desc" => "Uncheck this box if you would like to remove the social sharing buttons from all posts and pages.",
			"id" => $shortname."_social_box",
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


/* Article Settings */
$options[] = array( "name" => __('Category Pages','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show Featured Slider','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Featured Slider from the category pages.",
			"id" => $shortname."_slider_cat",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Maximum Featured Slider Items','framework_localize'),
			"desc" => "Set the maximum number of items (posts) to appear in the Featured Slider.",
			"id" => $shortname."_slider_cat_num",
			"std" => "3",
			"type" => "text");

if (isset($admin_images)) {
$options[] = array( "name" => __('Category Body Layout','framework_localize'),
			"desc" => __('Choose between three different layout options for your category pages: The large image, the horizontal list, or the two columns.','framework_localize'),
			"id" => $shortname."_category_layout",
			"std" => "list",
			"type" => "images",
			"options" => array(
				'list' => $admin_images . 'list.gif',
				'large' => $admin_images . 'large.gif'
				));
}


/* Social Media Settings */
$options[] = array( "name" => __('Social Media','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','framework_localize'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "While most fields require just the username, Google Plus requires the full URL to your Google Plus Page.",
			"type" => "info");

$options[] = array( "name" => __('Facebook','framework_localize'),
			"desc" => "Enter your Facebook Page username here.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Twitter','framework_localize'),
			"desc" => "Enter your Twitter username here.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Pinterest','framework_localize'),
			"desc" => "Enter your Pinterest username here.",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram','framework_localize'),
			"desc" => "Enter your Instagram username here.",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus','framework_localize'),
			"desc" => "Enter your full Google Plus URL here.",
			"id" => $shortname."_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Youtube','framework_localize'),
			"desc" => "Enter your Youtube username here.",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linkedin','framework_localize'),
			"desc" => "Enter your Linkedin username here.",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Custom RSS Link','framework_localize'),
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
			"std" => "The 300x250 ads are controlled via a Widget.",
			"type" => "info");

$options[] = array( "name" => __('Header Leaderboard Ad Code','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_header_leader",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Footer Leaderboard Ad Code','framework_localize'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_footer_leader",
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

$options[] = array( "name" => __('Wallpaper Ad Click-Through URL','framework_localize'),
			"desc" => "Enter the URL for your wallpaper ad click-through.",
			"id" => $shortname."_wall_url",
			"std" => "",
			"type" => "text");


/* Footer Settings */
$options[] = array( "name" => __('Footer Info','framework_localize'),
			"type" => "heading");

$options[] = array( "name" => __('Show Footer Info Box?','framework_localize'),
			"desc" => "Uncheck this box if you would like to remove the Footer Info Box.",
			"id" => $shortname."_footer_info",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Footer Logo','framework_localize'),
			"desc" => __('Select a file to appear as the logo in the Footer Info Box.','framework_localize'),
			"id" => $shortname."_logo_footer",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Footer Info Text','framework_localize'),
			"desc" => "Enter any text to display in the Footer Info Box.",
			"id" => $shortname."_footer_text",
			"std" => "<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem?</p><p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.</p>",
			"type" => "textarea");

$options[] = array( "name" => __('Copyright Text','framework_localize'),
			"desc" => "Here you can enter any text you want (eg. copyright text)",
			"id" => $shortname."_copyright",
			"std" => "Copyright &copy; 2014 Osage Theme. Theme by MVP Themes, powered by Wordpress.",
			"type" => "textarea");



update_option('of_template',$options);

update_option('of_shortname',$shortname);

}
}
?>