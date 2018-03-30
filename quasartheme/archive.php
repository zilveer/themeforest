<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Quasar
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
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

		<?php if ( have_posts() ) : ?>
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
                <div class="clear"></div>
                <div class="vertical-space"></div>
                <hr />
                <div class="vertical-space"></div>
			<?php endwhile; ?>

			<?php quasar_paging_nav(true); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php 
if(function_exists('rockthemes_pb_frontend_sidebar_after_content')) rockthemes_pb_frontend_sidebar_after_content();
else get_sidebar();
get_sidebar();
?>
<?php do_action('rockthemes_pb_frontend_after_page'); ?>
<?php get_footer(); ?>