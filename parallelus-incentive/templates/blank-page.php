<?php 
/**
 * Template Name: Blank Page
 */

get_header('blank'); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="row-fluid">
					<?php $hideTitle = get_post_meta($post->ID, 'hide_title', true);
					if ( !$hideTitle ) { ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					<?php } // !$hideTitle ?>

						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'framework' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->

						<?php edit_post_link( __( 'Edit', 'framework' ), '<span class="edit-link" style="float:none;">', '</span>' ); ?>
					</div>
				</div><!-- #post -->

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer('blank'); ?>