<?php
$output = $title = $el_class = $open = $css_animation = $el_id = '';

$inverted = false;
/**
 * @var string $title
 * @var string $el_class
 * @var string $open
 * @var string $css_animation
 *
 * @var array $atts
 */
extract( shortcode_atts( array(
	'title'			=> __( "Click to toggle", 'experience' ),
	'el_class'		=> '',
	'open'			=> 'false',
	'css_animation' => '',
	'el_id'			=> '',
), $atts ) );


/**
 * class wpb_toggle removed since 4.4
 * @since 4.4
 */
$elementClass = array(
	'base'			=> apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_toggle', $this->settings['base'], $atts ),
	// TODO: check this code, don't know how to get base class names from params	
	'open'			=> ( $open == 'true' ) ? 'vc_toggle_active' : '',
	'extra'			=> $this->getExtraClass( $el_class ),
	'css_animation' => $this->getCSSAnimation( $css_animation ), // @todo remove getCssAnimation as function in helpers
);

$elementClass = trim( implode( ' ', $elementClass ) );

?>
<div <?php echo isset( $el_id ) && ! empty( $el_id ) ? "id='" . esc_attr( $el_id ) . "'" : ""; ?> class="<?php echo esc_attr( $elementClass ); ?>">
	<div class="vc_toggle_title">
		<?php echo apply_filters( 'wpb_toggle_heading', '<h4><a href="#">' . esc_html( $title ) . '</a></h4>', array(
			'title' => $title,
			'open' => $open
		) ); ?>
	</div>
	<div class="vc_toggle_content">
		<?php echo wpb_js_remove_wpautop( apply_filters( 'the_content', $content ), true ); ?>
	</div>
</div>