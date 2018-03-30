<?php
/**
 * Ancora Framework: messages subsystem
 *
 * @package	themerex
 * @since	themerex 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('ancora_messages_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_messages_theme_setup' );
	function ancora_messages_theme_setup() {
		// Core messages strings
		add_action('ancora_action_add_scripts_inline', 'ancora_messages_add_scripts_inline');
	}
}


/* Session messages
------------------------------------------------------------------------------------- */

if (!function_exists('ancora_get_error_msg')) {
	function ancora_get_error_msg() {
		global $ANCORA_GLOBALS;
		return !empty($ANCORA_GLOBALS['error_msg']) ? $ANCORA_GLOBALS['error_msg'] : '';
	}
}

if (!function_exists('ancora_set_error_msg')) {
	function ancora_set_error_msg($msg) {
		global $ANCORA_GLOBALS;
		$msg2 = ancora_get_error_msg();
		$ANCORA_GLOBALS['error_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}

if (!function_exists('ancora_get_success_msg')) {
	function ancora_get_success_msg() {
		global $ANCORA_GLOBALS;
		return !empty($ANCORA_GLOBALS['success_msg']) ? $ANCORA_GLOBALS['success_msg'] : '';
	}
}

if (!function_exists('ancora_set_success_msg')) {
	function ancora_set_success_msg($msg) {
		global $ANCORA_GLOBALS;
		$msg2 = ancora_get_success_msg();
		$ANCORA_GLOBALS['success_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}

if (!function_exists('ancora_get_notice_msg')) {
	function ancora_get_notice_msg() {
		global $ANCORA_GLOBALS;
		return !empty($ANCORA_GLOBALS['notice_msg']) ? $ANCORA_GLOBALS['notice_msg'] : '';
	}
}

if (!function_exists('ancora_set_notice_msg')) {
	function ancora_set_notice_msg($msg) {
		global $ANCORA_GLOBALS;
		$msg2 = ancora_get_notice_msg();
		$ANCORA_GLOBALS['notice_msg'] = $msg2 . ($msg2=='' ? '' : '<br />') . ($msg);
	}
}


/* System messages (save when page reload)
------------------------------------------------------------------------------------- */
if (!function_exists('ancora_set_system_message')) {
	function ancora_set_system_message($msg, $status='info', $hdr='') {
		update_option('ancora_message', array('message' => $msg, 'status' => $status, 'header' => $hdr));
	}
}

if (!function_exists('ancora_get_system_message')) {
	function ancora_get_system_message($del=false) {
		$msg = get_option('ancora_message', false);
		if (!$msg)
			$msg = array('message' => '', 'status' => '', 'header' => '');
		else if ($del)
			ancora_del_system_message();
		return $msg;
	}
}

if (!function_exists('ancora_del_system_message')) {
	function ancora_del_system_message() {
		delete_option('ancora_message');
	}
}


/* Messages strings
------------------------------------------------------------------------------------- */

if (!function_exists('ancora_messages_add_scripts_inline')) {
	function ancora_messages_add_scripts_inline() {
		global $ANCORA_GLOBALS;
		echo '<script type="text/javascript">'
			. 'jQuery(document).ready(function() {'
			// Strings for translation
			. 'ANCORA_GLOBALS["strings"] = {'
				. 'bookmark_add: 		"' . addslashes(__('Add the bookmark', 'ancora')) . '",'
				. 'bookmark_added:		"' . addslashes(__('Current page has been successfully added to the bookmarks. You can see it in the right panel on the tab \'Bookmarks\'', 'ancora')) . '",'
				. 'bookmark_del: 		"' . addslashes(__('Delete this bookmark', 'ancora')) . '",'
				. 'bookmark_title:		"' . addslashes(__('Enter bookmark title', 'ancora')) . '",'
				. 'bookmark_exists:		"' . addslashes(__('Current page already exists in the bookmarks list', 'ancora')) . '",'
				. 'search_error:		"' . addslashes(__('Error occurs in AJAX search! Please, type your query and press search icon for the traditional search way.', 'ancora')) . '",'
				. 'email_confirm:		"' . addslashes(__('On the e-mail address <b>%s</b> we sent a confirmation email.<br>Please, open it and click on the link.', 'ancora')) . '",'
				. 'reviews_vote:		"' . addslashes(__('Thanks for your vote! New average rating is:', 'ancora')) . '",'
				. 'reviews_error:		"' . addslashes(__('Error saving your vote! Please, try again later.', 'ancora')) . '",'
				. 'error_like:			"' . addslashes(__('Error saving your like! Please, try again later.', 'ancora')) . '",'
				. 'error_global:		"' . addslashes(__('Global error text', 'ancora')) . '",'
				. 'name_empty:			"' . addslashes(__('The name can\'t be empty', 'ancora')) . '",'
				. 'name_long:			"' . addslashes(__('Too long name', 'ancora')) . '",'
				. 'email_empty:			"' . addslashes(__('Too short (or empty) email address', 'ancora')) . '",'
				. 'email_long:			"' . addslashes(__('Too long email address', 'ancora')) . '",'
				. 'email_not_valid:		"' . addslashes(__('Invalid email address', 'ancora')) . '",'
				. 'subject_empty:		"' . addslashes(__('The subject can\'t be empty', 'ancora')) . '",'
				. 'subject_long:		"' . addslashes(__('Too long subject', 'ancora')) . '",'
				. 'text_empty:			"' . addslashes(__('The message text can\'t be empty', 'ancora')) . '",'
				. 'text_long:			"' . addslashes(__('Too long message text', 'ancora')) . '",'
				. 'send_complete:		"' . addslashes(__("Send message complete!", 'ancora')) . '",'
				. 'send_error:			"' . addslashes(__('Transmit failed!', 'ancora')) . '",'
				. 'login_empty:			"' . addslashes(__('The Login field can\'t be empty', 'ancora')) . '",'
				. 'login_long:			"' . addslashes(__('Too long login field', 'ancora')) . '",'
				. 'login_success:		"' . addslashes(__('Login success! The page will be reloaded in 3 sec.', 'ancora')) . '",'
				. 'login_failed:		"' . addslashes(__('Login failed!', 'ancora')) . '",'
				. 'password_empty:		"' . addslashes(__('The password can\'t be empty and shorter then 4 characters', 'ancora')) . '",'
				. 'password_long:		"' . addslashes(__('Too long password', 'ancora')) . '",'
				. 'password_not_equal:	"' . addslashes(__('The passwords in both fields are not equal', 'ancora')) . '",'
				. 'registration_success:"' . addslashes(__('Registration success! Please log in!', 'ancora')) . '",'
				. 'registration_failed:	"' . addslashes(__('Registration failed!', 'ancora')) . '",'
				. 'geocode_error:		"' . addslashes(__('Geocode was not successful for the following reason:', 'wspace')) . '",'
				. 'googlemap_not_avail:	"' . addslashes(__('Google map API not available!', 'ancora')) . '",'
				. 'editor_save_success:	"' . addslashes(__("Post content saved!", 'ancora')) . '",'
				. 'editor_save_error:	"' . addslashes(__("Error saving post data!", 'ancora')) . '",'
				. 'editor_delete_post:	"' . addslashes(__("You really want to delete the current post?", 'ancora')) . '",'
				. 'editor_delete_post_header:"' . addslashes(__("Delete post", 'ancora')) . '",'
				. 'editor_delete_success:	"' . addslashes(__("Post deleted!", 'ancora')) . '",'
				. 'editor_delete_error:		"' . addslashes(__("Error deleting post!", 'ancora')) . '",'
				. 'editor_caption_cancel:	"' . addslashes(__('Cancel', 'ancora')) . '",'
				. 'editor_caption_close:	"' . addslashes(__('Close', 'ancora')) . '"'
				. '};'
			. '});'
			. '</script>';
	}
}
?>