<?php
/**
 * Created by PhpStorm.
 * User: duonglh
 * Date: 8/23/14
 * Time: 3:01 PM
 */

function g5plus_generate_less()
{
    try{
        global $g5plus_options;
	    $g5plus_options = get_option('g5plus_handmade_options');
	    if ( ! defined( 'FS_METHOD' ) ) {
		    define('FS_METHOD', 'direct');
	    }
        $home_preloader =  $g5plus_options['home_preloader'];
        $css_variable = g5plus_custom_css_variable();
        $custom_css = g5plus_custom_css();

        if (!class_exists('Less_Parser')) {
            require_once THEME_DIR . 'g5plus-framework/less/Autoloader.php';
            Less_Autoloader::register();
        }
        $parser = new Less_Parser(array( 'compress'=>true ));

        $parser->parse($css_variable);
        $parser->parseFile( THEME_DIR . 'assets/css/less/style.less' );

        if ($home_preloader != 'none' && !empty($home_preloader)) {
            $parser->parseFile( THEME_DIR . 'assets/css/less/loading/'.$home_preloader.'.less' );
        }

        if ( isset($g5plus_options['panel_selector']) && ($g5plus_options['panel_selector'] == 1)) {
            $parser->parseFile( THEME_DIR . 'assets/css/less/panel-style-selector.less' );
        }

        $parser->parse($custom_css);
        $css = $parser->getCss();

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WP_Filesystem();
        global $wp_filesystem;

        if (!$wp_filesystem->put_contents( THEME_DIR.   "style.min.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','g5plus-handmade')
            );
        }

        $theme_info = $wp_filesystem->get_contents( THEME_DIR . "theme-info.txt" );

        $parser = new Less_Parser();
        $parser->parse($css_variable);
        $parser->parseFile(THEME_DIR . 'assets/css/less/style.less');
        if ($home_preloader != 'none' && !empty($home_preloader)) {
            $parser->parseFile( THEME_DIR . 'assets/css/less/loading/'.$home_preloader.'.less' );
        }

        if ( isset($g5plus_options['panel_selector']) && ($g5plus_options['panel_selector'] == 1)) {
            $parser->parseFile( THEME_DIR . 'assets/css/less/panel-style-selector.less' );
        }


        $parser->parse($custom_css);
        $css = $parser->getCss();

        $css = $theme_info . "\n" . $css;
	    $css = str_replace("\r\n","\n", $css);

        if (!$wp_filesystem->put_contents( THEME_DIR.   "style.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','g5plus-handmade')
            );
        }

        return array(
            'status' => 'success',
            'message' => ''
        );

    }catch(Exception $e){
        $error_message = $e->getMessage();
        return array(
            'status' => 'error',
            'message' => $error_message
        );
    }
}