<?php

/**
 * @package WordPress
 * @subpackage MPC WP Boilerplate
 * @since 1.0
 */

global $mpcth_options;
global $mpcth_cake;
global $mpcth_sidebar_options;
?>

<footer id="mpcth_footer">
	<?php if(isset($mpcth_options['mpcth_show_footer']) && $mpcth_options['mpcth_show_footer'] == '1') { ?>
		<div id="mpcth_footer_content">
			<ul>
				<?php
				if(dynamic_sidebar('mpcth_main_footer') ) {
					// displays regular footer when there are no widgets in custom Footer
				} else {
					// displays widgets when they are not specified in custom & Main Footer
				}?>
			</ul>
			<div class="mpcth-clear-fix"></div>
		</div>	
	<?php } ?>
	<?php if(isset($mpcth_options['mpcth_show_copyright']) && $mpcth_options['mpcth_show_copyright'] == '1') { ?>
		<div id="mpcth_bottom_footer">
			<span class="mpcth-footer-copyright"><?php echo $mpcth_options['mpcth_copyright_text']; ?></span>
			<?php mpcth_get_social_icons(); ?>
		</div><!-- end #mpcth_bottom_footer -->
	<?php } ?>

	<?php if($mpcth_options['mpcth_analytics'] == '1') { ?>
		<script>
			<?php echo $mpcth_options['mpcth_analytics_code'];?>
		</script>
	<?php } ?>
</footer><!-- end #mpcth_footer -->

</div><!-- end #mpcth_page_wrap -->
	<?php
		global $ID;

		$page_meta = get_post_custom($ID);

		$display_toggler = false;

		if(isset($mpcth_options['mpcth_toggle_background']))
			$display_toggler = $mpcth_options['mpcth_toggle_background'];
		
		if(isset($page_meta['background_toggler_enabled'])) {
			if($page_meta['background_toggler_enabled'][0] =='on')
				$display_toggler = true;
			else
				$display_toggler = false;
		}

		if(isset($page_meta['background_type']) && $page_meta['background_type'][0] == 'none') {
			// no background
		} elseif(isset($page_meta['background_type']) && $page_meta['background_type'][0] == 'image' && isset($page_meta['background_image_source']) && $page_meta['background_image_source'][0] != '') {
			mpcth_display_image_background($page_meta['background_image_source'][0], $page_meta['background_image_pattern'][0], $display_toggler);
		} elseif(isset($page_meta['background_type']) && $page_meta['background_type'][0] == 'embed' && isset($page_meta['background_embed_source']) && $page_meta['background_embed_source'][0] != '') {
			mpcth_display_embed_background($page_meta['background_embed_source'][0], $display_toggler);
		} elseif(isset($mpcth_options['mpcth_background_type']) || (isset($page_meta['background_type']) && $page_meta['background_type'][0] == 'default')) {
			if($mpcth_options['mpcth_background_type'] == 'pattern_background' && isset($mpcth_options['mpcth_background_pattern']) && $mpcth_options['mpcth_background_pattern'] != '') {
				$image = MPC_THEME_ROOT . '/mpc-wp-boilerplate/images/' . $mpcth_options['mpcth_background_pattern'];
				$pattern = 'on';
				mpcth_display_image_background(MPC_THEME_ROOT . '/mpc-wp-boilerplate/images/' . $mpcth_options['mpcth_background_pattern'], 'on', $display_toggler);
			} elseif($mpcth_options['mpcth_background_type'] == 'custom_background' && isset($mpcth_options['mpcth_custom_bg'])) {
				$image = $mpcth_options['mpcth_custom_bg'];

				if(isset($mpcth_options['mpcth_repeat_background']) && $mpcth_options['mpcth_repeat_background'] != '')
					mpcth_display_image_background($mpcth_options['mpcth_custom_bg'], 'on', $display_toggler);
				else
					mpcth_display_image_background($mpcth_options['mpcth_custom_bg'], 'off', $display_toggler);
				
			} elseif($mpcth_options['mpcth_background_type'] == 'embed_background' && isset($mpcth_options['mpcth_embed_bg'])) {
				mpcth_display_embed_background($mpcth_options['mpcth_embed_bg'], $display_toggler);
			}
		}
	?>
<!-- </div> -->
	<?php wp_footer(); ?>
</body>
</html>