<?php 
	global $qode_options;
?>

<?php get_header(); ?>

	<?php get_template_part( 'title' ); ?>

	<div class="container">
		<div class="container_inner q_404_page default_template_holder">
			<div class="page_not_found">
				<h2><?php if($qode_options['404_title'] != ""): echo esc_html($qode_options['404_title']); else: ?> <?php _e('Page you are looking is Not Found', 'qode'); ?> <?php endif;?></h2>

                <h4><?php if($qode_options['404_text'] != ""): echo esc_html($qode_options['404_text']); else: ?> <?php _e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site’s homepage and see if you can find what you are looking for.', 'qode'); ?> <?php endif;?></h4>
				<a class="qbutton with-shadow" href="<?php echo esc_url(home_url('/')); ?>"><?php if($qode_options['404_backlabel'] != ""): echo esc_html($qode_options['404_backlabel']); else: ?> <?php _e('Back to homepage', 'qode'); ?> <?php endif;?></a>
			</div>
		</div>
	</div>
<?php get_footer(); ?>