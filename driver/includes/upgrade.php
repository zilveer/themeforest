<?php

/**
 * Upgrade
 *
 * All the functionality for upgrading Iron Templates
 *
 * @since 1.0.0
 */

function iron_upgrade () {
	global $wpdb; // $iron_updates

	# Don't run on theme activation
	if ( isset($_GET['activated']) && $_GET['activated'] == 'true' )
		return;
/*
	if ( ! current_user_can('update_themes') )
		wp_die( __('You do not have sufficient permissions to update this theme for this site.') );
*/
	$iron_theme  = wp_get_theme();
	$old_version = get_option( IRON_TEXT_DOMAIN . '_version', '1.0.0' ); // false
	$new_version = $iron_theme->get('Version'); // $iron_updates[0]['version'];

	if ( $new_version !== $old_version )
	{

		/*
		 * 1.0.1
		 *
		 * @created 2014-02-04
		 */

		/*if ( $old_version < '1.0.1' )
		{
			# Done
			update_option('ironband_version', '1.0.1');
		}*/
	}
}

add_action('init', 'iron_upgrade');
