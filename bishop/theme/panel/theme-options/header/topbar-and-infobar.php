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
 * Return an array with the options for Theme Options > Header > Topbar
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Header > Tobar and Infobar Settings */
    array(
        'type' => 'title',
        'name' => __( 'Topbar', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'header-enable-topbar',
        'type' => 'onoff',
        'name' => __( 'Show Top Bar', 'yit' ),
        'desc' => __( 'Select if you want to show the Top Bar above the header. ', 'yit' ),
        'std' => 'yes',
        'in_skin' => true
    ),

     array(
        'type' => 'title',
        'name' => __( 'Infobar', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'header-enable-infobar',
        'type' => 'onoff',
        'name' => __( 'Show Info Bar', 'yit' ),
        'desc' => __( 'Select if you want to show the Info Bar above the header. ', 'yit' ),
        'std' => 'no',
        'in_skin'        => true
    ),


);

