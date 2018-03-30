<?php
	wp_reset_query();

?>
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<?php ot_get_sidebar($post->ID, 'left'); ?>	
		<div class="content-main alternate <?php OT_content_class($post->ID);?>">
			<?php if (have_posts()) :  ?>
				<?php get_template_part(THEME_SINGLE."page","title"); ?>
				<div class="article-header">
					<?php get_template_part(THEME_SINGLE."image"); ?>
				</div>
				<?php the_content();?>
				<div class="split-line-1"></div>
				<?php get_template_part(THEME_SINGLE."share"); ?>
			<?php else: ?>
				<p><?php  _e('Sorry, no posts matched your criteria.' , THEME_NAME ); ?></p>
			<?php endif; ?>
		<!-- END .content-main -->
		</div>
	<?php ot_get_sidebar($post->ID, 'right'); ?>	
<?php get_template_part(THEME_LOOP."loop","end"); ?>
				