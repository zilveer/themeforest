<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $post;

$zoom = etheme_get_option('zoom_effect');

?>

<div class="row-fluid product-info product">
	<?php if (etheme_get_option('quick_images') != 'none'): ?>
		<div class="span6">
			<div class="images <?php echo ($zoom == 'disable') ? 'zoom-disabled' : '';  ?>">
				<a href="#" class='zoom hide'>Bug Fix</a>
				<?php
							
					if ( has_post_thumbnail() ) {

						$mainImageWidth = 600;
						$mainImageHeight = 900;
						$mainImageCrop = false;
						
						$image       		= etheme_get_image(false, $mainImageWidth, $mainImageHeight, $mainImageCrop);
						$attachment_ids 	= $product->get_gallery_attachment_ids();
						$image_title 		= esc_attr( get_the_title( get_post_thumbnail_id() ) );
						$image_link  		= wp_get_attachment_url( get_post_thumbnail_id() );
						$attachment_count   = count( $product->get_gallery_attachment_ids() );

						?>
						
							<div class="main-image-slider <?php if ($zoom != 'disable') {echo 'zoom-enabled';} ?>">
								
								<ul class="slides">
									<li><img src="<?php echo $image; ?>" title="<?php echo $image_title ?>"></li>
									<?php if ($attachment_ids && etheme_get_option('quick_images') == 'slider'): ?>
										<?php foreach ($attachment_ids as $key => $value): ?>
											<li><img src="<?php echo etheme_get_image($value, $mainImageWidth, $mainImageHeight, $mainImageCrop); ?>" title="<?php $image_title ?>"></li>
										<?php endforeach ?>						
									<?php endif ?>

								</ul>

							</div>
							<?php if (etheme_get_option('quick_images') == 'slider'): ?>
								<script type="text/javascript">
									jQuery('.main-image-slider').flexslider({
										animation: "slide",
										slideshow: false,
										animationLoop: false,
										controlNav: false,
										<?php if ($zoom != 'disable') {
											?>
												touch: false,
											<?php
										} ?>
									});
								</script>
							<?php endif ?>
							
						<?php

					} else {

						echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', woocommerce_placeholder_img_src() ), $post->ID );

					}
				?>

				

			</div>
		</div>
	<?php endif ?>
	<div class="<?php if (etheme_get_option('quick_images') != 'none'): ?>span6<?php else: ?>span12<?php endif;?> product_meta">
		<?php if (etheme_get_option('quick_product_name')): ?>
			<h3 class="product-name test-triggers"><?php the_title(); ?></h3>
		<?php endif ?>

		<?php if (etheme_get_option('quick_rating')): ?>
			<?php woocommerce_template_loop_rating(); ?>
		<?php endif ?>

		<?php if (etheme_get_option('quick_sku') && $product->is_type( array( 'simple', 'variable' ) ) && $product->get_sku() ) : ?>
			<span itemprop="productID" class="sku_wrapper"><?php _e( 'Product code', ETHEME_DOMAIN ); ?>: <span class="sku"><?php echo $product->get_sku(); ?></span></span>
		<?php endif; ?>

		<?php if (etheme_get_option('quick_price')): ?>
			<?php woocommerce_template_single_price(); ?>
		<?php endif; ?>
		
		<?php if (etheme_get_option('quick_descr')): ?>
			<?php woocommerce_template_single_excerpt(); ?>
		<?php endif; ?>

		<?php if (etheme_get_option('quick_add_to_cart')): ?>
			<?php woocommerce_template_single_add_to_cart(); ?>
		<?php endif; ?>
        
		<?php if (etheme_get_option('quick_share')): ?>
        	<?php if(etheme_get_option('share_icons')) echo do_shortcode('[share]'); ?>
		<?php endif; ?>

		<?php if ($product->is_in_stock() <= 0) : ?>
			<a href="<?php the_permalink(); ?>" class="single_add_to_cart_button filled big font2 button big alt"><?php _e('Show full details', ET_DOMAIN); ?></a>
		<?php endif; ?>
			
		

	</div>
</div>