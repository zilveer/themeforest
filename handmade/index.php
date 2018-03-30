<?php
if (isset($_REQUEST['custom-page']) && !empty($_REQUEST['custom-page'])) {
	global $g5plus_is_do_action_custom_page;
	if (!isset($g5plus_is_do_action_custom_page) || $g5plus_is_do_action_custom_page !== '1') {
		$g5plus_is_do_action_custom_page = '1';
		do_action('custom-page/'.$_REQUEST['custom-page']);
	}
} else {
	get_header();
	g5plus_get_template( 'archive');
	get_footer();
}
