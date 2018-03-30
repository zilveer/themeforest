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
 * Adds new font-face fonts
 */
function my_add_font_face_fonts( $manager ) {
    $uri = trailingslashit( get_stylesheet_directory_uri() ) . 'css/fontface-kits/';

    // LatoLight
    $manager->add_font( new G1_Font_Face_Font(
        'fontface_lato_light',                                              // Unique identificator
        array(
            'name'	=> 'LatoLight',                                         // The name of the font
            'eot'	=> $uri . 'lato-fontfacekit/Lato-Light-webfont.eot',    // eot file source
            'woff'	=> $uri . 'lato-fontfacekit/Lato-Light-webfont.woff',   // woff file source
            'ttf'	=> $uri . 'lato-fontfacekit/Lato-Light-webfont.ttf',    // ttf file source
            'svg'	=> $uri . 'lato-fontfacekit/Lato-Light-webfont.svg',    // svg file source
        )
    ));
}
add_action( 'g1_font_manager_register', 'my_add_font_face_fonts' );