<?php
/**
 * The Template Part for displaying the footer.
 *
 * @package BTP_Flare_Theme
 */
?>
	<?php	
		/* For the SEO purposes the preheader is placed here. */
		get_template_part( 'preheader' );		
		get_template_part( 'prefooter' );
	?>
	<footer id="footer" role="contentinfo" class="<?php echo btp_footer_get_class(); ?>">
		<div id="footer-inner">					
			<p id="footer-text">
			<?php
				$btp_footer_text = btp_theme_get_option_value('general_footer_text');
				/* WPML fallback */
				if ( function_exists( 'icl_t' ) ) {
					$btp_footer_text = icl_t( 'btp_theme_options', 'general_footer_text', $btp_footer_text);	
				}
				echo wp_kses_post( $btp_footer_text );
			?>
			</p>
			<nav id="footer-nav">	
				<?php
				 	if ( has_nav_menu( 'footer_nav' ) ) {					
						$footer_nav = array(
							'theme_location'	=> 'footer_nav',
							'container'			=> '',
							'menu_id'			=> 'footer-nav-menu',
							'menu_class'		=> 'footer-menu',
							'depth'				=> 1
						);
						wp_nav_menu($footer_nav); 
				 	} else {				 		
				 		btp_helpmode_render(
				 			__( 'Empty Footer Navigation', 'btp_theme' ),
				 			'<p>' . sprintf( __( 'You should <a href="%s">assign a menu to the Footer Navigation Theme Location</a>', 'btp_theme' ), network_admin_url( 'nav-menus.php' ) ) . '</p>'
				 		);
				 	}
				 ?>
				 <?php if ( 'none' !== btp_theme_get_option_value('style_footer_back_to_top') ): ?>
				 		<p id="footer-back-to-top"><a href="#page" class="back-to"><?php _e( 'Top', 'btp_theme' ); ?></a></p>
				 <?php endif; ?>
			</nav>			
			</div><!-- #footer-inner -->
			<div class="background">
				<div class="shadow"></div>
				<div class="pattern"></div>
				<div class="flare">
					<div></div>
					<div></div>
				</div>
			</div>
		</footer><!-- #footer -->
	</div><!-- #page-inner -->					
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>