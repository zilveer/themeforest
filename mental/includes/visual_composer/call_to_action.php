<?php
/* ========================================================================= *\
   Call to Action
\* ========================================================================= */

$animate_css_options = array('' => '', 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'bounceOut' => 'bounceOut', 'bounceOutDown' => 'bounceOutDown', 'bounceOutLeft' => 'bounceOutLeft', 'bounceOutRight' => 'bounceOutRight', 'bounceOutUp' => 'bounceOutUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'fadeOut' => 'fadeOut', 'fadeOutDown' => 'fadeOutDown', 'fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeft' => 'fadeOutLeft', 'fadeOutLeftBig' => 'fadeOutLeftBig', 'fadeOutRight' => 'fadeOutRight', 'fadeOutRightBig' => 'fadeOutRightBig', 'fadeOutUp' => 'fadeOutUp', 'fadeOutUpBig' => 'fadeOutUpBig', 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'flipOutX' => 'flipOutX', 'flipOutY' => 'flipOutY', 'lightSpeedIn' => 'lightSpeedIn', 'lightSpeedOut' => 'lightSpeedOut', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rotateOut' => 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft', 'rotateOutDownRight' => 'rotateOutDownRight', 'rotateOutUpLeft' => 'rotateOutUpLeft', 'rotateOutUpRight' => 'rotateOutUpRight', 'hinge' => 'hinge', 'rollIn' => 'rollIn', 'rollOut' => 'rollOut', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'zoomOut' => 'zoomOut', 'zoomOutDown' => 'zoomOutDown', 'zoomOutLeft' => 'zoomOutLeft', 'zoomOutRight' => 'zoomOutRight', 'zoomOutUp' => 'zoomOutUp');

add_shortcode( 'vcm_mental_call_to_action', 'vcm_mental_call_to_action_shortcode' );
function vcm_mental_call_to_action_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title'           => '',
		'button_position' => 'bottom',
		'button_text'     => 'Lets go',
		'link'            => '',
		'animate'         => '',
	), $atts, 'vcm_mental_call_to_action' );

	ob_start();
	?>

	<?php if ( $atts['button_position'] == 'bottom' ): ?>

		<div class="well call-to-action text-center" <?php if ( ! empty( $atts['animate'] ) ) {
			echo 'data-animate="' . esc_attr( $atts['animate'] ) . '"';
		} ?>>
			<h3><?php echo esc_html( $atts['title'] ); ?></h3>
			<a href="<?php echo esc_attr( $atts['link'] ); ?>"
			   class="btn btn-primary btn-lg btn-wider"><?php echo esc_html( $atts['button_text'] ); ?></a>
		</div>

	<?php else: ?>

		<div class="well call-to-action text-center" <?php if ( ! empty( $atts['animate'] ) ) {
			echo 'data-animate="' . esc_attr( $atts['animate'] ) . '"';
		} ?>>
			<div class="row">
				<div class="col-lg-8">
					<h3><?php echo esc_html( $atts['title'] ) ?></h3>
				</div>
				<div class="col-lg-4">
					<a href="<?php echo esc_attr( $atts['link'] ); ?>"
					   class="btn btn-primary btn-lg btn-wider"><?php echo esc_html( $atts['button_text'] ); ?></a>
				</div>
			</div>
		</div>

	<?php endif ?>

	<?php
	return ob_get_clean();
}

vc_map( array(
	'icon'            => 'vcm-mental-call-to-action',
	'name'            => __( 'Mentas Call to Action', 'mental' ),
	"base"            => "vcm_mental_call_to_action", // bind with our shortcode
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
			'type'       => 'dropdown',
			'param_name' => 'button_position',
			'heading'    => __( 'Button position', 'mental' ),
			'value'      => array(
				__( 'Bottom', 'mental' ) => 'bottom',
				__( 'Right', 'mental' )  => 'right',
			)
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'button_text',
			'heading'    => __( 'Button text', 'mental' ),
			'value'      => 'Lets go',
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'link',
			'heading'    => __( 'Link', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'animate',
			'heading'    => __( 'Animation', 'mental' ),
			'value'      => $animate_css_options
		),
	)
) );