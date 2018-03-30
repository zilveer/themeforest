<?php

return array(
	'icon'   => 'el el-adjust',
	'title'  => __( 'Custom colors', 'BERG' ),
	'subsection' => true,
	'fields' => array(

		array(
			'id' => 'berg_less_custom_enable',
			'type' => 'checkbox',
			'title' => __('Enable custom styles', 'BERG'),
		),

		array(
			'id' => 'berg_less_background_color_1',
			'type' => 'color',
			'title' => __('Background color 1', 'BERG'),
			'default' => '#fff',
			
		),
		array(
			'id' => 'berg_less_background_color_2',
			'type' => 'color',
			'title' => __('Background color 2', 'BERG'),
			'default' => '#111',
			
		),
		array(
			'id' => 'berg_less_background_color_3',
			'type' => 'color',
			'title' => __('Background color 3', 'BERG'),
			'default' => '#eee',
			
		),
		array(
			'id' => 'berg_less_text_color_1',
			'type' => 'color',
			'title' => __('Text color 1', 'BERG'),
			'default' => '#333',
			
		),
		array(
			'id' => 'berg_less_text_color_2',
			'type' => 'color',
			'title' => __('Text color 2', 'BERG'),
			'default' => '#fff',
			
		),
		array(
			'id' => 'berg_less_highlight_color',
			'type' => 'color',
			'title' => __('Highlight color', 'BERG'),
			'default' => '#ca293e',
			
		),
		array(
			'id' => 'berg_less_border_color',
			'type' => 'color',
			'title' => __('Border color', 'BERG'),
			'default' => '#eee',
			
		),
		array(
			'id' => 'berg_less_header_background_1',
			'type' => 'color',
			'title' => __('Navigation background color', 'BERG'),
			'default' => '#fff',
			
		),

		array(
			'id' => 'berg_less_header_background_2',
			'type' => 'color',
			'title' => __('Sub-navigation background color', 'BERG'),
			'default' => '#111',
			
		),
		array(
			'id' => 'berg_less_header_text_1',
			'type' => 'color',
			'title' => __('Navigation link color', 'BERG'),
			'default' => '#333',
			
		),

		array(
			'id' => 'berg_less_header_text_2',
			'type' => 'color',
			'title' => __('Sub-navigation link color', 'BERG'),
			'default' => '#fff',
			
		),

		array(
			'id' => 'berg_less_header_active',
			'type' => 'color',
			'title' => __('Navigation link active color', 'BERG'),
			'default' => '#ca293e',
			
		),
		array(
			'id' => 'berg_less_header_reorder_active',
			'type' => 'color',
			'title' => __('Reorder active color', 'BERG'),
			'default' => '#eee',
			
		),
		array(
			'id' => 'berg_less_footer_background',
			'type' => 'color',
			'title' => __('Footer background color', 'BERG'),
			'default' => '#111',
			
		),
		array(
			'id' => 'berg_less_footer_text',
			'type' => 'color',
			'title' => __('Footer text color', 'BERG'),
			'default' => '#cfcfcf',
			
		),
		array(
			'id' => 'berg_less_footer_link',
			'type' => 'color',
			'title' => __('Footer link color', 'BERG'),
			'default' => '#fff',
		),

		array(
			'id' => 'less_compile',
			'type' => 'less_compile',
			'title' => __('Generate CSS', 'BERG'),
		)
	)
);