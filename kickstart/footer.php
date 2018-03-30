</div><!-- #wrapper -->

<?php 
	if (!ot_get_option('footer_widgets')) {
		get_sidebar('footer'); 
	} 
	
	if (!ot_get_option('copyright_bar')) {
		echo '<div id="copyright-wrapper">
				<div id="copyright-container" class="size-wrap">
					<div id="copyright" >',
						ot_get_option('copyright_area_text'),
					'</div>';
					
					wp_nav_menu( array('theme_location' => 'footer', 'container_id' => 'footer-menu', 'fallback_cb' => false));

					echo '<div class="clear"></div>
				</div>
		</div>';
	}
?>
</div><!--#layout-wrapper-->
<?php wp_footer(); ?>
</body>
</html>