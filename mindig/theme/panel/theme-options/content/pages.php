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
        'name' => __( 'Custom text to show', 'yit' ),
        'desc' => __( "Text shown if a user request a page that doesn't exists.", 'yit' ),
        'std' => '',
        'deps' => array(
            'ids' => 'content-enable-404',
            'values' => 'yes'
        )
    ),

    array(
        'id' => 'content-404-image',
        'type' => 'upload',
        'name' => __( 'Custom image', 'yit' ),
        'desc' => __( "An image shown if a user request a page that doesn't exists.", 'yit' ),
        'std' => '',
        'deps' => array(
            'ids' => 'content-enable-404',
            'values' => 'yes'
        )
    ),

    array(
        'id' => 'content-404-background',
        'type' => 'upload',
        'name' => __( 'Background image', 'yit' ),
        'desc' => __( "Background image for content page", 'yit' ),
        'std' => YIT_IMAGES_URL . '/404-background.jpg'
    ),

    array(
        'id'      => 'content-404-background-repeat',
        'type'    => 'select',
        'options' => array(
            'repeat'    => __( 'Repeat', 'yit' ),
            'repeat-x'  => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y'  => __( 'Repeat Vertically', 'yit' ),
            'no-repeat' => __( 'No Repeat', 'yit' )
        ),
        'name'    => __( 'Background repeat', 'yit' ),
        'desc'    => __( 'Select the repeat mode for the background image of 404.', 'yit' ),
        'std'     => 'no-repeat'
    ),

    array(
        'id'      => 'content-404-background-position',
        'type'    => 'select',
        'options' => array(
            'center'        => __( 'Center', 'yit' ),
            'top left'      => __( 'Top Left', 'yit' ),
            'top center'    => __( 'Top Center', 'yit' ),
            'top right'     => __( 'Top Right', 'yit' ),
            'bottom left'   => __( 'Bottom Left', 'yit' ),
            'bottom center' => __( 'Bottom Center', 'yit' ),
            'bottom right'  => __( 'Bottom Right', 'yit' ),
        ),
        'name'    => __( 'Background position', 'yit' ),
        'desc'    => __( 'Select the position for the background image of 404.', 'yit' ),
        'std'     => 'top left'
    ),

    array(
        'id'      => 'content-404-background-attachment',
        'type'    => 'select',
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed'  => __( 'Fixed', 'yit' )
        ),
        'name'    => __( 'Background attachment', 'yit' ),
        'desc'    => __( 'Select the attachment for the background image of 404.', 'yit' ),
        'std'     => 'scroll'
    ),

    array(
        'id' => 'content-no-header-footer',
        'type' => 'onoff',
        'name' => __( 'Hide header and footer', 'yit' ),
        'desc' => __( 'Say if you want to hide the header and footer in the 404 page. ', 'yit' ),
        'std' => 'no'
    ),
);

