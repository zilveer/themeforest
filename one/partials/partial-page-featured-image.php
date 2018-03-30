<?php

if ( !isset( $img_link ) ) {
	$img_link = true;
	$img_overlay = true;
}

$img_attr = array(
	'class' => 'rsImg'
);

if ( !isset( $slideshow_class ) ) {
	$slideshow_class = 'page-content-slideshow';
}

$show_slideshow          = false;
$image_size              = 'full-width';
$featured_image          = thb_get_featured_image( $image_size, thb_get_page_ID() );
$header_background_id    = thb_get_post_meta( thb_get_page_ID(), 'header_background_id' );
$header_background       = thb_image_get_size( $header_background_id, $image_size );
$header_background_color = thb_get_post_meta( thb_get_page_ID(), 'header_background_background_color' );
$overlay_color           = thb_get_post_meta( thb_get_page_ID(), 'header_background_overlay_color' );
$overlay_display         = thb_get_post_meta( thb_get_page_ID(), 'header_background_overlay_display' );
$overlay_opacity         = thb_get_post_meta( thb_get_page_ID(), 'header_background_overlay_opacity' );
$is_layerslider          = thb_is_layerslider() && thb_get_layerslider() != '';

if ( is_single() && thb_get_post_format() == 'image' ) {
	$featured_image_src = thb_get_post_format_image_src( $image_size );
	$featured_image = $featured_image_src['scaled'];
}

if ( $is_layerslider ) {

	thb_layerslider();

}
elseif( thb_slideshow_has_slides() ) {

	thb_slideshow( $image_size, 'bg', 'thb-main-slideshow rsTHB ' . $slideshow_class );

}
elseif( thb_is_page_header_layout_extended() ) {

	$slideshow_attrs = array(
		'style' => sprintf( ' background-color: %s;', $header_background_color )
	);

	echo '<div class="thb-slideshow rsTHB thb-main-slideshow ' . $slideshow_class . '" ' . thb_get_attributes( $slideshow_attrs ) . '>';

		$slide_attrs = array(
			'style' => ''
		);

		$slide_skin = 'thb-skin-' . thb_color_get_skin_from_comparison( $overlay_color, $header_background_color );
		$slide_bg = '';

		if( ! empty( $header_background ) ) {
			$slide_bg = $header_background;
		}
		elseif( ! empty( $featured_image ) ) {
			$slide_bg = $featured_image;
		}

		$slide_attrs['style'] .= sprintf( ' background-image: url(%s);', $slide_bg );

		echo '<div class="slide ' . $slide_skin . '" ' . thb_get_attributes( $slide_attrs ) . '>';
			echo '<span class="thb-fake-background" ' . thb_get_attributes( $slide_attrs ) . '></span>';
			if ( $overlay_display == '1' ) {
				thb_overlay( $overlay_color, $overlay_opacity, 'thb-background-overlay' );
			}
		echo '</div>';

	echo '</div>';

}

// Regular featured image, hidden when extended

if( ! empty( $header_background ) ) {
	thb_image( $header_background_id, $image_size, array(
		'link'       => true,
		'link_class' => 'item-thumb thb-page-featured-image',
		'overlay'    => true
	) );
}
elseif( ! empty( $featured_image ) ) {
	thb_featured_image( $image_size, array(
		'link_class' => 'item-thumb thb-page-featured-image',
	) );
}