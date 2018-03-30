<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Portfolio Masonry
 */
get_header(); ?>


	<?php thb_page_before(); ?>

		<?php thb_page_start(); ?>
		
		<?php
			if( !thb_portfolio_is_filtered() ) {
				thb_portfolio_filter();
			}
			
			thb_portfolio_loop(array(
				'num_cols' => 4,
				'work_image_size' => thb_get_post_meta(thb_get_page_ID(), 'slides_size')
			));
		?>

		<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

<?php if( function_exists('dynamic_sidebar') && is_active_sidebar(thb_get_page_sidebar()) ) : ?>
	<div class="thb-main-sidebar">
		<div class="thb-main-sidebar-wrapper">
			<?php thb_page_sidebar(); ?>
		</div>
	</div>
<?php endif; ?>

<?php get_footer(); ?>