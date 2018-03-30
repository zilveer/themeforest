<?php

add_action('init','of_options_pmc');
if (!function_exists('of_options_pmc')) {
function of_options_pmc(){
	
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
$of_options_pmc_select = array("one","two","three","four","five"); 
$of_options_pmc_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
$of_options_pmc_homepage_blocks = array( 
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
$google_fonts = array("", "Allan:bold", "Allerta", "Allerta+Stencil", "Amaranth", "Anonymous+Pro", "Arimo", "Arvo", "Bentham", "Buda:light", "Cabin:bold", "Calligraffitti", "Cantarell", "Cardo", "opus+Cream+Soda", "Chewy","Coda:800", "Coming+Soon","Copse", "Corben:bold", "Cousine", "Covered+By+Your+Grace", "Crafty+Girls", "Crimson", "Crushed", "Cuprum", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Fontdiner+Swanky", "Geo", "Gruppo", "Homemade+Apple", "IM Fell", "Inconsolata", "Irish+Growler", "Josefin Sans Std Light", "Josefin+Sans", "Josefin+Slab", "Just+Another+Hand", "Just+Me+Again+Down+Here", "Kenia", "Kranky", "Kreon", "Kristi", "Lato", "Lekton", "Lobster", "Luckiest+Guy", "Maven+Pro", "Merriweather", "Michroma", "Molengo", "Mountains+of+Christmas", "Neucha", "Neuton", "Nobile", "OFL Sorts Mill Goudy TT", "OFL Standard TT", "Orbitron", "Pacifico", "Permanent+Marker", "Philosopher", "PT Sans", "PT Sans Narrow", "Puritan", "Raleway:100", "Reenie Beanie", "Rock+Salt", "Schoolbell", "Six+Caps", "Slackey", "Sniglet:800", "Sunshiney", "Syncopate", "Tangerine", "Tinos", "Ubuntu", "UnifrakturCook:bold", "UnifrakturMaguntia", "Unkempt", "Vibur", "Vidaloka", "Vollkorn", "Walter+Turncoat", "Yanone Kaffeesatz");
$google_fonts_display = str_replace('+', ' ', $google_fonts);
$number_entries_display = array("Select a number:","4","8","12");
$number_entries_display_port = array("Select a number:","3","6","9");
$menus = get_registered_nav_menus();
// Image Alignment radio box
$of_options_pmc_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
// Image Links to Options
$of_options_pmc_image_link_to = array("image" => "The Image","post" => "The Post"); 
// Set the Options Array
global $of_options_pmc;
$of_options_pmc = array();
$of_options_pmc[] = array( "name" => "General Settings",
                    "type" => "heading");
														

					
$of_options_pmc[] = array( "name" => "Check this is you wish to show blog on home page!",
					"desc" => "Check this is you wish to show blog on home page.",
					"id" => "home_blog",
					"std" => 1,
					"type" => "checkbox");	
					
$of_options_pmc[] = array( "name" => "Check this is you wish to show top bar!",
					"desc" => "Check this is you wish to show top bar.",
					"id" => "top_bar",
					"std" => 1,
					"type" => "checkbox");		
					
$of_options_pmc[] = array( "name" => "Display the 3 posts block under the logo?",
					"desc" => "Check this if you wish to display first block with 3 posts under the logo.",
					"id" => "use_block1",
					"std" => 0,
					"type" => "checkbox");						
				
$of_options_pmc[] = array( "name" => "Display Instagram block?",
					"desc" => "Check this if you wish to display Instagram block just above the footer",
					"id" => "use_block3",
					"std" => 1,
					"type" => "checkbox");	

$of_options_pmc[] = array( "name" => "Display about us block under the three posts?",
					"desc" => "Check this if you wish to display the about us block",
					"id" => "use_block2",
					"std" => 1,
					"type" => "checkbox");						

$of_options_pmc[] = array( "name" => "Use full width blog and full width single page without sidebar?",
					"desc" => "Check this if you wish to have the blog and single pages in full width format.",
					"id" => "use_fullwidth",
					"std" => 0,
					"type" => "checkbox");		

$of_options_pmc[] = array( "name" => "Display logo at the top (menu under logo)?",
					"desc" => "Check this if you wish to display logo at the top",
					"id" => "logo_top",
					"std" => 1,
					"type" => "checkbox");			

$of_options_pmc[] = array( "name" => "Display search in top bar with menu and social icons?",
					"desc" => "Check this if you wish to display search in top bar with menu and social icons",
					"id" => "search_top",
					"std" => 1,
					"type" => "checkbox");						

$of_options_pmc[] = array( "name" => "BANNER AD IN THE HEADER",
                    "type" => "innerheading");

$of_options_pmc[] = array( "name" => "Top Margin for AD in the Header",
					"desc" => "(only number, without px)",
					"id" => "sidebar_header_top_padding",
					"std" => "0px",
					"type" => "text");					
					
$of_options_pmc[] = array( "name" => "Logo settings",
                    "type" => "innerheading");	

$of_options_pmc[] = array( "name" => "Logo top margin",
					"desc" => "(only number, without px)",
					"id" => "logo_top_padding",
					"std" => "0px",
					"type" => "text"); 	

$of_options_pmc[] = array( "name" => "Logo bottom margin",
					"desc" => "(only number, without px)",
					"id" => "logo_bottom_padding",
					"std" => "0px",
					"type" => "text"); 						
					
					
$of_options_pmc[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png)",
					"id" => "logo",
					"std" => "",
					"type" => "upload");	
					
$of_options_pmc[] = array( "name" => "Custom Retina Logo",
					"desc" => "Upload a logo for your theme (retina dispplay), or specify the image address of your online logo. (http://yoursite.com/logo@2x.png)",
					"id" => "logo_retina",
					"std" => "",
					"type" => "upload");
					
$of_options_pmc[] = array( "name" => "Custom Scroll Logo",
					"desc" => "Upload a scroll logo for your theme. This is not required logo.",
					"id" => "scroll_logo",
					"std" => "",
					"type" => "upload");					

$of_options_pmc[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => "favicon",
					"std" => "",
					"type" => "upload"); 	
					

$of_options_pmc[] = array( "name" => "Home page",
                    "type" => "heading");	
					
$of_options_pmc[] = array( "name" => "Revolution slider",
                    "type" => "innerheading");	

$of_options_pmc[] = array( "name" => "Revolution slider alias",
					"desc" => "Add revolution slider alias for home page.",
					"id" => "rev_slider",
					"std" => "brixton",
					"type" => "text"); 		
					
$of_options_pmc[] = array( "name" => "Revolution slider top margin",
					"desc" => "Set top margin for Revolution slider.",
					"id" => "rev_slider_margin",
					"std" => "0px",
					"type" => "text"); 						
					
$of_options_pmc[] = array( "name" => "Upper Block (3 posts with images)",
                    "type" => "innerheading");						

$of_options_pmc[] = array( "name" => "Image for the first post (Recommended size 640px x 400px)",
					"desc" => "Upload your image.",
					"id" => "block1_img1",
					"std" => "",
					"type" => "upload");	

$of_options_pmc[] = array( "name" => "Title for the first post",
					"desc" => "Set the title for the image.",
					"id" => "block1_text1",
					"std" => "IMAGE TEXT",
					"type" => "text"); 
					
$of_options_pmc[] = array( "name" => "Lower Title for the first post",
					"desc" => "Set the lower title for the image.",
					"id" => "block1_lower_text1",
					"std" => "IMAGE TEXT",
					"type" => "text");
					
$of_options_pmc[] = array( "name" => "Link for the first post",
					"desc" => "Set link of the post.",
					"id" => "block1_link1",
					"std" => "",
					"type" => "text"); 					
					
$of_options_pmc[] = array( "name" => "Image for the second post (Recommended size 640px x 400px)",
					"desc" => "Upload your image.",
					"id" => "block1_img2",
					"std" => "",
					"type" => "upload");
					

$of_options_pmc[] = array( "name" => "Title for the second post",
					"desc" => "Set the title for the image.",
					"id" => "block1_text2",
					"std" => "IMAGE TEXT",
					"type" => "text"); 		

$of_options_pmc[] = array( "name" => "Lower Title for the second post",
					"desc" => "Set the lower title for the image.",
					"id" => "block1_lower_text2",
					"std" => "IMAGE TEXT",
					"type" => "text");
					

$of_options_pmc[] = array( "name" => "Link for the second post",
					"desc" => "Set link of the post.",
					"id" => "block1_link2",
					"std" => "",
					"type" => "text"); 					
					
$of_options_pmc[] = array( "name" => "Image for the third post (Recommended size 640px x 400px)",
					"desc" => "Upload your image.",
					"id" => "block1_img3",
					"std" => "",
					"type" => "upload");	

$of_options_pmc[] = array( "name" => "Title for the third post",
					"desc" => "Set the title for the image.",
					"id" => "block1_text3",
					"std" => "IMAGE TEXT",
					"type" => "text"); 	

$of_options_pmc[] = array( "name" => "Lower Title for the third post",
					"desc" => "Set the lower title for the image.",
					"id" => "block1_lower_text3",
					"std" => "IMAGE TEXT",
					"type" => "text");					

$of_options_pmc[] = array( "name" => "Link for the third post",
					"desc" => "Set link of the post.",
					"id" => "block1_link3",
					"std" => "",
					"type" => "text"); 					
										
$of_options_pmc[] = array( "name" => "About us block",
                    "type" => "innerheading");			

$of_options_pmc[] = array( "name" => "Image for the quote block  (recommended size 300px x 300px)",
					"desc" => "Upload your image.",
					"id" => "block2_img",
					"std" => "",
					"type" => "upload");
								

$of_options_pmc[] = array( "name" => "Content text for the quote block",
					"desc" => "Set the text for about us block.",
					"id" => "block2_text",
					"std" => "Text under title",
					"type" => "textarea"); 		

	
$of_options_pmc[] = array( "name" => "Quote block in the Footer",
                    "type" => "innerheading");

$of_options_pmc[] = array( "name" => "Content text for the quote block - above the footer",
					"desc" => "Set the text for quote footer block.",
					"id" => "block_footer_text",
					"std" => "Text under title",
					"type" => "textarea"); 
	
$of_options_pmc[] = array( "name" => "Instagram block",
                    "type" => "innerheading");

$of_options_pmc[] = array( "name" => "Instagram block Title",
					"desc" => "Title for the instagram block just above footer.",
					"id" => "block3_title",
					"std" => "brixtonirg",
					"type" => "text"); 						
					
$of_options_pmc[] = array( "name" => "Instagram block Username",
					"desc" => "The username that is displayed on the images.",
					"id" => "block3_username",
					"std" => "brixtonirg",
					"type" => "text"); 	

$of_options_pmc[] = array( "name" => "Instagram block Username Link",
					"desc" => "Link to your profile on Instagram.",
					"id" => "block3_url",
					"std" => "brixtonurl",
					"type" => "text"); 						
										
////////////////
$of_options_pmc[] = array( "name" => "Blog pages",
                    "type" => "heading");

$of_options_pmc[] = array( "name" => "Display post meta (date and author)?",
					"desc" => "Check this if you wish to display post meta such as date and author.",
					"id" => "display_post_meta",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Display socials?",
					"desc" => "Check this if you wish to display social icons.",
					"id" => "display_socials",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Single Blog Post",
                    "type" => "innerheading");

$of_options_pmc[] = array( "name" => "Display related posts?",
					"desc" => "Check this if you wish to display related posts.",
					"id" => "display_related",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Display tags?",
					"desc" => "Check this if you wish to display tags below each post.",
					"id" => "single_display_tags",
					"std" => 1,
					"type" => "checkbox");

$of_options_pmc[] = array( "name" => "Display author info?",
					"desc" => "Check this if you wish to display author info.",
					"id" => "display_author_info",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Display post meta (date and author) on single blog post?",
					"desc" => "Check this if you wish to display post meta such as date and author.",
					"id" => "single_display_post_meta",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Display socials?",
					"desc" => "Check this if you wish to display social icons on single blog post.",
					"id" => "single_display_socials",
					"std" => 1,
					"type" => "checkbox");
	
$of_options_pmc[] = array( "name" => "Display post navigation?",
					"desc" => "Check this if you wish to enable prev/next navigation between posts.",
					"id" => "single_display_post_navigation",
					"std" => 1,
					"type" => "checkbox");
	

$of_options_pmc[] = array( "name" => "Styling Options",
					"type" => "heading");
					
$of_options_pmc[] = array( "name" =>  "Main Theme Color ",
					"desc" => "Set the main color for your theme.",
					"id" => "mainColor",
					"std" => "#EEC43D",
					"type" => "color");		
					
$of_options_pmc[] = array( "name" =>  "Lower border Color",
					"desc" => "Lower border color for Portfolio categories (best if it is set to darker version of Theme's main Color",
					"id" => "gradient_color",
					"std" => "#ffffff",
					"type" => "color");						
					
					
$of_options_pmc[] = array( "name" =>  "Box Color ",
					"desc" => "Set the box color for your theme.",
					"id" => "boxColor",
					"std" => "#2a2b2c",
					"type" => "color");		
						
$of_options_pmc[] = array( "name" =>  "Shadow Color ",
					"desc" => "Set the Shadow color for your fonts.",
					"id" => "ShadowColorFont",
					"std" => "#ffffff",
					"type" => "color");			
					
$of_options_pmc[] = array( "name" => "Shadow opacity",
					"desc" => "Set Shadow opacity (between 0 and 1).",
					"id" => "ShadowOpacittyColorFont",
					"std" => "0.15",
					"type" => "text"); 	

$of_options_pmc[] = array( "name" => "Styling for header",
                    "type" => "innerheading");
					
$of_options_pmc[] = array( "name" =>  "Upper Bar background color",
					"desc" => "Pick a background color for the Upper Bar background color.",
					"id" => "top_menu_background_color",
					"std" => "#222",
					"type" => "color");					
					
$of_options_pmc[] = array( "name" =>  "Menu background color",
					"desc" => "Pick a background color for the menu.",
					"id" => "menu_background_color",
					"std" => "#222",
					"type" => "color");

$of_options_pmc[] = array( "name" =>  "Header background color",
					"desc" => "Pick a background color for the Header.",
					"id" => "header_background_color",
					"std" => "#ffffff",
					"type" => "color");	

$of_options_pmc[] = array( "name" => "Background Image for the header",
					"desc" => "Upload background image for the header (leave blank if you don't use image)",
					"id" => "image_background_header",
					"std" => "",
					"type" => "upload");	

$of_options_pmc[] = array( "name" => "Show solid background color when using background image?",
					"desc" => "Check this if you wish to use color menu background when using background image.",
					"id" => "use_menu_back",
					"std" => 0,
					"type" => "checkbox");						

$of_options_pmc[] = array( "name" => "Styling for Menu",
                    "type" => "innerheading");
					
$of_options_pmc[] = array( "name" =>  "Menu top border width",
					"desc" => "Set menu top border width (without px).",
					"id" => "menu_top_border",
					"std" => "0",
					"type" => "text");					
					
$of_options_pmc[] = array( "name" =>  "Menu bottom border width",
					"desc" => "Set menu bottom border width (without px).",
					"id" => "menu_bottom_border",
					"std" => "0",
					"type" => "text");
				
					
					
$of_options_pmc[] = array( "name" => "Body background",
                    "type" => "innerheading");
					
$of_options_pmc[] = array( "name" => "Use boxed version?",
					"desc" => "Check this if you wish to use boxed style.",
					"id" => "use_boxed",
					"std" => 0,
					"type" => "checkbox");					
					
$of_options_pmc[] = array( "name" =>  "Body Background Color",
					"desc" => "Pick a background color for the theme.",
					"id" => "body_background_color",
					"std" => "#ffffff",
					"type" => "color");

$of_options_pmc[] = array( "name" => "Enable Background image (for boxed style)",
					"desc" => "Displays image as background.",
					"id" => "background_image_full",
					"std" => 0,
					"type" => "checkbox");
					
$of_options_pmc[] = array( "name" => "Background Image (for boxed style)",
					"desc" => "Upload background image",
					"id" => "image_background",
					"std" => "",
					"type" => "upload");	
					
		
$of_options_pmc[] = array( "name" => "Custom Style",
                    "type" => "innerheading");				
					
$of_options_pmc[] = array( "name" => "Custom Style",
                    "desc" => "Add your custom style.",
                    "id" => "custom_style",
                    "std" => " ",
                    "type" => "textarea-plain");						
	
$of_options_pmc[] = array( "name" => "Typography",
                    "type" => "heading");
					
$of_options_pmc[] = array( "name" => "Body Typography Settings",
					"desc" => "Change body typography. Set the font family, size, color and style.",
					"id" => "body_font",
					"std" => array('size' => '13px','color' => '#2a2b2c','face' => 'arial'),
					"type" => "typography");

$of_options_pmc[] = array( "name" => "Custom Google font for body Typography",
					"desc" => "Change body typography. Here you can add custom <a target ='_blank' href = 'https://www.google.com/fonts'>Google font</a>.",
					"id" => "google_body_custom",
					"std" => "",
					"type" => "text"); 						
					
$of_options_pmc[] = array( "name" => "Heading Typography Settings",
					"desc" => "Change heading typography. Set the font family and style.",
					"id" => "heading_font",
					"std" => array('face' => 'Yanone%20Kaffeesatz:300','style' => 'normal'),
					"type" => "typography");	
					
$of_options_pmc[] = array( "name" => "Custom Google font for heading Typography",
					"desc" => "Change heading typography. Here you can add custom <a target ='_blank' href = 'https://www.google.com/fonts'>Google font</a>.",
					"id" => "google_heading_custom",
					"std" => "",
					"type" => "text"); 						
					
$of_options_pmc[] = array( "name" => "Menu Typography Settings",
					"desc" => "Change munu typography. Set the font family.",
					"id" => "menu_font",
					"std" => array('face' => 'Yanone%20Kaffeesatz:300','style' => 'normal','color' => '#000'),
					"type" => "typography");

$of_options_pmc[] = array( "name" => "Custom Google font for menu Typography",
					"desc" => "Change menu typography. Here you can add custom <a target ='_blank' href = 'https://www.google.com/fonts'>Google font</a>.",
					"id" => "google_menu_custom",
					"std" => "",
					"type" => "text"); 	

$of_options_pmc[] = array( "name" => "Custom Google font for Quote on front Page",
					"desc" => "Change menu typography. Here you can add custom <a target ='_blank' href = 'https://www.google.com/fonts'>Google font</a>.",
					"id" => "google_quote_custom",
					"std" => "",
					"type" => "text"); 					
					
$of_options_pmc[] = array( "name" => "Color for social icons in header (on hover)",
					"desc" => "Change Color for social icons in header (on hover)",
					"id" => "body_box_coler",
					"std" => "#ffffff",
					"type" => "color");		
									
$of_options_pmc[] = array( "name" => "H1 typography",
					"desc" => "Set H1 font size and color.",
					"id" => "heading_font_h1",
					"std" => array('size' => '30px','color' => '#2a2b2c'),
					"type" => "sizeColor");
$of_options_pmc[] = array( "name" => "H2 typography",
					"desc" => "Set H2 font size and color.",
					"id" => "heading_font_h2",
					"std" => array('size' => '22px','color' => '#2a2b2c'),
					"type" => "sizeColor");
					
$of_options_pmc[] = array( "name" => "H3 typography",
					"desc" => "Set H3 font size and color.",
					"id" => "heading_font_h3",
					"std" => array('size' => '20px','color' => '#2a2b2c'),
					"type" => "sizeColor");					
$of_options_pmc[] = array( "name" => "H4typography",
					"desc" => "Set H4 font size and color.",
					"id" => "heading_font_h4",
					"std" => array('size' => '16px','color' => '#2a2b2c'),
					"type" => "sizeColor");	
$of_options_pmc[] = array( "name" => "H5 typography",
					"desc" => "Set H5 font size and color.",
					"id" => "heading_font_h5",
					"std" => array('size' => '14px','color' => '#2a2b2c'),
					"type" => "sizeColor");		
$of_options_pmc[] = array( "name" => "H6 typography",
					"desc" => "Set H6 font size and color.",
					"id" => "heading_font_h6",
					"std" => array('size' => '12px','color' => '#2a2b2c'),
					"type" => "sizeColor");		
										
																							
$of_options_pmc[] = array( "name" => "Social Options",
					"type" => "heading");  
					
$of_options_pmc[] = array( "name" => "Social Icons",
					"desc" => "You can add unlimited number of social Icons and sort them with drag and drop .",
					"id" => "socialicons",
					"std" =>  array('title' => 'Facebook','url' => 'fa-facebook-official','link' => ''),
					"social" => true,
					"sidebar" => false,
					"menu" => false,						
					"type" => "slider");
					
$of_options_pmc[] = array( "name" => "Error page",
					"type" => "heading");      
					
$of_options_pmc[] = array( "name" => "404 Error page Title",
                    "desc" => "Set the title of the Error page (404 not found error).",
                    "id" => "errorpagetitle",
                    "std" => __('OOOPS! 404','pmc-themes'),
                    "type" => "text");	
										
$of_options_pmc[] = array( "name" => "404 Error page Title Content Text",
                    "desc" => "Add a description for your 404 page.",
                    "id" => "errorpage",
                    "std" => __('Sorry, but the page you are looking for has not been found.<br/>Try checking the URL for errors, then hit refresh.</br>Or you can simply click the icon below and go home:)','pmc-themes'),
                    "type" => "textarea");	   	
					
	
$of_options_pmc[] = array( "name" => "Footer Options",
					"type" => "heading");      
		
					
$of_options_pmc[] = array( "name" => "Copyright info",
                    "desc" => "Add your Copyright or some other notice.",
                    "id" => "copyright",
                    "std" => __('&copy; 2011 All rights reserved. ','pmc-themes'),
                    "type" => "textarea");
				
					
$of_options_pmc[] = array( "name" => "Backup Options",
					"type" => "heading");

$of_options_pmc[] = array( "name" => "Backup and Restore Options",
                    "id" => "pmc_backup",
                    "std" => "",
                    "type" => "backup",
					"desc" => 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.',
					);

$of_options_pmc[] = array( "name" => "Transfer Theme Options Data",
                    "id" => "pmc_transfer",
                    "std" => "YTo1NTp7czoxNDoic2hvd3Jlc3BvbnNpdmUiO3M6MToiMSI7czoxMDoidXNlX3Njcm9sbCI7czoxOiIxIjtzOjEwOiJ1c2VfYmxvY2syIjtzOjE6IjEiO3M6NDoibG9nbyI7czo3NToiaHR0cDovL3phcmEucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTUvMDEvemFyYS1ibG9nLWxvZ28ucG5nIjtzOjExOiJsb2dvX3JldGluYSI7czo3NToiaHR0cDovL3phcmEucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTUvMDEvemFyYS1ibG9nLWxvZ28ucG5nIjtzOjExOiJzY3JvbGxfbG9nbyI7czo3NToiaHR0cDovL3phcmEucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTUvMDEvemFyYS1ibG9nLWxvZ28ucG5nIjtzOjc6ImZhdmljb24iO3M6NzM6Imh0dHA6Ly96YXJhLnByZW1pdW1jb2RpbmcuY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzAxL3phcmEtZmF2aWNvbi5wbmciO3M6MTY6Imdvb2dsZV9hbmFseXRpY3MiO3M6MDoiIjtzOjExOiJibG9jazFfaW1nMSI7czo3ODoiaHR0cDovL3phcmEucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTQvMDQvemFyYS1wb3N0LWltYWdlLTMuanBnIjtzOjEyOiJibG9jazFfdGV4dDEiO3M6MjQ6IkFOIE9VVFNJREUgUEhPVE9TSE9PVElORyI7czoxMjoiYmxvY2sxX2xpbmsxIjtzOjU0OiJodHRwOi8vc2NyaWJiby5wcmVtaXVtY29kaW5nLmNvbS9mb3JjZWQtd29ya2luZy1zbWlsZS8iO3M6MTE6ImJsb2NrMV9pbWcyIjtzOjc4OiJodHRwOi8vemFyYS5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxNC8wNC96YXJhLXBvc3QtaW1hZ2UtNS5qcGciO3M6MTI6ImJsb2NrMV90ZXh0MiI7czoyMjoiTU9ERUxJTkcgSU4gVEhFIE5BVFVSRSI7czoxMjoiYmxvY2sxX2xpbmsyIjtzOjYyOiJodHRwOi8vc2NyaWJiby5wcmVtaXVtY29kaW5nLmNvbS9hbWF6aW5nLWF1dHVtbi1waG90b3Nob290aW5nLyI7czoxMToiYmxvY2sxX2ltZzMiO3M6Nzg6Imh0dHA6Ly96YXJhLnByZW1pdW1jb2RpbmcuY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE0LzA0L3phcmEtcG9zdC1pbWFnZS0xLmpwZyI7czoxMjoiYmxvY2sxX3RleHQzIjtzOjI2OiJCQUNLIFRPIFRIRSA3MOKAmVMgV0lUSCBVUyI7czoxMjoiYmxvY2sxX2xpbmszIjtzOjY5OiJodHRwOi8vc2NyaWJiby5wcmVtaXVtY29kaW5nLmNvbS9yZWNyZWF0aW9uLW9mLXRoZS03MHMtcGhvdG9zaG9vdGluZy8iO3M6MTA6ImJsb2NrMl9pbWciO3M6Nzk6Imh0dHA6Ly96YXJhLnByZW1pdW1jb2RpbmcuY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzAxL3phcmEtcXVvdGUtaW1hZ2UtMi5qcGciO3M6MTE6ImJsb2NrMl90ZXh0IjtzOjY5OiJJdCBpcyBkdXJpbmcgb3VyIGRhcmtlc3QgbW9tZW50cyB0aGF0IHdlIG11c3QgZm9jdXMgdG8gc2VlIHRoZSBsaWdodC4iO3M6MTc6ImJsb2NrX2Zvb3Rlcl90ZXh0IjtzOjIxODoi4oCcSSBzdGFydGVkIHdpdGggWmFyYSB0byBwcm92aWRlIHlvdSB3aXRoIDxzcGFuPmRhaWx5IGZyZXNoIG5ldyBpZGVhczwvc3Bhbj4gYWJvdXQgdHJlbmRzLiBJdCBpcyBhIHZlcnkgY2xlYW4gYW5kIGVsZWdhbnQgV29yZHByZXNzIFRoZW1lIHN1aXRhYmxlIGZvciBldmVyeSBibG9nZ2VyLiBQZXJmZWN0IGZvciBzaGFyaW5nIHlvdXIgPHNwYW4+bGlmZXN0eWxlLjwvc3Bhbj7igJ0iO3M6MTI6ImJsb2NrM190aXRsZSI7czoxODoiT1VSIElOU1RBR1JBTSBGRUVEIjtzOjE1OiJibG9jazNfdXNlcm5hbWUiO3M6NzoiemFyYWlyZyI7czoxMDoiYmxvY2szX3VybCI7czoyODoiaHR0cDovL2luc3RhZ3JhbS5jb20vemFyYWlyZyI7czo5OiJtYWluQ29sb3IiO3M6NzoiI0Y0QUZBOSI7czoxNDoiZ3JhZGllbnRfY29sb3IiO3M6NzoiI0Y0QUZBOSI7czo4OiJib3hDb2xvciI7czo3OiIjRkVGNEYzIjtzOjE1OiJTaGFkb3dDb2xvckZvbnQiO3M6NDoiI2ZmZiI7czoyMzoiU2hhZG93T3BhY2l0dHlDb2xvckZvbnQiO3M6MToiMCI7czoyMToiYm9keV9iYWNrZ3JvdW5kX2NvbG9yIjtzOjc6IiNGRUY0RjMiO3M6MjE6ImJhY2tncm91bmRfaW1hZ2VfZnVsbCI7czoxOiIxIjtzOjE2OiJpbWFnZV9iYWNrZ3JvdW5kIjtzOjg4OiJodHRwOi8vc2NyaWJiby5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxNC8xMi9zY3JpYmJvLWJveGVkLWJhY2tncm91bmQuanBnIjtzOjEyOiJjdXN0b21fc3R5bGUiO3M6MDoiIjtzOjk6ImJvZHlfZm9udCI7YTozOntzOjQ6InNpemUiO3M6NDoiMTZweCI7czo1OiJjb2xvciI7czo0OiIjNDQ0IjtzOjQ6ImZhY2UiO3M6MTE6Ik9wZW4lMjBTYW5zIjt9czoxODoiZ29vZ2xlX2JvZHlfY3VzdG9tIjtzOjEyOiJMYXRvOjQwMCw3MDAiO3M6MTI6ImhlYWRpbmdfZm9udCI7YToyOntzOjQ6ImZhY2UiO3M6MTE6Ik9wZW4lMjBTYW5zIjtzOjU6InN0eWxlIjtzOjQ6ImJvbGQiO31zOjIxOiJnb29nbGVfaGVhZGluZ19jdXN0b20iO3M6MjQ6IlBsYXlmYWlyIERpc3BsYXk6NDAwLDcwMCI7czo5OiJtZW51X2ZvbnQiO2E6NDp7czo0OiJzaXplIjtzOjQ6IjE2cHgiO3M6NToiY29sb3IiO3M6NDoiIzQ0NCI7czo0OiJmYWNlIjtzOjExOiJPcGVuJTIwU2FucyI7czo1OiJzdHlsZSI7czo2OiJub3JtYWwiO31zOjE4OiJnb29nbGVfbWVudV9jdXN0b20iO3M6MTY6Ikx1c2l0YW5hOjQwMCw3MDAiO3M6MTk6Imdvb2dsZV9xdW90ZV9jdXN0b20iO3M6OToiUm9jaGVzdGVyIjtzOjE0OiJib2R5X2JveF9jb2xlciI7czo3OiIjZmZmZmZmIjtzOjE1OiJib2R5X2xpbmtfY29sZXIiO3M6NzoiIzM0MzQzNCI7czoxNToiaGVhZGluZ19mb250X2gxIjthOjI6e3M6NDoic2l6ZSI7czo0OiI0OHB4IjtzOjU6ImNvbG9yIjtzOjQ6IiMzMzMiO31zOjE1OiJoZWFkaW5nX2ZvbnRfaDIiO2E6Mjp7czo0OiJzaXplIjtzOjQ6IjQycHgiO3M6NToiY29sb3IiO3M6NDoiIzMzMyI7fXM6MTU6ImhlYWRpbmdfZm9udF9oMyI7YToyOntzOjQ6InNpemUiO3M6NDoiMzZweCI7czo1OiJjb2xvciI7czo0OiIjMzMzIjt9czoxNToiaGVhZGluZ19mb250X2g0IjthOjI6e3M6NDoic2l6ZSI7czo0OiIzMHB4IjtzOjU6ImNvbG9yIjtzOjQ6IiMzMzMiO31zOjE1OiJoZWFkaW5nX2ZvbnRfaDUiO2E6Mjp7czo0OiJzaXplIjtzOjQ6IjI0cHgiO3M6NToiY29sb3IiO3M6NDoiIzMzMyI7fXM6MTU6ImhlYWRpbmdfZm9udF9oNiI7YToyOntzOjQ6InNpemUiO3M6NDoiMjBweCI7czo1OiJjb2xvciI7czo0OiIjMzMzIjt9czoxMToic29jaWFsaWNvbnMiO2E6NTp7aToxO2E6NDp7czo1OiJvcmRlciI7czoxOiIxIjtzOjU6InRpdGxlIjtzOjc6IlR3aXR0ZXIiO3M6MzoidXJsIjtzOjgyOiJodHRwOi8vemFyYS5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxNS8wMS9zY3JpYmJvLXR3aXR0ZXItYWJvdXQucG5nIjtzOjQ6ImxpbmsiO3M6MzI6Imh0dHA6Ly90d2l0dGVyLmNvbS9QcmVtaXVtQ29kaW5nIjt9aToyO2E6NDp7czo1OiJvcmRlciI7czoxOiIyIjtzOjU6InRpdGxlIjtzOjg6IkZhY2Vib29rIjtzOjM6InVybCI7czo4MzoiaHR0cDovL3phcmEucHJlbWl1bWNvZGluZy5jb20vd3AtY29udGVudC91cGxvYWRzLzIwMTUvMDEvc2NyaWJiby1mYWNlYm9vay1hYm91dC5wbmciO3M6NDoibGluayI7czozODoiaHR0cHM6Ly93d3cuZmFjZWJvb2suY29tL1ByZW1pdW1Db2RpbmciO31pOjM7YTo0OntzOjU6Im9yZGVyIjtzOjE6IjMiO3M6NToidGl0bGUiO3M6ODoiRHJpYmJibGUiO3M6MzoidXJsIjtzOjgzOiJodHRwOi8vemFyYS5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxNS8wMS9zY3JpYmJvLWRyaWJiYmxlLWFib3V0LnBuZyI7czo0OiJsaW5rIjtzOjA6IiI7fWk6NDthOjQ6e3M6NToib3JkZXIiO3M6MToiNCI7czo1OiJ0aXRsZSI7czo2OiJGbGlja3IiO3M6MzoidXJsIjtzOjgxOiJodHRwOi8vemFyYS5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxNS8wMS9zY3JpYmJvLWZsaWNrci1hYm91dC5wbmciO3M6NDoibGluayI7czoxODoiaHR0cDovL2ZsaWNrci5jb20vIjt9aTo1O2E6NDp7czo1OiJvcmRlciI7czoxOiI1IjtzOjU6InRpdGxlIjtzOjk6IlBpbnRlcmVzdCI7czozOiJ1cmwiO3M6ODQ6Imh0dHA6Ly96YXJhLnByZW1pdW1jb2RpbmcuY29tL3dwLWNvbnRlbnQvdXBsb2Fkcy8yMDE1LzAxL3NjcmliYm8tcGludGVyZXN0LWFib3V0LnBuZyI7czo0OiJsaW5rIjtzOjMzOiJodHRwOi8vd3d3LnBpbnRlcmVzdC5jb20vZ2xqaXZlYy8iO319czoxNDoiZXJyb3JwYWdldGl0bGUiO3M6MTA6Ik9PT1BTISA0MDQiO3M6OToiZXJyb3JwYWdlIjtzOjMyNjoiU29ycnksIGJ1dCB0aGUgcGFnZSB5b3UgYXJlIGxvb2tpbmcgZm9yIGhhcyBub3QgYmVlbiBmb3VuZC48YnIvPlRyeSBjaGVja2luZyB0aGUgVVJMIGZvciBlcnJvcnMsIHRoZW4gaGl0IHJlZnJlc2guPC9icj5PciB5b3UgY2FuIHNpbXBseSBjbGljayB0aGUgaWNvbiBiZWxvdyBhbmQgZ28gaG9tZTopDQo8YnI+PGJyPg0KPGEgaHJlZiA9IFwiaHR0cDovL3RlcmVzYS5wcmVtaXVtY29kaW5nLmNvbS9cIj48aW1nIHNyYyA9IFwiaHR0cDovL2J1bGxzeS5wcmVtaXVtY29kaW5nLmNvbS93cC1jb250ZW50L3VwbG9hZHMvMjAxMy8wOC9ob21lSG91c2VJY29uLnBuZ1wiPjwvYT4iO3M6OToiY29weXJpZ2h0IjtzOjE4NToiPGRpdiBjbGFzcyA9XCJsZWZ0LWZvb3Rlci1jb250ZW50XCI+wqkgMjAxNSBjb3B5cmlnaHQgUFJFTUlVTUNPRElORyAvLyBBbGwgcmlnaHRzIHJlc2VydmVkPC9kaXY+DQoNCjxkaXYgY2xhc3MgPVwicmlnaHQtZm9vdGVyLWNvbnRlbnRcIj5aYXJhIHdhcyBtYWRlIHdpdGggbG92ZSBieSBQcmVtaXVtY29kaW5nPC9kaXY+DQoiO3M6MTA6InVzZV9ibG9jazEiO3M6MDoiIjtzOjEwOiJ1c2VfYmxvY2szIjtzOjA6IiI7czoxMzoidXNlX2Z1bGx3aWR0aCI7czowOiIiO3M6OToidXNlX2JveGVkIjtzOjA6IiI7fQ==",
                    "type" => "transfer",
					"desc" => 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".
						',
					);		
					
	}
}
?>
