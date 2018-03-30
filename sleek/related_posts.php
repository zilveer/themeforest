<?php

	// get current post tags
	$tags_obj = wp_get_post_tags($post->ID);
	if( !$tags_obj ){ return; }

	$tags = array();
	foreach( $tags_obj as $term ){
		$tags[] = $term->term_id;
	}

	$tax_query = array(
		array(
			'taxonomy' => 'post_format'
			,'field' => 'slug'
			,'terms' => array('post-format-link','post-format-aside','post-format-status','post-format-quote')
			,'operator' => 'NOT IN'
		)
	);

	$args=array(
		'tag__in' => $tags
		,'post__not_in' => array($post->ID)
		,'posts_per_page' => 3
		,'ignore_sticky_posts' => 1
		,'orderby' => 'rand'
		,'meta_key' => '_thumbnail_id' // contain featured image
		,'tax_query' => $tax_query
	);



	$query = new WP_Query($args);
	if( $query->have_posts() ):

?>

	<div class="related-posts">

		<div class="separator separator--medium"></div>

		<h2>
			<?php _e('More Posts Like This One', 'sleek'); ?>
		</h2>

		<div class="loop-container loop-container--related">
		<?php while ($query->have_posts()) : $query->the_post(); ?>

			<article id="post-<?php the_ID(); ?>" class="post post--related">
				<div class="post__inwrap">

					<?php if( has_post_thumbnail() ): ?>
						<div class="post__media">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'square-s' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="post__text">

						<div class="post__text-inwrap">
							<h3 class="post__title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>

							<div class="post__meta">
								<div class="meta--item meta--date">
									<?php echo get_the_date(); ?>
								</div>
							</div>
						</div>

					</div>

				</div>
			</article>

		<?php endwhile; ?>
		</div>
	</div>

<?php endif; ?>
<?php wp_reset_query(); ?>
