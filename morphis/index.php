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
 * @package WordPress
 * @subpackage Morphis
 */


global $NHP_Options; 
$options_morphis = $NHP_Options; 

get_header(); ?>

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
				
				<div>
			<?php endif; ?>
			
			<?php //if ( have_posts() ) : ?>
				<?php 

				if ( get_query_var('paged') ) {

					$paged = get_query_var('paged');

				} elseif ( get_query_var('page') ) {

					$paged = get_query_var('page');

				} else {

					$paged = 1;

				}
				
				if (!empty($options_morphis['blog_exclude_cats'])) {																	
					$query_args = array(
						'post_type' => 'post',
						'paged' => $paged,
						'category__not_in' => $options_morphis['blog_exclude_cats'] 		
					);
					
				} else {
				
						$query_args = 'post_type=post&paged='. $paged;							
				}					
				
				
				$queryblog = new WP_Query( $query_args );
					
				if ( $queryblog->have_posts() ):
					
				?>

				<?php /* Start the Loop */ ?>
				<?php while ($queryblog->have_posts()) : $queryblog->the_post();  ?>
				
					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content' );
					?>


				<?php endwhile; ?>

				<?php numbered_pagination($queryblog->max_num_pages); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'morphis' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'morphis' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php //endif; ?>

				
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