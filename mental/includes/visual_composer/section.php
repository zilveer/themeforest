<?php
add_shortcode( 'vcm_mental_section', 'vcm_mental_section_shortcode' );
function vcm_mental_section_shortcode( $atts, $content = null ) {
	$atts_orig = $atts;

	$atts = shortcode_atts( array(
		'no_container' => 'no',
	), $atts, 'vcm_mental_section' );

	ob_start();
	?>

	<?php echo get_section_header( $atts_orig ) ?>

	<?php if ( $atts['no_container'] != 'yes' ) echo '<div class="container">'; ?>
	<?php echo do_shortcode( $content ) ?>
	<?php if ( $atts['no_container'] != 'yes' ) echo '</div> <!-- container -->'; ?>

	<?php echo get_section_footer( $atts_orig ) ?>

	<?php
	return ob_get_clean();
}

add_action( 'vc_before_init', 'vcm_section_integrateWithVC' );
function vcm_section_integrateWithVC() {
	vc_map( array(
		'icon'            => 'vcm-mental-section',
		'name'            => __( 'Mentas Section', 'mental' ),
		"base"            => "vcm_mental_section", // bind with our shortcode
		"content_element" => true, // set this parameter when element will has a content
		"is_container"    => true, // set this param when you need to add a content element in this element
		"category"        => __( 'Mentas Elements' ),
		// Here starts the definition of array with parameters of our compnent
		"params"          => array(
			array(
				'type'       => 'textfield',
				'param_name' => 'title',
				'heading'    => __( 'Title', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'description',
				'heading'    => __( 'Description', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'padding_top',
				'heading'    => __( 'Top Padding', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'padding_bottom',
				'heading'    => __( 'Bottom Padding', 'mental' )
			),
			array(
				'type'       => 'colorpicker',
				'param_name' => 'background_color',
				'heading'    => __( 'Background color', 'mental' )
			),
			array(
				'type'       => 'attach_image',
				'param_name' => 'background_image',
				'heading'    => __( 'Background image URL', 'mental' )
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'inverted',
				'heading'    => __( 'Dark background', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'attach_image',
				'param_name' => 'background_parallax_image',
				'heading'    => __( 'Background parallax image URL', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'background_parallax_ratio',
				'heading'    => __( 'Background parallax ratio', 'mental' ),
				'value'      => '0.5'
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'background_parallax_offset',
				'value'      => '-150',
				'heading'    => __( 'Background parallax offset', 'mental' )
			),
			array(
				'type'       => 'attach_video',
				'param_name' => 'background_video',
				'heading'    => __( 'Video background video URL', 'mental' )
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'background_video_opacity',
				'heading'    => __( 'Video background opacity', 'mental' ),
				'value'      => '0.1'
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'full_height',
				'heading'    => __( '100% height section', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'id',
				'heading'    => __( 'Section ID', 'mental' ),
			),
			array(
				'type'       => 'textfield',
				'param_name' => 'classes',
				'heading'    => __( 'Additional section classes', 'mental' ),
			),
			array(
				'type'       => 'dropdown',
				'param_name' => 'no_container',
				'heading'    => __( 'Section without container (content takes full page width)', 'mental' ),
				'value'      => array(
					__( 'No', 'mental' )  => 'no',
					__( 'Yes', 'mental' ) => 'yes',
				)
			),
		),
		"js_view"         => 'VcColumnView'
	) );
}

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Vcm_Mental_Section extends WPBakeryShortCodesContainer {
	}
}