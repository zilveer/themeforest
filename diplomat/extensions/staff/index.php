<?php
if (!defined('ABSPATH')) exit();

include_once TMM_EXT_PATH . '/staff/classes/staff.php';

if ( !function_exists('tmm_staff_init') ) {
	function tmm_staff_init() {
		add_action('init', array('TMM_Staff', 'init'));
		add_action('admin_init', array('TMM_Staff', 'admin_init'));
		add_action('save_post', array('TMM_Staff', 'save_post'));
	}
}

add_action('init', 'tmm_staff_init');
