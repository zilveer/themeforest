<?php
/**
 * Search feature in this theme is supposed to search in 'post' only.
 * Excludes additional post types from search.
 *
 * @return object Filtered $query.
 */
function flow_remove_pages_from_search() {
    global $wp_post_types;
	$wp_post_types['page']->exclude_from_search = true;
	$wp_post_types['attachment']->exclude_from_search = true;
}
add_action( 'pre_get_posts', 'flow_remove_pages_from_search' );
