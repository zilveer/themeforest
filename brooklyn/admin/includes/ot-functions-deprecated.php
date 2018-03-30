<?php if ( ! defined( 'OT_VERSION' ) ) exit( 'No direct script access allowed' );
/**
 * OptionTree deprecated functions
 *
 * @package   OptionTree
 * @author    Derek Herman <derek@valendesigns.com>
 * @copyright Copyright (c) 2013, Derek Herman
 * @since     2.0
 */

/**
 * Custom stripslashes from single value or array.
 *
 * @param       mixed $input
 * @return      mixed
 *
 * @access      public
 * @since       1.1.3
 * @deprecated  2.0
 */
if ( ! function_exists( 'option_tree_stripslashes' ) ) {

  function option_tree_stripslashes( $input ) {
    if ( is_array( $input ) ) {
      foreach( $input as &$val ) {
        if ( is_array( $val ) ) {
          $val = option_tree_stripslashes( $val );
        } else {
          $val = stripslashes( $val );
        }
      }
    } else {
      $input = stripslashes( $input );
    }
    return $input;
  }

}

/* End of file ot-functions-deprecated.php */
/* Location: ./includes/ot-functions-deprecated.php */