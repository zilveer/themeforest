<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Theme03
 * @subpackage G1_Fonts
 * @subpackage G1_Fonts 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php
/* PLEASE
 * Don't edit this file. Use the child theme to add new fonts.
 */

/**
 * Adds some system fonts
 *
 * @param G1_Font_Manager $manager
 */
function g1_add_some_system_fonts( $manager ) {

    $manager->add_font( new G1_System_Font( 'system_arial',  array(
        'name'	=> 'Arial',
        'stack' => array(
            'Helvetica',
            'sans-serif',
        ),
    )));

    $manager->add_font( new G1_System_Font( 'system_georgia',  array(
        'name'	=> 'Georgia',
        'stack' => array(
            'Times New Roman',
            'serif',
        ),
    )));
}
add_action( 'g1_font_manager_register', 'g1_add_some_system_fonts' );



/**
 * Adds some font-face fonts
 *
 * @param G1_Font_Manager $manager
 */
function g1_add_some_font_face_fonts( $manager ) {
    $uri = trailingslashit( get_template_directory_uri() ) . 'css/fontface-kits/';

    // LatoLight
    $manager->add_font( new G1_Font_Face_Font( 'fontface_lato_black',  array(
        'name'	=> 'LatoBlack',
        'eot'	=> $uri . 'lato-fontfacekit/Lato-Black-webfont.eot',
        'woff'	=> $uri . 'lato-fontfacekit/Lato-Black-webfont.woff',
        'ttf'	=> $uri . 'lato-fontfacekit/Lato-Black-webfont.ttf',
        'svg'	=> $uri . 'lato-fontfacekit/Lato-Black-webfont.svg',
    )));

    // LatoRegular
    $manager->add_font( new G1_Font_Face_Font( 'fontface_lora_regular',  array(
        'name'	=> 'Lora Regular',
        'eot'	=> $uri . 'lora-fontfacekit/Lora-Regular-webfont.eot',
        'woff'	=> $uri . 'lora-fontfacekit/Lora-Regular-webfont.woff',
        'ttf'	=> $uri . 'lora-fontfacekit/Lora-Regular-webfont.ttf',
        'svg'	=> $uri . 'lora-fontfacekit/Lora-Regular-webfont.svg',
    )));

    // Merriweather Light
    $manager->add_font( new G1_Font_Face_Font( 'fontface_merriweather_light',  array(
        'name'	=> 'Merriweather Light',
        'eot'	=> $uri . 'merriweather-fontfacekit/Merriweather-Light-webfont.eot',
        'woff'	=> $uri . 'merriweather-fontfacekit/Merriweather-Light-webfont.woff',
        'ttf'	=> $uri . 'merriweather-fontfacekit/Merriweather-Light-webfont.ttf',
        'svg'	=> $uri . 'merriweather-fontfacekit/Merriweather-Light-webfont.svg',
    )));
}
add_action( 'g1_font_manager_register', 'g1_add_some_font_face_fonts' );


/* PLEASE
 * Don't edit this file. Use the child theme to add new fonts.
 */