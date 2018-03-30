<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! function_exists( 'wolf_admin_notice' ) ) {
	/**
	 * Custom admin notice
	 *
	 * @access public
	 * @param string $message
	 * @param string $type
	 * @param bool $dismiss
	 * @param string $id
	 * @return bool
	 */
	function wolf_admin_notice( $message = null, $type = null, $dismiss = false, $id = null ) {

		if ( $dismiss ) {

			$dismiss = __( 'Hide permanently', 'wolf' );

			if ( $id ) {
				if ( ! isset( $_COOKIE[ $id ] ) )
					echo "<div class='$type'><p>$message<span class='wolf-close-admin-notice'>&times;</span><span id='$id' class='wolf-dismiss-admin-notice'>$dismiss</span></p></div>";
			} else {
				echo "<div class='$type'><p>$message<span class='wolf-close-admin-notice'>&times;</span></p></div>";
			}
		} else {
			echo "<div class='$type'><p>$message</p></div>";
		}

		return false;
	}
	add_action( 'admin_notices', 'wolf_admin_notice' );
}

if ( ! function_exists( 'wolf_include' ) ) {
	/**
	 * "Include file" function that checks if the "includes" directory and the required file exists before including it.
	 *
	 * @access public
	 * @param string $filename
	 * @param string $folder
	 * @return
	 */
	function wolf_include( $filename = null, $folder = 'includes' ) {

		$inc_dir = '';

		if ( is_dir( WOLF_THEME_DIR . '/' . $folder ) ) {
			$inc_dir = WOLF_THEME_DIR . '/' . $folder;
		}

		if ( file_exists( $inc_dir . '/' . $filename ) ) {
			return include( $inc_dir . '/' . $filename );
		}
	}
}

if ( ! function_exists( 'wolf_get_theme_changelog' ) ) {
	/**
	 * Fetch XML changelog file from remote server
	 *
	 * Get the theme changelog and cache it in a transient key
	 *
	 * @return string
	 */
	function wolf_get_theme_changelog() {

		$changelog_url = WOLF_UPDATE_URL . '/' . WOLF_THEME_SLUG .'/changelog.xml';

		if ( WOLF_DEBUG )
			$changelog_url = WOLF_THEME_URI . '/pack/changelog/changelog.xml';

		$trans_key = '_wolf_latest_theme_version_' . WOLF_THEME_SLUG;

		// delete_transient( $trans_key );

		if ( false === ( $cached_xml = get_transient( $trans_key ) ) ) {
			if ( function_exists( 'curl_init' ) ) {
				$ch = curl_init( $changelog_url );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch, CURLOPT_HEADER, 0 );
				curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
				$xml = curl_exec( $ch );
				curl_close( $ch );
			} else {
				$xml = file_get_contents( $changelog_url );
			}

			if ( $xml ) {
				set_transient( $trans_key, $xml, WOLF_CACHE_DURATION );
			}
		} else {
			$xml = $cached_xml;
		}

		if ( $xml ) {
			return @simplexml_load_string( $xml );
		}
	}
}

if ( ! function_exists( 'wolf_get_last_change_from_changelog' ) ) {
	/**
	 * Get last changes
	 *
	 * @access public
	 * @param bool $echo
	 * @return string $last_log
	 */
	function wolf_get_last_change_from_changelog() {

		$xml = wolf_get_theme_changelog();

		if ( $xml ) {
			$last_log = (string)$xml->new;
			if ( $last_log ) {

				return $last_log;
			}
		}
	}
}

if ( ! function_exists( 'wolf_get_theme_description_from_changelog' ) ) {
	/**
	 * Get last changes
	 *
	 * @access public
	 * @param bool $echo
	 * @return string $desc
	 */
	function wolf_get_theme_description_from_changelog() {

		$xml = wolf_get_theme_changelog();

		if ( $xml ) {
			$desc = (string)$xml->description;
			if ( $desc ) {

				return $desc;
			}
		}
	}
}

if ( ! function_exists( 'wolf_get_theme_short_link' ) ) {
	/**
	 * Get theme short link
	 *
	 * @param
	 * @return string shortlink
	 */
	function wolf_get_theme_short_link() {

		$xml = wolf_get_theme_changelog();

		if ( $xml ) {
			$short_link = (string)$xml->short_link;
			if ( $short_link ) {

				return esc_url( $short_link );
			}
		}

	}
}

if ( ! function_exists( 'wolf_theme_update_notification_message' ) ) {
	/**
	 * Display the theme update notification notice
	 *
	 * @param bool $link
	 * @return string
	 */
	function wolf_theme_update_notification_message( $link = true ) {

		if ( WOLF_UPDATE_NOTICE ) {

			$changelog = wolf_get_theme_changelog();

			if ( $changelog && isset( $changelog->latest ) && -1 == version_compare( WOLF_THEME_VERSION, $changelog->latest ) ) {
				$message  = '';
				$message .= '<strong>' . sprintf( __( 'There is a new version of %s available.', 'wolf' ),  ucfirst( wolf_get_theme_slug() ) ) . '</strong>';
				$message .= sprintf( __( 'You have version %s installed.', 'wolf' ),  WOLF_THEME_VERSION );
				if ( $link ) {
					$message .= '<a href="' . esc_url( admin_url( 'admin.php?page=wolf-theme-update' ) ) . '">';
				}
					$message .= ' ' . sprintf( __( 'Update to version %s', 'wolf' ),  $changelog->latest );

				if ( $link ) {
					$message .= '</a>';
				}

				wolf_admin_notice( $message, 'updated', true, '_' . wolf_get_theme_slug() . 'update_notice' );
			}
		}
	}
}

if ( ! function_exists( 'wolf_export_options' ) ) {
	/**
	 * Export theme options in a zip file
	 *
	 * @param array $options
	 * @return array $options
	 */
	function wolf_export_options( $options ) {

		if ( class_exists( 'ZipArchive' ) && WOLF_ENABLE_OPTIONS_EXPORTER ) {

			// 5 minutes time out
			set_time_limit( 900 );

			$dir = WOLF_THEME_DIR . '/includes/admin/export';
			/* Save options in zip file */
			$file = $dir . '/options-export.txt';
			$serialized_new_options = base64_encode( serialize( get_option( 'wolf_theme_options_' . wolf_get_theme_slug() ) ) );
			file_put_contents( $file, $serialized_new_options );
			$zip = new ZipArchive();
			$zip->open( WOLF_THEME_DIR . '/includes/admin/export/options-export.zip', ZipArchive::CREATE );
			$zip->addFile( $file, 'options-export.txt' );
			$zip->close();
			if ( is_file( $file ) ) unlink( $file );
		}

		return $options;
	}
	add_action( 'wolf_after_options_save', 'wolf_export_options' );
}

if ( ! function_exists( 'wolf_checkfolder' ) ) {
	/**
	 * Check if a folder exists and is writable
	 *
	 * @param
	 * @return
	 */
	function wolf_check_folder( $dir ) {

		$message  = null;
		$result   = true;
		$error_id = '';

		if ( is_writable( $dir ) ) {
			$result = true;
		}

		if ( is_dir( $dir ) && ! is_writable( $dir ) ) {

			if ( chmod( $dir, 775 ) ) {
				$result = true;
			} else {
				$message  = sprintf(
					__(
						'The <strong>%1$s</strong> directory has to be writable. Please set the folder permission to 775 through your FTP client <br>or with the command line <strong>chmod 775 %2$s</strong>',
						'wolf'
					), $dir, $dir );
				$error_id = 'error_' . $dir . '_dir_permission';
				$result   = false;
			}
		}

		elseif ( ! is_dir( $dir ) ) {

			$old_mask = umask( 0 );
			if ( ! mkdir( $dir, 775 ) ) {
				$message  = sprintf(
					__(
						'Error while trying to find the folder <strong>%1$s</strong>. Please create it manually and set the permission to 775 through your FTP client<br>or with the command line <strong>mkdir -m 775 %2$s</strong>', 'wolf'
					), $dir, $dir
				);
				$error_id = 'error_' . $dir . '_dir';
				$result   = false;
			}
			umask( $old_mask );
		}

		if ( false == $result ) {
			wolf_admin_notice( $message, 'error', true, $error_id );
		}

		return $result;
	}
}

if ( ! function_exists( 'wolf_clean_folder' ) ) {
	/**
	 * Remove all files in a folder
	 *
	 * @param string $dirname
	 */
	function wolf_clean_folder( $dirname ) {

		$dir_handle = null;
		$tmp_dir = WOLF_THEME_TMP_DIR;

		if ( is_dir( $dirname ) )
			$dir_handle = opendir( $dirname );

		if ( ! $dir_handle )
			return false;

		while ( $file = readdir( $dir_handle ) ) {
			if ( $file != '.' && $file != '..' && $file != 'empty' ) {
				if ( ! is_dir( $dirname . '/' . $file ) ) {
					unlink( $dirname . '/' . $file );
				} else {
					wolf_clean_folder( $dirname . '/' . $file );
				}
			}
		}

		closedir( $dir_handle );

		if ( $dirname != $tmp_dir && count( glob( "$dirname/*" ) ) === 0 ) {
			rmdir( $dirname );
		}

		return true;
	}
}

if ( ! function_exists( 'wolf_get_options_from_text_file' ) ) {
	/**
	 * Get theme options array from a a serialize arry in a txt file
	 *
	 * This function is used to set default options from an exported text file
	 *
	 * @param string $file
	 * @return array $default_options
	 */
	function wolf_get_options_from_text_file( $file = null ) {

		$default_options = array();
		$file = ( $file ) ? $file : WOLF_THEME_CONFIG_DIR . '/options-export.txt'; // default file location

		if ( is_file( $file ) ) {

			$options = array();

			if ( file_get_contents( $file ) ) {
				$options = unserialize( base64_decode( file_get_contents( $file ) ) );
			}

			foreach ( $options as $key => $value ) {
				$value = stripslashes( htmlspecialchars( $value ) );
				$socials = array( 'facebook', 'twitter', 'instagram' );
				if ( $value ) {
					if ( $value != '#' || in_array( $key, $socials ) ) {
						$default_options[ $key ] = $value;
					}
				}
			}
		}
		return $default_options;
	}
}