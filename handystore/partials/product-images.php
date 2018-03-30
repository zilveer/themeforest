<?php
/*-------Plumtree Custom product images output----------*/
global $product;
/* Variables */
$slider_type = (handy_get_option('product_slider_type') != '') ? handy_get_option('product_slider_type') : 'slider-with-thumbs';
$transition_type = (handy_get_option('product_slider_effect') != '') ? handy_get_option('product_slider_effect') : 'fade';
$owl_transition_attr = ' data-owl-transition="'.$transition_type.'"';
$attachment_ids = $product->get_gallery_attachment_ids();
/* Extra data attribute for owl carousel & magnific popup */
$extra_owl_attr = null;
$extra_popup_attr = null;
$extra_thumbs_owl_attr = null;
switch ($slider_type) {
	case 'simple-slider':
		$extra_owl_attr = ' data-owl="container" data-owl-slides="1" data-owl-type="simple"'.$owl_transition_attr;
		$extra_popup_attr = null;
	break;
	case 'slider-with-popup':
		$extra_owl_attr = ' data-owl="container" data-owl-slides="1" data-owl-type="simple"'.$owl_transition_attr;
		$extra_popup_attr = ' data-magnific="container"';
	break;
	case 'slider-with-thumbs':
		$extra_owl_attr = ' data-owl="container" data-owl-slides="1" data-owl-type="with-thumbs"'.$owl_transition_attr;
		$extra_popup_attr = ' data-magnific="container"';
		$extra_thumbs_owl_attr = ' data-owl-thumbs="container"';
	break;
}

/* Get product featured image */
function pt_get_main_img($size, $main_slider){
	global $post;
	$main_image = '';
	if ( has_post_thumbnail() ) {
		$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', $size ) );
		$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );

		if ($main_slider) {
			$main_image = apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image" title="%s" >%s</a>', $image_link, $image_title, $image ), $post->ID );
		} else {
			$main_image = apply_filters( 'woocommerce_single_product_image_html', sprintf( '%s', $image ), $post->ID );
		}
	} else {
		$main_image = apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
	}
	return $main_image;
}

/* Get attachments */
function pt_get_attachment_imgs($size, $main_slider){
	global $product;
	$attachment_ids = $product->get_gallery_attachment_ids();
	$gallery_imgs = '';

	if ($attachment_ids) {
		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array();
			$image_link = wp_get_attachment_url( $attachment_id );
			if ( ! $image_link )
				continue;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', $size ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			$gallery_imgs .= '<div class="slide">';
			if ($main_slider) {
				$gallery_imgs .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" itemprop="image" class="%s" title="%s" >%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id );
			} else {
				$gallery_imgs .= apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '%s', $image ), $attachment_id );
			}
			$gallery_imgs .= '</div>';
		}
	}
	return $gallery_imgs;
}

/* Output html(main slider) */
$html_output = '<div class="main-slider images"'.$extra_owl_attr.''.$extra_popup_attr.'>';
$html_output .= '<div class="slide">'.pt_get_main_img('shop_single', true).'</div>';
if ( $attachment_ids ) {
	$html_output .= pt_get_attachment_imgs('shop_single', true);
}
$html_output .= '</div>';

/* Output html(thumbs slider) */
if ($slider_type == 'slider-with-thumbs' && $attachment_ids ) {
	$html_output .= '<div class="thumb-slider"'.$extra_thumbs_owl_attr.'>';
	$html_output .= '<div class="slide">'.pt_get_main_img('pt-product-thumbs', false).'</div>';
	if ( $attachment_ids ) {
		$html_output .= pt_get_attachment_imgs('pt-product-thumbs', false);
	}
	$html_output .= '</div>';
}

echo $html_output;
