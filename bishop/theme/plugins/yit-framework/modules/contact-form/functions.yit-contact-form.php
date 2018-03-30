<?php
/**
 * Functions
 *
 * @author Your Inspiration Themes
 * @package YIT Contact Form
 * @version 1.0.7
 */

if ( !defined( 'YIT_CONTACT_FORM_VERSION' ) ) { exit; } // Exit if accessed directly


if( ! function_exists( 'yit_wpml_get_translated_id' ) ) {
    /**
     * Get the id of the current translation of the post/custom type
     *
     * @since  2.0.0
     * @author Andrea Frascaspata <andrea.frascaspata@yithemes.com>
     */
    function yit_wpml_get_translated_id( $id, $post_type ) {

        if ( function_exists( 'wpml_object_id_filter' ) ) {

            $id = wpml_object_id_filter( $id, $post_type, true );

        }

        return $id;
    }
}