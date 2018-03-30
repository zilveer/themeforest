<?php 

$themename = "The Cause";
$pageoptions = array('file' => basename(__FILE__), 'name' => 'Appearance Settings', 'child' => true);

$buttonStyle = array(
	'default' => 'Default (white)',
	'blue' => 'Blue',
	'brown' => 'Brown',
	'green' => 'Green',
	'orange' => 'Orange',
	'purple' => 'Purple',
	'red' => 'Red'
);

$buttonStyleExtra = array(
	'default' => 'Default (red)',
	'blue' => 'Blue',
	'brown' => 'Brown',
	'green' => 'Green',
	'orange' => 'Orange',
	'purple' => 'Purple',
	'white' => 'White'
);

$colorStyle = array(
	'default' => 'Default (blue)',
	'brown' => 'Brown',
	'gray' => 'Gray',
	'green' => 'Green',
	'orange' => 'Orange',
	'purple' => 'Purple',
	'red' => 'Red',
	'yellow' => 'Yellow',
	'white' => 'White'
);

$colorStyle2 = array(
	'default' => 'Default (blue)',
	'brown' => 'Brown',
	'gray' => 'Gray',
	'green' => 'Green',
	'orange' => 'Orange',
	'purple' => 'Purple',
	'red' => 'Red',
	'yellow' => 'Yellow'
);

$predefinedColors = array(
	'custom' => 'Custom',
	'idealist' => 'Idealist',
	'spiritual' => 'Spiritual',
	'politica' => 'Politica'
);

// Options
$options = array();
$options[] = array( "name" => "Appearance Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Header Background Color", "desc" => "Choose header background color", "id" => "tb_header_bckg_color", "type" => "colorPicker", "std" => DEFAULT_HEADER_BCKG_COLOR);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Header Background Image", "desc" => "Choose header background image", "id" => "tb_header_bckg_image", "type" => "upload", "std" => DEFAULT_HEADER_BCKG_IMAGE);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Landing page background color", "desc" => "Please choose background color of landing page.", "id" => "tb_landing_bgcolor", "type" => "colorPicker", "std" => DEFAULT_LANDING_BGCOLOR);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Landing page background image", "desc" => "Choose background image of landing page (or leave blank).", "id" => "tb_landing_bckg_image", "type" => "upload", "std" => DEFAULT_LANDING_BCKG_IMAGE);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Main background image", "desc" => "Choose main background image (or leave blank if you don't want to use it). Min width: 1350px, please.", "id" => "tb_main_bckg_image", "type" => "upload", "std" => DEFAULT_MAIN_BCKG_IMAGE);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Main background shadow", "desc" => "Do you want to use shadow above main background image (recommended for narrow images)", "id" => "tb_main_bckg_shadow", "type" => "select", "value" => array('yes' => 'Yes', 'no' => 'No'), "std" => DEFAULT_MAIN_BCKG_SHADOW);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Color Scheme", "desc" => "Please choose color scheme.", "id" => "tb_color_scheme", "type" => "select", "value" => $predefinedColors, "std" => 'custom');
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Navigation Background", "desc" => "Please choose navigation background.", "id" => "tb_navigation_bckg", "type" => "select", "value" => $colorStyle, "std" => DEFAULT_NAVIGATION_BCKG);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Button style", "desc" => "Please choose color of buttons.", "id" => "tb_button_style", "type" => "select", "value" => $buttonStyle, "std" => DEFAULT_BUTTONS);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Extra button style", "desc" => "Please choose color of 'extra' buttons (i.e. donate button).", "id" => "tb_button_extra_style", "type" => "select", "value" => $buttonStyleExtra, "std" => DEFAULT_BUTTONS_EXTRA);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Sidebar style", "desc" => "Please choose color of sidebar heading background.", "id" => "tb_sidebar_style", "type" => "select", "value" => $colorStyle2, "std" => DEFAULT_SIDEBAR_BCKG);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Sidebar position", "desc" => "Please choose position of sidebar.", "id" => "tb_sidebar_position", "type" => "select", "value" => array('leftSidebar' => 'Left', 'rightSidebar' => 'Right'), "std" => DEFAULT_SIDEBAR_POSITION);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Font", "desc" => "Please choose font which will be for headings.", "id" => "tb_font", "type" => "select", "subType" => "font", "std" => DEFAULT_FONT);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Cursive Font", "desc" => "Please choose cursive font..", "id" => "tb_font2", "type" => "select", "subType" => "font", "dir" => "fonts2", "std" => DEFAULT_FONT2);
$options[] = array( "type" => "close2");

$options[] = array( "name" => "Home Slider Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Order of slides", "desc" => "", "id" => "tb_slider_order_of_slides", "type" => "select", "value" => array('menu' => 'Menu order', 'rand' => 'Random'), "std" => DEFAULT_HOME_CUSTOM_SLIDES_ORDER);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Home page slider effect", "desc" => "Choose effect for home page slider", "id" => "tb_home_slider_effect", "type" => "select", "value" => array('slide' => 'Slide', 'fade' => 'Fade'), "std" => DEFAULT_HOME_SLIDER_EFFECT);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Animation speed", "desc" => "Choose speed of animation (in milliseconds)", "id" => "tb_home_slider_speed", "type" => "text", "std" => DEFAULT_HOME_SLIDER_SPEED);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Autoplay time", "desc" => "Choose time of autoplay (in milliseconds)", "id" => "tb_home_slider_autoplay", "type" => "text", "std" => DEFAULT_HOME_SLIDER_AUTOPLAY);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Use easing effect", "desc" => "Do you want to use easing effect?", "id" => "tb_home_slider_use_easing", "type" => "select", "value" => array("yes" => "Yes", "no" => "No"), "std" => DEFAULT_HOME_SLIDER_USE_EASING);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Easing effect", "desc" => "Add easing effect.", "id" => "tb_home_slider_easing", "type" => "text", "std" => DEFAULT_HOME_SLIDER_EASING);
$options[] = array( "type" => "close2");

$options[] = array( "name" => "Media Slider Settings", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Gallery slider effect", "desc" => "Choose effect for featured gallery slider", "id" => "tb_gallery_slider_effect", "type" => "select", "value" => array('slide' => 'Slide', 'fade' => 'Fade'), "std" => DEFAULT_GALLERY_SLIDER_EFFECT);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Animation speed", "desc" => "Choose speed of animation (in milliseconds)", "id" => "tb_gallery_slider_speed", "type" => "text", "std" => DEFAULT_GALLERY_SLIDER_SPEED);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Autoplay time", "desc" => "Choose time of autoplay (in milliseconds)", "id" => "tb_gallery_slider_autoplay", "type" => "text", "std" => DEFAULT_GALLERY_SLIDER_AUTOPLAY);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Use easing effect", "desc" => "Do you want to use easing effect?", "id" => "tb_gallery_slider_use_easing", "type" => "select", "value" => array("yes" => "Yes", "no" => "No"), "std" => DEFAULT_GALLERY_SLIDER_USE_EASING);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Easing effect", "desc" => "Add easing effect.", "id" => "tb_gallery_slider_easing", "type" => "text", "std" => DEFAULT_GALLERY_SLIDER_EASING);
$options[] = array( "type" => "close2");

$adminOptionsPage = new dashboardPages($options, $pageoptions);

?>