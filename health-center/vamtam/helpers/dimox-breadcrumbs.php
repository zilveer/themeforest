<?php

function dimox_breadcrumbs($delimiter = '&gt;') {
	global $post;

	$home = __('Home', 'health-center');
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb
	$delim_before = " <span class='delim'>";
	$delim_after = "</span> ";
	$delimiter = $delim_before.$delimiter.$delim_after;

 	$homeLink = home_url();

 	if ( wpv_has_woocommerce() && is_woocommerce() ) {
		woocommerce_breadcrumb( array(
			'delimiter' => $delimiter,
			'wrap_before' => '',
			'wrap_after' => '',
			'before' => '',
			'after' => '',
			'home' => $home,
		) );

		return;
	}

   	echo '<a href="' . $homeLink . '">' . $home . '</a> '.$delimiter;

	if ( (!is_home() && !is_front_page()) || is_paged() ) {


		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = get_category($cat_obj->term_id);
			$parentCat = get_category($thisCat->parent);
      		if ($thisCat->parent != 0)
      			echo get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');

      		echo $before . __('Archive by category', 'health-center').' "' . single_cat_title('', false) . '"' . $after;

		} elseif ( is_day() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			$post_type = get_post_type_object(get_post_type());

			if ( get_post_type() != 'post' ) {
				if(get_post_type() == 'portfolio') {
					echo '<a href="' . wpv_get_option('portfolio-all-items') . '/">' . $post_type->labels->singular_name . '</a> ';
				} else {
					$slug = $post_type->rewrite;
					echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ';
				}

				echo $delim_before.': '.$delim_after;
				echo $before . get_the_title() . $after;
			} else {
				echo '<a href="' . wpv_get_option('post-all-items') . '/">' . __('Blog', 'health-center') . '</a> ';
				$cat = get_the_category();
				if(isset($cat[0])) {
					echo $delimiter.' ';
					$cat = $cat[0];
					if($cat !== null)
						get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
					echo "<a href='".get_category_link($cat->term_id)."' title='{$cat->name}'>{$cat->name}</a>";
				}
				echo $delim_before.': '.$delim_after;
        		echo $before . get_the_title() . $after;
      		}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && is_object($post)) {
			$post_type = get_post_type_object(get_post_type());
			echo $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID);
			if(count($cat) && $cat[0] !== null)
				get_category_parents($cat[0], TRUE, ' ' . $delimiter . ' ');
			echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			echo implode(" $delimiter ", $breadcrumbs);
			echo $delim_before.': '.$delim_after;
			echo $before . get_the_title() . $after;

		} elseif ( is_search() ) {
			echo $before . __('Search results for', 'health-center').' "' . get_search_query() . '"' . $after;

		} elseif ( is_tag() ) {
			echo $before . __('Posts tagged', 'health-center').' "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . __('Articles posted by', 'health-center').' ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			echo $before . __('Error 404', 'health-center') . $after;
		}

		$paged = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');

		if ( $paged ) {
			$braced = (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author());
			if($braced)
				echo ' (';

			echo ' ('.__('Page', 'health-center') . ' ' . $paged.')';

			if($braced)
				echo ')';
    	}
	}
}