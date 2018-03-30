<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if( $parallax == 'image' ) {
	wp_enqueue_script('skrollr');
}

$css_container = 'container';
$css_row	   = 'row';
if ( ! empty( $full_width ) ) {
	$css_row = 'row no-gutter';
}
$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
$css_classes[] = 'section';
if( ! empty($theme_color) ) {
	$css_classes[] = $theme_color;
	if( $theme_color == 'theme-color' ) {
		$css_classes[] = 'dark';
	}
}
if( ! empty( $extra_css ) ) {
	$css_classes[] = $extra_css;
}
$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$css_container = 'fluid-container';
}
if( ! empty($box_padding) && $box_padding != 'no-padding' ) {
	$css_container .= ' '. $box_padding;
}
if ( ! empty( $full_height ) ) {
	$css_classes[] = 'fullheight vc-row-full-height';
}

if( $parallax == 'html5video' ) {
	$css_classes[] = 'bg_video';
}

$has_parallax_img    = false;
$has_parallax_video  = false;
$parallax_image_src  = '';
$html_image_parallax = '';
$has_transparent 	 = false;
$parallax_keys = 'data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 100px;" data-top-bottom="background-position: 50% -100px;"';
if( ! empty( $parallax_image ) ) {
	$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
	$image_src 		   = wp_get_attachment_image_src( $parallax_image_id, 'full' );
	if ( ! empty( $image_src[0] ) ) {
		$parallax_image_src = $image_src[0];
	}
}
if ( ! empty( $parallax ) && $parallax == 'image' && ! empty( $parallax_image_src ) ) {
	$has_parallax_img = true;
	if ( empty( $el_id ) ) {
		$el_id = 'parallax-bg-'. rand(1,999);
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
} 
if ( ! empty( $parallax ) && $parallax == 'youtube' && ! empty( $youtube ) ) {
	wp_enqueue_script('YTPlayer');
	$css_classes[] = 'yt-bg-player';
	if ( empty( $el_id ) ) {
		$el_id = 'parallax-bg-'. rand(1,999);
		$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
	}
	$wrapper_attributes[] = 'data-video="'. esc_url( $youtube ) . '"';
	$wrapper_attributes[] = 'data-container="#'. esc_attr( $el_id ) . '"';
	$wrapper_attributes[] = 'data-poster="'. esc_url( $parallax_image_src ) . '"';
}
$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';


$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if( $has_parallax_img ) {
	$output .= '<div class="bcg" data-parallax-image="'. esc_url($parallax_image_src) .'" data-center="background-position: 50% 0px;" data-bottom-top="background-position: 50% 100px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#'. esc_attr( $el_id ) .'">';
} elseif ( ! empty( $parallax ) && $parallax == 'html5video' && ! empty( $mp4 ) ) {
	$has_parallax_video = true;
	$output .= '<div class="video-wrap">
        <video poster="'. esc_url( $parallax_image_src ) .'" preload="auto" loop autoplay>
          <source src="'. esc_url( $mp4 ) .'" type="video/mp4">
          <source src="'. esc_url( $webm ) .'" type="video/webm">
        </video>
      </div>';
}
if( ! empty($theme_color) && $theme_color == 'dark' ) {
	if( ! empty( $overlay ) ) {
		$has_transparent = true;
		if( $overlay == '' ) {
			$output .= '<div class="'. esc_attr( $overlay ) .'">';
		} else {
			$output .= '<div class="bg-transparent '. esc_attr( $overlay ) .'">';
		}
	}
}

$output .= '<div class="'. $css_container .'">';
$output .= '<div class="' . esc_attr( trim( $css_row ) ) . '">';
$output .= wpb_js_remove_wpautop( $content );
$output .= '</div>';
$output .= '</div>';
if( $has_parallax_img ) {
	$output .= '</div>';
}
if( $has_transparent ) {
	$output .= '</div>';
}
$output .= '</div>';// End Of section
$output .= $after_output;
$output .= $this->endBlockComment( $this->getShortcode() );
echo $output;