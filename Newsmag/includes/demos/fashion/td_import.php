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
$td_top_menu_parent_id = td_demo_menus::add_link(array(
    'title' => 'Advertising',
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
    'title' => 'Advertise with us',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Premium Advertising',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Disclaimer',
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
td_demo_misc::update_background('td_fashion_bg');



/*  ----------------------------------------------------------------------------
    logo
 */
td_demo_misc::update_logo(array(
    'normal' => 'td_pic_logo_desktop',
    'retina' => 'td_pic_logo_desktop',
    'mobile' => 'td_pic_logo_white'
));


//footer
td_demo_misc::update_footer_logo(array(
    'normal' => 'td_pic_logo_white',
    'retina' => 'td_pic_logo_white'
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


/*  ----------------------------------------------------------------------------
    sidebars
 */


//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_1_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'MUST READ',
        'limit' => '4',
        'header_color' => '',
	    'td_ajax_filter_type' => 'td_category_ids_filter',
        'border_top' => 'no_border_top'
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
    'category_name' => 'Fashion Today',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
));
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Celebrity',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Chicago Show',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Fashion Week',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_5_id =td_demo_category::add_category(array(
        'category_name' => 'New York 2014',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
    ));

$demo_cat_6_id =td_demo_category::add_category(array(
	'category_name' => "Cosmopolitan",
	'parent_id' => 0,
	'category_template' => '',
	'top_posts_style' => '',
	'description' => '',
	'background_td_pic_id' => '',
	'sidebar_id' => '',
	'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
	'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_7_id =td_demo_category::add_category(array(
    'category_name' => 'Daily street chic',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
));

$demo_cat_8_id =td_demo_category::add_category(array(
	'category_name' => 'Style hunter',
	'parent_id' => 0,
	'category_template' => '',
	'top_posts_style' => '',
	'description' => '',
	'background_td_pic_id' => '',
	'sidebar_id' => '',
	'tdc_layout' => '1', //THE MODULE ID 1 2 3 NO NAME JUST ID
	'tdc_sidebar_pos' => 'sidebar_right' //sidebar_left, sidebar_right, no_sidebar
));


/*  ----------------------------------------------------------------------------
    pages
 */
//homepage
$td_homepage_id = td_demo_content::add_page(array(
    'title' => 'News',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/homepage.txt',
    'template' => 'page-pagebuilder-latest.php',   // the page template full file name with .php
    'td_layout' => '14',
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
    'title' => 'Fashion Today',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));

// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Cosmopolitan',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_6_id
));
td_demo_menus::add_mega_menu(array(
	'title' => 'Daily street chic',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_7_id
));
td_demo_menus::add_mega_menu(array(
	'title' => 'Style hunter',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_8_id
));


// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
    'title' => 'More',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => '#',
    'parent_id' => ''
));

td_demo_menus::add_category(array(
	'title' => 'Celebrity',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_2_id,
	'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Chicago Sho',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_3_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'Fashion Week',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_4_id,
    'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
    'title' => 'New York 2014',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id,
    'parent_id' => $parent_submenu_id
));



/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'Custo Barcelona 2015 Spring Collection: Perfect For Kylie Jenner',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_10',
));



//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Alexa Chung and Sofia Vergara Don’t Play by the Red Carpet Rules",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "The 10 Runway Trends You’ll Be Wearing This Year",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Are You Already Wearing the Hottest Brands in Your City?",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id,$demo_cat_7_id,$demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_3'
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => 'Top Stylists Share Their Secrets For RED CARPET',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "We Found the Sexiest Lingerie on the Internet",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_11'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "We Found the Sexiest Lingerie on the Internet",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "The 10 Runway Trends You’ll Be Wearing This Year",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "We Found the Sexiest Lingerie on the Internet",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_7'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "What Nude Underwear Should Really Look Like",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "What Nude Underwear Should Really Look Like",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Golden Globes: Fashion Verdict On The 10 Bold Dressed",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => 'Top Stylists Share Their Secrets For RED CARPET',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "The Perfect Shoes and Bags to Pair With Spring Looks",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => 'The True Story About How Fashion Trends Are Born',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "The Perfect Shoes and Bags to Pair With Spring Looks",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Golden Globes: Fashion Verdict On The 10 Bold Dressed",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "What Nude Underwear Should Really Look Like",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Golden Globes: Fashion Verdict On The 10 Bold Dressed",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Golden Globes: Fashion Verdict On The 10 Bold Dressed",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Are You Already Wearing the Hottest Brands in Your City?',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_10'
));

td_demo_content::add_post(array(
    'title' => "Your Hottest Spring Accessory & Personality",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => 'The True Story About How Fashion Trends Are Born',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_13'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "The Perfect Shoes and Bags to Pair With Spring Looks",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_14'
));
td_demo_content::add_post(array(
    'title' => "The Perfect Shoes and Bags to Pair With Spring Looks",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Top Stylists Share Their Secrets For RED CARPET',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Your Hottest Spring Accessory & Personality",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "What Nude Underwear Should Really Look Like",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => 'Vintage Fashion: 3 Modern Ways To Shop The Decades',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => 'Top Stylists Share Their Secrets For RED CARPET',
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => "Cheryl Steals Kate Middleton’s Beauty Icon Status",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_9'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "History of Victoria’s Secret’s Sexiest Angels",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_8_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "We Found the Sexiest Lingerie on the Internet",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Everyone Saved the Best Accessories For Last at MFW",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "History of Victoria’s Secret’s Sexiest Angels",
    'file' => td_global::$get_template_directory . '/includes/demos/fashion/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_7_id),
    'featured_image_td_id' => 'td_pic_1'
));

