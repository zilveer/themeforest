<?php
function df_breadcrumbs() {
 	wp_reset_query();
	$delimiter = '';
	$name = __('Home', THEME_NAME); //text for the 'Home' link
	$currentBefore = '<li>';
	$currentAfter = '</li>';

  if ( !is_home() && !is_front_page() || is_paged() || (DF_page_id() == get_option('page_for_posts'))) {
 
		echo '<ul class="breadcrumb">';

		global $post;
		$home = get_home_url();
		echo '<li><a href="' . $home . '">' . $name . '</a></li>' . $delimiter . ' ';
 
    if ( is_category() ) {
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) echo "<li>".(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '))."</li>";
		echo "<li>".single_cat_title('', false)."</li>";
 
    }
    if ( is_day() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter . ' ';
		echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>' . $delimiter . ' ';
		echo $currentBefore . get_the_time('d') . $currentAfter;
 
    }

    if ( is_month() ) {
		echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter . ' ';
		echo $currentBefore . get_the_time('F') . $currentAfter;
 
    }

    if ( is_year() ) {
		echo $currentBefore . get_the_time('Y') . $currentAfter;
 
    }

    if ( is_single() ) {
		if(get_the_category()) {
			$cat = get_the_category(); $cat = $cat[0];
		} else {
			$cat = false;
		}
		$pageType = get_query_var( 'post_type' );
		$terms = get_terms( $pageType.'-cat', 'orderby=count&hide_empty=0' );
		if($cat) {
			$categorys = explode("|",get_category_parents($cat, TRUE, '|' . $delimiter . ''),-1); 
			foreach($categorys as $category) echo "<li>".$category."</li>";
		} elseif (!$cat && is_array($terms)) {
			if(isset($terms[0]->slug)) {
				$breadcrumbs.=$currentBefore . "<a href=".get_term_link( $terms[0]->slug, $pageType."-cat" ).">".$terms[0]->name."</a>".$currentAfter.$delimiter;
			}
		}
		echo $currentBefore;
		the_title();
		echo $currentAfter;
 
    }

    if ( is_page() && !$post->post_parent ) {
		echo $currentBefore;
		the_title();
		echo $currentAfter;
 
    }

    if ( is_page() && $post->post_parent ) {
		$parent_id = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
			$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) echo $crumb . '' . $delimiter . '';
		echo $currentBefore;
		the_title();
		echo $currentAfter;
 
    }
    if ( is_search() ) {
		echo $currentBefore . get_search_query() . $currentAfter;
    }
    if ( is_tag() ) {
		echo $currentBefore.single_tag_title().$currentAfter;
    }
    if ( is_author() ) {
		global $author;
		$userdata = get_userdata($author);
		echo $currentBefore . $userdata->display_name . $currentAfter;
    }
    if ( is_404() ) {
		echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if( DF_page_id() == get_option('page_for_posts')) {
		echo $currentBefore .get_the_title(DF_page_id()). $currentAfter;
	}
	if (is_tax()) {
		echo $currentBefore;
		global $wp_query;
		$term =	$wp_query->queried_object;
		echo $term->name;
      echo $currentAfter;
	}
 	
    if ( get_query_var('paged') ) {
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		echo __('Page', THEME_NAME) . ' ' . get_query_var('paged');
		if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</ul>';
 
  }
}
?>