<?php
global $g5plus_options, $g5plus_header_layout, $g5plus_header_customize_current;
$prefix = 'g5plus_';
$g5plus_header_customize_current = 'left';

$header_customize_class = array('header-customize header-customize-left');

$header_customize = array();
$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_left');
if ($enable_header_customize == '1') {
	$page_header_customize = rwmb_meta($prefix . 'header_customize_left');
	if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
		$header_customize = explode('||', $page_header_customize['enable']);
	}

	$header_customize_left_separate = rwmb_meta($prefix . 'header_customize_left_separate');
	if ($header_customize_left_separate == '1') {
		$header_customize_class[] = 'header-customize-separate';
	}
}
else {
	if (isset($g5plus_options['header_customize_left']) && isset($g5plus_options['header_customize_left']['enabled']) && is_array($g5plus_options['header_customize_left']['enabled'])) {
		foreach ($g5plus_options['header_customize_left']['enabled'] as $key => $value) {
			$header_customize[] = $key;
		}
	}
	if (isset($g5plus_options['header_customize_nav_separate']) && ($g5plus_options['header_customize_left_separate'] == '1')){
		$header_customize_class[] = 'header-customize-separate';
	}
}

?>
<?php if (count($header_customize) > 0): ?>
	<div class="<?php echo join(' ', $header_customize_class) ?>">
		<?php foreach ($header_customize as $key){
			switch ($key) {
				case 'search-button':
					g5plus_get_template('header/search-button');
					break;
				case 'search-box':
					g5plus_get_template('header/search-box');
					break;
				case 'search-with-category':
					g5plus_get_template('header/search-with-category');
					break;
				case 'shopping-cart':
					if (class_exists( 'WooCommerce' )) {
						g5plus_get_template('header/mini-cart');
					}
					break;
				case 'shopping-cart-price':
					if (class_exists( 'WooCommerce' )) {
						g5plus_get_template('header/mini-cart-price');
					}
					break;
				case 'social-profile':
					g5plus_get_template('header/social-profile');
					break;
				case 'custom-text':
					g5plus_get_template('header/custom-text');
					break;
			}
		} ?>
	</div>
<?php endif;?>