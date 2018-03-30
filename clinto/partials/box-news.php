<?php

	$cat = '';

	if ( ot_get_option( 'home_news_category' ) ) :

		$cat = ot_get_option( 'home_news_category' );

	endif;

	$the_query = new WP_Query(array(
		'post_type'      => 'post',
		'posts_per_page' => 4,
		'offset'         => 0,
		'cat'            => $cat
	));

	if ( $the_query->have_posts() ) : ?>

		<!--<div class="thumbnails">-->

			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div <?php post_class( 'span3' ); ?>>
					<?php if ( has_post_thumbnail() ) { // the current post has a thumbnail ?>
						<div class="img">
							<a href="<?php the_permalink();?>"><?php the_post_thumbnail( 'portfolio', array( 'class' => '' ) );?>
								<span class="img-hover"><i class="icon-circle-arrow-right"></i></span></a>
						</div>
					<?php } ?>
					<div class="caption">
						<h4><?php if (is_sticky()) { echo '<i class="icon-pushpin sticky" title="Sticky"></i> ';}?><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
						<?php echo spritz_posted_on(); ?>
					</div>
				</div>
			<?php endwhile;
			wp_reset_postdata(); ?>
		<!--</div>-->

	<?php endif; ?>
	<?php wp_cache_flush(); ?>