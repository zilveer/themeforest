<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Centum
 */

if ( ! function_exists( 'the_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Posts navigation', 'centum' ); ?></h2>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older posts', 'centum' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'centum' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'the_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function the_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h2 class="screen-reader-text"><?php _e( 'Post navigation', 'centum' ); ?></h2>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', '%title' );
				next_post_link( '<div class="nav-next">%link</div>', '%title' );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'centum_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function centum_posted_on() {

echo '<div class="post-meta">';
	if(is_single()) {
    $metas = ot_get_option('pp_meta_single',array());
    if (in_array("date", $metas)) {
        echo '<span>';
        echo '<i class="fa fa-calendar"></i>'; printf('<a href="%1$s" class="published-time" title="%2$s" rel="bookmark">%3$s</a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); 
        echo '</span>';
    } 
    if (in_array("author", $metas)) {
        echo '<span itemscope itemtype="http://data-vocabulary.org/Person">';
        echo '<i class="fa fa-user"></i>'. __('By','centum'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>';
        echo '</span>';
    }
    if (in_array("cat", $metas)) {
      if(has_category()) { echo '<span><i class="fa fa-tag"></i>'; the_category(', '); echo '</span>'; }
    }
    if (in_array("tags", $metas)) {
      if(has_tag()) { echo '<span><i class="fa fa-tag"></i>'; the_tags('',', '); echo '</span>'; }
    }
    if (in_array("com", $metas)) {
      echo '<span><i class="fa fa-comment"></i>'; comments_popup_link( __('With 0 comments','centum'), __('With 1 comment','centum'), __('With % comments','centum'), 'comments-link', __('Comments are off','centum')); echo '</span>';
    }
  } else {
    $metas = ot_get_option('pp_meta_blog',array());
     if (in_array("date", $metas)) {
        echo '<span>';
        echo '<i class="fa fa-calendar"></i>'; printf('<a href="%1$s" class="published-time" title="%2$s" rel="bookmark">%3$s</a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); 
        echo '</span>';
    } 
   	if (in_array("author", $metas)) {
      echo '<span itemscope itemtype="http://data-vocabulary.org/Person">';
      if (in_array("author", $metas)) {
        echo '<i class="fa fa-user"></i>'. __('By','centum'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>';
      }
      echo '</span>';
    }
    if (in_array("cat", $metas)) {
      if(has_category()) { echo '<span><i class="fa fa-tag"></i>'; the_category(', '); echo '</span>'; }
    }
    if (in_array("tags", $metas)) {
      if(has_tag()) { echo '<span><i class="fa fa-tag"></i>'; the_tags('',', '); echo '</span>'; }
    }
    if (in_array("com", $metas)) {
      echo '<span><i class="fa fa-comment"></i>'; comments_popup_link( __('With 0 comments','centum'), __('With 1 comment','centum'), __('With % comments','centum'), 'comments-link', __('Comments are off','centum')); echo '</span>';
    }
  }
  echo '</div>';
}
endif;

if ( ! function_exists( 'centum_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function centum_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'centum' ) );
		if ( $categories_list && centum_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( 'Posted in %1$s', 'centum' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'centum' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( 'Tagged %1$s', 'centum' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'centum' ), __( '1 Comment', 'centum' ), __( '% Comments', 'centum' ) );
		echo '</span>';
	}

	edit_post_link( __( 'Edit', 'centum' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'centum' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'centum' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'centum' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'centum' ), get_the_date( _x( 'Y', 'yearly archives date format', 'centum' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'centum' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'centum' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'centum' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'centum' ) ) );
	} elseif ( is_tax( 'post_format' ) ) {
		if ( is_tax( 'post_format', 'post-format-aside' ) ) {
			$title = _x( 'Asides', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
			$title = _x( 'Galleries', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
			$title = _x( 'Images', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
			$title = _x( 'Videos', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
			$title = _x( 'Quotes', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
			$title = _x( 'Links', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
			$title = _x( 'Statuses', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
			$title = _x( 'Audio', 'post format archive title', 'centum' );
		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
			$title = _x( 'Chats', 'post format archive title', 'centum' );
		}
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'centum' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'centum' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'centum' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function centum_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'centum_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'centum_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so centum_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so centum_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in centum_categorized_blog.
 */
function centum_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'centum_categories' );
}
add_action( 'edit_category', 'centum_category_transient_flusher' );
add_action( 'save_post',     'centum_category_transient_flusher' );



function add_video_wmode_transparent($html, $url, $attr) {

    if ( strpos( $html, "<embed src=" ) !== false )
     { return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $html); }
 elseif ( strpos ( $html, 'feature=oembed' ) !== false )
     { return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $html ); }
 else
     { return $html; }
}
add_filter( 'embed_oembed_html', 'add_video_wmode_transparent', 10, 3);




function new_excerpt_more($more) {
    global $post;
    return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

function string_limit_words($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit) {
        array_pop($words);
        //add a ... at last article when more than limit word count
        return implode(' ', $words) ;
    } else {
        //otherwise
        return implode(' ', $words);
    }
}

function num_posts_portfolio($query){
    $showpost = ot_get_option('portfolio_showpost','20');
    if ($query->is_main_query() && $query->is_post_type_archive('portfolio') && !is_admin())
        $query->set('posts_per_page', $showpost);
}

add_action('pre_get_posts', 'num_posts_portfolio');



add_filter('next_posts_link_attributes', 'posts_link_attributes_1');
add_filter('previous_posts_link_attributes', 'posts_link_attributes_2');

function posts_link_attributes_1() {
    return 'class="prev"';
}
function posts_link_attributes_2() {
    return 'class="next"';
}



/**
 * related post with category
 * @param: int $limit limit of posts
 * @param: bool $catName echo category name
 * @param: string $title string before all entries
 * Example: echo fb_cat_related_posts();
 */
if (!function_exists('fb_get_cat_related_posts')) {

    function fb_get_cat_related_posts($limit = 5, $catName = TRUE) {
        if (!is_single())
            return;
        $limit = (int) $limit;
        $output = '';

        $category = get_the_category();
        $category = (int) $category[0]->cat_ID;
        if ($catName)
            $output .= __('Categories: ','centum') . get_cat_name($category) . ' ';

        $args = array(
            'numberposts' => $limit,
            'category' => $category,
            );


        $the_query = new WP_Query($args);
        echo "<ul>";
        while ($the_query->have_posts()) : $the_query->the_post();
        ?>
        <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if (has_post_thumbnail()) { ?>
            <div class="thumb-container">
                <a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark">
                    <?php the_post_thumbnail('small-thumb'); ?>
                </a>
                <a class="comments-link" href="<?php comments_link(); ?>"><?php echo get_comments_number(); ?></a>
            </div>
            <?php } ?>
            <div class="post-container <?php
            if (!has_post_thumbnail()) {
                echo "no-thumb";
            }
            ?> ">
            <h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'centum'), the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title(); ?></a></h5>
            <a class="author-link" href="<?php echo get_author_posts_url(get_the_author_meta('ID' )); ?>"><?php the_author_meta('display_name'); ?></a>
            <?php printf('<a href="%1$s" class="published-time" title="%2$s" rel="bookmark">%3$s</a>', get_permalink(), esc_attr(get_the_time()), get_the_date()); ?>
        </div>
    </li><!-- #post-## -->
    <?php
        endwhile; // End the loop. Whew.
        echo "</ul>";
        wp_reset_postdata();
    }

}



function body_scheme_class($classes) {
    $style = get_theme_mod( 'centum_layout_style', 'boxed' ) ;
    $scheme = get_theme_mod( 'centum_scheme_switch', 'light' ) ;

    $classes[] = $style.' '.$scheme;
    return $classes;
}

add_filter('body_class', 'body_scheme_class');

function thumb_class($classes) {
    global $post;

    if(has_post_thumbnail($post->ID)) {
        $classes[] = "has-thumbnail";
    }
    return $classes;
}
add_filter('post_class','thumb_class');


function video_class($classes) {
    global $post;
    $type  = get_post_meta($post->ID, 'incr_pf_type', true);
    if(get_post_format( $post->ID ) == 'video' ) {
        $classes[] = "video-cont";
    }
    return $classes;
}
add_filter('post_class','video_class');


/*
 * Adds fitlers terms from a custom taxonomy to post_class
 */
add_filter( 'post_class', 'centum_taxonomy_portfolio_class', 10, 3 );
function centum_taxonomy_portfolio_class( $classes, $class, $ID ) {
    $taxonomy = 'filters';
    $terms = get_the_terms( (int) $ID, $taxonomy );
    if( !empty( $terms ) ) {
        foreach( (array) $terms as $order => $term ) {
            if( !in_array( $term->slug, $classes ) ) {
                $classes[] = $term->slug;
            }
        }
    }
    return $classes;
}


add_filter('user_contactmethods', 'my_user_contactmethods');

function my_user_contactmethods($user_contactmethods){

  $user_contactmethods['twitter'] = 'Twitter Username';
  $user_contactmethods['facebook'] = 'Facebook Username';
  $user_contactmethods['googleplus'] = 'Google Plus Profile ID';
  $user_contactmethods['flickr'] = 'Flickr';

  return $user_contactmethods;
}

function custom_password_form($form) {
  $subs = array(
    '#<form(.*?)>#' => '<form$1 class="passwordform">',
    );

  echo preg_replace(array_keys($subs), array_values($subs), $form);
}

add_filter('the_password_form', 'custom_password_form');



function dimox_breadcrumbs() {

  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = ''; // delimiter between crumbs
  $home = __('Home','centum'); // text for the 'Home' link
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<li class="current_element">'; // tag before the current crumb
  $after = '</li>'; // tag after the current crumb

  global $post;
  $homeLink = home_url();
  $output = '';
  if (is_home() || is_front_page()) {

    if ($showOnHome == 1) $output .= '<ul id="breadcrumbs"></li><li><a href="' . $homeLink . '"></i>' . $home . '</a></li></ul>';

} else {

    $output .= '<ul id="breadcrumbs"><li><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '</li> ';

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) $output .= get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      $output .= $before . __('Archive by category','centum') .'"' . single_cat_title('', false) . '"' . $after;

  } elseif ( is_search() ) {
      $output .= $before . __('Search results for','centum') .'"' . get_search_query() . '"' . $after;

  } elseif ( is_day() ) {
      $output .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . '</li> ';
      $output .= '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . '</li> ';
      $output .= $before . get_the_time('d') . $after;

  } elseif ( is_month() ) {
      $output .= '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' </li>';
      $output .= $before . get_the_time('F') . $after;

  } elseif ( is_year() ) {
      $output .= $before . get_the_time('Y') . $after;

  } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        $output .= '<li><a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li>';
        if ($showCurrent == 1) $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
    } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        $output .= $cats;
        if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
    }

	} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	  $post_type = get_post_type_object(get_post_type());
	  $output .= $before . $post_type->labels->singular_name . $after;

	} elseif ( is_attachment() ) {
	  $parent = get_post($post->post_parent);
	  $cat = get_the_category($parent->ID); $cat = $cat[0];
	  $output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	  $output .= '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>';
	  if ($showCurrent == 1) $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	} elseif ( is_page() && !$post->post_parent ) {
	  if ($showCurrent == 1) $output .= $before . get_the_title() . $after;

	} elseif ( is_page() && $post->post_parent ) {
	  $parent_id  = $post->post_parent;
	  $breadcrumbs = array();
	  while ($parent_id) {
	    $page = get_page($parent_id);
	    $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
	    $parent_id  = $page->post_parent;
	}
	$breadcrumbs = array_reverse($breadcrumbs);
	for ($i = 0; $i < count($breadcrumbs); $i++) {
	    $output .= $breadcrumbs[$i];
	    if ($i != count($breadcrumbs)-1) $output .= ' ' . $delimiter . ' ';
	}
	if ($showCurrent == 1) $output .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

	} elseif ( is_tag() ) {
	  $output .= $before . __('Posts tagged ','centum') .'"' . single_tag_title('', false) . '"' . $after;

	} elseif ( is_author() ) {
	   global $author;
	   $userdata = get_userdata($author);
	   $output .= $before . __('Articles posted by','centum') . $userdata->display_name . $after;

	} elseif ( is_404() ) {
	  $output .= $before . __('Error 404','centum') . $after;
	}

	if ( get_query_var('paged') ) {
	  if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ' (';
	      $output .= __('Page','centum') . ' ' . get_query_var('paged');
	      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ')';
	}

	$output .= '</ul>';
	return $output;
	}
} // end dimox_breadcrumbs()


function recent_porfolios() {
    global $post;
    $exclude = $post->ID;
    rewind_posts();
    $filters  = get_post_meta($post->ID, 'pp_recent_portfolio_filters', true);
    $items  = get_post_meta($post->ID, 'pp_recent_portfolio_posts', true);

    // Create a new WP_Query() object
/*      if($filters){
        $filterstemparray = explode(',', $filters);
        if (count($filterstemparray)>1) {
            $filtersarray = $filterstemparray;
        } else {
            $filtersarray = $filterstemparray[0];
        }
    };*/

    $args = array(
            'post_type' => array('portfolio'),
            'post__not_in' => array($exclude),
            'showposts' => '4',
            'orderby' => 'date',
            'order' => 'DESC'
            ); // or 10 etc. however many you want

    if(!empty($items)) {

        $args['post__in'] = $items;
    }

    if(!empty($filters)) {
        $newfilters = array();
        foreach ($filters as $key => $value) {
            $newfilters[] = $key;
        }
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'filters',
                'field' => 'id',
                'terms' => $newfilters
                )
            );
    }
    $wpcust = new WP_Query($args);


        // the $wpcust-> variable is used to call the Loop methods. not sure if required
    if ( $wpcust->have_posts() ):
        while( $wpcust->have_posts() ) : $wpcust->the_post();
    $type  = get_post_meta($post->ID, 'incr_pf_type', true);
    $videothumbtype = ot_get_option('portfolio_videothumb');
    ?>

    <div class="four columns ">
        <?php if($type == 'video' && $videothumbtype == 'video') {
            $videoembed = get_post_meta($post->ID, 'incr_pfvideo_embed', true);
            if($videoembed) {
                echo '<div class="picture recent_video embedcode">'.$videoembed.'</div>';
            } else {
                global $wp_embed;
                $videolink = get_post_meta($post->ID, 'incr_pfvideo_link', true);
                $post_embed = $wp_embed->run_shortcode('[embed  width="220" height="155"]'.$videolink.'[/embed]') ;
                echo '<div class="picture recent_video ">'.$post_embed.'</div>';
            }
        } else {
            if ( has_post_thumbnail()) { ?>
            <div class="picture">
                <?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large'); ?>
                <a  href="<?php the_permalink(); ?>"> <?php the_post_thumbnail('portfolio-thumb'); ?><div class="image-overlay-link"></div></a>
            </div>
            <?php }
        } ?>
        <div class="item-description related">
            <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php
            $excerpt = get_the_excerpt();
            echo string_limit_words($excerpt,11);
            ?> </p>
        </div>
    </div>


    <?php
        endwhile;  // close the Loop
        endif;
        wp_reset_query(); // reset the Loop

} // end of list_all_posttypes() function


function filter_next_post_link($link) {
    $link = str_replace("rel=", 'class="next" rel=', $link);
    return $link;
}
add_filter('next_post_link', 'filter_next_post_link');

function filter_previous_post_link($link) {
    $link = str_replace("rel=", 'class="prev" rel=', $link);
    return $link;
}
add_filter('previous_post_link', 'filter_previous_post_link');



function incr_number_to_width($width) {
    switch ($width) {
        case '1':
        return "one";
        break;
        case '2':
        return "two";
        break;
        case '3':
        return "three";
        break;
        case '4':
        return "four";
        break;
        case '5':
        return "five";
        break;
        case '6':
        return "six";
        break;
        case '7':
        return "seven";
        break;
        case '8':
        return "eight";
        break;
        case '9':
        return "nine";
        break;
        case '10':
        return "ten";
        break;
        case '11':
        return "eleven";
        break;
        case '12':
        return "twelve";
        break;
        case '16':
        return "sixteen";
        break;
        case '1/3':
        return "one-third";
        break;        
        case '2/3':
        return "two-thirds";
        break;

        default:
        return "four";
        break;
    }
}


function my_tag_cloud_args($in){
    return 'smallest=13&largest=13&number=25&orderby=name&unit=px';
}
add_filter( 'widget_tag_cloud_args', 'my_tag_cloud_args');


add_action ('admin_menu', 'themedemo_admin');
function themedemo_admin() {
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' );
}



/**
 * Convert a hexa decimal color code to its RGB equivalent
 *
 * @param string $hexStr (hexadecimal color value)
 * @param boolean $returnAsString (if set true, returns the value separated by the separator character. Otherwise returns associative array)
 * @param string $seperator (to separate RGB values. Applicable only if second parameter is true.)
 * @return array or string (depending on second parameter. Returns False if invalid hex color value)
 */
function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}


add_action( 'customize_register', 'themename_customize_register' );


function themename_customize_register($wp_customize) {


    // color section
  $wp_customize->add_section( 'centum_color_settings', array(
    'title'          => 'Main color',
    'priority'       => 35,
    ) );

  $wp_customize->add_setting( 'centum_main_color', array(
    'default'        => '#72B626',
    'transport' =>'postMessage'
    ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'centum_main_color', array(
    'label'   => 'Color Setting',
    'section' => 'colors',
    'settings'   => 'centum_main_color',
    )));

  $wp_customize->add_setting( 'centum_overlay_color', array(
    'default'        => '#000',
    'transport' =>'postMessage'
    ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'centum_overlay_color', array(
    'label'   => 'Overlay\'s Color',
    'section' => 'colors',
    'settings'   => 'centum_overlay_color',
    )));

  $wp_customize->add_setting( 'centum_overlay_opacity', array(
    'default'  => '0.7'

    ));
  $wp_customize->add_control( 'centum_overlay_opacity', array(
    'label'    => 'Select overlay opacity',
    'section'  => 'colors',
    'settings' => 'centum_overlay_opacity',
    'type'     => 'select',
    'choices'    => array(
        '0.1' => '0.1',
        '0.2' => '0.2',
        '0.3' => '0.3',
        '0.4' => '0.4',
        '0.5' => '0.5',
        '0.6' => '0.6',
        '0.7' => '0.7',
        '0.8' => '0.8',
        '0.9' => '0.9',
        '1' => '1',
        )
    ));

  $wp_customize->add_setting( 'centum_nav_bg', array(
    'default'        => '#303030',
    'transport' =>'postMessage'
    ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'centum_nav_bg', array(
    'label'   => 'Menu\'s background color',
    'section' => 'colors',
    'settings'   => 'centum_nav_bg',
    )));

  $wp_customize->add_setting( 'centum_nav_color', array(
    'default'        => '#fff',
    'transport' =>'postMessage'
    ));

/*  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'centum_nav_color', array(
    'label'   => 'Menu\'s text color',
    'section' => 'colors',
    'settings'   => 'centum_nav_color',
    )));
*/
  $wp_customize->add_setting( 'centum_footer_bg', array(
    'default'        => '#303030',
    'transport' =>'postMessage'
    ));

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'centum_footer_bg', array(
    'label'   => 'Footer\'s background color',
    'section' => 'colors',
    'settings'   => 'centum_footer_bg',
    )));

    // eof color section

    // bof layout section
  $wp_customize->add_section( 'centum_layout_settings', array(
    'title'          => 'Layout type',
    'priority'       => 36,
    ));

  $wp_customize->add_setting( 'centum_layout_style', array(
    'default'  => 'boxed',
    'transport' => 'postMessage'
    ));
  $wp_customize->add_control( 'centum_layout_choose', array(
    'label'    => 'Select layout',
    'section'  => 'centum_layout_settings',
    'settings' => 'centum_layout_style',
    'type'     => 'select',
    'choices'    => array(
        'boxed' => 'Boxed',
        'wide' => 'Wide',
        )
    ));

  $wp_customize->add_setting( 'centum_scheme_switch', array(
    'default'  => 'light',
    'transport' => 'postMessage'
    ));
  $wp_customize->add_control( 'centum_scheme', array(
    'label'    => 'Select main scheme color',
    'section'  => 'centum_layout_settings',
    'settings' => 'centum_scheme_switch',
    'type'     => 'select',
    'choices'    => array(
        'light' => 'Light',
        'dark' => 'Dark',
        )
    ));
   // eof layout section

  $wp_customize->add_setting( 'centum_tagline_switch', array(
    'default'  => 'show',
    'transport' => 'postMessage'
    ));
  $wp_customize->add_control( 'centum_tagline_switcher', array(
     'settings' => 'centum_tagline_switch',
     'label'    => __( 'Display Tagline','centum' ),
     'section'  => 'title_tagline',
     'type'     => 'select',
     'choices'    => array(
        'show' => 'Show',
        'hide' => 'Hide',
        )
     ));


  if ( $wp_customize->is_preview() && !is_admin() )
    add_action( 'wp_footer', 'centum_customize_preview', 21);
}


function centum_customize_preview() {
    ?>
    <script type="text/javascript">
    ( function( $ ){
        function hex2rgb(hex) {
            if (hex[0]=="#") hex=hex.substr(1);
            if (hex.length==3) {
                var temp=hex; hex='';
                temp = /^([a-f0-9])([a-f0-9])([a-f0-9])$/i.exec(temp).slice(1);
                for (var i=0;i<3;i++) hex+=temp[i]+temp[i];
            }
        var triplets = /^([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})$/i.exec(hex).slice(1);
        return {
            red: parseInt(triplets[0],16),
            green: parseInt(triplets[1],16),
            blue: parseInt(triplets[2],16)
        }
    }


    wp.customize('centum_main_color',function( value ) {
        value.bind(function(to) {
           $('#bolded-line, .button.color, input[type="button"]').css('background', to);
           $('body #filters a.selected,.pricing-table .color-3 h3, .color-3 .sign-up,.pricing-table .color-3 h4,#navigation  ul > li.current-menu-ancestor > a, #navigation > div > ul > li.current-menu-item > a, .flex-direction-nav .flex-prev:hover, .flex-direction-nav .flex-next:hover, #scroll-top-top a, .post-icon').css('background-color', to);
           $('.mr-rotato-prev:hover, .mr-rotato-next:hover,li.current, .tags a:hover').css('background-color',to).css('border-color',to);
           $('#filters a:hover, .selected, #portfolio-navi a:hover ').css('background-color',to).css('border-color',to);
           $('.testimonials-author, body .page:not(.home) a:not(.button), body .post:not(.home) a:not(.button)').css('color',to);

           $('#navigation ul li a, #navigation ul li > a, .button.gray').hover(function(){$(this).css('background', to);},function(){$(this).css('background', '#303030');} );
           $('.button.light').hover(function(){ $(this).css('background', to); }, function(){ $(this).css('background', '#AAAAAA'); });
           $('.flex-direction-nav .flex-prev, .flex-direction-nav .flex-next, .tp-leftarrow, .tp-rightarrow').hover(function(){$(this).css('background-color', to);},function(){$(this).css('background-color', 'rgba(0,0,0,0.6)');});

           $('.post-meta a,.acc-trigger a,.tabs-nav li a').css('color','#888');
           $('a.sign-up').css('color','#fff');
           $('.post-title h1 a, .post-title h2 a, .acc-trigger.active a,.tabs-nav li.active a').css('color','#404040');

       });
});

wp.customize('centum_nav_bg',function( value ) {
    value.bind(function(to) {
       $('#navigation').css('background-color', to);
       $('#navigation ul li a').css('background','none');


   });
});

wp.customize('centum_nav_color',function( value ) {
    value.bind(function(to) {
       $('#navigation ul li a').css('color', to);
   });
});

wp.customize('centum_footer_bg',function( value ) {
    value.bind(function(to) {
        $('#footer,#footer .headline h4, .footer-headline h4').css('background-color', to);
        $('#footer .headline, .footer-headline').css('background','none');
    });
});

wp.customize('centum_overlay_color',function( value ) {
    value.bind(function(to) {
        var hex = to;
        var rgb = hex2rgb(to);

        //  alert(''+rgb.red+','+rgb.green+','+rgb.blue+',0.7');
        $('.image-overlay-link, .image-overlay-zoom').css('background-color', 'rgba('+rgb.red+','+rgb.green+','+rgb.blue+',<?php echo get_theme_mod( 'centum_overlay_opacity', '0.7' ) ?>)');
    });
});

wp.customize('centum_layout_style',function( value ) {
    value.bind(function(to) {
        var $style;
        if($('body').hasClass('dark')) { $style = 'dark' }
            if($('body').hasClass('light')) { $style = 'light' }

                $('#layout').attr('href', '<?php echo get_template_directory_uri(); ?>/css/' + $style + to + '.css');
            $('body').removeClass('wide').removeClass('boxed').addClass(to);
        });
});

wp.customize('centum_scheme_switch',function( value ) {
    value.bind(function(to) {
        var $style;
        if($('body').hasClass('boxed')) { $scheme = 'boxed' }
            if($('body').hasClass('wide')) { $scheme = 'wide' }

                $('#layout').attr('href', '<?php echo get_template_directory_uri(); ?>/css/'  + to + $scheme + '.css');
            $('body').removeClass('light').removeClass('dark').addClass(to);
        });
});

wp.customize('centum_tagline_switch',function( value ) {
    value.bind(function(to) {
        if(to === 'hide') { $('#tagline').hide(); } else { $('#tagline').show(); }
    });
});


//.image-overlay-link, .image-overlay-zoom
} )( jQuery )
</script>
<?php
}



//ordering taxonomies
function centum_taxonomy_add_new_meta_field() {
  // this will add the custom meta field to the add new term page
  ?>
  <div class="form-field">
    <label for="term_meta[order_meta]"><?php _e( 'Order number', 'centum' ); ?></label>
    <input type="text" name="term_meta[order_meta]" id="term_meta[order_meta]" value="">
  </div>
<?php
}
add_action( 'filters_add_form_fields', 'centum_taxonomy_add_new_meta_field', 10, 2 );


function centum_taxonomy_edit_meta_field($term) {

  // put the term ID into a variable
  $t_id = $term->term_id;

  // retrieve the existing value(s) for this meta field. This returns an array
  $term_meta = get_option( "taxonomy_$t_id" ); ?>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="term_meta[order_meta]"><?php _e( 'Order number', 'centum' ); ?></label></th>
    <td>
      <input type="text" name="term_meta[order_meta]" id="term_meta[order_meta]" value="<?php echo esc_attr( $term_meta['order_meta'] ) ? esc_attr( $term_meta['order_meta'] ) : ''; ?>">
    </td>
  </tr>
<?php
}
add_action( 'filters_edit_form_fields', 'centum_taxonomy_edit_meta_field', 10, 2 );


// Save extra taxonomy fields callback function.
function save_taxonomy_custom_meta( $term_id ) {
  if ( isset( $_POST['term_meta'] ) ) {
    $t_id = $term_id;
    $term_meta = get_option( "taxonomy_$t_id" );
    $cat_keys = array_keys( $_POST['term_meta'] );
    foreach ( $cat_keys as $key ) {
      if ( isset ( $_POST['term_meta'][$key] ) ) {
        $term_meta[$key] = $_POST['term_meta'][$key];
      }
    }
    // Save the option array.
    update_option( "taxonomy_$t_id", $term_meta );
  }
}
add_action( 'edited_filters', 'save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_filters', 'save_taxonomy_custom_meta', 10, 2 );




add_filter('get_terms', 'custom_term_sort', 10, 3);

function custom_term_sort($terms, $taxonomies, $args)
{
        // Controls behavior when get_terms is called at unusual times resulting in a terms array without objects
        $empty = false;

        // Create collector arrays
        $ordered_terms = array();
        $unordered_terms = array();

        // Add taxonomy order to terms
        foreach($terms as $term)
        {
                // Only set tax_order if value is an object
                if(is_object($term))
                {
                        $term_meta = get_option( "taxonomy_$term->term_id" );
                        if($taxonomy_sort = $term_meta['order_meta'])
                        {
                                $term->tax_order = (int) $taxonomy_sort;
                                $ordered_terms[] = $term;
                        }
                        else
                        {
                                $term->tax_order = (int) 0;
                                $unordered_terms[] = $term;
                        }
                }
                else
                        $empty = true;
        }

        // Only sort by tax_order if there are items to sort, otherwise return the original array
        if(!$empty && count($ordered_terms) > 0)
                quickSort($ordered_terms);
        else
                return $terms;

        // Combine the newly ordered items with the unordered items and return
        return array_merge($ordered_terms, $unordered_terms);
}

function quickSort(&$array)
{
        $cur = 1;
        $stack[1]['l'] = 0;
        $stack[1]['r'] = count($array)-1;

        do
        {
                $l = $stack[$cur]['l'];
                $r = $stack[$cur]['r'];
                $cur--;

                do
                {
                        $i = $l;
                        $j = $r;
                        $tmp = $array[(int)( ($l+$r)/2 )];

                        // partion the array in two parts.
                        // left from $tmp are with smaller values,
                        // right from $tmp are with bigger ones
                        do
                        {
                                while( $array[$i]->tax_order < $tmp->tax_order )
                                $i++;

                                while( $tmp->tax_order < $array[$j]->tax_order )
                                $j--;

                                // swap elements from the two sides
                                if( $i <= $j)
                                {
                                         $w = $array[$i];
                                         $array[$i] = $array[$j];
                                         $array[$j] = $w;

                                        $i++;
                                        $j--;
                                }

                        }while( $i <= $j );

                        if( $i < $r )
                        {
                                $cur++;
                                $stack[$cur]['l'] = $i;
                                $stack[$cur]['r'] = $r;
                        }
                        $r = $j;

                }while( $l < $r );

        }while( $cur != 0 );
}



/*
 * Custom comments
*/

function centum_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
    case '' :
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <div id="comment-<?php comment_ID(); ?>" class="comment_container">
        	<div class="avatar"><?php echo get_avatar( $comment, apply_filters( 'woocommerce_review_gravatar_size', '60' ), '', get_comment_author() ); ?></div>
			<div class="comment-des"><div class="arrow-comment"></div>
            <div class="comment-by">
                <strong><?php printf(__('%s ', 'boilerplate'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?></strong>
                <span class="reply"><span style="color:#aaa">/ </span><?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></span>
                <span class="date"> <?php
                /* translators: 1: date, 2: time */
                printf(__('%1$s at %2$s', 'boilerplate'), get_comment_date(), get_comment_time());
                ?> </span>
            </div>
			<div itemprop="description">
                    <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', 'centum'); ?></em>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
 
        <?php
        break;
        case 'pingback' :
        case 'trackback' :
        ?>
        <li class="post pingback">
            <p><?php _e('Pingback:', 'boilerplate'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('(Edit)', 'boilerplate'), ' '); ?></p>
            <?php
            break;
            endswitch;
        }

add_filter('wp_nav_menu_items','add_search_box_to_menu', 10, 2);
function add_search_box_to_menu( $items, $args ) {
	if(ot_get_option('centum_search') != "disable") { 
		
		if( $args->menu_class == 'dropmenu main-menu' ) {
		return $items.'<li id="search-in-menu">
					<form action="'.home_url().'" id="searchform" method="get">
						<i class="fa fa-search"></i><input type="text" class="search-text-box" name="s" />
					</form>
				</li>';
		}
	}
	return $items;
}



class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
	var $to_depth = -1;
    function start_lvl(&$output, $depth = 0, $args = array()){
      $output .= '</option>';
  }

  function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth); // don't output children closing tag
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0){
      $indent = ( $depth ) ? str_repeat( "&#151; ", $depth * 1 ) : '';
      $class_names = $value = '';
      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;
      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';
      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
      $value = ' value="'. $item->url .'"';
      $output .= '<option'.$id.$value.$class_names.'>';
      $item_output = $args->before;
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $output .= $indent.$item_output;
  }

  function end_el(&$output, $item, $depth = 0, $args = array()){
      if(substr($output, -9) != '</option>')
      		$output .= "</option>"; // replace closing </li> with the option tag

      }
  }