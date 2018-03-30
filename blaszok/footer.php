<?php
/**
 * The Footer base for MPC Themes
 *
 * Displays all of the <footer> section and everything up till </html>
 *
 * @package WordPress
 * @subpackage MPC Themes
 * @since 1.0
 */

global $mpcth_options;
global $page_id;

$hide_extended_footer = get_field('mpc_hide_extended_footer', $page_id);
$hide_footer = get_field('mpc_hide_footer', $page_id);
$hide_copyright = get_field('mpc_hide_copyright', $page_id);
$enable_toggle_footer = isset($mpcth_options['mpcth_enable_toggle_footer']) && $mpcth_options['mpcth_enable_toggle_footer'];
$enable_toggle_footer_extended = isset($mpcth_options['mpcth_enable_toggle_footer_extended']) && $mpcth_options['mpcth_enable_toggle_footer_extended'];
$enable_sticky_footer = isset($mpcth_options['mpcth_enable_sticky_footer']) && $mpcth_options['mpcth_enable_sticky_footer'];

?>
		<footer id="mpcth_footer" <?php if($enable_sticky_footer) echo 'class="sticky_footer"'; ?> >
			<div id="mpcth_footer_container">
				<?php if ($mpcth_options['mpcth_enable_footer_extended'] && ! $hide_extended_footer) { ?>
					<div id="mpcth_footer_extended_section">
						<div class="mpcth-footer-wrap">
							<?php if ($enable_toggle_footer_extended) { ?>
								<a id="mpcth_toggle_mobile_extended_footer" href="#"><span class="mpcth-toggle-text"><?php _e('Display extended footer', 'mpcth'); ?></span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
							<?php } ?>
							<div id="mpcth_footer_extended_content" <?php echo ! $enable_toggle_footer_extended ? 'class="mpcth-active"' : ''; ?>>
								<ul class="mpcth-widget-column mpcth-widget-columns-<?php echo $mpcth_options['mpcth_footer_extended_columns']; ?>">
									<?php dynamic_sidebar('mpcth_footer_extended'); ?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($mpcth_options['mpcth_enable_footer'] && ! $hide_footer) { ?>
					<div id="mpcth_footer_section">
						<div class="mpcth-footer-wrap">
							<?php if ($enable_toggle_footer) { ?>
								<a id="mpcth_toggle_mobile_footer" href="#"><span class="mpcth-toggle-text"><?php _e('Display footer', 'mpcth'); ?></span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></a>
							<?php } ?>
							<div id="mpcth_footer_content" <?php echo ! $enable_toggle_footer ? 'class="mpcth-active"' : ''; ?>>
								<ul class="mpcth-widget-column mpcth-widget-columns-<?php echo $mpcth_options['mpcth_footer_columns']; ?>">
									<?php dynamic_sidebar('mpcth_footer'); ?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>
				<?php if ($mpcth_options['mpcth_enable_copyrights'] && ! $hide_copyright) { ?>
					<div id="mpcth_footer_copyrights_section">
						<div class="mpcth-footer-wrap">
							<div id="mpcth_footer_copyrights_wrap">
								<div id="mpcth_footer_copyrights"><?php echo stripslashes($mpcth_options['mpcth_copyright_text']); ?></div>
								<?php 
								if(has_nav_menu('mpcth_copyright_menu'))
									wp_nav_menu(array(
										'theme_location' => 'mpcth_copyright_menu',
										'container' => '',
										'menu_id' => 'mpcth_copyright_menu',
										'menu_class' => 'mpcth-copyright-menu'
									));
								?>
								<ul id="mpcth_footer_socials" class="mpcth-socials-list">
									<?php mpcth_display_social_list(); ?>
								</ul>
							</div>
						</div>
					</div>
				<?php } ?>

				<?php if ($mpcth_options['mpcth_enable_analytics']) { ?>
					<script>
						<?php echo stripslashes(stripslashes($mpcth_options['mpcth_analytics_code']));?>
					</script>
				<?php } ?>
			</div><!-- end #mpcth_footer_container -->
		</footer><!-- end #mpcth_footer -->
	</div><!-- end #mpcth_page_wrap -->
	<?php
		$back_to_top_position = 'left';
		if (isset($mpcth_options['mpcth_back_to_top_position']))
			$back_to_top_position = $mpcth_options['mpcth_back_to_top_position'];

		if ($back_to_top_position != 'none')
			echo '<a href="#" id="mpcth_back_to_top" class="mpcth-back-to-top-position-' . $back_to_top_position . '"><i class="fa fa-angle-up"></i></a>';
	?>
	<?php wp_footer(); ?>
</body>
</html>