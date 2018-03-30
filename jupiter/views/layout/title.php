<?php

/**
 * template part for Page Title. views/layout
 *
 * @author 		Artbees
 * @package 	jupiter/views
 * @version     5.0.0
 */

global $mk_options;
$align = $title = $subtitle = $shadow_css = '';

$post_id = global_get_post_id();

if (is_singular('product') && $mk_options['woocommerce_single_product_title'] == 'false') return false;

if (is_singular('employees')) return false;

if($view_params['is_shortcode']) return false;

if (mk_get_blog_single_style() == 'bold') return false;


if ($post_id && in_array(get_post_meta($post_id, '_template', true), array(
    'no-title',
    'no-header-title',
    'no-header-title-footer',
    'no-footer-title'
))) {
    return false;
}

if ($post_id && is_page()   &&  $mk_options['page_title_global'] == 'false' ) {
    return false;
}

if ((global_get_post_id() && get_post_meta($post_id, '_enable_slidehsow', true) == 'true') || is_404()) {
    return false;
}


if ($post_id) {
    $custom_page_title = get_post_meta($post_id, '_custom_page_title', true);
    if (!empty($custom_page_title)) {
        $title = $custom_page_title;
    } else {
        $title = get_the_title($post_id);
    }
    $subtitle = get_post_meta($post_id, '_page_introduce_subtitle', true);
    $align    = get_post_meta($post_id, '_introduce_align', true);
} else {
    $title = get_the_title();
}

/* Loads Archive Page Headings */
if (is_archive()) {
    $title = $mk_options['archive_page_title'];
    if (is_category()) {
        $title = single_cat_title('', false);
        $subtitle = strip_tags(category_description());
    } elseif (is_tag()) {
        $subtitle = sprintf(__('Tag Archives for: "%s"', 'mk_framework'), single_tag_title('', false));
    } elseif (is_day()) {
        $subtitle = sprintf(__('Daily Archive for: "%s"', 'mk_framework'), get_the_time('F jS, Y'));
    } elseif (is_month()) {
        $subtitle = sprintf(__('Monthly Archive for: "%s"', 'mk_framework'), get_the_time('F, Y'));
    } elseif (is_year()) {
        $subtitle = sprintf(__('Yearly Archive for: "%s"', 'mk_framework'), get_the_time('Y'));
    } elseif (is_author()) {
        if (get_query_var('author_name')) {
            $curauth = get_user_by('slug', get_query_var('author_name'));
        } else {
            $curauth = get_userdata(get_query_var('author'));
        }
            $subtitle = sprintf(__('Author Archive for: "%s"'), $curauth->nickname);
    } elseif (is_tax()) {
        $term  = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $title = $term->name;
        $subtitle = strip_tags($term->description);
    }
    if ($mk_options['archive_disable_subtitle'] == 'false' && get_post_type() == 'post') {
        $subtitle = '';
    }

    // Will add the custom post type archive title in archive loop.
    $custom_archive_title = post_type_archive_title('', false);
    if(get_post_type() != 'post' && !empty($custom_archive_title)) {
         $title =  __( $custom_archive_title, 'mk_framework');
    }
}

if (function_exists('is_bbpress') && is_bbpress()) {
    if (bbp_is_forum_archive()) {
        $title = bbp_get_forum_archive_title();
    } elseif (bbp_is_topic_archive()) {
        $title = bbp_get_topic_archive_title();
    } elseif (bbp_is_single_view()) {
        $title = bbp_get_view_title();
    } elseif (bbp_is_single_forum()) {
        
        $forum_id        = get_queried_object_id();
        $forum_parent_id = bbp_get_forum_parent_id($forum_id);
        
        $title = bbp_get_forum_title($forum_id);
    } elseif (bbp_is_single_topic()) {
        $topic_id = get_queried_object_id();
        $title    = bbp_get_topic_title($topic_id);
    } elseif (bbp_is_single_user() || bbp_is_single_user_edit()) {
        
        $title = bbp_get_displayed_user_field('display_name');
    }
}

if (function_exists('is_woocommerce') && is_woocommerce() && !empty($post_id)) {
    ob_start();
    woocommerce_page_title();
    $title = ob_get_clean();
}

if (function_exists('is_woocommerce') && is_woocommerce()) {
    $title = __('Shop', 'mk_framework');
    //
    if (is_archive() || is_singular('product')) {
        $title = (isset($mk_options['woocommerce_category_page_title']) && !empty($mk_options['woocommerce_category_page_title'])) ? $mk_options['woocommerce_category_page_title'] : $title;
    }
    if(is_archive()) {
        $title = ($mk_options['woocommerce_use_category_title'] == 'true') ? single_cat_title('', false) :  $title;
    }
    if (is_tag()) {
        $title = ($mk_options['woocommerce_use_category_title'] == 'true') ? single_tag_title('', false) :  $title;
    }
    if( is_singular('product')) {
        $title = ($mk_options['woocommerce_use_product_title'] == 'true') ? get_the_title() :  $title;
    }
}

/* Loads Search Page Headings */
if (is_search()) {
    $title     = $mk_options['search_page_title'];
    $subtitle = sprintf(__('Search Results for: "%s"', 'mk_framework'), stripslashes(strip_tags(get_search_query())));
    
    if ($mk_options['search_disable_subtitle'] == 'false') {
        $subtitle = '';
    }
}
if ($mk_options['page_title_shadow'] == 'true') {
    $shadow_css = 'mk-drop-shadow';
}

$align = !empty($align) ? $align : 'left';

echo '<section id="mk-page-introduce" class="intro-' . esc_attr( $align ) . '">';
echo '<div class="mk-grid">';
if (!empty($title)) {
    echo '<h1 class="page-title ' . esc_attr( $shadow_css ) . '">' . esc_html( $title ) . '</h1>';
}

if (!empty($subtitle)) {
    echo '<div class="page-subtitle">';
    echo esc_html( $subtitle );
    echo '</div>';
}
if ($mk_options['disable_breadcrumb'] == 'true') {
    if (get_post_meta($post_id, '_disable_breadcrumb', true) != 'false') {
        
        mk_get_view('layout', 'breadcrumb');
    }
}

echo '<div class="clearboth"></div></div></section>';
