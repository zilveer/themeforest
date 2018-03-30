<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page' );
}

if (!function_exists( 'woo_options')) {
function woo_options() {

// THEME VARIABLES
$themename = 'Food & Cook';
$themeslug = 'food-cook';

// STANDARD VARIABLES. DO NOT TOUCH!
$shortname = 'woo';
$manualurl = 'http://daffyhazan.com/food-cook-changelog/';
$documentation = 'http://support.daffyhazan.com/online-docs/category/food-cook/';
$support = 'http://support.daffyhazan.com/forums/food-cook/';

//Access the WordPress Categories via an Array
$woo_categories = array();
$woo_categories_obj = get_categories( 'hide_empty=0' );
foreach ($woo_categories_obj as $woo_cat) {
    $woo_categories[$woo_cat->cat_ID] = $woo_cat->cat_name;}
$categories_tmp = array_unshift($woo_categories, 'Select a category:' );

//Access the WordPress Pages via an Array
$woo_pages = array();
$woo_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
foreach ($woo_pages_obj as $woo_page) {
    $woo_pages[$woo_page->ID] = $woo_page->post_name; }
$woo_pages_tmp = array_unshift($woo_pages, 'Select a page:' );

//Stylesheets Reader
$alt_stylesheet_path = get_template_directory() . '/styles/';
$alt_stylesheets = array();
if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) {
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, '.css') !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }
    }
}

// More Options
$slide_options = array();
$total_possible_slides = 10;
for ( $i = 1; $i <= $total_possible_slides; $i++ ) { $slide_options[] = $i; }

// Setup an array of slide-page terms for a dropdown.
$args = array( 'echo' => 0, 'hierarchical' => 1, 'taxonomy' => 'slide-page' );
$cats_dropdown = wp_dropdown_categories( $args );
$cats = array();

// Quick string hack to make sure we get the pages with the indents.
$cats_dropdown = str_replace( "<select name='cat' id='cat' class='postform' >", '', $cats_dropdown );
$cats_dropdown = str_replace( '</select>', '', $cats_dropdown );
$cats_split = explode( '</option>', $cats_dropdown );

$cats[] = __( 'Select a Slide Group:', 'woothemes' );

foreach ( $cats_split as $k => $v ) {
    $id = '';
    // Get the ID value.
    preg_match( '/value="(.*?)"/i', $v, $matches );

    if ( isset( $matches[1] ) ) {
        $id = $matches[1];
        $cats[$id] = trim( strip_tags( $v ) );
    }
}

$slide_groups = $cats;

//Revolution Slider
$revolutionslider = array();
$revolutionslider[0] = 'No Slider';

if(class_exists('RevSlider')){
    $slider = new RevSlider();
    $arrSliders = $slider->getArrSliders();
    foreach($arrSliders as $revSlider) {
        $revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
     }
    } else {
    $revolutionslider[0] = __('Install RevolutionSlider Plugin First!', 'woothemes');
  }

$revslider_options = $revolutionslider;

// Setup an array of numbers.
$woo_numbers = array();
for ( $i = 1; $i <= 20; $i++ ) {
    $woo_numbers[$i] = $i;
}

$options_pixels = array("0px","1px","2px","3px","4px","5px","6px","7px","8px","9px","10px","11px","12px","13px","14px","15px","16px","17px","18px","19px","20px");
$other_entries = array( '0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19' );
$other_entries_2 = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");

// THIS IS THE DIFFERENT FIELDS
$options = array();

/* General */

$options[] = array( 'name' => __( 'General Settings', 'woothemes' ),
    				'type' => 'heading',
    				'icon' => 'general' );

$options[] = array( 'name' => __( 'Quick Start', 'woothemes' ),
    				'type' => 'subheading' );


// $options[] = array( 'name' => __( 'Text Title', 'woothemes' ),
//                     'desc' => sprintf( __( 'Enable text-based Site Title and Tagline. Setup title & tagline in %1$s.', 'woothemes' ), '<a href="' . esc_url( home_url() ) . '/wp-admin/options-general.php">' . __( 'General Settings', 'woothemes' ) . '</a>' ),
//                     'id' => $shortname . '_texttitle',
//                     'std' => 'false',
//                     'type' => 'checkbox' );

// $options[] = array( 'name' => __( 'Site Description', 'woothemes' ),
//                     'desc' => __( 'Enable the site description/tagline under site title.', 'woothemes' ),
//                     'id' => $shortname . '_tagline',
//                     'std' => 'false',
//                     'type' => 'checkbox' );

// $options[] = array( 'name' => __( 'Custom Favicon', 'woothemes' ),
//     				'desc' => sprintf( __( 'Upload a 16px x 16px %1$s that will represent your website\'s favicon.', 'woothemes' ), '<a href="http://www.faviconr.com/">'.__( 'ico image', 'woothemes' ).'</a>' ),
//     				'id' => $shortname . '_custom_favicon',
//     				'std' => get_template_directory_uri().'/includes/assets/images/favicon.png',
//     				'type' => 'upload' );

$options[] = array(
   'name' => __( 'Show Advanced Search ?', 'woothemes' ),
   'desc' => __( 'Check to show advanced search', 'woothemes' ),
   'id'   => $shortname . '_advanced_search',
   'std'  => 'true',
   'type' => 'checkbox'
);

$options[] = array( 'name' => __( 'Show Topbar', 'woothemes' ),
                                                    'desc' => __( 'Check to show topbar', 'woothemes' ),
                                                     'id' => $shortname . '_check_topbar',
                                                     'std' => 'true',
                                                    'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Show Social Icons in Topbar', 'woothemes' ),
                                                    'desc' => __( 'Check to show Social Icons in Topbar (Configure Icons in Subscribe & Connect)', 'woothemes' ),
                                                     'id' => $shortname . '_social_top',
                                                     'std' => 'false',
                                                    'type' => 'checkbox' );



$options[] = array( "name" => __( 'Tracking Code', 'woothemes' ),
					"desc" => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme.', 'woothemes' ),
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");

// $options[] = array( 'name' => __( 'Subscription Settings', 'woothemes' ),
// 					'type' => 'subheading' );

// $options[] = array( 'name' => __( 'E-Mail Subscription URL', 'woothemes' ),
//     				'desc' => __( 'Enter your preferred E-mail subscription URL. (Feedburner or other)', 'woothemes' ),
//     				'id' => $shortname . '_subscribe_email',
//     				'std' => '',
//     				'type' => 'text' );

$options[] = array( 'name' => __( 'Display Options', 'woothemes' ),
    				'type' => 'subheading' );

$options[] = array( 'name' => __( 'Custom CSS', 'woothemes' ),
    				'desc' => __( 'Quickly add some CSS to your theme by adding it to this block.', 'woothemes' ),
    				'id' => $shortname . '_custom_css',
    				'std' => '',
    				'type' => 'textarea' );

$options[] = array( 'name' => __( 'Post/Page Comments', 'woothemes' ),
    				'desc' => __( 'Select if you want to enable/disable comments on posts and/or pages.', 'woothemes' ),
    				'id' => $shortname . '_comments',
    				'std' => 'post',
    				'type' => 'select2',
    				'options' => array( 'post' => __( 'Posts Only', 'woothemes' ), 'page' => __( 'Pages Only', 'woothemes' ), 'both' => __( 'Pages / Posts', 'woothemes' ), 'none' => __( 'None', 'woothemes' ) ) );

$options[] = array( 'name' => __( 'Post Content', 'woothemes' ),
    				'desc' => __( 'Select if you want to show the full content or the excerpt on posts.', 'woothemes' ),
    				'id' => $shortname . '_post_content',
    				'type' => 'select2',
    				'options' => array( 'excerpt' => __( 'The Excerpt', 'woothemes' ), 'content' => __( 'Full Content', 'woothemes' ) ) );


$options[] = array( 'name' => __( 'Show Page Title', 'woothemes' ),
                    'desc' => __( 'Display dynamic Title on each page of your website.', 'woothemes' ),
                    'id' => $shortname . '_show_page_header_title',
                    'std' => 'false',
                    'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Display Breadcrumbs', 'woothemes' ),
    				'desc' => __( 'Display dynamic breadcrumbs on each page of your website.', 'woothemes' ),
    				'id' => $shortname . '_breadcrumbs_show',
    				'std' => 'false',
    				'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Page Title Alignment', 'woothemes' ),
                    'desc' => __( 'Display page Title Align on each page of your website.', 'woothemes' ),
                    'id' => $shortname . '_page_header_title_align',
                    'std' => 'left',
                    'type' => 'select2',
                    'options' => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right'
                        ) );

$options[] = array( "name" => __( 'post archive style', 'woothemes' ),
                "desc" => __( 'Select style for archive post', 'woothemes' ),
                "id" => $shortname."_arch_post",
                "std" => "standard",
                "type" => "select2",
                "options" => array( 'standard-post' => __('Standard', 'woothemes'), 'elegant-post' => __('Elegant', 'woothemes') ) );

$options[] = array( "name" => __( 'Disable Post Author', 'woothemes' ),
                                                      "desc" => __( 'Disable post author below post?', 'woothemes' ),
                                                      "id" => $shortname."_disable_post_author",
                                                      "std" => "false",
                                                     "type" => "checkbox");

$options[] = array( 'name' => __( 'Display Pagination', 'woothemes' ),
    				'desc' => __( 'Display pagination on the blog.', 'woothemes' ),
    				'id' => $shortname . '_pagenav_show',
    				'std' => 'true',
    				'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Pagination Style', 'woothemes' ),
    				'desc' => __( 'Select the style of pagination you would like to use on the blog.', 'woothemes' ),
    				'id' => $shortname . '_pagination_type',
    				'type' => 'select2',
    				'options' => array( 'paginated_links' => __( 'Numbers', 'woothemes' ), 'simple' => __( 'Next/Previous', 'woothemes' ) ) );


/* Advertising */
$options[] = array( 'name' => __( 'Advertising', 'woothemes' ),
					'type' => 'subheading' );

$options[] = array( "name" => __( 'Enable Ad (Ad - Top (468x60))', 'woothemes' ),
					"desc" => __( 'Enable the ad space', 'woothemes' ),
					"id" => $shortname."_ad_top",
					"std" => "false",
					"type" => "checkbox");

$options[] = array( "name" => __( 'Adsense code', 'woothemes' ),
					"desc" => __( 'Enter your adsense code (or other ad network code) here.', 'woothemes' ),
					"id" => $shortname."_ad_top_adsense",
					"std" => "",
					"type" => "textarea");

$options[] = array( "name" => __( 'Image Location', 'woothemes' ),
					"desc" => __( 'Enter the URL to the banner ad image location.', 'woothemes' ),
					"id" => $shortname."_ad_top_image",
					"std" => "http://dahz.daffyhazan.com/images/ads/banner468x60.jpg",
					"type" => "upload");

$options[] = array( "name" => __( 'Destination URL', 'woothemes' ),
					"desc" => __( 'Enter the URL where this banner ad points to.', 'woothemes' ),
					"id" => $shortname."_ad_top_url",
					"std" => "http://dahz.daffyhazan.com",
					"type" => "text");


/* General Styling */


$options[] = array( 'name' => __( 'Layout Options', 'woothemes' ),
                    'type' => 'heading',
                    'icon' => 'styling' );

$options[] = array( 'name' => __( 'General Styling', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( "name" => __( 'Disable ALL Custom Styling', 'woothemes' ),
                    "desc" => __( 'disable output of all custom styling (CSS) from the theme options and use default styles from the stylesheet.', 'woothemes' ),
                    "id" => $shortname."_style_disable",
                    "std" => "true",
                    "type" => "checkbox");

$options[] = array( "name" => __( 'Link Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for links or add a hex color code e.g. #697e09', 'woothemes' ),
                    "id" => $shortname."_link_color",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Link Hover Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for links hover or add a hex color code e.g. #697e09', 'woothemes' ),
                    "id" => $shortname."_link_hover_color",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Button Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for buttons or add a hex color code e.g. #697e09', 'woothemes' ),
                    "id" => $shortname."_button_color",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Button Hover Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom hover color for buttons or add a hex color code e.g. #697e09', 'woothemes' ),
                    "id" => $shortname."_button_hover_color",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'General Border Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for general border colors or add a hex color code e.g. #e6e6e6', 'woothemes' ),
                    "id" => $shortname."_style_border",
                    "std" => "",
                    "type" => "color");


/* General Layout*/

$options[] = array( 'name' => __( 'General Layout', 'woothemes' ),
                    'type' => 'subheading' );

// $options[] = array( "name" => __( 'Site Width', 'woothemes' ),
//                             "desc" => "Set the width (in px) that you would like your content column to be (recommended max-width is 1600px)",
//                             "id" => $shortname."_layout_width",
//                             "std" => "960",
//                             "min" => "600",
//                             "max" => "1600",
//                             "increment" => "10",
//                             "type" => 'slider' );

$url =  get_template_directory_uri() . '/functions/images/';
$options[] = array( "name" => __( 'Main Layout', 'woothemes' ),
                        "desc" => __( 'Select main content and sidebar alignment. Choose between 1, 2 column layout.', 'woothemes' ),
                        "id" => $shortname . "_layout",
                        "std" => "two-col-left",
                        "type" => "images",
                        "options" => array(
                           'one-col' => $url . '1c.png',
                            'two-col-left' => $url . '2cl.png',
                            'two-col-right' => $url . '2cr.png',
                            'three-col-left' => $url . '3cl.png',
                            'three-col-middle' => $url . '3cm.png',
                            'three-col-right' => $url . '3cr.png'
                            )
                        );

$options[] = array( "name" => __( 'Category Exclude - Homepage', 'woothemes' ),
                    "desc" => __( 'Specify a comma seperated list of category IDs or slugs that you\'d like to exclude from your homepage (eg: uncategorized).', 'woothemes' ),
                    "id" => $shortname."_exclude_cats_home",
                    "std" => "",
                    "type" => "text" );

$options[] = array( "name" => __( 'Category Exclude - Blog Page Template', 'woothemes' ),
                    "desc" => __( 'Specify a comma seperated list of category IDs or slugs that you\'d like to exclude from your \'Blog\' page template (eg: uncategorized).', 'woothemes' ),
                    "id" => $shortname."_exclude_cats_blog",
                    "std" => "",
                    "type" => "text" );


/* Boxed Layout*/

$options[] = array( 'name' => __( 'Boxed Layout', 'woothemes' ),
                    'type' => 'subheading' );


$options[] = array(
    'name'    => __( 'Enable boxed layout', 'woothemes' ) ,
    'desc'    => __( 'Wrap your site content stretched or inside a box.', 'woothemes' ) ,
    'id'      => $shortname . '_boxed_layout',
    'std'     => 'false',
    'type'    => 'checkbox'
);

$options[] = array(
    "name"    =>  __( 'Background Color', 'woothemes' ),
    "desc"    => __( 'Pick a custom color for site background or add a hex color code e.g. #e6e6e6', 'woothemes' ),
    "id"      => $shortname . "_style_bg",
    "std"     => "",
    "type"    => "color"
);

$options[] = array(
    "name"    => __( 'Background Image', 'woothemes' ),
    "desc"    => __( 'Upload a background image, or specify the image address of your image. (http://yoursite.com/image.png)', 'woothemes' ),
    "id"      => $shortname . "_style_bg_image",
    "std"     => "",
    "type"    => "upload"
);

$options[] = array(
    "name"    => __( 'Background Image Repeat', 'woothemes' ),
    "desc"    => __( 'Select how you want your background image to display.', 'woothemes' ),
    "id"      => $shortname . "_style_bg_image_repeat",
    "type"    => "select",
    "std"     => "repeat",
    "options" => array(
                    "No Repeat"           => "no-repeat",
                    "Repeat"              => "repeat",
                    "Repeat Horizontally" => "repeat-x",
                    "Repeat Vertically"   => "repeat-y"
) );

$options[] = array(
    'name'    => __( 'Background image position', 'woothemes' ),
    'desc'    => __( 'Select how you would like to position the background', 'woothemes' ),
    'id'      => $shortname . '_style_bg_image_pos',
    'std'     => 'top left',
    'type'    => 'select',
    'options' => array(
                    "top left",
                    "top center",
                    "top right",
                    "center left",
                    "center center",
                    "center right",
                    "bottom left",
                    "bottom center",
                    "bottom right"
) );

$options[] = array(
    "name"    => __( 'Background Attachment', 'woothemes' ),
    "desc"    => __( 'Select whether the background should be fixed or move when the user scrolls', 'woothemes' ),
    "id"      => $shortname . "_style_bg_image_attach",
    "std"     => "scroll",
    "type"    => "select",
    "options" => array(
                    "scroll",
                    "fixed"
) );

$options[] = array(
    "name"    => __( 'Background Size', 'woothemes' ),
    "desc"    => __( 'Select whether the background size', 'woothemes' ),
    "id"      => $shortname . "_style_bg_image_size",
    "std"     => "cover",
    "type"    => "select",
    "options" => array(
                    "contain",
                    "cover",
                    "auto"
) );

$options[] = array(
    "name"    => __( 'Box Background Color', 'woothemes' ),
    "desc"    => __( 'Pick a custom color for the boxed background or add a hex color code e.g. #ffffff', 'woothemes' ),
    "id"      => $shortname . "_style_box_bg",
    "std"     => "",
    "type"    => "color"
);

$options[] = array(
    "name"    => __( 'Box Shadow', 'woothemes' ),
    "desc"    => __( 'Enable box shadow. Will only show in CSS3 compatible browser.', 'woothemes' ),
    "id"      => $shortname . "_box_shadow",
    "std"     => "true",
    "type"    => "checkbox"
);

/* Top Navigation */
$options[] = array( 'name' => __( 'Top Navigation', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( "name" => __( 'Top Heading Bar - Border Top Color', 'woothemes' ),
                    "desc" => sprintf( __( 'Pick a custom color for the top navigation background or add a hex color code e.g. #000.', 'woothemes' )),
                    "id" => $shortname."_top_nav_border",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Top Heading Bar - Border Bottom Color', 'woothemes' ),
                    "desc" => sprintf( __( 'Pick a custom color for the top navigation background or add a hex color code e.g. #000.', 'woothemes' )),
                    "id" => $shortname."_top_nav_border_bottom",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Top Navigation - Background Color', 'woothemes' ),
                    "desc" => sprintf( __( 'Pick a custom color for the top navigation background or add a hex color code e.g. #000.<br />Top Navigation can be added with <a href="%s">WP Menus</a>', 'woothemes' ), admin_url( 'nav-menus.php' ) ),
                    "id" => $shortname."_top_nav_bg",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Top Navigation - Hover Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for the top navigation hover text color or add a hex color code e.g. #000', 'woothemes' ),
                    "id" => $shortname."_top_nav_hover",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Top Navigation - Hover Background Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for the top navigation hover background color or add a hex color code e.g. #000', 'woothemes' ),
                    "id" => $shortname."_top_nav_hover_bg",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Top Search - Background Color', 'woothemes' ),
                    "desc" => __( 'Pick a custom color for the top search background color or add a hex color code e.g. #000', 'woothemes' ),
                    "id" => $shortname."_top_search_bg",
                    "std" => "",
                    "type" => "color");

/* Navigation Styling */
$options[] = array( 'name' => __( 'Primary Navigation', 'woothemes' ),
          'type' => 'subheading' );

$options[] = array( "name" => __( 'Background Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the navigation background or add a hex color code e.g. #cccccc', 'woothemes' ),
          "id" => $shortname."_nav_bg",
          "std" => "",
          "type" => "color");

$options[] = array( "name" => __( 'Hover Text Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the navigation hover text color or add a hex color code e.g. #eeeeee', 'woothemes' ),
          "id" => $shortname."_nav_hover",
          "std" => "",
          "type" => "color");

$options[] = array( "name" => __( 'Hover Background Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the navigation hover background color or add a hex color code e.g. #eeeeee', 'woothemes' ),
          "id" => $shortname."_nav_hover_bg",
          "std" => "",
          "type" => "color");

$options[] = array( "name" => __( 'Current Item Text Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the text color of the current menu item in the navigation, or add a hex color code e.g. #eeeeee', 'woothemes' ),
          "id" => $shortname."_nav_currentitem",
          "std" => "",
          "type" => "color");

$options[] = array( "name" => __( 'Current Item Background Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the background of the current menu item in the navigation, or add a hex color code e.g. #eeeeee', 'woothemes' ),
          "id" => $shortname."_nav_currentitem_bg",
          "std" => "",
          "type" => "color");

$options[] = array( "name" => __( 'Divider', 'woothemes' ),
          "desc" => __( 'Specify border properties for the menu items dividers.', 'woothemes' ),
          "id" => $shortname."_nav_divider_border",
          "std" => array('width' => '1','style' => 'solid','color' => '#dbdbdb'),
          "type" => "border");

$options[] = array( "name" => __( 'Dropdown menu border', 'woothemes' ),
          "desc" => __( 'Specify border properties for the navigation dropdown menu.', 'woothemes' ),
          "id" => $shortname."_nav_dropdown_border",
          "std" => array('width' => '1','style' => 'solid','color' => '#dbdbdb'),
          "type" => "border");

$options[] = array( "name" => __( 'Border Top', 'woothemes' ),
          "desc" => __( 'Specify border properties for the navigation.', 'woothemes' ),
          "id" => $shortname."_nav_border_top",
          "std" => array('width' => '0','style' => 'solid','color' => '#dbdbdb'),
          "type" => "border");

$options[] = array( "name" => __( 'Border Bottom', 'woothemes' ),
          "desc" => __( 'Specify border properties for the navigation.', 'woothemes' ),
          "id" => $shortname."_nav_border_bot",
          "std" => array('width' => '1','style' => 'solid','color' => '#dbdbdb'),
          "type" => "border");

$options[] = array( "name" => __( 'Background Sub Menu Color', 'woothemes' ),
          "desc" => __( 'Pick a custom color for the navigation background or add a hex color code e.g. #cccccc', 'woothemes' ),
          "id" => $shortname."_nav_sub_bg",
          "std" => "",
          "type" => "color");


/*Footer Styling */

$options[] = array( 'name' => __( 'Footer', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( "name" => __( 'Footer Background', 'woothemes' ),
                    "desc" => __( 'Select the background color you want for your footer.', 'woothemes' ),
                    "id" => $shortname."_footer_bg",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Footer Border Top', 'woothemes' ),
                    "desc" => __( 'Specify top border properties for the footer.', 'woothemes' ),
                    "id" => $shortname."_footer_border_top",
                    "std" => array('width' => '3','style' => 'solid','color' => '#ebebeb'),
                    "type" => "border");

$options[] = array( "name" => __( 'Footer Border Bottom', 'woothemes' ),
                    "desc" => __( 'Specify bottom border properties for the footer.', 'woothemes' ),
                    "id" => $shortname."_footer_border_bottom",
                    "std" => array('width' => '1','style' => 'solid', 'color' => '#bf9764'),
                    "type" => "border");

/*Recipe*/

$options[] = array( 'name' => __( 'Recipe Styling', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( "name" => __( 'Icon - Background Color', 'woothemes' ),
                    "desc" => __( 'Select the background color you want for your icon background e.g #000.', 'woothemes' ),
                    "id" => $shortname."_recipe_icon_bg",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Icon - Background Hover', 'woothemes' ),
                    "desc" => __( 'Select the background color hover you want for your Icon hover background e.g #000.', 'woothemes' ),
                    "id" => $shortname."_recipe_icon_hover_bg",
                    "std" => "",
                    "type" => "color");

// $options[] = array( "name" => __( 'Rating - Background Color', 'woothemes' ),
//                     "desc" => __( 'Select the background color you want for your icon background e.g #000.', 'woothemes' ),
//                     "id" => $shortname."_recipe_rating_bg",
//                     "std" => "",
//                     "type" => "color");

$options[] = array( "name" => __( 'Image Border Bottom', 'woothemes' ),
                    "desc" => __( 'Select the border color you want for your recipe image.', 'woothemes' ),
                    "id" => $shortname."_recipe_img_border_bottom",
                    "std" => array('width' => '3px','style' => 'solid', 'color' => '#bf9764'),
                    "type" => "border");

$options[] = array( "name" => __( 'Extra Info Border Bottom', 'woothemes' ),
                    "desc" => __( 'Select the border color you want for your extra info border.', 'woothemes' ),
                    "id" => $shortname."_recipe_img_border_bottom_single",
                    "std" => array('width' => '1px','style' => 'solid', 'color' => '#bf9764'),
                    "type" => "border");

if(class_exists('woocommerce')){
/*Shop*/
$options[] = array( 'name' => __( 'Shop Styling', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( "name" => __( 'Top Cart - Background Color ', 'woothemes' ),
                    "desc" => __( 'Select the background color you want for your on sale background e.g #000.', 'woothemes' ),
                    "id" => $shortname."_shop_top_cart_bg",
                    "std" => "",
                    "type" => "color");

$options[] = array( "name" => __( 'Image Border Bottom', 'woothemes' ),
                    "desc" => __( 'Select the border color you want for your shop image.', 'woothemes' ),
                    "id" => $shortname."_shop_img_border_bottom",
                    "std" => array('width' => '2px','style' => 'solid', 'color' => '#bf9764'),
                    "type" => "border");

$options[] = array( "name" => __( 'On Sale - Background Color ', 'woothemes' ),
                    "desc" => __( 'Select the background color you want for your onsale background e.g #000.', 'woothemes' ),
                    "id" => $shortname."_shop_onsale_bg",
                    "std" => "",
                    "type" => "color");
}
/* Typography */

$options[] = array(
    'name' => __( 'Typography', 'woothemes' ),
    'type' => 'heading',
    'icon' => 'typography'
);

$options[] = array(
    'name' => __( 'Enable Custom Typography', 'woothemes' ) ,
    'desc' => __( 'Enable the use of custom typography for your site. Custom styling will be output in your sites HEAD.', 'woothemes' ) ,
    'id'   => $shortname . '_typography',
    'std'  => 'false',
    'type' => 'checkbox'
);

$options[] = array(
    'name' => __( 'General Typography', 'woothemes' ) ,
    'desc' => __( 'Change the general font.', 'woothemes' ) ,
    'id'   => $shortname . '_font_body',
    'std'  => array(
                'size'  => '13',
                'unit'  => 'px',
                'face'  => 'Open Sans',
                'style' => 'normal',
                'color' => '#545454'
              ),
    'type' => 'typography'
);

$options[] = array(
    'name' => __( 'Navigation', 'woothemes' ) ,
    'desc' => __( 'Change the navigation font.', 'woothemes' ) ,
    'id'   => $shortname . '_font_nav',
    'std'  => array(
                'size'  => '14',
                'unit'  => 'px',
                'face'  => 'Georgia',
                'style' => 'normal',
                'color' => '#545454'
              ),
    'type' => 'typography'
);

$options[] = array(
    'name' => __( 'Headings', 'woothemes' ) ,
    'desc' => __( 'Change the headings font.', 'woothemes' ) ,
    'id'   => $shortname . '_font_page_title',
    'std'  => array(
                'size'  => '24',
                'unit'  => 'px',
                'face'  => 'Georgia',
                'style' => 'normal',
                'color' => '#545454'
              ),
    'type' => 'typography'
);

// $options[] = array( "name" => __( 'Top Navigation Font Style', 'woothemes' ),
//                     "desc" => __( 'Select typography for navigation.', 'woothemes' ),
//                     "id" => $shortname."_top_nav_font",
//                     "std" => array('size' => '13','unit' => 'px', 'face' => 'Open Sans','style' => 'thin','color' => '#b9b9b9'),
//                     "type" => "typography");

// $options[] = array( 'name' => __( 'Navigation', 'woothemes' ) ,
//             'desc' => __( 'Change the navigation font.', 'woothemes' ),
//             'id' => $shortname . '_font_nav',
//             'std' => array( 'size' => '14', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Page Title', 'woothemes' ) ,
//             'desc' => __( 'Change the page title.', 'woothemes' ) ,
//             'id' => $shortname . '_font_page_title',
//             'std' => array( 'size' => '24', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Post Title', 'woothemes' ) ,
//             'desc' => __( 'Change the post title.', 'woothemes' ) ,
//             'id' => $shortname . '_font_post_title',
//             'std' => array( 'size' => '24', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Post Meta', 'woothemes' ),
//             'desc' => __( 'Change the post meta.', 'woothemes' ) ,
//             'id' => $shortname . '_font_post_meta',
//             'std' => array( 'size' => '11', 'unit' => 'px', 'face' => 'Open Sans', 'style' => '', 'color' => '#b9b9b9' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Post Entry', 'woothemes' ) ,
//             'desc' => __( 'Change the post entry.', 'woothemes' ) ,
//             'id' => $shortname . '_font_post_entry',
//             'std' => array( 'size' => '13', 'unit' => 'px', 'face' => 'Open Sans', 'style' => '', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Recipe Title Entry', 'woothemes' ) ,
//             'desc' => __( 'Change the recipe title entry.', 'woothemes' ) ,
//             'id' => $shortname . '_font_recipe_title',
//             'std' => array( 'size' => '13', 'unit' => 'px', 'face' => 'Open Sans', 'style' => '', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Widget Titles', 'woothemes' ) ,
//             'desc' => __( 'Change the widget titles.', 'woothemes' ) ,
//             'id' => $shortname . '_font_widget_titles',
//             'std' => array( 'size' => '14', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'Normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Widget Text', 'woothemes' ) ,
//             'desc' => __( 'Change the widget text.', 'woothemes' ) ,
//             'id' => $shortname . '_font_widget_text',
//             'std' => array( 'size' => '13', 'unit' => 'px', 'face' => 'Open Sans', 'style' => 'Normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Footer Titles', 'woothemes' ) ,
//             'desc' => __( 'Change the footer titles.', 'woothemes' ) ,
//             'id' => $shortname . '_font_footer_titles',
//             'std' => array( 'size' => '12', 'unit' => 'px', 'face' => 'Georgia', 'style' => 'Normal', 'color' => '#545454' ),
//             'type' => 'typography' );

// $options[] = array( 'name' => __( 'Footer Text', 'woothemes' ) ,
//             'desc' => __( 'Change the footer text.', 'woothemes' ) ,
//             'id' => $shortname . '_font_footer_text',
//             'std' => array( 'size' => '13', 'unit' => 'px', 'face' => 'Open Sans', 'style' => 'Normal', 'color' => '#545454' ),
//             'type' => 'typography' );

/* Featured Slider */
/* See top of file for logic pertaining to $slide_options and $slide_groups arrays. */

$options[] = array( 'name' => __( 'Featured Slider', 'woothemes' ),
                    'icon' => 'slider',
                    'type' => 'heading' );

$options[] = array( 'name' => __( 'Slider Content', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( 'name' => __( 'Enable Featured Slider', 'woothemes' ),
                    'desc' => __( 'Enable the featured slider on the homepage.', 'woothemes' ),
                    'id' => $shortname . '_featured',
                    'std' => 'false',
                    'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Number of Slides', 'woothemes' ),
                    'desc' => __( 'Select the number of slides that should appear in the featured slider.', 'woothemes' ),
                    'id' => $shortname . '_featured_entries',
                    'std' => '3',
                    'type' => 'select',
                    'options' => $slide_options );

$options[] = array( 'name' => __( 'Slide Group', 'woothemes' ),
                    'desc' => __( 'Optionally choose to display only slides from a specific slide group.', 'woothemes' ),
                    'id' => $shortname . '_featured_slide_group',
                    'std' => '0',
                    'type' => 'select2',
                    'options' => $slide_groups );

$options[] = array( 'name' => __( 'Display Title On Video Slides', 'woothemes' ),
                    'desc' => __( 'If a slide has a video in the "Embed Code" field, display the slide title & content.', 'woothemes' ),
                    'id' => $shortname . '_featured_videotitle',
                    'std' => 'true',
                    'type' => 'checkbox');

$options[] = array( 'name' => __( 'Display Order', 'woothemes' ),
                    'desc' => __( 'Select which way you wish to order your slider posts.', 'woothemes' ),
                    'id' => $shortname . '_featured_order',
                    'std' => 'DESC',
                    'type' => 'select2',
                    'options' => array( 'DESC' => __( 'Newest to oldest', 'woothemes' ), 'ASC' => __( 'Oldest to newest', 'woothemes' ) ) );

$options[] = array( 'name' => __( 'Slider Settings', 'woothemes' ),
                    'type' => 'subheading' );

$options[] = array( 'name' => __( 'Animation Effect', 'woothemes' ),
                    'desc' => __( 'Select whether the featured slider should slide or fade.', 'woothemes' ),
                    'id' => $shortname . '_featured_animation',
                    'std' => 'fade',
                    'type' => 'select2',
                    'options' => array( 'fade' => __( 'Fade', 'woothemes' ), 'slide' => __( 'Slide', 'woothemes' ) ) );

$options[] = array( 'name' => __( 'Next / Previous Navigation', 'woothemes' ),
                    'desc' => __( 'Select to enable next/prev slider for the featured slider.', 'woothemes' ),
                    'id' => $shortname . '_featured_nextprev',
                    'std' => 'true',
                    'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Pagination Controls', 'woothemes' ),
                    'desc' => __( 'Select to enable pagination for the featured slider.', 'woothemes' ),
                    'id' => $shortname . '_featured_pagination',
                    'std' => 'false',
                    'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Pause On Hover', 'woothemes' ),
                    'desc' => __( 'Hovering over the featured slider will pause it.', 'woothemes' ),
                    'id' => $shortname . '_featured_hover',
                    'std' => 'true',
                    'type' => 'checkbox');

$options[] = array( 'name' => __( 'Pause On Action', 'woothemes' ),
                    'desc' => __( 'Using the featured slider navigation manually will pause it.', 'woothemes' ),
                    'id' => $shortname . '_featured_action',
                    'std' => 'true',
                    'type' => 'checkbox');

$options[] = array( 'name' => __( 'Auto-Animate Interval', 'woothemes' ),
                    'desc' => sprintf( __( 'The time in %1$sseconds%2$s each slide pauses for, before transitioning to the next %3$s(set to "Off" to disable automatic transitions).', 'woothemes' ), '<strong>', '</strong>', '<br /><br />' ),
                    'id' => $shortname . '_featured_speed',
                    'std' => '7',
                    'type' => 'select2',
                    'options' => array_merge( array( '0' => __( 'Off', 'woothemes' ) ), $slide_options ) );

$options[] = array( 'name' => __( 'Animation Speed', 'woothemes' ),
                    'desc' => sprintf( __( 'The time in %1$sseconds%2$s the animation between slides will take.', 'woothemes' ), '<strong>', '</strong>' ),
                    'id' => $shortname . '_featured_animation_speed',
                    'std' => '0.6',
                    'type' => 'select',
                    'options' => array( '0.0', '0.1', '0.2', '0.3', '0.4', '0.5', '0.6', '0.7', '0.8', '0.9', '1.0', '1.1', '1.2', '1.3', '1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0' ) );


/* Homepage */
    $options[] = array( 'name' => __( 'Homepage', 'woothemes' ),
                        'type' => 'heading',
                        'icon' => 'homepage' );


   // Sidebar Setup
    $options[] = array( 'name' => __( 'Sidebar', 'woothemes' ),
                        'type' => 'subheading' );

    $options[] = array( 'name' => __( 'Display a sidebar', 'woothemes' ),
                        'desc' => __( 'Display a sidebar on the homepage?', 'woothemes' ),
                        'id' => $shortname.'_homepage_sidebar',
                        'std' => 'true',
                        'type' => 'checkbox' );

/* WooCommerce */

if (class_exists('woocommerce')) {
    $options[] = array( 'name' => __( 'WooCommerce', 'woothemes' ),
                        'type' => 'heading',
                        'icon' => 'woocommerce' );

    $options[] = array( 'name' => __( 'Products', 'woothemes' ),
                        'type' => 'subheading' );

     $options[] = array( 'name' => __( 'Products per page', 'woothemes' ),
                        'desc' => __( 'How many products do you want to display on product archive pages?', 'woothemes' ),
                        'id' => $shortname.'commerce_products_per_page',
                        'std' => '12',
                        'type' => 'text' );

     $options[] = array( 'name' => __( 'Products per column', 'woothemes' ),
                        'desc' => __( 'How many products Column do you want to display on product archive pages?', 'woothemes' ),
                        'id' => $shortname.'commerce_products_per_column',
                        'std' => '3',
                        'type' => 'select2',
                        'options' => array(
                            '2' => __('Two Columns', 'woothemes'),
                            '3' => __('Three Columns', 'woothemes'),
                            '4' => __('Four Columns', 'woothemes'),
                            '5' => __('Five Columns', 'woothemes') ) );

       $options[] = array( 'name' => __( 'Display related products', 'woothemes' ),
              'desc' => __( 'Display related products on the product details page', 'woothemes' ),
              'id' => $shortname.'commerce_related_products',
              'std' => 'true',
                        'class' => 'collapsed',
              'type' => 'checkbox' );

   $options[] = array( 'name' => __( 'Layout', 'woothemes' ),
                        'type' => 'subheading' );

   $options[] = array( 'name' => __( 'Shop Banner', 'woothemes' ),
            'desc' => __( 'Upload a banner for your shop theme, or specify an image URL directly.', 'woothemes' ),
            'id' => $shortname . '_headbanner_shop',
            'std' => '',
            'type' => 'upload' );

    $options[] = array( 'name' => __( 'Custom Placeholder', 'woothemes' ),
                        'desc' => __( 'Upload a custom placeholder to be displayed when there is no product image.', 'woothemes' ),
                        'id' => $shortname . '_placeholder_url',
                        'std' => '',
                        'type' => 'upload' );

     $options[] = array( 'name' => __( 'Header Cart Link', 'woothemes' ),
                        'desc' => __( 'Display a link to the cart in the top bar', 'woothemes' ),
                        'id' => $shortname.'commerce_header_cart_link',
                        'std' => 'true',
                        'type' => 'checkbox' );

      $options[] = array( 'name' => __( 'Header User Link', 'woothemes' ),
                        'desc' => __( 'Display a link to the account in the top bar', 'woothemes' ),
                        'id' => $shortname.'commerce_header_user_link',
                        'std' => 'true',
                        'type' => 'checkbox' );

    $options[] = array( 'name' => __( 'Display the sidebar on shop archives?', 'woothemes' ),
                        'desc' => __( 'Global setting to show / hide the sidebar on product archive pages', 'woothemes' ),
                        'id' => $shortname.'commerce_archives_fullwidth',
                        'std' => 'false',
                        'type' => 'checkbox' );

    $options[] = array( 'name' => __( 'Display the sidebar on product pages?', 'woothemes' ),
                        'desc' => __( 'Global setting to show / hide the sidebar on <em>all</em> product pages', 'woothemes' ),
                        'id' => $shortname.'commerce_products_fullwidth',
                        'std' => 'false',
                        'type' => 'checkbox' );

    $options[] = array( 'name' => __( 'Display Popup login?', 'woothemes' ),
                        'desc' => __( 'Setting to show pop up login, my account', 'woothemes' ),
                        'id' => $shortname.'_popup_account',
                        'std' => 'true',
                        'type' => 'checkbox' );
if(is_plugin_active( 'nextend-facebook-connect/nextend-facebook-connect.php' ) ) {
    $options[] = array( 'name' => __( 'Display facebook login/register button?', 'woothemes' ),
                        'desc' => __( 'This setting will appear if you use plugin ( Nextend Facebook Connect )', 'woothemes' ),
                        'id' => $shortname.'_facebook_button',
                        'std' => 'true',
                        'type' => 'checkbox' );
}

}




/* Subscribe & Connect */

$options[] = array( 'name' => __( 'Subscribe & Connect', 'woothemes' ),
    				'type' => 'heading',
    				'icon' => 'connect' );

$options[] = array( 'name' => __( 'Setup', 'woothemes' ),
    				'type' => 'subheading' );

$options[] = array( 'name' => __( 'Enable Subscribe & Connect - Single Post', 'woothemes' ),
    				'desc' => sprintf( __( 'Enable the subscribe & connect area on single posts. You can also add this as a %1$s in your sidebar.', 'woothemes' ), '<a href="' . esc_url( home_url() ) . '/wp-admin/widgets.php">widget</a>' ),
    				'id' => $shortname . '_connect',
    				'std' => 'false',
    				'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Subscribe Title', 'woothemes' ),
    				'desc' => __( 'Enter the title to show in your subscribe & connect area.', 'woothemes' ),
    				'id' => $shortname . '_connect_title',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'Text', 'woothemes' ),
    				'desc' => __( 'Change the default text in this area.', 'woothemes' ),
    				'id' => $shortname . '_connect_content',
    				'std' => '',
    				'type' => 'textarea' );

$options[] = array( 'name' => __( 'Enable Related Posts', 'woothemes' ),
    				'desc' => __( 'Enable related posts in the subscribe area. Uses posts with the same <strong>tags</strong> to find related posts. Note: Will not show in the Subscribe widget.', 'woothemes' ),
    				'id' => $shortname . '_connect_related',
    				'std' => 'true',
    				'type' => 'checkbox' );

$options[] = array( 'name' => __( 'Subscribe Settings', 'woothemes' ),
    				'type' => 'subheading' );

// $options[] = array( 'name' => __( 'Subscribe By E-mail ID (Feedburner)', 'woothemes' ),
//     				'desc' => sprintf( __( 'Enter your %1$s for the e-mail subscription form.', 'woothemes' ), '<a href="http://www.woothemes.com/tutorials/how-to-find-your-feedburner-id-for-email-subscription/">'.__( 'Feedburner ID', 'woothemes' ).'</a>' ),
//     				'id' => $shortname . '_connect_newsletter_id',
//     				'std' => '',
//     				'type' => 'text' );

$options[] = array( 'name' => __( 'Subscribe By E-mail to MailChimp', 'woothemes' ),
    				'desc' => sprintf( __( 'If you have a MailChimp account you can enter the %1$s to allow your users to subscribe to a MailChimp List.', 'woothemes' ), '<a href="http://woochimp.heroku.com" target="_blank">'.__( 'MailChimp List Subscribe URL', 'woothemes' ).'</a>' ),
    				'id' => $shortname . '_connect_mailchimp_list_url',
    				'std' => '',
    				'type' => 'text' );

$options[] = array( 'name' => __( 'RSS URL', 'woothemes' ),
                    'desc' => __( 'Enter your preferred RSS URL. (Feedburner or other)', 'woothemes' ),
                    'id' => $shortname . '_feed_url',
                    'std' => '',
                    'type' => 'text' );


/* Dynamic Images */
// $options[] = array( "name" => __( 'Dynamic Images', 'woothemes' ),
//                     "icon" => "image",
//                     "type" => "heading");

// $options[] = array( 'name' => __( 'Resizer Settings', 'woothemes' ),
//                     'type' => 'subheading' );

// $options[] = array( "name" => __( 'Dynamic Image Resizing', 'woothemes' ),
//                     "desc" => "",
//                     "id" => $shortname."_wpthumb_notice",
//                     "std" => __( 'There are two alternative methods of dynamically resizing the thumbnails in the theme, <strong>WP Post Thumbnail</strong> (default) or <strong>TimThumb</strong>.', 'woothemes' ),
//                     "type" => "info");

// $options[] = array( "name" => __( 'WP Post Thumbnail', 'woothemes' ),
//                     "desc" => __( 'Use WordPress post thumbnail to assign a post thumbnail. Will enable the <strong>Featured Image panel</strong> in your post sidebar where you can assign a post thumbnail.', 'woothemes' ),
//                     "id" => $shortname."_post_image_support",
//                     "std" => "true",
//                     "class" => "collapsed",
//                     "type" => "checkbox" );

// $options[] = array( "name" => __( 'WP Post Thumbnail - Dynamic Image Resizing', 'woothemes' ),
//                     "desc" => __( 'The post thumbnail will be dynamically resized using native WP resize functionality. <em>(Requires PHP 5.2+)</em>', 'woothemes' ),
//                     "id" => $shortname."_pis_resize",
//                     "std" => "true",
//                     "class" => "hidden",
//                     "type" => "checkbox" );

// $options[] = array( "name" => __( 'WP Post Thumbnail - Hard Crop', 'woothemes' ),
//                     "desc" => __( 'The post thumbnail will be cropped to match the target aspect ratio (only used if <em>Dynamic Image Resizing</em> is enabled).', 'woothemes' ),
//                     "id" => $shortname."_pis_hard_crop",
//                     "std" => "true",
//                     "class" => "hidden last",
//                     "type" => "checkbox" );

// $options[] = array( "name" => __( 'TimThumb', 'woothemes' ),
//                     "desc" => __( 'This will enable the <a href="http://code.google.com/p/timthumb/">TimThumb</a> (thumb.php) script which dynamically resizes images added through the <strong>custom settings panel</strong>  below the post editor. Make sure your themes <em>cache</em> folder is writable. <a href="http://www.woothemes.com/2008/10/troubleshooting-image-resizer-thumbphp/">Need help?</a>', 'woothemes' ),
//                     "id" => $shortname."_resize",
//                     "std" => "false",
//                     "type" => "checkbox" );

// $options[] = array( "name" => __( 'Automatic Image Thumbnail', 'woothemes' ),
//                     "desc" => __( 'If no thumbnail is specified then the first uploaded image in the post is used.', 'woothemes' ),
//                     "id" => $shortname."_auto_img",
//                     "std" => "false",
//                     "type" => "checkbox" );

// $options[] = array( 'name' => __( 'Thumbnail Settings', 'woothemes' ),
//                     'type' => 'subheading' );

// $options[] = array( "name" => __( 'Thumbnail Dimensions', 'woothemes' ),
//                     "desc" => __( 'Enter an integer value i.e. 250 for the desired size which will be used when dynamically creating the images.', 'woothemes' ),
//                     "id" => $shortname."_image_dimensions",
//                     "std" => "",
//                     "type" => array(
//                                     array(  'id' => $shortname. '_thumb_w',
//                                             'type' => 'text',
//                                             'std' => 610,
//                                             'meta' => __( 'Width', 'woothemes' ) ),
//                                     array(  'id' => $shortname. '_thumb_h',
//                                             'type' => 'text',
//                                             'std' => 300,
//                                             'meta' => __( 'Height', 'woothemes' ) )
//                                   ));

// $options[] = array( "name" => __( 'Thumbnail Alignment', 'woothemes' ),
//                     "desc" => __( 'Select how to align your thumbnails with posts.', 'woothemes' ),
//                     "id" => $shortname."_thumb_align",
//                     "std" => "alignleft",
//                     "type" => "radio",
//                     "options" => array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"));

// $options[] = array( "name" => __( 'Single Post - Show Thumbnail', 'woothemes' ),
//                     "desc" => __( 'Show the thumbnail in the single post page.', 'woothemes' ),
//                     "id" => $shortname."_thumb_single",
//                     "std" => "false",
//                     "type" => "checkbox");

// $options[] = array( "name" => __( 'Single Post - Thumbnail Dimensions', 'woothemes' ),
//                     "desc" => __( 'Enter an integer value i.e. 250 for the image size.', 'woothemes' ),
//                     "id" => $shortname."_image_dimensions",
//                     "std" => "",
//                     "type" => array(
//                                     array(  'id' => $shortname. '_single_w',
//                                             'type' => 'text',
//                                             'std' => 610,
//                                             'meta' => __( 'Width', 'woothemes' ) ),
//                                     array(  'id' => $shortname. '_single_h',
//                                             'type' => 'text',
//                                             'std' => 300,
//                                             'meta' => __( 'Height', 'woothemes' ) )
//                                   ));

// $options[] = array( "name" => __( 'Single Post - Thumbnail Alignment', 'woothemes' ),
//                     "desc" => __( 'Select how to align your thumbnails with single posts.', 'woothemes' ),
//                     "id" => $shortname."_thumb_align_single",
//                     "std" => "alignright",
//                     "type" => "radio",
//                     "options" => array( "alignleft" => "Left","alignright" => "Right","aligncenter" => "Center" ) );


// $options[] = array( "name" => __( 'Add Featured Image to RSS feed', 'woothemes' ),
//                     "desc" => __( 'Add the featured image to your RSS feed', 'woothemes' ),
//                     "id" => $shortname."_rss_thumb",
//                     "std" => "false",
//                     "type" => "checkbox");

// $options[] = array( "name" => __( 'Enable Lightbox', 'woothemes' ),
//                     "desc" => __( 'Enable the PrettyPhoto lighbox script on images within your website\'s content.', 'woothemes' ),
//                     "id" => $shortname."_enable_lightbox",
//                     "std" => "false",
//                     "type" => "checkbox" );

/* Recipe Template page settings */
$options[] = array( 'name' => __( 'Food Recipe', 'woothemes' ),
                    'icon' => 'recipe',
                    'type' => 'heading');

$options[] = array( 'name' => __( 'Recipe Setup', 'woothemes' ),
                'type' => 'subheading' );

// $options[] = array( 'name' => __( 'Number of Recipe Posts', 'woothemes' ),
//                 'desc' => __( 'Select the number of posts to display if the content type is set to "Recipe Posts".', 'woothemes' ),
//                 'id' => $shortname . '_recipe_number_of_posts',
//                 'std' => '5',
//                 'type' => 'select2',
//                 'options' => $woo_numbers );

$options[] = array( "name" => __( 'Enable Related Recipe', 'woothemes' ),
                "desc" => __( 'Enable Related recipe on Single Recipe.', 'woothemes' ),
                "id" => $shortname."_rel_recipe",
                "std" => "false",
                "type" => "checkbox");

$options[] = array( 'name' => __( 'Number of Related Recipe', 'woothemes' ),
                'desc' => __( 'Select the number of posts to display related product on single recipe.', 'woothemes' ),
                'id' => $shortname . '_recipe_number_related',
                'std' => '5',
                'type' => 'select2',
                'options' => $woo_numbers );
// recipe archive setting
$options[] = array( "name" => __( 'Recipe archive style', 'woothemes' ),
                "desc" => __( 'Select style for archive recipe (check for recipe list, uncheck for recipe grid) ', 'woothemes' ),
                "id" => $shortname."_arch_recipe",
                "std" => "false",
                "type" => "checkbox");

$options[] = array( "name" => __( 'Rating Recipe', 'woothemes' ),
                "desc" => __( 'Rating Recipe On / Off ', 'woothemes' ),
                "id" => $shortname."_rating_recipe",
                "std" => "true",
                "type" => "checkbox");

$options[] = array( 'name' => __( 'Slider Recipe', 'woothemes' ),
                'type' => 'subheading' );

$options[] = array( "name" => __( 'Enable Slider', 'woothemes' ),
                "desc" => __( 'Enable the slider on the recipe page template.', 'woothemes' ),
                "id" => $shortname."_slider_recipe",
                "std" => "false",
                "type" => "checkbox");

$options[] = array( "name" => __( 'Enable Thumbnail Slider', 'woothemes' ),
                "desc" => __( 'Enable the thumbnail slider on the recipe page template.', 'woothemes' ),
                "id" => $shortname."_slider_thumbnail_recipe",
                "std" => "false",
                "type" => "checkbox");

$options[] = array( "name" => __( 'Enable Caption Slider', 'woothemes' ),
                "desc" => __( 'Enable the caption slider on the recipe page template.', 'woothemes' ),
                "id" => $shortname."_slider_caption",
                "std" => "false",
                "type" => "checkbox");

 $options[] = array( "name" => __( 'Number Of Posts To Display', 'woothemes' ),
                        "desc" => __( 'Select the number of entries that should appear in the Slider.', 'woothemes' ),
                        "id" => $shortname."_slider_number",
                        "std" => "3",
                        "type" => "select",
                        "options" => $other_entries);

 $options[] = array( 'name' => __( 'Author Page Setup', 'woothemes' ),
                'type' => 'subheading' );

    $options[] = array( "name" => __( 'Number Of Recipe and Post To Display in Author Single Page', 'woothemes' ),
                        "desc" => __( 'Select the number of recipe and post that should appear in the author single page.', 'woothemes' ),
                        "id" => $shortname."_auth_post_recipe_num",
                        "std" => "4",
                        "type" => "select",
                        "options" => $other_entries);

 $options[] = array( "name" => __( 'Display Recipe On Author Page', 'woothemes' ),
                    "desc" => __( 'Select how to display recipe on author page.', 'woothemes' ),
                    "id" => $shortname."_author_display",
                    "std" => "List",
                    "type" => "radio",
                    "options" => array("List" => "list","Grid" => "grid"));

  $options[] = array( "name" => __( 'Number Of Author To Display', 'woothemes' ),
                        "desc" => __( 'Select the number of author that should appear in the template page author.', 'woothemes' ),
                        "id" => $shortname."_auth_number",
                        "std" => "3",
                        "type" => "select",
                        "options" => $other_entries);

    $options[] = array( "name" => __( 'Define Displayed Role', 'woothemes' ),
                    "desc" => __( 'You can only define 1 role. (leave the blank for all role)', 'woothemes' ),
                    "id" => $shortname."_author_display_role",
                    "std" => "",
                    "type" => "text" );
    $options[] = array( "name" => __( 'Insert Recipe Page Link', 'woothemes' ),
                    "desc" => __( 'insert your recipe page link for single author page', 'woothemes' ),
                    "id" => $shortname."_author_recipe_link",
                    "std" => "",
                    "type" => "text" );
      $options[] = array( "name" => __( 'Insert Post Page Link', 'woothemes' ),
                    "desc" => __( 'insert your post page link for single author page', 'woothemes' ),
                    "id" => $shortname."_author_post_link",
                    "std" => "",
                    "type" => "text" );

  $options[] = array( 'name' => __( 'Single Posts Recipe Setup', 'woothemes' ),
                'type' => 'subheading' );

  $options[] = array( "name" => __( 'Enable Social Media Above Footer', 'woothemes' ),
                "desc" => __( 'Enable social media above footer single page recipe.', 'woothemes' ),
                "id" => $shortname."_social_single",
                "std" => "false",
                "type" => "checkbox");
   $options[] = array( "name" => __( 'Enable Share Media Below Content', 'woothemes' ),
                "desc" => __( 'Enable share media below content single page recipe.', 'woothemes' ),
                "id" => $shortname."_share_single",
                "std" => "false",
                "type" => "checkbox");
    $options[] = array( "name" => __( 'Enable About Chef Content', 'woothemes' ),
                "desc" => __( 'Enable About Chef content single page recipe.', 'woothemes' ),
                "id" => $shortname."_about_single",
                "std" => "true",
                "type" => "checkbox");

/* 404 Template page settings */

$options[] = array( 'name' => __( '404 Page', 'woothemes' ),
                    'icon' => 'error404',
                    'type' => 'heading');

$options[] = array( "name" => __( '404 Image Location ( 400 x 250 )', 'woothemes' ),
                                                                "desc" => __( 'Enter the URL to the banner 404 image location ( 400 x 250 ).', 'woothemes' ),
                                                                "id" => $shortname."_content_error_image",
                                                                "std" => "",
                                                                "type" => "upload");

$options[] = array( "name" => __( '404 Text', 'woothemes' ),
                                                                 "desc" => __( 'Enter your text error page here.', 'woothemes' ),
                                                                 "id" => $shortname."_content_error_page",
                                                                 "std" => "",
                                                                 "type" => "textarea");

$options[] = array( "name" => __( 'Enable Search Form', 'woothemes' ),
                                                                 "desc" => __( 'Enable Search Form', 'woothemes' ),
                                                                 "id" => $shortname."_search_error_page",
                                                                 "std" => "true",
                                                                 "type" => "checkbox");


/* Contact Template Settings */

$options[] = array( 'name' => __( 'Contact Page', 'woothemes' ),
                    'icon' => 'maps',
                    'type' => 'heading');

$options[] = array( 'name' => __( 'Contact Information', 'woothemes' ),
                    'type' => 'subheading');

$options[] = array( "name" => __( 'Contact Information Panel', 'woothemes' ),
                    "desc" => __( 'Enable the contact information panel on your contact page template.', 'woothemes' ),
                    "id" => $shortname."_contact_panel",
                    "std" => "false",
                    "class" => 'collapsed',
                    "type" => "checkbox" );

$options[] = array( 'name' => __( 'Location Name', 'woothemes' ),
                    'desc' => __( 'Enter the location name. Example: London Office', 'woothemes' ),
                    'id' => $shortname . '_contact_title',
                    'std' => '',
                    'class' => 'hidden',
                    'type' => 'text' );

$options[] = array( 'name' => __( 'Location Address', 'woothemes' ),
                    'desc' => __( 'Enter your company\'s address', 'woothemes' ),
                    'id' => $shortname . '_contact_address',
                    'std' => '',
                    'class' => 'hidden',
                    'type' => "textarea" );

$options[] = array( 'name' => __( 'Telephone', 'woothemes' ),
                    'desc' => __( 'Enter your telephone number', 'woothemes' ),
                    'id' => $shortname . '_contact_number',
                    'std' => '',
                    'class' => 'hidden',
                    'type' => 'text' );

$options[] = array( 'name' => __( 'Fax', 'woothemes' ),
                    'desc' => __( 'Enter your fax number', 'woothemes' ),
                    'id' => $shortname . '_contact_fax',
                    'std' => '',
                    'class' => 'hidden last',
                    'type' => 'text' );

$options[] = array( "name" => __( 'Contact Form E-Mail', 'woothemes' ),
                    "desc" => __( 'Enter your E-mail address to use on the "Contact Form" page Template.', 'woothemes' ),
                    "id" => $shortname."_contactform_email",
                    "std" => "",
                    "type" => "text" );

$options[] = array( 'name' => __( 'Your Twitter username', 'woothemes' ),
                    'desc' => __( 'Enter your Twitter username. Example: woothemes', 'woothemes' ),
                    'id' => $shortname . '_contact_twitter',
                    'std' => '',
                    'type' => 'text' );

$options[] = array( "name" => __( 'Enable Subscribe and Connect', 'woothemes' ),
                    "desc" => __( 'Enable the subscribe and connect functionality on the contact page template', 'woothemes' ),
                    "id" => $shortname."_contact_subscribe_and_connect",
                    "std" => "false",
                    "type" => "checkbox" );

$options[] = array( 'name' => __( 'Maps', 'woothemes' ),
                    'type' => 'subheading');

$options[] = array( 'name' => __( 'Contact Form Google Maps Coordinates', 'woothemes' ),
                    'desc' => sprintf( __( 'Enter your Google Map coordinates to display a map on the Contact Form page template. You can get these details from %sGoogle Maps%s', 'woothemes' ), '<a href="' . esc_url( 'http://itouchmap.com/latlong.html' ) . '" target="_blank">', '</a>' ),
                    'id' => $shortname . '_contactform_map_coords',
                    'std' => '',
                    'type' => 'text' );

$options[] = array( 'name' => __( 'Disable Mousescroll', 'woothemes' ),
                    'desc' => __( 'Turn off the mouse scroll action for all the Google Maps on the site. This could improve usability on your site.', 'woothemes' ),
                    'id' => $shortname . '_maps_scroll',
                    'std' => '',
                    'type' => 'checkbox');

$options[] = array( 'name' => __( 'Map Height', 'woothemes' ),
                    'desc' => __( 'Height in pixels for the maps displayed on Single.php pages.', 'woothemes' ),
                    'id' => $shortname . '_maps_single_height',
                    'std' => "250",
                    'type' => 'text');

$options[] = array( 'name' => __( 'Default Map Zoom Level', 'woothemes' ),
                    'desc' => __( 'Set this to adjust the default in the post & page edit backend.', 'woothemes' ),
                    'id' => $shortname . '_maps_default_mapzoom',
                    'std' => "9",
                    'type' => 'select2',
                    'options' => $other_entries);

$options[] = array( 'name' => __( 'Default Map Type', 'woothemes' ),
                    'desc' => __( 'Set this to the default rendered in the post backend.', 'woothemes' ),
                    'id' => $shortname . '_maps_default_maptype',
                    'std' => 'G_NORMAL_MAP',
                    'type' => 'select2',
                    'options' => array( 'G_NORMAL_MAP' => __( 'Normal', 'woothemes' ), 'G_SATELLITE_MAP' => __( 'Satellite', 'woothemes' ), 'G_HYBRID_MAP' => __( 'Hybrid', 'woothemes' ), 'G_PHYSICAL_MAP' => __( 'Terrain', 'woothemes' ) ) );

$options[] = array( 'name' => __( 'Map Callout Text', 'woothemes' ),
                    'desc' => __( 'Text or HTML that will be output when you click on the map marker for your location.', 'woothemes' ),
                    'id' => $shortname . '_maps_callout_text',
                    'std' => "",
                    'type' => 'textarea');





// Add extra options through function
if ( function_exists('woo_options_add') )
	$options = woo_options_add($options);

if ( get_option('woo_template') != $options) update_option('woo_template',$options);
if ( get_option('woo_themename') != $themename) update_option('woo_themename',$themename);
if ( get_option('woo_shortname') != $shortname) update_option('woo_shortname',$shortname);
if ( get_option('woo_manual') != $manualurl) update_option('woo_manual',$manualurl);
if ( get_option('woo_doc') != $documentation) update_option('woo_doc',$documentation);
if ( get_option('woo_support') != $support) update_option('woo_support',$support);

// Woo Metabox Options
$woo_metaboxes = array();

if( ( get_post_type() == 'post' || get_post_type() == 'recipe' ) || (!get_post_type()) ){

    // TimThumb is enabled in options
    // if ( get_option( 'woo_resize') == 'true' ) {

    //     $woo_metaboxes[] = array (  'name' => 'image',
    //                                 'label' => __( 'Image', 'woothemes' ),
    //                                 'type' => 'upload',
    //                                 'desc' => __( 'Upload an image or enter an URL.', 'woothemes' ) );

    //     $woo_metaboxes[] = array (  'name' => '_image_alignment',
    //                                 'std' => __( 'Center', 'woothemes' ),
    //                                 'label' => __( 'Image Crop Alignment', 'woothemes' ),
    //                                 'type' => 'select2',
    //                                 'desc' => __( 'Select crop alignment for resized image', 'woothemes' ),
    //                                 'options' => array( 'c' => 'Center',
    //                                                     't' => 'Top',
    //                                                     'b' => 'Bottom',
    //                                                     'l' => 'Left',
    //                                                     'r' => 'Right'));
    //     // TimThumb disabled in the options
    // } else {

    //     $woo_metaboxes[] = array (  'name' => '_timthumb-info',
    //                                 'label' => __( 'Image', 'woothemes' ),
    //                                 'type' => 'info',
    //                                 'desc' => sprintf( __( '%1$s is disabled. Use the %2$s panel in the sidebar instead, or enable TimThumb in the options panel.', 'woothemes' ), '<strong>'.__( 'TimThumb', 'woothemes' ).'</strong>', '<strong>'.__( 'Featured Image', 'woothemes' ).'</strong>' ) ) ;

    // }

    $woo_metaboxes[] = array (  'name'  => 'embed',
                                'std'  => '',
                                'label' => __( 'Embed Code', 'woothemes' ),
                                'type' => 'textarea',
                                'desc' => __( 'Enter the video embed code for your video (YouTube, Vimeo or similar)', 'woothemes' ) );




$url =  get_template_directory_uri() . '/functions/images/';
    $woo_metaboxes[] = array (  "name" => "_layout",
                                "label" => __( 'Layout', 'woothemes' ),
                                "type" => "images",
                                "desc" => __( 'Select a specific layout for this post/page. Overrides default site layout.', 'woothemes' ),
                                "options" => array(
                                                   'one-col' => $url . '1c.png',
                                                    'two-col-left' => $url . '2cl.png',
                                                    'two-col-right' => $url . '2cr.png',
                                                   'three-col-left' => $url . '3cl.png',
                                                   'three-col-middle' => $url . '3cm.png',
                                                   'three-col-right' => $url . '3cr.png'
                                                    ));


}

if ( get_post_type() != 'post' && get_post_type() != 'slide' &&  get_post_type() != 'recipe'  ) {

    $url =  get_template_directory_uri() . '/functions/images/';
    $woo_metaboxes[] = array (  "name" => "_layout",
                                "label" => __( 'Layout', 'woothemes' ),
                                "type" => "images",
                                "desc" => __( 'Select a specific layout for this post/page. Overrides default site layout.', 'woothemes' ),
                                "options" => array(
                                                   'one-col' => $url . '1c.png',
                                                    'two-col-left' => $url . '2cl.png',
                                                    'two-col-right' => $url . '2cr.png',
                                                   'three-col-left' => $url . '3cl.png',
                                                   'three-col-middle' => $url . '3cm.png',
                                                   'three-col-right' => $url . '3cr.png'
                                                    ));

}

if( get_post_type() == 'page' || ! get_post_type() ) {
  $woo_metaboxes[] = array ( "name" => "_revolutionslider",
                                                    "label" => __( "Revolution Slider", "woothemes" ),
                                                    "type" => "select2",
                                                     "desc" => __( 'Select a Slider Homepage from Revolution Slider. ', 'woothemes' ),
                                                    "std" => "",
                                                    "options" => $revslider_options
                                                 );

}

// if( get_post_type() == 'page' || get_post_type() == 'post' || get_post_type() == 'product' || get_post_type() == 'recipe' ) {

//   $woo_metaboxes[] = array ( "name" => "_header_style",
//                                                     "label" => __( "Custom Header Title", "woothemes" ),
//                                                     "type" => "images",
//                                                     "std" => "show",
//                                                     "options" => array(
//                                                                 'show' => 'Enable Header Title',
//                                                                 'hide' => 'Disable Header Title',
//                                                                 'fancy' => 'Fancy Header Title',
//                                                                 'slider' => ''
//                                                                 )
//                                                  );


// }



if ( get_post_type() == 'slide' || ! get_post_type() ) {
        $woo_metaboxes[] = array (
                                    'name' => 'url',
                                    'label' => __( 'Slide URL', 'woothemes' ),
                                    'type' => 'text',
                                    'desc' => sprintf( __( 'Enter an URL to link the slider title to a page e.g. %s (optional)', 'woothemes' ), 'http://yoursite.com/pagename/' )
                                    );

        $woo_metaboxes[] = array (
                                    'name'  => 'embed',
                                    'std'  => '',
                                    'label' => __( 'Embed Code', 'woothemes' ),
                                    'type' => 'textarea',
                                    'desc' => __( 'Enter the video embed code for your video (YouTube, Vimeo or similar)', 'woothemes' )
                                    );
} // End Slide


// Add extra metaboxes through function
if ( function_exists( 'woo_metaboxes_add' ) )
    $woo_metaboxes = woo_metaboxes_add( $woo_metaboxes );

if ( get_option( 'woo_custom_template' ) != $woo_metaboxes ) update_option( 'woo_custom_template', $woo_metaboxes );

} // END woo_options()
} // END function_exists()

// Add options to admin_head
add_action( 'admin_head', 'woo_options' );

//Enable WooSEO on these Post types
$seo_post_types = array( 'post', 'page' );
define( 'SEOPOSTTYPES', serialize( $seo_post_types ) );

//Global options setup
add_action( 'init', 'woo_global_options' );
function woo_global_options(){
	// Populate WooThemes option in array for use in theme
	global $woo_options;
	$woo_options = get_option( 'woo_options' );
}