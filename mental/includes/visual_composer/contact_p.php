<?php
add_shortcode( 'vcm_mental_contact_p', 'vcm_mental_contact_p_shortcode' );
function vcm_mental_contact_p_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'type'    => 'address-block',
		'animate' => ''
	), $atts, 'vcm_mental_contact_p' );

	ob_start();
	?>

	<div class="<?php echo esc_attr( $atts['type'] ); ?>" <?php if ( ! empty( $atts['animate'] ) ) {
		echo 'data-animate="' . esc_attr( $atts['animate'] ) . '"';
	} ?>>
		<?php echo wpautop( do_shortcode( $content ) ) ?>
	</div>

	<?php
	return ob_get_clean();
}
$animate_css_options = array('' => '', 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'bounceOut' => 'bounceOut', 'bounceOutDown' => 'bounceOutDown', 'bounceOutLeft' => 'bounceOutLeft', 'bounceOutRight' => 'bounceOutRight', 'bounceOutUp' => 'bounceOutUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'fadeOut' => 'fadeOut', 'fadeOutDown' => 'fadeOutDown', 'fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeft' => 'fadeOutLeft', 'fadeOutLeftBig' => 'fadeOutLeftBig', 'fadeOutRight' => 'fadeOutRight', 'fadeOutRightBig' => 'fadeOutRightBig', 'fadeOutUp' => 'fadeOutUp', 'fadeOutUpBig' => 'fadeOutUpBig', 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'flipOutX' => 'flipOutX', 'flipOutY' => 'flipOutY', 'lightSpeedIn' => 'lightSpeedIn', 'lightSpeedOut' => 'lightSpeedOut', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rotateOut' => 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft', 'rotateOutDownRight' => 'rotateOutDownRight', 'rotateOutUpLeft' => 'rotateOutUpLeft', 'rotateOutUpRight' => 'rotateOutUpRight', 'hinge' => 'hinge', 'rollIn' => 'rollIn', 'rollOut' => 'rollOut', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'zoomOut' => 'zoomOut', 'zoomOutDown' => 'zoomOutDown', 'zoomOutLeft' => 'zoomOutLeft', 'zoomOutRight' => 'zoomOutRight', 'zoomOutUp' => 'zoomOutUp');
vc_map( array(
	'icon'            => 'vcm-mental-contact-p',
	'name'            => __( 'Mentas Contact Paragraph', 'mental' ),
	"base"            => "vcm_mental_contact_p", // bind with our shortcode
	"content_element" => true, // set this parameter when element will has a content
	//"is_container" => true, // set this param when you need to add a content element in this element
	"category"        => __( 'Mentas Elements' ),
	"description"     => __( 'Text paragraph with icon', 'mental' ),
	"params"          => array(
		array(
			'type'       => 'dropdown',
			'param_name' => 'type',
			'heading'    => __( 'Icon', 'mental' ),
			'value'      => array(
				'Address block' => 'address-block',
				'Phone block'   => 'phone-block',
				'Email block'   => 'email-block',
			)
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'animate',
			'heading'    => __( 'Animation', 'mental' ),
			'value'      => $animate_css_options
		),
		array(
			'type'       => 'textarea',
			'param_name' => 'content',
			'heading'    => __( 'Contact', 'mental' ),
		)
	)
) );
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_Vcm_Mental_Contact_P extends WPBakeryShortCode {
	}
}