<?php

add_action('init','propanel_of_options');

if (!function_exists('propanel_of_options')) {
function propanel_of_options(){

//Theme Shortname
$shortname = "mvp";

//Populate the options array
global $tt_options;
$tt_options = get_option('of_options');

if ( is_admin() ) {

//Access the WordPress Pages via an Array
$tt_pages = array();
$tt_pages_obj = get_pages('sort_column=post_parent,menu_order');
foreach ($tt_pages_obj as $tt_page) {
$tt_pages[$tt_page->ID] = $tt_page->post_name; }
$tt_pages_tmp = array_unshift($tt_pages, "Select a page:");

//Access the WordPress Categories via an Array
$tt_categories = array();
$tt_categories_obj = get_categories('hide_empty=0');
foreach ($tt_categories_obj as $tt_cat) {
$tt_categories[$tt_cat->cat_ID] = $tt_cat->cat_name;}
$categories_tmp = array_unshift($tt_categories, "Select a category:");

if ( post_type_exists( 'scoreboard' ) ) {

//Access the custom Scoreboard Categories via an Array
$tt_tax = array();
$scores = get_terms('scores_cat', array( 'hide_empty' => 0 ));
foreach ($scores as $score) {
$tt_tax[$score->slug] = $score->slug;}
$tax_tmp = array_unshift($tt_tax, "Select a category:");

}

$skin_layout = array("Custom","Entertainment","Fashion","Sports","Tech");

$home_layout = array("Blog","Widgets","Widgets and Blog");

$feat_layout = array("Featured 1","Featured 2","Featured 3","Featured 4","Featured 5","Featured 6","Featured 7","Featured 8","Featured 9");

$post_layout = array("Template 1","Template 2","Template 3","Template 4","Template 5","Template 6","Template 7","Template 8");

$arch_layout = array("Row","Column");

$home_side = array("Sidebar","Popular");

$latest_side = array("Left","Right");

$post_side = array("Sidebar","Latest","Popular");

$light_dark = array("Light","Dark");

$logo_loc = array("Small in navigation","Left of leaderboard","Wide below leaderboard");

$leader_loc = array("Above Navigation","Below Navigation");

}

/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* General Settings */
$options[] = array( "name" => __('General','mvp-text'),
			"type" => "heading");

if (isset($skin_layout)) {
$options[] = array( "name" => __('Theme Skin','mvp-text'),
			"desc" => __('Select your theme skin. If you want to change the colors and fonts manually, please select Custom.','mvp-text'),
			"id" => $shortname."_skin_layout",
			"std" => "Custom",
			"type" => "select",
			"options" => $skin_layout);
}

if (isset($light_dark)) {
$options[] = array( "name" => __('Fly-Out Menu Skin','mvp-text'),
			"desc" => __('Choose between a light and dark skin for the Fly-Out menu.','mvp-text'),
			"id" => $shortname."_fly_skin",
			"std" => "Dark",
			"type" => "select",
			"options" => $light_dark);
}

if (isset($logo_loc)) {
$options[] = array( "name" => __('Logo Location','framework_localize'),
			"desc" => __('Set the location of your logo.','framework_localize'),
			"id" => $shortname."_logo_loc",
			"std" => "Small in navigation",
			"type" => "select",
			"options" => $logo_loc);
}

$options[] = array( "name" => __('Logo','mvp-text'),
			"desc" => __('Select a file to appear as your logo that will appear in the floating navigation bar and will replace the default "Flex Mag" logo.','mvp-text'),
			"id" => $shortname."_logo",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Logo in Navigation','mvp-text'),
			"desc" => __('If you are displaying your logo above the navigation, you can upload a separate logo that will appear in the floating navigation bar as you scroll down the page on desktop computers. It will also appear on mobile and tablet devices.','mvp-text'),
			"id" => $shortname."_logo_nav",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Custom Favicon','mvp-text'),
			"desc" => __('Upload a 16x16px PNG/GIF image that will represent your website\'s favicon.','mvp-text'),
			"id" => $shortname."_favicon",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Custom CSS','mvp-text'),
			"desc" => "Enter your custom CSS here. You will not lose any of the CSS you enter here if you update the theme to a new version.",
			"id" => $shortname."_customcss",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Toggle Responsiveness','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the responsiveness of the theme.",
			"id" => $shortname."_respond",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Toggle Infinite Scroll','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Infinite Scroll feature.",
			"id" => $shortname."_infinite_scroll",
			"std" => "true",
			"type" => "checkbox");


/* Theme Color Settings */
$options[] = array( "name" => __('Colors','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Primary Theme Color','mvp-text'),
			"desc" => __('Primary color for the site.','mvp-text'),
			"id" => $shortname."_primary_theme",
			"std" => "#eb0254",
			"type" => "color");

$options[] = array( "name" => __('Top Navigation Background Color','mvp-text'),
			"desc" => __('The background color of the top navigation.','mvp-text'),
			"id" => $shortname."_top_nav_bg",
			"std" => "#eb0254",
			"type" => "color");

$options[] = array( "name" => __('Top Navigation Text Color','mvp-text'),
			"desc" => __('The text color of the top navigation.','mvp-text'),
			"id" => $shortname."_top_nav_text",
			"std" => "#ffffff",
			"type" => "color");

$options[] = array( "name" => __('Top Navigation Text Hover Color','mvp-text'),
			"desc" => __('The text color when you mouse over the top navigation.','mvp-text'),
			"id" => $shortname."_top_nav_hover",
			"std" => "#fdacc8",
			"type" => "color");

$options[] = array( "name" => __('Fly-Out Button Background Color','mvp-text'),
			"desc" => __('The background color of the Fly-Out Menu Button.','mvp-text'),
			"id" => $shortname."_fly_but_bg",
			"std" => "#eb0254",
			"type" => "color");

$options[] = array( "name" => __('Fly-Out Button Lines Color','mvp-text'),
			"desc" => __('The background color of the Fly-Out Menu Button Lines.','mvp-text'),
			"id" => $shortname."_fly_but_lines",
			"std" => "#ffffff",
			"type" => "color");

$options[] = array( "name" => __('Main Headlines Link Color','mvp-text'),
			"desc" => __('The text color of the headline links.','mvp-text'),
			"id" => $shortname."_headlines",
			"std" => "#222222",
			"type" => "color");

$options[] = array( "name" => __('Main Headlines Link Hover Color','mvp-text'),
			"desc" => __('The text color when you mouse over the headline links.','mvp-text'),
			"id" => $shortname."_headlines_hover",
			"std" => "#999999",
			"type" => "color");

$options[] = array( "name" => __('Primary Link Color','mvp-text'),
			"desc" => __('Primary link color for the site.','mvp-text'),
			"id" => $shortname."_link_color",
			"std" => "#eb0254",
			"type" => "color");

$options[] = array( "name" => __('Link Hover Color','mvp-text'),
			"desc" => __('Link hover color for the site.','mvp-text'),
			"id" => $shortname."_link_hover",
			"std" => "#999999",
			"type" => "color");

/* Font Settings */
$options[] = array( "name" => __('Fonts','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('General Content Font','mvp-text'),
			"desc" => __('Enter the font name for the general font for the content on all pages.','mvp-text'),
			"id" => $shortname."_content_font",
			"std" => "Lato",
			"type" => "text");

$options[] = array( "name" => __('Fly-Out Menu/Top Navigation Font','mvp-text'),
			"desc" => "Enter the font name for the fly-out and top navigation menus.",
			"id" => $shortname."_menu_font",
			"std" => "Montserrat",
			"type" => "text");

$options[] = array( "name" => __('Featured Posts/Article Headline Font','mvp-text'),
			"desc" => "Enter the font name the font for the headlines in the Featured Posts section and the Article title on posts and pages.",
			"id" => $shortname."_featured_font",
			"std" => "Work Sans",
			"type" => "text");

$options[] = array( "name" => __('General Headline Font','mvp-text'),
			"desc" => "Enter the font name the font for the general headlines around the site.",
			"id" => $shortname."_headline_font",
			"std" => "Montserrat",
			"type" => "text");

$options[] = array( "name" => __('General Heading Font','mvp-text'),
			"desc" => "Enter the font name the font for the general headings that appear at the top of the different sections around the site.",
			"id" => $shortname."_heading_font",
			"std" => "Work Sans",
			"type" => "text");


/* Homepage Settings */
$options[] = array( "name" => __('Homepage Settings','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','mvp-text'),
			"desc" => "",
			"id" => $shortname."_attention_home_slider",
			"std" => "In order to utilize these functions, you will have to set up your homepage as a static page. Please refer to the Installing Demo Data section of the documentation for more information.",
			"type" => "info");

if (isset($feat_layout)) {
$options[] = array( "name" => __('Featured Posts Layout','mvp-text'),
			"desc" => __('Select the layout of your Featured Posts section on the homepage.','mvp-text'),
			"id" => $shortname."_feat_layout",
			"std" => "Featured 1",
			"type" => "select",
			"options" => $feat_layout);
}

$options[] = array( "name" => __('Show Featured Posts?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Featured Posts section from the homepage.",
			"id" => $shortname."_feat_posts",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Featured Posts Tag Slug','mvp-text'),
			"desc" => __('Enter the Tag Slug of the Tag you want associated with the Featured Posts section. Posts with this Tag will be displayed in the Featured Slider at the top of the homepage.','mvp-text'),
			"id" => $shortname."_feat_posts_tags",
			"std" => "featured",
			"type" => "text");

$options[] = array( "name" => __('Featured Heading','mvp-text'),
			"desc" => "The heading that will be displayed on top of the middle Featured Content section of the homepage.",
			"id" => $shortname."_feat_head",
			"std" => "Featured News",
			"type" => "text");

if (isset($home_layout)) {
$options[] = array( "name" => __('Homepage Body Layout','mvp-text'),
			"desc" => __('Select your layout for the body of the homepage that will appear in the middle column of the homepage.','mvp-text'),
			"id" => $shortname."_home_layout",
			"std" => "Widgets and Blog",
			"type" => "select",
			"options" => $home_layout);
}

$options[] = array( "name" => __('Show Homepage Left Sidebar?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Left Sidebar from the homepage.",
			"id" => $shortname."_show_latest",
			"std" => "true",
			"type" => "checkbox");

if (isset($post_side)) {
$options[] = array( "name" => __('Homepage Left Sidebar Layout','mvp-text'),
			"desc" => __('Select your layout for the left sidebar on the homepage.','mvp-text'),
			"id" => $shortname."_home_side_left",
			"std" => "Latest",
			"type" => "select",
			"options" => $post_side);
}

if (isset($post_side)) {
$options[] = array( "name" => __('Homepage Right Sidebar Layout','mvp-text'),
			"desc" => __('Select your layout for the right sidebar on the homepage.','mvp-text'),
			"id" => $shortname."_home_side",
			"std" => "Popular",
			"type" => "select",
			"options" => $post_side);
}

$options[] = array( "name" => __('Number of posts per page','mvp-text'),
			"desc" => "Set the number of posts per page that you want displayed on the Homepage Blog and the Latest News Template.",
			"id" => $shortname."_posts_num",
			"std" => "10",
			"type" => "text");


/* Latest News Settings */
$options[] = array( "name" => __('Latest News Settings','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Latest News Heading','mvp-text'),
			"desc" => "The heading that will be displayed before the Latest News sidebar.",
			"id" => $shortname."_latest_head",
			"std" => "The Latest",
			"type" => "text");

$options[] = array( "name" => __('Maximum Number of Latest News Stories','mvp-text'),
			"desc" => "Set the number of posts to display in the Latest News sidebar.",
			"id" => $shortname."_latest_num",
			"std" => "10",
			"type" => "text");

if (isset($latest_side)) {
$options[] = array( "name" => __('Latest News Position','mvp-text'),
			"desc" => __('Select whether to display the Latest News sidebar on the left or the right of the main section of the homepage.','mvp-text'),
			"id" => $shortname."_latest_side",
			"std" => "Left",
			"type" => "select",
			"options" => $latest_side);
}

if (isset($tt_pages)) {
$options[] = array( "name" => __('More Latest News Page','mvp-text'),
			"desc" => __('Select the page for your Latest News Template. Refer to the documentation for more information on how to set up custom Page templates.','mvp-text'),
			"id" => $shortname."_latest_page",
			"std" => "latest-news",
			"type" => "select",
			"options" => $tt_pages);
}

$options[] = array( "name" => __('Latest News Ad Code','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 300x250 ad area within the Latest News sidebar. The ad space can accommodate an ad of any height, but with only a maximum width of 300px.",
			"id" => $shortname."_latest_ad",
			"std" => "",
			"type" => "textarea");


/* Popular Posts Settings */
$options[] = array( "name" => __('Popular Posts Settings','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Popular Posts Heading','mvp-text'),
			"desc" => "The heading that will be displayed at the top of the Popular Posts column.",
			"id" => $shortname."_pop_head",
			"std" => "Most Popular",
			"type" => "text");

$options[] = array( "name" => __('Number of Popular Posts','mvp-text'),
			"desc" => "Set the number of posts to display in the Popular Posts sidebar.",
			"id" => $shortname."_pop_num",
			"std" => "10",
			"type" => "text");

$options[] = array( "name" => __('Popular Posts Days','mvp-text'),
			"desc" => "Number of days to use for Popular Posts. Only posts published within this length of time will be displayed in the Popular Posts column.",
			"id" => $shortname."_pop_days",
			"std" => "9999",
			"type" => "text");

$options[] = array( "name" => __('Popular Posts Ad Code','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 300x250 ad area within the Popular Posts sidebar. The ad space can accommodate an ad of any height, but with only a maximum width of 300px.",
			"id" => $shortname."_pop_ad",
			"std" => "",
			"type" => "textarea");


/* Article Settings */
$options[] = array( "name" => __('Article Settings','mvp-text'),
			"type" => "heading");

if (isset($post_layout)) {
$options[] = array( "name" => __('Default Post Template','mvp-text'),
			"desc" => __('Select the default Post Template layout for your articles.','mvp-text'),
			"id" => $shortname."_post_layout",
			"std" => "Template 1",
			"type" => "select",
			"options" => $post_layout);
}

$options[] = array( "name" => __('Show Featured Image In Posts?','mvp-text'),
			"desc" => __('Uncheck this box if you would like to remove the featured image thumbnail from all posts.','mvp-text'),
			"id" => $shortname."_featured_img",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Social Sharing Buttons?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the social sharing buttons from all posts.",
			"id" => $shortname."_social_box",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Author Info?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the author info box from the top of the posts.",
			"id" => $shortname."_author_box",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Author Email?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the author email link from within the author info box.",
			"id" => $shortname."_author_email",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Related Posts?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Related Posts from the bottom of the posts.",
			"id" => $shortname."_related_posts",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Auto Load Previous Post?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the automatic loading of the previous post below the article.",
			"id" => $shortname."_auto_load",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Show Previous/Next Post Links?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the links to the previous/next posts arrows in the margins of each article.",
			"id" => $shortname."_prev_next",
			"std" => "true",
			"type" => "checkbox");

if (isset($post_side)) {
$options[] = array( "name" => __('Article Sidebar Layout','mvp-text'),
			"desc" => __('Select your layout for the sidebar on article pages.','mvp-text'),
			"id" => $shortname."_post_side",
			"std" => "Popular",
			"type" => "select",
			"options" => $post_side);
}

$options[] = array( "name" => __('Disqus Forum Shortname','mvp-text'),
			"desc" => "If you want to use Disqus as your commenting system, enter your Disqus Forum Shortname in order to activate Disqus on your site. This is the unique identifier for your website in Disqus (i.e. yourforumshortname.disqus.com)",
			"id" => $shortname."_disqus_id",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Article Ad Code','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 300x250 ad area within the body of the article. The ad space can accommodate an ad of any height, but with only a maximum width of 300px.",
			"id" => $shortname."_post_ad",
			"std" => "",
			"type" => "textarea");


/* Category Settings */
$options[] = array( "name" => __('Category Pages','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','mvp-text'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "To set the number of posts that are displayed on category pages, go to Settings > Reading and change the 'Blog page show at most' number.",
			"type" => "info");

$options[] = array( "name" => __('Show Featured Posts','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Featured Posts section from the category pages.",
			"id" => $shortname."_featured_cat",
			"std" => "true",
			"type" => "checkbox");

if (isset($feat_layout)) {
$options[] = array( "name" => __('Featured Posts Layout','mvp-text'),
			"desc" => __('Select the layout of your Featured Posts section on the category pages.','mvp-text'),
			"id" => $shortname."_feat_cat_layout",
			"std" => "Featured 1",
			"type" => "select",
			"options" => $feat_layout);
}

if (isset($arch_layout)) {
$options[] = array( "name" => __('Category/Archive Body Layout','mvp-text'),
			"desc" => __('Select your layout for the body of your category and archive pages.','mvp-text'),
			"id" => $shortname."_arch_layout",
			"std" => "Column",
			"type" => "select",
			"options" => $arch_layout);
}


if ( post_type_exists( 'scoreboard' ) ) {

/* Scoreboard Settings */
$options[] = array( "name" => __('Scoreboard Settings','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Show Scoreboard?','mvp-text'),
			"desc" => __('Uncheck this box if you would like to remove the scoreboard.','mvp-text'),
			"id" => $shortname."_show_scoreboard",
			"std" => "false",
			"type" => "checkbox");

if (isset($light_dark)) {
$options[] = array( "name" => __('Scoreboard Skin','mvp-text'),
			"desc" => __('Choose between a light and dark skin for the scoreboard.','mvp-text'),
			"id" => $shortname."_score_skin",
			"std" => "Dark",
			"type" => "select",
			"options" => $light_dark);
}

$options[] = array( "name" => __('Name of Category 1','mvp-text'),
			"desc" => "Set the name of the 1st category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name1",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 1','mvp-text'),
			"desc" => __('Select the 1st category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat1",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 2','mvp-text'),
			"desc" => "Set the name of the 2nd category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name2",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 2','mvp-text'),
			"desc" => __('Select the 2nd category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat2",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 3','mvp-text'),
			"desc" => "Set the name of the 3rd category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name3",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 3','mvp-text'),
			"desc" => __('Select the 3rd category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat3",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 4','mvp-text'),
			"desc" => "Set the name of the 4th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name4",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 4','mvp-text'),
			"desc" => __('Select the 4th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat4",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 5','mvp-text'),
			"desc" => "Set the name of the 5th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name5",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 5','mvp-text'),
			"desc" => __('Select the 5th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat5",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 6','mvp-text'),
			"desc" => "Set the name of the 6th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name6",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 6','mvp-text'),
			"desc" => __('Select the 6th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat6",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 7','mvp-text'),
			"desc" => "Set the name of the 7th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name7",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 7','mvp-text'),
			"desc" => __('Select the 7th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat7",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 8','mvp-text'),
			"desc" => "Set the name of the 8th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name8",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 8','mvp-text'),
			"desc" => __('Select the 8th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat8",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 9','mvp-text'),
			"desc" => "Set the name of the 9th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name9",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 9','mvp-text'),
			"desc" => __('Select the 9th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat9",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

$options[] = array( "name" => __('Name of Category 10','mvp-text'),
			"desc" => "Set the name of the 10th category that will be displayed as the link above the scoreboard.",
			"id" => $shortname."_score_name10",
			"std" => "",
			"type" => "text");

if (isset($tt_tax)) {
$options[] = array( "name" => __('Select Category 10','mvp-text'),
			"desc" => __('Select the 10th category for your scoreboard.','mvp-text'),
			"id" => $shortname."_score_cat10",
			"std" => "1",
			"type" => "select",
			"options" => $tt_tax);
}

}


/* Social Media Settings */
$options[] = array( "name" => __('Social Media','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Facebook','mvp-text'),
			"desc" => "Enter your Facebook Page URL here.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Twitter','mvp-text'),
			"desc" => "Enter your Twitter URL here.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Pinterest','mvp-text'),
			"desc" => "Enter your Pinterest URL here.",
			"id" => $shortname."_pinterest",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Instagram','mvp-text'),
			"desc" => "Enter your Instagram URL here.",
			"id" => $shortname."_instagram",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Google Plus','mvp-text'),
			"desc" => "Enter your Google Plus URL here.",
			"id" => $shortname."_google",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Youtube','mvp-text'),
			"desc" => "Enter your Youtube URL here.",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Linkedin','mvp-text'),
			"desc" => "Enter your Linkedin URL here.",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Tumblr','mvp-text'),
			"desc" => "Enter your Tumblr URL here.",
			"id" => $shortname."_tumblr",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Custom RSS Link','mvp-text'),
			"desc" => "If you want to replace the default RSS link with a custom RSS link (like Feedburner), enter the URL here.",
			"id" => $shortname."_rss",
			"std" => "",
			"type" => "text");


/* Ad Management Settings */
$options[] = array( "name" => __('Ad Management','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Attention','mvp-text'),
			"desc" => "",
			"id" => $shortname."_attention_ad",
			"std" => "The 300x250 ads are controlled via a Widget.",
			"type" => "info");

if (isset($leader_loc)) {
$options[] = array( "name" => __('Leaderboard Location','framework_localize'),
			"desc" => __('Set the location of your leaderboard.','framework_localize'),
			"id" => $shortname."_leader_loc",
			"std" => "Below Navigation",
			"type" => "select",
			"options" => $leader_loc);
}

$options[] = array( "name" => __('Header Leaderboard Ad Code','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_header_leader",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Responsive Ad Area Below Article','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) to activate the responsive ad area that will be displayed below the content of each article.",
			"id" => $shortname."_article_ad",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Footer Leaderboard Ad Code','mvp-text'),
			"desc" => "Enter your ad code (Eg. Google Adsense) for the 970x90 ad area. You can also place a 728x90 ad in this spot.",
			"id" => $shortname."_footer_leader",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Wallpaper Ad Image URL','mvp-text'),
			"desc" => "Enter the URL for your wallpaper ad image. Wallpaper ad code should be a minimum of 1280px wide. Please see the theme documentation for more on wallpaper ad specifications.",
			"id" => $shortname."_wall_ad",
			"std" => "",
			"type" => "text");

$options[] = array( "name" => __('Wallpaper Ad Click-Through URL','mvp-text'),
			"desc" => "Enter the URL for your wallpaper ad click-through.",
			"id" => $shortname."_wall_url",
			"std" => "",
			"type" => "text");


/* Footer Settings */
$options[] = array( "name" => __('Footer Info','mvp-text'),
			"type" => "heading");

$options[] = array( "name" => __('Show Footer Info Box?','mvp-text'),
			"desc" => "Uncheck this box if you would like to remove the Footer Info Box.",
			"id" => $shortname."_footer_info",
			"std" => "true",
			"type" => "checkbox");

$options[] = array( "name" => __('Footer Logo','mvp-text'),
			"desc" => __('Select a file to appear as the logo in the Footer Info Box.','mvp-text'),
			"id" => $shortname."_logo_footer",
			"std" => "",
			"type" => "upload");

$options[] = array( "name" => __('Footer Info Text','mvp-text'),
			"desc" => "Enter any text to display in the Footer Info Box.",
			"id" => $shortname."_footer_text",
			"std" => "<p>Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem?</p><p>Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet.</p>",
			"type" => "textarea");

$options[] = array( "name" => __('Copyright Text','mvp-text'),
			"desc" => "Here you can enter any text you want (eg. copyright text)",
			"id" => $shortname."_copyright",
			"std" => "Copyright &copy; 2015 The Mag Theme. Theme by MVP Themes, powered by Wordpress.",
			"type" => "textarea");


update_option('of_template',$options);
update_option('of_shortname',$shortname);

}
}
?>