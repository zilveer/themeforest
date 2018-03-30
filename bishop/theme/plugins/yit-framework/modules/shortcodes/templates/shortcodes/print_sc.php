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
 * Template file for show code without execute it
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */

if( is_null( $content ) ) return;

$html = str_replace( array( '[', ']', '<', '>' ), array( '&#91;', '&#93;', '&lt;', '&gt;' ), $content );

echo '<pre class="shortcodes">' . $html . '</pre>';

?>