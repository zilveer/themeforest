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

$header_container_class = '';
if(!isset($dfd_ronneby['header_sixth_sticky']) || strcmp($dfd_ronneby['header_sixth_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
$header_container_class .= ' without-top-panel dfd-header-layout-fixed';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';

if(isset($dfd_ronneby['stun_header_title_align_header_6']) && strcmp($dfd_ronneby['stun_header_title_align_header_6'],'1') === 0) {
	$header_container_class .= ' dfd-keep-menu-fixer';
}
?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
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
						<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
							<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
								<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
							</a>
						<?php endif; ?>
						<div class="onclick-menu-wrap">
							<div class="dfd-click-menu-activation-button">
								<a href="#" title="">
									<span class="icon-wrap dfd-middle-line"></span>
									<span class="icon-wrap dfd-top-line"></span>
									<span class="icon-wrap dfd-bottom-line"></span>
								</a>
							</div>
							<div class="onclick-menu-cover">
								<nav class="onclick-menu clearfix">
									<?php
										wp_nav_menu(array(
											'theme_location' => 'primary_navigation', 
											'menu_class' => 'onclick-nav-menu menu-clonable-for-mobiles', 
											'fallback_cb' => 'top_menu_fallback'
										));
									?>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<?php get_template_part('templates/header/block', 'toppanel'); ?>
			</div>
		</div>
	</section>
</div>