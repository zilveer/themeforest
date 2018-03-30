<?php
/**
 */

/**
 * Gets the current URL. Insipred by all in one seo pack
 *
 * @package API\Links
 * @return string The current URL
 */
function bfi_get_current_url() {
    global $wp_query;
    
    if ($wp_query->is_404) return false;
	
	$haspost = count($wp_query->posts) > 0;

    if ($wp_query->is_search) {
        $link = trailingslashit(site_url()).'?s='.get_search_query();
	} elseif (get_query_var('m')) {
		$m = preg_replace('/[^0-9]/', '', get_query_var('m'));
		switch (strlen($m)) {
			case 4: 
			$link = get_year_link($m);
			break;
    		case 6: 
        	$link = get_month_link(substr($m, 0, 4), substr($m, 4, 2));
        	break;
    		case 8: 
        	$link = get_day_link(substr($m, 0, 4), substr($m, 4, 2), substr($m, 6, 2));
            break;
   			default:
   			return false;
		}
		
	} elseif (($wp_query->is_single || $wp_query->is_page) && $haspost) {
		$post = $wp_query->posts[0];
		$link = get_permalink($post->ID);
		
	} elseif (($wp_query->is_single || $wp_query->is_page) && $haspost) {
		$post = $wp_query->posts[0];
		$link = get_permalink($post->ID);
		
	} elseif ($wp_query->is_author && $haspost) {
		$author = get_userdata(get_query_var('author'));
		if ($author === false)
			return false;
		$link = get_author_posts_url($author->ID, $author->user_nicename);
  		
	} elseif ($wp_query->is_category && $haspost) {
		$link = get_category_link(get_query_var('cat'));
		
	} else if ($wp_query->is_tag  && $haspost) {
		$tag = get_term_by('slug',get_query_var('tag'),'post_tag');
   		if (!empty($tag->term_id)) {
			$link = get_tag_link($tag->term_id);
		} 
		
	} elseif ($wp_query->is_day && $haspost) {
		$link = get_day_link(get_query_var('year'),
                             get_query_var('monthnum'),
                             get_query_var('day'));
                             
    } elseif ($wp_query->is_month && $haspost) {
        $link = get_month_link(get_query_var('year'),
                               get_query_var('monthnum'));
                               
    } elseif ($wp_query->is_year && $haspost) {
        $link = get_year_link(get_query_var('year'));
        
	} elseif ($wp_query->is_home) {
        if ((get_option('show_on_front') == 'page') &&
            ($pageid = get_option('page_for_posts'))) {
            $link = get_permalink($pageid);
			$link = trailingslashit($link);
		} else {
			if ( function_exists( 'icl_get_home_url' ) ) {
				$link = icl_get_home_url();
			} else {
				$link = home_url();
			}
			$link = trailingslashit($link);
		}
		
	} elseif ($wp_query->is_tax && $haspost ) {
		$taxonomy = get_query_var( 'taxonomy' );
		$term = get_query_var( 'term' );
		$link = get_term_link( $term, $taxonomy );
		
    } elseif ( $wp_query->is_archive && function_exists( 'get_post_type_archive_link' ) && ( $post_type = get_query_var( 'post_type' ) ) ) {
        $link = get_post_type_archive_link( $post_type );
            
	} else {
        return false;
	}
	
	// Add the page variable
    $page = get_query_var('paged');
    if ($page && $page > 1) {
        $link = bfi_add_get_var($link, 'paged', $page);
    }
    return $link;
}
