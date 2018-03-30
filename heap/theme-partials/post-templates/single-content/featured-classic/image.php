<?php
if ( has_post_thumbnail() ):
	$image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium-size' );
	if ( ! empty( $image[0] ) ) : ?>
		<div class="article__featured-image" itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
			<img itemprop="url" src="<?php echo esc_attr( $image[0] ); ?>" alt="<?php the_title(); ?>"/>
			<?php if ( ! empty( $image[1] ) && ! empty( $image[2] ) ): ?>
			<meta itemprop="width" content="<?php echo esc_attr( $image[1] ); ?>">
			<meta itemprop="height" content="<?php echo esc_attr( $image[2] ); ?>">
			<?php endif; ?>
		</div>
	<?php endif;
endif;