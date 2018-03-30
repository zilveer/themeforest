<?php
if (!defined('THEME_FRAMEWORK'))
    exit('No direct script access allowed');

/**
 * This class will use Artbees Themes Captcha plugin to generate captcha interface.
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


class Mk_Theme_Captcha
{
    
    function __construct()
    {
        add_action('wp_ajax_nopriv_mk_create_captcha_image', array(
            &$this,
            'create_captcha_image'
        ));
        add_action('wp_ajax_mk_create_captcha_image', array(
            &$this,
            'create_captcha_image'
        ));

        add_action('wp_ajax_nopriv_mk_validate_captcha_input', array(
            &$this,
            'validate_captcha_input'
        ));
        add_action('wp_ajax_mk_validate_captcha_input', array(
            &$this,
            'validate_captcha_input'
        ));
    }
    
    
    /**
     * Check if captcha plugin is active
     *
     */
    static public function is_plugin_active()
    {
    	if(class_exists('Mk_Artbees_Captcha')) {
    		return true;
    	}
    	return false;
        
    }
    
    /**
     * Generate the captcha image
     *
     */
    public function create_captcha_image()
    {
    	if(self::is_plugin_active()) {
    		echo plugins_url( 'artbees-captcha/generate-captcha.php');
    	}

    	wp_die();
    }


    /**
     * Validates the captcha sent to the contact form.
     *
     */
    public function validate_captcha_input()
    {
        //Continue the session
        session_start();

        /** Validate captcha */
        if (!empty($_REQUEST['captcha'])) {
            if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captcha'])) != $_SESSION['captcha']) {
                $captcha_message = "Invalid captcha";
            } else {
                $captcha_message = "ok";
            }
            $request_captcha = htmlspecialchars($_REQUEST['captcha']);
            echo $captcha_message;
            wp_die();
        }
    }


}

new Mk_Theme_Captcha();