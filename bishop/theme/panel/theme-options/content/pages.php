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
 * Return an array with the options for Theme Options > Content > Pages
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Pages > 404 Settings */
    array(
        'type' => 'title',
        'name' => __( '404', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'content-enable-404',
        'type' => 'onoff',
        'name' => __( 'Custom 404 error page', 'yit' ),
        'desc' => __( 'Activate/Deactivate the custom 404 Error page. ', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'content-404-text',
        'type' => 'textarea',
        'name' => __( 'Text to show', 'yit' ),
        'desc' => __( "Text shown if a user request a page that doesn't exists.", 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'content-404-image',
        'type' => 'upload',
        'name' => __( 'Custom image', 'yit' ),
        'desc' => __( "An image shown if a user request a page that doesn't exists.", 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'content-no-header-footer',
        'type' => 'onoff',
        'name' => __( 'Hide header and footer', 'yit' ),
        'desc' => __( 'Say if you want to hide the header and footer in the 404 page. ', 'yit' ),
        'std' => 'no'
    ),
);

