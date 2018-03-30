<?php global $product; ?>
<li class="firstItem">
	<div class="media">
		<a class="pull-left" href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>">
			<?php echo $product->get_image(); ?>
		</a>
		<div class="media-body">
			<h4 class="media-heading"><a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a></h4>
			<span class="small-coast"><?php echo $product->get_price_html(); ?></span>
			<div class="rating">
				<?php if ( ! empty( $show_rating ) ) echo $product->get_rating_html(); ?>
			</div>
		</div>
	</div>
</li>