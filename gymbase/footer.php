		<?php global $theme_options; ?>
		<div class="footer_container">
			<div class="footer">
				<ul class="footer_banner_box_container clearfix">
					<?php
					if(is_active_sidebar('footer-top'))
						get_sidebar('footer-top');
					?>
				</ul>
				<div class="footer_box_container clearfix">
					<?php
					if(is_active_sidebar('footer-bottom'))
						get_sidebar('footer-bottom');
					?>
				</div>
				<?php if($theme_options["footer_text_left"]!="" || $theme_options["footer_text_right"]!=""): ?>
				<div class="copyright_area">
					<?php if($theme_options["footer_text_left"]!=""): ?>
					<div class="copyright_left">
						<?php echo do_shortcode($theme_options["footer_text_left"]); ?>
					</div>
					<?php 
					endif;
					if($theme_options["footer_text_right"]!=""): ?>
					<div class="copyright_right">
						<?php echo do_shortcode($theme_options["footer_text_right"]); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
		<?php wp_footer(); ?>
	</body>
</html>