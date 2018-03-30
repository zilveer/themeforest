<?php

class PGL_Theme {
	public $core_classes = array(
		'Feature',
		'Hook',
		'Filter',
		'Template_Tag',
		'Asset',
		'Widget',
		'Shortcodes'
	);

	function __construct() {
		/**
		 * Load core class
		 * Load hooks
		 * Load filters
		 * Load theme options
		 * Load features
		 */
		$this->load_core_classes();
		$this->init();

	}

	function load_core_classes() {
		foreach ( $this->core_classes as $class ) {
			PGL_Loader::find_class( $class, _PREFIX_ );
		}
	}

	function init() {
		foreach ( $this->core_classes as $class ) {
			$class = _PREFIX_ . $class;
			call_user_func( array( $class, 'init' ) );
		}
		PGL_Loader::find_class( 'options', _PREFIX_ );
		/**
		 * @var PGL_Options $pgl_options
		 */
		global $pgl_options;
		$pgl_options = new PGL_Options();
		$this->load_addons();
	}

	function load_addons() {
		/**
		 * @var PGL_Options $pgl_options
		 */
		// global $pgl_options;
		$addon_files = PGL_Utilities::list_file( 'inc/addons' );
		foreach( $addon_files as $k => $af ) {
			include_once PGL_PATH . 'inc/addons/' . $k . '.php';
			$className = 'PGL_Addon_' . $k;
			if ( class_exists($className) && is_callable(array($className, 'init')) ) {
				call_user_func(array($className, 'init'), $this);
			}
		}
	}
}