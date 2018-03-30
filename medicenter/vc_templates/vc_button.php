<?php
$output = $color = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract( shortcode_atts( array(
	'color' => 'wpb_button',
	'text_color' => '#FFFFFF',
	'hover_text_color' => '#FFFFFF',
	'custom_button_color' => '',
	'hover_color' => '',
	'custom_button_hover_color' => '',
	'size' => '',
	'icon' => 'none',
	'target' => '_self',
	'href' => '',
	'el_class' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'position' => '',
	'top_margin' => 'none'
), $atts ) );
$a_class = '';

if ( $el_class != '' ) {
	$tmp_class = explode( " ", strtolower( $el_class ) );
	$tmp_class = str_replace( ".", "", $tmp_class );
	if ( in_array( "prettyphoto", $tmp_class ) ) {
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );
		$a_class .= ' prettyphoto';
		$el_class = str_ireplace( "prettyphoto", "", $el_class );
	}
	if ( in_array( "pull-right", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-right';
		$el_class = str_ireplace( "pull-right", "", $el_class );
	}
	if ( in_array( "pull-left", $tmp_class ) && $href != '' ) {
		$a_class .= ' pull-left';
		$el_class = str_ireplace( "pull-left", "", $el_class );
	}
}

if ( $target == 'same' || $target == '_self' ) {
	$target = '';
}
$target = ( $target != '' ) ? ' target="' . $target . '"' : '';

$icon_orig = $icon;

$color = ($custom_button_color!='' ? $custom_button_color : $color);
$hover_color = ($custom_button_hover_color!='' ? $custom_button_hover_color : $hover_color);
$size = ( $size != '' && $size != 'wpb_regularsize' ) ? ' ' . $size : ' ' . $size;
$icon = ( $icon != '' && $icon != 'none' ) ? ' '.$icon.($icon=="icon_small_arrow" ? ($color=="transparent" ? ' margin_right_black' : ' margin_right_white') : '') : '';
$i_icon = ( $icon != '' ) ? ' <i class="icon"> </i>' : '';
$position = ( $position != '' ) ? ' ' . $position . '-button-position' : '';
$el_class = $this->getExtraClass( $el_class );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'wpb_button ' . $color . $size . $icon . $el_class . $position, $this->settings['base'], $atts );

$output .= '<a style="color:'.$text_color.';background-color:'.$color.';border-color:'.($color=="transparent" ? '#E0E0E0' : $color).';" onMouseOver="this.style.color=\''.$hover_text_color.'\';this.style.backgroundColor=\''.$hover_color.'\';this.style.borderColor=\''.($hover_color=="transparent" ? '#E0E0E0' : $hover_color).'\'" onMouseOut="this.style.color=\''.$text_color.'\';this.style.backgroundColor=\''.$color.'\';this.style.borderColor=\''.($color=="transparent" ? '#E0E0E0' : $color).'\'" title="'.$title.'" href="'.$href.'"'.$target.' class="mc_button more'.$size.$icon.$el_class.$position.$a_class.($top_margin!='none' ? ' ' . $top_margin : '').'">'.$title.($icon_orig!="icon_small_arrow" ? $i_icon : '').'</a>';


echo $output . $this->endBlockComment( 'button' ) . "\n";