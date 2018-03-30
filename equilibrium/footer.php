	</div>
	<!-- END #content -->
	
	<?php 
		$footer_widgets_disabled = intval( of_get_option( 'footer_widgets_disabled', '0' ) ); 
		$number_of_widgets = intval( of_get_option( 'footer_columns', '4' ) );
		
		if ( $number_of_widgets === 4 ) {
			$grid_class = "grid_3";
		} 
		else if ( $number_of_widgets === 3 ) {
			$grid_class = "grid_4";
		}
		else if ( $number_of_widgets === 2 ) {
			$grid_class = "grid_6";
		}
	?>
	
	<!-- START #footer -->
	<footer id="footer" class="grid_12 group <?php if ( $footer_widgets_disabled ) { echo 'no-widgets'; } ?>">
		
		<?php if(!$footer_widgets_disabled) { ?>
			
			<!-- START .footer-widgets -->
			<div class="footer-widgets grid_12 alpha omega">
				
					<?php for ( $i = 1; $i <= $number_of_widgets; $i++ ) { ?>
						
						<ul class="footer-widget <?php echo $grid_class; if(  $i == 1 ) { echo ' alpha'; } elseif ( $i == $number_of_widgets ) { echo ' omega'; } ?>">
							<?php if ( is_active_sidebar( 'bottom-' . $i ) ) : ?>
				          		
				          		<?php dynamic_sidebar( 'bottom-' . $i ); ?>
				          		
				          	<?php else: ?>
				          		
				          		<li><h4><?php _e( 'Widgetized Area', 'onioneye' ); echo ' ' + $i; ?></h4></li>
					          	<li>
					          		<p><?php _e( 'Go to Appearance &raquo; Widgets tab to overwrite this section. Use any widgets that fits you best. This is called ', 'onioneye' ); ?> 
					          		<strong><?php _e( 'Bottom', 'onioneye' ); echo ' ' . $i; ?></strong>.
					          		</p>
					          	</li>
					          	
							<?php endif; ?>
						</ul>
						
				    <?php } // end foreach ?>
					
			</div>
			<!-- END .footer-widgets -->
			
		<?php } // end if ?>
		
		<!-- START .footer-meta -->
		<div class="footer-meta grid_12 alpha omega">
			<p class="grid_8 alpha"><small><?php echo of_get_option( 'copyright_text', __( 'Copyright Text', 'onioneye' ) ); ?></small></p>
					
			<div class="grid_4 omega">
				<p id="back-top">
					<a href="#top"><?php _e( 'Back to top', 'onioneye' ); ?> <span>&uarr;</span></a>
				</p>
			</div>
		</div>
		<!-- END .footer-meta -->
		
	</footer>
	<!-- END #footer -->
	
	<?php eq_the_modal_window_html(); // Enqueue the script used to control the modal window, and add the appropriate HTML for the the window itself, if it has been activated. ?>
	
<!-- START wp_footer -->
<?php wp_footer(); ?>
<!-- END wp_footer -->

</div>
<!-- END #main-wrapper -->

<?php if( of_get_option( 'custom_footer_logo', '' ) ) { ?>
	
	<!-- START #footer-logo -->
	<div id="footer-logo">
		<a href="<?php echo home_url(); ?>" title="<?php _e( 'Return to the homepage', 'onioneye' ); ?>">
			<img src="<?php echo of_get_option( 'custom_footer_logo', '' ); ?>" alt="<?php bloginfo( 'title' ); ?>" />	
		</a>
	</div>
	<!-- END #footer-logo -->

<?php } ?>

</body>
</html>
