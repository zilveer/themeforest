<?php

function breadcrumb() {
	
	if (is_home()) {
		echo '<li><a href=" ' . home_url() . ' ">';
		bloginfo( 'name' );
		echo '</a></li>';
		echo '<li><a>';
		echo 'Home';
		echo '</a></li>';
	}
	else {
		echo '<li><a href=" ' . home_url() . ' ">';
		bloginfo( 'name' );
		echo '</a></li>';
		if (is_category()) {
			$cate = single_cat_title('', false);
			$cat = get_cat_ID($cate);
			echo '<li>' . (get_category_parents($cat, TRUE, '', FALSE)) . '</li>';
		}
		elseif (is_archive() && !is_category()) {
			echo '<li><a>' . 'Archives' . '</a></li>';
		}
		elseif (is_search()) {
			echo '<li><a>' . 'Search results' . '</a></li>';
		}
		elseif (is_404()) {
			echo '<li><a>' . 'Page not found' . '</a></li>';
		}
		elseif (is_single()) {
			$category = get_the_category();
			$category_id = get_cat_ID($category[0]->cat_name);
			$cat_link = get_category_link($category_id);

         $show = 0;

         global $post;
         $cats = wp_get_post_categories($post->ID);

         foreach (get_pages() as $p)
         {
            $pp = new Portfolio(array("post" => $p->ID));
            $c = $pp->get_cat();
            if (in_array($c, $cats)) $show = 1;
         }


         if ($show)
            echo '<li><a href=" ' . $cat_link . ' ">' . $category[0]->cat_name . '</a></li>';
			echo '<li><a>';
			echo the_title() . '</a></li>';
		}
		elseif (is_page()) {
			global $wp_query;
			global $post;
			$parent = get_page($post->post_parent);
			if ($parent->post_parent) {
				$children = $post->post_title;
				$parent = get_page($post->post_parent);
				$grand_parent = $parent->post_parent;
				$parent_link = get_permalink($parent);
				$grand_parent_link = get_permalink($grand_parent);
				echo '<li><a href="' . $grand_parent_link . '">' . get_the_title($grand_parent) . '</a></li>' . '<li><a href="' . $parent_link . '">' . $parent->post_title . '</a></li>' . '<li>' . $children . '</li>';
			}
			elseif ($post->post_parent) {
				$children = $post->post_title;
				$parent = get_page($post->post_parent);
				$parent_link = get_permalink($parent);
				echo '<li><a href="' . $parent_link . '">' . $parent->post_title . '</a></li>' . '<li><a>' . $children . '</a></li>';
			}
			elseif ($post->post_parent == 0) {
				echo '<li><a>';
				echo get_the_title($post) . '</a></li>';
			}
		}

	}
}


?>
