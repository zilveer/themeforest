<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

if(isset($dfd_ronneby['header_fourteenth_soc_icons_hover_style']) && !empty($dfd_ronneby['header_fourteenth_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_fourteenth_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}

$header_container_class = 'without-top-panel dfd-header-layout-fixed dfd-enable-mega-menu';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';
$header_container_class .= (isset($dfd_ronneby['header_fourteenth_content_alignment']) && !empty($dfd_ronneby['header_fourteenth_content_alignment'])) ? ' '.$dfd_ronneby['header_fourteenth_content_alignment'] : ' text-left';

if(isset($dfd_ronneby['stun_header_title_align_header_7']) && strcmp($dfd_ronneby['stun_header_title_align_header_7'],'1') === 0) {
	$header_container_class .= ' dfd-keep-menu-fixer';
}

if(isset($dfd_ronneby['header_fourteenth_appear_effect']) && !empty($dfd_ronneby['header_fourteenth_appear_effect'])) {
	$header_container_class .= ' '.$dfd_ronneby['header_fourteenth_appear_effect'];
}

if(!isset($dfd_ronneby['header_fourteenth_sticky']) || strcmp($dfd_ronneby['header_fourteenth_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> without-top-panel logo-position-left <?php echo esc_attr($header_container_class); ?>">
	<div class="dfd-top-row dfd-header-responsive-hide">
		<div class="row">
			<div class="twelve columns">
				<?php get_template_part('templates/header/block', 'custom_logo_second'); ?>
				<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
					<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
						<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
					</a>
				<?php endif; ?>
				<a href="#" title="menu" class="dfd-menu-button">
					<span class="icon-wrap dfd-top-line"></span>
					<span class="icon-wrap dfd-middle-line"></span>
					<span class="icon-wrap dfd-bottom-line"></span>
				</a>
			</div>
		</div>
		<?php get_template_part('templates/header/block', 'toppanel'); ?>
	</div>
	<section id="header">
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
						<?php get_template_part('templates/header/block', 'custom_logo_second'); ?>
						<div class="dfd-header-top dfd-header-responsive-hide header-info-panel">
							<?php get_template_part('templates/header/block', 'topinfo'); ?>
						</div>
					</div>
					<div class="header-col-right text-center clearfix">
						<div class="header-icons-wrapper">
							<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
							<?php get_template_part('templates/header/search', 'button'); ?>
							<?php get_template_part('templates/header/block', 'lang_sel'); ?>
							<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
						</div>
					</div>
					<div class="header-col-fluid">
						<nav class="mega-menu clearfix" id="main_mega_menu">
							<?php
								wp_nav_menu(array(
									'theme_location' => 'primary_navigation', 
									'depth' => 1,
									'menu_class' => 'nav-menu menu-primary-navigation menu-clonable-for-mobiles', 
									'fallback_cb' => 'top_menu_fallback'
								));
							?>
							<i class="carousel-nav prev dfd-icon-left_2"></i>
							<i class="carousel-nav next dfd-icon-right_2"></i>
						</nav>
					</div>
					<?php //if(isset($dfd_ronneby['head_fourteenth_show_soc_icons']) && $dfd_ronneby['head_fourteenth_show_soc_icons'] || isset($dfd_ronneby['header_fourteenth_copyright']) && $dfd_ronneby['header_fourteenth_copyright']) : ?>
						<div class="dfd-header-bottom dfd-header-responsive-hide">
							<div class="login-button-wrap">
								<?php if(isset($dfd_ronneby['header_fourteenth_login']) && $dfd_ronneby['header_fourteenth_login']) { ?>
									<?php get_template_part('templates/header/block', 'login-simple'); ?>
								<?php } ?>
							</div>
							<div class="clear"></div>
							<div class="inline-block">
								<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
								<?php get_template_part('templates/header/search', 'button'); ?>
								<?php get_template_part('templates/header/block', 'lang_sel'); ?>
							</div>
							<div class="clear"></div>
							<?php if(isset($dfd_ronneby['header_fourteenth_copyright']) && $dfd_ronneby['header_fourteenth_copyright'] || isset($dfd_ronneby['head_fourteenth_show_soc_icons']) && $dfd_ronneby['head_fourteenth_show_soc_icons']) { ?>
								<div class="copyright-soc-icons-wrap">
									<?php if(isset($dfd_ronneby['header_fourteenth_copyright']) && $dfd_ronneby['header_fourteenth_copyright']) { ?>
										<div class="dfd-copyright">
											<?php echo $dfd_ronneby['header_fourteenth_copyright']; ?>
										</div>
									<?php } ?>
									<?php if(isset($dfd_ronneby['head_fourteenth_show_soc_icons']) && $dfd_ronneby['head_fourteenth_show_soc_icons']) { ?>
										<div class="widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
											<?php echo crum_social_networks(true); ?>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					<?php //endif; ?>
				</div>
			</div>
		</div>
	</section>
</div>