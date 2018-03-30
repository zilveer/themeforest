<?php

	/* Template Name: Page with Sidebar */

?>
<?php get_header(); ?>
	
	<div class="container sp_sidebar">
	
	<div id="main">
	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							
		<?php get_template_part('content', 'page'); ?>
							
	<?php endwhile; endif; ?>
	
	</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>