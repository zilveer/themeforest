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

add_filter( 'yit_footer-background_std', create_function( '', 'return "#ffffff";' ) );
add_filter( 'yit_footer-borders-color_std', create_function( '', 'return "#dfdcdc";' ) );
add_filter( 'yit_copyright-background_std', create_function( '', 'return "#ffffff";' ) );
