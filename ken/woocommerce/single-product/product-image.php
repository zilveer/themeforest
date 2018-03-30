<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
  *
 * @package This template is overrided by theme
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product, $mk_settings;

$attachment_ids = $product->get_gallery_attachment_ids();


$single_image_size = isset($mk_settings['woo_single_image_size']) ? $mk_settings['woo_single_image_size'] : 'crop';

$image_height = isset($mk_settings['woo-single-thumb-height']) ? $mk_settings['woo-single-thumb-height'] : 800;
$image_width = 800;
$quality = isset($mk_settings['woo-image-quality']) ? $mk_settings['woo-image-quality'] : 1;


?>
<div class="images mk-gallery thumb-style">

	<?php if ( $product->is_on_sale() ) : ?>

		<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'SALE', 'mk_framework' ) . '</span>', $post, $product ); ?>

	<?php endif; ?>

	<div class="gallery-thumb-large">

		<div id="mk-single-product-swiper" style="max-height:<?php echo $image_height; ?>px;overflow:hidden;" class="mk-swiper-container mk-swiper-slider" data-freeModeFluid="false" data-loop="false" data-slidesPerView="1" data-pagination="false" data-freeMode="false" data-mousewheelControl="false" data-direction="horizontal" data-slideshowSpeed="100000" data-animationSpeed="600" data-directionNav="true">
			<div class="mk-swiper-wrapper">
	<?php


		if ( has_post_thumbnail() ) {

			switch ($single_image_size) {
		        case 'full':
		            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
		            $image = $image_src_array[0];
		            break;
		        case 'crop':
		            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
		            $image = bfi_thumb($image_src_array[0], array(
		                'width' => $image_width*$quality,
		                'height' => $image_height*$quality
		            ));
		            break;            
		        case 'large':
		            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large', true);
		            $image = $image_src_array[0];
		            break;
		        case 'medium':
		            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium', true);
		            $image = $image_src_array[0];
		            break;        
		        default:
		            $image_src_array = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full', true);
		            $image = bfi_thumb($image_src_array[0], array(
		                'width' => $image_width*$quality,
		                'height' => $image_height*$quality
		            ));
		            break;
		    }

			$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );

			echo '<div class="swiper-slide"><div itemprop="image" class="woocommerce-main-image mk-shop-single-image" title="'.$image_title.'"><img src="'.mk_thumbnail_image_gen($image, $image_width, $image_height).'" alt="'.$image_title.'" /></div><a  href="'.$image_link.'" rel="product-image" class="mk-lightbox product-single-lightbox" title="'.$image_title.'"><i class="mk-icon-search"></i></a></div>';

		}

		foreach ( $attachment_ids as $attachment_id ) {


			$image_link = wp_get_attachment_url( $attachment_id );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			switch ($single_image_size) {
		        case 'full':
		            $image_src_array = wp_get_attachment_image_src( $attachment_id, 'full', true);
		            $image = $image_src_array[0];
		            break;
		        case 'crop':
		            $image_src_array = wp_get_attachment_image_src( $attachment_id, 'full', true);
		            $image = bfi_thumb($image_src_array[0], array(
		                'width' => $image_width*$quality,
		                'height' => $image_height*$quality
		            ));
		            break;            
		        case 'large':
		            $image_src_array = wp_get_attachment_image_src( $attachment_id, 'large', true);
		            $image = $image_src_array[0];
		            break;
		        case 'medium':
		            $image_src_array = wp_get_attachment_image_src( $attachment_id, 'medium', true);
		            $image = $image_src_array[0];
		            break;        
		        default:
		            $image_src_array = wp_get_attachment_image_src( $attachment_id, 'full', true);
		            $image = bfi_thumb($image_src_array[0], array(
		                'width' => $image_width*$quality,
		                'height' => $image_height*$quality
		            ));
		            break;
		    }
			echo '<div class="swiper-slide"><img src="'.mk_thumbnail_image_gen($image, $image_width, $image_height).'" alt="'.$image_title.'" /><a href="'.$image_src_array[ 0 ].'" class="mk-lightbox product-single-lightbox" rel="product-image" title="'.$image_title.'"><i class="mk-icon-search"></i></a></div>';

		}

	echo '</div>';


	echo '<a class="mk-swiper-prev slideshow-swiper-arrows"><i class="mk-theme-icon-prev-big"></i></a>';
	echo '<a class="mk-swiper-next slideshow-swiper-arrows"><i class="mk-theme-icon-next-big"></i></a>';
	echo '</div></div>';


if ( $attachment_ids ) {
	?>
	<div class="gallery-thumbs-small"><?php

	if ( has_post_thumbnail() ) {
		$image_src_array_thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );
		$image_thumb = bfi_thumb( $image_src_array_thumb[ 0 ], array('width' => 100, 'height' => 100, 'crop' => false));

		echo '<a href="#" title="'.$image_title.'"><img src="'.mk_thumbnail_image_gen($image_thumb, 100, 100).'" alt="'.$image_title.'" /></a>';
	}

		foreach ( $attachment_ids as $attachment_id ) {


			$image_link = wp_get_attachment_url( $attachment_id );

			$image_src_array = wp_get_attachment_image_src( $attachment_id, 'full', true );
			$image = bfi_thumb( $image_src_array[ 0 ], array('width' => 100, 'height' => 100, 'crop' => false));
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo '<a href="#" title="'.$image_title.'"><img src="'.mk_thumbnail_image_gen($image, 100, 100).'" alt="'.$image_title.'" /></a>';

		}

	?></div>
	<?php
} ?>

</div>


