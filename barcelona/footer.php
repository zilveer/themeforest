<?php

if ( barcelona_get_option( 'show_footer' ) != 'off' ):

$barcelona_opts = barcelona_get_options( array(
	'show_footer_sidebars',
	'show_footer_menu',
	'show_footer_logo',
	'footer_copyright_text'
) );

if ( ! has_nav_menu( 'footer' ) ) {
	$barcelona_opts['show_footer_menu'] = 'off';
}

$barcelona_footer_bottom_classes = array( 'row', 'footer-bottom' );

if ( $barcelona_opts['show_footer_logo'] == 'on' ) {
	$barcelona_footer_bottom_classes[] = 'has-logo';
}

if ( $barcelona_opts['show_footer_menu'] == 'on' ) {
	$barcelona_footer_bottom_classes[] = 'has-menu';
}

if ( ! empty( $barcelona_opts['footer_copyright_text'] ) ) {
	$barcelona_footer_bottom_classes[] = 'has-copy-text';
}

?>
<footer class="<?php echo esc_attr( barcelona_footer_class() ); ?>">

	<div class="container">

		<?php if ( $barcelona_opts['show_footer_sidebars'] == 'on' ): ?>
		<div class="row footer-sidebars">
			<?php for ( $i = 1; $i <= 3; $i++ ): $barcelona_footer_sidebar = 'barcelona-footer-sidebar-'. intval( $i ); ?>
			<div class="f-col col-md-4">
				<?php
					if ( is_active_sidebar( $barcelona_footer_sidebar ) ) {
						dynamic_sidebar( $barcelona_footer_sidebar );
					}
				?>
			</div>
			<?php endfor; ?>
		</div><!-- .footer-sidebars -->
		<?php endif; ?>

		<?php if ( $barcelona_opts['show_footer_menu'] == 'on' || $barcelona_opts['show_footer_logo'] == 'on' || ! empty( $barcelona_opts['footer_copyright_text'] ) ): ?>
		<div class="<?php echo esc_attr( implode( ' ', $barcelona_footer_bottom_classes ) ); ?>">

			<div class="f-col col-md-6">

				<?php if ( $barcelona_opts['show_footer_logo'] == 'on' ): ?>
				<div class="logo-wrapper">

					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-inverse">
						<?php barcelona_logo( 'footer' ); ?>
					</a>

				</div>
				<?php endif; ?>

				<?php
				if ( ! empty( $barcelona_opts['footer_copyright_text'] ) ) {
					echo '<p class="copy-info">'. nl2br( $barcelona_opts['footer_copyright_text'] ) .'</p>';
				}
				?>

			</div>

			<div class="col col-md-6">
				<?php
				if ( $barcelona_opts['show_footer_menu'] == 'on' ) {

					wp_nav_menu( array(
						'theme_location' => 'footer',
						'container'      => false,
						'menu_class'     => 'footer-menu'
					) );

				}
				?>
			</div>

		</div>
		<?php endif; ?>

	</div><!-- .container -->

</footer><!-- footer -->

</div><!-- #page-wrapper -->

<?php

endif; // show_footer

wp_footer();

?>

</body>
</html>