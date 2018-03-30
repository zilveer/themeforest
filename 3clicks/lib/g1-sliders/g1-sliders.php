<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Sliders_Module
 * @since G1_Sliders_Module 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

require_once( dirname(__FILE__) . '/functions.php' );

function G1_Sliders_Module() {
    static $instance;

    if ( !isset( $instance ) )
        $instance = new G1_Sliders_Module();

    return $instance;
}
// Fire in the hole :)
G1_Sliders_Module();