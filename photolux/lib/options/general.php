<?php

$sociable_icons=array('', 'facebook.png', 'twitter.png', 'googleplus.png', 'rss.png', 'flickr.png', 'delicious.png', 'skype.png', 'youtube.png', 'vimeo.png', 'blogger.png', 'linkedin.png', 'myspace.png', 'reddit.png', 'dribbble.png', 'forrst.png', 'deviant-art.png', 'digg.png', 'github.png', 'lastfm.png', 'sharethis.png', 'stumbleupon.png', 'tumblr.png', 'wordpress.png', 'yahoo.png', 'amazon.png', 'apple.png', 'bing.png', 'pinterest.png', '500px.png', 'instagram.png');
foreach($sociable_icons as $key=>$value){
	$sociable_icons[$key]=PEXETO_FRONT_IMAGES_URL.'icons/'.$value;
}

$pexeto_show_sharing_slider = get_opt('_show_share_buttons');
$pexeto_default_sharing = empty($pexeto_show_sharing_slider) ? '' : 'slider';

$pexeto_general_options= array( array(
"name" => "General",
"type" => "title",
"img" => "icon-settings"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"main", "name"=>"Main Settings"), array("id"=>"sidebars", "name"=>"Sidebars"), array("id"=>"sociable", "name"=>"Social"), array("id"=>"seo", "name"=>"SEO"), array("id"=>"update", "name"=>"Theme Update"))
),

/* ------------------------------------------------------------------------*
 * MAIN SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'main'
),

array(
"name" => "Responsive Layout",
"id" => PEXETO_SHORTNAME."_responsive_layout",
"type" => "checkbox",
"desc" => "The responsive layout will set a fluid size to the main content elements,
so they are resized proportionally according to the window size. This layout mainly
improves the experience on mobile devices with smaller screens, as the elements are
resized to fit the screens.",
"std" => 'on'
),

array(
"name" => "Favicon image URL",
"id" => PEXETO_SHORTNAME."_favicon",
"type" => "upload",
"desc" => "Upload a favicon image - with .ico extention."
),

array(
"name" => "Display page title on pages",
"id" => PEXETO_SHORTNAME."_show_page_title",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If "ON" selected, the page title will be displayed in the beginning of the page content
as a main title. '
),

array(
"name" => "Display comments on pages",
"id" => PEXETO_SHORTNAME."_page_comments",
"type" => "checkbox",
"std" => 'off',
"desc" => 'By default comments won\'t be displayed on pages, but if you turn this option ON, you will be able
to enable/disable comments for the separate pages in the "Allow comments" field of the page.<br />
Note: This option is available for the Default Page Template only'
),

array(
"name" => "Disable right click",
"id" => PEXETO_SHORTNAME."_disable_click",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If "ON" selected, right click will be disabled for the theme in order to add copyright protection to images.
If you insert a text in the "Message on right click" field below, this message will be alerted.'
),

array(
"name" => "Message on right click",
"id" => PEXETO_SHORTNAME."_click_message",
"type" => "textarea",
"desc" => "This is the message that is displayed when the mouse right click is disabled. If you leave the field empty, no message will be alerted."
),


array(
"name" => "Google Analytics Code",
"id" => PEXETO_SHORTNAME."_analytics",
"type" => "textarea",
"desc" => "You can paste your generated Google Analytics here and it will be automatically set to the theme."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SIDEBARS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'sidebars'
),

array(
"name"=>"Add Sidebar",
"id"=>'sidebars',
"type"=>"custom",
"button_text"=>'Add Sidebar',
"fields"=>array(
	array('id'=>'_sidebar_name', 'type'=>'text', 'name'=>'Sidebar Name')
),
"desc"=>"You can add as many custom sidebars you like and after that for each page you will be
able to assign a different sidebar."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SOCIABLE ICONS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'sociable'
),

array(
"name" => "Display social icons in footer",
"id" => PEXETO_SHORTNAME."_show_footer_icons",
"type" => "checkbox",
"std" => 'on',
"desc" => 'If enabled, a sociable icons section will be displayed in the footer. You can add sociable icons in the 
"Add a sociable icon to the footer" section below.'
),


array(
"name"=>"Add a social icon to the footer",
"id"=>'sociable_icons',
"type"=>"custom",
"button_text"=>'Add Icon',
"preview"=>'_icon_url',
"fields"=>array(
array('id'=>'_icon_url', 'type'=>'imageselect', 'name'=>'Select Icon','options'=>$sociable_icons),
	array('id'=>'_icon_link', 'type'=>'text', 'name'=>'Sociable Site Link'),
	array('id'=>'_icon_title', 'type'=>'text', 'name'=>'Hover title (optional)')
)
),

array(
"type" => "documentation",
"text" => '<h2 class="option-section-title">Social sharing buttons</h2>' ),

array(
"name" => "Sharing Buttons",
"id" => PEXETO_SHORTNAME."_show_share_buttons",
"type" => "multicheck",
"options" => array(array('id'=>'facebook', 'name'=>'Facebook'),
	array('id'=>'twitter', 'name'=>'Twitter'), 
	array('id'=>'googleplus', 'name'=>'Google+'), 
	array('id'=>'pinterest', 'name'=>'Pinterest')),
'std' => 'facebook,twitter,googleplus,pinterest',
"class"=>"include"),

array(
	'name' => 'Display sharing buttons on',
	'id' => PEXETO_SHORTNAME.'_show_share_buttons_on',
	'type' => 'multicheck',
	'std'=>$pexeto_default_sharing,
	'options' => array(
			array( 'id'=>'page', 'name'=>'Pages' ),
			array( 'id'=>'post', 'name'=>'Posts' ),
			array( 'id'=>'slider', 'name'=>'Gallery Portfolio Slider' ),
			array( 'id'=>'portfolio', 'name'=>'Portfolio posts' )),
	'class'=>'include' 
),

array(
	'name' => 'Google+ button language code',
	'id' => PEXETO_SHORTNAME.'_gplus_lang',
	'type' => 'text',
	'desc' => 'The language code of the text that will be related with the 
		Google+ button functionality. You can get the list with all available 
		language codes here: 
		https://developers.google.com/+/plugins/+1button/#available-languages',
	'std' => 'en-US'
),


array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * SEO
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'seo'
),

array(
"type" => "documentation",
"text" => '<div class="note_box">
		 <b>Note: </b> This section contains some basic SEO options. For more advanced options, you may consider
		 using a SEO plugin - some plugins that we recommend are <a href="http://wordpress.org/extend/plugins/wordpress-seo/">WordPress SEO by Yoast</a> 
		 and <a href="http://wordpress.org/extend/plugins/all-in-one-seo-pack/">All in One SEO Pack</a>
		</div>'
),

array(
"name" => "Site keywords",
"id" => PEXETO_SHORTNAME."_seo_keywords",
"type" => "text",
"desc" => 'The main keywords that describe your site, separated by commas. Example:<br />
<i>photography,design,art</i>'
),

array(
"name" => "Home Page Description",
"id" => PEXETO_SHORTNAME."_seo_description",
"type" => "textarea",
"desc" => "By default the Tagline set in <b>Settings &raquo; General</b> will be displayed as a description of the site. Here
you can set a description that will be displayed on your home page only."
),

array(
"name" => "Home page title",
"id" => PEXETO_SHORTNAME."_seo_home_title",
"type" => "text",
"desc" => 'This is the home page document title. By default the blog name is displayed and if you insert a title here,
it will be prepended to the blog name'
),

array(
"name" => "Page title separator",
"id" => PEXETO_SHORTNAME."_seo_serapartor",
"type" => "text",
"std" => '@',
"desc" => 'Separates the different title parts'
),

array(
"name" => "Page title for category browsing",
"id" => PEXETO_SHORTNAME."_seo_category_title",
"type" => "text",
"std" => 'Category &raquo; ',
"desc" => 'This is the page title that is set to the document when browsing a category - the title is built by the
text entered here, the name of the category and the name of the blog - for example:<br /><i>Category &raquo; Business &laquo; @  Blog name</i>'
),

array(
"name" => "Page title for tag browsing",
"id" => PEXETO_SHORTNAME."_seo_tag_title",
"type" => "text",
"std" => 'Tag &raquo; ',
"desc" => 'This is the page title that is set to the document when browsing a tag - the title is built by the
text entered here, the name of the tag and the name of the blog - for example:<br /><i>Tag &raquo; business &laquo; @  Blog name</i>'
),

array(
"name" => "Page title for search results",
"id" => PEXETO_SHORTNAME."_search_tag_title",
"type" => "text",
"std" => 'Search results &raquo; ',
"desc" => 'This is the page title that is set to the document when displaying search results - the title is built by the
text entered here, the search query and the name of the blog - for example:<br /><i>Search results &raquo;  business &laquo; @  Blog name</i>'
),

array(
"name" => "Exclude pages from indexation",
"id" => PEXETO_SHORTNAME."_seo_indexation",
"type" => "multicheck",
"options" => array(array('id'=>'category', 'name'=>'Category Archive'), array('id'=>'date', 'name'=>'Date Archive'), array('id'=>'tag', 'name'=>'Tag Archive'), array('id'=>'author', 'name'=>'Author Archive'), array('id'=>'search', 'name'=>'Search Results')),
"class"=>"exclude",
"desc" => 'Pages, such as archives pages, display some duplicate content - for example, the same post can be found on your main Blog
page, but also in a category archive, date archive, etc. Some search engines are reported to penalize sites associated with too much duplicate
content. Therefore, excluding the pages from this option will remove the search engine indexiation by adding "noindex" and
"nofollow" meta tags which would prevent the search engines to index this duplicate content. By default, all the pages are indexed. '),

array(
"type" => "close"),


/* ------------------------------------------------------------------------*
 * THEME UPDATE
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'update'
),

array(
"name" => "Envato Marketplace Username",
"id" => PEXETO_SHORTNAME."_tf_username",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert the username of the account you used to purchase the theme from ThemeForest. For more information you can refer to the \"Updates\" section of the documentation."
),

array(
"name" => "Envato Marketplace API Key",
"id" => PEXETO_SHORTNAME."_tf_api_key",
"type" => "text",
"desc" => "If you would like to have an option to automatically update the theme from the admin panel, you have to insert your API Key here. To obtain your API Key, visit your \"My Settings\" page on any of the Envato Marketplaces (ThemeForest). For more information you can refer to the \"Updates\" section of the documentation."
),


array(
"type" => "close"),


array(
"type" => "close"));

pexeto_add_options($pexeto_general_options);