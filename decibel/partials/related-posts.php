<?php
global $post;
$terms = get_the_category( $post->ID );
$do_not_duplicate[] = $post->ID;

if ( ! empty( $terms ) ) {
	$term = array_shift( $terms );

	$args = array(
		'cat' => $term->term_id,
		'posts_per_page' => 3,
		'meta_key'    => '_thumbnail_id',
		'post__not_in' => $do_not_duplicate
	);

	$related_posts_query = null;
	$related_posts_query = new WP_Query( $args );
	if( $related_posts_query->have_posts() ) {
		?>
		<section class="related-posts clearfix">
			<?php while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post(); ?>
				<div class="related-post">
					<?php the_post_thumbnail( 'classic-video-thumb' ); ?>
					<a class="related-post-overlay" href="<?php the_permalink(); ?>">
							<span class="related-post-caption entry-meta">
								<h6><?php the_title(); ?></h6>
								<?php wolf_entry_date( true, false ); ?>
							</span>
					</a>
				</div>
			<?php endwhile; ?>
		</section>
	<?php
	}
}
wp_reset_postdata();
?>
