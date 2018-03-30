<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for insert an image
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
	$src = esc_url( $src );
    $animate = ( $animate != '' ) ? ' yit_animate '.$animate : '';
    if(function_exists('yit_image')){
        yit_image( "src=$src&width=$width&height=$height&alt=$alt&class=". esc_attr( $animate . $vc_css ) );
    }else{
        echo '<img src="' . $src . '" width="' . $width .'" height="'. $height .'" alt="'. $alt .'" class="'. esc_attr( $animate . $vc_css ) . '" >';
    }

?>