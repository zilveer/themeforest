<?php
/**
 * The template for displaying the footer.
 *
 */
?>

<?php 
	if ( get_theme_mod( 'footer_button_choice' ) ) { 
	$footer_button_animate = get_theme_mod( 'footer_button_animate' );
?>
<div class="footer_donate clearfix">

	<a href="<?php echo esc_url( get_theme_mod('footer_button_link', customizer_library_get_default( 'footer_button_link' ) ) ); ?>" class="<?php if ( $footer_button_animate != 'none' ) { echo 'wow '; echo esc_attr( $footer_button_animate ); };  ?>">
		<span class="donate_button round"><?php echo esc_attr( get_theme_mod( 'footer_button_text', customizer_library_get_default( 'footer_button_text' ) ) ); ?></span>
	</a>

</div><!-- .footer_donate -->
<?php } // end footer_button_choice ?>

<footer id="colophon" class="site-footer" role="contentinfo">

	<?php if ( get_theme_mod( 'footer_section_choice' ) ) { ?>
	<div class="row">

		<div class="large-4 columns">

	        <?php if ( is_active_sidebar( 'footer-left' ) ) { ?>

	          <?php dynamic_sidebar( 'footer-left' ); ?>

	        <?php } ?>

		</div><!-- .large-4 -->

		<div class="large-4 columns">

	        <?php if ( is_active_sidebar( 'footer-middle' ) ) { ?>

	          <?php dynamic_sidebar( 'footer-middle' ); ?>

	        <?php } ?>

		</div><!-- .large-4 -->

		<div class="large-4 columns">

	        <?php if ( is_active_sidebar( 'footer-right' ) ) { ?>

	          <?php dynamic_sidebar( 'footer-right' ); ?>

	        <?php } ?>
	        
		</div><!-- .large-4 -->

	</div><!-- .row -->
	<?php } // end footer_section_choice ?>

	<div class="copyright_wrap">
		<div class="row">

			<div class="large-12 columns">

				<div class="site-info">

					<span>
					<?php $footer_copyright = get_theme_mod( 'footer_copyright', customizer_library_get_default( 'footer_copyright' ) ) ?>
					<?php // Data validation: Allow anchor and strong tags
						echo wp_kses( $footer_copyright, 
							array(
								'strong' => array(),
								'a' => array( 'href' => array() ) 
								) 
							); 
					?>
					</span>
				</div><!-- .site-info -->

			</div><!-- .large-12 -->

		</div><!-- .row -->
	</div><!-- .copyright_wrap -->

</footer><!-- .site-footer #colophon -->

<?php wp_footer(); ?>

</body>

</html>