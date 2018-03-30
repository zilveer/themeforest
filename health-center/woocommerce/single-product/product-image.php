<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $product;

$attachment_ids = $product->get_gallery_attachment_ids();

?>
<div class="images">

	<?php
		if ( has_post_thumbnail() ) {
			$large_thumbnail_size = apply_filters( 'single_product_large_thumbnail_size', 'shop_single' );
			$small_thumbnail_size = apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' );

			$main_image_id = get_post_thumbnail_id();

			$attachment_count = count( $attachment_ids );


			if ( $attachment_count > 0 ):
				array_unshift($attachment_ids, $main_image_id);
			?>

				<div class="bxslider-wrapper">
					<ul class="bxslider-container" id="product-gallery-<?php echo $post->ID ?>">
						<?php foreach($attachment_ids as $aid): ?>
							<li>
								<?php
									$image_link  = wp_get_attachment_url( $aid );
									$image       = wp_get_attachment_image( $aid, $large_thumbnail_size );
									$image_title = esc_attr( get_the_title( $aid ) );

									echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_title, $image ), $post->ID );
								?>
							</li>
						<?php endforeach ?>
					</ul>
					<script>
						jQuery(function($) {
							var el = $('#product-gallery-<?php echo $post->ID ?>');
							el.data('bxslider', el.bxSlider({
								pagerCustom: '#product-gallery-pager-<?php echo $post->ID ?>',
								controls: false,
								adaptiveHeight: true
							}));
						});
					</script>
				</div>

			<?php else: ?>
				<?php
					$image_link  = wp_get_attachment_url( $main_image_id );
					$image_title = esc_attr( get_the_title( $main_image_id ) );
					$image       = get_the_post_thumbnail( $post->ID, $large_thumbnail_size, array(
						'title' => $image_title
					) );
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s"  rel="prettyPhoto">%s</a>', $image_link, $image_title, $image ), $post->ID );
				?>
			<?php endif;

		} else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

		}
	?>

	<?php if($attachment_ids): ?>
		<div class="thumbnails" id="product-gallery-pager-<?php echo $post->ID ?>"><?php

			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array();

				if ( $loop == 0 || $loop % $columns == 0 )
					$classes[] = 'first';

				if ( ( $loop + 1 ) % $columns == 0 )
					$classes[] = 'last';

				$image_link = wp_get_attachment_url( $attachment_id );

				if ( ! $image_link )
					continue;

				$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
				$image_class = esc_attr( implode( ' ', $classes ) );
				$image_title = esc_attr( get_the_title( $attachment_id ) );

				echo apply_filters( 'wpv_woocommerce_single_product_image_thumbnail_html', sprintf( '<a data-slide-index="%d" href="" class="%s" title="%s">%s</a>', $loop, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );

				$loop++;
			}

		?></div>
	<?php endif ?>
</div>
