<?php

add_shortcode( 'vcm_mental_creative_minds', 'vcm_mental_creative_minds_shortcode' );
function vcm_mental_creative_minds_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'id'                         => 'creative-mind-' . rand( 1, 999 ),
		'title'                      => '',
		'description'                => '',
		'padding_top'                => '',
		'padding_bottom'             => '',
		'background_color'           => '#FFFFFF',
		'background_image'           => '',
		'background_parallax_image'  => '',
		'background_parallax_ratio'  => 0.5,
		'background_parallax_offset' => '-150',
		'background_video'           => '',
		'background_video_opacity'   => 0.1,
		'full_height'                => 'no',
		'columns_count'              => '3',
		'classes'                    => '',
	), $atts, 'vcm_mental_creative_minds' );

	ob_start();
	?>

	<?php echo get_section_header( $atts ) ?>

	<div class="creative-minds cm-cols-<?php echo esc_attr( $atts['columns_count'] ); ?>">
		<div class="row-cm">

			<?php echo do_shortcode( $content ) ?>

		</div>
	</div>

	<?php echo get_section_footer( $atts ) ?>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-creative-minds',
	'name'            => __( 'Mentas Creative Minds Section', 'mental' ),
	"base"            => "vcm_mental_creative_minds", // bind with our shortcode
	"as_parent"       => array( 'only' => 'vcm_mental_creative_minds_item' ),
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
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
			'type'        => 'attach_video',
			'param_name'  => 'background_video',
			'heading'     => __( 'Video background video URL', 'mental' ),
			'description' => __( 'You can type several different video format URLs separated by space', 'mental' )
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
			'type'       => 'dropdown',
			'param_name' => 'columns_count',
			'heading'    => __( 'Columns count', 'mental' ),
			'value'      => array(
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6'
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
	),
	"js_view"         => 'VcColumnView'
) );

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Vcm_Mental_Creative_Minds extends WPBakeryShortCodesContainer {
	}
}