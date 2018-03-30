<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Archives
 */
$thb_page_id = get_the_ID();

get_header(); ?>

<div class="wrapper">
	<?php if( thb_get_post_meta($thb_page_id, 'pageheader_disable') == 0 ) : ?>
		<header class="pageheader">
			<h1><?php the_title(); ?></h1>
		</header><!-- /.pageheader -->
	<?php endif; ?>

	<?php thb_page_before(); ?>

		<div class="search_404">
			<?php get_search_form(); ?>
		</div>

		<div class="col content-two-fourth">
			<h3><?php _e("Archives by Month", 'thb_text_domain'); ?></h3>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		</div>

		<div class="col content-two-fourth last">
			<h3><?php _e("Archives by Subject", 'thb_text_domain'); ?></h3>
			<ul>
				 <?php wp_list_categories(array("title_li" => "")); ?>
			</ul>
		</div>

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