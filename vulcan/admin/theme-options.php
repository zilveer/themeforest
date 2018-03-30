<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options(){
	
// VARIABLES
$shortname = "vulcan";
if( function_exists( 'wp_get_theme' ) ) {
	if( is_child_theme() ) {
		$temp_obj = wp_get_theme();
		$theme_obj = wp_get_theme( $temp_obj->get('Template') );
	} else {
		$theme_obj = wp_get_theme();    
	}
	$themename = $theme_obj->get('Name');
}

// Populate OptionsFramework option in array for use in theme
global $of_options;
$of_options = get_option('of_options');

$GLOBALS['template_path'] = OF_DIRECTORY;

//Access the WordPress Categories via an Array
$of_categories = array();  
$of_categories_obj = get_categories('hide_empty=0');
foreach ($of_categories_obj as $of_cat) {
  $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
}    
//$categories_tmp = array_unshift($of_categories, "Select a category:");    

//Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages('parent=0');
foreach ($of_pages_obj as $of_page) {
  $of_pages[$of_page->ID] = $of_page->post_title; 
}
//$of_pages_tmp = array_unshift($of_pages, "Select a page:");       

// Image Alignment radio box
$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 

// Image Links to Options
$options_image_link_to = array("image" => "The Image","post" => "The Post"); 

//Testing 
$options_select = array("one","two","three","four","five"); 
$options_radio = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five"); 

//Stylesheets Reader
$alt_stylesheet_path = OF_FILEPATH . '/styles/';
$alt_stylesheets = array();


/* Get Cufon fonts into a drop-down list */
$cufonts = array();
if(is_dir(TEMPLATEPATH . "/js/fonts/")) {
	if($open_dirs = opendir(TEMPLATEPATH . "/js/fonts")) {
		while(($cufontfonts = readdir($open_dirs)) !== false) {
			if(stristr($cufontfonts, ".js") !== false) {
				$cufonts[] = $cufontfonts;
			}
		}
	}
}
$cufonts_dropdown = $cufonts;

//More Options
$uploads_arr = wp_upload_dir();
$all_uploads_path = $uploads_arr['path'];
$all_uploads = get_option('of_uploads');
$other_entries = array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
$body_repeat = array("no-repeat","repeat-x","repeat-y","repeat");
$body_pos = array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");

$slide_effects = array("fade","cover","uncover","scrollUp","scrollDown","scrollRight","scrollLeft","scrollHorz","scrollVert");
// Set the Options Array
$options = array();

$options[] = array( "name" => "General Settings",
                    "icon" => "general",
                    "type" => "heading");

$options[] = array( "type" => "info",
                    "std" => "General settings for your site that will be used in general pages");

$options[] = array( "name" => "Custom Logo",
					"desc" => "Upload your site logo, recommended size is 134x46px",
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
					"id" => $shortname."_ga_code",
					"std" => "",
					"type" => "textarea");                       
                                       
$options[] = array( "name" => "404 Text",
					"desc" => "Enter your 404 (Page Not Found) Text here.",
					"id" => $shortname."_404_text",
					"std" => "",
					"type" => "textarea");         

$options[] = array( "name" => "Footer Logo",
					"desc" => "Upload your footer logo site, recommended size is 132x46px",
					"id" => $shortname."_footer_logo",
					"std" => "",
					"type" => "upload");
          
$options[] = array( "name" => "Footer Text",
					"desc" => "Enter your site copyright here.",
					"id" => $shortname."_footer_text",
					"std" => "",
					"type" => "textarea");                                                

$options[] = array( "name" => "Pages &amp; Categories",
                    "icon" => "page_cat",
                    "type" => "heading");
                              
$options[] = array( "name" => "Your Services page",
					"desc" => "Select your Services page.",
					"id" => $shortname."_services_pid",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
          					
$options[] = array( "name" => "Services page Order",
					"desc" => "Select your order parameter for your services page tems.",
					"id" => $shortname."_services_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				
          
$options[] = array( "name" => "Homepage Settings",
                    "icon" => "homepage",
                    "type" => "heading");

$options[] = array( "type" => "info",
                    "std" => "Site Slogan setting for your site");
                    
$options[] = array( "name" => "Site Slogan",
					"desc" => "Enter your brief site slogan here",
					"id" => $shortname."_site_slogan",
					"std" => "",
					"type" => "textarea");
					       
$options[] = array( "type" => "info",
                    "std" => "3 columns Site features for homepage");
                    
$options[] = array( "name" => "Title for Homepage features box #1",
					"desc" => "Enter your title for homepage features box #1",
					"id" => $shortname."_homebox_title1",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Custom URL for Homepage features box #1",
					"desc" => "Enter your custom URL for homepage features box #1",
					"id" => $shortname."_homebox_desturl1",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Icon for Homepage features box #1",
					"desc" => "Upload your icon for homepage features box #1, recommended size 68x64px",
					"id" => $shortname."_homebox_image1",
					"std" => "",
					"type" => "upload");
              
$options[] = array( "name" => "Short Description for Homepage features box #1",
					"desc" => "Enter your brief short description for homepage features box #1",
					"id" => $shortname."_homebox_desc1",
					"std" => "",
					"type" => "textarea");  

$options[] = array( "name" => "Title for Homepage features box #2",
					"desc" => "Enter your title for homepage features box #2",
					"id" => $shortname."_homebox_title2",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Custom URL for Homepage features box #2",
					"desc" => "Enter your custom URL for homepage features box #2",
					"id" => $shortname."_homebox_desturl2",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Icon for Homepage features box #2",
					"desc" => "Upload your icon for homepage features box #2, recommended size 68x64px",
					"id" => $shortname."_homebox_image2",
					"std" => "",
					"type" => "upload");
              
$options[] = array( "name" => "Short Description for Homepage features box #2",
					"desc" => "Enter your brief short description for homepage features box #2",
					"id" => $shortname."_homebox_desc2",
					"std" => "",
					"type" => "textarea");  
                 
$options[] = array( "name" => "Title for Homepage features box #3",
					"desc" => "Enter your title for homepage features box #3",
					"id" => $shortname."_homebox_title3",
					"std" => "",
					"type" => "text");
					
$options[] = array( "name" => "Custom URL for Homepage features box #3",
					"desc" => "Enter your custom URL for homepage features box #3",
					"id" => $shortname."_homebox_desturl3",
					"std" => "",
					"type" => "text"); 
					
$options[] = array( "name" => "Icon for Homepage features box #3",
					"desc" => "Upload your icon for homepage features box #3, recommended size 68x64px",
					"id" => $shortname."_homebox_image3",
					"std" => "",
					"type" => "upload");
              
$options[] = array( "name" => "Short Description for Homepage features box #3",
					"desc" => "Enter your brief short description for homepage features box #3",
					"id" => $shortname."_homebox_desc3",
					"std" => "",
					"type" => "textarea");  
          
$options[] = array( "type" => "info",
                    "std" => "Homepage Contact Info Section");
					
$options[] = array( "name" => "Text Button",
					"desc" => "Enter your text button here",
					"id" => $shortname."_contactbox_text",
					"std" => "",
					"type" => "text");

$options[] = array( "name" => "Contact info Link",
					"desc" => "Enter custom URL for contact info link",
					"id" => $shortname."_contactbox_link",
					"std" => "",
					"type" => "text");	          

$options[] = array( "name" => "Icon/Image for Contact Info",
					"desc" => "upload your icon or image for your quote box section, recommended size 63x56px",
					"id" => $shortname."_contactbox_image",
					"std" => "",
					"type" => "upload");

$options[] = 	array(	"name" => "Welcome Title",
			"desc" => "Enter Your Welcome title here.",
            "id" => $shortname."_welcome_title",
            "type" => "text");
                        
$options[] = 	array(	"name" => "Website Description, will be displayed below 3 columns box",
			"desc" => "Enter your <strong>Site Description</strong> here",
			     "std" => "",
            "id" => $shortname."_site_desc",
            "type" => "textarea");    
          				
$options[] = array( "name" => "Slideshow Setting",
                    "icon" => "slideshow",
                    "type" => "heading");
					
$options[] = array( "name" => "Slideshow Items Order",
					"desc" => "Select your order parameter for slideshow items.",
					"id" => $shortname."_slideshow_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$options[] = array( "name" => "Slide Speed",
					"desc" => "Please enter your slideshow speed, eg. 3000",
					"id" => $shortname."_slideshow_speed",
					"std" => "3000",
					"type" => "text");
                    
$options[]	= array(	"name" => "Transition Types",
    			"desc" => "Please select transition types for your slideshow translation effect.",
    			"id" => $shortname."_slide_transition",
    			"type" => "select",
          "options" => $slide_effects);
					                    
$options[] = array( "name" => "Portfolio Options",
          "icon" => "portfolio",
					"type" => "heading");

$options[] = array( "name" => "Your Portfolio page",
					"desc" => "Select your contact page.",
					"id" => $shortname."_portfolio_page",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
          
$options[] = array( "name" => "Portfolio Items Order",
					"desc" => "Select your order parameter for portfolio items.",
					"id" => $shortname."_portfolio_order",
					"std" => "",
					"type" => "select",
					"options" => array("author","date","title","modified","menu_order","parent","ID","rand"));				                                                    

$options[] = 	array(	"name" => "Portfolio Page Heading",
			"desc" => "Enter the text Heading for Portfolio page.",
            "id" => $shortname."_porto_heading",
            "type" => "text");
                       
$options[] = 	array(	"name" => "Portfolio Page Description",
			"desc" => "Will be displayed in Portfolio page content.",
            "id" => $shortname."_porto_text",
            "std" => "",
            "type" => "textarea");
                           
$options[] = 	array(	"name" => "Number of posts per page to display in Portfolio Page",
			"desc" => "Fill the number of post to display in Portfolio Page alternative.",
			"id" => $shortname."_porto_num",
			"std" => "",
			"type" => "text");
          
$options[] =   array(	"name" => "Display Portfolio items as two columns?",
          "desc" => "please check this option if you want to display your portfolio itesm in two columns.",
            "id" => $shortname."_portfolio_2col",
            "std" => "",
            "type" => "checkbox");  
                                       
$options[] = array( "name" => "Blog Options",
          "icon" => "blog",
					"type" => "heading"); 	   
                              
$options[] = array( "name" => "Your Blog page",
					"desc" => "Select your blog page.",
					"id" => $shortname."_blog_pid",
					"std" => "",
					"type" => "select",
					"options" => $of_pages);
          					
$options[] = array( "name" => "Blog Categories",
					"desc" => "Please check the categories that you want to include in Blog page.",
					"id" => $shortname."_blog_cats_include",
					"std" => "",
					"type" => "multicheck",
					"options" => $of_categories);				  
					
$options[] = 	array(	"name" => "Number of posts to display in Blog Page",
			"desc" => "Select the number of post to display in Blog Page.",
			"id" => $shortname."_blog_num",
			"std" => "",
			"type" => "text");

$options[] = 	array(	"name" => "Number of Words",
			"desc" => "Enter the number of words for Blog Excerpt.",
            "id" => $shortname."_blogtext",
            "type" => "text");

$options[] = 	array(	"name" => "Read More text",
			"desc" => "Enter the text for read more (eg : Read More, Continue Reading).",
            "id" => $shortname."_readmoretext",
            "type" => "text");
$options[] =   array(	"name" => "Disable Author Box in single post?",
    "desc" => "check this option if you want to disable Author Box in Single Post",
    "id" => $shortname."_disable_authorbox",
    "std" => "false",
    "type" => "checkbox");
                                                                                                      
$options[] = array( "name" => "Styling Options",
          "icon" => "styling",
					"type" => "heading");

$options[] = array( "name" => "Cufon Font",
					"desc" => "Select your default cufon font.",
					"id" => $shortname."_cufon_fonts",
					"std" => "",
					"type" => "select",
					"options" => $cufonts);
          					
$url_bgcolor =  get_stylesheet_directory_uri()  . '/admin/images/bgcolor/';
$options[] = array( "name" => "Predefined Skins",
					"desc" => "Please select of one of predefined skins as your default skin.",
					"id" => $shortname."_style",
					"std" => "",
					"type" => "images",
					"options" => array(
						'green.css' => $url_bgcolor . 'green.png',
						'blue.css' => $url_bgcolor . 'blue.png',
						'purple.css' => $url_bgcolor . 'purple.png',
            'orange.css' => $url_bgcolor . 'orange.png',
            'default.css' => $url_bgcolor . 'dark.png'
            ));
          
$options[] = array( "name" => "Body Text Typograpy",
					"desc" => "Please set this option if you want to use your custom styling for body text paragraph",
					"id" => $shortname."_custom_body_text",
					"std" => array('size' => '12','unit' => 'px','face' => 'Tahoma, Arial, verdana','color' => '#a5a6a6'),
					"type" => "typography");
					
$options[] = array( "name" => "Custom CSS",
          "desc" => "Quickly add some CSS to your theme by adding it to this block.",
          "id" => $shortname."_custom_css",
          "std" => "",
          "type" => "textarea");
          
$options[] = array( "name" => "Contact Info",
          "icon" => "contact",
					"type" => "heading");      
          
$options[] = 	array(	"name" => "Latitude",
			"desc" => "Enter your latitude here, for quick search your latitude, please visit <a href='http://universimmedia.pagesperso-orange.fr/geo/loc.htm'>http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a>",
			"id" => $shortname."_info_latitude",
			"type" => "text");

$options[] = 	array(	"name" => "Longitude",
			"desc" => "Enter your longitude here, for quick search your longitude, <a href='http://universimmedia.pagesperso-orange.fr/geo/loc.htm'>http://universimmedia.pagesperso-orange.fr/geo/loc.htm</a>",
			"id" => $shortname."_info_longitude",
			"type" => "text");
      
$options[] =	array(	"name" => "Address",
			"desc" => "Please enter your office address here.",
			"id" => $shortname."_info_address",
			"type" => "textarea");
      
$options[] = 	array(	"name" => "Phone",
			"desc" => "Enter your phone number here.",
			"id" => $shortname."_info_phone",
			"type" => "text");
      
$options[] = 	array(	"name" => "Faximile",
			"desc" => "Enter your Faximile number here.",
			"id" => $shortname."_info_fax",
			"type" => "text");
      		
$options[] = 	array(	"name" => "Email Address",
			"desc" => "Enter the Email address from your company here.",
			"id" => $shortname."_info_email",
			"type" => "text");

$options[] = 	array(	"name" => "Sucess Message",
			"desc" => "Please enter the success message for contact form when email successfully sent.",
			"id" => $shortname."_success_msg",
      "type" => "textarea");		
      
$options[] = array( "type" => "info",
            "std" => "Twitter Account Setup");
           	  
$options[] = array( "name" => "Twitter ID",
					"desc" => "Please add your Twitter ID here.",
					"id" => $shortname."_twitter_id",
					"std" => "",
					"type" => "text");  

$options[] = array( "name" => "Consumer  key",
					"desc" => "Please add your Consumer  Key here.",
					"id" => $shortname."_user_consumer_key",
					"std" => "",
					"type" => "text"); 
          
$options[] = array( "name" => "Consumer  secret",
					"desc" => "Please add your Consumer  Secret here.",
					"id" => $shortname."_user_consumer_secret",
					"std" => "",
					"type" => "text"); 
          
          
$options[] = array( "name" => "Access token",
					"desc" => "Please add your Access Token here.",
					"id" => $shortname."_user_access_token",
					"std" => "",
					"type" => "text"); 
          
$options[] = array( "name" => "Access token secret",
					"desc" => "Please add your Access token secret here.",
					"id" => $shortname."_user_access_token_secret",
					"std" => "",
					"type" => "text");
          
update_option('of_template',$options); 					  
update_option('of_themename',$themename);   
update_option('of_shortname',$shortname);

}
}
?>
