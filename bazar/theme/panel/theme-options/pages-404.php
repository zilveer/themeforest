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
 
function yit_404_image_position_options( $array ) {
	
    $array = array(
        'left' => __( 'Left', 'yit' ),
        'right' => __( 'Right', 'yit' )
    );
    
    return $array;
}
add_filter( 'yit_404-image-position_options', 'yit_404_image_position_options' );

function yit_404_image_position_std( $array ) { return "left"; }
add_filter( 'yit_404-image-position_std', 'yit_404_image_position_std' );