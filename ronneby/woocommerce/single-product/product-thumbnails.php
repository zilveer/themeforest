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

$carousel_vertical = 'false';

$attachment_ids = $product->get_gallery_attachment_ids();
if(has_post_thumbnail()) {
	$thumbnail_id = get_post_thumbnail_id( $post->ID );
	array_unshift($attachment_ids, $thumbnail_id);
	array_unique($attachment_ids);
}

$thumbs_num = (isset($dfd_ronneby['woo_single_thumb_number']) && !empty($dfd_ronneby['woo_single_thumb_number'])) ? $dfd_ronneby['woo_single_thumb_number'] : 4;

$thumbs_position = (isset($dfd_ronneby['woo_single_thumb_position']) && !empty($dfd_ronneby['woo_single_thumb_position'])) ? $dfd_ronneby['woo_single_thumb_position'] : '';

if(!empty($thumbs_position) && $thumbs_position == 'thumbs-left') $carousel_vertical = 'true';

$unique_id = uniqid('spc-');

if ( $attachment_ids && (!isset($dfd_ronneby['woocommerce_hide_single_thumb']) || $dfd_ronneby['woocommerce_hide_single_thumb'] != '1')) { ?>
	<div class="product-carousel">
		<div id="<?php echo esc_attr($unique_id); ?>">
		<?php
			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
			
			$lightbox_html = '<div class="hide">';

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
				$thumb_url = wp_get_attachment_image_src($attachment_id, 'thumbnail');
				$thumb_data_attr = '';
				if(isset($thumb_url[0]) && !empty($thumb_url[0])) {
					$thumb_data_attr = 'data-thumb="'.esc_url($thumb_url[0]).'"';
				}
				$lightbox_html .= '<a href="'.esc_url($image_url).'" '.$thumb_data_attr.' data-rel="prettyPhoto[woo_single_gal]"></a>';
			}
			$lightbox_html .= '</div>';
		?>
		</div>
	</div>
	<?php
	echo $lightbox_html;
	?>

	<script type="text/javascript">
		(function($) {
			"use strict";
			$(document).ready(function() {
				var $container = $('#<?php echo esc_js($unique_id); ?>');
				$container.products_thumbnails_carousel(<?php echo esc_js($thumbs_num) ?>, <?php echo esc_js($carousel_vertical) ?>);
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