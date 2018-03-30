<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Quasar
 * @since Quasar 1.0
 */

get_header(); ?>
<?php do_action('rockthemes_pb_frontend_before_page'); ?>
<?php if(function_exists('rockthemes_pb_frontend_sidebar_before_content')) rockthemes_pb_frontend_sidebar_before_content(); ?>

	<div id="primary" class="content-area large-<?php echo rockthemes_pb_frontend_get_content_columns_after_sidebars(); ?> column">
		<div id="content" class="site-content" role="main">
			
            <?php 
			if(is_single()){
				quasar_set_post_views();
			}
			?>
            
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php get_template_part( 'content', get_post_format() ); ?>
                <?php 
				if(is_single()):
					echo quasar_hr_shadow(); ?>
                	<div class="vertical-space"></div>
                <?php endif; ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php 
if(function_exists('rockthemes_pb_frontend_sidebar_after_content')) rockthemes_pb_frontend_sidebar_after_content();
else get_sidebar();
?>
<?php do_action('rockthemes_pb_frontend_after_page'); ?>
<?php get_footer(); ?>