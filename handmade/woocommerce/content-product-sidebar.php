<?php global $product; ?>
<div class="product-sidebar-item">
	<div class="product-sidebar-image">
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo  $product->get_image(); ?>
		</a>
	</div>
	<div class="product-sidebar-info">
		<a class="product-sidebar-title" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo  $product->get_title(); ?>
		</a>
		<?php echo  $product->get_price_html(); ?>
	</div>
</div>