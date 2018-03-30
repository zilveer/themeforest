<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$themename = 'Bookcase';
$themename = 'Theme Options';
$shortname = "of";

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

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

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("Top" => "Top","Upper Middle" => "Upper Middle","Lower Middle" => "Lower Middle","Bottom" => "Bottom","Off" => "Off"); 
$options_googlefonts = array("Arial" => "Arial", "Georgia" => "Georgia", "Tahoma" => "Tahoma", "Verdana" => "Verdana", 
"Lobster Two" => "Lobster Two", "Redressed" => "Redressed", "Nixie One" => "Nixie One", "Shadows Into Light" => "Shadows Into Light",
"Jura" => "Jura", "Kameron" => "Kameron", "Zeyada" => "Zeyada", "Special Elite" => "Special Elite",  "Cedarville Cursive" => "Cedarville Cursive", "Artifika" => "Artifika", 
"La Belle Aurore" => "La Belle Aurore", "Maven Pro" => "Maven Pro", "Mako" => "Mako","Metrophobic" => "Metrophobic","Shanti" => "Shanti","Play" => "Play","Judson" => "Judson",
"Didact Gothic" => "Didact Gothic","Rokkitt" => "Rokkitt","Pacifico" => "Pacifico","Miltonian" => "Miltonian","Expletus Sans" => "Expletus Sans",
"League Script" => "League Script","Quattrocento" => "Quattrocento","Kreon" => "Kreon","Walter Turncoat" => "Walter Turncoat","Architects Daughter" => "Architects Daughter",
"Orbitron" => "Orbitron","EB Garamond" => "EB Garamond","Indie Flower" => "Indie Flower","Rock Salt" => "Rock Salt","Sniglet" => "Sniglet",
"Lekton" => "Lekton","Bevan" => "Bevan","Chewy" => "Chewy","Arvo" => "Arvo","PT Serif" => "PT Serif",
"Goudy Bookletter 1911" => "Goudy Bookletter 1911","Allerta" => "Allerta", "Open Sans" => "Open Sans",
"Gruppo" => "Gruppo","Permanent Marker" => "Permanent Marker","Bentham" => "Bentham","Yanone Kaffeesatz" => "Yanone Kaffeesatz","Philosopher" => "Philosopher",
"Neuton" => "Neuton","Josefin Sans" => "Josefin Sans","Lobster" => "Lobster","Old Standard TT" => "Old Standard TT","Cantarell" => "Cantarell","Droid Serif" => "Droid Serif",
"Kranky" => "Kranky","PT Sans" => "PT Sans","Ubuntu" => "Ubuntu","Tinos" => "Tinos","Molengo" => "Molengo","Cardo" => "Cardo","Droid Sans" => "Droid Sans", "Covered By Your Grace" => "Covered By Your Grace","Homemade Apple" => "Homemade Apple",	
"Geo" => "Geo","Nobile" => "Nobile","Merriweather" => "Merriweather","Vibur" => "Vibur","Just Another Hand" => "Just Another Hand","OFL Sorts Mill Goudy TT" => "OFL Sorts Mill Goudy TT","IM Fell English" => "IM Fell English","Neucha" => "Neucha","Josefin Slab" => "Josefin Slab","Vollkorn" => "Vollkorn",
"Crimson Text" => "Crimson Text","Just Me Again Down Here" => "Just Me Again Down Here","Sunshiney" => "Sunshiney");



//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
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

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

// Set the Options Array
$options = array();
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."wrench.png' class='headingicon'>General",				 
					"type" => "heading");
					

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload a logo for your theme, or specify the image address of your online logo. (http://yoursite.com/logo.png).<br /><br /> Image-size should be 300px x 65px.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "upload");
					
$options[] = array( "name" => "Custom Favicon",
					"desc" => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon.",
					"id" => $shortname."_custom_favicon",
					"std" => "",
					"type" => "upload"); 
                                               
$options[] = array( "name" => "Tracking Code",
					"desc" => "Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.",
					"id" => $shortname."_google_analytics",
					"std" => "",
					"type" => "textarea");    

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."paintcan.png' class='headingicon'>Skin",				 
					"type" => "heading");


$url =  get_template_directory_uri() .'/images/';
$options[] = array( "name" => __('Theme Skin', 'framework'),
					"desc" => "Select the Theme Skin.",
					"id" => $shortname."_theme_skin",
					"std" => "Light",
					"type" => "images",
					"options" => array(
						'Light' => $url . 'light-skin.png',			   
						'Dark' => $url . 'dark-skin.png',			   
						));
					//"options" => $alt_stylesheets);
					
					$url =  get_template_directory_uri() .'/images/skins/dividers/';
					
					
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."palette.png' class='headingicon'>Customize",				 
					"type" => "heading"); 

$url =  get_template_directory_uri() .'/images/skins/textures/';
$options[] = array( "name" => "Background Texture",
					"desc" => "Choose a texture overlay for your background.",
					"id" => $shortname."_texture_bg",
					"std" => "",
					"type" => "images",
					"options" => array(
						'none' => $url . 'call-none.png',
						$url . 'grain.png' => $url . 'grainthumb.png',
						$url . 'canvas.png' => $url . 'canvasthumb.png',
						$url . 'linen.png' => $url . 'linenthumb.png',
						$url . 'vertical-stripes.png' => $url . 'vertical-stripesthumb.png',
						$url . 'dots.png' => $url . 'dotsthumb.png',
						));

$options[] = array( "name" => "Custom Background Image",
					"desc" => "Upload a custom background image for your theme, or specify the image address of your online background image. (http://yoursite.com/background.png).<br /><br /> Image will be centered and horizontally tile in the featured background area.",
					"id" => $shortname."_background_image",
					"std" => "",
					"type" => "upload");

$options[] = array( "name" => "Top Logo Padding",
					"desc" => "Top Padding for the Logo Section.",
					"id" => $shortname."_logo_padding",
					"std" => "50",
					"type" => "text"); 

$options[] = array( "name" => "Top Content Padding",
					"desc" => "Top Padding for the Content Section.",
					"id" => $shortname."_content_padding",
					"std" => "50",
					"type" => "text"); 

$options[] = array( "name" => "Footer Always Open",
					"desc" => "Select whether you want the footer to be not fixed to the bottom of the page and appear within normal text flow.",
					"id" => $shortname."_open_footer",
					"std" => "false",
					"type" => "radio",
					"options" =>  array(
						'Yes' => 'Yes',
						'No' => 'No'
						));
					
$options[] = array( "name" => "Custom CSS",
                    "desc" => "Quickly add some CSS to your theme by adding it to this block.",
                    "id" => $shortname."_custom_css",
                    "std" => "",
                    "type" => "textarea");

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."color_wheel.png' class='headingicon'>Buttons &amp; Links",				 
					"type" => "heading");   

$options[] = array( "name" => "Button Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_button_color",
					"std" => "#212121",
					"type" => "color"); 

$options[] = array( "name" => "Button Hover Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_button_hover_color",
					"std" => "#555555",
					"type" => "color"); 

$options[] = array( "name" => "Link Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_link_color",
					"std" => "#212121",
					"type" => "color"); 

$options[] = array( "name" => "Link Hover Color",
					"desc" => "Select Your Top Section Font Color. Overwrites theme color.",
					"id" => $shortname."_link_hover_color",
					"std" => "#555555",
					"type" => "color"); 


$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."house.png' class='headingicon'>Homepage",				 
					"type" => "heading");

$options[] = array( "name" => "Item Slideshow AutoPlay",
					"desc" => "Select whether you want the portfolio images to automatically play.",
					"id" => $shortname."_autoplay",
					"std" => "false",
					"type" => "radio",
					"options" =>  array(
						'true' => 'On',
						'false' => 'Off'
						));

$options[] = array( "name" => "Autoplay Delay",
					"desc" => "Type in the delay time <b>(in milliseconds)</b> your want the slider to delay between slides.",
					"id" => $shortname."_autoplay_delay",
					"std" => "3500",
					"type" => "text"); 

$options[] = array( "name" => "Site Tagline",
					"desc" => "This is a tagline for your site beneath the logo.",
					"id" => $shortname."_site_tagline",
					"std" => "My Ultra Interactive Online Portfolio.",
					"type" => "text"); 

$options[] = array( "name" => "Project Posts Per Page",
					"desc" => "How many projects you want to display on the homepage/skills pages at a time.",
					"id" => $shortname."_project_posts",
					"std" => "30",
					"type" => "text"); 

$options[] = array( "name" => "Project Pagination",
					"desc" => "Select whether you want pagintation on homepage and skills pages. Proper Pagination plugin must be enabled.",
					"id" => $shortname."_project_pagination",
					"std" => "Off",
					"type" => "radio",
					"options" =>  array(
						'On' => 'On',
						'Off' => 'Off'
						));


$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."photos.png' class='headingicon'>Portfolio",				 
					"type" => "heading");


$options[] = array( "name" => "Portfolio Title",
					"desc" => "Title of the portfolio section.",
					"id" => $shortname."_portfolio_title",
					"std" => "Featured Projects",
					"type" => "text"); 

$options[] = array( "name" => "PrettyPhoto Gallery Mode",
					"desc" => "Select whether you want your popup to have gallery options.",
					"id" => $shortname."_prettyphoto_gallery",
					"std" => "prettyPhoto",
					"type" => "radio",
					"options" =>  array(
					'prettyPhoto[pp_gal]' => 'On',
					'prettyPhoto' => 'Off'
					));

$options[] = array( "name" => "PrettyPhoto Skin",
					"desc" => "Choose the skin for your PrettyPhoto popups.",
					"id" => $shortname."_prettyphoto_skin",
					"std" => "pp_default",
					"type" => "select2",
					"options" => array(
					'pp_default' => 'Default',	
					'facebook' => 'Facebook',	
					'dark_rounded' => 'Dark Rounded',	
					'dark_square' => 'Dark Square',	
					'light_rounded' => 'Light Rounded',	
					'light_square' => 'Light Square'	
					));

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."email.png' class='headingicon'>Forms",				 
					"type" => "heading");

$options[] = array( "name" => "Contact Email Address",
					"desc" => "Type in the email address you want the contact and quote request forms to mail to.",
					"id" => $shortname."_mail_address",
					"std" => "",
					"type" => "text"); 

$options[] = array( "name" => "Enable Quote Request Form",
					"desc" => "Activate to add a quote request form to the contact page.",
					"id" => $shortname."_quote_request",
					"std" => "true",
					"type" => "checkbox"); 

$options[] = array( "name" => "Quote Request Service Items",
					"desc" => "Type in a list of service items you'd like to add to the dropdown menu. Separate each with a comma.",
					"id" => $shortname."_service_items",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => "Quote Request Budget Options",
					"desc" => "Type in a list of the budget options you'd like to add to the form. Separate each with a comma.",
					"id" => $shortname."_budget_options",
					"std" => "",
					"type" => "textarea"); 

$options[] = array( "name" => "Successfully Sent Heading",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_heading",
					"std" => "Thank you for your email.",
					"type" => "text"); 

$options[] = array( "name" => "Successfully Sent Description",
					"desc" => "Heading for a successfully sent contact or quote form.",
					"id" => $shortname."_sent_description",
					"std" => "It will be answered as soon as possible.",
					"type" => "text"); 
$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."font.png' class='headingicon'>Fonts",				 
					"type" => "heading");

$options[] = array( "name" => "Heading Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_heading_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 

$options[] = array( "name" => "Secondary Heading Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_secondary_font",
					"std" => "Open Sans",
					"type" => "select2",	
					"options" => $options_googlefonts);

$options[] = array( "name" => "Tiny Details Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_tiny_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 

$options[] = array( "name" => "Paragraph Font",
					"desc" => "Font Settings for sitewide fonts excluding the Top Featured Area. For previews, visit <a href='http://www.google.com/webfonts' target='_blank'>The Google Fonts Homepage</a>",
					"id" => $shortname."_p_font",
					"std" => "Open Sans",
					"type" => "select2",
					"options" => $options_googlefonts); 

$url =  get_template_directory_uri() .'/admin/images/icons/';
$options[] = array( "name" => "<img src='".$url."tab.png' class='headingicon'>Tabs",				 
					"type" => "heading");

$url =  get_template_directory_uri() .'/images/icons/';
$options[] = array( "name" => "Featured Tabs Icons",
					"desc" => "Choose an icon for the tab features.",
					"id" => $shortname."_icons",
					"std" => "",
					"type" => "images",
					"options" => array(
						$url . 'silver_orb.gif' => $url . 'silver_orb.gif',
						$url . 'dark_orb.gif' => $url . 'dark_orb.gif',
						$url . 'green_check.gif' => $url . 'green_check.gif',
						$url . 'grey_check.gif' => $url . 'grey_check.gif',
						$url . 'arrow_right.gif' => $url . 'arrow_right.gif',
						$url . 'arrow_right_grey.gif' => $url . 'arrow_right_grey.gif',
						$url . 'pin_blue.gif' => $url . 'pin_blue.gif',
						$url . 'pin_grey.gif' => $url . 'pin_grey.gif',
						$url . 'gear_icon.png' => $url . 'gear_icon.png',
						$url . 'light_icon.png' => $url . 'light_icon.png',
						$url . 'micro_icon.png' => $url . 'micro_icon.png',
						$url . 'pencil_icon.png' => $url . 'pencil_icon.png',
						$url . 'user_icon.png' => $url . 'user_icon.png',
						$url . 'comment.gif' => $url . 'comment.gif',
						$url . 'flag_green.gif' => $url . 'flag_green.gif',
						$url . 'flag_red.gif' => $url . 'flag_red.gif',
						$url . 'flag_white.gif' => $url . 'flag_white.gif',
						$url . 'folder.gif' => $url . 'folder.gif',
						$url . 'icon_accept.gif' => $url . 'icon_accept.gif',
						$url . 'icon_airmail.gif' => $url . 'icon_airmail.gif',
						$url . 'icon_attachment.gif' => $url . 'icon_attachment.gif',
						$url . 'icon_clock.gif' => $url . 'icon_clock.gif',
						$url . 'icon_favourites.gif' => $url . 'icon_favourites.gif',
						$url . 'icon_home.gif' => $url . 'icon_home.gif',
						$url . 'icon_key.gif' => $url . 'icon_key.gif',
						$url . 'icon_package.gif' => $url . 'icon_package.gif',
						$url . 'icon_security.gif' => $url . 'icon_security.gif',
						$url . 'icon_settings.gif' => $url . 'icon_settings.gif',
						$url . 'icon_user.gif' => $url . 'icon_user.gif',
						$url . 'icon_wand.gif' => $url . 'icon_wand.gif',
						$url . 'icon_world.gif' => $url . 'icon_world.gif',
						$url . 'image.gif' => $url . 'image.gif',
						$url . 'note.gif' => $url . 'note.gif',
						$url . 'page_bookmark.gif' => $url . 'page_bookmark.gif',
						$url . 'page_code.gif' => $url . 'page_code.gif',						
						));

$options[] = array( "name" => "Custom Icon",
					"desc" => "Upload a custom Featured Tab Icon.<br /><b>Must be 16px x 16px.</b>",
					"id" => $shortname."_custom_icon",
					"std" => "",
					"type" => "upload_min");  

update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>