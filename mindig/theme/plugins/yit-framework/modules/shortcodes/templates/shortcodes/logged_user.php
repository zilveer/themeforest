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
 * Template file for show the username of the logged user with some option text before or after.
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */


if( !is_user_logged_in() )
    { return; }

$current_user = wp_get_current_user();

if( $display == 'first_last' )
    { $display = $current_user->user_firstname . ' ' . $current_user->user_lastname; }
elseif( $display == 'last_first' )
    { $display = $current_user->user_lastname . ' ' . $current_user->user_firstname; }
else
    { $display = $current_user->{$display}; }

echo $before . $display . $after;

