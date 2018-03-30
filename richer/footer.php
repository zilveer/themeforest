<?php 
global $options_data; 
if($options_data['check_footerwidgets'] != 0 && is_active_sidebar('Footer Widgets')) { ?>
	<footer id="footer" role="contentinfo">
		<div class="container">
			<div class="span12">
				<div class="row">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets')); ?>	
				</div>	
			</div>
		</div>
	</footer>
	<?php }
	if(!isset($options_data['check_copyright']) || $options_data['check_copyright'] != 1 ) {
	?>	
	<div id="copyright" role="contentinfo">
		<div class="container">
			<div class="span12">
				<div class="my-table">
					<div class="copyright-text my-td">
						<?php if($options_data['media_small_logo'] != "") { ?>
							<a href="<?php echo esc_url(home_url()); ?>/"><img src="<?php echo esc_attr($options_data['media_small_logo']); ?>" alt="<?php bloginfo('name'); ?>" class="copyright-logo" /></a>
						<?php } ?>
						<?php if($options_data['textarea_copyright'] != "") { ?>
							<?php echo apply_filters('richer_text_translate', 'textarea_copyright', $options_data['textarea_copyright']); ?>
						<?php } else { ?>
							&copy; <?php _e('Copyright','richer');  echo ' '.date("Y"); echo " "; bloginfo('name'); ?>
						<?php } ?>
					</div>
					<?php if($options_data['check_socialfooter'] == true) { ?>
					<div class="my-td block-right">
						<?php wp_nav_menu(array('theme_location' => 'footer_navigation', 'menu_id' => 'footer-nav', 'fallback_cb'=>false, 'depth'=> -1)); ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div><!-- end copyright -->
	<?php } ?>	
	<div class="clear"></div>
	</div> <!-- end boxed -->

	<div id="back-to-top"><a href="#"><i class="fa fa-long-arrow-up"></i></a></div>
	
	<?php if($options_data['textarea_trackingcode'] != '') { echo $options_data['textarea_trackingcode']; } ?>
	</div>
	<?php wp_footer(); ?>
</body>

</html>
