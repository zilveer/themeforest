<?php
/**
 * The template for displaying Search Results pages
 */

get_header(); ?>
	
	<div class="container">

		<div class="section-title-2">
			<?php printf( __( 'Search for: <span>%s</span>', 'dd_string' ), get_search_query() ); ?>
		</div><!-- #page-title -->

		<div class="blog-posts masonry clearfix">

			<?php

				if ( have_posts()) : while ( have_posts()) : the_post();
					
					get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );

				endwhile; else:

					?><div class="align-center"><?php _e( 'Nothing that fits the search term was found', 'dd_string' ); ?></div><?php

				endif;

			?>

		</div><!-- .blog-posts -->

		<?php dd_theme_pagination();  ?>

	</div><!-- .container -->

<?php get_footer(); ?>