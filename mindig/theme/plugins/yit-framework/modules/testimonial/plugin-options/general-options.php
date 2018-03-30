<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly


return array(
    'general' => array(

        /* =================== HOME =================== */
        'home'    => array(
            array( 'name' => __( 'Testimonials General Settings', 'yiw' ),
                   'type' => 'title' ),


            array( 'type' => 'close' )
        ),
        /* =================== END SKIN =================== */

        /* =================== GENERAL =================== */
        'general' => array(

            array( 'type' => 'open' ),

            array( 'name' => __( 'Show Thumbnail', 'yit' ),
                   'desc' => __( 'Activate/Deactivate the item thumbnail of testimonials. ', 'yit' ),
                   'id'   => 'thumbnail-testimonials',
                   'type' => 'on-off',
                   'std'  => 'yes' ),

            /*array( 'name' => __( 'Link to testimonial detail page', 'yit' ),
                   'desc' => __( 'Say if you want that the testimonial links, link to the testimonial detail page. ', 'yit' ),
                   'id'   => 'link-testimonials',
                   'type' => 'on-off',
                   'std'  => 'yes' ),*/


            array( 'name'    => __( 'Testimonial text type', 'yit' ),
                   'desc'    => __( 'Select what kind of content you want to show.', 'yit' ),
                   'id'      => 'text-type-testimonials',
                   'type'    => 'select',
                   'options' => array(
                       'content' => __( 'Complete content', 'yit' ),
                       'excerpt' => __( 'Limit Words for Excerpt', 'yit' )
                   ),
                   'std'     => 'content' ),

            array( 'name' => __( 'Limit words for excerpt content', 'yit' ),
                   'desc' => __( 'Select how many words to show, if "Limit Words for Excerpt" is selected', 'yit' ),
                   'id'   => 'limit-words-testimonials',
                   'type' => 'slider',
                   'min'  => 5,
                   'max'  => 255,
                   'deps' => array(
                       'ids' => 'text-type-testimonials',
                       'values' => 'excerpt'
                   ),
                   'std'  => 50 ),

            array( 'type' => 'close' )
        ),
    )
);