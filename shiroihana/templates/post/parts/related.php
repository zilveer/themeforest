<?php if( $related_posts = Youxi()->entries->get_related( Youxi()->option->get( 'blog_related_posts_count' ) ) ):

	global $post;
	$temp_post = $post;
	$posts_count = count( $related_posts );
	$column_width = 12 / max( Youxi()->option->get( 'blog_related_posts_count' ), $posts_count );

?><section class="entry-footer-section">

	<h3 class="entry-related-section-title">
		<span><?php _e( 'Related Posts', 'shiroi' ) ?></span>
	</h3>

	<div class="entry-related row">

		<?php foreach( $related_posts as $i => $post ) : setup_postdata( $post ); ?>

		<div class="col-md-<?php echo esc_attr( $column_width ) ?>">

			<article class="related-entry">

				<?php if( has_post_thumbnail() ): ?>

					<div class="related-entry-media">
						<figure class="related-entry-featured-image">
							<?php the_post_thumbnail( 'shiroi_4by3' ); ?>
						</figure>
					</div>

				<?php endif; ?>

				<?php the_title( '<h5 class="related-entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h5>' ); ?>

				<time class="related-entry-time" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
					<?php echo get_the_date( get_option( 'date_format' ) ); ?>
				</time>

			</article>

			<?php if( $i < $posts_count - 1 ) : ?>

				<div class="spacer-20 hidden-md hidden-lg"></div>
			
			<?php endif; ?>

		</div>

		<?php endforeach; ?>

	</div>
	
</section>
<?php

$post = $temp_post;
if( is_a( $post, 'WP_Post' ) ) {
	setup_postdata( $post );
}
endif; ?>
