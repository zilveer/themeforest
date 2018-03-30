<?php
/**
 * Themes-Dojo BreadCrumb Function
 * ===============================
 */

if ( ! function_exists( 'themesdojo_breadcrumb' ) ) {

	function get_term_parents($id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array()) {

	    $chain = '';
	    $parent = &get_term($id, $taxonomy);

	    try {
	        if (is_wp_error($parent)) {
	            throw new Exception('is_wp_error($parent) has throw error ' . $parent->get_error_message());
	        }
	    }
	    catch (exception $e) {
	        echo 'Caught exception: ', $e->getMessage(), "\n";
	        // use something less drastic than die() in production code
	        //die();
	    }

	    if ($nicename) {
	        $name = $parent->slug;
	    } else {
	        $name = htmlspecialchars($parent->name, ENT_QUOTES, 'UTF-8');
	    }


	    if ($parent->parent && ($parent->parent != $parent->term_id) && !in_array($parent->parent, $visited)) {
	        $visited[] = $parent->parent;
	        $chain .= get_term_parents($parent->parent, $taxonomy, $link, $separator, $nicename, $visited);
	    }

	    if ($link) {
	        $chain .= '<li><a href="' . get_term_link($parent->slug, $taxonomy) . '">' . $name . '</a></li>';
	    } else {
	        $chain .= $parent->name;
	    }

	    return $chain;
	}


	function get_tag_id($tag) {
	    global $wpdb;
	    $link_id = $wpdb->get_var($wpdb->prepare("SELECT term_id FROM $wpdb->terms WHERE name =  %s", $tag));
	    return $link_id;
	}

	function themesdojo_breadcrumb() {
	    global $post, $output;

	    $postType = get_post_type();

	    if (!is_home()) {

	    	echo '<ul id="breadcrumbs">';
	        echo '<li><a href="';
	        echo home_url();
	        echo '">';
	        echo 'Home';
	        echo '</a></li><li class="separator"><i class="fa fa-angle-right"></i></li>';

	        if ( is_category() || is_single('post') || $postType == 'post' ) {

	            echo '<li>';
	            the_category(' </li><li class="separator"><i class="fa fa-angle-right"></i></li><li> ');
	            if (is_single()) {
	                echo '</li><li class="separator"><i class="fa fa-angle-right"></i></li><li>';
	                the_title();
	                echo '</li>';
	            }

	        } if (is_tax()) {

        		$tag = single_tag_title('', false);
	            $tag = get_tag_id($tag);
	            $term = get_term_parents($tag, get_query_var('taxonomy'), true, ' &gt; ');
	            // remove last &gt;
	            echo preg_replace('/&gt;\s$|&gt;$/', '', $term);

        	} elseif ( get_post_type() == 'item' ) {

        		$terms = wp_get_post_terms( $post->ID, 'cat' );

        		$category = $terms[0]->name;
        		$term_link = get_term_link($terms[0]->slug, $terms[0]->taxonomy);

        		echo '<li><a href="'.$term_link.'">';
        		echo esc_attr($category);
        		echo '</a></li>';

            	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li><li>';
            	the_title();
            	echo '</li>';

	        } elseif ( get_post_type() == 'event' ) {

        		$terms = wp_get_post_terms( $post->ID, 'event_cat' );

        		$category = $terms[0]->name;
        		$term_link = get_term_link($terms[0]->slug, $terms[0]->taxonomy);

        		echo '<li><a href="'.$term_link.'">';
        		echo esc_attr($category);
        		echo '</a></li>';

            	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li><li>';
            	the_title();
            	echo '</li>';

	        } elseif (is_page()) {

	            if($post->post_parent){
	                $anc = get_post_ancestors( $post->ID );
	                $title = get_the_title();
	                foreach ( $anc as $ancestor ) {
	                    $output = '<li><a href="'.get_permalink($ancestor).'" title="'.get_the_title($ancestor).'">'.get_the_title($ancestor).'</a></li> <li class="separator"><i class="fa fa-angle-right"></i></li>' . $output;
	                }
	                echo $output;
	                echo '<span title="'.$title.'"> '.$title.'</span>';
	            } else {
	                echo '<li><span> '.get_the_title().'</span></li>';
	            }

	        } elseif ( is_search()) {

	        	echo "<li>Search Results"; echo'</li>';

	        } elseif (is_tag()) {

	        	single_tag_title();

	        } elseif (is_day()) {

	        	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li>';
	        	echo "<li>Archive for "; the_time('F jS, Y'); echo'</li>';

	        } elseif (is_month()) {

	        	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li>';
	        	echo "<li>Archive for "; the_time('F, Y'); echo'</li>';

	        } elseif (is_year()) {

	        	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li>';
	        	echo "<li>Archive for "; the_time('Y'); echo'</li>';

	        } elseif (is_author()) {

	        	echo '<li><li class="separator"><i class="fa fa-angle-right"></i></li>';
	        	echo "<li>Author Archive"; echo'</li>';

	        } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {

	        	echo "<li>Blog Archives"; echo'</li>';

	        }

	        echo '</ul>';
	        
	    }
	    
	}

}