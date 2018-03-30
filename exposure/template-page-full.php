<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 * Template name: Full width page
 */
$thb_page_id = get_the_ID();

get_header(); ?>

<div class="wrapper full-width">

	<?php if( thb_get_post_meta($thb_page_id, 'pageheader_disable') == 0 ) : ?>
	<header class="pageheader">
		<h1><?php the_title(); ?></h1>
	</header><!-- /.pageheader -->
	<?php endif; ?>

	<?php thb_page_before(); ?>
		
		<?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>
			<?php thb_page_start(); ?>
			
			<?php $content = get_the_content(); ?>

			<?php if( !empty($content) ) : ?>
			<div class="thb-text">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>
	
			<?php if( thb_show_comments() ) : ?>
			<section class="secondary">
				<?php thb_comments(); ?>
			</section>	
			<?php endif; ?>

			<?php thb_page_end(); ?>
		<?php endwhile; endif; ?>

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