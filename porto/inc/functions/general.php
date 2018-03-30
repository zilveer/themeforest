<?php

if (!function_exists('array_insert_before')) :
    function array_insert_before($key, array &$array, $new_key, $new_value) {
        if (array_key_exists($key, $array)) {
            $new = array();
            foreach ($array as $k => $value) {
                if ($k === $key) {
                    $new[$new_key] = $new_value;
                }
                $new[$k] = $value;
            }
            return $new;
        }
        return false;
    }
endif;

if (!function_exists('array_insert_after')) :
    function array_insert_after($key, &$array, $new_key, $new_value) {
        if (array_key_exists($key, $array)) {
            $new = array();
            foreach ($array as $k => $value) {
                $new[$k] = $value;
                if ($k === $key) {
                    $new[$new_key] = $new_value;
                }
            }
            return $new;
        }
        return false;
    }
endif;

if (!function_exists('porto_add_url_parameters')):
    function porto_add_url_parameters($url, $name, $value) {
        $url_data = parse_url(str_replace('#038;', '&', $url));
        if (!isset($url_data["query"]))
            $url_data["query"]="";

        $params = array();
        parse_str($url_data['query'], $params);
        $params[$name] = $value;
        $url_data['query'] = http_build_query($params);
        return porto_build_url($url_data);
    }
endif;

if (!function_exists('porto_remove_url_parameters')):
    function porto_remove_url_parameters($url, $name) {
        $url_data = parse_url(str_replace('#038;', '&', $url));
        if (!isset($url_data["query"]))
            $url_data["query"]="";

        $params = array();
        parse_str($url_data['query'], $params);
        $params[$name] = "";
        $url_data['query'] = http_build_query($params);
        return porto_build_url($url_data);
    }
endif;

if (!function_exists('porto_build_url')):
    function porto_build_url($url_data) {
        $url="";
        if (isset($url_data['host'])) {
            $url .= $url_data['scheme'] . '://';
            if (isset($url_data['user'])) {
                $url .= $url_data['user'];
                if (isset($url_data['pass']))
                    $url .= ':' . $url_data['pass'];
                $url .= '@';
            }
            $url .= $url_data['host'];
            if (isset($url_data['port']))
                $url .= ':' . $url_data['port'];
        }
        if (isset($url_data['path']))
            $url .= $url_data['path'];
        if (isset($url_data['query']))
            $url .= '?' . $url_data['query'];
        if (isset($url_data['fragment']))
            $url .= '#' . $url_data['fragment'];

        return str_replace('#038;', '&', $url);
    }
endif;

function porto_get_blank_image() {
    return 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
}

if (!function_exists('array2json')):
    function array2json($arr) {
        if(function_exists('json_encode')) return json_encode($arr); //Lastest versions of PHP already has this functionality.
        $parts = array();
        $is_list = false;

        //Find out if the given array is a numerical array
        $keys = array_keys($arr);
        $max_length = count($arr)-1;
        if(($keys[0] == 0) and ($keys[$max_length] == $max_length)) {//See if the first key is 0 and last key is length - 1
            $is_list = true;
            for($i=0; $i<count($keys); $i++) { //See if each key correspondes to its position
                if($i != $keys[$i]) { //A key fails at position check.
                    $is_list = false; //It is an associative array.
                    break;
                }
            }
        }

        foreach($arr as $key=>$value) {
            if(is_array($value)) { //Custom handling for arrays
                if($is_list) $parts[] = array2json($value); /* :RECURSION: */
                else $parts[] = '"' . $key . '":' . array2json($value); /* :RECURSION: */
            } else {
                $str = '';
                if(!$is_list) $str = '"' . $key . '":';

                //Custom handling for multiple data types
                if(is_numeric($value)) $str .= $value; //Numbers
                elseif($value === false) $str .= 'false'; //The booleans
                elseif($value === true) $str .= 'true';
                else $str .= '"' . addslashes($value) . '"'; //All other things

                $parts[] = $str;
            }
        }
        $json = implode(',',$parts);

        if($is_list) return '[' . $json . ']';//Return numerical JSON
        return '{' . $json . '}';//Return associative JSON
    }
endif;

function porto_generate_rand() {
    $validCharacters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $rand = '';
    $length = 32;
    for ($n = 1; $n < $length; $n++) {
        $whichCharacter = rand(0, strlen($validCharacters)-1);
        $rand .= $validCharacters{$whichCharacter};
    }

    return $rand;
}

if ( ! function_exists( 'porto_is_ajax' ) ) {
    function porto_is_ajax() {

        if ( defined( 'DOING_AJAX' ) ) {
            return true;
        }

        if (function_exists('mb_strtolower')) {
            return ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && mb_strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) ? true : false;
        } else {
            return ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) ? true : false;
        }
    }
}

function porto_stringify_attributes( $attributes ) {
    $atts = array();
    foreach ( $attributes as $name => $value ) {
        $atts[] = $name . '="' . esc_attr( $value ) . '"';
    }

    return implode( ' ', $atts );
}

function porto_has_class( $class, $classes ) {
    return in_array( $class, explode( ' ', strtolower( $classes ) ) );
}

function porto_strip_tags( $content ) {
    $content = str_replace( ']]>', ']]&gt;', $content );
    $content = preg_replace("/<script.*?\/script>/s", "", $content) ? : $content;
    $content = preg_replace("/<style.*?\/style>/s", "", $content) ? : $content;
    $content = strip_tags( $content );
    return $content;
}


