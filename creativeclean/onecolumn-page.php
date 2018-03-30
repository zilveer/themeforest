<?php
/*
 * Template Name: One column, no sidebar
 */

get_header(); ?>

				<div id="content">
					<div id="fullwidth">
						<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
						<h1><?php the_title(); ?></h1>
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'creativeclean' ), '<span class="edit-link">', '</span>' ); ?>
						<?php endwhile; ?>
					</div><!-- #fullwidth -->
				
				</div>
			</div>
<?php get_footer(); ?>
