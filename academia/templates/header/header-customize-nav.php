<?php
$g5plus_options = &G5Plus_Global::get_options();
$prefix = 'g5plus_';

$header_customize_class = array('header-customize header-customize-nav');
$header_customize = array();
$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_nav');
if ($enable_header_customize == '1') {
	$page_header_customize = rwmb_meta($prefix . 'header_customize_nav');
	if (isset($page_header_customize['enable']) && !empty($page_header_customize['enable'])) {
		$header_customize = explode('||', $page_header_customize['enable']);
	}
}
else {
	if (isset($g5plus_options['header_customize_nav']) && isset($g5plus_options['header_customize_nav']['enabled']) && is_array($g5plus_options['header_customize_nav']['enabled'])) {
		foreach ($g5plus_options['header_customize_nav']['enabled'] as $key => $value) {
			$header_customize[] = $key;
		}
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
				case 'shopping-cart':
					if (class_exists( 'WooCommerce' )) {
						g5plus_get_template('header/mini-cart');
					}
					break;
				case 'social-profile':
					g5plus_get_template('header/social-profile');
					break;
				case 'custom-text':
					g5plus_get_template('header/custom-text');
					break;
				case 'my-account':
					g5plus_get_template('header/my-account-button');
					break;
			}
		} ?>
	</div>
<?php endif;?>