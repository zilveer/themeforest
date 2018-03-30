<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/admin/functions/functions.options.php
 * @file	 	1.2
 */
?>
<?php

include( get_template_directory() . '/library/admin/google-fonts.php' );

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->term_id] = $of_cat->cat_name;
		}
		$of_categories = array('0'=>'Any category')+$of_categories;

		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name;
		}
		natsort($of_pages);

		$array_sidebars = $GLOBALS['wp_registered_sidebars'];
		$sidebars=array();
		foreach($array_sidebars as $sidebar) {
			$sidebars[$sidebar['id']]=$sidebar['name'];
		}

		$revslider_array = array();
		//Access the list of Revolution Sliders via an Array
		if(class_exists('revSlider')) {
			$revslider = new RevSlider();
			$list_revsliders = $revslider->getArrSliders();
			foreach($list_revsliders as $slider) {
				$revslider_array[$slider->getAlias()]=$slider->getTitle();
			}
		}

		$custom_shop_sidebar_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
			),
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"product_search"	=> "Product Search",
				"product_cat"		=> "Product Categories",
				"price_filter"	 	=> "Price Filter",
				"attribute_filter"	=> "Attributes Filter"
			),
		);

		$footer_section_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
			),
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"menu"	=> "Menu",
				"text"		=> "Custom Content",
				"social"	 	=> "Social Icons"
			),
		);

		$home_section_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"featured-product"	=> "Featured Products",
				"recent-product"		=> "Recent Products",
				"sale-product"	 	=> "On-sale Products",
				//"tab-product"	 	=> "Products tabs",
				"cat-product"	 	=> "Shop categories",
				"welcome-message"	 	=> "Welcome message",
				"blog-post"	 	=> "Blog posts",
				"sidebar"	 	=> "Sidebar",
/* 				"icon-block"	 	=> "Icon blocks", */
			),
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
			),
		);

		$home_product_tabs_blocks = array
		(
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
			),
			"enabled" => array (
				"placebo" 	=> "placebo", //REQUIRED!
				"featured"	=> "Featured Products",
				"recent"	=> "Recent Products",
				"sale"	 	=> "On-sale Products",
			),
		);

		//Background Images Reader
		$bg_images_path = get_template_directory_uri(). '/img/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/img/bg/'; // change this to where you store your bg images
		$bg_images = array();

		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) {
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }
		    }
		}
		$bg_images[] = 	get_template_directory_uri().'/library/admin/assets/images/custom_bg.png';
		$bg_images[] = 	get_template_directory_uri().'/library/admin/assets/images/none_bg.png';

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$numbers = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

  		$zilla_likes_state = plugin_is_active('zilla-likes/zilla-likes.php');
  		$zilla_likes_state = '<span class="'.$zilla_likes_state.'">'.$zilla_likes_state.'</span>';

  		$zilla_share_state = plugin_is_active('zilla-share/zilla-share.php');
  		$zilla_share_state = '<span class="'.$zilla_share_state.'">'.$zilla_share_state.'</span>';


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options, $prefix;
$of_options = array();


	/* -------------------------------------------------------
	   TAB 1 : General Settings
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("General Settings","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Custom Favicon","prostore-theme"),
							"desc" => __("Upload a 16px x 16px Png/Gif image that will represent your website's favicon.","prostore-theme"),
							"id" => $prefix."general_favicon",
							"std" => get_template_directory_uri() . '/favicon.ico',
							"type" => "upload");

		$of_options[] = array( "name" => __("RSS URL","prostore-theme"),
							"desc" => __('Enter your preferred RSS URL (example : Feedburner)',"prostore-theme"),
							"id" => $prefix."rss_url",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => __("Clean the header code","prostore-theme"),
							"desc" => __('Remove unnecessary tags added by wordpress in the header.',"prostore-theme"),
							"id" => $prefix."clean_header",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Google Analytics","prostore-theme"),
							"desc" => __('Paste your google analytics embed code here.',"prostore-theme"),
							"id" => $prefix."google_analytics",
							"std" => "",
							"type" => "textarea");

	/* -------------------------------------------------------
	   TAB 2 : Styling/Colors
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Styling and Colors","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Typography","prostore-theme"),
							"desc" => __("Body","prostore-theme"),
							"id"   => $prefix."typo_body",
							"std"  => array('size'=>'14px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'normal','color'=>'#979797'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Links","prostore-theme"),
							"id"   => $prefix."typo_link",
							"std"  => "#313131",
							"type" => "color");

		$of_options[] = array( "name" => "",
							"desc" => __("Links Hover state","prostore-theme"),
							"id"   => $prefix."typo_link_hover",
							"std"  => '#fc5703',
							"type" => "color");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 1 (H1)","prostore-theme"),
							"id"   => $prefix."typo_h1",
							"std"  => array('size'=>'44px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 2 (H2)","prostore-theme"),
							"id"   => $prefix."typo_h2",
							"std"  => array('size'=>'37px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 3 (H3)","prostore-theme"),
							"id"   => $prefix."typo_h3",
							"std"  => array('size'=>'27px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 4 (H4)","prostore-theme"),
							"id"   => $prefix."typo_h4",
							"std"  => array('size'=>'23px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 5 (H5)","prostore-theme"),
							"id"   => $prefix."typo_h5",
							"std"  => array('size'=>'17px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => __("Heading 6 (H6)","prostore-theme"),
							"id"   => $prefix."typo_h6",
							"std"  => array('size'=>'14px','face'=>'"Helvetica Neue", Helvetica, Arial, sans-serif','style'=>'bold','color'=>'#313131'),
							"type" => "typography");

		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "accent_colors_info",
							"std" => "The <strong>Accent colors</strong> section has moved to the <a href='".admin_url()."customize.php' target='_blank'>WordPress Customizer</a>",
							"type" => "info");

		$of_options[] = array("name"=>"Accent colors",
							"desc" => __("Primary","prostore-theme"),
							"id" => $prefix."accent_primary",
							"std"=>"#00afd8",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Secondary","prostore-theme"),
							"id" => $prefix."accent_secondary",
							"std"=>"#e9e9e9",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Tertiary","prostore-theme"),
							"id" => $prefix."accent_tertiary",
							"std"=>"#33CC9F",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Alert","prostore-theme"),
							"id" => $prefix."accent_alert",
							"std"=>"#fc5703",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Success","prostore-theme"),
							"id" => $prefix."accent_success",
							"std"=>"#8DC63F",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Warning","prostore-theme"),
							"id" => $prefix."accent_warning",
							"std"=>"#F8A534",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array("name"=>"",
							"desc" => __("Info","prostore-theme"),
							"id" => $prefix."accent_info",
							"std"=>"#FFE58F",
							"class"=>"hidden",
							"type" => "color");;

		$of_options[] = array("name"=>"",
							"desc" => __("Inverse","prostore-theme"),
							"id" => $prefix."accent_inverse",
							"std"=>"#313131",
							"class"=>"hidden",
							"type" => "color");

		$of_options[] = array( "name" => __("Custom CSS","prostore-theme"),
							"desc" => __('Add your custom styles here',"prostore-theme"),
							"id" => $prefix."custom_css",
							"std" => "",
							"type" => "textarea");

	/* -------------------------------------------------------
	   TAB 3 : Sections styling
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Sections styling","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "accent_colors_info",
							"std" => "The <strong>Sections styling</strong> section has moved to the <a href='".admin_url()."customize.php' target='_blank'>WordPress Customizer</a>",
							"type" => "info");

		$of_options[] = array( "name" =>  __("Helper bar (Above menu)","prostore-theme"),
							"desc" => "",
							"class" => "hidden",
							"id" => $prefix."bg_helper_bar",
							"std" => get_template_directory_uri() . '/img/top-nav-bg.png',
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"class" => "hidden",
							"id" => $prefix."bg_helper_bar_color",
							"std"=>"#222222",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_helper_bar_repeat",
							"options" => $body_repeat,
							"class"=>"select-bg hidden",
							"std"=>"repeat-x",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_helper_bar_position",
							"options" => $body_pos,
							"class"=>"select-bg hidden",
							"std"=>"top left",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_helper_bar_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"class"=>"select-bg hidden",
							"std"=>"fixed",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Headings and text color","prostore-theme"),
							"id" => $prefix."helper_bar_content_color",
							"std"=>"",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Links color","prostore-theme"),
							"id" => $prefix."helper_bar_content_color_link",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  __("Header","prostore-theme"),
							"desc" => "",
							"class" => "hidden",
							"id" => $prefix."bg_header",
							"std" => get_template_directory_uri() . '/img/top-nav-bg2.png',
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_header_color",
							"std"=>"",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_header_repeat",
							"options" => $body_repeat,
							"std"=>"repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_header_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_header_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Heading and text color","prostore-theme"),
							"id" => $prefix."header_content_color",
							"std"=>"",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Links color","prostore-theme"),
							"id" => $prefix."header_content_color_link",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  __("Body","prostore-theme"),
							"desc" => "",
							"id" => $prefix."bg_body",
							"std" => "",
							"class" => "hidden",
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_body_color",
							"std"=>"#F8F8F8",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_repeat",
							"options" => $body_repeat,
							"std"=>"no-repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  __("Body (Alternative section 1)","prostore-theme"),
							"desc" => __("Example : Section containing reviews and comments","prostore-theme"),
							"id" => $prefix."bg_body_alt_one",
							"std" => "",
							"class" => "hidden",
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_body_alt_one_color",
							"std"=>"#FFFFFF",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_one_repeat",
							"options" => $body_repeat,
							"std"=>"no-repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_one_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_one_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  __("Body (Alternative section 2)","prostore-theme"),
							"desc" => __("Example : Section containing Related posts in Shop or Date/Share/Like in Single posts","prostore-theme"),
							"id" => $prefix."bg_body_alt_two",
							"std" => "",
							"class" => "hidden",
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_body_alt_two_color",
							"std"=>"#313131",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_two_repeat",
							"options" => $body_repeat,
							"std"=>"no-repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_two_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_two_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Heading and text color","prostore-theme"),
							"id" => $prefix."body_alt_two_content_color",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Links color","prostore-theme"),
							"id" => $prefix."body_alt_two_content_color_link",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  __("Body (Alternative section 3)","prostore-theme"),
							"desc" => __("Example : Section containing Meta info in single posts","prostore-theme"),
							"id" => $prefix."bg_body_alt_three",
							"std" => "",
							"class" => "hidden",
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_body_alt_three_color",
							"std"=>"#ECEFF3",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_three_repeat",
							"options" => $body_repeat,
							"std"=>"no-repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_three_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_body_alt_three_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  __("Footer widget rea","prostore-theme"),
							"desc" => "",
							"id" => $prefix."bg_footer",
							"std" => "",
							"class" => "hidden",
							"type" => "media");

		$of_options[] = array("name"=>"",
							"desc" => "",
							"id" => $prefix."bg_footer_color",
							"std"=>"#252525",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_footer_repeat",
							"options" => $body_repeat,
							"std"=>"no-repeat",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_footer_position",
							"options" => $body_pos,
							"std"=>"top left",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array( "name" =>  "",
							"desc" => "",
							"id" => $prefix."bg_footer_attachment",
							"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
							"std"=>"fixed",
							"class" => "hidden",
							"type" => "select");

		$of_options[] = array ("id"=>"", "type" => "clear");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Heading and text color","prostore-theme"),
							"id" => $prefix."footer_content_color",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

		$of_options[] = array( "name" =>  "",
							"desc" => __("Links color","prostore-theme"),
							"id" => $prefix."footer_content_color_link",
							"std"=>"#ffffff",
							"class" => "hidden",
							"type" => "color");

	/* -------------------------------------------------------
	   TAB 4 : Header
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Header","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Add a welcome message/announcement section","prostore-theme"),
							"desc" => __("You can add a message that will appear at the top of the page (it can be closed by the user).","prostore-theme"),
							"id" => $prefix."header_announcement",
							"std" => "0",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Announcement content","prostore-theme"),
							"id" => $prefix."header_announcement_text",
							"std" => __("Howdy ! Hurry up before the sales end !","prostore-theme"),
							"fold" => $prefix."header_announcement",
							"type" => "textarea");

		$of_options[] = array( "name" => "",
							"desc" => __("Background color","prostore-theme"),
							"id" => $prefix."header_announcement_color",
							"std" => "warning",
							"fold" => $prefix."header_announcement",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse'));

		$of_options[] = array( "name" => __("Helper Bar","prostore-theme"),
							"desc" => __("This bar displays a custom text/menu on the left and the cart/account link on the right.","prostore-theme"),
							"id" => $prefix."header_helper_bar",
							"std" => "1",
							"folds" => "1",
							"type" => "checkbox");

			$url =  ADMIN_DIR . 'assets/images/';

		$of_options[] = array( "name" => "",
							"desc" => __("Left section (if menu is enabled, you must set a <b>Menu location</b> for <em>Helper Menu</em> in ","prostore-theme")."<a href='".admin_url()."/nav-menus.php' target='_blank'>".__('WordPress Menus',"prostore-theme")."</a>",
							"id" => $prefix."header_helper_bar_left",
							"std" => "text",
							"options"=>array("text","menu"),
							"fold" => $prefix."header_helper_bar",
							"type" => "select");

		$of_options[] = array( "name" => "",
							"desc" => __("Left section text","prostore-theme"),
							"id" => $prefix."header_helper_bar_left_text",
							"std" => "",
							"fold" => $prefix."header_helper_bar",
							"type" => "textarea");

		$of_options[] = array( "name" => __("Header Layout","prostore-theme"),
							"desc" => __("Light grey is logo, Dark grey is Main menu, Light blue is Custom content area","prostore-theme"),
							"id" => $prefix."header_layout",
							"std" => "onet-twot",
							"type" => "images",
							"options" => array(
								'half-half' => $url . 'layout12-12.png',
								'twot-onet' => $url . 'layout23-13.png',
								'onet-twot' => $url . 'layout13-23.png',
								'vert' => $url . 'layout-v.png',
								'vert-split' => $url . 'layout-v-s.png'));

		$of_options[] = array( "name" => "",
							"desc" => __("Custom content area (can contain HTML tags)","prostore-theme"),
							"id" => $prefix."header_layout_content",
							"std" => "",
							"type" => "textarea");

		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "logo_info",
							"std" => "The <strong>Logo</strong> section has moved to the <a href='".admin_url()."customize.php' target='_blank'>WordPress Customizer</a>",
							"type" => "info");

		$of_options[] = array( "name" => __("Logo","prostore-theme"),
							"desc" => __("If there is no logo image, the title and description of your website will be used.","prostore-theme"),
							"id" => $prefix."header_logo_image",
							"std" => "",
							"class"=>"hidden",
							"type" => "media");

		$of_options[] = array( "name" => "",
							"desc" => __("Logo spacing<br/>You can set the top and bottom spacing of the logo. The resulting total spacing will be the double of the chosen value (for top and bottom).","prostore-theme"),
							"id" => $prefix."header_logo_spacing",
							"min" => "0",
							"max" => "50",
							"std" => "0",
							"step" => "1",
							"unit" => "px",
							"class"=>"hidden",
							"type" => "range");

		$of_options[] = array( "name" => __("Menu","prostore-theme"),
							"desc" => __("Add a link to home as first item in the menu","prostore-theme"),
							"id" => $prefix."header_menu_home",
							"std" => "1",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display text to Home (default is icon)","prostore-theme"),
							"id" => $prefix."header_menu_home_icon",
							"std" => "0",
							"folds"=>"1",
							"fold" => $prefix."header_menu_home",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Home link text","prostore-theme"),
							"id" => $prefix."header_menu_home_text",
							"std" => "Home",
							"fold" => $prefix."header_menu_home_icon",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Display search icon at the end of the menu","prostore-theme"),
							"id" => $prefix."header_menu_search",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display text to Search (default is icon)","prostore-theme"),
							"id" => $prefix."header_menu_search_icon",
							"std" => "0",
							"folds"=>"1",
							"fold" => $prefix."header_menu_search",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Search link text","prostore-theme"),
							"id" => $prefix."header_menu_search_text",
							"std" => "Search",
							"fold" => $prefix."header_menu_search_icon",
							"type" => "text");

	/* -------------------------------------------------------
	   TAB 5 : Footer
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Footer","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Row 1 : Widget area","prostore-theme"),
							"desc" => __("Display a sidebar in footer (<b>Footer Sidebar</b>)","prostore-theme"),
							"id" => $prefix."footer_sidebar",
							"std" => "0",
							"folds"=>"1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Number of columns in widget area","prostore-theme"),
							"id" => $prefix."footer_sidebar_layout",
							"std" => "three",
							"type" => "images",
							"fold" => $prefix."footer_sidebar",
							"options" => array(
								'two' => $url . 'layout-footer1.png',
								'three' => $url . 'layout-footer2.png',
								'four' => $url . 'layout-footer3.png'));

		$of_options[] = array( "name" => __("Row 2 : Modulable area","prostore-theme"),
							"desc" => __("Activate a section below the footer sidebar (Social icons, Copyright text, Menu).<br/>If menu is enabled, you must set a <b>Menu location</b> for <em>Footer links</em> in <a href='".admin_url()."/nav-menus.php' target='_blank'>WordPress Menus</a>","prostore-theme"),
							"id" => $prefix."footer_section",
							"std" => "0",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Choose the modules to show in this section","prostore-theme"),
							"id" => $prefix."footer_section_blocks",
							"std" => $footer_section_blocks,
							"fold"=> $prefix."footer_section",
							"type" => "sorter");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom content area (can include HTML code). Example : copyright text or accepted cards images, etc","prostore-theme"),
							"id" => $prefix."footer_section_content",
							"std" => "",
							"fold"=> $prefix."footer_section",
							"type" => "textarea");

		$of_options[] = array( "name" => "",
							"std" => "<b>".__("Menu","prostore-theme")."</b> : ".__("A menu has to be set in the","prostore-theme"). "<a href='".admin_url()."/nav-menus.php' target='_blank'><em>".__("Footer menu location","prostore-theme")."</em></a><br><br><b>".__("Social icons","prostore-theme")."</b> : ".__("The services defined in the required ","prostore-theme")."<a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state.".",
							"id" => $prefix."footer_section_info",
							"fold"=> $prefix."footer_section",
							"type" => "info");

		$of_options[] = array( "name" => "Row 3 : Text area",
							"desc" => __("Activate a text section (for example a copyright text) at the end of the page.","prostore-theme"),
							"id" => $prefix."footer_section_last",
							"std" => "0",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text (example : copyright)","prostore-theme"),
							"id" => $prefix."footer_section_last_text",
							"std" => "",
							"fold"=> $prefix."footer_section_last",
							"type" => "textarea");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text (example : copyright). This section can include HTML tags (example : images)","prostore-theme"),
							"id" => $prefix."footer_section_last_text_align",
							"std" => "center",
							"options" => array("left","center","right"),
							"fold"=> $prefix."footer_section_last",
							"type" => "select");

	/* -------------------------------------------------------
	   TAB 6 : Sidebars
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Sidebars","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Sidebar Manager","prostore-theme"),
							"desc" => "",
							"id" => $prefix."sidebars",
							"std" => "",
							"type" => "sidebar",
							"input"=>"default");

	/* -------------------------------------------------------
	   TAB 7 : Posts/Pages
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Posts and Pages","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Sidebar","prostore-theme"),
							"desc" => __("Archives, Search results, etc.","prostore-theme")."<br/>".__("Fullwidth, Sidebar Right, Sidebar Left.","prostore-theme")."<br/><em>".__("This may not apply on custom templates","prostore-theme")."</em>.",
							"id" => $prefix."default_layout",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'full' => $url . 'layout-full.png',
								'right' => $url . 'layout23-13.png',
								'left' => $url . 'layout23-13-i.png'));

		$of_options[] = array( "name" => "",
							"desc" => __("Posts","prostore-theme")."</br>".__("Fullwidth, Sidebar Right, Sidebar Left","prostore-theme"),
							"id" => $prefix."default_layout_post",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'full' => $url . 'layout-full.png',
								'right' => $url . 'layout23-13.png',
								'left' => $url . 'layout23-13-i.png'));

		$of_options[] = array( "name" => "",
							"desc" => __("Pages","prostore-theme")."</br>".__("Fullwidth, Sidebar Right, Sidebar Left","prostore-theme"),
							"id" => $prefix."default_layout_page",
							"std" => "full",
							"type" => "images",
							"options" => array(
								'full' => $url . 'layout-full.png',
								'right' => $url . 'layout23-13.png',
								'left' => $url . 'layout23-13-i.png'));

		$of_options[] = array( "name" => "",
							"desc" => __("Portfolios","prostore-theme")."</br>".__("Fullwidth, Sidebar Right, Sidebar Left","prostore-theme"),
							"id" => $prefix."default_layout_portfolio",
							"std" => "right",
							"type" => "images",
							"options" => array(
								'full' => $url . 'layout-full.png',
								'right' => $url . 'layout23-13.png',
								'left' => $url . 'layout23-13-i.png'));

		$of_options[] = array( "name" => __("Layout - Blog/Archives/Search results, etc","prostore-theme"),
							"desc" => __("Mini (one per row)","prostore-theme")."<br/> ".__("Masonry or fitRows (one or multiple items per row)","prostore-theme").".<br/><em>".__("This setting will be overridden by the shortcodes in the Blog","prostore-theme")."</em>",
							"id" => $prefix."default_masonry",
							"std" => "mini",
							"type" => "select",
							"options" => array(
								'mini','masonry','fitrows'));

		$of_options[] = array( "name" => "",
							"desc" => __("Items per row (by screen size) for masonry and fitrows","prostore-theme"),
							"id" => $prefix."default_masonry_itemrow",
							"std" => array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6"),
							"type" => "text_responsive");

		$of_options[] = array( "name" => "",
							"desc" => __("Show Excerpt of Full content","prostore-theme"),
							"id" => $prefix."default_content_excerpt",
							"options" => array("excerpt","full"),
							"std"=>"excerpt",
							"type" => "select");

		$of_options[] = array( "name" => "",
							"desc" => __("Excerpt size (number of words)","prostore-theme"),
							"id" => $prefix."default_content_size",
							"std" => "20",
							"mod"=>"mini",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Read More text","prostore-theme"),
							"id" => $prefix."default_content_readmore",
							"std" => "Read More",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Pagination style (numbered or basic next/previous links)","prostore-theme"),
							"id" => $prefix."default_content_pagination",
							"options" => array("numbers","basic"),
							"std"=>"numbers",
							"type" => "select");

		$of_options[] = array( "name" => __("Layout - Portfolio","prostore-theme"),
							"desc" => __("Masonry or fitRows (one or multiple items per row)","prostore-theme"),
							"id" => $prefix."default_portf_masonry",
							"std" => "fitrows",
							"type" => "select",
							"options" => array('masonry','fitrows'));

		$of_options[] = array( "name" => "",
							"desc" => __("Items per row (by screen size) for masonry and fitrows","prostore-theme"),
							"id" => $prefix."default_portf_masonry_itemrow",
							"std" => array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6"),
							"type" => "text_responsive");

		$of_options[] = array( "name" => __("Background colors - Post formats Header (in Single post, Blog, Archives/Search results, etc)","prostore-theme"),
							"desc" => __("Standart","prostore-theme"),
							"id" => $prefix."format_standart_bg",
							"std" => "white",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Aside","prostore-theme"),
							"id" => $prefix."format_aside_bg",
							"std" => "white",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Gallery","prostore-theme"),
							"id" => $prefix."format_gallery_bg",
							"std" => "inverse",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Link","prostore-theme"),
							"id" => $prefix."format_link_bg",
							"std" => "alert",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Image","prostore-theme"),
							"id" => $prefix."format_image_bg",
							"std" => "inverse",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Quote","prostore-theme"),
							"id" => $prefix."format_quote_bg",
							"std" => "info",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Status","prostore-theme"),
							"id" => $prefix."format_status_bg",
							"std" => "primary",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Video","prostore-theme"),
							"id" => $prefix."format_video_bg",
							"std" => "inverse",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => "",
							"desc" => __("Audio","prostore-theme"),
							"id" => $prefix."format_audio_bg",
							"std" => "inverse",
							"type" => "select",
							"options"=>array('primary','secondary','tertiary','alert','success','info','warning','inverse','white'));

		$of_options[] = array( "name" => __("Meta Info - Default posts (in Blog, Archives, Search results, etc)","prostore-theme"),
							"desc" => __("Posted date","prostore-theme"),
							"id" => $prefix."meta_date",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Categories","prostore-theme"),
							"id" => $prefix."meta_category",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Tags","prostore-theme"),
							"id" => $prefix."meta_tags",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Post format icon","prostore-theme"),
							"id" => $prefix."meta_format",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Comments","prostore-theme"),
							"id" => $prefix."meta_comments",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Likes - Requires the ","prostore-theme")."<a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state."",
							"id" => $prefix."meta_likes",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Meta Info - Default posts (in single posts)","prostore-theme"),
							"desc" => __("Posted date","prostore-theme"),
							"id" => $prefix."meta_date_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Categories","prostore-theme"),
							"id" => $prefix."meta_category_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Tags","prostore-theme"),
							"id" => $prefix."meta_tags_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Post format icon","prostore-theme"),
							"id" => $prefix."meta_format_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Likes - Requires the <a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state."",
							"id" => $prefix."meta_likes_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Share - Requires the <a href='http://www.themezilla.com/plugins/zillashare/' target='_blank'><b>Zilla Share</b></a> plugin ".$zilla_share_state."",
							"id" => $prefix."meta_share_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Meta Info - Portfolio posts (in Portfolio, Archives/Search results, etc)","prostore-theme"),
							"desc" => __("Posted date","prostore-theme"),
							"id" => $prefix."meta_portf_date",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Fields","prostore-theme"),
							"id" => $prefix."meta_portf_field",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Likes - Requires the <a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state."",
							"id" => $prefix."meta_portf_likes",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "Meta Info - Portfolio posts (in Single portfolios)",
							"desc" => __("Posted date","prostore-theme"),
							"id" => $prefix."meta_portf_date_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Fields","prostore-theme"),
							"id" => $prefix."meta_portf_field_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Likes - Requires the <a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state."",
							"id" => $prefix."meta_portf_likes_s",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Share - Requires the <a href='http://www.themezilla.com/plugins/zillashare/' target='_blank'><b>Zilla Share</b></a> plugin ".$zilla_share_state."",
							"id" => $prefix."meta_portf_share_s",
							"std" => "1",
							"type" => "checkbox");

	/* -------------------------------------------------------
	   TAB 8 : Homepage
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Homepage","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Display main slider","prostore-theme"),
							"desc" => __("Check this to display the main slider on homepage","prostore-theme"),
							"id" => $prefix."home_slider",
							"std" => "0",
							"folds"=>"1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Choose the slider type.<br><br>The <b>FlexSlider</b> will be managed from the <em>FlexSlider</em> tab in this admin panel while the <b>Revolution Slider</b> will be managed from the <em>Revolution Slider</em> page.","prostore-theme"),
							"id" => $prefix."home_slider_mod",
							"fold"=> $prefix."home_slider",
							"options" => array("FlexSlider","Revolution Slider"),
							"std" => "FlexSlider",
							"type" => "select");

		$of_options[] = array( "name" => "",
							"desc" => "Choose your Revolution Slider",
							"id" => $prefix."home_slider_rev_id",
							"std" => "",
							"optgroup"=>"Choose your slider",
							"type" => "select",
							"specific"=>"tax",
							"options" => $revslider_array);

		$of_options[] = array( "name" => __("Modules","prostore-theme"),
							"desc" => __("Choose the modules to show in the homepage.<br/><br/>The <b>Custom page</b> will always appear below all other modules","prostore-theme"),
							"id" => $prefix."home_modules_blocks",
							"std" => $home_section_blocks,
							"type" => "sorter");

		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "accent_colors_info",
							"std" => "If you want to insert the content of a <strong>Custom page</strong> under the selected modules above, choose the desired custom page in the <a href='".admin_url()."customize.php' target='_blank'>WordPress Customizer</a> under the <strong>Static front page</strong> tab.<br/><br/>
							<u><strong>How it works ?</strong></u><br/><br/>
							- If you don't want to show the content of a custom page, choose the option <strong>Front page displays > <em>Your latest posts</em></strong><br/>
							- If you want to insert the content of a custom page, choose the option <strong>A static page > Front page > <em>Choose the desired page from the dropdown</em></strong>",
							"type" => "info");

	/* -------------------------------------------------------
	   TAB 8.1 : Homepage - FlexSlider
	   -------------------------------------------------------*/

		$of_options[] = array( "name" => __('FlexSlider',"prostore-theme"),
							"class" => "indent",
							"type" => "heading");

			$of_options[] = array( "name" => __("General options","prostore-theme"),
								"desc" => __("Slider layout","prostore-theme"),
								"id" => $prefix."home_slider_type",
								"std" => "fullwidth",
								//"fold"=>$prefix."home_slider",
								"type" => "select",
								"options"=>array("boxed","fullwidth"));

			$of_options[] = array( "name" => "",
								"desc" => __("Minimum height","prostore-theme"),
								"id" => $prefix."home_slider_minheight",
								"min" => "100",
								"max" => "5000",
								"std" => "250",
								"step" => "25",
								"unit" => "px",
								"type" => "range");

			$of_options[] = array( "name" => "",
								"desc" => __("Box-shadow inside top","prostore-theme"),
								"id" => $prefix."home_slider_boxshadow",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Slider background","prostore-theme"),
								"desc" => "",
								"id" => $prefix."home_slider_bg",
								"std"=>"",
								"type" => "tiles",
								"options" => $bg_images);

			$of_options[] = array( "name" =>  "",
								"desc" => __("Custom background","prostore-theme"),
								"id" => $prefix."bg_home_slider_custom",
								"std" => "",
								"class" => "hidden",
								"type" => "media");

			$of_options[] = array("name"=>"",
								"desc" => "",
								"id" => $prefix."bg_home_slider_custom_color",
								"std"=>"",
								"class" => "hidden",
								"type" => "color");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => $prefix."bg_home_slider_custom_repeat",
								"options" => $body_repeat,
								"std"=>"no-repeat",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => $prefix."bg_home_slider_custom_position",
								"options" => $body_pos,
								"std"=>"top left",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array( "name" =>  "",
								"desc" => "",
								"id" => $prefix."bg_home_slider_custom_attachment",
								"options" => array('scroll' => 'Scroll Normally', 'fixed' => 'Fixed in Place'),
								"std"=>"fixed",
								"class" => "hidden",
								"type" => "select");

			$of_options[] = array ("id"=>"", "type" => "clear");

			$of_options[] = array( "name" => __("Slider settings","prostore-theme"),
								"desc" => __("Animation style","prostore-theme"),
								"id" => $prefix."home_slider_settings_1",
								"std" => "fade",
								"type" => "select",
								"options"=>array("fade","slide"));

			$of_options[] = array( "name" => "",
								"desc" => __("Easing","prostore-theme"),
								"id" => $prefix."home_slider_settings_2",
								"std" => "swing",
								"type" => "select",
								"options"=>array('swing','easeInQuad','easeOutQuad','easeInOutQuad','easeInCubic','easeOutCubic','easeInOutCubic','easeInQuart','easeOutQuart','easeInOutQuart','easeInSine','easeOutSine','easeInOutSine','easeInExpo','easeOutExpo','easeInOutExpo','easeInQuint','easeOutQuint','easeInOutQuint','easeInCirc','easeOutCirc','easeInOutCirc','easeInElastic','easeOutElastic','easeInOutElastic','easeInBack','easeOutBack','easeInOutBack','easeInBounce','easeOutBounce','easeInOutBounce'),
								"std"=>"easeInOutExpo");

			$of_options[] = array( "name" => "",
								"desc" => __("Animation direction","prostore-theme"),
								"id" => $prefix."home_slider_settings_3",
								"std" => "horizontal",
								"type" => "select",
								"options"=>array("horizontal","vertical"));

			$of_options[] = array( "name" => "",
								"desc" => __("Animation loop","prostore-theme"),
								"id" => $prefix."home_slider_settings_18",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Smooth Height (Allow height of the slider to animate smoothly in horizontal mode)","prostore-theme"),
								"id" => $prefix."home_slider_settings_4",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Slide the slider should start on","prostore-theme"),
								"id" => $prefix."home_slider_settings_5",
								"std" => "0",
								"mod" => "mini",
								"type" => "text");

			$of_options[] = array( "name" => "",
								"desc" => __("Autoplay","prostore-theme"),
								"id" => $prefix."home_slider_settings_6",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Autoplay speed (duration on each slide before transition)","prostore-theme"),
								"id" => $prefix."home_slider_settings_7",
								"min" => "1000",
								"max" => "20000",
								"std" => "7000",
								"step" => "250",
								"unit" => "ms",
								"type" => "range");

			$of_options[] = array( "name" => "",
								"desc" => __("Transition speed (duration of the transition animation)","prostore-theme"),
								"id" => $prefix."home_slider_settings_8",
								"min" => "100",
								"max" => "5000",
								"std" => "600",
								"step" => "100",
								"unit" => "ms",
								"type" => "range");

			$of_options[] = array( "name" => "",
								"desc" => __("Delay before starting slider","prostore-theme"),
								"id" => $prefix."home_slider_settings_9",
								"std" => "0",
								"mod" => "mini",
								"type" => "text");

			$of_options[] = array( "name" => "",
								"desc" => __("Random slides","prostore-theme"),
								"id" => $prefix."home_slider_settings_10",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Pause slide on hover (will prevent moving to another slide when user's mouse is on the slider)","prostore-theme"),
								"id" => $prefix."home_slider_settings_11",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable arrow navigation","prostore-theme"),
								"id" => $prefix."home_slider_settings_12",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable bullets pagination","prostore-theme"),
								"id" => $prefix."home_slider_settings_13",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable pause/play","prostore-theme"),
								"id" => $prefix."home_slider_settings_14",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable touch navigation","prostore-theme"),
								"id" => $prefix."home_slider_settings_15",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable mousewheel navigation","prostore-theme"),
								"id" => $prefix."home_slider_settings_16",
								"std" => "0",
								"type" => "checkbox");

			$of_options[] = array( "name" => "",
								"desc" => __("Enable keyboard navigation","prostore-theme"),
								"id" => $prefix."home_slider_settings_17",
								"std" => "1",
								"type" => "checkbox");

			$of_options[] = array( "name" => __("Slides Manager","prostore-theme"),
								"id" => "subhead1",
								"std" => "",
								"type" => "subheading");

			$of_options[] = array( "name" => "",
								"desc" => "",
								"id" => $prefix."home_slider_slides",
								"std" => "",
								//"fold"=>$prefix."home_slider",
								"type" => "slider",
								"input"=>"default");

	/* -------------------------------------------------------
	   TAB 8.2 : Homepage - Modules
	   -------------------------------------------------------*/

		$of_options[] = array( "name" => __('Modules',"prostore-theme"),
							"class" => "indent",
							"type" => "heading");

		$of_options[] = array( "name" => __("Featured products","prostore-theme"),
							"desc" => __("Choose the number of products to show","prostore-theme"),
							"id" => $prefix."home_modules_featured-product_count",
							"std" => "6",
							"mod" => "mini",
							"type" => "select",
							"options" => $numbers);

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Section title (Leave empty if you do not wish to display)","prostore-theme"),
							"id" => $prefix."home_modules_featured-product_title",
							"std" => "Featured Products",
							"type" => "text");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Display in a carousel","prostore-theme"),
							"id" => $prefix."home_modules_featured-product_carousel",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Recent products","prostore-theme"),
							"desc" => __("Choose the number of products to show","prostore-theme"),
							"id" => $prefix."home_modules_recent-product_count",
							"std" => "6",
							"mod" => "mini",
							"type" => "select",
							"options" => $numbers);

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Section title (Leave empty if you do not wish to display)","prostore-theme"),
							"id" => $prefix."home_modules_recent-product_title",
							"std" => "Recent Products",
							"type" => "text");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Display in a carousel","prostore-theme"),
							"id" => $prefix."home_modules_recent-product_carousel",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("On-sale products","prostore-theme"),
							"desc" => __("Choose the number of products to show","prostore-theme"),
							"id" => $prefix."home_modules_sale-product_count",
							"std" => "6",
							"mod" => "mini",
							"type" => "select",
							"options" => $numbers);

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Section title (Leave empty if you do not wish to display)","prostore-theme"),
							"id" => $prefix."home_modules_sale-product_title",
							"std" => "On-sale Products",
							"type" => "text");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Display in a carousel","prostore-theme"),
							"id" => $prefix."home_modules_sale-product_carousel",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Shop categories","prostore-theme"),
							"desc" => __("Display in a carousel","prostore-theme"),
							"id" => $prefix."home_modules_cat-product_carousel",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Section title (Leave empty if you do not wish to display)","prostore-theme"),
							"id" => $prefix."home_modules_cat-product_title",
							"std" => "Product categories",
							"type" => "text");

		$of_options[] = array( "name" => __("Welcome message","prostore-theme"),
							"desc" => __("Title","prostore-theme"),
							"id" => $prefix."home_modules_welcome-message_title",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Subtitle (may contain HTML tags)","prostore-theme"),
							"id" => $prefix."home_modules_welcome-message_caption",
							"std" => "",
							"type" => "textarea");

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Boxed (in a white background)","prostore-theme"),
							"id" => $prefix."home_modules_welcome-message_boxed",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Text alignment","prostore-theme"),
							"id" => $prefix."home_modules_welcome-message_align",
							"std" => "center",
							"type" => "select",
							"options"=>array('left','center','right'));

		$of_options[] = array( "name" => __("Blog posts","prostore-theme"),
							"desc" => __("Choose the number of posts to show","prostore-theme"),
							"id" => $prefix."home_modules_blog-post_count",
							"std" => "6",
							"mod" => "mini",
							"type" => "select",
							"options" => $numbers);

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Show featured (sticky) posts only","prostore-theme"),
							"id" => $prefix."home_modules_blog-post_sticky",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "A list of all the categories being used on the site.",
							"id" => $prefix."home_modules_blog-post_category",
							"std" => "Any category",
							"type" => "select",
							"specific"=>"tax",
							"options" => $of_categories);

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Layout","prostore-theme"),
							"id" => $prefix."home_modules_blog-post_layout",
							"options" => array("mini","fitrows","masonry"),
							"std" => "mini",
							"type" => "select");

		$of_options[] = array( "name" => "Sidebar",
							"desc" => __("Layout","prostore-theme"),
							"id" => $prefix."home_modules_sidebar_count",
							"std" => "three",
							"type" => "images",
							"options" => array(
								'two' => $url . 'layout-footer1.png',
								'three' => $url . 'layout-footer2.png',
								'four' => $url . 'layout-footer3.png'));

		$of_options[] = array( "name" => "",
							"desc" => __("Widget area 1","prostore-theme"),
							"id" => $prefix."home_modules_sidebar_one",
							"std" => "sidebar2",
							"type" => "select",
							"specific" => "tax",
							"options" => $sidebars);

		$of_options[] = array( "name" => "",
							"desc" => __("Widget area 2","prostore-theme"),
							"id" => $prefix."home_modules_sidebar_two",
							"std" => "",
							"type" => "select",
							"specific" => "tax",
							"options" => $sidebars);

		$of_options[] = array( "name" => "",
							"desc" => __("Widget area 3 (if applicable)","prostore-theme"),
							"id" => $prefix."home_modules_sidebar_three",
							"std" => "",
							"type" => "select",
							"specific" => "tax",
							"options" => $sidebars);

		$of_options[] = array( "name" => "",
							"desc" => __("Widget area 4 (if applicable)","prostore-theme"),
							"id" => $prefix."home_modules_sidebar_four",
							"std" => "",
							"type" => "select",
							"specific" => "tax",
							"options" => $sidebars);

/*
		$of_options[] = array( "name" => __("Custom page","prostore-theme"),
							"desc" => __("Insert the content of a custom page.","prostore-theme")."<br/>The <b>Default</b> ".__("option is setting a page in","prostore-theme")." <a href='".admin_url()."/options-reading.php'>WordPress Settings > Reading</a>",
							"id" => $prefix."home_modules_custom-page",
							"std" => "Shop",
							"options"=>array("Default", "Shop","Custom page"),
							"type" => "select");

		$of_options[] = array( "name" => "",
							"desc" => __("Select a page content to insert","prostore-theme"),
							"id" => $prefix."home_module_custom-page_custom",
							"std" => "",
							"type" => "select",
							"specific"=>"tax",
							"optgroup"=>__("Select a page :","prostore-theme"),
							"options" => $of_pages);
*/

	/* -------------------------------------------------------
	   TAB 9 : Contact
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Contact","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Contact details (Leave empty each field you do not want to show)","prostore-theme"),
							"desc" => __("Phone number","prostore-theme"),
							"id" => $prefix."contact_info_phone",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Email address<br><em>Replace the <b>@</b> by <b>[at]</b> to avoid spam robots.</em>","prostore-theme"),
							"id" => $prefix."contact_info_email",
							"std" => "",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Adress","prostore-theme"),
							"id" => $prefix."contact_info_adress",
							"std" => "",
							"type" => "textarea");

		$of_options[] = array( "name" => __("Google Maps","prostore-theme"),
							"id" => "subhead1",
							"std" => "",
							"type" => "subheading");

		$imagepath_pin =  get_template_directory_uri() . '/img/map_pins/';
		$of_options[] = array( "name" => __("Pin Style","prostore-theme"),
							"desc" => "",
							"id" => $prefix."map_pin",
							"std" => "red",
							"type" => "images",
							"options" => array(
											'blue'=>$imagepath_pin.'pin_blue.png',
											'green'=>$imagepath_pin.'pin_green.png',
											'red'=>$imagepath_pin.'pin_red.png',
											'yellow'=>$imagepath_pin.'pin_yellow.png'
											));

		$of_options[] = array( "name" => __("Zoom Level","prostore-theme"),
							"desc" => __("You can set the zoom level of the map.","prostore-theme"),
							"id" => $prefix."contact_gmap_zoom",
							"min" => "1",
							"max" => "50",
							"std" => "4",
							"step" => "1",
							"unit" => "",
							"type" => "range");

		$of_options[] = array( "name" => "",
							"desc" => "",
							"id" => "contact_panel_info",
							"std" => "You may use this <a href='http://itouchmap.com/latlong.html' target='_blank'>tool</a> to get the longitude/latitude for any address.<br/><br/>Even if you have entered the map center coordinates, you still need to enter at least one location.",
							"type" => "info");

		$of_options[] = array( "name" => __("Map Center","prostore-theme"),
							"desc" => __("Latitude","prostore-theme"),
							"id" => $prefix."contact_gmapc_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Longitude","prostore-theme"),
							"id" => $prefix."contact_gmapc_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 1","prostore-theme"),
							"desc" => __("Latitude","prostore-theme"),
							"id" => $prefix."contact_gmap1_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Longitude","prostore-theme"),
							"id" => $prefix."contact_gmap1_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text in the info bubble","prostore-theme"),
							"id" => $prefix."contact_gmap1_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 2","prostore-theme"),
							"desc" => __("Latitude","prostore-theme"),
							"id" => $prefix."contact_gmap2_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Longitude","prostore-theme"),
							"id" => $prefix."contact_gmap2_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text in the info bubble","prostore-theme"),
							"id" => $prefix."contact_gmap2_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 3","prostore-theme"),
							"desc" => __("Latitude","prostore-theme"),
							"id" => $prefix."contact_gmap3_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Longitude","prostore-theme"),
							"id" => $prefix."contact_gmap3_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text in the info bubble","prostore-theme"),
							"id" => $prefix."contact_gmap3_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => __("Location 4","prostore-theme"),
							"desc" => __("Latitude","prostore-theme"),
							"id" => $prefix."contact_gmap4_lat",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Longitude","prostore-theme"),
							"id" => $prefix."contact_gmap4_lon",
							"std" => "0",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Custom text in the info bubble","prostore-theme"),
							"id" => $prefix."contact_gmap4_text",
							"std" => "0",
							"type" => "text");

		$of_options[] = array ("id"=>"", "type" => "clear");

	/* -------------------------------------------------------
	   TAB 10 : WooCommerce
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("WooCommerce","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Page templates","prostore-theme"),
							"desc" => __("Display icons for woocommerce pages (Cart, Checkout, My Account, etc)","prostore-theme"),
							"id" => $prefix."woocommerce_pagetitle_icons",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display user bar in Cart, Account, Pay and Order Tracking pages if user is logged in","prostore-theme"),
							"id" => $prefix."woocommerce_page_bar",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Main layout (Shop page, Product categories, Search Results)","prostore-theme"),
							"desc" => __("Sidebar Left, Sidebar Right, Sidebar Top, Fullwidth","prostore-theme"),
							"id" => $prefix."woocommerce_layout_main",
							"std" => "vertical-left",
							"type" => "images",
							"options" => array(
								'vertical-left' => $url . 'layout13-23.png',
								'vertical-right' => $url . 'layout23-13.png',
								'horizontal' => $url . 'layout-v.png',
								'none' => $url . 'layout-full.png'));

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Style :","prostore-theme")."<br/> ".__("Masonry or fitRows (one or multiple items per row)","prostore-theme"),
							"id" => $prefix."woocommerce_layout_style",
							"std" => "fitrows",
							"type" => "select",
							"options" => array('masonry','fitrows'));

		$of_options[] = array( "name" => __("","prostore-theme"),
							"desc" => __("Hard crop (for fitrows)","prostore-theme"),
							"id" => $prefix."woocommerce_layout_fitrows_crop",
							"std"=>"1",
							"type"=>"checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Items per row (by screen size)","prostore-theme"),
							"id" => $prefix."woocommerce_layout_itemrow",
							"std" => array("one"=>"1","two"=>"2","three"=>"3","four"=>"4","five"=>"5","six"=>"6"),
							"type" => "text_responsive");

		$of_options[] = array( "name" => "",
							"desc" => __("Sidebar choice (Custom sidebar, ","prostore-theme")."<a href='".admin_url()."/widgets.php' target='_blank'>Shop Sidebar</a>)",
							"id" => $prefix."woocommerce_layout_sidebar_choice",
							"std" => "custom",
							"type" => "select",
							"options"=>array("custom","Shop Sidebar"));

		$of_options[] = array( "name" => "",
							"desc" => __("Sidebar title","prostore-theme"),
							"id" => $prefix."woocommerce_layout_sidebar_title",
							"std" => "Filtering",
							"type" => "text");

		$of_options[] = array( "name" => "",
							"desc" => __("Allow sidebar toggle (user can increase the view size this way)","prostore-theme"),
							"id" => $prefix."woocommerce_layout_sidebar_toggle",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Choose the widgets to show in the custom sidebar","prostore-theme"),
							"id" => $prefix."woocommerce_layout_sidebar_blocks",
							"std" => $custom_shop_sidebar_blocks,
							"type" => "sorter");

		$of_options[] = array( "name" => "",
							"desc" => __("Minify by default the widgets","prostore-theme"),
							"id" => $prefix."woocommerce_layout_sidebar_widgets_toggle",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Products layout (Shop page, Product categories, Search Results)","prostore-theme"),
							"desc" => __("Display data (title, description price, info) in overlay","prostore-theme"),
							"id" => $prefix."woocommerce_product_overlay",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display description below product title","prostore-theme"),
							"id" => $prefix."woocommerce_product_desc",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Products layout (Single product)","prostore-theme"),
							"desc" => __("Enable zoom on product image","prostore-theme"),
							"id" => $prefix."woocommerce_product_zoom",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Products Related/Up-sells (Single product)","prostore-theme"),
							"desc" => __("Display section : Products you may like (upsells)","prostore-theme"),
							"id" => $prefix."woocommerce_product_maylike",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display section : Related Products","prostore-theme"),
							"id" => $prefix."woocommerce_product_related",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Display data (title, price, info) in overlay","prostore-theme"),
							"id" => $prefix."woocommerce_product_related_overlay",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Number of related products","prostore-theme"),
							"id" => $prefix."woocommerce_product_related_count",
							"std" => "4",
							"mod" => "mini",
							"options" => array("1","2","3","4","5","6","7","8","9","10"),
							"type" => "select");

		$of_options[] = array( "name" => __("Products Meta Info (Single product)","prostore-theme"),
							"desc" => __("Categories & Tags","prostore-theme"),
							"id" => $prefix."woocommerce_product_meta_cat_tag",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Likes - Requires the <a href='http://www.themezilla.com/plugins/zillalikes/' target='_blank'><b>Zilla Likes</b></a> plugin ".$zilla_likes_state."",
							"id" => $prefix."woocommerce_product_meta_likes",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => __("Share","prostore-theme"),
							"id" => $prefix."woocommerce_product_meta_share",
							"std" => "1",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Sharing Method<br/>ZillaShare requires the <a href='http://www.themezilla.com/plugins/zillashare/' target='_blank'><b>Zilla Share</b></a> plugin ".$zilla_share_state."",
							"id" => $prefix."woocommerce_product_meta_share_method",
							"std" => "Zilla-Share",
							"options"=>array("Native woocommerce share", "Zilla-Share"),
							"fold" => $prefix."woocommerce_product_meta_share",
							"type" => "select");

	/* -------------------------------------------------------
	   TAB 11 : Responsiveness
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Responsiveness","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => "",
							"std" => __("The settings below allow you to control the behaviour of the site for screens smaller than 480px, typically smartphones.","prostore-theme"),
							"id" => $prefix."responsiveness",
							"type" => "info");

		$of_options[] = array( "name" => __("Sidebars","prostore-theme"),
							"desc" => "<b>Posts and Pages</b> : Show Main Sidebar",
							"id" => $prefix."responsive_sidebar",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "<b>Shop</b> : Show sidebar",
							"id" => $prefix."woocommerce_responsive_sidebar",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "<b>Footer</b> : Show Footer Sidebar",
							"id" => $prefix."responsive_sidebar_footer",
							"std" => "0",
							"folds" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Toggle (close) all widgets by default (will apply to any activated sidebar of the above)",
							"id" => $prefix."responsive_widget_toggle",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Posts & Pages : Archives/Search Results/Blog, etc","prostore-theme"),
							"desc" => __("Show Meta","prostore-theme"),
							"id" => $prefix."responsive_meta",
							"std" => "0",
							"type" => "checkbox"); //

		$of_options[] = array( "name" => __("Posts & Pages: Single posts","prostore-theme"),
							"desc" => __("Show Comments","prostore-theme"),
							"id" => $prefix."responsive_meta_single",
							"std" => "0",
							"type" => "checkbox"); //

		$of_options[] = array( "name" => "",
							"desc" => __("Show Meta","prostore-theme"),
							"id" => $prefix."responsive_comments_single",
							"std" => "0",
							"type" => "checkbox"); //

		$of_options[] = array( "name" => __("Shop","prostore-theme"),
							"desc" => __("Use overlay to display product info on shop pages","prostore-theme"),
							"id" => $prefix."woocommerce_responsive_overlay",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Show <b>Products you may like</b>/<b>Related products</b> on single product page",
							"id" => $prefix."woocommerce_responsive_related",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => "",
							"desc" => "Show <b>Categories, Tags</b> on single product page",
							"id" => $prefix."woocommerce_responsive_meta",
							"std" => "0",
							"type" => "checkbox");

	/* -------------------------------------------------------
	   TAB 12 : Speed Optimization
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Speed Optimization","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Speed Optimization","prostore-theme"),
							"desc" => "",
							"id" => "speed_optimization_info",
							"std" => "<h3 style=\"margin: 0 0 10px;\">".__("Speed Optimization","prostore-theme")."</h3>".
									__("In this section, you can disable some additional plugins that aims to offer a better experience to the visitor. Disabling them will increase the page speed and loading time.","prostore-theme")."<br/><br/>".
									__("Please note that this section has priority over the rest if theme options. For instance, if you disable the custom styling here, then all the styling-related options in the other tabs will not be taken in account.","prostore-theme"),
							"icon" => true,
							"type" => "info");

		$of_options[] = array( "name" => __("CUSTOM STYLING","prostore-theme"),
							"desc" => __("All styling options chosen in the admin panel will be disabled and the default stylesheet will be used.","prostore-theme"),
							"id" => $prefix."optimize_styling",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Preloading","prostore-theme"),
							"desc" => __("Disable the preloading state that will fade when content is ready to be displayed","prostore-theme"),
							"id" => $prefix."optimize_preload",
							"std" => "1",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Idle Timer","prostore-theme"),
							"desc" => __("This feature can be seen on the search input. It automatically tells the user <b>Press Enter</b> when he starts typing.","prostore-theme"),
							"id" => $prefix."optimize_idle",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Textarea Autosize","prostore-theme"),
							"desc" => __("This increases the textarea while typing (for example : reviews and comments)","prostore-theme"),
							"id" => $prefix."optimize_autosize",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Gravatar MD5","prostore-theme"),
							"desc" => __("This automatically grabs the user's gravatar when he enters his email in the login form or comment form.","prostore-theme"),
							"id" => $prefix."optimize_md5",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("FitText","prostore-theme"),
							"desc" => __("This allows the text size to fit inside the container. Typically, it is used in the product overlay (can be important when screen size is small).","prostore-theme"),
							"id" => $prefix."optimize_fittext",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Google Maps","prostore-theme"),
							"desc" => __("Disable Google Maps if you are not planning to have a contact page.","prostore-theme"),
							"id" => $prefix."optimize_gmap",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Image Zoom","prostore-theme"),
							"desc" => __("Disable the zoom feature on the images. For exmample inside the products page.","prostore-theme"),
							"id" => $prefix."optimize_zoom",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Foundation - Reveal","prostore-theme"),
							"desc" => __("Disable this script if you are not planning to use modal windows with <b>Foundation Reveal</b>","prostore-theme"),
							"id" => $prefix."optimize_freveal",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Foundation - Tooltip","prostore-theme"),
							"desc" => __("Disable this script if you are not planning to use tooltips with <b>Foundation Tooltips</b>","prostore-theme"),
							"id" => $prefix."optimize_ftooltip",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Foundation - Magellan","prostore-theme"),
							"desc" => __("Disable this script if you are not planning to use the sticky bar with position detection (seen on Archives Timeline and Tag Index) with <b>Foundation Magellan</b>","prostore-theme"),
							"id" => $prefix."optimize_fmagellan",
							"std" => "0",
							"type" => "checkbox");

	/* -------------------------------------------------------
	   TAB 13 : Framework
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Framework","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Disable Theme Updates Notifications","prostore-theme"),
							"desc" => __("Check this option if you do not wish to see notifications about theme updates.","prostore-theme"),
							"id" => $prefix."framework_udpate_notify",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Plugin Reminders","prostore-theme"),
							"desc" => __("Check this option if you do not wish to see notifications about required/recommended plugins.","prostore-theme"),
							"id" => $prefix."framework_plugins_notify",
							"std" => "0",
							"type" => "checkbox");

		$of_options[] = array( "name" => __("Custom log-in screen","prostore-theme"),
							"desc" => __("Activate the custom log-in screen.","prostore-theme"),
							"id" => $prefix."framework_login_screen",
							"std" => "1",
							"type" => "checkbox");

	/* -------------------------------------------------------
	   TAB 14 : Backup and Restore
	   -------------------------------------------------------*/

	$of_options[] = array( "name" => __("Backup-Restore","prostore-theme"),
						"type" => "heading");

		$of_options[] = array( "name" => __("Backup and Restore Options","prostore-theme"),
		                    "id" => "of_backup",
		                    "std" => "",
		                    "type" => "backup",
							"desc" => __("You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.","prostore-theme"),
							);

		$of_options[] = array( "name" => __("Transfer Theme Options Data","prostore-theme"),
		                    "id" => "of_transfer",
		                    "std" => "",
		                    "type" => "transfer",
							"desc" => __("You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click 'Import Options'.","prostore-theme")
							);

	}
}
?>