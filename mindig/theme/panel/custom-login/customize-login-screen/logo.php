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
 * Return an array with the options for Custom Login > Customize Login Screen > Logo
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithems.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Custom Login > Costumize Login Screen > Logo */
    array(
        'id' => 'logo-custom-login',
        'type' => 'upload',
        'name' => __( 'Logo image', 'yit' ),
        'desc' => __( 'Logo image. Leave empty to use default image.', 'yit' ),
        'std' => YIT_IMAGES_URL . '/logo.png'
    ),

    array(
        'id' => 'logo-color-custom-login',
        'type' => 'colorpicker',
        'name' => __( 'Background color', 'yit' ),
        'desc' => __( 'Logo background color. Leave empty for transparent background.', 'yit' ),
        'std' => array(
            'color' => '#ffffff'
        )
    ),
);