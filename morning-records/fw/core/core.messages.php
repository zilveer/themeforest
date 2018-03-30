<?php
/**
 * Morning records Framework: messages subsystem
 *
 * @package	morning_records
 * @since	morning_records 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('morning_records_messages_theme_setup')) {
	add_action( 'morning_records_action_before_init_theme', 'morning_records_messages_theme_setup' );
	function morning_records_messages_theme_setup() {
		// Core messages strings
		add_action('morning_records_action_add_scripts_inline', 'morning_records_messages_add_scripts_inline');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('morning_records_get_error_msg')) {
	function morning_records_get_error_msg() {
		return morning_records_storage_get('error_msg');
	}
}

if (!function_exists('morning_records_set_error_msg')) {
	function morning_records_set_error_msg($msg) {
		$msg2 = morning_records_get_error_msg();
		morning_records_storage_set('error_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('morning_records_get_success_msg')) {
	function morning_records_get_success_msg() {
		return morning_records_storage_get('success_msg');
	}
}

if (!function_exists('morning_records_set_success_msg')) {
	function morning_records_set_success_msg($msg) {
		$msg2 = morning_records_get_success_msg();
		morning_records_storage_set('success_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}

if (!function_exists('morning_records_get_notice_msg')) {
	function morning_records_get_notice_msg() {
		return morning_records_storage_get('notice_msg');
	}
}

if (!function_exists('morning_records_set_notice_msg')) {
	function morning_records_set_notice_msg($msg) {
		$msg2 = morning_records_get_notice_msg();
		morning_records_storage_set('notice_msg', trim($msg2) . ($msg2=='' ? '' : '<br />') . trim($msg));
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('morning_records_set_system_message')) {
	function morning_records_set_system_message($msg, $status='info', $hdr='') {
		update_option('morning_records_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('morning_records_get_system_message')) {
	function morning_records_get_system_message($del=false) {
		$msg = get_option('morning_records_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			morning_records_del_system_message();
		return $msg;
	}
}

if (!function_exists('morning_records_del_system_message')) {
	function morning_records_del_system_message() {
		delete_option('morning_records_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('morning_records_messages_add_scripts_inline')) {
	function morning_records_messages_add_scripts_inline() {
		echo '<script type="text/javascript">'
			
			. "if (typeof MORNING_RECORDS_STORAGE == 'undefined') var MORNING_RECORDS_STORAGE = {};"
			
			// Strings for translation
			. 'MORNING_RECORDS_STORAGE["strings"] = {'
				. 'ajax_error: 			"' . addslashes(esc_html__('Invalid server answer', 'morning-records')) . '",'
				. 'bookmark_add: 		"' . addslashes(esc_html__('Add the bookmark', 'morning-records')) . '",'
				. 'bookmark_added:		"' . addslashes(esc_html__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'morning-records')) . '",'
				. 'bookmark_del: 		"' . addslashes(esc_html__('Delete this bookmark', 'morning-records')) . '",'
				. 'bookmark_title:		"' . addslashes(esc_html__('Enter bookmark title', 'morning-records')) . '",'
				. 'bookmark_exists:		"' . addslashes(esc_html__('Current page already exists in the bookmarks list', 'morning-records')) . '",'
				. 'search_error:		"' . addslashes(esc_html__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'morning-records')) . '",'
				. 'email_confirm:		"' . addslashes(esc_html__('On the e-mail address "%s" we sent a confirmation email. Please, open it and click on the link.', 'morning-records')) . '",'
				. 'reviews_vote:		"' . addslashes(esc_html__('Thanks for your vote! New average rating is:', 'morning-records')) . '",'
				. 'reviews_error:		"' . addslashes(esc_html__('Error saving your vote! Please, try again later.', 'morning-records')) . '",'
				. 'error_like:			"' . addslashes(esc_html__('Error saving your like! Please, try again later.', 'morning-records')) . '",'
				. 'error_global:		"' . addslashes(esc_html__('Global error text', 'morning-records')) . '",'
				. 'name_empty:			"' . addslashes(esc_html__('The name can\'t be empty', 'morning-records')) . '",'
				. 'name_long:			"' . addslashes(esc_html__('Too long name', 'morning-records')) . '",'
				. 'email_empty:			"' . addslashes(esc_html__('Too short (or empty) email address', 'morning-records')) . '",'
				. 'email_long:			"' . addslashes(esc_html__('Too long email address', 'morning-records')) . '",'
				. 'email_not_valid:		"' . addslashes(esc_html__('Invalid email address', 'morning-records')) . '",'
				. 'subject_empty:		"' . addslashes(esc_html__('The subject can\'t be empty', 'morning-records')) . '",'
				. 'subject_long:		"' . addslashes(esc_html__('Too long subject', 'morning-records')) . '",'
				. 'text_empty:			"' . addslashes(esc_html__('The message text can\'t be empty', 'morning-records')) . '",'
				. 'text_long:			"' . addslashes(esc_html__('Too long message text', 'morning-records')) . '",'
				. 'send_complete:		"' . addslashes(esc_html__("Send message complete!", 'morning-records')) . '",'
				. 'send_error:			"' . addslashes(esc_html__('Transmit failed!', 'morning-records')) . '",'
				. 'login_empty:			"' . addslashes(esc_html__('The Login field can\'t be empty', 'morning-records')) . '",'
				. 'login_long:			"' . addslashes(esc_html__('Too long login field', 'morning-records')) . '",'
				. 'login_success:		"' . addslashes(esc_html__('Login success! The page will be reloaded in 3 sec.', 'morning-records')) . '",'
				. 'login_failed:		"' . addslashes(esc_html__('Login failed!', 'morning-records')) . '",'
				. 'password_empty:		"' . addslashes(esc_html__('The password can\'t be empty and shorter then 4 characters', 'morning-records')) . '",'
				. 'password_long:		"' . addslashes(esc_html__('Too long password', 'morning-records')) . '",'
				. 'password_not_equal:	"' . addslashes(esc_html__('The passwords in both fields are not equal', 'morning-records')) . '",'
				. 'registration_success:"' . addslashes(esc_html__('Registration success! Please log in!', 'morning-records')) . '",'
				. 'registration_failed:	"' . addslashes(esc_html__('Registration failed!', 'morning-records')) . '",'
				. 'geocode_error:		"' . addslashes(esc_html__('Geocode was not successful for the following reason:', 'morning-records')) . '",'
				. 'googlemap_not_avail:	"' . addslashes(esc_html__('Google map API not available!', 'morning-records')) . '",'
				. 'editor_save_success:	"' . addslashes(esc_html__("Post content saved!", 'morning-records')) . '",'
				. 'editor_save_error:	"' . addslashes(esc_html__("Error saving post data!", 'morning-records')) . '",'
				. 'editor_delete_post:	"' . addslashes(esc_html__("You really want to delete the current post?", 'morning-records')) . '",'
				. 'editor_delete_post_header:"' . addslashes(esc_html__("Delete post", 'morning-records')) . '",'
				. 'editor_delete_success:	"' . addslashes(esc_html__("Post deleted!", 'morning-records')) . '",'
				. 'editor_delete_error:		"' . addslashes(esc_html__("Error deleting post!", 'morning-records')) . '",'
				. 'editor_caption_cancel:	"' . addslashes(esc_html__('Cancel', 'morning-records')) . '",'
				. 'editor_caption_close:	"' . addslashes(esc_html__('Close', 'morning-records')) . '",'
				. 'placeholder_widget_search:	"' . addslashes(esc_html__('Keyword', 'morning-records')) . '"'
				. '};'
			
			. '</script>';
	}
}
?>