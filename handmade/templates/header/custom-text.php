<?php
global $g5plus_options, $g5plus_header_customize_current;

$prefix = 'g5plus_';
$header_customize_text = '';

switch ($g5plus_header_customize_current) {
	case 'nav':
		$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_nav');
		if ($enable_header_customize == '1') {
			$header_customize_text = rwmb_meta($prefix . 'header_customize_nav_text');
		}
		else {
			$header_customize_text = $g5plus_options['header_customize_nav_text'];
		}

		break;
	case 'left':
		$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_left');
		if ($enable_header_customize == '1') {
			$header_customize_text = rwmb_meta($prefix . 'header_customize_left_text');
		}
		else {
			$header_customize_text = $g5plus_options['header_customize_left_text'];
		}
		break;
	case 'right':
		$enable_header_customize = rwmb_meta($prefix . 'enable_header_customize_right');
		if ($enable_header_customize == '1') {
			$header_customize_text = rwmb_meta($prefix . 'header_customize_right_text');
		}
		else {
			$header_customize_text = $g5plus_options['header_customize_right_text'];
		}
		break;
}
?>
<?php if (!empty($header_customize_text)): ?>
	<div class="custom-text-wrapper header-customize-item">
		<?php echo wp_kses_post($header_customize_text); ?>
	</div>
<?php endif;?>