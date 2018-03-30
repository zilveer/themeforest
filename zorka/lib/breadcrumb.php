<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2/28/15
 * Time: 9:12 AM
 */


if ( ! function_exists( 'zorka_get_breadcrumb' ) ) {
    function zorka_get_breadcrumb() {

        $items = zorka_get_breadcrumb_items();
        $breadcrumbs = '<ul class="breadcrumbs" xmlns:v="http://rdf.data-vocabulary.org/#">';
        $breadcrumbs .= join( "", $items );
        $breadcrumbs .= '</ul>';

        echo  wp_kses_post($breadcrumbs);
    }
}

if ( ! function_exists( 'zorka_get_breadcrumb_items' ) ) {
    function zorka_get_breadcrumb_items() {
        global $wp_query;


        $on_front = get_option('show_on_front');

        $item = array();
        /* Front page. */
        if ( is_front_page() ) {
            $item['last'] ='<i class="fa fa-home"></i>';
        }


        /* Link to front page. */
        if ( !is_front_page() ) {
            $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="'. home_url( '/' ) .'" class="home"><i class="fa fa-home"></i></a></li>';
        }

        /* If bbPress is installed and we're on a bbPress page. */
        if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
            $item = array_merge( $item, zorka_breadcrumb_get_bbpress_items() );
        }

        elseif ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
            $item = array_merge( $item, zorka_filter_breadcrumb_items() );
        }

        /* If viewing a home/post page. */
        elseif ( is_home() ) {
            $home_page = get_post( $wp_query->get_queried_object_id() );
            $item = array_merge( $item, zorka_breadcrumb_get_parents( $home_page->post_parent ) );
            $item['last'] = get_the_title( $home_page->ID );
        }

        /* If viewing a singular post. */
        elseif ( is_singular() ) {

            $post = $wp_query->get_queried_object();
            $post_id = (int) $wp_query->get_queried_object_id();
            $post_type = $post->post_type;

            $post_type_object = get_post_type_object( $post_type );

            if ( 'post' === $wp_query->post->post_type ) {
                // $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></li>';
                $categories = get_the_category( $post_id );
                $item = array_merge( $item, zorka_breadcrumb_get_term_parents( $categories[0]->term_id, $categories[0]->taxonomy ) );
            }

            if ( 'page' !== $wp_query->post->post_type ) {

                /* If there's an archive page, add it. */

                if ( function_exists( 'get_post_type_archive_link' ) && !empty( $post_type_object->has_archive ) )
                    $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">' . $post_type_object->labels->name . '</a></li>';

                if ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) && is_taxonomy_hierarchical( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) ) {
                    $terms = wp_get_object_terms( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"] );
                    $item = array_merge( $item, zorka_breadcrumb_get_term_parents( $terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"] ) );
                }

                elseif ( isset( $args["singular_{$wp_query->post->post_type}_taxonomy"] ) )
                    $item[] = get_the_term_list( $post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '' );
            }

            if ( ( is_post_type_hierarchical( $wp_query->post->post_type ) || 'attachment' === $wp_query->post->post_type ) && $parents = zorka_breadcrumb_get_parents( $wp_query->post->post_parent ) ) {
                $item = array_merge( $item, $parents );
            }

            $item['last'] = get_the_title();
        }

        /* If viewing any type of archive. */
        else if ( is_archive() ) {

            if ( is_category() || is_tag() || is_tax() ) {

                $term = $wp_query->get_queried_object();
                //$taxonomy = get_taxonomy( $term->taxonomy );

                if ( ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent ) && $parents = zorka_breadcrumb_get_term_parents( $term->parent, $term->taxonomy ) )
                    $item = array_merge( $item, $parents );

                $item['last'] = $term->name;
            }

            else if ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {
                $post_type_object = get_post_type_object( get_query_var( 'post_type' ) );
                $item['last'] = $post_type_object->labels->name;
            }

            else if ( is_date() ) {

                if ( is_day() )
                    $item['last'] = esc_html__('Archives for ', 'zorka' ) . get_the_time( 'F j, Y' );

                elseif ( is_month() )
                    $item['last'] = esc_html__('Archives for ', 'zorka' ) . single_month_title( ' ', false );

                elseif ( is_year() )
                    $item['last'] = esc_html__('Archives for ', 'zorka' ) . get_the_time( 'Y' );
            }

            else if ( is_author() )
                $item['last'] = esc_html__('Archives by: ', 'zorka' ) . get_the_author_meta( 'display_name', $wp_query->post->post_author );

        }

        /* If viewing search results. */
        else if ( is_search() )
            $item['last'] = esc_html__('Search results for "', 'zorka' ) . stripslashes( strip_tags( get_search_query() ) ) . '"';

        /* If viewing a 404 error page. */
        else if ( is_404() )
            $item['last'] = esc_html__('Page Not Found', 'zorka' );



        if ( isset( $item['last'] ) ) {
            $item['last'] = sprintf( '<li><span>%s</span></li>', $item['last'] );
        }




        return apply_filters( 'zorka_filter_breadcrumb_items', $item );
    }
}

if ( ! function_exists( 'zorka_filter_breadcrumb_items' ) ) {
    function zorka_filter_breadcrumb_items() {
        $item = array();
        $shop_page_id = wc_get_page_id( 'shop' );

        if ( get_option( 'page_on_front' ) != $shop_page_id ) {
            $shop_name = $shop_page_id ? get_the_title( $shop_page_id ) : '';
            if ( ! is_shop() ) {
                $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $shop_page_id ) . '">' . $shop_name . '</a></li>';
            } else {
                $item[ 'last' ] = $shop_name;
            }
        }

        if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

        } elseif ( is_product() ) {
            global $post;
            $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) );
            $current_term = $terms[0];
        }

        if ( ! empty( $current_term ) ) {
            if ( is_taxonomy_hierarchical( $current_term->taxonomy ) ) {
                $item = array_merge( $item, zorka_breadcrumb_get_term_parents( $current_term->parent, $current_term->taxonomy ) );
            }

            if ( is_tax( 'product_cat' ) || is_tax( 'product_tag' ) ) {
                $item[ 'last' ] = $current_term->name;
            } else {
                $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $current_term->term_id, $current_term->taxonomy ) . '">' . $current_term->name . '</a></li>';
            }
        }

        if ( is_product() ) {
            $item[ 'last' ] = get_the_title();
        }

        return apply_filters( 'zorka_filter_breadcrumb_items', $item );
    }
}

if ( ! function_exists( 'zorka_breadcrumb_get_bbpress_items' ) ) {
    function zorka_breadcrumb_get_bbpress_items() {
        $item = array();

        $post_type_object = get_post_type_object( bbp_get_forum_post_type() );

        if ( !empty( $post_type_object->has_archive ) && !bbp_is_forum_archive() )
            $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link( bbp_get_forum_post_type() ) . '">' . bbp_get_forum_archive_title() . '</a></li>';

        if ( bbp_is_forum_archive() )
            $item[ 'last' ] = bbp_get_forum_archive_title();

        elseif ( bbp_is_topic_archive() )
            $item[ 'last' ] = bbp_get_topic_archive_title();

        elseif ( bbp_is_single_view() )
            $item[ 'last' ] = bbp_get_view_title();

        elseif ( bbp_is_single_topic() ) {

            $topic_id = get_queried_object_id();

            $item = array_merge( $item, zorka_breadcrumb_get_parents( bbp_get_topic_forum_id( $topic_id ) ) );

            if ( bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit() )
                $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_topic_permalink( $topic_id ) . '">' . bbp_get_topic_title( $topic_id ) . '</a></li>';
            else
                $item[ 'last' ] = bbp_get_topic_title( $topic_id );

            if ( bbp_is_topic_split() )
                $item[ 'last' ] = esc_html__('Split', 'zorka' );

            elseif ( bbp_is_topic_merge() )
                $item[ 'last' ] = esc_html__('Merge', 'zorka' );

            elseif ( bbp_is_topic_edit() )
                $item[ 'last' ] = esc_html__('Edit', 'zorka' );
        }

        elseif ( bbp_is_single_reply() ) {

            $reply_id = get_queried_object_id();

            $item = array_merge( $item, zorka_breadcrumb_get_parents( bbp_get_reply_topic_id( $reply_id ) ) );

            if ( !bbp_is_reply_edit() ) {
                $item[ 'last' ] = bbp_get_reply_title( $reply_id );

            } else {
                $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_reply_url( $reply_id ) . '">' . bbp_get_reply_title( $reply_id ) . '</a></li>';
                $item[ 'last' ] = esc_html__('Edit', 'zorka' );
            }

        }

        elseif ( bbp_is_single_forum() ) {

            $forum_id = get_queried_object_id();
            $forum_parent_id = bbp_get_forum_parent_id( $forum_id );

            if ( 0 !== $forum_parent_id)
                $item = array_merge( $item, zorka_breadcrumb_get_parents( $forum_parent_id ) );

            $item[ 'last' ] = bbp_get_forum_title( $forum_id );
        }

        elseif ( bbp_is_single_user() || bbp_is_single_user_edit() ) {

            if ( bbp_is_single_user_edit() ) {
                $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . bbp_get_user_profile_url() . '">' . bbp_get_displayed_user_field( 'display_name' ) . '</a></li>';
                $item[ 'last' ] = esc_html__('Edit', 'zorka' );
            } else {
                $item[ 'last' ] = bbp_get_displayed_user_field( 'display_name' );
            }
        }

        return apply_filters( 'zorka_breadcrumb_get_bbpress_items', $item );
    }
}

if ( ! function_exists( 'zorka_breadcrumb_get_parents' ) ) {
    function zorka_breadcrumb_get_parents( $post_id = '', $separator = '/' ) {
        $parents = array();

        if ( $post_id == 0 ){
            return $parents;
        }

        while ( $post_id ) {
            $page = get_post( $post_id );
            $parents[]  = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a></li>';
            $post_id = $page->post_parent;
        }

        if ( $parents ) {
            $parents = array_reverse( $parents );
        }

        return $parents;
    }
}

if ( ! function_exists( 'zorka_breadcrumb_get_term_parents' ) ) {
    function zorka_breadcrumb_get_term_parents( $parent_id = '', $taxonomy = '', $separator = '/' ) {
        $parents = array();

        if ( empty( $parent_id ) || empty( $taxonomy ) ){
            return $parents;
        }

        while ( $parent_id ) {
            $parent = get_term( $parent_id, $taxonomy );
            $parents[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a></li>';
            $parent_id = $parent->parent;
        }

        if ( $parents )	{
            $parents = array_reverse( $parents );
        }

        return $parents;
    }
}