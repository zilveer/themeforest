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
 * Return an array with the options for Theme Options > Shop > Category Page
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @author Francesco Licandro <francesco.licandro@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* Shop > Category Page Settings */
    array(
        'type' => 'title',
        'name' => __( 'Category Page', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'shop-category-show-page-title',
        'type' => 'onoff',
        'name' => __( 'Show category page title', 'yit' ),
        'desc' => __( 'Activate/Deactivate the page title on Category.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-category-show-page-image',
        'type' => 'onoff',
        'name' => __( 'Show image in category page', 'yit' ),
        'desc' => __( 'Activate/Deactivate the image on Category.', 'yit' ),
        'std' => 'no'
    ),

    array(
        'id' => 'shop-category-show-page-description',
        'type' => 'onoff',
        'name' => __( 'Show description in category page', 'yit' ),
        'desc' => __( 'Activate/Deactivate the description about category.', 'yit' ),
        'std' => 'no'
    ),

);

