<?php

if ( function_exists( 'vc_map' ) ) {
	
	
/*vc_map( array(
'name' => 'One Half Column',
'base' => 'one_half',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'One Third Column',
'base' => 'one_third',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'One Fourth Column',
'base' => 'one_fourth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'One Fifth Column',
'base' => 'one_fifth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'One Sixth Column',
'base' => 'one_sixth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Two Third Column',
'base' => 'two_third',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Two Fifth Column',
'base' => 'two_fifth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Three Fourth Column',
'base' => 'three_fourth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Three Fifth Column',
'base' => 'three_fifth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Four Fifth Column',
'base' => 'four_fifth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );

vc_map( array(
'name' => 'Five Sixth Column',
'base' => 'five_sixth',
'icon' => 'icon-vc-clapat-berger',
'is_container' => 'true',
'category' => __('Berger - Columns', THEME_LANGUAGE_DOMAIN),
'description' => __('Column', THEME_LANGUAGE_DOMAIN),
'params' => array(
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Last Column?', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'last',
'value' => array( 'no', 'yes', ),
),
array(
'type' => 'dropdown',
'holder' => 'div',
'heading' => __('Text Alignment', THEME_LANGUAGE_DOMAIN),
'description' => '',
'param_name' => 'text_align',
'value' => array( 'text-align-left', 'text-align-center', 'text-align-right', ),
),
array(
'type' => 'textarea_html',
'holder' => 'div',
'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
'param_name' => 'content',
'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
),
)
) );*/

vc_map( array(
	'name' => 'Title',
	'base' => 'title',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Typo Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Title', THEME_LANGUAGE_DOMAIN),
	'admin_enqueue_css' => array( get_template_directory_uri() . '/include/vc-extend.css' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Title Size', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'size',
			'value' => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', ),
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Has Underline?', THEME_LANGUAGE_DOMAIN),
			'description' => __('If the title is displayed underlined or without underline', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'underline',
			'value' => array( 'no', 'yes', ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Subtitle',
	'base' => 'subtitle',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Typo Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Subtitle', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Has Underline?', THEME_LANGUAGE_DOMAIN),
			'description' => __('If the title is displayed underlined or without underline', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'underline',
			'value' => array( 'no', 'yes', ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Line Divider',
	'base' => 'hr',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Typo Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Line Divider', THEME_LANGUAGE_DOMAIN),
	'params' => array(
	array(
		'type' => 'dropdown',
		'holder' => 'div',
		'heading' => __('Size', THEME_LANGUAGE_DOMAIN),
		'description' => '',
		'param_name' => 'size',
		'value' => array( 'normal', 'small', ),
	),
	)
) );

vc_map( array(
	'name' => 'Button',
	'base' => 'button',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Typo Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Button', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Button Link', THEME_LANGUAGE_DOMAIN),
			'description' => __('URL for the button', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'link',
			'value' => 'http://',
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Target Window', THEME_LANGUAGE_DOMAIN),
			'description' => __('Button link opens in a new or current window', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'target',
			'value' => array( '_blank', '_self', ),
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Button type', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'type',
			'value' => array( 'normal', 'outline', ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
		)
) );

vc_map( array(
	'name' => 'Space Between Buttons',
	'base' => 'space_between_buttons',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Typo Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Adds a space between two button shortcodes', THEME_LANGUAGE_DOMAIN),
	'show_settings_on_create' => false
) );



// Customize the default row to allow adding parallax sections
// parallax section flag
$attributes = array(
			'type' => 'checkbox',
			'heading' => __( 'Parallax section?', THEME_LANGUAGE_DOMAIN ),
			'param_name' => 'parallax_section',
			'description' => __( 'If selected, this row will act as a parallax section. You can set the background parallax image using Design Options tab.', THEME_LANGUAGE_DOMAIN ),
			'value' => Array(__("Yes", THEME_LANGUAGE_DOMAIN) => 'yes')
		);
vc_add_param( 'vc_row', $attributes );

// section id
$attributes = array(
					'type' => 'textfield',
					'holder' => 'div',
					'heading' => __('Parallax Section Id', THEME_LANGUAGE_DOMAIN),
					'description' => __( 'This is the id of the parallax section. If specified, it can be used to uniquely identify the section in the page as well as adding special styles to it.', THEME_LANGUAGE_DOMAIN ),
					'param_name' => 'parallax_id',
					"value" => ''
				);
vc_add_param( 'vc_row', $attributes );

// overlay color
$attributes = array(
					'type' => 'colorpicker',
					'holder' => 'div',
					'heading' => __('Parallax Image Overlay Color', THEME_LANGUAGE_DOMAIN),
					'description' => __('Overlay color of the parallax section.', THEME_LANGUAGE_DOMAIN),
					'param_name' => 'parallax_overlay_color',
					'value' => '',
				);
vc_add_param( 'vc_row', $attributes );

// overlay color opacity
$attributes = array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __('Parallax Image Overlay Color Opacity', THEME_LANGUAGE_DOMAIN),
				'description' => __('Overlay color opacity of the parallax section. Values from 0 (no opacity) to 1 (full opacity). Example: 0.6', THEME_LANGUAGE_DOMAIN),
				'param_name' => 'parallax_overlay_color_opacity',
				'value' => '',
				);
vc_add_param( 'vc_row', $attributes );

// padding top and bottom
$attributes = array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __('Parallax Section Padding Top', THEME_LANGUAGE_DOMAIN),
				'description' => __('Top padding of the section, in pixels.', THEME_LANGUAGE_DOMAIN),
				'param_name' => 'parallax_padding_top',
				'value' => '',
				);
vc_add_param( 'vc_row', $attributes );				
				
$attributes = array(
				'type' => 'textfield',
				'holder' => 'div',
				'heading' => __('Parallax Section Padding Bottom', THEME_LANGUAGE_DOMAIN),
				'description' => __('Bottom padding of the section, in pixels.', THEME_LANGUAGE_DOMAIN),
				'param_name' => 'parallax_padding_bottom',
				'value' => '',
				);
vc_add_param( 'vc_row', $attributes );


vc_map( array(
	'name' => 'Animated Div',
	'base' => 'animated_div',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Animated Div', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('FX effect', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'fx_effect',
			'value' => array( 'fade', 'fade-from-left', 'fade-from-right', 'fade-from-bottom', 'none', ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('FX speed', THEME_LANGUAGE_DOMAIN),
			'description' => __('FX animation speed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'fx_speed',
			'value' => '100',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Accordion',
	'base' => 'accordion',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'accordion_item'),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Accordion', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => false,
	"params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Placeholder Parameter", THEME_LANGUAGE_DOMAIN),
            "param_name" => "accordion_placeholder_param",
			"value" => "Accordion Container",
            "description" => __("This is a placeholder parameter of the accordion container. It has no role or effect. Visual Composer does not display shortcodes without parameters.", THEME_LANGUAGE_DOMAIN)
        )
    ),
	'js_view' => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_accordion extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Accordion Item',
	'base' => 'accordion_item',
	'icon' => 'icon-vc-clapat-berger',
	'as_child' => array('only' => 'accordion' ),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Accordion Item', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Title', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'title',
			'value' => 'Accordion Item Title',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_accordion_item extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Toggle',
	'base' => 'toggle',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Toggle', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Title', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Team Members',
	'base' => 'team',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'team_member'),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Team Members', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => false,
	"params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Placeholder Parameter", THEME_LANGUAGE_DOMAIN),
            "param_name" => "team_placeholder_param",
			"value" => "Team Members Container",
            "description" => __("This is a placeholder parameter of the team members container. It has no role or effect. Visual Composer does not display shortcodes without parameters.", THEME_LANGUAGE_DOMAIN)
        )
    ),
	'js_view' => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_team extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Team Member',
	'base' => 'team_member',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'as_child' => array('only' => 'team' ),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Team Member', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Team Member Name', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'name',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Job Title', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'heading' => __('Picture', THEME_LANGUAGE_DOMAIN),
			'description' => __('Team member\'s picture', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'picture_id',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Icon 1', THEME_LANGUAGE_DOMAIN),
			'description' => __('Social Icon. Type in the class of the icon in this edit box. The complete and latest list: http://fortawesome.github.io/Font-Awesome/icons/', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'social_icon1',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Link 1 URL', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'social_link1_url',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Icon 2', THEME_LANGUAGE_DOMAIN),
			'description' => __('Social Icon. Type in the class of the icon in this edit box. The complete and latest list: http://fortawesome.github.io/Font-Awesome/icons/', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'social_icon2',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Link 2 URL', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'social_link2_url',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Icon 3', THEME_LANGUAGE_DOMAIN),
			'description' => __('Social Icon. Type in the class of the icon in this edit box. The complete and latest list: http://fortawesome.github.io/Font-Awesome/icons/', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'social_icon3',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Social Link 3 URL', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'social_link3_url',
			'value' => '',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_team_member extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Alert Box',
	'base' => 'alert',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Alert Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Color', THEME_LANGUAGE_DOMAIN),
			'description' => __('Background color for the alert box', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'color',
			'value' => array( 'red', 'blue', 'yellow', 'green', ),
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Progress Bars',
	'base' => 'progress',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'progress_bar'),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Progress Bars', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => false,
	"params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Placeholder Parameter", THEME_LANGUAGE_DOMAIN),
            "param_name" => "progress_placeholder_param",
			"value" => "Progress Container",
            "description" => __("This is a placeholder parameter of the progress container. It has no role or effect. Visual Composer does not display shortcodes without parameters.", THEME_LANGUAGE_DOMAIN)
        )
    ),
	'js_view' => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_progress extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Progress Bar',
	'base' => 'progress_bar',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'as_child' => array('only' => 'progress' ),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Progress Bar', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Percentage', THEME_LANGUAGE_DOMAIN),
			'description' => __('Progress Bar Percentage', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'percentage',
			'value' => '100',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_progress_bar extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Pricing Table',
	'base' => 'pricing_table',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'pricing_row'),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Pricing Table', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => true,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Active', THEME_LANGUAGE_DOMAIN),
			'description' => __('If the pricing table is highlighted or not', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'active',
			'value' => array( 'no', 'yes', ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Icon', THEME_LANGUAGE_DOMAIN),
			'description' => __('Icon displayed at top of the price table', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'icon',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Title', THEME_LANGUAGE_DOMAIN),
			'description' => __('Pricing table title. Usually the name of the category of services being priced', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Price', THEME_LANGUAGE_DOMAIN),
			'description' => __('Price for the services being offered', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'price',
			'value' => '99.99',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Currency', THEME_LANGUAGE_DOMAIN),
			'description' => __('Pricing table title. Usually the name of the category of services being priced', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'currency',
			'value' => '$',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Time', THEME_LANGUAGE_DOMAIN),
			'description' => __('Period of time the price is applied for', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'time',
			'value' => 'per month',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Details URL', THEME_LANGUAGE_DOMAIN),
			'description' => __('Url offering more details about the service(s)', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'url',
			'value' => 'http://',
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Details URL target', THEME_LANGUAGE_DOMAIN),
			'description' => __('Target window for details URL', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'target',
			'value' => array( '_blank', '_self', ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Buy Now Caption', THEME_LANGUAGE_DOMAIN),
			'description' => __('Caption or slogan for the button displayed at the bottom of the pricing table', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'buy_now_text',
			'value' => 'Buy Now',
		),
	)
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_pricing_table extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Pricing Row',
	'base' => 'pricing_row',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'as_child' => array('only' => 'pricing_table' ),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Pricing Row', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Info about priced services here.', THEME_LANGUAGE_DOMAIN)
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_pricing_row extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Counters',
	'base' => 'counters',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'counter'),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Counters', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => false,
	"params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Placeholder Parameter", THEME_LANGUAGE_DOMAIN),
            "param_name" => "counter_placeholder_param",
			"value" => "Counters Container",
            "description" => __("This is a placeholder parameter of the counters container. It has no role or effect. Visual Composer does not display shortcodes without parameters.", THEME_LANGUAGE_DOMAIN)
        )
    ),
	'js_view' => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_counters extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Counter Box',
	'base' => 'counter',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'as_child' => array('only' => 'counters' ),'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Counter Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Counts', THEME_LANGUAGE_DOMAIN),
			'description' => __('Number of counts', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'counts',
			'value' => '100',
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Fade effect', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'fx_effect',
			'value' => array( 'fade', 'fade-from-left', 'fade-from-right', 'fade-from-bottom', 'none', ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('FX speed', THEME_LANGUAGE_DOMAIN),
			'description' => __('Fade effect animation speed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'fx_speed',
			'value' => '100',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_counter extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Radial Counter Box',
	'base' => 'radial_counter',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Radial Counter Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Counts', THEME_LANGUAGE_DOMAIN),
			'description' => __('Number of counts', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'counts',
			'value' => '100',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Title', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Big Quote',
	'base' => 'parallax_quote',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Parallax Quote', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Author', THEME_LANGUAGE_DOMAIN),
			'description' => __('Author of the quote', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'author',
			'value' => 'John Doe',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Icon Service',
	'base' => 'service',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Service Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Icon', THEME_LANGUAGE_DOMAIN),
			'description' => __('Icon displayed within service box. Type in the class of the icon in this edit box. The complete and latest list: http://fortawesome.github.io/Font-Awesome/icons/', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'icon',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Service Title', THEME_LANGUAGE_DOMAIN),
			'description' => __('Title of the service', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Big Icon Service',
	'base' => 'big_service',
	'icon' => 'icon-vc-clapat-berger',
	'is_container' => 'true',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Big Service Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Icon', THEME_LANGUAGE_DOMAIN),
			'description' => __('Icon displayed within service box', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'icon',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Service Title', THEME_LANGUAGE_DOMAIN),
			'description' => __('Title of the service', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'title',
			'value' => '',
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __('Content', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'content',
			'value' => __('Content goes here', THEME_LANGUAGE_DOMAIN),
		),
	)
) );

vc_map( array(
	'name' => 'Latest News',
	'base' => 'cpbg_latest_news',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('Displays the most recent three blog posts', THEME_LANGUAGE_DOMAIN),
	'show_settings_on_create' => false
) );

vc_map( array(
	'name' => 'FontAwesome Icon',
	'base' => 'fontawesome_icon',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Elements', THEME_LANGUAGE_DOMAIN),
	'description' => __('FontAwesome Icon', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Icon', THEME_LANGUAGE_DOMAIN),
			'description' => __('Type in the class of the icon in this edit box. The complete and latest list: http://fortawesome.github.io/Font-Awesome/icons/', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'icon',
			'value' => '',
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Size', THEME_LANGUAGE_DOMAIN),
			'description' => __('Icon size relative to their container. See http://fortawesome.github.io/Font-Awesome/examples/#larger for more information', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'size',
			'value' => array( 'none', 'lg', '2x', '3x', '4x', '5x', ),
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Color', THEME_LANGUAGE_DOMAIN),
			'description' => __('Icon color', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'color',
			'value' => '#000000',
		),
	)
) );

vc_map( array(
	'name' => 'Video Embed',
	'base' => 'video_embed',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Media', THEME_LANGUAGE_DOMAIN),
	'description' => __('Video Embed', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Embedded Video URL', THEME_LANGUAGE_DOMAIN),
			'description' => __('The embedded video url as found in Share - Embed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'video_url',
			'value' => 'http://',
		),
		array(
			'type' => 'dropdown',
			'holder' => 'div',
			'heading' => __('Video Type', THEME_LANGUAGE_DOMAIN),
			'description' => '',
			'param_name' => 'video_type',
			'value' => array( 'youtube', 'vimeo', ),
		),
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'heading' => __('Video Cover Image', THEME_LANGUAGE_DOMAIN),
			'description' => __('Cover image displayed on top of the video when the video it\'s stopped', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'cover_img_id',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Video Cover Image ALT', THEME_LANGUAGE_DOMAIN),
			'description' => __('The ALT attribute specifies an alternate text for an image, if the image cannot be displayed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'cover_img_alt',
			'value' => '',
		),
	)
) );

vc_map( array(
	'name' => 'Image Popup',
	'base' => 'image_popup',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Media', THEME_LANGUAGE_DOMAIN),
	'description' => __('Image Popup', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'heading' => __('Thumbnail Image', THEME_LANGUAGE_DOMAIN),
			'description' => __('Image thumbnail displayed in the page', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'thumb_img_id',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Thumbnail Image ALT', THEME_LANGUAGE_DOMAIN),
			'description' => __('The ALT attribute specifies an alternate text for an image, if the image cannot be displayed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'thumb_img_alt',
			'value' => '',
		),
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'heading' => __('Full Image', THEME_LANGUAGE_DOMAIN),
			'description' => __('Full image displayed in the pop-up', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'full_img_id',
			'value' => 'http://',
		),
	)
) );

vc_map( array(
	'name' => 'Normal Image Slider',
	'base' => 'general_slider',
	'icon' => 'icon-vc-clapat-berger',
	'as_parent' => array('only' => 'general_slide'),'category' => __('Berger - Sliders', THEME_LANGUAGE_DOMAIN),
	'description' => __('Normal Image Slider', THEME_LANGUAGE_DOMAIN),
	'content_element' => true,
	'show_settings_on_create' => false,
	"params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __("Placeholder Parameter", THEME_LANGUAGE_DOMAIN),
            "param_name" => "slider_placeholder_param",
			"value" => "Image Sliders Container",
            "description" => __("This is a placeholder parameter of the image sliders container. It has no role or effect. Visual Composer does not display shortcodes without parameters.", THEME_LANGUAGE_DOMAIN)
        )
    ),
	'js_view' => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {class WPBakeryShortCode_general_slider extends WPBakeryShortCodesContainer {}}

vc_map( array(
	'name' => 'Slide',
	'base' => 'general_slide',
	'icon' => 'icon-vc-clapat-berger',
	'as_child' => array('only' => 'general_slider' ),'category' => __('Berger - Sliders', THEME_LANGUAGE_DOMAIN),
	'description' => __('Slide', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'attach_image',
			'holder' => 'div',
			'heading' => __('Slider Image', THEME_LANGUAGE_DOMAIN),
			'description' => __('Image representing this slide', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'img_id',
			'value' => '',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Image ALT', THEME_LANGUAGE_DOMAIN),
			'description' => __('The ALT attribute specifies an alternate text for an image, if the image cannot be displayed', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'alt',
			'value' => '',
		),
	)
) );

if ( class_exists( 'WPBakeryShortCode' ) ) {class WPBakeryShortCode_general_slide extends WPBakeryShortCode {}}

vc_map( array(
	'name' => 'Twitter Parallax Box',
	'base' => 'parallax_twitter',
	'icon' => 'icon-vc-clapat-berger',
	'category' => __('Berger - Sliders', THEME_LANGUAGE_DOMAIN),
	'description' => __('Twitter Parallax Box', THEME_LANGUAGE_DOMAIN),
	'params' => array(
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Tweets Count', THEME_LANGUAGE_DOMAIN),
			'description' => __('Number of tweets to display', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'count',
			'value' => '5',
		),
		array(
			'type' => 'textfield',
			'holder' => 'div',
			'heading' => __('Twitter username', THEME_LANGUAGE_DOMAIN),
			'description' => __('Twitter account name', THEME_LANGUAGE_DOMAIN),
			'param_name' => 'username',
			'value' => '',
		),
	)
) );
		
				
}
?>