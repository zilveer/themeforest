<?php
/**********************************
BREADCRUMB SCRIPT
**********************************/
/* Breadcrumb */
function epic_breadcrumbs($position) {
    if(current_theme_supports('epic_breadcrumb')){
        global $post;
        if (!is_front_page() || is_paged()) {
            echo '<div id="breadcrumb" class="' . $position . '">';
            $delimiter = '';
            $name = __('Home', 'epic');
            $home = home_url();
            //echo '<span>' . EPIC_BREADCRUMBTEXT . '</span>';
            if (!is_front_page() || is_paged()) {
            echo '<a href="' . $home . '">' . $name . '</a> ';
            }
            echo $delimiter;
            
            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) echo (get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
                echo '';
                single_cat_title();
                echo '';
			
            }
            
             elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                echo get_the_time('d');
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo get_the_time('F');
            } elseif (is_year()) {
                echo get_the_time('Y');
            } elseif (is_single()) {
                
                
                if (is_singular('portfolio')){
                echo get_the_term_list( $post->ID, 'portfoliocategory', $delimiter, ' ', '' );
                }
                
                $cat = get_the_category();
                $cat = $cat[0];
                if ($cat != '') {
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                }
                echo '<span>';
                the_title();
                echo '</span>';
                                
            } elseif (is_page() && !$post->post_parent) {
                  echo '<span>';
                the_title();
                echo '</span>';
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
                  echo '<span>';
                the_title();
                echo '</span>';
            } elseif (is_search()) {
                echo __('Search results for ','epic') . get_search_query();
            } elseif (is_tag()) {
                echo '';
                single_tag_title();
                echo '';
            } 
            

            elseif ( is_tax()) {
     		       	echo single_term_title();
      		}
      		            
            elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                echo __('Articles posted by ','epic') . $userdata->display_name;
            }
            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '';
                echo __(' - page','epic') . ' ' . get_query_var('paged');
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) echo '';
            }
            echo '</div>';
            }
    }
}
?>