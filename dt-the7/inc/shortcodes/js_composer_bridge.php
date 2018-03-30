<?php 
/**
 * This file contains shortcodes interface for Visual Composer.
 *
 * @package the7\Shortcodes
 * @since 1.0.0
 */

// ! File Security Check
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Changing rows and columns classes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @return string
 */
function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	if ( $tag=='vc_column' || $tag=='vc_column_inner' ) {
		$class_string = preg_replace( '/vc_span(\d{1,2})/', 'wf-cell wf-span-$1', $class_string );
	}

	return $class_string;
}
add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );


/**
 * Adding our classes to paint standard VC shortcodes.
 *
 * @param  string $class_string
 * @param  string $tag
 * @param  array  $atts
 * @return string
 */
function custom_css_accordion( $class_string, $tag, $atts = array() ) {
	if ( in_array( $tag, array( 'vc_accordion', 'vc_toggle', 'vc_progress_bar', 'vc_posts_slider' ) ) ) {
		$class_string .= ' dt-style';
	}

	if ( 'vc_accordion' === $tag ) {
		if ( array_key_exists( 'style' , $atts ) ) {
			switch ( $atts['style'] ) {
				case '2':
					$class_string .= ' dt-accordion-bg-on';
					break;

				case '3':
					$class_string .= ' dt-accordion-line-on';
					break;
			}
		}

		if ( array_key_exists( 'title_size', $atts ) ) {
			$class_string .= ' dt-accordion-' . presscore_get_font_size_class( $atts['title_size'] );
		}
	}

	return $class_string;
}
add_filter( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'custom_css_accordion', 10, 3 );

/**
 * VC Row.
 */

// Animation
vc_add_param( "vc_row", array(
	"heading" => __( "Animation", 'the7mk2' ),
	"param_name" => "animation",
	"type" => "dropdown",
	"value" => presscore_get_vc_animation_options(),
	"admin_label" => true,
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Anchor
vc_add_param( "vc_row", array(
	"heading" => __( "Anchor", 'the7mk2' ),
	"description" => __( "If anchor is &quot;contact&quot;, use &quot;#!/contact&quot; as its smooth scroll link.", 'the7mk2' ),
	"param_name" => "anchor",
	"type" => "textfield",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Minimum height
vc_add_param( "vc_row", array(
	"heading" => __( "Row minimum height", 'the7mk2' ),
	"description" => __( "You can use pixels (px) or percents (%).", 'the7mk2' ),
	"param_name" => "min_height",
	"type" => "textfield",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

$row_margin_support_link = 'http://support.dream-theme.com/knowledgebase/remove-gap-above-and-below-content-area/';

// Top margin
vc_add_param( "vc_row", array(
	"heading" => __( "Top margin", 'the7mk2' ),
	"description" => sprintf( __( 'In pixels; negative values are allowed. if this is <a href="%s" target="_blank">the first stripe</a>, set -50px.', 'the7mk2' ), $row_margin_support_link ),
	"param_name" => "margin_top",
	"type" => "textfield",
	"value" => "",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Bottom margin
vc_add_param( "vc_row", array(
	"heading" => __( "Bottom margin", 'the7mk2' ),
	"description" => sprintf( __( 'In pixels; negative values are allowed. if this is <a href="%s" target="_blank">the last stripe</a>, set -50px.', 'the7mk2' ), $row_margin_support_link ),
	"param_name" => "margin_bottom",
	"type" => "textfield",
	"value" => "",
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Full-width content
vc_add_param( "vc_row", array(
	"heading" => __( "Full-width content", 'the7mk2' ),
	"param_name" => "full_width_row",
	"type" => "checkbox",
	"value" => array( "" => "true" ),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Left padding
vc_add_param( "vc_row", array(
	"heading" => __( "Left padding", 'the7mk2' ),
	"description" => __( "In pixels. This setting works only for inner row (a row inside a row).", 'the7mk2' ),
	"param_name" => "padding_left",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "full_width_row",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Right padding
vc_add_param( "vc_row", array(
	"heading" => __( "Right padding", 'the7mk2' ),
	"description" => __( "In pixels. This setting works only for inner row (a row inside a row).", 'the7mk2' ),
	"param_name" => "padding_right",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "full_width_row",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Top padding
vc_add_param( "vc_row", array(
	"heading" => __( "Top padding", 'the7mk2' ),
	"description" => __( "In pixels.", 'the7mk2' ),
	"param_name" => "padding_top",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Bottom padding
vc_add_param( "vc_row", array(
	"heading" => __( "Bottom padding", 'the7mk2' ),
	"description" => __( "In pixels.", 'the7mk2' ),
	"param_name" => "padding_bottom",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background color
vc_add_param( "vc_row", array(
	"heading" => __( "Background color", 'the7mk2' ),
	"param_name" => "bg_color",
	"type" => "colorpicker",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background image
vc_add_param( "vc_row", array(
	"heading" => __( "Background image", 'the7mk2' ),
	"description" => __( "Image URL.", 'the7mk2' ),
	"param_name" => "bg_image",
	"type" => "textfield",
	"class" => "dt_image",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background position
vc_add_param( "vc_row", array(
	"heading" => __( "Background position", 'the7mk2' ),
	"param_name" => "bg_position",
	"type" => "dropdown",
	"value" => array(
		"Top" => "top",
		"Middle" => "center",
		"Bottom" => "bottom",
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Background repeat
vc_add_param( "vc_row", array(
	"heading" => __( "Background repeat", 'the7mk2' ),
	"param_name" => "bg_repeat",
	"type" => "dropdown",
	"value" => array(
		"No repeat" => "no-repeat",
		"Repeat (horizontally & vertically)" => "repeat",
		"Repeat horizontally" => "repeat-x",
		"Repeat vertically" => "repeat-y",
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Full-width background
vc_add_param( "vc_row", array(
	"heading" => __( "Full-width background", 'the7mk2' ),
	"param_name" => "bg_cover",
	"type" => "dropdown",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Fixed background
vc_add_param( "vc_row", array(
	"heading" => __( "Fixed background", 'the7mk2' ),
	"param_name" => "bg_attachment",
	"type" => "dropdown",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Enable parallax
vc_add_param( "vc_row", array(
	"heading" => __( "Enable parallax", 'the7mk2' ),
	"param_name" => "enable_parallax",
	"type" => "checkbox",
	"value" => array( "" => "false" ),
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Parallax speed
vc_add_param( "vc_row", array(
	"heading" => __( "Parallax speed", 'the7mk2' ),
	"description" => __( "Slower then content scrolling: 0.1 - 1. Faster then content scrolling: 1 and above. Reverse direction: - 0.1 and below.", 'the7mk2' ),
	"param_name" => "parallax_speed",
	"type" => "textfield",
	"value" => "0.1",
	"dependency" => array(
		"element" => "enable_parallax",
		"not_empty" => true,
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column",
));

// Video background (mp4)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (mp4)", 'the7mk2' ),
	"param_name" => "bg_video_src_mp4",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

// Video background (ogv)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (ogv)", 'the7mk2' ),
	"param_name" => "bg_video_src_ogv",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

// Video background (webm)
vc_add_param( "vc_row", array(
	"heading" => __( "Video background (webm)", 'the7mk2' ),
	"param_name" => "bg_video_src_webm",
	"type" => "textfield",
	"value" => "",
	"dependency" => array(
		"element" => "type",
		"value" => array( '1', '2', '3', '4', '5' ),
	),
	"edit_field_class" => "dt_vc_row-param vc_col-xs-12 vc_column dt-force-hidden",
));

$vc_row_shortcode = WPBMap::getShortCode( 'vc_row' );
if ( isset( $vc_row_shortcode['params'] ) && is_array( $vc_row_shortcode['params'] ) ) {
	$params = $vc_row_shortcode['params'];

	// Output 'tupe' param first.
	array_unshift( $params, array(
		'heading' => __( 'Row style', 'the7mk2' ),
		'param_name' => 'type',
		'type' => 'dropdown',
		'edit_field_class' => 'dt_vc_row-params_switch vc_col-xs-12 vc_column',
		'admin_label' => true,
		'value' => array(
			'Default The7' => '',
			'Default VC' => 'vc_default',
			'Stripe 1 (from Theme Options > Stripes)' => '1',
			'Stripe 2 (from Theme Options > Stripes)' => '2',
			'Stripe 3 (from Theme Options > Stripes)' => '3',
			'Stripe 4 (dark background & light content)' => '4',
			'Stripe 5 (light background & dark content)' => '5',
		),
	) );

	$el_class_key = false;
	foreach ( $params as $p_key=>$p_data ) {
		if ( isset( $p_data['param_name'] ) && 'el_class' === $p_data['param_name'] ) {
			$el_class_key = $p_key;
			break;
		}
	}

	// Output 'el_class' param last.
	if ( false !== $el_class_key ) {
		$el_class = $params[ $el_class_key ];
		unset( $params[ $el_class_key ] );
		$params[] = $el_class;
	}

	WPBMap::modify( 'vc_row', 'params', $params );
}

/**
 * VC Column.
 */

vc_add_param("vc_column", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Animation", 'the7mk2'),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => presscore_get_vc_animation_options(),
	"description" => ""
));

/**
 * VC Pie.
 */

vc_map( array(
	'base'			=> 'vc_pie',
	'name'			=> __( 'Pie chart', 'the7mk2' ),
	'description'	=> __( 'Animated pie chart', 'the7mk2' ),
	'category'		=> __( 'Content', 'the7mk2' ),
	'icon'			=> 'icon-wpb-vc_pie',
	'params'		=> array(
		array(
			'heading'		=> __( 'Widget title', 'the7mk2' ),
			'description'	=> __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'the7mk2' ),
			'param_name'	=> 'title',
			'type'			=> 'textfield',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie value', 'the7mk2' ),
			'description'	=> __( 'Input graph value here. Choose range between 0 and 100.', 'the7mk2' ),
			'param_name'	=> 'value',
			'type'			=> 'textfield',
			'value'			=> '50',
			'admin_label'	=> true,
		),
		array(
			'heading'		=> __( 'Pie label value', 'the7mk2' ),
			'description'	=> __( 'Input integer value for label. If empty "Pie value" will be used.', 'the7mk2' ),
			'param_name'	=> 'label_value',
			'type'			=> 'textfield',
			'value'			=> '',
		),
		array(
			'heading'		=> __( 'Units', 'the7mk2' ),
			'description'	=> __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'the7mk2' ),
			'param_name'	=> 'units',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Bar color", 'the7mk2' ),
			"description"	=> __( 'Select pie chart color.', 'the7mk2' ),
			"param_name"	=> "color_mode",
			"type"			=> "dropdown",
			"value"			=> array(
				"Title"					=> "title_like",
				"Light (50% content)"	=> "content_like",
				"Accent"				=> "accent",
				"Custom"				=> "custom"
			),
		),
		array(
			"heading"		=> __( "Custom bar color", 'the7mk2' ),
			"param_name"	=> "color",
			"type"			=> "colorpicker",
			"value"			=> '#f7f7f7',
			"dependency"	=> array(
				"element"		=> "color_mode",
				"value"			=> array( "custom" )
			)
		),
		array(
			'heading'		=> __( 'Extra class name', 'the7mk2' ),
			'description'	=> __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'the7mk2' ),
			'param_name'	=> 'el_class',
			'type'			=> 'textfield',
		),
		array(
			"heading"		=> __( "Appearance", 'the7mk2' ),
			"param_name"	=> "appearance",
			"type"			=> "dropdown",
			"value"			=> array(
				"Pie chart (default)"	=> "default",
				"Counter"				=> "counter"
			),
			"admin_label"	=> true,
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * VC Widgetized sidebar.
 */

vc_add_param( "vc_widget_sidebar", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __( "Show background", 'the7mk2' ),
	"admin_label" => true,
	"param_name" => "show_bg",
	"value" => array(
		"Yes" => "true",
		"No" => "false"
	)
) );

/**
 * VC Tabs.
 */

// undeprecate
vc_map_update("vc_tabs", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_tabs",
	"weight" => -1,
));

vc_map_update( 'vc_tab', array(
	'deprecated' => null,
) );

// title font size
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

// style
vc_add_param("vc_tabs", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three",
		"Style 4" => "tab-style-four"
	)
));

/**
 * VC Tour.
 */

// undeprecate
vc_map_update("vc_tour", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_tour",
	"weight" => -1,
));

// title font size
vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_tour", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		"Style 1" => "tab-style-one",
		"Style 2" => "tab-style-two",
		"Style 3" => "tab-style-three",
		"Style 4" => "tab-style-four"
	)
));

/**
 * VC Progress bars.
 */

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Style', 'the7mk2' ),
	"param_name" => "caption_pos",
	"value" => array(
		'Style 1 (text on the bar)' => 'on',
		'Style 2 (text above the thick bar)' => 'top',
		'Style 3 (text above the thin bar)' => 'thin_top',
	)
));

vc_add_param("vc_progress_bar", array(
	"type" => "dropdown",
	"heading" => __( 'Background', 'the7mk2' ),
	"param_name" => "bgstyle",
	"value" => array(
		'Default' => 'default',
		'Outlines' => 'outline',
		'Semitransparent' => 'transparent',
	)
));

// add accent predefined color
$param = WPBMap::getParam('vc_progress_bar', 'bgcolor');
$param['value'] = array( 'Accent' => 'accent-bg', 'Custom' => 'custom' );
WPBMap::mutateParam('vc_progress_bar', $param);

/**
 * VC Column text.
 */

// add custom animation
$param = WPBMap::getParam('vc_column_text', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_column_text', $param);

/**
 * VC Message Box.
 */

// add custom animation
$param = WPBMap::getParam('vc_message', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_message', $param);

/**
 * VC Toggle.
 */

// add custom animation
$param = WPBMap::getParam('vc_toggle', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_toggle', $param);

/**
 * VC Single Image.
 */

// add custom animation
$param = WPBMap::getParam('vc_single_image', 'css_animation');
$param['value'] = presscore_get_vc_animation_options();
WPBMap::mutateParam('vc_single_image', $param);

// replace pretty photo with theme popup
$param = WPBMap::getParam('vc_single_image', 'onclick');

if ( $param && $key = array_search( 'link_image', $param['value'] ) ) {
	unset( $param['value'][ $key ] );

	$key = 'Open Magnific Popup';

	$param['value'][ $key ] = 'link_image';

	WPBMap::mutateParam('vc_single_image', $param);
}
unset( $param, $key );

vc_add_param("vc_single_image", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Image hovers", 'the7mk2'),
	"param_name" => "image_hovers",
	"std" => "true",
	"value" => array(
		"Disabled" => "false",
		"Enabled" => "true"
	)
));

/**
 * @since 3.1.4
 */
vc_add_param("vc_single_image", array(
	"type" => "checkbox",
	"heading" => __("Lazy loading", 'the7mk2'),
	"param_name" => "lazy_loading",
));

/**
 * VC Accordion.
 */

// undeprecate
vc_map_update("vc_accordion", array(
	"deprecated" => null,
	"category" => __('by Dream-Theme', 'the7mk2'),
	"icon" => "dt_vc_ico_accordion",
	"weight" => -1,
));

vc_map_update( 'vc_accordion_tab', array(
	'deprecated' => null,
));

// title font size
vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Title size", 'the7mk2'),
	"param_name" => "title_size",
	"value" => array(
		'small' => "small",
		'medium' => "normal",
		'large' => "big",
		'h1' => "h1",
		'h2' => "h2",
		'h3' => "h3",
		'h4' => "h4",
		'h5' => "h5",
		'h6' => "h6",
	),
	"std" => "big"
));

vc_add_param("vc_accordion", array(
	"type" => "dropdown",
	"heading" => __("Style", 'the7mk2'),
	"param_name" => "style",
	"value" => array(
		'Style 1 (no background)' => '1',
		'Style 2 (with background)' => '2',
		'Style 3 (with dividers)' => '3'
	),
	"description" => ""
));

/**
 * VC Button.
 */

vc_add_param( 'vc_btn', array(
	'type' => 'checkbox',
	'heading' => __( 'Smooth scroll?', 'the7mk2' ),
	'param_name' => 'smooth_scroll',
	'description' => __( 'for #anchor navigation', 'the7mk2' )
) );

/**
 * DT Fancy Titles.
 */

vc_map( array(
	"weight" => -1,
	"name" => "Fancy Titles",
	"base" => "dt_fancy_title",
	"icon" => "dt_vc_ico_fancy_titles",
	"class" => "dt_vc_sc_fancy_titles",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => "Title",
			"param_name" => "title",
			"holder" => "div",
			"value" => "Title",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title position",
			"param_name" => "title_align",
			"value" => array(
				'centre' => "center",
				'left' => "left",
				'right' => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title size",
			"param_name" => "title_size",
			"value" => array(
				'small' => "small",
				'medium' => "normal",
				'large' => "big",
				'h1' => "h1",
				'h2' => "h2",
				'h3' => "h3",
				'h4' => "h4",
				'h5' => "h5",
				'h6' => "h6",
			),
			"std" => "normal",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Title color",
			"param_name" => "title_color",
			"value" => array(
				"semitransparent" => "default",
				"accent" => "accent",
				"title" => "title",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom title color",
			"param_name" => "custom_title_color",
			"dependency" => array(
				"element" => "title_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"line" => "",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
				"thick" => "thick",
				"disabled" => "disabled"
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in %)",
			"param_name" => "el_width",
			"value" => "100",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Background under title",
			"param_name" => "title_bg",
			"value" => array(
				"enabled" => "enabled",
				"disabled" => "disabled"
			),
			"std" => "disabled",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator & background color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Separators.
 */

vc_map( array(
	"weight" => -1,
	"name" => "Fancy Separators",
	"base" => "dt_fancy_separator",
	"icon" => "dt_vc_ico_separators",
	"class" => "dt_vc_sc_separators",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"description" => '',
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => "Separator style",
			"param_name" => "separator_style",
			"value" => array(
				"solid line" => "line",
				"dashed" => "dashed",
				"dotted" => "dotted",
				"double" => "double",
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Separator color",
			"param_name" => "separator_color",
			"value" => array(
				"default" => "default",
				"accent" => "accent",
				"custom" => "custom"
			),
			"std" => "default",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"heading" => "Custom separator color",
			"param_name" => "custom_separator_color",
			"dependency" => array(
				"element" => "separator_color",
				"value" => array( "custom" )
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"heading" => "Alignment",
			"param_name" => "alignment",
			"value" => array(
				'center' => 'center',
				'left' => 'left',
				'right' => 'right',
			),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Thickness (in px)",
			"param_name" => "line_thickness",
			"value" => "",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"heading" => "Element width (in % or px)",
			"param_name" => "el_width",
			"value" => "100%",
			"description" => ""
		),
	)
) );

/**
 * DT Fancy Quote.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Quote", 'the7mk2'),
	"base" => "dt_quote",
	"icon" => "dt_vc_ico_quote",
	"class" => "dt_vc_sc_quote",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for QUOTE. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Quote type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Blockquote" => "blockquote",
				"Pullquote" => "pullquote"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "font_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
				"h1" => "h1",
				"h2" => "h2",
				"h3" => "h3",
				"h4" => "h4",
				"h5" => "h5",
				"h6" => "h6",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Blockquote style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"Border" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Call to Action.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Call to Action", 'the7mk2'),
	"base" => "dt_call_to_action",
	"icon" => "dt_vc_ico_call_to_action",
	"class" => "dt_vc_sc_call_to_action",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for CALL TO ACTION. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big",
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Outline" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Decorative line on the left", 'the7mk2'),
			"param_name" => "line",
			"value" => array(
				"Disable" => "false",
				"Enable" => "true"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Default" => "0",
				"On the right" => "1"
			),
			"description" => __( "Use [dt_button] to insert a button. Default: button keeps alignment from content editor. On the right: button is aligned to the right.", 'the7mk2' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Teaser.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Teaser", 'the7mk2'),
	"base" => "dt_teaser",
	"icon" => "dt_vc_ico_teaser",
	"class" => "dt_vc_sc_teaser",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image",
				"Video from url" => "video"
			),
			"description" => ""
		),

		//////////////////////
		// uploaded image //
		//////////////////////

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// image from url //
		//////////////////////

		// image url
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image width
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image WIDTH", 'the7mk2'),
			"param_name" => "image_width",
			"value" => "",
			"description" => __("image width in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image height
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image HEIGHT", 'the7mk2'),
			"param_name" => "image_height",
			"value" => "",
			"description" => __("image height in px", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),

		// image alt
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// misc link
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Misc link", 'the7mk2'),
			"param_name" => "misc_link",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// target
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Target link", 'the7mk2'),
			"param_name" => "target",
			"value" => array(
				"Blank" => "blank",
				"Self" => "self"
			),
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		// open in lightbox
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", 'the7mk2'),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image",
					"uploaded_image"
				)
			)
		),

		//////////////////////
		// video from url //
		//////////////////////

		// video url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"video"
				)
			)
		),

		// content
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("I am test text for TEASER. Click edit button to change this text.", 'the7mk2'),
			"description" => ""
		),

		// media style
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Media style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Full-width" => "1",
				"With paddings" => "2"
			),
			"description" => ""
		),

		// image hoovers
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"std" => "true",
			"value" => array(
				"Disabled" => "false",
				"Enabled" => "true"
			)
		),

		// font size
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "content_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),

		// background
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "background",
			"value" => array(
				"None" => "no",
				"Outline" => "plain",
				"Background" => "fancy"
			),
			"description" => ""
		),

		// animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Banner.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Banner", 'the7mk2'),
	"base" => "dt_banner",
	"icon" => "dt_vc_ico_banner",
	"class" => "dt_vc_sc_banner",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded image" => "uploaded_image",
				"Image from url" => "image"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Background image", 'the7mk2'),
			"param_name" => "bg_image",
			"description" => __("Image URL.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"image"
				)
			)
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<p>I am test text for BANNER. Click edit button to change this text.</p>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"admin_label" => true,
			"heading" => __("Banner link", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			),
			"description" => "",
			"dependency" => array(
				"element" => "link",
				"not_empty" => true
			)
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Background color", 'the7mk2'),
			"param_name" => "bg_color",
			"value" => "rgba(0,0,0,0.4)",
			"description" => ""
		),
		array(
			"type" => "colorpicker",
			"class" => "",
			"heading" => __("Border color", 'the7mk2'),
			"param_name" => "text_color",
			"value" => "#ffffff",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Font size", 'the7mk2'),
			"param_name" => "text_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "normal",
				"Large" => "big"
			),
			"std" => "big",
			"description" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Border width", 'the7mk2'),
			"param_name" => "border_width",
			"value" => "3",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Outer padding", 'the7mk2'),
			"param_name" => "outer_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Inner padding", 'the7mk2'),
			"param_name" => "inner_padding",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Banner minimal height", 'the7mk2'),
			"param_name" => "min_height",
			"value" => "150",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		)
	)
) );

/**
 * DT Contact form.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Contact Form", 'the7mk2'),
	"base" => "dt_contact_form",
	"icon" => "dt_vc_ico_contact_form",
	"class" => "dt_vc_sc_contact_form",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Form fields", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "fields",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Message textarea height", 'the7mk2'),
			"param_name" => "message_height",
			"value" => "6",
			"description" => __("Number of lines.", 'the7mk2'),
		),
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Required fields", 'the7mk2'),
			//"admin_label" => true,
			"param_name" => "required",
			"value" => array(
				"name" => "name",
				"email" => "email",
				"telephone" => "telephone",
				"country" => "country",
				"city" => "city",
				"company" => "company",
				"website" => "website",
				"message" => "message"
			),
			"description" => __("Attention! At least one must be selected.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Submit button caption', 'the7mk2'),
			"param_name" => "button_title",
			"value" => "Send message",
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Submit button size", 'the7mk2'),
			"param_name" => "button_size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Big" => "big"
			),
			"description" => ""
		)
	)
) );

/**
 * DT Mini Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Mini", 'the7mk2'),
	"base" => "dt_blog_posts_small",
	"icon" => "dt_vc_ico_blog_posts_small",
	"class" => "dt_vc_sc_blog_posts_small",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2'),
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "6",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Layout", 'the7mk2'),
			"param_name" => "columns",
			"type" => "dropdown",
			"value" => array(
				"List" => "1",
				"2 columns" => "2",
				"3 columns" => "3"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Featured images", 'the7mk2'),
			"param_name" => "featured_images",
			"type" => "dropdown",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Images width", 'the7mk2'),
			"param_name" => "images_width",
			"type" => "textfield",
			"value" => "60",
			"description" => 'in px',
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Images height", 'the7mk2'),
			"param_name" => "images_height",
			"type" => "textfield",
			"value" => "60",
			"description" => 'in px',
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "round_images",
			"type" => "checkbox",
			"value" => array(
				"Enable rounded corners" => "true",
			),
			"dependency" => array(
				"element" => "featured_images",
				"value" => array( "true" )
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_excerpts",
			"type" => "checkbox",
			"value" => array(
				"Show excerpts" => "true",
			),
		),
	)
) );

/**
 * Blog list.
 */
vc_map( array(
	'weight' => -1,
	'name' => __( 'Blog list', 'the7mk2' ),
	'base' => 'dt_blog_list',
	'class' => 'dt_vc_sc_blog_list',
	'icon' => 'dt_vc_ico_blog_posts',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'params' => array(
		// General group.
		array(
			'heading' => __('Categories', 'the7mk2'),
			'param_name' => 'category',
			'type' => 'dt_taxonomy',
			'taxonomy' => 'category',
			'admin_label' => true,
			'description' => __('Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.', 'the7mk2'),
		),
		// - Layout Settings.
		array(
			'heading' => __( 'Layout Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Style', 'the7mk2'),
			'param_name' => 'layout',
			'type' => 'dropdown',
			'value' => array(
				'Classic' => 'classic',
				'Centered' => 'centered',
				'Bottom overlap' => 'bottom_overlap',
				'Side overlap' => 'side_overlap',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Classic style.
		array(
			'heading' => __('Image width', 'the7mk2'),
			'param_name' => 'cl_image_width',
			'type' => 'dt_number',
			'value' => '50%',
			'units' => '%',
			'max' => 100,
			'min' => 0,
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'classic',
			),
		),
		array(
			'heading' => __('Show dividers', 'the7mk2'),
			'param_name' => 'cl_dividers',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'classic',
			),
		),
		array(
			'heading'		=> __('Dividers color', 'the7mk2'),
			'param_name'	=> 'cl_dividers_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'layout',
				'value'		=> 'classic',
			),
			'description'   => __( 'Live empty to use default divider color.', 'the7mk2' ),
		),
		// -- Centered style.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'ce_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'centered',
			),
		),
		array(
			'heading' => __('Show dividers', 'the7mk2'),
			'param_name' => 'ce_dividers',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'centered',
			),
		),
		array(
			'heading'		=> __('Dividers color', 'the7mk2'),
			'param_name'	=> 'ce_dividers_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'layout',
				'value'		=> 'centered',
			),
			'description'   => __( 'Live empty to use default divider color.', 'the7mk2' ),
		),
		// -- Bottom overlap.
		array(
			'heading' => __('Content area width', 'the7mk2'),
			'param_name' => 'bo_content_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		array(
			'heading' => __('Content area top overlap', 'the7mk2'),
			'param_name' => 'bo_content_top_overlap',
			'type' => 'dt_number',
			'value' => '100px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'bottom_overlap',
			),
		),
		// -- Side overlap style.
		array(
			'heading' => __('Content alignment', 'the7mk2'),
			'param_name' => 'si_content_align',
			'type' => 'dropdown',
			'value' => array(
				'Checker' => 'checkerboard',
				'Text on the right' => 'list',
				'Text on the left' => 'right_list',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Image width', 'the7mk2'),
			'param_name' => 'si_image_width',
			'type' => 'dt_number',
			'value' => '75%',
			'units' => 'px, %',
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Content area side overlap', 'the7mk2'),
			'param_name' => 'si_content_side_overlap',
			'type' => 'dt_number',
			'value' => '150px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		array(
			'heading' => __('Content area top margin', 'the7mk2'),
			'param_name' => 'si_content_top_margin',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'layout',
				'value' => 'side_overlap',
			),
		),
		// - Content Area.
		array(
			'heading' => __( 'Content Area', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Show background', 'the7mk2'),
			'param_name' => 'content_bg',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
		),
		array(
			'heading'		=> __('Color', 'the7mk2'),
			'param_name'	=> 'custom_content_bg_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency'	=> array(
				'element'	=> 'content_bg',
				'value'		=> 'y',
			),
			'description'   => __( 'Live empty to use default content boxes color & decoration.', 'the7mk2' ),
		),
		array(
			'heading' => __('Content area paddings', 'the7mk2'),
			'param_name' => 'post_content_paddings',
			'type' => 'dt_spacing',
			'value' => '25px 30px 30px 30px',
			'units' => 'px',
		),
		array(
			'heading' => __('Gap below post', 'the7mk2'),
			'param_name' => 'gap_between_posts',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// - Image Settings.
		array(
			'heading' => __( 'Image Settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Image sizing', 'the7mk2'),
			'param_name' => 'image_sizing',
			'type' => 'dropdown',
			'std' => 'resize',
			'value' => array(
				'Preserve images proportions' => 'proportional',
				'Resize images' => 'resize',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		array(
			'headings' => array( __('Width', 'the7mk2'), __('Height', 'the7mk2') ),
			'param_name' => 'resized_image_dimensions',
			'type' => 'dt_dimensions',
			'value' => '3x2',
			'dependency' => array(
				'element' => 'image_sizing',
				'value' => 'resize',
			),
			'description' => __('Set image proportions, for example: 4x3, 3x2.', 'the7mk2'),
		),
		array(
			'heading' => __('Image paddings', 'the7mk2'),
			'param_name' => 'image_paddings',
			'type' => 'dt_spacing',
			'value' => '0px 0px 0px 0px',
			'units' => 'px, %',
		),
		array(
			'heading' => __('Enable scale animation on hover', 'the7mk2'),
			'param_name' => 'image_scale_animation_on_hover',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
		),
		// - Responsiveness.
		array(
			'heading' => __( 'Responsiveness', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Switch to mobile layout if browser width is less then', 'the7mk2'),
			'param_name' => 'mobile_switch_width',
			'type' => 'dt_number',
			'value' => '768px',
			'units' => 'px',
		),
		// - Pagination.
		array(
			'heading' => __( 'Pagination', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
		),
		array(
			'heading' => __('Pagination mode', 'the7mk2'),
			'param_name' => 'loading_mode',
			'type' => 'dropdown',
			'std' => 'disabled',
			'value' => array(
				'Disabled' => 'disabled',
				'Standard' => 'standard',
				'JavaScript pages' => 'js_pagination',
				'"Load more" button' => 'js_more',
				'Infinite scroll' => 'js_lazy_loading',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
		),
		// -- Disabled.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'dis_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'disabled',
			),
			'description' => __('Live empty to display all posts.', 'the7mk2'),
		),
		// -- Standard.
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'st_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
			'description' => __('Live empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Show all pages in paginator', 'the7mk2'),
			'param_name' => 'st_show_all_pages',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'st_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'standard',
			),
			'description' => __('Live empty to use default gap', 'the7mk2'),
		),
		// -- JavaScript pages.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsp_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Live empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsp_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Live empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Show all pages in paginator', 'the7mk2'),
			'param_name' => 'jsp_show_all_pages',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'jsp_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_pagination',
			),
			'description' => __('Live empty to use default gap', 'the7mk2'),
		),
		// -- js Load more.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsm_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Live empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsm_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Live empty to use number from wp settings.', 'the7mk2'),
		),
		array(
			'heading' => __('Gap before pagination', 'the7mk2'),
			'param_name' => 'jsm_gap_before_pagination',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_more',
			),
			'description' => __('Live empty to use default gap', 'the7mk2'),
		),
		// -- js Infinite scroll.
		array(
			'heading' => __('Total number of posts', 'the7mk2'),
			'param_name' => 'jsl_posts_total',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_lazy_loading',
			),
			'description' => __('Live empty to display all posts.', 'the7mk2'),
		),
		array(
			'heading' => __('Number of posts to display on one page', 'the7mk2'),
			'param_name' => 'jsl_posts_per_page',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'loading_mode',
				'value'	=> 'js_lazy_loading',
			),
			'description' => __('Live empty to use number from wp settings.', 'the7mk2'),
		),
		// Post group.
		// - Post Title.
		array(
			'heading' => __( 'Post Title', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'post_title_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'post_title_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Live empty to use H3 font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'post_title_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Live empty to use H3 line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_title_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Live empty to use headers color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below title', 'the7mk2'),
			'param_name' => 'post_title_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Meta Information.
		array(
			'heading' => __( 'Meta Information', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post date', 'the7mk2'),
			'param_name' => 'post_date',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post categories', 'the7mk2'),
			'param_name' => 'post_category',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post author', 'the7mk2'),
			'param_name' => 'post_author',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Show post comments', 'the7mk2'),
			'param_name' => 'post_comments',
			'type' => 'dt_switch',
			'value' => 'y',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'meta_info_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'meta_info_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Live empty to use small font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'meta_info_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'description' => __( 'Live empty to use small line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_meta_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'description' => __( 'Live empty to use secondary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below meta info', 'the7mk2'),
			'param_name' => 'meta_info_bottom_margin',
			'type' => 'dt_number',
			'value' => '15px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - Text.
		array(
			'heading' => __( 'Text', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Post content or excerpt', 'the7mk2'),
			'param_name' => 'post_content',
			'type' => 'dropdown',
			'std' => 'show_excerpt',
			'value' => array(
				'Off' => 'off',
				'Excerpt' => 'show_excerpt',
				'Post content' => 'show_content',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Excerpt maximum number of words', 'the7mk2'),
			'param_name' => 'excerpt_words_limit',
			'type' => 'dt_number',
			'value' => '',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => 'show_excerpt',
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Font style', 'the7mk2' ),
			'param_name' => 'content_font_style',
			'type' => 'dt_font_style',
			'value' => '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Font size', 'the7mk2'),
			'param_name' => 'content_font_size',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Live empty to use large font size.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Line height', 'the7mk2'),
			'param_name' => 'content_line_height',
			'type' => 'dt_number',
			'value' => '',
			'units' => 'px',
			'edit_field_class' => 'vc_col-sm-3 vc_column',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Live empty to use large line height.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading'		=> __('Font color', 'the7mk2'),
			'param_name'	=> 'custom_content_color',
			'type'			=> 'colorpicker',
			'value'			=> '',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'description' => __( 'Live empty to use primary text color.', 'the7mk2' ),
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Gap below text', 'the7mk2'),
			'param_name' => 'content_bottom_margin',
			'type' => 'dt_number',
			'value' => '5px',
			'units' => 'px',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'post_content',
				'value' => array( 'show_excerpt', 'show_content' ),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// - "Read More" Button.
		array(
			'heading' => __( '"Read More" Button', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('"Read more" button', 'the7mk2'),
			'param_name' => 'read_more_button',
			'type' => 'dropdown',
			'std' => 'default_link',
			'value' => array(
				'Off' => 'off',
				'Default link' => 'default_link',
				'Default button' => 'default_button',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'Post', 'the7mk2' ),
		),
		array(
			'heading' => __('Button text', 'the7mk2'),
			'param_name' => 'read_more_button_text',
			'type' => 'textfield',
			'value' => 'Read more',
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'dependency' => array(
				'element' => 'read_more_button',
				'value'	=> array(
					'default_link',
					'default_button',
				),
			),
			'group' => __( 'Post', 'the7mk2' ),
		),
		// Fancy Elements group.
		// - Fancy Date.
		array(
			'heading' => __( 'Fancy Date', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show Fancy date', 'the7mk2'),
			'param_name' => 'fancy_date',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_date_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Live empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_date_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Live empty to use predefined color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Line color', 'the7mk2'),
			'param_name' => 'fancy_date_line_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_date',
				'value'	=> 'y',
			),
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// - Fancy Categories.
		array(
			'heading' => __( 'Fancy Categories', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Show fancy categories', 'the7mk2'),
			'param_name' => 'fancy_categories',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'fancy_categories_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Live empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		array(
			'heading' => __('Background color', 'the7mk2'),
			'param_name' => 'fancy_categories_bg_color',
			'type' => 'colorpicker',
			'value' => '',
			'dependency' => array(
				'element' => 'fancy_categories',
				'value'	=> 'y',
			),
			'description' => __( 'Live empty to use predefined color or category color indication.', 'the7mk2' ),
			'group' => __( 'Fancy Elements', 'the7mk2' ),
		),
		// List group.
		array(
			'heading' => __( 'Caterogiazation & Ordering settings', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'value' => '',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order', 'the7mk2'),
			'param_name' => 'order',
			'type' => 'dropdown',
			'std' => 'desc',
			'value' => array(
				'Ascending' => 'asc',
				'Descending' => 'desc',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Order by', 'the7mk2'),
			'param_name' => 'orderby',
			'type' => 'dropdown',
			'value' => array(
				'Date' => 'date',
				'Name' => 'title',
			),
			'edit_field_class' => 'vc_col-xs-12 vc_column dt_row-6',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show categories filter', 'the7mk2'),
			'param_name' => 'show_categories_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show name / date ordering', 'the7mk2'),
			'param_name' => 'show_orderby_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Show asc. / desc. ordering', 'the7mk2'),
			'param_name' => 'show_order_filter',
			'type' => 'dt_switch',
			'value' => 'n',
			'options' => array(
				'Yes' => 'y',
				'No' => 'n',
			),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Gap below categorization & ordering', 'the7mk2' ),
			'param_name' => 'gap_below_category_filter',
			'type' => 'dt_number',
			'value' => '50px',
			'units' => 'px',
			'description' => __('Live empty to use default gap', 'the7mk2'),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __( 'Categorization, ordering & pagination colors', 'the7mk2' ),
			'param_name' => 'dt_title',
			'type' => 'dt_title',
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Font color', 'the7mk2'),
			'param_name' => 'navigation_font_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Live empty to use headers color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
		array(
			'heading' => __('Accent color', 'the7mk2'),
			'param_name' => 'navigation_accent_color',
			'type' => 'colorpicker',
			'value' => '',
			'description' => __( 'Live empty to use accent color.', 'the7mk2' ),
			'group' => __( 'List', 'the7mk2' ),
		),
	),
) );

/**
 * DT Blog.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Masonry & Grid", 'the7mk2'),
	"base" => "dt_blog_posts",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2')
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "12",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Posts per page", 'the7mk2'),
			"param_name" => "posts_per_page",
			"type" => "textfield",
			"value" => "-1",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand",
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
		    "edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc",
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
		    "edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __( "Posts Filter", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"param_name" => "show_filter",
			"type" => "checkbox",
			"value" => array(
				"Show categories filter" => "true",
			),
		),
		array(
			"param_name" => "show_orderby",
			"type" => "checkbox",
			"value" => array(
				"Show name / date ordering" => "true",
			),
		),
		array(
			"param_name" => "show_order",
			"type" => "checkbox",
			"value" => array(
				"Show asc. / desc. ordering" => "true",
			),
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Appearance", 'the7mk2'),
			"param_name" => "type",
			"type" => "dropdown",
			"value" => array(
				"Masonry" => "masonry",
				"Grid" => "grid",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Loading effect", 'the7mk2'),
			"param_name" => "loading_effect",
			"type" => "dropdown",
			"value" => array(
				'None' => 'none',
				'Fade in' => 'fade_in',
				'Move up' => 'move_up',
				'Scale up' => 'scale_up',
				'Fall perspective' => 'fall_perspective',
				'Fly' => 'fly',
				'Flip' => 'flip',
				'Helix' => 'helix',
				'Scale' => 'scale'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Posts width", 'the7mk2'),
			"param_name" => "same_width",
			"type" => "dropdown",
			"value" => array(
				"Preserve original width" => "false",
				"Make posts same width" => "true",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Gap between posts (px)", 'the7mk2'),
			"param_name" => "padding",
			"type" => "textfield",
			"value" => "20",
			"description" => __("Post paddings (e.g. 5 pixel padding will give you 10 pixel gaps between posts)", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image proportions", 'the7mk2'),
			"param_name" => "proportion",
			"type" => "textfield",
			"value" => "",
			"description" => __("Width:height (e.g. 16:9). Leave this field empty to preserve original image proportions.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image & background style", 'the7mk2'),
			"param_name" => "background",
			"type" => "dropdown",
			"value" => array(
				"No background" => "disabled",
				"Fullwidth image" => "fullwidth",
				"Image with paddings" => "with_paddings"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_excerpts",
			"type" => "checkbox",
			"value" => array(
				"Show excerpts" => "true",
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "show_read_more_button",
			"type" => "checkbox",
			"value" => array(
				'Show "Read more" buttons' => "true",
			),
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"param_name" => "fancy_date",
			"type" => "checkbox",
			"value" => array(
				"Fancy date" => "true",
			),
		),
		// Elements group.
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_categories",
			"type" => "checkbox",
			"value" => array(
				"Show post categories" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_date",
			"type" => "checkbox",
			"value" => array(
				"Show post date" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_author",
			"type" => "checkbox",
			"value" => array(
				"Show post author" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_post_comments",
			"type" => "checkbox",
			"value" => array(
				"Show post comments" => "true",
			),
		),
		// Responsiveness group.
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Responsiveness", 'the7mk2'),
			"param_name" => "responsiveness",
			"type" => "dropdown",
			"value" => array(
				"Post width based" => "post_width_based",
				"Browser width based" => "browser_width_based",
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Column minimum width (px)", 'the7mk2'),
			"param_name" => "column_width",
			"type" => "textfield",
			"value" => "370",
			"edit_field_class" => "vc_col-sm-6 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"post_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Desired columns number", 'the7mk2'),
			"param_name" => "columns_number",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-6 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"post_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Desktop", 'the7mk2'),
			"param_name" => "columns_on_desk",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Horizontal Tablet", 'the7mk2'),
			"param_name" => "columns_on_htabs",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Vertical Tablet", 'the7mk2'),
			"param_name" => "columns_on_vtabs",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
		array(
			"group" => __("Responsiveness", 'the7mk2'),
			"heading" => __("Columns on Mobile Phone", 'the7mk2'),
			"param_name" => "columns_on_mobile",
			"type" => "textfield",
			"value" => "3",
			"edit_field_class" => "vc_col-sm-3 vc_column",
			"dependency" => array(
				"element" => "responsiveness",
				"value" => array(
					"browser_width_based",
				),
			),
		),
	)
) );

/**
 * DT Blog Scroller.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Blog Scroller", 'the7mk2'),
	"base" => "dt_blog_scroller",
	"icon" => "dt_vc_ico_blog_posts",
	"class" => "dt_vc_sc_blog_posts",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		// General group.
		array(
			"heading" => __("Categories", 'the7mk2'),
			"param_name" => "category",
			"type" => "dt_taxonomy",
			"taxonomy" => "category",
			"admin_label" => true,
			"description" => __("Note: By default, all your posts will be displayed. <br>If you want to narrow output, select category(s) above. Only selected categories will be displayed.", 'the7mk2'),
		),
		array(
			"heading" => __( "Posts Number & Order", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"heading" => __("Number of posts to show", 'the7mk2'),
			"param_name" => "number",
			"type" => "textfield",
			"value" => "12",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"heading" => __("Order by", 'the7mk2'),
			"param_name" => "orderby",
			"type" => "dropdown",
			"value" => array(
				"Date" => "date",
				"Author" => "author",
				"Title" => "title",
				"Slug" => "name",
				"Date modified" => "modified",
				"ID" => "id",
				"Random" => "rand"
			),
			"description" => __("Select how to sort retrieved posts.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"heading" => __("Order way", 'the7mk2'),
			"param_name" => "order",
			"type" => "dropdown",
			"value" => array(
				"Descending" => "desc",
				"Ascending" => "asc"
			),
			"description" => __("Designates the ascending or descending order.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		// Appearance group.
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Gap between images (px)", 'the7mk2'),
			"param_name" => "padding",
			"type" => "textfield",
			"value" => "20",
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails width", 'the7mk2'),
			"param_name" => "width",
			"type" => "textfield",
			"value" => "",
			"description" => __("In pixels. Leave this field empty if you want to preserve original thumbnails proportions.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails height", 'the7mk2'),
			"param_name" => "height",
			"type" => "textfield",
			"value" => "210",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Thumbnails max width", 'the7mk2'),
			"param_name" => "max_width",
			"type" => "textfield",
			"value" => "",
			"description" => __("In percents.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __( "Post Design & Elements", 'the7mk2' ),
			"param_name" => "dt_title",
			"type" => "dt_title",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Content alignment", 'the7mk2'),
			"param_name" => "content_aligment",
			"type" => "dropdown",
			"value" => array(
				'Left' => 'left',
				'Centre' => 'center'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Image hover background color", 'the7mk2'),
			"param_name" => "hover_bg_color",
			"type" => "dropdown",
			"value" => array(
				'Color (from Theme Options)' => 'accent',
				'Dark' => 'dark'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"heading" => __("Background under projects", 'the7mk2'),
			"type" => "dropdown",
			"param_name" => "bg_under_posts",
			"value" => array(
				'Enabled (image with paddings)' => 'with_paddings',
				'Enabled (image without paddings)' => 'fullwidth',
				'Disabled' => 'disabled'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Appearance", 'the7mk2'),
			"type" => "checkbox",
			"param_name" => "show_excerpt",
			"value" => array(
				"Show excerpt" => "true",
			),
		),
		// Elements group.
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_categories",
			"type" => "checkbox",
			"value" => array(
				"Show post categories" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_date",
			"type" => "checkbox",
			"value" => array(
				"Show post date" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_author",
			"type" => "checkbox",
			"value" => array(
				"Show post author" => "true",
			),
		),
		array(
			"group" => __("Post Meta", 'the7mk2'),
			"param_name" => "show_comments",
			"type" => "checkbox",
			"value" => array(
				"Show post comments" => "true",
			),
		),
	    // Slideshow group.
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Arrows", 'the7mk2'),
			"param_name" => "arrows",
			"type" => "dropdown",
			"value" => array(
				'light' => 'light',
				'dark' => 'dark',
				'rectangular accent' => 'rectangular_accent',
				'disabled' => 'disabled'
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Show arrows on mobile device", 'the7mk2'),
			"param_name" => "arrows_on_mobile",
			"type" => "dropdown",
			"value" => array(
				"Yes" => "on",
				"No" => "off",
			),
			"dependency" => array(
				"element" => "arrows",
				"value" => array(
					'light',
					'dark',
					'rectangular_accent',
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt_row-6",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => __("Autoslide interval (in milliseconds)", 'the7mk2'),
			"param_name" => "autoslide",
			"type" => "textfield",
			"value" => "",
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
		array(
			"group" => __("Slideshow", 'the7mk2'),
			"heading" => '&nbsp;',
			"param_name" => "loop",
			"type" => "checkbox",
			"value" => array(
				"Loop" => "true",
			),
			"edit_field_class" => "vc_col-sm-6 vc_column",
		),
	)
) );

/**
 * DT Gap.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Gap", 'the7mk2'),
	"base" => "dt_gap",
	"deprecated" => '4.6',
	"icon" => "dt_vc_ico_gap",
	"class" => "dt_vc_sc_gap",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Gap height", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "height",
			"value" => "10",
			"description" => __("In pixels.", 'the7mk2')
		)
	)
) );

/**
 * DT Fancy Media.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy Media", 'the7mk2'),
	"base" => "dt_fancy_image",
	"icon" => "dt_vc_ico_fancy_image",
	"class" => "dt_vc_sc_fancy_image",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'the7mk2'),
			"param_name" => "type",
			"value" => array(
				"Uploaded media" => "uploaded_image",
				"Media from url" => "from_url"
			),
			"description" => ""
		),
		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose image", 'the7mk2'),
			"param_name" => "image_id",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image URL", 'the7mk2'),
			"param_name" => "image",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image size", 'the7mk2'),
			"description" => __("Enter image size in pixels. Example: 200x100 (Width x Height).", 'the7mk2'),
			"param_name" => "image_dimensions",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "dt_image",
			"heading" => __("Image ALT", 'the7mk2'),
			"param_name" => "image_alt",
			"value" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "video" and "video_in_lightbox"
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Video URL", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "media",
			"value" => "",
			"description" => "",
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"from_url"
				)
			)
		),
		//Only for "image"
		array(
			"type" => "checkbox",
			"class" => "",
			"heading" => __("Open in lighbox", 'the7mk2'),
			"param_name" => "lightbox",
			"value" => array(
				"" => "true"
			),
			"description" => __("If selected, larger image will be opened on click.", 'the7mk2')
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Image hovers", 'the7mk2'),
			"param_name" => "image_hovers",
			"std" => "true",
			"value" => array(
				"Disabled" => "false",
				"Enabled" => "true"
			),
			"dependency" => array(
				"element" => "lightbox",
				"value" => array(
					"true"
				)
			)
		),

		array(
			"type" => "dropdown",
			"heading" => __("Style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Full-width media" => "1",
				"Media with padding & outline" => "2",
				"Media with padding & background fill" => "3"
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Width", 'the7mk2'),
			"param_name" => "width",
			"value" => "270",
			"description" => __("In pixels.", 'the7mk2')
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Height", 'the7mk2'),
			"param_name" => "height",
			"value" => "",
			"description" => __("In pixels. Will be calculated automatically if empty.", 'the7mk2'),
			"dependency" => array(
				"element" => "type",
				"value" => array(
					"uploaded_image"
				),
			)
		),
		array(
			"type" => "textfield",
			"heading" => __("Padding", 'the7mk2'),
			"param_name" => "padding",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"dependency" => array(
				"element" => "style",
				"value" => array(
					"2",
					"3"
				),
			),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-top", 'the7mk2'),
			"param_name" => "margin_top",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-bottom", 'the7mk2'),
			"param_name" => "margin_bottom",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-left", 'the7mk2'),
			"param_name" => "margin_left",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "textfield",
			"heading" => __("Margin-right", 'the7mk2'),
			"param_name" => "margin_right",
			"value" => "",
			"description" => __("In pixels.", 'the7mk2'),
			"edit_field_class" => "vc_col-xs-12 vc_column dt-force-hidden",
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Align", 'the7mk2'),
			"param_name" => "align",
			"value" => array(
				"Left" => "left",
				"Center" => "center",
				"Right" => "right"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options(),
			"description" => ""
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'the7mk2' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'the7mk2' )
		),
	)
) );

/**
 * DT Button.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Button", 'the7mk2'),
	"base" => "dt_button",
	"icon" => "dt_vc_ico_button",
	"class" => "dt_vc_sc_button",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(

		// Extra class name
		array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'the7mk2'),
			"param_name" => "el_class",
			"value" => "",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'the7mk2')
		),

		// Caption
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"admin_label" => true,
			"param_name" => "content",
			"value" => ""
		),

		// Link Url
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Link URL", 'the7mk2'),
			"param_name" => "link",
			"value" => ""
		),

		// Open link in
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Open link in", 'the7mk2'),
			"param_name" => "target_blank",
			"value" => array(
				"Same window" => "false",
				"New window" => "true"
			)
		),

		// Smooth scroll
		array(
			'type' => 'checkbox',
			'heading' => __( 'Smooth scroll?', 'the7mk2' ),
			'param_name' => 'smooth_scroll',
			'description' => __( 'for #anchor navigation', 'the7mk2' )
		),

		// Align
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button alignment", 'the7mk2'),
			"param_name" => "button_alignment",
			"value" => array(
				"Default" => "default",
				"Centre" => "center",
			),
		),

		// Animation
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Animation", 'the7mk2'),
			"param_name" => "animation",
			"value" => presscore_get_vc_animation_options()
		),

		// Size
		array(
			"group" => __("Style", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Size", 'the7mk2'),
			"param_name" => "size",
			"value" => array(
				"Small" => "small",
				"Medium" => "medium",
				"Large" => "big"
			),
		),

		// Style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Style", 'the7mk2'),
			"param_name"	=> "style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Link"										=> "link",
				"Light"										=> "light",
				"Light with background on hover"			=> "light_with_bg",
				"Outline"									=> "outline",
				"Outline with background on hover"			=> "outline_with_bg",
			)
		),

		// Button background color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) color", 'the7mk2'),
			"param_name"	=> "bg_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'outline',
					'outline_with_bg'
				)
			),
		),

		// Button background color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background color", 'the7mk2'),
			"param_name"	=> "bg_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button hover background color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Background (border) hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			),
			"dependency"	=> array(
				"element"	=> "style",
				"value"		=> array(
					'default',
					'light_with_bg',
					'outline',
					'outline_with_bg'
				)
			),
		),

		// Button hover background color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom background hover color", 'the7mk2'),
			"param_name"	=> "bg_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "bg_hover_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button text color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text color", 'the7mk2'),
			"param_name"	=> "text_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Title"										=> "context",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			)
		),

		// Button text color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text color", 'the7mk2'),
			"param_name"	=> "text_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Button hover text color style
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "dropdown",
			"class"			=> "",
			"heading"		=> __("Text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color_style",
			"value"			=> array(
				"Default (from Theme Options / Buttons)"	=> "default",
				"Title"										=> "context",
				"Accent"									=> "accent",
				"Custom"									=> "custom"
			)
		),

		// Button hover text color
		array(
			"group"			=> __("Style", 'the7mk2'),
			"type"			=> "colorpicker",
			"class"			=> "",
			"heading"		=> __("Custom text hover color", 'the7mk2'),
			"param_name"	=> "text_hover_color",
			"value"			=> '#888888',
			"dependency"	=> array(
				"element"	=> "text_hover_color_style",
				"value"		=> array( "custom" )
			),
		),

		// Icon
		array(
			"group" => __("Icon", 'the7mk2'),
			"type" => "textarea_raw_html",
			"class" => "",
			"heading" => __("Icon", 'the7mk2'),
			"param_name" => "icon",
			"value" => '',
			"description" => __('f.e. <code>&lt;i class="fa fa-coffee"&gt;&lt;/i&gt;</code>', 'the7mk2'),
		),

		// Icon align
		array(
			"group" => __("Icon", 'the7mk2'),
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon align", 'the7mk2'),
			"param_name" => "icon_align",
			"value" => array(
				"Left" => "left",
				"Right" => "right"
			)
		),
	)
) );

/**
 * DT Fancy List.
 */

vc_map( array(
	"weight" => -1,
	"name" => __("Fancy List", 'the7mk2'),
	"base" => "dt_vc_list",
	"icon" => "dt_vc_ico_list",
	"class" => "dt_vc_sc_list",
	"category" => __('by Dream-Theme', 'the7mk2'),
	"params" => array(
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Caption", 'the7mk2'),
			"param_name" => "content",
			"value" => __("<ul><li>Your list</li><li>goes</li><li>here!</li></ul>", 'the7mk2'),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("List style", 'the7mk2'),
			"param_name" => "style",
			"value" => array(
				"Unordered" => "1",
				"Ordered (numbers)" => "2",
				"No bullets" => "3"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bullet position", 'the7mk2'),
			"param_name" => "bullet_position",
			"value" => array(
				"Top" => "top",
				"Middle" => "middle"
			),
			"description" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Dividers", 'the7mk2'),
			"param_name" => "dividers",
			"value" => array(
				"Show" => "true",
				"Hide" => "false"
			),
			"description" => ""
		)
	)
) );

/**
 * DT Before / After.
 */

vc_map( array(
	"weight" => -1,
	'name' => __( 'Before / After', 'the7mk2' ),
	'base' => 'dt_before_after',
	'class' => 'dt_vc_sc_before_after',
	'icon' => 'dt_vc_ico_before_after',
	'category' => __( 'by Dream-Theme', 'the7mk2' ),
	'description' => "",
	'params' => array(

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose first image", 'the7mk2'),
			"param_name" => "image_1",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "attach_image",
			"holder" => "img",
			"class" => "dt_image",
			"heading" => __("Choose second image", 'the7mk2'),
			"param_name" => "image_2",
			"value" => "",
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Orientation", 'the7mk2'),
			"param_name" => "orientation",
			"value" => array(
				"Vertical" => "horizontal",
				"Horizontal" => "vertical"
			),
			"description" => ""
		),

		array(
			"type" => "dropdown",
			"class" => "",
			"holder" => "div",
			"heading" => __("Navigation", 'the7mk2'),
			"param_name" => "navigation",
			"value" => array(
				"Click and drag" => "drag",
				"Follow" => "move"
			),
			"description" => ""
		),

		array(
			'type' => 'textfield',
			"holder" => "div",
			'heading' => __( 'Visible part of the "Before" image (in %)', 'the7mk2' ),
			'param_name' => 'offset',
			'std' => '50',
			'description' => "",
		),

	)
) );