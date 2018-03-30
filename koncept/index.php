<?php
/**
 * Index file - silence would be golden if Envato would allow this.
 */
get_header();

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

	$args = array(
		'paged' => $paged, 
		'post_type' => 'post'
	);
	$all_posts = new WP_Query( $args );

	?>
		
	<div id="posts-container" class="clearfix">

		<?php while ( $all_posts->have_posts() ) : $all_posts->the_post();

			get_template_part( 'content' );

		endwhile; ?>

	</div>

	<div class="infinite-barrier"><span class="preloader"></span><p class="end"><?php _e( 'No More Posts', 'krown' ); ?></p><a id="infinite-link" href="<?php echo next_posts( 0, false ); ?>"><?php _e( 'Load More Posts', 'krown' ); ?></a></div>

<?php get_footer(); ?>