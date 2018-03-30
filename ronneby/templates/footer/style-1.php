<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if(isset($dfd_ronneby['footer_soc_icons_hover_style']) && !empty($dfd_ronneby['footer_soc_icons_hover_style'])) {
	$footer_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['footer_soc_icons_hover_style'];
} else {
	$footer_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
?>
<div class="row">
	<div class="twelve columns text-center">
		<?php if(isset($dfd_ronneby['logo_footer']['url']) && $dfd_ronneby['logo_footer']['url'] && isset($dfd_ronneby['enable_footer_logo']) && strcmp($dfd_ronneby['enable_footer_logo'], '1') === 0) : ?>
			<div class="footer-logo">
				<a href="<?php echo esc_url(get_home_url()) ?>" alt="<?php _e('Footer logo', 'dfd') ?>"><img src="<?php echo esc_url($dfd_ronneby['logo_footer']['url']); ?>" alt="logo" class="foot-logo" /></a>
			</div>
		<?php endif; ?>
		<?php if(isset($dfd_ronneby['enable_footer_soc_icons']) && strcmp($dfd_ronneby['enable_footer_soc_icons'], '1') === 0) : ?>
			<div class="widget soc-icons <?php echo esc_attr($footer_soc_icons_hover_style) ?>">
				<?php crum_social_networks(true); ?>
			</div>
		<?php endif; ?>
		<?php if(isset($dfd_ronneby['enable_footer_menu']) && strcmp($dfd_ronneby['enable_footer_menu'], '1') === 0) : ?>
			<div class="dfd-footer-menu">
				<?php wp_nav_menu(array('theme_location' => 'footer_menu', 'depth'=>1, 'container' => 'nav', 'fallback_cb' => 'false', 'menu_class' => 'footer-menu', 'walker' => new crum_clean_walker())); ?>
			</div>
		<?php endif; ?>
		<?php if(isset($dfd_ronneby['footer_copyright_position']) && strcmp($dfd_ronneby['footer_copyright_position'], 'footer') === 0 && isset($dfd_ronneby['copyright_footer'])) : ?>
			<div class="dfd-footer-copyright">
				<?php echo $dfd_ronneby['copyright_footer']; ?>
			</div>
		<?php endif; ?>
	</div>
</div>