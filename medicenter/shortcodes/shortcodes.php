<?php
global $medicenter_posts_array;
$medicenter_posts_array = array();
$count_posts = wp_count_posts();
if($count_posts->publish<100)
{
	$medicenter_posts_list = get_posts(array(
		'posts_per_page' => -1,
		'nopaging' => true,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));
	$medicenter_posts_array[__("All", 'medicenter')] = "-";
	foreach($medicenter_posts_list as $post)
		$medicenter_posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
}

global $medicenter_pages_array;
$medicenter_pages_array = array();
$count_pages = wp_count_posts('page');
if($count_pages->publish<100)
{
	$pages_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'page'
	));
	$medicenter_pages_array = array();
	$medicenter_pages_array[__("none", 'medicenter')] = "-";
	foreach($pages_list as $single_page)
		$medicenter_pages_array[$single_page->post_title . " (id:" . $single_page->ID . ")"] = $single_page->ID;
}

//slider
mc_get_theme_file("/shortcodes/slider.php");
//home box
mc_get_theme_file("/shortcodes/home_box.php");
//blog
mc_get_theme_file("/shortcodes/blog.php");
//post
mc_get_theme_file("/shortcodes/single-post.php");
//items_list
mc_get_theme_file("/shortcodes/items_list.php");
//columns
mc_get_theme_file("/shortcodes/columns.php");
//timetable
mc_get_theme_file("/shortcodes/timetable.php");
//map
mc_get_theme_file("/shortcodes/map.php");
//accordion
//require_once("accordion.php");
//nested tabs
//require_once("nested_tabs.php");
//carousel
mc_get_theme_file("/shortcodes/carousel.php");
//small slider
mc_get_theme_file("/shortcodes/small_slider.php");
//photostream
mc_get_theme_file("/shortcodes/photostream.php");
//announcement box
mc_get_theme_file("/shortcodes/announcement_box.php");
//testimonials
mc_get_theme_file("/shortcodes/testimonials.php");
//notification box
mc_get_theme_file("/shortcodes/notification_box.php");
//icon
mc_get_theme_file("/shortcodes/icon.php");
//cart icon
mc_get_theme_file("/shortcodes/cart_icon.php");
//pricing table
mc_get_theme_file("/shortcodes/pricing_table.php");

//row inner
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'medicenter'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'medicenter') => "none",  __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section"),
		"description" => __("Select top margin value for your row", "medicenter")
	)
);
vc_add_params('vc_row_inner', $attributes);

//row
vc_map( array(
	'name' => __( 'Row', 'js_composer' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Place content elements inside the row', 'js_composer' ),
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none",  __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section"),
			"description" => __("Select top margin value for your row", "medicenter")
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'js_composer' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'js_composer' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Bottom', 'js_composer' ) => 'bottom',
				__( 'Stretch', 'js_composer' ) => 'stretch',
			),
			'description' => __( 'Select columns position within row.', 'js_composer' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'js_composer' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'js_composer' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'js_composer' ) => '',
				__( 'Top', 'js_composer' ) => 'top',
				__( 'Middle', 'js_composer' ) => 'middle',
				__( 'Bottom', 'js_composer' ) => 'bottom',
			),
			'description' => __( 'Select content position within columns.', 'js_composer' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'js_composer' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'js_composer' ),
			'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'js_composer' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => __( 'Add YouTube link.', 'js_composer' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'js_composer' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( 'Simple', 'js_composer' ) => 'content-moving',
				__( 'With fade', 'js_composer' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'js_composer' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'js_composer' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'js_composer' ) => '',
				__( 'Simple', 'js_composer' ) => 'content-moving',
				__( 'With fade', 'js_composer' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'js_composer' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'js_composer' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'js_composer' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'js_composer' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'js_composer' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' ),
		)
	),
	'js_view' => 'VcRowView'
) );

//column
$vc_column_width_list = array(
	__('1 column - 1/12', 'js_composer') => '1/12',
	__('2 columns - 1/6', 'js_composer') => '1/6',
	__('3 columns - 1/4', 'js_composer') => '1/4',
	__('4 columns - 1/3', 'js_composer') => '1/3',
	__('5 columns - 5/12', 'js_composer') => '5/12',
	__('6 columns - 1/2', 'js_composer') => '1/2',
	__('7 columns - 7/12', 'js_composer') => '7/12',
	__('8 columns - 2/3', 'js_composer') => '2/3',
	__('9 columns - 3/4', 'js_composer') => '3/4',
	__('10 columns - 5/6', 'js_composer') => '5/6',
	__('11 columns - 11/12', 'js_composer') => '11/12',
	__('12 columns - 1/1', 'js_composer') => '1/1'
);
vc_map( array(
	'name' => __( 'Column', 'js_composer' ),
	'base' => 'vc_column',
	'is_container' => true,
	'content_element' => false,
	'description' => __( 'Place content elements inside the column', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none",  __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section"),
			"description" => __("Select top margin value for your column", "medicenter")
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'js_composer' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'js_composer' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'js_composer' ),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'group' => __( 'Responsive Options', 'js_composer' ),
			'description' => __( 'Select column width.', 'js_composer' ),
			'std' => '1/1'
		),
		array(
			'type' => 'column_offset',
			'heading' => __( 'Responsiveness', 'js_composer' ),
			'param_name' => 'offset',
			'group' => __( 'Responsive Options', 'js_composer' ),
			'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'js_composer' )
		)
	),
	'js_view' => 'VcColumnView'
) );

//widgetised sidebar
vc_map( array(
	'name' => __( 'Widgetised Sidebar', 'js_composer' ),
	'base' => 'vc_widget_sidebar',
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'icon-wpb-layout_sidebar',
	'category' => __( 'Structure', 'js_composer' ),
	'description' => __( 'WordPress widgetised sidebar', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'js_composer' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'js_composer' )
		),
		array(
			'type' => 'widgetised_sidebars',
			'heading' => __( 'Sidebar', 'js_composer' ),
			'param_name' => 'sidebar_id',
			'description' => __( 'Select widget area to display.', 'js_composer' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'js_composer' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none",  __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section"),
			"description" => __("Select top margin value for your sidebar", "medicenter")
		)
	)
) );

$mc_colors_arr = array(__("Dark blue", "js_composer") => "#3156a3", __("Blue", "js_composer") => "#0384ce", __("Light blue", "js_composer") => "#42b3e5", __("Black", "js_composer") => "#000000", __("Gray", "js_composer") => "#AAAAAA", __("Dark gray", "js_composer") => "#444444", __("Light gray", "js_composer") => "#CCCCCC", __("Green", "js_composer") => "#43a140", __("Dark green", "js_composer") => "#008238", __("Light green", "js_composer") => "#7cba3d", __("Orange", "js_composer") => "#f17800", __("Dark orange", "js_composer") => "#cb451b", __("Light orange", "js_composer") => "#ffa800", __("Red", "js_composer") => "#db5237", __("Dark red", "js_composer") => "#c03427", __("Light red", "js_composer") => "#f37548", __("Turquoise", "js_composer") => "#0097b5", __("Dark turquoise", "js_composer") => "#006688", __("Light turquoise", "js_composer") => "#00b6cc", __("Violet", "js_composer") => "#6969b3", __("Dark violet", "js_composer") => "#3e4c94", __("Light violet", "js_composer") => "#9187c4", __("White", "js_composer") => "#FFFFFF", __("Yellow", "js_composer") => "#fec110", __("Light", "js_composer") => "transparent");
$mc_size_arr = array(__("Medium", 'medicenter') => "medium", __("Tiny", 'medicenter') => "tiny", __("Small", 'medicenter') => "small", __("Large", 'medicenter') => "large");
$mc_icons_arr = array(
		__("None", "js_composer") => "none",
		__("Small arrow", "medicenter") => "icon_small_arrow",
		__("Address book icon", "js_composer") => "wpb_address_book",
		__("Alarm clock icon", "js_composer") => "wpb_alarm_clock",
		__("Anchor icon", "js_composer") => "wpb_anchor",
		__("Application Image icon", "js_composer") => "wpb_application_image",
		__("Arrow icon", "js_composer") => "wpb_arrow",
		__("Asterisk icon", "js_composer") => "wpb_asterisk",
		__("Hammer icon", "js_composer") => "wpb_hammer",
		__("Balloon icon", "js_composer") => "wpb_balloon",
		__("Balloon Buzz icon", "js_composer") => "wpb_balloon_buzz",
		__("Balloon Facebook icon", "js_composer") => "wpb_balloon_facebook",
		__("Balloon Twitter icon", "js_composer") => "wpb_balloon_twitter",
		__("Battery icon", "js_composer") => "wpb_battery",
		__("Binocular icon", "js_composer") => "wpb_binocular",
		__("Document Excel icon", "js_composer") => "wpb_document_excel",
		__("Document Image icon", "js_composer") => "wpb_document_image",
		__("Document Music icon", "js_composer") => "wpb_document_music",
		__("Document Office icon", "js_composer") => "wpb_document_office",
		__("Document PDF icon", "js_composer") => "wpb_document_pdf",
		__("Document Powerpoint icon", "js_composer") => "wpb_document_powerpoint",
		__("Document Word icon", "js_composer") => "wpb_document_word",
		__("Bookmark icon", "js_composer") => "wpb_bookmark",
		__("Camcorder icon", "js_composer") => "wpb_camcorder",
		__("Camera icon", "js_composer") => "wpb_camera",
		__("Chart icon", "js_composer") => "wpb_chart",
		__("Chart pie icon", "js_composer") => "wpb_chart_pie",
		__("Clock icon", "js_composer") => "wpb_clock",
		__("Fire icon", "js_composer") => "wpb_fire",
		__("Heart icon", "js_composer") => "wpb_heart",
		__("Mail icon", "js_composer") => "wpb_mail",
		__("Play icon", "js_composer") => "wpb_play",
		__("Shield icon", "js_composer") => "wpb_shield",
		__("Video icon", "js_composer") => "wpb_video"
	);
$target_arr = array(
	__( 'Same window', 'js_composer' ) => '_self',
	__( 'New window', 'js_composer' ) => '_blank'
);

vc_map( array(
	'name' => __( 'Button', 'js_composer' ) . " 1",
	'base' => 'vc_button',
	'icon' => 'icon-wpb-ui-button',
	'category' => __( 'Content', 'js_composer' ),
	'description' => __( 'Eye catching button', 'js_composer' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'js_composer' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'js_composer' ),
			'description' => __( 'Text on the button.', 'js_composer' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'js_composer' ),
			'param_name' => 'href',
			'description' => __( 'Button link.', 'js_composer' )
		),
		array(
			"type" => "dropdown",
			"heading" => __("Size", "js_composer"),
			"param_name" => "size",
			"value" => $mc_size_arr,
			"description" => __("Button size.", "js_composer")
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'js_composer' ),
			'param_name' => 'target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'href',
				'not_empty' => true,
				'callback' => 'vc_button_param_target_callback'
			)
		),
		/*array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'js_composer' ),
			'param_name' => 'color',
			'value' => $colors_arr,
			'description' => __( 'Button color.', 'js_composer' ),
			'param_holder_class' => 'vc-colored-dropdown'
		),*/
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon', 'js_composer' ),
			'param_name' => 'icon',
			'value' => $mc_icons_arr,
			'description' => __( 'Button icon.', 'js_composer' )
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text color", 'medicenter'),
			"param_name" => "text_color",
			"value" => "#FFFFFF"
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Hover text color", 'medicenter'),
			"param_name" => "hover_text_color",
			"value" => "#FFFFFF"
		),
		array(
			"type" => "dropdown",
			"heading" => __("Color", "js_composer"),
			"param_name" => "color",
			"value" => $mc_colors_arr,
			"description" => __("Button color.", "js_composer")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button color", 'medicenter'),
			"param_name" => "custom_button_color",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => __("Hover Color", "js_composer"),
			"param_name" => "hover_color",
			"value" => $mc_colors_arr,
			"description" => __("Button hover color.", "js_composer")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button hover color", 'medicenter'),
			"param_name" => "custom_button_hover_color",
			"value" => ""
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'js_composer' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none",  __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section")
		)
	),
	'js_view' => 'VcButtonView'
) );

//page layout
function theme_page_layout($atts, $content)
{
	return '<div class="page_layout clearfix">' . do_shortcode($content) . '</div>';
}
add_shortcode("page_layout", "theme_page_layout");

//page left
function theme_page_left($atts, $content)
{
	if(is_active_sidebar('left-top'))
	{
		ob_start();
		get_sidebar('left-top');
		$sidebar_left_top = ob_get_contents();
		ob_end_clean();
	}
	return '<div class="page_left">' . $sidebar_left_top . do_shortcode($content) . '</div>';
}
add_shortcode("page_left", "theme_page_left");

//page right
function theme_page_right($atts, $content)
{
	if(is_active_sidebar('right-top'))
	{
		ob_start();
		get_sidebar('right-top');
		$sidebar_right_top = ob_get_contents();
		ob_end_clean();
	}
	return '<div class="page_right">' . $sidebar_right_top . do_shortcode($content) . '</div>';
}
add_shortcode("page_right", "theme_page_right");

//button more
function theme_button_more($atts, $content)
{
	extract(shortcode_atts(array(
		"color" => "black",
		"arrow" => "margin_right_white",
		"href" => "#",
		"title" => "More"
	), $atts));
	
	return '<a class="more ' . $color . ($arrow!="" ? ' icon_small_arrow ' . $arrow : '') . '" href="' . $href . '" title="' . $title . '">' . do_shortcode($content) . '</a>';
}
add_shortcode("button_more", "theme_button_more");

//box_header
function theme_box_header($atts)
{
	extract(shortcode_atts(array(
		"title" => "Sample Header",
		"type" => "h3",
		"class" => "",
		"bottom_border" => 1,
		"animation" => 0,
		"top_margin" => "none"
	), $atts));
	return '<' . $type . ' class="box_header' . ($class!="" ? ' ' . $class : '') . (!(int)$bottom_border ? ' no_border' : ((int)$animation ? ' animation-slide' : '')) . ($top_margin!="none" ? ' ' . $top_margin : '') . '">' . do_shortcode($title) . '</' . $type . '>';
}
add_shortcode("box_header", "theme_box_header");
//visual composer
vc_map( array(
	"name" => __("Box header", 'medicenter'),
	"base" => "box_header",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-box-header",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'medicenter'),
			"param_name" => "title",
			"value" => "Sample Header"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'medicenter'),
			"param_name" => "type",
			"value" => array(__("H3", 'medicenter') => "h3",  __("H1", 'medicenter') => "h1", __("H2", 'medicenter') => "h2", __("H4", 'medicenter') => "h4", __("H5", 'medicenter') => "h5")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bottom border", 'medicenter'),
			"param_name" => "bottom_border",
			"value" => array(__("yes", 'medicenter') => 1,  __("no", 'medicenter') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bottom border animation", 'medicenter'),
			"param_name" => "animation",
			"value" => array(__("no", 'medicenter') => 0,  __("yes", 'medicenter') => 1),
			"dependency" => Array('element' => "bottom_border", 'value' => '1')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'medicenter'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none", __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section")
		)
	)
));

//dropcap
function theme_dropcap($atts, $content)
{
	extract(shortcode_atts(array(
		"id" => "",
		"label" => "1",
		"label_background_color" => "",
		"custom_label_background_color" => "",
		"label_color" => "",
		"content_text_color" => "",
		"class" => "",
		"top_margin" => "none"
	), $atts));
	
	$label_background_color = ($custom_label_background_color!="" ? $custom_label_background_color : $label_background_color);
	return ($content_text_color!="" && $id!="" ? '<style type="text/css">#' . $id . ' p{color:' . $content_text_color . ';}</style>': '') . '<div' . ($id!="" ? ' id="' . $id . '"' : '') . ' class="dropcap' . ($top_margin!="none" ? ' ' . $top_margin : '') . ($class!="" ? ' '. $class : '') . '"><div class="dropcap_label"' . ($label_background_color!="" ? ' style="background-color:' . $label_background_color . ';"' : '') . '><h3' . ($label_color!="" ? ' style="color:' . $label_color . ';"' : '') . '>' . $label . '</h3></div>' . wpb_js_remove_wpautop($content) . '</div>';
}
add_shortcode("dropcap", "theme_dropcap");
//visual composer
$mc_colors_arr = array(__("Dark blue", "js_composer") => "#3156a3", __("Blue", "js_composer") => "#0384ce", __("Light blue", "js_composer") => "#42b3e5", __("Black", "js_composer") => "#000000", __("Gray", "js_composer") => "#AAAAAA", __("Dark gray", "js_composer") => "#444444", __("Light gray", "js_composer") => "#CCCCCC", __("Green", "js_composer") => "#43a140", __("Dark green", "js_composer") => "#008238", __("Light green", "js_composer") => "#7cba3d", __("Orange", "js_composer") => "#f17800", __("Dark orange", "js_composer") => "#cb451b", __("Light orange", "js_composer") => "#ffa800", __("Red", "js_composer") => "#db5237", __("Dark red", "js_composer") => "#c03427", __("Light red", "js_composer") => "#f37548", __("Turquoise", "js_composer") => "#0097b5", __("Dark turquoise", "js_composer") => "#006688", __("Light turquoise", "js_composer") => "#00b6cc", __("Violet", "js_composer") => "#6969b3", __("Dark violet", "js_composer") => "#3e4c94", __("Light violet", "js_composer") => "#9187c4", __("White", "js_composer") => "#FFFFFF", __("Yellow", "js_composer") => "#fec110");
vc_map( array(
	"name" => __("Dropcap text", 'medicenter'),
	"base" => "dropcap",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-dropcap",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Id", 'medicenter'),
			"param_name" => "id",
			"value" => "",
			"description" => __("Please provide unique id for each dropcap on the same page/post if you would like to have custom content color for each one", 'medicenter')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Label", 'medicenter'),
			"param_name" => "label",
			"value" => "1"
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'medicenter'),
			"param_name" => "content",
			"value" => ""
		),
		array(
            "type" => "dropdown",
            "heading" => __("Label background color", "medicenter"),
            "param_name" => "label_background_color",
            "value" => $mc_colors_arr,
            "description" => __("Button color.", "js_composer")
        ),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom label background color", 'medicenter'),
			"param_name" => "custom_label_background_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Label text color", 'medicenter'),
			"param_name" => "label_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content text color", 'medicenter'),
			"param_name" => "content_text_color",
			"value" => "",
			"description" => __("If you would like to use 'Content text color', you need to fill 'Id' field", 'medicenter')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'medicenter'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'medicenter'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'medicenter') => "none", __("Page (small)", 'medicenter') => "page_margin_top", __("Section (large)", 'medicenter') => "page_margin_top_section")
		)
	)
));

//show all
function theme_show_all_button($atts)
{
	extract(shortcode_atts(array(
		"url" => "blog",
		"title" => __("Show all &rarr;", 'medicenter')
	), $atts));
	return '<div class="show_all clearfix"><a href="' . $url . '" title="' . esc_attr($title) . '">' . $title . '</a></div>';
}
add_shortcode("show_all_button", "theme_show_all_button");
//visual composer
vc_map( array(
	"name" => __("Show all button", 'medicenter'),
	"base" => "show_all_button",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-shape-text",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'medicenter'),
			"param_name" => "title",
			"value" => __("Show all &rarr;", 'medicenter')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Url", 'medicenter'),
			"param_name" => "url",
			"value" => "blog"
		)
	)
));

//sentence
function theme_sentence($atts)
{
	extract(shortcode_atts(array(
		"title" => "Sample Sentence Text",
		"author" => "",
		"title_animation" => "",
		"title_animation_duration" => 600,
		"title_animation_delay" => 0,
		"author_animation" => "",
		"author_animation_duration" => 600,
		"author_animation_delay" => 0
	), $atts));
	
	return '<h3 class="sentence' . ($title_animation!='' ? ' animated_element animation-' . $title_animation . ((int)$title_animation_duration>0 && (int)$title_animation_duration!=600 ? ' duration-' . (int)$title_animation_duration : '') . ((int)$title_animation_delay>0 ? ' delay-' . (int)$title_animation_delay : '') : '') . '">' . do_shortcode($title) . '</h3>' . ($author!="" ? '<div class="clearfix"><span class="sentence_author' . ($author_animation!='' ? ' animated_element animation-' . $author_animation . ((int)$author_animation_duration>0 && (int)$author_animation_duration!=600 ? ' duration-' . (int)$author_animation_duration : '') . ((int)$author_animation_delay>0 ? ' delay-' . (int)$author_animation_delay : '') : '') . '">' . $author . '</span></div>' : '');
}
add_shortcode("sentence", "theme_sentence");
//visual composer
vc_map( array(
	"name" => __("Sentence", 'medicenter'),
	"base" => "sentence",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-sentence",
	"category" => __('MediCenter', 'medicenter'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'medicenter'),
			"param_name" => "title",
			"value" => "Sample Sentence Text"
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Author", 'medicenter'),
			"param_name" => "author",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => __("Title animation", "js_composer"),
			"param_name" => "title_animation",
			"value" => array(
				__("none", "medicenter") => "",
				__("fade in", "medicenter") => "fadeIn",
				__("scale", "medicenter") => "scale",
				__("slide right", "medicenter") => "slideRight",
				__("slide right 200%", "medicenter") => "slideRight200",
				__("slide left", "medicenter") => "slideLeft",
				__("slide left 50%", "medicenter") => "slideLeft50",
				__("slide down", "medicenter") => "slideDown",
				__("slide down 200%", "medicenter") => "slideDown200",
				__("slide up", "medicenter") => "slideUp"
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title animation duration", 'medicenter'),
			"param_name" => "title_animation_duration",
			"value" => "600"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title animation delay", 'medicenter'),
			"param_name" => "title_animation_delay",
			"value" => "0"
		),
		array(
			"type" => "dropdown",
			"heading" => __("Author animation", "js_composer"),
			"param_name" => "author_animation",
			"value" => array(
				__("none", "medicenter") => "",
				__("fade in", "medicenter") => "fadeIn",
				__("scale", "medicenter") => "scale",
				__("slide right", "medicenter") => "slideRight",
				__("slide right 200%", "medicenter") => "slideRight200",
				__("slide left", "medicenter") => "slideLeft",
				__("slide left 50%", "medicenter") => "slideLeft50",
				__("slide down", "medicenter") => "slideDown",
				__("slide down 200%", "medicenter") => "slideDown200",
				__("slide up", "medicenter") => "slideUp"
			)
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Author animation duration", 'medicenter'),
			"param_name" => "author_animation_duration",
			"value" => "600"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Author animation delay", 'medicenter'),
			"param_name" => "author_animation_delay",
			"value" => "0"
		)
	)
));

//sidebar box
function theme_sidebar_box($atts, $content)
{
	extract(shortcode_atts(array(
		"first" => false
	), $atts));
	return '<div class="sidebar_box' . ($first ? ' first' : '') . '">' . do_shortcode($content) . '</div>';
}
add_shortcode("sidebar_box", "theme_sidebar_box");

//scroll top
function theme_scroll_top($atts, $content)
{
	extract(shortcode_atts(array(
		"title" => "Scroll to top",
		"label" => "Top"
	), $atts));
	
	return '<a class="scroll_top icon_small_arrow top_white" href="#top" title="' . esc_attr($title) . '">' . esc_attr($label) . '</a>';
}
add_shortcode("scroll_top", "theme_scroll_top");

//box_header
function theme_info_text($atts, $content)
{
	extract(shortcode_atts(array(
		"color" => "white",
		"class" => ""
	), $atts));
	return '<h4 class="info_' . $color . ' ' . $class . '">' . do_shortcode($content) . '</h4>';
}
add_shortcode("info_text", "theme_info_text");

//header_icon
function theme_header_icon($atts, $content)
{
	extract(shortcode_atts(array(
		"class" => "",
		"url" => "",
		"url_target" => "new_window",
		"type" => "address"
	), $atts));
	
	return '<' . ($url!="" ? 'a' : 'span') . ($url!="" ? ' href="' . esc_attr($url) . '"' . ($url_target=="new_window" ? ' target="_blank"' : '') : '') . ' class="header_icon ' . $type . ($content=="" ? ' empty_icon' : '') . ($class!="" ? ' ' . $class : '') . '">' . $content . '</' . ($url!="" ? 'a' : 'span') . '>';
}
add_shortcode("header_icon", "theme_header_icon");
?>