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
 * Return an array with default sidebars of theme
 *
 * @package Yithemes
 * @author  Emanuela Castorina <emanuela.castorina@yithemes.it>
 * @since   2.0.0
 * @return mixed array
 *
 */

return array(
    'default-sidebar'  => array(
        'name'         => __( 'Default', 'yit' ),
        'description'  => __( 'Widget area for default sidebar', 'yit' ),
        'widget-class' => 'widget',
        'title'        => 'h3'
    ),

    'topbar-left'  => array(
        'name'         => __( 'Topbar Left', 'yit' ),
        'description'  => __( 'Left widget area for Top Bar', 'yit' ),
        'widget-class' => 'widget',
        'title'        => 'h3'
    ),
    'topbar-right' => array(
        'name'         => __( 'Topbar Right', 'yit' ),
        'description'  => __( 'Right widget area for Top Bar', 'yit' ),
        'widget-class' => 'widget',
        'title'        => 'h3'
    ),
    'header' => array(
        'name'         => __( 'Header Sidebar', 'yit' ),
        'description'  => __( 'Widget area near the navigation', 'yit' ),
        'widget-class' => 'widget',
        'title'        => 'h3'
    ),
    'infobar' => array(
        'name'         => __( 'Infobar', 'yit' ),
        'description'  => __( 'Widget area for Info Bar', 'yit' ),
        'widget-class' => 'widget',
        'title'        => 'h3'
    ),

);