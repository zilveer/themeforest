<?php
/*
*	openframe
*	written by stefano giliberti (stfno@me.com),
*	opendept.net
*/

function op_get_version() {
	$last_cache = get_option( op_config( 'theme' ) . '_cache' );
	$last_time = get_option( op_config( 'theme' ) . '_cache_last' );
	if ( ! $last_time || ( time() - $last_time ) > 86400 ) { // change 86400 to 1 to instantly see new theme's notification
		update_option( op_config( 'theme' ) . '_cache_last', time() );
		$xml = op_file_contents( op_config( 'theme_xml' ) );
		if ( $xml )	
			update_option( op_config( 'theme' ) . '_cache', $xml );
	}
	else if ( $last_cache ) {
		$xml = get_option( op_config( 'theme' ) . '_cache' );
	}
	if ( isset( $xml ) )
		return simplexml_load_string( $xml );
}

function op_version_notify() {
	$xml = op_get_version();
	$latestver = $xml->version;
	$bubble = sprintf(
	    ' <span class="update-plugins" style="margin-top: 0;"><span class="update-count">%s</span></span>',
	    $latestver
	);
	if ( version_compare( $xml->version, op_theme_version, '>' ) ) // temporary comment this row to check if .xml is working
		add_dashboard_page( op_config( 'theme_name' ), ( __( 'Theme Update', 'openframe' ) ) . $bubble, 'switch_themes', op_config( 'theme' ), 'op_version_page' );
}

if ( function_exists( 'simplexml_load_string' ) )
	add_action( 'admin_menu', 'op_version_notify' );  

function op_version_page() {
	$xml = op_get_version();
	$latestver = $xml->version;
	?>
	
	<div class="wrap">
		<h2 style="margin-bottom: .5em;"><strong><?php echo op_config( 'theme_name' ); ?></strong> <?php _e( 'Update', 'openframe' ); ?></h2>
		<p style="font-size: 1.3em;"><?php printf( __( '<strong>%s - Version %s</strong> is available to download (you are currently using <strong>Version %s</strong>).', 'openframe' ), op_config( 'theme_name' ), $latestver, op_theme_version ); ?></p>
		<div style="margin-top: 1em;">
		    <h2><?php _e( 'How do I update?', 'openframe' ); ?></h2>
		    <p><?php printf( __( 'Updating a theme is pretty much like installing it. Download it from ThemeForest.net, extract the .zip package, find the theme folder or the theme zip file. Now, if you do not know how to connect via FTP connection to your server, simply delete the current version of "%s" from WordPress and install the new one (Version %s). Otherwise, connect to your server, navigate to the WordPress themes folder and replace the whole theme folder with the new version.', 'openframe' ), op_config( 'theme_name' ), $latestver ); ?></p>
		    <p><?php _e( 'Your themes path is:', 'openframe' ); ?> <code><?php echo get_theme_root(); ?></code></p>
		    <p><?php _e( '<strong>IMPORTANT:</strong> <em>If you made changes to the theme files you will probably lose theme settings when updating. In that case we recommend to backup your theme folder first, look at <strong>changes.txt</strong> file contained into the new theme version package and manually update only the files that have been changed.</em>', 'openframe' ); ?></p>
		<h2><?php _e( 'Changelog', 'openframe' ); ?></h2>
		<div><?php echo $xml->changes; ?></div>			
		</div>
	</div>
	
	<?php
}

?>