<?php get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 

				while ( have_posts() ) : the_post(); 

					// Show/hide title
					$hideTitle = get_post_meta($post->ID, 'hide_title', true);
					if (!$hideTitle) : ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					<?php endif; ?>

					<div class="entry-content">
						<?php the_content(); ?>
					</div>
					<?php 

				endwhile; // end of the loop. 

				get_template_part( 'templates/grid' );  

				edit_post_link( __( 'Edit', 'framework' ), '<span class="edit-link">', '</span>' ); ?>

			</div><!-- #post-ID -->

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>