<?php
/**
 * Single Product Image
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $woocommerce, $dfd_ronneby;
$unique_id = uniqid('woo-single-image-');
?>

<div class="images columns seven">
	<div class="single-product-image">
		<?php
		if ( has_post_thumbnail() ) {
			$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			if(function_exists('wc_get_image_size')) {
				$image_size = wc_get_image_size('shop_single');
				$img_url = dfd_aq_resize($image_link, $image_size['width'], $image_size['height'], $image_size['crop'], true, true);
				if(!$img_url) {
					$img_url = $image_link;
				}
				$image = '<img src="'.esc_url($img_url).'" class="dfd-woo-main-image" alt="'.$image_title.'" />';
			} else {
				$image = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
			}

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<div itemprop="image"  id="'. esc_attr($unique_id) .'" class="woocommerce-main-image %s">%s <img src="%s" alt="" class="dfd-large-image" /></div>', $image_title, $image, $image_link ), $post->ID );
			?>
			<script type="text/javascript">
			(function($) {
				var wrap = $('#<?php echo $unique_id; ?>');
				var wrapLeft, wrapTop, wrapWidth, wrapHeight, largeImage, largeImageWidth, largeImageheight, ratioX, ratioY;
				var calculateVars = function() {
					setTimeout(function() {
						wrapLeft =  wrap.offset().left;
						wrapTop =  wrap.offset().top;
						wrapWidth =  wrap.width();
						wrapHeight =  wrap.height();
						largeImage = wrap.find('img.dfd-large-image');
						largeImageWidth = largeImage.width();
						largeImageheight = largeImage.height();
						ratioX = largeImageWidth / wrapWidth - 1;
						ratioY = largeImageheight / wrapHeight - 1;
					},100);
				};
				var magnifierMove = function() {
					wrap.mousemove(function(e) {
						if(largeImage) {
							var coordLeft = (e.pageX - wrapLeft) * ratioX;
							if(coordLeft < 0) coordLeft = 0;
							if(coordLeft > largeImageWidth) coordLeft = largeImageWidth;
							var coordTop = (e.pageY - wrapTop) * ratioY;
							if(coordTop < 0) coordTop = 0;
							if(coordTop > largeImageheight) coordTop = largeImageheight;
							largeImage.css({
								'left' : -coordLeft,
								'top' : -coordTop
							});
						}
					});
				};
				$(document).ready(function() {
					magnifierMove();
				});
				$(window).on("resize load scroll", calculateVars);
			})(jQuery);
			</script>
			<?php
		} else {
			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );
		}
		?>
	</div>
	
	<div class="single-product-thumbnails">
		<?php do_action( 'woocommerce_product_thumbnails' ); ?>
	</div>
</div>