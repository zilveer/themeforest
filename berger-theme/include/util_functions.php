<?php
/**
 * Created by Clapat.
 * Utility functions used throughout the theme
 * Date: 21/02/14
 * Time: 12:54 PM
 */

function clapat_get_image_metadata( $image_id ){

    $image_metadata     = array();
    $image_title        = __("Image Title", THEME_LANGUAGE_DOMAIN);
    $image_caption      = "";
    $image_desc         = __("Image Description", THEME_LANGUAGE_DOMAIN);
    $image_info         = get_post( $image_id );

    if( $image_info ){

        $image_title     = $image_info->post_title;
        $image_desc      = $image_info->post_content;
        $image_caption   = $image_info->post_excerpt;
    }

    $image_metadata['title']    = $image_title;
    $image_metadata['desc']     = $image_desc;
    $image_metadata['caption']  = $image_caption;

    return $image_metadata;
}

function hex2rgb($hex) {

    $hex = str_replace("#", "", $hex);

    if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
    }

    $rgb = array($r, $g, $b);

    return $rgb; // returns an array with the rgb values
}

function hex2rgba($hex, $opacity = '0') {

    $rgbval = hex2rgb( $hex );

    return 'rgba(' . $rgbval[0] . ', ' . $rgbval[1] . ', ' . $rgbval[2] . ', ' . $opacity . ')';
}

?>