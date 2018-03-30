<?php
	$g5plus_options = &G5Plus_Global::get_options();

	$prefix = 'g5plus_';

	$data_search_type = 'standard';
	if (isset($g5plus_options['search_box_type']) && ($g5plus_options['search_box_type'] == 'ajax')) {
		$data_search_type = 'ajax';
	}
	$search_box_type = 'standard';
	$search_box_submit = 'submit';
	if (isset($g5plus_options['search_box_type'])) {
		$search_box_type = $g5plus_options['search_box_type'];
	}
	if ($search_box_type == 'ajax') {
		$search_box_submit = 'button';
	}

	$header_customize_nav_search_button_style = 'default';
	$enable_header_customize_nav = rwmb_meta($prefix . 'enable_header_customize_nav');
	if ($enable_header_customize_nav == '1') {
		$header_customize_nav_search_button_style = rwmb_meta($prefix . 'header_customize_nav_search_button_style');
	}
	else {
		$header_customize_nav_search_button_style = isset($g5plus_options['header_customize_nav_search_button_style']) && !empty($g5plus_options['header_customize_nav_search_button_style'])
			? $g5plus_options['header_customize_nav_search_button_style'] : 'default';
	}

	$search_button_wrapper_class = array(
		'search-button-wrapper',
		'header-customize-item',
		'style-' . esc_attr($header_customize_nav_search_button_style)
	);
?>
<div class="<?php echo join(' ', $search_button_wrapper_class) ?>">
	<a class="icon-search-menu" href="#" data-search-type="<?php echo esc_attr($data_search_type) ?>"><i class="fa fa-search"></i></a>
</div>