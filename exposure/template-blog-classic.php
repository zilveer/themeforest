<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Blog Classic
 */
get_header(); ?>

<div class="wrapper full-width">
	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>

		<?php get_template_part('loop/blog', 'classic'); ?>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>
</div><!-- /.wrapper -->

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>