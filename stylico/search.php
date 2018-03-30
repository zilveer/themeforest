<?php
/**
 * The template used to displaying Search Results
 *
 */
get_header(); ?>

		<section id="main" class="content-box grid_8 alpha">
			<div class="inner-content">

			<?php if ( have_posts() ) : ?>

				<div class="page-header">
					<span class="page-title"><?php printf( __( 'Search results for %s', 'stylico'), '<span>' . get_search_query() . '</span>' ); ?></span>
				</div>

				<?php while ( have_posts() ) : the_post();

				get_template_part('loop');
				
				stylico_content_nav();

				endwhile; ?>

			<?php else : ?>

				<?php stylico_nothing_found(); ?>
                <br />
                <?php get_search_form(); ?>

			<?php endif; ?>

			</div>
		</section>

        <?php get_sidebar(); ?>
        
<?php get_footer(); ?>
