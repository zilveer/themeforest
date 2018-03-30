<?php
/**
 * Monarch functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Monarch
 * @since Monarch 1.0
 */

define( 'MONARCH_THEME_VERSION', '1.3.1' );

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Monarch 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Monarch only works in WordPress 4.4 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.4-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'monarch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Monarch 1.0
 */
function monarch_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on monarch, use a find and replace
	 * to change 'monarch' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'monarch', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'        => esc_html__( 'Categories Menu', 'monarch' ),
		'info'           => esc_html__( 'Info Menu', 'monarch' ),
		'social'         => esc_html__( 'Social Links Menu', 'monarch' ),
		'buddy'          => esc_html__( 'BuddyPress Menu', 'monarch' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = monarch_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'monarch_custom_background_args', array(
		'default-color'      => $default_color,
		'wp-head-callback'   => '_custom_background_cb_monarch',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', monarch_fonts_url() ) );
	
	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // monarch_setup
add_action( 'after_setup_theme', 'monarch_setup' );

/**
 * Register sidebars.
 *
 * @since Monarch 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function monarch_sidebars_init() {
	// Register custom sidebars.
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area One', 'monarch' ),
		'id'            => 'sidebar-one',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'monarch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area BuddyPress', 'monarch' ),
		'id'            => 'sidebar-bp',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'monarch' ),
		'before_widget' => '<div class="elem col-xs-12 col-sm-12 col-md-6 col-lg-12 col-bg-12"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area bbPress', 'monarch' ),
		'id'            => 'sidebar-bb',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'monarch' ),
		'before_widget' => '<div class="elem col-xs-12 col-sm-12 col-md-6 col-lg-12 col-bg-12"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Widget Area Two', 'monarch' ),
		'id'            => 'sidebar-two',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'monarch' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Widgets Page Area', 'monarch' ),
		'id'            => 'widgets-page',
		'description'   => esc_html__( 'Add widgets here to appear in your widgets page.', 'monarch' ),
		'before_widget' => '<div class="elem col-xs-12 col-sm-12 col-md-6 col-lg-4 col-bg-3 ShowOnScroll"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );
}
add_action( 'widgets_init', 'monarch_sidebars_init' );

/**
 * Register widgets.
 *
 * @since Monarch 1.0
 *
 * @link https://codex.wordpress.org/Widgets_API
 */
require get_template_directory() . '/inc/widgets/widget_about.php';
require get_template_directory() . '/inc/widgets/widget_comments.php';
require get_template_directory() . '/inc/widgets/widget_posts.php';
require get_template_directory() . '/inc/widgets/widget_banner.php';
require get_template_directory() . '/inc/widgets/widget_facebook.php';

function monarch_widgets_init() {
    register_widget( 'widget_about' );
	register_widget( 'widget_comments' );
    register_widget( 'widget_posts' );
    register_widget( 'widget_banner' );
    register_widget( 'widget_facebook' );
}
add_action( 'widgets_init', 'monarch_widgets_init' );

if ( ! function_exists( 'monarch_fonts_url' ) ) :
/**
 * Register Google fonts for monarch.
 *
 * @since Monarch 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function monarch_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	$fonts[] = get_theme_mod( 'monarch_font_primary', 'Merriweather' ) . ':400,400italic,700,700italic';
	$fonts[] = get_theme_mod( 'monarch_font_secondary', 'Playfair Display' ) . ':400,400italic,700,700italic';

    /* If logo is not uploaded */
    $header_image = get_header_image();
    if ( empty( $header_image ) ) {
		$fonts[] = get_theme_mod( 'monarch_font_logo', 'UnifrakturCook' ) . ':700,400';
    }

	if ( get_theme_mod( 'monarch_font_cyrillic' ) ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( get_theme_mod( 'monarch_font_greek' ) ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( get_theme_mod( 'monarch_font_devanagari' ) ) {
		$subsets .= ',devanagari';
	} elseif ( get_theme_mod( 'monarch_font_vietnamese' ) ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Monarch 1.1
 */
function monarch_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'monarch_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Monarch 1.0
 */
function monarch_scripts() {

	// Styles
	wp_enqueue_style( 'bootstrap',     get_template_directory_uri() . '/css/bootstrap/bootstrap.min.css', array(), MONARCH_THEME_VERSION );
	wp_enqueue_style( 'main',          get_template_directory_uri() . '/css/main.css', array(), MONARCH_THEME_VERSION );
	wp_enqueue_style( 'monarch-style', get_stylesheet_uri(), array(), MONARCH_THEME_VERSION );
	wp_enqueue_style( 'fontello',      get_template_directory_uri() . '/css/fonts/fontello/css/fontello.css', array(), MONARCH_THEME_VERSION );
	wp_enqueue_style( 'ionicons',      get_template_directory_uri() . '/css/fonts/ionicons/css/ionicons.min.css', array(), MONARCH_THEME_VERSION );
	
	// Add custom fonts, used in the main stylesheet
	wp_enqueue_style( 'monarch-fonts', monarch_fonts_url(), array(), null );

	// Load the html5 shiv
	// wp_enqueue_script( 'html5shiv', get_template_directory_uri() . '/js/html5shiv.min.js', array(), MONARCH_THEME_VERSION );
	// wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	// Load the respond
	wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.min.js', array(), MONARCH_THEME_VERSION );
	wp_script_add_data( 'respond', 'conditional', 'lt IE 9' );

	// Plugins
	wp_enqueue_script( 'skiplinkfix',    get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'bootstrap',      get_template_directory_uri() . '/js/plugins/bootstrap.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'icheck',         get_template_directory_uri() . '/js/plugins/icheck.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'share',          get_template_directory_uri() . '/js/plugins/share.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'sticky',         get_template_directory_uri() . '/js/plugins/hc-sticky.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'flexmenu',       get_template_directory_uri() . '/js/plugins/flexmenu.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'nanobar',        get_template_directory_uri() . '/js/plugins/nanobar.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'slimscroll',     get_template_directory_uri() . '/js/plugins/jquery.scrollbar.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'modernizr',      get_template_directory_uri() . '/js/plugins/modernizr-2.7.2.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'imagesloaded',   get_template_directory_uri() . '/js/plugins/imagesloaded.pkgd.min.js', array(), MONARCH_THEME_VERSION, true );
	wp_enqueue_script( 'jquery-masonry');
	wp_enqueue_script( 'template',       get_template_directory_uri() . '/js/template.js', array(), MONARCH_THEME_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'monarch-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), MONARCH_THEME_VERSION );
	}

	wp_enqueue_script( 'monarch-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), MONARCH_THEME_VERSION, true );
	wp_localize_script( 'monarch-script', 'localizeJsText', array(
		'expand'        => '<span class="sr-only">' . esc_html__( 'expand child menu', 'monarch' ) . '</span>',
		'collapse'      => '<span class="sr-only">' . esc_html__( 'collapse child menu', 'monarch' ) . '</span>',
		'username'      => esc_html__( 'Username', 'monarch' ),
		'password'      => esc_html__( 'Password', 'monarch' ),
		'more'          => esc_html__( 'More', 'monarch' ),
		'viewmore'      => esc_html__( 'View More', 'monarch' ),
		'menu'          => esc_html__( 'Menu', 'monarch' ),
		'openclosemenu' => esc_html__( 'Open/Close Menu', 'monarch' ),
	) );
}

add_action( 'wp_enqueue_scripts', 'monarch_scripts' );

/**
 * Display descriptions in main navigation.
 *
 * @since Monarch 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function monarch_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && get_theme_mod('monarch_primary_descriptions') && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'monarch_nav_description', 10, 4 );

/**
 * Implement the Custom Header feature.
 *
 * @since Monarch 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Monarch 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Monarch 1.0
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Bootstrap comments form.
 *
 * @since Monarch 1.0
 */
add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="row"><div class="form-group comment-form-author col-md-4">' . '<label class="hidden" for="author">' . esc_html__( 'Name', 'monarch' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input placeholder="' . esc_html__( 'Name', 'monarch' ) . '*' . '" class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email col-md-4"><label class="hidden" for="email">' . esc_html__( 'Email', 'monarch' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input placeholder="' . esc_html__( 'Email', 'monarch' ) . '*' . '" class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url col-md-4"><label class="hidden" for="url">' . esc_html__( 'Website', 'monarch' ) . '</label> ' .
                    '<input placeholder="' . esc_html__( 'Website', 'monarch' ) . '" class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div>',
    );
    
    return $fields;
}
add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
function bootstrap3_comment_form( $args ) {
	if ( !is_user_logged_in() )
    $args['comment_field'] = '
		<div class="comment-form-comment">
            <label for="comment">' . esc_html__( 'Comment', 'monarch' ) . '</label> 
            <textarea placeholder="' . esc_html__( 'Comment', 'monarch' ) . '" class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>
        </div>';
    else
    $args['comment_field'] = '
		<div class="comment-form-comment">
            <label for="comment">' . esc_html__( 'Comment', 'monarch' ) . '</label> 
            <textarea placeholder="' . esc_html__( 'Comment', 'monarch' ) . '" class="form-control" id="comment" name="comment" cols="45" rows="4" aria-required="true"></textarea>
        </div>';
    return $args;
}
add_action('comment_form', 'bootstrap3_comment_button' );
function bootstrap3_comment_button() {
    echo '<br><button class="btn btn-primary pull-right" type="submit">' . esc_html__( 'Submit', 'monarch' ) . '</button><div class="clearfix"></div>';
}

/**
 * Customizer: Hide WordPress Toolbar for all users
 *
 * @since Monarch 1.1
 */
if( get_theme_mod( 'monarch_show_adminbar' ) ) {
	add_filter( 'show_admin_bar', '__return_false' );
}

/**
 * Login Page: add specific CSS class by filter.
 *
 * @since Monarch 1.1
 */
function specific_body_class_registration( $specific_body_class ) {
    $specific_body_class[] = 'registration';
    // return the $classes array
    return $specific_body_class;
}

/**
 * Customizer: Private Site
 * Redirect for Login Page
 *
 * @since Monarch 1.3
 */
function monarch_private_site() {
	if ( get_theme_mod( 'monarch_private_site' ) ) {
		if ( ! ( is_page( 'register' ) || is_page( 'login' ) ) ) {
			if ( ! is_user_logged_in() ) {
	    		wp_redirect( home_url() . '/login' );
	    		exit;
	    	}
		}
	}
	if ( is_page( 'login' ) ) {
	 	if ( is_user_logged_in() ) {
	 		wp_redirect( home_url() );
			exit;
		}
	}
}

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Monarch 1.0
 *
 * @see wp_add_inline_style()
 */
function monarch_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous .post-title { color: #fff; text-shadow: 0 0 10px rgba(0, 0, 0, 0.4); }
			.post-navigation .nav-previous .meta-nav { color: rgba(255, 255, 255, 0.7); }
			.post-navigation .nav-previous::before { background-image: url(' . esc_url( $prevthumb[0] ) . '); -moz-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); -webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); }
			.post-navigation .nav-previous a::before { content: ""; position: absolute; top: 5px; left: 5px; right: 5px; bottom: 5px; border: 1px solid rgba(255, 255, 255, 0.25); z-index: 3; }
			.post-navigation .nav-previous a::after { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.4); z-index: 2; }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous .post-title { color: #fff; text-shadow: 0 0 10px rgba(0, 0, 0, 0.4); }
			.post-navigation .nav-previous .meta-nav { color: rgba(255, 255, 255, 0.7); }
			.post-navigation .nav-previous::before { background-image: url(' . esc_url( $nextthumb[0] ) . '); -moz-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); -webkit-box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.7); }
			.post-navigation .nav-previous a::before { content: ""; position: absolute; top: 5px; left: 5px; right: 5px; bottom: 5px; border: 1px solid rgba(255, 255, 255, 0.25); z-index: 3; }
			.post-navigation .nav-previous a::after { content: ""; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.4); z-index: 2; }
		';
	}

	wp_add_inline_style( 'monarch-style', $css );
}
add_action( 'wp_enqueue_scripts', 'monarch_post_nav_background' );

/**
 * Customizer: Background image & color.
 *
 * @since Monarch 1.0
 */
function _custom_background_cb_monarch() {
	// $background is the saved custom image, or the default image.
	$background = set_url_scheme( get_background_image() );

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( $color === get_theme_support( 'custom-background', 'default-color' ) ) {
		$color = false;
	}

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';
	$styleColor = $color ? "#$color" : '';

	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( 'background_repeat', get_theme_support( 'custom-background', 'default-repeat' ) );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', get_theme_support( 'custom-background', 'default-position-x' ) );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', get_theme_support( 'custom-background', 'default-attachment' ) );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

	?>

		<style type="text/css" id="custom-background-css">
			body.error404 .body-bg, body.registration .body-bg, body.activation .body-bg { <?php echo trim( $style ); ?> }
	<?php
		if ( $styleColor ) {
	?>
			body .rtm-media-single-comments,
			body .mfp-content .rtm-single-meta,
			body,
			.wrapper { 
				background-color: <?php echo trim( $styleColor ); ?>;
			}

			.toolbar-scrollup .wp-admin, 
			.toolbar-scrollup .scrollup,
			.header-panel .nav-primary .current-menu-item > a::before { 
				border-color: <?php echo trim( $styleColor ); ?>;
			}

			.relatedposts .relatedpost::after,
			.author-info::after,
			.post-wrap .page.type-page::after,
			.post-wrap .hentry.type-attachment::after,
			.post-wrap .hentry.format-gallery::after,
			.post-wrap .hentry.format-standard::after,
			.post-wrap .hentry.format-video::after,
			.post-wrap .hentry.format-audio::after,
			.page-header .page-header-content::after,
			.widget::after {
			    background: -webkit-linear-gradient(135deg, <?php echo trim( $styleColor ); ?> 45%, #eaeaea 50%, #eaeaea 56%, #eaeaea 80%);
			    background: linear-gradient(315deg, <?php echo trim( $styleColor ); ?> 45%, #eaeaea 50%, #eaeaea 56%, #eaeaea 80%);
			}
	<?php
		}
	?>
		</style>
	<?php

}

/**
 * Jetpack Infinite Scroll Support.
 *
 * @since Monarch 1.0
 */
function monarch_infinite_scroll_init() {
	add_theme_support( 'infinite-scroll', array(
	    'type'           => 'scroll',
	    'footer'         => false,
	    'container'      => 'jp-scroll',
	    'wrapper'        => false,
	) );
}
add_action( 'after_setup_theme', 'monarch_infinite_scroll_init' );

/**
 * BuddyPress Cover Support.
 * Monarch theme callback function.
 * @see bp_legacy_theme_cover_image() to discover the one used by BP Legacy.
 *
 * @since Monarch 1.0
 */
function monarch_cover_image_callback( $params = array() ) {
    if ( empty( $params ) ) {
        return;
    }
 
    return '
        /* Cover image */
        #item-header.cover-image-container {
            background-image: url(' . $params['cover_image'] . ');
        }
    ';
}

function monarch_cover_image_css( $settings = array() ) {
    /**
     * If you are using a child theme, use bp-child-css
     * as the theme handel
     */
    $theme_handle = 'bp-parent-css';
 
    $settings['width']  = 1920;
    $settings['height'] = 400;
	$settings['default_cover'] = '"' . esc_url( get_template_directory_uri() ) . '/css/img/cover.jpg' . '"';
    $settings['theme_handle'] = $theme_handle;
 
    /**
     * Then you'll probably also need to use your own callback function
     * @see the previous snippet
     */
     $settings['callback'] = 'monarch_cover_image_callback';
     
 
    return $settings;
}
add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'monarch_cover_image_css', 10, 1 );
add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'monarch_cover_image_css', 10, 1 );

/**
 * Monarch WP Dashboard Styles
 *
 * @since Monarch 1.2
 */
function monarch_admin_style() {
   	wp_enqueue_style( 'monarch-admin', get_template_directory_uri() . '/css/admin.css', array(), MONARCH_THEME_VERSION );
}
add_action( 'admin_enqueue_scripts', 'monarch_admin_style' );

/**
 * Monarch WP Dashboard after theme is activated
 *
 * @since Monarch 1.2
 */
function monarch_after_theme_is_activated() {
    global $pagenow;
    if ( is_admin() && 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
        wp_redirect(admin_url('themes.php?page=monarch_admin_page_welcome'));
        exit;
    }
}
monarch_after_theme_is_activated();

/**
 * Monarch WP Dashboard Pages
 *
 * @since Monarch 1.2
 */
function monarch_wp_admin_menu() {
	add_theme_page( esc_html__( 'Monarch Welcome', 'monarch' ), esc_html__( 'Monarch Welcome', 'monarch' ), 'manage_options', 'monarch_admin_page_welcome', 'monarch_admin_page_welcome');
	add_theme_page( esc_html__( 'Monarch Changelog', 'monarch' ), esc_html__( 'Monarch Changelog', 'monarch' ), 'manage_options', 'monarch_admin_page_changelog', 'monarch_admin_page_changelog');
	add_theme_page( esc_html__( 'Monarch Help', 'monarch' ), esc_html__( 'Monarch Help', 'monarch' ), 'manage_options', 'monarch_admin_page_help', 'monarch_admin_page_help');
}
add_action('admin_menu', 'monarch_wp_admin_menu');

/**
 * Monarch WP Dashboard Menu
 *
 * @since Monarch 1.2
 */
function monarch_admin_page_links( $page ) {
?>
	<h2 class="nav-tab-wrapper wp-clearfix">
		<a href="<?php echo admin_url('themes.php?page=monarch_admin_page_welcome'); ?>" class="nav-tab <?php if ( $page == 'welcome') { echo 'nav-tab-active'; } ; ?>"><?php esc_html_e( 'Welcome', 'monarch' ); ?></a>
		<a href="<?php echo admin_url('themes.php?page=monarch_admin_page_changelog'); ?>" class="nav-tab <?php if ( $page == 'changelog') { echo 'nav-tab-active'; } ; ?>"><?php esc_html_e( 'Changelog', 'monarch' ); ?></a>
		<a href="<?php echo admin_url('themes.php?page=monarch_admin_page_help'); ?>" class="nav-tab <?php if ( $page == 'help') { echo 'nav-tab-active'; } ; ?>"><?php esc_html_e( 'Help', 'monarch' ); ?></a>
		<a href="<?php echo admin_url('themes.php?page=tgmpa-install-plugins'); ?>" class="tgmpa-install-plugins-link nav-tab <?php if ( $page == 'plugins') { echo 'nav-tab-active'; } ; ?>"><?php esc_html_e( 'Install Plugins', 'monarch' ); ?></a>
	</h2>
<?php	
}

/**
 * Monarch WP Dashboard Pages Header
 *
 * @since Monarch 1.2
 */
function monarch_admin_page_header() {
?>
	<h1><strong><?php esc_html_e( 'Monarch', 'monarch' ); ?></strong></h1>
	<div class="about-text">
		<?php esc_html_e( 'Innovative WordPress & BuddyPress Community Theme', 'monarch' ); ?>
		<p><strong><?php printf( esc_html__( 'Version %s', 'monarch' ), MONARCH_THEME_VERSION ); ?></strong></p>
	</div>
	<div class="wp-badge monarch"></div>
<?php	
}

/**
 * Monarch WP Dashboard Pages HTML
 *
 * @since Monarch 1.2
 */
require get_template_directory() . '/inc/admin/monarch_admin_page_changelog.php';
require get_template_directory() . '/inc/admin/monarch_admin_page_welcome.php';
require get_template_directory() . '/inc/admin/monarch_admin_page_help.php';

/**
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Monarch
 * @since      Monarch 1.1
 * @version    2.5.2 for parent theme Monarch for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'function_tgm_monarch_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 */
function function_tgm_monarch_register_required_plugins() {
	
	$plugins = array(
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => true,
		),
		array(
			'name'      => 'bbPress',
			'slug'      => 'bbpress',
			'required'  => true,
		),
		array(
			'name'      => 'Buddypress Media - rtMedia',
			'slug'      => 'buddypress-media',
			'required'  => true,
		),
		array(
			'name'      => 'Gallery Carousel Without JetPack',
			'slug'      => 'carousel-without-jetpack',
			'required'  => true,
		),
		array(
			'name'      => 'BuddyPress Default Data',
			'slug'      => 'bp-default-data',
			'required'  => false,
		),
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),
		array(
			'name'      => 'WordPress Social Login',
			'slug'      => 'wordpress-social-login',
			'required'  => false,
		),
		array(
			'name'      => 'BuddyPress Like',
			'slug'      => 'buddypress-like',
			'required'  => false,
		),
		array(
			'name'      => 'WP-Polls',
			'slug'      => 'wp-polls',
			'required'  => false,
		),
		array(
			'name'      => 'Buddypress Media - rtMedia',
			'slug'      => 'buddypress-media',
			'required'  => false,
		),
		array(
			'name'      => 'iFlyChat',
			'slug'      => 'iflychat',
			'required'  => false,
		),
		array(
			'name'      => 'BuddyDrive',
			'slug'      => 'buddydrive',
			'required'  => false,
		),
		array(
			'name'      => 'Envato Wordpress Toolkit - Auto Theme Updates',
			'slug'      => 'envato-wordpress-toolkit',
			'source'    => get_template_directory() . '/inc/plugins/envato-wordpress-toolkit.zip',
			'required'  => true,
		),
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 */
	$config = array(
		'id'           => 'monarch',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}