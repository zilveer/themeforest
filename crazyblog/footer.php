<?php
$settings = crazyblog_opt();
$footer_settings = $settings;
crazyblog_adCode( 'footer', 'f', 'remove-gap ads-setting' );

if ( crazyblog_set( $footer_settings, 'footer_section_1' ) ) :
	$bg = (crazyblog_set( $footer_settings, 'footer_upper_bg' )) ? crazyblog_set( $footer_settings, "footer_upper_bg" ) : '';
	$style = crazyblog_set( $footer_settings, 'footer_style' );
	?>
	<footer class="dark <?php echo esc_attr( $style ) ?>">
		<div class="block blackish">
			<div class="parallax" data-velocity="-.1" style="background: url(<?php echo esc_url( $bg ) ?>) repeat scroll 50% 0 transparent;"></div>
			<div class="container">
				<div class="row">
					<?php
					$footer_builder = crazyblog_set( crazyblog_set( $settings, 'footer_dynamic_sidebar' ), 'footer_dynamic_sidebar' );
					if ( $footer_builder ) {
						foreach ( $footer_builder as $f_side ) {
							$widget = str_replace( ' ', '-', strtolower( crazyblog_set( $f_side, 'footer_sidebar_name' ) ) );
							if ( is_active_sidebar( $widget ) ) {
								dynamic_sidebar( $widget );
							}
						}
					}
					?>
				</div>
			</div>
		</div>
	</footer><!-- Footer -->

<?php endif; ?>
<?php wp_add_inline_style( 'crazyblog_df-style', 'body{background:#000 !important;}' ); ?>
<?php if ( crazyblog_set( $footer_settings, 'footer_section_3' ) ) : ?>
	<div class="bottom-footer">
		<div class="container">
			<?php echo wp_kses_post( (crazyblog_set( $footer_settings, 'copyright_text' )) ? "<p><span>" . crazyblog_set( $footer_settings, 'copyright_text' ) . "</span></p>" : ""  ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => '', 'container' => false ) ); ?>
		</div>
	</div><!-- Bottom Footer -->
<?php endif; ?>

</div><!-- Theme Layout -->
<?php wp_footer() ?>
</body>
</html>