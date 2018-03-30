<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package erg-wp
 */

get_header(); 

?>
<section id="blog-classic" class="section-scroll main-section blog-content blog blog-sidebar">
	<div class="container">
		<div class="row">

			<div class="col-xs-12 col-md-10 col-md-offset-1">
				<div id="blog-content-append">
					<?php
					if (have_posts()) :
						while (have_posts()) : the_post();

							get_template_part('content', 'blog-classic');
						
						endwhile;

						berg_wp_paging_nav();

					else :

						get_template_part('content', 'none');

					endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_template_part('footer'); ?>
