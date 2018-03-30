<?php
/**
 * Returns true if user is logged in, false if not logged in.
 * 
 * @deprecated 	Use is_user_logged_in() instead
 * @uses 		is_user_logged_in()
 * @return 		boolean
 */
function crb_is_logged_in() {
	return is_user_logged_in();
}


/**
 * Returns the currently logged in user object
 *
 * @deprecated 	Use wp_get_current_user() instead
 * @uses 		wp_get_current_user();
 * @return 		WP_User
 */
function crb_get_current_user() {
	return wp_get_current_user();
}

/**
 * Redirects if the current user is not logged in. Be careful with the $redirect -
 * may cause infinite redirection loop if the redirect requires login as well
 * 
 * @param  string $redirect URL
 */
function crb_require_login($redirect = '') {
	if (!crb_is_logged_in()) {
		$redirect = ($redirect) ? $redirect : home_url('/');
		wp_redirect($redirect);
		exit;
	}
}

/**
 * Redirects if the current user is not of the specified level. Admins are always alowed.
 * May cause infinite redirection loop if the function is called on the $redirect URL.
 * 
 * @param  string $level required user capability
 * @param  string $redirect URL address to redirect when the user doesn't have the required capability
 */
function crb_require_user_level($level, $redirect = '') {
	$u = crb_get_current_user();
	if ( empty($u->ID) || !( crb_user_is($u->ID, 'administrator') && crb_user_is($u->ID, $level) ) ) {
		$redirect = ($redirect) ? $redirect : home_url('/');
		wp_redirect($redirect);
		exit;
	}
}

/**
 * Returns boolean indicating whether the specified user has the specified role or capability
 * 
 * @deprecated 	Use user_can() instead
 * @uses 		user_can()
 * @param  		int $user_id
 * @param  		string $capability
 * @return 		boolean
 */
function crb_user_is($user_id, $capability) {
	return user_can($user_id, $capability);
}
