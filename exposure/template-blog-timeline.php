<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Blog Timeline
 */
get_header(); ?>

<?php thb_page_before(); ?>

	<?php thb_page_start(); ?>
	
	<div class="thb-content-wrapper">
		<?php get_template_part('loop/blog', 'timeline'); ?>
	</div>

	<div id="timeline-mobile-navigation">
		<?php thb_pagination( array( 'type' => 'links' ) ); ?>
	</div>

	<?php thb_page_end(); ?>

<?php thb_page_after(); ?>

<?php get_template_part('loop/timeline-blog', 'timeline'); ?>

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>