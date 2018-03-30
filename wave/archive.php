<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

	<div class="container">

		<div class="section-title-2">
			<?php
				if ( is_category() )
					printf( __( 'Category Archives: <span>%s</span>', 'dd_string' ), single_cat_title( '', false ) );
				elseif ( is_tag() )
					printf( __( 'Tag Archives: <span>%s</span>', 'dd_string' ), single_tag_title( '', false ) );
				elseif ( is_author() ) {

					the_post();
					printf( __( 'Author Archives: <span>%s</span>', 'dd_string' ), get_the_author() );
					rewind_posts();

				} elseif ( is_day() )
					printf( __( 'Daily Archives: <span>%s</span>', 'dd_string' ), get_the_date() );
				elseif ( is_month() )
					printf( __( 'Monthly Archives: <span>%s</span>', 'dd_string' ), get_the_date( 'F Y' ) );
				elseif ( is_year() )
					printf( __( 'Yearly Archives: <span>%s</span>', 'dd_string' ), get_the_date( 'Y' ) );
				else
					_e( 'Archives', 'dd_string' );

			?>
		</div><!-- #page-title -->

		<div class="blog-posts masonry clearfix">

			<?php

				if ( have_posts()) : while ( have_posts()) : the_post();
					
					get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );

				endwhile; else:

					?><div class="align-center"><?php _e( 'This archive is empty.', 'dd_string' ); ?></div><?php

				endif;

			?>

		</div><!-- .blog-posts -->

		<?php dd_theme_pagination();  ?>
		
	</div><!-- .container -->

<?php get_footer(); ?>