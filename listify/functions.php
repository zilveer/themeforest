<?php
/**
 * Listify functions and definitions
 *
 * @package Listify
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
    $content_width = 750;
}

if ( ! function_exists( 'listify_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Listify 1.0.0
 *
 * @return void
 */
function listify_setup() {
    /**
     * Translations can be filed in the /languages/ directory.
     */
    $locale = apply_filters( 'plugin_locale', get_locale(), 'listify' );
    load_textdomain( 'listify', WP_LANG_DIR . "/listify-$locale.mo" );
    load_theme_textdomain( 'listify', get_template_directory() . '/languages' );

    /**
     * Add default posts and comments RSS feed links to head
     */
	add_theme_support( 'automatic-feed-links' );

    /**
     * Enable support for Post Thumbnails on posts and pages
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
	add_theme_support( 'post-thumbnails' );

    /**
     * Let WP set the title
     */
    add_theme_support( 'title-tag' );

    /**
     * This theme uses wp_nav_menu() in one location.
     */
    register_nav_menus( array(
        'primary' => __( 'Primary Menu (header)', 'listify' ),
        'secondary' => __( 'Secondary Menu', 'listify' ),
        'tertiary' => __( 'Tertiary Menu', 'listify' ),
        'social'  => __( 'Social Menu (footer)', 'listify' )
    ) );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'commentlist', 'gallery', 'caption'
    ) );

    /**
     * Editor Style
     */
    add_editor_style( 'css/editor-style.css' );

    /**
     * Setup the WordPress core custom background feature.
     */
    add_theme_support( 'custom-background', apply_filters( 'listify_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    ) ) );

	/**
	 * Selective refresh for widgets
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'listify_setup' );

/**
 * Sidebars and Widgets
 *
 * @since Listify 1.0.0
 *
 * @return void
 */
function listify_widgets_init() {
    register_widget( 'Listify_Widget_Ad' );
    register_widget( 'Listify_Widget_Features' );
    register_widget( 'Listify_Widget_Feature_Callout' );
    register_widget( 'Listify_Widget_Recent_Posts' );
    register_widget( 'Listify_Widget_Call_To_Action' );

    /* Standard Sidebar */
    register_sidebar( array(
        'name'          => __( 'Sidebar', 'listify' ),
        'id'            => 'widget-area-sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    /* Custom Homepage */
    register_sidebar( array(
        'name'          => __( 'Homepage', 'listify' ),
        'description'   => __( 'Widgets that appear on the "Homepage" Page Template', 'listify' ),
        'id'            => 'widget-area-home',
        'before_widget' => '<aside id="%1$s" class="home-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<div class="home-widget-section-title"><h2 class="home-widget-title">',
        'after_title'   => '</h2></div>',
    ) );

    /* Footer Column 1 */
    register_sidebar( array(
        'name'          => __( 'Footer Column 1 (wide)', 'listify' ),
        'id'            => 'widget-area-footer-1',
        'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    /* Footer Column 2 */
    register_sidebar( array(
        'name'          => __( 'Footer Column 2', 'listify' ),
        'id'            => 'widget-area-footer-2',
        'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );

    /* Footer Column 3 */
    register_sidebar( array(
        'name'          => __( 'Footer Column 3', 'listify' ),
        'id'            => 'widget-area-footer-3',
        'before_widget' => '<aside id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'listify_widgets_init' );

/**
 * Load fonts in TinyMCE
 *
 * @since Listify 1.0.0
 *
 * @return string $css
 */
function listify_mce_css( $css ) {
    $css .= ', ' . Listify_Customizer::$fonts->get_google_font_url() ;

    return $css;
}
add_filter( 'mce_css', 'listify_mce_css' );

/**
 * Scripts and Styles
 *
 * Load Styles and Scripts depending on certain conditions. Not all assets
 * will be loaded on every page.
 *
 * @since Listify 1.0.0
 *
 * @return void
 */
function listify_scripts() {
    /*
     * Collect all the custom styles
     */
    do_action( 'listify_output_customizer_css' );

	/** Output Google fonts if set */
	if ( false !== ( $url = Listify_Customizer::$fonts->get_google_font_url() ) ) {
		wp_enqueue_style( 'listify-fonts', esc_url( $url ) );
	}

    wp_enqueue_style( 'listify', get_template_directory_uri() . '/css/style.min.css', array(), 20160919 );
    wp_style_add_data( 'listify', 'rtl', 'replace' );

    /* Custom CSS */
	wp_add_inline_style( 'listify', Listify_Customizer_CSS::build() );

    /*
     * Scripts
     */

    /* Comments */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    $deps = array( 'jquery' );

    if ( listify_has_integration( 'wp-job-manager-regions' ) && get_option( 'job_manager_regions_filter' ) ) {
        $deps[] = 'job-regions';
    }

    wp_enqueue_script( 'listify', get_template_directory_uri() . '/js/app.min.js', $deps, 20160923, true );
    wp_enqueue_script( 'salvattore', get_template_directory_uri() . '/js/vendor/salvattore.min.js', array(), '', true );
    wp_enqueue_script( 'flexibility', get_template_directory_uri() . '/js/vendor/salvattore.min.js', array(), '', true );
	wp_script_add_data( 'flexibility', 'conditional', 'lt IE 11' );

    wp_localize_script( 'listify', 'listifySettings', apply_filters( 'listify_js_settings', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'homeurl' => home_url( '/' ),
        'archiveurl' => get_post_type_archive_link( 'job_listing' ),
        'is_job_manager_archive' => listify_is_job_manager_archive(),
		'is_rtl' => is_rtl(),
        'megamenu' => array(
            'taxonomy' => listify_theme_mod( 'nav-megamenu', 'job_listing_category' ) 
        ),
        'l10n' => array(
            'closed' => __( 'Closed', 'listify' ),
			'timeFormat' => get_option( 'time_format' ),
			'magnific' => array(
				'tClose' => __( 'Close', 'listify' ),
				'tLoading' => __( 'Loading...', 'listify' ),
				'tError' => __( 'The content could not be loaded.', 'listify' )
			)
        )
    ) ) );
}
add_action( 'wp_enqueue_scripts', 'listify_scripts' );

/**
 * Adds custom classes to the array of body classes.
 */
function listify_body_classes( $classes ) {
    global $wp_query, $post;

    if ( is_page_template( 'page-templates/template-archive-job_listing.php' ) ) {
        $classes[] = 'template-archive-job_listing';
    }

    if ( listify_is_widgetized_page() ) {
        $classes[] = 'template-home';
    }

    if (
        is_page_template( 'page-templates/template-full-width-blank.php' ) ||
        ( isset( $post ) && has_shortcode( get_post()->post_content, 'jobs' ) ) 
    ) {
        $classes[] = 'unboxed';
    }

    if ( is_singular() && get_post()->enable_tertiary_navigation ) {
        $classes[] = 'tertiary-enabled';
    }

	if ( 
		get_theme_mod( 'fixed-header', true ) ||
		( is_front_page() && 'transparent' != get_theme_mod( 'home-header-style', 'default' ) && get_theme_mod( 'fixed-header', true ) )
	) {
        $classes[] = 'fixed-header';
    }

	if ( is_front_page() ) {
		$classes[] = 'site-header--' . get_theme_mod( 'home-header-style', 'default' );
	}

    if ( listify_theme_mod( 'custom-submission', true ) ) {
        $classes[] = 'directory-fields';
    }

    $classes[] = 'color-scheme-' . sanitize_title( listify_theme_mod( 'color-scheme', 'default' ) );

    $classes[] = 'footer-' . listify_theme_mod( 'footer-display', 'dark' );

    $theme = wp_get_theme( 'listify' );

    if ( $theme->get( 'Name' ) ) {
        $classes[] = sanitize_title( $theme->get( 'Name' ) );
        $classes[] = sanitize_title( $theme->get( 'Name' ) . '-' . str_replace( '.', '', $theme->get( 'Version' ) ) );
    }

    return $classes;
}
add_filter( 'body_class', 'listify_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 */
function listify_post_classes( $classes ) {
    global $post;

    if (
        in_array( $post->post_type, array( 'post', 'page' ) ) ||
        is_search() &&
        ! has_shortcode( $post->post_content, 'jobs' )
    ) {
        $classes[] = 'content-box content-box-wrapper';
    }

    return $classes;
}
add_filter( 'post_class', 'listify_post_classes' );

/**
 * "Cover" images for pages and other content.
 *
 * If on an archive the current query will be used. Otherwise it will
 * look for a single item's featured image or an image from its gallery.
 *
 * @since Listify 1.0.0
 *
 * @param string $class
 * @return string $atts
 */
function listify_cover( $class, $args = array() ) {
    $defaults = apply_filters( 'listify_cover_defaults', array(
        'images' => false,
        'object_ids' => false,
        'size' => 'large'
    ) );

    $args  = wp_parse_args( $args, $defaults );
    $image = false;
    $atts  = array();

    global $wp_query;

	$post = get_post();

    // special for WooCommerce
    if ( ( function_exists( 'is_shop' ) && is_shop() ) || is_singular( 'product' )) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( wc_get_page_id( 'shop' ) ), $args[ 'size' ] );
    } else if ( is_tax( array( 'product_cat', 'product_tag' ) ) ) {
        $thumbnail_id = get_woocommerce_term_meta( get_queried_object_id(), 'thumbnail_id', true );
        $image = wp_get_attachment_image_src( $thumbnail_id, $args[ 'size' ] );
    } else if ( ( is_home() && ! in_the_loop() ) || ( ! in_the_loop() && is_singular( 'post' ) ) ) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_option( 'page_for_posts' ) ), $args[ 'size' ] );
    } else if ( ( ! did_action( 'loop_start' ) && is_archive() ) || ( $args[ 'images' ] || $args[ 'object_ids' ] ) ) {
        $image = listify_get_cover_from_group( $args );
    } else if ( is_a( $post, 'WP_Post' ) ) {
		if ( '' != $post->_thumbnail_id ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id(), $args[ 'size' ] );
        } else if ( apply_filters( 'listify_listing_cover_use_gallery_images', false ) && listify_has_integration( 'wp-job-manager' ) ) {
            $gallery = Listify_WP_Job_Manager_Gallery::get( $post->ID );

            if ( $gallery ) {
				$args[ 'images' ] = $gallery;
				unset( $args[ 'object_ids' ] );

                $image = listify_get_cover_from_group( $args );
            }
        }
    }

    $image = apply_filters( 'listify_cover_image', $image, $args );

    if ( ! $image ) {
        $class .= ' no-image';

        return sprintf( 'class="%s"', $class );
    }

    $class .= ' has-image';

    $atts[] = sprintf( 'style="background-image: url(%s);"', $image[0] );
    $atts[] = sprintf( 'class="%s"', $class );

    return implode( ' ', $atts );
}
add_filter( 'listify_cover', 'listify_cover', 10, 2 );

/**
 * Get a cover image from a "group" (WP_Query or array of IDS)
 *
 * @see listify_cover()
 *
 * @since Listify 1.0.0
 *
 * @param array|object $group
 * @return array $image
 */
function listify_get_cover_from_group( $args ) {
    $image = false;

    if ( empty( $args[ 'object_ids' ] ) && ( ! isset( $args[ 'images' ] ) || empty( $args[ 'images' ] ) ) ) {
        global $wp_query, $wpdb;

        if ( empty( $wp_query->posts ) ) {
            return $image;
        }

        $args[ 'object_ids' ] = wp_list_pluck( $wp_query->posts, 'ID' );
    }

    if ( ( ! isset( $args[ 'images' ] ) || empty( $args[ 'images' ] ) ) && ( isset( $args[ 'object_ids' ] ) && ! empty( $args[ 'object_ids' ] ) ) ) {

		$objects_hash = 'listify_cover_' . md5( json_encode( $args ) . WP_Job_Manager_Cache_Helper::get_transient_version( 'listify_cover_' . md5( json_encode( $args[ 'object_ids' ] ) ) ) );

		$image = get_transient( $objects_hash );

        if ( ! $image ) {
            $attachments = new WP_Query( array(
                'post_parent__in' => $args[ 'object_ids' ],
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => 1,
                'orderby' => 'rand',
                'update_post_term_cache' => false,
                'no_found_rows' => true
            ) );

            if ( $attachments->have_posts() ) {
                $image = wp_get_attachment_image_src( $attachments->posts[0]->ID, $args[ 'size' ] );

				$company_logo = $image[0] == $attachments->posts[0]->company_avatar;

                if ( file_exists( $image[0] ) && ! $company_logo ) {
                    set_transient( $objects_hash, $image, 6 * HOUR_IN_SECONDS );
                }
            }
        }
    } elseif ( isset( $args[ 'images' ] ) && ! empty( $args[ 'images' ] ) ) {
        shuffle( $args[ 'images' ] );

        $image = wp_get_attachment_image_src( current( $args[ 'images' ] ), $args[ 'size' ] );
    }

    return $image;
}

/**
 * Count the number of posts for a specific user.
 *
 * @since Listify 1.0.0
 *
 * @param string $post_type
 * @param int $user_id
 * @return int $count
 */
function listify_count_posts( $post_type, $user_id ) {
    global $wpdb;

    if ( false === ( $count = get_transient( $post_type . $user_id ) ) ) {
        $count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '$user_id' AND post_type = '$post_type' and post_status = 'publish'" );

        set_transient( $post_type . $user_id, $count );
    }

    return $count;
}

/**
 * Check if a specific integration is active.
 *
 * @since Listify 1.0.0
 *
 * @param string $integration
 * @return boolean
 */
function listify_has_integration( $integration ) {
    return array_key_exists( $integration, Listify_Integration::get_integrations() );
}

/** Standard Includes */
$includes = array(
    'addons/class-addons-admin.php',
    'customizer/class-customizer.php',

    'class-tgmpa.php',
    'class-strings.php',

    'class-activation.php',
    'setup/class-setup.php',

    'class-integration.php',

    'class-navigation.php',
    'class-widget.php',
    'class-page-settings.php',
	'class-search.php',

	'authors/class-authors.php',

    'class-widgetized-pages.php',
    'widgets/class-widget-ad.php',
    'widgets/class-widget-home-features.php',
    'widgets/class-widget-home-feature-callout.php',
    'widgets/class-widget-home-recent-posts.php',
    'widgets/class-widget-home-cta.php',

    'custom-header.php',
    'template-tags.php',
    'extras.php',
);

foreach ( $includes as $file ) {
    require( get_template_directory() . '/inc/' . $file );
}

/** Integrations */
$integrations = apply_filters( 'listify_integrations', array(
    'wp-job-manager' => defined( 'JOB_MANAGER_VERSION' ),
    'wp-job-manager-bookmarks' => defined( 'JOB_MANAGER_BOOKMARKS_VERSION' ),
    'wp-job-manager-wc-paid-listings' => defined( 'JOB_MANAGER_WCPL_VERSION' ),
    'wp-job-manager-tags' => defined( 'JOB_MANAGER_TAGS_PLUGIN_URL' ),

    'wp-job-manager-field-editor' => defined( 'WPJM_FIELD_EDITOR_VERSION' ),

    'wp-job-manager-regions' => class_exists( 'Astoundify_Job_Manager_Regions' ),
    'wp-job-manager-reviews' => class_exists( 'WP_Job_Manager_Reviews' ),
    'wp-job-manager-products' => class_exists( 'WP_Job_Manager_Products' ),
    'wp-job-manager-claim-listing' => class_exists( 'WP_Job_Manager_Claim_Listing' ) || defined( 'WPJMCL_VERSION' ),
    'wp-job-manager-wc-advanced-paid-listings' => defined( 'JWAPL_VERSION' ),

    'woocommerce' => class_exists( 'Woocommerce' ),
    'woocommerce-bookings' => class_exists( 'WC_Bookings' ),
    'woocommerce-social-login' => class_exists( 'WC_Social_Login' ),

    'facetwp' => class_exists( 'FacetWP' ),
    'jetpack' => defined( 'JETPACK__VERSION' ),
    'polylang' => defined( 'POLYLANG_VERSION' ),

    'ratings' => true
) );

foreach ( $integrations as $file => $dependancy ) {
    if ( $dependancy ) {
        require( get_template_directory() . sprintf( '/inc/integrations/%1$s/class-%1$s.php', $file ) );
    }
}
