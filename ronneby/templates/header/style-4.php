<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

$show_header_top_panel = isset($dfd_ronneby['header_fourth_top_panel']) && strcmp($dfd_ronneby['header_fourth_top_panel'], 'on') === 0;

$header_container_class = 'dfd-enable-mega-menu';
if(!isset($dfd_ronneby['header_fourth_sticky']) || strcmp($dfd_ronneby['header_fourth_sticky'], 'off') !== 0) {
	$header_container_class .= ' dfd-enable-headroom';
}
$header_container_class .= ' dfd-header-layout-fixed';
if (!empty($post) && is_object($post)) {
	$page_id = $post->ID;

	$auto_colours = get_post_meta($page_id, 'dfd_auto_header_colors', true);
	if(strcmp($auto_colours, 'on') === 0) {
		$header_container_class .= ' dfd-smart-header';
		?>
		<script type="text/javascript">
			var dfd_smart_logo_dark = '<?php echo isset($dfd_ronneby['custom_logo_image']['url']) && $dfd_ronneby['custom_logo_image']['url'] ? esc_url($dfd_ronneby['custom_logo_image']['url']) : ''; ?>';
			var dfd_smart_logo_light = '<?php echo isset($dfd_ronneby['custom_logo_image_second']['url']) && $dfd_ronneby['custom_logo_image_second']['url'] ? esc_url($dfd_ronneby['custom_logo_image_second']['url']) : ''; ?>';
		</script>
		<?php
	}
}

if(isset($dfd_ronneby['header_fourth_soc_icons_hover_style']) && !empty($dfd_ronneby['header_fourth_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_fourth_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class .= ($show_header_top_panel) ? ' with-top-panel' : ' without-top-panel';
//$header_container_class .= (isset($dfd_ronneby['enable_sticky_header']) && strcmp($dfd_ronneby['enable_sticky_header'], 'off') === 0) ? ' sticky-header-disabled' : ' sticky-header-enabled';
$header_container_class .= (isset($dfd_ronneby['fixed_header_mode']) && strcmp($dfd_ronneby['fixed_header_mode'], 'on') === 0) ? ' dfd-header-layout-fixed' : '';
$header_container_class .= (isset($dfd_ronneby['head_fourth_enable_buttons']) && strcmp($dfd_ronneby['head_fourth_enable_buttons'], '1') === 0) ? '' : ' dfd-header-buttons-disabled';

if(isset($dfd_ronneby['stun_header_title_align_header_4']) && strcmp($dfd_ronneby['stun_header_title_align_header_4'],'1') === 0) {
	$header_container_class .= ' dfd-keep-menu-fixer';
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
						
						<?php if(isset($dfd_ronneby['header_fourth_login']) && $dfd_ronneby['header_fourth_login']) { ?>
							<?php get_template_part('templates/header/block', 'login'); ?>
						<?php } ?>
						
						<?php if(isset($dfd_ronneby['head_fourth_show_soc_icons']) && $dfd_ronneby['head_fourth_show_soc_icons']) { ?>
							<div class="widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
								<?php echo crum_social_networks(true); ?>
							</div>
						<?php } ?>
						<?php if(isset($dfd_ronneby['head_fourth_enable_top_panel_wishlist_link']) && $dfd_ronneby['head_fourth_enable_top_panel_wishlist_link']) {
							echo dfd_wishlist_button();
						} ?>
						<?php get_template_part('templates/header/block', 'additional_header_menu'); ?>
					</div>
					<?php get_template_part('templates/header/block', 'toppanel'); ?>
				</div>
			</div>
		<?php endif; ?>
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
						<?php get_template_part('templates/header/block', 'left_top_menu'); ?>
						<?php get_template_part('templates/header/block', 'right_top_menu'); ?>
						
						<?php if(isset($dfd_ronneby['custom_logo_fixed_header']['url']) && $dfd_ronneby['custom_logo_fixed_header']['url']) : ?>
							<a href="<?php echo home_url(); ?>/" title="<?php _e('Home', 'dfd') ?>" class="fixed-header-logo">
								<img src="<?php echo esc_url($dfd_ronneby['custom_logo_fixed_header']['url']); ?>" alt="logo"/>
							</a>
						<?php endif; ?>
						
						<?php get_template_part('templates/header/block', 'custom_logo_second'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>