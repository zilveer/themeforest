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
 * @package Wish
 */

get_header(); ?>
	

		<div <?php post_class("container-fluid blog-page"); ?>>
			<!-- Post Starts -->
			<?php $num = get_option( 'posts_per_page' ); $wish = 0; ?>
			
			<?php query_posts('post_type=post&post_status=publish&posts_per_page='.$num.'&paged='. get_query_var('paged'));  ?>
			
						<?php if(have_posts()): while(have_posts()): the_post();  ?>
						
						
						<?php get_template_part( 'template-parts/content', get_post_format() ); ?>
						
						<?php $wish = $wish+1;  ?>
			
				<?php endwhile; ?>
				
				<?php wish_posts_navigation(); ?>
				
				<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>
				
						<?php endif; ?>
			
			
		</div>
		<!-- /. BLOG ENDS
			========================================================================= -->
		
<?php get_footer() ?>