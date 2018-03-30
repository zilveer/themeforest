<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

// Get search & mini-cart for header mobile
$mobile_header_shopping_cart = rwmb_meta($prefix . 'mobile_header_shopping_cart');
if (($mobile_header_shopping_cart === '') || ($mobile_header_shopping_cart == '-1')) {
	$mobile_header_shopping_cart = $g5plus_options['mobile_header_shopping_cart'];
}

$mobile_header_search_box = rwmb_meta($prefix . 'mobile_header_search_box');
if (($mobile_header_search_box === '') || ($mobile_header_search_box == '-1')) {
	$mobile_header_search_box = $g5plus_options['mobile_header_search_box'];
}

$mobile_header_menu_drop = rwmb_meta($prefix . 'mobile_header_menu_drop');
if (($mobile_header_menu_drop === '') || ($mobile_header_menu_drop == '-1')) {
	$mobile_header_menu_drop = 'dropdown';
	if (isset($g5plus_options['mobile_header_menu_drop']) && !empty($g5plus_options['mobile_header_menu_drop'])) {
		$mobile_header_menu_drop = $g5plus_options['mobile_header_menu_drop'];
	}
}

$header_container_wrapper_class = array('header-container-wrapper');

$mobile_header_stick = rwmb_meta($prefix . 'mobile_header_stick');
if (($mobile_header_stick === '') || ($mobile_header_stick == '-1')) {
	$mobile_header_stick = isset($g5plus_options['mobile_header_stick']) ? $g5plus_options['mobile_header_stick'] : '0';
}
if ($mobile_header_stick == '1') {
	$header_container_wrapper_class[] = 'header-mobile-sticky';
}

$header_mobile_nav = array('header-mobile-nav' , 'menu-drop-' . $mobile_header_menu_drop);
?>
<div class="<?php echo join(' ', $header_container_wrapper_class); ?>">
	<div class="container header-mobile-container">
		<div class="header-mobile-inner">
			<div class="toggle-icon-wrapper toggle-mobile-menu" data-ref="nav-menu-mobile" data-drop-type="<?php echo esc_attr($mobile_header_menu_drop); ?>">
				<div class="toggle-icon"> <span></span></div>
			</div>
			<div class="header-customize">
				<?php if ($mobile_header_search_box == '1'): ?>
					<?php g5plus_get_template('header/search-button-mobile'); ?>
				<?php endif; ?>
				<?php if (($mobile_header_shopping_cart == '1') && class_exists( 'WooCommerce' )): ?>
					<?php g5plus_get_template('header/mini-cart'); ?>
				<?php endif; ?>
			</div>
			<?php g5plus_get_template('header/header-mobile-logo'); ?>
		</div>
		<?php g5plus_get_template('header/header-mobile-nav'); ?>
	</div>
</div>