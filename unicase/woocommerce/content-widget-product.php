<?php global $product; ?>
<?php $show_rating = apply_filters( 'unicase_product_list_widget_show_rating', TRUE ); ?>
<li>
	<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
		<?php echo wp_kses_post( $product->get_image() ); ?>
		<span class="product-title"><?php echo esc_html( $product->get_title() ); ?></span>
	</a>
	<?php if ( ! empty( $show_rating ) ) echo wp_kses_post( $product->get_rating_html() ); ?>
	<span class="price"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
	<?php woocommerce_template_loop_add_to_cart(); ?>
</li>