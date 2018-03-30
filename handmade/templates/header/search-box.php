<?php
	global $g5plus_options;

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
?>
<div class="search-box-wrapper header-customize-item" data-hint-message="<?php esc_html_e('Type at least 3 characters to search','g5plus-handmade') ?>">
	<form method="get" action="<?php echo esc_url(home_url('/')); ?>" class="search-type-<?php echo esc_attr($search_box_type) ?> search-box">
		<input type="text" name="s" placeholder="<?php esc_html_e('Search','g5plus-handmade'); ?>"/>
		<button type="<?php echo esc_attr($search_box_submit) ?>"><i class="wicon fa fa-search"></i></button>
	</form>
</div>