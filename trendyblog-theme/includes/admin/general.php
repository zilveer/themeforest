<?php
global $different_themes_managment;
$differentThemes_general_options= array(
 array(
	"type" => "navigation",
	"name" => "General",
	"slug" => "general"
),

array(
	"type" => "tab",
	"slug"=>'general'
),

array(
	"type" => "sub_navigation",
	"subname"=>array(
		array("slug"=>"page", "name"=>esc_html__("General", THEME_NAME)), 
		array("slug"=>"blog", "name"=>esc_html__("Blog", THEME_NAME)),
		array("slug"=>"gallery", "name"=>esc_html__("Gallery", THEME_NAME)),
		array("slug"=>"contact", "name"=>esc_html__("Contact/Footer", THEME_NAME)),
		array("slug"=>"banner_settings", "name"=>esc_html__("Banners", THEME_NAME))
	)
),

/* ------------------------------------------------------------------------*
 * PAGE SETTINGS
 * ------------------------------------------------------------------------*/

 array(
	"type" => "sub_tab",
	"slug"=>'page'
),
 array(
	"type" => "row"
),

array(
	"type" => "homepage_set_test",
	"title" => "Set up Your Homepage and post page!",
	"desc" => "	<p><b>You have not selected the correct template page for homepage.</b></p>
	<p>Please make sure, you choose template \"Drag & Drop Page Builder\".</p>
	<br/>
	<ul>
		<li>Current front page: <a href='".esc_url(get_permalink(get_option('page_on_front')))."'>".get_the_title(get_option('page_on_front'))."</a></li>
		<li>Current blog page: <a href'".esc_url(get_permalink(get_option('page_for_posts')))."'>".get_the_title(get_option('page_for_posts'))."</a></li>
	</ul>",
	"desc_2" => "<p><b>You have NOT enabled homepage.</b></p>
	<p>To use custom homepage, you must first create two <a href='".esc_url(home_url())."/wp-admin/post-new.php?post_type=page'>new pages</a>, and one of them assign to \"<b>Homepage</b>\" template.Give each page a title, but avoid adding any text.</p>
	<p>Then enable homepage  in <a href='".esc_url(home_url())."/wp-admin/options-reading.php'>wordpress reading settings</a> (See \"Front page displays\" option). Select your previously created pages from both dropdowns and save changes.</p>"
),
array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Load dynamic js/css files directly in header", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Load in Header (this improves your page speed on some servers, but it depends on server configuration):", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_scriptLoad"
),
   

array(
	"type" => "close"
), 
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Add logo image", THEME_NAME)
),
   
array(
	"type" => "upload",
	"title" => esc_html__("Add Header Logo Image", THEME_NAME),
	"info" => esc_html__("Suggested image size is 467x60px", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_logo",
),      

array(
	"type" => "close"
),
 array(
	"type" => "row"
),
array(
	"type" => "select",
	"title" => "Page Name Style",
	"info" => esc_html__("Works only if you leave the logo image field empty.", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_subcount",
	"options"=>array(
		array("slug"=>"0", "name"=> esc_html__("None character in theme color scheme color", THEME_NAME)), 
		array("slug"=>"1", "name"=>esc_html__("1 character in theme color scheme color", THEME_NAME)),
		array("slug"=>"2", "name"=>esc_html__("2 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"3", "name"=>esc_html__("3 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"4", "name"=>esc_html__("4 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"5", "name"=>esc_html__("5 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"6", "name"=>esc_html__("6 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"7", "name"=>esc_html__("7 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"8", "name"=>esc_html__("8 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"9", "name"=>esc_html__("9 characters in theme color scheme color", THEME_NAME)),
		array("slug"=>"10", "name"=>esc_html__("10 characters in theme color scheme color", THEME_NAME)),
		),
	"std" => "6"
),
array(
	"type" => "close"
),
 array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Export/Import Theme Settings", THEME_NAME)
),
   
array(
	"type" => "export_content",
	"title" => esc_html__("Export Settings", THEME_NAME),
	"section" => "management",
	"id" => $different_themes_managment->themeslug."_export"
),      
   
array(
	"type" => "import_content",
	"title" => esc_html__("Import Settings", THEME_NAME),
	"section" => "management",
	"id" => $different_themes_managment->themeslug."_import"
),      

array(
	"type" => "close"
),  
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Favicon"
),
   
array(
	"type" => "upload",
	"title" => "Favicon",
	"info" => "Favicons are the small 16 pixel by 16 pixel pictures you see beside some URLs in your browser's address bar.",
	"id" => $different_themes_managment->themeslug."_favicon"
),   

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Unit Settings", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show Search In Top Menu:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_search"
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Hide Duplicate Posts On Homepage:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_duplicate"
),
   

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Weather Forecast", THEME_NAME),
),

array(
	"type" => "radio",
	"title" => esc_html__("Show Weather Forecast:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_weather",
	"radio" => array(
		array("title" => esc_html__("Show Weather Forecast:", THEME_NAME), "value" => "on"),
		array("title" => esc_html__("Show Custom Text/Link:", THEME_NAME), "value" => "link"),
		array("title" => esc_html__("Show Date:", THEME_NAME), "value" => "date"),
		array("title" => esc_html__("Off:", THEME_NAME), "value" => "off")
	),
),
array(
	"type" => "title",
	"title" => "Text/Link",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "link")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("Text", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_weather_text",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "link")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("Url", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_weather_url",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "link")
	)
),
array(
	"type" => "checkbox",
	"title" => esc_html__("Open In New Window/Tab:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_weather_target",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "link")
	)
),
array(
	"type" => "title",
	"title" => "Temperature Type",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),
array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_temperature",
	"radio" => array(
		array("title" => esc_html__("Show Temperature In C:", THEME_NAME), "value" => "C"),
		array("title" => esc_html__("Show Temperature In F:", THEME_NAME), "value" => "F")
	),
	"std" => "C",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),
array(
	"type" => "title",
	"title" => "API type",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_weather_api_key_type",
	"radio" => array(
		array("title" => esc_html__("Free API Key:", THEME_NAME), "value" => "free"),
		array("title" => esc_html__("Premium API Key:", THEME_NAME), "value" => "premium")
	),
	"std" => "free",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),
array(
	"type" => "title",
	"title" => "Location",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_weather_location_type",
	"radio" => array(
		array("title" => esc_html__("Search For Customer Location:", THEME_NAME), "value" => "customer"),
		array("title" => esc_html__("Set Your Own Custom Location:", THEME_NAME), "value" => "custom")
	),
	"std" => "customer",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("City Name, Country", THEME_NAME),
	"info" => esc_html__("Example - London,United Kingdom", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_weather_city",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather_location_type", "value" => "custom")
	)
),

array(
	"type" => "input",
	"title" => esc_html__("API Key", THEME_NAME),
	"info" => esc_html__("The API Key You Can Get Here:", THEME_NAME)." <a href='//developer.worldweatheronline.com/signup.aspx' style='color:#fff' target='_blank'>".esc_html__("Register API Key", THEME_NAME)."</a>",
	"id" => $different_themes_managment->themeslug."_weather_api",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_weather", "value" => "on")
	)
),


array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show Shopping Cart In Main Menu", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show Shopping Cart:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_cart"
),
array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Breadcrumb", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show Breadcrumb:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_breadcrumb"
),
array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME),
),
   
array(
	"type" => "closesubtab"
),

/* ------------------------------------------------------------------------*
 * BLOG SETTINGS
 * ------------------------------------------------------------------------*/   
  
array(
	"type" => "sub_tab",
	"slug"=>'blog'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Unit Settings", THEME_NAME),
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show thumbnails in blog post list:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_show_first_thumb",
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Show \"no image\" thumbnail, when no thumbnail is available:", THEME_NAME),
	"id"=>$different_themes_managment->themeslug."_show_no_image_thumb"
),
array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show thumbnail in open post/page", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_show_single_thumb",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show thumbnail in open post/page full height", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_single_thumb_size",
	"radio" => array(
		array("title" => esc_html__("Full:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Cropped:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Clickable Single Post/Page Image", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_imagePopUp",
	"radio" => array(
		array("title" => esc_html__("Yes:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("No:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Icons on Thumbnails in Post Listing Pages", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_showTumbIcon",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Post Title In Single Post/Page", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_show_single_title",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Post Controls",'different_themes')
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postControls",
	"radio" => array(
		array("title" => esc_html__("Show:",'different_themes'), "value" => "show"),
		array("title" => esc_html__("Hide:",'different_themes'), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:",'different_themes'), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Post Author", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postAuthor",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),


array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Post Date", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postDate",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Post Views", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postViews",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),
array(
	"type" => "title",
	"title" => esc_html__("Show Like Count", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_showLikes",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show Categories", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postCategory",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show Tags In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_post_tag_single",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show \"About Author\" In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_aboutPostAuthor",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show \"Similar News\" In Single Post", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_similar_posts",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "title",
	"title" => esc_html__("Similar Post Count",THEME_NAME)
),

array(
	"type" => "scroller",
	"title" => esc_html__("Post Count:",THEME_NAME),
	"id" => $different_themes_managment->themeslug."_similar_post_count",
	"max" => '30',
	"std" => "3"
),

array(
	"type" => "title",
	"title" => esc_html__("Similar Excerpt",THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_similar_post_excerpt",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "on"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "off"),
	),
	"std" => "on"
),

array(
	"type" => "close"
),



array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show Share Buttons", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_share_buttons",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post/Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show Post Comment Count", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_postComments",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Post:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),
array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME)
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * CONTACT SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'contact'
),
/*
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Social Account Icons In Header", THEME_NAME)
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Enable Icons", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_top_icons",
	"std" => "off"
),

array(
	"type" => "input",
	"title" => esc_html__("Facebook Account Url:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_facebook",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_top_icons", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("Twitter Account Url:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_twitter",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_top_icons", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("LinkedIn Account Url:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_linkedin",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_top_icons", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("Pinterest Account Url:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_pinterest",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_top_icons", "value" => "on")
	)
),
array(
	"type" => "input",
	"title" => esc_html__("RSS Account Url:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_rss",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_top_icons", "value" => "on")
	)
),

array(
	"type" => "close"
),
*/
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Twitter Account", THEME_NAME)
),

array(
	"type" => "input",
	"title" => esc_html__("Twitter Account Name:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_twitter_name"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Footer CopyRight", THEME_NAME),
),

array(
	"type" => "textarea",
	"title" => esc_html__("Text:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_copyright"
),

array(
	"type" => "close"
),


array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME),
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * GALLERY SETTINGS
 * ------------------------------------------------------------------------*/   
array(
	"type" => "sub_tab",
	"slug"=>'gallery'
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title"=> esc_html__('Gallery Settings', THEME_NAME)
),

array(
	"type" => "input",
	"title" => esc_html__("Items per gallery page:", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_gallery_items",
	"number" => "yes",
	"std" => "8"
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Show \"Similar Posts\" In Single Galley", THEME_NAME)
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_similar_posts_gallery",
	"radio" => array(
		array("title" => esc_html__("Show:", THEME_NAME), "value" => "show"),
		array("title" => esc_html__("Hide:", THEME_NAME), "value" => "hide"),
		array("title" => esc_html__("Custom For Each Gallery Page:", THEME_NAME), "value" => "custom")
	),
	"std" => "custom"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => esc_html__("Save Changes", THEME_NAME),
),

array(
	"type" => "closesubtab"
),


/* ------------------------------------------------------------------------*
 * BANNER SETTINGS
 * ------------------------------------------------------------------------*/   

array(
	"type" => "sub_tab",
	"slug"=>'banner_settings'
),

array(
	"type" => "row",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_headerStyle", "value" => "2")
	)
),

array(
	"type" => "title",
	"title" => esc_html__("Header Banner", THEME_NAME),
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_headerStyle", "value" => "2")
	)
),

array(
	"type" => "checkbox",
	"title" => esc_html__("Enable Banner", THEME_NAME),
	"id" => $different_themes_managment->themeslug."_top_banner",
	"std" => "off",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_headerStyle", "value" => "2")
	)
),

array(
	"type" => "textarea",
	"title" => esc_html__("Banner HTML Code", THEME_NAME),
	"sample" => '<a href="http://www.different-themes.com" target="_blank"><img src="'.esc_url(THEME_IMAGE_URL.'no-banner-728x90.jpg').'" alt="" title="" /></a>',
	"id" => $different_themes_managment->themeslug."_top_banner_code",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_headerStyle", "value" => "2")
	)
),

array(
	"type" => "close",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_headerStyle", "value" => "2")
	)
),
/*
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Custom HTML Under Main Menu", THEME_NAME)
),

array(
	"type" => "textarea",
	"title" => esc_html__("HTML Code", THEME_NAME),
	"sample" => '<span>Custom links here:</span><a href="#">Google Adsense</a><a href="#">Cheap laptops and netbooks</a><a href="#">lpad, Laptops &amp; Books</a><a href="#">Cheapest Cell Phones</a><a href="#">Buy Quality HP laptops</a>',
	"id" => $different_themes_managment->themeslug."_custom_html",
),

array(
	"type" => "close"
),
*/
array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => esc_html__("Select Pop Up Banner Type", THEME_NAME),
),

array(
	"type" => "radio",
	"id" => $different_themes_managment->themeslug."_banner_type",
	"radio" => array(
		array("title" => "Off", "value" => "off"),
		array("title" => "Banner With Image", "value" => "image"),
		array("title" => "Banner With Text Or HTML Code", "value" => "text"),
		array("title" => "Banner With Image &amp; Text", "value" => "text_image")
	),
	"std" => "off"
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $different_themes_managment->themeslug."_banner_image",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner content",
	"info" => "You can copy also some HTML code here.",
	"id" => $different_themes_managment->themeslug."_banner_text",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text")
	)
),

array(
	"type" => "upload",
	"title" => "Add Banner Image",
	"id" => $different_themes_managment->themeslug."_banner_text_image_img",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "textarea",
	"title" => "Banner text",
	"info" => "You add only text.",
	"id" => $different_themes_managment->themeslug."_banner_text_image_txt",
	"protected" => array(
		array("id" => $different_themes_managment->themeslug."_banner_type", "value" => "text_image")
	)
),

array(
	"type" => "close"
),

array(
	"type" => "row"
),

array(
	"type" => "title",
	"title" => "Banner Settings",
),

array(
	"type" => "select",
	"title" => "Start Time",
	"id" => $different_themes_managment->themeslug."_banner_start",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Secconds"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Close Time",
	"id" => $different_themes_managment->themeslug."_banner_close",
	"options"=>array(
		array("slug"=>"0", "name"=>"Off"), 
		array("slug"=>"5", "name"=>"5 Secconds"),
		array("slug"=>"10", "name"=>"10 Secconds"),
		array("slug"=>"15", "name"=>"15 Secconds"),
		array("slug"=>"20", "name"=>"20 Secconds"),
		array("slug"=>"25", "name"=>"25 Secconds"),
		array("slug"=>"30", "name"=>"30 Secconds"),
		array("slug"=>"60", "name"=>"1 Minute"),
		array("slug"=>"120", "name"=>"2 Minute"),
		array("slug"=>"180", "name"=>"3 Minute"),

		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly In From",
	"id" => $different_themes_managment->themeslug."_banner_fly_in",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Fly Out To",
	"id" => $different_themes_managment->themeslug."_banner_fly_out",
	"options"=>array(
		array("slug"=>"off", "name"=>"Off"), 
		array("slug"=>"top", "name"=>"Top"),
		array("slug"=>"top-left", "name"=>"Top Left"),
		array("slug"=>"top-right", "name"=>"Top Right"),
		array("slug"=>"left", "name"=>"Left"),
		array("slug"=>"bottom", "name"=>"Bottom"),
		array("slug"=>"bottom-left", "name"=>"Bottom Left"),
		array("slug"=>"bottom-right", "name"=>"Bottom Right"),
		),
	"std" => "off"
),

array(
	"type" => "select",
	"title" => "Show Banner after",
	"info" => "How many times site may be viewed until the popup will be shown again",
	"id" => $different_themes_managment->themeslug."_banner_views",
	"options"=>array(
		array("slug"=>"0", "name"=>"0 Click"), 
		array("slug"=>"1", "name"=>"1 Click"),
		array("slug"=>"2", "name"=>"2 Clicks"),
		array("slug"=>"2", "name"=>"3 Clicks"),
		array("slug"=>"4", "name"=>"4 Clicks"),
		array("slug"=>"5", "name"=>"5 Clicks"),
		array("slug"=>"10", "name"=>"10 Clicks"),
		array("slug"=>"20", "name"=>"20 Clicks"),
		),
	"std" => "0"
),

array(
	"type" => "select",
	"title" => "How offen show the banner",
	"id" => $different_themes_managment->themeslug."_banner_timeout",
	"options"=>array(
		array("slug"=>"0", "name"=>"One time per visit"), 
		array("slug"=>"1", "name"=>"Once a day"), 
		array("slug"=>"2", "name"=>"Once in 2 days"),
		array("slug"=>"3", "name"=>"Once in 3 days"),
		array("slug"=>"7", "name"=>"Once in a week"),
		array("slug"=>"30", "name"=>"Once in a month"),
		array("slug"=>"365", "name"=>"Once in a year"),
		),
	"std" => "0"
),

array(
	"type" => "checkbox",
	"title" => "Enable Background Overlay:",
	"id" => $different_themes_managment->themeslug."_banner_overlay",
	"std" => "off"
),

array(
	"type" => "close"
),

array(
	"type" => "save",
	"title" => "Save Changes"
),

array(
	"type" => "closesubtab"
),

array(
	"type" => "closetab"
)
 
 );


$different_themes_managment->add_options($differentThemes_general_options);
?>