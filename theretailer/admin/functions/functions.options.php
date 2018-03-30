<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories = array();  
		$of_categories_obj = get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp = array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages = array();
		$of_pages_obj = get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp = array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select = array("one","two","three","four","five"); 
		$of_options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" => "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
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
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads = get_option('of_uploads');
		$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();
$url =  ADMIN_DIR . 'assets/images/';

// General tab

$of_options[] = array( "name" => "General",
					"type" => "heading");
					
$of_options[] = array( "name" => "Main Layout Style",
					"desc" => "Select the layout style for your site. Choose a <strong><em>Full Width</em></strong> or <strong><em>Boxed</em></strong> layout.",
					"id" => "gb_layout",
					"std" => "fullscreen",
					"type" => "images",
					"options" => array(
						'fullscreen' => $url . '1col.png',
						'boxed' => $url . '3cm.png')
					);
					
/*$of_options[] = array( "name" => "Boxed Layout Width",
					"desc" => "The Width of the boxed layout in px.",
					"id" => "boxed_layout_width",
					"std" => "1100",
					"type" => "text");*/
					
$of_options[] = array( 	"name" 		=> "'<em>Boxed</em>' Layout Width",
						"desc" 		=> "Slide to adjust the width of the <strong><em>Boxed</em></strong> layout (if selected above).",
						"id" 		=> "boxed_layout_width",
						"std" 		=> "1100",
						"min" 		=> "980",
						"step"		=> "1",
						"max" 		=> "1600",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);
				
/*$of_options[] = array( 	"name" 		=> "[BETA] Responsive Behaviour",
						"desc" 		=> "Enable / Disable the Responsive Behaviour",
						"id" 		=> "gb_responsive",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);*/
					
$of_options[] = array( "name" => "Favicon",
					"desc" => "Upload your custom Favicon image. <br /><strong>.ico</strong> or <strong>.png</strong> file required.",
					"id" => "favicon_image",
					"std" => "",
					"mod" => "min",
					"type" => "media");
					
/*$of_options[] = array( "name" => "Favicon - Retina",
					"desc" => "The retina version of your Favicon. <strong>144</strong>&times;<strong>144</strong>px <strong>.png</strong> file required.",
					"id" => "favicon_retina",
					"std" => "",
					"mod" => "min",
					"type" => "media");*/
										
/*$of_options[] = array( "name" => "Revolution Slider",
					"desc" => "Check to turn off the Revolution Slider in mobile phones.",
					"id" => "revolution_slider_in_mobile_phones",
					"std" => 0,
					"type" => "checkbox");*/
				
$of_options[] = array( "name" => "Revolution Slider on Mobile Devices",
					"desc" => "To improve the experience, you can choose not to display the Revolution Sliders on mobile devices.",
					"id" => "revolution_slider_in_mobile_phones",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'rev_slider_mobiles_with.png',
						'1' => $url . 'rev_slider_mobiles_without.png')
					);
					
/*$of_options[] = array( "name" => "Comments on Pages",
					"desc" => "Check to display comments form on pages.",
					"id" => "page_comments",
					"std" => 0,
					"type" => "checkbox");*/
					
$of_options[] = array( 	"name" 		=> "Comments on Pages",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> comments on pages.",
						"id" 		=> "page_comments",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Full Post on blog listing",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> Full Post on blog listing. If disable it shows the Excerpt.",
						"id" 		=> "show_full_post",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Featured Image on Single Post",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the Featured Image on Single Post.",
						"id" 		=> "featured_image_single_post",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
/*$of_options[] = array( 	"name" 		=> "Let it snow!",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the snow effect.",
						"id" 		=> "let_it_snow",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"folds"		=> 	1,
						"type" 		=> "switch"
				);*/
				
$of_options[] = array( "name" 		=> "Progress Bar",
						"desc" 		=> "<strong>Show</strong> / <strong>Hide</strong> the Progress Bar on page load.",
						"id" 		=> "progress_bar",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
/*$of_options[] = array(
	"name"		=>	"Number of Snowflakes",
	"desc" 		=>	"Drag the slider to set the number of snowflakes.",
	"id" 		=>	"snow_flakes",
	"std" 		=>	"100",
	"min" 		=>	"10",
	"step"		=>	"1",
	"max" 		=>	"150",
	"fold" 		=> 	"let_it_snow",
	"type" 		=>	"sliderui",
	"edit" 		=>	"0"
);*/




// Header tab			
			
$of_options[] = array( "name" => "Header",
                    "type" => "heading");

$of_options[] = array( "name" => "Top Bar",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Top Bar</h4>",
					"icon" => true,
					"type" => "info");					
				
$of_options[] = array( "name" => "Top Bar",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the <strong><em>Top Bar</em></strong>.",
					"id" => "hide_topbar",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'top_bar_with.png',
						'1' => $url . 'top_bar_without.png')
					);
					
$of_options[] = array( "name" => "'<em>Top Bar</em>' Text",
					"desc" => "Type in your  <strong><em>Top Bar</em></strong> info here.",
					"id" => "topbar_text",
					"std" => "FREE SHIPPING ON ALL ORDERS OVER $75!",
					"type" => "textarea");
					
$of_options[] = array( 	"name" 		=> "Search Input Open at All Times",
						"desc" 		=> "",
						"id" 		=> "search_input_style",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
					
$of_options[] = array( "name" => "'<em>Top Bar</em>' Background Color",
					"desc" => "Define the Top Bar Background Color for your theme. ",
					"id" => "topbar_bg_color",
					"std" => "#000",
					"type" => "color");
					
$of_options[] = array( "name" => "'<em>Top Bar</em>' Text Color",
					"desc" => "Define the Top Bar Text Color.",
					"id" => "topbar_color",
					"std" => "#fff",
					"type" => "color");
					
$of_options[] = array( 	"name" 		=> "'<em>Top Bar</em>' Font Size",
						"desc" 		=> "Drag the slider to set the size of the Top Bar text.",
						"id" 		=> "top_bar_font_size",
						"std" 		=> "10",
						"min" 		=> "8",
						"step"		=> "1",
						"max" 		=> "16",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);

$of_options[] = array( "name" => "Header",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Header</h4>",
					"icon" => true,
					"type" => "info");	
					
$of_options[] = array( "name" => "Header Options",
					"desc" => "Select the <strong><em>Header</em></strong> layout style.",
					"id" => "gb_header_style",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'header_1.png',
						'1' => $url . 'header_2.png',
						'2' => $url . 'header_3.png')
					);

$of_options[] = array( "name" => "<em>Header</em> &#8212; Background Color",
					"desc" => "The background color of the <em>Header</em>.",
					"id" => "header_bg_color",
					"std" => "#f4f4f4",
					"type" => "color");
					
$of_options[] = array( 	"name" 		=> "Sticky Header",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the <strong><em>Sticky</em></strong> Header.",
						"id" 		=> "sticky_header",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);

$of_options[] = array( "name" => "Main Navigation",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Main Navigation</h4>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( "name" => "<em>Main Navigation</em> &#8212; Text Color",
					"desc" => "The text color for the <em>Main Navigation</em>.",
					"id" => "primary_menu_color",
					"std" => "#000",
					"type" => "color");

$of_options[] = array( 	"name" 		=> "'<em>Main Navigation</em>' Font Size",
						"desc" 		=> "Drag the slider to set the Main Navigation font size.",
						"id" 		=> "main_navigation_font_size",
						"std" 		=> "12",
						"min" 		=> "8",
						"step"		=> "1",
						"max" 		=> "16",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);
					
$of_options[] = array( "name" => "Secondary Navigation",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Secondary Navigation</h4>",
					"icon" => true,
					"type" => "info");					

$of_options[] = array( "name" => "<em>Secondary Navigation</em> &#8212; Text Color",
					"desc" => "The text color for the <em>Secondary Navigation</em>.",
					"id" => "secondary_menu_color",
					"std" => "#777",
					"type" => "color");

$of_options[] = array( 	"name" 		=> "'<em>Secondary Navigation</em>' Font Size",
						"desc" 		=> "Drag the slider to set the Secondary Navigation font size.",
						"id" 		=> "secondary_navigation_font_size",
						"std" 		=> "12",
						"min" 		=> "8",
						"step"		=> "1",
						"max" 		=> "16",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);					

$of_options[] = array( "name" => "Header Spacing",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Header Spacing</h4>",
					"icon" => true,
					"type" => "info");

$of_options[] = array( 	"name" 		=> "Spacing Above the Navigation",
						"desc" 		=> "Slide to set the spacing Above the Navigation.",
						"id" 		=> "menu_header_top_padding_1_7",
						"std" 		=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "300",
						"type" 		=> "sliderui",
						"edit" 		=> "1" 
				);
					
/*$of_options[] = array( "name" => "Main Navigation - Bottom Spacing",
					"desc" => "Set the spacing below the main navigation to adjust the size of your header.",
					"id" => "menu_header_bottom_padding",
					"std" => array('size' => '30px'),
					"type" => "typography");*/
					
$of_options[] = array( 	"name" 		=> "Spacing Below the Navigation",
						"desc" 		=> "Slide to set the spacing Below the Navigation.",
						"id" 		=> "menu_header_bottom_padding_1_7",
						"std" 		=> "40",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "300",
						"type" 		=> "sliderui" ,
						"edit" 		=> "1"
				);

$of_options[] = array( "name" => "Mini Shopping Bag",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Mini Shopping Bag</h4>",
					"icon" => true,
					"type" => "info");
				
$of_options[] = array( 	"name" 		=> "The '<em>Mini Shopping Bag</em>'",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the <strong><em>Mini Shopping Bag</em></strong> drop-down in Header.",
						"id" 		=> "shopping_bag_in_header",
						"std" 		=> 1,
						"folds"		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
$of_options[] = array( "name" => "'<em>Mini Shopping Bag</em>' Style",
					"desc" => "Styling options for the <strong><em>Mini Shopping Bag</em></strong> drop-down in Header.",
					"id" => "shopping_bag_style",
					"std" => "style2",
					"type" => "images",
					"fold" 		=> "shopping_bag_in_header",
					"options" => array(
						'style1' => $url . 'bag_1.png',
						'style2' => $url . 'bag_2.png')
					);



// Footer tab					
					
$of_options[] = array( "name" => "Footer",
					"type" => "heading");
					
$of_options[] = array( 	"name" 		=> "Expandable footer on mobiles",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the expandable footer on mobiles.",
						"id" 		=> "expandable_footer_mobiles",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);

$of_options[] = array( "name" => "Light Footer",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Light Footer</h4>",
					"icon" => true,
					"type" => "info");	
					
/*$of_options[] = array( "name" => "Light Footer on All Site",
					"desc" => "Check to hide the Light Footer on All Site.",
					"id" => "light_footer_all_site",
					"std" => 0,
					"type" => "checkbox");*/
				
$of_options[] = array( "name" => "The '<em>Light Footer</em>'",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the <strong><em>Light Footer</em></strong> for all site pages.",
					"id" => "light_footer_all_site",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'light_footer_with.png',
						'1' => $url . 'light_footer_without.png')
					);
				
$of_options[] = array( "name" => "'<em>Light Footer</em>' Layout Options",
					"desc" => "Select the layout for your <strong><em>Light Footer</em></strong>.",
					"id" => "light_footer_layout",
					"std" => "4col",
					"type" => "images",
					"options" => array(
						'4col' => $url . 'light_footer_4_col.png',
						'3col' => $url . 'light_footer_3_col.png')
					);

$of_options[] = array( "name" => "'<em>Light Footer</em>' &#8212; Background Color",
					"desc" => "The background color of the <em>Light Footer</em>.",
					"id" => "primary_footer_bg_color",
					"std" => "#f4f4f4",
					"type" => "color");

$of_options[] = array( "name" => "Dark Footer",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Dark Footer</h4>",
					"icon" => true,
					"type" => "info");	
					
/*$of_options[] = array( "name" => "Dark Footer on All Site",
					"desc" => "Check to hide the Dark Footer on All Site.",
					"id" => "dark_footer_all_site",
					"std" => 0,
					"type" => "checkbox");*/
				
$of_options[] = array( "name" => "The '<em>Dark Footer</em>'",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the <strong><em>Dark Footer</em></strong> for all site pages.",
					"id" => "dark_footer_all_site",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'dark_footer_with.png',
						'1' => $url . 'dark_footer_without.png')
					);
				
$of_options[] = array( "name" => "'<em>Dark Footer</em>' Layout Options",
					"desc" => "Select the layout for your <strong><em>Dark Footer</em></strong>.",
					"id" => "dark_footer_layout",
					"std" => "4col",
					"type" => "images",
					"options" => array(
						'4col' => $url . 'dark_footer_4_col.png',
						'3col' => $url . 'dark_footer_3_col.png')
					);

$of_options[] = array( "name" => "'<em>Dark Footer</em> &#8212; Background Color",
					"desc" => "The background color of the <em>Dark Footer</em>.",
					"id" => "secondary_footer_bg_color",
					"std" => "#000",
					"type" => "color");
					
$of_options[] = array( "name" => "'<em>Dark Footer</em> &#8212; Text Color",
					"desc" => "The text color on the <em>Dark Footer</em>.",
					"id" => "secondary_footer_color",
					"std" => "#fff",
					"type" => "color");

$of_options[] = array( "name" => "'<em>Dark Footer</em> &#8212; Widget Title Border",
					"desc" => "Styles for the separator/line under the widget titles on the <em>Dark Footer</em>.",
					"id" => "secondary_footer_title_border",
					"std" => array('width' => '2','style' => 'solid','color' => '#3d3d3d'),
					"type" => "border");
					
$of_options[] = array( "name" => "'<em>Dark Footer</em> &#8212; List separators and borders",
					"desc" => "The color for list separators and borders on the <em>Dark Footer</em>.",
					"id" => "secondary_footer_borders_color",
					"std" => "#3d3d3d",
					"type" => "color");

$of_options[] = array( "name" => "Bottom / Credit Card Icons / Copyright Text",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Bottom / Credit Card Icons / Copyright Text</h4>",
					"icon" => true,
					"type" => "info");	
					
$of_options[] = array( "name" => "Footer Credit Card Icons",
					"desc" => "Upload your custom icons sprite.",
					"id" => "footer_logos",
					"std" => $url . "payment_cards.png",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => "Footer Copyright Text",
					"desc" => "Enter your copyright information here.",
					"id" => "copyright_text",
					"std" => "&#169; <strong>Get Bowtied</strong> - Elite ThemeForest Author",
					"type" => "textarea");		
					
$of_options[] = array( "name" => "<em>Copyright Bar</em> &#8212;  Background Color",
					"desc" => "The background color of the '<em>Copyright Bar'</em>, the area under the <em>Dark Footer</em>.",
					"id" => "copyright_bar_bg_color",
					"std" => "#000",
					"type" => "color");
					
$of_options[] = array( "name" => "<em>Dark Footer</em> / <em>Copyright Bar</em> &#8212; Separator Styles",
					"desc" => "Styles for the separator/line between the <em>Dark Footer</em> and the <em>Copyright Bar</em>.",
					"id" => "copyright_bar_top_border",
					"std" => array('width' => '2','style' => 'solid','color' => '#3d3d3d'),
					"type" => "border");
					
$of_options[] = array( "name" => "<em>Copyright Bar</em> &#8212;  Text Color",
					"desc" => "The text color on the <em>Copyright Bar</em>.",
					"id" => "copyright_text_color",
					"std" => "#a8a8a8",
					"type" => "color");	




// Shop tab
$of_options[] = array( "name" => "Shop",
                    "type" => "heading");
					
/*$of_options[] = array( "name" => "Catalog Mode",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> <em><strong>the Catalog Mode</em></strong> feature. This option will turn off the shopping functionality of WooCommerce.",
					"id" => "catalog_mode",
					"std" => 0,
					"type" => "checkbox");*/
					
$of_options[] = array( "name" 		=> "Catalog Mode",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the <em><strong>Catalog Mode</em></strong>. When enabled, the feature <em>Turns Off</em> the shopping functionality of WooCommerce.",
						"id" 		=> "catalog_mode",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
					
/*$of_options[] = array( "name" => "Shop With Sidebar",
					"desc" => "Check to enable the left sidebar on shop.",
					"id" => "sidebar_listing",
					"std" => 0,
					"type" => "checkbox");*/
				
$of_options[] = array( "name" => "Shop / Shop w. Sidebar",
					"desc" => "Select the layout style for the Shop catalog pages. The second option will enable the <strong><em>Shop Sidebar</em></strong> for the WooCommerce widgets.",
					"id" => "sidebar_listing",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'shop_layout_no_sidebar.png',
						'1' => $url . 'shop_layout_sidebar.png')
					);
					
/*$of_options[] = array( "name" => "Flipping Products Animation",
					"desc" => "Check to turn off the flipping animation.",
					"id" => "flip_product",
					"std" => 0,
					"type" => "checkbox");*/
					
$of_options[] = array( "name" => "Flipping Products Animation",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the flipping animation.",
					"id" => "flip_product",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'flip_product_enabled.png',
						'1' => $url . 'flip_product_disabled.png')
					);
					
/*$of_options[] = array( "name" => "",
					"desc" => "Check to turn off the flipping animation on mobiles only.",
					"id" => "flip_product_mobiles",
					"std" => 0,
					"type" => "checkbox");*/
					
$of_options[] = array( "name" => "Flipping Products Animation on Mobile Devices",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the flipping animation only for mobile devices.",
					"id" => "flip_product_mobiles",
					"std" => "1",
					"type" => "images",
					"options" => array(
						'0' => $url . 'flip_product_mobiles_enabled.png',
						'1' => $url . 'flip_product_mobiles_disabled.png')
					);
					
/*$of_options[] = array( "name" => "Category in Product Listing",
					"desc" => "Check to hide the Category in Product Listing",
					"id" => "category_listing",
					"std" => 0,
					"type" => "checkbox");*/
					
$of_options[] = array( "name" => "Parent Category on Catalog Pages",
					"desc" => "<strong>Enable</strong> / <strong>Disable</strong> the parent category text label from catalog pages.",
					"id" => "category_listing",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'category_listing_enabled.png',
						'1' => $url . 'category_listing_disabled.png')
					);
					
/*$of_options[] = array( "name" => "Products/Page in Product Listing",
					"desc" => "Enter the Number of Products per Page in Product Listing.",
					"id" => "products_per_page",
					"std" => "12",
					"type" => "text");	*/
					
$of_options[] = array( 	"name" 		=> "Number of Products per Catalog Page",
						"desc" 		=> "Drag the slider to set the number of products to be listed on the shop page and catalog pages.",
						"id" 		=> "products_per_page",
						"std" 		=> "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "48",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);
				
$of_options[] = array( "name" 		=> "Ratings on Catalog Pages",
						"desc" 		=> "<strong>Show</strong> / <strong>Hide</strong> the ratings meter on the products listed on shop pages.",
						"id" 		=> "ratings_on_product_listing",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
$of_options[] = array( "name" => "Ratings styles",
					"desc" => "Select the style for the ratings.",
					"id" => "ratings_styles",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'rating-dashes.png',
						'1' => $url . 'rating-stars.png')
					);
				
$of_options[] = array( 	"name" => "Out of Stock",
						"desc" => "Change the 'Out of stock' text.",
						"id" => "out_of_stock_text",
						"std" => "Out of stock",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Sale",
						"desc" => "Change the 'Sale' text.",
						"id" => "sale_text",
						"std" => "Sale!",
						"type" => "text"
				);
				
$of_options[] = array( "name" 		=> "Parallax on Category Header",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the Parallax on Category Header.",
						"id" 		=> "category_header_parallax",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
$of_options[] = array( "name" 		=> "Breadcrumbs",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the Breadcrumbs.",
						"id" 		=> "breadcrumbs",
						"std" 		=> 0,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);

// Product Page

$of_options[] = array( "name" => "Product Page",
                    "type" => "heading");

$of_options[] = array( "name" => "Products Layout",
					"desc" => "Select the layout style for the products.",
					"id" => "products_layout",
					"std" => "0",
					"type" => "images",
					"options" => array(
						'0' => $url . 'product-sidebar-off.png',
						'1' => $url . 'product-sidebar-on.png')
					);

$of_options[] = array( "name" 		=> "Sharing Options",
						"desc" 		=> "<strong>Enable</strong> / <strong>Disable</strong> the social media sharing options on the product page.",
						"id" 		=> "sharing_on_product_page",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
				
$of_options[] = array( "name" 		=> "Product Reviews",
						"desc" 		=> "Use this option to <strong>Disable</strong> the product reviews on the product page, for all products at once.",
						"id" 		=> "reviews_on_product_page",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
					
$of_options[] = array( "name" 		=> "Related Products",
						"desc" 		=> "Use this option to <strong>Enable</strong> / <strong>Disable</strong> the related products at the bottom of the product page.",
						"id" 		=> "related_products_on_product_page",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);

// My Account

$of_options[] = array( "name" => "My Account",
                    "type" => "heading");
					
$of_options[] = array( "name" => "Registration &#8212; Content",
					"desc" => "The registration text block displayed on the right side of the form.",
					"id" => "registration_content",
					"std" => "<h3>Your Registration text here</h3>
<ul>
<li>Your text here</li>
<li>Your text here</li>
<li>Your text here</li>
<li>Your text here</li>
</ul>",
					"type" => "textarea");
					
/*$of_options[] = array( "name" => "Register Button",
					"desc" => "The text on your registration button.",
					"id" => "registration_button",
					"std" => "Create an account",
					"type" => "text");*/
					
$of_options[] = array( "name" => "Login &#8212; Content",
					"desc" => "The login text block displayed on the right side of the form.",
					"id" => "login_content",
					"std" => "<h3>Your Login text here</h3>
<ul>
<li>Your text here</li>
<li>Your text here</li>
<li>Your text here</li>
<li>Your text here</li>
</ul>",
					"type" => "textarea");
					
					





// Styling tab

$of_options[] = array( "name" => "Styling",
					"type" => "heading");
					
$of_options[] = array( "name" => "Logo",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Logo</h4>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Upload Your Logo",
					"desc" => "Upload your logo image.",
					"id" => "site_logo",
					"std" => "",
					"mod" => "min",
					"type" => "media");
					
$of_options[] = array( "name" => "Upload Your Retina Logo",
					"desc" => "Upload a higher-resolution image to be used for retina display devices.",
					"id" => "site_logo_retina",
					"std" => "",
					"mod" => "min",
					"type" => "media");
									
$of_options[] = array( "name" => "Colors",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Colors</h4>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Main Theme Color / Accent Color",
					"desc" => "Define the main/accent color for your theme. Several elements on the theme will automatically inherit the styling defined here.",
					"id" => "accent_color",
					"std" => "#b39964",
					"type" => "color");
					
$of_options[] = array( "name" => "Primary Font Color",
					"desc" => "Select a color for your Primary Font selected in the Typography section.",
					"id" => "primary_color",
					"std" => "#000",
					"type" => "color");
					
$of_options[] = array( "name" => "Main Background",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Site Background Options</h4> <br />* The following background options are available only if the <em>Main Layout</em> is set to use the <em>Boxed</em> layout option. This layout option can be enabled by navigationg to the <em>General</em> options tab.",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Background Color (<em>*for Boxed layout only</em>)",
					"desc" => "The main background color of the site if the <em>Boxed</em> layout style is enabled.",
					"id" => "main_bg_color",
					"std" => "#fff",
					"type" => "color");
					
$of_options[] = array( "name" => "Background Image (<em>*for Boxed layout only</em>)",
					"desc" => "Upload a background image or specify an image URL. Used if the <em>Boxed</em> layout style is enabled.",
					"id" => "main_bg",
					"std" => "",
					"type" => "media");					
					
					
$of_options[] = array( "name" => "Icons",
					"desc" => "",
					"id" => "introduction",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Icons</h4>",
					"icon" => true,
					"type" => "info");
					
$of_options[] = array( "name" => "Site Icons &#8212; Sprite",
					"desc" => "Upload your custom icons sprite.",
					"id" => "icons_sprite_normal",
					"std" => "",
					"mod" => "min",
					"type" => "upload");
					
$of_options[] = array( "name" => "Site Icons &#8212; Sprite (Retina)",
					"desc" => "Upload the retina version for your custom icons sprite.",
					"id" => "icons_sprite_retina",
					"std" => "",
					"mod" => "min",
					"type" => "media");
					
					
					
					
					
					
					
// Typography tab

$of_options[] = array( "name" => "Typography",
					"type" => "heading");
					
$all_font_faces = array('arial'=>'Arial',
				'verdana'=>'Verdana, Geneva',
				'trebuchet'=>'Trebuchet MS',
				'georgia' =>'Georgia',
				'times'=>'Times New Roman',
				'tahoma'=>'Tahoma, Geneva',
				'helvetica'=>'Helvetica',
				
				'ABeeZee' => 'ABeeZee',
				'Abel' => 'Abel',
				'Abril Fatface' => 'Abril Fatface',
				'Aclonica' => 'Aclonica',
				'Acme' => 'Acme',
				'Actor' => 'Actor',
				'Adamina' => 'Adamina',
				'Advent Pro' => 'Advent Pro',
				'Aguafina Script' => 'Aguafina Script',
				'Akronim' => 'Akronim',
				'Aladin' => 'Aladin',
				'Aldrich' => 'Aldrich',
				'Alef' => 'Alef',
				'Alegreya' => 'Alegreya',
				'Alegreya SC' => 'Alegreya SC',
				'Alegreya Sans' => 'Alegreya Sans',
				'Alegreya Sans SC' => 'Alegreya Sans SC',
				'Alex Brush' => 'Alex Brush',
				'Alfa Slab One' => 'Alfa Slab One',
				'Alice' => 'Alice',
				'Alike' => 'Alike',
				'Alike Angular' => 'Alike Angular',
				'Allan' => 'Allan',
				'Allerta' => 'Allerta',
				'Allerta Stencil' => 'Allerta Stencil',
				'Allura' => 'Allura',
				'Almendra' => 'Almendra',
				'Almendra Display' => 'Almendra Display',
				'Almendra SC' => 'Almendra SC',
				'Amarante' => 'Amarante',
				'Amaranth' => 'Amaranth',
				'Amatic SC' => 'Amatic SC',
				'Amethysta' => 'Amethysta',
				'Anaheim' => 'Anaheim',
				'Andada' => 'Andada',
				'Andika' => 'Andika',
				'Angkor' => 'Angkor',
				'Annie Use Your Telescope' => 'Annie Use Your Telescope',
				'Anonymous Pro' => 'Anonymous Pro',
				'Antic' => 'Antic',
				'Antic Didone' => 'Antic Didone',
				'Antic Slab' => 'Antic Slab',
				'Anton' => 'Anton',
				'Arapey' => 'Arapey',
				'Arbutus' => 'Arbutus',
				'Arbutus Slab' => 'Arbutus Slab',
				'Architects Daughter' => 'Architects Daughter',
				'Archivo Black' => 'Archivo Black',
				'Archivo Narrow' => 'Archivo Narrow',
				'Arimo' => 'Arimo',
				'Arizonia' => 'Arizonia',
				'Armata' => 'Armata',
				'Artifika' => 'Artifika',
				'Arvo' => 'Arvo',
				'Asap' => 'Asap',
				'Asset' => 'Asset',
				'Astloch' => 'Astloch',
				'Asul' => 'Asul',
				'Atomic Age' => 'Atomic Age',
				'Aubrey' => 'Aubrey',
				'Audiowide' => 'Audiowide',
				'Autour One' => 'Autour One',
				'Average' => 'Average',
				'Average Sans' => 'Average Sans',
				'Averia Gruesa Libre' => 'Averia Gruesa Libre',
				'Averia Libre' => 'Averia Libre',
				'Averia Sans Libre' => 'Averia Sans Libre',
				'Averia Serif Libre' => 'Averia Serif Libre',
				'Bad Script' => 'Bad Script',
				'Balthazar' => 'Balthazar',
				'Bangers' => 'Bangers',
				'Basic' => 'Basic',
				'Battambang' => 'Battambang',
				'Baumans' => 'Baumans',
				'Bayon' => 'Bayon',
				'Belgrano' => 'Belgrano',
				'Belleza' => 'Belleza',
				'BenchNine' => 'BenchNine',
				'Bentham' => 'Bentham',
				'Berkshire Swash' => 'Berkshire Swash',
				'Bevan' => 'Bevan',
				'Bigelow Rules' => 'Bigelow Rules',
				'Bigshot One' => 'Bigshot One',
				'Bilbo' => 'Bilbo',
				'Bilbo Swash Caps' => 'Bilbo Swash Caps',
				'Bitter' => 'Bitter',
				'Black Ops One' => 'Black Ops One',
				'Bokor' => 'Bokor',
				'Bonbon' => 'Bonbon',
				'Boogaloo' => 'Boogaloo',
				'Bowlby One' => 'Bowlby One',
				'Bowlby One SC' => 'Bowlby One SC',
				'Brawler' => 'Brawler',
				'Bree Serif' => 'Bree Serif',
				'Bubblegum Sans' => 'Bubblegum Sans',
				'Bubbler One' => 'Bubbler One',
				'Buda' => 'Buda',
				'Buenard' => 'Buenard',
				'Butcherman' => 'Butcherman',
				'Butterfly Kids' => 'Butterfly Kids',
				'Cabin' => 'Cabin',
				'Cabin Condensed' => 'Cabin Condensed',
				'Cabin Sketch' => 'Cabin Sketch',
				'Caesar Dressing' => 'Caesar Dressing',
				'Cagliostro' => 'Cagliostro',
				'Calligraffitti' => 'Calligraffitti',
				'Cambo' => 'Cambo',
				'Candal' => 'Candal',
				'Cantarell' => 'Cantarell',
				'Cantata One' => 'Cantata One',
				'Cantora One' => 'Cantora One',
				'Capriola' => 'Capriola',
				'Cardo' => 'Cardo',
				'Carme' => 'Carme',
				'Carrois Gothic' => 'Carrois Gothic',
				'Carrois Gothic SC' => 'Carrois Gothic SC',
				'Carter One' => 'Carter One',
				'Caudex' => 'Caudex',
				'Cedarville Cursive' => 'Cedarville Cursive',
				'Ceviche One' => 'Ceviche One',
				'Changa One' => 'Changa One',
				'Chango' => 'Chango',
				'Chau Philomene One' => 'Chau Philomene One',
				'Chela One' => 'Chela One',
				'Chelsea Market' => 'Chelsea Market',
				'Chenla' => 'Chenla',
				'Cherry Cream Soda' => 'Cherry Cream Soda',
				'Cherry Swash' => 'Cherry Swash',
				'Chewy' => 'Chewy',
				'Chicle' => 'Chicle',
				'Chivo' => 'Chivo',
				'Cinzel' => 'Cinzel',
				'Cinzel Decorative' => 'Cinzel Decorative',
				'Clicker Script' => 'Clicker Script',
				'Coda' => 'Coda',
				'Coda Caption' => 'Coda Caption',
				'Codystar' => 'Codystar',
				'Combo' => 'Combo',
				'Comfortaa' => 'Comfortaa',
				'Coming Soon' => 'Coming Soon',
				'Concert One' => 'Concert One',
				'Condiment' => 'Condiment',
				'Content' => 'Content',
				'Contrail One' => 'Contrail One',
				'Convergence' => 'Convergence',
				'Cookie' => 'Cookie',
				'Copse' => 'Copse',
				'Corben' => 'Corben',
				'Courgette' => 'Courgette',
				'Cousine' => 'Cousine',
				'Coustard' => 'Coustard',
				'Covered By Your Grace' => 'Covered By Your Grace',
				'Crafty Girls' => 'Crafty Girls',
				'Creepster' => 'Creepster',
				'Crete Round' => 'Crete Round',
				'Crimson Text' => 'Crimson Text',
				'Croissant One' => 'Croissant One',
				'Crushed' => 'Crushed',
				'Cuprum' => 'Cuprum',
				'Cutive' => 'Cutive',
				'Cutive Mono' => 'Cutive Mono',
				'Damion' => 'Damion',
				'Dancing Script' => 'Dancing Script',
				'Dangrek' => 'Dangrek',
				'Dawning of a New Day' => 'Dawning of a New Day',
				'Days One' => 'Days One',
				'Delius' => 'Delius',
				'Delius Swash Caps' => 'Delius Swash Caps',
				'Delius Unicase' => 'Delius Unicase',
				'Della Respira' => 'Della Respira',
				'Denk One' => 'Denk One',
				'Devonshire' => 'Devonshire',
				'Didact Gothic' => 'Didact Gothic',
				'Diplomata' => 'Diplomata',
				'Diplomata SC' => 'Diplomata SC',
				'Domine' => 'Domine',
				'Donegal One' => 'Donegal One',
				'Doppio One' => 'Doppio One',
				'Dorsa' => 'Dorsa',
				'Dosis' => 'Dosis',
				'Dr Sugiyama' => 'Dr Sugiyama',
				'Droid Sans' => 'Droid Sans',
				'Droid Sans Mono' => 'Droid Sans Mono',
				'Droid Serif' => 'Droid Serif',
				'Duru Sans' => 'Duru Sans',
				'Dynalight' => 'Dynalight',
				'EB Garamond' => 'EB Garamond',
				'Eagle Lake' => 'Eagle Lake',
				'Eater' => 'Eater',
				'Economica' => 'Economica',
				'Ek Mukta' => 'Ek Mukta',
				'Electrolize' => 'Electrolize',
				'Elsie' => 'Elsie',
				'Elsie Swash Caps' => 'Elsie Swash Caps',
				'Emblema One' => 'Emblema One',
				'Emilys Candy' => 'Emilys Candy',
				'Engagement' => 'Engagement',
				'Englebert' => 'Englebert',
				'Enriqueta' => 'Enriqueta',
				'Erica One' => 'Erica One',
				'Esteban' => 'Esteban',
				'Euphoria Script' => 'Euphoria Script',
				'Ewert' => 'Ewert',
				'Exo' => 'Exo',
				'Exo 2' => 'Exo 2',
				'Expletus Sans' => 'Expletus Sans',
				'Fanwood Text' => 'Fanwood Text',
				'Fascinate' => 'Fascinate',
				'Fascinate Inline' => 'Fascinate Inline',
				'Faster One' => 'Faster One',
				'Fasthand' => 'Fasthand',
				'Fauna One' => 'Fauna One',
				'Federant' => 'Federant',
				'Federo' => 'Federo',
				'Felipa' => 'Felipa',
				'Fenix' => 'Fenix',
				'Finger Paint' => 'Finger Paint',
				'Fira Mono' => 'Fira Mono',
				'Fira Sans' => 'Fira Sans',
				'Fjalla One' => 'Fjalla One',
				'Fjord One' => 'Fjord One',
				'Flamenco' => 'Flamenco',
				'Flavors' => 'Flavors',
				'Fondamento' => 'Fondamento',
				'Fontdiner Swanky' => 'Fontdiner Swanky',
				'Forum' => 'Forum',
				'Francois One' => 'Francois One',
				'Freckle Face' => 'Freckle Face',
				'Fredericka the Great' => 'Fredericka the Great',
				'Fredoka One' => 'Fredoka One',
				'Freehand' => 'Freehand',
				'Fresca' => 'Fresca',
				'Frijole' => 'Frijole',
				'Fruktur' => 'Fruktur',
				'Fugaz One' => 'Fugaz One',
				'GFS Didot' => 'GFS Didot',
				'GFS Neohellenic' => 'GFS Neohellenic',
				'Gabriela' => 'Gabriela',
				'Gafata' => 'Gafata',
				'Galdeano' => 'Galdeano',
				'Galindo' => 'Galindo',
				'Gentium Basic' => 'Gentium Basic',
				'Gentium Book Basic' => 'Gentium Book Basic',
				'Geo' => 'Geo',
				'Geostar' => 'Geostar',
				'Geostar Fill' => 'Geostar Fill',
				'Germania One' => 'Germania One',
				'Gilda Display' => 'Gilda Display',
				'Give You Glory' => 'Give You Glory',
				'Glass Antiqua' => 'Glass Antiqua',
				'Glegoo' => 'Glegoo',
				'Gloria Hallelujah' => 'Gloria Hallelujah',
				'Goblin One' => 'Goblin One',
				'Gochi Hand' => 'Gochi Hand',
				'Gorditas' => 'Gorditas',
				'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
				'Graduate' => 'Graduate',
				'Grand Hotel' => 'Grand Hotel',
				'Gravitas One' => 'Gravitas One',
				'Great Vibes' => 'Great Vibes',
				'Griffy' => 'Griffy',
				'Gruppo' => 'Gruppo',
				'Gudea' => 'Gudea',
				'Habibi' => 'Habibi',
				'Hammersmith One' => 'Hammersmith One',
				'Hanalei' => 'Hanalei',
				'Hanalei Fill' => 'Hanalei Fill',
				'Handlee' => 'Handlee',
				'Hanuman' => 'Hanuman',
				'Happy Monkey' => 'Happy Monkey',
				'Headland One' => 'Headland One',
				'Henny Penny' => 'Henny Penny',
				'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
				'Holtwood One SC' => 'Holtwood One SC',
				'Homemade Apple' => 'Homemade Apple',
				'Homenaje' => 'Homenaje',
				'IM Fell DW Pica' => 'IM Fell DW Pica',
				'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
				'IM Fell Double Pica' => 'IM Fell Double Pica',
				'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
				'IM Fell English' => 'IM Fell English',
				'IM Fell English SC' => 'IM Fell English SC',
				'IM Fell French Canon' => 'IM Fell French Canon',
				'IM Fell French Canon SC' => 'IM Fell French Canon SC',
				'IM Fell Great Primer' => 'IM Fell Great Primer',
				'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
				'Iceberg' => 'Iceberg',
				'Iceland' => 'Iceland',
				'Imprima' => 'Imprima',
				'Inconsolata' => 'Inconsolata',
				'Inder' => 'Inder',
				'Indie Flower' => 'Indie Flower',
				'Inika' => 'Inika',
				'Irish Grover' => 'Irish Grover',
				'Istok Web' => 'Istok Web',
				'Italiana' => 'Italiana',
				'Italianno' => 'Italianno',
				'Jacques Francois' => 'Jacques Francois',
				'Jacques Francois Shadow' => 'Jacques Francois Shadow',
				'Jim Nightshade' => 'Jim Nightshade',
				'Jockey One' => 'Jockey One',
				'Jolly Lodger' => 'Jolly Lodger',
				'Josefin Sans' => 'Josefin Sans',
				'Josefin Slab' => 'Josefin Slab',
				'Joti One' => 'Joti One',
				'Judson' => 'Judson',
				'Julee' => 'Julee',
				'Julius Sans One' => 'Julius Sans One',
				'Junge' => 'Junge',
				'Jura' => 'Jura',
				'Just Another Hand' => 'Just Another Hand',
				'Just Me Again Down Here' => 'Just Me Again Down Here',
				'Kameron' => 'Kameron',
				'Kantumruy' => 'Kantumruy',
				'Karla' => 'Karla',
				'Kaushan Script' => 'Kaushan Script',
				'Kavoon' => 'Kavoon',
				'Kdam Thmor' => 'Kdam Thmor',
				'Keania One' => 'Keania One',
				'Kelly Slab' => 'Kelly Slab',
				'Kenia' => 'Kenia',
				'Khmer' => 'Khmer',
				'Kite One' => 'Kite One',
				'Knewave' => 'Knewave',
				'Kotta One' => 'Kotta One',
				'Koulen' => 'Koulen',
				'Kranky' => 'Kranky',
				'Kreon' => 'Kreon',
				'Kristi' => 'Kristi',
				'Krona One' => 'Krona One',
				'La Belle Aurore' => 'La Belle Aurore',
				'Lancelot' => 'Lancelot',
				'Lato' => 'Lato',
				'League Script' => 'League Script',
				'Leckerli One' => 'Leckerli One',
				'Ledger' => 'Ledger',
				'Lekton' => 'Lekton',
				'Lemon' => 'Lemon',
				'Libre Baskerville' => 'Libre Baskerville',
				'Life Savers' => 'Life Savers',
				'Lilita One' => 'Lilita One',
				'Lily Script One' => 'Lily Script One',
				'Limelight' => 'Limelight',
				'Linden Hill' => 'Linden Hill',
				'Lobster' => 'Lobster',
				'Lobster Two' => 'Lobster Two',
				'Londrina Outline' => 'Londrina Outline',
				'Londrina Shadow' => 'Londrina Shadow',
				'Londrina Sketch' => 'Londrina Sketch',
				'Londrina Solid' => 'Londrina Solid',
				'Lora' => 'Lora',
				'Love Ya Like A Sister' => 'Love Ya Like A Sister',
				'Loved by the King' => 'Loved by the King',
				'Lovers Quarrel' => 'Lovers Quarrel',
				'Luckiest Guy' => 'Luckiest Guy',
				'Lusitana' => 'Lusitana',
				'Lustria' => 'Lustria',
				'Macondo' => 'Macondo',
				'Macondo Swash Caps' => 'Macondo Swash Caps',
				'Magra' => 'Magra',
				'Maiden Orange' => 'Maiden Orange',
				'Mako' => 'Mako',
				'Marcellus' => 'Marcellus',
				'Marcellus SC' => 'Marcellus SC',
				'Marck Script' => 'Marck Script',
				'Margarine' => 'Margarine',
				'Marko One' => 'Marko One',
				'Marmelad' => 'Marmelad',
				'Marvel' => 'Marvel',
				'Mate' => 'Mate',
				'Mate SC' => 'Mate SC',
				'Maven Pro' => 'Maven Pro',
				'McLaren' => 'McLaren',
				'Meddon' => 'Meddon',
				'MedievalSharp' => 'MedievalSharp',
				'Medula One' => 'Medula One',
				'Megrim' => 'Megrim',
				'Meie Script' => 'Meie Script',
				'Merienda' => 'Merienda',
				'Merienda One' => 'Merienda One',
				'Merriweather' => 'Merriweather',
				'Merriweather Sans' => 'Merriweather Sans',
				'Metal' => 'Metal',
				'Metal Mania' => 'Metal Mania',
				'Metamorphous' => 'Metamorphous',
				'Metrophobic' => 'Metrophobic',
				'Michroma' => 'Michroma',
				'Milonga' => 'Milonga',
				'Miltonian' => 'Miltonian',
				'Miltonian Tattoo' => 'Miltonian Tattoo',
				'Miniver' => 'Miniver',
				'Miss Fajardose' => 'Miss Fajardose',
				'Modern Antiqua' => 'Modern Antiqua',
				'Molengo' => 'Molengo',
				'Molle' => 'Molle',
				'Monda' => 'Monda',
				'Monofett' => 'Monofett',
				'Monoton' => 'Monoton',
				'Monsieur La Doulaise' => 'Monsieur La Doulaise',
				'Montaga' => 'Montaga',
				'Montez' => 'Montez',
				'Montserrat' => 'Montserrat',
				'Montserrat Alternates' => 'Montserrat Alternates',
				'Montserrat Subrayada' => 'Montserrat Subrayada',
				'Moul' => 'Moul',
				'Moulpali' => 'Moulpali',
				'Mountains of Christmas' => 'Mountains of Christmas',
				'Mouse Memoirs' => 'Mouse Memoirs',
				'Mr Bedfort' => 'Mr Bedfort',
				'Mr Dafoe' => 'Mr Dafoe',
				'Mr De Haviland' => 'Mr De Haviland',
				'Mrs Saint Delafield' => 'Mrs Saint Delafield',
				'Mrs Sheppards' => 'Mrs Sheppards',
				'Muli' => 'Muli',
				'Mystery Quest' => 'Mystery Quest',
				'Neucha' => 'Neucha',
				'Neuton' => 'Neuton',
				'New Rocker' => 'New Rocker',
				'News Cycle' => 'News Cycle',
				'Niconne' => 'Niconne',
				'Nixie One' => 'Nixie One',
				'Nobile' => 'Nobile',
				'Nokora' => 'Nokora',
				'Norican' => 'Norican',
				'Nosifer' => 'Nosifer',
				'Nothing You Could Do' => 'Nothing You Could Do',
				'Noticia Text' => 'Noticia Text',
				'Noto Sans' => 'Noto Sans',
				'Noto Serif' => 'Noto Serif',
				'Nova Cut' => 'Nova Cut',
				'Nova Flat' => 'Nova Flat',
				'Nova Mono' => 'Nova Mono',
				'Nova Oval' => 'Nova Oval',
				'Nova Round' => 'Nova Round',
				'Nova Script' => 'Nova Script',
				'Nova Slim' => 'Nova Slim',
				'Nova Square' => 'Nova Square',
				'Numans' => 'Numans',
				'Nunito' => 'Nunito',
				'Odor Mean Chey' => 'Odor Mean Chey',
				'Offside' => 'Offside',
				'Old Standard TT' => 'Old Standard TT',
				'Oldenburg' => 'Oldenburg',
				'Oleo Script' => 'Oleo Script',
				'Oleo Script Swash Caps' => 'Oleo Script Swash Caps',
				'Open Sans' => 'Open Sans',
				'Open Sans Condensed' => 'Open Sans Condensed',
				'Oranienbaum' => 'Oranienbaum',
				'Orbitron' => 'Orbitron',
				'Oregano' => 'Oregano',
				'Orienta' => 'Orienta',
				'Original Surfer' => 'Original Surfer',
				'Oswald' => 'Oswald',
				'Over the Rainbow' => 'Over the Rainbow',
				'Overlock' => 'Overlock',
				'Overlock SC' => 'Overlock SC',
				'Ovo' => 'Ovo',
				'Oxygen' => 'Oxygen',
				'Oxygen Mono' => 'Oxygen Mono',
				'PT Mono' => 'PT Mono',
				'PT Sans' => 'PT Sans',
				'PT Sans Caption' => 'PT Sans Caption',
				'PT Sans Narrow' => 'PT Sans Narrow',
				'PT Serif' => 'PT Serif',
				'PT Serif Caption' => 'PT Serif Caption',
				'Pacifico' => 'Pacifico',
				'Paprika' => 'Paprika',
				'Parisienne' => 'Parisienne',
				'Passero One' => 'Passero One',
				'Passion One' => 'Passion One',
				'Pathway Gothic One' => 'Pathway Gothic One',
				'Patrick Hand' => 'Patrick Hand',
				'Patrick Hand SC' => 'Patrick Hand SC',
				'Patua One' => 'Patua One',
				'Paytone One' => 'Paytone One',
				'Peralta' => 'Peralta',
				'Permanent Marker' => 'Permanent Marker',
				'Petit Formal Script' => 'Petit Formal Script',
				'Petrona' => 'Petrona',
				'Philosopher' => 'Philosopher',
				'Piedra' => 'Piedra',
				'Pinyon Script' => 'Pinyon Script',
				'Pirata One' => 'Pirata One',
				'Plaster' => 'Plaster',
				'Play' => 'Play',
				'Playball' => 'Playball',
				'Playfair Display' => 'Playfair Display',
				'Playfair Display SC' => 'Playfair Display SC',
				'Podkova' => 'Podkova',
				'Poiret One' => 'Poiret One',
				'Poller One' => 'Poller One',
				'Poly' => 'Poly',
				'Pompiere' => 'Pompiere',
				'Pontano Sans' => 'Pontano Sans',
				'Port Lligat Sans' => 'Port Lligat Sans',
				'Port Lligat Slab' => 'Port Lligat Slab',
				'Prata' => 'Prata',
				'Preahvihear' => 'Preahvihear',
				'Press Start 2P' => 'Press Start 2P',
				'Princess Sofia' => 'Princess Sofia',
				'Prociono' => 'Prociono',
				'Prosto One' => 'Prosto One',
				'Puritan' => 'Puritan',
				'Purple Purse' => 'Purple Purse',
				'Quando' => 'Quando',
				'Quantico' => 'Quantico',
				'Quattrocento' => 'Quattrocento',
				'Quattrocento Sans' => 'Quattrocento Sans',
				'Questrial' => 'Questrial',
				'Quicksand' => 'Quicksand',
				'Quintessential' => 'Quintessential',
				'Qwigley' => 'Qwigley',
				'Racing Sans One' => 'Racing Sans One',
				'Radley' => 'Radley',
				'Raleway' => 'Raleway',
				'Raleway Dots' => 'Raleway Dots',
				'Rambla' => 'Rambla',
				'Rammetto One' => 'Rammetto One',
				'Ranchers' => 'Ranchers',
				'Rancho' => 'Rancho',
				'Rationale' => 'Rationale',
				'Redressed' => 'Redressed',
				'Reenie Beanie' => 'Reenie Beanie',
				'Revalia' => 'Revalia',
				'Ribeye' => 'Ribeye',
				'Ribeye Marrow' => 'Ribeye Marrow',
				'Righteous' => 'Righteous',
				'Risque' => 'Risque',
				'Roboto' => 'Roboto',
				'Roboto Condensed' => 'Roboto Condensed',
				'Roboto Slab' => 'Roboto Slab',
				'Rochester' => 'Rochester',
				'Rock Salt' => 'Rock Salt',
				'Rokkitt' => 'Rokkitt',
				'Romanesco' => 'Romanesco',
				'Ropa Sans' => 'Ropa Sans',
				'Rosario' => 'Rosario',
				'Rosarivo' => 'Rosarivo',
				'Rouge Script' => 'Rouge Script',
				'Rubik Mono One' => 'Rubik Mono One',
				'Rubik One' => 'Rubik One',
				'Ruda' => 'Ruda',
				'Rufina' => 'Rufina',
				'Ruge Boogie' => 'Ruge Boogie',
				'Ruluko' => 'Ruluko',
				'Rum Raisin' => 'Rum Raisin',
				'Ruslan Display' => 'Ruslan Display',
				'Russo One' => 'Russo One',
				'Ruthie' => 'Ruthie',
				'Rye' => 'Rye',
				'Sacramento' => 'Sacramento',
				'Sail' => 'Sail',
				'Salsa' => 'Salsa',
				'Sanchez' => 'Sanchez',
				'Sancreek' => 'Sancreek',
				'Sansita One' => 'Sansita One',
				'Sarina' => 'Sarina',
				'Satisfy' => 'Satisfy',
				'Scada' => 'Scada',
				'Schoolbell' => 'Schoolbell',
				'Seaweed Script' => 'Seaweed Script',
				'Sevillana' => 'Sevillana',
				'Seymour One' => 'Seymour One',
				'Shadows Into Light' => 'Shadows Into Light',
				'Shadows Into Light Two' => 'Shadows Into Light Two',
				'Shanti' => 'Shanti',
				'Share' => 'Share',
				'Share Tech' => 'Share Tech',
				'Share Tech Mono' => 'Share Tech Mono',
				'Shojumaru' => 'Shojumaru',
				'Short Stack' => 'Short Stack',
				'Siemreap' => 'Siemreap',
				'Sigmar One' => 'Sigmar One',
				'Signika' => 'Signika',
				'Signika Negative' => 'Signika Negative',
				'Simonetta' => 'Simonetta',
				'Sintony' => 'Sintony',
				'Sirin Stencil' => 'Sirin Stencil',
				'Six Caps' => 'Six Caps',
				'Skranji' => 'Skranji',
				'Slackey' => 'Slackey',
				'Smokum' => 'Smokum',
				'Smythe' => 'Smythe',
				'Sniglet' => 'Sniglet',
				'Snippet' => 'Snippet',
				'Snowburst One' => 'Snowburst One',
				'Sofadi One' => 'Sofadi One',
				'Sofia' => 'Sofia',
				'Sonsie One' => 'Sonsie One',
				'Sorts Mill Goudy' => 'Sorts Mill Goudy',
				'Source Code Pro' => 'Source Code Pro',
				'Source Sans Pro' => 'Source Sans Pro',
				'Source Serif Pro' => 'Source Serif Pro',
				'Special Elite' => 'Special Elite',
				'Spicy Rice' => 'Spicy Rice',
				'Spinnaker' => 'Spinnaker',
				'Spirax' => 'Spirax',
				'Squada One' => 'Squada One',
				'Stalemate' => 'Stalemate',
				'Stalinist One' => 'Stalinist One',
				'Stardos Stencil' => 'Stardos Stencil',
				'Stint Ultra Condensed' => 'Stint Ultra Condensed',
				'Stint Ultra Expanded' => 'Stint Ultra Expanded',
				'Stoke' => 'Stoke',
				'Strait' => 'Strait',
				'Sue Ellen Francisco' => 'Sue Ellen Francisco',
				'Sunshiney' => 'Sunshiney',
				'Supermercado One' => 'Supermercado One',
				'Suwannaphum' => 'Suwannaphum',
				'Swanky and Moo Moo' => 'Swanky and Moo Moo',
				'Syncopate' => 'Syncopate',
				'Tangerine' => 'Tangerine',
				'Taprom' => 'Taprom',
				'Tauri' => 'Tauri',
				'Telex' => 'Telex',
				'Tenor Sans' => 'Tenor Sans',
				'Text Me One' => 'Text Me One',
				'The Girl Next Door' => 'The Girl Next Door',
				'Tienne' => 'Tienne',
				'Tinos' => 'Tinos',
				'Titan One' => 'Titan One',
				'Titillium Web' => 'Titillium Web',
				'Trade Winds' => 'Trade Winds',
				'Trocchi' => 'Trocchi',
				'Trochut' => 'Trochut',
				'Trykker' => 'Trykker',
				'Tulpen One' => 'Tulpen One',
				'Ubuntu' => 'Ubuntu',
				'Ubuntu Condensed' => 'Ubuntu Condensed',
				'Ubuntu Mono' => 'Ubuntu Mono',
				'Ultra' => 'Ultra',
				'Uncial Antiqua' => 'Uncial Antiqua',
				'Underdog' => 'Underdog',
				'Unica One' => 'Unica One',
				'UnifrakturCook' => 'UnifrakturCook',
				'UnifrakturMaguntia' => 'UnifrakturMaguntia',
				'Unkempt' => 'Unkempt',
				'Unlock' => 'Unlock',
				'Unna' => 'Unna',
				'VT323' => 'VT323',
				'Vampiro One' => 'Vampiro One',
				'Varela' => 'Varela',
				'Varela Round' => 'Varela Round',
				'Vast Shadow' => 'Vast Shadow',
				'Vibur' => 'Vibur',
				'Vidaloka' => 'Vidaloka',
				'Viga' => 'Viga',
				'Voces' => 'Voces',
				'Volkhov' => 'Volkhov',
				'Vollkorn' => 'Vollkorn',
				'Voltaire' => 'Voltaire',
				'Waiting for the Sunrise' => 'Waiting for the Sunrise',
				'Wallpoet' => 'Wallpoet',
				'Walter Turncoat' => 'Walter Turncoat',
				'Warnes' => 'Warnes',
				'Wellfleet' => 'Wellfleet',
				'Wendy One' => 'Wendy One',
				'Wire One' => 'Wire One',
				'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
				'Yellowtail' => 'Yellowtail',
				'Yeseva One' => 'Yeseva One',				
				'Yesteryear' => 'Yesteryear',
				'Zeyada' => 'Zeyada',

);
					
$of_options[] = array( "name" => "Main Font",
					"desc" => "Pick the <em>Main Font</em> for your site.",
					"id" => "gb_main_font",
					"std" => "Arvo",
					"type" => "select_google_font",
					"options" => $all_font_faces); 
					
$of_options[] = array( "name" => "Secondary Font",
					"desc" => "Pick the <em>Secondary Font</em> for your site.",
					"id" => "gb_secondary_font",
					"std" => "Lato",
					"type" => "select_google_font",
					"options" => $all_font_faces); 					
					
					
					
// Portfolio tab

$of_options[] = array( "name" => "Portfolio",
					"type" => "heading");

/*$of_options[] = array( 	"name" 		=> "Number of Portfolio Items before the 'Load More' button ",
						"desc" 		=> "Drag the slider to set the number of portfolio items to be listed on the page before the 'Load More' button.",
						"id" 		=> "portfolio_items_per_page",
						"std" 		=> "99999",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"type" 		=> "sliderui",
						"edit" 		=> "1"
				);*/
				
$of_options[] = array( 	"name" 		=> "Number of Portfolio Items per row",
						"desc" 		=> "Drag the slider to set the number of portfolio items to be listed on a row.",
						"id" 		=> "portfolio_items_per_row",
						"std" 		=> "3",
						"min" 		=> "2",
						"step"		=> "1",
						"max" 		=> "4",
						"type" 		=> "sliderui",
						"edit" 		=> "0"
				);
				
$of_options[] = array( 	"name" 		=> "Order by",
						/*"desc" 		=> "Order by",*/
						"id" 		=> "portfolio_items_order_by",
						"std" 		=> "date",
						"type" 		=> "select",
						"options" 	=> array("Date","Title")
				);
				
$of_options[] = array( 	"name" 		=> "Order",
						/*"desc" 		=> "Order",*/
						"id" 		=> "portfolio_items_order",
						"std" 		=> "DESC",
						"type" 		=> "select",
						"options" 	=> array("DESC","ASC")
				);
				
				
				
// Social Media tab

$of_options[] = array( "name" => "Social Media",
					"type" => "heading");
					
$of_options[] = array( 	"name" 		=> "Show Social Media Icons in the Header",
						"desc" 		=> "",
						"id" 		=> "social_media_in_header",
						"std" 		=> 1,
						"on" 		=> "Enabled",
						"off" 		=> "Disabled",
						"type" 		=> "switch"
				);
					
$of_options[] = array( 	"name" => "Facebook",
						"desc" => "",
						"id" => "social_media_facebook",
						"std" => "https://www.facebook.com/GetBowtied",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Pinterest",
						"desc" => "",
						"id" => "social_media_pinterest",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Linkedin",
						"desc" => "",
						"id" => "social_media_linkedin",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Twitter",
						"desc" => "",
						"id" => "social_media_twitter",
						"std" => "https://twitter.com/getbowtied",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Google+",
						"desc" => "",
						"id" => "social_media_googleplus",
						"std" => "https://plus.google.com/b/100388744672090997201/+Getbowtied/posts",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "RSS",
						"desc" => "",
						"id" => "social_media_rss",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Tumblr",
						"desc" => "",
						"id" => "social_media_tumblr",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Instagram",
						"desc" => "",
						"id" => "social_media_instagram",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Youtube",
						"desc" => "",
						"id" => "social_media_youtube",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Vimeo",
						"desc" => "",
						"id" => "social_media_vimeo",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Behance",
						"desc" => "",
						"id" => "social_media_behance",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Dribble",
						"desc" => "",
						"id" => "social_media_dribble",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Flickr",
						"desc" => "",
						"id" => "social_media_flickr",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Git",
						"desc" => "",
						"id" => "social_media_git",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Skype",
						"desc" => "",
						"id" => "social_media_skype",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Weibo",
						"desc" => "",
						"id" => "social_media_weibo",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Foursquare",
						"desc" => "",
						"id" => "social_media_foursquare",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "Soundcloud",
						"desc" => "",
						"id" => "social_media_soundcloud",
						"std" => "",
						"type" => "text"
				);
				
$of_options[] = array( 	"name" => "VK",
						"desc" => "",
						"id" => "social_media_vk",
						"std" => "",
						"type" => "text"
				);

$of_options[] = array( 	"name" => "Snapchat",
						"desc" => "",
						"id" => "social_media_snapchat",
						"std" => "",
						"type" => "text"
				);

$of_options[] = array( 	"name" => "Houzz",
						"desc" => "",
						"id" => "social_media_houzz",
						"std" => "",
						"type" => "text"
				);
				

// Custom Code tab

$of_options[] = array( "name" => "Custom Code",
					"type" => "heading");
					
$of_options[] = array( "name" => "Custom CSS",
					"desc" => "Paste your custom <strong>CSS</strong> code here.",
					"id" => "custom_css",
					"std" => ".add-your-own-classes-here {

}",
					"type" => "textarea"); 
					
$of_options[] = array( "name" => "Header JavaScript Code",
					"desc" => "Paste your custom <strong>JS</strong> code here. The code will be added to the header of your site.",
					"id" => "custom_js_header",
					"std" => '<script type="text/javascript">
					
//JavaScript goes here

</script>',
					"type" => "textarea");
					
$of_options[] = array( "name" => "Footer JavaScript Code",
					"desc" => "Here is the place to paste your <br /><strong>Google Analytics</strong> code or any other <strong>JS</strong> code you might want to add to be loaded in the footer of your website.",
					"id" => "custom_js_footer",
					"std" => '<script type="text/javascript">
					
//JavaScript goes here

</script>',
					"type" => "textarea");
					
					
					
					
// Backup Options tab
$of_options[] = array( "name" => "Backup",
					"type" => "heading");
					
$of_options[] = array( "name" => "Backup and Restore Options",
                    "id" => "of_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);
					
$of_options[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "of_transfer",
                    "std" => "",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);
					
					
					
					
					
					
// Documentation tab
$of_options[] = array( "name" => "Documentation",
					"type" => "heading");

$of_options[] = array( "name" => "Documentation Info",
					"desc" => "",
					"id" => "doc_info",
					"std" => "<br /><br /><p class=\"theretailer_theme_options_info_paragraph\"><img src='../wp-content/themes/theretailer/admin/assets/images/support_icon.png' /></p>",
					"icon" => true,
					"type" => "info");					
					
$of_options[] = array( "name" => "Theme Documentation",
					"desc" => "",
					"id" => "theme_documentation",
					"std" => '<p>Knowledge is Power! You can rely on the online <a href="http://support.getbowtied.com/hc/en-us/categories/200102021-The-Retailer" target="_blank">Theme Documentation</a> as you move further with building your site. It covers all the steps of configuring the navigation, importing the dummy data, building the pages and so on.</p><p>Always feel free to get back to it. We update it as much as we can with valuable information whenever is needed. <br /><br /><a class="button-primary" href="http://support.getbowtied.com/hc/en-us/categories/200102021-The-Retailer" target="_blank">Theme Documentation &rarr;</a></p>',
					"icon" => true,
					"type" => "info");	
									
/*$of_options[] = array( "name" => "Customer Support",
					"desc" => "",
					"id" => "customer_support",
					"std" => "<h4 class=\"theretailer_theme_options_subheader\">Customer Support Forum</h4><p>If you cannot find your answer in the documentation file or if you have any problem while installing and configuring your theme, you can open ticket on our dedicated <a href=\"http://getbowtiedsupport.ticksy.com/\" target=\"_blank\">Support Forum</a>. Be descriptive about the issues you're experiencing and always provide a link to your site.</p><p>* <em>The ThemeForest purchase code is needed to access the Support Forum. <br />**Please note that we do not provide support for any custom changes and/or integration with 3rd party plugins or extensions.</em></p>",
					"icon" => true,
					"type" => "info");*/
			
	}
}
?>
