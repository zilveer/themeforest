<?php
/**
 * Shortcodes for Organique WP theme defined
 *
 * @package Organique
 */



/**
 * Adds the light class to the titles in the content (for subtitles)
 * @param  array $atts
 * @param  string $content
 * @return string HTML
 */
function sc_light( $atts, $content ) {
	return '<span class="light">' . $content . '</span>';
}
add_shortcode( "light", "sc_light" );



/**
 * Shortcode for zocial icons
 * @param  array $atts
 * @return string HTML
 */
function sc_zocial( $atts ) {
	extract( shortcode_atts( array(
		'service' => 'acrobat',
		'href'    => '#',
		'target'  => '_self',
	), $atts ) );

	return '<a class="social-container" href="' . $href . '" target="' . $target . '"><span class="zocial-' . strtolower( $service ) . '"></span></a>';
}
add_shortcode( "zocial", "sc_zocial" );



function organique_su_button( $atts = null, $content = null ) {
	$atts = shortcode_atts( array(
			'url'         => home_url(),
			'link'        => null, // 3.x
			'target'      => 'self',
			'style'       => 'default',
			'background'  => '#2D89EF',
			'color'       => '#FFFFFF',
			'dark'        => null, // 3.x
			'size'        => 3,
			'wide'        => 'no',
			'center'      => 'no',
			'radius'      => 'auto',
			'icon'        => false,
			'icon_color'  => '#FFFFFF',
			'ts_color'    => null, // Dep. 4.3.2
			'ts_pos'      => null, // Dep. 4.3.2
			'text_shadow' => 'none',
			'desc'        => '',
			'onclick'     => '',
			'class'       => ''
		), $atts, 'button' );

	if ( $atts['link'] !== null ) $atts['url'] = $atts['link'];
	if ( $atts['dark'] !== null ) {
		$atts['background'] = $atts['color'];
		$atts['color'] = ( $atts['dark'] ) ? '#000' : '#fff';
	}
	if ( is_numeric( $atts['style'] ) ) $atts['style'] = str_replace( array( '1', '2', '3', '4', '5' ), array( 'default', 'glass', 'bubbles', 'noise', 'stroked' ), $atts['style'] ); // 3.x
	// Prepare vars
	$a_css = array();
	$span_css = array();
	$img_css = array();
	$small_css = array();
	$radius = '0px';
	$before = $after = '';
	// Text shadow values
	$shadows = array(
		'none'         => '0 0',
		'top'          => '0 -1px',
		'right'        => '1px 0',
		'bottom'       => '0 1px',
		'left'         => '-1px 0',
		'top-right'    => '1px -1px',
		'top-left'     => '-1px -1px',
		'bottom-right' => '1px 1px',
		'bottom-left'  => '-1px 1px'
	);
	// Common styles for button
	$styles = array(
		'size'     => round( ( $atts['size'] + 7 ) * 1.3 ),
		'ts_color' => ( $atts['ts_color'] === 'light' ) ? su_hex_shift( $atts['background'], 'lighter', 50 ) : su_hex_shift( $atts['background'], 'darker', 40 ),
		'ts_pos'   => ( $atts['ts_pos'] !== null ) ? $shadows[$atts['ts_pos']] : $shadows['none']
	);
	// Calculate border-radius
	if ( $atts['radius'] == 'auto' ) $radius = round( $atts['size'] + 2 ) . 'px';
	elseif ( $atts['radius'] == 'round' ) $radius = round( ( ( $atts['size'] * 2 ) + 2 ) * 2 + $styles['size'] ) . 'px';
	elseif ( is_numeric( $atts['radius'] ) ) $radius = intval( $atts['radius'] ) . 'px';
	// CSS rules for <a> tag
	$a_rules = array(
		'color'                 => $atts['color'],
		'background-color'      => $atts['background'],
		'border-color'          => su_hex_shift( $atts['background'], 'darker', 20 ),
		'border-radius'         => $radius,
		'-moz-border-radius'    => $radius,
		'-webkit-border-radius' => $radius
	);
	// CSS rules for <span> tag
	$span_rules = array(
		'color'                 => $atts['color'],
		'padding'               => ( $atts['icon'] ) ? round( ( $atts['size'] ) / 2 + 4 ) . 'px ' . round( $atts['size'] * 2 + 10 ) . 'px' : '0px ' . round( $atts['size'] * 2 + 10 ) . 'px',
		'font-size'             => $styles['size'] . 'px',
		'line-height'           => ( $atts['icon'] ) ? round( $styles['size'] * 1.5 ) . 'px' : round( $styles['size'] * 2 ) . 'px',
		'border-color'          => su_hex_shift( $atts['background'], 'lighter', 30 ),
		'border-radius'         => $radius,
		'-moz-border-radius'    => $radius,
		'-webkit-border-radius' => $radius,
		'text-shadow'           => $styles['ts_pos'] . ' 1px ' . $styles['ts_color'],
		'-moz-text-shadow'      => $styles['ts_pos'] . ' 1px ' . $styles['ts_color'],
		'-webkit-text-shadow'   => $styles['ts_pos'] . ' 1px ' . $styles['ts_color']
	);
	// Apply new text-shadow value
	if ( $atts['ts_color'] === null && $atts['ts_pos'] === null ) {
		$span_rules['text-shadow'] = $atts['text_shadow'];
		$span_rules['-moz-text-shadow'] = $atts['text_shadow'];
		$span_rules['-webkit-text-shadow'] = $atts['text_shadow'];
	}
	// CSS rules for <img> tag
	$img_rules = array(
		'width'     => round( $styles['size'] * 1.5 ) . 'px',
		'height'    => round( $styles['size'] * 1.5 ) . 'px'
	);
	// CSS rules for <small> tag
	$small_rules = array(
		'padding-bottom' => round( ( $atts['size'] ) / 2 + 4 ) . 'px',
		'color' => $atts['color']
	);
	// Create style attr value for <a> tag
	foreach ( $a_rules as $a_rule => $a_value ) $a_css[] = $a_rule . ':' . $a_value;
	// Create style attr value for <span> tag
	foreach ( $span_rules as $span_rule => $span_value ) $span_css[] = $span_rule . ':' . $span_value;
	// Create style attr value for <img> tag
	foreach ( $img_rules as $img_rule => $img_value ) $img_css[] = $img_rule . ':' . $img_value;
	// Create style attr value for <img> tag
	foreach ( $small_rules as $small_rule => $small_value ) $small_css[] = $small_rule . ':' . $small_value;
	// Prepare button classes
	$classes = array( 'su-button', 'su-button-style-' . $atts['style'] );
	// Additional classes
	if ( $atts['class'] ) $classes[] = $atts['class'];
	// Wide class
	if ( $atts['wide'] === 'yes' ) $classes[] = 'su-button-wide';
	// Prepare icon
	if ( $atts['icon'] ) {
		if ( strpos( $atts['icon'], 'icon:' ) !== false ) {
			$icon = '<i class="fa fa-' . trim( str_replace( 'icon:', '', $atts['icon'] ) ) . '" style="font-size:' . $styles['size'] . 'px;color:' . $atts['icon_color'] . '"></i>';
			su_query_asset( 'css', 'font-awesome' );
		}
		else $icon = '<img src="' . $atts['icon'] . '" alt="' . esc_attr( $content ) . '" style="' . implode( $img_css, ';' ) . '" />';
	}
	else $icon = '';
	// Prepare <small> with description
	$desc = ( $atts['desc'] ) ? '<small style="' . implode( $small_css, ';' ) . '">' . su_scattr( $atts['desc'] ) . '</small>' : '';
	// Wrap with div if button centered
	if ( $atts['center'] === 'yes' ) {
		$before .= '<div class="su-button-center">';
		$after .= '</div>';
	}
	// Replace icon marker in content,
	// add float-icon class to rearrange margins
	if ( strpos( $content, '%icon%' ) !== false ) {
		$content = str_replace( '%icon%', $icon, $content );
		$classes[] = 'su-button-float-icon';
	}
	// Button text has no icon marker, append icon to begin of the text
	else $content = $icon . ' ' . $content;
	// Prepare onclick action
	$atts['onclick'] = ( $atts['onclick'] ) ? ' onClick="' . $atts['onclick'] . '"' : '';
	su_query_asset( 'css', 'su-content-shortcodes' );

	// reset the span css if the style is default
	if ( 'default' === $atts[ 'style' ] ) {
		$span_css = array();
	}

	return $before . '<a href="' . su_scattr( $atts['url'] ) . '" class="' . implode( $classes, ' ' ) . '" style="' . implode( $a_css, ';' ) . '" target="_' . $atts['target'] . '"' . $atts['onclick'] . '><span style="' . implode( $span_css, ';' ) . '">' . do_shortcode( $content ) . $desc . '</span></a>' . $after;
}