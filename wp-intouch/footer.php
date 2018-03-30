<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */
?>

<?php
global $ct_options;

isset( $ct_options['ct_copyright_info'] ) ? $copyright_info = $ct_options['ct_copyright_info'] : $copyright_info = '';
isset( $ct_options['ct_add_info'] ) ? $add_info = $ct_options['ct_add_info'] : $add_info = '';
?>

<a href="#" class="ct-totop" title="<?php _e('To top','color-theme-framework'); ?>"><i class="icon-angle-up"></i></a>

<div id="footer" role="contentinfo">
	<?php if ( is_active_sidebar( 'ct_footer' ) ) : ?>
		<!-- START FOOTER WIDGETS AREA [InTouch] -->
		<div class="container">
			<div class="row">
				<?php dynamic_sidebar( 'ct_footer' ); ?>
			</div> <!-- .row -->
		</div><!-- .container -->
		<!-- END FOOTER WIDGETS AREA -->
	<?php endif; ?>

	<div class="ct-copyright">
		<div class="container">
			<?php if ( !empty($copyright_info) ) : ?>
				<!-- START COPYRIGHT [InTouch] -->
				<div class="row">
					<div class="col-lg-6">
						<div class="copyright-info">
							<?php echo $copyright_info; ?>
						</div><!-- .copyright-info -->
					</div> <!-- .col-lg-6 -->
					<div class="col-lg-6">
						<div class="add-info">
							<?php echo $add_info; ?>
						</div><!-- .copyright-info -->
					</div> <!-- .col-lg-6 -->
				</div> <!-- .row .ct-copyright -->
				<!-- END COPYRIGHT -->
			<?php endif; ?>
		</div><!-- .container -->
	</div><!-- .ct-copyright -->
</div><!-- #footer -->

<?php wp_footer(); ?>

</body>
</html>