<?php

$output = $gal_images = '';

extract( shortcode_atts( array(
	'el_class'				=> '',	
	'onclick'				=> 'link_image',
	'custom_links'			=> '',
	'custom_links_target'	=> '',
	'img_size' 				=> 'thumbnail',
	'images'				=> '',
	'columns'				=>	'1',
	'css'					=> '',
	'remove_spacing'		=> ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

wp_enqueue_script( 'vc_grid-js-imagesloaded' );
wp_enqueue_script( 'isotope' );

if ( $onclick == 'link_image' ) {
	wp_enqueue_script( 'fancybox' );
	wp_enqueue_style( 'fancybox' );
}


if ( $images == '' ) {
	$images = '-1,-2,-3';
}

if ( $onclick == 'custom_link' ) {
	$custom_links = explode( ',', $custom_links );
}

$images = explode( ',', $images );
$i = - 1;
$gallery_id = rand();

foreach ( $images as $attach_id ) {

	$i ++;
	if ( $attach_id > 0 ) {
		$post_thumbnail = wpb_getImageBySize( array( 'attach_id' => $attach_id, 'thumb_size' => $img_size ) );
	} else {
		$post_thumbnail = array();
		$post_thumbnail['thumbnail'] = '<img class="attachment-image" src="'. vc_asset_url( 'vc/no_image.png' ) .'" />';
		$post_thumbnail['p_img_large'][0] = vc_asset_url( 'vc/no_image.png' );
	}
	
	$thumbnail = $post_thumbnail['thumbnail'];
	$p_img_large = $post_thumbnail['p_img_large'];
	$link_start = $link_end = '';
	
	if ( $onclick == 'link_image' ) {
		$link_start = '<a class="fancybox" href="'. esc_url( $p_img_large[0] ) .'" data-fancybox-type="image" data-fancybox-group="media-gallery-'. $gallery_id .'">';
		$link_end = '</a>';
	} else if ( $onclick == 'custom_link' && isset( $custom_links[ $i ] ) && $custom_links[ $i ] != '' ) {
		$link_start = '<a href="'. esc_url( $custom_links[ $i ] ) .'"'. ( ! empty( $custom_links_target ) ? ' target="'. esc_attr( $custom_links_target ) .'"' : '' ) .'>';
		$link_end = '</a>';
	}

	$gal_images .= '<figure class="gallery-item">
						<div class="gallery-icon landscape">'. $link_start . $thumbnail . $link_end .'</div>';
	
		if ( in_array( $onclick, array( 'link_image', 'custom_link' ) ) ) {
			
			$gal_images .= '<figcaption class="gallery-caption">
								<div class="wp-caption-content">
									<span class="view"></span>
								</div>
							</figcaption>';
		}
		
	$gal_images .= '</figure>';

}

if ( $remove_spacing == 'true') {
	$remove_spacing = ' no-spacing';
} else {
	$remove_spacing = '';
}
	
$class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$output .= '<div class="'. esc_attr( $css_class ) .'">
				<div class="gallery gallery-columns-'. esc_attr( $columns . $remove_spacing ) .'">'. $gal_images .'</div>
			</div>';

echo $output;