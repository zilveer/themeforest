<?php
function multipurpose_breadcrumb() {   
    $breadcrumb_disabled = get_theme_mod('breadcrumb_disabled'); 
    if ($breadcrumb_disabled == 1) return; 

    $pattern = get_theme_mod('breadcrumb_pattern');
    if(empty($pattern)) {
        $pattern = 7;
    }
    if ($pattern == -1) {
        $pattern_class = '';
    } else {
        if ($pattern < 10) {
            $pattern = "0" . $pattern;
        }
        $pattern_class = "p".$pattern;
    }

    $color = get_theme_mod('breadcrumb_color');
    if ($color) $style = 'style="background-color: ' . $color . '"';
    else $style = '';

    $main = esc_attr__('Home', 'multipurpose');  
    if(is_day() || is_month() || is_year()) {
        $arc_year = get_the_time('Y'); 
        $arc_month = get_the_time('F'); 
        $arc_day = get_the_time('d');
        $arc_day_full = get_the_time('l');  
        $url_year = get_year_link($arc_year);
        $url_month = get_month_link($arc_year,$arc_month);
    }     

    if (!is_front_page()) {
        if(!is_search()) {
            $id = get_the_ID();
            $hide_breadcrumb = get_post_meta($id, 'hide_breadcrumb', true) ? 1 : 0;
            if($hide_breadcrumb == 1) return;
        }

        echo '<section class="breadcrumb '.$pattern_class.'" '.$style.'><div>';
         
        global $post, $cat;         
        $home_link = home_url();
        $delimiter = '<span class="delimiter">&rsaquo;</span>';
        $link_before = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
        $link_after = '</div>';
        echo $link_before . '<a href="' . home_url() . '" itemprop="url"><span itemprop="title">' . $main . '</span></a>'. $link_after . $delimiter;    
         
        if (is_single()) {
            $category = get_the_category();
            $num_cat = count($category);
            $type = get_post_type();
            switch($type) {
                case 'project':
                    echo $link_before . '<a href="'.get_post_type_archive_link($type).'" itemprop="url"><span itemprop="title">'.esc_attr__('Projects', 'multipurpose').'</span></a>'. $link_after . $delimiter;
                    the_title();
                    break;

                case 'product':
                    echo $link_before . get_shop_link() . $link_after . $delimiter;
                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = $terms[0];
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );
                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );
                            if ( ! is_wp_error( $ancestor ) && $ancestor )
                                echo $link_before . '<a href="' . get_term_link( $ancestor->slug, 'product_cat' ) . '" itemprop="url"><span itemprop="title">' . $ancestor->name . '</span></a>'. $link_after . $delimiter;
                        }
                        echo $link_before . '<a href="' . get_term_link( $main_term->slug, 'product_cat' ) . '" itemprop="url"><span itemprop="title">' . $main_term->name . '</span></a>'. $link_after . $delimiter;
                    }

                    the_title();
                    break;


                default: 
                    if ($num_cat <= 1 && isset($category[0])) {
                        echo '<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
                        //echo get_category_parents($category[0],  true, ' ');
                        echo '<a href="' . get_category_link($category[0]->term_id) . '" itemprop="url"><span itemprop="title">' . $category[0]->name . '</span></a>';
                        echo '</span>';
                        echo $delimiter . get_the_title();
                    } elseif ($num_cat > 1) { 
                        //echo the_category(', ') . $delimiter . trim(get_the_title());
						echo multipurpose_get_breadcrubms_category($link_before, $link_after, $delimiter) . $delimiter . trim(get_the_title()); 
                    } else {
                        echo trim(get_the_title()); 
                    }        
            }
              
        } 
        elseif ( is_404() ) {
            esc_attr_e('Error 404 - Not Found.', 'multipurpose');
        }
        elseif (is_category()) { 
            //echo esc_attr__('Archive category', 'multipurpose').': ' . get_category_parents($cat, true,' ');
	        $current = get_category( $cat );
	        if( $current->category_parent && $parent = get_category( $current->category_parent ) ) {
	            echo multipurpose_get_breadcrubms_category($link_before, $link_after, $delimiter, $current->category_parent);
	        }
	        echo $current->name;
        }       
        elseif ( is_tag() ) { 
            echo esc_attr__('Posts tagged', 'multipurpose').': ' . single_tag_title("", false);
        }
        elseif ( is_tax('product_cat') ) {
            echo $link_before . get_shop_link() . $link_after . $delimiter;
            $current_term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
            $ancestors = array_reverse( get_ancestors( $current_term->term_id, get_query_var( 'taxonomy' ) ) );
            foreach ( $ancestors as $ancestor ) {
                $ancestor = get_term( $ancestor, get_query_var( 'taxonomy' ) );
                echo $link_before . '<a href="' . get_term_link( $ancestor->slug, get_query_var( 'taxonomy' ) ) . '" itemprop="url"><span itemprop="title">' . esc_html( $ancestor->name ) . '</span></a>'. $link_after . $delimiter;
            }
            echo esc_html( $current_term->name );
        } elseif ( is_tax('product_tag') ) {
            global $wp_query;
            $queried_object = $wp_query->get_queried_object();
            echo esc_attr__( 'Products tagged &ldquo;', 'woocommerce' ) . $queried_object->name . '&rdquo;';
        }       
        elseif ( is_day()) { 
            echo $link_before . '<a href="' . $url_year . '" itemprop="url"><span itemprop="title">' . $arc_year . '</span></a>'. $link_after . $delimiter;
            echo $link_before . '<a href="' . $url_month . '" itemprop="url"><span itemprop="title">' . $arc_month . '</span></a> '. $link_after . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        } 
        elseif ( is_month() ) {
            echo $link_before . '<a href="' . $url_year . '" itemprop="url"><span itemprop="title">' . $arc_year . '</span></a> '. $link_after . $delimiter . $arc_month;
        } 
        elseif ( is_year() ) {
            echo $arc_year;
        }       
        elseif ( is_search() ) {
            echo esc_attr__('Search results for', 'multipurpose').': "' . get_search_query() . '"';
        }       
        elseif ( is_page() && !$post->post_parent ) {
            echo get_the_title();
        }        
        elseif ( 'project' == get_post_type()) {
            esc_attr_e('Project archive', 'multipurpose');
        }   
        elseif ( is_page() && $post->post_parent ) {               
            $post_array = get_post_ancestors($post);
            krsort($post_array); 
             
            foreach($post_array as $key=>$postid){
                $post_ids = get_post($postid);
                $title = $post_ids->post_title; 
                echo $link_before . '<a href="' . get_permalink($post_ids) . '" itemprop="url"><span itemprop="title">' . $title . '</span></a>'. $link_after . $delimiter;
            }
            the_title();
        }          
        elseif ( is_author() ) {
            global $author;
            $user_info = get_userdata($author);
            echo  esc_attr__('Articles by', 'multipurpose').': ' . $user_info->display_name;
        }       
            
        elseif ( ( ! is_home() && ! is_front_page() && ! ( is_post_type_archive() && get_option( 'page_on_front' ) == woocommerce_get_page_id('shop')))) {
            $permalinks   = get_option( 'woocommerce_permalinks' );
            $shop_page_id = woocommerce_get_page_id( 'shop' );
            $shop_page    = get_post( $shop_page_id );
            echo $shop_page->post_title;
        } else {
            
        }
       echo '</div></section>';     
    }   
}

function get_shop_link() {
    $permalinks   = get_option( 'woocommerce_permalinks' );
    $shop_page_id = woocommerce_get_page_id( 'shop' );
    $shop_page    = get_post( $shop_page_id );
    return '<a href="' . get_permalink( $shop_page ) . '" itemprop="url"><span itemprop="title">' . $shop_page->post_title . '</span></a> ';
}


/*
 * $before - prefix tag of category's link a tag
 * $after - suffix tag of category's link a tag
 * $separator - Delimiter tag between each category's tags
 * $cat_id - Current Category ID
 * $visisted - Category ID Array that show already
 * $post_id - Current Post ID
 */
function multipurpose_get_breadcrubms_category($before, $after, $separator, $cat_id = false, $visited = array(), $post_id = false)
{
	$rel = 'rel="category tag"';

    $thelist = '';
    
    if ($cat_id)
    {
        $parent = get_term( $cat_id, 'category' );// Get Object of Current Category
        if ( is_wp_error( $parent ) )
            return $parent;

        // Recursive Call after checking whether current category is the category that show already or not.
        if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
            $visited[] = $parent->parent;
            $thelist .= multipurpose_get_breadcrubms_category( $before, $after, $separator, $parent->parent, $visited, $post_id );
        }
        
        $thelist .= $before.'<a itemprop="url" href="' . esc_url( get_category_link( $parent->term_id ) ) . '" ' . $rel . '><span itemprop="title">'.$parent->name.'</span></a>'.$after.$separator;
    }
    else
    {
        $categories = get_the_category( $post_id );// Get Category Object's Array of Current Post
        $i = 0;
        foreach ( $categories as $category ) {
            if ( 0 < $i )
                $thelist .= $separator;
            $thelist .= $before.'<a itemprop="url" href="' . esc_url( get_category_link( $category->term_id ) ) . '" ' . $rel . '><span itemprop="title">' . $category->name.'</span></a>'.$after;
            ++$i;
        }
    }
    
    return ($thelist);
}
?>