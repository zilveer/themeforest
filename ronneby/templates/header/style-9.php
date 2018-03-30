<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $dfd_ronneby;
# For stylechanger - "Show header top panel" option
/*
$show_header_top_panel = !!(strcmp($dfd_ronneby['header_top_panel'], 'on') === 0);
 * Was added for stylechanger, deprecated
 * 
if (isset($_POST['show_header_top_panel'])) {
	$show_header_top_panel = !!intval($_POST['show_header_top_panel']);
}
*/

$show_header_top_panel = isset($dfd_ronneby['header_ninth_top_panel']) && strcmp($dfd_ronneby['header_ninth_top_panel'], 'on') === 0;
if(isset($dfd_ronneby['header_ninth_soc_icons_hover_style']) && !empty($dfd_ronneby['header_ninth_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_ninth_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class = 'dfd-enable-mega-menu';
if(!isset($dfd_ronneby['header_ninth_sticky']) || strcmp($dfd_ronneby['header_ninth_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
$header_container_class .= ($show_header_top_panel) ? ' with-top-panel' : ' without-top-panel';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';
$header_container_class .= (isset($dfd_ronneby['head_ninth_enable_buttons']) && strcmp($dfd_ronneby['head_ninth_enable_buttons'], '1') === 0) ? '' : ' dfd-header-buttons-disabled';
$header_container_class .= (isset($dfd_ronneby['header_ninth_logo_align']) && !empty($dfd_ronneby['header_ninth_logo_align'])) ? ' '.$dfd_ronneby['header_ninth_logo_align'] : ' logo_left';

if(isset($dfd_ronneby['header_ninth_menu_align']) && !empty($dfd_ronneby['header_ninth_menu_align'])) {
	$header_container_class .= ' '.$dfd_ronneby['header_ninth_menu_align'];
}

if(isset($dfd_ronneby['header_ninth_middle_item']) && !empty($dfd_ronneby['header_ninth_middle_item'])) {
	$header_container_class .= ' with-'.$dfd_ronneby['header_ninth_middle_item'];
}
?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
	<section id="header">
		<?php if ($show_header_top_panel) : ?>
			<div class="header-top-panel">
				<div class="row">
					<div class="columns twelve header-info-panel">
						<?php get_template_part('templates/header/block', 'topinfo'); ?>
						
						<?php if(isset($dfd_ronneby['header_ninth_login']) && $dfd_ronneby['header_ninth_login']) { ?>
							<?php get_template_part('templates/header/block', 'login'); ?>
						<?php } ?>
						
						<?php if(isset($dfd_ronneby['head_ninth_show_header_soc_icons']) && $dfd_ronneby['head_ninth_show_header_soc_icons']) { ?>
							<div class="widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
								<?php echo crum_social_networks(true); ?>
							</div>
						<?php } ?>
						<?php if(isset($dfd_ronneby['head_ninth_enable_top_panel_wishlist_link']) && $dfd_ronneby['head_ninth_enable_top_panel_wishlist_link']) {
							echo dfd_wishlist_button();
						} ?>
					</div>
					<?php get_template_part('templates/header/block', 'toppanel'); ?>
				</div>
			</div>
		<?php endif; ?>
		<div class="logo-wrap header-top-logo-panel">
			<div class="row">
				<div class="columns twelve">
					<?php get_template_part('templates/header/block', 'custom_logo'); ?>
					<div class="dfd-header-middle-content">
						<?php
						if(isset($dfd_ronneby['header_ninth_middle_item']) && $dfd_ronneby['header_ninth_middle_item'] == 'banner' && isset($dfd_ronneby['header_ninth_banner_image']['url']) && !empty($dfd_ronneby['header_ninth_banner_image']['url']) ) {
							$banner_url = (isset($dfd_ronneby['header_ninth_banner_url']) && !empty($dfd_ronneby['header_ninth_banner_url'])) ? $dfd_ronneby['header_ninth_banner_url'] : home_url();
							?>
							<a class="dfd-header-banner-link" href="<?php echo esc_url($banner_url) ?>" title="<?php echo esc_attr__('Banner','dfd') ?>"><img src="<?php echo esc_url($dfd_ronneby['header_ninth_banner_image']['url']) ?>" alt="<?php echo esc_attr__('Banner','dfd') ?>" /></a>
							<?php
						} else {
							get_template_part('templates/header/block', 'additional_header_menu');
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<div class="header-wrap">
			<div class="row decorated">
				<div class="columns twelve header-main-panel">
					<div class="header-col-left">
						<div class="mobile-logo">
							<?php if(isset($dfd_ronneby['mobile_logo_image']['url']) && $dfd_ronneby['mobile_logo_image']['url']) : ?>
								<a href="<?php home_url() ?>" title="<?php _e('Home','dfd'); ?>"><img src="<?php echo esc_url($dfd_ronneby['mobile_logo_image']['url']); ?>" alt="logo"/></a>
							<?php else : ?>
								<?php get_template_part('templates/header/block', 'custom_logo'); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="header-col-right text-center clearfix">
						<div class="header-icons-wrapper">
							<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
							<?php get_template_part('templates/header/block', 'side_area'); ?>
							<?php get_template_part('templates/header/block', 'lang_sel'); ?>
							<?php get_template_part('templates/header/search', 'button'); ?>
							<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
						</div>
					</div>
					<div class="header-col-fluid">
						<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
							<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
								<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
							</a>
						<?php endif; ?>
						<?php get_template_part('templates/header/block', 'main_menu'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>