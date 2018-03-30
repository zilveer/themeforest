<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * System helpers.
 *
 * This file contains system-wide utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Get a configuration key.
 *
 * @param string $key The configuration key.
 * @param string $subkey The configuration subkey.
 * @return mixed
 */
if( !function_exists('thb_config') ) {
	function thb_config( $key, $subkey=null ) {
		$thb_theme = thb_theme();
		return $thb_theme->getConfig($key, $subkey);
	}
}

/**
 * Raise a message.
 *
 * @param string $type The message type.
 * @param string $message The message text.
 * @param array $data The data array.
 * @return mixed
 */
if( !function_exists('thb_system_raise') ) {
	function thb_system_raise( $type, $message, $data ) {
		$response['type'] = $type;
		$response['message'] = $message;

		if( !empty($data) ) {
			$response['data'] = $data;
		}

		if( isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&  !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
			echo json_encode($response);
			die;
		}
		else {
			return $response;
		}
	}
}

/**
 * Raise an error message.
 *
 * @param string $message The message text.
 * @param array $data The data array.
 * @return void
 */
if( !function_exists('thb_system_raise_error') ) {
	function thb_system_raise_error( $message, $data=array() ) {
		return thb_system_raise('error', $message, $data);
	}
}

/**
 * Raise a success message.
 *
 * @param string $message The message text.
 * @param array $data The data array.
 * @return void
 */
if( !function_exists('thb_system_raise_success') ) {
	function thb_system_raise_success( $message, $data=array() ) {
		return thb_system_raise('success', $message, $data);
	}
}

/**
 * Get the current URL.
 *
 * @return string
 */
if( !function_exists('thb_system_current_url') ) {
	function thb_system_current_url() {
		$serverrequri = $_SERVER['PHP_SELF'];
		$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
		$protocol='http' . $s;
		$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);

		$url = $protocol."://".$_SERVER['SERVER_NAME'].$port.$serverrequri;

		if( !empty($_SERVER['QUERY_STRING']) ) {
			$url .= '?' . $_SERVER['QUERY_STRING'];
		}

		return $url;
	}
}

/**
 * Check if the theme is in development mode.
 *
 * @return boolean
 */
if( !function_exists('thb_system_is_development') ) {
	function thb_system_is_development() {
		return THB_THEME_ENVIRONMENT == 'development';
	}
}

/**
 * Check if the theme is in production mode.
 *
 * @return boolean
 */
if( !function_exists('thb_system_is_production') ) {
	function thb_system_is_production() {
		return !thb_system_is_development();
	}
}

/**
 * Verify the THB nonce.
 *
 * @param string $nonce The nonce name.
 * @return void
 */
if( !function_exists('thb_system_verify_nonce') ) {
	function thb_system_verify_nonce( $nonce ) {
		$ok = true;

		if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
			if( !isset($_POST['THB_nonce']) || !wp_verify_nonce($_POST['THB_nonce'], plugin_basename($nonce)) ) {
				$ok = false;
			    $message = __('You do not have sufficient permissions to save these options', 'thb_text_domain');
			}
		}
		else {
			$ok = false;
			$message = __('You do not have sufficient permissions to access this page', 'thb_text_domain');
		}

		if( !$ok ) {
			thb_system_raise_error($message);
		}
	}
}

/**
 * Parses a query string into an array.
 *
 * @param string $str The query string.
 * @return array
 **/
if( !function_exists('thb_parse_querystring') ) {
	function thb_parse_querystring( $str ) {
		$op = array();
		$pairs = explode("&", $str);
		foreach ($pairs as $pair) {
			if(empty($pair))
				continue;
			list($k, $v) = array_map("urldecode", explode("=", $pair));
			$op[$k] = $v;
		}
		return $op;
	}
}

/**
 * Parse a shortcode string and return its value.
 *
 * @param string $shortcode The shortcode string.
 * @param string $attribute The attribute string.
 * @return string
 */
if( !function_exists('thb_get_shortcode_attribute') ) {
	function thb_get_shortcode_attribute( $shortcode, $attribute ) {
		$pattern = '/'.$attribute.'="([^\"]+)"/i';
		preg_match_all($pattern, $shortcode, $matches, PREG_OFFSET_CAPTURE);

		if( isset($matches[1]) && !empty($matches[1]) ) {
			return $matches[1][0][0];
		}

		return '';
	}
}

if( !function_exists('thb_system_get_path') ) {
	/**
	 * Translates a URL resource to a path.
	 *
	 * @param $url The resource URL.
	 * @return string
	 */
	function thb_system_get_path( $url ) {
		$url = str_replace(WP_CONTENT_URL, '', $url);

		return WP_CONTENT_DIR . $url;
	}
}

if( !function_exists('thb_read_url') ) {
	/**
	 * Retrieve the content of a local or remote file.
	 *
	 * @param $url The resource URL.
	 * @return string
	 */
	function thb_read_url( $url ) {
		if( thb_text_startsWith($url, WP_CONTENT_URL) ) {
			return file_get_contents( thb_system_get_path($url) );
		}
		else {
			$response = wp_remote_get($url);

			if( thb_response_is_ok($response) ) {
				return $response['body'];
			}
		}

		return '';
	}
}

/**
 * Return a system button.
 *
 * @param string $label The button label.
 * @param string $url The button URL.
 * @param array $atts The button configuration array.
 * @return string
 */
if( !function_exists('thb_system_get_button') ) {
	function thb_system_get_button( $label, $url='#', $atts=array() ) {
		$atts = thb_array_asum(array(
			'class' => '',
			'id' => '',
			'icon' => '',
			'data' => array()
		), $atts);

		extract($atts);

		$btn = '<a href="' . $url . '" class="thb-btn ' . $class . '"';

		if( $id != '' ) {
			$btn .= ' id="' . $id . '" ';
		}

		$btn .= thb_get_data_attributes($data);

		$btn .= '>';

		if( $icon != '' ) {
			$btn .= '<img class="thb-btn-icon" src="' . THB_ADMIN_CSS_URL . '/i/' . $icon . '" />';
		}

		$btn .= $label;

		$btn .= '</a>';

		return $btn;
	}
}

/**
 * Echo a system button.
 *
 * @param string $label The button label.
 * @param string $url The button URL.
 * @param array $atts The button configuration array.
 * @return string
 */
if( !function_exists('thb_system_button') ) {
	function thb_system_button( $label, $url='#', $atts=array() ) {
		echo thb_system_get_button($label, $url, $atts);
	}
}

/**
 * Method: xss_protect
 * Purpose: Attempts to filter out code used for cross-site scripting attacks
 *
 * @param $data - the string of data to filter
 * @param $strip_tags - true to use PHP's strip_tags function for added security
 * @param $allowed_tags - a list of tags that are allowed in the string of data
 * @return a fully encoded, escaped and (optionally) stripped string of data
 */
if( !function_exists('thb_system_xss_protect') ) {
	function thb_system_xss_protect( $data, $strip_tags = false, $allowed_tags = '' ) {
	    if($strip_tags) {
	        $data = strip_tags($data, $allowed_tags . '<b>');
	    }

	    if(stripos($data, 'script') !== false) {
	        $result = str_replace('script','scr<b></b>ipt', htmlentities($data, ENT_QUOTES));
	    } else {
	        $result = htmlentities($data, ENT_QUOTES);
	    }

	    return $result;
	}
}

/**
 * Render the custom resource.
 *
 * @return void
 */
if( !function_exists('thb_render_resource') ) {
	function thb_render_resource() {
		$file = '/' . $_GET['name'];
		$folders = array( THB_THEME_RESOURCES_DIR, THB_RESOURCES_DIR );

		foreach( $folders as $folder ) {
			if( file_exists($folder . $file . '.' . THB_Template::$extension) ) {
				$file = $folder . $file;
				$resource = new THB_Template($file);
				$resource->render();

				die();
			}
		}

		die();
	}
}
add_action('wp_ajax_nopriv_thb_render_resource', 'thb_render_resource');
add_action('wp_ajax_thb_render_resource', 'thb_render_resource');

/**
 * Return a custom resource link.
 *
 * @param string $name The custom resource name.
 * @return string
 */
if( !function_exists('thb_custom_resource') ) {
	function thb_custom_resource( $name ) {
		$page_id = thb_get_page_ID();
		$resource_url = admin_url('admin-ajax.php') . '?action=thb_render_resource&page_id=' . $page_id . '&name=' . $name;

		return $resource_url;
	}
}

/**
 * Get a properly translated admin resource.
 *
 * @param string $key The string key to look for.
 * @return string
 */
if( !function_exists('thb_translated_admin_resource') ) {
	function thb_translated_admin_resource( $key ) {
		$thb_theme = thb_theme();

		$thb_admin_language = $thb_theme->getAdmin()->getLanguage();
		$thb_admin_default_language = $thb_theme->getAdmin()->getDefaultLanguage();

		if( file_exists(THB_LANGUAGES_DIR . '/' . $thb_admin_language . '/admin/resources/' . $key . '.php') ) {
			// $file = THB_LANGUAGES_DIR . '/' . $thb_admin_language . '/admin/resources/' . $key;
			$thb_valid_language = $thb_admin_language;
		}
		else {
			// $file = THB_LANGUAGES_DIR . '/' . $thb_admin_default_language . '/admin/resources/' . $key;
			$thb_valid_language = $thb_admin_default_language;
		}

		$file = $thb_valid_language . '/admin/resources/' . $key;

		if( file_exists(THB_THEME_TEMPLATES_DIR . '/languages/' . $file . '.php') ) {
			$file = THB_THEME_TEMPLATES_DIR . '/languages/' . $file;
		}
		else {
			$file = THB_LANGUAGES_DIR . '/' . $file;
		}

		$resource = new THB_Template($file);
		return $resource->render(true);
	}
}

/**
 * Get a list of all the defined super users.
 *
 * @return array
 */
if( !function_exists('thb_get_super_users') ) {
	function thb_get_super_users() {
		$super_users_option = get_option('thb_super_users');

		$usernames = array();
		if( $super_users_option ) {
			$usernames = explode(',', $super_users_option);
			array_walk($usernames, 'trim');
		}

		return $usernames;
	}
}

/**
 * Check if a user or the currently logged user is a super user.
 *
 * @return boolean
 */
if( !function_exists('thb_is_super_user') ) {
	function thb_is_super_user( $user=null ) {
		if( !$user ) {
			$current_user = wp_get_current_user();
			if( !($current_user instanceof WP_User) ) {
				return false;
			}

			$user = $current_user->user_login;
		}

		$super_users = thb_get_super_users();

		if( empty($super_users) ) {
			return current_user_can('administrator');
		}
		else {
			return in_array($user, $super_users);
		}
	}
}

/**
 * Check if the response is successful.
 *
 * @param array $response The response array.
 * @return boolean
 */
if( !function_exists('thb_response_is_ok') ) {
	function thb_response_is_ok( $response ) {
		return !($response instanceOf WP_Error) && is_array($response) && $response['response']['code'] == 200;
	}
}

/**
 * Get the URL of an admin page.
 *
 * @param string $slug The admin page slug.
 * @return string
 */
if( !function_exists('thb_system_admin_url') ) {
	function thb_system_admin_url( $slug ) {
		if( thb_system_is_production() ) {
			$basepage = 'admin';
		}
		else {
			$basepage = 'themes';
		}

		return admin_url('/' . $basepage . '.php?page=' . $slug);
	}
}

/**
 * Email filters
 */
if( ! function_exists('thb_wp_mail_from') ) {
	function thb_wp_mail_from( $content_type ) {
		return thb_system_xss_protect($_POST['contact_email']);
	}
}

if( ! function_exists('thb_wp_mail_from_name') ) {
	function thb_wp_mail_from_name( $name ) {
		$contact_name = thb_system_xss_protect($_POST['contact_name']);
		return html_entity_decode( stripslashes( $contact_name ) );
	}
}

/**
 * Send an email from the contact form.
 *
 * @param string $to The recipient's email.
 * @return void
 */
if( !function_exists('thb_system_send_mail') ) {
	function thb_system_send_mail( $to ) {
		/**
		 * Verify we have data to send.
		 */
		if( $_SERVER['REQUEST_METHOD'] != 'POST' || empty($_POST) || !isset($_POST['thb_system_send_mail_nonce']) ) {
			return;
		}

		/**
		 * Verify that the nonce is correct.
		 */
		if( ! wp_verify_nonce($_POST['thb_system_send_mail_nonce'], 'thb_system_send_mail') ) {
			return;
		}

		header('Content-type: application/json');

		/**
		 * Email data
		 */
		$thb_data = array(
			'contact_email'   => '',
			'contact_name'    => '',
			'contact_subject' => '',
			'contact_message' => ''
		);
		$thb_data = $_POST + $thb_data;

		/**
		 * Sanitize the data
		 */
		array_walk( $thb_data, 'thb_system_xss_protect' );

		/**
		 * Data validation
		 */
		foreach( $thb_data as $d ) {
			if( trim($d) == '' ) {
				thb_system_raise_error( __('Please fill in all the required fields.', 'thb_text_domain') );
			}
		}

		/**
		 * Composing the email
		 */
		$contact_name = $thb_data['contact_name'];
		$contact_email = $thb_data['contact_email'];
		$contact_subject = $thb_data['contact_subject'];
		$contact_message = $thb_data['contact_message'];

		$subject = $contact_subject;
		$subject = apply_filters('thb_email_subject', $subject);
		$thb_contact_message = html_entity_decode( stripslashes( strip_tags( $contact_message ) ) );
		$headers = "From: " . $contact_name . " <" . $contact_email . ">" . "\r\n";

		/**
		 * Filters
		 */
		remove_all_filters( 'wp_mail_from' );
		remove_all_filters( 'wp_mail_from_name' );
		// add_filter( 'wp_mail_from','thb_wp_mail_from', 9999 );
		// add_filter( 'wp_mail_from_name','thb_wp_mail_from_name', 9999 );

		/**
		 * Sending the email
		 */
		if( wp_mail($to, $subject, $thb_contact_message, $headers, array()) ) {
			thb_system_raise_success( __('Email sent successfully!', 'thb_text_domain') );
		}
		else {
			thb_system_raise_error( __('An error has occurred while sending your email.', 'thb_text_domain') );
		}
	}
}

if( ! function_exists('thb_custom_font_upload_mimes') ) {
	/**
	 * Add the mime type for the custom font format.
	 *
	 * @param  array  $existing_mimes
	 * @return array
	 */
	function thb_custom_font_upload_mimes ( $existing_mimes = array() ) {
		$existing_mimes['zip'] = 'application/zip';

		return $existing_mimes;
	}
}

/**
 * Unzip the source_file in the destination dir.
 *
 * @param   string      The path to the ZIP-file.
 * @param   string      The path where the zipfile should be unpacked, if false the directory of the zip-file is used
 * @param   boolean     Indicates if the files will be unpacked in a directory with the name of the zip-file (true) or not (false) (only if the destination directory is set to false!)
 * @param   boolean     Overwrite existing files (true) or not (false)
 * @return  boolean     Succesful or not
 */
if( ! function_exists( 'thb_unzip' ) ) {
	function thb_unzip( $src_file, $dest_dir=false, $create_zip_name_dir=true, $overwrite=true ) {
		if ($zip = zip_open($src_file)) {
			if ($zip) {
		  		$splitter = ($create_zip_name_dir === true) ? "." : "/";
		  		if ($dest_dir === false) $dest_dir = substr($src_file, 0, strrpos($src_file, $splitter))."/";

				// Create the directories to the destination dir if they don't already exist
				thb_create_dirs($dest_dir);

				// For every file in the zip-packet
				while ($zip_entry = zip_read($zip)) {
					// Now we're going to create the directories in the destination directories

					// If the file is not in the root dir
					$pos_last_slash = strrpos(zip_entry_name($zip_entry), "/");
					if ($pos_last_slash !== false) {
			  			// Create the directory where the zip-entry should be saved (with a "/" at the end)
			  			thb_create_dirs($dest_dir.substr(zip_entry_name($zip_entry), 0, $pos_last_slash+1));
					}

					// Open the entry
					if (zip_entry_open($zip,$zip_entry,"r"))
					{
						// The name of the file to save on the disk
						$file_name = $dest_dir.zip_entry_name($zip_entry);

						// Check if the files should be overwritten or not
						if ($overwrite === true || $overwrite === false && !is_file($file_name)) {
							// Get the content of the zip entry
							$fstream = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

							if ( ! is_dir( $file_name ) ) {
								file_put_contents($file_name, $fstream );

								// Set the rights
								chmod($file_name, 0777);
								// echo "save: ".$file_name."<br />";
							}
						}

						// Close the entry
						zip_entry_close($zip_entry);
					}

		  		}

				// Close the zip-file
				zip_close($zip);
			}
		} else {
			return false;
		}

		return true;
	}
}

/**
 * Recursively create directories if they don't already exist.
 *
 * @param string The path that should be created
 * @return void
 */
if( !function_exists('thb_create_dirs') ) {
	function thb_create_dirs( $path ) {
		if( !is_dir($path) ) {
			$directory_path = '';
			$directories = explode('/',$path);
			array_pop($directories);

			foreach( $directories as $directory ) {
				$directory_path .= $directory.'/';
				if( !is_dir($directory_path) ) {
					mkdir($directory_path);
					chmod($directory_path, 0777);
				}
			}
		}
	}
}

/**
 * Log a user in or out of the system.
 *
 * @return void
 */
if( !function_exists('thb_system_loginout') ) {
	function thb_system_loginout() {
		if( !empty($_POST) && isset($_POST['action']) && in_array($_POST['action'], array('login', 'logout')) ) {

			$action = $_POST['action'];
			$redirect = false;

			switch( $action ) {
				case 'login':
					$creds = array();
					$creds['user_login'] = $_POST['user_login'];
					$creds['user_password'] = $_POST['user_password'];
					$user = wp_signon( $creds, false );

					if( ! $user instanceOf WP_error ) {
						$redirect = true;
					}

					break;
				case 'logout':
					wp_logout();
					$redirect = true;

					break;
				default:
					die();
					$redirect = true;
			}

			if( $redirect ) {
				header( 'Location: ' . get_post_permalink(thb_get_page_ID()) );
			}
		}
	}
}

if( ! function_exists('thb_check_template_config') ) {
	/**
	 * Check if a particular key is currently enabled or disabled, or if it is
	 * enabled only for a specific set of page templates.
	 *
	 * @param string $key The option key.
	 * @param string $subkey The option subkey.
	 * @return boolean
	 */
	function thb_check_template_config( $key, $subkey ) {
		return thb_config($key, $subkey) === true || thb_is_admin_template(thb_config($key, $subkey));
	}
}

if( ! function_exists('thb_is_wordpress_version_before') ) {
	/**
	 * Check if WordPress is currently running a version prior to a given one.
	 *
	 * @param int $version The target WordPress version number.
	 * @return boolean
	 */
	function thb_is_wordpress_version_before( $version ) {
		return floatval(get_bloginfo('version')) < floatval($version);
	}
}

if( ! function_exists('thb_plugin_status') ) {
	function thb_plugin_status( $slug, $file=false ) {
		if( !$file ) {
			$file = $slug . '/' . $slug . '.php';
		}

		$status = array(
			'install_link' => wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=' . $slug), 'install-plugin_' . $slug),
			'activate_link' => wp_nonce_url(self_admin_url('plugins.php?action=activate&amp;plugin=' . $file . '&amp;plugin_status=all&amp;paged=1&amp;s'), 'activate-plugin_' . $file)
		);

		$status['installed'] = file_exists(WP_PLUGIN_DIR . '/' . $file);
		$status['active'] = (int) ($status['installed'] && is_plugin_active($file));

		return $status;
	}
}

/**
 * Chace a response object into the database.
 *
 * @param $key string The cache key.
 * @param $data string The cached data.
 * @param $expires int Number of seconds after which the cache will expire.
 * @return mixed
 */
if( !function_exists('thb_cache_set') ) {
	function thb_cache_set( $key, $data, $expires=3600 ) {
		set_transient($key, $data, $expires);

		return $data;
	}
}

/**
 * Get a cached response object.
 *
 * @param $key string The cache key.
 * @return mixed
 */
if( !function_exists('thb_cache_get') ) {
	function thb_cache_get( $key ) {
		return get_transient($key);
	}
}

if( ! function_exists('thb_system_set_flashdata') ) {
	/**
	 * Set a flash data transient.
	 *
	 * @param array $message
	 */
	function thb_system_set_flashdata( $message ) {
		$user_id = get_current_user_id();
		$transient_key = 'thb_system_flashdata_' . $user_id;

		set_transient( $transient_key, $message, 0 );
	}
}

if( ! function_exists('thb_system_get_flashdata') ) {
	/**
	 * Get the flash data transient.
	 *
	 * @return array
	 */
	function thb_system_get_flashdata() {
		$user_id = get_current_user_id();
		$transient_key = 'thb_system_flashdata_' . $user_id;

		$value = get_transient( $transient_key );
		thb_system_set_flashdata( array( 'message' => '', 'type' => '' ) );
		// delete_transient( $transient_key );

		return $value;
	}
}

if( ! function_exists( 'thb_flash_message' ) ) {
	/**
	 * Display a flash message.
	 */
	function thb_flash_message() {
		$thb_post_msg = '';
		$thb_post_msg_type = '';
		$flashdata = thb_system_get_flashdata();

		if ( $flashdata !== false && $flashdata['message'] != '' ) {
			$thb_post_msg = $flashdata['message'];
			$thb_post_msg_type = $flashdata['type'];
		}

		$attrs = array(
			'class' => 'thb-msg-container',
			'data-type' => $thb_post_msg_type,
			'data-message' => $thb_post_msg
		);

		printf( '<div %s></div>', thb_get_attributes( $attrs ) );
	}
}