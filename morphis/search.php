<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */


global $NHP_Options; 
$options_morphis = $NHP_Options; 

get_header(); ?>

				<header class="page-header">
						<h3 class="page-title"><?php printf( __( 'Search Results for: %s', 'morphis' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
					</header>

<!-- END HEADER -->	
	<div class="clear"></div>
	<!-- MAIN BODY -->
	
    <div id="main" role="main" class="sixteen columns">
		<!-- START BLOG CONTAINER -->
		
		<div class="blog-post">
			<!-- START BLOG MAIN -->
			<?php $sidebar_pos = $options_morphis['radio_img_select_sidebar'] ?>
			
			<?php if($sidebar_pos == '1') : ?>
				<?php get_sidebar('left'); ?>
				<div class="twelve columns omega">			
			<?php elseif($sidebar_pos == '2') : ?>
				<div class="twelve columns alpha">			
			<?php else :  ?>
				
			<?php endif; ?>
			
			<?php if ( have_posts() ) : ?>

				<?php //printf( __(), ''); ?>
				
				
				
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content' );
					?>
					
				<?php endwhile; ?>

				
				
				<?php morphis_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="page-header">
						<h3 class="page-title"><?php _e( 'Nothing Found', 'morphis' ); ?></h3>
					</header><!-- .entry-header -->
					<hr />

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'morphis' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

				
		</div><!-- end .twelve columns content -->
		<?php if($sidebar_pos == '2') : ?>
		<?php get_sidebar(); ?>
		<?php endif; ?>
		<div class="clear"></div>
		</div><!-- #blog post -->
	</div>
	</div> <!-- #end cntainer -->


 <?php if( $options_morphis['twitter_hide_below'] == '1' ) { ?>
		<?php twitter_strip($options_morphis['twitter_username']); ?>
 <?php } ?>
 
<?php get_footer(); ?>