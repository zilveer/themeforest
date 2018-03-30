<?php

/**
 * This is the main class that initializes all the functionality needed for the theme.
 * @author Pexeto
 *
 */
class PexetoFunctionsManager{
	
	public $pexeto_sidebars=array();
	public $pexeto_footer_sidebars=array();
	public $pexeto_slider_data=array();
	
	/**
	 * Inits all the main methods.
	 */
	public function init(){
		$this->define_constants();
		$this->load_files();
	}
	
	/**
	 * Defines all the constants that will be used within the theme.
	 */
	public function define_constants(){
		//main theme info constants
		define("PEXETO_THEMENAME", 'HighLight');
		define("PEXETO_SHORTNAME", 'highlight');
		$theme_data = wp_get_theme();
		define("PEXETO_VERSION", $theme_data->Version);
		
		//define the main paths and URLs
		define("PEXETO_LIB_PATH", TEMPLATEPATH . '/lib/');
		define("PEXETO_LIB_URL", get_template_directory_uri().'/lib/');
		
		define("PEXETO_FUNCTIONS_PATH", PEXETO_LIB_PATH . 'functions/');
		define("PEXETO_FUNCTIONS_URL", PEXETO_LIB_URL.'functions/');
		define("PEXETO_CLASSES_PATH", PEXETO_LIB_PATH.'classes/');
		define("PEXETO_OPTIONS_PATH", PEXETO_LIB_PATH.'options/');
		define("PEXETO_PLUGINS_PATH", PEXETO_LIB_PATH.'plugins/');
		define("PEXETO_UTILS_URL", PEXETO_LIB_URL.'utils/');
		define("PEXETO_TIMTHUMB_URL", PEXETO_UTILS_URL.'timthumb.php');
		
		define("PEXETO_IMAGES_URL", PEXETO_LIB_URL.'images/');
		define("PEXETO_CSS_URL", PEXETO_LIB_URL.'css/');
		define("PEXETO_SCRIPT_URL", PEXETO_LIB_URL.'script/');
		define("PEXETO_PATTERNS_URL", PEXETO_IMAGES_URL.'pattern_samples/');
		$uploadsdir=wp_upload_dir();
		define("PEXETO_UPLOADS_URL", $uploadsdir['url']);
		
		//other constants
		define("PEXETO_PORTFOLIO_POST_TYPE", 'portfolio');
		define("PEXETO_SEPARATOR", '|*|');
	}
	
	/**
	 * Loads all the needed files
	 */
	public function load_files(){
		require_once (PEXETO_LIB_PATH.'utils/aq_resizer.php');  //image resizing script
		require_once (PEXETO_FUNCTIONS_PATH.'general.php');  //some main common functions
		require_once (PEXETO_FUNCTIONS_PATH.'sidebars.php');  //the sidebar functionality
		if ( isset($_GET['page']) && $_GET['page'] == 'options' ){
			require_once (PEXETO_CLASSES_PATH.'pexeto-options-manager.php');  //the theme options manager functionality
		}
		require_once (PEXETO_FUNCTIONS_PATH.'options.php');  //the theme options functionality
		require_once (PEXETO_FUNCTIONS_PATH.'portfolio.php');  //portfolio functionality
		require_once (PEXETO_FUNCTIONS_PATH.'comments.php');  //the comments functionality
		
		if(is_admin()){
			require_once (PEXETO_FUNCTIONS_PATH.'meta.php');  //adds the custom meta fields to the posts and pages
		}
		require_once (PEXETO_FUNCTIONS_PATH.'shortcodes.php');  //the shortcodes functionality
		require_once (PEXETO_LIB_PATH.'utils/upload-handler.php');
	}
	

}