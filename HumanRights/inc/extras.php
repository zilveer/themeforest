<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package WPCharming
 */

/**
 * Automatic theme updates notifications
 *
 */
if ( ! function_exists( 'wpcharming_updater' ) ) {
	function wpcharming_updater() {
		global $wpc_option;
		if ( isset( $wpc_option['tf_username'] ) && trim( $wpc_option['tf_username'] ) != '' ) {
			if ( isset( $wpc_option['tf_api'] ) && trim( $wpc_option['tf_api'] ) != '' ) {
				load_template( get_template_directory() . '/inc/updater/envato-theme-update.php' );
				if ( class_exists( 'Envato_Theme_Updater' ) ) {
					Envato_Theme_Updater::init( $username, $api_key, 'WPCharming' );
				}
			}
		}
	}
	add_action( 'after_setup_theme', 'wpcharming_updater' );
}

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function wpcharming_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'wpcharming_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wpcharming_body_classes( $classes ) {

	global $woocommerce;
	global $post;

	if ( is_page_template( 'template-fullwidth.php' ) || is_404() ) {
		$classes[] = 'page-fullwidth';
	}

	// WooCommerce
	if ( $woocommerce ) {
		$woo_layout  = get_post_meta( woocommerce_get_page_id('shop'), '_wpc_page_layout', true );
		if ( $woo_layout == 'right-sidebar' || $woo_layout == 'left-sidebar' ) {
			$classes[] = 'shop-has-sidebar';
		}
	}

	// Boxed Layout
	if ( wpcharming_option('site_boxed') || (isset($_REQUEST['boxed_layout']) && $_REQUEST['boxed_layout'] = 'enable' ) ) {
		$classes[] = 'layout-boxed';
	}

	return $classes;
}
add_filter( 'body_class', 'wpcharming_body_classes' );

/**
 * Adds custom classes to main content.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wpcharming_get_layout_class() {
	global $post;
	global $woocommerce;
	$classes              = 'right-sidebar';
	$page_layout_admin    = wpcharming_option('page_layout');
	$archive_layout_admin = wpcharming_option('archive_layout');
	$blog_layout_admin    = wpcharming_option('blog_layout');
	$single_shop_layout   = wpcharming_option('single_shop_layout');

	// Pages
	if ( is_page() ){
		$page_meta = get_post_meta( $post->ID, '_wpc_page_layout', true );

		if ( $page_meta == 'sidebar-default' || $page_meta == '' ) {
			$classes = $page_layout_admin;
		} else {
			$classes = $page_meta;
		}
	}

	// Single Post
	if ( is_single() ) {
		if ( $blog_layout_admin ) {
			$classes = $blog_layout_admin;
		} else {
			$classes = 'right-sidebar';
		}
	}

	// Archive
	if ( (is_archive() || is_author()) & !is_front_page() ) {
		if ( $archive_layout_admin !== '' ){
			$classes = $archive_layout_admin;
		} else {
			$classes = 'right-sidebar';
		}

	}

	// Search
	if ( is_search() ) {
		if ( $archive_layout_admin !== '' ){
			$classes = $archive_layout_admin;
		} else {
			$classes = 'right-sidebar';
		}

	}

	// Blog Page
	if ( !is_front_page() && is_home() ) {
		if ( $blog_layout_admin ) {
			$classes = $blog_layout_admin;
		} else {
			$classes = 'right-sidebar';
		}
	}

	// WooCommerce
	if ( $woocommerce ) {
		$shop_layout_meta = get_post_meta( woocommerce_get_page_id('shop'), '_wpc_page_layout', true );
		if ( $woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() ) {
			if ( $shop_layout_meta ) {
				$classes = $shop_layout_meta;
			} else {
				$classes = 'no-sidebar';
			}
		}
		if ( $woocommerce && is_product() ) {
			if ( $single_shop_layout ) {
				$classes = $single_shop_layout;
			} else {
				$classes = 'no-sidebar';
			}
		}
	}

	return $classes;
}


/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function wpcharming_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'wpcharming_setup_author' );

/**
 * Output the status of widets.
 *
 */
function wpcharming_sidebar_desc( $sidebar_id ) {

	$desc           = '';
	$column         = str_replace( 'footer-', '', $sidebar_id );
	$footer_columns = wpcharming_option('footer_columns');

	if ( $column > $footer_columns ) {
		$desc = __( 'This widget area is currently disabled. You can enable it Theme Options - Footer section.', 'base' );
	}

	return esc_html( $desc );
}

/**
 * Browser detection body_class() output
 */
function wpcharming_browser_body_class($classes) {
        global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
        if($is_lynx) $classes[] = 'lynx';
        elseif($is_gecko) $classes[] = 'gecko';
        elseif($is_opera) $classes[] = 'opera';
        elseif($is_NS4) $classes[] = 'ns4';
        elseif($is_safari) $classes[] = 'safari';
        elseif($is_chrome) $classes[] = 'chrome';
        elseif($is_IE) {
                $classes[] = 'ie';
                if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
                $classes[] = 'ie'.$browser_version[1];
        } else $classes[] = 'unknown';
        if($is_iphone) $classes[] = 'iphone';
        if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
                 $classes[] = 'osx';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
                 $classes[] = 'linux';
           } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
                 $classes[] = 'windows';
           }
        return $classes;
}
add_filter('body_class','wpcharming_browser_body_class');
