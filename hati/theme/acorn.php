<?php

/**
 * Alaja Core Nesting Class
 * 
 * @package   Theme Framework
 * @author    alaja <support@alaja.info>
 * @copyright 2013 The authors
 */

class Acorn {
  
  static function setup () {

    # preparation
    $ct = wp_get_theme();

    # core names
    define( 'A_THEME_NAME', $ct['Name'] );
    define( 'A_THEME_KEY', self::strToID(A_THEME_NAME) );
    
    # theme options
    define( 'A_THEME_OPTIONS_ID', 'a_'. A_THEME_KEY .'_options' );

    # theme version
    define( 'A_THEME_VER', ( $ct['Version'] ) ? $ct['Version'] : 1.0 );

    # dirs & urls
    define( 'A_DIR', get_template_directory() );
    define( 'A_URL', get_template_directory_uri() );

    # theme
    define( 'A_THEME',    A_DIR . '/theme' );
    define( 'A_THEME_URL',  A_URL . '/theme' );

    # 3rd parties
    define( 'A_3RD',    A_DIR . '/3rd' );
    define( 'A_3RD_URL',  A_URL . '/3rd' );

    # upload dir & url
    $upload_dir = wp_upload_dir();
    define( 'A_UPLOAD',   $upload_dir['basedir'] );
    define( 'A_UPLOAD_URL', $upload_dir['baseurl'] );

    # custom css
    define( 'A_CUSTOM_CSS',   A_DIR .'/custom.css' );
    define( 'A_CUSTOM_CSS_URL', A_URL .'/custom.css' );

    # text domain
    define( 'A_DOMAIN', 'translateme' );
  }

  static function log ( $msg ) {
    
    if ( WP_DEBUG !== true ) return;

    foreach( func_get_args() as $msg ) {
      if ( is_array($msg) || is_object($msg) ) {
        error_log(print_r($msg, true));
      } else if ( is_bool($msg) ) {
        error_log( var_export($msg, true) );
      } else {
        error_log($msg);
      }
    }
  }

  static function get ( $key, $default = false, $defaultOnEmpty = true ) {

    if ( function_exists( 'of_get_option' ) ) {
      $option = of_get_option ($key, $default);
      return ($defaultOnEmpty && !$option) ? $default : $option;
    }

    return $default;
  }

  static function eget ( $key, $default = false, $defaultOnEmpty = true ) {
    echo self::get( $key, $default, $defaultOnEmpty );
  }

  static function getm ( $key, $default = false ) {

    global $post;
    if (!$post) return $default;

    $meta = get_post_meta( $post->ID, $key, true );
    return ($meta) ? $meta : $default;
  }
  
  static function egetm ( $key, $default = false ) {
    echo self::getm( $key, $default );
  }

  static function replaceConstants ( $str, $invert = false ) {

    $search = array( '{{A_DIR}}', '{{A_URL}}' );
    $replace = array( A_DIR, A_URL );
    
    return ($invert) ? 
      str_replace( $replace, $search, $str ):
      str_replace( $search, $replace, $str );
  }

  static function strToID ( $str ) {

    $id = preg_replace( "/[^a-zA-Z0-9\/_|+ -]/", '', $str );
    $id = strtolower(trim( $id, '-' ));
    $id = preg_replace( "/[\/_|+ -]+/", '-', $id );

    return $id;
  }

  static function strToLowerCamelcase ( $str ) {

    $str = trim( $str );
    $str = preg_replace( '/ (.?)/e', "strtoupper('$1')", $str );

    return $str;
  }

  static function argsToAttr ( $args, $prefix = '', $emptyAttrs = false ) {

    if ( is_string( $args ) ) $args = str_replace( ',', '&', $args );
    $args = wp_parse_args( $args );

    $attr = '';
    if ( count( $args ) > 0 ) {
      foreach ($args as $key => $val) {
        if ($val) $attr .= " {$prefix}{$key}=\"{$val}\"";
        elseif ($emptyAttrs) $attr .= " {$prefix}{$key}";
      }
    }
    return $attr;
  }
}

Acorn::setup();
