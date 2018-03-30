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
 * Return an array with the options for Custom Login > Customize Login Screen > Background
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithems.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Custom Login > Costumize Login Screen > Background */
    array(
        'id' => 'background-custom-login',
        'type' => 'upload',
        'name' => __( 'Background image', 'yit' ),
        'desc' => __( 'Login screen background image', 'yit' ),
        'std' => YIT_IMAGES_URL . '/splash.jpg'
    ),

    array(
        'id' => 'background-color-custom-login',
        'type' => 'colorpicker',
        'name' => __( 'Background color', 'yit' ),
        'desc' => __( 'Login screen background color', 'yit' ),
        'std' =>  array(
            'color' => '#ffffff'
        )
    ),

    array(
        'id' => 'background-repeat-custom-login',
        'type' => 'select',
        'name' => __( 'Background repeat', 'yit' ),
        'desc' => __( 'Select the repeat mode for the background image.', 'yit' ),
        'options' => array(
            'no-repeat' => __( 'No Repeat', 'yit' ),
            'repeat' => __( 'Repeat', 'yit' ),
            'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
            'repeat-y' => __( 'Repeat Vertically', 'yit' )
        ),
        'std' => 'no-repeat'
    ),

    array(
        'id' => 'background-position-custom-login',
        'type' => 'select',
        'name' => __( 'Background position', 'yit' ),
        'desc' => __( 'Select the position for the background image.', 'yit' ),
        'options' => array(
            'center' => __( 'Center', 'yit' ),
            'top left' => __( 'Top left', 'yit' ),
            'top center' => __( 'Top center', 'yit' ),
            'top right' => __( 'Top right', 'yit' ),
            'bottom left' => __( 'Bottom left', 'yit' ),
            'bottom center' => __( 'Bottom center', 'yit' ),
            'bottom right' => __( 'Bottom right', 'yit')
        ),
        'std' => 'center'
    ),

    array(
        'id' => 'background-attachment-custom-login',
        'type' => 'select',
        'name' => __( 'Background attachment', 'yit' ),
        'desc' => __( 'Select the attachment for the background image.', 'yit' ),
        'options' => array(
            'scroll' => __( 'Scroll', 'yit' ),
            'fixed' => __( 'Fixed', 'yit' ),
        ),
        'std' => 'scroll'
    )

);