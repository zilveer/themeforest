<?php
/*
Template Name: Full Width Page
*/	
?>
<?php get_header(); ?>
<?php get_template_part(THEME_INCLUDES.'top'); ?>
<?php 
	wp_reset_query(); 
?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<!-- BEGIN .content-main -->
	<div class="content-main alternate full-width">
		<?php if (have_posts()) : ?>
			<?php get_template_part(THEME_SINGLE."page","title"); ?>
			<?php the_content(); ?>
			<div class="split-line-1"></div>
			<?php get_template_part(THEME_SINGLE."share"); ?>
		<?php else: ?>
				<p><?php printf ( __('Sorry, no posts matched your criteria.' , THEME_NAME )); ?></p>
		<?php endif; ?>	
	<!-- END .content-main -->
	</div>
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php get_footer(); ?>