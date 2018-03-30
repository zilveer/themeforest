<?php 
	$footer_widgets_disabled = get_theme_mod('oy_disable_widgetized_area', 0);
	$number_of_widgets = get_option('oy_no_of_columns', 4); 
	$are_social_networks_existent = onioneye_is_social_existent();
?>
			
		</div><!-- /.main-content -->
									
		<footer class="footer group">
			<div>
				<?php if($are_social_networks_existent) { ?>																
					
					<?php get_template_part('includes/social'); ?>
					
				<?php } ?>
				
				<p class="copyright">
					<small><?php echo esc_html(sprintf(__('&copy; %1$s %2$s. All rights reserved.', 'onioneye'), get_bloginfo('name'), date("Y"))); ?></small>
				</p>
			</div>
		</footer><!-- /.footer -->	
	
	</div><!-- /.main-container -->
	
	<?php if(!$footer_widgets_disabled) { ?>
	
		<div id="scroller" class="slide-out-div tabbed-content inactive">
			
			<div class="slide-out-container">
					
				<div class="footer-widgets group">
					
					<?php for ($i = 1; $i <= $number_of_widgets; $i++) { ?>
						
						<ul class="footer-widget widget-grid-<?php echo esc_attr($number_of_widgets); ?>">
							<?php if (is_active_sidebar('bottom-' . $i)) : ?>
				          		
				          		<?php dynamic_sidebar('bottom-' . $i); ?>
				          		
				          	<?php else: ?>
				          		
				          		<li>
				          			<h3><?php esc_html_e('Widgetized Area', 'onioneye'); ?></h3>
				          		</li>
					          	<li>
					          		<p><?php printf(esc_html__('Go to Appearance &raquo; Widgets tab to overwrite this section. Use any widgets that fits you best. This is called &ldquo;Bottom %d&rdquo;', 'onioneye'), $i); ?>
					          		</p>
					          	</li>
					          	
							<?php endif; ?>
						</ul><!-- /.footer-widget -->
						
				    <?php } // end foreach ?>
						
				</div><!-- /.footer-widgets -->
				
				<div class="overlay-handle inactive">&nbsp;</div>
				
				<div id="back-to-top" class="main-top-button">
					<span class="inner"></span>
					<span class="arrow-up-icon"></span>
				</div>
				
			</div><!-- /.slide-out-container --> 
			
		</div><!-- /#scroller -->
		
		<span class="close-slide-out">&nbsp;</span>
		
	<?php } else { ?>
		
		<div id="back-to-top" class="alternative-top-button">
			<span class="inner"></span>
			<span class="arrow-up-icon"></span>
		</div>
		
	<?php } ?>
	
	<div class="overlay-loader">&nbsp;</div>
	
	<!-- wordpress footer functions -->
	<?php wp_footer(); ?>
	<!-- end of wordpress footer -->

</body>
</html>