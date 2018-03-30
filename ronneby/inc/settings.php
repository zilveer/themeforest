<?php
/*Depticated*/
if ( ! defined( 'ABSPATH' ) ) { exit; }

class DfdThemeSettings {

	private static $_instance;
	private static $_settings;
	private static $_default_settings;

	private function __construct() {}

	private function __clone() {}

	private function __wakeup() {}

	public static function getInstance() {
		if (!defined('DFD_THEME_SETTINGS_NAME')) {
			throw new Exception('"DFD_THEME_SETTINGS_NAME" is not defined');
		}
		
		if (empty(self::$_instance)) {
			self::$_instance = new self();
		}
		
		if (empty(self::$_settings)) {
			self::$_settings = get_option(DFD_THEME_SETTINGS_NAME);
		}
		
		if (empty(self::$_default_settings)) {
			self::$_default_settings = self::_set_default_options();
		}
		
		return self::$_instance;
	}
	
	public static function reloadInstance() {
		self::$_settings = null;
		self::getInstance();
	}
	
	private static function _set_default_options() {
		$out = null;
		
		if (!function_exists('setup_framework_options')) {
			return null;
		}
		
		$sections = setup_framework_options(true);
		
		foreach ($sections as $sections) {
			if (empty($sections['fields'])) {
				continue;
			}
			
			foreach ($sections['fields'] as $field) {
				if (!isset($field['std'])) {
					continue;
				}

				$out[$field['id']] = $field['std'];
			}
		}
		
		return $out;
	}
	
	public static function get($option) {
		if (empty($option)) {
			return NULL;
		}
		
		if (isset(self::$_settings[$option])) {
			return self::$_settings[$option];
		} elseif (
			!isset(self::$_settings[$option]) &&
			isset(self::$_default_settings[$option]))
		{
			return self::$_default_settings[$option];
		} else {
			return null;
		}
	}

}

class DfdMetaBoxSettings {
	
	public static function get($name) {
		global $post;
		
		if (isset($post) && !empty($post->ID)) {
			return get_post_meta($post->ID, $name, true);
		}
		
		return false;
	}
	
	public static function compared($name, $default) {
		global $dfd_ronneby;
		
		$value = self::get($name);
		if($value) {
			return $value;
		} elseif(!$value && isset($dfd_ronneby[$name]) && !empty($dfd_ronneby[$name])) {
			return $dfd_ronneby[$name];
		} else {
			return $default;
		}
	}
}
