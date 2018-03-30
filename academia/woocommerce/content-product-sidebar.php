<?php global $product; ?>
<div class="product-sidebar-item clearfix">
	<div class="product-widget-thumb">
		<?php echo wp_kses_post($product->get_image()); ?>
		<?php
		/**
		 * g5plus_woocommerce_after_product_widget_thumb hook
		 *
		 * @hooked g5plus_woocomerce_template_loop_quick_view - 15
		 * @hooked g5plus_woocomerce_template_loop_link - 20
		 *
		 */
		do_action( 'g5plus_woocommerce_after_product_widget_thumb' );
		?>
	</div>
	<div class="product-widget-inner">
		<?php
		$cat_name = '';
		$terms = wc_get_product_terms( $product->id, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
		if ($terms) {
			$cat_link = get_term_link( $terms[0], 'product_cat' );
			$cat_name = $terms[0]->name;
		}
		if (!empty($cat_name)) :
			?>
			<a class="product-widget-cat s-font" href="<?php echo esc_url($cat_link) ?>" ><?php echo esc_html($cat_name);?></a>
		<?php endif; ?>


		<a class="product-widget-title p-font" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo wp_kses_post($product->get_title()); ?>
		</a>
		<div class="product-widget-price-wrap product">
			<?php echo wp_kses_post($product->get_rating_html()); ?>
			<span class="price">
				<?php echo wp_kses_post($product->get_price_html()); ?>
			</span>
		</div>
	</div>
</div>