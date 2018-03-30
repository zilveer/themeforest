<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */

global $product;

$button_text = __('Add to cart', 'aurum');

?>
<div class="product-item">
	<div class="image">
	<?php
		# Primary Thumbnail
		echo '<a href="' . get_permalink() . '">';
		echo woocommerce_get_product_thumbnail('shop_thumbnail');
		echo '</a>';
	?>
	</div>
	<div class="product-details">
		<h4>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h4>

		<p class="price"><?php echo $product->get_price_html(); ?></p>
	</div>
	<div class="product-link">
		<?php if($product->is_type('simple') && $product->is_in_stock()): ?>
			<a class="btn btn-default btn-xs add-to-cart ajax-add-to-cart ajax-require-refresh" data-product-id="<?php echo $product->id; ?>" href="<?php the_permalink(); ?>" data-toggle="tooltip" data-placement="left" title="<?php echo $button_text; ?>" data-added-to-cart-title="<?php _e('Product added to cart!', 'aurum'); ?>"><?php _e('Add to cart', 'aurum'); ?></a>
		<?php elseif( in_array( $product->product_type, array( 'variable', 'grouped' ) ) ): ?>
			<a href="<?php the_permalink(); ?>" class="btn btn-default btn-xs"><?php _e('Select Options', 'aurum'); ?></a>
		<?php else: ?>
			<a href="<?php the_permalink(); ?>" class="btn btn-default btn-xs"><?php _e('View Product', 'aurum'); ?></a>
		<?php endif; ?>
	</div>
</div>
