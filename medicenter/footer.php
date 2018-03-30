			<?php global $theme_options, $themename; ?>
			<div class="footer_container">
				<div class="footer">
					<ul class="footer_banner_box_container clearfix">
						<?php
						$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_footer_top", true));
						if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
							dynamic_sidebar($sidebar->post_name);
						?>
					</ul>
					<div class="footer_box_container clearfix">
						<?php
						$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_footer_bottom", true));
						if(!(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
							dynamic_sidebar($sidebar->post_name);
						?>
					</div>
					<?php if($theme_options["footer_text_left"]!="" || $theme_options["footer_text_right"]!=""): ?>
					<div class="copyright_area clearfix">
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
		</div>
		<?php
		if((int)$theme_options["layout_picker"])
			mc_get_theme_file("/layout_picker/layout_picker.php");		
		wp_footer();
		?>
	</body>
</html>