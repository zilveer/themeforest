<div class="single_grid_product">
	<?php if (has_post_thumbnail()) { ?>
	<div class="product_med_wrap">
		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="single_product_image_link">
			<?php the_post_thumbnail( 'product_med', array('alt' => get_the_title()) ); ?>
		</a>
	</div>
	<?php } ?>
	<h3><a class="grid_title" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
	<div class="product_meta">

		<?php if ( defined( 'CC_VERSION_NUMBER' ) && of_get_option('affiliate_mode') != 'no' ) { // if Cart66 Cloud is on ?>

			<!-- Start Cloud  -->

			<?php $cart66_product = cart66_get_product(get_post_meta($post->ID, '_dc_product_id', true)); ?>

			<?php if($cart66_product): ?>
				<?php if($cart66_product['on_sale']) : ?>
					<span class="onsale"><?php _e('Sale!','designcrumbs'); ?></span>
				<?php endif; ?>

				<?php if(!empty($cart66_product['on_sale']) && !empty($cart66_product['sale_price'])): ?>
					<span class="price"><del><?php echo $cart66_product['formatted_price']; ?></del></span>
					<span class="price sale-price"><?php echo $cart66_product['formatted_sale_price']; ?></span>
				<?php else: ?>
					<span class="price price-no-sale"><?php echo $cart66_product['formatted_price']; ?></span>
				<?php endif; ?>

				<div class="right">
					<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link"><?php _e('View Details', 'designcrumbs'); ?> &raquo;</a>
				</div>

			<?php else: ?>
				<span class="no_product_attached"><?php _e('Cart66 product not attached.','designcrumbs'); ?></span>
			<?php endif; ?>

			<!-- End Cloud  -->

		<?php } else { // else if Cloud is not on (or Cloud 2.0) ?>

			<?php if ( version_compare( CC_VERSION_NUMBER, '2.0.0', '>' ) ) { ?>
			<div class="left"><?php
				$product_sku = get_post_meta( get_the_ID(), '_cc_product_sku', true );
				echo apply_money_styles( do_shortcode( '[cc_product_price sku="' . $product_sku . '"]' ) );
			?></div>
			<?php } elseif (get_post_meta($post->ID, '_dc_price', true) != '') { ?>
			<div class="left">
				<?php echo get_post_meta($post->ID, '_dc_price', true);?>
			</div>
			<?php } ?>


			<div class="right">
				<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" class="more-link"><?php _e('View Details', 'designcrumbs'); ?> &raquo;</a>
			</div>

		<?php } ?>

		<div class="clear"></div>
	</div>
</div>