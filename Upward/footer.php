<?php if ( !defined( 'ABSPATH' ) ) exit;

	global
		$st_Options,
		$st_Settings;

		$st_['copyrights'] = !empty( $st_Settings['copyrights'] ) ? $st_Settings['copyrights'] : date( 'Y' ) . ' &copy; ' . get_bloginfo( 'sitename' );

		?>
			<div class="clear"><!-- --></div>

			<footer>

				<div id="footer">
	
					<div id="footer-layout">
	
						<div id="footer-holder">
					
							<?php

								// Footer Sidebars
								get_template_part( '/includes/sidebars/sidebar_footer' );

							?>
		
						</div><!-- #footer-holder -->
	
						<div id="copyrights-holder">
	
							<div id="copyrights-box">
						
								<?php
								
									// Company copyrights
									echo '<div id="copyrights-company">' . $st_['copyrights'] . '</div>';
							
									// Developer copyrights
									if ( !isset( $st_Settings['dev_link'] ) || empty( $st_Settings['dev_link'] ) && $st_Settings['dev_link'] != 'no' ) {
										echo '<div id="copyrights-developer">' . $st_Options['general']['label'] . ' theme by <a href="' . $st_Options['general']['developer-url'] . '">' . $st_Options['general']['developer'] . '</a></div>'; }
	
								?>
	
								<div class="clear"><!-- --></div>
	
							</div><!-- #copyrights-box -->
						
						</div><!-- #copyrights-holder -->
	
					</div><!-- #footer-layout -->
	
				</div><!-- #footer -->

			</footer>

		</div><!-- #layout -->

		<?php
		
			wp_footer();

		?>

	</body>

</html>