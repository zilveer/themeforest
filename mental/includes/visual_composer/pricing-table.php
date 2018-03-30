<?php
add_shortcode( 'vcm_mental_pricing_table', 'vcm_mental_pricing_table_shortcode' );
function vcm_mental_pricing_table_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'title'       => '',
		'price'       => '',
		'link'        => '',
		'active'      => 'no',
		'show_button' => 'yes',
		'button_text' => __( 'Buy it now', 'mental' ),
		'items'       => '',
		'animate'     => '',
	), $atts, 'vcm_mental_pricing_table' );

	$items = explode( ',', $atts['items'] );

	ob_start();
	?>

	<div <?php if ( ! empty( $atts['animate'] ) ) {
		echo 'data-animate="' . $atts['animate'] . '"';
	} ?>>
		<div class="price-table <?php echo ( $atts['active'] == 'yes' ) ? 'active' : '' ?>">
			<header class="price-header">
				<h3><?php echo esc_html( $atts['price'] ); ?></h3>

				<p><?php echo esc_html( $atts['title'] ); ?></p>
			</header>
			<ul class="price-descr">
				<?php foreach ( $items as $item ): ?>
					<li><?php echo esc_html( $item ); ?></li>
				<?php endforeach ?>
			</ul>
			<?php if ( $atts['show_button'] == 'yes' ): ?>
				<footer class="price-footer">
					<a href="<?php echo esc_url( $atts['link'] ); ?>"
					   class="btn btn-default"><?php echo esc_html( $atts['button_text'] ); ?></a>
				</footer>
			<?php endif ?>
		</div>
	</div>

	<?php
	return ob_get_clean();
}
static $animate_css_options = array('' => '', 'bounce' => 'bounce', 'flash' => 'flash', 'pulse' => 'pulse', 'rubberBand' => 'rubberBand', 'shake' => 'shake', 'swing' => 'swing', 'tada' => 'tada', 'wobble' => 'wobble', 'bounceIn' => 'bounceIn', 'bounceInDown' => 'bounceInDown', 'bounceInLeft' => 'bounceInLeft', 'bounceInRight' => 'bounceInRight', 'bounceInUp' => 'bounceInUp', 'bounceOut' => 'bounceOut', 'bounceOutDown' => 'bounceOutDown', 'bounceOutLeft' => 'bounceOutLeft', 'bounceOutRight' => 'bounceOutRight', 'bounceOutUp' => 'bounceOutUp', 'fadeIn' => 'fadeIn', 'fadeInDown' => 'fadeInDown', 'fadeInDownBig' => 'fadeInDownBig', 'fadeInLeft' => 'fadeInLeft', 'fadeInLeftBig' => 'fadeInLeftBig', 'fadeInRight' => 'fadeInRight', 'fadeInRightBig' => 'fadeInRightBig', 'fadeInUp' => 'fadeInUp', 'fadeInUpBig' => 'fadeInUpBig', 'fadeOut' => 'fadeOut', 'fadeOutDown' => 'fadeOutDown', 'fadeOutDownBig' => 'fadeOutDownBig', 'fadeOutLeft' => 'fadeOutLeft', 'fadeOutLeftBig' => 'fadeOutLeftBig', 'fadeOutRight' => 'fadeOutRight', 'fadeOutRightBig' => 'fadeOutRightBig', 'fadeOutUp' => 'fadeOutUp', 'fadeOutUpBig' => 'fadeOutUpBig', 'flip' => 'flip', 'flipInX' => 'flipInX', 'flipInY' => 'flipInY', 'flipOutX' => 'flipOutX', 'flipOutY' => 'flipOutY', 'lightSpeedIn' => 'lightSpeedIn', 'lightSpeedOut' => 'lightSpeedOut', 'rotateIn' => 'rotateIn', 'rotateInDownLeft' => 'rotateInDownLeft', 'rotateInDownRight' => 'rotateInDownRight', 'rotateInUpLeft' => 'rotateInUpLeft', 'rotateInUpRight' => 'rotateInUpRight', 'rotateOut' => 'rotateOut', 'rotateOutDownLeft' => 'rotateOutDownLeft', 'rotateOutDownRight' => 'rotateOutDownRight', 'rotateOutUpLeft' => 'rotateOutUpLeft', 'rotateOutUpRight' => 'rotateOutUpRight', 'hinge' => 'hinge', 'rollIn' => 'rollIn', 'rollOut' => 'rollOut', 'zoomIn' => 'zoomIn', 'zoomInDown' => 'zoomInDown', 'zoomInLeft' => 'zoomInLeft', 'zoomInRight' => 'zoomInRight', 'zoomInUp' => 'zoomInUp', 'zoomOut' => 'zoomOut', 'zoomOutDown' => 'zoomOutDown', 'zoomOutLeft' => 'zoomOutLeft', 'zoomOutRight' => 'zoomOutRight', 'zoomOutUp' => 'zoomOutUp');
vc_map( array(
	'icon'            => 'vcm-mental-pricing-table',
	'name'            => __( 'Mentas Pricing Table', 'mental' ),
	"base"            => "vcm_mental_pricing_table", // bind with our shortcode
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
			'param_name' => 'price',
			'heading'    => __( 'Price', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'link',
			'heading'    => __( 'Link', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'active',
			'heading'    => __( 'Active', 'mental' ),
			'value'      => array(
				__( 'No', 'mental' )  => 'no',
				__( 'Yes', 'mental' ) => 'yes',
			)
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'show_button',
			'heading'    => __( 'Show button', 'mental' ),
			'class'      => '',
			'value'      => array(
				__( 'Yes', 'mental' ) => 'yes',
				__( 'No', 'mental' )  => 'no',
			)
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'button_text',
			'value'      => __( 'Buy it now', 'mental' ),
			'heading'    => __( 'Button text', 'mental' )
		),
		array(
			'type'       => 'textfield',
			'param_name' => 'items',
			'heading'    => __( 'Price Items (comma separated)', 'mental' )
		),
		array(
			'type'       => 'dropdown',
			'param_name' => 'animate',
			'heading'    => __( 'Animation', 'mental' ),
			'value'      => $animate_css_options
		),
	)
) );