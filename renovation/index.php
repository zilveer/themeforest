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
 * @package progression
 */

get_header(); ?>

<?php $page_for_posts = get_option('page_for_posts'); ?>
<?php if( get_option( 'page_for_posts' ) ) : $cover_page = get_page( get_option( 'page_for_posts' ) ); ?>
	<?php if(get_post_meta($cover_page->ID, 'progression_category_slug', true)): ?>
	<div id="pro-home-slider"><?php echo apply_filters('the_content', get_post_meta($cover_page->ID, 'progression_category_slug', true)); ?></div>
	<?php else: ?>
	<div id="page-title-background">
	<div id="page-title">		
		<div class="width-container">
			<?php if(function_exists('bcn_display')): ?><div id="bread-crumb"><?php bcn_display()?></div><?php endif; ?>
			<h1><?php echo get_the_title($page_for_posts); ?></h1>
			<?php if(get_post_meta($cover_page->ID, 'progression_sub_headline', true)): ?>
				<div id="page-title-description"><?php echo get_post_meta($cover_page->ID, 'progression_sub_headline', true); ?></div>
			<?php endif; ?>
			<div class="clearfix"></div>
		</div>
	</div><!-- close #page-title -->
	</div><!-- close #page-title-background -->
	<?php endif; ?>
	<?php else: ?>
		<div id="page-title-background">
		<div id="page-title" class="extra-spacing">		
			<div class="width-container">
				<?php if(function_exists('bcn_display')): ?><div id="bread-crumb"><?php bcn_display()?></div><?php endif; ?>
				<h1><?php esc_html_e('Latest Posts','progression'); ?></h1>
				<div class="clearfix"></div>
			</div>
		</div><!-- close #page-title -->
		</div><!-- close #page-title-background -->
<?php endif; ?>


<?php if ( have_posts() ) : ?>


<div id="main">

<div class="width-container bg-sidebar-pro">
	<div id="content-container">
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php
				/* Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
			?>

		<?php endwhile; ?>

		<?php show_pagination_links( ); ?>

	<?php else : ?>

		<?php get_template_part( 'no-results', 'index' ); ?>

	<?php endif; ?>
	</div>
	
	<?php get_sidebar(); ?>
	<div class="clearfix"></div>
</div>

<?php get_footer(); ?>