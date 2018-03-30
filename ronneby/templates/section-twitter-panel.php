<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['footer_tw_disp']) && $dfd_ronneby['footer_tw_disp']): ?>
	<?php if (isset($dfd_ronneby['site_boxed']) && $dfd_ronneby['site_boxed']): ?><div class="boxed_lay"><?php endif; ?>
		<section id="bot-twitter" style="
				<?php if(isset($dfd_ronneby['t_panel_padding']) && $dfd_ronneby['t_panel_padding']) {echo 'padding:30px 0;';} ?>
				<?php if(isset($dfd_ronneby['t_panel_bg_color']) && $dfd_ronneby['t_panel_bg_color']) {echo 'background-color:' . $dfd_ronneby['t_panel_bg_color'] . ';';} ?>
				<?php if(isset($dfd_ronneby['t_panel_bg_image']['url']) && $dfd_ronneby['t_panel_bg_image']['url']) {echo 'background-image:url(' . $dfd_ronneby['t_panel_bg_image']['url'] . '); background-position: center; background-attachment: fixed;'; } ?>
		">
			<div class="row">
				<?php echo do_shortcode('[dfd_twitter_row]'); ?>
			</div>
		</section>
	<?php if (isset($dfd_ronneby['site_boxed']) && $dfd_ronneby['site_boxed']): ?></div><?php endif; ?>
<?php endif; ?>
