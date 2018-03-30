<?php
/**
 * Created by ra on 5/14/2015.
 */



/*  ---------------------------------------------------------------------------
    top menu - MENUS MUST HAVE THE FOLLOWING NAMES:
    td-demo-top-menu
    td-demo-header-menu
    td-demo-footer-menu
*/

//top menu
$td_demo_top_menu_id = td_demo_menus::create_menu('td-demo-top-menu', 'top-menu');
td_demo_menus::add_link(array(
    'title' => 'Live Streaming',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => 'Odds',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => 'Scores',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_link(array(
    'title' => 'Buy Now',
    'add_to_menu_id' => $td_demo_top_menu_id,
    'url' => 'http://themeforest.net/item/newsmag-news-magazine-newspaper/9512331',
    'parent_id' => ''
));


//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');


//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_link(array(
    'title' => 'TV Listing',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Scores',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Odds',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Buy Now',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => 'http://themeforest.net/item/newsmag-news-magazine-newspaper/9512331',
    'parent_id' => ''
));




/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');



/*  ----------------------------------------------------------------------------
    logo
 */
td_demo_misc::update_logo(array(
    'normal' => 'td_pic_logo',
    'retina' => 'td_pic_logo',
    'mobile' => 'td_pic_logo'
));


//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_pic_logo',
    'retina' => 'td_pic_logo'
));


/*  ----------------------------------------------------------------------------
    footer text
 */
td_demo_misc::update_footer_text('We provide you with the latest breaking news and videos straight from the entertainment industry.');



/*  ----------------------------------------------------------------------------
    socials
 */
td_demo_misc::add_social_buttons(array(
    'facebook' => '#',
    'twitter' => '#',
    'vimeo' => '#',
    'vk' => '#',
    'youtube' => '#'
));


/*  ----------------------------------------------------------------------------
    ads
 */
td_demo_misc::clear_all_ads();
td_demo_misc::add_ad_image('header', 'td_sport_ad_full');
td_demo_misc::add_ad_image('sidebar', 'td_sport_ad_sidebar');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'MOST COMMENTED',
        'limit' => '3',
        'header_color' => '',
	    'border_top' => 'no_border_top'
    )
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_ad_box_widget',
	array (
		'spot_title' => '- Advertisement -',
		'spot_id' => 'sidebar'
	)
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_popular_categories_widget',
    array (
	    'custom_title' => 'POPULAR CATEGORY',
        'limit' => '6'
    )
);


/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Sport Today',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
    'tdc_color' => '#e91e63'
));
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Cycling Tour',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
        'tdc_color' => '#26a69a'
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Football',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
        'tdc_color' => '#66bb6a'
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Golf',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
        'tdc_color' => '#78909c'
    ));
    $demo_cat_5_id =td_demo_category::add_category(array(
        'category_name' => 'Horse Racing',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
        'tdc_color' => '#6d4c41'
    ));
$demo_cat_6_id =td_demo_category::add_category(array(
    'category_name' => "Tennis",
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
    'tdc_color' => '#7cb342'
));

$demo_cat_7_id =td_demo_category::add_category(array(
    'category_name' => 'Wrc',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
    'tdc_color' => '#29b6f6'
));
$demo_cat_8_id =td_demo_category::add_category(array(
    'category_name' => 'Videos',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
    'tdc_color' => '#7b1fa2'
));
$demo_cat_9_id =td_demo_category::add_category(array(
	'category_name' => 'Photos',
	'parent_id' => 0,
	'category_template' => '',
	'top_posts_style' => '',
	'description' => '',
	'background_td_pic_id' => '',
	'sidebar_id' => '',
	'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
	'tdc_sidebar_pos' => 'sidebar_right', //sidebar_left, sidebar_right, no_sidebar
	'tdc_color' => ''
));


/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'News',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php
    'td_layout' => '11',
    'homepage' => true
));


/*  ----------------------------------------------------------------------------
    menu
 */

//add the homepage to the menu
td_demo_menus::add_page(array(
    'title' => 'News',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'page_id' => $td_homepage_id,
    'parent_id' => ''
));


// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Sport Today',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Tennis',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Wrc',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_7_id
));
td_demo_menus::add_mega_menu(array(
    'title' => 'Horse racing',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id
));


// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
    'title' => 'Cycling Tour',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_2_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Golf',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Videos',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_8_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
	'title' => 'Photos',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_9_id,
	'parent_id' => $parent_submenu_id
));

/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Best Sports Bloopers 2015 Funny Sport Fails Compilation',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => 'Best Funny Wins & Fails Compilation February 2015',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Kim Kardashian Shows Off Deep Cleavage In Plunging Top & Mini",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => "Taylor Swift’s Stylish Separates In Germany – Shop Them Here",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Hard time ahead for Hodgson as England start Euro 2016",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_7'
));


//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Man United skipper again boosted for first goal",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Albatec Racing Geared-Up For World RX Of France in Europe",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "VIDEO: Neil Simpson impresses at Barum Czech Rally Zlín",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "M-Sport Hits 250 At Happy Hunting Ground",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Pedal power sees Amy complete world toughest cycle challenge",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id,$demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_3'
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Celebrating 25 years since Rally Australia’s first WRC inclusion",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Rally Australia (WRC): multiples of five',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Skipper again boosted for first England goal after win",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Solberg wins Loheac RX in front of sell-out crowd",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_11'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Hyundai Shell World Rally Team travels down under",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "United news and transfers Valencia rejected €2 millions",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Albatec Racing Geared-Up For World RX Of France in Europe",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Conwy becomes host county for Wales Rally GB",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "M-Sport Hits 250 At Happy Hunting Ground",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_7'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "VIDEO: Neil Simpson impresses at Barum Czech Rally Zlíne",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "ARR Craib MSA Scottish Rally Championship: Merrick Stages",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Solberg wins Loheac RX in front of sell-out crowd",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => 'Hyundai Shell World Rally Team travels down under',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "Rally Australia (WRC): multiples of five",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Celebrating 25 years since Rally Australia’s first WRC inclusion",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => "Best Funny Wins & Fails Compilation February 2015",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => 'Funny Videos Accident Compilation 2014 HQ – Funny Sport Fails',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Best Sports Bloopers 2015 Funny Sport Fails Compilation",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Epic Fail 93 – Extreme Sport Compilation HD",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Winners and Losers from MLS Matches Sep 5-7",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Rooney backs Sterling to be England Overmars",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Former Wimbledon champion Goran Ivanisevic always believed in US Open",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Cincinnati Masters: Federer downs Murray to set up Raonic SF challenge",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Williams Collects 3rd Straight US Open Title, $4 Million",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Marin Cilic victory means US Open will host first Grand Slam final',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Rafael Nadal shows off sleeveless top he would have worn at US",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => "Lake effect: Bubble players fight for ticket to East Lake",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'FedEx update: Horschel No. 2; Hoffmann, Palmer advance',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Horse racing tips: Monday 8 September",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => 'Scoop 6 pool expected to swell beyond £3m after 10 winners',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Tropics victory would be emotional for Dean Ivory",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Ask a Mechanic: Tuning a Campy rear derailleur",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Sport picture of the day: the flying horse',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Ask a Mechanic: Tuning a Campy rear derailleur",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Rory Mcilroy just 4-putted for the second time in two days',
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Eurobike Gallery: Canyon’s full-suspension road bike",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Hole 26 at Shepard Hollow in Southeast Michigan",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Rumour Mill: Gordon Strachan | David Beckham",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "Scotland and Germany play during Euro 16 qualifier",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_9_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "George Boateng: Keeping Ron Vlaar was Paul Lambert masterstroke",
    'file' => td_global::$get_template_directory . '/includes/demos/sport/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));