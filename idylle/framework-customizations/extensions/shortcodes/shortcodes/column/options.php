<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'title' => array(
		'label' => esc_html__('Title', 'idylle'),
		'type'  => 'text'
	),
	'lettering' => array(
		'type'   => 'switch',
		'label'  => esc_html__( 'Lettering', 'idylle' ),
	),
	'subtitle' => array(
		'label' => esc_html__('Subtitle', 'idylle'),
		'type'  => 'text'
	),
	'idylle_white_txt' => array(
		'label'        => esc_html__('White Text', 'idylle'),
		'type'         => 'switch',
	),
	'idylle_column_padding' => array(
		'label'        => esc_html__('Padding in Block', 'idylle'),
		'type'         => 'switch',
	),

	'background_color' => array(
		'label' => esc_html__('Background Color', 'idylle'),
		'desc'  => esc_html__('Please select the background color', 'idylle'),
		'type'  => 'color-picker'
	),
	'background_image' => array(
		'label'   => esc_html__('Background Image', 'idylle'),
		'desc'    => esc_html__('Please select the background image', 'idylle'),
		'type'    => 'background-image',
		'choices' => array(//	in future may will set predefined images
		)
	),
	'video' => array(
		'label' => esc_html__('Background Video', 'idylle'),
		'desc'  => esc_html__('Insert Video URL to embed this video', 'idylle'),
		'type'  => 'text'
	),
	'over_display' => array(
        'type'  => 'switch',
        'label' => esc_html__('Display Over', 'idylle')
    ),
    'over_color' => array(
	    'type'  => 'color-picker',
	    'value' => '#000',
	    'label' => esc_html__('Over Color', 'idylle')
	),
	'over_opacity'   => array(
		'label' => esc_html__( 'Opacity', 'idylle' ),
		'type'  => 'text',
		'value' => '0.3'
	)
);
