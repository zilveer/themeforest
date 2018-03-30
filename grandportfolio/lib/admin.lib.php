<?php

//Begin Create customizer styling import options
$customizer_styling_arr = array( 
	array('id'	=>	'demo99', 'title' => 'Classic'),
	array('id'	=>	'demo1', 'title' => 'Architect'),
	array('id'	=>	'demo2', 'title' => 'Blogger'),
	array('id'	=>	'demo3', 'title' => 'Creative & Design Agency'),
	array('id'	=>	'demo4', 'title' => 'Fashion Designer'),
	array('id'	=>	'demo5', 'title' => 'Music Band & Singer'),
	array('id'	=>	'demo6', 'title' => 'Photographer'),
	array('id'	=>	'demo7', 'title' => 'Magazine & Publisher'),
	array('id'	=>	'demo8', 'title' => 'Agency Company'),
	array('id'	=>	'demo9', 'title' => 'Creative Company'),
);

$customizer_styling_html = '';

foreach($customizer_styling_arr as $customizer_styling)
{
	$customizer_styling_html.= '
		<li data-styling="'.$customizer_styling['id'].'">
	    	<div class="item_thumb"><img src="'.get_template_directory_uri().'/cache/demos/customizer/screenshots/'.$customizer_styling['id'].'.png" alt=""/></div>
	    	<div class="item_content">
			    '.$customizer_styling['title'].'
			</div>
	    </li>';
}

//End Create customizer styling import options

//Begin Create demo import options
$demo_import_options_arr = array( 
	array('id'	=>	'demo99', 'title' => 'Classic', 'demo' => 99),
	array('id'	=>	'demo1', 'title' => 'Architect', 'demo' => 1),
	array('id'	=>	'demo2', 'title' => 'Blogger', 'demo' => 2),
	array('id'	=>	'demo3', 'title' => 'Creative & Design Agency', 'demo' => 3),
	array('id'	=>	'demo4', 'title' => 'Fashion Designer', 'demo' => 4),
	array('id'	=>	'demo5', 'title' => 'Music Band & Singer', 'demo' => 5),
	array('id'	=>	'demo6', 'title' => 'Photographer', 'demo' => 6),
	array('id'	=>	'demo7', 'title' => 'Magazine & Publisher', 'demo' => 7),
	array('id'	=>	'demo8', 'title' => 'Agency Company', 'demo' => 8),
	array('id'	=>	'demo9', 'title' => 'Creative Company', 'demo' => 9),
);
//End Create demo import options

$demo_import_options_html = '';

foreach($demo_import_options_arr as $demo_import_option)
{
$demo_import_options_html.= '<li class="fullwidth" data-demo="'.$demo_import_option['demo'].'">
		    	<div class="item_content_wrapper">
		    		<div class="item_content">
		    			<div class="item_thumb"><img src="'.get_template_directory_uri().'/cache/demos/customizer/screenshots/'.$demo_import_option['id'].'.png" alt=""/></div>
		    			<div class="item_content">
		    				<h3>'.$demo_import_option['title'].'</h3>
					    	What\'s Included?: posts, pages and custom post type contents, images, videos and theme settings.
					    </div>
				    </div>
			    </div>
		    </li>';
}

/*
	Begin creating admin options
*/

$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

$grandportfolio_options = array (
 
//Begin admin header
array( 
		"name" => THEMENAME." Options",
		"type" => "title"
),
//End admin header


//Begin second tab "General"
array( 	"name" => "General",
		"type" => "section",
		"icon" => "fa-gear",	
),
array( "type" => "open"),

array( "name" => "<h2>Contact Form Settings</h2>Your email address",
	"desc" => "Enter which email address will be sent from contact form",
	"id" => SHORTNAME."_contact_email",
	"type" => "text",
	"validation" => "email",
	"std" => ""

),
array( "name" => "Select and sort contents on your contact page. Use fields you want to show on your contact form",
	"sort_title" => "Contact Form Manager",
	"desc" => "",
	"id" => SHORTNAME."_contact_form",
	"type" => "sortable",
	"options" => array(
		0 => 'Empty field',
		1 => 'Name',
		2 => 'Email',
		3 => 'Message',
		4 => 'Address',
		5 => 'Phone',
		6 => 'Mobile',
		7 => 'Company Name',
		8 => 'Country',
	),
	"options_disable" => array(1, 2, 3),
	"std" => ''
),

array( "name" => "<h2>Google Maps Setting</h2>API Key",
	"desc" => "Enter Google Maps API Key <a href=\"https://themegoods.ticksy.com/article/7785/\" target=\"_blank\">How to get API Key</a>",
	"id" => SHORTNAME."_googlemap_api_key",
	"type" => "text",
	"std" => ""
),

array( "name" => "Custom Google Maps Style",
	"desc" => "Enter javascript style array of map. You can get sample one from <a href=\"https://snazzymaps.com\" target=\"_blank\">Snazzy Maps</a>",
	"id" => SHORTNAME."_googlemap_style",
	"type" => "textarea",
	"std" => ""
),
array( "name" => "<h2>Captcha Settings</h2>Enable Captcha",
	"desc" => "If you enable this option, contact page will display captcha image to prevent possible spam",
	"id" => SHORTNAME."_contact_enable_captcha",
	"type" => "iphone_checkboxes",
	"std" => 1,
),

array( "name" => "<h2>Custom Sidebar Settings</h2>Add a new sidebar",
	"desc" => "Enter sidebar name",
	"id" => SHORTNAME."_sidebar0",
	"type" => "text",
	"validation" => "text",
	"std" => "",
),

array( "type" => "close"),
//End second tab "General"


//Begin second tab "Styling"
array( "name" => "Styling",
	"type" => "section",
	"icon" => "fa-paint-brush",
),

array( "type" => "open"),

array( "name" => "",
	"desc" => "",
	"id" => SHORTNAME."_get_styling_button",
	"type" => "html",
	"html" => '
	<ul id="get_styling_content" class="styling_list">
	    '.$customizer_styling_html.'
	</ul>
	<input id="pp_get_styling_button" name="pp_get_styling_button" type="button" value="Get Selected Styling" class="upload_btn button-primary"/>
	<input type="hidden" id="pp_get_styling" name="pp_get_styling" value=""/>
	<div class="styling_message"><img src="'.get_template_directory_uri().'/functions/images/ajax-loader.gif" alt="" style="vertical-align: middle;"/><br/><br/>*Data is being procressed please be patient, don\'t navigate away from this page</div>
	',
),

array( "name" => "<h2>Theme Customize</h2>",
	"desc" => "",
	"id" => SHORTNAME."_open_customize",
	"type" => "html",
	"html" => 'Or you can open theme customize and start customizing theme elements, colors, typography yourself by clicking below button or open Appearance > Customize<br/><br/><br/>
	<input id="pp_open_customize_button" name="pp_open_customize_button" type="button" value="Open Theme customize" class="button" onclick="window.location=\''.esc_url(admin_url('customize.php')).'\'"/>
	',
),
 
array( "type" => "close"),


//Begin fifth tab "Social Profiles"
array( 	"name" => "Social-Profiles",
		"type" => "section",
		"icon" => "fa-facebook-official",
),
array( "type" => "open"),
	
array( "name" => "<h2>Accounts Settings</h2>Facebook page URL",
	"desc" => "Enter full Facebook page URL",
	"id" => SHORTNAME."_facebook_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Twitter Username",
	"desc" => "Enter Twitter username",
	"id" => SHORTNAME."_twitter_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Google Plus URL",
	"desc" => "Enter Google Plus URL",
	"id" => SHORTNAME."_google_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Flickr Username",
	"desc" => "Enter Flickr username",
	"id" => SHORTNAME."_flickr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Youtube Profile URL",
	"desc" => "Enter Youtube Profile URL",
	"id" => SHORTNAME."_youtube_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Vimeo Username",
	"desc" => "Enter Vimeo username",
	"id" => SHORTNAME."_vimeo_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Tumblr Username",
	"desc" => "Enter Tumblr username",
	"id" => SHORTNAME."_tumblr_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Dribbble Username",
	"desc" => "Enter Dribbble username",
	"id" => SHORTNAME."_dribbble_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Linkedin URL",
	"desc" => "Enter full Linkedin URL",
	"id" => SHORTNAME."_linkedin_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Pinterest Username",
	"desc" => "Enter Pinterest username",
	"id" => SHORTNAME."_pinterest_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Instagram Username",
	"desc" => "Enter Instagram username",
	"id" => SHORTNAME."_instagram_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "Behance Username",
	"desc" => "Enter Behance username",
	"id" => SHORTNAME."_behance_username",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "500px Profile URL",
	"desc" => "Enter 500px Profile URL",
	"id" => SHORTNAME."_500px_url",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "name" => "<h2>Photo Stream</h2>Select photo stream photo source. It displays before footer area",
	"desc" => "",
	"id" => SHORTNAME."_photostream",
	"type" => "select",
	"options" => array(
		'' => 'Disable Photo Stream',
		'instagram' => 'Instagram',
		'flickr' => 'Flickr',
	),
	"std" => ''
),
array( "name" => "Instagram Access Token <a href=\"https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=".admin_url("themes.php?page=functions.php")."&response_type=token\" >Find you Access Token here</a>",
	"desc" => "Enter Instagram Access Token",
	"id" => SHORTNAME."_instagram_access_token",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),

array( "name" => "Flickr ID <a href=\"http://idgettr.com/\" target=\"_blank\">Find your Flickr ID here</a>",
	"desc" => "Enter Flickr ID",
	"id" => SHORTNAME."_flickr_id",
	"type" => "text",
	"std" => "",
	"validation" => "text",
),
array( "type" => "close"),

//End fifth tab "Social Profiles"


//Begin second tab "Script"
array( "name" => "Script",
	"type" => "section",
	"icon" => "fa-css3",
),

array( "type" => "open"),

array( "name" => "<h2>CSS Settings</h2>Custom CSS for desktop",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPad Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_tablet_portrait",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPhone Landscape View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_mobile_landscape",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "Custom CSS for iPhone Portrait View",
	"desc" => "You can add your custom CSS here",
	"id" => SHORTNAME."_custom_css_mobile_portrait",
	"type" => "textarea",
	"std" => "",
	'validation' => '',
),

array( "name" => "<h2>CSS and Javascript Optimisation Settings</h2>Combine and compress theme's CSS files",
	"desc" => "Combine and compress all CSS files to one. Help reduce page load time. NOTE: If you enable child theme CSS compression is not support",
	"id" => SHORTNAME."_advance_combine_css",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "Combine and compress theme's javascript files",
	"desc" => "Combine and compress all javascript files to one. Help reduce page load time",
	"id" => SHORTNAME."_advance_combine_js",
	"type" => "iphone_checkboxes",
	"std" => 1
),

array( "name" => "<h2>Cache Settings</h2>Clear Cache",
	"desc" => "Try to clear cache when you enable javascript and CSS compression and theme went wrong",
	"id" => SHORTNAME."_advance_clear_cache",
	"type" => "html",
	"html" => '<a id="'.SHORTNAME.'_advance_clear_cache" href="'.$api_url.'" class="button">Click here to start clearing cache files</a>',
),
 
array( "type" => "close"),

);

//Check if WordPress importer is installed	
$wordpress_importer = ABSPATH . '/wp-content/plugins/wordpress-importer/wordpress-importer.php';

// Check if the file is available to prevent warnings
$pp_wordpress_importer_activated = file_exists($wordpress_importer);

if($pp_wordpress_importer_activated)
{
	//Begin second tab "Demo"
	$grandportfolio_options[] = array( "name" => "Demo-Content",
	    "type" => "section",
	    "icon" => "fa-database",
	);
	
	$grandportfolio_options[] = array( "type" => "open");
	
	$grandportfolio_options[] = array( "name" => "<h2>Import Demo Content</h2>",
	    "desc" => "",
	    "id" => SHORTNAME."_import_demo_content",
	    "type" => "html",
	    "html" => '<strong>*NOTE:</strong> If you import demo content. It will overwrite the existing data and settings. <strong>It\'s not included revolution slider.</strong> so you have to configure that settings once it\'s done.<br/><br/>'.grandportfolio_check_system().'
	    <ul id="import_demo_content" class="demo_list">
	        '.$demo_import_options_html.'
	    </ul>
	    <input id="pp_import_content_button" name="pp_import_content_button" type="button" value="Import Selected" class="upload_btn button-primary"/>
	    <input type="hidden" id="grandportfolio_import_demo_content" name="grandportfolio_import_demo_content" value=""/>
	    <div class="import_message"><img src="'.get_template_directory_uri().'/functions/images/ajax-loader.gif" alt="" style="vertical-align: middle;"/><br/><br/>*Data is being imported please be patient, don\'t navigate away from this page</div>
	    ',
	);
	
	$grandportfolio_options[] = array( "name" => "<h2>Import Revolution Slider</h2>",
	    "desc" => "",
	    "id" => SHORTNAME."_import_revslider",
	    "type" => "html",
	    "html" => 'Demo Revolution Sliders are included in import files. <a href="http://themes.themegoods2.com/grandportfolio/doc/import-demo-revolution-sliders/" target="_blank">Click here to download demo slider</a>
	    ',
	);
	 
	$grandportfolio_options[] = array( "type" => "close");
}
else
{
	//Begin second tab "Demo"
	$grandportfolio_options[] = array( "name" => "Demo-Content",
	    "type" => "section",
	    "icon" => "fa-database",
	);
	
	$grandportfolio_options[] = array( "type" => "open");
	
	$grandportfolio_options[] = array( "name" => "<h2>Import Demo Content</h2>",
	    "desc" => "",
	    "id" => SHORTNAME."_import_demo_content",
	    "type" => "html",
	    "html" => '
	    	Please install <strong>WordPress Importer</strong> plugin first so demo content importing feature is activated. You can install it from <a href="'.admin_url("themes.php?page=install-required-plugins&plugin_status=install").'">here</a>. 
	    ',
	);
	
	$grandportfolio_options[] = array( "name" => "<h2>Import Revolution Slider</h2>",
	    "desc" => "",
	    "id" => SHORTNAME."_import_revslider",
	    "type" => "html",
	    "html" => 'Demo Revolution Sliders are included in import files. <a href="http://themes.themegoods2.com/grandportfolio/doc/import-demo-revolution-sliders/" target="_blank">Click here to download demo slider</a>
	    ',
	);
	 
	$grandportfolio_options[] = array( "type" => "close");
}

grandportfolio_set_options($grandportfolio_options);
?>