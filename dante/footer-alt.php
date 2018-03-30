<?php
						$options = get_option('sf_dante_options');
						$enable_backtotop = $options['enable_backtotop'];
						$enable_footer = $options['enable_footer'];
						$enable_footer_divider = $options['enable_footer_divider'];
						$enable_copyright = $options['enable_copyright'];
						$enable_copyright_divider = $options['enable_copyright_divider'];
						$show_backlink = $options['show_backlink'];
						$page_layout = $options['page_layout'];
						$footer_config = $options['footer_layout'];
						$copyright_text = __($options['footer_copyright_text'], 'swiftframework');
						$enable_footer_promo_bar = $options['enable_footer_promo_bar'];
						$footer_promo_bar_type = $options['footer_promo_bar_type'];
						$footer_promo_bar_text = __($options['footer_promo_bar_text'], "swiftframework");
						$footer_promo_bar_button_color = $options['footer_promo_bar_button_color'];
						$footer_promo_bar_button_text = __($options['footer_promo_bar_button_text'], "swiftframework");
						$footer_promo_bar_button_link = __($options['footer_promo_bar_button_link'], "swiftframework");
						$footer_promo_bar_button_target = $options['footer_promo_bar_button_target'];
						
						global $sf_include_infscroll, $remove_promo_bar, $enable_one_page_nav;
													
						$footer_class = $copyright_class = "";
						
						if ($enable_footer_divider) { $footer_class = "footer-divider"; }
						if ($enable_copyright_divider) { $copyright_class = "copyright-divider"; }
					?>
				
				<!--// CLOSE #page-wrap //-->			
				</div>
				
			<!--// CLOSE #main-container //-->
			</div>
								
		<!--// CLOSE #container //-->
		</div>
		
		<?php if ($enable_one_page_nav) { ?>
		<!--// ONE PAGE NAV //-->
		<div id="one-page-nav">
			<ul>
			</ul>
		</div>
		<?php } ?>
		
		<?php if ($enable_backtotop) { ?>
		<!--// BACK TO TOP //-->
		<div id="back-to-top" class="animate-top"><i class="ss-navigateup"></i></div>
		<?php } ?>
		
		<!--// FULL WIDTH VIDEO //-->
		<div class="fw-video-area"><div class="fw-video-close"><i class="ss-delete"></i></div></div><div class="fw-video-spacer"></div>
		
		<?php if ($sf_include_infscroll) { ?>
		<div id="inf-scroll-params" data-loadingimage="<?php echo get_template_directory_uri(); ?>/images/loader.gif" data-msgtext="<?php _e("Loading", "swiftframework"); 
		?>" data-finishedmsg="<?php _e("All posts loaded", "swiftframework"); ?>"></div>
		<?php } ?>
						
		<!--// FRAMEWORK INCLUDES //-->
		<div id="sf-included" class="<?php echo sf_global_include_classes(); ?>"></div>
			
		<!--// WORDPRESS FOOTER HOOK //-->
		<?php wp_footer(); ?>

	
	<!--// CLOSE BODY //-->
	</body>


<!--// CLOSE HTML //-->
</html>