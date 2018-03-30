<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;

if(isset($dfd_ronneby['header_eighth_soc_icons_hover_style']) && !empty($dfd_ronneby['header_eighth_soc_icons_hover_style'])) {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['header_eighth_soc_icons_hover_style'];
} else {
	$header_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
}
$header_container_class = 'dfd-header-layout-fixed';
$header_container_class .= (isset($dfd_ronneby['header_eighth_alignment']) && !empty($dfd_ronneby['header_eighth_alignment'])) ? ' '.$dfd_ronneby['header_eighth_alignment'] : ' left';
$header_container_class .= (isset($dfd_ronneby['header_eighth_content_alignment']) && !empty($dfd_ronneby['header_eighth_content_alignment'])) ? ' '.$dfd_ronneby['header_eighth_content_alignment'] : ' text-left';

?>
<?php get_template_part('templates/header/block', 'search'); ?>
<div id="header-container" class="<?php echo dfd_get_header_style(); ?> <?php echo esc_attr($header_container_class); ?>">
	<section id="header">
		<div class="dfd-side-header-activation-wrap dfd-header-responsive-hide">
			<a href="#" id="dfd-side-header-activation-button">
				<span class="icon-wrap dfd-top-line"></span>
				<span class="icon-wrap dfd-middle-line"></span>
				<span class="icon-wrap dfd-bottom-line"></span>
			</a>
		</div>
		<?php if(isset($dfd_ronneby['small_logo_image']['url']) && $dfd_ronneby['small_logo_image']['url']) : ?>
			<div class="dfd-small-logo dfd-header-responsive-hide">
				<?php
				//$small_logo = dfd_aq_resize($dfd_ronneby['small_logo_image']['url'], 100, 100, true, true, false);
				//if(!$small_logo) {
					$small_logo = $dfd_ronneby['small_logo_image']['url'];
				//}
				?>
				<img src="<?php echo esc_url($small_logo); ?>" alt="logo" />
			</div>
		<?php endif; ?>
		<div class="dfd-side-header-container">
			<div class="logo-wrap header-top-logo-panel dfd-header-responsive-hide">
				<div class="row">
					<div class="columns twelve">
						<?php get_template_part('templates/header/block', 'custom_logo_side'); ?>
					</div>
					<div class="columns twelve header-info-panel">
						<?php get_template_part('templates/header/block', 'topinfo'); ?>
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
						<div class="header-col-right">
							<div class="header-icons-wrapper">
								<?php get_template_part('templates/header/block', 'responsive-menu'); ?>
								<?php get_template_part('templates/header/block', 'lang_sel'); ?>
								<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
								<?php get_template_part('templates/header/search', 'button'); ?>
							</div>
						</div>
						<div class="header-col-fluid">
							<?php get_template_part('templates/header/block', 'main_menu'); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="dfd-header-bottom dfd-header-responsive-hide">
				<div class="login-button-wrap">
					<?php if(isset($dfd_ronneby['header_eighth_login']) && $dfd_ronneby['header_eighth_login']) { ?>
						<?php get_template_part('templates/header/block', 'login'); ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
				<div class="inline-block">
					<?php if (is_plugin_active('woocommerce/woocommerce.php')) echo dfd_woocommerce_total_cart(); ?>
					<?php get_template_part('templates/header/search', 'button'); ?>
					<?php get_template_part('templates/header/block', 'lang_sel'); ?>
				</div>
				<div class="clear"></div>
				<div class="widget soc-icons <?php echo esc_attr($header_soc_icons_hover_style) ?>">
					<?php if(isset($dfd_ronneby['head_eighth_show_header_soc_icons']) && $dfd_ronneby['head_eighth_show_header_soc_icons']) { ?>
						<?php echo crum_social_networks(true); ?>
					<?php } ?>
				</div>
				<div class="clear"></div>
				<?php if(isset($dfd_ronneby['header_eighth_copyright']) && $dfd_ronneby['header_eighth_copyright']) { ?>
					<div class="dfd-copyright">
						<?php echo $dfd_ronneby['header_eighth_copyright']; ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
</div>