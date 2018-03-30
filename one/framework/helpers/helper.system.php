<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * System helpers.
 *
 * This file contains system-wide utility functions.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists('thb_theme') ) {
	/**
	 * Get the theme instance.
	 *
	 * @return THB_Theme
	 **/
	function thb_theme() {
		return THB_Theme::getInstance();
	}
}

if( ! function_exists('thb_get_field_template') ) {
	/**
	 * Get a field template (AJAX call)
	 *
	 * @return string
	 */
	function thb_get_field_template() {
		$theme = thb_theme();

		if( isset($_POST['posttype']) ) {
			$postType = $theme->getPostType($_POST['posttype']);
			$metabox = $postType->getMetabox($_POST['metabox']);
			$container = $metabox->getContainer($_POST['container']);
			$field = $container->getField();
		}
		else {
			$page = $theme->getAdmin()->getPage($_POST['page']);
			$tab = $page->getTab($_POST['tab']);
			$container = $tab->getContainer($_POST['container']);
			$field = $container->getField();
		}

		$field->reset();

		if( isset($_POST['subtemplate']) && !empty($_POST['subtemplate']) ) {
			$field->setMetaKey('subtemplate', $_POST['subtemplate']);
		}

		$field->render();
		die();
	}
}

if( ! function_exists('thb_save_tab') ) {
	/**
	 * Save an options page tab.
	 */
	function thb_save_tab() {

		thb_system_verify_nonce('THB_tab');

		$theme = thb_theme();
		$page = $theme->getAdmin()->getPage($_POST['page']);
		$tab = $page->getTab($_POST['tab']);
		$containers = $tab->getContainers();
		$uniqids = array();

		foreach( $containers as $container ) {
			if( ! $container->isDuplicable() ) {
				foreach( $container->getFields() as $field ) {
					// $field->save( $_POST[$field->getName()] );
					$field->save();
				}
			}
			else {
				$uniqids[$container->getSlug()] = thb_duplicable_fields_save( $container->getField() );
			}
		}

		thb_system_raise_success( __('All saved!', 'thb_text_domain'), $uniqids );
	}
}

if( ! function_exists('thb_is_page_template') ) {
	/**
	 * Check if the current page is using a specific template.
	 *
	 * @param mixed $template The page template(s).
	 * @param int $page_id The page ID.
	 * @return boolean
	 */
	function thb_is_page_template( $template, $page_id=null ) {
		if( !$page_id ) {
			$page_id = thb_get_page_ID();
		}

		$page_template = thb_get_page_template($page_id);

		if( is_array($template) ) {
			return in_array($page_template, $template);
		}

		return $page_template == $template;
	}
}

if( ! function_exists('thb_get_page_template') ) {
	/**
	 * Get the page template.
	 *
	 * @param int $page_id The page ID.
	 * @return string
	 */
	function thb_get_page_template( $page_id = null ) {
		if( $page_id == null ) {
			$page_id = thb_get_page_ID();
		}

		$template = '';

		if( $page_id === 0 ) {
			return $template;
		}

		$post_type = get_post_type( $page_id );

		if( $post_type == 'page' ) {
			$template = get_post_meta( $page_id, '_wp_page_template', true );

			if( ! $template ) {
				$template = 'default';
			}
		}
		else if( ! empty( $post_type ) ) {
			if( $post_type == 'post' ) {
				$template = 'single.php';
			}
			else {
				$template = 'single-' . $post_type . '.php';
			}
		}

		$template = apply_filters( 'thb_get_page_template', $template );

		return $template;
	}
}

/**
 * Return the page template.
 *
 * @return string
 */
if( ! function_exists('thb_admin_template') ) {
	function thb_admin_template() {
		return thb_get_admin_template();
	}
}

if( ! function_exists( 'thb_get_admin_entry_ID' ) ) {
	/**
	 * Get the admin page/entry ID.
	 *
	 * @return integer
	 */
	function thb_get_admin_entry_ID() {
		$id = thb_input_post( 'post_ID', 'absint' );

		if ( $id === false ) {
			$id = thb_input_get( 'post', 'absint' );
		}

		if ( $id === false && defined( 'POLYLANG_VERSION' ) ) {
			$id = thb_input_get( 'from_post', 'absint', 0 );
		}

		return (int) $id;
	}
}

if( ! function_exists( 'thb_get_admin_template' ) ) {
	/**
	 * Get the admin page template.
	 *
	 * @return string
	 */
	function thb_get_admin_template() {
		global $pagenow;
		$thb_page_id = thb_get_admin_entry_ID();
		$post_type = 'post';

		// Post type
		$post_type = thb_input_post( 'post_type', 'string', false );

		if ( $post_type === false ) {
			$post_type = thb_input_get( 'post_type', 'string', 'post' );
		}

		if( ! $thb_page_id ) {
			if ( $post_type !== 'post' ) {
				if ( $post_type !== 'page' && $pagenow !== 'edit.php' ) {
					return 'single-' . $post_type . '.php';
				}
				else {
					return 'default';
				}
			}
			else {
				return 'single.php';
			}
		}
		else {
			return thb_get_page_template( $thb_page_id );
		}
	}
}

if( ! function_exists('thb_is_admin_template') ) {
	/**
	 * Check the page template.
	 *
	 * @param string $template The page template to be checked against.
	 * @return boolean
	 */
	function thb_is_admin_template( $template ) {
		if( is_string( $template ) ) {
			if ( is_admin() ) {
				return $template == thb_get_admin_template();
			}
		}
		elseif( is_array( $template ) ) {
			foreach( $template as $t ) {
				if( thb_is_admin_template( $t ) ) {
					return true;
				}
			}
		}

		return false;
	}
}

/**
 * Return the post type name from a specified page template filename.
 *
 * E.g. "template-contact.php" returns "page",
 * "single-works.php" returns "works".
 *
 * @param string $template The page template filename.
 * @return string
 */
if( ! function_exists('thb_get_post_type_from_template') ) {
	function thb_get_post_type_from_template( $template ) {
		$post_type = 'page';

		if( $template == 'single.php' ) {
			$post_type = 'post';
		}
		elseif( thb_text_startsWith($template, 'single-') ) {
			$post_type = str_replace('single-', '', $template);
			$post_type = str_replace('.php', '', $post_type);
		}

		return $post_type;
	}
}

/**
 * Return the page templates associated to a specific post type.
 *
 * @param string $post_type The post type.
 * @return array
 */
if( ! function_exists('thb_post_type_page_templates') ) {
	function thb_post_type_page_templates( $post_type='post' ) {
		$templates = array();

		return apply_filters('thb_' . $post_type . '_page_templates', $templates);
	}
}

if( ! function_exists('thb_config') ) {
	/**
	 * Get a configuration key.
	 *
	 * @param string $key The configuration key.
	 * @param string $subkey The configuration subkey.
	 * @return mixed
	 */
	function thb_config( $key, $subkey = null ) {
		$thb_theme = thb_theme();
		return $thb_theme->getConfig( $key, $subkey );
	}
}

if( ! function_exists( 'thb_system_get_messages' ) ) {
	/**
	 * Get all the messages for the current user.
	 *
	 * @return array
	 */
	function thb_system_get_messages() {
		$user_id = get_current_user_id();
		$transient_key = 'thb_system_messages_' . $user_id;

		$transient = get_transient( $transient_key );

		if ( $transient === false ) {
			return array();
		}

		return $transient;
	}
}

if( ! function_exists( 'thb_system_add_message' ) ) {
	/**
	 * Add a message for the current user.
	 *
	 * @param string $key The message key.
	 * @param string $message The message text.
	 */
	function thb_system_add_message( $key, $message ) {
		$messages = thb_system_get_messages();

		$user_id = get_current_user_id();
		$transient_key = 'thb_system_messages_' . $user_id;

		$messages[$key] = $message;

		set_transient( $transient_key, $messages, 0 );
	}
}

if( ! function_exists( 'thb_system_discard_message' ) ) {
	/**
	 * Discard a message for the current user.
	 */
	function thb_system_discard_message() {
		thb_system_verify_nonce('THB_discard_message');

		$key = $_POST['key'];

		$user_id = get_current_user_id();
		$transient_key = 'thb_system_messages_' . $user_id;

		$messages = thb_system_get_messages();

		if ( isset( $messages[$key] ) ) {
			unset( $messages[$key] );
		}

		set_transient( $transient_key, $messages, 0 );
		die();
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

/**
 * Raise a message.
 *
 * @param string $type The message type.
 * @param string $message The message text.
 * @param array $data The data array.
 * @return mixed
 */
if( ! function_exists('thb_system_raise') ) {
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
if( ! function_exists('thb_system_raise_error') ) {
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
if( ! function_exists('thb_system_raise_success') ) {
	function thb_system_raise_success( $message, $data=array() ) {
		return thb_system_raise('success', $message, $data);
	}
}

/**
 * Get the current URL.
 *
 * @return string
 */
if( ! function_exists('thb_system_current_url') ) {
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

if( ! function_exists('thb_system_is_development') ) {
	/**
	 * Check if the theme is in development mode.
	 *
	 * @return boolean
	 */
	function thb_system_is_development() {
		return THB_THEME_ENVIRONMENT == 'development';
	}
}

if( ! function_exists('thb_system_is_production') ) {
	/**
	 * Check if the theme is in production mode.
	 *
	 * @return boolean
	 */
	function thb_system_is_production() {
		return ! thb_system_is_development();
	}
}

if( ! function_exists('thb_system_verify_nonce') ) {
	/**
	 * Verify the THB nonce.
	 *
	 * @param string $nonce The nonce name.
	 * @return array
	 */
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
			return thb_system_raise_error($message);
		}
	}
}

if( ! function_exists('thb_parse_querystring') ) {
	/**
	 * Parses a query string into an array.
	 *
	 * @param string $str The query string.
	 * @return array
	 */
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

if( ! function_exists('thb_system_get_path') ) {
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

if( ! function_exists('thb_system_get_button') ) {
	/**
	 * Return a system button.
	 *
	 * @param string $label The button label.
	 * @param string $url The button URL.
	 * @param array $atts The button configuration array.
	 * @return string
	 */
	function thb_system_get_button( $label, $url='#', $atts=array() ) {
		$atts = thb_array_asum(array(
			'class' => '',
			'id'    => '',
			'icon'  => '',
			'data'  => array()
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

if( ! function_exists('thb_system_button') ) {
	/**
	 * Echo a system button.
	 *
	 * @param string $label The button label.
	 * @param string $url The button URL.
	 * @param array $atts The button configuration array.
	 */
	function thb_system_button( $label, $url='#', $atts=array() ) {
		echo thb_system_get_button($label, $url, $atts);
	}
}

/**
 * Get a list of all the defined super users.
 *
 * @return array
 */
if( ! function_exists('thb_get_super_users') ) {
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
if( ! function_exists('thb_is_super_user') ) {
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

if( ! function_exists('thb_system_admin_url') ) {
	/**
	 * Get the URL of an admin page.
	 *
	 * @param string $slug The admin page slug.
	 * @param array $params
	 * @return string
	 */
	function thb_system_admin_url( $slug, $params = array() ) {
		if( thb_system_is_production() ) {
			$basepage = 'admin';
		}
		else {
			$basepage = 'themes';
		}

		$url = '/' . $basepage . '.php?page=' . $slug;

		if ( ! empty( $params ) ) {
			foreach ( $params as $key => $value ) {
				$url .= '&' . $key . '=' . $value;
			}
		}

		return admin_url( $url );
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

if( ! function_exists('thb_cache_set') ) {
	/**
	 * Chace a response object into the database.
	 *
	 * @param $key string The cache key.
	 * @param $data string The cached data.
	 * @param $expires int Number of seconds after which the cache will expire.
	 * @return mixed
	 */
	function thb_cache_set( $key, $data, $expires=3600 ) {
		set_transient( $key, $data, $expires );

		return $data;
	}
}

if( ! function_exists('thb_cache_get') ) {
	/**
	 * Get a cached response object.
	 *
	 * @param $key string The cache key.
	 * @return mixed
	 */
	function thb_cache_get( $key ) {
		return get_transient( $key );
	}
}

if( ! function_exists( 'thb_cache_clear' ) ) {
	/**
	 * Clear a cached response object.
	 *
	 * @param $key string The cache key.
	 */
	function thb_cache_clear( $key ) {
		delete_transient( $key );
	}
}

if ( ! function_exists( 'thb_cache_get_timeout' ) ) {
	/**
	 * Get the timeout of a cached object.
	 *
	 * @param $key string The cache key.
	 * @return integer
	 */
	function thb_cache_get_timeout( $key ) {
		return (int) get_option( "_transient_timeout_{$key}" );
	}
}

if( ! function_exists( 'thb_set_html_class' ) ) {
	/**
	 * Add an html data class on pages that starts with 'thb-'
	 */
	function thb_set_html_class() {
		$page_slug = thb_input_get( 'page', 'string' );

		if( $page_slug && thb_text_startsWith( $page_slug, 'thb-' ) ) {
			echo " data-class='thb' ";
		}
	}

	add_action( 'admin_xml_ns', 'thb_set_html_class' );
}

if( ! function_exists( 'thb_export_data' ) ) {
	/**
	 * Export the selected data to file.
	 *
	 * @param array $data The data array.
	 * @param string $filename The name of the file to export.
	 */
	function thb_export_data( $data, $filename ) {

		$exp = base64_encode( serialize( $data ) );
		$filename .= '.' . date('Y-m-d') . '.thb-backup';

		header('Content-disposition: attachment; filename=' . $filename);
		header('Content-type: text/css');

		ob_start();
		echo $exp;
		ob_end_flush();

		die();

	}
}

if( ! function_exists('thb_export') ) {
	/**
	 * Export options and skin to file.
	 */
	function thb_export() {
		$exportOptions = isset($_POST['export_options']) && $_POST['export_options'] == 1;
		$exportMods = isset($_POST['export_mods']) && $_POST['export_mods'] == 1;
		// $exportDuplicable = isset($_POST['export_duplicable']) && $_POST['export_duplicable'] == 1;

		$data = array();
		$filename = 'thb-export';

		if( $exportOptions ) {
			$thb_theme = thb_theme();
			$data['options'] = $thb_theme->getOptions();
			$data['duplicable'] = thb_duplicable_get_all();

			$filename .= '-options';
		}

		if( $exportMods ) {
			$data['mods'] = get_theme_mods();

			$filename .= '-skin';
		}

		if ( isset( $data['options'][0] ) && ! is_array( $data['options'][0] ) ) {
			unset( $data['options'][0] );
		}

		if ( isset( $data['mods'][0] ) && ! is_array( $data['mods'][0] ) ) {
			unset( $data['mods'][0] );
		}

		if ( isset( $data['duplicable'][0] ) && ! is_array( $data['duplicable'][0] ) ) {
			unset( $data['duplicable'][0] );
		}

		thb_export_data($data, $filename);
	}
}

if( ! function_exists( 'thb_import_array' ) ) {
	/**
	 * Import options and skin into the system.
	 *
	 * @param array $data
	 * @param boolean $importOptions
	 * @param boolean $importMods
	 * @param boolean $importDuplicable
	 */
	function thb_import_array( $data = array(), $importOptions=true, $importMods=true, $importDuplicable=true ) {
		$success = false;

		if( $importOptions && isset($data['options']) ) {
			$thb_theme = thb_theme();
			$thb_theme->importOptions($data['options']);
			$success = true;
		}

		if( $importMods && isset($data['mods']) ) {
			$theme = get_option( 'stylesheet' );
			update_option( "theme_mods_$theme", $data['mods'] );
			$success = true;
		}

		if( $importDuplicable && isset($data['duplicable']) ) {
			thb_duplicable_remove_all();

			foreach( $data['duplicable'] as $itemKey => $datas ) {
				foreach( $datas as $dat ) {
					thb_duplicable_add($itemKey, $dat);
				}
			}

			$success = true;
		}

		return $success;
	}
}

if( ! function_exists('thb_import') ) {
	/**
	 * Import options and skin into the system.
	 *
	 * @param boolean $importOptions
	 * @param boolean $importMods
	 * @param boolean $importDuplicable
	 */
	function thb_import( $importOptions=true, $importMods=true, $importDuplicable=true ) {
		if( !empty($_FILES) ) {
			foreach( $_FILES as $uploaded_file ) {

				$file = thb_upload($uploaded_file);

				if( file_exists($file['file']['file']) ) {

					$fileinfo = pathinfo($file['file']['file']);

					if( $fileinfo['extension'] == 'thb-backup' ) {
						$backup = @file_get_contents($file['file']['file']);
						$data = unserialize( base64_decode( $backup ) );

						$success = thb_import_array($data);

						if( $success ) {
							$result = thb_system_raise_success( __('Data imported correctly', 'thb_text_domain') );
						}
						else {
							$result = thb_system_raise_error( __('No data imported', 'thb_text_domain') );
						}
					}
					else {
						$result = thb_system_raise_error( sprintf( __('Wrong file type. Only files with the following extensions are allowed: %s.', 'thb_text_domain'), '.thb-backup' ) );
					}

					unlink($file['file']['file']);

				}
				else {
					$result = thb_system_raise_error( __('Upload failed', 'thb_text_domain') );
				}

				thb_system_set_flashdata( $result );

			}
		}
	}
}

if( ! function_exists('thb_save_super_users') ) {
	/**
	 * Save the framework settings access option.
	 */
	function thb_save_super_users() {
		$superUsers = isset($_POST['thb_super_users']) ? $_POST['thb_super_users'] : '';
		$usernames = explode(',', $superUsers);
		array_walk($usernames, 'trim');

		if( !empty($usernames) ) {
			update_option( 'thb_super_users', implode(',', $usernames) );
		}

		$result = thb_system_raise_success( __('All saved!', 'thb_text_domain') );
		thb_system_set_flashdata( $result );

		if( ! thb_is_super_user() ) {
			$thb_theme = thb_theme();
			$thb_theme->getAdmin()->redirectToThemePage();
		}
	}
}

if( ! function_exists('thb_custom_upload_mimes') ) {
	/**
	 * Add the mime type for the backup format.
	 *
	 * @param  array  $existing_mimes
	 * @return array
	 */
	function thb_custom_upload_mimes ( $existing_mimes = array() ) {
		$existing_mimes['thb-backup'] = 'text/plain';

		return $existing_mimes;
	}

	add_filter('upload_mimes', 'thb_custom_upload_mimes');
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

if( ! function_exists( 'thb_unzip' ) ) {
	/**
	 * Unzip the source_file in the destination dir.
	 *
	 * @param   string      The path to the ZIP-file.
	 * @param   string      The path where the zipfile should be unpacked, if false the directory of the zip-file is used
	 * @param   boolean     Indicates if the files will be unpacked in a directory with the name of the zip-file (true) or not (false) (only if the destination directory is set to false!)
	 * @param   boolean     Overwrite existing files (true) or not (false)
	 * @return  boolean     Succesful or not
	 */
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

if( ! function_exists('thb_create_dirs') ) {
	/**
	 * Recursively create directories if they don't already exist.
	 *
	 * @param string The path that should be created
	 */
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

if( !function_exists('thb_upload_custom_fonts') ) {
	/**
	 * Upload a font face kit from Font Squirrel.
	 */
	function thb_upload_custom_fonts() {
		$key = 'custom_font';
		$upload_dir = wp_upload_dir();
		$basedir = $upload_dir['basedir'];

		add_filter( 'upload_mimes', 'thb_custom_font_upload_mimes' );

		if( ! empty( $_POST ) ) {
			thb_duplicable_remove( $key, 0 );
		}

		$count = 0;
		$new_fonts = array();

		if( ! empty( $_FILES ) && isset( $_FILES[$key] ) ) {
			$count = count( $_FILES[$key]['name'] );
			$ak = array_keys( $_FILES[$key]['name'] );

			if ( count( $ak ) > 0 ) {
				foreach ( $ak as $i ) {
					$uploaded_file = array(
						'name'     => $_FILES[$key]['name'][$i]['value'],
						'type'     => $_FILES[$key]['type'][$i]['value'],
						'tmp_name' => $_FILES[$key]['tmp_name'][$i]['value'],
						'error'    => $_FILES[$key]['error'][$i]['value'],
						'size'     => $_FILES[$key]['size'][$i]['value']
					);

					if ( $uploaded_file['name'] != '' ) {
						$file = thb_upload( $uploaded_file );

						if( file_exists( $file['file']['file'] ) ) {
							$archive_name = str_replace('-fontfacekit.zip', '', basename($uploaded_file['name']));

							thb_unzip($file['file']['file'], $basedir . '/fonts/' . $archive_name . '/');
							unlink($file['file']['file']);

							$stylesheet = @file_get_contents($basedir . '/fonts/' . $archive_name . '/stylesheet.css');
							preg_match_all( '|font-family:(.*)$|mi', $stylesheet, $families );
							preg_match_all( '|font-weight:(.*)$|mi', $stylesheet, $weights );
							preg_match_all( '|font-style:(.*)$|mi', $stylesheet, $styles );

							if( isset($families[1]) && !empty($families[1]) ) {
								$k=0;
								foreach( $families[1] as $family ) {
									$family = trim($family);
									$family = str_replace("'", "", $family);
									$family = str_replace(";", "", $family);

									$family_words = ucwords( strtolower( str_replace( '_', ' ', $family ) ) );

									$var = array();
									if( isset($weights[1]) && !empty($weights[1]) && isset($styles[1]) && !empty($styles[1]) ) {
										$w = $weights[1][$k];
										$s = $styles[1][$k];

										$w = trim($w);
										$w = str_replace("'", "", $w);
										$w = str_replace(";", "", $w);

										$s = trim($s);
										$s = str_replace("'", "", $s);
										$s = str_replace(";", "", $s);

										$v = $w . $s;

										if( $v == 'normalnormal' ) {
											$v = 'normal';
										}

										$var[] = $v;
									}

									$new_fonts[] = array(
										'family'   => $family_words,
										'css'      => $family,
										'folder'   => $archive_name,
										'variants' => $var
									);

									$k++;
								}
							}
						}
					}
				}
			}
		}

		if ( ! empty( $new_fonts ) ) {
			$i = 0;
			foreach ( $new_fonts as $new_font ) {
				$meta = array(
					'subtemplate' => '',
					'uniqid' => ''
				);

				thb_duplicable_add($key, array(
					'ord'       => $i,
					'value'     => array(
						'family'   => $new_font['family'],
						'css'      => $new_font['css'],
						'variants' => implode( ',', (array) $new_font['variants'] ),
						'folder'   => $new_font['folder']
					),
					'meta'      => $meta
				));

				$i++;
			}
		}

		if( ! empty( $_POST ) && isset( $_POST[$key] ) ) {
			$post_count = count( $_POST[$key] );

			$i = 0;
			foreach ( $_POST[$key] as $submitted_font ) {
				if ( isset( $submitted_font['family'] ) ) {
					$meta = array(
						'subtemplate' => '',
						'uniqid' => ''
					);

					thb_duplicable_add($key, array(
						'ord'       => $i,
						'value'     => array(
							'family'   => $submitted_font['family'],
							'css'      => $submitted_font['css'],
							'variants' => implode( ',', (array) $submitted_font['variants'] ),
							'folder'   => $submitted_font['folder']
						),
						'meta'      => $meta
					));
				}

				$i++;
			}
		}

		if( !empty($_POST) ) {
			$result = thb_system_raise_success( __('All saved!', 'thb_text_domain') );
			thb_system_set_flashdata( $result );
		}
	}
}

if( !function_exists('thb_get_theme_name') ) {
	/**
	 * Return the parent theme name.
	 *
	 * @return string
	 */
	function thb_get_theme_name() {
		$thb_theme_name = THB_THEME_NAME;

		if( is_child_theme() ) {
			$thb_theme_name = THB_PARENT_THEME_NAME;
		}

		return $thb_theme_name;
	}
}

if( ! function_exists( 'thb_dummy_content_check' ) ) {
	function thb_dummy_content_check() {
		$posts = get_posts( array(
			'post_type'      => 'any',
			'post_status'    => 'any',
			'meta_key'       => '_thb_dummy',
			'posts_per_page' => '-1'
		) );

		return count( $posts ) > 0;
	}
}

if( ! function_exists( 'thb_dummy_content_remove' ) ) {
	function thb_dummy_content_remove() {
		if ( ! empty( $_POST ) ) {

			$post_types = thb_theme()->getPublicPostTypes();
			$pt = array();

			foreach ( $post_types as $p ) {
				if ( isset( $_POST['dummy_check_' . $p->getType()] ) && $_POST['dummy_check_' . $p->getType()] == '1' ) {
					$pt[] = $p->getType();
				}
			}

			if ( isset( $_POST['dummy_check_attachment'] ) && $_POST['dummy_check_attachment'] == '1' ) {
				$pt[] = 'attachment';
			}

			$posts = get_posts( array(
				'post_type'      => $pt,
				'post_status'    => 'any',
				'meta_key'       => '_thb_dummy',
				'posts_per_page' => '-1'
			) );

			if ( empty( $posts ) ) {
				$result = thb_system_raise_error( __("Nothing to remove, you're all good.", 'thb_text_domain') );
				thb_system_set_flashdata( $result );
			}
			else {
				foreach ( $posts as $post ) {
					wp_delete_post( $post->ID );
				}

				$result = thb_system_raise_success( __('Dummy content removed!', 'thb_text_domain') );
				thb_system_set_flashdata( $result );
			}
		}
	}
}

if( ! function_exists('thb_get_post_type_for_select') ) {
	/**
	 * Get post type entries, in a selectable format.
	 *
	 * @param string $post_type The post type.
	 * @return array
	 */
	function thb_get_post_type_for_select( $post_type = 'post' ) {
		$items = get_posts(array(
			'paged'          => 1,
			'posts_per_page' => -1,
			'post_type'      => $post_type
		));

		$options = array();
		$options[0] = '--';

		if( count($items > 0) ) {
			foreach( $items as $item ) {
				$options[$item->ID] = thb_text_format( $item->post_title );
			}
		}

		return $options;
	}
}

if( ! function_exists('thb_get_pages_for_select') ) {
	/**
	 * Get pages from a specific page template, in a selectable format.
	 *
	 * @param string $page_template The page template.
	 * @return array
	 */
	function thb_get_pages_for_select( $page_template='' ) {
		$items = get_posts(array(
			'paged' => 1,
			'posts_per_page' => -1,
			'post_type' => 'page'
		));

		$options = array();
		$options[0] = '--';

		if( count($items > 0) ) {
			foreach( $items as $item ) {
				$add = true;

				if ( ! empty( $page_template ) ) {
					$add = thb_is_page_template( $page_template, $item->ID );
				}

				if ( $add ) {
					$options[$item->ID] = thb_text_format( $item->post_title );
				}
			}
		}

		return $options;
	}
}

if( ! function_exists( 'thb_partial_date' ) ) {
	/**
	 * Render the partial for a media library upload control.
	 *
	 * @param array $data The template parameters.
	 */
	function thb_partial_date( $data ) {
		$partial = new THB_Template( THB_TEMPLATES_DIR . '/admin/fields/partials/date', $data);
		$partial->render();
	}
}

if( ! function_exists( 'thb_get_protocol' ) ) {
	/**
	 * Return the current protocol being used.
	 *
	 * @return string
	 */
	function thb_get_protocol() {
		return is_ssl() ? 'https' : 'http';
	}
}

if( ! function_exists('thb_load_icons') ) {
	/**
	 * Output the defined icons.
	 **/
	function thb_load_icons() {
		$icons_output = array();
		$icon_path = THB_SHARED_ASSETS_PATH . '/fontello/config.json';
		$icon_path = apply_filters( 'thb_icon_path', $icon_path );

		ob_start();
		include $icon_path;
		$icons_template = ob_get_contents();
		ob_end_clean();

		$icons = json_decode( $icons_template );

		foreach ( $icons->glyphs as $glyph ) {
			$icons_output[] = $icons->css_prefix_text . $glyph->css;
		}

		return $icons_output;
	}
}

if ( ! function_exists( 'thb_get_current_locale' ) ) {
	/**
	 * Get the current locale. Supports WPML, Polylang and qTranslate.
	 *
	 * @return string
	 */
	function thb_get_current_locale() {
		$locale = WPLANG;

		if( defined( 'ICL_LANGUAGE_CODE' ) ) {
			$locale = get_locale();
		}
		elseif ( function_exists( 'pll_current_language' ) ) {
			$locale = pll_current_language( 'locale' );
		}
		elseif ( defined( 'QT_SUPPORTED_WP_VERSION' ) ) {
			global $q_config;
			$locale = $q_config['locale'][$q_config['language']];
		}

		return $locale;
	}
}

if ( ! function_exists( 'thb_is_translation_enabled' ) ) {
	/**
	 * Check if a translation plugin is active.
	 *
	 * @return boolean
	 */
	function thb_is_translation_enabled() {
		return defined( 'ICL_LANGUAGE_CODE' ) || function_exists( 'pll_current_language' ) || defined( 'QT_SUPPORTED_WP_VERSION' );
	}
}

if ( ! function_exists( 'thb_modal_content' ) ) {
	/**
	 * Load the content of a modal.
	 */
	function thb_modal_content() {
		if ( empty( $_POST ) || ! isset( $_POST['slug'] ) ) {
			die();
		}

		$data = isset( $_POST['data'] ) ? $_POST['data'] : array();
		$slug = $_POST['slug'];
		$modal = thb_theme()->getAdmin()->getModal( $slug );

		if ( $modal ) {
			$modal_tabs = $modal->getTabs();

			echo '<div class="thb-tabs" data-open="0">';
				if ( $modal_tabs->size() > 1 ) {
					echo '<ul class="thb-modal-tabs-nav thb-tabs-nav">';
						foreach ( $modal_tabs as $tab ) {
							if ( $tab->getContainers()->size() > 0 ) {
								printf( '<li class="%s"><a href="#thb-modal-tab-%s">%s</a></li>', $tab->getNavClass(), $tab->getSlug(), $tab->getTitle() );
							}
						}
					echo '</ul>';
				}

				echo '<div class="thb-modal-tabs thb-tabs-contents">';
					foreach ( $modal_tabs as $tab ) {
						if ( $tab->getContainers()->size() > 0 ) {
							$tab->render( $data );
						}
					}
				echo '</div>';
			echo '</div>';
		}

		die();
	}
}

if ( ! function_exists( 'thb_system_require_config' ) ) {
	/**
	 * Require a configuration file. Attempts to load the child theme's file first.
	 *
	 * @param string $file
	 */
	function thb_system_require_config( $file ) {
		$path = locate_template( 'config/' . $file );

		if ( ! empty( $path ) ) {
			require_once $path;
		}
	}
}

if ( ! function_exists( 'thb_compress_frontend_scripts' ) ) {
	/**
	 * Check if frontend scripts need to be compressed and minified.
	 *
	 * @return boolean
	 */
	function thb_compress_frontend_scripts() {
		$compress = thb_get_option( 'compress_frontend_scripts' ) == '1';

		return apply_filters( 'thb_compress_frontend_scripts', $compress );
	}
}

if( !function_exists('thb_blog_page_notice') ) {
	/**
	 * Add a notice to pages set as "Posts page" from the Reading Settings, since
	 * metabox options won't work in that setup.
	 */
	function thb_blog_page_notice() {
		$id = thb_get_admin_entry_ID();

		if ( ! empty( $id ) && $id == get_option( 'page_for_posts' ) ) {
			?>
			<div class="error">
			    <p>
			    	<?php
			    		printf( '<strong>This page has been set as "Posts page" from the <a href="%s">Reading Settings</a></strong>. Please note that page options will not be applied in this setup. You can set the "Posts page" to blank in order to restore the page options functionality.', admin_url( 'options-reading.php' ) );
			    	?>
			    </p>
			</div>
			<?php
		}
	}

	add_action( 'admin_notices', 'thb_blog_page_notice' );
}

if ( ! function_exists( 'thb_system_is_version' ) ) {
	/**
	 * Check if the WordPress installation is equal or subsequent to the specified one.
	 *
	 * @param string $version
	 * @return boolean
	 */
	function thb_system_is_version( $version ) {
		global $wp_version;

		return version_compare( $wp_version, $version, '>=' );
	}
}

/**
 * Get the defined responsive breakpoints for the theme.
 *
 * @return array
 */
function thb_responsive_breakpoints() {
	return apply_filters( 'thb_responsive_breakpoints', array() );
}

/**
 * Strip script tags from an HTML string.
 *
 * @param string $html
 * @return string
 */
function thb_strip_scripts( $html ) {
	$html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

	return $html;
}