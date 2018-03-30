<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $post, $product, $woocommerce;
$attachment_ids = $product->get_gallery_attachment_ids();
$thumb = thb_get_featured_image( apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ), $post->ID);
$image_link = thb_get_featured_image( 'full', $post->ID);
$image = thb_get_featured_image( apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), $post->ID);
$image_title = '';
$img_sum = (int) has_post_thumbnail() + count($attachment_ids);

?>
<div class="thb-product-slideshow-wrapper images">
	<?php woocommerce_show_product_sale_flash(); ?>


	<div class="thb-product-slideshow thb-images-container rsTHB">
		<?php
			echo '<div class="rsContent">';
				printf( '<a href="%s" class="item-thumb">', $image_link );
					// echo '<span class="thb-overlay"></span>';
					printf( '<img class="rsImg" src="%s" alt="%s" />', $image, $image_title );
					 if ( $img_sum > 1 ) {
						printf( '<div class="rsTmb"><img src="%s" alt="" /></div>', $thumb );
					 }
				echo '</a>';
			echo '</div>';

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link ) {
						continue;
					}

					$image = thb_image_get_size( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
					$thumb = thb_image_get_size( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo '<div class="rsContent">';
						printf( '<a href="%s" class="item-thumb">', $image_link );
							// echo '<span class="thb-overlay"></span>';
							printf( '<img class="rsImg" src="%s" alt="%s" />', $image, $image_title );
							printf( '<div class="rsTmb"><img src="%s" alt="" /></div>', $thumb );
						echo '</a>';
					echo '</div>';
				}
			}
		?>
	</div>

</div>

<?php if ( $img_sum > 1 ) : ?>

	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$(".thb-product-slideshow").royalSlider({
					controlNavigation: 'thumbnails',
					autoHeight: true,
					loopRewind: true,
					slidesSpacing: 0,
					navigateByClick: false,
					imageScaleMode: 'none',
					imageAlignCenter:false,
					thumbs: {
						spacing: 0,
						autoCenter: false,
						arrowsAutoHide: true,
						fitInViewport: false
					}
				});
			});
		})(jQuery);
	</script>

<?php endif; ?>