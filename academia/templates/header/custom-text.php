<?php
$g5plus_options = &G5Plus_Global::get_options();

$prefix = 'g5plus_';
$header_customize_text = '';
$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_nav');
if ($enable_header_customize == '1') {
	$header_customize_text = rwmb_meta($prefix . 'header_customize_nav_text');
}
else {
	$header_customize_text = $g5plus_options['header_customize_nav_text'];
}
?>
<?php if (!empty($header_customize_text)): ?>
	<div class="custom-text-wrapper header-customize-item">
		<?php echo wp_kses_post($header_customize_text); ?>
	</div>
<?php endif;?>