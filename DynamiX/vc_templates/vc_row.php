<?php
$output = $el_class = $bg_image = $bg_color = $bg_slider = $bg_video = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = $background_css = $background_image = $background_style = $row_height = '';
extract(shortcode_atts(array(
	'el_class'        => '',
	'bg_image'        => '',
	'bg_color'        => '',
	'bg_image_repeat' => '',
	'font_color'      => '',
	'full_width' 		=> false,	
	'wide_row' 		  => '',
	'padding'         => '',
	'custom_background' => '',	
	'margin_bottom'   => '',
	'parallax' => '',
	'anchor_link' => '',
    'css' => '',
	'content_placement' => 'middle',
	'video_bg' => '',
	'video_bg_url' => '',
	'video_bg_parallax' => '',
	'full_height_row' => ''
), $atts));

$output = $after_output = '';

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

if( $wide_row == 'yes' ) 
{
	$full_width = 'stretch_row';	
	$css_classes[] = ' shaded-wide-row';
}

// Scrape Background CSS
if(preg_match('/\bbackground\b/i', $css))
{
    $background_css = 'yes';
}


$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width"></div>';
}

if ( ! empty( $full_height_row ) ) {
	$css_classes[] = ' vc_row-o-full-height';
	if ( ! empty( $content_placement ) ) {
		$css_classes[] = ' vc_row-flex vc_row-o-content-' . $content_placement;
	}
}

// use default video if user checked video, but didn't chose url
if ( ! empty( $video_bg ) && empty( $video_bg_url ) ) {
	$video_bg_url = 'https://www.youtube.com/watch?v=lMJXxhRFO1k';
}

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

if ( $has_video_bg ) {
	$parallax = $video_bg_parallax;
	$parallax_image = $video_bg_url;
	$css_classes[] = ' vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $parallax ) ) {
	wp_enqueue_script( 'vc_jquery_skrollr_js' );
	$wrapper_attributes[] = 'data-vc-parallax="1.5"'; // parallax speed
	$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
	if ( strpos( $parallax, 'fade' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fade';
		$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
	} elseif ( strpos( $parallax, 'fixed' ) !== false ) {
		$css_classes[] = 'js-vc_parallax-o-fixed';
	}
}

if( $custom_background == 'inherit' )
{
	$style = $this->buildStyle($bg_image, '', $bg_image_repeat, $font_color, $padding, $margin_bottom);
	$css_classes[] = ' custom-row-inherit';
}
else
{
	$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);
}

$wrapper_attributes[] = $style;

// Anchor Links
if( !empty( $anchor_link ) )
{
	wp_register_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), true );
	wp_enqueue_script('waypoints');	

	wp_register_script('anchor-waypoints', get_template_directory_uri().'/js/anchor-waypoints.min.js', array('waypoints'), true );
	wp_enqueue_script('anchor-waypoints');			
	
	$css_classes[] = 'link_anchor anchor-'.$anchor_link;		
	$wrapper_attributes[] = ' data-anchor-link="'. $anchor_link .'"';
}

if ( ! empty ( $parallax ) ) {
	
	if ( $has_video_bg )
	{
		$parallax_image_src = $parallax_image;
	} 
	else if( empty( $css ) )
	{
		$background_style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, '', '', '' );		

		preg_match_all('/background(-image)??\s*?:.*?url\(["|\']??(.+)["|\']??\)/', $background_style, $matches, PREG_SET_ORDER);
		$parallax_image_src = $matches[0][2];			
	}
	else
	{
		preg_match_all('/background(-image)??\s*?:.*?url\(["|\']??(.+)["|\']??\)/', $css, $matches, PREG_SET_ORDER);
		$parallax_image_src = $matches[0][2];	
			
		$css = str_replace( $matches[0][0] . ' !important;', '', $css );		
	}
	
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}

if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
//$output .= '<div class="row-inner-wrap">';
$output .= wpb_js_remove_wpautop( $content );
//$output .= '</div>';
$output .= '</div>';
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );

echo $output;