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
 * Return an array with the options for Custom Login > Customize Login Screen > General
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithems.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Custom Login > Costumize Login Screen > General */
    array(
        'id' => 'enable-custom-login',
        'type' => 'onoff',
        'name' => __( 'Enable Custom Login Screen', 'yit' ),
        'desc' => __( 'Enable the custom login screen or use the Wordpress default screen.', 'yit'),
        'std' => 'yes'
    ),

    array(
        'id' => 'style-custom-login',
        'type' => 'textarea',
        'name' => __( 'Custom Style', 'yit' ),
        'desc' => __( 'Insert here your custom CSS style', 'yit' ),
        'std' => ''
    )

);