<?php get_header(); ?>

	<?php suprema_qodef_get_title(); ?>

	<div class="qodef-container">
	<?php do_action('suprema_qodef_after_container_open'); ?>
		<div class="qodef-container-inner qodef-404-page">
			<div class="qodef-page-not-found">
				<h2>
					<?php if(suprema_qodef_options()->getOptionValue('404_title')){
						echo esc_html(suprema_qodef_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Page you are looking is not found', 'suprema');
					} ?>
				</h2>
				<h4>
					<?php if(suprema_qodef_options()->getOptionValue('404_text')){
						echo esc_html(suprema_qodef_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'suprema');
					} ?>
				</h4>
				<?php
					$params = array();
					if (suprema_qodef_options()->getOptionValue('404_back_to_home')){
						$params['text'] = suprema_qodef_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = "Back to Home Page";
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
				echo suprema_qodef_execute_shortcode('qodef_button',$params);?>
			</div>
		</div>
		<?php do_action('suprema_qodef_before_container_close'); ?>
	</div>
<?php get_footer(); ?>