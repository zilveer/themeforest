<?php

/**
 * StagFramework Theme Options Backup
 * 
 * @package StagFrameework
 * @since 2.0
 */
class StagFramework_Backup{
	private $admin_page;
	private $token;
	
	public function __construct () {
		$this->admin_page = '';
		$this->token = 'stagframework-backup';
	}

	/**
	 * init()
	 * 
	 */
	public function init(){
		add_action( 'admin_menu', array( &$this, 'register_admin_screen'), 20 );
	}

	/**
	* Register Admin Screen
	* 
	* @since 2.0
	*/
	public function register_admin_screen(){
		$this->admin_page = add_submenu_page( 'stagframework', __( 'Settings Backup', 'stag' ), __( 'Backup Settings', 'stag' ), 'manage_options', $this->token, array( &$this, 'admin_screen' ) );

		add_action( 'load-' . $this->admin_page, array( &$this, 'admin_screen_logic' ) );

		add_action( 'admin_notices', array( &$this, 'admin_notices' ), 10 );
	}

	/**
	* Load the admin screen for settings
	*/
	public function admin_screen(){
?>

	<div class="wrap">
		<?php screen_icon('tools'); ?>
		<h2><?php _e( 'Backup Settings', 'stag' ); ?></h2>
		
		<h3><?php _e( 'Import Settings', 'stag' ); ?></h3>
		
		<p><?php _e( 'If you have settings in a backup file on your computer, the StagFramework can import those into this site. To get started, upload your backup file to import from below.', 'stag' ); ?></p>

		<div class="form-wrap">
			<form enctype="multipart/form-data" method="post" action="<?php echo admin_url( 'admin.php?page=' . $this->token ); ?>">
				<?php wp_nonce_field( 'stag-backup-import' ); ?>
				<label for="stag-import-file"><?php printf( __( 'Upload File: (Maximum Size: %s)', 'stag' ), ini_get( 'post_max_size' ) ); ?></label>
				<input type="file" id="stag-import-file" name="stag-import-file" size="25" />
				<input type="hidden" name="stag-backup-import" value="1" />
				<input type="submit" class="button" value="<?php _e( 'Upload File and Import', 'stag' ); ?>" />
			</form>
		</div><!--/.form-wrap-->
	
		<h3><?php _e( 'Export Settings', 'stag' ); ?></h3>
		<p><?php _e( 'When you click the button below, the StagFramework will create a text file for you to save to your computer.', 'stag' ); ?></p>
		<p><?php echo sprintf( __( 'This text file can be used to restore your settings here on "%s", or to easily setup another website with the same settings".', 'stag' ), get_bloginfo( 'name' ) ); ?></p>

		<form method="post" action="<?php echo admin_url( 'admin.php?page=' . $this->token ); ?>">
			<?php wp_nonce_field( 'stag-backup-export' ); ?>
			<p><label><input type="radio" name="content" value="all" checked="checked"> <?php _e( 'All Content', 'stag' ); ?></label>
				<p class="description"><?php _e( 'This will contain all of your theme options.', 'stag' ); ?></p>
			</p>
			<input type="hidden" name="stag-backup-export" value="1" />
			<input type="submit" class="button" value="<?php _e( 'Download Export File', 'stag' ); ?>" />
		</form>

	</div>		

<?php
	} // end admin_screen()

	/**
	* Display admin notices when performing backup/restore
	*/
	public function admin_notices(){

		if ( ! isset( $_GET['page'] ) || ( $_GET['page'] != $this->token ) ) { return; }

		echo '<div class="updated" id="import-notice"><p>' . sprintf( __( 'Please note that this backup manager backs up only your settings and not your content. To backup your content, please use the %sWordPress Export Tool%s.', 'stag' ), '<a href="' . admin_url( 'export.php' ) . '">', '</a>' ) . '</p></div>';

		if ( isset( $_GET['error'] ) && $_GET['error'] == 'true' ) {
			echo '<div id="message" class="error"><p>' . __( 'There was a problem importing your settings. Please Try again.', 'stag' ) . '</p></div>';
		} else if ( isset( $_GET['error-export'] ) && $_GET['error-export'] == 'true' ) {  
			echo '<div id="message" class="error"><p>' . __( 'There was a problem exporting your settings. Please Try again.', 'stag' ) . '</p></div>';
		} else if ( isset( $_GET['invalid'] ) && $_GET['invalid'] == 'true' ) {  
			echo '<div id="message" class="error"><p>' . __( 'The import file you\'ve provided is invalid. Please try again.', 'stag' ) . '</p></div>';
		} else if ( isset( $_GET['imported'] ) && $_GET['imported'] == 'true' ) {  
			echo '<div id="message" class="updated"><p>' . sprintf( __( 'Settings successfully imported. Return to %sTheme Options%s', 'stag' ), '<a href="' . admin_url( 'admin.php?page=stagframework' ) . '">', '</a>' ) . '</p></div>';
		}
	}

	/**
	* Processes the code to generate the backup or restore
	*/
	public function admin_screen_logic () {
		
		if ( ! isset( $_POST['stag-backup-export'] ) && isset( $_POST['stag-backup-import'] ) && ( $_POST['stag-backup-import'] == true ) ) {
			$this->import();
		}
		
		if ( ! isset( $_POST['stag-backup-import'] ) && isset( $_POST['stag-backup-export'] ) && ( $_POST['stag-backup-export'] == true ) ) {
			$this->export();
		}

	} // End admin_screen_logic()

	/**
	* Import settings from a backup file
	*/
	public function import(){
		check_admin_referer( 'stag-backup-import' ); // Security check

		if ( ! isset( $_FILES['stag-import-file'] ) ) { return; } // We can't import the settings without a settings file.

		$upload = file_get_contents( $_FILES['stag-import-file']['tmp_name'] );

		// Decode the JSON from the uploaded file
		$options = json_decode( $upload, true );

		// Check for errors
		if( !$options || $_FILES['stag-import-file']['error'] ){
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&error=true' ) );
			exit;
		}

		// Let's make sure if it's a valid backup file
		if ( ! isset( $options['stag-backup-validator'] ) ) {
			wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&invalid=true' ) );
			exit;
		} else {
			unset( $options['stag-backup-validator'] ); // Now that we've checked it, we don't need the field anymore.
		}

		$stag_options = get_option('stag_framework_values');

		$has_updated = false; // If this is set to true at any stage, we update the main options collection.

		// Cycle through data, import settings
		foreach( (array) $options as $key => $settings ) {
			$settings = maybe_unserialize( $settings ); // Unserialize serialized data before inserting it back into the database.

			if( is_array( $stag_options ) ) {
				$stag_options[$key] = $settings;
				$has_updated = true;
			}
		}

		if( $has_updated == true ) {
			update_option( 'stag_framework_values', $stag_options );
		}

		// Redirect, add success flag to the URI
		wp_redirect( admin_url( 'admin.php?page=' . $this->token . '&imported=true' ) );
		exit;
	}

	/**
	* Export current settings
	*/
	public function export(){
		global $wpdb;
		
		check_admin_referer( 'stag-backup-export' ); // Security check

		$settings = get_option('stag_framework_values');

		// Add our custom marker, to ensure only valid files are imported successfully.
		$settings['stag-backup-validator'] = date( 'Y-m-d h:i:s' );

		// Generate the export file.
	    $output = json_encode( (array)$settings );
	
	    header( 'Content-Description: File Transfer' );
	    header( 'Cache-Control: public, must-revalidate' );
	    header( 'Pragma: hack' );
	    header( 'Content-Type: text/plain' );
	    header( 'Content-Disposition: attachment; filename="' . $this->token . '-' . date( 'Ymd-His' ) . '.json"' );
	    header( 'Content-Length: ' . strlen( $output ) );
	    echo $output;
	    exit;
	}

}

/**
 * Create $stag_backup Object.
 *
 * @since 2.0
 * @uses StagFramework_Backup
 */
$stag_backup = new StagFramework_Backup();
$stag_backup->init();
