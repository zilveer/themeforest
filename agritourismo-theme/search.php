<?php
	get_header();
	get_template_part(THEME_INCLUDES."top");
	wp_reset_query();


?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<?php ot_get_sidebar(OT_page_ID(), 'left'); ?>		
		<div class="content-main alternate <?php OT_content_class(OT_page_ID());?>">
			<?php get_template_part(THEME_SINGLE."page","title"); ?>
			<?php $counter = 1;?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php get_template_part(THEME_LOOP."post"); ?>
			<?php $counter++; ?>
			<?php endwhile; else: ?>
				<?php get_template_part(THEME_LOOP."no","post"); ?>
			<?php endif; ?>
			<?php customized_nav_btns($paged, $wp_query->max_num_pages); ?>
		<!-- END .content-main -->
		</div>
	<?php ot_get_sidebar(OT_page_ID(), 'right'); ?>	
<?php get_template_part(THEME_LOOP."loop","end"); ?>
<?php 
	get_footer(); 
?>			
