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
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @author Antonio La Rocca <antonio.larocca@yithemes.it>
 * @since 2.0.0
 * @return mixed array
 *
 */
return array(

    /* General > Integration */
    array(
        'type' => 'title',
        'name' => __( 'Twitter API', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'general-twitter-username',
        'type' => 'text',
        'name' => __( 'Twitter username', 'yit' ),
        'desc' => __( 'Enter Twitter username', 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'general-twitter-consumer-key',
        'type' => 'text',
        'name' => __( 'Twitter consumer key', 'yit' ),
        'desc' => __( 'Enter Twitter consumer key', 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'general-twitter-consumer-secret',
        'type' => 'text',
        'name' => __( 'Twitter consumer secret', 'yit' ),
        'desc' => __( 'Enter Twitter consumer secret', 'yit' ),
        'std' => ''
    ),

    array(
        'id' => 'general-twitter-access-token',
        'type' => 'text',
        'name' => __( 'Twitter access token', 'yit' ),
        'desc' => __( 'Enter Twitter access token', 'yit' ),
		'std' => ''
    ),

    array(
        'id' => 'general-twitter-access-token-secret',
        'type' => 'text',
        'name' => __( 'Twitter access token secret', 'yit' ),
        'desc' => __( 'Enter Twitter access token secret', 'yit' ),
		'std' => ''
    ),

    array(
        'type' => 'title',
        'name' => __( 'Open Graph', 'yit' ),
        'desc' => ''
    ),

    array(
        'id' => 'general-enable-open-graph',
        'type' => 'onoff',
        'name' => __( 'Enable open graph', 'yit' ),
        'desc' => __( 'Enable open graph or use your own plugin.', 'yit' ),
		'std' => 'yes'
    )
);

