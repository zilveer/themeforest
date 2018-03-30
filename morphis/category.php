<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */

global $NHP_Options; 
$options_morphis = $NHP_Options; 
get_header(); ?>
<div class="clear"></div>
<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'morphis' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>
					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>
			<?php // yoast breadcrumb integration
				if ( function_exists('yoast_breadcrumb') ) {
				   yoast_breadcrumb('<div id="breadcrumbs">','</div><hr />');		   
				}
			?>
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

				<?php numbered_pagination(); ?>
				

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

