<?php
/**
* Require files that deal with various plugin integrations.
*
* @package Listable
*/

/**
 * Load WP Job Manager compatibility file.
 * https://wpjobmanager.com/
 */
if ( class_exists( 'WP_Job_Manager' ) ) {
	require get_template_directory() . '/inc/integrations/wp-job-manager.php';
}

/**
 * Load WP Job Manager Bookmarks compatibility file.
 * https://wpjobmanager.com/add-ons/bookmarks/
 */
if ( class_exists( 'WP_Job_Manager_Bookmarks' ) ) {
	require get_template_directory() . '/inc/integrations/wp-job-manager-bookmarks.php';
}

/**
 * Load WP Job Manager Job Tags compatibility file.
 * https://wpjobmanager.com/add-ons/job-tags/
 */
if ( class_exists( 'WP_Job_Manager_Job_Tags' ) ) {
	require get_template_directory() . '/inc/integrations/wp-job-manager-tags.php';
}

/**
 * Load WP Job Manager Field Editor compatibility file.
 * https://plugins.smyl.es/wp-job-manager-field-editor
 */
if ( class_exists( 'WP_Job_Manager_Field_Editor' ) ) {
	require get_template_directory() . '/inc/integrations/wp-job-manager-field-editor.php';
}

/**
 * Load FacetWP compatibility file.
 * https://facetwp.com/
 */
if ( class_exists( 'FacetWP' ) ) {
	require get_template_directory() . '/inc/integrations/facetwp.php';
}

function listable_using_facetwp() {
	//For now just check for class existance
	//@todo in the future we might determine if there are any facets used, etc.
	return function_exists( 'FWP' );
}

/**
 * Load WooCommerce compatibility file.
 * https://www.woothemes.com/woocommerce/
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/integrations/woocommerce.php';
}

/**
 * Load WP Job Manager Products compatibility file.
 * https://astoundify.com/downloads/wp-job-manager-products/
 */
if ( class_exists( 'WP_Job_Manager_Products' ) ) {
	require get_template_directory() . '/inc/integrations/wp-job-manager-products.php';
}

/**
 * Load WooCommerce Social Login compatibility file.
 * https://www.woothemes.com/products/woocommerce-social-login/
 */
if ( class_exists( 'WC_Social_Login' ) ) {
	require get_template_directory() . '/inc/integrations/woocommerce-social-login.php';
}

/**
 * Load Login with Ajax compatibility file.
 * https://wordpress.org/plugins/login-with-ajax/
 */
if ( class_exists( 'LoginWithAjax' ) ) {
	require get_template_directory() . '/inc/integrations/login-with-ajax.php';
}

function listable_using_lwa() {
	//just this for now
	return function_exists( 'login_with_ajax' );
}

/**
 * Load Jetpack compatibility file.
 * http://jetpack.me/
 */
require get_template_directory() . '/inc/integrations/jetpack.php';