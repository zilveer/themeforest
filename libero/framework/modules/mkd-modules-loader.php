<?php

if(!function_exists('libero_mikado_load_modules')) {
    /**
     * Loades all modules by going through all folders that are placed directly in modules folder
     * and loads load.php file in each. Hooks to libero_mikado_after_options_map action
     *
     * @see http://php.net/manual/en/function.glob.php
     */
    function libero_mikado_load_modules() {
        foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/modules/*/load.php') as $module_load) {
            include_once $module_load;
        }
    }

    add_action('libero_mikado_before_options_map', 'libero_mikado_load_modules');
}

if(!function_exists('libero_mikado_load_shortcode_interface')) {

    function libero_mikado_load_shortcode_interface() {

        include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/shortcodes/lib/shortcode-interface.php';

    }

    add_action('libero_mikado_before_options_map', 'libero_mikado_load_shortcode_interface');

}

if(!function_exists('libero_mikado_load_shortcodes')) {
    /**
     * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
     * and loads load.php file in each. Hooks to libero_mikado_after_options_map action
     *
     * @see http://php.net/manual/en/function.glob.php
     */
    function libero_mikado_load_shortcodes() {
        foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/modules/shortcodes/*/load.php') as $shortcode_load) {
            include_once $shortcode_load;
        }

        include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/shortcodes/lib/shortcode-loader.inc';
    }

    add_action('libero_mikado_before_options_map', 'libero_mikado_load_shortcodes');
}

if(!function_exists('libero_mikado_load_widget_class')) {
	 /**
     * Loades widget class file. 
     *
     */
	function libero_mikado_load_widget_class(){
		include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/widgets/lib/widget-class.php';
	} 
	
	add_action('libero_mikado_before_options_map', 'libero_mikado_load_widget_class');
}

if(!function_exists('libero_mikado_load_widgets')) {
    /**
     * Loades all widgets by going through all folders that are placed directly in widgets folder
     * and loads load.php file in each. Hooks to libero_mikado_after_options_map action
     */
    function libero_mikado_load_widgets() {
		
        foreach(glob(MIKADO_FRAMEWORK_ROOT_DIR.'/modules/widgets/*/load.php') as $widget_load) {
            include_once $widget_load;
        }

        include_once MIKADO_FRAMEWORK_MODULES_ROOT_DIR.'/widgets/lib/widget-loader.php';
    }

    add_action('libero_mikado_before_options_map', 'libero_mikado_load_widgets');
}