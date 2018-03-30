<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * General methods to be used in custom post types class
 *
 * @author		Bob Ulusoy
 * @copyright	Artbees LTD (c)
 * @link		http://artbees.net
 * @since		Version 1.0
 * @package 	artbees
 */

class Mk_Post_Type_Helpers
{
    
    /** 
     * Beautifies a string. Capitalize words and remove underscores
     *
     * @param 	string 			$string
     * @return 	string
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    static function beautify($string) {
        $letters = array(
            '-',
            '_'
        );
        return apply_filters('abb_beautify', ucwords(str_replace($letters, ' ', $string)));
    }
    
    /**
     * Uglifies a string. replace dash to underline and removes strange keyworks
     *
     * @param 	string 			$string
     * @return 	string
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    static function uglify($string) {
        return apply_filters('abb_uglify', sanitize_title($string));
    }
    
    /**
     * Converts first char of the string to upper letter
     *
     * @param 	string 			$string
     * @return 	string
     *
     * @author 	Maki
     * @since 	1.0
     *
     */
    static function upper_first($string) {
        return strtoupper($string[1]);
    }
    
    /**
     * Turns a hyphen-separated strings into CamelCase
     *
     * @param 	string 			$string
     * @return 	string
     *
     * @author 	Maki
     * @since 	1.0
     *
     */
    static function camel_case($str) {
        if (version_compare(phpversion() , '5.3', '>=')) {
            return preg_replace_callback('/-(.?)/', function ($string) {
                return strtoupper($string[1]);
            }
            , $str);
        } 
        else {
            return preg_replace("/\-(.)/e", "strtoupper('\\1')", $str);
        }
    }
    
    /**
     * Makes a word plural
     *
     * @param 	string 			$string
     * @return 	string
     *
     * @author 	Bob Ulusoy
     * @since 	1.0
     *
     */
    static function pluralize($string) {
        $plural = array(
            array(
                '/(quiz)$/i',
                "$1zes"
            ) ,
            array(
                '/^(ox)$/i',
                "$1en"
            ) ,
            array(
                '/([m|l])ouse$/i',
                "$1ice"
            ) ,
            array(
                '/(matr|vert|ind)ix|ex$/i',
                "$1ices"
            ) ,
            array(
                '/(x|ch|ss|sh)$/i',
                "$1es"
            ) ,
            array(
                '/([^aeiouy]|qu)y$/i',
                "$1ies"
            ) ,
            array(
                '/([^aeiouy]|qu)ies$/i',
                "$1y"
            ) ,
            array(
                '/(hive)$/i',
                "$1s"
            ) ,
            array(
                '/(?:([^f])fe|([lr])f)$/i',
                "$1$2ves"
            ) ,
            array(
                '/sis$/i',
                "ses"
            ) ,
            array(
                '/([ti])um$/i',
                "$1a"
            ) ,
            array(
                '/(buffal|tomat)o$/i',
                "$1oes"
            ) ,
            array(
                '/(bu)s$/i',
                "$1ses"
            ) ,
            array(
                '/(alias|status)$/i',
                "$1es"
            ) ,
            array(
                '/(octop|vir)us$/i',
                "$1i"
            ) ,
            array(
                '/(ax|test)is$/i',
                "$1es"
            ) ,
            array(
                '/s$/i',
                "s"
            ) ,
            array(
                '/$/',
                "s"
            )
        );
        
        $irregular = array(
            array(
                'move',
                'moves'
            ) ,
            array(
                'sex',
                'sexes'
            ) ,
            array(
                'child',
                'children'
            ) ,
            array(
                'man',
                'men'
            ) ,
            array(
                'person',
                'people'
            )
        );
        
        $uncountable = array(
            'sheep',
            'fish',
            'series',
            'species',
            'money',
            'rice',
            'information',
            'equipment'
        );
        
        // Save time if string in uncountable
        if (in_array(strtolower($string) , $uncountable)) return apply_filters('abb_pluralize', $string);
        
        // Check for irregular words
        foreach ($irregular as $noun) {
            if (strtolower($string) == $noun[0]) return apply_filters('abb_pluralize', $noun[1]);
        }
        
        // Check for plural forms
        foreach ($plural as $pattern) {
            if (preg_match($pattern[0], $string)) return apply_filters('abb_pluralize', preg_replace($pattern[0], $pattern[1], $string));
        }
        
        // Return if noting found
        return apply_filters('abb_pluralize', $string);
    }
    
    /**
     * Returns Current Page URL
     *
     *
     */
    static function current_page_url() {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"])) {
            if ($_SERVER["HTTPS"] == "on") {
                $pageURL.= "s";
            }
        }
        $pageURL.= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL.= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } 
        else {
            $pageURL.= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }
}
