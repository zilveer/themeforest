<?php
/** @var $this WPBakeryShortCode_VC_Icon_Element */
$icon = $color = $size = $align = $box_padding = $title = $el_class = $background_style = $background_color =
$type = $icon_fontawesome = $icon_openiconic = $icon_typicons = $icon_entypoicons = $icon_linecons = $icon_line_height = '';

$defaults = array(
	'type' => 'fontawesome',
	'icon_fontawesome' => 'fa fa-adjust',
	'icon_openiconic' => '',
	'icon_typicons' => '',
	'icon_entypoicons' => '',
	'icon_linecons' => '',
	'icon_entypo' => '',
	'color' => '#5e8cc0',
	'custom_color' => '',
	'background_style' => '',
	'background_color' => '',
	'size' => '24px',
	'padding_left' => '35px',
	'padding_right' => '35px',
	'align' => 'left',
	'el_class' => '',
	'heading' => '',
	'radius' => '5px',
	'title' => '',
	'border_width' => '2px',
	'icon_padding' => '20px',
	'icon_line_height' => '',
	'css_animation' => '',

);
/** @var array $atts - shortcode attributes */
$atts = vc_shortcode_attribute_parse( $defaults, $atts );
extract( $atts );

$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
$css_class .= $this->getCSSAnimation( $css_animation );
// Enqueue needed icon font.
vc_icon_element_fonts_enqueue( $type );


$sd_size = ( !empty( $size ) ? 'font-size: '. $size .';' : 'font-size: 24px;' );
$color = ( !empty( $color ) ? 'color: '. $color .';' : 'color: #5e8cc0;' );
$border_width = ( !empty( $border_width ) ? $border_width : '2px' );
$title = ( !empty( $title ) && $heading !== 'none' ? '<' . $heading . '>' . $title . '</' . $heading . '>' : $title );

if ( $align == 'left' ) {
	$box_padding = 'style="padding-left: ' . $padding_left . ';"';
} elseif ( $align == 'right' ){
	$box_padding = 'style="padding-right: ' . $padding_right . ';"';
}

$line_height = ( !empty( $icon_line_height ) ) ? $icon_line_height : $size;

switch ( $background_style ) {
	case 'none' :
		$background_style = '';
		break;
	
	case 'rounded' :
		$background_style = 'background-color: ' . $background_color . '; border-radius: 100%; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
		
	case 'square' :
		$background_style = 'background-color: ' . $background_color . '; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
	
	case 'rounded-square' :
		$background_style = 'background-color: ' . $background_color . '; border-radius: ' . $radius . '; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
	
	case 'outlined-rounded' :
		$background_style = 'border: ' . $border_width . ' solid  ' . $background_color . '; border-radius: 100%; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
	
	case 'outlined-square' :
		$background_style = 'border: ' . $border_width . ' solid  ' . $background_color . '; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
		
	case 'outlined-rounded-square' :
		$background_style = 'border: ' . $border_width . ' solid  ' . $background_color . '; border-radius: ' . $radius . '; line-height: ' . $line_height . '; padding: ' . $icon_padding . ';';
		break;
	
}

$icon_styles = $sd_size . $color . $background_style;

?>
<div class="sd-icon-box sd-icon-box-<?php echo esc_attr( $align ); ?> <?php echo esc_attr( $css_class ); ?>" <?php echo $box_padding ; ?>>
	<i class="<?php echo esc_attr( ${"icon_" . $type} ); ?>" style="<?php echo esc_attr( $icon_styles ); ?>"></i>
	<?php echo $title; ?>
	<?php if ( !empty( $text_content ) ) : ?>
		<?php echo $text_content; ?>
	<?php endif; ?>
	
	<?php echo wpb_js_remove_wpautop( $content, true ); ?>
</div>
		<?php echo $this->endBlockComment( '.vc_icon_element' ); ?>
