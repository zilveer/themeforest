<article id="post-<?php the_ID(); ?>"><?php
		
	get_template_part( 'inc/thumbnail' );

	the_title( '<h2 class="post-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );

	get_template_part( 'inc/post-meta' );

	if ( is_category() || is_archive() || is_search() ) {
		the_excerpt();
	} else {
		the_content('');
	} ?>
	
	<a href="<?php echo esc_url( get_permalink() ); ?>" class="btn btn-primary read-more-btn"><?php _e('Read more', 'jobseek'); ?></a>

</article>