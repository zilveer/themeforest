<?php
	$header_button_url = get_option('nav_button_url', '#');
	$header_button = get_option('nav_button_text', 'Login')
?>

<div class="module widget-handle left">
    <a class="btn btn-sm" href="<?php echo esc_url($header_button_url); ?>"><?php echo wp_kses($header_button, ebor_allowed_tags()); ?></a>
</div>