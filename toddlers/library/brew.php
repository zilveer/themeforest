<?php
/*
Author: Dan Brown
URL: danvswild.com
*/

// Read more text > bootstrap button

function my_more_link( $link, $link_button ) {

    return str_replace( $link_button, '<p><a href="' . get_permalink() . '" class="readmore btn btn-sm btn-primary ">' . __( 'Continue Reading...', 'toddlers' ) . ' </a> </p>', $link );
}

add_filter( 'the_content_more_link', 'my_more_link', 10, 2 );


// Bootstrap Style Pagination
// http://www.ericmmartin.com/pagination-function-for-wordpress/

function emm_paginate($args = null) {
    $defaults = array(
        'page' => null, 'pages' => null,
        'range' => 3, 'gap' => 3, 'anchor' => 1,
        'before' => '<div class="paginationwrap"><ul class="pagination">', 'after' => '</ul></div>',
        'nextpage' => __('&raquo;','toddlers'), 'previouspage' => __('&laquo','toddlers'),
        'echo' => 1
    );

  $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    if (!$page && !$pages) {
        global $wp_query;

        $page = get_query_var('paged');
        $page = !empty($page) ? intval($page) : 1;

        $posts_per_page = intval(get_query_var('posts_per_page'));
        $pages = intval(ceil($wp_query->found_posts / $posts_per_page));
    }

    $output = "";
    if ($pages > 1) {
        $output .= "$before";
        $ellipsis = "<li>...</li>";

        if ($page > 1 && !empty($previouspage)) {
            $output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
        }

        $min_links = $range * 2 + 1;
        $block_min = min($page - $range, $pages - $min_links);
        $block_high = max($page + $range, $min_links);
        $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
        $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

        if ($left_gap && !$right_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $pages, $page)
            );
        }
        else if ($left_gap && $right_gap) {
            $output .= sprintf('%s%s%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else if ($right_gap && !$left_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else {
            $output .= emm_paginate_loop(1, $pages, $page);
        }

        if ($page < $pages && !empty($nextpage)) {
            $output .= "<li><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
        }

        $output .= $after;
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 */

function emm_paginate_loop($start, $max, $page = 0) {
    $output = "";
    for ($i = $start; $i <= $max; $i++) {
        $output .= ($page === intval($i))
            ? "<li><span class='active'>$i</span></li>"
            : "<li><a href='" . get_pagenum_link($i) . "' class=''>$i</a></li>";
    }
    return $output;
}



function the_breadcrumbs() {

        global $post;

        if (!is_home() && (!is_front_page()) && (!is_search())&& (!is_tag())&& (!is_day())&& (!is_month())&& (!is_year())&& (!is_author())){
			echo'<div class="breadcrumbs hidden-sm hidden-xs">';
            echo "<a href='";
            echo home_url();
            echo "'>";
            echo get_bloginfo('name');
            echo "</a>";

            if (is_category() || is_single()) {

                echo " <span class='sep'>></span> ";

				$category = get_the_category();
				if($category[0]){
				echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
				}

                echo " <span class='sep'>></span> ";
                if (is_single()) {
                    the_title();
                }
            } elseif (is_page()) {

                if($post->post_parent){
                    $anc = get_post_ancestors( $post->ID );
                    $anc_link = get_page_link( $post->post_parent );

                    foreach ( $anc as $ancestor ) {
                        $output = " > <a href=".$anc_link.">".get_the_title($ancestor)."</a> <span class='sep'>></span> ";
                    }

                    echo $output;
                    the_title();

                } else {
                    echo '  <span class="sep">></span> ';
                    echo the_title();
                }
            }
            echo'</div>';
        }
}



// Checking if comment navigation is enabled
function page_has_comments_nav() {
 global $wp_query;
 return ($wp_query->max_num_comment_pages > 1);
}

//  Truncating Strings
//  Function Author:  8bit (Standard Theme)
/**
 * Truncates string at the last breakable space within the string at the
 * character limit and then adds the truncation indicator.
 *
 * @param        string $string                  The string to possibly truncate
 * @param        int $character_limit            Optional. The number of characters to limit the string to
 * @param        string $truncation_indicator    Optional. The characters to end truncation with (if needed)
 * @return        string The original or the truncated string based on the length of the original string.
 * @since        3.0
 * @version        3.0
 */

function brew_truncate_text( $string, $character_limit = 50, $truncation_indicator = '...' ) {

        $truncated = null == $string ? '' : $string;
    if ( strlen( $string ) >= ( $character_limit + 1 ) ) {

        $truncated = substr( $string, 0, $character_limit );

        if ( substr_count( $truncated, ' ') > 1 ) {
            $last_space = strrpos( $truncated, ' ' );
            $truncated = substr( $truncated, 0, $last_space );
        } // end if

        $truncated = $truncated . $truncation_indicator;

    } // end if/else

    return $truncated;

} // end brew_truncate_text


// customize author fields
function brew_contact_methods( $contactmethods ) {

    // This isn't 2004
    unset( $contactmethods[ 'aim' ] );
    unset( $contactmethods[ 'yim' ] );
    unset( $contactmethods[ 'jabber' ] );

    // Add some useful ones
    $contactmethods[ 'twitter' ] = 'Twitter Profile URL';
    $contactmethods[ 'facebook' ] = 'Facebook Profile URL';
    $contactmethods[ 'linkedin' ] = 'LinkedIn Public Profile URL';
    $contactmethods[ 'googleplus' ] = 'Google+ Profile URL';
    $contactmethods[ 'pinterest' ] = 'Pinterest Profile URL';

    return $contactmethods;
}

add_filter( 'user_contactmethods', 'brew_contact_methods' );
?>