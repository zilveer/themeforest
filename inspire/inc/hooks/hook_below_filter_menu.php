<?php

	$inspire_options_hooks = get_option('inspire_options_hooks');

	if (isset($inspire_options_hooks['use_hooks']) && !empty($inspire_options_hooks['hook_html_below_filter_menu'])) {

		echo '<style type="text/css">';
		echo $inspire_options_hooks['hook_css_below_filter_menu'];
		echo '</style>';

		echo $inspire_options_hooks['hook_html_below_filter_menu'];

	}
