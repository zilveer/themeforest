<?php
function is_custom_post() {
	global $wp_query;
	if (!isset($wp_query->query_vars['post_type']))
		return false;
	$post_type = $wp_query->query_vars['post_type'];
	if ( is_array($post_type) ) {
		if ( count($post_type) > 1 )
			return false;

		$post_type = $post_type[0];
	}

	if ( !is_string($post_type) )
		return;

	$post_type = get_post_type_object( $post_type );

	if ( !is_null( $post_type ) && $post_type->_builtin == false && $post_type->public == true && isset($post_type->rewrite['slug']) && !empty($post_type->rewrite['slug']) )
		return $post_type;

	return false;
}

function get_term_parents( $term, $separator = '/', $visited = array() ) {
	$chain = '';
	$parent = &get_term((int)$term->parent, $term->taxonomy );
	if ( !is_wp_error( $parent ) && !in_array( $parent->parent, $visited ) ) {
		$visited[] = $term->term_id;
		$chain .= get_term_parents( $parent, $separator, $visited );
	}

	$chain .= '<a href="' . get_term_link( $term, $term->taxonomy ) . '" title="' . esc_attr( sprintf( __( 'View all posts in %s' ), $term->name ) ) . '">'.$term->name.'</a>' . $separator;
	return $chain;
}

function theme_breadcrumbs() {
	$delimiter = '&raquo;';
	$name = __('Home', TEMPLATENAME);
	$currentBefore = '<span class="current">';
	$currentAfter = '</span>';

	if ( !is_home() && !is_front_page() || is_paged() ) {

		echo '<div id="breadcrumbs">';

		global $post;
		$home = home_url();
		echo '<a href="' . $home . '">' . $name . '</a> ' . $delimiter . '&nbsp;';

		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0)
				echo(get_category_parents($parentCat, TRUE, '&nbsp;' . $delimiter . '&nbsp;'));
			echo $currentBefore . __('Archive by category:', TEMPLATENAME) . '&nbsp;&#39;';
			single_cat_title();
			echo '&#39;' . $currentAfter;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '&nbsp;';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '&nbsp;';
			echo $currentBefore . get_the_time('d') . $currentAfter;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '&nbsp;';
			echo $currentBefore . get_the_time('F') . $currentAfter;

		} elseif ( is_year() ) {
			echo $currentBefore . get_the_time('Y') . $currentAfter;

		} elseif (is_tax()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			if ($term->parent != 0) {
				$parent = &get_term((int)$term->parent, $term->taxonomy );
				echo get_term_parents($parent, '&nbsp;' . $delimiter . '&nbsp;');
			}
			echo $currentBefore . __('Posts classified under:', TEMPLATENAME) . '&nbsp;&#39;';
			echo $term->name;
			echo '&#39;' . $currentAfter;
		} elseif ($post_type = is_custom_post()) {
			if (is_single()) {
				echo '<a href="'.home_url($post_type->rewrite['slug']).'">'.$post_type->label.'</a>'.$delimiter.'&nbsp;';
				$tax_names = get_post_taxonomies($post->ID);
				foreach($tax_names as $tax_name) {
					$tax = get_taxonomy($tax_name);
					if ($tax->hierarchical) {
						break;
					}
				}
				$cat = get_the_terms(null, $tax_name); $cat = reset($cat);
				echo get_term_parents($cat, '&nbsp;' . $delimiter . '&nbsp;');
				echo $currentBefore;
				the_title();
				echo $currentAfter;
			} else {
				echo $currentBefore;
				echo $post_type->label;
				echo $currentAfter;
			}
		} elseif ( is_single() && !is_attachment() ) {
			$cat = get_the_category(); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, '&nbsp;' . $delimiter . '&nbsp;');
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			echo get_category_parents($cat, TRUE, '&nbsp;' . $delimiter . '&nbsp;');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . '&nbsp;';
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif ( is_page() && !$post->post_parent ) {
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . '&nbsp;' . $delimiter . '&nbsp;';
			echo $currentBefore;
			the_title();
			echo $currentAfter;

		} elseif ( is_search() ) {
			echo $currentBefore . __('Search results for:', TEMPLATENAME) . '&nbsp;&#39;' . get_search_query() . ' &#39;' . $currentAfter;

		} elseif ( is_tag() ) {
			echo $currentBefore . __('Posts tagged:', TEMPLATENAME) . '&nbsp;&#39;';
			single_tag_title();
			echo '&#39;' . $currentAfter;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $currentBefore . __('Articles posted by:', TEMPLATENAME) . '&nbsp;' . $userdata->display_name . $currentAfter;

		} elseif ( is_404() ) {
			echo $currentBefore . __('Error 404', TEMPLATENAME) . $currentAfter;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
			echo __('Page') . '&nbsp;' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
		}

		echo '</div>';

	}

}
?>