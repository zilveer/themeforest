		
		</div>
		
				
		<!-- footer -->
		<footer id="footer">

			<?php
			$footer_area = get_iron_option('footer-area_id');
			if ( is_active_sidebar( $footer_area ) ) :
				$widget_area = get_iron_option('widget_areas', $footer_area);
			?>
						<div class="footer__widgets widget-area widget-area--<?php echo esc_attr( $footer_area ); if ( $widget_area['sidebar_grid'] > 1 ) echo ' grid-cols grid-cols--' . $widget_area['sidebar_grid']; ?>">
			<?php
				do_action('before_ironband_footer_dynamic_sidebar');
			
				dynamic_sidebar( $footer_area );
			
				do_action('after_ironband_footer_dynamic_sidebar');
			?>
						</div>
			<?php
			endif;
			?>
			
			<?php
			$social_media = (bool)get_iron_option('footer_social_media_enabled');
			?>
			<?php if($social_media): ?>
			<div class="footer-block share">
				<!-- links-box -->
				<div class="links-box">
				<?php get_template_part('parts/networks'); ?>
				</div>
			</div>
			<?php endif; ?>

			<!-- footer-row -->
			<div class="footer-row">
				<div class="footer-wrapper">
					<?php
		if ( get_iron_option('footer_bottom_logo') ) :
			$output = '<img src="' . esc_url( get_iron_option('footer_bottom_logo') ) . '" alt="">';

			if ( get_iron_option('footer_bottom_link') )
				$output = sprintf('<a class="footer-logo-wrap" target="_blank" href="%s">%s</a>', esc_url( get_iron_option('footer_bottom_link') ), $output);
			else
				$output = sprintf('<a class="footer-logo-wrap" style="pointer-events:none;" href="%s">%s</a>', esc_url( get_iron_option('footer_bottom_link') ), $output);

			echo $output . "\n";
		endif;
					?>
					<div class="text"><?php echo apply_filters('the_content', get_iron_option('footer_copyright') ); ?></div>
					<div class="clear"></div>
			</div>
		</footer>
</div>
<?php wp_footer(); ?>
	<!-- Mobile Back to Top -->
	<?php 
	$footer_back_to_top_enabled = get_iron_option('footer_back_to_top_enabled');
	$footer_back_to_top_text = get_iron_option('footer_back_to_top_text');
	?>
	<?php if($footer_back_to_top_enabled): ?>
	<a href="#" id="back-to-top-mobile" class="footer-wrapper-backtotop-mobile">
		<i class="fa fa-chevron-up"></i>
	</a>
	<a href="#" id="back-to-top" class="footer-wrapper-backtotop">
		<i class="fa fa-chevron-up"></i>
	</a>
	<?php endif; ?>
</body>
</html>