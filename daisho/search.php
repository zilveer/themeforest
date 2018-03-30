<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

<?php if( have_posts() ) { ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'flowthemes' ), get_search_query() ); ?></h1>
	</header>
		
	<div class="site-content clearfix">
		<div class="content-area" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
		</div>
		<?php get_sidebar(); ?>
	</div>
	
	<?php flow_paging_nav(); ?>
	
<?php } else { ?>
	<?php get_template_part( 'content', 'none' ); ?>
<?php } ?>

<?php get_footer(); ?>