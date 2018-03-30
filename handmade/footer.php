			<?php
			/**
			 **/
			do_action('g5plus_main_wrapper_content_end');
			?>

			</div>
			<!-- Close Wrapper Content -->

			<?php
			global $g5plus_options;
			$prefix = 'g5plus_';
			$main_footer_class = array('main-footer-wrapper');


			$footer_wrap_layout = rwmb_meta($prefix . 'footer_wrap_layout');
			if (!isset($footer_wrap_layout) || $footer_wrap_layout == '' || $footer_wrap_layout == '-1') {
				$footer_wrap_layout = isset($g5plus_options['footer_wrap_layout']) ?  $g5plus_options['footer_wrap_layout'] : 'full';
			}

			if ($footer_wrap_layout != 'full') {
				$main_footer_class[] = $footer_wrap_layout;
			}

			$footer_parallax = rwmb_meta($prefix . 'footer_parallax');
			if (!isset($footer_parallax) || $footer_parallax == '' || $footer_parallax == '-1') {
				$footer_parallax = isset($g5plus_options['footer_parallax']) ?  $g5plus_options['footer_parallax'] : 0;
			}

			if ($footer_parallax == 1) {
				$main_footer_class[] = 'enable-parallax';
			}



			$collapse_footer = rwmb_meta($prefix . 'collapse_footer');
			if (!isset($collapse_footer) || $collapse_footer == '' || $collapse_footer == '-1') {
				$collapse_footer = isset($g5plus_options['collapse_footer']) ?  $g5plus_options['collapse_footer'] : 0;
			}

			if ($collapse_footer == 1) {
				$main_footer_class[] = 'footer-collapse-able';
			}

			$footer_scheme_custom = rwmb_meta($prefix . 'footer_scheme');
			$footer_scheme = $footer_scheme_custom;
			if (!isset($footer_scheme) || $footer_scheme == '' || $footer_scheme == '-1') {
				$footer_scheme = isset($g5plus_options['footer_scheme']) ?  $g5plus_options['footer_scheme'] : 'dark';
			}

			$main_footer_class[] = $footer_scheme;

			if ($footer_scheme_custom == 'custom') {
				$footer_bg_images = rwmb_meta($prefix.'footer_bg_image','type=image&size=full',get_the_ID());
			}
			if (isset($footer_bg_images) && $footer_bg_images) {
				$footer_bg_image_id = g5plus_get_post_meta(get_the_ID(),$prefix.'footer_bg_image',true);
				$footer_bg_image = $footer_bg_images[$footer_bg_image_id];
			} else {
				$footer_bg_image = isset($g5plus_options['footer_bg_image']) ? $g5plus_options['footer_bg_image'] : array() ;
			}
            $footer_bg_image_url = '';
			if (isset($footer_bg_image) && isset($footer_bg_image['url'])) {
				$footer_bg_image_url = $footer_bg_image['url'];
			}
			$custom_style =  '';
			if ($footer_bg_image_url != '') {
				$main_footer_class[] = 'main-footer-bg';
				$custom_style = 'style="background-image: url(' . $footer_bg_image_url . ');"';
			}


			$footer_show_hide = rwmb_meta($prefix . 'footer_show_hide');
			if (($footer_show_hide === '')) {
				$footer_show_hide = '1';
			}
			?>

			<?php if ($footer_show_hide == '1'): ?>
				<footer <?php echo wp_kses_post($custom_style); ?> class="<?php echo join(' ', $main_footer_class) ?>">
					<div id="wrapper-footer">
						<?php
						/**
                         * @hooked - g5plus_footer_widgets - 10
						 * @hooked - g5plus_bottom_bar - 20
						 **/
						do_action('g5plus_main_wrapper_footer');
						?>
					</div>
				</footer>
			<?php endif;?>
		</div>
		<!-- Close Wrapper -->

		<?php
		/**
		 * @hooked - g5plus_back_to_top - 5
		 **/
		do_action('g5plus_after_page_wrapper');
		?>
	<?php wp_footer(); ?>
</body>
</html> <!-- end of site. what a ride! -->