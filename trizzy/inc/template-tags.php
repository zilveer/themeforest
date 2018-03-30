<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Trizzy
 */

if ( ! function_exists( 'trizzy_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function trizzy_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'trizzy' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'trizzy' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'trizzy' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'trizzy_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function trizzy_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'trizzy' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'trizzy' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'trizzy' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */

if (!function_exists('trizzy_categorized_blog')) :
function trizzy_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'trizzy_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'trizzy_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so trizzy_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so trizzy_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flush out the transients used in trizzy_categorized_blog.
 */
if (!function_exists('trizzy_category_transient_flusher')) :
  function trizzy_category_transient_flusher() {
  	// Like, beat it. Dig?
  	delete_transient( 'trizzy_categories' );
  }
  add_action( 'edit_category', 'trizzy_category_transient_flusher' );
  add_action( 'save_post',     'trizzy_category_transient_flusher' );
endif;

if (!function_exists('trizzy_number_to_width')) :
function trizzy_number_to_width($width) {
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
        case '13':
        return "thirteen";
        break;
        case '14':
        return "fourteen";
        break;
        case '15':
        return "fifteen";
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
        return "thirteen";
        break;
    }
}
endif;

/**
 * The fallback function for the shop nav menu
*/
/*function trizzy_shop_menu() { ?>
    <ul></ul> 
<?php } ?>*/


if ( ! function_exists( 'trizzy_get_posts_page' ) ) :

function trizzy_get_posts_page($info) {
  if( get_option('show_on_front') == 'page') {
    $posts_page_id = get_option( 'page_for_posts');
    $posts_page = get_page( $posts_page_id);
    $posts_page_title = $posts_page->post_title;
    $posts_page_url = get_page_uri($posts_page_id  );
  }
  else $posts_page_title = $posts_page_url = '';

  if ($info == 'url') {
    return $posts_page_url;
  } elseif ($info == 'title') {
    return $posts_page_title;
  } else {
    return false;
  }
}
endif;


/**
 * The Breadcrumbs function
*/
if ( ! function_exists( 'dimox_breadcrumbs' ) ) :
  function dimox_breadcrumbs() {
    $showOnHome = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = ''; // delimiter between crumbs
    $home = __('Home','trizzy'); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = '<li class="current_element">'; // tag before the current crumb
    $after = '</li>'; // tag after the current crumb

    global $post;
    $homeLink = home_url();
    $frontpageuri = trizzy_get_posts_page('url');
    $frontpagetitle = ot_get_option('pp_blog_page');
    $output = '';
    if (is_home() || is_front_page()) {
      if ($showOnHome == 1)
        echo '<ul>';
        echo '<li><a href="' . $homeLink . '">' . $home . '</a></li>';
        echo '<li>' . $frontpagetitle . '</li>';
        echo '</ul>';
    } else {

      $output .= '<ul><li><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '</li> ';
      if(function_exists('is_shop')) {
        if(is_shop()) {
          $shop_page_id = wc_get_page_id( 'shop' );
          $output .= '<li><a href="'.get_permalink( $shop_page_id) .'">'.__('Shop','trizzy').'</a></li>';
        }
      }
      if ( is_category() ) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) $output .= '<li>'.get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ').'<li>';
        $output .= $before . __('Archive by category','trizzy').' "' . single_cat_title('', false) . '"' . $after;

      } elseif ( is_search() ) {
        $output .= $before . __('Search results for','trizzy').' "' . get_search_query() . '"' . $after;

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
          $output .= '<li>'.$cats.'</li>';
          if ($showCurrent == 1) $output .= $before . get_the_title() . $after;
        }

      } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        $output .= $before . $post_type->labels->singular_name . $after;

      } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        //$output .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
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
        $output .= $before . __('Posts tagged','trizzy').' "' . single_tag_title('', false) . '"' . $after;

      } elseif ( is_author() ) {
       global $author;
       $userdata = get_userdata($author);
       $output .= $before . __('Articles posted by ','trizzy') . $userdata->display_name . $after;

     } elseif ( is_404() ) {
      $output .= $before .  __('Error 404','trizzy') . $after;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ' (';
        $output .= '<li>'.__('Page','trizzy') . ' ' . get_query_var('paged').'</li>';
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $output .= ')';
  }

  $output .= '</ul>';
  return $output;
  }
  } // end dimox_breadcrumbs()
endif;


if ( ! function_exists( 'trizzy_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since astrum 1.0
 */

function trizzy_posted_on() {

  if(is_single()) {
    $metas = ot_get_option('pp_meta_single',array());
    if (in_array("author", $metas)) {
        echo '<span itemscope itemtype="http://data-vocabulary.org/Person">';
        echo '<i class="fa fa-user"></i>'. __('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>';
        echo '</span>';
    }
    if (in_array("cat", $metas)) {
      if(has_category()) { echo '<span><i class="fa fa-tag"></i>'; the_category(', '); echo '</span>'; }
    }
    if (in_array("tags", $metas)) {
      if(has_tag()) { echo '<span><i class="fa fa-tag"></i>'; the_tags('',', '); echo '</span>'; }
    }
    if (in_array("com", $metas)) {
      echo '<span><i class="fa fa-comment"></i>'; comments_popup_link( __('With 0 comments','trizzy'), __('With 1 comment','trizzy'), __('With % comments','trizzy'), 'comments-link', __('Comments are off','trizzy')); echo '</span>';
    }
  } else {
    $metas = ot_get_option('pp_meta_blog',array());

   if (in_array("author", $metas)) {
      echo '<span itemscope itemtype="http://data-vocabulary.org/Person">';
      if (in_array("author", $metas)) {
        echo '<i class="fa fa-user"></i>'. __('By','trizzy'). ' <a class="author-link" itemprop="url" rel="author" href="'.get_author_posts_url(get_the_author_meta('ID' )).'">'; the_author_meta('display_name'); echo'</a>';
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
      echo '<span><i class="fa fa-comment"></i>'; comments_popup_link( __('With 0 comments','trizzy'), __('With 1 comment','trizzy'), __('With % comments','trizzy'), 'comments-link', __('Comments are off','trizzy')); echo '</span>';
    }
  }
}
endif;


if ( ! function_exists( 'trizzy_meta_box_post_format_quote' ) ) :
add_filter('ot_meta_box_post_format_quote', 'trizzy_meta_box_post_format_quote',10,3);
function trizzy_meta_box_post_format_quote($array, $pages) {
  $array = array(
    'id'        => 'ot-post-format-quote',
    'title'     => __( 'Quote', 'option-tree' ),
    'desc'      => '',
    'pages'     => $pages,
    'context'   => 'side',
    'priority'  => 'low',
    'fields'    => array(
      array(
        'id'      => '_format_quote_content',
        'label'   => '',
        'desc'    => __( 'Quote', 'option-tree' ),
        'std'     => '',
        'type'    => 'textarea'
      ),
      array(
        'id'      => '_format_quote_source_name',
        'label'   => '',
        'desc'    => __( 'Name (ex. author, singer, actor)', 'option-tree' ),
        'std'     => '',
        'type'    => 'text'
      ),
      array(
        'id'      => '_format_quote_source_url',
        'label'   => '',
        'desc'    => __( 'Source URL', 'option-tree' ),
        'std'     => '',
        'type'    => 'text'
      ),
      array(
        'id'      => '_format_quote_source_title',
        'label'   => '',
        'desc'    => __( 'Source Title (ex. book, song, movie)', 'option-tree' ),
        'std'     => '',
        'type'    => 'text'
      ),
      array(
        'id'      => '_format_quote_source_date',
        'label'   => '',
        'desc'    => __( 'Source Date', 'option-tree' ),
        'std'     => '',
        'type'    => 'text'
      )
    )
  );
return $array;
}
endif;

/**
 * Limits number of words from string
 *
 * @since astrum 1.0
 */
if ( ! function_exists( 'string_limit_words' ) ) :
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
endif;


if ( ! function_exists( 'trizzy_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since astrum 1.0
 */
function trizzy_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
  ?>
  <li class="post pingback">
    <p><?php _e( 'Pingback:', 'trizzy' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'trizzy' ), ' ' ); ?></p>
  <?php
      break;
    default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
     <div id="comment-<?php comment_ID(); ?>" class="comment">
      <div class="avatar"><?php echo get_avatar( $comment, 70 ); ?></div>
      <div class="comment-content"><div class="arrow-comment"></div>
      <div class="comment-by"><?php printf( '<strong>%s</strong>', get_comment_author_link() ); ?>  <span class="date"> <?php printf( __( '%1$s at %2$s', 'trizzy' ), get_comment_date(), get_comment_time() ); ?></span>
        <span class="reply"><span style="color:#ccc"> </span><?php comment_reply_link( array_merge( $args, array( 'reply_text' => '<i class="fa fa-reply"></i>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
      </div>
      <?php comment_text(); ?>
    </div>
  </div>

  <?php
      break;
  endswitch;
}
endif; // ends check for trizzy_comment()



//Adding the Open Graph in the Language Attributes
function trizzy_add_opengraph_doctype( $output ) {
    return $output . '  prefix="og: http://ogp.me/ns# fb: http://www.facebook.com/2008/fbml"';
  }
add_filter('language_attributes', 'trizzy_add_opengraph_doctype');

//Lets add Open Graph Meta Info

function  trizzy_insert_fb_in_head() {
  global $post;
  if ( !is_singular()) //if it is not a post or a page
    return;

        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:site_name" content="'. get_bloginfo( 'name' ) .'"/>';
    if(has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
        $thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
        echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
    }
  echo "
";
}
add_action( 'wp_head', 'trizzy_insert_fb_in_head', 5 );
?>