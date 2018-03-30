<?php

$mad_icons_arr = array(
	__( 'None', 'flatastic' ) => 'none',
	__( 'Pencil', 'flatastic' ) => 'fa-pencil',
	__( 'Shopping Cart', 'flatastic' ) => 'fa-shopping-cart',
	__( 'Info', 'flatastic' ) => 'fa-info-circle',
	__( 'Check', 'flatastic' ) => 'fa-check',
	__( 'Warning', 'flatastic' ) => 'fa-warning',
	__( 'Flash', 'flatastic' ) => 'fa-flash',
	__( 'Refresh', 'flatastic' ) => 'fa-refresh',
	__( 'Times', 'flatastic' ) => 'fa-times'
);

$mad_target_arr = array(
	__( 'Same window', 'flatastic' ) => '_self',
	__( 'New window', 'flatastic' ) => "_blank"
);

$mad_colors_arr = array(
	__( 'Default', 'flatastic' ) => 'btn-orange',
	__( 'Grey', 'flatastic' ) => 'btn-grey',
	__( 'Blue', 'flatastic' ) => 'btn-blue',
	__( 'Navy Blue', 'flatastic' ) => 'btn-navy-blue',
	__( 'Green', 'flatastic' ) => 'btn-green',
	__( 'Yellow', 'flatastic' ) => 'btn-yellow',
	__( 'Transparent', 'flatastic' ) => 'btn-transparent'
);

$mad_size_arr = array(
	__( 'Large', 'flatastic' ) => 'btn-large',
	__( 'Medium', 'flatastic' ) => 'btn-medium',
	__( 'Small', 'flatastic' ) => "btn-small",
	__( 'Mini', 'flatastic' ) => "btn-mini"
);

$mad_list_unordered_styles = array(
	__( 'Circle', 'flatastic' ) => 'vertical_list_type_2',
	__( 'Bordered Circle', 'flatastic' ) => 'vertical_list_type_3',
	__( 'Square', 'flatastic' ) => 'vertical_list_type_4',
	__( 'Check', 'flatastic' ) => 'vertical_list_type_5',
	__( 'Triangle', 'flatastic' ) => 'vertical_list_type_6',
	__( 'Star', 'flatastic' ) => 'vertical_list_type_7'
);

$mad_list_ordered_styles = array(
	__( 'Upper roman', 'flatastic' ) => 'upper-roman',
	__( 'Decimal', 'flatastic' ) => 'decimal',
	__( 'Upper latin', 'flatastic' ) => 'upper-latin',
	__( 'Bordered Square', 'flatastic' ) => 'bordered',
	__( 'Fill Square', 'flatastic' ) => 'fill'
);

$mad_add_css_animation = array(
	'type' => 'dropdown',
	'heading' => __( 'CSS Animation', 'flatastic' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		__( 'No', 'flatastic' ) => '',
		__( 'Top to bottom', 'flatastic' ) => 'top-to-bottom',
		__( 'Bottom to top', 'flatastic' ) => 'bottom-to-top',
		__( 'Left to right', 'flatastic' ) => 'left-to-right',
		__( 'Right to left', 'flatastic' ) => 'right-to-left',
		__( 'Appear from center', 'flatastic' ) => "appear",
		__( 'Fade', 'flatastic' ) => "fade"
	),
	'group' => __( 'Animations', 'flatastic' ),
	'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'flatastic' )
);

$mad_short_css_animation = array(
	'type' => 'dropdown',
	'heading' => __( 'CSS Animation', 'flatastic' ),
	'param_name' => 'css_animation',
	'admin_label' => true,
	'value' => array(
		__( 'No', 'flatastic' ) => '',
		__( 'Yes', 'flatastic' ) => 'yes'
	),
	'group' => __( 'Animations', 'flatastic' ),
	'description' => __( 'Select type of animation if you want this element to be animated when it enters into the browsers viewport. Note: Works only in modern browsers.', 'flatastic' )
);

/* Default Shortcodes
/* --------------------------------------------------------------------- */

/* Row
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Row', 'flatastic' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Place content elements inside the row', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Row stretch', 'flatastic' ),
			'param_name' => 'full_width',
			'value' => array(
				__('Default', 'flatastic') => '',
				__('Stretch row', 'flatastic') => 'stretch_row',
				__('Stretch row and content', 'flatastic') => 'stretch_row_content',
				__('Stretch row and content without spaces', 'flatastic') => 'stretch_row_content_no_spaces',
			),
			'description' => __( 'Select stretching options for row and content. Stretched row overlay sidebar and may not work if parent container has overflow: hidden css property.', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'flatastic' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'flatastic' ),
			'value' => array( __( 'Yes', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'flatastic' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Middle', 'flatastic' ) => 'middle',
				__( 'Top', 'flatastic' ) => 'top',
			),
			'description' => __( 'Select content position within row.', 'flatastic' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'flatastic' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'flatastic' ),
			'value' => array( __( 'Yes', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'flatastic' ),
			'param_name' => 'video_bg_url',
			'description' => __( 'Add YouTube link.', 'flatastic' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'flatastic' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'flatastic' ) => '',
				__( 'Simple', 'flatastic' ) => 'content-moving',
				__( 'With fade', 'flatastic' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'flatastic' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'flatastic' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'flatastic' ) => '',
				__( 'Simple', 'flatastic' ) => 'content-moving',
				__( 'With fade', 'flatastic' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'flatastic' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'flatastic' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'flatastic' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__( 'Disable row', 'flatastic' ),
			'param_name' => 'disable_element', // Inner param name.
			'description' => esc_html__( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'flatastic' ),
			'value' => array( esc_html__( 'Yes', 'flatastic' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'flatastic' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' ),
			'group' => __( 'Design options', 'flatastic' )
		)
	),
	'js_view' => 'VcRowView'
) );

/* Toggle 2
---------------------------------------------------------- */

//vc_map( array(
//	'name' => __( 'FAQ', 'flatastic' ),
//	'base' => 'vc_toggle',
//	'icon' => 'icon-wpb-toggle-small-expand',
//	'category' => __( 'Content', 'flatastic' ),
//	'description' => __( 'Toggle element for Q&A block', 'flatastic' ),
//	'params' => array(
//		array(
//			'type' => 'textfield',
//			'holder' => 'h4',
//			'class' => 'vc_toggle_title',
//			'heading' => __( 'Toggle title', 'flatastic' ),
//			'param_name' => 'title',
//			'value' => __( 'Toggle title', 'flatastic' ),
//			'description' => __( 'Toggle block title.', 'flatastic' )
//		),
//		array(
//			'type' => 'textarea_html',
//			'holder' => 'div',
//			'class' => 'vc_toggle_content',
//			'heading' => __( 'Toggle content', 'flatastic' ),
//			'param_name' => 'content',
//			'value' => __( '<p>Toggle content goes here, click edit button to change this text.</p>', 'flatastic' ),
//			'description' => __( 'Toggle block content.', 'flatastic' )
//		),
//	),
//	'js_view' => 'VcToggleView'
//) );


/* Video element
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Video Player', 'flatastic' ),
	'base' => 'vc_video',
	'icon' => 'icon-wpb-film-youtube',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Embed YouTube/Vimeo player', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Video link', 'flatastic' ),
			'param_name' => 'link',
			'admin_label' => true,
			'description' => sprintf( __( 'Link to the video. More about supported formats at %s.', 'flatastic' ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' )
		),
		$mad_add_css_animation,
		array(
			'type' => 'css_editor',
			'heading' => __( 'Css', 'flatastic' ),
			'param_name' => 'css',
			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' ),
			'group' => __( 'Design options', 'flatastic' )
		),
	)
) );


/* Custom Heading element
----------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Custom Heading', 'flatastic' ),
	'base' => 'vc_custom_heading',
	'icon' => 'icon-wpb-ui-custom_heading',
	'show_settings_on_create' => true,
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Add custom heading text with google fonts', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textarea',
			'heading' => __( 'Text', 'flatastic' ),
			'param_name' => 'text',
			'admin_label' => true,
			'value'=> __( 'This is custom heading element with Google Fonts', 'flatastic' ),
			'description' => __( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'flatastic' ),
		),
		array(
			'type' => 'vc_link',
			'heading' => __( 'URL (Link)', 'flatastic' ),
			'param_name' => 'link',
			'description' => __( 'Add link to custom heading.', 'flatastic' ),
			// compatible with btn2 and converted from href{btn1}
		),
		array(
			'type' => 'font_container',
			'param_name' => 'font_container',
			'value' => 'tag:h2|text_align:left',
			'settings' => array(
				'fields' => array(
					'tag' => 'h2', // default value h2
					'text_align',
					'font_size',
					'line_height',
					'color',
					//'font_style_italic'
					//'font_style_bold'
					//'font_family'

					'tag_description' => __( 'Select element tag.', 'flatastic' ),
					'text_align_description' => __( 'Select text alignment.', 'flatastic' ),
					'font_size_description' => __( 'Enter font size.', 'flatastic' ),
					'line_height_description' => __( 'Enter line height.', 'flatastic' ),
					'color_description' => __( 'Select heading color.', 'flatastic' )
				),
			)
		),
		array(
			'type' => 'google_fonts',
			'param_name' => 'google_fonts',
			'value' => 'font_family:Roboto:100,100italic,300,300italic,regular,italic,500,500italic,700,700italic,900,900italic|font_style:300%20regular%3A300%3Anormal',
			// default
			//'font_family:'.rawurlencode('Abril Fatface:400').'|font_style:'.rawurlencode('400 regular:400:normal')
			// this will override 'settings'. 'font_family:'.rawurlencode('Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic').'|font_style:'.rawurlencode('900 bold italic:900:italic'),
			'settings' => array(
				//'no_font_style' // Method 1: To disable font style
				//'no_font_style'=>true // Method 2: To disable font style
				'fields' => array(
					//'font_family' => 'Abril Fatface:regular',
					//'Exo:100,100italic,200,200italic,300,300italic,regular,italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic',// Default font family and all available styles to fetch
					//'font_style' => '400 regular:400:normal',
					// Default font style. Name:weight:style, example: "800 bold regular:800:normal"
					'font_family_description' => __( 'Select font family.', 'flatastic' ),
					'font_style_description' => __( 'Select font styling.', 'flatastic' )
				)
			),
			'dependency' => array(
				'element' => 'use_theme_fonts',
				'value_not_equal_to' => 'yes',
			)
		),
//		array(
//			'type' => 'textfield',
//			'heading' => __( 'Font size', 'flatastic' ),
//			'param_name' => 'font_size',
//			'group' => __( 'Font styles', 'flatastic' ),
//			'description' => __( 'Enter font size.', 'flatastic' )
//		),
//		array(
//			'type' => 'textfield',
//			'heading' => __( 'Font weight', 'flatastic' ),
//			'param_name' => 'font_weight',
//			'group' => __( 'Font styles', 'flatastic' ),
//			'description' => __( 'Enter font weight.', 'flatastic' )
//		),
//		array(
//			'type' => 'dropdown',
//			'heading' => __( 'Font style', 'flatastic' ),
//			'param_name' => 'font_style',
//			'value' => array(
//				'normal' => 'normal',
//				'italic' => 'italic'
//			),
//			'std' => 'normal',
//			'group' => __( 'Font styles', 'flatastic' ),
//			'description' => __( 'Choose font style.', 'flatastic' )
//		),
//		array(
//			'type' => 'dropdown',
//			'heading' => __( 'Text align', 'flatastic' ),
//			'param_name' => 'text_align',
//			'value' => array(
//				'left' => 'align-left',
//				'center' => 'align-center',
//				'right' => 'align-right'
//			),
//			'group' => __( 'Font styles', 'flatastic' ),
//			'description' => __( 'Select text alignment.', 'flatastic' )
//		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Heading Color', 'flatastic' ),
			'param_name' => 'heading_color',
			'group' => __( 'Font styles', 'flatastic' ),
			'description' => __( 'Select heading color for your heading.', 'flatastic' )
		),
		array(
			"type" => 'checkbox',
			"heading" => __( 'With bottom border', 'flatastic' ),
			"param_name" => "with_bottom_border",
			"description" => "Adds a bottom border to your heading.",
			"value" => array(
				__( 'Yes, please', 'flatastic' ) => 'on'
			)
		),
		$mad_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'flatastic' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'flatastic' ),
			'param_name' => 'css',
			'group' => __( 'Design options', 'flatastic' )
		)
	),
) );


/* Button
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Button', 'flatastic' ),
	'base' => 'vc_button',
	'icon' => 'icon-wpb-ui-button',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Eye catching button', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Text on the button', 'flatastic' ),
			'holder' => 'button',
			'class' => 'wpb_button',
			'param_name' => 'title',
			'value' => __( 'Text on the button', 'flatastic' ),
			'description' => __( 'Text on the button.', 'flatastic' )
		),
		array(
			'type' => 'href',
			'heading' => __( 'URL (Link)', 'flatastic' ),
			'param_name' => 'href',
			'description' => __( 'Button link.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Target', 'flatastic' ),
			'param_name' => 'target',
			'value' => $mad_target_arr,
			'dependency' => array(
				'element' => 'href',
				'not_empty' => true,
				'callback' => 'vc_button_param_target_callback'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'flatastic' ),
			'param_name' => 'color',
			'value' => $mad_colors_arr,
			'description' => __( 'Button color.', 'flatastic' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon', 'flatastic' ),
			'param_name' => 'icon',
			'value' => $mad_icons_arr,
			'description' => __( 'Button icon.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Size', 'flatastic' ),
			'param_name' => 'size',
			'value' => $mad_size_arr,
			'description' => __( 'Button size.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button alignment', 'flatastic' ),
			'param_name' => 'align',
			'value' => array(
				__( 'Left', 'flatastic' ) => 'align-left',
				__( 'Center', 'flatastic' ) => 'align-center',
				__( 'Right', 'flatastic' ) => "align-right"
			),
			'description' => __( 'Select button alignment.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'flatastic' )
		),
		$mad_add_css_animation
	),
	'js_view' => 'VcButtonView'
) );

/* Message box
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Message Box', 'flatastic' ),
	'base' => 'vc_message',
	'icon' => 'icon-wpb-information-white',
	'wrapper_class' => 'alert',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Notification box', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Message box type', 'flatastic' ),
			'param_name' => 'color',
			'value' => array(
				__( 'Informational', 'flatastic' ) => 'alert-info',
				__( 'Warning', 'flatastic' ) => 'alert-warning',
				__( 'Success', 'flatastic' ) => 'alert-success',
				__( 'Error', 'flatastic' ) => "alert-danger"
			),
			'description' => __( 'Select message type.', 'flatastic' ),
			'param_holder_class' => 'vc_message-type'
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'class' => 'messagebox_text',
			'heading' => __( 'Message text', 'flatastic' ),
			'param_name' => 'content',
			'value' => __( '<p>I am message box. Click edit button to change this text.</p>', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' )
		)
	),
	'js_view' => 'VcMessageView'
) );


/* Separator (Divider)
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Separator', 'flatastic' ),
	'base' => 'vc_separator',
	'icon' => 'icon-wpb-ui-separator',
	'show_settings_on_create' => true,
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Horizontal separator line', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Color', 'flatastic' ),
			'param_name' => 'color',
			'value' => array_merge( madGetVcShared( 'colors' ), array( __( 'Custom color', 'flatastic' ) => 'custom' ) ),
			'std' => 'grey',
			'description' => __( 'Separator color.', 'flatastic' ),
			'param_holder_class' => 'vc_colored-dropdown'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Separator alignment', 'flatastic' ),
			'param_name' => 'align',
			'value' => array(
				__( 'Center', 'flatastic' ) => 'align_center',
				__( 'Left', 'flatastic' ) => 'align_left',
				__( 'Right', 'flatastic' ) => "align_right"
			),
			'description' => __( 'Select separator alignment.', 'flatastic' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Custom Border Color', 'flatastic' ),
			'param_name' => 'accent_color',
			'description' => __( 'Select border color for your element.', 'flatastic' ),
			'dependency' => array(
				'element' => 'color',
				'value' => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'flatastic' ),
			'param_name' => 'style',
			'value' => madGetVcShared( 'separator styles' ),
			'description' => __( 'Separator style.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Border width', 'flatastic' ),
			'param_name' => 'border_width',
			'value' => madGetVcShared( 'separator border widths' ),
			'description' => __( 'Border width in pixels.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Element width', 'flatastic' ),
			'param_name' => 'el_width',
			'value' => madGetVcShared( 'separator widths' ),
			'description' => __( 'Separator element width in percents.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' )
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'flatastic' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'flatastic' )
		)
	)
) );

/* Theme Shortcodes
/* ---------------------------------------------------------------- */

/* List Styles
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'List Styles', 'flatastic' ),
	'base' => 'vc_mad_list_styles',
	'icon' => 'icon-wpb-mad-list-styles',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'List styles', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'List Type', 'flatastic' ),
			'param_name' => 'list_type',
			'value' => array(
				__( 'Unordered', 'flatastic' ) => 'unordered',
				__( 'Ordered', 'flatastic' ) => 'ordered'
			),
			'description' => __( 'Choose list type', 'flatastic' ),
			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'List Unordered Styles', 'flatastic' ),
			'param_name' => 'list_unordered_styles',
			'value' => $mad_list_unordered_styles,
			'description' => __( 'Choose styles for unordered list', 'flatastic' ),
			"dependency" => array(
				"element" => "list_type",
				"value" => array("unordered")
			)
//			'admin_label' => true
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'List Ordered Styles', 'flatastic' ),
			'param_name' => 'list_ordered_styles',
			'value' => $mad_list_ordered_styles,
			'description' => __( 'Choose styles for ordered list', 'flatastic' ),
			"dependency" => array(
				"element" => "list_type",
				"value" => array("ordered")
			)
//			'admin_label' => true
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'List Items', 'flatastic' ),
			'param_name' => 'values',
			'description' => __( 'Input list items values. Divide values with linebreaks (Enter). Example: Development|Design', 'flatastic' ),
			'value' => "Development|Design|Marketing"
		),
		$mad_add_css_animation
	)
) );

/* Tables
---------------------------------------------------------- */

vc_map( array(
	"name"		=> __('Tables', 'flatastic'),
	"base"		=> "vc_mad_tables",
	"icon"		=> "icon-wpb-mad-tables",
	"is_container" => true,
	"category"  => __('Content', 'flatastic'),
	"description" => __('Tables', 'flatastic'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( 'Title', 'flatastic' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => __( '', 'flatastic' )
		),
		array(
			"type" => "table_number",
			"heading" => __("Columns", 'flatastic'),
			"param_name" => "columns",
			"value" => ''
		),
		array(
			"type" => "table_number",
			"heading" => __( 'Rows', 'flatastic' ),
			"param_name" => "rows",
			"description" => __( '', 'flatastic' )
		),
		array(
			"type" => "table_hidden",
			"param_name" => "data",
			"class" => "tables-hidden-data",
			"description" => __( '', 'flatastic' )
		)
	)
));


/* Info Block
---------------------------------------------------------- */

vc_map( array(
	"name"		=> __('Info Block', 'flatastic'),
	"base"		=> "vc_mad_info_block",
	"icon"		=> "icon-wpb-mad-info-block",
	"is_container" => false,
	"category"  => __('Content', 'flatastic'),
	"description" => __('Styled info blocks', 'flatastic'),
	"params" => array(
		array(
			"type" => "dropdown",
			"heading" => __( 'Select type', 'flatastic' ),
			"param_name" => "type",
			"value" => array(
				'Type 1' => 'type-1',
				'Type 2' => 'type-2',
				'Type 3' => 'type-3',
				'Color Blocks' => 'type-4',
				'Contact Info' => 'type-5'
			),
			"description" => __( 'Choose type for this info block.', 'flatastic' )
		),
		array(
			"type" => "textfield",
			"heading" => __( 'Title', 'flatastic' ),
			"param_name" => "title",
			"holder" => "h4",
			"dependency" => array(
				'element' => "type",
				'value' => array('type-1', 'type-2', 'type-3')
			),
			"description" => __( '', 'flatastic' )
		),
		array(
			"type" => "colorpicker",
			"heading" => __( 'Background color', 'flatastic' ),
			"param_name" => "bg_color",
			"value" => "#2ecc71",
			"description" => __( 'Set background color for info block.', 'flatastic' ),
			"dependency" => array(
				'element' => "type",
				'value' => array('type-4')
			)
		),
		array(
			"type" => "choose_icons",
			"heading" => __("Icon", 'flatastic'),
			"param_name" => "icon",
			"value" => 'none'
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __( 'Text', 'flatastic' ),
			'param_name' => 'content',
			'value' => __( '<p>Click edit button to change this text.</p>', 'flatastic' )
		),
		array(
			"type" => "vc_link",
			"heading" => __( 'Add URL to the whole box (optional)', 'flatastic' ),
			"param_name" => "link",
			"dependency" => array(
				'element' => "type",
				'value' => array('type-1', 'type-2', 'type-3', 'type-4')
			)
		),
		$mad_add_css_animation
	)
));

/* Price Table
---------------------------------------------------------- */

vc_map( array(
	"name"		=> __('Pricing Table', 'flatastic'),
	"base"		=> "vc_mad_pricing_box",
	"icon"		=> "icon-wpb-mad-pricing-box",
//	"allowed_container_element" => false,
	"is_container" => false,
	"category"  => __('Content', 'flatastic'),
	"description" => __('Styled pricing tables', 'flatastic'),
	"params" => array(
		array(
			"type" => "textfield",
			"heading" => __( 'Title', 'flatastic' ),
			"param_name" => "title",
			"holder" => "h4",
			"description" => __( 'Give your plan a title.', 'flatastic' ),
			"value" => __( 'Free', 'flatastic' ),
		),
		array(
			"type" => "textfield",
			"heading" => __( 'Currency', 'flatastic' ),
			"param_name" => "currency",
			"holder" => "span",
			"description" => __( 'Enter currency symbol or text, e.g., $ or USD.', 'flatastic' ),
			"value" => __( '$', 'flatastic' )
		),
		array(
			"type" => "textfield",
			"heading" => __( 'Price', 'flatastic' ),
			"param_name" => "price",
			"holder" => "span",
			"description" => __( 'Set the price for this plan.', 'flatastic' ),
			"value" => __( '15', 'flatastic' )
		),
		array(
			"type" => "textfield",
			"heading" => __( 'Time', 'flatastic' ),
			"param_name" => "time",
			"holder" => "span",
			"description" => __( 'Choose time span for you plan, e.g., per month', 'flatastic' ),
			"value" => __( 'per month', 'flatastic' )
		),
		array(
			"type" => "textarea",
			"heading" => __( 'Features', 'flatastic' ),
			"param_name" => "features",
			"holder" => "span",
			"description" => __( 'A short description or list for the plan.', 'flatastic' ),
			"value" => __( 'Up to 50 users | Limited team members | Limited disk space | Custom Domain | PayPal Integration | Basecamp Integration', 'flatastic' )
		),
		array(
			"type" => "vc_link",
			"heading" => __( 'Add URL to the whole box (optional)', 'flatastic' ),
			"param_name" => "link",
		),
		array(
			"type" => "dropdown",
			"heading" => __( 'Select style', 'flatastic' ),
			"param_name" => "box_style",
			"value" => array(
				'Dark' => 'bg_color_dark',
				'Green' => 'bg_color_green',
				'Orange' => 'bg_color_orange',
				'Red' => 'bg_color_red',
				'Blue' => 'bg_color_blue',
				'Custom' => 'custom'
			),
			"description" => __( 'Choose style for this pricing box.', 'flatastic' ),
			"group" => __('Design', 'flatastic')
		),
		array(
			"type" => "colorpicker",
			"heading" => __( 'Header Background color', 'flatastic' ),
			"param_name" => "header_bg_color",
			"value" => "#292f38",
			"description" => __( 'Set background color for pricing box header.', 'flatastic' ),
			"group" => __('Design', 'flatastic'),
			"dependency" => array(
				'element' => "box_style",
				'value' => array('custom')
			)
		),
		array(
			"type" => "colorpicker",
			"heading" => __( 'Main Background color', 'flatastic' ),
			"param_name" => "main_bg_color",
			"value" => "#323a45",
			"description" => __( 'Set background color for pricing box main.', 'flatastic' ),
			"group" => __('Design', 'flatastic'),
			"dependency" => array(
				'element' => "box_style",
				'value' => array('custom')
			)
		),
		array(
			"type" => 'checkbox',
			"heading" => __( 'Add hot?', 'flatastic' ),
			"param_name" => "add_hot",
			"group" => __('Hot', 'flatastic'),
			"description" => "Adds a nice hot to your pricing box.",
			"value" => array(
				__( 'Yes, please', 'flatastic' ) => 'on'
			)
		),
		$mad_add_css_animation
	)
//	"js_view" => 'VcPricingView'
));

/* Single Image
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Single Image', 'flatastic' ),
	'base' => 'vc_mad_single_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Simple image', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image source', 'flatastic' ),
			'param_name' => 'source',
			'value' => array(
				__( 'Media library', 'flatastic' ) => 'media_library',
				__( 'External link', 'flatastic' ) => 'external_link',
				__( 'Featured Image', 'flatastic' ) => 'featured_image'
			),
			'std' => 'media_library',
			'description' => __( 'Select image source.', 'flatastic' )
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'flatastic' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'flatastic' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'media_library'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'External link', 'flatastic' ),
			'param_name' => 'custom_src',
			'description' => __( 'Select external link.', 'flatastic' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'external_link'
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'flatastic' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size in pixels: 200*100 (Width * Height). Leave empty to use full size.', 'flatastic' ),
			'dependency' => array(
				'element' => 'source',
				'value' => array( 'media_library', 'featured_image' )
			)
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'flatastic'),
			'param_name' => 'external_img_size',
			'value' => '',
			'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'flatastic' ),
			'dependency' => array(
				'element' => 'source',
				'value' => 'external_link'
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image alignment', 'flatastic' ),
			'param_name' => 'alignment',
			'value' => array(
				__( 'None', 'flatastic' ) => 'none',
				__( 'Left', 'flatastic' ) => 'left',
				__( 'Right', 'flatastic' ) => 'right',
				__( 'Center', 'flatastic' ) => 'center'
			),
			'description' => __( 'Select image alignment.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click action', 'flatastic' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'None', 'flatastic' ) => '',
				__( 'Link to large image', 'flatastic' ) => 'img_link_large',
				__( 'Open prettyPhoto', 'flatastic' ) => 'link_image',
				__( 'Open custom link', 'flatastic' ) => 'custom_link'
			),
			'description' => __( 'Select action for click action.', 'flatastic' ),
			'std' => ''
		),
		array(
			'type' => 'href',
			'heading' => __( 'Image link', 'flatastic' ),
			'param_name' => 'link',
			'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'flatastic' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => 'custom_link',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', 'flatastic' ),
			'param_name' => 'img_link_target',
			'value' => $mad_target_arr,
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link', 'img_link_large' ),
			),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'flatastic' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'flatastic' )
		),
		// backward compatibility. since 4.6
		array(
			'type' => 'hidden',
			'param_name' => 'img_link_large'
		)
	)
) );


/* Testimonials
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Testimonials', 'flatastic' ),
	'base' => 'vc_mad_testimonials',
	'icon' => 'icon-wpb-mad-testimonials',
	'description' => __( 'Testimonials post type', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'edit_field_class' => 'vc_col-sm-6',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Tag for title', 'flatastic' ),
			'param_name' => 'tag_title',
			'value' => array(
				'h1' => 'h1',
				'h2' => 'h2'
			),
			'std' => 'h2',
			'edit_field_class' => 'vc_col-sm-6',
			'description' => __( 'Choose tag for title.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text align', 'flatastic' ),
			'param_name' => 'text_align',
			'value' => array(
				'left' => 'align-left',
				'center' => 'align-center',
				'right' => 'align-right'
			),
			'std' => 'align-left',
			'group' => __( 'Text styles', 'flatastic' ),
			'description' => __( 'Select testimonials alignment.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Testimonial Style', 'flatastic' ),
			'param_name' => 'style',
			'value' => array(
				__( 'Testimonial List', 'flatastic' ) => 'tm-list',
				__( 'Testimonial Slider', 'flatastic' ) => 'tm-slider'
			),
			'description' => __( 'Here you can select how to display the testimonials. You can either create a testimonial slider or a testimonial grid with multiple columns', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Count Items', 'flatastic' ),
			'param_name' => 'items',
			'value' => MAD_VC_CONFIG::array_number(1, 10, 1, array('All' => '-1')),
			'std' => -1,
			'description' => __( 'How many items should be displayed per page?', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display show image', 'flatastic' ),
			'param_name' => 'display_show_image',
			'description' => __( 'output date', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			"type" => "get_terms",
			"term" => "testimonials_category",
			'heading' => __( 'Which categories should be used for the testimonials?', 'flatastic' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => __('The Page will then show testimonials from only those categories.', 'flatastic')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order By', 'flatastic' ),
			'param_name' => 'orderby',
			'value' => MAD_VC_CONFIG::get_order_sort_array(),
			'description' => __( '', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order', 'flatastic' ),
			'param_name' => 'order',
			'value' => array(
				__( 'DESC', 'flatastic' ) => 'DESC',
				__( 'ASC', 'flatastic' ) => 'ASC',
			),
			'description' => __( 'Direction Order', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Pagination', 'flatastic' ),
			'param_name' => 'pagination',
			'value' => array(
				__( 'No', 'flatastic' ) => 'no',
				__( 'Yes', 'flatastic' ) => 'yes'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('tm-list')
			),
			'description' => __( 'Should a pagination be displayed?', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Autoplay', 'flatastic' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enables autoplay mode.', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => __( 'Autoplay timeout', 'flatastic' ),
			'param_name' => 'autoplaytimeout',
			'description' => __( 'Autoplay interval timeout', 'flatastic' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			)
		),
		$mad_short_css_animation
	)
) );


/* Brands Logo
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Brands Logo', 'flatastic' ),
	'base' => 'vc_mad_brands_logo',
	'icon' => 'icon-wpb-brands-logo',
	'description' => __( 'Brands logo', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Twin Items?', 'flatastic' ),
			'param_name' => 'twin',
			'description' => __( '', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'flatastic' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'flatastic' )
		),
		array(
			"type" => "textarea",
			"heading" => __( 'Links', 'flatastic' ),
			"param_name" => "links",
			"holder" => "span",
			"description" => __( 'Input links values. Divide values with linebreaks (|). Example: http://brand.com | http://brand2.com', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Autoplay', 'flatastic' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enables autoplay mode.', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => __( 'Autoplay timeout', 'flatastic' ),
			'param_name' => 'autoplaytimeout',
			'description' => __( 'Autoplay interval timeout', 'flatastic' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			)
		),
		$mad_add_css_animation
	)
) );

/* Team Members
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Team Members', 'flatastic' ),
	'base' => 'vc_mad_team_members',
	'icon' => 'icon-wpb-mad-team-members',
	'description' => __( 'Team Members post type', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Count Items', 'flatastic' ),
			'param_name' => 'items',
			'value' => MAD_VC_CONFIG::array_number(1, 12, 1, array('All' => '-1')),
			'std' => -1,
			'description' => __( 'How many items should be displayed per page?', 'flatastic' )
		),
		array(
			"type" => "get_terms",
			"term" => "team_category",
			'heading' => __( 'Which categories should be used for the team?', 'flatastic' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => __('The Page will then show team from only those categories.', 'flatastic')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order By', 'flatastic' ),
			'param_name' => 'orderby',
			'value' => MAD_VC_CONFIG::get_order_sort_array(),
			'description' => __( '', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order', 'flatastic' ),
			'param_name' => 'order',
			'value' => array(
				__( 'DESC', 'flatastic' ) => 'DESC',
				__( 'ASC', 'flatastic' ) => 'ASC',
			),
			'description' => __( 'Direction Order', 'flatastic' )
		)
	)
) );

/* Blog Posts
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Blog Posts', 'flatastic' ),
	'base' => 'vc_mad_blog_posts',
	'icon' => 'icon-wpb-application-icon-large',
	'description' => __( 'Blog posts', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Blog Style', 'flatastic' ),
			'param_name' => 'blog_style',
			'value' => array(
				__( 'Blog Medium', 'flatastic' ) => 'blog-medium',
				__( 'Blog Big', 'flatastic' ) => 'blog-big',
				__( 'Blog Grid', 'flatastic' ) => 'blog-grid'
			),
			'description' => __( 'Choose the default blog layout here.', 'flatastic' )
		),
		array(
			"type" => "get_terms",
			"term" => "category",
			'heading' => __( 'Which categories should be used for the blog?', 'flatastic' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => __('The Page will then show entries from only those categories.', 'flatastic')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order By', 'flatastic' ),
			'param_name' => 'orderby',
			'value' => MAD_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => __( 'Sort retrieved posts by parameter', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order', 'flatastic' ),
			'param_name' => 'order',
			'value' => array(
				__( 'DESC', 'flatastic' ) => 'DESC',
				__( 'ASC', 'flatastic' ) => 'ASC'
			),
			'description' => __( 'In what direction order?', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Posts Count', 'flatastic' ),
			'param_name' => 'posts_per_page',
			'value' => MAD_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => __( 'How many items should be displayed per page?', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'First post big?', 'flatastic' ),
			'param_name' => 'first_big_post',
			'description' => __( '', 'flatastic' ),
			'dependency' => array(
				'element' => 'blog_style',
				'value' => array('blog-medium')
			),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Pagination', 'flatastic' ),
			'param_name' => 'pagination',
			'value' => array(
				__( 'No', 'flatastic' ) => 'no',
				__( 'Yes', 'flatastic' ) => 'yes'
			),
			'description' => __( 'Should a pagination be displayed?', 'flatastic' )
		)
	)
) );


/* Banners
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Banners', 'flatastic' ),
	'base' => 'vc_mad_banners',
	'icon' => 'icon-wpb-mad-banners',
	'description' => __( '2 type banners', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'flatastic' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Type 1', 'flatastic' ) => 'type-1',
				__( 'Type 2', 'flatastic' ) => 'type-2'
			),
			'description' => __( 'Type styles banner', 'flatastic' )
		),
		array(
			"type" => "colorpicker",
			"heading" => __( 'Border color', 'flatastic' ),
			"param_name" => "border_color",
			"value" => "#e74c3c",
			"description" => __( 'Set border color for banner Type 2.', 'flatastic' ),
			"dependency" => array(
				'element' => "type",
				'value' => array('type-2')
			),
			'group' => __( 'Styling', 'flatastic' ),
			"std" => '#e74c3c'
		),
		array(
			"type" => "colorpicker",
			"heading" => __( 'Background color', 'flatastic' ),
			"param_name" => "bg_color",
			"value" => "#ffffff",
			"description" => __( 'Set background color for banner Type 2.', 'flatastic' ),
			"dependency" => array(
				'element' => "type",
				'value' => array('type-2')
			),
			'group' => __( 'Styling', 'flatastic' ),
			"std" => '#ffffff'
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'flatastic' ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'flatastic' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __( 'Text', 'flatastic' ),
			'param_name' => 'content',
			"dependency" => array(
				'element' => "type",
				'value' => array('type-2')
			),
			'value' => __( '<p>Click edit button to change this text.</p>', 'flatastic' )
		),
		array(
			"type" => "vc_link",
			"heading" => __( 'Add URL to the button', 'flatastic' ),
			"param_name" => "link"
		),
		$mad_add_css_animation
	)
) );


/* Posts Slider
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Posts Slider', 'flatastic' ),
	'base' => 'vc_mad_posts_slider',
	'icon' => 'icon-wpb-mad-posts-slider',
	'description' => __( 'Blog posts', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			"type" => "get_terms",
			"term" => "category",
			'heading' => __( 'Which categories should be used for the blog?', 'flatastic' ),
			"param_name" => "category",
			"holder" => "div",
			'description' => __('The Page will then show entries from only those categories.', 'flatastic')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order By', 'flatastic' ),
			'param_name' => 'orderby',
			'value' => MAD_VC_CONFIG::get_order_sort_array(),
			'std' => 'date',
			'description' => __( 'Sort retrieved posts by parameter', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order', 'flatastic' ),
			'param_name' => 'order',
			'value' => array(
				__( 'DESC', 'flatastic' ) => 'DESC',
				__( 'ASC', 'flatastic' ) => 'ASC'
			),
			'description' => __( 'In what direction order?', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Posts Count', 'flatastic' ),
			'param_name' => 'posts_per_page',
			'value' => MAD_VC_CONFIG::array_number(1, 50, 1, array('-1' => 'All')),
			'std' => 5,
			'description' => __( 'How many items should be displayed per page?', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Items', 'flatastic' ),
			'param_name' => 'items',
			'value' => MAD_VC_CONFIG::array_number(1, 2, 1),
			'std' => 1,
			'description' => __( 'This variable allows you to set the maximum amount of items displayed at a time with the widest browser width', 'flatastic' )
		),
		$mad_short_css_animation
	)
) );

if (class_exists('WooCommerce')) {

	/* Product Grid
	---------------------------------------------------------- */

	vc_map( array(
		'name' => __( 'Products', 'flatastic' ),
		'base' => 'vc_mad_products',
		'icon' => 'icon-wpb-mad-woocommerce',
		'category' => __( 'WooCommerce', 'flatastic' ),
		'description' => __( 'Displayed for product grid', 'flatastic' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Title', 'flatastic' ),
				'param_name' => 'title',
				'edit_field_class' => 'vc_col-sm-6',
				'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Tag for title', 'flatastic' ),
				'param_name' => 'tag_title',
				'value' => array(
					'h1' => 'h1',
					'h2' => 'h2'
				),
				'std' => 'h2',
				'edit_field_class' => 'vc_col-sm-6',
				'description' => __( 'Choose tag for title.', 'flatastic' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Type', 'flatastic' ),
				'param_name' => 'type',
				'value' => array(
					__('Grid', 'flatastic') => 'product-grid',
					__('Carousel', 'flatastic') => 'product-carousel'
				),
				'description' => __('Choose the type style.', 'flatastic')
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Layout', 'flatastic' ),
				'param_name' => 'layout',
				'value' => array(
					__('Grid View', 'flatastic') => 'view-grid',
					__('Grid View (meta data align center)', 'flatastic') => 'view-grid-center',
					__('Grid List', 'flatastic') => 'view-list'
				),
				'dependency' => array(
					'element' => 'type',
					'value' => array('product-grid')
				),
				'description' => __('Choose layout style.', 'flatastic')
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Columns', 'flatastic' ),
				'param_name' => 'columns',
				'value' => array(
					__( '3 Columns', 'flatastic' ) => 3,
					__( '4 Columns', 'flatastic' ) => 4
				),
				'description' => __( 'How many columns should be displayed?', 'flatastic' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Count Items', 'flatastic' ),
				'param_name' => 'items',
				'value' => MAD_VC_CONFIG::array_number(1, 40, 1, array('All' => -1)),
				'std' => 9,
				'description' => __( 'How many items should be displayed per page?', 'flatastic' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Show', 'flatastic' ),
				'param_name' => 'show',
				'value' => array(
					__( 'All Products', 'flatastic' ) => '',
					__( 'Featured Products', 'flatastic' ) => 'featured',
					__( 'On-sale Products', 'flatastic' ) => 'onsale',
					__( 'Best Selling Products', 'flatastic' ) => 'bestselling',
					__( 'Top Rated Products', 'flatastic' ) => 'toprated'
				),
				'std' => 'desc',
				'description' => __( '', 'flatastic' ),
				'group' => esc_html__( 'Data Settings', 'flatastic' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'flatastic' ),
				'param_name' => 'orderby',
				'value' => array(
					__('Default', 'flatastic' ) => '',
					__('Date', 'flatastic' ) => 'date',
					__('Price', 'flatastic' ) => 'price',
					__('Random', 'flatastic' ) => 'rand',
					__('Sales', 'flatastic' ) => 'sales',
					__('Sort by Ids', 'flatastic' ) => 'post__in',
					__('Sort alphabetically', 'flatastic' ) => 'title',
					__('Sort by popularity', 'flatastic' ) => 'popularity'
				),
				'group' => esc_html__( 'Data Settings', 'flatastic' ),
				'description' => __( 'Here you can choose how to display the products', 'flatastic' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Sorting Order', 'flatastic' ),
				'param_name' => 'order',
				'value' => array(
					__( 'ASC', 'flatastic' ) => 'asc',
					__( 'DESC', 'flatastic' ) => 'desc'
				),
				'std' => 'desc',
				'group' => esc_html__( 'Data Settings', 'flatastic' ),
				'description' => __( 'Here you can choose how to display the products', 'flatastic' )
			),
			array(
				'type' => 'autocomplete',
				'settings' => array(
					'multiple' => true,
					// is multiple values allowed? default false
					// 'sortable' => true, // is values are sortable? default false
					'min_length' => 2,
					// min length to start search -> default 2
					// 'no_hide' => true, // In UI after select doesn't hide an select list, default false
					'groups' => true,
					// In UI show results grouped by groups, default false
					'unique_values' => true,
					// In UI show results except selected. NB! You should manually check values in backend, default false
					'display_inline' => true,
					// In UI show results inline view, default false (each value in own line)
					'delay' => 500,
					// delay for search. default 500
					'auto_focus' => true,
					// auto focus input, default true
					// 'values' => $taxonomies_list,
				),
				'heading' => __( 'Select identificators', 'flatastic' ),
				'param_name' => 'by_id',
				'admin_label' => true,
				'group' => esc_html__( 'Data Settings', 'flatastic' ),
				'description' => __('Input product ID or product SKU or product title to see suggestions', 'flatastic')
			),
			array(
				"type" => "get_terms",
				"term" => "product_cat",
				'heading' => __( 'Which categories should be used for the products?', 'flatastic' ),
				"param_name" => "categories",
				"holder" => "div",
				'group' => esc_html__( 'Data Settings', 'flatastic' ),
				'description' => __('The Page will then show products from only those categories.', 'flatastic')
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Filter', 'flatastic' ),
				'param_name' => 'filter',
				'value' => array(
					__( 'No', 'flatastic' ) => 'no',
					__( 'Yes', 'flatastic' ) => 'yes'
				),
				'description' => __( 'Should the filter options based on categories be displayed?', 'flatastic' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add random filter item?', 'flatastic' ),
				'param_name' => 'random',
				'description' => __( 'Sort by random', 'flatastic' ),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('yes')
				),
				'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Add sale filter item?', 'flatastic' ),
				'param_name' => 'sale',
				'description' => __( 'Sort by price sale', 'flatastic' ),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('yes')
				),
				'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Pagination', 'flatastic' ),
				'param_name' => 'pagination',
				'value' => array(
					__( 'No', 'flatastic' ) => 'no',
					__( 'Yes', 'flatastic' ) => 'yes'
				),
				'dependency' => array(
					'element' => 'filter',
					'value' => array('no')
				),
				'description' => __( 'Should a pagination be displayed?', 'flatastic' )
			),
			$mad_add_css_animation
		)
	) );

	$Vc_Vendor_Woocommerce = new Vc_Vendor_Woocommerce();

	//Filters For autocomplete param:
	//For suggestion: vc_autocomplete_[shortcode_name]_[param_name]_callback
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_callback', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteSuggester' ), 10, 1 );
	// Get suggestion(find). Must return an array
	add_filter( 'vc_autocomplete_vc_mad_products_by_id_render', array($Vc_Vendor_Woocommerce, 'productIdAutocompleteRender' ), 10, 1 );
	// Render exact product. Must return an array (label,value)
	//For param: ID default value filter
	add_filter( 'vc_form_fields_render_field_vc_mad_products_by_id_param_value', array($Vc_Vendor_Woocommerce, 'productIdDefaultValue' ), 10, 4 );
	// Defines default value for param if not provided. Takes from other param value.

	/* MAD VC woocommerce product attribute */
	$attributes_tax = wc_get_attribute_taxonomies();
	$attributes = array();
	foreach ( $attributes_tax as $attribute ) {
		$attributes[ $attribute->attribute_label ] = $attribute->attribute_name;
	}

	$order_by_values = array(
		'',
		__( 'Date', 'flatastic' ) => 'date',
		__( 'ID', 'flatastic' ) => 'ID',
		__( 'Author', 'flatastic' ) => 'author',
		__( 'Title', 'flatastic' ) => 'title',
		__( 'Modified', 'flatastic' ) => 'modified',
		__( 'Random', 'flatastic' ) => 'rand',
		__( 'Comment count', 'flatastic' ) => 'comment_count',
		__( 'Menu order', 'flatastic' ) => 'menu_order',
	);

	$order_way_values = array(
		'',
		__( 'Descending', 'flatastic' ) => 'DESC',
		__( 'Ascending', 'flatastic' ) => 'ASC',
	);

	vc_map( array(
		'name' => __( 'Product Attribute', 'flatastic'),
		'base' => 'vc_mad_product_attribute',
		'icon' => 'icon-wpb-woocommerce',
		'category' => __( 'WooCommerce', 'flatastic' ),
		'description' => __( 'List products with an attribute shortcode', 'flatastic' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Per page', 'flatastic' ),
				'value' => 12,
				'param_name' => 'per_page',
				'description' => __( 'How much items per page to show', 'flatastic' ),
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Columns', 'flatastic' ),
				'param_name' => 'columns',
				'value' => array(
					__( '3 Columns', 'flatastic' ) => 3,
					__( '4 Columns', 'flatastic' ) => 4
				),
				'description' => __( 'How many columns should be displayed?', 'flatastic' ),
				'param_holder_class' => ''
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order by', 'flatastic' ),
				'param_name' => 'orderby',
				'value' => $order_by_values,
				'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'flatastic' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Order way', 'flatastic' ),
				'param_name' => 'order',
				'value' => $order_way_values,
				'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'flatastic' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Attribute', 'flatastic'),
				'param_name' => 'attribute',
				'value' => $attributes,
				'description' => __( 'List of product taxonomy attribute', 'flatastic' ),
			),
			array(
				'type' => 'checkbox',
				'heading' => __( 'Filter', 'flatastic' ),
				'param_name' => 'filter',
				'value' => array( 'empty' => 'empty' ),
				'description' => __( 'Taxonomy values', 'flatastic' ),
				'dependency' => array(
					'element' => 'attribute',
					'is_empty' => true,
					'callback' => 'madvcWoocommerceProductAttributeFilterDependencyCallback',
				),
			),
		)
	) );

	/* VC woocommerce order tracking */
	vc_map( array(
			"name" => __("Order Tracking", 'flatastic'),
			"base" => "woocommerce_order_tracking",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => __('WooCommerce', 'flatastic'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce cart */
	vc_map( array(
			"name" => __("Cart", 'flatastic'),
			"base" => "woocommerce_cart",
			"icon" => 'icon-wpb-mad-woocommerce',
			"class" => "wp_woo",
			"category" => __('WooCommerce', 'flatastic'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce checkout */
	vc_map( array(
			"name" => __("Checkout", 'flatastic'),
			"base" => "woocommerce_checkout",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => __('WooCommerce', 'flatastic'),
			"show_settings_on_create" => false
		)
	);

	/* VC woocommerce my account */
	vc_map( array(
			"name" => __("My Account", 'flatastic'),
			"base" => "woocommerce_my_account",
			"icon" => 'icon-wpb-mad-woocommerce',
			"category" => __('WooCommerce', 'flatastic'),
			"show_settings_on_create" => false
		)
	);

	if (defined('YITH_WCWL')) {

		/* VC woocommerce my wishlist */
		vc_map( array(
				"name" => __("Wishlist", 'flatastic'),
				"base" => "vc_mad_yith_wcwl_wishlist",
				"icon" => 'icon-wpb-mad-woocommerce',
				"category" => __('WooCommerce', 'flatastic'),
				"params" => array(
					array(
						'type' => 'dropdown',
						'heading' => __( 'Pagination', 'flatastic' ),
						'param_name' => 'pagination',
						'value' => array(
							__( 'No', 'flatastic' ) => 'no',
							__( 'Yes', 'flatastic' ) => 'yes'
						),
						'description' => __( 'Should a pagination be displayed?', 'flatastic' )
					),
					array(
						'type' => 'dropdown',
						'heading' => __( 'Count Items', 'flatastic' ),
						'param_name' => 'per_page',
						'value' => MAD_VC_CONFIG::array_number(1, 51, 1, array('All' => '-1')),
						'std' => -1,
						'dependency' => array(
							'element' => 'pagination',
							'value' => array('yes')
						),
						'description' => __( 'A number of products on one page', 'flatastic' ),
					)
				)
			)
		);

	}

}


/* Portfolio
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Portfolio', 'flatastic' ),
	'base' => 'vc_mad_portfolio',
	'class' => '',
	'icon' => 'icon-wpb-vc_carousel',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Displayed for portfolio items', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'title', 'flatastic' ),
			'edit_field_class' => 'vc_col-sm-6',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Tag for title', 'flatastic' ),
			'param_name' => 'tag_title',
			'value' => array(
				'h1' => 'h1',
				'h2' => 'h2'
			),
			'std' => 'h2',
			'edit_field_class' => 'vc_col-sm-6',
			'description' => __( 'Choose tag for title.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Layout', 'flatastic' ),
			'param_name' => 'layout',
			'value' => array(
				__( 'Grid', 'flatastic' ) => 'grid',
				__( 'Carousel', 'flatastic' ) => 'carousel',
				__( 'Masonry', 'flatastic' ) => 'masonry'
			),
			'description' => __( 'Layout be displayed?', 'flatastic' )
		),
		array(
			"type" => "get_terms",
			"term" => "portfolio_categories",
			'heading' => __( 'Which categories should be used for the portfolio?', 'flatastic' ),
			"param_name" => "categories",
			"holder" => "div",
			'description' => __('The Page will then show portfolio from only those categories.', 'flatastic')
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order By', 'flatastic' ),
			'param_name' => 'orderby',
			'value' => MAD_VC_CONFIG::get_order_sort_array(),
			'description' => __( 'Sort retrieved items by parameter', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order', 'flatastic' ),
			'param_name' => 'order',
			'value' => array(
				__( 'DESC', 'flatastic' ) => 'DESC',
				__( 'ASC', 'flatastic' ) => 'ASC',
			),
			'description' => __( 'Direction Order', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', 'flatastic' ),
			'param_name' => 'columns',
			'value' => array(
				__( '2 Columns', 'flatastic' ) => 2,
				__( '3 Columns', 'flatastic' ) => 3,
				__( '4 Columns', 'flatastic' ) => 4,
				__( '5 Columns', 'flatastic' ) => 5
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array('grid', 'carousel')
			),
			'std' => 3,
			'description' => __( 'How many columns should be displayed?', 'flatastic' ),
			'param_holder_class' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Count Items', 'flatastic' ),
			'param_name' => 'items',
			'value' => MAD_VC_CONFIG::array_number(1, 30, 1, array('All' => '-1')),
			'std' => -1,
			'description' => __( 'How many items should be displayed per page?', 'flatastic' ),
			'param_holder_class' => ''
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Filter', 'flatastic' ),
			'param_name' => 'sort',
			'value' => array(
				__( 'No', 'flatastic' ) => 'no',
				__( 'Yes', 'flatastic' ) => 'yes'
			),
			'dependency' => array(
				'element' => 'layout',
				'value' => array('grid', 'masonry')
			),
			'description' => __( 'Should the sorting options based on categories be displayed?', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'flatastic' ),
			'param_name' => 'filter_style',
			'value' => array(
				__( 'Dropdown', 'flatastic' ) => 'dropdown',
				__( 'Buttons', 'flatastic' ) => 'buttons',
			),
			'dependency' => array(
				'element' => 'sort',
				'value' => array('yes'),
			),
			'std' => 'dropdown',
			'group' => __( 'Filter', 'flatastic' ),
			'description' => __( 'Select filter display style.', 'flatastic' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Pagination', 'flatastic' ),
			'param_name' => 'pagination',
			'value' => array(
				__( 'No', 'flatastic' ) => 'no',
				__( 'Pagination', 'flatastic' ) => 'yes',
				__( 'Load more button', 'flatastic' ) => 'load-more'

			),
//			'dependency' => array(
//				'element' => 'sort',
//				'value' => array('no')
//			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
			'description' => __( 'Select pagination style.', 'flatastic' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Items per page', 'flatastic' ),
			'param_name' => 'items_per_page',
			'description' => __( 'Number of items to show per page.', 'flatastic' ),
			'value' => 4,
			'dependency' => array(
				'element' => 'pagination',
				'value' => array( 'load-more', 'pagination' ),
			),
			'edit_field_class' => 'vc_col-sm-6 vc_column',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Position of the text', 'flatastic' ),
			'param_name' => 'position_text',
			'value' => array(
				__( 'Bottom', 'flatastic' ) => 'bottom',
				__( 'Inside', 'flatastic' ) => 'inside'
			),
//			'dependency' => array(
//				'element' => 'layout',
//				'value' => array('grid')
//			),
			'std' => 'bottom',
			'description' => __( 'Select position of the text in item portfolio.', 'flatastic' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Related Items', 'flatastic' ),
			'param_name' => 'related',
			'description' => __( 'display only related posts (To display the detailed portfolio page)', 'flatastic' ),
			'dependency' => array(
				'element' => 'layout',
				'value' => array('grid')
			),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		)
	)
) );

/* About Portfolio
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'About Portfolio', 'flatastic' ),
	'base' => 'vc_mad_about_portfolio',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'To display the detailed portfolio page', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'checkbox',
			'heading' => __( 'Date', 'flatastic' ),
			'param_name' => 'output_date',
			'description' => __( 'output date', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Client', 'flatastic' ),
			'param_name' => 'output_client',
			'description' => __( 'output client', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Services', 'flatastic' ),
			'param_name' => 'output_services',
			'description' => __( 'output services', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Skills', 'flatastic' ),
			'param_name' => 'output_skills',
			'description' => __( 'output skills', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Category', 'flatastic' ),
			'param_name' => 'output_category',
			'description' => __( 'output category', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Tags', 'flatastic' ),
			'param_name' => 'output_tags',
			'description' => __( 'output tags', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display share?', 'flatastic' ),
			'param_name' => 'display_share',
			'description' => __( 'share social services', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		)
	)
) );


/* Portfolio Image List
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Portfolio Image List', 'flatastic' ),
	'base' => 'vc_mad_portfolio_image_list',
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Image List for portfolio single', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'flatastic' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'flatastic' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size in pixels: 200*100 (Width * Height). Leave empty to use full size. Divide image size with (^). Example: 730*460^730*800^730*360', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' )
		)
	)
));


/* Image Carousel
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Image Carousel', 'flatastic' ),
	'base' => 'vc_mad_images_carousel',
	'icon' => 'icon-wpb-images-carousel',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Animated carousel with images', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'flatastic' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library. Your image should be at least 440x345', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'flatastic' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open lightBox', 'flatastic' ) => 'link_image',
				__( 'Do nothing', 'flatastic' ) => 'link_no',
				__( 'Open custom link', 'flatastic' ) => 'custom_link'
			),
			'description' => __( 'What to do when slide is clicked?', 'flatastic' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'flatastic' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide here. Divide links with linebreaks (Enter) . ', 'flatastic' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'flatastic' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open  custom links.', 'flatastic' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $mad_target_arr
		),
		array(
			'type' => 'number',
			'heading' => __( 'Slide speed', 'flatastic' ),
			'param_name' => 'speed',
			'value' => 1000,
			'description' => __( 'Duration of animation between slides (in ms)', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Autoplay', 'flatastic' ),
			'param_name' => 'autoplay',
			'description' => __( 'Enables autoplay mode.', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'number',
			'heading' => __( 'Autoplay timeout', 'flatastic' ),
			'param_name' => 'autoplaytimeout',
			'description' => __( 'Autoplay interval timeout', 'flatastic' ),
			'value' => 5000,
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( 'yes' )
			),
		),
		$mad_add_css_animation,
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'flatastic' ),
			'param_name' => 'el_class',
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'flatastic' )
		)
	)
) );

/* Gallery/Slideshow
---------------------------------------------------------- */

vc_map( array(
	'name' => __( 'Image Gallery', 'flatastic' ),
	'base' => 'vc_mad_gallery',
	'icon' => 'icon-wpb-images-stack',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Responsive image gallery', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery type', 'flatastic' ),
			'param_name' => 'type',
			'value' => array(
				__( 'Image grid', 'flatastic' ) => 'image_grid',
				__( 'Masonry', 'flatastic' ) => 'masonry_grid'
			),
			'description' => __( 'Select gallery type.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'flatastic' ),
			'param_name' => 'img_size',
			'description' => __( 'Enter image size in pixels: 200*100 (Width * Height). Leave empty to use full size. Divide image size with (^).', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery Columns', 'flatastic' ),
			'param_name' => 'columns',
			'value' => array(
				2 => 2,
				3 => 3,
				4 => 4,
			),
			'dependency' => array(
				'element' => 'type',
				'value' => array('image_grid')
			),
			'description' => __( 'Choose the column count of your Gallery', 'flatastic' )
		),
		array(
			'type' => 'attach_images',
			'heading' => __( 'Images', 'flatastic' ),
			'param_name' => 'images',
			'value' => '',
			'description' => __( 'Select images from media library.', 'flatastic' )
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Display show image title?', 'flatastic' ),
			'param_name' => 'image_title',
			'description' => __( '', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => 'yes' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'On click', 'flatastic' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'Open Lightbox', 'flatastic' ) => 'link_image',
				__( 'Do nothing', 'flatastic' ) => 'link_no',
				__( 'Open custom link', 'flatastic' ) => 'custom_link'
			),
			'description' => __( 'Define action for onclick event if needed.', 'flatastic' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Custom links', 'flatastic' ),
			'param_name' => 'custom_links',
			'description' => __('Enter links for each slide here. Divide links with linebreaks (|) .', 'flatastic' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'flatastic' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open  custom links.', 'flatastic' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' )
			),
			'value' => $mad_target_arr
		),
	)
));

/* Google maps element
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Google Maps', 'flatastic' ),
	'base' => 'vc_mad_gmaps',
	'icon' => 'icon-wpb-map-pin',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Map block', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => __( 'Map embed iframe', 'flatastic' ),
			'param_name' => 'link',
			'description' => sprintf( __( 'Visit %s to create your map. 1) Find location 2) Click "Share" and make sure map is public on the web 3) Click folder icon to reveal "Embed on my site" link 4) Copy iframe code and paste it here.', 'flatastic' ), '<a href="https://mapsengine.google.com/" target="_blank">Google maps</a>' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Map align', 'flatastic' ),
			'param_name' => 'align',
			'value' => array(
				__( 'None', 'flatastic' ) => '',
				__( 'Left', 'flatastic' ) => 'alignleft',
				__( 'Right', 'flatastic' ) => 'alignright'
			),
			'description' => __( 'Choose the alignment of your map here', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Map width', 'flatastic' ),
			'param_name' => 'width',
			'admin_label' => true,
			'description' => __( 'Enter map width in pixels. Example: 200 or leave it empty to make map responsive.', 'flatastic' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Map height', 'flatastic' ),
			'param_name' => 'height',
			'admin_label' => true,
			'description' => __( 'Enter map height in pixels. Example: 200 or leave it empty to make map responsive.', 'flatastic' )
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Map type', 'flatastic' ),
			'param_name' => 'type',
			'value' => array( __( 'Map', 'flatastic' ) => 'm', __( 'Satellite', 'flatastic' ) => 'k', __( 'Map + Terrain', 'flatastic' ) => "p" ),
			'description' => __( 'Select map type.', 'flatastic' )
  		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Map Zoom', 'flatastic' ),
			'param_name' => 'zoom',
			'value' => array( __( '14 - Default', 'flatastic' ) => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Remove info bubble', 'flatastic' ),
			'param_name' => 'bubble',
			'description' => __( 'If selected, information bubble will be hidden.', 'flatastic' ),
			'value' => array( __( 'Yes, please', 'flatastic' ) => true),
		)
	)
) );



/* Dropcap
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Dropcap', 'flatastic' ),
	'base' => 'vc_mad_dropcap',
	'icon' => 'icon-wpb-mad-dropcap',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Dropcap', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Type', 'flatastic' ),
			'param_name' => 'type',
			'value' => array(
				__('Type 1', 'flatastic') => 'type_1',
				__('Type 2', 'flatastic') => 'type_2'
			),
			'description' => __('Choose the first letter style.', 'flatastic')
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Letter', 'flatastic' ),
			'param_name' => 'letter',
			'admin_label' => true,
			'description' => __( '', 'flatastic' )
		),
		array(
			'type' => 'textarea_html',
			'holder' => 'div',
			'heading' => __( 'Text', 'flatastic' ),
			'param_name' => 'content',
			'value' => __( '<p>Click edit button to change this text.</p>', 'flatastic' )
		),
	)
));

/* Graph
---------------------------------------------------------- */
vc_map( array(
	'name' => __( 'Progress Bar', 'flatastic' ),
	'base' => 'vc_mad_progress_bar',
	'icon' => 'icon-wpb-mad-progress-bar',
	'category' => __( 'Content', 'flatastic' ),
	'description' => __( 'Animated progress bar', 'flatastic' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'flatastic' ),
			'param_name' => 'title',
			'description' => __( 'Enter text which will be used as title. Leave blank if no title is needed.', 'flatastic' )
		),
		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Graphic values', 'flatastic' ),
			'param_name' => 'values',
			'description' => __( 'Input graph values, titles and color here. Divide values with linebreaks (Enter). Example: 90|Development|#e75956', 'flatastic' ),
			'value' => "90|Development,80|Design,70|Marketing"
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Units', 'flatastic' ),
			'param_name' => 'units',
			'description' => __( 'Enter measurement units (if needed) Eg. %, px, points, etc. Graph value and unit will be appended to the graph title.', 'flatastic' )
		)
	)
) );





/*** Visual Composer Content elements refresh ***/
class MadVcSharedLibrary {
	// Here we will store plugin wise (shared) settings. Colors, Locations, Sizes, etc...
	/**
	 * @var array
	 */
	private static $colors = array(
		'Blue' => 'blue',
		'Turquoise' => 'turquoise',
		'Pink' => 'pink',
		'Violet' => 'violet',
		'Peacoc' => 'peacoc',
		'Chino' => 'chino',
		'Mulled Wine' => 'mulled_wine',
		'Vista Blue' => 'vista_blue',
		'Black' => 'black',
		'Grey' => 'grey',
		'Orange' => 'orange',
		'Sky' => 'sky',
		'Green' => 'green',
		'Juicy pink' => 'juicy_pink',
		'Sandy brown' => 'sandy_brown',
		'Purple' => 'purple',
		'White' => 'white'
	);

	/**
	 * @var array
	 */
	public static $icons = array(
		'Glass' => 'glass',
		'Music' => 'music',
		'Search' => 'search'
	);

	/**
	 * @var array
	 */
	public static $sizes = array(
		'Mini' => 'xs',
		'Small' => 'sm',
		'Normal' => 'md',
		'Large' => 'lg'
	);

	/**
	 * @var array
	 */
	public static $button_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'3D' => '3d',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $message_box_styles = array(
		'Standard' => 'standard',
		'Solid' => 'solid',
		'Solid icon' => 'solid-icon',
		'Outline' => 'outline',
		'3D' => '3d',
	);

	/**
	 * Toggle styles
	 * @var array
	 */
	public static $toggle_styles = array(
		'Default' => 'default',
		'Simple' => 'simple',
		'Round' => 'round',
		'Round Outline' => 'round_outline',
		'Rounded' => 'rounded',
		'Rounded Outline' => 'rounded_outline',
		'Square' => 'square',
		'Square Outline' => 'square_outline',
		'Arrow' => 'arrow',
		'Text Only' => 'text_only'
	);

	/**
	 * @var array
	 */
	public static $cta_styles = array(
		'Rounded' => 'rounded',
		'Square' => 'square',
		'Round' => 'round',
		'Outlined' => 'outlined',
		'Square Outlined' => 'square_outlined'
	);

	/**
	 * @var array
	 */
	public static $txt_align = array(
		'Left' => 'left',
		'Right' => 'right',
		'Center' => 'center',
		'Justify' => 'justify'
	);

	/**
	 * @var array
	 */
	public static $el_widths = array(
		'100%' => '',
		'90%' => '90',
		'80%' => '80',
		'70%' => '70',
		'60%' => '60',
		'50%' => '50',
		'40%' => '40',
		'30%' => '30'
	);

	/**
	 * @var array
	 */
	public static $sep_widths = array(
		'1px' => '',
		'2px' => '2',
		'3px' => '3',
		'4px' => '4',
		'5px' => '5',
		'6px' => '6',
		'7px' => '7',
		'8px' => '8',
		'9px' => '9',
		'10px' => '10'
	);

	/**
	 * @var array
	 */
	public static $sep_styles = array(
		'Border' => '',
		'Dashed' => 'dashed',
		'Dotted' => 'dotted',
		'Double' => 'double'
	);

	/**
	 * @var array
	 */
	public static $box_styles = array(
		'Default' => '',
		'Rounded' => 'vc_box_rounded',
		'Border' => 'vc_box_border',
		'Outline' => 'vc_box_outline',
		'Shadow' => 'vc_box_shadow',
		'Bordered shadow' => 'vc_box_shadow_border',
		'3D Shadow' => 'vc_box_shadow_3d',
		'Circle' => 'vc_box_circle', //new
		'Circle Border' => 'vc_box_border_circle', //new
		'Circle Outline' => 'vc_box_outline_circle', //new
		'Circle Shadow' => 'vc_box_shadow_circle', //new
		'Circle Border Shadow' => 'vc_box_shadow_border_circle' //new
	);

	/**
	 * @return array
	 */
	public static function getColors() {
		return self::$colors;
	}

	/**
	 * @return array
	 */
	public static function getIcons() {
		return self::$icons;
	}

	/**
	 * @return array
	 */
	public static function getSizes() {
		return self::$sizes;
	}

	/**
	 * @return array
	 */
	public static function getButtonStyles() {
		return self::$button_styles;
	}

	/**
	 * @return array
	 */
	public static function getMessageBoxStyles() {
		return self::$message_box_styles;
	}

	/**
	 * @return array
	 */
	public static function getToggleStyles() {
		return self::$toggle_styles;
	}

	/**
	 * @return array
	 */
	public static function getCtaStyles() {
		return self::$cta_styles;
	}

	/**
	 * @return array
	 */
	public static function getTextAlign() {
		return self::$txt_align;
	}

	/**
	 * @return array
	 */
	public static function getBorderWidths() {
		return self::$sep_widths;
	}

	/**
	 * @return array
	 */
	public static function getElementWidths() {
		return self::$el_widths;
	}

	/**
	 * @return array
	 */
	public static function getSeparatorStyles() {
		return self::$sep_styles;
	}

	/**
	 * @return array
	 */
	public static function getBoxStyles() {
		return self::$box_styles;
	}

	public static function getColorsDashed() {
		$colors = array(
			__( 'Blue', 'flatastic' ) => 'blue',
			__( 'Turquoise', 'flatastic' ) => 'turquoise',
			__( 'Pink', 'flatastic' ) => 'pink',
			__( 'Violet', 'flatastic' ) => 'violet',
			__( 'Peacoc', 'flatastic' ) => 'peacoc',
			__( 'Chino', 'flatastic' ) => 'chino',
			__( 'Mulled Wine', 'flatastic' ) => 'mulled-wine',
			__( 'Vista Blue', 'flatastic' ) => 'vista-blue',
			__( 'Black', 'flatastic' ) => 'black',
			__( 'Grey', 'flatastic' ) => 'grey',
			__( 'Orange', 'flatastic' ) => 'orange',
			__( 'Sky', 'flatastic' ) => 'sky',
			__( 'Green', 'flatastic' ) => 'green',
			__( 'Juicy pink', 'flatastic' ) => 'juicy-pink',
			__( 'Sandy brown', 'flatastic' ) => 'sandy-brown',
			__( 'Purple', 'flatastic' ) => 'purple',
			__( 'White', 'flatastic' ) => 'white'
		);

		return $colors;
	}
}

//VcSharedLibrary::getColors();
/**
 * @param string $asset
 *
 * @return array
 */
function madGetVcShared( $asset = '' ) {
	switch ( $asset ) {
		case 'colors':
			return MadVcSharedLibrary::getColors();
			break;

		case 'colors-dashed':
			return MadVcSharedLibrary::getColorsDashed();
			break;

		case 'icons':
			return MadVcSharedLibrary::getIcons();
			break;

		case 'sizes':
			return MadVcSharedLibrary::getSizes();
			break;

		case 'button styles':
		case 'alert styles':
			return MadVcSharedLibrary::getButtonStyles();
			break;
		case 'message_box_styles':
			return MadVcSharedLibrary::getMessageBoxStyles();
			break;
		case 'cta styles':
			return MadVcSharedLibrary::getCtaStyles();
			break;

		case 'text align':
			return MadVcSharedLibrary::getTextAlign();
			break;

		case 'cta widths':
		case 'separator widths':
			return MadVcSharedLibrary::getElementWidths();
			break;

		case 'separator styles':
			return MadVcSharedLibrary::getSeparatorStyles();
			break;

		case 'separator border widths':
			return MadVcSharedLibrary::getBorderWidths();
			break;

		case 'single image styles':
			return MadVcSharedLibrary::getBoxStyles();
			break;

		case 'toggle styles':
			return MadVcSharedLibrary::getToggleStyles();
			break;

		default:
			# code...
			break;
	}

	return '';
}