<?php
/**
 * @var $this WPBakeryShortCode_VC_Message
 * @var array $atts
 *
 * @var string $el_class
 * @var string $style
 * @var string $shape
 * @var string $type
 * @var string $color
 * @var string $css_animation
 * @var string $message_box_type
 * @var string $message_box_style
 * @var string $message_box_shape
 * @var string $message_box_color
 * @var string $icon_type
 */
$defaultFont = 'fontawesome';
$defaultIconClass = 'fa fa-info-circle';
//$this->convert..
$atts = $this->convertAttributesToMessageBox2( $atts );
$defaults = array(
	'el_class' => '',
	'message_box_style' => 'classic',
	'style' => 'rounded', // dye to backward compatibility message_box_shape
	'color' => '', //message_box_type due to backward compatibility
	'message_box_color' => 'alert-info',
	'css_animation' => '',
	'icon_type' => $defaultFont,
	'icon_fontawesome' => $defaultIconClass,
);

$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

$elementClass = array(
	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'vc_message_box', $this->settings['base'], $atts ),
	'style' => 'vc_message_box-' . $message_box_style,
	'shape' => 'vc_message_box-' . $style,
	'color' => ( strlen( $color ) > 0 && strpos( 'alert', $color ) === false ) ? 'vc_color-' . $color : 'vc_color-' . $message_box_color,
	'extra' => $this->getExtraClass( $el_class ),
	'css_animation' => $this->getCSSAnimation( $css_animation ),
);
$elementClass = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $elementClass ) );

$bool = 1;
// Pick up icons
$iconClass = isset( ${"icon_" . $icon_type} ) ? ${"icon_" . $icon_type} : $defaultIconClass;
switch ( $color ) {
	case 'info':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-info-circle';
		$cls = 'alert-info';
		break;
	case 'alert-info':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-info';
		$cls = 'alert-info';
		break;
	case 'success':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-check';
		$cls = 'alert-success';
		break;
	case 'alert-success':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-tick';
		$cls = 'alert-success';
		break;
	case 'warning':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-exclamation-triangle';
		$cls = 'alert-warning';
		break;
	case 'alert-warning':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-alert';
		$cls = 'alert-warning';
		break;
	case 'danger':
		$icon_type = 'fontawesome';
		$iconClass = 'fa fa-times';
		$cls = 'alert-danger';
		break;
	case 'alert-danger':
		$icon_type = 'pixelicons';
		$iconClass = 'vc_pixel_icon vc_pixel_icon-explanation';
		$cls = 'alert-danger';
		break;
	case 'alert-custom':
		$bool = 0;
	default:
		break;
}

// Enqueue needed font for icon element
if ( 'pixelicons' != $icon_type ) {
	vc_icon_element_fonts_enqueue( $icon_type );
}
?>
<div class="alert <?php echo esc_attr($cls); if($dismissable == 'yes') echo ' alert-dismissable'; if($bool == 0) echo esc_attr( $elementClass ); ?>">
	<span class="alert-icon"><i class="<?php echo esc_attr( $iconClass ); ?>"></i></span>
	<?php if($closebtn == 'yes') echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="fa fa-close"></i></button>'; ?>
	<?php echo wpb_js_remove_wpautop( $content, false ); ?>
</div>