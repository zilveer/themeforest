<?php 
/**
 * Template Name: Template - Page + SideBar
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
<?php else: ?>	
	
	<div class="h20"></div>	
	<div class="h10"></div>	
			
<?php endif; ?>
		

<div class="container animationStart startNow">		
	<div class="row page_sidebar">

		<?php 
			// Check where sidebar should be
			$sidebar_left = false; 
			if(ot_get_option('sidebar_layout','right-sidebar')=='left-sidebar'){
				$sidebar_left=true;
			}
			// Place sidebar if it's left
			($sidebar_left ? get_sidebar() : '');
		?>	
	
		<!-- Post -->
		<div <?php post_class(''); ?> id="post-<?php the_ID(); ?>" >
			<div class="twelve columns">
				<?php while (have_posts()) : the_post(); ?>
				<?php the_content() ?>
				<?php endwhile; ?>
			</div>
		</div>
		<!-- Post :: END -->
			
		<?php // Place sidebar if it's right
			  (!$sidebar_left ? get_sidebar() : '');?>
		
	</div>	
</div>

<?php get_footer(); ?>