<?php
/**
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 *
 * @package G1_Framework
 * @subpackage G1_Theme
 * @since G1_Theme 1.0.0
 */

// Prevent direct script access
if ( !defined('ABSPATH') )
    die ( 'No direct script access allowed' );
?>
<?php

add_action( 'wp_loaded', 'g1_revslider_load_custom_captions' );

function g1_revslider_load_custom_captions() {
    if ( ! is_admin() ) {
        return;
    }

    if ( ! is_plugin_active( 'revslider/revslider.php' ) ) {
        return;
    }

    if ( ! class_exists( 'RevSliderDB' ) ) {
        return;
    }

    $loaded = get_option( 'g1_revslider_custom_captions_loaded', false );

    if ( $loaded ) {
        return;
    }

    $db = new RevSliderDB();

    $g1_captions = array(
        'g1-layer-small-black' => array(
            'padding'           => array( '5px', '20px', '5px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '18px',
            'line-height'       => '24px',
            'color'             => '#000',
            'background-color' => 'rgb(255,255,255)',
            'background-color' => 'rgba(255,255,255, 0.75)',
        ),
        'g1-layer-small-white' => array(
            'padding'           => array( '5px', '20px', '5px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '18px',
            'line-height'       => '24px',
            'color'             => '#fff',
            'background-color'  => 'rgb(0,0,0)',
            'background-color'  => 'rgba(0,0,0, 0.75)',
        ),
        'g1-layer-medium-black' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '36px',
            'line-height'       => '42px',
            'color'             => '#000',
            'background-color'  => 'rgb(255,255,255)',
            'background-color'  => 'rgba(255,255,255, 0.75)',
        ),
        'g1-layer-medium-white' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '36px',
            'line-height'       => '42px',
            'color'             => '#fff',
            'background-color'  => 'rgb(0,0,0)',
            'background-color'  => 'rgba(0,0,0, 0.75)',
        ),
        'g1-layer-large-black' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '60px',
            'line-height'       => '70px',
            'color'             => '#000',
            'background-color'  => 'rgb(255,255,255)',
            'background-color'  => 'rgba(255,255,255, 0.75)',
        ),
        'g1-layer-large-white' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '60px',
            'line-height'       => '70px',
            'color'             => '#fff',
            'background-color'  => 'rgb(0,0,0)',
            'background-color'  => 'rgba(0,0,0, 0.75)',
        ),
        'g1-layer-xlarge-black' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '84px',
            'line-height'       => '98px',
            'color'             => '#000',
            'background-color'  => 'rgb(255,255,255)',
            'background-color'  => 'rgba(255,255,255, 0.75)',
        ),
        'g1-layer-xlarge-white' => array(
            'padding'           => array( '7px', '20px', '7px', '20px' ),
            'position'          => 'absolute',
            'font-size'         => '84px',
            'line-height'       => '98px',
            'color'             => '#fff',
            'background-color'  => 'rgb(0,0,0)',
            'background-color'  => 'rgba(0,0,0, 0.75)',
        ),
    );

    $g1_captions = apply_filters( 'g1_revslider_custom_captions', $g1_captions );

    foreach ( $g1_captions as $handle => $styles ) {
        $content['hover']             = '';
        $content['advanced']          = array();
        $content['advanced']['idle']  = '';
        $content['advanced']['hover'] = '';

        $arrInsert           = array();
        $arrInsert["handle"] = '.tp-caption.' . $handle;
        $arrInsert["params"] = stripslashes( json_encode( $styles ) );
        $arrInsert["hover"]  = null;

        $content['settings']               = array();
        $content['settings']['version']    = 'custom';
        $content['settings']['translated'] = '5'; // translated to version 5 currently
        $arrInsert["settings"]             = stripslashes( json_encode( str_replace( "'", '"', $content['settings'] ) ) );

        $arrInsert["advanced"]          = array();
        $arrInsert["advanced"]['idle']  = $content['advanced']['idle'];
        $arrInsert["advanced"]['hover'] = $content['advanced']['hover'];
        $arrInsert["advanced"]          = stripslashes( json_encode( str_replace( "'", '"', $arrInsert["advanced"] ) ) );

        $db->insert( RevSliderGlobals::$table_css, $arrInsert );
    }

    update_option( 'g1_revslider_custom_captions_loaded', true );
}
