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
 * Adds new fonts from the Google API
 */
function my_add_google_fonts( $manager ) {
    $manager->add_font( new G1_Google_API_Font(
        'google_abel',          // unique identificator
        array(
            'name'	=> 'Abel'   // the name of the font
    )));
}
add_action( 'g1_font_manager_register', 'my_add_google_fonts' );