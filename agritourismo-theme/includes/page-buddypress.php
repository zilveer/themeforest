<?php
	wp_reset_query();
?>		
<?php get_template_part(THEME_LOOP."loop","start"); ?>
	<?php ot_get_sidebar($post->ID, 'left'); ?>	
	<div class="content-main alternate <?php OT_content_class($post->ID);?>">
		<?php
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();
					the_content();
				} // end while
			} // end if
		?>
	<!-- END .content-main -->
	</div>
	<?php ot_get_sidebar($post->ID, 'right'); ?>	
<?php get_template_part(THEME_LOOP."loop","end"); ?>			