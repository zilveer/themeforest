<?php

/*------------------------------------------------------------
 * Include external shortcode files
 *------------------------------------------------------------*/

include_once(THEME_SHORTCODES.'/loops/sleek_blog.php');
// include_once(THEME_SHORTCODES.'/loops/sleek_portfolio.php');
include_once(THEME_SHORTCODES.'/sleek_slider.php');
include_once(THEME_SHORTCODES.'/sleek_image_slider.php');



/*------------------------------------------------------------
 * Shortcode: Row & Column
 *------------------------------------------------------------*/

/*
[row padding_top="" padding_bottom="" bg="" bg_light="true" appear="false"]
	[column size="1-1" appear=""][/column]
[/row]

@padding_top:
	0 [default]
	n - top padding in px
@padding_bottom:
	0 [default]
	n - bottom padding in px
@bg:
	background css string
@bg_light:
	true / false
@size:
	1-1 [default]
	1-2
	3-4
	n-n
@appear:
	true / false
	Enable animation appearance
*/

if( !function_exists( 'sleek_row' ) ){
function sleek_row($atts, $content = null) {

	extract( shortcode_atts( array(
		 'padding_top' => ''
		,'padding_bottom' => ''
		,'bg' => ''
		,'bg_light' => ''
		,'appear' => 'false'
	), $atts ) );

	$style = '';
	$class = '';

	if ($padding_top) {
		$style .= 'padding-top:'.$padding_top.'px;';
	}
	if ($padding_bottom) {
		$style .= 'padding-bottom:'.$padding_bottom.'px;';
	}

	if ($bg) {
		$style .= 'background:'.$bg.';';
	}

	if ( $bg_light == 'false' ) {
		$class .= ' dark-mode';
	}

	if ( $appear == 'true' ) {
		$class .= ' sleek-animate-appearance';
	}

	return '<div class="row ' . $class . '" style="' . $style . '"><div class="row__inwrap"><div class="column-wrap">' . do_shortcode( $content) . '</div></div></div>';
}
}

add_shortcode('row', 'sleek_row');



if( !function_exists( 'sleek_column' ) ){
function sleek_column($atts, $content = null) {

	extract( shortcode_atts( array(
		 'size' => '1-1'
		,'appear' => 'false'
	), $atts ) );

	$size = $size == '' ? '1-1' : $size;

	$class = '';

	$class .= 'column--'.$size;

	if ( $appear == 'true' ) {
		$class .= ' sleek-animate-appearance';
	}

	return '<div class="'.$class.'">'.do_shortcode($content).'</div>';
}
}

add_shortcode('column', 'sleek_column');



/*------------------------------------------------------------
 * Shortcode: Page Marker
 *------------------------------------------------------------*/

/*
[page_marker title="TITLE"]
*/

if( !function_exists( 'sleek_page_marker' ) ){
function sleek_page_marker($atts, $content = null) {
	global $page_marker_i;
	$page_marker_i = $page_marker_i+1;

	return '<span id="page-marker-'.$page_marker_i.'"> This is Page Marker #'.$page_marker_i.'</span>';
}
}

// add_shortcode('page_marker', 'sleek_page_marker');



/*------------------------------------------------------------
 * Shortcode: Gmap
 *------------------------------------------------------------*/

/*
[gmap lat="48.851978" lng="2.348151" zoom="14" pin="" scrollable="" height=""]This is my bubble content.[/gmap]

@lat:
	n - latitude number
@lng:
	n - longitute number
@zoom:
	n - zoom number, defaults to 14
@pin:
	URL to custom pin image.
@scrollable:
	false - default
	true - make map Mouse Wheel scrollable
@height:
	Defaults to 16:9 aspect ratio
	n - custom height of map

@content:
	defaults to none - no bubble
*/

if( !function_exists( 'sleek_gmap' ) ){
function sleek_gmap($atts, $content = null) {

	extract( shortcode_atts( array(
		 'lat' => '48.851978'
		,'lng' => '2.348151'
		,'zoom' => '14'
		,'pin' => THEME_IMG_URI.'/gmap_pin.png'
		,'scrollable' => 'false'
		,'height' => ''
	), $atts ) );

	// set defaults for empty atts
	if( $pin == ''){
		$pin = THEME_IMG_URI.'/gmap_pin.png';
	}
	if( $scrollable == ''){
		$scrollable = 'false';
	}
	if( $zoom == ''){
		$zoom = '14';
	}

	wp_enqueue_script('sleek_google_maps');

	$output = '<div class="sleek-gmap sleek-embed-container js-sleek-gmap"';
	$output .= ' data-lat="'.$lat.'"';
	$output .= ' data-lng="'.$lng.'"';
	$output .= ' data-zoom="'.$zoom.'"';
	$output .= ' data-pin="'.$pin.'"';
	$output .= ' data-scrollable="'.$scrollable.'"';
	$output .= ' style="padding-bottom:'.$height.'px;"';
	$output .= '>'.$content.'</div>';

	return $output;
}
}

add_shortcode('gmap', 'sleek_gmap');



/*------------------------------------------------------------
 * Shortcode: Social
 *------------------------------------------------------------*/

/*
[social style_big="false" icon_name="url"]

@style_big - true/false
@icon_name - icon to use
@url - full url to profile
*/

if( !function_exists( 'sleek_social' ) ){
function sleek_social($atts, $content = null) {

	extract( shortcode_atts( array(
		'style_big' => 'false'
	), $atts ) );

	$atts = array_filter( $atts );
	unset( $atts['style_big'] );

	if( count( $atts ) == 0 ){
		return;
	}



	$classes = $style_big == 'true' ? ' social-nav--big' : '';

	$output = '';
	$output .= '<div class="social-nav ' . $classes . '">';
	$output .= '<ul class="social-nav__items">';

	foreach ($atts as $key => $value) {

		// Replace '-' with '_' to revert icon name
		$key = str_replace('_', '-', $key);

		$output .= '<li class="social-nav__item">';
			$output .= '<a class="social-nav__link js-skip-ajax" target="_blank"  href="'.$value.'" title="'.$key.'">';
				$output .= '<i class="icon-'.$key.'"></i>';
			$output .= '</a>';
		$output .= '</li>';
	}

	$output .= '</ul>';
	$output .= '</div>';

	return $output;
}
}

add_shortcode('social', 'sleek_social');



/*------------------------------------------------------------
 * Shortcode: Icon
 *------------------------------------------------------------*/

/*
[icon icon="ICON_NAME"]
[icon]ICON_NAME[/icon]

@icon, @content
	Icon class name. Both params/ways are valid
*/

if( !function_exists( 'sleek_icon' ) ){
function sleek_icon($atts, $content = null) {

	extract( shortcode_atts( array(
		 'icon' => ''
	), $atts ) );

	return '<i class="'.$icon.' '.$content.'"></i>';
}
}

add_shortcode('icon', 'sleek_icon');



/*------------------------------------------------------------
 * Shortcode: Dropcap
 *------------------------------------------------------------*/

/*
[dropcap style="hexagon"]X[/dropcap]

@style - none / hexagon
@content - Letter or Icon
*/

if( !function_exists( 'sleek_dropcap' ) ){
function sleek_dropcap($atts, $content = null) {

	extract( shortcode_atts( array(
		 'style' => ''
	), $atts ) );

	return '<span class="dropcap '.$style.'">'.do_shortcode($content).'</span>';
}
}

add_shortcode('dropcap', 'sleek_dropcap');



/*------------------------------------------------------------
 * Shortcode: Separator
 *------------------------------------------------------------*/

/*
[separator size="medium" center="false" empty="false" opaque="false" margin_top="" margin_bottom=""]

@size - small / medium
@center - true / false
@empty - true / false - empty space
@opaque - true / false - full opacity or not
@margin_top - n - override margin
@margin_bottom - n - override margin
*/

if( !function_exists( 'sleek_separator' ) ){
function sleek_separator($atts, $content = null) {

	extract( shortcode_atts( array(
		 'size' 		=> 'medium'
		,'center' 		=> 'false'
		,'empty' 		=> 'false'
		,'opaque' 		=> 'false'
		,'margin_top' 	=> ''
		,'margin_bottom'=> ''
	), $atts ) );

	$classes = '';
	$classes .= ' separator--'.$size;
	$classes .= $center == 'true' ? ' separator--center' : '';
	$classes .= $empty 	== 'true' ? ' separator--empty' : '';
	$classes .= $opaque == 'true' ? ' separator--opaque-full' : '';

	$styles = 'style="';

	$styles .= $margin_top != '' ? 'margin-top:' . $margin_top . 'px;' : '';
	$styles .= $margin_bottom != '' ? 'margin-bottom:' . $margin_bottom . 'px;' : '';

	$styles .= '"';

	return '<span class="separator' . $classes . '" ' . $styles . '></span>';
}
}

add_shortcode('separator', 'sleek_separator');



/*------------------------------------------------------------
 * Shortcode: Highlighted Text
 *------------------------------------------------------------*/

/*
[highlighted_text]Highlighted Text[/highlighted_text]
*/

if( !function_exists( 'sleek_highlighted_text' ) ){
function sleek_highlighted_text($atts, $content = null) {

	extract( shortcode_atts( array(), $atts ) );

	return '<span class="highlighted-text">'.do_shortcode($content).'</span>';
}
}

add_shortcode('highlighted_text','sleek_highlighted_text');



/*------------------------------------------------------------
 * Shortcode: Highlighted Paragraph
 *------------------------------------------------------------*/

/*
[highlighted_p boxed="false" center="false"]Paragraph Content[/highlighted_p]

@boxed - true / false
*/

if( !function_exists( 'sleek_highlighted_p' ) ){
function sleek_highlighted_p($atts, $content = null) {

	extract( shortcode_atts( array(
		 'boxed' => 'false'
		,'center'=> 'false'
	), $atts ) );

	$classes = '';
	if( $boxed == 'true' ){
		$classes .= ' highlighted-p--boxed';
	}

	$style = '';
	if( $center == 'true' ){
		$style .= 'text-align: center;';
	}

	return '<span class="highlighted-p' .$classes.'" style="'.$style.'">'.do_shortcode($content).'</span>';
}
}

add_shortcode('highlighted_p', 'sleek_highlighted_p');



/*------------------------------------------------------------
 * Shortcode: Button
 *------------------------------------------------------------*/

/*
[button url="#" new_tab="false" size="medium" style="solid" color="false" light="false"]My Button[/button]

@url [required]:
	url for button
@new_tab:
	false - natural navigation / same tab [default]
	true - open link in new tab/window
@size:
	small
	medium [default]
	large
@style
	solid [default]
	outline
@color
	false - black / white [default]
	true - theme primary-color
@light
	false - button on light bg [default]
	true - button on dark bg
*/

if( !function_exists( 'sleek_button' ) ){
function sleek_button($atts, $content = null) {

	extract( shortcode_atts( array(
		 'url' 		=> '#'
		,'new_tab' 	=> 'false'
		,'size' 	=> 'medium'
		,'style' 	=> 'solid'
		,'color' 	=> 'false'
		,'light' 	=> 'false'
	), $atts ) );

	$url = $url ? $url : '#';
	$new_tab = $new_tab == 'true' ? '_blank' : '_self';
	$size = $size ? $size : 'medium';
	$style = $style ? $style : 'solid';
	$color = $color == 'true' ? true : false;
	$light = $light == 'true' ? true : false;



	$classes = '';
	// Size
	$classes .= ' button--'.$size;

	// Style + Color & Light
	$classes .= ' button--'.$style;
	$classes .= $color ? '--color' : '';
	$classes .= $light ? '--light' : '';



	return '<a href="'.$url.'" target="'.$new_tab.'" class="button '.$classes.'">'.do_shortcode($content).'</a>';
}
}

add_shortcode('button', 'sleek_button');



/*------------------------------------------------------------
 * Shortcode: Custom Title
 *------------------------------------------------------------*/

/*
[title above="" h1="false" center="true"]Title Above[/title]
*/

if( !function_exists( 'sleek_title' ) ){
function sleek_title($atts, $content = null) {

	extract( shortcode_atts( array(
		 'above' => ''
		,'h1' => 'false'
		,'center' => 'true'
	), $atts ) );

	$style = $center == 'true' ? 'text-align: center;' : '';

	$tag = $h1 == 'true' ? 'h1' : 'h2';

	$output = '<' . $tag . ' style="'.$style.'">';
	$output .= $above ? '<span class="above">' . $above . '</span>' : '';
	$output .= $content;
	$output .= '</' . $tag . '>';

	return $output;
}
}

add_shortcode('title', 'sleek_title');



/*------------------------------------------------------------
 * Shortcode: Custom Heading
 *------------------------------------------------------------*/

/*
[custom_heading center="true"]Label Title[/custom_heading]
*/

if( !function_exists( 'sleek_custom_heading' ) ){
function sleek_custom_heading($atts, $content = null) {

	extract( shortcode_atts( array(
		'center' => 'true'
	), $atts ) );

	$style = $center == 'true' ? 'text-align: center;' : '';

	$output = '<span class="custom-heading" style="'.$style.'">';
	$output .= $content;
	$output .= '</span>';

	return $output;
}
}

add_shortcode('custom_heading', 'sleek_custom_heading');



/*------------------------------------------------------------
 * Shortcode: CTA
 *------------------------------------------------------------*/

/*
[cta btn_text="" btn_url="" bg="" bg_light="true" appear="false"]Text[/cta]
*/

if( !function_exists( 'sleek_cta' ) ){
function sleek_cta( $atts, $content = null ) {

	extract( shortcode_atts( array(
		 'btn_text' => ''
		,'btn_url' => '#'
		,'bg' => ''
		,'bg_light' => ''
		,'appear' => ''
	), $atts ) );

	$style = '';
	if( $bg ){
		$style = 'background:'.$bg.';';
	}

	$class = '';
	if ( $bg_light == 'false' ) {$class .= ' dark-mode'; }
	if ( $appear == 'true' ) 	{$class .= ' sleek-animate-appearance'; }

	$output = '';

	$output .= '<div class="sleek-cta ' . $class . '" style="' . $style . '">';
	$output .= '<div class="sleek-cta__inwrap">';
		$output .= '<span class="h4">' . do_shortcode($content) . '</span>';
		$output .= '<a class="button" href="' . $btn_url . '">' . $btn_text . '</a>';
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}
}

add_shortcode('cta', 'sleek_cta');



/*------------------------------------------------------------
 * Shortcode: Progress Bar
 *------------------------------------------------------------*/

/*
[progress_bar title="" percent="" color="grey"]

title - text
percent - 0-100
color - grey[default]/black/primary/white
*/

if( !function_exists( 'sleek_progress_bar' ) ){
function sleek_progress_bar( $atts, $content = null ) {

	extract( shortcode_atts( array(
		 'title' => ''
		,'percent' => '0'
		,'color' => 'grey'
	), $atts ) );

	$percent = $percent == '' ? '0' : $percent;
	$color = $color == '' ? 'grey' : $color;

	$output = '';

	$output .= '<div class="progress-bar color-'.$color.'" data-percent="'.$percent.'">';
		$output .= '<div class="meta">';
			$output .= '<span class="title">'.$title.'</span>';
			$output .= '<span class="percent">'.$percent.'%</span>';
		$output .= '</div>';
		$output .= '<div class="bar"><div></div></div>';
	$output .= '</div>';

	return $output;
}
}

add_shortcode('progress_bar', 'sleek_progress_bar');



/*------------------------------------------------------------
 * Shortcode: Icon Badge
 *------------------------------------------------------------*/

/*
[icon_badge icon="" size="medium" style="grey" url="" tooltip="" tooltip_location=""]

icon - icon name
size - small/medium/large
style - grey / white
url - href to be linked to
tooltip - title text for link tooltip
tooltip_location - right / left / top / bottom
*/

if( !function_exists( 'sleek_icon_badge' ) ){
function sleek_icon_badge( $atts, $content = null ) {

	extract( shortcode_atts( array(
		 'icon' => ''
		,'size' => 'medium'
		,'style' => 'grey'
		,'url' => ''
		,'tooltip' => ''
		,'tooltip_location' => 'right'
	), $atts ) );

	$size = $size == '' ? 'medium' : $size;
	$style = $style == '' ? 'grey' : $style;
	$tooltip_location = $tooltip_location == '' ? 'right' : $tooltip_location;

	$class = '';
	$class .= $icon;
	$class .= ' icon--badge--'.$size;
	$class .= ' icon--badge--'.$style;

	$tooltip_content = '';
	if( $tooltip ){
		$tooltip_content = ' class="tooltip tooltip--'.$tooltip_location.'" data-tooltip="'.$tooltip.'" ';
	}

	$output = '';

	if( $url != '' ){
		$output .= '<a href="'.$url.'" '.$tooltip_content.'>';
	}

	$output .= '<i class="icon--badge '.$class.'"></i>';

	if( $url ){
		$output .= '</a>';
	}



	return $output;
}
}

add_shortcode('icon_badge', 'sleek_icon_badge');
