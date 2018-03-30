<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Your Inspiration
 * Date: 31/07/14
 * Time: 15.19
 * To change this template use File | Settings | File Templates.
 */

/* === ENQUEUE SCRIPTS === */

if( ! yit_is_old_ie() ){
    $this->enqueue_style( 'portfolio-single', 'css/style.css' );
}else{
    wp_enqueue_style( 'portfolio-single', YIT_THEME_TEMPLATES_URL . '/portfolios/single/css/style.css' );
}

/**
 * Retrieve a terms list
 *
 * Returns a string with the terms list separated by {$separator} or false otherwise
 *
 * @param $post_id string  the post id
 * @param $taxonomy string the taxonomy name
 * @param $separator the term separator | Default: ', '
 *
 * @since 2.0.0
 * @return mixed string|bool
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 */

if( ! function_exists( 'yit_get_terms_list_by_id' ) ){
    function yit_get_terms_list_by_id( $post_id, $taxonomy, $separator = ', ' ){

        $terms_list = '';
        $terms = get_the_terms( $post_id, $taxonomy );
        if( ! empty( $post_id ) && ! empty( $taxonomy ) && !empty( $terms ) ){
            foreach( $terms as $term ){
               $terms_list .= $term->name . $separator;
            }
            $terms_list = trim( $terms_list, $separator );
        }

        return ! empty( $terms_list ) ? $terms_list : false;
    }
}