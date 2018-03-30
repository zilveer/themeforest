<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

if(isset($dfd_ronneby['header_eleventh_soc_icons_hover_style']) && !empty($dfd_ronneby['header_eleventh_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_eleventh_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class = 'dfd-header-layout-fixed dfd-enable-mega-menu';
$header_container_class .= (isset($dfd_ronneby['header_eleventh_alignment']) && !empty($dfd_ronneby['header_eleventh_alignment'])) ? ' '.$dfd_ronneby['header_eleventh_alignment'] : ' left';

?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
	<section id="header">
		<div class="header-wrap">
			<div class="row decorated">
				<div class="columns twelve header-main-panel">
					<?php if(isset($dfd_ronneby['small_logo_image']['url']) && $dfd_ronneby['small_logo_image']['url']) : ?>
						<div class="dfd-small-logo dfd-header-responsive-hide">
							<?php
							//$small_logo = dfd_aq_resize($dfd_ronneby['small_logo_image']['url'], 100, 100, true, true, true);
							//if(!$small_logo) {
								$small_logo = $dfd_ronneby['small_logo_image']['url'];
							//}
							?>
							<img src="<?php echo esc_url($small_logo); ?>" alt="logo" />
						</div>
					<?php endif; ?>
					<div class="header-col-left">
						<div class="mobile-logo">
							<?php if(isset($dfd_ronneby['mobile_logo_image']['url']) && $dfd_ronneby['mobile_logo_image']['url']) : ?>
								<a href="<?php home_url() ?>" title="<?php _e('Home','dfd'); ?>"><img src="<?php echo esc_url($dfd_ronneby['mobile_logo_image']['url']); ?>" alt="logo"/></a>
							<?php else : ?>
								<?php get_template_part('templates/header/block', 'custom_logo'); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="header-col-fluid">
						<?php //get_template_part('templates/header/block', 'main_menu'); ?>
						<nav class="mega-menu clearfix" id="main_mega_menu">
							<?php
								wp_nav_menu(array(
									'theme_location' => 'side_header_menu', 
									'menu_class' => 'nav-menu menu-primary-navigation menu-clonable-for-mobiles', 
									'fallback_cb' => 'false'
								));
							?>
						</nav>
					</div>
					<div class="header-col-right">
						<div class="dfd-header-responsive-hide">
							<?php if(isset($dfd_ronneby['header_eleventh_login']) && $dfd_ronneby['header_eleventh_login']) { ?>
								<?php get_template_part('templates/header/block', 'login'); ?>
							<?php } ?>
						</div>
						<div class="header-icons-wrapper">
							<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
							<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
							<?php get_template_part('templates/header/search', 'button'); ?>
							<?php get_template_part('templates/header/block', 'lang_sel'); ?>
						</div>
					</div>
					<?php if(isset($dfd_ronneby['head_eleventh_show_header_soc_icons']) && $dfd_ronneby['head_eleventh_show_header_soc_icons']) { ?>
						<div class="dfd-header-responsive-hide widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
							<?php echo crum_social_networks(true); ?>
						</div>
					<?php } ?>
					<?php if(isset($dfd_ronneby['header_eleventh_copyright']) && $dfd_ronneby['header_eleventh_copyright']) { ?>
						<div class="dfd-header-responsive-hide dfd-copyright">
							<?php echo $dfd_ronneby['header_eleventh_copyright']; ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</div>