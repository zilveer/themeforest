<?php if(! defined('ABSPATH')){ return; }
/**
 * Admin View: Notice - Update
 * @see class-zn-about.php
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div id="message" class="notice notice-error">
	<h3><?php _e( 'Theme Data Update Required', 'zn_framework' ); ?></h3>
	<p><?php _e( '&#8211; We just need to update your install to the latest version.', 'zn_framework' ); ?></p>
	<p><?php _e( '&#8211; Don\'t forget about backups, always backup!', 'zn_framework' ); ?></p>
	<p class="submit"><a href="<?php echo esc_url( add_query_arg( 'do_theme_update', 'true', admin_url( 'admin.php?page=zn-about' ) ) ); ?>" class="button-primary zn_run_theme_updater"><?php _e( 'Run the updater', 'zn_framework' ); ?></a></p>
</div>

<div id="message" class="notice notice-info zn_updater_msg_container">

</div>


