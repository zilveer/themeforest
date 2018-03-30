<?php
/**
 * The template for displaying Search Results pages.
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
			<header class="page-header">
				<strong class="page-title"><?php printf( __( 'Nothing Matched', 'quasar' ), get_search_query() ); ?></strong>
			</header>
            <div class="vertical-space"></div>

            <?php echo get_search_form(); ?>
			<?php //get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->
<?php 
if(function_exists('rockthemes_pb_frontend_sidebar_after_content')) rockthemes_pb_frontend_sidebar_after_content();
else get_sidebar();
?>
<?php do_action('rockthemes_pb_frontend_after_page'); ?>
<div class="vertical-space"></div>

<?php get_footer(); ?>