<?php

/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


if ( ! function_exists( 'yit_the_excerpt_max_charlength' ) ) {
    /**
     * Use get_the_excerpt() to print an excerpt by specifying a maximium number of characters.
     *
     * @param int $charlength
     *
     * @return string
     * @since    1.0.0
     */
    function yit_the_excerpt_max_charlength( $charlength = 50 ) {

        $excerpt = get_the_excerpt();
        $charlength ++;

        if ( mb_strlen( $excerpt ) > $charlength ) {
            $subex   = mb_substr( $excerpt, 0, $charlength - 5 );
            $exwords = explode( ' ', $subex );
            $excut   = - ( mb_strlen( $exwords[count( $exwords ) - 1] ) );
            if ( $excut < 0 ) {
                return mb_substr( $subex, 0, $excut );
            }
            else {
                return $subex;
            }

        }
        else {
            return $excerpt;
        }
    }

}