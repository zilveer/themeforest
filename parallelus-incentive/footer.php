			<?php global $context;
			// Layout Manager - End Layout
			//................................................................
			do_action('output_layout','end'); // do_action('output_footer'); // :/ 

			// Footer layout information
			//................................................................
			$footer_data = get_layout_options('footer');
			$footer = (isset($footer_data)) ? $footer_data : false;
			// out($footer);
			// $footer = (isset($footer_data['custom_options'])) ? $footer_data['custom_options'] : false;
			// $layout = get_layout_options('footer');
			// $footer = (isset($layout['footer'])) ? get_options_data('layout_footer_'.$layout['footer']) : false;
			// $footer_data = get_layout_footer();
			// out($footer_data);
			
			// Footer Top Content
			//................................................................
			$footer_type = (isset($footer['footer-top-content'])) ? get_footer_content($footer['footer-top-content']) : false;
			if ( !empty($footer_type) ) {
				?>	
				<div id="FooterTop" class="clearfix">
					<?php
					// Footer Top Content
					if ($footer_type != 'default') { ?>
						<div class="footer-content-top type_<?php echo $footer_type ?>">
							<?php show_footer_content($footer_type, $footer['footer-top-content']); ?>
						</div>
						<?php
					} else {
						// Theme Default Footer Top 
						echo '<div class="inner-wrapper"><div class="widget-area">';
						if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer-top')) : endif;
						echo '</div> <!-- / .widget-area --> </div>';
					} ?>
					<div class="clear"></div>
				</div><!-- #FooterTop -->
				<?php
			} // End Footer Top Content
			?>
		</div><!-- .main-content -->
	</div><!-- #Middle -->
</div><!-- #page -->

<footer id="Bottom" class="site">
	<?php 
	
	// Footer Bottom Content
	//................................................................
	$footer_type = (isset($footer['footer-bottom-content'])) ? get_footer_content($footer['footer-bottom-content']) : false;
	if ( !empty($footer_type) ) {
		?>	
		<div id="FooterBottom" class="clearfix">
			<?php
			// Footer Bottom Content
			if ($footer_type != 'default') { ?>
				<div class="footer-content-bottom type_<?php echo $footer_type ?>">
					<?php show_footer_content($footer_type, $footer['footer-bottom-content']); ?>
				</div>
				<?php
			} else {
				// Theme Default Footer Bottom 
				echo '<div class="inner-wrapper"><div class="widget-area">';
				if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer-bottom')) : endif;
				echo '</div> <!-- / .widget-area --> </div>';
			} ?>
			<div class="clear"></div>
		</div><!-- #FooterBottom -->
		<?php
	} // End Footer Bottom Content
	?>
</footer><!-- #Bottom -->

<?php wp_footer(); ?>
</body>
</html>