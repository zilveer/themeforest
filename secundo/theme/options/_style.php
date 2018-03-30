<?php

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_100_font.png',
	'title' => __('Font', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_font_style',
			'title' => __("Font style", 'ct_theme'),
			'type' => 'google_webfonts',
			'options' => array("Arial" => "Arial")
		),

		array(
			'id' => 'style_font_size',
			'type' => 'text',
			'title' => __('Default font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h1',
			'type' => 'text',
			'title' => __('H1 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h2',
			'type' => 'text',
			'title' => __('H2 font size (px)', 'ct_theme'),
		), array(
			'id' => 'style_font_size_h3',
			'type' => 'text',
			'title' => __('H3 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h4',
			'type' => 'text',
			'title' => __('H4 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h5',
			'type' => 'text',
			'title' => __('H5 font size (px)', 'ct_theme'),
		),
		array(
			'id' => 'style_font_size_h6',
			'type' => 'text',
			'title' => __('H6 font size (px)', 'ct_theme'),
		)
	)
);

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_091_adjust.png',
	'title' => __('Color', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_info0',
			'type' => 'info',
			'desc' => __('<h4>Motive color (default green pattern)</h4>', 'ct_theme')
		),
		array(
			'id' => "style_color_motive_background",
			'title' => __("Motive Color", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_motive_background_image",
			'title' => __("Motive Background image", 'ct_theme'),
			'type' => 'upload'
		),

		array(
			'id' => 'style_info00',
			'type' => 'info',
			'desc' => __('<h4>Second Motive color (default orange pattern)</h4>', 'ct_theme')
		),
		array(
			'id' => "style_color_motive2_color",
			'title' => __("Second Motive Color", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_motive2_arrows",
			'title' => __("Arrows Image", 'ct_theme'),
			'type' => 'upload'
		),

		array(
			'id' => 'style_info',
			'type' => 'info',
			'desc' => __('<h4>Color 1 scheme</h4>', 'ct_theme')
		),
		array(
			'id' => "style_color_basic_background",
			'title' => __("Background", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_basic_background_image",
			'title' => __("Background image", 'ct_theme'),
			'type' => 'upload'
		),
		array(
			'id' => "style_color_basic_heading",
			'title' => __("Heading", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_basic_text",
			'title' => __("Text", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_basic_link",
			'title' => __("Link", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_basic_link_hover",
			'title' => __("Link hover", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info_2',
			'type' => 'info',
			'desc' => __('<h4>Color 2 scheme</h4>', 'ct_theme')
		),

		array(
			'id' => "style_color_2_background",
			'title' => __("Background", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_2_background_image",
			'title' => __("Background image", 'ct_theme'),
			'type' => 'upload'
		),
		array(
			'id' => "style_color_2_heading",
			'title' => __("Heading", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_2_heading_strong",
			'title' => __("Heading - strong", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_2_text",
			'title' => __("Text", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_2_link",
			'title' => __("Link", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_2_link_hover",
			'title' => __("Link hover", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info_3',
			'type' => 'info',
			'desc' => __('<h4>Color 3 scheme</h4>', 'ct_theme')
		),

		array(
			'id' => "style_color_3_background",
			'title' => __("Background", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_3_background_image",
			'title' => __("Background image", 'ct_theme'),
			'type' => 'upload'
		),
		array(
			'id' => "style_color_3_heading",
			'title' => __("Heading", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_3_heading_strong",
			'title' => __("Heading - strong", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_3_text",
			'title' => __("Text", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_3_link",
			'title' => __("Link", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_3_link_hover",
			'title' => __("Link hover", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info_4',
			'type' => 'info',
			'desc' => __('<h4>Color 4 scheme</h4>', 'ct_theme')
		),

		array(
			'id' => "style_color_4_background",
			'title' => __("Background", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_4_background_image",
			'title' => __("Background image", 'ct_theme'),
			'type' => 'upload'
		),
		array(
			'id' => "style_color_4_heading",
			'title' => __("Heading", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_4_heading_strong",
			'title' => __("Heading - strong", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_4_text",
			'title' => __("Text", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_4_link",
			'title' => __("Link", 'ct_theme'),
			'type' => 'color'
		),
		array(
			'id' => "style_color_4_link_hover",
			'title' => __("Link hover", 'ct_theme'),
			'type' => 'color'
		),
	)
);

$sections[] = array(
	'icon' => NHP_OPTIONS_URL . 'img/glyphicons/glyphicons_245_chat.png',
	'title' => __('Contact widget', 'ct_theme'),
	'group' => __("Style", 'ct_theme'),
	'fields' => array(
		array(
			'id' => 'style_info',
			'type' => 'info',
			'desc' => __('<h4>Color 1 scheme</h4>', 'ct_theme')
		),
		array(
			'id' => "style_contact_widget_1_label_color",
			'title' => __("Label color", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info',
			'type' => 'info',
			'desc' => __('<h4>Color 2 scheme</h4>', 'ct_theme')
		),
		array(
			'id' => "style_contact_widget_2_label_color",
			'title' => __("Label color", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info',
			'type' => 'info',
			'desc' => __('<h4>Color 3 scheme</h4>', 'ct_theme')
		),
		array(
			'id' => "style_contact_widget_3_label_color",
			'title' => __("Label color", 'ct_theme'),
			'type' => 'color'
		),

		array(
			'id' => 'style_info',
			'type' => 'info',
			'desc' => __('<h4>Color 4 scheme</h4>', 'ct_theme')
		),
		array(
			'id' => "style_contact_widget_4_label_color",
			'title' => __("Label color", 'ct_theme'),
			'type' => 'color'
		),

	)
);