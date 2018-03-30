<?php 
	global $edgt_options;
?>

<?php get_header(); ?>

	<?php get_template_part( 'title' ); ?>

	<div class="container">
	<?php if($edgt_options['overlapping_content'] == 'yes') {?>
		<div class="overlapping_content"><div class="overlapping_content_inner">
	<?php } ?>
		<div class="container_inner edgt_404_page default_template_holder">
			<div class="page_not_found">
				<h2><?php if($edgt_options['404_title'] != ""): echo esc_html($edgt_options['404_title']); else: ?> <?php _e('Page you are looking is Not Found', 'edgt'); ?> <?php endif;?></h2>

                <h4><?php if($edgt_options['404_text'] != ""): echo esc_html($edgt_options['404_text']); else: ?> <?php _e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.', 'edgt'); ?> <?php endif;?></h4>
				<a class="qbutton with-shadow" href="<?php echo esc_url(home_url()); ?>/"><?php if($edgt_options['404_backlabel'] != ""): echo esc_html($edgt_options['404_backlabel']); else: ?> <?php _e('Back to homepage', 'edgt'); ?> <?php endif;?></a>
			</div>
		</div>
		<?php if($edgt_options['overlapping_content'] == 'yes') {?>
				</div></div>
		<?php } ?>
	</div>
<?php get_footer(); ?>