<?php

	$inspire_options_hooks = get_option('inspire_options_hooks');

	if (isset($inspire_options_hooks['use_hooks']) && !empty($inspire_options_hooks['hook_html_above_footer'])) {

		echo '<style type="text/css">';
		echo $inspire_options_hooks['hook_css_above_footer'];
		echo '</style>';

		echo $inspire_options_hooks['hook_html_above_footer'];

	}
