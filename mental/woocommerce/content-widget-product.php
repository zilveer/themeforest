<?php global $product; ?>

<li class="has-thumbnail">
	<figure>
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php $product->get_title(); ?>">
			<?php echo wp_kses( $product->get_image() , 'post'); ?>
		</a>
	</figure>
	<div class="body">
		<p class="wg-pp-title"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo esc_html($product->get_title()); ?></a></p>
		<?php if ( ! empty( $show_rating ) ) echo wp_kses( $product->get_rating_html(), mental_allowed_tags() ); ?>
		<b><?php echo wp_kses( $product->get_price_html(), mental_allowed_tags() ); ?></b>
	</div>
</li>