<div class="testimonial"><?php

	$byline = get_post_meta( $post->ID, '_byline', true );
	$url = get_post_meta( $post->ID, '_url', true );

	if( has_post_thumbnail() ) { ?>
			<?php if( !empty( $url ) ) { ?> 
				<a href="<?php echo esc_url($url); ?>"><?php the_post_thumbnail( 'testimonial' ); ?></a>
			<?php } else { ?>
				<?php the_post_thumbnail( 'testimonial' ); ?>
			<?php } ?>
	<?php } ?>
	<blockquote>
		<?php the_content(''); ?>
		<footer>
			<?php echo get_the_title(); ?>
			<?php if( !empty( $url ) ) { ?>
				<a href="<?php echo esc_url($url); ?>"><cite title="<?php echo esc_html($byline); ?>"><?php echo esc_html($byline); ?></cite></a>
			<?php } else { ?>
				<cite title="<?php echo esc_html($byline); ?>"><?php echo esc_html($byline); ?></cite>
			<?php } ?>
		</footer>
	</blockquote>
</div>