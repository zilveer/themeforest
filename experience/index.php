<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 
 
get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>

	<!-- BEGIN .section-wrapper -->
	<section <?php post_class( 'section-wrapper' );?>>	
	
		<!-- BEGIN .section-content-wrapper -->
		<div class="section-content-wrapper">			
			
			<!-- BEGIN .section-content -->
			<div class="section-content padding-h padding-v site-width">
				
				<!-- BEGIN .post-content -->
				<div class="post-content clearfix">
				
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
					
					<?php the_content(); ?>
					
					<?php wp_link_pages( array(
						'before'		=> '<div class="wp-link-pages">',
						'after'			=> '</div>',
						'separator'     => '<span class="pagination-separator"></span>',
						'link_before'   => '<span class="pagination-button">',
						'link_after'    => '</span>',
					) ); ?>
				
				</div>
				<!-- END .post-content -->
			
			</div>
			<!-- END .section-content -->
		
		</div>
		<!-- END .section-content-wrapper -->

	</section>
	<!-- END .section-wrapper -->

<?php endwhile; ?>

<?php get_footer(); ?>