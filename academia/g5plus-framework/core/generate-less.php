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
	    $g5plus_options = &G5Plus_Global::get_options();
	    $g5plus_options = get_option('g5plus_academia_options');
	    if ( ! defined( 'FS_METHOD' ) ) {
		    define('FS_METHOD', 'direct');
	    }


        $loading_animation = isset($g5plus_options['loading_animation']) ? $g5plus_options['loading_animation'] : 'none';
        $css_variable = g5plus_custom_css_variable();
        $custom_css = g5plus_custom_css();

        if (!class_exists('Less_Parser')) {
            require_once G5PLUS_THEME_DIR . 'g5plus-framework/less/Less.php';
        }
        $parser = new Less_Parser(array( 'compress'=>true ));

        $parser->parse($css_variable);
        $parser->parseFile( G5PLUS_THEME_DIR . 'assets/css/less/style.less' );

        if ($loading_animation != 'none' && !empty($loading_animation)) {
            $parser->parseFile( G5PLUS_THEME_DIR . 'assets/css/less/loading/'.$loading_animation.'.less' );
        }

        $parser->parse($custom_css);
        $css = $parser->getCss();

        require_once(ABSPATH . 'wp-admin/includes/file.php');
        WP_Filesystem();
        global $wp_filesystem;

        if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "style.min.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','g5plus-academia')
            );
        }

        $theme_info = $wp_filesystem->get_contents( G5PLUS_THEME_DIR . "theme-info.txt" );

        $parser = new Less_Parser();
        $parser->parse($css_variable);
        $parser->parseFile(G5PLUS_THEME_DIR . 'assets/css/less/style.less');
        if ($loading_animation != 'none' && !empty($loading_animation)) {
            $parser->parseFile( G5PLUS_THEME_DIR . 'assets/css/less/loading/'.$loading_animation.'.less' );
        }


        $parser->parse($custom_css);
        $css = $parser->getCss();

        $css = $theme_info . "\n" . $css;
	    $css = str_replace("\r\n","\n", $css);

        if (!$wp_filesystem->put_contents( G5PLUS_THEME_DIR.   "style.css", $css, FS_CHMOD_FILE)) {
            return array(
                'status' => 'error',
                'message' => esc_html__('Could not save file','g5plus-academia')
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