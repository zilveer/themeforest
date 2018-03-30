<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
 die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Footer Template
 *
 * Here we setup all logic and XHTML that is required for the footer section of all screens.
 *
 * @package WooFramework
 * @subpackage Template
 */

global $woo_options; ?>

			<a href="#" class="go-top"><div class="fa fa-chevron-up"></div></a>

			<div id="footer-wrap">

				<?php woo_footer_top(); ?>

				<?php woo_footer_before(); ?>

				<div id="footer-wrap-bottom">

					<div id="footer" class="col-full">

						<?php woo_footer_inside(); ?>

						<div id="copyright" class="col-left">
							<?php woo_footer_left(); ?>
						</div>

						<div id="credit" class="col-right">
							<?php woo_footer_right(); ?>
						</div>

					</div><!-- /#footer  -->

				</div>

			</div>

			<?php woo_footer_after(); ?>

		</div><!-- /#wrapper -->

		<div class="fix"></div><!--/.fix-->

		<?php woo_foot(); ?>

		<?php wp_footer(); ?>

	</body>

</html>