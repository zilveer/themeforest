<?php get_header(); ?>
	
		<div id="container" class="no-sidebar" >
				<div id="content">
				
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>		
					<article id="post-<?php the_ID(); ?>" <?php post_class('post-entry clearfix'); ?> role="article">
											
						<div class="entry-content">
							<?php the_content(); ?>
						</div><!-- .entry-content -->

					</article><!-- #post -->
				<?php endwhile; ?>
					
				</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>