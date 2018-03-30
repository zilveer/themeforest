<?php
if (!defined('_PREFIX_')) {
	die('Direct access fobidden');
}

class PGL_Loader
{
	function __construct()
	{	
	}
	
	static function find($name, $prefix = '')
	{
		if (!defined('PGL_PATH')) {
			define('PGL_PATH', str_replace('\\', '/', get_template_directory()) . '/');
		}
		$include_dir = PGL_PATH . '/inc/';
		$name = str_replace('\\', '/', $name);
		if ($prefix) {
			$name = explode('/', $name);
			$k = key(end($name));
			$name[$k] = $prefix . '-' . $name[$k];
			$name = implode('/', $name);
		}
		if (!PGL_Utilities::endsWith($name, '.php')) {
			$name = $name . '.php';
		}
		$file = $include_dir . $name;
		if (file_exists($file)) {
			include $file;
		} else {
			error_log('Cannot find ' . $name);
		}
	}
	
	static function find_class($class_name, $prefix = _PREFIX_, $dir = '')
	{
		if ($dir && !PGL_Utilities::endsWith($dir, '/')) {
			$dir.= '/';
		}
		self::find(strtolower($dir . $class_name));
		if ($prefix) {
			$class_name = $prefix . $class_name;
		}
		if (!class_exists($class_name)) {
			//pgl_to_do use try /catch instead of die()
			//			die( 'Cannot find class ' . $class_name );
			return false;
		} else {
			return true;
		}
	}
}