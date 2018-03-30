<?php
/**
 */

/**
 * Generates a span html tag that contains breadcrumbs that link to the current post or page.
 *
 * @package API\Links
 * @link http://dimox.net/wordpress-breadcrumbs-without-a-plugin/ inspired by, but altered a lot
 * @param string $class A class string to add to the resulting breadcrumbs span tag
 * @param string $delimiter A string delimiter to be used for separating the crumbs
 * @param string $attrString A string of attributes to be appended to the breadcrumbs span tag
 * @return string A span element containing the breadcrumbs
 */
function bfi_breadcrumbs($class = '', $delimiter = '', $attrString = '') {
    global $post;
    if (!$delimiter) $delimiter = "<span class='delim'>/</span>";
    $label = '<span>%s</span>';
    $current = '<span class="current">%s</span>';
    $currentPage = '<span class="current-page">%s</span>';
    $homeLink = sprintf('<span><a href="%1$s" rel="prev">%2$s</a></span>', home_url(), __("Home", BFI_I18NDOMAIN));
    $link = '<span><a href="%1$s" rel="prev">%2$s</a></span>';
    $crumbs = array();
    
    // is_home() does not work here
    $isHome = isset($post) && !is_search() && $post->ID == bfi_get_option(BFI_FRONTPAGEOPTION);
    if ($isHome) return '';
    if (is_home()) return '';
    
    else $crumbs[] = $homeLink;

    if (is_search()) {
        $crumbs[] = sprintf($label, __("Search", BFI_I18NDOMAIN), get_search_query());
        $crumbs[] = sprintf($current, get_search_query());
        
    } else if (is_404()) {
        $crumbs[] = sprintf($current, __("Error 404", BFI_I18NDOMAIN));
        
    } else if (is_category()) {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $thisCat = $cat_obj->term_id;
        $thisCat = get_category($thisCat);
        $parentCat = get_category($thisCat->parent);
      
        $crumbs[] = sprintf($label, __("Posts in categories", BFI_I18NDOMAIN));
        if ($thisCat->parent != 0) $crumbs[] = get_category_parents($parentCat, true, $delimiter);
        $crumbs[] = sprintf($current, single_cat_title('', false));
    
    } elseif (is_day()) {
        $crumbs[] = sprintf($label, __("Posts by date", BFI_I18NDOMAIN));
        $crumbs[] = sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
        $crumbs[] = sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
        $crumbs[] = sprintf($current, get_the_time('d'));
        
    } else if (is_month()) {
        $crumbs[] = sprintf($label, __("Posts by date", BFI_I18NDOMAIN));
        $crumbs[] = sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
        $crumbs[] = sprintf($current, get_the_time('F'));
        
    } else if (is_year()) {
        $crumbs[] = sprintf($label, __("Posts by year", BFI_I18NDOMAIN));
        $crumbs[] = sprintf($current, get_the_time('Y'));
        
    } else if (is_tag()) {
        $crumbs[] = sprintf($label, __("Posts with tags", BFI_I18NDOMAIN));
        $crumbs[] = sprintf($current, single_tag_title('', false));
        
    } else if (is_author()) {
        global $author;
        $userdata = get_userdata($author);
        $crumbs[] = sprintf($label, __("Posts by author", BFI_I18NDOMAIN));
        $crumbs[] = sprintf($current, $userdata->display_name);
        
    } else if (is_single() && !is_attachment()) {
        // non-blog post
        if (get_post_type() != "post") {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            $crumbs[] = sprintf($link, home_url() . '/' . $slug['slug'], $post_type->labels->singular_name);
            $crumbs[] = sprintf($current, get_the_title());
        // blog post
        } else {
            $cat = get_the_category(); 
            if (count($cat)) {
                $cat = $cat[0];
                $crumb = get_category_parents($cat, true, '</span><span>');
                $crumb = substr($crumb, 0, strripos($crumb, '</span><span>'));
                $crumbs[] = sprintf($label, $crumb);
                unset($crumb);
            }
            $crumbs[] = sprintf($current, get_the_title());
        }
        
    } else if (!is_single() && !is_page() && get_post_type() != 'post') {
        global $wp_query;
        $cat_obj = $wp_query->get_queried_object();
        $tax_obj = get_taxonomy($cat_obj->taxonomy);
        $crumbs[] = sprintf($label, $tax_obj->labels->name);
        $crumbs[] = sprintf($current, $cat_obj->name);
      
    } else if (is_attachment()) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID);
        $crumbs[] = sprintf($label, __("Attachments", BFI_I18NDOMAIN)); 
        if (count($cat)) {
            $cat = $cat[0];
            $crumbs[] = get_category_parents($cat, true, $delimiter);
        }
        $crumbs[] = sprintf($current, get_the_title());
      
    } else if (is_page() && !$post->post_parent) {
        $crumbs[] = sprintf($current, get_the_title());

    } else if (is_page() && $post->post_parent) {
        $parent_id  = $post->post_parent;
        $subCrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $subCrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
            $parent_id  = $page->post_parent;
        }
        $subCrumbs = array_reverse($subCrumbs);
        foreach ($subCrumbs as $crumb) $crumbs[] = $crumb;
        unset($subCrumbs);
        $crumbs[] = sprintf($current, get_the_title());
        
    }
    
    
    // create additional breadcrumbs if paged
    if (get_query_var('paged') && get_query_var('paged') > 1) {
        if (is_search()) {
            $crumbs[] = sprintf($link, get_search_link(get_search_query()) , __("Page 1", BFI_I18NDOMAIN));
        } else if (is_category()) {
            global $wp_query;
            $obj = $wp_query->get_queried_object();
            $crumbs[] = sprintf($link, get_category_link($obj->cat_ID), __("Page 1", BFI_I18NDOMAIN));
        } else if (!is_single() && !is_page() && get_post_type() != 'post') {
            global $wp_query;
            $obj = $wp_query->get_queried_object();
            $crumbs[] = sprintf($link, get_term_link($obj), __("Page 1", BFI_I18NDOMAIN));
        } else if (is_author()) {
            global $wp_query;
            $obj = $wp_query->get_queried_object();
            $crumbs[] = sprintf($link, get_author_posts_url($obj->ID), __("Page 1", BFI_I18NDOMAIN));
        } else if (is_tag()) {
            global $wp_query;
            $obj = $wp_query->get_queried_object();
            $crumbs[] = sprintf($link, get_tag_link($obj), __("Page 1", BFI_I18NDOMAIN));
        } else if (is_year()) {
            $crumbs[] = sprintf($link, get_year_link(get_the_date('Y')), __("Page 1", BFI_I18NDOMAIN));
        } else if (is_month()) {
            $crumbs[] = sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), __("Page 1", BFI_I18NDOMAIN));
        } else if (is_day()) {
            $crumbs[] = sprintf($link, get_day_link(get_the_time('Y'), get_the_time('m'), get_the_time('d')), __("Page 1", BFI_I18NDOMAIN));
        } else {
            $crumbs[] = sprintf($link, get_permalink(), __("Page 1", BFI_I18NDOMAIN));
        }
        $crumbs[] = sprintf($currentPage, sprintf(__("Page %s", BFI_I18NDOMAIN), get_query_var('paged')));
    }
 
    echo "<small class='breadcrumbs $class' $attrString>".implode($delimiter, $crumbs)."</small>";
}
