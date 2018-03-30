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
 * Template file for sitemap
 *
 * @package Yithemes
 * @author Antonio La Rocca <antonio.larocca@yithemes.com>
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( isset($title) ): ?>
    <h1 class="title_sitemap"><?php echo $title ?></h1>
<?php endif ?>

<div class="sitemap row">
<?php

/* If user never click on "save changes" before to prevent notice*/
$option_sitemap_general_order = YIT_Sitemap()->get_option('sitemap-general-order');
if(empty($option_sitemap_general_order))  return ;
/*----------------------------------*/

$order = array();
$order = json_decode( stripslashes( $option_sitemap_general_order ) , true );

if( !empty($order) ) {
    $order = array_keys($order['include']);
}

$sitemap = array();

$columns = 3;

//get pages
if(in_array('pages', $order) ) {
    //retrieve pages with metabox _exclude-sitemap setted to On
    $args = array(
        'fields' => 'ids',
        'post_type' => 'page',
        'meta_query' => array(
            array(
                'key' => '_sitemap_display',
                'value' => '0',
                'compare' => '='
            )
        )
    );
    $query = new WP_Query( $args );
    $exclude = implode(',', $query->posts);
    //Aggiungere controllo su pagine escluse con dati recuperati dal pannello Layout
    wp_reset_query();

    //$sitemap['pages']  = '<div class="sitemap-pages-container span3">';
    $sitemap['pages'] = '<h3>' . YIT_Sitemap()->get_option( 'sitemap-page-title' ) . '</h3>';

    $sitemap['pages'] .= '<ul>' . wp_list_pages(array(
        'depth'        => YIT_Sitemap()->get_option( 'sitemap-page-depth' ),
        'exclude'      => $exclude,
        'echo'         => 0,
        'title_li'     => '',
        'sort_column'  => YIT_Sitemap()->get_option( 'sitemap-page-order-by' ),
        'sort_order'   => YIT_Sitemap()->get_option( 'sitemap-page-order' ),
        'post_type'    => 'page',
        'post_status'  => 'publish'
    )) . '</ul>';

    //$sitemap['pages'] .= '</div>';
    wp_reset_query();
}

//get posts
if( in_array('posts', $order) ) {
    //get categories
    /*$exclude_cat = yit_get_option('sitemap-posts-cats_exclude');
    $exclude_cat = isset($exclude_cat[1]) && is_array($exclude_cat[1]) ? implode(',',$exclude_cat[1]) : '';*/
    //Aggiungere controllo su categorie escluse con dati recuperati dal pannello Layout
    $exclude_cat = "";

    $categories = get_categories(array(
        'type' => 'post',
        'orderby' => 'name',
        'order' => 'ASC',
        'hide_empty' => 1,
        'exclude' => $exclude_cat,
        'hierarchical' => 1,
        'taxonomy' => 'category'
    ));

    //retrieve posts with metabox _exclude-sitemap setted to On
    /*$args = array(
        'fields' => 'ids',
        'post_type' => 'post',
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array('catalog', 'visible'),
                'compare' => 'IN'
            )
        ),
        'meta_query' => array(
            array(
                'key' => '_exclude-sitemap',
                'value' => '1',
                'compare' => '='
            )
        )
    );
    $query = new WP_Query( $args );
    $exclude = implode(',', $query->posts) . ',' . yit_get_option('sitemap-posts-exclude');*/
    //Aggiungere controllo su posts esclusi con dati recuperati dal pannello Layout
    $exclude = "";



    //$sitemap['posts']  = '<div class="sitemap-posts-container span3">';
    $sitemap['posts'] = '<h3>' . YIT_Sitemap()->get_option( 'sitemap-post-title' ) . '</h3>';

    if( YIT_Sitemap()->get_option( 'sitemap-post-items' ) != 0 ){
        foreach($categories as $category) {
            //get posts in category
            $sitemap['posts'] .= '<h2><a href="'. get_category_link( $category->term_id ) .'">' . $category->name . '</a></h2>';

            $posts = array();
            if( YIT_Sitemap()->get_option( 'sitemap-post-items' ) != 0 ){
                $posts = get_posts(array(
                    'numberposts'	=> YIT_Sitemap()->get_option( 'sitemap-post-items' ),
                    'category'	=> $category->cat_ID,
                    'orderby'	=> YIT_Sitemap()->get_option( 'sitemap-post-order-by' ),
                    'order'		=> YIT_Sitemap()->get_option( 'sitemap-post-order' ),
                    'exclude'	=> $exclude,
                    'post_type'	=> 'post',
                ));
            }

            if (count($posts) > 0) {
                $sitemap['posts'] .= '<ul class="cat_' . $category->cat_ID .' cat">';

                foreach($posts as $post) {

                    $extra = '';

                    if ( strcmp( YIT_Sitemap()->get_option( 'sitemap-post-show-date' ), 'yes' ) == 0 ) {
                        $extra = ' <span>' . date_i18n( get_option('date_format'), strtotime( $post->post_date ) ) . '</span>';
                    }

                    $sitemap['posts'] .= '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yit'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a>' . $extra . '</li>';
                }

                $sitemap['posts'] .= '</ul>';
            }
        }

        //$sitemap['posts'] .= '</div>';
        wp_reset_query();
    }
}

//get archives
if( in_array('archives', $order) ) {

    //$sitemap['archives']  = '<div class="sitemap-archives-container span3">';
    $sitemap['archives'] = '<h3>' . YIT_Sitemap()->get_option( 'sitemap-archive-title' ) . '</h3>';
    $sitemap['archives'] .= '<ul>';

    $sitemap['archives'] .= wp_get_archives(array(
        'type' => YIT_Sitemap()->get_option( 'sitemap-archive-type' ),
        'limit' => YIT_Sitemap()->get_option( 'sitemap-archive-limit' ) == -1 ? '' : YIT_Sitemap()->get_option( 'sitemap-archive-limit' ),
        'show_post_count' => ( strcmp( YIT_Sitemap()->get_option( 'sitemap-archive-show-count' ), 'no' ) == 0 ) ? false : true ,
        'echo' => 0
    ));

    $sitemap['archives'] .= '</ul>';
    //$sitemap['archives'] .= '</div>';
}

//get products
if( function_exists( 'WC' ) && in_array('products', $order) && is_shop_installed()) {

    $categories = get_terms( array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => 0
    ) );

    $columns = 4;

    //$sitemap['products']  = '<div class="sitemap-products-container span3">';
    $sitemap['products'] = '<h3>' . YIT_Sitemap()->get_option( 'sitemap-product-title' ) . '</h3>';

    if( YIT_Sitemap()->get_option( 'sitemap-product-items' ) == -1 ){



        foreach($categories as $category) {
            //get posts in category
            $args = array(
                'post_type'	=> 'product',
                'post_status' => 'publish',
                'ignore_sticky_posts'	=> 1,
                'posts_per_page' => YIT_Sitemap()->get_option( 'sitemap-product-items' ),
                'meta_query' => array(
                    array(
                        'key' => '_visibility',
                        'value' => array('catalog', 'visible'),
                        'compare' => 'IN'
                    )
                ),
                'tax_query' => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'terms' => array( esc_attr($category->slug) ),
                        'field' => 'slug',
                        'operator' => 'IN'
                    )
                )
            );
            $products = new WP_Query( $args );

            if (count($products->posts) > 0) {
                $category_link = get_term_link( $category, 'product_cat' );
                $sitemap['products'] .= '<h2><a href="'. $category_link .'">' . $category->name . '</a></h2>';
                $sitemap['products'] .= '<ul class="cat_' . $category->term_id .' cat">';

                foreach($products->posts as $post) {
                    $sitemap['products'] .= '<li><a href="' . get_permalink($post->ID) . '" title="' . sprintf(esc_attr__('Permalink to %s', 'yit'), the_title_attribute('echo=0')) . '" rel="bookmark">' . get_the_title($post->ID) . '</a></li>';
                }

                if( YIT_Sitemap()->get_option( 'sitemap-product-items' ) ) {
                    $sitemap['products'] .= '<li class="sitemap-read-more"><a href="' . $category_link . '">' . __('More', 'yit') . '</a></li>';
                }

                $sitemap['products'] .= '</ul>';
            }
        }
    }

    //$sitemap['products'] .= '</div>';

}

//print the sitemap
$i = 0;
foreach($order as $k => $item) {
    $class = ( $i++ % $columns ) == 0 ? ' first' : '';
    if( isset( $sitemap[ $item ] ) ){
        echo '<div class="sitemap-' . $k . '-container col-sm-'.(12/$columns).' '. $class .'">';
        echo $sitemap[$item];
        echo '</div>';
    }
}
?>
</div>