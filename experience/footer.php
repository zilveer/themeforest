<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing tags of .page-wrapper and .wapper elements.
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/
 
// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options(); ?>

		<?php if ( 
			!is_404()
			&& (
					!is_page()
					|| get_post_meta( $post->ID, "experience_hide_footer", true ) != 'on' 
				)
		) { ?>
		
			<!-- BEING .site-footer -->
			<footer class="site-footer">
				
				<?php $sidebar_name_clean = experience_get_sidebar_name( esc_html__( "Footer", 'experience' ) );				
				if ( is_active_sidebar( $sidebar_name_clean ) ) { ?>				
					<div class="clearfix padding-h padding-v site-width">				
						<?php dynamic_sidebar( $sidebar_name_clean ); ?>						
					</div>					
				<?php } ?>
				
				<div class="clearfix padding-h padding-v">
					
					<!-- BEGIN .footer-content -->
					<div class="footer-content">
					
						<!-- BEING .footer-text -->
						<div class="footer-text padding-h">
						
							<?php if ( !empty( $experience_theme_array['footer-text'] ) ) {							
								echo do_shortcode( $experience_theme_array['footer-text'] );								
							} ?>
							
							<!-- BEING .copyright -->
							<span class="copyright"><?php echo wp_kses( sprintf( __( ' &copy; %1$s <a href="%2$s">%3$s</a>', 'experience' ), date( "Y" ), get_home_url(), get_bloginfo( 'name' ) ), array( 'a' => array( 'href' => array(), 'title' => array() ) ) ); ?></span>
							<!-- END .copyright -->							
					
						</div>
						<!-- END .footer-text -->	
						
						<a class="back-to-top-link" href="#top">
							<span class="funky-icon-arrow-up"></span>
						</a>
					
					</div>					
					<!-- END .footer-content -->				
					
				</div>				
			
			</footer>
			<!-- END .site-footer -->
		
		<?php } ?>		
	
	</div>
	<!-- END .wrapper -->

	<?php wp_footer(); ?>

</body>
</html>