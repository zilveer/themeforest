<?php
	$g5plus_options = &G5Plus_Global::get_options();

	$prefix = 'g5plus_';

	$data_search_type = 'standard';
	if (isset($g5plus_options['search_box_type']) && ($g5plus_options['search_box_type'] == 'ajax')) {
		$data_search_type = 'ajax';
	}
?>
<div class="search-button-wrapper header-customize-item">
	<a class="icon-search-menu" href="#" data-search-type="<?php echo esc_attr($data_search_type) ?>"><i class="fa fa-search"></i></a>
</div>