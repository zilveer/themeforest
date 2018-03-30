<?php
/**
 * The template for displaying the footer.
 */

global $dd_sn;

?>

		</section><!-- #main -->

		<footer id="footer">

			<?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>

				<div id="footer-primary">

					<div id="footer-primary-inner" class="container clearfix">

						<?php if ( ! dynamic_sidebar( 'sidebar-footer' ) ) : ?>

							<!-- No widgets -->

						<?php endif; ?>

					</div><!-- #footer-primary-inner -->

				</div><!-- #footer-primary -->

			<?php endif; ?>

			<div id="footer-secondary">

				<div id="footer-secondary-inner" class="container clearfix">

					<div id="footer-copyright">
						<?php echo ot_get_option( $dd_sn . 'footer_copyright', '&copy; 2013 by Wave. All rights reserved.' ); ?>
					</div><!-- #footer-copyright -->

					<nav id="footer-nav">

						<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_class' => '', 'after' => '<span class="sep">/</span>' ) ); ?>

					</nav><!-- #footer-nav -->

				</div><!-- #footer-secondary-inner -->

			</div><!-- #footer-secondary -->

		</footer><!-- #footer -->

	</div><!-- #page-container -->

	<div id="loader">
		<?php if ( is_home() ) : ?>
			<span><?php _e( 'LOADING', 'dd_string' ); ?></span>
		<?php endif; ?>
	</div><!-- #loader -->

	<?php wp_footer(); ?>

	<?php echo ot_get_option( $dd_sn . 'analytics', ''); ?>

</body>
</html>