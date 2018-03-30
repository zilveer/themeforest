<?php
/**
 * Set up the content width value based on the theme's design.
 *
 * @see templatemela_content_width()
 *
 * @since TemplateMela 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 604;
}


function templatemela_setup() {
	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/font-awesome.css', '/fonts/css/font-awesome.css', templatemela_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	/*
	 * This theme supports all available post formats by default.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
	) );

	global $wp_version;
	if ( version_compare( $wp_version, '3.4', '>=' ) ) {
		add_theme_support( 'custom-background' ); 
	}

	// This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(
		'primary'   => __( 'TM Header Navigation', 'templatemela' ),
		'header-menu' => __('TM Header Top Links', 'templatemela'),
		'footer-menu' => __('TM Footer Navigation', 'templatemela'),
	) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'templatemela_setup' );

/*
 * Makes Templatemela available for translation.
 *
 * Translations can be added to the /languages/ directory.
 * If you're building a theme based on Templatemela, use a find and
 * replace to change 'templatemela' to the name of your theme in all
 * template files.
 */
function templatemela_textdomain_setup() {	
	load_theme_textdomain( 'templatemela', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	
	if ( is_readable( $locale_file ) ) {
		require_once( $locale_file );
	}
}
add_action( 'after_setup_theme', 'templatemela_textdomain_setup' );

/********************************************************
**************** TEMPLATE MELA CONTENT WIDTH ******************
********************************************************/
function templatemela_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', 'templatemela_content_width' );

/**
 * Getter function for Featured Content Plugin.
 *
 * @since TemplateMela 1.0
 *
 * @return array An array of WP_Post objects.
 */
function templatemela_get_featured_posts() {
	/**
	 * Filter the featured posts to return in TemplateMela.
	 * @param array|bool $posts Array of featured posts, otherwise false.
	 */
	return apply_filters( 'templatemela_get_featured_posts', array() );
}

/**
 * A helper conditional function that returns a boolean value.
 * @return bool Whether there are featured posts.
 */
function templatemela_has_featured_posts() {
	return ! is_paged() && (bool) templatemela_get_featured_posts();
}

/********************************************************
**************** TEMPLATE MELA SIDEBAR ******************
********************************************************/

function templatemela_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'templatemela' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );	
	register_sidebar( array(
		'name' => __( 'Secondary Sidebar', 'templatemela' ),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</li></ul></aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><ul class="main-ul"><li>',
	));
	register_sidebar( array(
		'name' => __( 'Homepage Sidebar', 'templatemela' ),
		'id' => 'sidebar-home',
		'description' => __( 'Appears on posts and pages in Front Page template, which has its own widgets', 'templatemela' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );
}
add_action( 'widgets_init', 'templatemela_widgets_init' );


/********************************************************
**************** TEMPLATE MELA FONT SETTING ******************
********************************************************/

function templatemela_fonts_url() {
	$fonts_url = '';
	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'templatemela' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'templatemela' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = esc_url(add_query_arg( $query_args, "//fonts.googleapis.com/css" ));
	}

	return $fonts_url;
}

/********************************************************
************ TEMPLATE MELA SCRIPT SETTING ***************
********************************************************/

function templatemela_scripts_styles() {
	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'templatemela-fonts', templatemela_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'font_awesome', get_template_directory_uri() . '/fonts/css/font-awesome.css', array(), '2.09' );
	
	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'font', get_template_directory_uri() . '/fonts/ArialRoundedMT.css',array());

	// Loads our main stylesheet.
	wp_enqueue_style( 'templatemela-style', get_stylesheet_uri(), array(), '2014-02-01' );

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'templatemela-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
	}

	// Loads JavaScript file with functionality specific to Templatemela.
	wp_enqueue_script( 'templatemela-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '2014-02-01', true );

	// Adds JavaScript for handling the navigation menu hide-and-show behavior.
	wp_enqueue_script( 'templatemela-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'templatemela_scripts_styles' );


/********************************************************
************ TEMPLATE MELA ADMIN FONT SETTING ***************
********************************************************/

function templatemela_admin_fonts() {
	wp_enqueue_style( 'templatemela-fonts', templatemela_fonts_url(), array(), null );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', 'templatemela_admin_fonts' );


/********************************************************
************ TEMPLATE MELA IMAGE ATTACHMENT ***************
********************************************************/

if ( ! function_exists( 'templatemela_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 * @return void
 */
function templatemela_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Templatemela 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'templatemela_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;


/********************************************************
************ TEMPLATE MELA GET URL **********************
********************************************************/

function templatemela_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}


/********************************************************
************ TEMPLATE MELA LIST AUTHOR SETTING**************
********************************************************/

if ( ! function_exists( 'templatemela_list_authors' ) ) :
/**
 * Print a list of all site contributors who published at least one post.
 * @return void
 */
function templatemela_list_authors() {
	$contributor_ids = get_users( array(
		'fields'  => 'ID',
		'orderby' => 'post_count',
		'order'   => 'DESC',
		'who'     => 'authors',
	) );

	foreach ( $contributor_ids as $contributor_id ) :
		$post_count = count_user_posts( $contributor_id );

		// Move on if user has not published a post (yet).
		if ( ! $post_count ) {
			continue;
		}
	?>

<div class="contributor">
  <div class="contributor-info">
    <div class="contributor-avatar"><?php echo get_avatar( $contributor_id, 132 ); ?></div>
    <div class="contributor-summary">
      <h2 class="contributor-name"><?php echo get_the_author_meta( 'display_name', $contributor_id ); ?></h2>
      <p class="contributor-bio"> <?php echo get_the_author_meta( 'description', $contributor_id ); ?> </p>
      <a class="contributor-posts-link" href="<?php echo esc_url( get_author_posts_url( $contributor_id ) ); ?>"> <?php printf( _n( '%d Article', '%d Articles', $post_count, 'templatemela' ), $post_count ); ?> </a> </div>
    <!-- .contributor-summary -->
  </div>
  <!-- .contributor-info -->
</div>
<!-- .contributor -->
<?php
	
	endforeach;
}
endif;


/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Presence of header image.
 * 3. Index views.
 * 4. Full-width content layout.
 * 5. Presence of footer widgets.
 * 6. Single views.
 * 7. Featured content layout.
 *
 * @since TemplateMela 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function templatemela_body_classes( $classes ) {
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}
	if ( get_header_image() ) {
		$classes[] = 'header-image';
	} else {
		$classes[] = 'masthead-fixed';
	}

	if ( is_archive() || is_search() || is_home() ) {
		$classes[] = 'list-view';
	}

	if ( ( ! is_active_sidebar( 'sidebar-2' ) )
		|| is_page_template( 'page-templates/full-width.php' )
		|| is_page_template( 'page-templates/contributors.php' )
		|| is_attachment() ) {
		//$classes[] = 'full-width';
	}

	if ( is_singular() && ! is_front_page() ) {
		$classes[] = 'singular';
	}

	if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
		$classes[] = 'slider';
	} elseif ( is_front_page() ) {
		$classes[] = 'grid';
	}

	return $classes;
}
add_filter( 'body_class', 'templatemela_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 */
 
function templatemela_post_classes( $classes ) {
	if ( ! post_password_required() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', 'templatemela_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
 
function templatemela_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'templatemela' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'templatemela_wp_title', 10, 2 );

// Implement Custom Header features.
require get_template_directory() . '/inc/custom-header.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Add Theme Customizer functionality.
require get_template_directory() . '/inc/customizer.php';

/*
 * Add Featured Content functionality.
 *
 * To overwrite in a plugin, define your own Featured_Content class on or
 * before the 'setup_theme' hook.
*/
 
if ( ! class_exists( 'Featured_Content' ) && 'plugins.php' !== $GLOBALS['pagenow'] ) {
	require get_template_directory() . '/inc/featured-content.php';
}

include_once("templatemela/megnor-functions.php");
?>
