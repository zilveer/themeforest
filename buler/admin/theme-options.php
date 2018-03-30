<?php

add_action('init','of_options_buler_pmc');

if (!function_exists('of_options_buler_pmc')) {
function of_options_buler_pmc(){
	
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
$of_options_buler_pmc_select = array("one","two","three","four","five"); 
$of_options_buler_pmc_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
$of_options_buler_pmc_homepage_blocks = array( 
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

if ( is_dir($alt_stylesheet_path) ) {
    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) { 
        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) {
            if(stristr($alt_stylesheet_file, ".css") !== false) {
                $alt_stylesheets[] = $alt_stylesheet_file;
            }
        }    
    }
}

//Background Images Reader
$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
$images_url = get_template_directory_uri().'/images/'; // change this to where you store your bg images
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

//Background Images Reader
$bg_images_path_header = get_stylesheet_directory(). '/images/bg-footer/'; // change this to where you store your bg images
$bg_images_url_header  = get_template_directory_uri().'/images/bg-footer/'; // change this to where you store your bg images
$bg_images_header  = array();

if ( is_dir($bg_images_path_header ) ) {
    if ($bg_images_dir_header = opendir($bg_images_path_header) ) { 
        while ( ($bg_images_file_header = readdir($bg_images_dir_header)) !== false ) {
            if(stristr($bg_images_file_header, ".png") !== false || stristr($bg_images_file_header, ".jpg") !== false) {
                $bg_images_header[] = $bg_images_url_header . $bg_images_file_header;
            }
        }    
    }
}

//Background header Images Reader
$bg_images_path_header = get_stylesheet_directory() . '/images/bg-footer/'; // change this to where you store your bg images
$bg_images_url_header  = get_template_directory_uri().'/images/bg-footer/'; // change this to where you store your bg images
$bg_images_header  = array();

if ( is_dir($bg_images_path_header ) ) {
    if ($bg_images_dir_header = opendir($bg_images_path_header) ) { 
        while ( ($bg_images_file_header = readdir($bg_images_dir_header)) !== false ) {
            if(stristr($bg_images_file_header, ".png") !== false || stristr($bg_images_file_header, ".jpg") !== false) {
                $bg_images_header[] = $bg_images_url_header . $bg_images_file_header;
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
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
$body_att = array("scroll","fixed");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$number_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19","20","25","30","35","40","45","50");
$slider_entries = array("sliceDown", "sliceDownLeft", "sliceUp", "sliceUpLeft", "sliceUpDown", "sliceUpDownLeft", "fold", "fade", "random", "slideInRight", "slideInLeft", "boxRandom", "boxRain", "boxRainReverse", "boxRainGrow", "boxRainGrowReverse");
$google_fonts = array("", "Allan:bold", "Allerta", "Allerta+Stencil", "Amaranth", "Anonymous+Pro", "Arimo", "Arvo", "Bentham", "Buda:light", "Cabin:bold", "Calligraffitti", "Cantarell", "Cardo", "Cherry+Cream+Soda", "Chewy","Coda:800", "Coming+Soon","Copse", "Corben:bold", "Cousine", "Covered+By+Your+Grace", "Crafty+Girls", "Crimson", "Crushed", "Cuprum", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Fontdiner+Swanky", "Geo", "Gruppo", "Homemade+Apple", "IM Fell", "Inconsolata", "Irish+Growler", "Josefin Sans Std Light", "Josefin+Sans", "Josefin+Slab", "Just+Another+Hand", "Just+Me+Again+Down+Here", "Kenia", "Kranky", "Kreon", "Kristi", "Lato", "Lekton", "Lobster", "Luckiest+Guy", "Maven+Pro", "Merriweather", "Michroma", "Molengo", "Mountains+of+Christmas", "Neucha", "Neuton", "Nobile", "OFL Sorts Mill Goudy TT", "OFL Standard TT", "Orbitron", "Pacifico", "Permanent+Marker", "Philosopher", "PT Sans", "PT Sans Narrow", "Puritan", "Raleway:100", "Reenie Beanie", "Rock+Salt", "Schoolbell", "Six+Caps", "Slackey", "Sniglet:800", "Sunshiney", "Syncopate", "Tangerine", "Tinos", "Ubuntu", "UnifrakturCook:bold", "UnifrakturMaguntia", "Unkempt", "Vibur", "Vidaloka", "Vollkorn", "Walter+Turncoat", "Yanone Kaffeesatz");
$google_fonts_display = str_replace('+', ' ', $google_fonts);
$number_entries_display = array("Select a number:","4","8","12");
$number_entries_display_port = array("Select a number:","3","6","9");
// Image Alignment radio box
$of_options_buler_pmc_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$of_options_buler_pmc_image_link_to = array("image" => "The Image","post" => "The Post"); 

// Set the Options Array
global $of_options_buler_pmc;
$of_options_buler_pmc = array();



$of_options_buler_pmc[] = array( "name" => "Home Settings",
					"type" => "heading");
				
$of_options_buler_pmc[] = array( "name" => "General settings",
                    "type" => "innerheading");	

$of_options_buler_pmc[] = array( "name" => "Allow responsive mode?",
					"desc" => "Check this if you wish to allow responsive mode.",
					"id" => "showresponsive",
					"std" => 1,
					"type" => "checkbox");						
					
$of_options_buler_pmc[] = array( "name" => "Portfolio slug",
					"desc" => "If you are not using default <a href='".admin_url()."options-permalink.php' target='_blank'>Permalink structure</a> you will need to: <p>1. save Permalink to default structure </p><p> 2. save Permalink to your custom structure</p>",
					"id" => "port_slug",
					"std" => "portfolio",
					"type" => "text"); 
									
					
$of_options_buler_pmc[] = array( "name" => "Portfolio and post setting for home page",
                    "type" => "innerheading");								
				
				
$of_options_buler_pmc[] = array( "name" => "Number of recent portfolio  on home page",
					"desc" => "Select how many recent items you wish to display in portfolio",
					"id" => "home_recent_number",
					"std" => "8",
					"type" => "select",
					"options" => $number_entries);		

$of_options_buler_pmc[] = array( "name" => "Number of recent portfolio items display per slide",
					"desc" => "Select how many recent portfolio items display per slide",
					"id" => "home_recent_number_display",
					"std" =>"4",
					"type" => "select",
					"options" => $number_entries_display );						

					
$of_options_buler_pmc[] = array( "name" => "Number of recent post items display per slide",
					"desc" => "Select how many recent post items display per slide (only for 3 rows post display)",
					"id" => "home_recent_number_display_post",
					"std" => "3",
					"type" => "select",
					"options" => $number_entries_display_port );					

$of_options_buler_pmc[] = array( "name" => "Number of recent posts on home page",
					"desc" => "Select how many recent items you wish to display in post",
					"id" => "home_recent_number_post",
					"std" => "2",
					"type" => "select",
					"options" => $number_entries);			

	
		
$of_options_buler_pmc[] = array( "name" => "Woocommerce Settings",
					"type" => "heading");

$of_options_buler_pmc[] = array( "name" => "Woocomerce setting for home page",
                    "type" => "innerheading");		

$of_options_buler_pmc[] = array( "name" =>  "Category type for Woocommerce",
					"desc" => "Set Category type for Woocommerce.",
					"id" => "catwootype",
					'options' => array('1' => 'Full width', '2' => 'With sidebar'),
					"std" => "1",					
					"type" => "radio");		

$of_options_buler_pmc[] = array( "name" => "Display add to cart animation",
					"desc" => "Check if you wish animation when add to cart is clicked",
					"id" => "add_to_cart",
					"std" => 1,
					"type" => "checkbox");						

$of_options_buler_pmc[] = array( "name" => "Display recent Products?",
					"desc" => "Check this if you wish to display recent Products (under the 3 featured items).",
					"id" => "recent_status_product",
					"std" => 1,
					"type" => "checkbox");		
					
$of_options_buler_pmc[] = array( "name" => "Number of recent Products on home page",
					"desc" => "Select how many recent Products you wish to display in Home page",
					"id" => "home_recent_products_number",
					"std" => "8",
					"type" => "select",
					"options" => $number_entries);		

$of_options_buler_pmc[] = array( "name" => "Number of Products items display per slide",
					"desc" => "Select how many  Products display per slide",
					"id" => "home_recent_number_display_product",
					"std" => "8",
					"type" => "select",
					"options" => $number_entries_display);							
					
$of_options_buler_pmc[] = array( "name" => "Display Feautured Products?",
					"desc" => "Check this if you wish to display Feautured Products on Home page (under the 3 featured items).",
					"id" => "recent_status_productF",
					"std" => 1,
					"type" => "checkbox");		
															
$of_options_buler_pmc[] = array( "name" => "Number of feautured Products on home page",
					"desc" => "Select how many feautured Products you wish to display in Home Page",
					"id" => "home_recent_productsF_number",
					"std" => "8",
					"type" => "select",
					"options" => $number_entries);	
					
$of_options_buler_pmc[] = array( "name" => "Number of feautured Products items display per slide",
					"desc" => "Select how many feautured Products display per slide",
					"id" => "home_recent_number_display_fproduct",
					"std" => "4",
					"type" => "select",
					"options" => $number_entries_display);							
							

$of_options_buler_pmc[] = array( "name" => "WooCommerce Text",
                    "type" => "innerheading");		

$of_options_buler_pmc[] = array( "name" => "Cart",
                    "desc" => "Translation for cart text.",
                    "id" => "translation_cart",
                    "std" => __('Cart','buler'),
                    "type" => "text");	
	

$of_options_buler_pmc[] = array( "name" => "Share this product title",
                    "desc" => "Translation for Share this product title.",
                    "id" => "translation_share_product",
                    "std" =>  __('<span>Share</span> this product','buler'),
                    "type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "Live Sample",
                    "desc" => "Translation for live sample audio title in single product view.",
                    "id" => "translation_sample",
                    "std" => __('Live Sample','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Also like product",
                    "desc" => "Translation for Also like product title.",
                    "id" => "translation_also_like",
                    "std" => __('<span>Also</span> like','buler'),
                    "type" => "text");			

$of_options_buler_pmc[] = array( "name" => "Login / Register",
                    "desc" => "Translation for Login / Register.",
                    "id" => "translation_login_register",
                    "std" => __('Login / Register','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Our Futured Products",
                    "desc" => "Translation for Our futured products text.",
                    "id" => "translation_featured",
                    "std" => __('Our Futured Products','buler'),
                    "type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "Recent Products",
                    "desc" => "Translation for Home page Recebt product title.",
                    "id" => "translation_recent_pruduct_title",
                    "std" => __('recent Products','buler'),
                    "type" => "text");						
					
$of_options_buler_pmc[] = array( "name" => "Read more for product",
                    "desc" => "Translation for Read more.",
                    "id" => "translation_morelink",
                    "std" => __('Read more','buler'),
                    "type" => "text");					

$of_options_buler_pmc[] = array( "name" => "Other WooCommerce settings",
                    "type" => "innerheading");		

$of_options_buler_pmc[] = array( "name" => "Number of Products per page in Shop",
					"desc" => "Select how many Category Products per page you wish to display",
					"id" => "product_cat_page",
					"std" => "9",
					"type" => "select",
					"options" => $number_entries);						
					
$of_options_buler_pmc[] = array( "name" => "Catalog image height",
                    "desc" => "Set catalog image height. (if you wish 200px size put in field 200)",
                    "id" => "catalog_img_height",
                    "std" => '230',
                    "type" => "text");						
			
				
$of_options_buler_pmc[] = array( "name" => "Content Setting",
                    "type" => "heading");
					
			
					
$of_options_buler_pmc[] = array( "name" => "Quote for default pages (blog, sigle post, single portfolio)",
                    "type" => "innerheading");	

$of_options_buler_pmc[] = array( "name" => "Big quote text ",
					"desc" => "Enter big text for quote bar.",
					"id" => "quote_big",
					"std" => __('CHECK OUR LATEST WORDPRESS THEME THAT IMPLEMENTS PAGE BUILDER','buler'),
					"type" => "text"); 	

$of_options_buler_pmc[] = array( "name" => "Small quote text ",
					"desc" => "Enter small text for quote bar.",
					"id" => "quote_small",
					"std" => __('- learn how to build Wordpress Themes with ease with a premium Page Builder which allows you to add new Pages in seconds.','buler'),
					"type" => "text"); 	

$of_options_buler_pmc[] = array( "name" => "Top bar content",
                    "type" => "innerheading");						
					
$of_options_buler_pmc[] = array( "name" => "Icon for telephone text (leave empty if you don't need image.)",
					"desc" => "Upload an image for telephone text.<br>Awesome Icon Class - <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>refer here</a><br/>For mobile phone icon just add : icon-mobile-phone ",
					"id" => "top_notification_icon_tel",
					"std" =>  "icon-mobile-phone",
					"type" => "text");						

$of_options_buler_pmc[] = array( "name" => "Telephone text",
					"desc" => "Enter Telephone text for top bar.",
					"id" => "top_notification_tel",
					"std" => __('Premiumcoding Telephone','buler'),
					"type" => "text"); 			
					
$of_options_buler_pmc[] = array( "name" => "Icon for mail text (leave empty if you don't need image.)",
					"desc" => "Upload an image for mail text. <br>Awesome Icon Class - <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>refer here</a><br/>For mail icon just add : icon-envelope ",
					"id" => "top_notification_icon_mail",
					"std" =>  "icon-envelope",
					"type" => "text");						

$of_options_buler_pmc[] = array( "name" => "Mail text",
					"desc" => "Enter Mail text for top bar.",
					"id" => "top_notification_mail",
					"std" => __('Premiumcoding Mail','buler'),
					"type" => "text"); 
	



$of_options_buler_pmc[] = array( "name" => "Our major brands images",
                    "type" => "innerheading");							


$of_options_buler_pmc[] = array( "name" => "Our major brands",
					"desc" => "You can add unlimited number of images and sort them with drag and drop.",
					"id" => "advertiseimage",
					"std" =>  array('title' => 'slide','url' => '/wp-content/uploads/2012/09/sponsor1.png','link' => 'http://premiumcoding.com'),
					"nivo" => false,						
					"team" => false,	
					"ios" => false,					
					"descshow" => false,
					"type" => "slider");					
				
					
$of_options_buler_pmc[] = array( "name" => "General Settings",
                    "type" => "heading");
							
					
$of_options_buler_pmc[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => "logo",
					"std" => "http://buler.premiumcoding.com/wp-content/uploads/2012/10/logo.png",
					"type" => "upload");
									
					
$of_options_buler_pmc[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => "favicon",
					"std" => "http://curvey.premiumcoding.com/wp-content/uploads/2012/05/faviconLogo.png",
					"type" => "upload"); 					
							
 $of_options_buler_pmc[] = array( "name" => "Google Analytics",
                    "desc" => "Paste your Google analytics code here.",
                    "id" => "google_analytics",
                    "std" => "/",
                    "type" => "textarea");	   		                                               									
    
$of_options_buler_pmc[] = array( "name" => "Styling Options",
					"type" => "heading");

$of_options_buler_pmc[] = array( "name" =>  "Main Theme Color ",
					"desc" => "Set the main color for your theme.",
					"id" => "mainColor",
					"std" => "#EEC43D",
					"type" => "color");		
					
$of_options_buler_pmc[] = array( "name" =>  "Second Theme Color (for creating gradient)",
					"desc" => "Set the Second Theme Color (for creating gradient).",
					"id" => "gradient_color",
					"std" => "#ffffff",
					"type" => "color");	
					
$of_options_buler_pmc[] = array( "name" =>  "Border Color (for making a border around elements with gradient)",
					"desc" => "Set the Border Color (for making a border around elements with gradient).",
					"id" => "gradient_border_color",
					"std" => "#ffffff",
					"type" => "color");						
					
					
$of_options_buler_pmc[] = array( "name" =>  "Box Color ",
					"desc" => "Set the box color for your theme.",
					"id" => "boxColor",
					"std" => "#2a2b2c",
					"type" => "color");		
						

$of_options_buler_pmc[] = array( "name" =>  "Shadow Color ",
					"desc" => "Set the Shadow color for your fonts.",
					"id" => "ShadowColorFont",
					"std" => "#ffffff",
					"type" => "color");			

					
$of_options_buler_pmc[] = array( "name" => "Shadow opacity",
					"desc" => "Set Shadow opacity (between 0 and 1).",
					"id" => "ShadowOpacittyColorFont",
					"std" => "0.15",
					"type" => "text"); 	
						
					

$of_options_buler_pmc[] = array( "name" => "Body background",
                    "type" => "innerheading");
					
$of_options_buler_pmc[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme.",
					"id" => "body_background_color",
					"std" => "#ffffff",
					"type" => "color");

$of_options_buler_pmc[] = array( "name" => "Enable Background Image",
					"desc" => "Displays an image not the color selected above",
					"id" => "background_image",
					"std" => 1,
					"type" => "checkbox");
					
$of_options_buler_pmc[] = array( "name" => "Background Pattern",
					"desc" => "Select a background pattern.",
					"id" => "body_bg",
					"std" => $bg_images_url."bg16.png",
					"type" => "tiles",
					"options" => $bg_images,
					);	
											
						
					
$of_options_buler_pmc[] = array( "name" => "Background Image Properties",
					"desc" => "You can define additional shorthand properties for the background such as no-repeat here. This is for advanced CSS users only.",
					"id" => "body_bg_properties",
					"std" => "repeat 0 0",
					"type" => "text"); 	

$of_options_buler_pmc[] = array( "name" => "Footer background ",
                    "type" => "innerheading");					
					
$of_options_buler_pmc[] = array( "name" => "Enable header and footer Background Pattern",
					"desc" => "Enable header and footer Background Image",
					"id" => "background_image_header",
					"std" => 1,
					"type" => "checkbox");
					
$of_options_buler_pmc[] = array( "name" =>  "Header and Footer Background Color",
					"desc" => "Header and Footer Background Color.",
					"id" => "header_background_color",
					"std" => "#F4F4F4",
					"type" => "color");
					
$of_options_buler_pmc[] = array( "name" => "Background header and footer Pattern",
					"desc" => "Background footer Pattern. To add more patterns upload them to your Theme's /images/bg-footer folder.",
					"id" => "header_bg",
					"std" => $bg_images_url_header."bg12.png",
					"type" => "tiles",
					"options" => $bg_images_header,
					);					
					

$of_options_buler_pmc[] = array( "name" => "Background header and footer Image Properties",
					"desc" => "You can define additional shorthand properties for the background such as no-repeat here. This is for advanced CSS users only.",
					"id" => "header_bg_properties",
					"std" => "repeat 0 0",
					"type" => "text"); 		

$of_options_buler_pmc[] = array( "name" => "Custom Style",
                    "type" => "innerheading");				
					
$of_options_buler_pmc[] = array( "name" => "Custom Style",
                    "desc" => "Add your custom style.",
                    "id" => "custom_style",
                    "std" => " ",
                    "type" => "textarea");						


$of_options_buler_pmc[] = array( "name" => "Slider options",
                    "type" => "heading");
					
$of_options_buler_pmc[] = array( "name" => "iosSlider",
                    "type" => "innerheading");					
					
$of_options_buler_pmc[] = array( "name" => "Slider Options",
					"desc" => "You can add unlimited number of images and sort them with drag and drop. If you wish to have bottom position of text leave description field empty and add text to title field.",
					"id" => "iosslider",
					"std" => array('title' => 'slide','url' => 'wp-content/uploads/2012/10/railway.jpg','link' => 'http://premiumcoding.com','description'=>'description]'),
					"nivo" => true,						
					"descshow" => true,	
					"team" => false,
					"ios" => true,					
					"type" => "slider");						
					
					
$of_options_buler_pmc[] = array( "name" => "Nivo slider",
                    "type" => "innerheading");					
					
$of_options_buler_pmc[] = array( "name" => "Slider Options",
					"desc" => "You can add unlimited number of images and sort them with drag and drop.",
					"id" => "nivo_slider",
					"std" => array('title' => 'slide','url' => 'wp-content/uploads/2012/10/railway.jpg','link' => 'http://premiumcoding.com','description'=>'description]'),
					"nivo" => true,						
					"descshow" => true,	
					"team" => false,	
					"ios" => false,					
					"type" => "slider");					

$of_options_buler_pmc[] = array( "name" => "Main Settings",
                    "type" => "innerheading");	

$of_options_buler_pmc[] = array( "name" => "Background transparency of text holder",
					"desc" => "Set the background opacity / transparency of the text holder. (from 0 to 1)",
					"id" => "slider_opacity",
					"std" => "0.5",
					"type" => "text");						

					
$of_options_buler_pmc[] = array( "name" => "Nivo Slider Options",
                    "type" => "innerheading");
													
					
$of_options_buler_pmc[] = array( "name" => "Slider text color and font size for Nivo slider",
					"desc" => "Font color and size for Content text",
					"id" => "slider_fontSize_colorNivo",
					"std" => array('size' => '24px','color' => '#ffffff'),
					"type" => "sizeColor");		
					
$of_options_buler_pmc[] = array( "name" => "Background color of text holder for Nivo slider",
					"desc" => "Set the Background color of text holder.",
					"id" => "slider_backColorNivo",
					"std" => "#1BAACC",
					"type" => "color");							

$of_options_buler_pmc[] = array( "name" => "Border color of text holder for Nivo slider",
					"desc" => "Set border color of text holder.",
					"id" => "slider_borderColorNivo",
					"std" => "#1BAACC",
					"type" => "color");		

			


					
$of_options_buler_pmc[] = array( "name" => "Typography",
                    "type" => "heading");
					
$of_options_buler_pmc[] = array( "name" => "Body Typography Settings",
					"desc" => "Change body typography. Set the font family, size, color and style.",
					"id" => "body_font",
					"std" => array('size' => '13px','color' => '#2a2b2c','face' => 'arial'),
					"type" => "typography");
									
					
$of_options_buler_pmc[] = array( "name" => "Heading Typography Settings",
					"desc" => "Change heading typography. Set the font family and style.",
					"id" => "heading_font",
					"std" => array('face' => 'Yanone%20Kaffeesatz:300','style' => 'normal'),
					"type" => "typography");	
					
$of_options_buler_pmc[] = array( "name" => "Menu Typography Settings",
					"desc" => "Change munu typography. Set the font family.",
					"id" => "menu_font",
					"std" => 'Helvetica Neue',
					"type" => "font");			
					
$of_options_buler_pmc[] = array( "name" => "Box Text Color (text on ribbons and boxes)",
					"desc" => "Change Box Text Color (text on ribbons and boxes).",
					"id" => "body_box_coler",
					"std" => "#ffffff",
					"type" => "color");	

$of_options_buler_pmc[] = array( "name" => "Link Typography (color of text links)",
					"desc" => "Change Link Typography (color of text links).",
					"id" => "body_link_coler",
					"std" => "#2a2b2c",
					"type" => "color");						

$of_options_buler_pmc[] = array( "name" => "H1 typography",
					"desc" => "Set H1 font size and color.",
					"id" => "heading_font_h1",
					"std" => array('size' => '30px','color' => '#2a2b2c'),
					"type" => "sizeColor");

$of_options_buler_pmc[] = array( "name" => "H2 typography",
					"desc" => "Set H2 font size and color.",
					"id" => "heading_font_h2",
					"std" => array('size' => '22px','color' => '#2a2b2c'),
					"type" => "sizeColor");
					
$of_options_buler_pmc[] = array( "name" => "H3 typography",
					"desc" => "Set H3 font size and color.",
					"id" => "heading_font_h3",
					"std" => array('size' => '20px','color' => '#2a2b2c'),
					"type" => "sizeColor");					

$of_options_buler_pmc[] = array( "name" => "H4typography",
					"desc" => "Set H4 font size and color.",
					"id" => "heading_font_h4",
					"std" => array('size' => '16px','color' => '#2a2b2c'),
					"type" => "sizeColor");	

$of_options_buler_pmc[] = array( "name" => "H5 typography",
					"desc" => "Set H5 font size and color.",
					"id" => "heading_font_h5",
					"std" => array('size' => '14px','color' => '#2a2b2c'),
					"type" => "sizeColor");		

$of_options_buler_pmc[] = array( "name" => "H6 typography",
					"desc" => "Set H6 font size and color.",
					"id" => "heading_font_h6",
					"std" => array('size' => '12px','color' => '#2a2b2c'),
					"type" => "sizeColor");		
										
																							
$of_options_buler_pmc[] = array( "name" => "Social Options",
					"type" => "heading");  
					
$of_options_buler_pmc[] = array( "name" => "Show Facebook icon",
					"desc" => "Check if you wish to show Facebook icon",
					"id" => "facebook_show",
					"std" => 1,
					"type" => "checkbox");							
					
$of_options_buler_pmc[] = array( "name" => "Facebook link",
					"desc" => "Set the link used for your Facebook icon.",
					"id" => "facebook",
					"std" => "http://premiumcoding.com",
					"type" => "text");

$of_options_buler_pmc[] = array( "name" => "Show Twitter icon",
					"desc" => "Check if you wish to show Twitter icon",
					"id" => "twitter_show",
					"std" => 1,
					"type" => "checkbox");							

$of_options_buler_pmc[] = array( "name" => "Twitter link",
					"desc" => "Set the link used for your Twitter icon.",
					"id" => "twitter",
					"std" => "http://premiumcoding.com",
					"type" => "text");
					
$of_options_buler_pmc[] = array( "name" => "Show Pinterest icon",
					"desc" => "Check if you wish to show Pinterest icon",
					"id" => "vimeo_show",
					"std" => 1,
					"type" => "checkbox");							

$of_options_buler_pmc[] = array( "name" => "Pinterest link",
					"desc" => "Set the link used for your Pinterest icon.",
					"id" => "vimeo",
					"std" => "http://premiumcoding.com",
					"type" => "text");		

$of_options_buler_pmc[] = array( "name" => "Show Dribble icon",
					"desc" => "Check if you wish to show Dribble icon",
					"id" => "youtube_show",
					"std" => 1,
					"type" => "checkbox");							

$of_options_buler_pmc[] = array( "name" => "Dribble link",
					"desc" => "Set the link used for your Dribble icon.",
					"id" => "youtube",
					"std" => "http://premiumcoding.com",
					"type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "Show Email icon",
					"desc" => "Check if you wish to show Email icon",
					"id" => "email_show",
					"std" => 1,
					"type" => "checkbox");							
						

$of_options_buler_pmc[] = array( "name" => " Email link",
					"desc" => "Set the link used for your Email icon.",
					"id" => "email",
					"std" => "http://premiumcoding.com",
					"type" => "text");						
				


$of_options_buler_pmc[] = array( "name" => "Error page",
					"type" => "heading");      

					
$of_options_buler_pmc[] = array( "name" => "404 Error page Title",
                    "desc" => "Set the title of the Error page (404 not found error).",
                    "id" => "errorpagetitle",
                    "std" => __('OOOPS! 404','buler'),
                    "type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "404 Error page Sub Title",
                    "desc" => "Set the sub title of the Error page (404 not found error).",
                    "id" => "errorpagesubtitle",
                    "std" => "Seems like you stumbled at something that doesn't really exist",
                    "type" => "text");						

$of_options_buler_pmc[] = array( "name" => "404 Error page Title Content Text",
                    "desc" => "Add a description for your 404 page.",
                    "id" => "errorpage",
                    "std" => __('Sorry, but the page you are looking for has not been found.<br/>Try checking the URL for errors, then hit refresh.</br>Or you can simply click the icon below and go home:)','buler'),
                    "type" => "textarea");	   	
					
	
$of_options_buler_pmc[] = array( "name" => "Footer Options",
					"type" => "heading");      
		
					
$of_options_buler_pmc[] = array( "name" => "Copyright info",
                    "desc" => "Add your Copyright or some other notice.",
                    "id" => "copyright",
                    "std" => __('&copy; 2011 All rights reserved. ','buler'),
                    "type" => "textarea");	

					
					

					
$of_options_buler_pmc[] = array( "name" => "Translation",
					"type" => "heading");   	
									

$of_options_buler_pmc[] = array( "name" => "Social icons",
                    "type" => "innerheading");						

				
$of_options_buler_pmc[] = array( "name" => "Social icons title in footer",
                    "desc" => "Translation for social icons title in footer.",
                    "id" => "translation_socialtitle",
                    "std" => __('SOCIALIZE WITH US','buler'),
                    "type" => "text");	 
					
$of_options_buler_pmc[] = array( "name" => "Facebook icon alt text",
                    "desc" => "Translation for Facebook alt text.",
                    "id" => "translation_facebook",
                    "std" => __('Facebook','buler'),
                    "type" => "text");	 	

$of_options_buler_pmc[] = array( "name" => "Twitter icon alt text",
                    "desc" => "Translation for twitter alt text.",
                    "id" => "translation_twitter",
                    "std" => __('Twitter','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Pinterest icon alt text",
                    "desc" => "Translation for Pinterest alt text.",
                    "id" => "translation_vimeo",
                    "std" => __('Pinterest','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Dribble icon alt text",
                    "desc" => "Translation for Dribble alt text.",
                    "id" => "translation_dribble",
                    "std" => __('Dribble','buler'),
                    "type" => "text");	

/*$of_options_buler_pmc[] = array( "name" => "Stumble Upon icon alt text",
                    "desc" => "Translation for Stumble Upon alt text.",
                    "id" => "translation_stumble",
                    "std" => __('Stumble Upon','buler'),
                    "type" => "text");		*/				
					

$of_options_buler_pmc[] = array( "name" => "Email icon alt text",
                    "desc" => "Translation for email alt text.",
                    "id" => "translation_email",
                    "std" => __('Send us Email','buler'),
                    "type" => "text");	

					
							
$of_options_buler_pmc[] = array( "name" => "General Translaction",
                    "type" => "innerheading");								
					
					
$of_options_buler_pmc[] = array( "name" => "Our latest posts",
                    "desc" => "Translation for Our latest posts text.",
                    "id" => "translation_post",
                    "std" =>  __('Our latest posts','buler'),
                    "type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "Enter search",
                    "desc" => "Translation for enter search text in widget.",
                    "id" => "translation_enter_search",
                    "std" =>  __('Enter search...','buler'),
                    "type" => "text");						
					
$of_options_buler_pmc[] = array( "name" => "Portfolio title on home page.",
                    "desc" => "Translation for portfolio title on home page.",
                    "id" => "translation_port",
                    "std" => __('Recent from Our portfolio','buler'), 
                    "type" => "text");							
					
$of_options_buler_pmc[] = array( "name" => "Related post",
                    "desc" => "Translation for Related post text.",
                    "id" => "translation_relatedpost",
                    "std" => __('Related post','buler'),
                    "type" => "text");						


$of_options_buler_pmc[] = array( "name" => "Home page Our major brands",
                    "desc" => "Translation for Home page Our major brands title.",
                    "id" => "translation_advertise_title",
                    "std" => __('Our major brands','buler'),
                    "type" => "text");	
					
					
					
$of_options_buler_pmc[] = array( "name" => "Read more for blog",
                    "desc" => "Translation for Read more.",
                    "id" => "translation_morelinkblog",
                    "std" => __('Read more about this...','buler'),
                    "type" => "text");						
					
$of_options_buler_pmc[] = array( "name" => "Read more for portfolio items on front page",                    
					"desc" => "Translation for Read more.",                    
					"id" => "translation_morelinkport",
                    "std" => __('Read more about this...','buler'),
                    "type" => "text");
			
			

$of_options_buler_pmc[] = array( "name" => "Portfolio Translaction",
                    "type" => "innerheading");
					

$of_options_buler_pmc[] = array( "name" => "Project Description",
					"desc" => "Set Project Description",
					"id" => "port_project_description",
					"std" => __('Project description:','buler'),
					"type" => "text");		

$of_options_buler_pmc[] = array( "name" => "Project details",
					"desc" => "Set Project details",
					"id" => "port_project_details",
					"std" => __('Project details:','buler'),
					"type" => "text");						
									
					
$of_options_buler_pmc[] = array( "name" => "Project URL",
					"desc" => "Set the Project URL Title",
					"id" => "port_project_url",
					"std" => __('Project URL:','buler'),
					"type" => "text");			
					
$of_options_buler_pmc[] = array( "name" => "Project designer",
					"desc" => "Set the Project designer Title",
					"id" => "port_project_designer",
					"std" => __('Project designer:','buler'),
					"type" => "text");	
					
$of_options_buler_pmc[] = array( "name" => "Project Date of completion",
					"desc" => "Set the Project Date of completion Title",
					"id" => "port_project_date",
					"std" => __('Date of completion:','buler'),
					"type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Project Client",
					"desc" => "Set the Client Title",
					"id" => "port_project_client",
					"std" => __('Client:','buler'),
					"type" => "text");		

$of_options_buler_pmc[] = array( "name" => "Share the project",
					"desc" => "Set the Share the project Title",
					"id" => "port_project_share",
					"std" => __('Share the <span>project</span>','buler'),
					"type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Related project",
					"desc" => "Set the Related projject Title",
					"id" => "port_project_related",
					"std" => __('Related <span>project</span>','buler'),
					"type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Show all",
                    "desc" => "Translation for Show all.",
                    "id" => "translation_all",
                    "std" => __('Show all:','buler'),
                    "type" => "text");		
					
					
									

$of_options_buler_pmc[] = array( "name" => "Blog translation",
                    "type" => "innerheading");

$of_options_buler_pmc[] = array( "name" => "Translation for text By",
                    "desc" => "Translation for text By.",
                    "id" => "translation_by",
                    "std" => __('By: ','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Leave the comment",
                    "desc" => "Translation for text Leave the comment.",
                    "id" => "translation_leave_comment",
                    "std" => __('Leave the comment ','buler'),
                    "type" => "text");
					

$of_options_buler_pmc[] = array( "name" => "Share post",
                    "desc" => "Translation for Share  post title.",
                    "id" => "translation_share_post",
                    "std" => __('Share this post','buler'),
                    "type" => "text");		
			

					

$of_options_buler_pmc[] = array( "name" => "Comment translation",
                    "type" => "innerheading");
					
$of_options_buler_pmc[] = array( "name" => "Recent Comments text",
                    "desc" => "Translation for Recent Comments text.",
                    "id" => "translation_recent_comments",
                    "std" => __('Recent Comments','buler'),
                    "type" => "text");						

$of_options_buler_pmc[] = array( "name" => "Leave a Reply text",
                    "desc" => "Translation for Leave a Reply title.",
                    "id" => "translation_comment_leave_replay",
                    "std" => __('Leave a Reply','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Leave a Reply to text",
                    "desc" => "Translation for Leave a Reply to title.",
                    "id" => "translation_comment_leave_replay_to",
                    "std" => __('Leave a Reply to','buler'),
                    "type" => "text");		

$of_options_buler_pmc[] = array( "name" => "Cancle Replay text",
                    "desc" => "Translation for Cancle Replay title.",
                    "id" => "translation_comment_leave_replay_cancle",
                    "std" => __('Cancle Replay','buler'),
                    "type" => "text");						

$of_options_buler_pmc[] = array( "name" => "Name text",
                    "desc" => "Translation for Name text.",
                    "id" => "translation_comment_name",
                    "std" => __('Name','buler'),
                    "type" => "text");		

$of_options_buler_pmc[] = array( "name" => "Mail text",
                    "desc" => "Translation for Mail text.",
                    "id" => "translation_comment_mail",
                    "std" => __('Mail','buler'),
                    "type" => "text");	

$of_options_buler_pmc[] = array( "name" => "Website text",
                    "desc" => "Translation for Website text.",
                    "id" => "translation_comment_website",
                    "std" => __('Website','buler'),
                    "type" => "text");							

$of_options_buler_pmc[] = array( "name" => "Required text",
                    "desc" => "Translation for required text.",
                    "id" => "translation_comment_required",
                    "std" => __('required','buler'),
                    "type" => "text");							

$of_options_buler_pmc[] = array( "name" => "Comments are closed text",
                    "desc" => "Translation for Comments are closed text.",
                    "id" => "translation_comment_closed",
                    "std" => __('Comments are closed.','buler'),
                    "type" => "text");		

$of_options_buler_pmc[] = array( "name" => "No Responses text",
                    "desc" => "Translation for No Responses text.",
                    "id" => "translation_comment_no_responce",
                    "std" => __('No Responses','buler'),
                    "type" => "text");

$of_options_buler_pmc[] = array( "name" => "One Response text",
                    "desc" => "Translation One Response text.",
                    "id" => "translation_comment_one_comment",
                    "std" => __('One Response','buler'),
                    "type" => "text");

$of_options_buler_pmc[] = array( "name" => "Responses text",
                    "desc" => "Translation for Responses text.",
                    "id" => "translation_comment_max_comment",
                    "std" => __('Responses','buler'),
                    "type" => "text");					



	}

}

?>
