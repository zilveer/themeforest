<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Pages_Module
 * @since G1_Pages_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

require_once( trailingslashit( dirname(__FILE__) ) . 'lib/functions.php' );


add_theme_support( 'post-thumbnails', array( 'page' ) );


/**
 * Quasi-singleton for our module
 *
 * @return G1_Pages_Module
 */
function G1_Pages_Module() {
    static $instance;

    if ( ! isset( $instance ) )
        $instance = new G1_Pages_Module();

    return $instance;
}
// Fire in the hole :)
G1_Pages_Module();


require_once( trailingslashit ( dirname(__FILE__) ) . 'lib/shortcodes.php' );
