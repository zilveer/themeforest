<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $post, $dfd_ronneby;

if(isset($dfd_ronneby['header_thirteenth_soc_icons_hover_style']) && !empty($dfd_ronneby['header_thirteenth_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_thirteenth_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class = 'dfd-enable-mega-menu dfd-header-layout-fixed';
if(!isset($dfd_ronneby['header_thirteenth_sticky']) || strcmp($dfd_ronneby['header_thirteenth_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
$header_container_class .= ' without-top-panel';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';
$header_container_class .= (isset($dfd_ronneby['head_thirteenth_enable_buttons']) && strcmp($dfd_ronneby['head_thirteenth_enable_buttons'], '1') === 0) ? '' : ' dfd-header-buttons-disabled';
$header_container_class .= (isset($dfd_ronneby['header_thirteenth_logo_align']) && !empty($dfd_ronneby['header_thirteenth_logo_align'])) ? ' '.$dfd_ronneby['header_thirteenth_logo_align'] : ' logo_left';

if(isset($dfd_ronneby['stun_header_title_align_header_10']) && strcmp($dfd_ronneby['stun_header_title_align_header_10'],'1') === 0) {
	$header_container_class .= ' dfd-keep-menu-fixer';
}

if(isset($dfd_ronneby['header_thirteenth_menu_align']) && !empty($dfd_ronneby['header_thirteenth_menu_align'])) {
	$header_container_class .= ' '.$dfd_ronneby['header_thirteenth_menu_align'];
}
?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
	<section id="header">
		<div class="header-wrap">
			<div class="row decorated">
				<div class="columns twelve header-main-panel">
					<div class="header-col-left">
						<?php get_template_part('templates/header/block', 'custom_logo_second'); ?>
						<div class="mobile-logo">
							<?php if(isset($dfd_ronneby['mobile_logo_image']['url']) && $dfd_ronneby['mobile_logo_image']['url']) : ?>
								<a href="<?php home_url() ?>" title="<?php _e('Home','dfd'); ?>"><img src="<?php echo esc_url($dfd_ronneby['mobile_logo_image']['url']); ?>" alt="logo"/></a>
							<?php else : ?>
								<?php get_template_part('templates/header/block', 'custom_logo_second'); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="header-col-right text-center clearfix">
						<div class="header-icons-wrapper">
							<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
							<?php get_template_part('templates/header/block', 'menu_button'); ?>
							<?php get_template_part('templates/header/block', 'lang_sel'); ?>
							<?php get_template_part('templates/header/search', 'button'); ?>
							<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
						</div>
						<?php get_template_part('templates/header/block', 'main_menu'); ?>
					</div>
					<div class="header-col-fluid">
						<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
							<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
								<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>