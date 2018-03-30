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

?>
<?php
	$attachment_ids = $product->get_gallery_attachment_ids();
	$placeholder = false;
	if ( has_post_thumbnail() ) {
		$image_title = esc_attr( get_the_title( get_post_thumbnail_id() ) );
		$image       = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
			'title' => $image_title
			) );
		$image_full = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
	}else{
		$image_title = get_the_title($product->id);
		$image =  apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
		$image_full = array(wc_placeholder_img_src());
		$placeholder = true;
	}
?>
	<?php $shop_single = wc_get_image_size( 'shop_single' );?>
	<div class="single-product-images-slider<?php echo ($attachment_ids ? ' single-product-images-slider-gallery':''); ?>" data-item_template = "<?php echo esc_attr('<li class="caroufredsel-item"><a href="__image_full__" data-rel="magnific-popup-verticalfit" title="__image_title__">__image__</a></li>'); ?>">
		<div class="caroufredsel product-images-slider" data-synchronise=".single-product-images-slider-synchronise" data-scrollduration="500" data-height="variable" data-scroll-fx="none" data-visible="1" data-circular="1" data-responsive="1">
			<div class="caroufredsel-wrap">
				<ul class="caroufredsel-items">
					<?php if(apply_filters('dh_use_feature_product_image_in_single', false)):?>
					<li class="caroufredsel-item">
						<a data-itemprop="image" href="<?php echo esc_attr(@$image_full[0])?>" data-rel="magnific-popup-verticalfit" title="<?php echo esc_attr($image_title)?>">
							<?php echo dh_print_string($image)?>
						</a>
					</li>
					<?php endif;?>
					<?php if ( $attachment_ids ) {?>
						<?php  $loop=1; ?>
						<?php foreach ( $attachment_ids as $attachment_id ) {?>
						<?php 
						$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
						$image_title = esc_attr( get_the_title( $attachment_id ) );
						$image_full = wp_get_attachment_image_src($attachment_id,'full');
						?>
						<li class="caroufredsel-item">
							<div class="thumb">
								<a href="<?php echo esc_attr(@$image_full[0])?>" data-rel="magnific-popup-verticalfit" title="<?php echo esc_attr($image_title)?>">
									<?php echo dh_print_string($image)?>
								</a>
							</div>
						</li>
						<?php
							$loop ++; 
							}
						 ?>
					<?php } ?>
				</ul>
				<a href="#" class="caroufredsel-prev"></a>
				<a href="#" class="caroufredsel-next"></a>
			</div>
		</div>
	</div>
<?php
do_action( 'woocommerce_product_thumbnails' );
?>
