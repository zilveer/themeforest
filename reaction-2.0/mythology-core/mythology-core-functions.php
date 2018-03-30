<?php 

/**
*
* MYTHOLOGY Core Version 1.0
*
* Includes a set of functions that extend the functionality of this WP theme.
* These are all optional - You can use them by calling their functions, or just ignore them.
*
* What's Inside in this Version:
* 
* mythology_localization();		Sets text-domain for language translations.
* mythology_wp_title();			HTML Title Re-Write
* mythology_posted_on();			Adds "Posted on [DATE]" to posts.
* get_custom_field();		Get Custom Field (for OT Meta Boxes)
* get_cat_slug();			Get Category Slug from ID (for Isotope)
* mythology_content_nav();		Cross-Post Navigation
* mythology_breadcrumbs();		Breadcrumbs 
* mythology_categorized_blog();	Used to detect category information.
* 
* @package mythology
*/


/**
* LOCALIZATION
* Defines the text domain 'mythology' - 
* Instructs where the language files are - 
* Then instructs the theme to load the language if it's in WP-CONFIG.php as WP_LANG
*/
function mythology_localization() {	
	load_theme_textdomain('mythology', get_template_directory() . '/theme-core/theme-functions/languages');
	$locale = get_locale();
	$locale_file = get_template_directory()."/theme-core/theme-functions/languages/$locale.php";
	if ( is_readable($locale_file) )
		require_once($locale_file);			
}    
add_action('init', 'mythology_localization'); /* Run the above function at the init() hook */

/**
 * HTML TITLE REWRITE
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function mythology_wp_title( $title, $sep ) {
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
		$title .= " $sep " . sprintf( __( 'Page %s', 'mythology' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mythology_wp_title', 10, 2 );


/**
* POSTED ON 
* Prints HTML with meta information for the current post-date/time and author.
*/
if ( ! function_exists( 'mythology_posted_on' ) ) :
function mythology_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) )
		$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'mythology' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;


/**
* GET CUSTOM FIELD
* Allows us to grab custom meta fields super easy
*/
function get_custom_field($key,$echo=false) {
	global $post;
	if(!isset($post->ID)) return null;
	$custom_field = get_post_meta($post->ID,$key,true);
	if($echo==false) return $custom_field;
	echo $custom_field;
}


/**
* CATEGORY SLUG FUNCTION
* Allows us to grab the category slug from an ID 
*/
function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}


/**
* CROSS-POST NAV
* Allows for NEXT/PREV post navigation in posts.
*/
if ( ! function_exists( 'mythology_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable.
 */
function mythology_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'mythology' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'mythology' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'mythology' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
		<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mythology' ) ); ?></div>
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mythology' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // mythology_content_nav


/**
* BREADCRUMBS
* Switch the NEXT/PREV post links to 1,2,3,4... links.
*/
function mythology_breadcrumbs() { 
	global $post; 
	$trail = '';
	$page_title = get_the_title($post->ID);
 
	if($post->post_parent) {
		$parent_id = $post->post_parent;
 
		while ($parent_id) {
			$page = get_page($parent_id);
			$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a> &raquo; ';
			$parent_id = $page->post_parent;
		}
 
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach($breadcrumbs as $crumb) $trail .= $crumb;
	}
 
	$trail .= $page_title;
	$trail .= ''; 
	return $trail; 
}


/**
 * CATEGORY FUNCTIONS
 * Returns true if a blog has more than 1 category.
 */
function mythology_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so mythology_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mythology_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in mythology_categorized_blog.
 */
function mythology_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'mythology_category_transient_flusher' );
add_action( 'save_post',     'mythology_category_transient_flusher' );

?>