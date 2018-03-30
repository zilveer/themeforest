<?php get_header(); ?>

	<?php hue_mikado_get_title(); ?>

	<div class="mkd-container">
	<?php do_action('hue_mikado_after_container_open'); ?>
		<div class="mkd-container-inner mkd-404-page">
			<div class="mkd-page-not-found">
				<h2>
					<?php if(hue_mikado_options()->getOptionValue('404_title')){
						echo esc_html(hue_mikado_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Page you are looking for is not found', 'hue');
					} ?>
				</h2>
				<p>
					<?php if(hue_mikado_options()->getOptionValue('404_text')){
						echo esc_html(hue_mikado_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for does not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'hue');
					} ?>
				</p>
				<?php
					$params = array();
					if (hue_mikado_options()->getOptionValue('404_back_to_home')){
						$params['text'] = hue_mikado_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = esc_html__('Back to Home Page', 'hue');
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
					$params['type'] = 'gradient';
					$params['gradient_style'] = 'mkd-type2-gradient-left-to-right-2x';
					$params['margin'] = '35px 0px 0px 0px';
				echo hue_mikado_execute_shortcode('mkd_button',$params);?>
			</div>
		</div>
		<?php do_action('hue_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>