<?php 
/**
 * Template Name: Template - Full Width
 *
 * A Full Width custom page template without sidebar.
 * @package WordPress
 */


get_header(); ?>

<?php if((is_page() || is_single()) && !is_front_page()): ?>
	<div class="full_container_page_title">	
		<div class="container animationStart">		
			<div class="row no_bm">
				<div class="sixteen columns">
				    <?php boc_breadcrumbs(); ?>
					<div class="page_heading"><h1><?php the_title(); ?></h1></div>
				</div>		
			</div>
		</div>
	</div>
<?php endif; ?>


<!-- Post -->
<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >

	<?php while (have_posts()) : the_post(); ?>

	<?php // Check for occurence of 'container'; if none - put one in to keep the layout intact 
		$content = get_the_content();
		$container_exists = strpos($content, 'row_container');

		$automatic_container_open = '
		<!-- Automatic Container -->
		<div class="container">
			<div class="row">
				<div class="sixteen columns">';
	
		$automatic_container_close = '
				</div>
			</div>
		</div>';
	?>
	
	<?php echo !$container_exists ? $automatic_container_open : ''; ?>
	<?php echo the_content(); ?>
	<?php wp_link_pages(); ?>
	<?php echo !$container_exists ? $automatic_container_close : ''; ?>
	
	<?php endwhile; ?>

</div>
<!-- Post :: END -->	

<?php get_footer(); ?>	