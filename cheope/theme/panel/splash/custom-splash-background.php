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

function yit_splash_bg_color_std( $array ) {    
    return '#ffffff';
}
add_filter( 'yit_splash-bg_color_std', 'yit_splash_bg_color_std' );

function yit_splash_bg_image_repeat_std( $array ) {    
    return 'repeat';
}
add_filter( 'yit_splash-bg_image_repeat_std', 'yit_splash_bg_image_repeat_std' );

function yit_splash_bg_image_position_std( $array ) {    
    return 'top center';
}
add_filter( 'yit_splash-bg_image_position_std', 'yit_splash_bg_image_position_std' );