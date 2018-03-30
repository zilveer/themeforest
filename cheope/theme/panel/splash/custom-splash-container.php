<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */


function yit_splash_container_width_std() {
    return 400;
}
add_filter( 'yit_splash-container_width_std', 'yit_splash_container_width_std' );

function yit_splash_container_submit_font_std( $array ) {
    $array['family'] = 'Muli';
    $array['size'] = 12;
    $array['color'] = '#4c4c4c';

    return $array;
}
add_filter( 'yit_splash-container-submit_font_std', 'yit_splash_container_submit_font_std' );

function yit_splash_container_label_font_std( $array ) {
    $array['family'] = 'Muli';
    $array['color'] = '#666767';
    $array['size'] = 14;
    return $array;
}
add_filter( 'yit_splash-container-label_font_std', 'yit_splash_container_label_font_std' );

function yit_splash_container_lostback_font_std( $array ) {
    $array['family'] = 'Muli';
    $array['color'] = '#ffffff';
    $array['size'] = 12;
    return $array;
}
add_filter( 'yit_splash-container-lostback_font_std', 'yit_splash_container_lostback_font_std' );

function yit_splash_container_submit_bg_color_std( $array ) {
    return '#F3F0F0';
}
add_filter( 'yit_splash-container-submit_bg_color_std', 'yit_splash_container_submit_bg_color_std' );

function yit_splash_container_submit_bg_color_hover_std( $array ) {
    return '#ffffff';
}
add_filter( 'yit_splash-container-submit_bg_color_hover_std', 'yit_splash_container_submit_bg_color_hover_std' );