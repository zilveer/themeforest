<?php // Breadcrumb navigation
    if (is_page() && !is_home() || is_single() || is_category()) {
        echo '<div class="general-block-outer">
		<div class="general-block breadcrumbs" itemprop="breadcrumb">
		<ul class="breadcrumbs">';
        echo '<li class="home"><a href="'.get_bloginfo('url').'">' . __("Home", "circolare") . '</a></li>';
 
        if (is_page()) {
            $ancestors = get_post_ancestors($post);
 
            if ($ancestors) {
                $ancestors = array_reverse($ancestors);
 
                foreach ($ancestors as $crumb) {
                    echo '<li><a href="'.get_permalink($crumb).'">'.get_the_title($crumb).'</a></li>';
                }
            }
        }
		
		if (is_singular( 'portfolio' )) {
			$term_list = wp_get_post_terms($post->ID, 'galleries');
			$term = array_pop($term_list);
			echo '<li><a href="'. get_term_link($term->slug, 'galleries') .'">'.$term->name.'</a></li>';
		} elseif (is_single()) {
            $category = get_the_category();
            echo '<li><a href="'.get_category_link($category[0]->cat_ID).'">'.$category[0]->cat_name.'</a></li>';
        }
 
        if (is_category()) {
            $category = get_the_category();
            echo '<li>'.$category[0]->cat_name.'</li>';
        }
 
        // Current page
        if (is_page() || is_single()) {
            echo '<li class="last active">'.get_the_title().'</li>';
        }
        echo '</ul>
		<br class="clear"/>
		</div>
		</div>';
    } elseif (is_home()) {
        // Front page
        echo '<div class="general-block-outer">
		<div class="general-block breadcrumbs">
		<ul class="breadcrumbs">';
        echo '<li class="home"><a href="'.get_bloginfo('url').'">' . __("Home", "circolare") . '</a></li>';
        echo '<li class="last active">'.get_the_title(get_option( 'page_for_posts' )).'</li>';
        echo '</ul>
		<br class="clear"/>
		</div>
		</div>';
    }
?>