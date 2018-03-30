<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'yit_header', 'yit_topbar',                  30 );
add_action( 'yit_header', 'yit_start_header_container',  40 );
add_action( 'yit_header', 'yit_logo',                    50 );
add_action( 'yit_header', 'yit_header_sidebar',          60 );
add_action( 'yit_header', 'yit_nav',                     70 );
add_action( 'yit_header', 'yit_end_header_container',    80 );