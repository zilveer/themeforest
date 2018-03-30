<?php 
		global $post, $mango_settings,$current_page;	
		$hide= $mango_settings['mango_hide_footer_bottom_widgets'];
		$mango_hide_bottom_footer = get_post_meta ( $current_page, 'mango_bottom_footer_widget_hide', true ) ? get_post_meta ( $current_page, 'mango_bottom_footer_widget_hide', true ) : '';		?>
		<footer id="footer" class="mango_footer_1" role="contentinfo">			<?php get_template_part("footer/footer-top-widgets"); 			
		if($mango_hide_bottom_footer==2 || $mango_hide_bottom_footer=='' && !$hide){
		?>				
		<div id="footer-inner">
		<div class="container footer-bg">
		<?php get_template_part('footer/footer-widgets') ?>					</div>				
		</div>
		<?php } ?>
			<div id="footer-bottom">
				<div class="container">
					<div class="row">																
					<div class="col-md-7 ">							
					<?php  if ( has_nav_menu ( 'footer_menu' )  && mango_show_footer_menu()) {								
					wp_nav_menu (				
					array (							
					'theme_location' => 'footer_menu',									
					'menu_class' => 'footer-menu',										"depth" => 1,							
					'container' => false					
					) );							
					}?>								
					<p class="copyright"><?php echo htmlspecialchars_decode(esc_textarea($mango_settings['mango_copyright'])) ?></p>						</div><!-- End .col-md-7 -->
						<?php if(!$mango_settings['mango_hide_payments']){ ?>
						<div class="col-md-5 ">
							<div class="payment-container">
								<img src="<?php echo esc_url($mango_settings['mango_payments_image']['url']);?>" alt="Payments">
							</div><!-- End .payment-container -->
						</div><!-- End .col-md-5 -->
                <?php 	} ?>
					
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End #footer-bottom -->
		</footer><!-- End #footer -->