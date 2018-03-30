<?php
						global $sf_options;
						$header_layout = $sf_options['header_layout'];
						if (isset($_GET['header'])) {
							$header_layout = $_GET['header'];
						}

						global $remove_promo_bar;

						if ($remove_promo_bar) {
							remove_action('sf_main_container_end', 'sf_footer_promo', 20);
						}
					?>

				<?php
					/**
					 * @hooked - sf_footer_promo - 20
					 * @hooked - sf_one_page_nav - 30
					**/
					do_action('sf_main_container_end');
				?>

			<!--// CLOSE #main-container //-->
			</div>

			<div id="footer-wrap">
				<?php
					/**
					 * @hooked - sf_footer_widgets - 10
					 * @hooked - sf_footer_copyright - 20
					**/
					do_action('sf_footer_wrap_content');
				?>
			</div>

			<?php do_action('sf_container_end'); ?>

		<!--// CLOSE #container //-->
		</div>

		<?php
			/**
			 * @hooked - sf_back_to_top - 20
			 * @hooked - sf_fw_video_area - 30
			**/
			do_action('sf_after_page_container');
		?>

		<?php wp_footer(); ?>

	<!--// CLOSE BODY //-->
	</body>


<!--// CLOSE HTML //-->
</html>