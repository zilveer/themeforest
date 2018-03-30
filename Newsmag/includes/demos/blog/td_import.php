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


//main menu
$td_demo_header_menu_id = td_demo_menus::create_menu('td-demo-header-menu', 'header-menu');


//footer menu
$td_demo_footer_menu = td_demo_menus::create_menu('td-demo-footer-menu', 'footer-menu');
td_demo_menus::add_link(array(
    'title' => 'Gallery',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'Contact us',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));
td_demo_menus::add_link(array(
    'title' => 'About me',
    'add_to_menu_id' => $td_demo_footer_menu,
    'url' => '#',
    'parent_id' => ''
));




/*  ----------------------------------------------------------------------------
    background - leave empty if you want to make sure that there is NO background on the demo - td_demo_misc::update_background('');
 */
td_demo_misc::update_background('');


/*  ----------------------------------------------------------------------------
    sidebars
 */

//default sidebar
td_demo_widgets::remove_widgets_from_sidebar('default');
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_9_widget',
    array (
        'sort' => 'random_posts',
        'custom_title' => 'Popular Posts',
        'limit' => '4',
        'header_color' => ''
    )
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_1_widget',
	array (
		'sort' => 'random_posts',
		'custom_title' => 'My Favorites',
		'limit' => '4',
		'header_color' => ''
	)
);
td_demo_widgets::add_widget_to_sidebar('default', 'td_block_popular_categories_widget',
    array (
        'custom_title' => 'Popular Categories',
        'limit' => '6',
        'header_color' => ''
    )
);





/*  ---------------------------------------------------------------------------
    categories
*/
$demo_cat_1_id =td_demo_category::add_category(array(
    'category_name' => 'Photography',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
    $demo_cat_2_id =td_demo_category::add_category(array(
        'category_name' => 'Ceremony',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_3_id =td_demo_category::add_category(array(
        'category_name' => 'Events',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
    $demo_cat_4_id =td_demo_category::add_category(array(
        'category_name' => 'Wedding planner',
        'parent_id' => $demo_cat_1_id,
        'category_template' => '',
        'top_posts_style' => '',
        'description' => '',
        'background_td_pic_id' => '',
        'sidebar_id' => '',
        'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
        'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
    ));
$demo_cat_5_id =td_demo_category::add_category(array(
    'category_name' => 'Travel',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));
$demo_cat_6_id =td_demo_category::add_category(array(
    'category_name' => 'Fashion',
    'parent_id' => 0,
    'category_template' => '',
    'top_posts_style' => '',
    'description' => '',
    'background_td_pic_id' => '',
    'sidebar_id' => '',
    'tdc_layout' => '', //THE MODULE ID 1 2 3 NO NAME JUST ID
    'tdc_sidebar_pos' => '', //sidebar_left, sidebar_right, no_sidebar
));




/*  ----------------------------------------------------------------------------
    menu
 */

//add the homepage to the menu
td_demo_menus::add_link(array(
    'title' => 'Home',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'url' => get_home_url(),
    'parent_id' => ''
));

// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
	'title' => 'Categories',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'url' => '#',
	'parent_id' => ''
));
td_demo_menus::add_category(array(
	'title' => 'Wedding planner',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_4_id,
	'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
	'title' => 'Fashion',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_6_id,
	'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
	'title' => 'Ceremony',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_2_id,
	'parent_id' => $parent_submenu_id
));
td_demo_menus::add_category(array(
	'title' => 'Events',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'category_id' => $demo_cat_3_id,
	'parent_id' => $parent_submenu_id
));


// mega menu multiple subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Photography',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_1_id
));


// mega menu one subcateg
td_demo_menus::add_mega_menu(array(
    'title' => 'Travel',
    'add_to_menu_id' => $td_demo_header_menu_id,
    'category_id' => $demo_cat_5_id
));


// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
	'title' => 'About me',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'url' => '#',
	'parent_id' => ''
));
// add a subcategory to the sub-menu
$parent_submenu_id = td_demo_menus::add_link(array(
	'title' => 'Contact',
	'add_to_menu_id' => $td_demo_header_menu_id,
	'url' => '#',
	'parent_id' => ''
));



/*  ---------------------------------------------------------------------------
    posts
*/
// post in featured category
td_demo_content::add_post(array(
    'title' => 'My Favourite Books',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => 'Where The Magic Happens',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_7'

));
td_demo_content::add_post(array(
    'title' => 'Every Colour Please',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => 'Simple Things Makes Me Happy',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Back On The Road',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array(get_cat_ID(TD_FEATURED_CAT), $demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_2'
));


//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Things I Like – My Favourites",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "The Glamour Gift Guide",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Best Ingredients To Have For Cooking",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_12'
));
td_demo_content::add_post(array(
    'title' => "Reading In The Morning?",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Back To Basics",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id,$demo_cat_3_id,$demo_cat_4_id,$demo_cat_5_id,$demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_3'
));



//  ----------------------------------------------------------------------------
//  Mix Cat
td_demo_content::add_post(array(
    'title' => "Postcard From Cape Town",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));
td_demo_content::add_post(array(
    'title' => 'Relaxation Is A Must For Me',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Thoughts Of Home",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "Be Free And Enjoy The Travel",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_11'
));


//  ----------------------------------------------------------------------------
//
td_demo_content::add_post(array(
    'title' => "I’ve Learned That Love Has Many Shapes",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Wine – The Perfect Combination",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Inside The Studio",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Corn With Coffee Is One Of My Favorites",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_1_id),
    'featured_image_td_id' => 'td_pic_2'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "The Simple Life",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Some Sunny Morning",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => 'Enjoy Every Morning On The Beach',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => "The Perfect Shoes and Bags to Pair With Spring Looks",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Be Positive And Enjoy Every Ride",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => 'Trends to Wear All Summer Long',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_1'
));
td_demo_content::add_post(array(
    'title' => "Spring Accessory With Personality",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_2'
));
td_demo_content::add_post(array(
    'title' => "Morning Essentials Tips",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_10'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Weekend Mode – Relaxing",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "From Morning To Night",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_5'
));
td_demo_content::add_post(array(
    'title' => "Golden Globes: Fashion Verdict On The 10 Bold Dressed",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "One Day In Venice",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "The 5 New Watch Trends To Try Now",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Amsterdam City Guide',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "This Year Adventure Calendar",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_14'
));

td_demo_content::add_post(array(
    'title' => "Banana Pancakes Are Just Delicious",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_13'
));
td_demo_content::add_post(array(
    'title' => 'The True Story About How Fashion Trends Are Born',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_12'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "The Perfect Dinner",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_11'
));
td_demo_content::add_post(array(
    'title' => 'Good Morning Smoothie',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_10'
));
td_demo_content::add_post(array(
    'title' => "Your Hottest Spring Accessory & Personality",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_9'
));
td_demo_content::add_post(array(
    'title' => "Style Tips to Look Instantly Slimmer",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_2_id),
    'featured_image_td_id' => 'td_pic_8'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => 'Shopping Is My Cardio',
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_7'
));
td_demo_content::add_post(array(
    'title' => "High Five For Fitness",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_6_id),
    'featured_image_td_id' => 'td_pic_6'
));
td_demo_content::add_post(array(
    'title' => "Dressing for New York City Fall Weekends",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_5'
));

//  ----------------------------------------------------------------------------
td_demo_content::add_post(array(
    'title' => "Christian Siriano Spring 2015 Collection: Great For Sarah Hyland",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_3_id),
    'featured_image_td_id' => 'td_pic_4'
));
td_demo_content::add_post(array(
    'title' => "Tommy Hilfiger Rock N Roll Spring 2015 Collection",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_5_id),
    'featured_image_td_id' => 'td_pic_3'
));
td_demo_content::add_post(array(
    'title' => "Kendall Jenner Exposes Some Cheeks In Tommy Hilfiger Show",
    'file' => td_global::$get_template_directory . '/includes/demos/blog/pages/post_default.txt',
    'categories_id_array' => array($demo_cat_4_id),
    'featured_image_td_id' => 'td_pic_2'
));
