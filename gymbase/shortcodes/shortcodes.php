<?php
//slider
gb_get_theme_file("/shortcodes/slider.php");
//home box
gb_get_theme_file("/shortcodes/home_box.php");
//blog
gb_get_theme_file("/shortcodes/blog.php");
//latest_news
gb_get_theme_file("/shortcodes/latest_news.php");
//scrolling_list
gb_get_theme_file("/shortcodes/scrolling_list.php");
//items_list
gb_get_theme_file("/shortcodes/items_list.php");
//item
gb_get_theme_file("/shortcodes/item.php");
//columns
gb_get_theme_file("/shortcodes/columns.php");
//timetable
gb_get_theme_file("/shortcodes/timetable.php");
//map
gb_get_theme_file("/shortcodes/map.php");
//accordion
gb_get_theme_file("/shortcodes/accordion.php");
//tabs
gb_get_theme_file("/shortcodes/tabs.php");
//social icons
gb_get_theme_file("/shortcodes/social_icons.php");
//cart icon
gb_get_theme_file("/shortcodes/cart_icon.php");

//row inner
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'gymbase'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section"),
		"description" => __("Select top margin value for your row", "gymbase")
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
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section"),
			"description" => __("Select top margin value for your row", "gymbase")
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
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section"),
			"description" => __("Select top margin value for your column", "gymbase")
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
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'gymbase') => "none",  __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section"),
			"description" => __("Select top margin value for your sidebar", "gymbase")
		)
	)
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


//list pages
function theme_list_pages($atts, $content)
{
	$output = "";
	
	$output .= "<h3>Page List:</h3><ul>";
	$args = array(
		'post_type' => 'page',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'orderby' => 'title', 
		'order' => 'ASC',
		'suppress_filters' => 0
	);
	query_posts($args);
	if(have_posts()) : while (have_posts()) : the_post();
		global $post;
		$output .= "<li>" . get_the_title() . "</li>";
	endwhile;
	endif;
	wp_reset_query();
	
	$output .= "</ul>";
	
	return $output;
}
add_shortcode("list_pages", "theme_list_pages");
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
function theme_box_header($atts, $content)
{
	extract(shortcode_atts(array(
		"type" => "h3",
		"class" => "",
		"top_margin" => "page_margin_top_none"
	), $atts));
	return '<' . $type . ' class="box_header' . ($class!="" ? " " . $class : "") . ' ' . $top_margin . '">' . do_shortcode($content) . '</' . $type . '>';
}
add_shortcode("box_header", "theme_box_header");

//visual composer
vc_map( array(
	"name" => __("Box header", 'gymbase'),
	"base" => "box_header",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-box-header",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'gymbase'),
			"param_name" => "content",
			"value" => "Sample Header"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'gymbase'),
			"param_name" => "type",
			"value" => array(__("H3", 'gymbase') => "h3",  __("H1", 'gymbase') => "h1", __("H2", 'gymbase') => "h2", __("H4", 'gymbase') => "h4", __("H5", 'gymbase') => "h5")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'gymbase'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
		)
	)
));

//show all
function theme_show_all_button($atts)
{
	global $themename;
	extract(shortcode_atts(array(
		"url" => "blog",
		"title" => __("Show all", 'gymbase'),
		"top_margin" => "page_margin_top"
	), $atts));
	return '<div class="show_all ' . $top_margin . '"><a class="more icon_small_arrow margin_right_white" href="' . $url . '" title="' . $title . '">' . $title . '</a></div>';
}
add_shortcode("show_all_button", "theme_show_all_button");
//visual composer
vc_map( array(
	"name" => __("Show all button", 'gymbase'),
	"base" => "show_all_button",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-ui-button",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'gymbase'),
			"param_name" => "title",
			"value" => __("Show all", 'gymbase')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Url", 'gymbase'),
			"param_name" => "url",
			"value" => "blog"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
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
		"class" => "",
		"top_margin" => ""
	), $atts));
	return '<h4 class="info_' . $color . ' ' . $class . ' ' . $top_margin .'">' . do_shortcode($content) . '</h4>';
}
add_shortcode("info_text", "theme_info_text");

//visual composer
vc_map( array(
	"name" => __("Info text", 'gymbase'),
	"base" => "info_text",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-shape-text",
	"category" => __('GymBase', 'gymbase'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'gymbase'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"holder" => "",
			"class" => "",
			"heading" => __("Color", 'gymbase'),
			"param_name" => "color",
			"value" => array(__("White", 'gymbase') => "white", __("Green", 'gymbase') => "green")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Class", 'gymbase'),
			"param_name" => "class",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'gymbase'),
			"param_name" => "top_margin",
			"value" => array( __("Page (small)", 'gymbase') => "page_margin_top", __("Section (large)", 'gymbase') => "page_margin_top_section", __("None", 'gymbase') => "page_margin_top_none")
		)
	)
));

?>