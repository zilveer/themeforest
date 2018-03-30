<?php
/**
 * StagFramework
 *
 * @package StagFramework
 * @since 2.0.0
 * @version 2.0.1.2
 * @author Ram Ratan Maurya (Codestag)
 * @link https://mauryaratan.me
 * @link https://codestag.com
 * @copyright Ram Ratan Maurya (Codestag)
 */

class StagFramework{
	/** @var string Framework version. */
	public $version = '2.0.1.2';

	function __construct(){
		define( 'STAG_FRAMEWORK_VERSION', $this->version );

		if(function_exists('wp_get_theme')){
		  if(is_child_theme()){
		    $temp_obj = wp_get_theme();
		    $theme_obj = wp_get_theme( $temp_obj->get('Template') );
		  }else{
		    $theme_obj = wp_get_theme();
		  }
		  $theme_version = $theme_obj->get('Version');
		  $theme_name = $theme_obj->get('Name');
		  $theme_uri = $theme_obj->get('ThemeURI');
		  $theme_author = $theme_obj->get('Author');
		  $theme_author_uri = $theme_obj->get('AuthorURI');
		}

		define( 'STAG_THEME_NAME', $theme_name );
		define( 'STAG_THEME_VERSION', $theme_version );
		define( 'STAG_THEME_URI', $theme_uri );
		define( 'STAG_THEME_AUTHOR', $theme_author );
		define( 'STAG_THEME_AUTHOR_URI', $theme_author_uri );

		define( 'STAG_SUPPORT_URI', 'https://codestag.com/support/' );
		define( 'STAG_HOME', 'https://codestag.com' );
		define( 'STAG_DEBUG', true );
	}
}

$GLOBALS['stagFramework'] = new StagFramework();

require_once ( get_template_directory() . '/framework/stag-admin-init.php' );
