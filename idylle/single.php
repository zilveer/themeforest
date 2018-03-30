<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Idylle
 */

get_header(); 
require_once get_template_directory() .'/template-parts/header-slider.php';
?>


<section class="idy_box idy_main_sidebar">
	<div class="container">
		
		<?php get_sidebar(); ?>
		<div class="idy_main_sidebar">
		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', get_post_format() );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div>

	</div>
</section>

<?php
get_footer();
