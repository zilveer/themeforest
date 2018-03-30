					<?php 
						// Fetch options stored in $qns_data
						global $qns_data; 
					?>
					
					<?php /* Only display widget areas if widgets are placed in them */ 
					if ( 
						is_active_sidebar('footer-widget-area-one') or 
						is_active_sidebar('footer-widget-area-two') or 
						is_active_sidebar('footer-widget-area-three') or 
						is_active_sidebar('footer-widget-area-four') 
					) { ?>
					
					<!-- BEGIN #footer -->
					<div id="footer">
		
						<ul class="columns-4 clearfix">
							<li class="col4">
								<?php dynamic_sidebar( 'footer-widget-area-one' ); ?>
							</li>
							<li class="col4">
								<?php dynamic_sidebar( 'footer-widget-area-two' ); ?>
							</li>
							<li class="col4">
								<?php dynamic_sidebar( 'footer-widget-area-three' ); ?>
							</li>
							<li class="col4">
								<?php dynamic_sidebar( 'footer-widget-area-four' ); ?>
							</li>
						</ul>
		
					<!-- END #footer -->
					</div>
					
					<?php } ?>
					
					<!-- BEGIN #footer-bottom -->
					<div id="footer-bottom" class="clearfix">
	
						<div class="fl clearfix">
							
							<?php if ( has_nav_menu( 'footer' ) ) { ?>

								<!-- Secondary Menu -->
								<?php wp_nav_menu( array(
									'theme_location' => 'footer',
									'container' =>false,
									'items_wrap' => '<ul class="footer-menu">%3$s</ul>',
									'echo' => true,
									'before' => '',
									'after' => '',
									'link_before' => '',
									'link_after' => '',
									'depth' => 0 )
								); ?>

							<?php } ?>
							
							
							<?php // Display footer message
								if ( $qns_data['footer_msg'] ) :
									echo '<p>' . __($qns_data['footer_msg'],'qns') . '</p>';
								else :
									echo '<p>' . __('&copy; Copyright 2016','qns') . '</p>';
								endif;
							?>
						</div>	
						
						<?php if( !empty($qns_data['bottom_image']['url']) ) { ?>
							<div class="fr">
								<img src="<?php echo $qns_data['bottom_image']['url']; ?>" alt="" />	
							</div>
						<?php } ?>
	
					<!-- END #footer-bottom -->
					</div>
			
				<!-- END .content-body -->
				</div>
	
			<!-- END .content-wrapper -->
			</div>

		<!-- END .background-wrapper -->
		</div>

	<?php wp_footer(); ?>

	<!-- END body -->
	</body>
</html>