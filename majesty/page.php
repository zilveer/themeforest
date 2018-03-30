<?php
/**
 * The template for displaying pages.
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
 
get_header(); ?>

<div class="padding-100">	
	<div class="container">
		<div class="row">
			
			<div class="blog-main-content post-with-sidebar col-md-9">
				<main id="main" class="site-main">
				
				<?php 
					if ( have_posts() ) :
					
						while ( have_posts() ) : the_post();
					
							get_template_part( 'content', 'page' );
												

							if ( comments_open() || get_comments_number() ) {
								comments_template();
							}
			
						endwhile;
					
					else :
				
						get_template_part( 'content', 'none' );
					
					endif;
				?>
				
				</main>
			</div>
			
			<?php get_sidebar(); ?>	
		</div>
	</div>
</div>
<?php get_footer(); ?>