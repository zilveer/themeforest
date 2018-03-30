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

$id = uniqid();


$data_config[] = '';
if( has_post_thumbnail() ) {
	$attachment_ids = $product->get_gallery_attachment_ids();
	array_unshift($attachment_ids, get_post_thumbnail_id());

	if(count($attachment_ids) > 1) {
		$data_config[] = "data-mk-component='SwipeSlideshow'";
		$data_config[] = 'data-swipeSlideshow-config=\'{
							"effect" : "slide",
							"displayTime" : "3000",
							"transitionTime" : "700",
							"nav" : ".mk-swipe-slideshow-nav-'. $id .'",
							"hasNav" : true,
							"draggable" : true,
							"fluidHeight" : true 
						  }\'';
	}
}


	if(has_post_thumbnail()) {
		if(count($attachment_ids) > 1) {
		
		/**
		 *
		 *	Gallery with multiple images
		 * 
		 */
?>

		<div id="mk-slider-<?php echo $id ?>" class="mk-swipe-slideshow mk-product-image images">

			<div class="mk-slider-holder js-el" <?php echo implode(' ', $data_config); ?>>

				<div class="mk-slider-wrapper">
					<?php
					foreach ($attachment_ids as $attachment_id) {

						$featured_image_src = Mk_Image_Resize::resize_by_id_adaptive($attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), '', '', $crop = false, $dummy = true);

						$image_gallery_link  = wp_get_attachment_image_src($attachment_id, 'full');
						$image_title = esc_attr( get_the_title( $attachment_id ) );
						?>
							<div itemprop="image" data-fancybox-group="product-gallery" class="mk-woocommerce-main-image mk-slider-slide" title="<?php echo $image_title; ?>">
								<img src="<?php echo $featured_image_src['dummy']; ?>" <?php echo $featured_image_src['data-set']; ?> alt="<?php echo $image_title; ?>" itemprop="image" />
								<a href="<?php echo $image_gallery_link[0]; ?>" data-fancybox-group="post-<?php echo $id; ?>" class="mk-lightbox swiper-zoom-icon"><?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-moon-zoom-in'); ?></a>
							</div>
						<?php 
					}
					?>
				</div>

				<div class="swiper-navigation mk-swipe-slideshow-nav-<?php echo $id ?>">
					<a class="mk-swiper-prev swiper-arrows" data-direction="prev">
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-left'); ?>
					</a>
					<a class="mk-swiper-next swiper-arrows" data-direction="next">
						<?php Mk_SVG_Icons::get_svg_icon_by_class_name(true, 'mk-jupiter-icon-arrow-right'); ?>
					</a>
				</div>

			</div>

			<div class="thumbnails  js-el" data-gallery="mk-slider-<?php echo $id ?>" data-mk-component="SwipeSlideshowExtraNav">
				<?php
				$loop = 0;
				$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 6 );

				foreach ( $attachment_ids as $attachment_id ) {

					$image_link = wp_get_attachment_url( $attachment_id );

					if ( ! $image_link ) continue;

					$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
					$image_title = esc_attr( get_the_title( $attachment_id ) );

					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="#" title="%s">%s</a>', $image_title, $image ), $attachment_id, $post->ID );

					$loop++;
				}
				?>
			</div>
		</div>

	<?php 
	} else {
		
		/**
		 *
		 *	Single image
		 * 
		 */
		
		$attachment_id = get_post_thumbnail_id();
		$image_gallery_src = Mk_Image_Resize::resize_by_id_adaptive($attachment_id, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), '', '', $crop = false, $dummy = true);
		$image_gallery_link  = wp_get_attachment_image_src($attachment_id, 'full');
		$image_title = esc_attr( get_the_title( $attachment_id ) );
		?>
		<div class="mk-product-image images">
			<div itemprop="image" data-fancybox-group="product-gallery" class="mk-woocommerce-main-image" title="<?php echo $image_title; ?>">
				<a href="<?php echo $image_gallery_link[0]; ?>" class="mk-lightbox">
					<img src="<?php echo $image_gallery_src['dummy']; ?>" <?php echo $image_gallery_src['data-set']; ?> alt="<?php echo $image_title; ?>" itemprop="image" />
				</a>
			</div>
		</div>
		<?php 
	} ?>
<?php
} else {
		
	/**
	 *
	 *	No thumb image at all
	 * 
	 */
	echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $post->ID );
} ?>