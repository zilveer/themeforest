<?php

/**
 * Icons Helper
 *
 * @package wpv
 */
/**
 * class WpvIconsHelper
 */
class WpvIconsHelper extends WpvAjax {

	public static $storage_path;

	/**
	 * Hook ajax actions
	 */
	public function __construct() {
		$this->actions = array(
			'get-icon-list' => 'get_icon_list',
			'process-icon-font' => 'process_icon_font',
		);

		parent::__construct();

		self::$storage_path = trailingslashit( WP_CONTENT_DIR ) . 'vamtam/custom-icon-font/';

		add_action( 'admin_menu', array( __CLASS__, 'admin_menu' ), 20 );
	}

	public static function process_icon_font() {
		check_ajax_referer( 'vamtam-icon-manager' );

		$path = get_post_meta( (int) $_POST['selected'], '_wp_attached_file', true );

		if ( empty( $path ) ) {
			die( -1 );
		}

		$upload_dir = wp_upload_dir();

		$fullpath = trailingslashit( $upload_dir['basedir'] ) . $path;

		if ( ! is_dir( self::$storage_path ) && ! mkdir( self::$storage_path, 0755, true ) ) {
			die( json_encode( array( 'error' => 'Cannot create directory: ' . self::$storage_path ) ) );
		}

		$files = glob( self::$storage_path . '*' );
		foreach ( $files as $file ) {
			@unlink( $file );
		}

		$zip = new ZipArchive;
		$res = $zip->open( $fullpath );
		if ( $res === TRUE ) {
			$zip->extractTo( self::$storage_path . 'temp/' );
			$zip->close();

			$files = glob( self::$storage_path . 'temp/fonts/*' );
			foreach ( $files as $file ) {
				$extension = pathinfo( $file, PATHINFO_EXTENSION );
				rename( $file, self::$storage_path . 'custom-icons.' . $extension );
			}

			$selection = json_decode( file_get_contents( self::$storage_path . 'temp/selection.json' ) );

			$icons = $icons_display = array();

			foreach ( $selection->icons as $icon ) {
				$icons[ $icon->properties->name ] = $icon->properties->code;

				$icons_display[ $icon->properties->name ] = $icon->icon->paths;
			}

			update_option( 'vamtam-custom-icons-map', $icons );

			echo json_encode( $icons_display );
		} else {
			die( json_encode( array( 'error' => 'Cannot unzip uploaded file. Check if the ZipArchive PHP extension is installed and activated on your server.' ) ) );
		}

		exit;
	}

	public static function admin_menu() {
		add_submenu_page( 'wpv_general', __('Icons', 'health-center'), __('Icons', 'health-center'), 'edit_theme_options', 'vamtam_icons', array( __CLASS__, 'page' ) );
	}

	public static function page() {
		include WPV_ADMIN_TEMPLATES . 'icons-manager.php';
	}

	/**
	 * JSON-encoded list of icons
	 */
	public function get_icon_list() {
		header( 'Content-type: application/json' );

		$icons  = wpv_get_icons_extended();
		$result = array();

		$result[''] = '<span>'.__( 'No icon' ).'</span>';

		foreach ( $icons as $key => $name ) {
			$type = wpv_get_icon_type( $key );

			if ( $type !== '' ) {
				$type .= '-icon';
			}

			$result[$key] = '<span title="'.esc_attr( $name ).'" class="vamtam-icon '. $type . '">&#' . wpv_get_icon_num( $key ) . '</span>';
		}

		echo json_encode( $result );

		exit;
	}
}
