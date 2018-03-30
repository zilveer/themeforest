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
 * Safely include wp-load, to bootstrap wp env
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 * @since 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$wp_load = dirname(dirname(__FILE__));

for( $i=0; $i<10; $i++ ) {
    if( file_exists( $wp_load . '/wp-load.php' ) ) {
        require_once "$wp_load/wp-load.php";
        break;
    } else {
        $wp_load = dirname( $wp_load );
    }
}
?>