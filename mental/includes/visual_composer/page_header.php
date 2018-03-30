<?php

add_shortcode( 'vcm_mental_page_header_section', 'vcm_mental_page_header_section_shortcode' );
function vcm_mental_page_header_section_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'header_main'           => '',
		'header_tag'            => '2',
		'header_sub'            => '',
		'color_main'            => '',
		'color_sub'             => '',
		'background_color_main' => '',
		'background_color_sub'  => '',
	), $atts, 'vcm_mental_page_header_section' );

	ob_start();
	?>

	<h<?php echo esc_attr( $atts['header_tag'] ); ?> class="header-main"
	                                                 style="color: <?php echo esc_attr( $atts['color_main'] ); ?>; background-color: <?php echo esc_attr( $atts['background_color_main'] ); ?>;"><?php echo esc_html( $atts['header_main'] ); ?></h<?php echo esc_attr( $atts['header_tag'] ); ?>>
	<span class="header-sub" style="color: <?php echo esc_attr( $atts['color_sub'] ); ?>; background-color: <?php echo esc_attr( $atts['background_color_sub'] ); ?>;"><?php echo esc_html( $atts['header_sub'] ); ?></span>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-page-header-section',
	'name'            => __( 'Mentas Page Header Section', 'mental' ),
	"base"            => "vcm_mental_page_header_section", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	// Here starts the definition of array with parameters of our compnent
	"params"          => array(
		array(
			'type'       => 'textfield',
			'param_name' => 'header_main',
			'heading'    => __( 'Header', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'header_tag',
			'heading'    => __( 'Heading tag', 'mental' ),
			'value'      => array(
				'H1 - Extra Large' => '1',
				'H2 - Large'       => '2',
				'H3 - Normal'      => '3',
				'H4 - Small'       => '4',
				'H5 - Smaller'     => '5',
				'H6 - Extra Small' => '6',
			)
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'header_sub',
			'heading'    => __( 'Sub header', 'mental' )
		),
		array(
			'type'       => 'colorpicker',
			'param_name' => 'color_main',
			'value'      => '#000000',
			'heading'    => __( 'Header text color', 'mental' )
		),
		array(
			'type'       => 'colorpicker',
			'param_name' => 'color_sub',
			'value'      => '#000000',
			'heading'    => __( 'Sub header text color', 'mental' )
		),
		array(
			'type'       => 'colorpicker',
			'param_name' => 'background_color_main',
			'value'      => '#FFFFFF',
			'heading'    => __( 'Header Background color', 'mental' )
		),
		array(
			'type'       => 'colorpicker',
			'param_name' => 'background_color_sub',
			'value'      => '#FFFFFF',
			'heading'    => __( 'Sub Header Background color', 'mental' )
		),
	)
) );