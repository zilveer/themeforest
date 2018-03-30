<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if(preg_match('/(?i)msie [1-9]/',$_SERVER['HTTP_USER_AGENT']) === 0) {
	global $post, $dfd_ronneby;
	if (!empty($post) && is_object($post)) {
		$page_id = $post->ID;
		$show_side_area = get_post_meta($page_id, 'dfd_headers_show_side_area', true);
		if(empty($show_side_area)) {
			$show_side_area = isset($dfd_ronneby['side_area_enable']) && !empty($dfd_ronneby['side_area_enable']) ? $dfd_ronneby['side_area_enable'] : 'on';
		}
		$side_area_widgetised = isset($dfd_ronneby['side_area_widget']) && !empty($dfd_ronneby['side_area_widget']) ? $dfd_ronneby['side_area_widget'] : 'off';
		$side_area_menu_class = 'nav-menu side-area-menu';//onclick-nav-menu';
		$side_area_class = '';
		$side_menu_location = '';
		$header_style = dfd_get_header_style_option();
		
		if(empty($side_menu_location)) {
			$side_menu_location = 'side_area_menu';
		}
		$side_area_class .= (isset($dfd_ronneby['side_area_bg_dark']) && strcmp($dfd_ronneby['side_area_bg_dark'], '1') === 0) ? ' dfd-background-dark' : '';
		
		if($side_area_widgetised != 'on')
			$side_area_class .= isset($dfd_ronneby['side_area_alignment']) && !empty($dfd_ronneby['side_area_alignment']) ? ' '.$dfd_ronneby['side_area_alignment'] : '';
		
		$side_area_css = '';
		$side_area_bg_color = isset($dfd_ronneby['side_area_bg_color']) ? $dfd_ronneby['side_area_bg_color'] : '';
		$side_area_bg_image = isset($dfd_ronneby['side_area_bg_image']['url']) ? $dfd_ronneby['side_area_bg_image']['url'] : '';
		$side_area_bg_position = isset($dfd_ronneby['side_area_bg_position']) ? $dfd_ronneby['side_area_bg_position'] : '';
		$side_area_bg_repeat = isset($dfd_ronneby['side_area_bg_repeat']) ? $dfd_ronneby['side_area_bg_repeat'] : '';
		$side_area_css .= !empty($side_area_bg_color) ? 'background-color: '.esc_attr($side_area_bg_color).'; ' : '';
		$side_area_css .= !empty($side_area_bg_image) ? 'background-image: url('.esc_url($side_area_bg_image).'); ' : '';
		$side_area_css .= !empty($side_area_bg_position) ? 'background-position: '.esc_attr($side_area_bg_position).'; ' : '';
		$side_area_css .= !empty($side_area_bg_repeat) ? 'background-repeat: '.esc_attr($side_area_bg_repeat).';' : '';
		
		if(isset($dfd_ronneby['side_area_soc_icons_hover_style']) && !empty($dfd_ronneby['side_area_soc_icons_hover_style'])) {
			$side_area_soc_icons_hover_style = 'dfd-soc-icons-hover-style-'.$dfd_ronneby['side_area_soc_icons_hover_style'];
		} else {
			$side_area_soc_icons_hover_style = 'dfd-soc-icons-hover-style-1';
		}

		if (strcmp($show_side_area, 'off') !== 0) {
			if (strcmp($side_area_widgetised, 'on') === 0) { ?>
				<section id="side-area" class="side-area-widget <?php echo esc_attr($side_area_class); ?>" style="<?php echo $side_area_css; ?>">
					<div class="dfd-side-area-mask side-area-controller"></div>
					<div class="widget-vertical-scroll">
						<?php dynamic_sidebar('sidebar-sidearea'); ?>
					</div>
				</section>
			<?php } else { ?>
				<section id="side-area" class="<?php echo esc_attr($side_area_class); ?>" style="<?php echo $side_area_css; ?>">
					<div class="dfd-side-area-mask side-area-controller"></div>
					<?php /*get_template_part('templates/header/block', 'side_area');*/ ?>
					<div class="side_area_title">
						<?php if (isset($dfd_ronneby['side_area_title']['url']) && $dfd_ronneby['side_area_title']['url']) { ?>
							<a href="<?php echo home_url(); ?>" title=""><img src="<?php echo esc_url($dfd_ronneby['side_area_title']['url']); ?>" alt="side-area-logo" /></a>
						<?php } ?>
					</div>
					<!--<a href="#" target="_self" class="close_side_menu"></a>-->
					<div class="side-area-widgets">
						<nav class="mega-menu clearfix">
							<?php
								wp_nav_menu(array(
									'theme_location' => $side_menu_location,
									'menu_class' => $side_area_menu_class,
									'fallback_cb' => false
								));
							?>
						</nav>
					</div>
					<div class="side-area-bottom">
						<?php /*if (strcmp($dfd_ronneby['side_area_search'], '1') === 0 || strcmp($dfd_ronneby['side_area_cart'], '1') === 0) : ?>
							<div class="side-search-cart-wrap">
								<?php
								if ($dfd_ronneby['side_area_search']) {
									get_template_part('templates/header/search', 'button');
								}
								if ($dfd_ronneby['side_area_cart'] && is_plugin_active('woocommerce/woocommerce.php')) {
									echo dfd_woocommerce_total_cart();
								}
								?>
							</div>
						<?php endif;*/ ?>
						<?php if (isset($dfd_ronneby['side_area_soc_icons']) && strcmp($dfd_ronneby['side_area_soc_icons'], '1') === 0) : ?>
							<div class="soc-icon-aligment">
								<div class="widget soc-icons <?php echo esc_attr($side_area_soc_icons_hover_style) ?>">
									<?php echo crum_social_networks(true); ?>
								</div>
							</div>
						<?php endif; ?>
						<?php if (isset($dfd_ronneby['side_area_copyright']) && $dfd_ronneby['side_area_copyright']) : ?>
							<div class="side-area-subbottom">
								<div class="side_area_copyright">
									<?php echo $dfd_ronneby['side_area_copyright'] ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</section>
		<?php }}
	}
} ?>
	
