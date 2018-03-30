<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package progression
 */

get_header(); ?>

<?php if ( have_posts() ) : ?>
<div id="page-title-background">
<div id="page-title">		
	<div class="width-container">
		<h1><?php printf( __( 'Search Results for: %s', 'progression' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		<?php if(function_exists('bcn_display')): ?><div id="bread-crumb"><span class="you-are-here-pro"><?php _e( 'You are here:', 'progression' ); ?></span><?php bcn_display()?></div><?php endif; ?>
		<div class="clearfix"></div>
	</div>
</div><!-- close #page-title -->
</div><!-- close #page-title -->
<?php get_template_part( 'title', 'blog' ); ?>

<div id="main">

<div class="width-container bg-sidebar-pro">
	<div id="content-container">	
		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'search' ); ?>

		<?php endwhile; ?>

		<?php show_pagination_links( ); ?>
	
	<?php else : ?>

		<?php get_template_part( 'no-results', 'search' ); ?>
		
	<?php endif; ?>
	</div>
	
	<?php get_sidebar(); ?>
	<div class="clearfix"></div>
</div>

<?php get_footer(); ?>