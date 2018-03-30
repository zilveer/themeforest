<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/3/2015
 * Time: 10:22 AM
 */
/*================================================
THE BREADCRUMB
================================================== */
if (!function_exists('g5plus_the_breadcrumb')) {
	function g5plus_the_breadcrumb() {
		g5plus_get_template('breadcrumb');
	}
}

/*================================================
GET BREADCRUMB
================================================== */
if (!function_exists('g5plus_get_breadcrumb')) {
	function g5plus_get_breadcrumb() {
		$items = g5plus_get_breadcrumb_items();
		$breadcrumbs = '<ul class="breadcrumbs">';
		$breadcrumbs .= join("", $items);
		$breadcrumbs .= '</ul>';

		echo wp_kses_post($breadcrumbs);
	}
}

/*================================================
GET BREADCRUMB ITEMS
================================================== */
if (!function_exists('g5plus_get_breadcrumb_items')) {
	function g5plus_get_breadcrumb_items() {
		global $wp_query;


		$on_front = get_option('show_on_front');

		$item = array();
		/* Front page. */
		if (is_front_page()) {
			$item['last'] = esc_html__('Home', 'g5plus-handmade' );
		}


		/* Link to front page. */
		if (!is_front_page()) {
			$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . home_url('/') . '" class="home">' . esc_html__('Home', 'g5plus-handmade' ) . '</a></li>';
		}

		/* If bbPress is installed and we're on a bbPress page. */
		if (function_exists('is_bbpress') && is_bbpress()) {
			$item = array_merge($item, g5plus_breadcrumb_get_bbpress_items());
		} elseif (function_exists('is_woocommerce') && is_woocommerce()) {
			$item = array_merge($item, g5plus_filter_breadcrumb_items());
		} /* If viewing a home/post page. */
		elseif (is_home()) {
			$home_page = get_post($wp_query->get_queried_object_id());
			$item = array_merge($item, g5plus_breadcrumb_get_parents($home_page->post_parent));
			$item['last'] = get_the_title($home_page->ID);
		} /* If viewing a singular post. */
		elseif (is_singular()) {

			$post = $wp_query->get_queried_object();
			$post_id = (int)$wp_query->get_queried_object_id();
			$post_type = $post->post_type;

			$post_type_object = get_post_type_object($post_type);

			if ('post' === $wp_query->post->post_type) {
				// $item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink( get_option( 'page_for_posts' ) ) . '">' . get_the_title( get_option( 'page_for_posts' ) ) . '</a></li>';
				$categories = get_the_category($post_id);
				$item = array_merge($item, g5plus_breadcrumb_get_term_parents($categories[0]->term_id, $categories[0]->taxonomy));
			}

			if ('page' !== $wp_query->post->post_type) {

				/* If there's an archive page, add it. */

				if (function_exists('get_post_type_archive_link') && !empty($post_type_object->has_archive))
					$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_post_type_archive_link($post_type) . '" title="' . esc_attr($post_type_object->labels->name) . '">' . $post_type_object->labels->name . '</a></li>';

				if (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]) && is_taxonomy_hierarchical($args["singular_{$wp_query->post->post_type}_taxonomy"])) {
					$terms = wp_get_object_terms($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"]);
					$item = array_merge($item, g5plus_breadcrumb_get_term_parents($terms[0], $args["singular_{$wp_query->post->post_type}_taxonomy"]));
				} elseif (isset($args["singular_{$wp_query->post->post_type}_taxonomy"]))
					$item[] = get_the_term_list($post_id, $args["singular_{$wp_query->post->post_type}_taxonomy"], '', ', ', '');
			}

			if ((is_post_type_hierarchical($wp_query->post->post_type) || 'attachment' === $wp_query->post->post_type) && $parents = g5plus_breadcrumb_get_parents($wp_query->post->post_parent)) {
				$item = array_merge($item, $parents);
			}

			$item['last'] = get_the_title();
		} /* If viewing any type of archive. */
		else if (is_archive()) {

			if (is_category() || is_tag() || is_tax()) {

				$term = $wp_query->get_queried_object();
				//$taxonomy = get_taxonomy( $term->taxonomy );

				if ((is_taxonomy_hierarchical($term->taxonomy) && $term->parent) && $parents = g5plus_breadcrumb_get_term_parents($term->parent, $term->taxonomy))
					$item = array_merge($item, $parents);

				$item['last'] = $term->name;
			} else if (function_exists('is_post_type_archive') && is_post_type_archive()) {
				$post_type_object = get_post_type_object(get_query_var('post_type'));
				$item['last'] = $post_type_object->labels->name;
			} else if (is_date()) {

				if (is_day())
					$item['last'] = esc_html__('Archives for ', 'g5plus-handmade' ) . get_the_time('F j, Y');

				elseif (is_month())
					$item['last'] = esc_html__('Archives for ', 'g5plus-handmade' ) . single_month_title(' ', false);

				elseif (is_year())
					$item['last'] = esc_html__('Archives for ', 'g5plus-handmade' ) . get_the_time('Y');
			} else if (is_author())
				$item['last'] = esc_html__('Archives by: ', 'g5plus-handmade' ) . get_the_author_meta('display_name', $wp_query->post->post_author);

		} /* If viewing search results. */
		else if (is_search())
			$item['last'] = esc_html__('Search results for "', 'g5plus-handmade' ) . stripslashes(strip_tags(get_search_query())) . '"';

		/* If viewing a 404 error page. */
		else if (is_404())
			$item['last'] = esc_html__('Page Not Found', 'g5plus-handmade' );


		if (isset($item['last'])) {
			$item['last'] = sprintf('<li><span>%s</span></li>', $item['last']);
		}


		return apply_filters('g5plus_framework_filter_breadcrumb_items', $item);
	}
}

/*================================================
FILTER BREADCRUMB ITEMS
================================================== */
if (!function_exists('g5plus_filter_breadcrumb_items')) {
	function g5plus_filter_breadcrumb_items()
	{
		$item = array();
		$shop_page_id = wc_get_page_id('shop');

		if (get_option('page_on_front') != $shop_page_id) {
			$shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
			if (!is_shop()) {
				$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
			} else {
				$item['last'] = $shop_name;
			}
		}

		if (is_tax('product_cat') || is_tax('product_tag')) {
			$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

		} elseif (is_product()) {
			global $post;
			$terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
			if ($terms) {
				$current_term = $terms[0];
			}

		}

		if (!empty($current_term)) {
			if (is_taxonomy_hierarchical($current_term->taxonomy)) {
				$item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
			}

			if (is_tax('product_cat') || is_tax('product_tag')) {
				$item['last'] = $current_term->name;
			} else {
				$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
			}
		}

		if (is_product()) {
			$item['last'] = get_the_title();
		}

		return apply_filters('g5plus_filter_breadcrumb_items', $item);
	}
}


/*================================================
GET BREADCRUMB BBPRESS ITEMS
================================================== */
if (!function_exists('g5plus_breadcrumb_get_bbpress_items')) {
	function g5plus_breadcrumb_get_bbpress_items()
	{
		$item = array();
		$shop_page_id = wc_get_page_id('shop');

		if (get_option('page_on_front') != $shop_page_id) {
			$shop_name = $shop_page_id ? get_the_title($shop_page_id) : '';
			if (!is_shop()) {
				$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink($shop_page_id) . '">' . $shop_name . '</a></li>';
			} else {
				$item['last'] = $shop_name;
			}
		}

		if (is_tax('product_cat') || is_tax('product_tag')) {
			$current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

		} elseif (is_product()) {
			global $post;
			$terms = wc_get_product_terms($post->ID, 'product_cat', array('orderby' => 'parent', 'order' => 'DESC'));
			if ($terms) {
				$current_term = $terms[0];
			}

		}

		if (!empty($current_term)) {
			if (is_taxonomy_hierarchical($current_term->taxonomy)) {
				$item = array_merge($item, g5plus_breadcrumb_get_term_parents($current_term->parent, $current_term->taxonomy));
			}

			if (is_tax('product_cat') || is_tax('product_tag')) {
				$item['last'] = $current_term->name;
			} else {
				$item[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link($current_term->term_id, $current_term->taxonomy) . '">' . $current_term->name . '</a></li>';
			}
		}

		if (is_product()) {
			$item['last'] = get_the_title();
		}

		return apply_filters('g5plus_filter_breadcrumb_items', $item);
	}
}

/*================================================
GET BREADCRUMB PARENTS
================================================== */
if (!function_exists('g5plus_breadcrumb_get_parents')) {
	function g5plus_breadcrumb_get_parents($post_id = '', $separator = '/')
	{
		$parents = array();

		if ($post_id == 0) {
			return $parents;
		}

		while ($post_id) {
			$page = get_post($post_id);
			$parents[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_permalink($post_id) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . get_the_title($post_id) . '</a></li>';
			$post_id = $page->post_parent;
		}

		if ($parents) {
			$parents = array_reverse($parents);
		}

		return $parents;
	}
}

/*================================================
GET BREADCRUMB TERM PARENTS
================================================== */
if (!function_exists('g5plus_breadcrumb_get_term_parents')) {
	function g5plus_breadcrumb_get_term_parents($parent_id = '', $taxonomy = '', $separator = '/')
	{
		$parents = array();

		if (empty($parent_id) || empty($taxonomy)) {
			return $parents;
		}

		while ($parent_id) {
			$parent = get_term($parent_id, $taxonomy);
			$parents[] = '<li typeof="v:Breadcrumb"><a rel="v:url" property="v:title" href="' . get_term_link($parent, $taxonomy) . '" title="' . esc_attr($parent->name) . '">' . $parent->name . '</a></li>';
			$parent_id = $parent->parent;
		}

		if ($parents) {
			$parents = array_reverse($parents);
		}

		return $parents;
	}
}

