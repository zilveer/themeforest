<?php

require_once(porto_functions . '/content_type/portfolio_like.php');
require_once(porto_functions . '/content_type/meta_values.php');
require_once(porto_functions . '/content_type/meta_fields.php');

function porto_get_meta_value($meta_key, $boolean = false) {
    global $wp_query, $porto_settings;

    $value = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($cat) $value = get_metadata('category', $cat->term_id, $meta_key, true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = get_post_meta(wc_get_page_id( 'shop' ), $meta_key, true);
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page() && ($archive_page = porto_portfolios_page_id())) {
            $value = get_post_meta($archive_page, $meta_key, true);
        } else if (function_exists('is_porto_members_page') && is_porto_members_page() && ($archive_page = porto_members_page_id())) {
            $value = get_post_meta($archive_page, $meta_key, true);
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page() && ($archive_page = porto_faqs_page_id())) {
            $value = get_post_meta($archive_page, $meta_key, true);
        } else {
            $term = get_queried_object();
            if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                $value = get_metadata($term->taxonomy, $term->term_id, $meta_key, true);
            }
        }
    } else {
        if (is_singular()) {
            $value = get_post_meta(get_the_id(), $meta_key, true);
        } else {
            if (!is_home() && is_front_page()) {
                if (isset($porto_settings[$meta_key]))
                    $value = $porto_settings[$meta_key];
            } else if (is_home() && !is_front_page()) {
                $blog_id = get_option( 'page_for_posts' );
                if ($blog_id)
                    $value = get_post_meta($blog_id, $meta_key, true);
                else if (isset($porto_settings['blog-'.$meta_key]))
                    $value = $porto_settings['blog-'.$meta_key];
            } else if (is_home() || is_front_page()) {
                if (isset($porto_settings[$meta_key]))
                    $value = $porto_settings[$meta_key];
            }
        }
    }

    if ($boolean) {
        $value = ($value != $meta_key) ? true : false;
    }

    return apply_filters('porto_get_meta_value_' . $meta_key, $value);
}

function porto_meta_use_default() {
    global $wp_query;

    $value = '';

    if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($cat) $value = get_metadata('category', $cat->term_id, 'default', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = get_post_meta(wc_get_page_id( 'shop' ), 'default', true);
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page() && ($archive_page = porto_portfolios_page_id())) {
            $value = get_post_meta($archive_page, 'default', true);
        } else if (function_exists('is_porto_members_page') && is_porto_members_page() && ($archive_page = porto_members_page_id())) {
            $value = get_post_meta($archive_page, 'default', true);
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page() && ($archive_page = porto_faqs_page_id())) {
            $value = get_post_meta($archive_page, 'default', true);
        } else {
            $term = get_queried_object();
            if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                $value = get_metadata($term->taxonomy, $term->term_id, 'default', true);
            }
        }
    } else {
        if (is_singular()) {
            $value = get_post_meta(get_the_id(), 'default', true);
        }
    }

    return apply_filters('porto_meta_use_default', ($value != 'default') ? true : false);
}

function porto_meta_layout() {
    global $wp_query, $porto_settings;

    $value = isset($porto_settings['layout']) ? $porto_settings['layout'] : $porto_settings['layout'];
    $default = porto_meta_use_default();

    if ((class_exists('bbPress') && is_bbpress()) || (class_exists('BuddyPress') && is_buddypress())) {
        $value = $porto_settings['bb-layout'];
    } else if (is_404()) {
        $value = 'fullwidth';
    } else if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($default)
            $value = $porto_settings['post-archive-layout'];
        else
            if ($cat) $value = get_metadata('category', $cat->term_id, 'layout', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            if ($default)
                $value = $porto_settings['product-archive-layout'];
            else
                $value = get_post_meta(wc_get_page_id( 'shop' ), 'layout', true);
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page() && ($archive_page = porto_portfolios_page_id())) {
            if ($default)
                $value = $porto_settings['portfolio-archive-layout'];
            else
                $value = get_post_meta($archive_page, 'layout', true);
        } else if (function_exists('is_porto_members_page') && is_porto_members_page() && ($archive_page = porto_members_page_id())) {
            if ($default)
                $value = $porto_settings['member-archive-layout'];
            else
                $value = get_post_meta($archive_page, 'layout', true);
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page() && ($archive_page = porto_faqs_page_id())) {
            if ($default)
                $value = $porto_settings['faq-archive-layout'];
            else
                $value = get_post_meta($archive_page, 'layout', true);
        } else {
            if (is_post_type_archive('portfolio')) {
                $value = $porto_settings['portfolio-archive-layout'];
            } else if (is_post_type_archive('member')) {
                $value = $porto_settings['member-archive-layout'];
            } else if (is_post_type_archive('faq')) {
                $value = $porto_settings['faq-archive-layout'];
            } else {
                $term = get_queried_object();
                if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                    if ($default) {
                        switch ($term->taxonomy) {
                            case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                                $value = $porto_settings['portfolio-archive-layout'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('product')):
                                $value = $porto_settings['product-archive-layout'];
                                break;
                            case 'product_cat':
                                $value = $porto_settings['product-archive-layout'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('member')):
                                $value = $porto_settings['member-archive-layout'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                                $value = $porto_settings['faq-archive-layout'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('post')):
                                $value = $porto_settings['post-archive-layout'];
                                break;
                            default:
                                $value = $porto_settings['layout'];
                        }
                    } else {
                        $value = get_metadata($term->taxonomy, $term->term_id, 'layout', true);
                    }
                } else if (is_tag()) {
                    $value = $porto_settings['post-archive-layout'];
                }
            }
        }
    } else {
        if (is_singular()) {
            if ($default) {
                switch (get_post_type()) {
                    case 'product':
                        $value = $porto_settings['product-single-layout'];
                        break;
                    case 'portfolio':
                        $value = $porto_settings['portfolio-single-layout'];
                        break;
                    case 'member':
                        $value = $porto_settings['member-single-layout'];
                        break;
                    case 'post':
                        $value = $porto_settings['post-single-layout'];
                        break;
                    default:
                        $value = $porto_settings['layout'];
                }
            } else {
                $value = get_post_meta(get_the_id(), 'layout', true);
            }
        } else {
            if (!is_home() && is_front_page()) {
                $value = $porto_settings['layout'];
            } else if (is_home() && !is_front_page()) {
                    $value = $porto_settings['post-archive-layout'];
            } else if (is_home() || is_front_page()) {
                $value = $porto_settings['layout'];
            }
        }
    }

    return apply_filters('porto_meta_layout', $value);
}

function porto_meta_default_layout() {
    global $porto_settings;

    $value = isset($porto_settings['layout']) ? $porto_settings['layout'] : $porto_settings['layout'];

    if ((class_exists('bbPress') && is_bbpress()) || (class_exists('BuddyPress') && is_buddypress())) {
        $value = $porto_settings['bb-layout'];
    } else if (is_404()) {
        $value = 'fullwidth';
    } else if (is_category()) {
        $value = $porto_settings['post-archive-layout'];
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = $porto_settings['product-archive-layout'];
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page()) {
            $value = $porto_settings['portfolio-archive-layout'];
        } else if (function_exists('is_porto_members_page') && is_porto_members_page()) {
            $value = $porto_settings['member-archive-layout'];
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page()) {
            $value = $porto_settings['faq-archive-layout'];
        } else {
            if (is_post_type_archive('portfolio')) {
                $value = $porto_settings['portfolio-archive-layout'];
            } else if (is_post_type_archive('member')) {
                $value = $porto_settings['member-archive-layout'];
            } else if (is_post_type_archive('faq')) {
                $value = $porto_settings['faq-archive-layout'];
            } else {
                $term = get_queried_object();
                if ($term && isset($term->taxonomy)) {
                    switch ($term->taxonomy) {
                        case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                            $value = $porto_settings['portfolio-archive-layout'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('product')):
                            $value = $porto_settings['product-archive-layout'];
                            break;
                        case 'product_cat':
                            $value = $porto_settings['product-archive-layout'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('member')):
                            $value = $porto_settings['member-archive-layout'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                            $value = $porto_settings['faq-archive-layout'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('post')):
                            $value = $porto_settings['post-archive-layout'];
                            break;
                        default:
                            $value = $porto_settings['layout'];
                    }
                } else if (is_tag()) {
                    $value = $porto_settings['post-archive-layout'];
                }
            }
        }
    } else {
        if (is_singular()) {
            switch (get_post_type()) {
                case 'product':
                    $value = $porto_settings['product-single-layout'];
                    break;
                case 'portfolio':
                    $value = $porto_settings['portfolio-single-layout'];
                    break;
                case 'member':
                    $value = $porto_settings['member-single-layout'];
                    break;
                case 'post':
                    $value = $porto_settings['post-single-layout'];
                    break;
                default:
                    $value = $porto_settings['layout'];
            }
        } else {
            if (!is_home() && is_front_page()) {
                $value = $porto_settings['layout'];
            } else if (is_home() && !is_front_page()) {
                $value = $porto_settings['post-archive-layout'];
            } else if (is_home() || is_front_page()) {
                $value = $porto_settings['layout'];
            }
        }
    }

    return apply_filters('porto_meta_default_layout', $value);
}

function porto_meta_sidebar() {
    global $wp_query, $porto_settings;

    $layout = porto_meta_layout();
    if (!($layout == 'wide-left-sidebar' || $layout == 'wide-right-sidebar' || $layout == 'left-sidebar' || $layout == 'right-sidebar'))
        return '';

    $value = $porto_settings['sidebar'];
    $default = porto_meta_use_default();

    if ((class_exists('bbPress') && is_bbpress()) || (class_exists('BuddyPress') && is_buddypress())) {
        $value = $porto_settings['bb-sidebar'];
    } else if (is_404()) {
        $value = '';
    } else if (is_category()) {
        $cat = $wp_query->get_queried_object();
        if ($default)
            $value = 'blog-sidebar';
        else
            if ($cat) $value = get_metadata('category', $cat->term_id, 'sidebar', true);
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            if ($default)
                $value = 'woo-category-sidebar';
            else
                $value = get_post_meta(wc_get_page_id( 'shop' ), 'sidebar', true);
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page()) {
            $value = $porto_settings['portfolio-archive-sidebar'];
        } else if (function_exists('is_porto_members_page') && is_porto_members_page()) {
            $value = $porto_settings['member-archive-sidebar'];
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page()) {
            $value = $porto_settings['faq-archive-sidebar'];
        } else {
            if (is_post_type_archive('portfolio')) {
                $value = $porto_settings['portfolio-archive-sidebar'];
            } else if (is_post_type_archive('member')) {
                $value = $porto_settings['member-archive-sidebar'];
            } else if (is_post_type_archive('faq')) {
                $value = $porto_settings['faq-archive-sidebar'];
            } else {
                $term = get_queried_object();
                if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                    if ($default) {
                        switch ($term->taxonomy) {
                            case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                                $value = $porto_settings['portfolio-archive-sidebar'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('product')):
                                $value = 'woo-category-sidebar';
                                break;
                            case 'product_cat':
                                $value = 'woo-category-sidebar';
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('member')):
                                $value = $porto_settings['member-archive-sidebar'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                                $value = $porto_settings['faq-archive-sidebar'];
                                break;
                            case in_array($term->taxonomy, porto_get_taxonomies('post')):
                                $value = 'blog-sidebar';
                                break;
                            default:
                                $value = $porto_settings['sidebar'];
                        }
                    } else {
                        $value = get_metadata($term->taxonomy, $term->term_id, 'sidebar', true);
                    }
                } else if (is_tag()) {
                    $value = 'blog-sidebar';
                }
            }
        }
    } else {
        if (is_singular()) {
            global $post;
            if ($default) {
                switch ($post->post_type) {
                    case 'product':
                        $value = 'woo-product-sidebar';
                        break;
                    case 'portfolio':
                        $value = $porto_settings['portfolio-single-sidebar'];
                        break;
                    case 'member':
                        $value = $porto_settings['member-single-sidebar'];
                        break;
                    case 'post':
                        $value = 'blog-sidebar';
                        break;
                    default:
                        $value = $porto_settings['sidebar'];
                }
            } else {
                $value = get_post_meta(get_the_id(), 'sidebar', true);
            }
        } else {
                $value = 'blog-sidebar';
        }
    }

    return apply_filters('porto_meta_sidebar', $value);
}

function porto_meta_sticky_sidebar() {
    global $porto_settings;

    $value = $porto_settings['sticky-sidebar'];
    $default = porto_get_meta_value('sticky_sidebar');

    if ($default == 'yes')
        return true;

    if ($default == 'no')
        return false;

    if ((class_exists('bbPress') && is_bbpress()) || (class_exists('BuddyPress') && is_buddypress())) {
        $value = $porto_settings['bb-sticky-sidebar'];
    } else if (is_404()) {
        $value = false;
    } else if (is_category()) {
        $value = $porto_settings['post-archive-sticky-sidebar'];
    } else if (is_archive()) {
        if (function_exists('is_shop') && is_shop())  {
            $value = $porto_settings['product-archive-sticky-sidebar'];
        } else if (function_exists('is_porto_portfolios_page') && is_porto_portfolios_page()) {
            $value = $porto_settings['portfolio-archive-sticky-sidebar'];
        } else if (function_exists('is_porto_members_page') && is_porto_members_page()) {
            $value = $porto_settings['member-archive-sticky-sidebar'];
        } else if (function_exists('is_porto_faqs_page') && is_porto_faqs_page()) {
            $value = $porto_settings['faq-archive-sticky-sidebar'];
        } else {
            if (is_post_type_archive('portfolio')) {
                $value = $porto_settings['portfolio-archive-sticky-sidebar'];
            } else if (is_post_type_archive('member')) {
                $value = $porto_settings['member-archive-sticky-sidebar'];
            } else if (is_post_type_archive('faq')) {
                $value = $porto_settings['faq-archive-sticky-sidebar'];
            } else {
                $term = get_queried_object();
                if ($term && isset($term->taxonomy) && isset($term->term_id)) {
                    switch ($term->taxonomy) {
                        case in_array($term->taxonomy, porto_get_taxonomies('portfolio')):
                            $value = $porto_settings['portfolio-archive-sticky-sidebar'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('product')):
                            $value = $porto_settings['product-archive-sticky-sidebar'];
                            break;
                        case 'product_cat':
                            $value = $porto_settings['product-archive-sticky-sidebar'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('member')):
                            $value = $porto_settings['member-archive-sticky-sidebar'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('faq')):
                            $value = $porto_settings['faq-archive-sticky-sidebar'];
                            break;
                        case in_array($term->taxonomy, porto_get_taxonomies('post')):
                            $value = $porto_settings['post-archive-sticky-sidebar'];
                            break;
                    }
                } else if (is_tag()) {
                    $value = $porto_settings['post-archive-sticky-sidebar'];
                }
            }
        }
    } else {
        if (is_singular()) {
            global $post;
            switch ($post->post_type) {
                case 'product':
                    $value = $porto_settings['product-single-sticky-sidebar'];
                    break;
                case 'portfolio':
                    $value = $porto_settings['portfolio-single-sticky-sidebar'];
                    break;
                case 'member':
                    $value = $porto_settings['member-single-sticky-sidebar'];
                    break;
                case 'post':
                    $value = $porto_settings['post-single-sticky-sidebar'];
                    break;
            }
        }
    }

    return apply_filters('porto_meta_sticky_sidebar', $value);
}

function porto_get_taxonomies($content_type) {
    $args=array(
        'object_type' => array($content_type)
    );
    $output = 'names'; // or objects
    $operator = 'and'; // 'and' or 'or'
    $taxonomies = get_taxonomies($args, $output, $operator);
    return $taxonomies;
}

function porto_portfolio_sub_title($post = null) {
    if (!$post) {
        $post = $GLOBALS['post'];
    }

    $output = '';

    if ($post) {
        global $porto_settings;

        switch ($porto_settings['portfolio-subtitle']) {
            case 'like':
                $output .= porto_portfolio_like();
                break;
            case 'date':
                $output .= get_the_date('', $post);
                break;
            case 'cats':
                $terms = get_the_terms( $post->ID, 'portfolio_cat' );
                if ( !is_wp_error( $terms ) && !empty($terms) ) {
                    $links = array();
                    foreach ( $terms as $term ) {
                        $links[] = $term->name;
                    }
                    $output .= join( ', ', $links );
                }
                break;
            case 'skills':
                $terms = get_the_terms( $post->ID, 'portfolio_skills' );
                if ( !is_wp_error( $terms ) && !empty($terms) ) {
                    $links = array();
                    foreach ( $terms as $term ) {
                        $links[] = $term->name;
                    }
                    $output .= join( ', ', $links );
                }
                break;
            case 'location':
                $output .= get_post_meta($post->ID, 'portfolio_location', true);
                break;
            case 'client_name':
                $output .= get_post_meta($post->ID, 'portfolio_client', true);
                break;
            case 'client_link':
                $output .= get_post_meta($post->ID, 'portfolio_client_link', true);
                break;
            case 'author_name':
                $output .= get_post_meta($post->ID, 'portfolio_author_name', true);
                break;
            case 'author_role':
                $output .= get_post_meta($post->ID, 'portfolio_author_role', true);
                break;
        }
    }

    return apply_filters('porto_portfolio_sub_title', $output);
}