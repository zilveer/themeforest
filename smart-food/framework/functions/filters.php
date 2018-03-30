<?php
/**
 * Filters for theme-related WordPress features.  These filters are for handling adding or modifying the 
 * output of common WordPress template tags to make for a richer theme development experience without 
 * having to resort to custom template tags.  Many of the filters are simply for adding HTML5 microdata.
 *
 * @package   ThemesDepotCore
 * @version   3.0.0
 * @author    Alessandro Tesoro
 * @copyright Copyright (c) 2014, Alessandro Tesoro
 * @link      https://themesdepot.org
 */

/* Default excerpt more. */
add_filter( 'excerpt_more', 'tdp_excerpt_more', 5 );

/* Modifies the arguments and output of wp_link_pages(). */
add_filter( 'wp_link_pages_args', 'tdp_link_pages_args', 5 );
add_filter( 'wp_link_pages_link', 'tdp_link_pages_link', 5 );

/* Filters to add microdata support to common template tags. */
add_filter( 'the_author_posts_link',          'tdp_the_author_posts_link',          5 );
add_filter( 'get_comment_author_link',        'tdp_get_comment_author_link',        5 );
add_filter( 'get_comment_author_url_link',    'tdp_get_comment_author_url_link',    5 );
add_filter( 'comment_reply_link',             'tdp_comment_reply_link_filter',      5 );
add_filter( 'get_avatar',                     'tdp_get_avatar',                     5 );
add_filter( 'post_thumbnail_html',            'tdp_post_thumbnail_html',            5 );
add_filter( 'comments_popup_link_attributes', 'tdp_comments_popup_link_attributes', 5 );

/**
 * Filters the excerpt more output with internationalized text and a link to the post.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $text
 * @return string
 */
function tdp_excerpt_more( $text ) {

	if ( 0 !== strpos( $text, '<a' ) )
		$text = sprintf( ' <a href="%s" class="more-link">%s</a>', get_permalink(), trim( $text ) );

	return $text;
}

/**
 * Wraps the output of `wp_link_pages()` with `<p class="page-links">` if it's simply wrapped in a 
 * `<p>` tag.
 *
 * @since  2.0.0
 * @access public
 * @param  array  $args
 * @return array
 */
function tdp_link_pages_args( $args ) {
	$args['before'] = str_replace( '<p>', '<p class="page-links">', $args['before'] );
	return $args;
}

/**
 * Wraps page "links" that aren't actually links (just text) with `<span class="page-numbers">` so that they 
 * can also be styled.  This makes `wp_link_pages()` consistent with the output of `paginate_links()`.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tdp_link_pages_link( $link ) {

	if ( 0 !== strpos( $link, '<a' ) )
		$link = "<span class='page-numbers'>{$link}</span>";

	return $link;
}

/**
 * Adds microdata to the author posts link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tdp_the_author_posts_link( $link ) {

	$pattern = array(
		"/(<a.*?)(>)/i",
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replace = array(
		'$1 class="url fn n" itemprop="url"$2',
		'$1<span itemprop="name">$2</span>$3'
	);

	return preg_replace( $pattern, $replace, $link );
}

/**
 * Adds microdata to the comment author link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tdp_get_comment_author_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
		"/(<a.*?)(>)/i",
		'/(<a.*?>)(.*?)(<\/a>)/i'
	);
	$replaces = array(
		'$1$2 fn n$3',
		'$1 itemprop="url"$2',
		'$1<span itemprop="name">$2</span>$3'
	);

	return preg_replace( $patterns, $replaces, $link );
}

/**
 * Adds microdata to the comment author URL link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tdp_get_comment_author_url_link( $link ) {

	$patterns = array(
		'/(class=[\'"])(.+?)([\'"])/i',
		"/(<a.*?)(>)/i"
	);
	$replaces = array(
		'$1$2 fn n$3',
		'$1 itemprop="url"$2'
	);

	return preg_replace( $patterns, $replaces, $link );
}

/**
 * Adds microdata to the comment reply link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $link
 * @return string
 */
function tdp_comment_reply_link_filter( $link ) {
	return preg_replace( '/(<a\s)/i', '$1itemprop="replyToUrl"', $link );
}

/**
 * Adds microdata to avatars.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $avatar
 * @return string
 */
function tdp_get_avatar( $avatar ) {
	return preg_replace( '/(<img.*?)(\/>)/i', '$1itemprop="image" $2', $avatar );
}

/**
 * Adds microdata to the post thumbnail HTML.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $html
 * @return string
 */
function tdp_post_thumbnail_html( $html ) {
	return function_exists( 'get_the_image' ) ? $html : preg_replace( '/(<img.*?)(\/>)/i', '$1itemprop="image" $2', $html );
}

/**
 * Adds microdata to the comments popup link.
 *
 * @since  2.0.0
 * @access public
 * @param  string  $attr
 * @return string
 */
function tdp_comments_popup_link_attributes( $attr ) {
	return 'itemprop="discussionURL"';
}


/**
 * Add browser classes to body tag
 * @since  3.0.0
 * @access public
 * @return array $classes
 */
function tdp_browser_body_class($classes) {

	global $post, $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		
	$classes[] = '';
	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) {
	    $classes[] = 'ie';
	    $browser = $_SERVER[ 'HTTP_USER_AGENT' ];
	    if( preg_match( "/MSIE 7.0/", $browser ) ) {
	        $classes[] = 'ie7';
	    }
	    if( preg_match( "/MSIE 8.0/", $browser ) ) {
	        $classes[] = 'ie8';
	    }
	    if( preg_match( "/MSIE 9.0/", $browser ) ) {
	        $classes[] = 'ie9';
	    }
	    if( preg_match( "/MSIE 7.0/", $browser ) ) {
	        $classes[] = 'ie10';
	    }
    }
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}	
		
	return $classes;
}
add_filter('body_class','tdp_browser_body_class');

/**
 * Fixes shortcodes p tags
 * @since  3.0.0
 * @access public
 * @return mixed $content
 */
function tdp_shortcode_fix($content){   
        $array = array (
            '<p>[' => '[', 
            ']</p>' => ']', 
            ']<br />' => ']'
        );
    
        $content = strtr($content, $array);
        return $content;
    }
add_filter('the_content', 'tdp_shortcode_fix');

/**
 * Filters crazy long titles in classes.
 */
function tdp_category_id_class($classes) {
        global $post;
        foreach((get_the_category($post->ID)) as $category)
            $classes[] = $category->category_nicename;
            return array_slice($classes, 0,5);
    }
add_filter('post_class', 'tdp_category_id_class');

/**
 * Filters scripts urls and remove version.
 */
function tdp_remove_script_version( $src ){
    return remove_query_arg( 'ver', $src );
}

add_filter( 'script_loader_src', 'tdp_remove_script_version' );
add_filter( 'style_loader_src', 'tdp_remove_script_version' );

/**
 * Helper function for getting the site title.
 *
 * @since  3.0.0
 */
function tdp_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'smartfood' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'tdp_wp_title', 10, 2 );