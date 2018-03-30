<?php
add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sidebars
		$of_sidebars 	= array();
		global $default_sidebars;
		if($default_sidebars){
			foreach( $default_sidebars as $key => $_sidebar ){
				$of_sidebars[$_sidebar['id']] = $_sidebar['name'];
			}
		}

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
				"placebo" 		=> "placebo", //REQUIRED!
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
		
		//default value for logo and favor icon
		$df_logo_images_uri = get_stylesheet_directory_uri(). '/images/logo.png'; 
		$df_icon_images_uri = get_stylesheet_directory_uri(). '/images/favicon.ico'; 
		
		$df_payment_images_1_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_paypal.png';
		$df_payment_images_2_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_visa.png'; 		
		$df_payment_images_3_uri = get_stylesheet_directory_uri(). '/images/media/icon_american_visa.png'; 		
		$df_payment_images_4_uri = get_stylesheet_directory_uri(). '/images/media/icon_payment_master_card.png';
		$df_payment_images_5_uri = get_stylesheet_directory_uri(). '/images/media/icon_dhl_visa.png'; 		
		$df_payment_images_6_uri = get_stylesheet_directory_uri(). '/images/media/icon_fed_visa.png';
		///background footer 
		$df_bg_third_footer_widget = get_stylesheet_directory_uri(). '/images/media/bg-footer.jpg';
		
		/* Breadcrumbs background */
		$df_bg_breadcrumbs = get_stylesheet_directory_uri(). '/images/media/bg-breadcrumb.jpg';

		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		$default_font_size = array(	
			"10px"
			,"11px"
			,"12px"
			,"13px"
			,"14px"
			,"15px"
			,"16px"
			,"17px"
			,"18px"
			,"19px"
			,"20px"
			,"21px"
			,"22px"
			,"23px"
			,"24px"
			,"25px"
			,"26px"
			,"27px"
			,"28px"
			,"29px"
			,"30px"		
			,"31px"
			,"32px"
			,"33px"
			,"34px"
			,"35px"
			,"36px"
			,"37px"
			,"38px"
			,"39px"	
			,"40px"	
			,"41px"
			,"42px"
			,"43px"
			,"44px"
			,"45px"
			,"46px"
			,"47px"
			,"48px"
			,"49px"	
			,"50px"		
		);
		
		$faces = array('Arial'=>'Arial',
					'Advent Pro'=>'Advent Pro',
					'Open Sans'=>'Open Sans',
					'Verdana'=>'Verdana, Geneva',
					'Trebuchet'=>'Trebuchet',
					'Georgia' =>'Georgia',
					'Times New Roman'=>'Times New Roman',
					'Tahoma, Geneva'=>'Tahoma, Geneva',
					'Palatino'=>'Palatino',
					'Helvetica'=>'Helvetica' );
										
		$url =  ADMIN_DIR . 'assets/images/';	

		$default_font_size = array_combine($default_font_size, $default_font_size);
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

/***************** TODO : GENERAL ****************/					


global $of_options,$wd_google_fonts;

$of_options = array();

/* Import demo content */					
$of_options[] = array( 	"name" 		=> "Import Demo",
						"type" 		=> "heading"
				);	
				
$of_options[] = array( "name" 	=> "",
					"desc" 		=> "Please make sure you already installed and activated Visual Composer, Revolution Slider and WooCommerce plugins.<br/>It can also take a minute to complete. <strong>Please don't close your browser when importing</strong>",
					"id" 		=> "wd_import_button",
					"std" 		=> 'Click To Import',
					"type" 		=> "button"
				);	

$of_options[] = array( 	"name" 		=> "Import Pages - Posts - Menu"
						,"desc" 	=> ""
						,"id" 		=> "wd_import_pages_posts"
						,"std"		=> "yes"
						,"options"	=> array(
									'yes'	=> 'Yes'
									,'no'	=> 'No'
									)
						,"type" 	=> "select"
				);
				
$of_options[] = array( 	"name" 		=> "Import Revolution Slider"
						,"desc" 	=> ""
						,"id" 		=> "wd_import_revsliders"
						,"std"		=> "yes"
						,"options"	=> array(
									'yes'	=> 'Yes'
									,'no'	=> 'No'
									)
						,"type" 	=> "select"
				);
				
$of_options[] = array( 	"name" 		=> "Import Widget Content"
						,"desc" 	=> ""
						,"id" 		=> "wd_import_widgets"
						,"std"		=> "override"
						,"options"	=> array(
									'override'	=> 'Override'
									,'append'	=> 'Append'
									,'no'		=> 'No'
									)
						,"type" 	=> "select"
				);
				
$of_options[] = array( 	"name" 		=> "Import Theme Options"
						,"desc" 	=> "Get default options after importing"
						,"id" 		=> "wd_import_theme_options"
						,"std"		=> "no"
						,"options"	=> array(
									'yes'		=> 'Yes'
									,'no'		=> 'No'
									)
						,"type" 	=> "select"
				);
				
/* General Settings */
					
$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);						

$of_options[] = array( 	"name" 		=> "Logo image"
						,"desc" 	=> "Change your logo."
						,"id" 		=> "wd_logo"
						,"std"		=> $df_logo_images_uri
						,"type" 	=> "upload"
				);

$of_options[] = array( 	"name" 		=> "Favicon image"
						,"desc" 	=> "Accept ICO files"
						,"id" 		=> "wd_icon"
						,"std" 		=> $df_icon_images_uri
						,"type" 		=> "media"
				);
				
$of_options[] = array( 	"name" 		=> "Text Logo"
						,"desc" 	=> "Text Logo"
						,"id" 		=> "wd_text_logo"
						,"std" 		=> "Oswad Market Theme"
						,"type" 	=> "text"
				);	
/*************** Config image size ****************/
$of_options[] = array( 	"name" 		=> "Image Size Section"
						,"desc" 	=> ""
						,"id" 		=> "introduction_image_size"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Image Size Section</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Blog Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 879"
						,"id" 		=> "wd_blog_thumb_width"
						,"std" 		=> "879"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height.In px, default value: 565"
						,"id" 		=> "wd_blog_thumb_height"
						,"std" 		=> "565"
						,"type" 	=> "text" 
				);

				
$of_options[] = array( 	"name" 		=> "Custom Product Thumbnail Size"
						,"desc" 	=> "Thumbnail width. Use in custom product shortcode. <br /> In px, default value: 400"
						,"id" 		=> "wd_custom_product_thumb_width"
						,"std" 		=> "400"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. <br />In px, default value: 400"
						,"id" 		=> "wd_custom_product_thumb_height"
						,"std" 		=> "400"
						,"type" 	=> "text" 
				);
				
$of_options[] = array( 	"name" 		=> "Product Tini Thumbnail Size"
						,"desc" 	=> "Thumbnail width. Use in widget, product gallery.<br /> In px, default value: 130"
						,"id" 		=> "wd_product_tini_thumb_width"
						,"std" 		=> "130"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 130"
						,"id" 		=> "wd_product_tini_thumb_height"
						,"std" 		=> "130"
						,"type" 	=> "text" 
				);
				
$of_options[] = array( 	"name" 		=> "Shortcode Blog Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 880"
						,"id" 		=> "wd_shortcode_blog_thumb_width"
						,"std" 		=> "880"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 565"
						,"id" 		=> "wd_shortcode_blog_thumb_height"
						,"std" 		=> "565"
						,"type" 	=> "text" 
				);
				
$of_options[] = array( 	"name" 		=> "Testimonial Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 150"
						,"id" 		=> "wd_testimonial_thumb_width"
						,"std" 		=> "150"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 150"
						,"id" 		=> "wd_testimonial_thumb_height"
						,"std" 		=> "150"
						,"type" 	=> "text" 
				);
				
$of_options[] = array( 	"name" 		=> "Feature Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 320"
						,"id" 		=> "wd_feature_thumb_width"
						,"std" 		=> "600"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 50"
						,"id" 		=> "wd_feature_thumb_height"
						,"std" 		=> "370"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> "Portfolio Thumbnail Size"
						,"desc" 	=> "Thumbnail width. In px, default value: 600"
						,"id" 		=> "wd_portfolio_thumb_width"
						,"std" 		=> "600"
						,"type" 	=> "text" 
				);
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height. In px, default value: 370"
						,"id" 		=> "wd_portfolio_thumb_height"
						,"std" 		=> "370"
						,"type" 	=> "text" 
				);
/************ Config Feedback Button **************/
$of_options[] = array( 	"name" 		=> "Right Sidebar Feedback Section"
						,"desc" 	=> ""
						,"id" 		=> "introduction_right_sidebar"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Right Sidebar Feedback Section</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
$of_options[] = array( 	"name" 		=> "Show Feedback Button"
						,"desc" 	=> "Show/Hide Feedback Button on Right"
						,"id" 		=> "wd_show_feedback_button"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);			

$of_options[] = array( 	"name" 		=> "Feedback Button Text"
						,"desc" 	=> "Change your Feedback button text."
						,"id" 		=> "wd_feedback_button_text"
						,"std"		=> "feedback"
						,"fold"		=> "wd_show_feedback_button"
						,"type" 	=> "text"
				);
		
$of_options[] = array( 	"name" 		=> "Feedback Dialog Content"
						,"desc" 	=> 'You can use the contact form 7 shortcode : [contact-form-7 id="Your form ID" title="Your title"]'
						,"id" 		=> "wd_feedback_dialog_content"
						,"std" 		=> '[contact-form-7 id="4" title="Contact form 1"]'
						,"fold"		=> "wd_show_feedback_button"
						,"type" 	=> "textarea"
						
				);	

$of_options[] = array( 	"name" 		=> "Catalog Mod"
						,"desc" 	=> ""
						,"id" 		=> "introduction_catalog_mod"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Catalog Mod</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Enable Catalog Mod"
						,"desc" 	=> "Enable/Disable Catalog Mod(Hide All \"Add To Cart\" button on your site)"
						,"id" 		=> "wd_enable_catalog_mod"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);				
/* RIGHT TO LEFT */				
$of_options[] = array( 	"name" 		=> "Right To Left"
						,"desc" 	=> ""
						,"id" 		=> "wd_right_to_left"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Right To Left</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Enable Right To Left"
						,"desc" 	=> "Enable/Disable Right To Left"
						,"id" 		=> "wd_enable_right_to_left"
						,"on"		=> "Enable"
						,"off"		=> "Disable"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);														
				
/***************** TODO : STYLE ****************/					
				
$of_options[] = array( 	"name" 		=> "Styling Options"
						,"type" 	=> "heading"
				);
		
$of_options[] = array( 	"name" 		=> "Preview Panel"
						,"desc" 	=> "Preview Panel allow you to view,change style on frontend"
						,"id" 		=> "wd_preview_panel"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);
			
/*$of_options[] = array( 	"name" 		=> "Enable NiceScroll"
						,"desc" 	=> "Enable Nice Scroll Bar on the right browsers"
						,"id" 		=> "wd_nicescroll"
						,"std" 		=> 0
						,"type" 	=> "switch"
				);*/

$of_options[] = array( 	"name" 		=> "Enable Sticky Menu"
						,"desc" 	=> "Enable Sticky Menu on top pages"
						,"id" 		=> "wd_sticky_menu"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Enable Back Product Image"
						,"desc" 	=> "Show Back Product Image on hover"
						,"id" 		=> "wd_effect_product"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Enable Effect Product Image Hover"
						,"desc" 	=> "Show Background above Product Image on hover"
						,"id" 		=> "wd_effect_product_hover"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Layout Style"
						,"desc" 	=> ""
						,"id" 		=> "wd_layout_styles"
						,"std" 		=> "wide"
						,"type" 	=> "select"
						,"options"	=> array("wide","box")
				);				
				
$of_options[] = array( 	"name" 		=> "Theme Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_them_color"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Theme Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);					
				
		
$of_options[] = array( 	"name" 		=> "Theme Primary Scheme Color"
						,"desc" 	=> "Change Tini Cart, Tab Heading, Logo, Shortcode Heading border color ..."
						,"id" 		=> "wd_theme_color_primary"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Theme Secondary Scheme Color"
						,"desc" 	=> "Change Feedback button, Scroll To Top button, Product Detail title ..."
						,"id" 		=> "wd_theme_color_secondary"
						,"std" 		=> "#333333"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Main Content Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_main_content_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
									

$of_options[] = array( 	"name" 		=> "Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Text Weak Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_weak_color"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Link Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_color"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);		

$of_options[] = array( 	"name" 		=> "Link Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_color_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);
/**************************************** SLIDESHOW **********************************************/
				
				
/* ***********************************************************************************************/		
$of_options[] = array( 	"name" 		=> "Header Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_header_color_scheme"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);			
$of_options[] = array( 	"name" 		=> "Top Header Background"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_background"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Top Header Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Top Header Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_top_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Middle Header Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_middle_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Middle Header Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_header_middle_text_color"
						,"std" 		=> "#7a7a7a"
						,"type" 	=> "color"
				);						
/* ***********************************************************************************************/					

$of_options[] = array( 	"name" 		=> "Menu Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_menu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Menu Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);					
				
$of_options[] = array( 	"name" 		=> "Header Menu Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	
$of_options[] = array( 	"name" 		=> "Menu Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_text_color"
						,"std" 		=> "#333333"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Header Menu Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_border"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Header Menu Border Top Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_border_top"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Header Menu Border Bottom Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_border_bottom"
						,"std" 		=> "#c1c1c1"
						,"type" 	=> "color"
				);					
			
$of_options[] = array( 	"name" 		=> "Header Menu Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_background_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);					
	
$of_options[] = array( 	"name" 		=> "Menu Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_text_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Menu Border Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_menu_border_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);

/* ***********************************************************************************************/
				
$of_options[] = array( 	"name" 		=> "Sub Menu Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_submenu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sub Menu Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);									
		
$of_options[] = array( 	"name" 		=> "Sub Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_text_color"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Sub Text Hover Color "
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_text_color_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Sub Border"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_border"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sub_menu_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);					

/* ***********************************************************************************************/
$of_options[] = array( 	"name" 		=> "Phone Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Phone Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	

				
$of_options[] = array( 	"name" 		=> "Phone Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_background"
						,"std" 		=> "#1d1f24"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Phone Sub Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_background_hover"
						,"std" 		=> "#131519"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Phone Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_phone_text_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);						


/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Primary Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Primary Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
$of_options[] = array( 	"name" 		=> "Special Color"
						,"desc" 	=> "input Place order (page checkout),availability:In stock,input Processd to checkout (page cart)"
						,"id" 		=> "wd_special_color"
						,"std" 		=> "#1bb289"
						,"type" 	=> "color"
				);							
$of_options[] = array( 	"name" 		=> "Blog Background Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_background_blog_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);				
$of_options[] = array( 	"name" 		=> "Title Border Color"
						,"desc" 	=> "Border for title shortcode (product,tab,recent post,..)... "
						,"id" 		=> "wd_title_border_color"
						,"std" 		=> "#e5e5e5"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Border Input Color"
						,"desc" 	=> "input border(table,text,select,...),product hover... "
						,"id" 		=> "wd_input_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);	
				
$of_options[] = array( 	"name" 		=> "Border Input Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_input_border_color_hover"
						,"std" 		=> "#aaaaaa"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Box Border Color"
						,"desc" 	=> "Border for box comment,box author,.. "
						,"id" 		=> "wd_box_border_color"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
					);						
$of_options[] = array( 	"name" 		=> "Slider Button"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Button Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Button Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_text"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);			
$of_options[] = array( 	"name" 		=> "Button Icon Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_icon_color"
						,"std" 		=> "#868686"
						,"type" 	=> "color"
				);				
$of_options[] = array( 	"name" 		=> "Button Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_border"
						,"std" 		=> "#cccccc"
						,"type" 	=> "color"
				);			
$of_options[] = array( 	"name" 		=> "Button Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);				
$of_options[] = array( 	"name" 		=> "Button Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Button Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_background_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);					
$of_options[] = array( 	"name" 		=> "Slider Navi Icon Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_icon"
						,"std" 		=> "#666666"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Slider Navi Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_border"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Slider Navi Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Slider Navi Icon Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_icon_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Slider Navi Border Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_border_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Slider Navi Background Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slider_background_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "SlideShow Navi"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Slideshow Navi Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
$of_options[] = array( 	"name" 		=> "SlideShow Navi Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slideshow_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "SlideShow Navi Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_button_slideshow_color_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Text"
						,"desc" 	=> "custom color for text of tag"
						,"id" 		=> "wd_tag_text"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Border Color"
						,"desc" 	=> "custom color for border text of tag"
						,"id" 		=> "wd_tag_border"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Background Color"
						,"desc" 	=> "custom color for background of tag"
						,"id" 		=> "wd_tag_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_tag_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Border Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_tag_border_hover"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Tag Background Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_tag_background_hover"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Portfolio Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Portfolio Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Portfolio Link Title Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_title_portfolio"
						,"std" 		=> "#333333"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Portfolio Link Title Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_link_title_portfolio_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Portfolio Image Background Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_portfolio_background_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				
				
$of_options[] = array( 	"name" 		=> "Portfolio Button Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_portfolio_button_icon"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Portfolio Button Icon Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_portfolio_button_icon_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Portfolio Button Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_portfolio_button_background_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
				

/* ************************************** Quickshop **********************************************/
if ( in_array( 'wd_quickshop/wd_quickshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	$of_options[] = array( 	"name" 		=> "Quickshop Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_quickshop"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Quickshop Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
	$of_options[] = array( 	"name" 		=> "Quickshop Text Color"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_text_color"
							,"std" 		=> "#ffffff"
							,"type" 	=> "color"
					);
					
	$of_options[] = array( 	"name" 		=> "Quickshop Text Color Hover"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_text_color_hover"
							,"std" 		=> "#ffffff"
							,"type" 	=> "color"
					);
	
	$of_options[] = array( 	"name" 		=> "Quickshop Background Color Hover"
							,"desc" 	=> ""
							,"id" 		=> "wd_quickshop_background_hover"
							,"std" 		=> "#000000"
							,"type" 	=> "color"
					);	
}

/* ***************************************** Advertisement ****************************************/
/*$of_options[] = array( 	"name" 		=> "Advertisement Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_advertisement"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Advertisement Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Advertisement Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_background_advertisement"
						,"std" 		=> "#fff0c2"
						,"type" 	=> "color"
				);*/
/* ***********************************************************************************************/

$of_options[] = array( 	"name" 		=> "Product Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_cart"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Product Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
$of_options[] = array( 	"name" 		=> "Background Product Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_background_product_hover"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Product Name Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_product_name_color"
						,"std" 		=> "#333333"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Text Price Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_price_color"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Rating Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_rating_color"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Rating Color - Rated"
						,"desc" 	=> ""
						,"id" 		=> "wd_rating_color_star"
						,"std" 		=> "#ffc600"
						,"type" 	=> "color"
				);					
				 
$of_options[] = array( 	"name" 		=> "Sale Price Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_text_price_sale_color"
						,"std" 		=> "#888888"
						,"type" 	=> "color"
				);	

$of_options[] = array( 	"name" 		=> "Sale Label Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_sale"
						,"std" 		=> "#72b728"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Sale Label Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_text_sale"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	

$of_options[] = array( 	"name" 		=> "Hot Label Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_hot"
						,"std" 		=> "#f92136"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Hot Label Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_text_hot"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Feature New Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_new"
						,"std" 		=> "#00a2ff"
						,"type" 	=> "color"
				);	
$of_options[] = array( 	"name" 		=> "Feature New Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_feature_text_new"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);	
$of_options[] = array( 	"name" 		=> "Label Sale Of Product Title Background Color" 
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_sale_background"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Sale Of Product Title Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_sale_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);

$of_options[] = array( 	"name" 		=> "Label Hot Of Product Title Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_hot_background"
						,"std" 		=> "#ffb400"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Hot Of Product Title Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_hot_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label New Of Product Title Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_new_background"
						,"std" 		=> "#2cc005"
						,"type" 	=> "color"
				);
			
$of_options[] = array( 	"name" 		=> "Label New Of Product Title Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_new_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Feature Of Product Title Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_feature_background"
						,"std" 		=> "#0072ff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Feature Of Product Title Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_title_feature_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Of Shorcode Recommend Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_top_recommend_background"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Label Of Shorcode Recommend Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_label_top_recommend_text"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
/******************************************* Social Icon Color Scheme *********************************************/
$of_options[] = array( 	"name" 		=> "Social Icon Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "social_icon_color_scheme"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Social Icon Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Social Icon Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_icon_color"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Social Icon Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_icon_color_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Social Icon Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_icon_background"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Social Icon Background Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_social_icon_background_hover"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);
/* ************************************************** SIDEBAR ***************************************************/
$of_options[] = array( 	"name" 		=> "Sidebar Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_sidebar_color_scheme"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sidebar Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Sidebar Heading Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_sidebar_border"
						,"std" 		=> "#d9d9d9"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Sidebar Heading Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_heading_sidebar_color"
						,"std" 		=> "#000000"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Sidebar Heading Line Top Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_heading_sidebar_line_top"
						,"std" 		=> "#f23534"
						,"type" 	=> "color"
				);

/* ****************************************************************************************************************/
$of_options[] = array( 	"name" 		=> "Footer Color Scheme"
						,"desc" 	=> ""
						,"id" 		=> "introduction_footer_color_scheme"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Footer Color Scheme</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Footer Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_background"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Middle Footer Background Color"
						,"desc" 	=> "Set background color for Fourth, Fifth, Sixth Footer Widget Area"
						,"id" 		=> "wd_footer_middle_background"
						,"std" 		=> "#1d1f24"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Middle Footer Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_middle_text"
						,"std" 		=> "#999999"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Middle Footer Heading Text Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_middle_heading"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "End Footer Area Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_end_background"
						,"std" 		=> "#22252c"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Text"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_text"
						,"std" 		=> "#888a91"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Border Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_border"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Background Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_background"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Text Hover Color"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_text_hover"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Border Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_border_hover"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
$of_options[] = array( 	"name" 		=> "Footer Tag Background Color Hover"
						,"desc" 	=> ""
						,"id" 		=> "wd_footer_tag_background_hover"
						,"std" 		=> "#383c48"
						,"type" 	=> "color"
				);
		
/***************** TODO : TYPO ****************/		

$of_options[] = array( 	"name" 		=> "Typography"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-typography.gif"
				);
		
$of_options[] = array( 	"name" 		=> "Body Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_bodyfont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Body Font Options</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
					
$of_options[] = array( 	"name" 		=> "Body font with Google font"
						,"desc" 	=> "Using google font for your body font"
						,"id" 		=> "wd_body_font_googlefont_enable"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Body Font"
						,"desc" 	=> "Specify the body font properties.Using in case google font disabled"
						,"id" 		=> "wd_body_font_family"
						,"position"	=> "left"
						,"fold"		=> "wd_body_font_googlefont_enable"
						,"std" 		=> "Arial"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
									
					
$of_options[] = array( 	"name" 		=> "Body Google Font"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_body_font_googlefont"
						,"position"	=> "right"
						,"std" 		=> 'Open Sans'
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_body_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my body font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);		

/* ================================= Body second font ==================================== */
$of_options[] = array( 	"name" 		=> "Body Second Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_bodysecondfont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Body Second Font Options</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
					
$of_options[] = array( 	"name" 		=> "Body second font with Google font"
						,"desc" 	=> "Using google font for your body second font"
						,"id" 		=> "wd_body_second_font_googlefont_enable"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Body Second Font"
						,"desc" 	=> "Specify the body second font properties.Using in case google font disabled"
						,"id" 		=> "wd_body_second_font_family"
						,"position"	=> "left"
						,"fold"		=> "wd_body_second_font_googlefont_enable"
						,"std" 		=> "Arial"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
									
					
$of_options[] = array( 	"name" 		=> "Body Second Google Font"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_body_second_font_googlefont"
						,"position"	=> "right"
						,"std" 		=> "Roboto Condensed"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_body_second_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my body second font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
	
/* =============================== Menu font ====================================== */			
$of_options[] = array( 	"name" 		=> "Menu Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_menufont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Menu Font Options</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);	
				
$of_options[] = array( 	"name" 		=> "Menu font with Google font"
						,"desc" 	=> "Using google font for your top menu font"
						,"id" 		=> "wd_menu_font_googlefont_enable"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Menu Font"
						,"desc" 	=> "Specify the menu font properties.Using in case google font disabled"
						,"id" 		=> "wd_menu_fontfamily"
						,"position"	=> "left"
						,"fold"		=> "wd_menu_font_googlefont_enable"
						,"std" 		=> "Arial"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Menu Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_menu_font_googlefont"
						,"std" 		=> "Roboto Condensed"
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_menu_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my menu font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
/* ======================================= Submenu font ================================================ */
$of_options[] = array( 	"name" 		=> "Sub Menu Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_submenufont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Sub Menu Font Options</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Font with Google font"
						,"desc" 	=> "Using google font for your sub menu font"
						,"id" 		=> "wd_sub_menu_font_googlefont_enable"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Sub Menu Default Font"
						,"desc" 	=> "Specify the Sub menu font properties.Using in case google font disabled"
						,"id" 		=> "wd_sub_menu_fontfamily"
						,"std" 		=> 'Arial'
						,"position"	=> "left"
						,"fold"		=> "wd_sub_menu_font_googlefont_enable"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Sub Menu Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_sub_menu_font_googlefont"
						,"std" 		=> 'Open Sans'
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_sub_menu_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my Sub menu font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	
/* ===================================== Price font =============================================== */				
$of_options[] = array( 	"name" 		=> "Price Font"
						,"desc" 	=> ""
						,"id" 		=> "introduction_pricefont"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Price Font Options</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Price Font with Google font"
						,"desc" 	=> "Using google font for your price font"
						,"id" 		=> "wd_price_font_googlefont_enable"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on" 		=> "Family Font"
						,"off" 		=> "Google Font"
						,"type" 	=> "switchs"
				);
					
$of_options[] = array( 	"name" 		=> "Price Default Font"
						,"desc" 	=> "Specify the price font properties.Using in case google font disabled"
						,"id" 		=> "wd_price_fontfamily"
						,"std" 		=> 'Arial'
						,"position"	=> "left"
						,"fold"		=> "wd_price_font_googlefont_enable"
						,"type" 	=> "select"
						,"options"	=> $faces
				);					
					
$of_options[] = array( 	"name" 		=> "Price Google Font Select"
						,"desc" 	=> "This font going to overwrite the default font."
						,"id" 		=> "wd_price_font_googlefont"
						,"std" 		=> 'Open Sans'
						,"position"	=> "right"
						,"type" 	=> "select_google_font"
						,"fold"		=> "wd_price_font_googlefont_enable"
						,"preview" 	=> array(
										"text" => "This is my price font preview!"
										,"size" => "30px"
						)
						,"options" 	=> $wd_google_fonts
				);	

/***************** TODO : STYLE HEADER ****************/					
				
$of_options[] = array( 	"name" 		=> "Header"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);

$of_options[] = array( 	"name" 		=> "Header Layout"
						,"id" 		=> "wd_header_layout"
						,"std" 		=> "v1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'v1' 	=> $url . 'header/header_v1.jpg'
							,'v2' 	=> $url . 'header/header_v2.jpg'
							,'v3' 	=> $url . 'header/header_v3.jpg'
							,'v4' 	=> $url . 'header/header_v4.jpg'
							,'v5' 	=> $url . 'header/header_v5.jpg'
						)
				);				

$of_options[] = array( 	"name" 		=> "Header Top Left"
						,"desc" 	=> ""
						,"id" 		=> "introduction_header"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header Top Left</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);		

$of_options[] = array( 	"name" 		=> "Header Text Shipping "
						,"desc" 	=> "Change your text."
						,"id" 		=> "wd_text_shipping"
						,"std" 		=> 'Free shipping'
						,"type" 	=> "text"
				);					

$of_options[] = array( 	"name" 		=> "Header Phone"
						,"desc" 	=> "Change your phone."
						,"id" 		=> "wd_phone"
						,"std" 		=> '010 456 213 987'
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Header HotLine"
						,"desc" 	=> "Change your HotLine."
						,"id" 		=> "wd_hotline"
						,"std" 		=> '010 456 222 333'
						,"type" 	=> "text"
				);					

$of_options[] = array( 	"name" 		=> "Header Top Right Social Icon"
						,"desc" 	=> ""
						,"id" 		=> "introduction_header"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Header top Social icon</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);

$of_options[] = array( 	"name" 		=> "Enable Facebook"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_facebook"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);

$of_options[] = array( 	"name" 		=> "Facebook"
						,"desc" 	=> "Change your Facebook ID."
						,"id" 		=> "wd_facebook_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_facebook"
						,"type" 	=> "text"
				);	
				
$of_options[] = array( 	"name" 		=> "Enable Twitter"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_twitter"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);
				
$of_options[] = array( 	"name" 		=> "Twitter"
						,"desc" 	=> "Change your Twitter ID."
						,"id" 		=> "wd_twitter_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_twitter"
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Enable Flickr"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_flickr"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);
$of_options[] = array( 	"name" 		=> "Flickr"
						,"desc" 	=> "Change your Flickr ID."
						,"id" 		=> "wd_flickr_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_flickr"
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Enable Google"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_google"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);
$of_options[] = array( 	"name" 		=> "Google"
						,"desc" 	=> "Change your Google ID."
						,"id" 		=> "wd_google_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_google"
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Enable Rss"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_rss"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);
$of_options[] = array( 	"name" 		=> "Rss"
						,"desc" 	=> "Change your Rss ID."
						,"id" 		=> "wd_rss_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_rss"
						,"type" 	=> "text"
				);
$of_options[] = array( 	"name" 		=> "Enable Vimeo"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_vimeo"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
						);
$of_options[] = array( 	"name" 		=> "Vimeo"
						,"desc" 	=> "Change your Vimeo ID."
						,"id" 		=> "wd_vimeo_id"
						,"std" 		=> ''
						,"fold"		=> "wd_enable_vimeo"
						,"type" 	=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom icon class"
						,"desc" 	=> "Add FontAwesome class. Ex: fa-facebook"
						,"id" 		=> "wd_custom_social_icon_class"
						,"std" 		=> ''
						,"type" 	=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom icon link"
						,"desc" 	=> "Ex: https://facebook.com/"
						,"id" 		=> "wd_custom_social_icon_link"
						,"std" 		=> ''
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Custom icon class 2"
						,"desc" 	=> "Add FontAwesome class. Ex: fa-facebook"
						,"id" 		=> "wd_custom_social_icon_class_2"
						,"std" 		=> ''
						,"type" 	=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Custom icon link 2"
						,"desc" 	=> "Ex: https://facebook.com/"
						,"id" 		=> "wd_custom_social_icon_link_2"
						,"std" 		=> ''
						,"type" 	=> "text"
				);				
				
$of_options[] = array( 	"name" 		=> "Middle Header"
						,"desc" 	=> ""
						,"id" 		=> "introduction_header"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Middle Header</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				

$of_options[] = array( 	"name" 		=> "Enable Middle Header Custom Code"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_middle_header_custom_code"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Middle Header Custom Code"
						,"desc" 	=> "Input Html/Js Code. Only Support Header Layout Version #1 & #3"
						,"id" 		=> "wd_middle_header_custom_code"
						,"std" 		=> '<a class="wd-effect-mirror" title="oswad" href="#"><img src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/header-banner-middle.png" alt="oswad market" title="oswad market" /></a>'
						,"fold"		=> "wd_enable_middle_header_custom_code"
						,"type" 	=> "textarea"
				);	
$of_options[] = array( 	"name" 		=> "Enable Header Search"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_header_search"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Enable Header Search On Mobile"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_header_search_on_mobile"
						,"std" 		=> 1
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Breadcrumbs"
						,"desc" 	=> ""
						,"id" 		=> "introduction_breadcrumbs"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Breadcrumbs</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
				
$of_options[] = array( 	"name" 		=> "Breadcrumbs background"
						,"desc" 	=> ""
						,"id" 		=> "wd_bg_breadcrumbs"
						,"std"		=> $df_bg_breadcrumbs
						,"type" 	=> "upload"
					);
				
/***************** TODO : STYLE FOOTER ****************/
$of_options[] = array( 	"name" 		=> "Footer"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);

$of_options[] = array( 	"name" 		=> "Show First Footer Widget Area"
						,"desc" 	=> "Show/Hide First Footer Widget Area"
						,"id" 		=> "wd_show_first_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Show Second Footer Widget Area"
						,"desc" 	=> "Show/Hide Second Footer Widget Area"
						,"id" 		=> "wd_show_second_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Show Third Footer Widget Area"
						,"desc" 	=> "Show/Hide Third Footer Widget Area"
						,"id" 		=> "wd_show_third_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Show Fourth Footer Widget Area(Footer Subscrible)"
						,"desc" 	=> "Show/Hide Fourth Footer Widget Area"
						,"id" 		=> "wd_show_fourth_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Background Fourth Footer Widget Area"
						,"desc" 	=> "Change your Background Fourth Footer Widget Area."
						,"id" 		=> "wd_bg_third_footer_widget_area"
						,"std"		=> $df_bg_third_footer_widget
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Enable Background Fourth Footer Widget Area"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_bg_color_third_footer_widget_area"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);						
					
$of_options[] = array( 	"name" 		=> "Background Color Fourth Footer Widget Area"
						,"desc" 	=> "Change your Background Color Fourth Footer Widget Area."
						,"id" 		=> "wd_bg_color_third_footer_widget_area"
						,"fold"		=> "wd_enable_bg_color_third_footer_widget_area"
						,"std" 		=> "#ffffff"
						,"type" 	=> "color"
					);	
$of_options[] = array( 	"name" 		=> "Show Fifth Footer Widget Area"
						,"desc" 	=> "Show/Hide Fifth Footer Widget Area"
						,"id" 		=> "wd_show_fifth_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Show Sixth Footer Widget Area"
						,"desc" 	=> "Show/Hide Sixth Footer Widget Area"
						,"id" 		=> "wd_show_sixth_footer_widget_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Show End Footer Area"
						,"desc" 	=> "Show/Hide End Footer Area (Copyright and Payment)"
						,"id" 		=> "wd_show_end_footer_area"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);		
$of_options[] = array( 	"name" 		=> "Copyright Section"
						,"desc" 	=> ""
						,"id" 		=> "introduction_custom_copyright"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Copyright Section</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);				
				
$of_options[] = array( 	"name" 		=> "Footer Copyright"
						,"desc" 	=> "You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]"
						,"id" 		=> "footer_text"
						,"std" 		=> 'Copyright &copy; 2014 Oswad . Designed by <a href="http://wpdance.com/" title=""> WPDance.com</a>'
						,"type" 	=> "textarea"
				);
$of_options[] = array( 	"name" 		=> "Payment icon"
						,"desc" 	=> ""
						,"id" 		=> "introduction_checkout"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Payment icon</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Show Payment image 1"
						,"desc" 	=> "Show/Hide Payment image 1"
						,"id" 		=> "wd_show_payment_image_1"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);				
$of_options[] = array( 	"name" 		=> "Payment image 1"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_1"
						,"std"		=> $df_payment_images_1_uri
						,"fold"		=> "wd_show_payment_image_1"
						,"type" 	=> "upload"
				);		
$of_options[] = array( 	"name" 		=> "Show Payment image 2"
						,"desc" 	=> "Show/Hide Payment image 2"
						,"id" 		=> "wd_show_payment_image_2"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);					
$of_options[] = array( 	"name" 		=> "Payment image 2"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_2"
						,"std"		=> $df_payment_images_2_uri
						,"fold"		=> "wd_show_payment_image_2"
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Show Payment image 3"
						,"desc" 	=> "Show/Hide Payment image 3"
						,"id" 		=> "wd_show_payment_image_3"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Payment image 3"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_3"
						,"fold"		=> "wd_show_payment_image_3"
						,"std"		=> $df_payment_images_3_uri
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Show Payment image 4"
						,"desc" 	=> "Show/Hide Payment image 4"
						,"id" 		=> "wd_show_payment_image_4"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Payment image 4"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_4"
						,"std"		=> $df_payment_images_4_uri
						,"fold"		=> "wd_show_payment_image_4"
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Show Payment image 5"
						,"desc" 	=> "Show/Hide Payment image 5"
						,"id" 		=> "wd_show_payment_image_5"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Payment image 5"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_5"
						,"fold"		=> "wd_show_payment_image_5"
						,"std"		=> $df_payment_images_5_uri
						,"type" 	=> "upload"
				);
$of_options[] = array( 	"name" 		=> "Show Payment image 6"
						,"desc" 	=> "Show/Hide Payment image 6"
						,"id" 		=> "wd_show_payment_image_6"
						,"std" 		=> 1
						,"type" 	=> "switch"
				);	
$of_options[] = array( 	"name" 		=> "Payment image 6"
						,"desc" 	=> "Change your image."
						,"id" 		=> "wd_payment_image_6"
						,"fold"		=> "wd_show_payment_image_6"
						,"std"		=> $df_payment_images_6_uri
						,"type" 	=> "upload"
				);

/***************** TODO : Menu ****************/		

$of_options[] = array( 	"name" 		=> "Menu Options"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "slider-control.png"
				);
					
$of_options[] = array( 	"name" 		=> "Mega Menu"
						,"desc" 	=> ""
						,"id" 		=> "introduction_mega_menu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Mega Menu</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Menu Thumbnail Size"
						,"desc" 	=> "Thumbnail width.<br /> Min: 5, max: 48, step: 1, default value: 16"
						,"id" 		=> "wd_menu_thumb_width"
						,"std" 		=> "16"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "48"
						,"type" 	=> "sliderui" 
				);
				
$of_options[] = array( 	"name" 		=> ""
						,"desc" 	=> "Thumbnail height.<br /> Min: 5, max: 48, step: 1, default value: 16"
						,"id" 		=> "wd_menu_thumb_height"
						,"std" 		=> "16"
						,"min" 		=> "5"
						,"step"		=> "1"
						,"max" 		=> "48"
						,"type" 	=> "sliderui" 
				);		

$of_options[] = array( 	"name" 		=> "Mega Menu Widget Area"
						,"desc" 	=> "Number Widget Area Available.<br /> Min: 1, max: 30, step: 1, default value: 5"
						,"id" 		=> "wd_menu_num_widget"
						,"std" 		=> "5"
						,"min" 		=> "1"
						,"step"		=> "1"
						,"max" 		=> "30"
						,"type" 	=> "sliderui" 
				);				
$of_options[] = array( 	"name" 		=> "Main Menu"
						,"desc" 	=> ""
						,"id" 		=> "introduction_main_menu"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Main Menu</h3>"
						,"icon" 	=> true
						,"type" 	=> "info"
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Show Effect"
						,"desc" 	=> "Specify the effect when hover main menu"
						,"id" 		=> "wd_sub_menu_show_effect"
						,"position" => "left"
						,"std" 		=> "dropdown"
						,"type" 	=> "select"
						,"options"	=> array(
							"dropdown" => "Dropdown"
							,"bottom_to_top" => "Bottom To Top"
							,"left_to_right" => "Left To Right"
							,"right_to_left" => "Right To Left"
						)
				);
$of_options[] = array( 	"name" 		=> "Sub Menu Show Duration"
						,"desc" 	=> "Input duration to show sub menu. In ms"
						,"id" 		=> "wd_sub_menu_show_duration"
						,"std" 		=> "200"
						,"type" 	=> "text"
					);

/***************** TODO : Quickshop ****************/		

/**
 * Check if WD Quickshop is active
 **/

if ( in_array( 'wd_quickshop/wd_quickshop.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	$df_qs_images_uri = get_stylesheet_directory_uri(). '/images/quickshop.png'; 

	$of_options[] = array( 	"name" 		=> "Quickshop Options"
							,"type" 	=> "heading"
							,"icon"		=> ADMIN_IMAGES . "icon-settings.png"
					);		

	$of_options[] = array( 	"name" 		=> "Button Label"
							,"desc" 	=> "Change button label"
							,"id" 		=> "wd_qs_button_label"
							,"std" 		=> __("","wpdance")
							,"type" 	=> "text"
					);	

	$of_options[] = array( 	"name" 		=> "Button image"
							,"desc" 	=> "Change your button image.Leave blank to use button label"
							,"id" 		=> "wd_qs_button_imgage"
							,"std"		=> $df_qs_images_uri
							,"type" 	=> "upload"
					);	

	$of_options[] = array( 	"name" 		=> "Product Title"
							,"desc" 	=> "Show/hide product title"
							,"id" 		=> "wd_qs_product_title"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Label"
							,"desc" 	=> "Show/hide product label"
							,"id" 		=> "wd_qs_product_label"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Availability"
							,"desc" 	=> "Show/hide product availability"
							,"id" 		=> "wd_qs_product_availability"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product SKU"
							,"desc" 	=> "Show/hide product sku"
							,"id" 		=> "wd_qs_product_sku"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Rating"
							,"desc" 	=> "Show/hide product rating"
							,"id" 		=> "wd_qs_product_rating"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Short Description"
							,"desc" 	=> "Show/hide product short description"
							,"id" 		=> "wd_qs_product_short_description"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
	$of_options[] = array( 	"name" 		=> "Product Add To Cart"
							,"desc" 	=> "Show/hide product add to cart"
							,"id" 		=> "wd_qs_product_add_to_cart"
							,"std" 		=> 1
							,"on" 		=> "Show"
							,"off" 		=> "Hide"
							,"type" 	=> "switch"
					);
		
}

		
				
/***************** TODO : Advertisement ****************/		

/*
$of_options[] = array( 	"name" 		=> "Advertisement"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-edit.png"
				);
				
$of_options[] = array( 	"name" 		=> "Enable Advertisement"
						,"desc" 	=> ""
						,"id" 		=> "wd_enable_advertisement"
						,"std" 		=> 0
						,"folds"	=> 1
						,"on"		=> "yes"
						,"off"		=> "no"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Advertisement Code"
						,"desc" 	=> "Input Html/Js Advertisement Code."
						,"id" 		=> "wd_advertisement_code"
						,"std" 		=> '<div class="wd-shipping"><a style="color:#00387f" class="shipping" href="#">Free shipping for over $200.00 orders</a><a style="color:#c30005" class="gifts" href="#">Gifts for over $100 orders </a></div>
<ul class="menu-advertisment">
										<li><a href="#">$5 DVDs</a></li>
										<li><a href="#">$10 Blu-ray Discs</a></li>
										<li><a href="#">Preorders</a></li>
										<li><a class="wd-important" href="#">Deals</a></li>
										</ul>'
						,"fold"		=> "wd_enable_advertisement"
						,"type" 	=> "textarea"
				);	
*/		
				
				
/***************** TODO : Integration ****************/	
			
$of_options[] = array( 	"name" 		=> "Integration"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-add.png"
				);			
	
$of_options[] = array( 	"name" 		=> "Top Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to top of blog details by adding it to this block."
						,"id" 		=> "wd_top_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Bottom Blog Details Codes"
						,"desc" 	=> "Quickly add some html/css to bottom of blog details by adding it to this block."
						,"id" 		=> "wd_bottom_blog_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);

$of_options[] = array( 	"name" 		=> "Before Body End Code"
						,"desc" 	=> "Quickly add some html/css adding it to this block."
						,"id" 		=> "wd_before_body_end_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);				
	
$of_options[] = array( 	"name" 		=> "Google Analytic Code"
						,"desc" 	=> "Quickly add some html/css adding it to this block."
						,"id" 		=> "wd_google_analytic_code"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);	
/*	
$of_options[] = array( 	"name" 		=> "Custom CSS"
						,"desc" 	=> "Quickly add some CSS to your theme by adding it to this block."
						,"id" 		=> "wd_custom_css"
						,"std" 		=> ""
						,"type" 	=> "textarea"
				);
*/	
/***************** TODO : Shop Shortcode Slider Options ****************/	
$of_options[] = array( 	"name" 		=> "Shop Shortcode Slider"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "slider-control.png"
				);	
$of_options[] = array( 	"name" 		=> "Slide Speed on PC"
						,"desc" 	=> "In ms, default is 800"
						,"id" 		=> "wd_shop_slider_slide_speed_pc"
						,"std" 		=> "800"
						,"type" 	=> "text"
					);
$of_options[] = array( 	"name" 		=> "Slide Speed on Mobile"
						,"desc" 	=> "In ms, default is 200"
						,"id" 		=> "wd_shop_slider_slide_speed_mobile"
						,"std" 		=> "200"
						,"type" 	=> "text"
					);
$of_options[] = array( 	"name" 		=> "Scroll Per Page"
						,"desc" 	=> "Enable/Disable scroll per page"
						,"id" 		=> "wd_shop_slider_scroll_per_page"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Infinity Loop"
						,"desc" 	=> "Enable/Disable Infinity Loop"
						,"id" 		=> "wd_shop_slider_infinity_loop"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Rewind Navigation"
						,"desc" 	=> "Enable/Disable Slide to First Item. This option is available when Infinity Loop is Disable"
						,"id" 		=> "wd_shop_slider_rewind_nav"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Auto Play"
						,"desc" 	=> "Enable/Disable Auto Play"
						,"id" 		=> "wd_shop_slider_auto_play"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Stop on hover"
						,"desc" 	=> "Enable/Disable Stop autoplay on mouse hover"
						,"id" 		=> "wd_shop_slider_stop_on_hover"
						,"std" 		=> 0
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"fold" 	=> "wd_shop_slider_auto_play"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Mouse Drag"
						,"desc" 	=> "Enable/Disable Mouse Drag"
						,"id" 		=> "wd_shop_slider_mouse_drag"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Touch Drag"
						,"desc" 	=> "Enable/Disable Touch Drag"
						,"id" 		=> "wd_shop_slider_touch_drag"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);
					
								
/***************** TODO : Product Category Options ****************/							
$of_options[] = array( 	"name" 		=> "Product Category"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
$of_options[] = array( 	"name" 		=> "Category Columns"
						,"id" 		=> "wd_prod_cat_column"
						,"std" 		=> "4"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(2,3,4,6)
				);
$of_options[] = array( 	"name" 		=> "The Number Of Products Per Page"
                        ,"desc" 	=> "Set the number of products per page"
                        ,"id" 		=> "wd_prod_cat_per_page"
                        ,"std" 		=> 16
                        ,"type" 	=> "text"
        );				

$of_options[] = array( 	"name" 		=> "Category Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_cat_layout"
						,"std" 		=> "1-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);								

$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_cat_left_sidebar"
						,"std" 		=> "product-category-widget-area-left"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);

$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_cat_right_sidebar"
						,"std" 		=> "product-category-widget-area-right"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);
$of_options[] = array( 	"name" 		=> "Product Label"
						,"desc" 	=> "Show/hide Product Label"
						,"id" 		=> "wd_prod_cat_label"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Title Label"
						,"desc" 	=> "Show/hide Product Label Before Title"
						,"id" 		=> "wd_prod_cat_title_label"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Product Rating"
						,"desc" 	=> "Show/hide Product Rating"
						,"id" 		=> "wd_prod_cat_rating"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Categories"
						,"desc" 	=> "Show/hide Product Categories"
						,"id" 		=> "wd_prod_cat_categories"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Title"
						,"desc" 	=> "Show/hide Product Title"
						,"id" 		=> "wd_prod_cat_title"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Sku"
						,"desc" 	=> "Show/hide Product Sku"
						,"id" 		=> "wd_prod_cat_sku"
						,"std" 		=> 0
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
$of_options[] = array( 	"name" 		=> "Product Discription on Grid Mode"
						,"desc" 	=> "Show/hide Discription on Grid Mode"
						,"id" 		=> "wd_prod_cat_disc_grid"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Number of Words in Discription on Grid Mode"
						,"desc" 	=> "It is also used by product shortcode. Input -1 to show all"
						,"id" 		=> "wd_prod_cat_word_disc_grid"
						,"std" 		=> "6"
						,"type" 	=> "text"
					);
				
$of_options[] = array( 	"name" 		=> "Product Discription on List Mode"
						,"desc" 	=> "Show/hide Product Discription on List Mode"
						,"id" 		=> "wd_prod_cat_disc_list"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Number of Words in Discription on List Mode"
						,"desc" 	=> "Input -1 to show all"
						,"id" 		=> "wd_prod_cat_word_disc_list"
						,"std" 		=> "40"
						,"type" 	=> "text"
					);
				
$of_options[] = array( 	"name" 		=> "Product Price"
						,"desc" 	=> "Show/hide Product Price"
						,"id" 		=> "wd_prod_cat_price"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Add To Cart"
						,"desc" 	=> "Show/hide Product Add To Cart Button"
						,"id" 		=> "wd_prod_cat_add_to_cart"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
				
/***************** TODO : Product Details Options ****************/	
$of_options[] = array( 	"name" 		=> "Product Details"
						,"type" 		=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);		

$of_options[] = array( 	"name" 		=> "Product Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_prod_layout"
						,"std" 		=> "1-1-0"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);	
				
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_prod_left_sidebar"
						,"std" 		=> "product-widget-area-left"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_prod_right_sidebar"
						,"std" 		=> "product-widget-area-right"
						,"type" 	=> "select"
						//,"mod"		=> "mini"
						,"options" 	=> $of_sidebars
				);				

$of_options[] = array( 	"name" 		=> "Product Image"
						,"desc" 	=> "Show/hide Product Image"
						,"id" 		=> "wd_prod_image"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Cloud-zoom"
						,"desc" 	=> "Show/hide Product Cloud-zoom"
						,"id" 		=> "wd_prod_cloudzoom"
						,"std" 		=> 1
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"type" 	=> "switch"
				);	

$of_options[] = array( 	"name" 		=> "Product Label"
						,"desc" 	=> "Show/hide Product Label"
						,"id" 		=> "wd_prod_label"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Title"
						,"desc" 	=> "Show/hide Product Title"
						,"id" 		=> "wd_prod_title"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Product Sku"
						,"desc" 	=> "Show/hide Product Sku"
						,"id" 		=> "wd_prod_sku"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Rating"
						,"desc" 	=> "Show/hide Product Rating"
						,"id" 		=> "wd_prod_rating"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);			
$of_options[] = array( 	"name" 		=> "Product Review"
						,"desc" 	=> "Show/hide Product Review"
						,"id" 		=> "wd_prod_review"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Availability"
						,"desc" 	=> "Show/hide Product Availability"
						,"id" 		=> "wd_prod_availability"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product AddToCart Button"
						,"desc" 	=> "Show/hide Product AddToCart Button"
						,"id" 		=> "wd_prod_cart"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Product Price"
						,"desc" 	=> "Show/hide Product Price"
						,"id" 		=> "wd_prod_price"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);


$of_options[] = array( 	"name" 		=> "Product Short Desc"
						,"desc" 	=> "Show/hide Product Short Desc"
						,"id" 		=> "wd_prod_shortdesc"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);



$of_options[] = array( 	"name" 		=> "Product Meta(Tags,Categories) "
						,"desc" 	=> "Show/hide Product Meta(Tags,Categories) "
						,"id" 		=> "wd_prod_meta"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"type" 	=> "switch"
				);
	

$of_options[] = array( 	"name" 		=> "Product Related Products"
						,"desc" 	=> "Show/hide Product Related Products"
						,"id" 		=> "wd_prod_related"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
	
$of_options[] = array( 	"name" 		=> "Related Product Title"
						,"id" 		=> "wd_prod_related_title"
						,"std" 		=> __('RELATED ITEMS','wpdance')
						,"fold" 	=> "wd_prod_related"
						,"type" 	=> "text"
				);			
/*				
$of_options[] = array( 	"name" 		=> "Related Product Number"
						,"desc" 	=> "Number of related products"
						,"id" 		=> "wd_prod_related_num"
						,"std" 		=> 6
						,"fold" 	=> "wd_prod_related"
						,"type" 	=> "select"
						,"mod"		=> "mini"
						,"options" 	=> array(3,4,5,6,7,8,9)
				);	*/		
$of_options[] = array( 	"name" 		=> "Product Upsell"
						,"desc" 	=> "Show/hide Product Upsell"
						,"id" 		=> "wd_prod_upsell"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);			
$of_options[] = array( 	"name" 		=> "Upsell Product Title"
						,"id" 		=> "wd_prod_upsell_title"
						,"std" 		=> __('YOU MAY ALSO LIKE','wpdance')
						,"fold" 	=> "wd_prod_upsell"
						,"type" 	=> "text"
				);			
			
$of_options[] = array( 	"name" 		=> "Product Share"
						,"desc" 	=> "Show/hide Product Social Sharing"
						,"id" 		=> "wd_prod_share"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Share"
						,"id" 		=> "wd_prod_share_title"
						,"std" 		=> __('Share thist','wpdance')
						,"fold" 	=> "wd_prod_share"
						,"type" 	=> "text"
				);	
/*
$of_options[] = array( 	"name" 		=> "Product Sharing Code"
						,"id" 		=> "wd_prod_share_code"
						,"std" 		=> "Share This"
						,"fold" 	=> "wd_prod_share"
						,"type" 	=> "textarea"
				);
*/
$of_options[] = array( 	"name" 		=> "Ship & Return Box"
						,"desc" 	=> "Show/hide Ship & Return Box"
						,"id" 		=> "wd_prod_ship_return"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds" 	=> 1
						,"type" 	=> "switch"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Title"
						,"id" 		=> "wd_prod_ship_return_title"
						,"std" 		=> ""
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Show Ship & Return Box Content"
						,"id" 		=> "wd_prod_ship_return_content"
						,"std" 		=> '<div class="wd-bottom-banner-left one_half">
										<a class="wd-effect-mirror"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/banner-bottom-product.jpg" />
										</a></div><div class="wd-bottom-banner-right one_half last">
										<a class="wd-effect-mirror"><img title="banner" alt="banner" src="http://demo2.wpdance.com/imgs/WP_Woo_OswadMarket/banner-bottom-product.jpg" /></a></div>'
						,"fold" 	=> "wd_prod_ship_return"
						,"type" 	=> "textarea"
				);
								
$of_options[] = array( 	"name" 		=> "Product Tabs"
						,"desc" 	=> "Show/hide Product Tabs"
						,"id" 		=> "wd_prod_tabs"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Description Tab"
						,"desc" 	=> "Show/hide Product Description Tab"
						,"id" 		=> "wd_prod_desc_tab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);
$of_options[] = array( 	"name" 		=> "Product Additional Information Tab"
						,"desc" 	=> "Show/hide Product Additional Information Tab"
						,"id" 		=> "wd_prod_add_info_tab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);				
$of_options[] = array( 	"name" 		=> "Product Tags Tab"
						,"desc" 	=> "Show/hide Product Tags Tab"
						,"id" 		=> "wd_prod_tags_tab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);				
				
	
$of_options[] = array( 	"name" 		=> "Product Custom Tab"
						,"desc" 	=> "Show/hide Product Custom Tab"
						,"id" 		=> "wd_prod_customtab"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"fold"		=> "wd_prod_tabs"
						,"type" 	=> "switch"
				);			
		
$of_options[] = array( 	"name" 		=> "Product Custom Tab Title"
						,"id" 		=> "wd_prod_customtab_title"
						,"std" 		=> __('Custom Tab','wpdance')
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "text"
				);

$of_options[] = array( 	"name" 		=> "Product Custom Tab Content"
						,"id" 		=> "wd_prod_customtab_content"
						,"std" 		=> "custom contents goes here"
						,"fold" 	=> "wd_prod_customtab"
						,"type" 	=> "textarea"
				);		


/***************** TODO : Blog Options ****************/	
$of_options[] = array( 	"name" 		=> "Blog Options"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Blog Categories"
						,"desc" 	=> "Show/hide Categories"
						,"id" 		=> "wd_blog_categories"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
				
$of_options[] = array( 	"name" 		=> "Blog Author"
						,"desc" 	=> "Show/hide Author"
						,"id" 		=> "wd_blog_author"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		

$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
$of_options[] = array( 	"name" 		=> "Blog Sharing"
						,"desc" 	=> "Show/hide Sharing"
						,"id" 		=> "wd_blog_sharing"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
/*	
$of_options[] = array( 	"name" 		=> "Blog Tags"
						,"desc" 	=> "Show/hide Tags"
						,"id" 		=> "wd_blog_tags"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	
*/	
			

				
$of_options[] = array( 	"name" 		=> "Blog Comment Number"
						,"desc" 	=> "Show/hide Comment Number"
						,"id" 		=> "wd_blog_comment_number"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Excerpt"
						,"desc" 	=> "Show/hide Excerpt"
						,"id" 		=> "wd_blog_excerpt"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Thumbnail"
						,"desc" 	=> "Show/hide Thumbnail"
						,"id" 		=> "wd_blog_thumbnail"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Read More"
						,"desc" 	=> "Show/hide Read More"
						,"id" 		=> "wd_blog_readmore"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);	

$of_options[] = array( 	"name" 		=> "Blog Excerpt Max Words"
						,"id" 		=> "wd_blog_excerpt_max_words"
						,"std" 		=> "125"
						,"type" 	=> "text"
				);	

$of_options[] = array( 	"name" 		=> "Blog Excerpt Strip Tags"
						,"desc" 	=> "Enable Strip Html Tags Of Blog Excerpt"
						,"id" 		=> "wd_blog_excerpt_strip_tags"
						,"on" 		=> "Enable"
						,"off" 		=> "Disable"
						,"std" 		=> 1
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);				

/***************** TODO : Blog Details ****************/
	
$of_options[] = array( 	"name" 		=> "Blog Details"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
				
$of_options[] = array( 	"name" 		=> "Blog Layout"
						,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
						,"id" 		=> "wd_blog_details_layout"
						,"std" 		=> "0-1-1"
						,"type" 	=> "images"
						,"options" 	=> array(
							'0-1-0' 	=> $url . '1col.png'
							,'0-1-1' 	=> $url . '2cr.png'
							,'1-1-0' 	=> $url . '2cl.png'
							,'1-1-1' 	=> $url . '3cm.png'
						)
				);	
				
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_blog_details_left_sidebar"
						,"std" 		=> "blog-widget-area-left"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_blog_details_right_sidebar"
						,"std" 		=> "blog-widget-area-right"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
				
$of_options[] = array( 	"name" 		=> "Blog Categories"
						,"desc" 	=> "Show/hide Categories"
						,"id" 		=> "wd_blog_details_categories"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
				
$of_options[] = array( 	"name" 		=> "Blog Author"
						,"desc" 	=> "Show/hide Author"
						,"id" 		=> "wd_blog_details_author"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		

$of_options[] = array( 	"name" 		=> "Blog Time"
						,"desc" 	=> "Show/hide Time"
						,"id" 		=> "wd_blog_details_time"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Tags"
						,"desc" 	=> "Show/hide Tags"
						,"id" 		=> "wd_blog_details_tags"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);
$of_options[] = array( 	"name" 		=> "Blog Thumbnail"
						,"desc" 	=> "Show/hide Thumbnail"
						,"id" 		=> "wd_blog_details_thumbnail"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);							
$of_options[] = array( 	"name" 		=> "Blog Comment"
						,"desc" 	=> "Show/hide Comment"
						,"id" 		=> "wd_blog_details_comment"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Social Sharing"
						,"desc" 	=> "Show/hide Social Sharing"
						,"id" 		=> "wd_blog_details_socialsharing"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Author Box"
						,"desc" 	=> "Show/hide Author Box"
						,"id" 		=> "wd_blog_details_authorbox"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);		
$of_options[] = array( 	"name" 		=> "Blog Related Posts"
						,"desc" 	=> "Show/hide Related Posts"
						,"id" 		=> "wd_blog_details_related"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);			

$of_options[] = array( 	"name" 		=> "Blog Related Label"
						,"desc" 	=> "Related Label"
						,"id" 		=> "wd_blog_details_relatedlabel"
						,"std" 		=> __("Related Posts","wpdance")
						,"fold"		=> "wd_blog_details_related"
						,"type" 	=> "text"		
					);					
$of_options[] = array( 	"name" 		=> "Blog Comment List"
						,"desc" 	=> "Show/hide Comment List"
						,"id" 		=> "wd_blog_details_commentlist"
						,"std" 		=> 1
						,"on" 		=> "Show"
						,"off" 		=> "Hide"
						,"folds"	=> 1
						,"type" 	=> "switch"		
					);						
				
$of_options[] = array( 	"name" 		=> "Blog Comment List Label"
						,"desc" 	=> "Comment List Label"
						,"id" 		=> "wd_blog_details_commentlabel"
						,"std" 		=> __("Comment","wpdance")
						,"fold"		=> "wd_blog_details_commentlist"
						,"type" 	=> "text"		
					);		

/***************** bbPress Forum *****************/
if( class_exists('bbPress') ){
	$of_options[] = array( 	"name" 		=> "Forum"
							,"type" 	=> "heading"
							,"icon"		=> ADMIN_IMAGES . "icon-slider.png"
				);
	$of_options[] = array( 	"name" 		=> "Forum Layout"
							,"desc" 	=> "Select main content and sidebar alignment. Choose between 1, 2 column layout."
							,"id" 		=> "wd_forum_layout"
							,"std" 		=> "1-1-0"
							,"type" 	=> "images"
							,"options" 	=> array(
								'0-1-0' 	=> $url . '1col.png'
								,'0-1-1' 	=> $url . '2cr.png'
								,'1-1-0' 	=> $url . '2cl.png'
								,'1-1-1' 	=> $url . '3cm.png'
							)
				);	
				
$of_options[] = array( 	"name" 		=> "Left Sidebar"
						,"id" 		=> "wd_forum_left_sidebar"
						,"std" 		=> "forum-widget-area-left"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
$of_options[] = array( 	"name" 		=> "Right Sidebar"
						,"id" 		=> "wd_forum_right_sidebar"
						,"std" 		=> "forum-widget-area-right"
						,"type" 	=> "select"
						,"options" 	=> $of_sidebars
				);	
	
	
}					
/***************** TODO : Backup Options ****************/

$of_options[] = array( 	"name" 		=> "Backup Options"
						,"type" 	=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-backup.png"
				);
				
$of_options[] = array( 	"name" 		=> "Backup and Restore Options"
						,"id" 		=> "of_backup"
						,"std" 		=> ""
						,"type" 	=> "backup"
						,"desc" 	=> 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.'
				);
				
$of_options[] = array( 	"name" 		=> "Transfer Theme Options Data"
						,"id" 		=> "of_transfer"
						,"std" 		=> ""
						,"type" 	=> "transfer"
						,"desc" 	=> 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".'
				);
				
/***************** TODO : Documentation ****************/				
				
$of_options[] = array( 	"name" 		=> "Documentation"
						,"type" 		=> "heading"
						,"icon"		=> ADMIN_IMAGES . "icon-docs.png"
				);
				
$of_options[] = array( 	"name" 		=> "Docs #1 Install"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Where is my sample data?</h3>
							Sample data is beside your package, find the file sample-data.xml"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #2"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Theme not look like the demo.</h3>
							The main problem that themeforest rules do NOT allow us to supply the image resources,so pls contact <a href=\"mailto:support@wpdance.com\">support@wpdance.com</a> with your purchase code ( <a href=\"http://themeforest.net/forums/thread/how-to-find-item-purchase-code-screenshotmockup/105269\" target=\"_blank\">How to download purchase code</a> ) for any extra help."
						,"icon" 		=> true
						,"type" 		=> "info"
				);	


$of_options[] = array( 	"name" 		=> "Docs #3"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Basic Woocommerce Configuration!.</h3>
							Pls follow those guides  : <br/>
							<a href=\"http://www.youtube.com/watch?v=g8l0LpoTZVM\" target=\"_blank\">http://www.youtube.com/watch?v=g8l0LpoTZVM</a><br/>
							<a href=\"http://www.youtube.com/watch?v=hg6Ys_KxEwE\" target=\"_blank\">http://www.youtube.com/watch?v=hg6Ys_KxEwE</a><br/>
							
							"
						,"icon" 		=> true
						,"type" 		=> "info"
				);	

$of_options[] = array( 	"name" 		=> "Docs #1 Install"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">The complete documents</h3>
							Complete documents included in your theme package. You can download it from Download Menu on your Themeforest Dashboard"
						,"icon" 		=> true
						,"type" 		=> "info"
				);					
				
$of_options[] = array( 	"name" 		=> "Docs #4"
						,"desc" 		=> ""
						,"id" 		=> "introduction"
						,"std" 		=> "<h3 style=\"margin: 0 0 10px;\">Still Need Help?</h3>
							Drop us an email <a href=\"mailto:support@wpdance.com\">support@wpdance.com</a> for help. ( Monday - Friday 8 AM to 5:30 PM ,GMT +7 )"
						,"icon" 		=> true
						,"type" 		=> "info"
				);				
				
	}//End function: of_options()
}//End chack if function exists: of_options()

?>
