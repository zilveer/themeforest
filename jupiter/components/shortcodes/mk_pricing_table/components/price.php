<div class="pricing-price">
	<span>
		<sup><?php echo get_post_meta( get_the_ID(), '_currency', true ); ?></sup><?php echo get_post_meta( get_the_ID(), '_price', true ); ?>
		<sub><?php echo get_post_meta( get_the_ID(), '_period', true ); ?></sub>
	</span>
</div>