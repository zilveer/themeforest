<?php

// Pluggable
if (! function_exists( 'uxbarn_render_breadcrumbs' ) ) {
    
    function uxbarn_render_breadcrumbs() {
        
        /* === OPTIONS === */  
        $text['home']     = __('Home', 'uxbarn'); // text for the 'Home' link  
        $text['category'] = __('Archive by Category "%s"', 'uxbarn'); // text for a category page  
        $text['search']   = __('Search Results for "%s"', 'uxbarn'); // text for a search results page  
        $text['tag']      = __('Posts Tagged "%s"', 'uxbarn'); // text for a tag page  
        $text['author']   = __('Articles Posted by %s', 'uxbarn'); // text for an author page  
        $text['404']      = __('404 Page Not Found', 'uxbarn'); // text for the 404 page  
      
        $show_current   = 1; // 1 - show current post/page/category title in breadcrumbs, 0 - don't show  
        $show_on_home   = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show  
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show  
        $show_title     = 1; // 1 - show the title for the links, 0 - don't show  
        $delimiter      = ''; // delimiter between crumbs  
        $before         = '<li class="current">'; // tag before the current crumb  
        $after          = '</li>'; // tag after the current crumb  
        /* === END OF OPTIONS === */  
      
        global $post;  
        $home_link    = home_url('/');  
        $link_before  = '<li>';  
        $link_after   = '</li>';  
        //$link_attr    = ' rel="v:url" property="v:title"';  
        $link         = $link_before . '<a href="%1$s">%2$s</a>' . $link_after;
      
        $parent_id = null;
        if(isset($post)) {
            $parent_id    = $parent_id_2 = $post->post_parent;
        }
          
        $frontpage_id = get_option('page_on_front');  
      
        if (is_home() || is_front_page()) {  
            
            $post_id = get_option('page_for_posts');
            $title = uxbarn_sanitize_for_attribute(get_the_title($post_id));
            
            if ($show_on_home == 1) echo '<ul class="breadcrumbs"><li><a href="' . $home_link . '">' . $text['home'] . '</a></li><li class="current">' . $title . '</li></ul>';  
      
        } else {  
      
            echo '<ul class="breadcrumbs">';  
            if ($show_home_link == 1) {  
                echo sprintf($link, $home_link, $text['home']);  
                if ($frontpage_id == 0 || $parent_id != $frontpage_id) echo $delimiter;  
            }  
      
            if ( is_category() ) {  
                $this_cat = get_category(get_query_var('cat'), false);  
                if ($this_cat->parent != 0) {  
                    $cats = get_category_parents($this_cat->parent, TRUE, $delimiter);  
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                    $cats = str_replace('<a', $link_before . '<a', $cats);  
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                    echo $cats;  
                }  
                if ($show_current == 1) echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
      
            } elseif ( is_search() ) {  
                echo $before . sprintf($text['search'], get_search_query()) . $after;  
      
            } elseif ( is_day() ) {  
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
                echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
                echo $before . get_the_time('d') . $after;  
      
            } elseif ( is_month() ) {  
                echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
                echo $before . get_the_time('F') . $after;  
      
            } elseif ( is_year() ) {  
                echo $before . get_the_time('Y') . $after;  
      
            } elseif ( is_single() && !is_attachment() ) {  
                if ( get_post_type() != 'post' ) {
                	if(is_singular('portfolio')) {
                		$terms = wp_get_post_terms($post->ID, 'portfolio-category');
						//echo var_dump($terms[0]);
						echo $link_before . '<a href="' . get_term_link($terms[0]) . '">' . $terms[0]->name . '</a>' .  $link_after;
					}  
                    //$post_type = get_post_type_object(get_post_type());  
                    //$slug = $post_type->rewrite;  
                    //printf($link, $home_link . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);  
                    if ($show_current == 1) echo $delimiter . $before . uxbarn_sanitize_for_attribute(get_the_title()) . $after;  
                } else {  
                    $cat = get_the_category(); $cat = $cat[0];  
                    $cats = get_category_parents($cat, TRUE, $delimiter);  
                    if ($show_current == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                    $cats = str_replace('<a', $link_before . '<a', $cats);  
                    $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                    if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                    echo $cats;  
                    if ($show_current == 1) echo $before . uxbarn_sanitize_for_attribute(get_the_title()) . $after;  
                }  
      
            } elseif (is_tax()) {
            	
				if(is_tax('portfolio-category')) {
               		echo $before . single_term_title('', false) . $after;
				}  
            
            } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
                
                $post_type = get_post_type_object(get_post_type());
				if($post_type) {
               		echo $before . $post_type->labels->singular_name . $after;
				}  
      
            } elseif ( is_attachment() ) {  
                /*$parent = get_post($parent_id);  
                $cat = get_the_category($parent->ID); $cat = $cat[0];  
                $cats = get_category_parents($cat, TRUE, $delimiter);  
                $cats = str_replace('<a', $link_before . '<a', $cats);  
                $cats = str_replace('</a>', '</a>' . $link_after, $cats);  
                if ($show_title == 0) $cats = preg_replace('/ title="(.*?)"/', '', $cats);  
                echo $cats;*/  
                //printf($link, get_permalink($parent), $parent->post_title);  
                if ($show_current == 1) echo $delimiter . $before . uxbarn_sanitize_for_attribute(get_the_title()) . $after;  
      
            } elseif ( is_page() && !$parent_id ) {  
                if ($show_current == 1) echo $before . uxbarn_sanitize_for_attribute(get_the_title()) . $after;  
      
            } elseif ( is_page() && $parent_id ) {  
                if ($parent_id != $frontpage_id) {  
                    $breadcrumbs = array();  
                    while ($parent_id) {  
                        $page = get_page($parent_id);  
                        if ($parent_id != $frontpage_id) {  
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), uxbarn_sanitize_for_attribute(get_the_title($page->ID)));  
                        }  
                        $parent_id = $page->post_parent;  
                    }  
                    $breadcrumbs = array_reverse($breadcrumbs);  
                    for ($i = 0; $i < count($breadcrumbs); $i++) {  
                        echo $breadcrumbs[$i];  
                        if ($i != count($breadcrumbs)-1) echo $delimiter;  
                    }  
                }  
                if ($show_current == 1) {  
                    if ($show_home_link == 1 || ($parent_id_2 != 0 && $parent_id_2 != $frontpage_id)) echo $delimiter;  
                    echo $before . uxbarn_sanitize_for_attribute(get_the_title()) . $after;  
                }  
      
            } elseif ( is_tag() ) {  
                echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
      
            } elseif ( is_author() ) {  
                global $author;  
                $userdata = get_userdata($author);  
                echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
      
            } elseif ( is_404() ) {  
                echo $before . $text['404'] . $after;  
            }  
      
            if ( get_query_var('paged') ) {  
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '<li class="page">';  
                echo __('Page', 'uxbarn') . ' ' . get_query_var('paged');  
                if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '</li>';  
            }  
      
            echo '</ul>';  
      
        }  
        
    
    }
}