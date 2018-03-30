<?php

	// Vars
	global $ch_search_form_button, $ch_is_in_sidebar;

	if ($ch_search_form_button == 'searchButton') {
		$search_string = '';
	} elseif (get_search_query() == '') {
		$search_string = __('Search', 'ch');
	} else {
		$search_string = get_search_query();
	}

	if (empty($ch_search_form_button))
		$ch_search_form_button = 'submitButton';

	$class      = 'span17';
	$form_class = ' gray-form';
	if ($ch_is_in_sidebar === true) {
		$class      = 'span18';
		$form_class = '';
	} elseif (is_search()) {
		$class      = 'span5';
		$form_class = '';
	}
?>
<div class="search">
	<form action="<?php echo home_url(); ?>" method="get" class="<?php echo $form_class; ?>">
		<div class="input-append">
			<input type="text" name="s" class="<?php echo $class; ?>" onclick="clearInput(this, 'Search');" id="appendedInputButton" value="<?php echo $search_string; ?>" />
			<input type="submit" name="search" class="btn btn-primary strong" value="<?php _e('Search', 'ch'); ?>" />
		</div>
	</form>
</div><!--end of search-->