<?php
/**
 * StagFramework functions and definitions.
 *
 * @package StagFramework
 *
 */
if ( ! isset( $content_width ) )
	$content_width = 800;

/*
 * Set Retina Cookie
 */
global $is_retina;
( isset( $_COOKIE['retina'] ) ) ? $is_retina = true : $is_retina = false;

if ( ! function_exists( 'stag_theme_setup' ) ) :

function stag_theme_setup(){

	/* Load translation domain ---------------------------------------------*/
	load_theme_textdomain( 'stag', get_template_directory() . '/languages' );

	$locale = get_locale();

	$locale_file = get_template_directory(). "/languages/$locale.php";
	if ( is_readable( $locale_file ) ){
		require_once( $locale_file );
	}

	/* Register Menus ------------------------------------------------------*/
	register_nav_menus( array(
		'primary'   => __( 'Primary Menu', 'stag' ),
		'subheader' => __( 'Subheader Menu', 'stag' ),
		'footer'    => __( 'Footer Menu', 'stag' ),
	) );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( 'framework/assets/css/editor-style.css' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'title-tag' );

	// Switches default core markup for search form, comment form, and comments
	// to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Add support for WooCommerce plugin.
	 *
	 * @link http://wordpress.org/plugins/woocommerce/
	 */
	add_theme_support( 'woocommerce' );

	set_post_thumbnail_size( 870, 275, true );
}
endif;
add_action( 'after_setup_theme', 'stag_theme_setup' );


if ( ! function_exists( 'stag_sidebar_init' ) ) :
/**
* Register widget areas
*
* @return void
*/
function stag_sidebar_init(){
	register_sidebar(array(
		'name'          => __( 'Main Sidebar', 'stag' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description'   => __( 'Main sidebar that appears on the left or right side.', 'stag' )
	));

	register_sidebar(array(
		'name'          => __( 'Footer Widgets', 'stag' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description'   => __( 'Footer Widgets Area.', 'stag' )
	));

	register_sidebar(array(
		'name'          => __( 'Category Boxes Section', 'stag' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="widget grid-4 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'description'   => __( 'Use only &ldquo;Category Boxes&rdquo; widget here.', 'stag' )
	));
}
endif;
add_action( 'widgets_init', 'stag_sidebar_init' );

if ( ! function_exists( 'stag_wp_title' ) ) :
/**
* WordPress Title Filter
*
* @since StagFramework 1.0.1
* @param string $title Default title text for current view.
* @param string $sep Optional separator.
* @return string Filtered title.
*/
function stag_wp_title( $title, $sep ) {
	if ( function_exists( 'stag_check_third_party_seo' ) && ! stag_check_third_party_seo() ){
		$title .= get_bloginfo( 'name' );

		$site_desc = get_bloginfo( 'description', 'display' );
		if ( $site_desc && ( is_home() || is_front_page() ) ) {
			$title = "$title $sep $site_desc";
		}
	}
	return $title;
}
endif;
add_filter( 'wp_title', 'stag_wp_title', 10, 2 );


/**
* Enqueues scripts and styles for front end.
*
* @uses stag_google_font_url() Google Fonts URL
* @return void
*/
function stag_scripts_styles(){
	if ( ! is_admin() ) :

	global $woocommerce;

	/* Register Scripts ---------------------------------------------------*/
	if ( 'template-widgetized.php' == get_page_template_slug() ) {
		wp_enqueue_script( 'iosslider', get_template_directory_uri() . '/assets/js/iosslider.min.js', array('jquery'), '1.1.56', true );
	}

	wp_register_script( 'stag-custom', get_template_directory_uri().'/assets/js/jquery.custom.js', array( 'jquery' ), STAG_THEME_VERSION, true );
	wp_register_script( 'stag-plugins', get_template_directory_uri().'/assets/js/plugins.js', array( 'jquery' ), STAG_THEME_VERSION, true );

	/* Enqueue Scripts ---------------------------------------------------*/
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'stag-custom' );
	wp_enqueue_script( 'stag-plugins' );

	wp_localize_script( 'stag-custom', 'stag', array(
		'ajaxurl'               => admin_url( 'ajax.php' ),
		'is_woocommerce_active' => stag_is_woocommerce_active(),
		'accent_color'          => stag_get_option( 'style_accent_color' ),
		'show_favicon_badge'    => stag_get_option( 'shop_favicon_badge' ),
		'cart_contents_count'   => ( stag_is_woocommerce_active() ) ? $woocommerce->cart->cart_contents_count : false
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments

	/* Enqueue Styles ---------------------------------------------------*/
	wp_enqueue_style( 'stag-style', get_stylesheet_uri(), '', STAG_THEME_VERSION );

	$dependencies = array();

	if ( stag_is_woocommerce_active() ) $dependencies[] = 'crux-woocommerce';

	if ( ! wp_style_is( 'font-awesome', 'enqueued' ) ) {
		wp_enqueue_style( 'font-awesome', get_template_directory_uri()  . '/assets/css/font-awesome.css' , '', '4.3.0', 'all' );
	}

	wp_enqueue_style( 'google-fonts', stag_google_font_url(), array(), null );

	endif;
}
add_action( 'wp_enqueue_scripts', 'stag_scripts_styles' );

/**
 * Register the required plugins for this theme.
 *
 * @return void
 */
function stag_required_plugins() {
	$plugins = array(
		array(
			'name'             => 'WooCommerce - excelling eCommerce',
			'slug'             => 'woocommerce',
			'required'         => true,
			'force_activation' => true,
		),
		array(
			'name'             => 'StagTools',
			'slug'             => 'stagtools',
			'required'         => true,
			'force_activation' => true,
		),
		array(
			'name'             => 'Stag Custom Sidebars',
			'slug'             => 'stag-custom-sidebars',
			'required'         => true,
		),
		array(
			'name'             => 'LayerSlider WP',
			'slug'             => 'LayerSlider',
			'source'           => get_template_directory() . '/config-layerslider/layerslider.zip',
			'required'         => false,
			'version'          => '5.6.8',
		),
	);

	tgmpa( $plugins );
}
add_action( 'tgmpa_register', 'stag_required_plugins' );

/**
 * Check if there is any third party plugin active.
 *
 * @return bool
 */
function stag_check_third_party_seo() {
	include_once(ABSPATH .'wp-admin/includes/plugin.php');

	if ( is_plugin_active( 'headspace2/headspace.php' ) ) return true;
	if ( is_plugin_active( 'all-in-one-seo-pack/all_in_one_seo_pack.php' ) ) return true;
	if ( is_plugin_active( 'wordpres-seo/wp-seo.php' ) ) return true;

	return false;
}

/**
 * Modify body classes.
 *
 * @param  array $classes An array container body classes
 * @uses   stag_if_contains_backgrounds() Check if there a background set for page.
 * @uses   stag_sidebar_layout() Check which sidebar is active, if any.
 * @return array
 */
function stag_site_backgrounds( $classes ){
	if ( stag_if_contains_backgrounds() ) $classes[] = 'custom-page-background';

	if ( ! stag_should_load_sidebar() ) {
		$classes[] = 'full-width';
	}

	$classes[] = stag_sidebar_layout();

	if ( stag_is_woocommerce_active() ) {
		if ( crux_is_older_than_2_1() ) {
			$classes[] = 'not-wc-2-1';
		} else {
			$classes[] = 'wc-2-1';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'stag_site_backgrounds' );

/**
 * Check if given page has background.
 *
 * @uses stag_get_background() Returns false if page doesn't have any background.
 * @uses stag_is_woocommerce_active() Checks if WooCommerce plugin is active.
 * @global $wp_query
 * @return bool
 */
function stag_if_contains_backgrounds( ) {
	global $wp_query;
	$cat = $wp_query->get_queried_object();

	if ( is_home() || is_page() && stag_get_background() )
		return true;

	if ( stag_is_woocommerce_active() && is_product_category() )
		return true;

	return false;
}

/**
 * Get page background, if exists.
 *
 * @return Page background.
 */
function stag_get_background(){
	$output = false;

	if ( is_home() ) {
		$output = stag_get_option( 'blog_page_background' );
	} elseif ( is_page() ) {
		$output = get_post_meta( get_the_ID(), '_stag_background_image', true );
	} elseif ( ( stag_is_woocommerce_active() && function_exists( 'is_product_category' ) ) && is_product_category() ) {
		global $wp_query;
		$cat          = $wp_query->get_queried_object();
		$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
		$output       = wp_get_attachment_url( $thumbnail_id );
	}

	return $output;
}

/**
 * Checks if sidebars should be displayed when WooCommerce is active.
 *
 * @return bool
 */
function stag_should_load_sidebar() {
	if ( stag_is_woocommerce_active() && ( is_checkout() || is_cart() || is_account_page() )  )
		return false;

	return true;
}

/**
 * Append search box in main menu.
 *
 * @param  string $items Get navigation HTML
 * @param  object $args  Navigation object
 * @return string HTML of navigation containing search box
 */
function stag_append_search_nav( $items, $args ) {
	if ( is_object( $args ) && 'primary' == $args->theme_location ) {
		ob_start();
		// get_search_form();
		get_template_part( 'product', 'searchform-nav' );
		$form = ob_get_clean();
		$items .= '<li id="menu-item-search" class="noMobile menu-item menu-item-search-dropdown">' . $form . '</li>';
	}

	return $items;
}

/**
 * Check if the given page is WooCommerce page.
 *
 * @return bool
 * @deprecated 1.3.9
 */
function stag_is_woocommerce_page() {

	if ( stag_is_woocommerce_active() ){
		$wc_pages = array( 'myaccount', 'edit_address', 'change_password', 'shop', 'cart', 'checkout', 'pay', 'view_order', 'thanks', 'terms' );
		$page_id = get_the_ID();

		foreach ( $wc_pages as $page ) {
			if ( $page_id == woocommerce_get_page_id( $page ) ){
				return true;
			}
		}
	}

	return false;
}

/**
 * Sitewide sidebar logic.
 *
 * Also used to output to body class.
 *
 * @return string Sidebar setting e.g. no-sidebar, left-sidebar.
 */
function stag_sidebar_layout() {
	$single_page  = stag_get_option( 'sidebar_single_page_layout' );
	$page         = stag_get_option( 'sidebar_page_layout' );
	$archive_page = stag_get_option( 'sidebar_archive_page_layout' );
	$blog_page    = stag_get_option( 'sidebar_blog_page_layout' );

	$layout = $blog_page;
	$display = false;

	if ( is_page() || is_search() || is_404() || is_attachment() ) {
		$layout = $page;
	}

	if ( is_archive() ) {
		global $wp_query;

		$layout = $archive_page;

		// Check if it's a product category page and sidebar option is not blank.
		// Then override $layout with product category page setting.
		if ( function_exists( 'is_product_category' ) && is_product_category() ) {
			$cat            = $wp_query->get_queried_object();
			$sidebar_option = get_woocommerce_term_meta( $cat->term_id, 'display_sidebar', true );

			if ( $sidebar_option != '' ) {
				$layout = $sidebar_option;
			}
		}
	}

	if ( is_post_type_archive( 'product' ) ) {
		$shop_page = stag_get_option( 'sidebar_shop_page' );

		if ( isset( $shop_page ) ) {
			$layout = $shop_page;
		}
	}

	if ( is_single() ) {
		$layout = $single_page;
	}

	// Check if layout is not overridden on single pages.
	if ( is_singular() ) {
		$display = get_post_meta( get_the_ID(), '_stag_page_layout', true );
	}

	global $wp_query;
	if ( $wp_query->is_posts_page ) {
		$layout = get_post_meta( get_option( 'page_for_posts' ), '_stag_page_layout', true );
	}

	// If we got no result from the previous get_post_meta query or
	// we are not on a single post get the setting defined on the option page.
	if ( ! $display || 'default' == $display ) {
		$display = $layout;
	}

	// If we stil got no result, probably because no option page was saved.
	if ( ! $display ) {
		$display = 'right-sidebar';
	}

	if ( is_single() && 'product' == get_post_type() ) {
		$display = 'no-sidebar';
	}

	return $display;
}

/**
 * Hide layout metabox and background settings when not needed.
 *
 * @return void
 */
function stag_admin_print_script() {
	global $post_type;

	// Display only on page edit screens
	if ( 'page' !== $post_type ) return;

	?>
	<script type="text/javascript">
		document.addEventListener("DOMContentLoaded", function(event) {

			var page_template = document.getElementById('page_template');
			var layout_metabox = document.getElementById('stag-metabox-layout');
			var background_metabox = document.getElementById('stag-metabox-page-background');

			if (page_template.value === "template-widgetized.php") {
				layout_metabox.style.display = "none";
				background_metabox.style.display = "none";
			}

			page_template.addEventListener( 'change', function(e){
				if (e.target.value === "template-widgetized.php") {
					layout_metabox.style.display = "none";
					background_metabox.style.display = "none";
				} else {
					layout_metabox.style.display = "block";
					background_metabox.style.display = "block";
				}
			}, false );
		});
	</script>
	<?php
}
add_action( 'admin_print_scripts-post.php', 'stag_admin_print_script' );
add_action( 'admin_print_scripts-post-new.php', 'stag_admin_print_script' );


/**
 * Custom template tags for this theme.
 * And the StagFramework.
 */
require get_template_directory() . '/inc/template-tags.php';

include_once ( get_template_directory() . '/framework/stag-framework.php' );
include_once ( get_template_directory() . '/woocommerce/init.php' );
include_once ( get_template_directory() . '/config-gravityforms/init.php' );
include_once ( get_template_directory() . '/inc/init.php' );

// LayerSlider
include_once ( get_template_directory() . '/config-layerslider/init.php' );


if ( 'on' == stag_get_option( 'site_show_searchbar_in_nav' ) ) {
	add_action( 'wp_nav_menu_items', 'stag_append_search_nav', 10, 2 );
}

/**
 * Display static content section sitewide.
 *
 * Output depends on selected options under Theme Options > Static Content.
 *
 * @return void
 */
function stag_display_static_content() {
	$title            = stag_get_option( 'static_page_title' );
	$page             = stag_get_option( 'static_page' );
	$background_image = stag_get_option( 'static_page_background' );
	$background_color = stag_get_option( 'static_page_background_color' );
	$text_color       = stag_get_option( 'static_page_text_color' );
	$link_color       = stag_get_option( 'static_page_link_color' );
	$opacity          = stag_get_option( 'static_page_background_opacity' );

	$is_visible = false;

	if ( ! $page || $page === '-1' ) return;

	if ( is_page() && 'on' == stag_get_option( 'static_page_visible_on_single-pages' ) ) $is_visible = true;

	if ( is_single() && 'post' == get_post_type() && 'on' == stag_get_option( 'static_page_visible_on_single-posts' ) ) $is_visible = true;

	if ( is_archive() && 'post' == get_post_type() && 'on' == stag_get_option( 'static_page_visible_on_archive-pages' ) ) $is_visible = true;

	if ( is_archive() && 'product' == get_post_type() && 'on' == stag_get_option( 'static_page_visible_on_shop-archive-pages' ) ) $is_visible = true;

	if ( is_single() && 'product' == get_post_type() && 'on' == stag_get_option( 'static_page_visible_on_single-product-pages' ) ) $is_visible = true;

	if ( is_404() && 'on' == stag_get_option( 'static_page_visible_on_404-page' ) ) $is_visible = true;

	if ( is_home() || is_front_page() ) {
		if ( 'on' == stag_get_option( 'static_page_visible_on_homepage' ) ) {
			$is_visible = true;
		} else {
			$is_visible = false;
		}
	}

	global $wp_query;
	if ( $wp_query->is_posts_page ) {
		$is_visible = false;
		if ( 'on' == stag_get_option( 'static_page_visible_on_blog-page' ) ) $is_visible = true;
	}

	if ( $is_visible ) :

	$the_page = get_page( $page );

	$query = new WP_Query( array( 'page_id' => $page ) );

	while ( $query->have_posts() ) : $query->the_post();

	?>

	<div class="global-static-content" data-background-image="<?php echo $background_image; ?>" data-opacity="<?php echo $opacity; ?>" data-background-color="<?php echo $background_color; ?>" data-text-color="<?php echo $text_color; ?>" data-link-color="<?php echo $link_color; ?>">
		<div class="inside">
		    <article <?php post_class(); ?>>

				<?php if ( $title != '' ): ?>
		    	<h3 class="content-title"><?php echo $title; ?></h3>
				<?php endif; ?>

		        <div class="entry-content">
		            <?php
					global $more;
					$more = false;
					the_content( __( 'Read More&hellip;', 'stag' ) );
					wp_link_pages( array( 'before' => '<p><strong>'.__( 'Pages:', 'stag' ).'</strong> ', 'after' => '</p>', 'next_or_number' => 'number' ) );
					?>
		        </div>
		    </article>
		</div>
	</div>

	<?php

	endwhile;

	wp_reset_query();

	endif;

}
add_action( 'before_footer', 'stag_display_static_content', 20 );

function stag_registered_sidebars( $sidebars = array(), $exclude = array() ) {
	global $wp_registered_sidebars;

	foreach ( $wp_registered_sidebars as $sidebar ) {
		if ( ! in_array( $sidebar['name'], $exclude ) ) {
			$sidebars[$sidebar['id']] = $sidebar['name'];
		}
	}

	return $sidebars;
}

/**
 * Display custom css.
 *
 * @since 1.4
 */
if ( ! function_exists( 'crux_custom_css' ) ) :
function crux_custom_css() {
	ob_start();
	$stag_values = get_option( 'stag_framework_values' );
	$output = '';
	if ( array_key_exists( 'style_custom_css', $stag_values ) && $stag_values['style_custom_css'] != '' ) {
		$output .= stripslashes( $stag_values['style_custom_css'] );
		$output .= "\n";
	}
	echo apply_filters( 'stag_custom_css_output', $output );

	$css = ob_get_clean();

	echo "<style type='text/css'>$css</style>";
}
endif;

add_action( 'wp_head', 'crux_custom_css', 10 );
