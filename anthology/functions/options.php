<?php 

//get the categories
$categories=get_categories('hide_empty=0');
for($i=0; $i<count($categories); $i++){
	$cat_ids[$i]=$categories[$i]->cat_ID;
	$cat_names[$i]=$categories[$i]->cat_name;
}

//get the pages
$pages=get_pages();
for($i=0; $i<count($pages); $i++){
	$page_ids[$i]=$pages[$i]->ID;
	$page_names[$i]=$pages[$i]->post_title;
}

//get the tags
$tags=get_tags();
for($i=0; $i<count($tags); $i++){
	$tag_ids[$i]=$tags[$i]->term_id;
	$tag_names[$i]=$tags[$i]->name;
}

//get the pattern names
$pattern_ids[0]='none';
$pattern_names[0]='None';
for($i=1; $i<=32; $i++){
	$pattern_ids[$i]=$i.'.png';
	$pattern_names[$i]='Pattern '.$i;
}

//get the sidebars available for the portfolio posts content
$sidebar_ids[0]='home';
$sidebar_names[0]='Default (Home Sidebar)';
foreach($pexeto_generated_sidebars as $sidebar){
	$sidebar_ids[]=$sidebar['id'];
	$sidebar_names[]=$sidebar['name'];
}

//get the sidebars available for the blog posts content
$blog_sidebar_ids[0]='blog';
$blog_sidebar_names[0]='Default (Blog Sidebar)';
foreach($pexeto_generated_sidebars as $sidebar){
	$blog_sidebar_ids[]=$sidebar['id'];
	$blog_sidebar_names[]=$sidebar['name'];
}

$options = array (

//------------------GENERAL SETTINGS-------------------

array(
"name" => "General",
"type" => "title"),

array(
"type" => "open"),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-comment"></div>Comments'
),

array(
"name" => "Show comments on non-blog posts",
"id" => $shortname."_post_comments",
"type" => "select",
"options" => array('Hide','Show'),
"values" => array('off', 'on')),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-newwin"></div>Theme Update'
),

array(
"name" => "Envato Marketplace Username",
"id" => $shortname."_tf_username",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert the username of the account you used to purchase the theme from ThemeForest. For more information you can refer to the \"Updates\" section of the documentation."
),

array(
"name" => "Envato Marketplace API Key",
"id" => $shortname."_tf_api_key",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert your API Key here. To obtain your API Key, visit your \"My Settings\" page on any of the Envato Marketplaces (ThemeForest). For more information you can refer to the \"Updates\" section of the documentation."
),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-newwin"></div>Other'
),

array(
"name" => "Featured Category",
"id" => $shortname."_featured_cat",
"type" => "select",
"options" => $cat_names,
"values" => $cat_ids,
"desc" => "If you use the Featured Posts Template you can select the Featured category here"),

array(
"name" => "Display page tile as main page heading",
"id" => $shortname."_show_page_title",
"type" => "select",
"options" => array('Display ','Do not display '),
"values" => array('on', 'off'),
"std" => 'on',
"desc" => 'If "Display" selected, the page title will be displayed in the beginning of the page content
as a main title. This option is available for Default Page Template and Contact Page Template.'
),

array(
"name" => "Google Analytics Code",
"id" => $shortname."_analytics",
"type" => "textarea",
"options" => $cat_names,
"values" => $cat_ids),

array(
"type" => "close"),


//------------------STYLE SETTINGS-------------------

array(
"name" => "Style settings",
"type" => "title"),

array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>General Styles Settings'
),

array(
"name" => "Predefined Skins",
"id" => $shortname."_skin",
"type" => "select",
"options" => array("Light Grey","Grey","Dark Grey","Cornsilk","Light Yellow","Dark Yellow","Orange","Red 1", "Red 2","Pink","Light Brown","Dark Brown","Light Green","Green","Dark Green","Light Aqua","Aqua 1","Aqua 2","Light Blue","Blue","Dark Blue","Teal","Dark Scarlet","Dark"),
"values" => array( "b0b0b0","919191","595959","d9ceb2","ecd078","debf59","c76a49","913746", "892642","b38184","7b3b3b","542437","bebd6d","88a65e","5e8c6a","aaccb1","5a8180","53777a","93b3c9","6c8fba","325166","036564","372c3e","0e2430"),
"std" => 'b0b0b0',
"color" =>true,
"desc" => 'You can either select a predefined skin or pick your custom color below.'
),


array(
"name" => "Custom Theme Color",
"id" => $shortname."_custom_skin",
"type" => "text",
"color" => true,
"desc" => 'You can select a custom color for your theme. This field has priority over the "Predefined Skins" one. '
),

array(
"name" => "Theme Pattern",
"id" => $shortname."_pattern",
"type" => "select",
"options" => $pattern_names,
"values" => $pattern_ids,
"std" => '17.png',
"pattern" => true,
"desc" => 'Select the pattern for your theme. Pattern preview in this dropdown list is available with Firefox.'
),


array(
"name" => "Main body text size",
"id" => $shortname."_body_text_size",
"type" => "text",
"desc" => "The main body font size in pixels. Default: 16"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-image"></div>Logo Settings'
),

array(
"name" => "Logo image",
"id" => $shortname."_logo_image",
"type" => "text",
"upload" =>true,
"desc" => "If the image is located within the images folder you can just insert images/image-name.jpg, otherwise
you have to insert the full path to the image, for example: http://site.com/image-name.jpg"
),

array(
"name" => "Logo image width",
"id" => $shortname."_logo_width",
"type" => "text",
"desc" => "The logo image width in pixels- default:278"
),


array(
"name" => "Logo image height",
"id" => $shortname."_logo_height",
"type" => "text",
"desc" => "The logo image height in pixels- default:85"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-comment"></div>Text Color Settings'
),

array(
"name" => "Main body text color",
"id" => $shortname."_body_color",
"type" => "text",
"color" => true,
"desc" => "This setting will change the main content and sidebar text color."
),

array(
"name" => "Headings color",
"id" => $shortname."_heading_color",
"type" => "text",
"color" => true
),

array(
"name" => "Page subtitle color",
"id" => $shortname."_subtitle_color",
"type" => "text",
"color" => true,
"desc" => "The subtitle in the header section that is displayed when no slider has been selected."
),

array(
"name" => "Links color",
"id" => $shortname."_link_color",
"type" => "text",
"color" => true
),

array(
"name" => "Menu links color",
"id" => $shortname."_menu_link_color",
"type" => "text",
"color" => true
),

array(
"name" => "Menu links hover color",
"id" => $shortname."_menu_link_hover",
"type" => "text",
"color" => true
),

array(
"name" => "Footer text color",
"id" => $shortname."_footer_text_color",
"type" => "text",
"color" => true
),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-copy"></div>Background Settings'
),

array(
"name" => "Body background color",
"id" => $shortname."_body_bg",
"type" => "text",
"color" => true
),

array(
"name" => "Home/Pricing boxes background color",
"id" => $shortname."_boxes_color",
"type" => "text",
"color" => true
),

array(
"name" => "Comments background color",
"id" => $shortname."_comments_bg",
"type" => "text",
"color" => true
),

array(
"name" => "Footer background color",
"id" => $shortname."_footer_bg",
"type" => "text",
"color" => true
),

array(
"name" => "Footer lines color",
"id" => $shortname."_footer_lines_color",
"type" => "text",
"color" => true
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-circle-plus"></div>Additional styles'
),

array(
"name" => "Additional CSS styles",
"id" => $shortname."_additional_styles",
"type" => "textarea",
"desc" => "You can insert some more additional CSS code here"
),


array(
"type" => "close"),


//------------------SIDEBARS SETTINGS-------------------

array(
"name" => "Sidebars",
"type" => "title"),


array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-video"></div>Add New Sidebar'),

array(
"name" => "AddSidebar",
"type" => "add_sidebar",
),

array(
"id" => "_sidebar_names",
"type" => "hidden",
"function" => "pexetoOptions.setSidebarFunc();"
),

array(
"type" => "close"),

//------------------HOME SETTINGS-------------------

array(
"name" => "Home Page",
"type" => "title"),

array(
"type" => "open"),

array(
"name" => '<div class="ui-icon ui-icon-copy"></div>First Box Content',
"type" => "subtitle"),

array(
"name" => "First box title",
"id" => $shortname."_home_box_title1",
"type" => "text",
"std" => "Unlimited skins"
),

array(
"name" => "First box description",
"id" => $shortname."_home_box_desc1",
"type" => "textarea",
"std" => "Changing template's colors is super simple - check out how your favorite color looks."
),

array(
"name" => "First box icon URL",
"id" => $shortname."_home_box_icon1",
"type" => "text",
"std" => get_template_directory_uri().'/images/serv_icon2.png',
"upload" => true
),

array(
"name" => "First box button text",
"id" => $shortname."_home_box_btn_text1",
"type" => "text",
"std" => "Learn More"
),

array(
"name" => "First box button link",
"id" => $shortname."_home_box_btn_link1",
"type" => "text"
),
array(
"name" => '<div class="ui-icon ui-icon-copy"></div>Second Box Content',
"type" => "subtitle"),

array(
"name" => "Second box title",
"id" => $shortname."_home_box_title2",
"type" => "text",
"std" => "Advanced Admin"
),

array(
"name" => "Second box description",
"id" => $shortname."_home_box_desc2",
"type" => "textarea",
"std" => "Changing template's colors is super simple - check out how your favorite color looks."
),

array(
"name" => "Second box icon URL",
"id" => $shortname."_home_box_icon2",
"type" => "text",
"std" => get_template_directory_uri().'/images/serv_icon3.png',
"upload" => true
),

array(
"name" => "Second box button text",
"id" => $shortname."_home_box_btn_text2",
"type" => "text",
"std" => "Learn More"
),

array(
"name" => "Second box button link",
"id" => $shortname."_home_box_btn_link2",
"type" => "text"
),


array(
"name" => '<div class="ui-icon ui-icon-copy"></div>Third Box Content',
"type" => "subtitle"),

array(
"name" => "Third box title",
"id" => $shortname."_home_box_title3",
"type" => "text",
"std" => "jQuery Powered"
),

array(
"name" => "Third box description",
"id" => $shortname."_home_box_desc3",
"type" => "textarea",
"std" => "Changing template's colors is super simple - check out how your favorite color looks."
),

array(
"name" => "Third box icon URL",
"id" => $shortname."_home_box_icon3",
"type" => "text",
"std" => get_template_directory_uri().'/images/serv_icon.png',
"upload" => true
),

array(
"name" => "Third box button text",
"id" => $shortname."_home_box_btn_text3",
"type" => "text",
"std" => "Learn More"
),

array(
"name" => "Third box button link",
"id" => $shortname."_home_box_btn_link3",
"type" => "text"
),

array(
"type" => "close"),

//------------------POSTS PAGE SETTINGS-------------------

array(
"name" => "Blog/Index",
"type" => "title"),


array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>General settings'),

array(
"name" => "Page Layout",
"id" => $shortname."_blog_layout",
"type" => "select",
"options" => array('Right Sidebar', 'Left Sidebar','Full Width'),
"values" => array('right', 'left','full'),
"std" => 'right',
"desc" => 'This layout setting will affect the blog page, blog posts template, archives and search pages'
),

array(
"name" => "Blog sidebar",
"id" => $shortname."_blog_sidebar",
"type" => "select",
"options" => $blog_sidebar_names,
"values" =>$blog_sidebar_ids,
"std" => 'blog',
"desc" => 'This sidebar setting will affect the blog page, blog posts template, archives and search pages'
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-image"></div>Header section settings'),

array(
"name" => "Slider on posts/blog page",
"id" => $shortname."_home_slider",
"type" => "select",
"options" => array('Tumbnail Slider', 'Nivo Slider/Fader','Big Thumbnail Slider', 'None'),
"values" => array('thum-slider', 'nivo-slider','big-thum-slider','none'),
"std" => 'thum-slider'
),

array(
"name" => "Page Subtitle",
"id" => $shortname."_posts_subtitle",
"type" => "text",
"desc" => "Available only when no slider has been selected above."
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-document"></div> Posts settings'),

array(
"name" => "Exclude categories from blog",
"id" => $shortname."_exclude_cat_from_blog",
"type" => "multicheck",
"options" => $cat_names,
"values" => $cat_ids,
"desc" => "You can select which categories not to be shown on the blog"),

array(
"name" => "Number of posts per page",
"id" => $shortname."_post_per_page_on_blog",
"type" => "text",
"std" => "5"
),

array(
"name" => "Display post info",
"id" => $shortname."_blog_info",
"type" => "select",
"options" => array('Display', 'Hide'),
"values" => array('on', 'off'),
"std" => 'on',
"desc" => 'If you select "Hide", the post info such as category, date and author will be hidden on the blog'),

array(
"type" => "close"),

//------------------THUMBNAIL SLIDER SETTINGS-------------------

array(
"name" => "Thumbnail slider",
"type" => "title"),


array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-video"></div>Thumbnail Slider Images'),

array(
"name" => "AddThumbImage",
"type" => "add_thumb_image",
),

array(
"id" => "_thum_image_names",
"type" => "hidden",
),

array(
"id" => "_thum_image_desc",
"type" => "hidden",
),

array(
"id" => "_thum_image_links",
"type" => "hidden",
"function" => "pexetoOptions.setThumbFunc();"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>Slider settings'),

array(
"name" => "Autoplay",
"id" => $shortname."_thum_autoplay",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'true',
"desc" => 'If enabled, the images will rotate automatically'
),

array(
"name" => "Automatic Thumbnail Cropping",
"id" => $shortname."_thum_auto_resize",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'false',
"desc" => 'If enabled, the smaller thumbnail images will be automatically cropped, rather than resized.'
),

array(
"name" => "Rotate Interval",
"id" => $shortname."_thum_interval",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => $shortname."_thum_pause",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),

array(
"name" => "Pause on hover",
"id" => $shortname."_thum_pause_hover",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'true',
"desc" => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
),

array(
"type" => "close"),

//------------------BIG THUMBNAIL SLIDER SETTINGS-------------------

array(
"name" => "Big Thumbnail Slider",
"type" => "title"),


array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-video"></div>Big Thumbnail Slider Images'),

array(
"name" => "AddThumbImage",
"type" => "add_thumb_image_big",
),

array(
"id" => "_thum_image_names_big",
"type" => "hidden",
),

array(
"id" => "_thum_image_desc_big",
"type" => "hidden",
),

array(
"id" => "_thum_image_links_big",
"type" => "hidden",
"function" => "pexetoOptions.setThumbFuncBig();"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>Slider settings'),

array(
"name" => "Autoplay",
"id" => $shortname."_thum_autoplay_big",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'true',
"desc" => 'If enabled, the images will rotate automatically'
),

array(
"name" => "Automatic Thumbnail Cropping",
"id" => $shortname."_thum_auto_resize_big",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'false',
"desc" => 'If enabled, the smaller thumbnail images will be automatically cropped, rather than resized.'
),

array(
"name" => "Rotate Interval",
"id" => $shortname."_thum_interval_big",
"type" => "text",
"desc" => "The interval between changing the images when autoplay is enabled (in miliseconds)",
"std" => '4000'
),

array(
"name" => "Pause Interval",
"id" => $shortname."_thum_pause_big",
"type" => "text",
"desc" => "The pause interval (in miliseconds)- when an user clicks on an image or arrow, the autoplay pauses for this interval of time",
"std" => '5000'
),


array(
"name" => "Pause on hover",
"id" => $shortname."_thum_pause_hover_big",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'true',
"desc" => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
),

array(
"type" => "close"),


//------------------NIVO SLIDER SETTINGS-------------------

array(
"name" => "Nivo slider",
"type" => "title"),

array(
"type" => "open"),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-video"></div>Nivo Slider Images'),

array(
"name" => "AddNivoImage",
"type" => "add_nivo_image",
),

array(
"id" => "_nivo_image_names",
"type" => "hidden",
),

array(
"id" => "_nivo_image_desc",
"type" => "hidden",
),

array(
"id" => "_nivo_image_links",
"type" => "hidden",
"function" => "pexetoOptions.setNivoFunc();"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>Nivo Slider Settings'),

array(
"name" => "Navigation",
"id" => $shortname."_nivo_navigation",
"type" => "select",
"options" => array('None', 'Buttons', 'Arrows', 'Buttons and Arrows'),
"values" => array('none', 'buttons', 'arrows', 'butarr'),
"std" => 'none'
),

array(
"name" => "Animation Effect",
"id" => $shortname."_nivo_animation",
"type" => "select",
"options" => array('Random', 'Fold', 'Fade', 'Slice Down', 'Slice Down Left', 'Slice Up', 'Slice Up Down', 'Slice Up Left', 'Slice Up Down Left', 'Slide In Right', 'Slide In Left', 'Box Random', 'Box Rain', 'Box Rain Reverse', 'Box Rain Grow', 'Box Rain Grow Reverse'),
"values" => array('random','fold','fade','sliceDown','sliceDownLeft','sliceUp','sliceUpDown','sliceUpLeft','sliceUpDownLeft','slideInRight','slideInLeft','boxRandom','boxRain','boxRainReverse','boxRainGrow','boxRainGrowReverse'),
"std" => 'random'
),

array(
"name" => "Number of slices",
"id" => $shortname."_nivo_slices",
"type" => "text",
"std" => "15"
),

array(
"name" => "Number of box rows",
"id" => $shortname."_nivo_rows",
"type" => "text",
"std" => "4",
"desc" => "For box animations only."
),

array(
"name" => "Number of box columns",
"id" => $shortname."_nivo_columns",
"type" => "text",
"std" => "8",
"desc" => "For box animations only."
),

array(
"name" => "Animation Speed",
"id" => $shortname."_nivo_speed",
"type" => "text",
"std" => "800",
"desc" => "The animation speed in miliseconds"
),

array(
"name" => "Pause interval",
"id" => $shortname."_nivo_interval",
"type" => "text",
"std" => "3000",
"desc" => "The time interval between image changes in miliseconds"
),

array(
"name" => "Autoplay",
"id" => $shortname."_nivo_autoplay",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('false', 'true'),
"std" => 'false',
"desc" => 'If enabled, the images will rotate automatically'
),

array(
"name" => "Pause on hover",
"id" => $shortname."_nivo_pause_hover",
"type" => "select",
"options" => array('Enabled', 'Disabled'),
"values" => array('true', 'false'),
"std" => 'true',
"desc" => 'If enabled, when the user hovers the image, the automatic rotation will pause.'
),

array(
"type" => "close"),


//------------------CONTACT PAGE SETTINGS-------------------

array(
"name" => "Contact page",
"type" => "title"),

array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-mail-open"></div>Contact Page Settings'),

array(
"name" => "Email to which to send contact form message",
"id" => $shortname."_email",
"type" => "text"),

array(
'name' => 'Email sender',
'id' => $shortname.'_email_from',
'type' => 'text',
'desc' => '<b>Important:</b> Please do not leave this field empty.<br/>
Set a custom <b>non-Yahoo</b> email address that will be set as a sender of the email to avoid
emails failing to be sent due to the Yahoo\'s DMARC policy of reject.<br/>
' 
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-mail-open"></div>Labels'),

array(
"name" => "Ask your question",
"id" => $shortname."_ask_question_text",
"type" => "text",
"std" => "Ask your question"
),

array(
"name" => "Name text",
"id" => $shortname."_name_text",
"type" => "text",
"std" => "Name"
),


array(
"name" => "Your e-mail text",
"id" => $shortname."_your_email_text",
"type" => "text",
"std" => "Your e-mail"
),


array(
"name" => "Question text",
"id" => $shortname."_question_text",
"type" => "text",
"std" => "Question"
),

array(
"name" => "Send text",
"id" => $shortname."_send_text",
"type" => "text",
"std" => "Send"
),

array(
"name" => "Message sent text",
"id" => $shortname."_message_sent_text",
"type" => "text",
"std" => "Message sent"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-mail-open"></div>Validation error messages'),

array(
"name" => "Empty name message",
"id" => $shortname."_name_error",
"type" => "text",
"std" => "Please insert your name"
),

array(
"name" => "Invalid email message",
"id" => $shortname."_email_error",
"type" => "text",
"std" => "Please insert a valid email"
),

array(
"name" => "Empty question message",
"id" => $shortname."_question_error",
"type" => "text",
"std" => "Please insert your question"
),


array(
"type" => "close"),


//------------------PORTFOLIO SETTINGS-------------------

array(
"name" => "Portfolio",
"type" => "title"),

array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-wrench"></div>Portfolio Item Posts Settings'
),

array(
"name" => "Page Layout",
"id" => $shortname."_portfolio_layout",
"type" => "select",
"options" => array('Right Sidebar', 'Left Sidebar','Full Width'),
"values" => array('right', 'left','full'),
"std" => 'right',
"desc" => 'This is the layout of the portfolio item content page'
),

array(
"name" => "Show comments",
"id" => $shortname."_portfolio_comments",
"type" => "select",
"options" => array('Hide','Show'),
"values" => array('off', 'on'),
"std" =>'off'
),

array(
"name" => "Content Sidebar",
"id" => $shortname."_portfolio_sidebar",
"type" => "select",
"options" => $sidebar_names,
"values" => $sidebar_ids,
"std" => 'home'
),

array(
"type" => "close"),


//------------------TRANSLATION-------------------

array(
"name" => "Translation",
"type" => "title"),

array(
"type" => "open"),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-script"></div>Blog Texts'
),

array(
"name" => "Read more text",
"id" => $shortname."_read_more",
"type" => "text",
"std" => "Read More..."
),


array(
"name" => "By text",
"id" => $shortname."_by_text",
"type" => "text",
"std" => "By"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-comment"></div>Comments texts'
),


array(
"name" => "No comments text",
"id" => $shortname."_no_comments_text",
"type" => "text",
"std" => "No comments"
),


array(
"name" => "One omment text",
"id" => $shortname."_one_comment_text",
"type" => "text",
"std" => "One comment"
),


array(
"name" => "Comments text",
"id" => $shortname."_comments_text",
"type" => "text",
"std" => "comments"
),

array(
"name" => "Leave a comment text",
"id" => $shortname."_leave_comment_text",
"type" => "text",
"std" => "Leave a comment"
),

array(
"name" => "Name text",
"id" => $shortname."_comment_name_text",
"type" => "text",
"std" => "Name"
),

array(
"name" => "Email text",
"id" => $shortname."_email_text",
"type" => "text",
"std" => "Email(will not be published)"
),

array(
"name" => "Website text",
"id" => $shortname."_website_text",
"type" => "text",
"std" => "Website"
),

array(
"name" => "Your comment text",
"id" => $shortname."_your_comment_text",
"type" => "text",
"std" => "Your comment"
),

array(
"name" => "Submit comment text",
"id" => $shortname."_submit_comment_text",
"type" => "text",
"std" => "Submit Comment"
),

array(
"name" => "Reply to comment text",
"id" => $shortname."_reply_text",
"type" => "text",
"std" => "Reply"
),


array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-image"></div>Portfolio Texts'
),

array(
"name" => "Previous page text",
"id" => $shortname."_previous_text",
"type" => "text",
"std" => "Previous"
),

array(
"name" => "Next page text",
"id" => $shortname."_next_text",
"type" => "text",
"std" => "Next"
),

array(
"name" => "More Projects text",
"id" => $shortname."_more_projects_text",
"type" => "text",
"std" => "More Projects"
),


array(
"name" => "ALL text",
"id" => $shortname."_all_text",
"type" => "text",
"std" => "ALL"
),

array(
"name" => "Show me text",
"id" => $shortname."_showme_text",
"type" => "text",
"std" => "show me:"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-search"></div>Search Texts'
),

array(
"name" => "Search box text",
"id" => $shortname."_search_text",
"type" => "text",
"std" => "Search"
),

array(
"name" => "Search results text",
"id" => $shortname."_search_results_text",
"type" => "text",
"std" => "Search results for"
),

array(
"name" => "No results found text",
"id" => $shortname."_no_results_text",
"type" => "text",
"std" => "No results found"
),

array(
"type" => "subtitle",
"name" => '<div class="ui-icon ui-icon-copy"></div>Other'
),

array(
"name" => "404 Page not found text",
"id" => $shortname."_404_text",
"type" => "text",
"std" => "The requested page has not been found"
),

array(
"type" => "close")
);


function mytheme_admin() {

	global $themename, $shortname, $options;


	if ( $_REQUEST['saved'] ) echo '<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-circle-check" style="float: left; margin-right: .3em;"></span>'.$themename.' settings saved.</p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';

	?>

<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
				<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
This is the <?php echo $themename; ?> options page where you can do most of the theme settings. Please note
that there is a documentation included where all the theme customization settings are explained. The documentation
is located within the <strong>documentation</strong> folder. <br/>
<strong>If you have any questions, please refer to the Support section of the documentation.</strong>
</p></div>

<div id="logo"></div>

<div id="tabs">
<form method="post">
<?php 
if ( function_exists('wp_nonce_field') ){
			wp_nonce_field('pexeto-theme-update-options','pexeto-theme-options');
		}
?>
<ul>
<?php
$i=1;
foreach ($options as $value) {

	if($value['type']=='title'){?>
	<li><a href="#tabs-<?php echo($i); ?>"><?php echo $value['name']; ?></a></li>
	<?php
	$i++;
	}
}
?>
</ul>
<?php
$i=0;
foreach ($options as $value) {
	switch ( $value['type'] ) {

		case "open":
			?>
<div id="tabs-<?php echo($i); ?>"><?php break;

case "close":
	?></div>
	<?php break;

case "misc":
	?>
<div class="option-container">
	<?php echo $value['name']; ?></div>
	<?php break;

case "title":
	$i++;
	break;

case 'text':
	?>
<div class="option-container">
<span class="option-title">
	<?php echo $value['name']; ?> </span> 
	<?php if ($value['image'] != "") {?>
<div class="option-image-container">
<img class="option-image" src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['image'];?>" alt="image" />
</div>
	<?php } ?> 
	<input class="option-input <?php if($value['color']==true) echo ' color';?> <?php if($value['upload']==true) echo ' image-input';?>"
	name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
	type="<?php echo $value['type']; ?>"
	value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
	

	<?php if($value['upload']==true){?>
	<div id="<?php echo $value['id']; ?>" class="upload-button upload-logo" >Upload Image</div><br/>
	
<?php	
     $path= get_template_directory_uri().'/functions/';
	 $uploadsdir=wp_upload_dir();
	 $uploadsurl=$uploadsdir[url];
		
		echo '<script type="text/javascript">jQuery(document).ready(function($){
			pexetoOptions.loadUploader(jQuery("div#'.$value['id'].'"), "'.$path.'upload-handler.php", "'.$uploadsurl.'");
	});</script>'; 
?>	
<?php } ?>
	
	<?php if($value['color']==true){?>
	 <div class="color-preview" style="background-color:#<?php echo get_option( $value['id'] ); ?>"></div>
	 <?php } ?>
<br />
<span class="option-description"><?php echo $value['desc']; ?></span></div>
	<?php
	break;

case 'hidden':
	?> <input style="width: 600px;" name="<?php echo $value['id']; ?>"
	id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
	value="<?php if ( get_option( $value['id'] ) != "" && get_option( $value['id'] ) != null) { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>" />
<script>jQuery(document).ready(function($) {
<?php echo($value['function']);?>
});
</script> <?php
break;

case 'textarea':
	?>
<div class="option-container">
<span class="option-title">
	<?php echo $value['name']; ?> </span> <?php if ($value['image'] != "") {?>
<div class="option-image-container">
<img class="option-image" src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['image'];?>" alt="image" />
</div>
	<?php } ?> <textarea name="<?php echo $value['id']; ?>" class="option-textarea" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'] )); } else { echo stripslashes($value['std']); } ?>
</textarea> <br />
<span class="option-description"><?php echo $value['desc']; ?></span></div>
	<?php
	break;
	/*Ralph Damiano*/
case 'select':
	?>
<div class="option-container">
<span class="option-title">
	<?php echo $value['name']; ?> </span> <?php if ($value['image'] != "") {?>
<div class="option-image-container">
<img class="option-image" src="<?php echo get_template_directory_uri(); ?>/images/<?php echo $value['image'];?>" alt="image" />
</div>
	<?php } ?> <select class="option-select" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	<?php
	$counter=0;
	foreach ($value['options'] as $option) { ?>
	<option
	<?php if ( get_option( $value['id'] ) ==$value['values'][$counter]) {
		echo ' selected="selected"';
	} elseif ($option == $value['std']) {
		echo ' selected="selected"';
	} ?>
	<?php $style='';
	if($value['color']) $style='style="background-color:#'.$value['values'][$counter].';border-bottom:1px solid #fff; color:#fff;"';
	if($value['pattern']) {
		$pexeto_pattern_path=get_template_directory_uri().'/images/patterns';
		$style='style="height:25px; vertical-align:middle; background-color:#828282; color:#fff; margin-bottom:1px; background-image:url('.$pexeto_pattern_path.'/'.$value['values'][$counter].');"';
	}
	
	?>
		value="<?php echo($value['values'][$counter]);?>" <?php echo $style; ?>><?php echo $option; ?></option>
		<?php
		$counter++;
	} 
	?>
</select> <br />
<span class="option-description"><?php echo $value['desc']; ?></span></div>
	<?php
	break;

case "checkbox":
	?>
<div class="option-container">
<span class="option-title">
	<?php echo $value['name']; ?> </span> <?php if ($value['image'] != "") {?>
<div class="option-image-container">
<img class="option-image" src="<?php echo get_template_directory_uri();?>/images/<?php echo $value['image'];?>" alt="image" />
</div>
	<?php } ?> <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
<input type="checkbox" name="<?php echo $value['id']; ?>"
	id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
<br />
<span class="option-description"><?php echo $value['desc']; ?></span></div>
	<?php
	break;

case 'multicheck':
	?>
<div class="option-container">
<span class="option-title">
	<?php echo $value['name']; ?> </span> <?php if ($value['image'] != "") {?>
<div class="option-image-container">
<img class="option-image" src="<?php echo get_template_directory_uri();?>/images/<?php echo $value['image'];?>" alt="image" />
</div>
	<?php } ?> <?php

	$idsString=get_option($value['id']);

	//$idsArray=$idsString.split(",");
	$idsArray=explode(",",$idsString);
	$counter=0;
	foreach ($value['options'] as $option) { ?> <input type="checkbox"
	value="<?php echo($value['values'][$counter]); ?>" class="check"
	<?php if(in_array($value['values'][$counter], $idsArray)){echo('checked="yes" ');}?> /><?php echo $option; ?><br />

	<?php
	$counter++;
	} ?> <input type="hidden" class="hiddenText"
	name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"
	value="<?php echo(get_option($value['id']));?>"> <br />
<span class="option-description"><?php echo $value['desc']; ?></span></div>
	<?php
	break;

case "submit":
	?>
<p class="submit"><input name="save" type="submit" value="Save changes"
	class="ui-state-default ui-corner-all" /> <input type="hidden"
	name="action" value="save" /></p>
	<?php break;


case "add_thumb_image": ?> 
<div class="option-container">
<span class="option-title">Add Thumbnail Slider Image</span>

<table>
	<tr>
		<td>Image URL:</td>
		<td><input type="text" id="urlThumImg" class="option-input image-input" /><div id="thumbUpload" class="upload-button" >Upload Image</div>
		<span class="option-description">You can either upload an image or insert directy the image URL.</span>
	</tr>
	<tr>
		<td>Image Link(Optional):</td>
		<td><input type="text" id="linkThumImg" class="option-input" /></td>
	</tr>
	<tr>
		<td>Image Description(Optional):</td>
		<td><textarea id="descThumImg" class="option-textarea" ></textarea></td>
	</tr>
	<tr>
		<td><input type="button" class="submit_button nomargin"
			value="Add Image" id="addThumImageButton" /></td>
	</tr>
</table>
<br />
<br />
Ddrag and drop boxes below to sort them <br />
<br />
<ul id="sortableThum" class="sortable">

</ul>
</div>
<?php
break;


case "add_thumb_image_big": ?> 
<div class="option-container">
<span class="option-title">Add Thumbnail Slider Image</span>

<table>
	<tr>
		<td>Image URL:</td>
				<td><input type="text" id="urlThumImgBig" class="option-input image-input" /><div id="thumUploadBig" class="upload-button" >Upload Image</div>
		<span class="option-description">You can either upload an image or insert directy the image URL.</span>
		</td>
	</tr>
	<tr>
		<td>Image Link(Optional):</td>
		<td><input type="text" id="linkThumImgBig" class="option-input" /></td>
	</tr>
	<tr>
		<td>Image Description(Optional):</td>
		<td><textarea id="descThumImgBig" class="option-textarea" ></textarea></td>
	</tr>
	<tr>
		<td><input type="button" class="submit_button nomargin"
			value="Add Image" id="addThumImageButtonBig" /></td>
	</tr>
</table>
<br />
<br />
Ddrag and drop boxes below to sort them <br />
<br />
<ul id="sortableThumBig" class="sortable">

</ul>
</div>
<?php
break;


case 'subtitle':?>
<div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix">
<h3><?php echo($value['name']); ?></h3>
</div>
<?php
break;

case "add_nivo_image": ?> 
<div class="option-container">
<span class="option-title">Add Nivo Slider Image</span>

<table>
	<tr>
		<td>Image URL:</td>
			<td><input type="text" id="urlNivoImg" class="option-input image-input" /><div id="nivoUpload" class="upload-button" >Upload Image</div>
		<span class="option-description">You can either upload an image or insert directy the image URL.</span>
		</td>
	</tr>
	<tr>
		<td>Image Link(Optional):</td>
		<td><input type="text" id="linkNivoImg" class="option-input" /></td>
	</tr>
	<tr>
		<td>Image Description(Optional):</td>
		<td><textarea id="descNivoImg" class="option-textarea" ></textarea></td>
	</tr>
	<tr>
		<td><input type="button" class="submit_button nomargin"
			value="Add Image" id="addNivoImageButton" /></td>
	</tr>
</table>
<br />
<br />
Ddrag and drop boxes below to sort them <br />
<br />
<ul id="sortableNivo" class="sortable">

</ul>
</div>
<?php
break;



case "add_sidebar": ?> 
<div class="option-container">

<table>
	<tr>
		<td>Sidebar Name:</td>
		<td><input type="text" id="sidebarName" class="option-input" /></td>
	</tr>
	<tr>
		<td><input type="button" class="submit_button nomargin"
			value="Add Sidebar" id="addSidebarButton" /></td>
	</tr>
</table>
<br />
<br />
Ddrag and drop boxes below to sort them <br />
<br />
<ul id="sortableSidebar" class="sortable">

</ul>
</div>
<?php
break;

	}
}
?>
<p class="submit"><input name="save" type="submit" class="submit_button"
	value="Save changes" /> <input type="hidden" name="action" value="save" /></p>
</form>

</div>
<?php
}


function echo_option($option){
	echo(stripslashes(get_option($option)));
}

function get_opt($option){
	return stripslashes(get_option('anthology'.$option));
}







?>