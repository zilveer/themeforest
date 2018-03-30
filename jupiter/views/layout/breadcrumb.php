<?php

/**
 * template part for Breadcrumbs. views/layout
 *
 * @author      Artbees
 * @package     jupiter/views
 * @version     5.0.5
 */

global $mk_options, $post;
$post_id = global_get_post_id();
if ($post_id) {
    $local_skining = get_post_meta($post_id, '_enable_local_backgrounds', true);
    $breadcrumb_skin = get_post_meta($post_id, '_breadcrumb_skin', true);
    if ($local_skining == 'true' && !empty($breadcrumb_skin)) {
        $breadcrumb_skin_class = $breadcrumb_skin;
    } 
    else {
        $breadcrumb_skin_class = $mk_options['breadcrumb_skin'];
    }
} 
else {
    $breadcrumb_skin_class = $mk_options['breadcrumb_skin'];
}

echo '<div id="mk-breadcrumbs"><div class="mk-breadcrumbs-inner ' . esc_attr( $breadcrumb_skin_class ) . '-skin">';

if (function_exists('yoast_breadcrumb')) {
    yoast_breadcrumb('', '');
} 
else {
    
    $delimiter = ' &#47; ';
    
    echo '<span xmlns:v="http://rdf.data-vocabulary.org/#"><span typeof="v:Breadcrumb">';
    
    if (!is_front_page()) {
        echo '<a href="';
        echo home_url('/');
        echo '" rel="v:url" property="v:title">' . esc_html__( 'Home', 'mk_framework' );
        echo "</a>" . $delimiter;
    }
    echo '<span rel="v:child" typeof="v:Breadcrumb">';
    if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
        $shop_page_id = wc_get_page_id('shop');
        $shop_page = get_post($shop_page_id);
        $permalinks = get_option('woocommerce_permalinks');
        if ($shop_page_id && $shop_page && get_option('page_on_front') !== $shop_page_id) {
            echo '<a href="' . esc_url( get_permalink($shop_page) ) . '" rel="v:url" property="v:title">' . esc_html( $shop_page->post_title ) . '</a> ';
        }
    }
    
    if (is_category() && !is_singular('portfolio')) {
        
        $categories = get_the_category();
        $ID = $categories[0]->cat_ID;
        echo is_wp_error($cat_parents = get_category_parents($ID, TRUE, ' <span>/</span> ')) ? '' : '<span class="breadcrumb-categoris-holder">' . $cat_parents . '</span>';
    } 
    else if (is_singular('news')) {
        echo '<span>' . get_the_title() . '</span>';
    } 
    else if (is_single() && !is_attachment()) {
        
        if (function_exists('is_woocommerce') && is_woocommerce() && get_post_type() == 'product') {
            
            if ($terms = wc_get_product_terms($post->ID, 'product_cat', array(
                'orderby' => 'parent',
                'order' => 'DESC'
            ))) {
                
                $main_term = $terms[0];
                
                $ancestors = get_ancestors($main_term->term_id, 'product_cat');
                
                $ancestors = array_reverse($ancestors);
                
                foreach ($ancestors as $ancestor) {
                    $ancestor = get_term($ancestor, 'product_cat');
                    
                    if (!is_wp_error($ancestor) && $ancestor) echo '<a href="' . esc_url( get_term_link($ancestor->slug, 'product_cat') ) . '" rel="v:url" property="v:title">' . esc_html( $ancestor->name ) . '</a>' . $delimiter;
                }
                
                echo '<a href="' . esc_url( get_term_link($main_term->slug, 'product_cat') ) . '" rel="v:url" property="v:title">' . esc_html( $main_term->name ) . '</a>' . $delimiter;
            }
            
            echo get_the_title();
        } 
        elseif (is_singular('portfolio')) {
            $portfolio_category = get_the_term_list($post->ID, 'portfolio_category', '', ' / ');
            if (!empty($portfolio_category)) {
                echo $portfolio_category . $delimiter;
            }
            echo '<span>' . get_the_title() . '</span>';
        } 
        elseif (get_post_type() != 'post') {
            
            if (function_exists('is_bbpress') && is_bbpress()) {
            } 
            else {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url( get_post_type_archive_link(get_post_type()) ) . '" rel="v:url" property="v:title">' . esc_html( $post_type->labels->singular_name ) . '</a>' . $delimiter;
                echo get_the_title();
            }
        } 
        else {
            $cat = current(get_the_category());
            echo get_category_parents($cat, true, $delimiter);
            echo get_the_title();
        }
    } 
    elseif (is_page() && !$post->post_parent) {
        
        echo get_the_title();
    } 
    elseif (is_page() && $post->post_parent) {
        
        $parent_id = $post->post_parent;
        $breadcrumbs = array();
        
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '" rel="v:url" property="v:title">' . get_the_title($page->ID) . '</a>';
            $parent_id = $page->post_parent;
        }
        
        $breadcrumbs = array_reverse($breadcrumbs);
        
        foreach ($breadcrumbs as $crumb) echo $crumb . '' . $delimiter;
        
        echo get_the_title();
    } 
    elseif (is_attachment()) {
        
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $cat = $cat[0];
        
        /* admin@innodron.com patch:
                Fix for Catchable fatal error: Object of class WP_Error could not be converted to string
                ref: https://wordpress.org/support/topic/catchable-fatal-error-object-of-class-wp_error-could-not-be-converted-to-string-11
        */
        echo is_wp_error($cat_parents = get_category_parents($cat, TRUE, '' . $delimiter . '')) ? '' : $cat_parents;
        
        /* end admin@innodron.com patch */
        echo '<a href="' . esc_url( get_permalink($parent) ) . '" rel="v:url" property="v:title">' . esc_html( $parent->post_title ) . '</a>' . $delimiter;
        echo get_the_title();
    } 
    elseif (is_archive()) {
        $custom_archive_title = post_type_archive_title('', false);
        echo esc_html( $custom_archive_title );
    } 
    elseif (is_search()) {
        
        echo esc_html__( 'Search results for &ldquo;', 'mk_framework' ) . esc_html( get_search_query() ) . '&rdquo;';
    } 
    elseif (is_tag()) {
        
        echo esc_html__( 'Tag &ldquo;', 'mk_framework' ) . esc_html( single_tag_title('', false) ) . '&rdquo;';
    } 
    elseif (is_author()) {
        
        $userdata = get_userdata(get_the_author_meta('ID'));
        echo esc_html__( 'Author:', 'mk_framework' ) . ' ' . esc_html( $userdata->display_name );
    } 
    elseif (is_day()) {
        
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo '<a href="' . get_month_link(get_the_time('Y') , get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $delimiter;
        echo get_the_time('d');
    } 
    elseif (is_month()) {
        
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $delimiter;
        echo get_the_time('F');
    } 
    elseif (is_year()) {
        
        echo get_the_time('Y');
    }
    
    if (get_query_var('paged')) echo ' (' . esc_html__( 'Page', 'mk_framework' ) . ' ' . get_query_var('paged') . ')';
    
    if (is_tax()) {
        $term = get_term_by('slug', get_query_var('term') , get_query_var('taxonomy'));
        if (function_exists('is_woocommerce') && is_woocommerce() && is_archive()) {
            echo $delimiter;
        }
        
        echo '<span>' . esc_html( $term->name ) . '</span>';
    }
    
    if (function_exists('is_bbpress') && is_bbpress()) {
        $item = array();
        
        $post_type_object = get_post_type_object(bbp_get_forum_post_type());
        
        if (!empty($post_type_object->has_archive) && !bbp_is_forum_archive()) {
            $item[] = '<a href="' . esc_url( get_post_type_archive_link(bbp_get_forum_post_type()) ) . '" rel="v:url" property="v:title">' . esc_html( bbp_get_forum_archive_title() ) . '</a>';
        }
        
        if (bbp_is_forum_archive()) {
            $item[] = bbp_get_forum_archive_title();
        } 
        elseif (bbp_is_topic_archive()) {
            $item[] = bbp_get_topic_archive_title();
        } 
        elseif (bbp_is_single_view()) {
            $item[] = bbp_get_view_title();
        } 
        elseif (bbp_is_single_topic()) {
            
            $topic_id = get_queried_object_id();
            
            $item = array_merge($item, mk_breadcrumbs_get_parents(bbp_get_topic_forum_id($topic_id)));
            
            if (bbp_is_topic_split() || bbp_is_topic_merge() || bbp_is_topic_edit()) $item[] = '<a href="' . esc_url( bbp_get_topic_permalink($topic_id) ) . '" rel="v:url" property="v:title">' . esc_html( bbp_get_topic_title($topic_id) ) . '</a>';
            else $item[] = bbp_get_topic_title($topic_id);
            
            if (bbp_is_topic_split()) $item[] = esc_html__( 'Split', 'mk_framework' );
            elseif (bbp_is_topic_merge()) $item[] = esc_html__( 'Merge', 'mk_framework' );
            elseif (bbp_is_topic_edit()) $item[] = esc_html__( 'Edit', 'mk_framework' );
        } 
        elseif (bbp_is_single_reply()) {
            
            $reply_id = get_queried_object_id();
            
            $item = array_merge($item, mk_breadcrumbs_get_parents(bbp_get_reply_topic_id($reply_id)));
            
            if (!bbp_is_reply_edit()) {
                $item[] = bbp_get_reply_title($reply_id);
            } 
            else {
                $item[] = '<a href="' . esc_url( bbp_get_reply_url($reply_id) ) . '" rel="v:url" property="v:title">' . esc_html( bbp_get_reply_title($reply_id) ) . '</a>';
                $item[] = esc_html__( 'Edit', 'mk_framework' );
            }
        } 
        elseif (bbp_is_single_forum()) {
            
            $forum_id = get_queried_object_id();
            $forum_parent_id = bbp_get_forum_parent_id($forum_id);
            
            if (0 !== $forum_parent_id) $item = array_merge($item, mk_breadcrumbs_get_parents($forum_parent_id));
            
            $item[] = bbp_get_forum_title($forum_id);
        } 
        elseif (bbp_is_single_user() || bbp_is_single_user_edit()) {
            
            if (bbp_is_single_user_edit()) {
                $item[] = '<a href="' . esc_url( bbp_get_user_profile_url() ) . '" rel="v:url" property="v:title">' . esc_html( bbp_get_displayed_user_field('display_name') ) . '</a>';
                $item[] = esc_html__( 'Edit', 'mk_framework' );
            } 
            else {
                $item[] = bbp_get_displayed_user_field('display_name');
            }
        }
        
        echo implode($delimiter, $item);
    }
    echo '</span>';
    echo '</span></span>';
}

echo "</div></div>";
