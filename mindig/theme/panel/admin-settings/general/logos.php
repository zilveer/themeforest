<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Return an array with the options for Theme Options > General > Settings
 *
 * @package Yithemes
 * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */


$options = array(

    /* General > Settings */
    array(
        'type' => 'title',
        'name' => __( 'General Settings', 'yit' ),
        'desc' => ''
    ),

    array(
        'id'       => 'admin-logo-header',
        'type'     => 'upload',
        'name'     => __( 'Admin Logo', 'yit' ),
        'desc'     => __( 'The logo appears in the administration panel header', 'yit' ),
        'validate' => 'esc_url',
        'std'      => ''
    ),

    array(
        'id'       => 'admin-logo-menu',
        'type'     => 'upload',
        'name'     => __( 'Admin Button', 'yit' ),
        'desc'     => __( 'The logo appears next to the option menu labels and the "Add Shortcodes" button in the "classic mode" of editor', 'yit' ),
        'validate' => 'esc_url',
        'std'      => ''
    ),
);

if(( defined( 'YIT_SHORTCODE' ) && YIT_SHORTCODE )){

    array_push($options,array(
        'id'       => 'admin-logo-visualcomposer',
        'type'     => 'upload',
        'name'     => __( 'Shortcodes Logo', 'yit' ),
        'desc'     => __( 'The logo appears next to shortcode name in visual composer, suggested size 32px x 32px', 'yit' ),
        'validate' => 'esc_url',
        'std'      => ''
    )) ;

}

return $options;

