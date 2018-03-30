<?php get_header(); ?>

	<?php libero_mikado_get_title(); ?>

	<div class="mkd-container">
	<?php do_action('libero_mikado_after_container_open'); ?>
		<div class="mkd-container-inner mkd-404-page">
			<div class="mkd-page-not-found">
				<h2>
					<?php if(libero_mikado_options()->getOptionValue('404_title')){
						echo esc_html(libero_mikado_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('404', 'libero');
					} ?>
				</h2>
				<h3>
					<?php if(libero_mikado_options()->getOptionValue('404_text')){
						echo esc_html(libero_mikado_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('Oops, something happened, this page is missing!', 'libero');
					} ?>
				</h3>
				<?php
					$params = array();
					if (libero_mikado_options()->getOptionValue('404_back_to_home')){
						$params['text'] = libero_mikado_options()->getOptionValue('404_back_to_home');
					}
					else{
						$params['text'] = "Back to Home Page";
					}
					$params['link'] = esc_url(home_url('/'));
					$params['target'] = '_self';
					$params['size'] = 'medium';
					$params['icon_pack'] = 'font_elegant';
					$params['fe_icon'] = 'arrow_carrot-right';
					$params['custom_class'] = 'mkd-404-btn';
				echo libero_mikado_execute_shortcode('mkd_button',$params);?>
			</div>
		</div>
		<?php do_action('libero_mikado_before_container_close'); ?>
	</div>
<?php get_footer(); ?>