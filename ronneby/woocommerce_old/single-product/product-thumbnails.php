<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce, $dfd_ronneby;

$attachment_ids = $product->get_gallery_attachment_ids();
if(has_post_thumbnail()) {
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	array_unshift($attachment_ids, $thumbnail_id);
	array_unique($attachment_ids);
}

$unique_id = uniqid('spc-');

if ( $attachment_ids && (!isset($dfd_ronneby['woocommerce_hide_single_thumb']) || $dfd_ronneby['woocommerce_hide_single_thumb'] != '1')) { ?>
<div class="product-carousel">
	<div id="<?php echo esc_attr($unique_id); ?>">
	<?php
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );

		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array( 'single-product-thumbnail' );
			
			$image_url   = wp_get_attachment_url($attachment_id);
			if ( ! $image_url )
				continue;
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			$image_size = wc_get_image_size('shop_single');
			$thumb_size = wc_get_image_size('shop_thumbnail');
			$image_link = dfd_aq_resize($image_url, $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
			if(!$image_link) {
				$image_link = $image_url;
			}
			
			$image_src = wp_get_attachment_image_src($attachment_id);
			$img_url = dfd_aq_resize($image_src[0], $thumb_size['width'], $thumb_size['height'], $thumb_size['crop'], true, true);
			if(!$img_url) {
				$img_url = $image_src[0];
			}
			$image = '<img src ="'.esc_url($img_url).'" alt="" />';
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '
			<div class="%s"><a href="%s" title="%s" data-large="%s">%s</a></div>', $image_class, $image_link,  $image_title, $image_url, $image ), $attachment_id, $post->ID, $image_class );
			$loop++;
		}
	?>
    </div>
</div>

<script type="text/javascript">
	(function($) {
		"use strict";
		$(document).ready(function() {
			var $container = $('#<?php echo esc_js($unique_id); ?>');
			$container.products_thumbnails_carousel(4, false);
			$container.find('.single-product-thumbnail a').each(function() {
				var $this = $(this);
				$this.click(function(e) {
					e.preventDefault();
					var url = $this.attr('href');
					var urlFull = $this.attr('data-large');
					$this.parent().parents('.images').find('.single-product-image img.dfd-woo-main-image').attr('src', url);
					$this.parent().parents('.images').find('.single-product-image img.dfd-large-image').attr('src', urlFull);
				});
			});
		});
	})(jQuery);
</script>

	<?php
}