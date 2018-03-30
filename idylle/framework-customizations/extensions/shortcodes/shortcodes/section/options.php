<?php if (!defined('FW')) {
	die('Forbidden');
}

$options = array(
	'title' => array(
		'label' => esc_html__('Title', 'idylle'),
		'type'  => 'text'
	),
	'subtitle' => array(
		'label' => esc_html__('Subtitle', 'idylle'),
		'type'  => 'text'
	),
	'id' => array(
		'label' => esc_html__('ID', 'idylle'),
		'type'  => 'text'
	),
	'fullwidth' => array(
		'label'        => esc_html__('Full Width', 'idylle'),
		'type'         => 'switch',
	),
	'white_txt' => array(
		'label'        => esc_html__('White Text', 'idylle'),
		'type'         => 'switch',
	),
	'text_align' => array(
        'type'  => 'image-picker',
        'value' => 'intro_text_lc',
        'label' => esc_html__('Text Alignment', 'idylle'),
        'choices' => array(
            'idy_text_left' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/tl.gif',
            'idy_text_center' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/tc.gif',
            'idy_text_right' => get_template_directory_uri() .'/framework-customizations/theme/options/static/img/tr.gif',                
        ),
        'blank' => true, 
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
		'choices' => array(
		)
	),
	'parallax' => array(
		'label'        => esc_html__('Parallax', 'idylle'),
		'type'         => 'switch',
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
		'desc'  => esc_html__('0.0-1', 'idylle'),
		'type'  => 'text',
		'value' => '0.3'
	)
);
