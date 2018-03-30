<?php
$g5plus_options = &G5Plus_Global::get_options();

$prefix = 'g5plus_';
$header_customize_my_account_text = '';
$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_nav');
$header_customize_my_account_text = $g5plus_options['header_customize_my_account_text'];
$header_customize_my_account_text_sign_out = $g5plus_options['header_customize_my_account_text_sign_out'];

if ($header_customize_my_account_text == '') {
	$header_customize_my_account_text = esc_html('Register', 'g5plus-academia');
}
if ($header_customize_my_account_text_sign_out == '') {
	$header_customize_my_account_text_sign_out = esc_html('Sign Out', 'g5plus-academia');
}
$login_url = '';
if (class_exists( 'WooCommerce' ) ) {
	$myaccount_page_id = wc_get_page_id('myaccount');
	if ( $myaccount_page_id > 0 ) {
		$login_url = get_permalink( $myaccount_page_id );
	}
	else {
		$login_url = wp_login_url( get_permalink() );
	}
}
else {
	$login_url = wp_login_url( get_permalink() );
}

?>
<div class="header-customize-item my-account-button">
	<?php if ( !is_user_logged_in() ):?>
		<a class="transition3s spacing-50" href="<?php echo esc_url($login_url) ?>"><span><?php echo esc_html($header_customize_my_account_text) ?></span></a>
	<?php else: ?>
		<a class="transition3s spacing-50" href="<?php echo esc_url(wp_logout_url(is_home()? home_url() : get_permalink()) ); ?>"><span><?php echo esc_html($header_customize_my_account_text_sign_out) ?></span></a>
	<?php endif; ?>
</div>