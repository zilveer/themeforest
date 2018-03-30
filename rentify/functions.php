<?php
/**
* @package WordPress
* @subpackage simplebuilder
* @since 1.0
*/


/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once( get_template_directory() . '/framework/functions.php' );


function rentify_option_data(){
  global $rentify_option_data;
  return $rentify_option_data;
}


if(!function_exists('_log')){
  function _log( $message ) {
    if( WP_DEBUG === true ){
      if( is_array( $message ) || is_object( $message ) ){
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}
