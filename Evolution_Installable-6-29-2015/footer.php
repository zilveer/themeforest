	<?php $alc_options = isset($_POST['options']) ? $_POST['options'] : get_option('alc_general_settings');?>
	<div class="row top-footer">
		<div class="shadow"></div>
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Top Sidebar") ) :endif; ?>		
		<!-- Bottom Content -->
		<?php 
			$footer_widget_count = isset($alc_options['alc_footer_widgets_count']) ? $alc_options['alc_footer_widgets_count']:0;
			if($footer_widget_count > 0):
				for($i = 1; $i<= $footer_widget_count; $i++){
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Footer Widget ".$i) ) :endif;
				}			
			endif; 
		?>		
	</div>
	<div class="row bottom-footer">
		<div class="large-6 columns">
			<p class="copyright"><?php echo $alc_options['alc_copyright']?></p>
		</div>
		<div class="large-6 columns">
			<?php 
			wp_nav_menu( 
			array( 
				'theme_location' => 'footer_nav',
				'menu' =>'footer_nav', 
				'container'=>'', 
				'depth' => 1, 
				'menu_class' => 'inline-list right'
			)); 
			?>
		</div>
	</div>		
</div> <!-- End main wrapper -->	
<?php //include ('optionspanel.php') ?>
<a href="#" class="scrollup" style="display: inline"><?php _e('Scroll', 'Evolution')?></a>
<?php if (isset($alc_options['alc_custom_js'])) echo $alc_options['alc_custom_js']; ?>
<?php wp_footer()?>
</body>
</html>