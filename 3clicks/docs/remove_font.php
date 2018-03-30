<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Examples
 * @since G1_Examples 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

/**
 * Removes new font-face fonts
 */
function my_remove_fonts( $manager ) {
    // remove by unique identificator
    $manager->remove_font( 'fontface_lato_light' );
}
add_action( 'g1_font_manager_register', 'my_remove_fonts' );