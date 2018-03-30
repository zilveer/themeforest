<?php
/**
 * Custom functions that deal with the integration of WooCommerce Social Login.
 * See: https://www.woothemes.com/products/woocommerce-social-login/
 *
 * @package Listable
 */

/**
 * By default WooCommerce Social Login allows only the 'subscriber' and 'customer' roles from connecting their existing accounts (identified by email) with social providers
 * We will allow others too
 *
 * @param array $roles Array of user roles that are restricted from connecting their existing account with a social provider
 *
 * @return array
 */
function listable_woo_social_login_allow_other_roles_to_connect( $roles ) {
	//add to the allowed roles
	$roles[] = 'administrator';
	$roles[] = 'editor';
	$roles[] = 'employer';

	return $roles;
}
add_filter( 'wc_social_login_find_by_email_allowed_user_roles', 'listable_woo_social_login_allow_other_roles_to_connect' );