<?php
/* Welcome to Bones */

// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'bones_ahoy', 16 );

function bones_ahoy() {
    // launching operation cleanup
    add_action( 'init', 'bones_head_cleanup' );
    // remove WP version from RSS
    add_filter( 'the_generator', 'bones_rss_version' );
    // clean up comment styles in the head
    add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
    // clean up gallery output in wp
    add_filter( 'gallery_style', 'bones_gallery_style' );

    // launching this stuff after theme setup
    bones_theme_support();

    // adding sidebars to Wordpress (these are created in functions.php)
    add_action( 'widgets_init', 'toddlers_register_sidebars' );

    // cleaning up random code around images
    add_filter( 'the_content', 'bones_filter_ptags_on_images' );
    // cleaning up excerpt
    add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

function bones_head_cleanup() {
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}

// remove injected CSS from gallery
function bones_gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}



/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// default thumb size
	set_post_thumbnail_size(125, 125, true);

	// rss
	add_theme_support('automatic-feed-links');

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'top-menu' => __( 'Top Menu', 'toddlers' ),   // top nav in header
			'main-menu' => __( 'Main Menu', 'toddlers' ),   // main nav in header
			'mobile-menu' => __( 'Mobile Menu', 'toddlers' ),   // Mobile nav
			'footer-menu' => __( 'Footer Menu', 'toddlers' ),   // Footer nav

		)
	);
} /* end bones theme support */


/*********************
MENUS & NAVIGATION
*********************/

// the top menu
function unf_top_menu() {
    wp_nav_menu(array(
    	'container' => false,                          				// remove nav container
    	'container_class' => 'top-menu-container menu clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Top Menu', 'toddlers' ),  					// nav name
    	'menu_class' => 'nav top-menu',  							// adding custom nav class
    	'theme_location' => 'top-menu',                 			// where it's located in the theme
    	'before' => '',                                				// before the menu
		'after' => '',                                  			// after the menu
		'link_before' => '',                            			// before each link
		'link_after' => '',                             			// after each link
		'depth' => 2,                                   			// limit the depth of the nav
		'fallback_cb' => 'wp_bootstrap_navwalker::fallback',		// fallback
    	'walker' => new wp_bootstrap_navwalker()        			// for bootstrap nav
	));
}

// the main menu
function unf_main_menu() {
    wp_nav_menu(array(
    	'container' => false,                          				// remove nav container
    	'container_class' => 'main-menu-container menu clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Main Menu', 'toddlers' ),  					// nav name
    	'menu_class' => 'nav main-menu',  							// adding custom nav class
    	'theme_location' => 'main-menu',                 			// where it's located in the theme
    	'before' => '',                                				// before the menu
		'after' => '',                                  			// after the menu
		'link_before' => '',                            			// before each link
		'link_after' => '',                             			// after each link
		'depth' => 2,                                   			// limit the depth of the nav
		'fallback_cb' => 'wp_bootstrap_navwalker::fallback',		// fallback
    	'walker' => new wp_bootstrap_navwalker()        			// for bootstrap nav
	));
}
// the mobile menu
function unf_mobile_menu() {
    wp_nav_menu(array(
    	'container' => false,                          				// remove nav container
    	'container_class' => 'mobile-menu-container menu clearfix',   // class of container (should you choose to use it)
    	'menu' => __( 'Mobile Menu', 'toddlers' ),  					// nav name
    	'menu_class' => 'nav mobile-menu',  							// adding custom nav class
    	'theme_location' => 'mobile-menu',                 			// where it's located in the theme
    	'before' => '',                                				// before the menu
		'after' => '',                                  			// after the menu
		'link_before' => '',                            			// before each link
		'link_after' => '',                             			// after each link
		'depth' => 2,                                   			// limit the depth of the nav
		'fallback_cb' => 'wp_bootstrap_navwalker_mobile::fallback',		// fallback
    	'walker' => new wp_bootstrap_navwalker_mobile()        			// for bootstrap nav
	));
}

// the footer menu
function unf_footer_menu() {
    wp_nav_menu(array(
    	'container' => false,                           			// remove nav container
    	'container_class' => 'footer-menu-container menu clearfix ', // class of container (should you choose to use it)
    	'menu' => __( 'Footer Menu', 'toddlers' ),  				// nav name
    	'menu_class' => 'footer-menu nav navbar-nav navbar-right footernav',  // adding custom nav class
    	'theme_location' => 'footer-menu',                 			// where it's located in the theme
    	'before' => '',                                 			// before the menu
		'after' => '',                                  			// after the menu
		'link_before' => '',                            			// before each link
		'link_after' => '',                             			// after each link
		'depth' => 1,                                   			// limit the depth of the nav
		'fallback_cb' => 'wp_bootstrap_navwalker::fallback',		// fallback
    	'walker' => new wp_bootstrap_navwalker()        			// for bootstrap nav
	));
}

/*********************
PAGE NAVI
*********************/

// Numeric Page Navi (built into the theme by default)
function bones_page_navi() {
	global $wp_query;
	$bignum = 999999999;
	if ( $wp_query->max_num_pages <= 1 )
	return;

	echo '<nav class="pagination">';

		echo paginate_links( array(
			'base' 			=> str_replace( $bignum, '%#%', esc_url( get_pagenum_link($bignum) ) ),
			'format' 		=> '',
			'current' 		=> max( 1, get_query_var('paged') ),
			'total' 		=> $wp_query->max_num_pages,
			'prev_text' 	=> '&larr;',
			'next_text' 	=> '&rarr;',
			'type'			=> 'list',
			'end_size'		=> 3,
			'mid_size'		=> 3
		) );

	echo '</nav>';
} /* end page navi */

/*********************
CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

function bones_excerpt_more($more) {
	global $post;

return '...</p>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 * This is necessary to allow usage of the usual l10n process with printf().
*/
function bones_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s','toddlers'), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}
?>