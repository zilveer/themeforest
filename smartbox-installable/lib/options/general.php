<?php
$google_fonts = des_get_all_google_fonts();

$designare_fonts_array = designare_fonts_array_builder();
$designare_portfolio_types = designare_portfolio_types();
$designare_projects = designare_get_proj();

$designare_general_options= array( array(
"name" => "General",
"type" => "title",
"img" => DESIGNARE_IMAGES_URL."icon_general.png"
),

array(
"type" => "open",
"subtitles"=>array(array("id"=>"main", "name"=>"Main Settings"), array("id"=>"seo", "name"=>"SEO"), array("id"=>"fonts", "name"=>"Google Fonts"), array("id"=>"projects", "name"=>"Projects"), array("id"=>"blog", "name"=>"Blog"), array("id"=>"search", "name"=>"Search"), array("id"=>"archives", "name"=>"Archives"), array("id"=>"shop", "name"=>"Shop"))
),

/* ------------------------------------------------------------------------*
 * MAIN SETTINGS
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'main'
),

array(
"type" => "documentation",
"text" => "<h3>Logo</h3>"
),

array(
"name" => "Logo type",
"id" => DESIGNARE_SHORTNAME."_logo_type",
"type" => "checkbox-text-image",
"std" => "image"
),

array(
"name" => "Margin Top",
"id" => DESIGNARE_SHORTNAME."_logo_margin_top",
"type" => "slider",
"std" => "10px",
"desc" => "Choose a top margin for your logo."
),

array(
"name" => "Margin Left",
"id" => DESIGNARE_SHORTNAME."_logo_margin_left",
"type" => "slider",
"std" => "0px",
"desc" => "Choose a left margin for your logo."
),


array(
"name" => "Logo URL",
"id" => DESIGNARE_SHORTNAME."_logo_image_url",
"type" => "upload",
"desc" => "Upload your logo image - with png/jpg/gif extension.",
"std" => "http://www.designarethemes.net/themes/smartbox/wp-content/uploads/2014/04/logosmart.png"
),

array(
"name" => "Logo Retina URL",
"id" => DESIGNARE_SHORTNAME."_logo_retina_image_url",
"type" => "upload",
"desc" => "Upload your logo image - with png/jpg/gif extension.",
"std" => "http://www.designarethemes.net/themes/smartbox/wp-content/uploads/2014/04/logo@2x.png"
),

array(
"name" => "Height",
"id" => DESIGNARE_SHORTNAME."_logo_height",
"type" => "text",
"desc" => "Insert the height of your logo (pixels).",
"std"=>"58px"
),

array(
"name" => "Reduced Height",
"id" => DESIGNARE_SHORTNAME."_logo_reduced_height",
"type" => "text",
"desc" => "Insert the height of your logo (pixels) on the sticky menu.",
"std" => "40px"
),


array(
"name" => "Text",
"id" => DESIGNARE_SHORTNAME."_logo_text",
"type" => "text",
"desc" => "Insert the text of your logo.",
"std" => "Smartbox"
),

array(
"name" => "Font",
"id" => DESIGNARE_SHORTNAME."_logo_font",
"type" => "select",
"options" => $designare_fonts_array,
"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).'
),

array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_logo_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),

array(
"name" => "Size",
"id" => DESIGNARE_SHORTNAME."_logo_size",
"type" => "slider",
"std" => "12 px",
"desc" => "Choose the size of your logo."
),

array(
"name" => "Color",
"id" => DESIGNARE_SHORTNAME."_logo_color",
"type" => "color",
"desc" => 'Select a custom color for your logo.'
),

array(
"type" => "documentation",
"text" => "<h3>Slogan</h3>"
),

array(
"name" => "Enable Slogan",
"id" => DESIGNARE_SHORTNAME."_slogan",
"type" => "checkbox",
"std" => 'off'),

array(
"name" => "Font",
"id" => DESIGNARE_SHORTNAME."_slogan_font",
"type" => "select",
"options" => $designare_fonts_array,
"desc" => 'You can select one of the fonts that the theme goes with or you can add google fonts (Style Options > Fonts).'
),

array(
"name" => "Font style",
"id" => DESIGNARE_SHORTNAME."_slogan_font_style",
"type" => "multicheck",
"options" => array(array("id"=>"bold", "name"=>"Bold"), array("id"=>"italic", "name"=>"Italic"), array("id"=>"underline", "name"=>"Underline")),
"class"=>"include"
),

array(
"name" => "Size",
"id" => DESIGNARE_SHORTNAME."_slogan_size",
"type" => "slider",
"std" => "12 px",
"desc" => "Choose the size of your slogan."
),

array(
"name" => "Color",
"id" => DESIGNARE_SHORTNAME."_slogan_color",
"type" => "color",
"desc" => 'Select a custom color for your slogan.'
),

array(
"type" => "documentation",
"text" => "<h3>Favicon</h3>"
),


array(
"name" => "Image URL",
"id" => DESIGNARE_SHORTNAME."_favicon",
"type" => "upload",
"desc" => "Upload a favicon image - with .ico extension.",
"std" => "http://placehold.it/4x4"
),

/*
array(
"type" => "documentation",
"text" => "<h3>Responsive Layout?</h3>"
),
*/

array(
"name" => "Disable Responsive Layout",
"id" => DESIGNARE_SHORTNAME."_disable_responsive",
"type" => "checkbox",
"std" =>"off",
"desc" => "By setting this option to true, the layout will not adapt to smaller resolutions such as in mobile devices and will display like it would in the normal resolution."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * Google Fonts
 * ------------------------------------------------------------------------*/
 
array(
"type" => "subtitle",
"id"=>'fonts'
),

array(
"type" => "documentation",
"text" => "<h3>Google API Fonts</h3>"
),

array(
"name" => "Enable Google Fonts",
"id" => DESIGNARE_SHORTNAME."_enable_google_fonts",
"type" => "checkbox",
"std" =>"on"
),

array(
"name" => "Choose Google Font",
"id" => "add_google_font",
"type" => "custom",
"button_text"=>'Add Font',
"desc"=>"In this field you can add or remove Google Fonts to the theme.",
"fields"=>array(
	array(
		'name' => 'Font URL',
		'id'=>'des_google_fonts_name',
		'type'=>'select',
		'options' => $google_fonts
	)
)
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
"text" => "<h3>Google Analytics</h3>"
),

array(
"name" => "Google Analytics Code",
"id" => DESIGNARE_SHORTNAME."_seo_analytics",
"type" => "textarea",
"desc" => "You can paste your generated Google Analytics here and it will be automatically set to the theme."
),

array(
"type" => "documentation",
"text" => "<h3>Website Info</h3>"
),

array(
"name" => "Site title",
"id" => DESIGNARE_SHORTNAME."_seo_sitetitle",
"type" => "text",
"desc" => 'Insert a title for your site. If empty, it will use the wordpress default title/tagline.'
),

array(
"name" => "Site keywords",
"id" => DESIGNARE_SHORTNAME."_seo_keywords",
"type" => "text",
"desc" => 'The main keywords that describe your site, separated by commas. Example:<br />
<i>portfolio,design,web</i>'
),

array(
"name" => "Site Description",
"id" => DESIGNARE_SHORTNAME."_seo_description",
"type" => "textarea",
"desc" => "Here you can set a description that will be displayed on your site."
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * Projects
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'archives'
),


array(
"type" => "documentation",
"text" => "<h3>HomePage with Posts Listing</h3>"
),

array(
"name" => "Primary Title",
"id" => DESIGNARE_SHORTNAME."_index_primary_title",
"type" => "text"
),

array(
"name" => "Secondary Title",
"id" => DESIGNARE_SHORTNAME."_index_secondary_title",
"type" => "text",
"desc" => "If set, will display this as a secondary title."
),

array(
"type" => "documentation",
"text" => "<h3>Blog Archive</h3>"
),

array(
"name" => "Secondary Title",
"id" => DESIGNARE_SHORTNAME."_archive_secondary_title",
"type" => "text",
"desc" => "If set, will display this as a secondary title."
),

array(
"name" => "Sidebar",
"id" => DESIGNARE_SHORTNAME."_blog_archive_sidebar",
"type" => "select",
"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"left", "name"=>"Left"), array("id"=>"right", "name"=>"Right")),
"std"=>"right"
),

array(
"type" => "documentation",
"text" => "<h3>Projects Archive</h3>"
),

array(
"name" => "Primary Title",
"id" => DESIGNARE_SHORTNAME."_projects_primary_title",
"type" => "text"
),

array(
"name" => "Secondary Title",
"id" => DESIGNARE_SHORTNAME."_projects_secondary_title",
"type" => "text",
"desc" => "If set, will display this as a secondary title."
),

array(
"name" => "Predefined Style",
"id" => DESIGNARE_SHORTNAME."_projects_archive_style",
"type" => "select",
"options" => array(array("id"=>"style1", "name"=>"Style 1"), array("id"=>"style2", "name"=>"Style 2")),
"std"=>"no"
),

array(
"name" => "Number of columns",
"id" => DESIGNARE_SHORTNAME."_projects_archive_ncolumns",
"type" => "select",
"options" => array(array("id"=>"2col", "name"=>"2"), array("id"=>"3col", "name"=>"3"), array("id"=>"4col", "name"=>"4")),
"std"=>"4col"
),

array(
"name" => "Effect",
"id" => DESIGNARE_SHORTNAME."_projects_archive_effect",
"type" => "select",
"options" => array(array("id"=>"move", "name"=>"Move"), array("id"=>"opacity", "name"=>"Opacity")),
"std"=>"Move"
),

array(
"type" => "close"),

/* ------------------------------------------------------------------------*
 * Blog
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'blog'
),

array(
"type" => "documentation",
"text" => "<h3>Blog Reading Option</h3>"
),

array(
"name" => "Reading Type",
"id" => DESIGNARE_SHORTNAME."_blog_reading_type",
"type" => "select",
"options" => array(array('id'=>'default','name'=>'Default'), array('id'=>'paged','name'=>'Pagination'), array('id'=>'dropdown', 'name'=>'Pagination Dropdown List'), array('id'=>'scroll','name'=>'Load More'), array('id'=>'scrollauto','name'=>'Auto Load More')),
"std" => 'default'
),

array(
"type" => "documentation",
"text" => "<h3>Blog - Single Post Options</h3>"
),

array(
	"name" => "Primary Title",
	"id" => DESIGNARE_SHORTNAME."_blog_single_primary_title",
	"type" => "text",
	"std" => "Blog"
),

array(
	"name" => "Secondary Title",
	"id" => DESIGNARE_SHORTNAME."_archive_secondary_title",
	"type" => "text",
	"desc" => "If set, will display this as a secondary title."
),


array(
	"name" => "Default Sidebar",
	"id" => DESIGNARE_SHORTNAME."_blog_single_sidebar",
	"type" => "select",
	"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"left", "name"=>"Left"), array("id"=>"right", "name"=>"Right")),
	"std"=>"right"
),

array(
	"name" => "Enlarge Images on Single Post",
	"id" => DESIGNARE_SHORTNAME."_enlarge_images",
	"type" => "checkbox",
	"std" => 'off',
	"desc" => 'If "ON" PrettyPhoto effect will be available.'
),

array(
"type" => "close"),


/* ------------------------------------------------------------------------*
 * Projects
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'projects'
),

array(
"type" => "documentation",
"text" => "<h3>Projects Display</h3>"
),


array(
	"name" => "Portfolio Permalink",
	"id" => DESIGNARE_SHORTNAME."_portfolio_permalink",
	"type" => "text",
	"std" => "portfolio",
	"desc" => "Change the \"/portfolio/\" bit of the projects' permalink. <br/><strong>Max. 20 characters, can not contain capital letters or spaces.</strong>"
),

array(
	"type" => "documentation",
	"text" => "* If you change this option you need to go to <strong>Settings > Permalinks </strong>and click the <strong>Save Changes</strong> button or you'll get a 404 error on the single projects."
),

array(
	"name" => "Animate Thumbnails ?",
	"id" => DESIGNARE_SHORTNAME."_animate_thumbnails",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Animation Effect",
	"id" => DESIGNARE_SHORTNAME."_thumbnails_effect",
	"type" => "select",
	"options" => array(array('id'=>'flip', 'name'=>'Flip'), array('id'=>'flipInX', 'name'=>'Flip In X'), array('id'=>'bounceIn', 'name'=>'Bounce In'), array('id'=>'bounceInDown', 'name'=>'Bounce In Down'), array('id'=>'bounceInUp', 'name'=>'Bounce In Up'), array('id'=>'bounceInLeft', 'name'=>'Bounce In Left'), array('id'=>'bounceInRight', 'name'=>'Bounce In Right'), array('id'=>'fadeIn', 'name'=>'Fade In'), array('id'=>'fadeInUp', 'name'=>'Fade In Up'), array('id'=>'fadeInDown', 'name'=>'Fade In Down'), array('id'=>'fadeInLeft', 'name'=>'Fade In Left'), array('id'=>'fadeInRight', 'name'=>'Fade In Right'), array('id'=>'fadeInUpBig', 'name'=>'Fade In Up Big'), array('id'=>'fadeInDownBig', 'name'=>'Fade In Down Big'), array('id'=>'fadeInLeftBig', 'name'=>'Fade In Left Big'), array('id'=>'fadeInRightBig', 'name'=>'Fade In Right Big'), array('id'=>'rotateIn', 'name'=>'Rotate In'), array('id'=>'rotateInDownLeft', 'name'=>'Rotate In Down Left'), array('id'=>'rotateInDownRight', 'name'=>'Rotate In Down Right'), array('id'=>'rotateInUpLeft', 'name'=>'Rotate In Up Left'), array('id'=>'rotateInUpRight', 'name'=>'Rotate In Up Right'), array('id'=>'lightSpeedIn', 'name'=>'Light Speed In'), array('id'=>'lightSpeedOut', 'name'=>'Light Speed Out'), array('id'=>'hinge', 'name'=>'Hinge'), array('id'=>'rollIn', 'name'=>'Roll In'), array('id'=>'rollOut', 'name'=>'Roll Out')),
	"std" => "fadeInDown"
),

array(
	"name" => "Style #1 Thumbnails Hover Option",
	"id" => DESIGNARE_SHORTNAME."_thumbnails_hover_option",
	"type" => "select",
	"options" => array(array('id'=>'link_magnifier','name'=>'Link + Magnifier'), array('id'=>'magnifier','name'=>'Magnifier'), array('id'=>'link', 'name'=>'Link'), array('id'=>'none','name'=>'None')),
	"std" => 'link_magnifier'
),

array(
	"name" => "Open | Close on Categories",
	"id" => DESIGNARE_SHORTNAME."_enable_open_close_categories",
	"type" => "checkbox",
	"std" => "on"
),

array(
	"name" => "Categories Initial State",
	"id" => DESIGNARE_SHORTNAME."_categories_initial_state",
	"type" => "select",
	"options" => array(array("id"=>"closed", "name"=>"Closed"), array("id"=>"open","name"=>"Open")),
	"std" => "closed"
),

array(
"name" => "Project Single Layout Option",
"id" => DESIGNARE_SHORTNAME."_single_layout",
"type" => "select",
"options" => array(array('id'=>'left_slider','name'=>'Left Slider'), array('id'=>'full_slider','name'=>'Full Slider'), array('id'=>'fullwidth_slider', 'name'=>'Full Width Slider')),
"std" => 'left_slider'
),

array(
"name" => "Enlarge Images on Single Project",
"id" => DESIGNARE_SHORTNAME."_projects_enlarge_images",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If "ON" PrettyPhoto effect will be available.'
),

array(
	"type" => "close"
),



/* ------------------------------------------------------------------------*
 * Search
 * ------------------------------------------------------------------------*/

array(
"type" => "subtitle",
"id"=>'search'
),
	
array(
"type" => "documentation",
"text" => "<h3>Search Results</h3>"
),

array(
"name" => "Secondary Title",
"id" => DESIGNARE_SHORTNAME."_search_secondary_title",
"type" => "text",
"desc" => "If set, will display this as a secondary title."
),

array(
"name" => "Sidebar",
"id" => DESIGNARE_SHORTNAME."_search_archive_sidebar",
"type" => "select",
"options" => array(array("id"=>"none", "name"=>"None"), array("id"=>"left", "name"=>"Left"), array("id"=>"right", "name"=>"Right")),
"std"=>"right"
),

array(
"name" => "Search Everything",
"id" => DESIGNARE_SHORTNAME."_search_everything",
"type" => "checkbox",
"std" => 'off',
"desc" => 'If "on" the search will show results from Pages as well.'
),

array(
	"type" => "close"
),

/*SHOP*/
array(
	"type" => "subtitle",
	"id" => "shop"
),

array(
	"type" => "documentation",
	"text" => "<h3>WooCommerce Shop</h3><br/><p>These titles will appear on Product Pages (either single products and categories/tags)</p>"
),

array(
	"name" => "Shop Primary Title",
	"id" => DESIGNARE_SHORTNAME."_shop_primary_title",
	"type" => "text",
	"std" => "Shop"
),

array(
	"name" => "Shop Secondary Title",
	"id" => DESIGNARE_SHORTNAME."_shop_secondary_title",
	"type" => "text",
	"desc" => "If set, will display this as a secondary title."
),

array(
	"type" => "close"
),


array(
"type" => "close"));

designare_add_options($designare_general_options);