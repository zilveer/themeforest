<!-- BEGIN FOOTER -->
<?php 
	$inspire_options = get_option('inspire_options'); 

	if (!isset($inspire_options['footer_layout'])) { $inspire_options['footer_layout'] = "text_footer"; }
?>


	<?php 

		if ($inspire_options['footer_layout'] != "none") { echo "<footer>"; }

		if ($inspire_options['footer_layout'] == "both" || $inspire_options['footer_layout'] == "widgets_footer") { get_template_part('inc/templates/template_widgets_footer'); }
		if ($inspire_options['footer_layout'] == "both" || $inspire_options['footer_layout'] == "text_footer") { get_template_part('inc/templates/template_text_footer'); }

		if ($inspire_options['footer_layout'] != "none") { echo "</footer>"; }

	?>


	
	</div>
	<!-- END WRAPPER -->
	
	</div>
	<!-- END BG WRAPPER -->


	<!-- FOOTER TAB -->
	<div id="footer_tab">
		<img src="<?php echo get_template_directory_uri(); ?>/images/footer-toggle-down.png" title="<?php _e('Show Footer', 'loc_inspire'); ?>" alt="" />
	</div>
	
	<!-- HIDDEN FOOTER-->
	<?php get_template_part('inc/templates/template_hidden_footer'); ?>

	<div id="to_top"><img src="<?php echo get_template_directory_uri(); ?>/images/totop.png"></div>
	
	<?php if (!empty($inspire_options['google_analytics_code'])) echo $inspire_options['google_analytics_code']; ?>

	<!-- DYNAMIC FOOTER TEMPLATE-->
	<?php get_template_part('inc/templates/dynamic_footer'); ?>

	<?php wp_footer(); ?>

</body>

</html>