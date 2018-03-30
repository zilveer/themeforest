<?php

add_action('init','of_options');

if (!function_exists('of_options')) {
function of_options() {

// Access the WordPress Pages via an Array
$of_pages = array();
$of_pages_obj = get_pages( 'parent=0' );
foreach ( $of_pages_obj as $of_page ) {
	$of_pages[$of_page->post_name] = $of_page->post_title;
}
$of_pages_tmp = array_unshift( $of_pages, __( 'Select a page:', 'flatbox' ) );

// get layout images
$admin_img_path =  ADMIN_DIR . 'assets/images/';
$portfolio_layouts = array(
	'3' => $admin_img_path . '4-col-portfolio.png',
	'4' => $admin_img_path . '3-col-portfolio.png',
	'6' => $admin_img_path . '2-col-portfolio.png',
);
$portfolio_layouts_keys = array_keys($portfolio_layouts);
$sidebar_layouts = array(
	'right' => $admin_img_path . '2cr.png',
	'left' => $admin_img_path . '2cl.png',
);
$sidebar_layouts_keys = array_keys($sidebar_layouts);

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array(
	"name" => __('General Settings','flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Main Logo', 'flatbox'),
	"desc" => __('Select a graphic logo to be used instead of the text version - it will get resized to fit the theme\'s design. <span style="color:#d52">Recommanded size: 350px x 130px</span>', 'flatbox'),
	"id" => "custom_logo",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Custom Favicon', 'flatbox'),
	"desc" => __("Upload a 16px x 16px png / gif image that will represent your website's favicon", 'flatbox'),
	"id" => "custom_favicon",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Custom Site Image', 'flatbox'),
	"desc" => __('Upload custom site thumbnail image used by services like Facebook Share.', 'flatbox'),
	"id" => "custom_site_image",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Search Form', 'flatbox'),
	"desc" => __('Determines if search form is visibe in the header', 'flatbox'),
	"id" => "header_search_form",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Custom CSS', 'flatbox'),
	"desc" => __('Quickly add some CSS to your theme by adding it into this block.', 'flatbox'),
	"id" => "custom_css",
	"std" => "",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Google Analytics Snippet', 'flatbox'),
	"desc" => __('Paste your Google Analytics (or other) tracking code here. This will be added into the head section of your website (must include script tags).', 'flatbox'),
	"id" => "tracking_header",
	"std" => '',
	"type" => "textarea"
);

//	Extra Menu
$of_options[] = array(
	"name" => __('Extra Menu','flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Show Extra Menu', 'flatbox'),
	"desc" => __('You can turn extra menu ON and OFF.', 'flatbox'),
	"id" => "extramenu_on",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Extra Menu Links', 'flatbox'),
	"desc" => __('Manage extra menu links.', 'flatbox'),
	"id" => "exmenu",
	"std" => "",
	"type" => "slider"
);


$of_options[] = array(
	"name" => __('Style Settings','flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Base Color','flatbox'),
	"desc" => __('Select the main color of the theme (leave field empty for default theme color).', 'flatbox'),
	"id" => "color_base",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Second Color','flatbox'),
	"desc" => __('Select the color of the secondary theme color in the content area (leave field empty for default theme color).', 'flatbox'),
	"id" => "color_link",
	"std" => '',
	"type" => "color"
);

$animations = array('none', 'shake', 'flash', 'bounce', 'tada', 'swing', 'wobble', 'wiggle', 'pulse', 'flip');
$of_options[] = array(
	"name" => __('CSS3 Animation','flatbox'),
	"desc" => __('Select the CSS3 animation used for some elements (logo, buttons, etc.)', 'flatbox'),
	"id" => "css3_animation",
	"std" => $animations[0],
	"type" => "select",
	"options" => $animations
);


// Home
$of_options[] = array(
	"name" => __('Home Page', 'flatbox'),
	"type" => "heading"
);

$homepage_blocks = array(
	"enabled" => array (
		"placebo" => "placebo", // REQUIRED!
		"intro_text" => __('Introduction Text', 'flatbox'),
		"call_to_action" => __('Call-To-Action Box', 'flatbox'),
	),
	"disabled" => array (
		"placebo" => "placebo", // REQUIRED!
		"revolution_slider" => __('Revolution Slider', 'flatbox'),
		"layerslider" => __('LayerSlider', 'flatbox'),
		"video" => __('Video Player', 'flatbox'),
		"general" => __('General Text', 'flatbox'),
		"general2" => __('General Text 2', 'flatbox'),
		"features" => __('Features', 'flatbox'),
		"work" => __('Latest Work', 'flatbox'),
		"clients" => __('Clients', 'flatbox'),
		"quotes" => __('Quotes', 'flatbox'),
		"twitters" => __('Twitter', 'flatbox'),
		"toggles" => __('Points', 'flatbox'),
		"toggles2" => __('Points 2', 'flatbox'),
		"blog" => __('Recent Blog Posts', 'flatbox'),
		"progress1" => __('Progress bar', 'flatbox'),
		"progress2" => __('Progress circle', 'flatbox'),
		"showcase" => __('Showcase image', 'flatbox'),
		"html1" => __('HTML 1', 'flatbox'),
		"html2" => __('HTML 2', 'flatbox'),
		"html3" => __('HTML 3', 'flatbox'),
		"html4" => __('HTML 4', 'flatbox'),
	),
);

$of_options[] = array(
	"name" => __('Homepage Layout Manager', 'flatbox'),
	"desc" => __('Organize what sections of the layout you want to appear on the homepage and their order. Use drag and drop to manage them.', 'flatbox'),
	"id" => "homepage_blocks2",
	"std" => $homepage_blocks,
	"type" => "sorter"
);

$of_options[] = array(
	"name" => __('Introduction Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('Homepage Introduction Text Header', 'flatbox'),
	"desc" => __('Introduce the heading text used for the Introduction Text section.', 'flatbox'),
	"id" => "homepage_intro_header",
	"std" => __('Flat design just blows my mind', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Paragraph', 'flatbox'),
	"desc" => __('Introduce the paragraph text used for the Introduction Text section.', 'flatbox'),
	"id" => "homepage_intro_text",
	"std" => __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor aenean massaret. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus pellentesque eu pretium quis sem.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button Text', 'flatbox'),
	"desc" => __('Input the Button text.', 'flatbox'),
	"id" => "homepage_intro_link_text",
	"std" => __('Click Here', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button link', 'flatbox'),
	"desc" => __('Input button link(starting with http://).', 'flatbox'),
	"id" => "homepage_intro_link",
	"std" => __('button link', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button 2 Text', 'flatbox'),
	"desc" => __('Input the Button 2 text.', 'flatbox'),
	"id" => "homepage_intro_link_text2",
	"std" => __('Click Here', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button 2 link', 'flatbox'),
	"desc" => __('Input button 2 link(starting with http://).', 'flatbox'),
	"id" => "homepage_intro_link2",
	"std" => __('button link', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Introduction Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the Introduction section.', 'flatbox'),
	"id" => "Introduction_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Introduction Background Color','flatbox'),
	"desc" => __('Select the background color of Introduction section.', 'flatbox'),
	"id" => "Introduction_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Revolution Slider Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Revolution Slider ID', 'flatbox'),
	"desc" => __('The id that will be used for embedding the slider. Example: 1. if the slider didnt appear, open slider settings and set jQuery no conflict mode to off, and put include js to body to true.','flatbox'),
	"id" => "revolution_slider_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Layer Slider Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Layer Slider ID', 'flatbox'),
	"desc" => __('The id that will be used for embedding the slider. Example: 3.', 'flatbox'),
	"id" => "layer_slider_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('Call us Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Call-To-Action Title', 'flatbox'),
	"desc" => __('Set the title of the Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "call_to_action_title",
	"std" => __('Hello, we are flatbox! Need more support or a free quote?', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Text', 'flatbox'),
	"desc" => __('Set the text of the Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "call_to_action_text",
	"std" => __('Call Us (+1) 234 567 89 tellus curcus commondo, please contact us for everything you need.', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Button Text', 'flatbox'),
	"desc" => __('Set the text of the button in Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "call_to_action_button_text",
	"std" => __('Get in touch with us', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Button URL', 'flatbox'),
	"desc" => __('Set the URL of the button in Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "call_to_action_button_url",
	"std" => __('mailto:name@yourdomain.com?subject=flatbox%20is%20great%21', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('call Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "call_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('call Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "call_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "call_bg_paralax",
	"std" => 0,
	"type" => "switch"
);



$of_options[] = array(
	"name" => __('Features Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Features Columns', 'flatbox'),
	"desc" => __('Sets the columns used for the Features section. Please introduce 1, 2, 3, 4, 6 slides for the columns to be well balanced.<br> Images Must be larger than 100*100 !', 'flatbox'),
	"id" => "features_slider",
	"std" => "",
	"type" => "slider"
);

//		Video ::::::::::::::::::::

$of_options[] = array(
	"name" => __('Video Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);
$of_options[] = array(
	"name" => __('Video Title', 'flatbox'),
	"desc" => __('Set the title of the Video section (used if enabled).', 'flatbox'),
	"id" => "Video_title",
	"std" => __('This is an amazing video block !', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Video tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "video_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Video logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Video section.', 'flatbox'),
	"id" => "video_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Video Embed', 'flatbox'),
	"desc" => __('Paste the embed code that will be used in the Video Player section of the homepage.', 'flatbox'),
	"id" => "video_embed",
	"std" => "",
	"type" => "textarea"
);


$of_options[] = array(
	"name" => __('video Title Color','flatbox'),
	"desc" => __('Select the title color of video section.', 'flatbox'),
	"id" => "video_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('video tagline Color','flatbox'),
	"desc" => __('Select the tagline color of video section.', 'flatbox'),
	"id" => "video_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Video Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "Video_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Video Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "Video_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "video_bg_paralax",
	"std" => 0,
	"type" => "switch"
);

//		General ::::::::::::::::::::

$of_options[] = array(
	"name" => __('General Text Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('General Title', 'flatbox'),
	"desc" => __('Set the title of the General section (used if enabled).', 'flatbox'),
	"id" => "General_title",
	"std" => __('Hello, we are FlatBox!', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General Text', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the General Text homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "homepage_general_text",
	"std" => "",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('General link', 'flatbox'),
	"desc" => __('Set the link of the General section (used if enabled).', 'flatbox'),
	"id" => "General_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General Image', 'flatbox'),
	"desc" => __('Upload an image to be used in the General section of the homepage.', 'flatbox'),
	"id" => "General_image",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('General Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the General section.', 'flatbox'),
	"id" => "general_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('General Background Color','flatbox'),
	"desc" => __('Select the background color of General section.', 'flatbox'),
	"id" => "general_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General Title Color','flatbox'),
	"desc" => __('Select the Title color of General section.', 'flatbox'),
	"id" => "general_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General Text Color','flatbox'),
	"desc" => __('Select the Text color of General section.', 'flatbox'),
	"id" => "general_text_color",
	"std" => '',
	"type" => "color"
);


//		General 2 ::::::::::::::::::::

$of_options[] = array(
	"name" => __('General 2 Text Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('General 2 Title', 'flatbox'),
	"desc" => __('Set the title of the General 2 section (used if enabled).', 'flatbox'),
	"id" => "General2_title",
	"std" => __('Hello, we are FlatBox!', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General 2 Text', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the General Text homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "homepage_general2_text",
	"std" => "",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('General 2 link', 'flatbox'),
	"desc" => __('Set the link of the General section (used if enabled).', 'flatbox'),
	"id" => "General2_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General 2 Image', 'flatbox'),
	"desc" => __('Upload an image to be used in the General section of the homepage.', 'flatbox'),
	"id" => "General2_image",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('General 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the General section.', 'flatbox'),
	"id" => "general2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('General 2 Background Color','flatbox'),
	"desc" => __('Select the background color of General section.', 'flatbox'),
	"id" => "general2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General 2 Title Color','flatbox'),
	"desc" => __('Select the Title color of General section.', 'flatbox'),
	"id" => "general2_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General 2 Text Color','flatbox'),
	"desc" => __('Select the Text color of General section.', 'flatbox'),
	"id" => "general2_text_color",
	"std" => '',
	"type" => "color"
);

//		testimonials ::::::::::::::::::::
$of_options[] = array(
	"name" => __('Testimonials Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('testimonials Image', 'flatbox'),
	"desc" => __('Upload an image to be the background of the testimonials section of the homepage.', 'flatbox'),
	"id" => "testimonials_image",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('testimonials Color', 'flatbox'),
	"desc" => __('Enable Light or dark version of testimonials.', 'flatbox'),
	"id" => "testimonials_light",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('testimonials text Color','flatbox'),
	"desc" => __('Select the text color of testimonials section.', 'flatbox'),
	"id" => "testimonials_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Clients Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Clients Title', 'flatbox'),
	"desc" => __('Set the title of the Clients section (used if enabled).', 'flatbox'),
	"id" => "clients_title",
	"std" => __('Our Clients', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Clients Description', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the Clients homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "clients_info",
	"std" => __('Please set your description regarding your clients.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Clients List', 'flatbox'),
	"desc" => __('Manage slides that will be use in the homepage Clients section. You can use drag and drop to sort the slides.', 'flatbox'),
	"id" => "clients_slider",
	"std" => "",
	"type" => "slider"
);

$of_options[] = array(
	"name" => __('clients Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "clients_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('clients Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "clients_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('clients text Color','flatbox'),
	"desc" => __('Select the text color of clients section.', 'flatbox'),
	"id" => "clients_text_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "clients_bg_paralax",
	"std" => 0,
	"type" => "switch"
);


$of_options[] = array(
	"name" => __('Work Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);
$of_options[] = array(
	"name" => __('Work Title', 'flatbox'),
	"desc" => __('Set the Title of the Work section.', 'flatbox'),
	"id" => "work_title",
	"std" => __('LATEST PROJECTS | ', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Work More link text', 'flatbox'),
	"desc" => __('Set the More link of the Work section.', 'flatbox'),
	"id" => "work_more_text",
	"std" => __('View All Projects »', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Work Description', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the Work homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "our_work_info",
	"std" => __('Please set your description regarding your work.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Work link', 'flatbox'),
	"desc" => __('Set the link of the Work section.', 'flatbox'),
	"id" => "work_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('work Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "work_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('work Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "work_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work Title Color','flatbox'),
	"desc" => __('Select the title color of work section.', 'flatbox'),
	"id" => "work_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work More link Color','flatbox'),
	"desc" => __('Select the More link color of work section.', 'flatbox'),
	"id" => "work_more_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work tagline Color','flatbox'),
	"desc" => __('Select the tagline color of work section.', 'flatbox'),
	"id" => "work_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "work_bg_paralax",
	"std" => 0,
	"type" => "switch"
);


$of_options[] = array(
	"name" => __('Twitter Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Twitter ID', 'flatbox'),
	"desc" => __('<strong> HOW TO CREATE A VALID ID TO USE: </strong>
		<br>
      * Go to www.twitter.com and sign in as normal, go to your settings page.
		<br>
      * Go to "Widgets" on the left hand side.
		<br>
      * Create a new widget for what you need eg "user timeline" or "search" etc. 
		<br>
      * Feel free to check "exclude replies" if you dont want replies in results.
		<br>
      * Now go back to settings page, and then go back to widgets page, you should
		<br>
      * see the widget you just created. Click edit.
		<br>
      * Now look at the URL in your web browser, you will see a long number like this:
		<br>
      * 437068535550840832
		<br>
      * Write this id here!
      ', 'flatbox'),
	"id" => "twitter_id",
	"std" => __('437068535550840832', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('Points Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Points Title', 'flatbox'),
	"desc" => __('Set the title of the Points section.', 'flatbox'),
	"id" => "toggles_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Points Main Image', 'flatbox'),
	"desc" => __('Upload an image to be used as main image for this section.', 'flatbox'),
	"id" => "points_main",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Points Links', 'flatbox'),
	"desc" => __('Manage Points that will be used in the homepage.', 'flatbox'),
	"id" => "the_toggles",
	"std" => "",
	"type" => "slider"
);

$of_options[] = array(
	"name" => __('Point title Color','flatbox'),
	"desc" => __('Select the point title color .', 'flatbox'),
	"id" => "point_list_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Point text Color','flatbox'),
	"desc" => __('Select the point text color .', 'flatbox'),
	"id" => "point_list_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Points Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to this section.', 'flatbox'),
	"id" => "toggles_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Points Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "toggles_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points Title Color','flatbox'),
	"desc" => __('Select the Title color of this section.', 'flatbox'),
	"id" => "toggles_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points 2 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Points 2 Title', 'flatbox'),
	"desc" => __('Set the title of the Points 2 section.', 'flatbox'),
	"id" => "toggles2_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Points 2 Main Image', 'flatbox'),
	"desc" => __('Upload an image to be used as main 2 image for this section.', 'flatbox'),
	"id" => "points2_main",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Points 2 Links', 'flatbox'),
	"desc" => __('Manage Points 2 that will be used in the homepage.', 'flatbox'),
	"id" => "the_toggles2",
	"std" => "",
	"type" => "slider"
);


$of_options[] = array(
	"name" => __('Point 2 title Color','flatbox'),
	"desc" => __('Select the point title color .', 'flatbox'),
	"id" => "point2_list_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Point 2 text Color','flatbox'),
	"desc" => __('Select the point text color .', 'flatbox'),
	"id" => "point2_list_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Points 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to this section.', 'flatbox'),
	"id" => "toggles2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Points 2 Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "toggles2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points 2 Title Color','flatbox'),
	"desc" => __('Select the Title color of this section.', 'flatbox'),
	"id" => "toggles2_title_color",
	"std" => '',
	"type" => "color"
);



$of_options[] = array(
	"name" => __('Blog','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Blog Title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "blog_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "blog_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Blog section.', 'flatbox'),
	"id" => "blog_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Blog Post count', 'flatbox'),
	"desc" => __('Set the number of the posts.', 'flatbox'),
	"id" => "blog_post_count",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Blog section.', 'flatbox'),
	"id" => "blog_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Blog Background Color','flatbox'),
	"desc" => __('Select the background color of Blog section.', 'flatbox'),
	"id" => "blog_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Blog Title Color','flatbox'),
	"desc" => __('Select the title color of Blog section.', 'flatbox'),
	"id" => "blog_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Blog tagline Color','flatbox'),
	"desc" => __('Select the tagline color of Blog section.', 'flatbox'),
	"id" => "blog_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "blog_bg_paralax",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Progress Bar','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sep1",
	"std" => '',
	"type" => "separator"
);



$of_options[] = array(
	"name" => __('Progress logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Progress section.', 'flatbox'),
	"id" => "progress_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Progress title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "progress_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "progress_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress Bar', 'flatbox'),
	"desc" => __('Manage progress bars that will be use in progress bar section. You can use drag and drop to sort the progress bars.', 'flatbox'),
	"id" => "homepage_progress",
	"std" => "",
	"type" => "progress"
);

$of_options[] = array(
	"name" => __('Progress Bar Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Progress bar section.', 'flatbox'),
	"id" => "progress1_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Progress Background Color','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "progress1_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress Title Color','flatbox'),
	"desc" => __('Select the title color of progress section.', 'flatbox'),
	"id" => "progress_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress tagline Color','flatbox'),
	"desc" => __('Select the tagline color of progress section.', 'flatbox'),
	"id" => "progress_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "progress_bg_paralax",
	"std" => 0,
	"type" => "switch"
);






//===========================================================
// Prgress 2
$of_options[] = array(
	"name" => __('Progress circle','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Progress logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Progress section.', 'flatbox'),
	"id" => "progress2_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Progress title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "progress2_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress 2 tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "progress2_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress Bar 2', 'flatbox'),
	"desc" => __('Manage progress bars that will be use in progress bar section. You can use drag and drop to sort the progress bars.', 'flatbox'),
	"id" => "homepage_progress2",
	"std" => "",
	"type" => "progress"
);
$of_options[] = array(
	"name" => __('Progress Bar Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Progress bar section.', 'flatbox'),
	"id" => "progress2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Progress Background Color','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "progress2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress Title Color','flatbox'),
	"desc" => __('Select the title color of progress section.', 'flatbox'),
	"id" => "progress2_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress tagline Color','flatbox'),
	"desc" => __('Select the tagline color of progress section.', 'flatbox'),
	"id" => "progress2_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "progress2_bg_paralax",
	"std" => 0,
	"type" => "switch"
);



$of_options[] = array(
	"name" => __('Showcase','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Showcase logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Showcase section.', 'flatbox'),
	"id" => "showcase_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Showcase Text', 'flatbox'),
	"desc" => __('Input text to be placed in the showcase section.', 'flatbox'),
	"id" => "showcase_text",
	"std" => __('Welcome to FlatBox', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Showcase Image', 'flatbox'),
	"desc" => __('Upload an image to be used in to the Showcase section.', 'flatbox'),
	"id" => "showcase_image",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Showcase Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Showcase section.', 'flatbox'),
	"id" => "showcase_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Showcase Background Color','flatbox'),
	"desc" => __('Select the background color of Showcase section.', 'flatbox'),
	"id" => "showcase_color",
	"std" => '',
	"type" => "color"
);
$of_options[] = array(
	"name" => __('Showcase Text Color','flatbox'),
	"desc" => __('Select the text color of Showcase section.', 'flatbox'),
	"id" => "showcase_text_color",
	"std" => '',
	"type" => "color"
);



//	HTML 1
$of_options[] = array(
	"name" => __('HTML 1 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 1 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "html1_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 1 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 1 section.', 'flatbox'),
	"id" => "html1_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 1 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "html1_color",
	"std" => '',
	"type" => "color"
);

//	HTML 2
$of_options[] = array(
	"name" => __('HTML 2 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 2 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "html2_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 2 section.', 'flatbox'),
	"id" => "html2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 1 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "html2_color",
	"std" => '',
	"type" => "color"
);

//	HTML 3
$of_options[] = array(
	"name" => __('HTML 3 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 3 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "html3_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 3 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 3 section.', 'flatbox'),
	"id" => "html3_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 3 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "html3_color",
	"std" => '',
	"type" => "color"
);

//	HTML 4
$of_options[] = array(
	"name" => __('HTML 4 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 4 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "html4_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 4 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 4 section.', 'flatbox'),
	"id" => "html4_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 4 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "html4_color",
	"std" => '',
	"type" => "color"
);


























// Home 2
$of_options[] = array(
	"name" => __('Home Page 2', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Homepage Layout Manager', 'flatbox'),
	"desc" => __('Organize what sections of the layout you want to appear on the homepage and their order. Use drag and drop to manage them.', 'flatbox'),
	"id" => "home2_homepage_blocks2",
	"std" => $homepage_blocks,
	"type" => "sorter"
);

$of_options[] = array(
	"name" => __('Introduction Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('Homepage Introduction Text Header', 'flatbox'),
	"desc" => __('Introduce the heading text used for the Introduction Text section.', 'flatbox'),
	"id" => "home2_homepage_intro_header",
	"std" => __('Flat design just blows my mind', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Paragraph', 'flatbox'),
	"desc" => __('Introduce the paragraph text used for the Introduction Text section.', 'flatbox'),
	"id" => "home2_homepage_intro_text",
	"std" => __('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor aenean massaret. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus pellentesque eu pretium quis sem.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button Text', 'flatbox'),
	"desc" => __('Input the Button text.', 'flatbox'),
	"id" => "home2_homepage_intro_link_text",
	"std" => __('Click Here', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button link', 'flatbox'),
	"desc" => __('Input button link(starting with http://).', 'flatbox'),
	"id" => "home2_homepage_intro_link",
	"std" => __('button link', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button 2 Text', 'flatbox'),
	"desc" => __('Input the Button 2 text.', 'flatbox'),
	"id" => "home2_homepage_intro_link_text2",
	"std" => __('Click Here', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Homepage Introduction Button 2 link', 'flatbox'),
	"desc" => __('Input button 2 link(starting with http://).', 'flatbox'),
	"id" => "home2_homepage_intro_link2",
	"std" => __('button link', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Introduction Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the Introduction section.', 'flatbox'),
	"id" => "home2_Introduction_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Introduction Background Color','flatbox'),
	"desc" => __('Select the background color of Introduction section.', 'flatbox'),
	"id" => "home2_Introduction_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Revolution Slider Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Revolution Slider Alias', 'flatbox'),
	"desc" => __('The alias that will be used for embedding the slider. Example: slider1.', 'flatbox'),
	"id" => "home2_revolution_slider_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Layer Slider Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Layer Slider ID', 'flatbox'),
	"desc" => __('The id that will be used for embedding the slider. Example: 3.', 'flatbox'),
	"id" => "home2_layer_slider_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

// $of_options[] = array(
// 	"name" => __('Homepage Slider Images', 'flatbox'),
// 	"desc" => __('Manage slides that will be use in Simple Flexslider, Detailed Flexslider and RoundAbout Slider. You can use drag and drop to sort the slides.', 'flatbox'),
// 	"id" => "home2_homepage_slider",
// 	"std" => "",
// 	"type" => "new_slider"
// );

// $of_options[] = array(
// 	"name" => __('Resize Homepage Slider Images', 'flatbox'),
// 	"desc" => __('Resizes and optimizes images to a fixed 940x480 standard. If this option is turned off then original unmodified images will be used.', 'flatbox'),
// 	"id" => "home2_homepage_slider_resize",
// 	"std" => 0,
// 	"type" => "switch"
// );

$of_options[] = array(
	"name" => __('Call us Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Call-To-Action Title', 'flatbox'),
	"desc" => __('Set the title of the Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "home2_call_to_action_title",
	"std" => __('Hello, we are flatbox! Need more support or a free quote?', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Text', 'flatbox'),
	"desc" => __('Set the text of the Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "home2_call_to_action_text",
	"std" => __('Call Us (+1) 234 567 89 tellus curcus commondo, please contact us for everything you need.', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Button Text', 'flatbox'),
	"desc" => __('Set the text of the button in Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "home2_call_to_action_button_text",
	"std" => __('Get in touch with us', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Call-To-Action Button URL', 'flatbox'),
	"desc" => __('Set the URL of the button in Call-To-Action section (used if enabled).', 'flatbox'),
	"id" => "home2_call_to_action_button_url",
	"std" => __('mailto:name@yourdomain.com?subject=flatbox%20is%20great%21', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('call Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "home2_call_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('call Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_call_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_call_bg_paralax",
	"std" => 0,
	"type" => "switch"
);



$of_options[] = array(
	"name" => __('Features Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Features Columns', 'flatbox'),
	"desc" => __('Sets the columns used for the Features section. Please introduce 1, 2, 3, 4, 6 slides for the columns to be well balanced.<br> Images Must be larger than 100*100 !', 'flatbox'),
	"id" => "home2_features_slider",
	"std" => "",
	"type" => "slider"
);

// $of_options[] = array(
// 	"name" => __('Panorama Options','flatbox'),
// 	"desc" => __('Select the background color of progress section.', 'flatbox'),
// 	"id" => "home2_sadasd",
// 	"std" => '',
// 	"type" => "separator"
// );

// $of_options[] = array(
// 	"name" => __('Panorama 360&deg; Image', 'flatbox'),
// 	"desc" => __('Upload a panoroma image to be used in the Panorama 360&deg; section of the homepage.', 'flatbox'),
// 	"id" => "home2_panorama_image",
// 	"type" => "media"
// );

//		Video ::::::::::::::::::::

$of_options[] = array(
	"name" => __('Video Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);
$of_options[] = array(
	"name" => __('Video Title', 'flatbox'),
	"desc" => __('Set the title of the Video section (used if enabled).', 'flatbox'),
	"id" => "home2_Video_title",
	"std" => __('This is an amazing video block !', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Video tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "home2_video_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Video logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Video section.', 'flatbox'),
	"id" => "home2_video_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Video Embed', 'flatbox'),
	"desc" => __('Paste the embed code that will be used in the Video Player section of the homepage.', 'flatbox'),
	"id" => "home2_video_embed",
	"std" => "",
	"type" => "textarea"
);


$of_options[] = array(
	"name" => __('video Title Color','flatbox'),
	"desc" => __('Select the title color of video section.', 'flatbox'),
	"id" => "home2_video_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('video tagline Color','flatbox'),
	"desc" => __('Select the tagline color of video section.', 'flatbox'),
	"id" => "home2_video_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Video Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "home2_Video_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Video Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_Video_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_video_bg_paralax",
	"std" => 0,
	"type" => "switch"
);

//		General ::::::::::::::::::::

$of_options[] = array(
	"name" => __('General Text Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('General Title', 'flatbox'),
	"desc" => __('Set the title of the General section (used if enabled).', 'flatbox'),
	"id" => "home2_General_title",
	"std" => __('Hello, we are FlatBox!', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General Text', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the General Text homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "home2_homepage_general_text",
	"std" => "",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('General link', 'flatbox'),
	"desc" => __('Set the link of the General section (used if enabled).', 'flatbox'),
	"id" => "home2_General_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General Image', 'flatbox'),
	"desc" => __('Upload an image to be used in the General section of the homepage.', 'flatbox'),
	"id" => "home2_General_image",
	"type" => "media"
);
// $of_options[] = array(
// 	"name" => __('General Image 2', 'flatbox'),
// 	"desc" => __('Upload an extra image to be used in the General section of the homepage.', 'flatbox'),
// 	"id" => "home2_General_image2",
// 	"type" => "media"
// );

$of_options[] = array(
	"name" => __('General Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the General section.', 'flatbox'),
	"id" => "home2_general_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('General Background Color','flatbox'),
	"desc" => __('Select the background color of General section.', 'flatbox'),
	"id" => "home2_general_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General Title Color','flatbox'),
	"desc" => __('Select the Title color of General section.', 'flatbox'),
	"id" => "home2_general_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General Text Color','flatbox'),
	"desc" => __('Select the Text color of General section.', 'flatbox'),
	"id" => "home2_general_text_color",
	"std" => '',
	"type" => "color"
);


//		General 2 ::::::::::::::::::::

$of_options[] = array(
	"name" => __('General 2 Text Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('General 2 Title', 'flatbox'),
	"desc" => __('Set the title of the General 2 section (used if enabled).', 'flatbox'),
	"id" => "home2_General2_title",
	"std" => __('Hello, we are FlatBox!', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General 2 Text', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the General Text homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "home2_homepage_general2_text",
	"std" => "",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('General 2 link', 'flatbox'),
	"desc" => __('Set the link of the General section (used if enabled).', 'flatbox'),
	"id" => "home2_General2_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('General 2 Image', 'flatbox'),
	"desc" => __('Upload an image to be used in the General section of the homepage.', 'flatbox'),
	"id" => "home2_General2_image",
	"type" => "media"
);
// $of_options[] = array(
// 	"name" => __('General 2 Image 2', 'flatbox'),
// 	"desc" => __('Upload an extra image to be used in the General section of the homepage.', 'flatbox'),
// 	"id" => "home2_General2_image2",
// 	"type" => "media"
// );

$of_options[] = array(
	"name" => __('General 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the General section.', 'flatbox'),
	"id" => "home2_general2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('General 2 Background Color','flatbox'),
	"desc" => __('Select the background color of General section.', 'flatbox'),
	"id" => "home2_general2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General 2 Title Color','flatbox'),
	"desc" => __('Select the Title color of General section.', 'flatbox'),
	"id" => "home2_general2_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('General 2 Text Color','flatbox'),
	"desc" => __('Select the Text color of General section.', 'flatbox'),
	"id" => "home2_general2_text_color",
	"std" => '',
	"type" => "color"
);

//		testimonials ::::::::::::::::::::
$of_options[] = array(
	"name" => __('Testimonials Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('testimonials Image', 'flatbox'),
	"desc" => __('Upload an image to be the background of the testimonials section of the homepage.', 'flatbox'),
	"id" => "home2_testimonials_image",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('testimonials Color', 'flatbox'),
	"desc" => __('Enable Light or dark version of testimonials.', 'flatbox'),
	"id" => "home2_testimonials_light",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('testimonials text Color','flatbox'),
	"desc" => __('Select the text color of testimonials section.', 'flatbox'),
	"id" => "home2_testimonials_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Clients Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Clients Title', 'flatbox'),
	"desc" => __('Set the title of the Clients section (used if enabled).', 'flatbox'),
	"id" => "home2_clients_title",
	"std" => __('Our Clients', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Clients Description', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the Clients homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "home2_clients_info",
	"std" => __('Please set your description regarding your clients.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Clients List', 'flatbox'),
	"desc" => __('Manage slides that will be use in the homepage Clients section. You can use drag and drop to sort the slides.', 'flatbox'),
	"id" => "home2_clients_slider",
	"std" => "",
	"type" => "slider"
);

$of_options[] = array(
	"name" => __('clients Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "home2_clients_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('clients Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_clients_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('clients text Color','flatbox'),
	"desc" => __('Select the text color of clients section.', 'flatbox'),
	"id" => "home2_clients_text_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_clients_bg_paralax",
	"std" => 0,
	"type" => "switch"
);


$of_options[] = array(
	"name" => __('Work Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);
$of_options[] = array(
	"name" => __('Work Title', 'flatbox'),
	"desc" => __('Set the Title of the Work section.', 'flatbox'),
	"id" => "home2_work_title",
	"std" => __('LATEST PROJECTS | ', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Work More link text', 'flatbox'),
	"desc" => __('Set the More link of the Work section.', 'flatbox'),
	"id" => "home2_work_more_text",
	"std" => __('View All Projects »', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Work Description', 'flatbox'),
	"desc" => __('Set the text that will be displayed in the Work homepage section (can use shortcodes here).', 'flatbox'),
	"id" => "home2_our_work_info",
	"std" => __('Please set your description regarding your work.', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Work link', 'flatbox'),
	"desc" => __('Set the link of the Work section.', 'flatbox'),
	"id" => "home2_work_link",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('work Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to this section.', 'flatbox'),
	"id" => "home2_work_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('work Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_work_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work Title Color','flatbox'),
	"desc" => __('Select the title color of work section.', 'flatbox'),
	"id" => "home2_work_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work More link Color','flatbox'),
	"desc" => __('Select the More link color of work section.', 'flatbox'),
	"id" => "home2_work_more_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('work tagline Color','flatbox'),
	"desc" => __('Select the tagline color of work section.', 'flatbox'),
	"id" => "home2_work_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_work_bg_paralax",
	"std" => 0,
	"type" => "switch"
);


$of_options[] = array(
	"name" => __('Twitter Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Twitter ID', 'flatbox'),
	"desc" => __('<strong> HOW TO CREATE A VALID ID TO USE: </strong>
		<br>
      * Go to www.twitter.com and sign in as normal, go to your settings page.
		<br>
      * Go to "Widgets" on the left hand side.
		<br>
      * Create a new widget for what you need eg "user timeline" or "search" etc. 
		<br>
      * Feel free to check "exclude replies" if you dont want replies in results.
		<br>
      * Now go back to settings page, and then go back to widgets page, you should
		<br>
      * see the widget you just created. Click edit.
		<br>
      * Now look at the URL in your web browser, you will see a long number like this:
		<br>
      * 377205624066433024
		<br>
      * Write this id here!
      ', 'flatbox'),
	"id" => "home2_twitter_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('Points Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Points Title', 'flatbox'),
	"desc" => __('Set the title of the Points section.', 'flatbox'),
	"id" => "home2_toggles_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Points Main Image', 'flatbox'),
	"desc" => __('Upload an image to be used as main image for this section.', 'flatbox'),
	"id" => "home2_points_main",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Points Links', 'flatbox'),
	"desc" => __('Manage Points that will be used in the homepage.', 'flatbox'),
	"id" => "home2_the_toggles",
	"std" => "",
	"type" => "slider"
);

$of_options[] = array(
	"name" => __('Point title Color','flatbox'),
	"desc" => __('Select the point title color .', 'flatbox'),
	"id" => "home2_point_list_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Point text Color','flatbox'),
	"desc" => __('Select the point text color .', 'flatbox'),
	"id" => "home2_point_list_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Points Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to this section.', 'flatbox'),
	"id" => "home2_toggles_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Points Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_toggles_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points Title Color','flatbox'),
	"desc" => __('Select the Title color of this section.', 'flatbox'),
	"id" => "home2_toggles_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points 2 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Points 2 Title', 'flatbox'),
	"desc" => __('Set the title of the Points 2 section.', 'flatbox'),
	"id" => "home2_toggles2_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Points 2 Main Image', 'flatbox'),
	"desc" => __('Upload an image to be used as main 2 image for this section.', 'flatbox'),
	"id" => "home2_points2_main",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Points 2 Links', 'flatbox'),
	"desc" => __('Manage Points 2 that will be used in the homepage.', 'flatbox'),
	"id" => "home2_the_toggles2",
	"std" => "",
	"type" => "slider"
);


$of_options[] = array(
	"name" => __('Point 2 title Color','flatbox'),
	"desc" => __('Select the point title color .', 'flatbox'),
	"id" => "home2_point2_list_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Point 2 text Color','flatbox'),
	"desc" => __('Select the point text color .', 'flatbox'),
	"id" => "home2_point2_list_text_color",
	"std" => '',
	"type" => "color"
);


$of_options[] = array(
	"name" => __('Points 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to this section.', 'flatbox'),
	"id" => "home2_toggles2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Points 2 Background Color','flatbox'),
	"desc" => __('Select the background color of this section.', 'flatbox'),
	"id" => "home2_toggles2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Points 2 Title Color','flatbox'),
	"desc" => __('Select the Title color of this section.', 'flatbox'),
	"id" => "home2_toggles2_title_color",
	"std" => '',
	"type" => "color"
);



$of_options[] = array(
	"name" => __('Blog','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Blog Title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "home2_blog_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "home2_blog_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Blog section.', 'flatbox'),
	"id" => "home2_blog_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Blog Post count', 'flatbox'),
	"desc" => __('Set the number of the posts.', 'flatbox'),
	"id" => "home2_blog_post_count",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blog Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Blog section.', 'flatbox'),
	"id" => "home2_blog_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Blog Background Color','flatbox'),
	"desc" => __('Select the background color of Blog section.', 'flatbox'),
	"id" => "home2_blog_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Blog Title Color','flatbox'),
	"desc" => __('Select the title color of Blog section.', 'flatbox'),
	"id" => "home2_blog_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Blog tagline Color','flatbox'),
	"desc" => __('Select the tagline color of Blog section.', 'flatbox'),
	"id" => "home2_blog_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_blog_bg_paralax",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Progress Bar','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sep1",
	"std" => '',
	"type" => "separator"
);



$of_options[] = array(
	"name" => __('Progress logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Progress section.', 'flatbox'),
	"id" => "home2_progress_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Progress title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "home2_progress_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "home2_progress_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress Bar', 'flatbox'),
	"desc" => __('Manage progress bars that will be use in progress bar section. You can use drag and drop to sort the progress bars.', 'flatbox'),
	"id" => "home2_homepage_progress",
	"std" => "",
	"type" => "progress"
);

$of_options[] = array(
	"name" => __('Progress Bar Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Progress bar section.', 'flatbox'),
	"id" => "home2_progress1_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Progress Background Color','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_progress1_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress Title Color','flatbox'),
	"desc" => __('Select the title color of progress section.', 'flatbox'),
	"id" => "home2_progress_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress tagline Color','flatbox'),
	"desc" => __('Select the tagline color of progress section.', 'flatbox'),
	"id" => "home2_progress_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_progress_bg_paralax",
	"std" => 0,
	"type" => "switch"
);






//===========================================================
// Prgress 2
$of_options[] = array(
	"name" => __('Progress circle','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Progress logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Progress section.', 'flatbox'),
	"id" => "home2_progress2_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Progress title', 'flatbox'),
	"desc" => __('Set the section title.', 'flatbox'),
	"id" => "home2_progress2_title",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress 2 tagline', 'flatbox'),
	"desc" => __('Set the section text.', 'flatbox'),
	"id" => "home2_progress2_text",
	"std" => __('', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Progress Bar 2', 'flatbox'),
	"desc" => __('Manage progress bars that will be use in progress bar section. You can use drag and drop to sort the progress bars.', 'flatbox'),
	"id" => "home2_homepage_progress2",
	"std" => "",
	"type" => "progress"
);
$of_options[] = array(
	"name" => __('Progress Bar Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Progress bar section.', 'flatbox'),
	"id" => "home2_progress2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Progress Background Color','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_progress2_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress Title Color','flatbox'),
	"desc" => __('Select the title color of progress section.', 'flatbox'),
	"id" => "home2_progress2_title_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('progress tagline Color','flatbox'),
	"desc" => __('Select the tagline color of progress section.', 'flatbox'),
	"id" => "home2_progress2_tagline_color",
	"std" => '',
	"type" => "color"
);

$of_options[] = array(
	"name" => __('Paralax Background', 'flatbox'),
	"desc" => __('Enable & Disable the Paralax option of the background image.', 'flatbox'),
	"id" => "home2_progress2_bg_paralax",
	"std" => 0,
	"type" => "switch"
);



$of_options[] = array(
	"name" => __('Showcase','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sep1",
	"std" => '',
	"type" => "separator"
);

$of_options[] = array(
	"name" => __('Showcase logo Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a logo to the Showcase section.', 'flatbox'),
	"id" => "home2_showcase_logo",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Showcase Text', 'flatbox'),
	"desc" => __('Input text to be placed in the showcase section.', 'flatbox'),
	"id" => "home2_showcase_text",
	"std" => __('Welcome to FlatBox', 'flatbox'),
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Showcase Image', 'flatbox'),
	"desc" => __('Upload an image to be used in to the Showcase section.', 'flatbox'),
	"id" => "home2_showcase_image",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Showcase Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used as a background to the Showcase section.', 'flatbox'),
	"id" => "home2_showcase_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('Showcase Background Color','flatbox'),
	"desc" => __('Select the background color of Showcase section.', 'flatbox'),
	"id" => "home2_showcase_color",
	"std" => '',
	"type" => "color"
);
$of_options[] = array(
	"name" => __('Showcase Text Color','flatbox'),
	"desc" => __('Select the text color of Showcase section.', 'flatbox'),
	"id" => "home2_showcase_text_color",
	"std" => '',
	"type" => "color"
);



//	HTML 1
$of_options[] = array(
	"name" => __('HTML 1 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 1 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "home2_html1_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 1 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 1 section.', 'flatbox'),
	"id" => "home2_html1_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 1 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "home2_html1_color",
	"std" => '',
	"type" => "color"
);

//	HTML 2
$of_options[] = array(
	"name" => __('HTML 2 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 2 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "home2_html2_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 2 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 2 section.', 'flatbox'),
	"id" => "home2_html2_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 1 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "home2_html2_color",
	"std" => '',
	"type" => "color"
);

//	HTML 3
$of_options[] = array(
	"name" => __('HTML 3 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 3 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "home2_html3_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 3 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 3 section.', 'flatbox'),
	"id" => "home2_html3_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 3 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "home2_html3_color",
	"std" => '',
	"type" => "color"
);

//	HTML 4
$of_options[] = array(
	"name" => __('HTML 4 Options','flatbox'),
	"desc" => __('Select the background color of progress section.', 'flatbox'),
	"id" => "home2_sadasd",
	"std" => '',
	"type" => "separator"
);


$of_options[] = array(
	"name" => __('HTML 4 Text', 'flatbox'),
	"desc" => __('HTML  text used inside the section.', 'flatbox'),
	"id" => "home2_html4_text",
	"std" => __('', 'flatbox'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('HTML 4 Background Image', 'flatbox'),
	"desc" => __('Upload an image to be used au a background to the HTML 4 section.', 'flatbox'),
	"id" => "home2_html4_bg",
	"type" => "media"
);
$of_options[] = array(
	"name" => __('HTML 4 Background Color','flatbox'),
	"desc" => __('Select the background color of HTML  section.', 'flatbox'),
	"id" => "home2_html4_color",
	"std" => '',
	"type" => "color"
);




































// Portfolio Settings
$of_options[] = array(
	"name" => __('Portfolio Page', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Portfolio Column Layout', 'flatbox'),
	"desc" => __('Select the column size on the portfolio page.', 'flatbox'),
	"id" => "portfolio_grid_no",
	"std" => $portfolio_layouts_keys[0],
	"type" => "images",
	"options" => $portfolio_layouts,
);

$of_options[] = array(
	"name" => __('Position of details in Portfolio Gallery', 'flatbox'),
	"desc" => __('Show details below the image in the portfolio isotope gallery.', 'flatbox'),
	"id" => "portfolio_details_outside",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Enable Infinite Scroll in Portfolio Gallery', 'flatbox'),
	"desc" => __('Enable automatic load of new posts when the end of the portfolio is reached (this will enable category filters as well) .', 'flatbox'),
	"id" => "portfolio_infinitescroll",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Portfolio Page', 'flatbox'),
	"desc" => __('Select the portfolio page used to get back to all posts (used in single item page as return address to all items).', 'flatbox'),
	"id" => "portfolio_page",
	"type" => "select2",
	"options" => $of_pages
);

$of_options[] = array(
	"name" => __('Portfolio Item Extra Information', 'flatbox'),
	"desc" => __('Introduce extra information after the text of the portfolio item. This is a good place to add widgets like sharing tools, shortcodes, etc.', 'flatbox'),
	"id" => "portfolio_item_extra",
	"std" => '',
	"type" => "textarea"
);

// Blog Settings
$of_options[] = array(
	"name" => __('Blog Page', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Blog Column Layout', 'flatbox'),
	"desc" => __('Select the column size on the Blog page.', 'flatbox'),
	"id" => "journal_grid_no",
	"std" => $portfolio_layouts_keys[0],
	"type" => "images",
	"options" => $portfolio_layouts,
);

$of_options[] = array(
	"name" => __('Position of details in Blog Gallery', 'flatbox'),
	"desc" => __('Show details below the image in the journal isotope gallery.', 'flatbox'),
	"id" => "journal_details_outside",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Enable Infinite Scroll in Blog Gallery', 'flatbox'),
	"desc" => __('Enable automatic load of new posts when the end of the Blog is reached (this will enable category filters as well) .', 'flatbox'),
	"id" => "journal_infinitescroll",
	"std" => 0,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Enable Sidebar', 'flatbox'),
	"desc" => __('Enable Sidebar at the left or right of the blog page .', 'flatbox'),
	"id" => "blog_sidebar2",
	"std" => 1,
	"type" => "switch"
);

$of_options[] = array(
	"name" => __('Blog Sidebar Layout', 'flatbox'),
	"desc" => __('Select Sidebar alignment on the Blog page.', 'flatbox'),
	"id" => "sidebar_layout",
	"std" => $sidebar_layouts_keys[0],
	"type" => "images",
	"options" => $sidebar_layouts,
);


$of_options[] = array(
	"name" => __('Blog Page', 'flatbox'),
	"desc" => __('Select the Blog page used to get back to all posts (used in single item page as return address to all items).', 'flatbox'),
	"id" => "journal_page",
	"type" => "select2",
	"options" => $of_pages
);

$of_options[] = array(
	"name" => __('Single Post Layout', 'flatbox'),
	"desc" => __('Select image and meta information alignment on the single post page.', 'flatbox'),
	"id" => "journal_layout",
	"std" => $sidebar_layouts_keys[0],
	"type" => "images",
	"options" => $sidebar_layouts,
);

$of_options[] = array(
	"name" => __('Single Post Extra Information', 'flatbox'),
	"desc" => __('Introduce extra information after the text of the post. This is a good place to add widgets like sharing tools, shortcodes, etc.', 'flatbox'),
	"id" => "single_post_extra",
	"std" => '',
	"type" => "textarea"
);

// Contact Form
$of_options[] = array(
	"name" => __('Contact Page', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Contact Email', 'flatbox'),
	"desc" => __('Introduce your email address that will receive all messages from the contact form. The email will not be displayed in the HTML source file, only used to send the email.', 'flatbox'),
	"id" => "contact_email",
	"std" => '',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Contact Email Subject', 'flatbox'),
	"desc" => __('Introduce the subject of the email you\'ll see in your inbox.', 'flatbox'),
	"id" => "contact_subject",
	"std" => 'Message received from the website contact form',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Contact GMap Embed', 'flatbox'),
	"desc" => __('Introduce a Google Maps url .', 'flatbox'),
	"id" => "contact_gmap_embed",
	"std" => '',
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Show Twitter feed', 'flatbox'),
	"desc" => __('.', 'flatbox'),
	"id" => "contact_twitter",
	"std" => 1,
	"type" => "switch"
);


$of_options[] = array(
	"name" => __('Twitter ID', 'flatbox'),
	"desc" => __('<strong> HOW TO CREATE A VALID ID TO USE: </strong>
		<br>
      * Go to www.twitter.com and sign in as normal, go to your settings page.
		<br>
      * Go to "Widgets" on the left hand side.
		<br>
      * Create a new widget for what you need eg "user timeline" or "search" etc. 
		<br>
      * Feel free to check "exclude replies" if you dont want replies in results.
		<br>
      * Now go back to settings page, and then go back to widgets page, you should
		<br>
      * see the widget you just created. Click edit.
		<br>
      * Now look at the URL in your web browser, you will see a long number like this:
		<br>
      * 377205624066433024
		<br>
      * Write this id here!
      ', 'flatbox'),
	"id" => "contact_twitter_id",
	"std" => __('', 'flatbox'),
	"type" => "text"
);


$of_options[] = array(
	"name" => __('Contact Headline', 'flatbox'),
	"desc" => __('write a headline for the contact page.', 'flatbox'),
	"id" => "contact_headline",
	"std" => '',
	"type" => "textarea"
);



$of_options[] = array(
	"name" => __('Home info', 'flatbox'),
	"desc" => __('write your home info to be used in the additional info.', 'flatbox'),
	"id" => "contact_home",
	"std" => '',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Location', 'flatbox'),
	"desc" => __('write your Location to be used in the additional info.', 'flatbox'),
	"id" => "contact_location",
	"std" => '',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Email', 'flatbox'),
	"desc" => __('write your email to be used in the additional info.', 'flatbox'),
	"id" => "contact_info_email",
	"std" => '',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Mobile Number', 'flatbox'),
	"desc" => __('write your mobile number to be used in the additional info.', 'flatbox'),
	"id" => "contact_mobile",
	"std" => '',
	"type" => "text"
);




$of_options[] = array(
	"name" => __('Phone Number', 'flatbox'),
	"desc" => __('write your Phone number to be used in the additional info.', 'flatbox'),
	"id" => "contact_phone",
	"std" => '',
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Fax Number', 'flatbox'),
	"desc" => __('write your Fax number to be used in the additional info.', 'flatbox'),
	"id" => "contact_fax",
	"std" => '',
	"type" => "text"
);







$of_options[] = array(
	"name" => __('Additional Information', 'flatbox'),
	"desc" => __('Introduce the HTML markup to be used in the Additional Info section of the contact form. Use <strong>&lt;p class="small"&gt; ... &lt;/p&gt;</strong> for small text descriptions. You can use shortcodes to add social icons, too.', 'flatbox'),
	"id" => "contact_additional_info",
	"std" => 'Brooklyn BBridge\nNew York, NY, USA',
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Contact wp-content Directory', 'flatbox'),
	"desc" => __('Introduce your wp-content directory name if different from <strong>wp-content</strong>. This will be used by the external sendmail.php script.', 'flatbox'),
	"id" => "contact_wpcontent_dir",
	"std" => 'wp-content',
	"type" => "text"
);

// Footer
$of_options[] = array(
	"name" => __('Footer Area', 'flatbox'),
	"type" => "heading"
);

$footer_social2 = array(
	"enabled" => array (
		"placebo" => "placebo", // REQUIRED!
	
	),
	"disabled" => array (
		"placebo" => "placebo", // REQUIRED!
		"facebook" => __('Facebook', 'flatbox'),
		"youtube" => __('youtube', 'flatbox'),
		"twitter" => __('twitter', 'flatbox'),
		"envato" => __('envato', 'flatbox'),
		"rss" => __('rss', 'flatbox'),
		"amazon" => __('amazon', 'flatbox'),
		"behance" => __('behance', 'flatbox'),
		"blogger" => __('blogger', 'flatbox'),
		"deviantart" => __('deviantart', 'flatbox'),
		"digg" => __('digg', 'flatbox'),
		"dribbble" => __('dribbble', 'flatbox'),
		"dropbox" => __('dropbox', 'flatbox'),
		"ebay" => __('ebay', 'flatbox'),
		"flickr" => __('flickr', 'flatbox'),
		"forrst" => __('forrst', 'flatbox'),
		"google" => __('google', 'flatbox'),
		"instagram" => __('instagram', 'flatbox'),
		"linkedin" => __('linkedin', 'flatbox'),
		"myspace" => __('myspace', 'flatbox'),
		"paypal" => __('paypal', 'flatbox'),
		"pinterest" => __('pinterest', 'flatbox'),
		"skype" => __('skype', 'flatbox'),
		"soundcloud" => __('soundcloud', 'flatbox'),
		"tumblr" => __('tumblr', 'flatbox'),
		"twitter" => __('twitter', 'flatbox'),
		"vimeo" => __('vimeo', 'flatbox'),
		"wordpress" => __('wordpress', 'flatbox'),
		"yahoo" => __('yahoo', 'flatbox'),
		

	),
);
$of_options[] = array(
	"name" => __('Footer Social Manager', 'flatbox'),
	"desc" => __('Organize Social icons in the footer section.', 'flatbox'),
	"id" => "footer_blocks2",
	"std" => $footer_social2,
	"type" => "sorter"
);

$of_options[] = array(
	"name" => __('Footer Logo', 'flatbox'),
	"desc" => __('Select a graphic logo for the footer area to be used instead of the text version. <span style="color:#d52">Recommanded size: 320x40</span>', 'flatbox'),
	"id" => "custom_footer_logo",
	"std" => '',
	"type" => "upload"
);

$of_options[] = array(
	"name" => __('Footer Text', 'flatbox'),
	"desc" => __('You can use the following shortcodes in your footer text: [wp-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'flatbox'),
	"id" => "footer_text",
	"std" => __('&copy; [the-year] [blog-title]. All Rights Reserved.', 'flatbox'),
	"type" => "textarea"
);


// Footer social links
$of_options[] = array(
	"name" => __('Facebook Profile', 'flatbox'),
	"desc" => __('Input your Facebook Profile URL.', 'flatbox'),
	"id" => "footer-facebook",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('twitter Profile', 'flatbox'),
	"desc" => __('Input your twitter Profile URL.', 'flatbox'),
	"id" => "footer-twitter",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('envato Profile', 'flatbox'),
	"desc" => __('Input your envato Profile URL.', 'flatbox'),
	"id" => "footer-envato",
	"type" => "text"
);



$of_options[] = array(
	"name" => __('youtube Profile', 'flatbox'),
	"desc" => __('Input your youtube Profile URL.', 'flatbox'),
	"id" => "footer-youtube",
	"type" => "text"
);


$of_options[] = array(
	"name" => __('rss Profile', 'flatbox'),
	"desc" => __('Input your rss Profile URL.', 'flatbox'),
	"id" => "footer-rss",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('amazon Profile', 'flatbox'),
	"desc" => __('Input your amazon Profile URL.', 'flatbox'),
	"id" => "footer-amazon",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('behance Profile', 'flatbox'),
	"desc" => __('Input your behance Profile URL.', 'flatbox'),
	"id" => "footer-behance",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('blogger Profile', 'flatbox'),
	"desc" => __('Input your blogger Profile URL.', 'flatbox'),
	"id" => "footer-blogger",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('deviantart Profile', 'flatbox'),
	"desc" => __('Input your deviantart Profile URL.', 'flatbox'),
	"id" => "footer-deviantart",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('digg Profile', 'flatbox'),
	"desc" => __('Input your digg Profile URL.', 'flatbox'),
	"id" => "footer-digg",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('dribbble Profile', 'flatbox'),
	"desc" => __('Input your dribbble Profile URL.', 'flatbox'),
	"id" => "footer-dribbble",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('dropbox Profile', 'flatbox'),
	"desc" => __('Input your dropbox Profile URL.', 'flatbox'),
	"id" => "footer-dropbox",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('ebay Profile', 'flatbox'),
	"desc" => __('Input your ebay Profile URL.', 'flatbox'),
	"id" => "footer-ebay",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('flickr Profile', 'flatbox'),
	"desc" => __('Input your flickr Profile URL.', 'flatbox'),
	"id" => "footer-flickr",
	"type" => "text"
);



$of_options[] = array(
	"name" => __('forrst Profile', 'flatbox'),
	"desc" => __('Input your forrst Profile URL.', 'flatbox'),
	"id" => "footer-forrst",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('google Profile', 'flatbox'),
	"desc" => __('Input your google Profile URL.', 'flatbox'),
	"id" => "footer-google",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('instagram Profile', 'flatbox'),
	"desc" => __('Input your instagram Profile URL.', 'flatbox'),
	"id" => "footer-instagram",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('linkedin Profile', 'flatbox'),
	"desc" => __('Input your linkedin Profile URL.', 'flatbox'),
	"id" => "footer-linkedin",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('myspace Profile', 'flatbox'),
	"desc" => __('Input your myspace Profile URL.', 'flatbox'),
	"id" => "footer-myspace",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('paypal Profile', 'flatbox'),
	"desc" => __('Input your paypal Profile URL.', 'flatbox'),
	"id" => "footer-paypal",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('pinterest Profile', 'flatbox'),
	"desc" => __('Input your pinterest Profile URL.', 'flatbox'),
	"id" => "footer-pinterest",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('skype Profile', 'flatbox'),
	"desc" => __('Input your skype Profile URL.', 'flatbox'),
	"id" => "footer-skype",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('soundcloud Profile', 'flatbox'),
	"desc" => __('Input your soundcloud Profile URL.', 'flatbox'),
	"id" => "footer-soundcloud",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('tumblr Profile', 'flatbox'),
	"desc" => __('Input your tumblr Profile URL.', 'flatbox'),
	"id" => "footer-tumblr",
	"type" => "text"
);


$of_options[] = array(
	"name" => __('vimeo Profile', 'flatbox'),
	"desc" => __('Input your vimeo Profile URL.', 'flatbox'),
	"id" => "footer-vimeo",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('wordpress Profile', 'flatbox'),
	"desc" => __('Input your wordpress Profile URL.', 'flatbox'),
	"id" => "footer-wordpress",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('yahoo Profile', 'flatbox'),
	"desc" => __('Input your yahoo Profile URL.', 'flatbox'),
	"id" => "footer-yahoo",
	"type" => "text"
);





































// Custom Posts
$of_options[] = array(
	"name" => __('Custom Posts', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Custom Post Types', 'flatbox'),
	"id" => "custom_post_types_info",
	"std" => __('Here you can change the name and slug of the custom post types - Testimonials, Gallery, Portfolio, Panorama. This can be helpful if you prefer to customize these items. After you change the name or slug, be sure to refresh you permalinks by going to Settings > Permalinks > and Save Changes.', 'flatbox'),
	"icon" => true,
	"type" => "info"
);

$of_options[] = array(
	"name" => __('Portfolio Post Type Name', 'flatbox'),
	"desc" => __('This will change the name of your Portfolio post type in the admin area.', 'flatbox'),
	"id" => "portfolio_post_type_name",
	"std" => "",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Portfolio Post Type Slug', 'flatbox'),
	"desc" => __('When you change the slug of a post type, be sure to refresh the permalink settings. Go to Settings > Permalinks and simply hit Save Changes. That will refresh your slug.', 'flatbox'),
	"id" => "portfolio_post_type_slug",
	"std" => "",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Staff Members Post Type Name', 'flatbox'),
	"desc" => __('This will change the name of your Staff Members post type in the admin area.', 'flatbox'),
	"id" => "staff_members_post_type_name",
	"std" => "",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Staff Members Post Type Slug', 'flatbox'),
	"desc" => __('When you change the slug of a post type, be sure to refresh the permalink settings. Go to Settings > Permalinks and simply hit Save Changes. That will refresh your slug.', 'flatbox'),
	"id" => "staff_members_post_type_slug",
	"std" => "",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Testimonials Post Type Name', 'flatbox'),
	"desc" => __('This will change the name of your Testimonials post type in the admin area.', 'flatbox'),
	"id" => "testimonials_post_type_name",
	"std" => "",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Testimonials Post Type Slug', 'flatbox'),
	"desc" => __('When you change the slug of a post type, be sure to refresh the permalink settings. Go to Settings > Permalinks and simply hit Save Changes. That will refresh your slug.', 'flatbox'),
	"id" => "testimonials_post_type_slug",
	"std" => "",
	"type" => "text"
);

// Social
$of_options[] = array(
	"name" => __('Social Profiles', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Hello there!', 'flatbox'),
	"id" => "social_info",
	"std" => __('Please introduce the full URL for the following social links used in [social-link] shorcodes. Example of a full URL: <strong>http://twitter.com/envato</strong>', 'flatbox'),
	"type" => "info"
);

$of_options[] = array(
	"name" => __('Twitter Profile', 'flatbox'),
	"desc" => __('Input your Twitter Profile URL.', 'flatbox'),
	"id" => "social_twitter",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Facebook Profile', 'flatbox'),
	"desc" => __('Input your Facebook Profile URL.', 'flatbox'),
	"id" => "social_facebook",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Google+ Profile', 'flatbox'),
	"desc" => __('Input your Google+ Profile URL.', 'flatbox'),
	"id" => "social_googleplus",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('YouTube Profile', 'flatbox'),
	"desc" => __('Input your YouTube Profile URL.', 'flatbox'),
	"id" => "social_youtube",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Vimeo Profile', 'flatbox'),
	"desc" => __('Input your Vimeo Profile URL.', 'flatbox'),
	"id" => "social_vimeo",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('LinkedIn Profile', 'flatbox'),
	"desc" => __('Input your LinkedIn Profile URL.', 'flatbox'),
	"id" => "social_linkedin",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Dribbble Profile', 'flatbox'),
	"desc" => __('Input your Dribbble Profile URL.', 'flatbox'),
	"id" => "social_dribbble",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Pinterest Profile', 'flatbox'),
	"desc" => __('Input your Pinterest Profile URL.', 'flatbox'),
	"id" => "social_pinterest",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Evernote Profile', 'flatbox'),
	"desc" => __('Input your Evernote Profile URL.', 'flatbox'),
	"id" => "social_evernote",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Forrst Profile', 'flatbox'),
	"desc" => __('Input your Forrst Profile URL.', 'flatbox'),
	"id" => "social_forrst",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Flickr Profile', 'flatbox'),
	"desc" => __('Input your Flickr Profile URL.', 'flatbox'),
	"id" => "social_flickr",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Behance Profile', 'flatbox'),
	"desc" => __('Input your Behance Profile URL.', 'flatbox'),
	"id" => "social_behance",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Tumblr Profile', 'flatbox'),
	"desc" => __('Input your Tumblr Profile URL.', 'flatbox'),
	"id" => "social_tumblr",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Blogger Profile', 'flatbox'),
	"desc" => __('Input your Blogger Profile URL.', 'flatbox'),
	"id" => "social_blogger",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Digg Profile', 'flatbox'),
	"desc" => __('Input your Digg Profile URL.', 'flatbox'),
	"id" => "social_digg",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('WordPress Profile', 'flatbox'),
	"desc" => __('Input your WordPress Profile URL.', 'flatbox'),
	"id" => "social_wordpress",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('RSS URL', 'flatbox'),
	"desc" => __('Input your RSS Feed address.', 'flatbox'),
	"id" => "social_rss",
	"type" => "text"
);

$of_options[] = array(
	"name" => __('Email Address', 'flatbox'),
	"desc" => __('Input your Email Address.', 'flatbox'),
	"id" => "social_email",
	"type" => "text"
);

// SEO Settings
$of_options[] = array(
	"name" => __('SEO', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Meta Description', 'flatbox'),
	"desc" => __('Add a meta description. This will appear in your header for better SEO value.', 'flatbox'),
	"id" => "meta-desc",
	"std" => get_bloginfo('description'),
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Meta Keywords', 'flatbox'),
	"desc" => __('Add some meta keywords. This will appear in your header for better SEO value. Provide a list of keywords that will allow your site to attract better SEO value.', 'flatbox'),
	"id" => "meta-key",
	"std" => "FlatBox, pixfort, WordPress",
	"type" => "textarea"
);

$of_options[] = array(
	"name" => __('Apple Touch Icon 57x57', 'flatbox'),
	"desc" => __('Upload or past the URL for your Apple Touch Icon.  There are three sizes to upload.  This size should be 57x57 of your logo.  This will help SEO value. <span style="color:#d52">The name of this image should be "apple-touch-icon.png"</span>', 'flatbox'),
	"id" => "custom_apple_touch_icon_1",
	"std" => "",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Apple Touch Icon 72x72', 'flatbox'),
	"desc" => __('Upload or past the URL for your Apple Touch Icon. There are three sizes to upload. This size should be 72x72 of your logo. This will help SEO value. <span style="color:#d52">The name of this image should be "apple-touch-icon-72x72.png"</span>', 'flatbox'),
	"id" => "custom_apple_touch_icon_2",
	"std" => "",
	"type" => "media"
);

$of_options[] = array(
	"name" => __('Apple Touch Icon 114x114', 'flatbox'),
	"desc" => __('Upload or past the URL for your Apple Touch Icon. There are three sizes to upload.  This size should be 114x114 of your logo. This will help SEO value. <span style="color:#d52">The name of this image should be "apple-touch-icon-114x114.png"</span>', 'flatbox'),
	"id" => "custom_apple_touch_icon_3",
	"std" => "",
	"type" => "media"
);

// 404
$of_options[] = array(
	"name" => __('Not Found 404', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('404 Image', 'flatbox'),
	"desc" => __('Select an image to be used as a 404 page not found graphics.', 'flatbox'),
	"id" => "404_image",
	"std" => '',
	"type" => "media"
);

$of_options[] = array(
	"name" => __('404 Text', 'flatbox'),
	"desc" => __('Input your error message that gets displayed on the 404 page not found template.', 'flatbox'),
	"id" => "404_text",
	"std" => 'The page you are looking for has vanished. Maybe it was never here or it was moved to a better place. You\'ll never know.',
	"type" => "textarea"
);

// Support
$of_options[] = array(
	"name" => __('Support', 'flatbox'),
	"type" => "heading"
);

$star_img = '<img src="' . get_template_directory_uri() . '/utils/admin/assets/images/icon-star2.png" />';
$of_options[] = array(
	"name" => __('Support', 'flatbox'),
	"id" => "updates_info",
	"std" => __('<strong>When encountering any issue please consult the documentation of this theme (from main purchased file) and do a quick internet search related to the issue - it might be a WordPress issue and not theme related.</strong> <br /><br />If you have no luck then send us a message via ThemeForest so we can validate your purchase first - please include your preview URL or temporary access to your WordPress admin in order for us to take a look as quick as possible. we will do our best to help out. <br /><br /> <a class="button-secondary rate" href="http://themeforest.net/downloads" target="_blank">Rate the theme first ' . $star_img . $star_img . $star_img . $star_img . $star_img . '</a> <a class="button-primary" href="http://themeforest.net/user/pixfort" target="_blank">Send us a private message</a>', 'flatbox'),
	"type" => "info"
);

// Backup Options
$of_options[] = array(
	"name" => __('Backup Options', 'flatbox'),
	"type" => "heading"
);

$of_options[] = array(
	"name" => __('Backup and Restore Options', 'flatbox'),
	"id" => "of_backup",
	"std" => "",
	"type" => "backup",
	"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'flatbox'),
);

$of_options[] = array(
	"name" => __('Transfer Theme Options Data', 'flatbox'),
	"id" => "of_transfer",
	"std" => "",
	"type" => "transfer",
	"desc" => __('You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'flatbox'),
);

}
}
?>
