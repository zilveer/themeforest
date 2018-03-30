<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
// http://tympanus.net/Development/CreativeLinkEffects/

$button_shortcode_name = 'styled_button';

$button_settings = array(
	/* Main settings section */
	array(
		'id' => 'title_delim',
		'label' => __('Title section', 'dfd'),
		'name' => 'title_delim',
		'type' => 'delim',
	),
	array(
		'id' => 'title',
		'label' => __('Title', 'dfd'),
		'name' => 'title',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'href',
		'label' => __('Href', 'dfd'),
		'name' => 'href',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'title_align',
		'label' => __('Title alignment', 'dfd'),
		'name' => 'title_align',
		'type' => 'select',
		'col_span' => 'half_size',
		'options' => array(
			array(
				'label' => __('Center', 'dfd'),
				'default' => true,
				'class' => 'text-center',
			),
			array(
				'label' => __('Left', 'dfd'),
				'class' => 'text-left',
			),
			array(
				'label' => __('Right', 'dfd'),
				'class' => 'text-right',
			),
		)
	),
	array(
		'id' => 'display',
		'label' => __('Button width', 'dfd'),
		'name' => 'display',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Auto', 'dfd'),
				'default' => true,
				'class' => 'inline',
			),
			array(
				'label' => __('Fullwidth', 'dfd'),
				'class' => 'block',
			),
		)
	),
	array(
		'id' => 'button_height',
		'label' => __('Button height (pixels)', 'dfd'),
		'name' => 'button_height',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'text_size',
		'label' => __('Text size (pixels)', 'dfd'),
		'name' => 'text_size',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'letter_spacing',
		'label' => __('Letter spacing (pixels)', 'dfd'),
		'name' => 'letter_spacing',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'font_family',
		'label' => __('Font family', 'dfd'),
		'name' => 'font_family',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Inherit from Block Title', 'dfd'),
				'class' => 'dfd-block-title-family',
			),
			array(
				'label' => __('Inherit from Subtitle', 'dfd'),
				'class' => 'dfd-subtitle-family',
			),
			array(
				'label' => __('Inherit from Default Body Text', 'dfd'),
				'class' => 'dfd-default-text-family',
			),
		)
	),
	array(
		'id' => 'font_weight',
		'label' => __('Font weight', 'dfd'),
		'name' => 'font_weight',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('100', 'dfd'),
				'class' => '100',
			),
			array(
				'label' => __('200', 'dfd'),
				'class' => '200',
			),
			array(
				'label' => __('300', 'dfd'),
				'class' => '300',
			),
			array(
				'label' => __('400', 'dfd'),
				'class' => '400',
			),
			array(
				'label' => __('500', 'dfd'),
				'class' => '500',
			),
			array(
				'label' => __('600', 'dfd'),
				'class' => '600',
			),
			array(
				'label' => __('700', 'dfd'),
				'class' => '700',
			),
			array(
				'label' => __('800', 'dfd'),
				'class' => '800',
			),
			array(
				'label' => __('900', 'dfd'),
				'class' => '900',
			),
		)
	),
	array(
		'id' => 'text_color',
		'label' => __('Text color', 'dfd'),
		'name' => 'text_color',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Main site color', 'dfd'),
				'class' => 'text-main',
			),
			array(
				'label' => __('Second site color', 'dfd'),
				'class' => 'text-second',
			),
			array(
				'label' => __('Third site color', 'dfd'),
				'class' => 'text-third',
			),
			array(
				'label' => __('Fourth site color', 'dfd'),
				'class' => 'text-fourth',
			),
			array(
				'label' => __('White', 'dfd'),
				'class' => 'text-white',
			),
			array(
				'label' => __('Dark', 'dfd'),
				'class' => 'text-dark',
			),
			array(
				'label' => __('Gray', 'dfd'),
				'class' => 'text-gray',
			),
		)
	),
	array(
		'id' => 'style',
		'label' => __('Hover style', 'dfd'),
		'name' => 'style',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Style 1', 'dfd'),
				'class' => 'style-1',
			),
			array(
				'label' => __('Style 2', 'dfd'),
				'class' => 'style-2',
			),
			array(
				'label' => __('Style 3', 'dfd'),
				'class' => 'style-3',
			),
		)
	),
	array(
		'id' => 'bg_color',
		'label' => __('Background color', 'dfd'),
		'name' => 'bg_color',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Main site color', 'dfd'),
				'class' => 'bg-main',
			),
			array(
				'label' => __('Second site color', 'dfd'),
				'class' => 'bg-second',
			),
			array(
				'label' => __('Third site color', 'dfd'),
				'class' => 'bg-third',
			),
			array(
				'label' => __('Fourth site color', 'dfd'),
				'class' => 'bg-fourth',
			),
			array(
				'label' => __('White', 'dfd'),
				'class' => 'bg-white',
			),
			array(
				'label' => __('Dark', 'dfd'),
				'class' => 'bg-dark',
			),
			array(
				'label' => __('Gray', 'dfd'),
				'class' => 'bg-gray',
			),
			array(
				'label' => __('Transparent', 'dfd'),
				'class' => 'bg-transparent',
			),
		)
	),
	
	/* Icon section */
	
	array(
		'id' => 'icon_delim',
		'label' => __('Icon section', 'dfd'),
		'name' => 'icon_delim',
		'type' => 'delim',
	),
	array(
		'id' => 'icon',
		'label' => __('Icon', 'dfd'),
		'name' => 'icon',
		'col_span' => 'half_size',
		'type' => 'icon'
	),
	array(
		'id' => 'icon_size',
		'label' => __('Icon size (pixels)', 'dfd'),
		'name' => 'icon_size',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'icon_style',
		'label' => __('Icon style', 'dfd'),
		'name' => 'icon_style',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Without icon', 'dfd'),
				'class' => '',
			),
			array(
				'label' => __('Left icon', 'dfd'),
				'class' => 'left-icon',
			),
			array(
				'label' => __('Right icon', 'dfd'),
				'class' => 'right-icon',
			),
			array(
				'label' => __('Animated left icon', 'dfd'),
				'class' => 'left-icon animated-icon',
			),
			array(
				'label' => __('Animated right icon', 'dfd'),
				'class' => 'right-icon animated-icon',
			),
		)
	),
	array(
		'id' => 'icon_color',
		'label' => __('Icon color', 'dfd'),
		'name' => 'icon_color',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Main site color', 'dfd'),
				'class' => 'icon-color-main',
			),
			array(
				'label' => __('Second site color', 'dfd'),
				'class' => 'icon-color-second',
			),
			array(
				'label' => __('Third site color', 'dfd'),
				'class' => 'icon-color-third',
			),
			array(
				'label' => __('Fourth site color', 'dfd'),
				'class' => 'icon-color-fourth',
			),
			array(
				'label' => __('White', 'dfd'),
				'class' => 'icon-color-white',
			),
			array(
				'label' => __('Dark', 'dfd'),
				'class' => 'icon-color-dark',
			),
			array(
				'label' => __('Gray', 'dfd'),
				'class' => 'icon-color-gray',
			),
		)
	),
	
	/* Border section */
	
	array(
		'id' => 'border_delim',
		'label' => __('Border section', 'dfd'),
		'name' => 'border_delim',
		'type' => 'delim',
	),
	array(
		'id' => 'border_width (pixels)',
		'label' => __('Border width (pixels)', 'dfd'),
		'name' => 'border_width',
		'col_span' => 'half_size',
		'type' => 'text'
	),
	array(
		'id' => 'border_style',
		'label' => __('Border style', 'dfd'),
		'name' => 'border_style',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Solid', 'dfd'),
				'class' => 'solid',
			),
			array(
				'label' => __('Dashed', 'dfd'),
				'class' => 'dashed',
			),
			array(
				'label' => __('Dotted', 'dfd'),
				'class' => 'dotted',
			)
		)
	),
	array(
		'id' => 'border_radius',
		'label' => __('Border radius (pixels)', 'dfd'),
		'name' => 'border_radius',
		'col_span' => 'half_size',
		'type' => 'text',
	),
	array(
		'id' => 'border_color',
		'label' => __('Border color', 'dfd'),
		'name' => 'border_color',
		'col_span' => 'half_size',
		'type' => 'select',
		'options' => array(
			array(
				'label' => __('Main site color', 'dfd'),
				'class' => 'border-color-main',
			),
			array(
				'label' => __('Second site color', 'dfd'),
				'class' => 'border-color-second',
			),
			array(
				'label' => __('Third site color', 'dfd'),
				'class' => 'border-color-third',
			),
			array(
				'label' => __('Fourth site color', 'dfd'),
				'class' => 'border-color-fourth',
			),
			array(
				'label' => __('White', 'dfd'),
				'class' => 'border-color-white',
			),
			array(
				'label' => __('Dark', 'dfd'),
				'class' => 'border-color-dark',
			),
			array(
				'label' => __('Gray','dfd'),
				'class' => 'border-color-gray',
			),
			array(
				'label' => __('Without border', 'dfd'),
				'class' => 'without-border',
			),
		)
	),
);
