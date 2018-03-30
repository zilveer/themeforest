<?php require(gp_inc . 'options.php'); global $gp_settings, $dirname; ?>
				
				
<?php if(!is_page_template('blank-page.php')) { ?>
				
									
					<div class="clear"></div>
					
					
					<!-- BEGIN CONTENT WIDGETS -->
					
					<?php if($gp_settings['bottom_widgets'] == "Show") { ?>
					
						<?php if(is_active_sidebar('gp-bottom-content-1') OR is_active_sidebar('gp-bottom-content-2') OR is_active_sidebar('gp-bottom-content-3') OR is_active_sidebar('gp-bottom-content-4')) { ?>
							
							<div id="content-widgets">				
								
								<?php
								if(is_active_sidebar('gp-bottom-content-1') && is_active_sidebar('gp-bottom-content-2') && is_active_sidebar('gp-bottom-content-3') && is_active_sidebar('gp-bottom-content-4')) { $content_widgets = "content-widget-fourth"; }
								elseif(is_active_sidebar('gp-bottom-content-1') && is_active_sidebar('gp-bottom-content-2') && is_active_sidebar('gp-bottom-content-3')) { $content_widgets = "content-widget-third"; }
								elseif(is_active_sidebar('gp-bottom-content-1') && is_active_sidebar('gp-bottom-content-2')) {
								$content_widgets = "content-widget-half"; }	
								elseif(is_active_sidebar('gp-bottom-content-1')) { $content_widgets = "content-widget-whole"; }
								?>
							
								<?php if(is_active_sidebar('gp-bottom-content-1')) { ?>
									<div class="content-widget-outer <?php echo($content_widgets); ?>">
										<?php dynamic_sidebar('gp-bottom-content-1'); ?>
									</div>
								<?php } ?>
							
								<?php if(is_active_sidebar('gp-bottom-content-2')) { ?>
									<div class="content-widget-outer <?php echo($content_widgets); ?>">
										<?php dynamic_sidebar('gp-bottom-content-2'); ?>
									</div>
								<?php } ?>
								
								<?php if(is_active_sidebar('gp-bottom-content-3')) { ?>
									<div class="content-widget-outer <?php echo($content_widgets); ?>">
										<?php dynamic_sidebar('gp-bottom-content-3'); ?>
									</div>
								<?php } ?>
								
								<?php if(is_active_sidebar('gp-bottom-content-4')) { ?>
									<div class="content-widget-outer <?php echo($content_widgets); ?>">
										<?php dynamic_sidebar('gp-bottom-content-4'); ?>
									</div>
								<?php } ?>
						
							</div>
											
							<div class="clear"></div>
							
						<?php } ?>
					
					<?php } ?>
					
					<!-- END CONTENT WIDGETS -->
			
			
				</div>
				
				<!-- END CONTENT WRAPPER -->
				
				
				<!-- BEGIN FOOTER -->
				
				<div id="footer">
				
					<?php if(is_active_sidebar('gp-footer-1') OR is_active_sidebar('gp-footer-2') OR is_active_sidebar('gp-footer-3') OR is_active_sidebar('gp-footer-4')) { ?>
							
						<?php
						if(is_active_sidebar('gp-footer-1') && is_active_sidebar('gp-footer-2') && is_active_sidebar('gp-footer-3') && is_active_sidebar('gp-footer-4')) { $footer_widgets = "footer-fourth"; }
						elseif(is_active_sidebar('gp-footer-1') && is_active_sidebar('gp-footer-2') && is_active_sidebar('gp-footer-3')) { $footer_widgets = "footer-third"; }
						elseif(is_active_sidebar('gp-footer-1') && is_active_sidebar('gp-footer-2')) {
						$footer_widgets = "footer-half"; }	
						elseif(is_active_sidebar('gp-footer-1')) { $footer_widgets = "footer-whole"; }
						?>
					
						<?php if(is_active_sidebar('gp-footer-1')) { ?>
							<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
								<?php dynamic_sidebar('gp-footer-1'); ?>
							</div>
						<?php } ?>
					
						<?php if(is_active_sidebar('gp-footer-2')) { ?>
							<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
								<?php dynamic_sidebar('gp-footer-2'); ?>
							</div>
						<?php } ?>
						
						<?php if(is_active_sidebar('gp-footer-3')) { ?>
							<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
								<?php dynamic_sidebar('gp-footer-3'); ?>
							</div>
						<?php } ?>
						
						<?php if(is_active_sidebar('gp-footer-4')) { ?>
							<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
								<?php dynamic_sidebar('gp-footer-4'); ?>
							</div>
						<?php } ?>
						
					<?php } ?>

					<div id="copyright"><?php if(get_option($dirname.'_footer_content')) { echo stripslashes(get_option($dirname.'_footer_content')); } else { ?><?php _e('Copyright &copy;', 'gp_lang'); ?> <?php echo date('Y'); ?> <a href="http://themeforest.net/user/GhostPool/portfolio?ref=GhostPool"><?php _e('GhostPool.com', 'gp_lang'); ?></a>. <?php _e('All rights reserved.', 'gp_lang'); ?><?php } ?></div>
					
					<div class="clear"></div>
					
				</div>
				
				<!-- END FOOTER -->
				
				
			</div>
			
			
			<!-- END PAGE INNER -->	
		
		
		</div>
		
		<!-- END PAGE OUTER -->	
	
	
		<div class="clear"></div>
		
		
	</div>
	
	<!-- END PAGE WRAPPER -->


<?php } ?>


<?php wp_footer(); ?>

</body>
</html>