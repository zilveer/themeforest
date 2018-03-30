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
 * Return an array with the options for Theme Options > General > Integration
 *
 * @package Yithemes
 * @author Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* General > Integration */
    array(
        'type' => 'title',
        'name' => __( 'SEO', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'seo-active',
        'type' => 'onoff',
        'name' => __( 'Enable SEO', 'yit' ),
        'desc' => __( 'Enable SEO or use your own plugin.', 'yit' ),
        'std' => 'yes'
    )
);