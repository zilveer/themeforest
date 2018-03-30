<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

if ( sizeof($attachment_ids) > 0) {
	?>
	<script type="text/javascript">
	jQuery(window).load(function(){
		if(jQuery().flexslider) {
			var WooThumbWidth = 140;
			if(jQuery('body.woocommerce #sidebar').is(':visible')) {
				wooThumbWidth = 140;
			} else {
				wooThumbWidth = 140;
			}

			jQuery('.woocommerce .images #carousel').flexslider({
				animation: 'slide',
				controlNav: false,
				directionNav: true,
				animationLoop: true,
				slideshow: false,
				itemWidth: wooThumbWidth,
				itemMargin: 4,
				minItems: 3,
				maxItems:4,
				touch: true,
				useCSS: false,
				asNavFor: '.woocommerce .images #slider',
				start: function(){
					jQuery('#carousel a[href$=jpg], #carousel a[href$=JPG], #carousel a[href$=jpeg], #carousel a[href$=JPEG], #carousel a[href$=png], #carousel a[href$=gif], #carousel a[href$=bmp]:has(img)').unbind('click.prettyphoto');
				},
			});

			jQuery('.woocommerce .images #slider').flexslider({
				animation: 'fade',
				controlNav: false,
				directionNav: false,
				animationLoop: true,
				slideshow: false,
				smoothHeight: true,
				touch: true,
				useCSS: false,
				sync: '.woocommerce .images #carousel',
				start: function(){
					jQuery('a[class^="prettyPhoto"], a[rel^="prettyPhoto"]').prettyPhoto({social_tools: false});
				},
			});
		}
	});
	</script>
	<?php if ( sizeof($attachment_ids) > 1) { ?>
	<div id="carousel" class="flexslider">
		<ul class="slides">
		<!-- items mirrored twice, total of 12 -->
	<?php
		if ( has_post_thumbnail() ) {

		$image       		= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
		$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
		$attachment_count   = count( $product->get_gallery_attachment_ids() );

		if ( $attachment_count > 0 ) {
			$gallery = '[product-gallery]';
		} else {
			$gallery = '';
		}

		//echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<li><a href="%s" itemprop="image" class="image-'.get_post_thumbnail_id().'" title="%s">%s</a></li>', $image_link, $image_title, $image ), $post->ID );

	} 
	?>
	<?php

		$loop = 0;
		//$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

		foreach ( $attachment_ids as $attachment_id ) {

			$image_link = wp_get_attachment_url( $attachment_id );

			if ( ! $image_link )
				continue;

			$classes[] = 'image-'.$attachment_id;

			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<li><a href="%s" class="%s" title="%s">%s</a></li>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

			$loop++;
		}

	?>		</ul>
	</div>
	<?php }	?>
	<?php
}