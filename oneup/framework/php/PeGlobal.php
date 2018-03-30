<?php

class PeGlobal {
	public static $controller;
	public static $config;
	public static $const;
	public static $data;

	public static function loader($class) {
		if (strpos($class,"PeThemeMetaBox") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/MetaBox/$class.php")) {
					require("$location/MetaBox/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeFormElement") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/FormElement/$class.php")) {
					require("$location/FormElement/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeShortcode") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/ShortCode/$class.php")) {
					require("$location/ShortCode/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeConstant") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/Constant/$class.php")) {
					require("$location/Constant/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeWidget") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/Widget/$class.php")) {
					require("$location/Widget/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeViewLayoutModule") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/View/LayoutModule/$class.php")) {
					require("$location/View/LayoutModule/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeThemeView") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/View/$class.php")) {
					require("$location/View/$class.php");
					return true;
				}
			}
		} elseif (strpos($class,"PeTheme") === 0) {
			foreach (PeGlobal::$config["classPath"] as $location) {
				if (file_exists("$location/$class.php")) {
					require("$location/$class.php");
					return true;
				}
			}
		} else {
			foreach (PeGlobal::$config["libPath"] as $location) {
				if (file_exists("$location/$class.php")) {
					require("$location/$class.php");
					return true;
				}
			}
		}
		return false;
	}

	public static function init() {
		if (!isset(PeGlobal::$const)) {
			if (function_exists("spl_autoload_register")) {
				spl_autoload_register(array("PeGlobal","loader"));
			} else {
				function __autoload($class) {
					PeGlobal::loader($class);
				}
			}
			PeGlobal::$const = new PeThemeConst();
		}
	}

}

?>