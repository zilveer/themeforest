<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'mom_';

global $meta_boxes;

$meta_boxes = array();
//Page options
$of_pages = array();
$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($of_pages_obj as $of_page) {
    $of_pages[$of_page->ID] = $of_page->post_name; }
//Category options
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
// Easing

$ease = array(
"jswing" => 'jswing',
"def" => 'def',
"easeInQuad" => 'easeInQuad',
"easeOutQuad" => 'easeOutQuad',
"easeInOutQuad" => 'easeInOutQuad',
"easeInCubic" => 'easeInCubic',
"easeOutCubic" => 'easeOutCubic',
"easeInOutCubic" => 'easeInOutCubic',
"easeInQuart" => 'easeInQuart',
"easeOutQuart" => 'easeOutQuart',
"easeInOutQuart" => 'easeInOutQuart',
"easeInQuint" => 'easeInQuint',
"easeOutQuint" => 'easeOutQuint',
"easeInOutQuint" => 'easeInOutQuint',
"easeInSine" => 'easeInSine',
"easeOutSine" => 'easeOutSine',
"easeInOutSine" => 'easeInOutSine',
"easeInExpo" => 'easeInExpo',
"easeOutExpo" => 'easeOutExpo',
"easeInOutExpo" => 'easeInOutExpo',
"easeInCirc" => 'easeInCirc',
"easeOutCirc" => 'easeOutCirc',
"easeInOutCirc" => 'easeInOutCirc',
"easeInElastic" => 'easeInElastic',
"easeOutElastic" => 'easeOutElastic',
"easeInOutElastic" => 'easeInOutElastic',
"easeInBack" => 'easeInBack',
"easeOutBack" => 'easeOutBack',
"easeInOutBack" => 'easeInOutBack',
"easeInBounce" => 'easeInBounce',
"easeOutBounce" => 'easeOutBounce',
"easeInOutBounce" => 'easeInOutBounce',              
              );
// Menus
//$mom_menus = array();
//    $all_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
//foreach ($all_menus as $mom_menu) {
//    $mom_menus[$mom_menu->term_id] = $mom_menu->name;
//}

// Get ads
$ads = get_posts('post_type=ads&posts_per_page=-1');

$get_ads = array();
foreach ($ads as $ad) {
    $get_ads[$ad->ID] = esc_attr($ad->post_title);
}

// image Path
$imgpath = MOM_URI . '/framework/metaboxes/img/';
$imagepath = MOM_URI . '/framework/metaboxes/img';
// Main settings
$meta_boxes[] = array(
	'id' => 'main_settings',
	'title' => __('Page Layout', 'theme'),
	'pages' => array( 'post', 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                //custom page
                array(
			'name'  => __('Custom Page', 'theme'),
			'id'    => "{$prefix}custom_page",
			'desc'  => __('if you want build fully customizable page, Enable this option', 'theme'),
			'type'  => 'checkbox',
		),         
		// Page Layout
                array(
			'name'  => __('Page Layout', 'theme'),
			'id'    => "{$prefix}page_layout",
			'desc'  => __('Select page layout, none mean you will use the default layout or what you set by theme options -> Layout', 'theme'),
			'type'  => 'radioimg',
			'std'   => '',
			'options' => array(
				'' => '<img src="'.$imgpath.'none.png" alt="none">',
				'right-sidebar' => '<img src="'.$imgpath.'right_side.png" alt="Right Sidebar">',
				'left-sidebar' => '<img src="'.$imgpath.'left_side.png" alt="Left Sidebar">',
				'both-sidebars-all' => '<img src="'.$imgpath.'both.png" alt="Both Sidebar">',
				'both-sidebars-right' => '<img src="'.$imgpath.'both_right.png" alt="Both Right Sidebar">',
				'both-sidebars-left' => '<img src="'.$imgpath.'both_left.png" alt="Both Left Sidebar">',
				'fullwidth' => '<img src="'.$imgpath.'no_side.png" alt="no Sidebar">',
			),
		),

                // Sidebars
                array(
			'name'  => __('Main Sidebar', 'theme'),
			'id'    => "{$prefix}right_sidebar",
			'desc'  => __('Select main sidebar', 'theme'),
                        'class' => 'hide',
			'type'  => 'sidebars',
		),                

                array(
			'name'  => __('Secondary Sidebar', 'theme'),
			'id'    => "{$prefix}left_sidebar",
			'desc'  => __('Select secondary sidebar (the small one)', 'theme'),
                        'class' => 'hide',
			'type'  => 'sidebars',
		),
                
    )

);

// Page/post background
$meta_boxes[] = array(
	'id' => 'page_background',
	'title' => __('Page Background', 'theme'),
	'pages' => array( 'post', 'page', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                  array(
			'name'  => __('Background color', 'theme'),
			'id'    => "{$prefix}custom_bg",
			'type'  => 'color',
		),

                array(
			'name'  => __('Background Image', 'theme'),
			'id'    => "{$prefix}custom_bg_img",
			'type'  => 'media',
		),

                array(
			'name'  => __('Background Position', 'theme'),
			'id'    => "{$prefix}custom_bg_pos",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array(
                                'top left'      => __('Top Left', 'theme'),
                                'top center'    => __('Top Center', 'theme'),
                                'top right'     => __('Top Right', 'theme'),
                                'center left'   => __('Middle Left', 'theme'),
                                'center center' => __('Middle Center', 'theme'),
                                'center right'  => __('Middle Right', 'theme'),
                                'bottom left'   => __('Bottom Left', 'theme'),
                                'bottom center' => __('Bottom Center', 'theme'),
                                'bottom right'  => __('Bottom Right', 'theme')
			),
		),



                array(
			'name'  => __('Background Repeat', 'theme'),
			'id'    => "{$prefix}custom_bg_repeat",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'repeat' => __('Tile', 'theme'),
				'no-repeat' => __('No Repeat', 'theme'),
				'repeat-x' => __('Tile Horizontally', 'theme'),
				'repeat-y' => __('Tile Vertically', 'theme'),
			),
		),
                array(
			'name'  => __('Background Attachment', 'theme'),
			'id'    => "{$prefix}custom_bg_attach",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'scroll' => __('Scroll', 'theme'),
				'fixed' => __('Fixed', 'theme'),
			),
		),

                array(
			'name'  => __('Background size', 'theme'),
			'id'    => "{$prefix}custom_bg_size",
			'type'  => 'select',
                        'class' => 'rw_float min_select rw_last',
			'options' => array(
				'auto' => __('inherit', 'theme'),
				'cover' => __('cover', 'theme'),
				'contain' => __('contain', 'theme'),
			),
		),                
                
    )

);

// content ads
$meta_boxes[] = array(
	'id' => 'custom_header_elements',
	'title' => __('Custom Header Elements', 'theme'),
	'pages' => array( 'post', 'page', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
                array(
			'name'  => __('Custom Logo', 'theme'),
			'id'    => "{$prefix}custom_logo",
			'type'  => 'media',
		),

                array(
			'name'  => __('Header Banner', 'theme'),
			'id'    => "{$prefix}Header_banner",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array('') +$get_ads,
		),
                
    )

);

// content ads
$meta_boxes[] = array(
	'id' => 'page_content_ads',
	'title' => __('Content Ads', 'theme'),
	'pages' => array( 'post', 'page', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(

                array(
			'name'  => __('Fixed On Scroll', 'theme'),
			'id'    => "{$prefix}content_ads_fixed",
                        'std'   => false,
			'type'  => 'checkbox',
		),

                array(
			'name'  => __('Right Banner', 'theme'),
			'id'    => "{$prefix}content_right_banner",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array('') +$get_ads,
		),
                
                array(
			'name'  => __('Left Banner', 'theme'),
			'id'    => "{$prefix}content_left_banner",
			'type'  => 'select',
                        'class' => 'rw_float min_select',
			'options' => array('') + $get_ads,
		),
    )

);


// post settings
$meta_boxes[] = array(
	'id' => 'mom_post_setting',
	'title' => __('Post Settings', 'theme'),
	'pages' => array( 'post' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
                array(
			'name'  => __('Hide Feature Area', 'theme'),
			'id'    => "{$prefix}hide_feature",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('by default you will see the feature area at the top of post it contain: feature image, video, audio or gallery', 'theme')
		),
            
                array(
			'name'  => __('Show full post', 'theme'),
			'id'    => "{$prefix}full_post",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('this option work only in blog and category, default is show excerpt or some text from the content', 'theme')
		),
            
                array(
			'name'  => __('Disable Breadcrumb', 'theme'),
			'id'    => "{$prefix}disbale_breadcrumb",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
                array(
			'name'  => __('Hide News ticker', 'theme'),
			'id'    => "{$prefix}disbale_newsticker",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
               array(
			'name'  => __('Disable posts share', 'theme'),
			'id'    => "{$prefix}blog_ps",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Next post and prev post links', 'theme'),
			'id'    => "{$prefix}blog_np",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable author box', 'theme'),
			'id'    => "{$prefix}blog_ab",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable Related posts', 'theme'),
			'id'    => "{$prefix}blog_rp",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                array(
			'name'  => __('Disable comments', 'theme'),
			'id'    => "{$prefix}blog_pc",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
    )

);
// page settings
$meta_boxes[] = array(
	'id' => 'mom_page_setting',
	'title' => __('Page Settings', 'theme'),
	'pages' => array( 'page' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(


                array(
			'name'  => __('Hide Page title', 'theme'),
			'id'    => "{$prefix}hide_pagetitle",
                        'std'   => false,
			'type'  => 'checkbox',
		),                

                array(
			'name'  => __('Disable Breadcrumb', 'theme'),
			'id'    => "{$prefix}disbale_breadcrumb",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
                array(
			'name'  => __('Hide News ticker', 'theme'),
			'id'    => "{$prefix}disbale_newsticker",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
               array(
			'name'  => __('Enable Page share', 'theme'),
			'id'    => "{$prefix}page_share",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
                array(
			'name'  => __('Enable comments', 'theme'),
			'id'    => "{$prefix}page_comments",
                        'std'   => false,
			'type'  => 'checkbox',
		),                

                array(
			'name'  => __('Unique Posts', 'theme'),
			'id'    => "{$prefix}unique_posts",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('you can use this option if you want a unique posts when you create a home page', 'theme')
		),                
    )

);

// post settings
$meta_boxes[] = array(
	'id' => 'mom_gallery_post_setting',
	'title' => __('Gallery Settings', 'theme'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'core',
	'fields' => array(
                array(
			'name'  => __('Arrows', 'theme'),
			'id'    => "{$prefix}gallery_post_arrows",
                        'std'   => false,
			'type'  => 'checkbox',
                        'desc' => __('Enable/disable arrows', 'theme')
		),
                array(
			'name'  => __('Bullets Navigation', 'theme'),
			'id'    => "{$prefix}gallery_post_bullets",
                        'std'   => true,
			'type'  => 'checkbox',
                        'desc' => __('Enable/disable bullets', 'theme')
		),
                array(
			'name'  => __('Animation', 'theme'),
			'id'    => "{$prefix}gallery_post_animation",
			'type'  => 'select',
                        'options' => array (
                                                "crossfade" => __('crossfade', 'theme'),
						"scroll" => __('scroll', 'theme'),
						"directscroll" => __('directscroll', 'theme'),
						"fade" => __('fade', 'theme'),
						"cover" => __('cover', 'theme'),
						"cover-fade" => __('cover-fade', 'theme'),
						"uncover" => __('uncover', 'theme'),
						"uncover-fade" => __('uncover-fade', 'theme'),
						"none" => __('none', 'theme'),
                        )
		),
                
                array(
			'name'  => __('Easing', 'theme'),
			'id'    => "{$prefix}gallery_post_easing",
			'type'  => 'select',
                        'options' => $ease
		),
                array(
			'name'  => __('Animation Speed', 'theme'),
			'id'    => "{$prefix}gallery_post_speed",
			'type'  => 'text',
                        'desc' => __('in ms, default is 600', 'theme')
		),
                array(
			'name'  => __('Timeout', 'theme'),
			'id'    => "{$prefix}gallery_post_timeout",
			'type'  => 'text',
                        'desc' => __('the time between each slide in ms, default 4000 = 4 seconds', 'theme')
		),
            
    )

);

// post settings
$meta_boxes[] = array(
	'id' => 'mom_portfolio_setting',
	'title' => __('Settings', 'theme'),
	'pages' => array( 'portfolio' ),
	'context' => 'side',
	'priority' => 'core',
	'fields' => array(
                array(
			'name'  => __('Hide Feature Image', 'theme'),
			'id'    => "{$prefix}hide_feature",
                        'std'   => false,
			'type'  => 'checkbox',
		),
                array(
			'name'  => __('Disable Breadcrumb', 'theme'),
			'id'    => "{$prefix}disbale_breadcrumb",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
               
                array(
			'name'  => __('Hide News ticker', 'theme'),
			'id'    => "{$prefix}disbale_newsticker",
                        'std'   => false,
			'type'  => 'checkbox',
		),                
                               
        )
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );