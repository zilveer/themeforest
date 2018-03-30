<?php get_header(); ?>

	<div class="eltd-container">
	<?php do_action('flow_elated_after_container_open'); ?>
		<div class="eltd-container-inner eltd-404-page">
			<div class="eltd-page-not-found">
				<h2>
					<?php if(flow_elated_options()->getOptionValue('404_title')){
						echo esc_html(flow_elated_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Page you are looking is not found', 'flow');
					} ?>
				</h2>
				<p>
					<?php if(flow_elated_options()->getOptionValue('404_text')){
						echo esc_html(flow_elated_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'flow');
					} ?>
				</p>
			</div>
		</div>
		<?php do_action('flow_elated_before_container_close'); ?>
	</div>
<?php get_footer(); ?>