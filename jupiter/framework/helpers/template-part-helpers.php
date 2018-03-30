<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Helper functions for get views part of the template
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */



/**
 * Get template parts from views folder
 * @param string    $slug
 * @param string    $name
 * @param boolean   $return
 * @return object
 *
 */
if (!function_exists('mk_get_view')) {
    function mk_get_view($slug, $name = '', $return = false, $view_params = array()) {
        if ($return) {
            ob_start();
            mk_get_template_part('views/' . $slug . '/' . $name, $view_params);
            return ob_get_clean();
        } 
        else {
            mk_get_template_part('views/' . $slug . '/' . $name, $view_params);
        }
    }
}

/**
 * Get header components and put them together. this function passes variables into the file too.
 * @param string    $slug
 * @param string    $name
 * @param boolean   $return
 * @return object
 *
 */
if (!function_exists('mk_get_header_view')) {
    function mk_get_header_view($location, $component, $view_params = array() , $return = false) {
        if ($return) {
            ob_start();
            mk_get_template_part('views/header/' . $location . '/' . $component, $view_params);
            return ob_get_clean();
        } 
        else {
            mk_get_template_part('views/header/' . $location . '/' . $component, $view_params);
        }
    }
}

/**
 * Get template parts from shortcodes folder
 * @param string    $slug
 * @param string    $name
 * @param boolean   $return
 * @return object
 *
 */
if (!function_exists('mk_get_shortcode_view')) {
    function mk_get_shortcode_view($shortcode_name, $name = '', $return = false, $view_params = array()) {
        if ($return) {
            ob_start();
            mk_get_template_part('components/shortcodes/' . $shortcode_name . '/' . $name, $view_params);
            return ob_get_clean();
        } 
        else {
            mk_get_template_part('components/shortcodes/' . $shortcode_name . '/' . $name, $view_params);
        }
    }
}

/**
 * Get template parts from Control Panel
 * @param string    $slug
 * @param string    $name
 * @param boolean   $return
 * @return object
 *
 */
if (!function_exists('mk_get_control_panel_view')) {
    function mk_get_control_panel_view($name = '', $return = false, $view_params = array()) {
        if ($return) {
            ob_start();
            mk_get_template_part('framework/admin/control-panel/views/' . $name, $view_params);
            return ob_get_clean();
        } 
        else {
            mk_get_template_part('framework/admin/control-panel/views/' . $name, $view_params);
        }
    }
}

/**
 * Like get_template_part() put lets you pass args to the template file
 * Args are available in the tempalte as $view_params array
 * @param string filepart
 * @param mixed wp_args style argument list
 *
 *
 * @last_update 5.0.8
 */
if (!function_exists('mk_get_template_part')) {
    function mk_get_template_part($file, $view_params = array() , $cache_args = array()) {  
        global $post;

        // security check for LFI
        if(is_numeric(strpos($file,"..")) or is_numeric(strpos($file,"./"))) {
        // if someone tries to reach parent directories
            echo "Bad method! Code: GP-113";
            die;
        }

        // die if file does not exists in the template or child theme directory.
        if (file_exists(get_stylesheet_directory() . '/' . $file . '.php')) {
            $file = get_stylesheet_directory() . '/' . $file . '.php';
        } else if (file_exists(get_template_directory() . '/' . $file . '.php')) {
            $file = get_template_directory() . '/' . $file . '.php';
        } else {
            echo "Bad method! Code: GP-123! $file file is missing!";
            die;
        }

        $view_params = wp_parse_args($view_params);
        $cache_args = wp_parse_args($cache_args);
        if ($cache_args) {
            foreach ($view_params as $key => $value) {
                if (is_scalar($value) || is_array($value)) {
                    $cache_args[$key] = $value;
                } 
                else if (is_object($value) && method_exists($value, 'get_id')) {
                    $cache_args[$key] = call_user_func(array($value, 'get_id')); //call_user_method('get_id', $value);
                }
            }
            if (($cache = wp_cache_get($file, serialize($cache_args))) !== false) {
                if (!empty($view_params['return'])) return $cache;
                echo $cache;
                return;
            }
        }
        $file_handle = $file;
        do_action('start_operation', 'mk_template_part::' . $file_handle);
        ob_start();
        $return = require ($file);
        $data = ob_get_clean();
        do_action('end_operation', 'mk_template_part::' . $file_handle);
        if ($cache_args) {
            wp_cache_set($file, $data, serialize($cache_args) , 3600);
        }
        if (!empty($view_params['return'])) if ($return === false) return false;
        else return $data;
        echo $data;
    }
}