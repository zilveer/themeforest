<?php
add_shortcode( 'vcm_mental_quote_section', 'vcm_mental_quote_section_shortcode' );
function vcm_mental_quote_section_shortcode( $atts, $content = null ) {
	$atts_orig = $atts;

	$atts = shortcode_atts( array(
		'quote'   => '',
		'author'  => '',
		'animate' => ''
	), $atts, 'vcm_mental_quote_section' );

	$atts_orig['classes'] = isset( $atts_orig['classes'] ) ? $atts_orig['classes'] : '' . ' st-padding-xl';

	ob_start();
	?>

	<?php echo get_section_header( $atts_orig ) ?>

	<div class="container testimonial" <?php if ( $atts['animate'] )
		echo 'data-animate="' . esc_attr( $atts['animate'] ) . '"'; ?>>
		<h3 class="citation-big">&#8220;<?php echo esc_html( $atts['quote'] ); ?>&#8221;</h3>

		<p class="author-big"><?php echo esc_html( $atts['author'] ); ?></p>
	</div> <!-- container -->

	<?php echo get_section_footer( $atts_orig ) ?>

	<?php
	return ob_get_clean();
}
$animate_css_options = array('' => '', 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'bounceOut' => 'bounceOut', 'bounceOutDown' => 'bounceOutDown', 'bounceOutLeft' => 'bounceOutLeft', 'bounceOutRight' => 'bounceOutRight', 'bounceOutUp' => 'bounceOutUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'fadeOut' => 'fadeOut', 'fadeOutDown' => 'fadeOutDown', 'fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeft' => 'fadeOutLeft', 'fadeOutLeftBig' => 'fadeOutLeftBig', 'fadeOutRight' => 'fadeOutRight', 'fadeOutRightBig' => 'fadeOutRightBig', 'fadeOutUp' => 'fadeOutUp', 'fadeOutUpBig' => 'fadeOutUpBig', 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'flipOutX' => 'flipOutX', 'flipOutY' => 'flipOutY', 'lightSpeedIn' => 'lightSpeedIn', 'lightSpeedOut' => 'lightSpeedOut', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rotateOut' => 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft', 'rotateOutDownRight' => 'rotateOutDownRight', 'rotateOutUpLeft' => 'rotateOutUpLeft', 'rotateOutUpRight' => 'rotateOutUpRight', 'hinge' => 'hinge', 'rollIn' => 'rollIn', 'rollOut' => 'rollOut', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'zoomOut' => 'zoomOut', 'zoomOutDown' => 'zoomOutDown', 'zoomOutLeft' => 'zoomOutLeft', 'zoomOutRight' => 'zoomOutRight', 'zoomOutUp' => 'zoomOutUp');
vc_map( array(
	'icon'            => 'vcm-mental-quote-section',
	'name'            => __( 'Mentas Qoute Section', 'mental' ),
	"base"            => "vcm_mental_quote_section", // bind with our shortcode
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
			'param_name' => 'quote',
			'heading'    => __( 'Quote', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'author',
			'heading'    => __( 'Author', 'mental' )
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
			'param_name' => 'animate',
			'heading'    => __( 'Animation', 'mental' ),
			'value'      => $animate_css_options
		),
	)
) );