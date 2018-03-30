<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Function for shop-shortcodes
 *
 * @package Yithemes
 * @autor Francesco Licandro  <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
if ( ! function_exists( 'yit_get_shop_categories' ) ) {
    function yit_get_shop_categories( $show_all = true , $default_value='0' ) {
        global $wpdb;

        $terms = $wpdb->get_results( 'SELECT name, slug FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "product_cat" ORDER BY name ASC;' );

        $categories = array();
        if ( $show_all ) {
            $categories[$default_value] = __( 'All categories', 'yit' );
        }
        if ( $terms ) {
            foreach ( $terms as $cat ) {
                $categories[$cat->slug] = ( $cat->name ) ? $cat->name : 'ID: ' . $cat->slug;
            }
        }
        return $categories;
    }
}

if ( ! function_exists( 'yit_get_shop_categories_by_id' ) ) {
    function yit_get_shop_categories_by_id() {
        global $wpdb;

        $terms = $wpdb->get_results( 'SELECT name, ' . $wpdb->prefix . 'terms.term_id FROM ' . $wpdb->prefix . 'terms, ' . $wpdb->prefix . 'term_taxonomy WHERE ' . $wpdb->prefix . 'terms.term_id = ' . $wpdb->prefix . 'term_taxonomy.term_id AND taxonomy = "product_cat" ORDER BY name ASC;' );

        $categories      = array();
        $categories['0'] = __( 'All categories', 'yit' );
        if ( $terms ) {
            foreach ( $terms as $cat ) {
                $categories[ $cat->term_id ] = ( $cat->name ) ? $cat->name : 'ID: ' . $cat->term_id;
            }
        }

        return $categories;
    }
}

if ( ! function_exists( 'yit_get_shop_products' ) ) {
    function yit_get_shop_products() {
        global $wpdb;

        $terms = get_posts( array(
                'post_type'      => array( 'product' ),
                'posts_per_page' => - 1,
                'post_status'    => 'publish',
            )
        );

        $products      = array();
        $products['0'] = __( 'All products', 'yit' );
        if ( $terms ) {
            foreach ( $terms as $prod ) {
                $products[ $prod->ID ] = ( $prod->post_title ) ? $prod->post_title : 'ID: ' . $prod->ID;
            }
        }

        return $products;
    }
}