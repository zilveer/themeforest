<?php
/**
 * Theme Footer
 */
?>
			<!-- Footer Start -->
			
			<footer id="footer">

				<div id="footer-left">
				
					<?php
					wp_nav_menu( array(
						'theme_location'	=> 'footer',
						'menu_id'			=> 'footer-menu-links',
						'container'			=> false, // don't wrap in div
						'depth'				=> 1, // no sub menus
						'fallback_cb'		=> false // don't show pages if no menu found - show nothing
					) );
					?>
				
					<?php risen_icons( 'footer' ); ?>
					
					<div class="clear"></div>
					
				</div>			
				
				<div id="footer-right">
				
					<?php if ( risen_option( 'footer_address' ) || risen_option( 'footer_phone' ) ) : ?>
					<ul id="footer-contact">
					
						<?php if ( risen_option( 'footer_address' ) ) : ?>
						<li><span class="footer-icon <?php echo ! risen_option( 'footer_address_non_church' ) ? 'church' : 'generic'; ?>"></span> <?php echo risen_option( 'footer_address' ); ?></li>
						<?php endif; ?>
						
						<?php if ( risen_option( 'footer_phone' ) ) : ?>
						<li><span class="footer-icon phone"></span> <?php echo risen_option( 'footer_phone' ); ?></li>
						<?php endif; ?>

					</ul>
					<?php endif; ?>
				
					<?php if ( risen_option( 'footer_copyright' ) ) : ?>
					<div id="copyright">
						<?php echo do_shortcode( risen_option( 'footer_copyright' ) ); ?>
					</div>
					<?php endif; ?>
					
				</div>
				
				<div class="clear"></div>
				
			</footer>
			
			<div id="footer-bottom"></div>
			
			<!-- Footer End -->

		</div>
	
	</div>
	
	<!-- Container End -->
	
<?php
wp_footer(); // a hook for extra code in the footer, if needed
?>

</body>
</html>