<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Filters and Actions
 */

/**
 * Enqueue Google fonts style to admin screen for custom header display.
 * @internal
 */
function _action_theme_admin_fonts() {
	wp_enqueue_style( 'fw-theme-lato', fw_theme_font_url(), array(), fw()->theme->manifest->get_version() );
}
add_action( 'admin_print_scripts-appearance_page_custom-header', '_action_theme_admin_fonts' );

if ( ! function_exists( '_action_theme_setup' ) ) :
	/**
	 * Theme setup.
	 *
	 * Set up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support post thumbnails.
	 * @internal
	 */
	function _action_theme_setup() {

		/*
		 * Make Theme available for translation.
		 */
		load_theme_textdomain( 'fw', get_template_directory() . '/languages' );

		// This theme styles the visual editor to resemble the theme style.
		add_editor_style( array( 'css/editor-style.css', fw_theme_font_url() ) );

		// Add RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// Enable support for Post Thumbnails, and declare two sizes.

		set_post_thumbnail_size( 592, 372, true );
		//add_image_size( 'fw-theme-full-width', 1038, 576, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
		) );

		// Add support for featured content.
		add_theme_support( 'featured-content', array(
			'featured_content_filter' => 'fw_theme_get_featured_posts',
			'max_posts' => 6,
		) );

		// This theme uses its own gallery styles.
		add_filter( 'use_default_gallery_style', '__return_false' );

        add_theme_support( 'post-thumbnails', array('post','fw-portfolio','fw-member','fw-testimonials','product') );


	}
endif;
add_action( 'after_setup_theme', '_action_theme_setup' );

/**
 * Adjust content_width value for image attachment template.
 * @internal
 */
function _action_theme_content_width() {
	if ( is_attachment() && wp_attachment_is_image() ) {
		$GLOBALS['content_width'] = 810;
	}
}
add_action( 'template_redirect', '_action_theme_content_width' );

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
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 * @internal
 */
function _filter_theme_body_classes( $classes ) {
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

    if(function_exists('fw_ext_sidebars_get_current_position'))
        if ( in_array(fw_ext_sidebars_get_current_position(), array('full', 'left'))
            || is_page_template( 'page-templates/full-width.php' )
            || is_page_template( 'page-templates/contributors.php' )
            || is_attachment() ) {
            $classes[] = 'full-width';
        }

	if (  is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'footer-widgets';
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
add_filter( 'body_class', '_filter_theme_body_classes' );

/**
 * Extend the default WordPress post classes.
 *
 * Adds a post class to denote:
 * Non-password protected page with a post thumbnail.
 *
 * @param array $classes A list of existing post class values.
 * @return array The filtered post class list.
 * @internal
 */
function _filter_theme_post_classes( $classes ) {
	if ( ! post_password_required() && ! is_attachment() && has_post_thumbnail() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'post_class', '_filter_theme_post_classes' );

/**
 * Create a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 * @internal
 */
function _filter_theme_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fw' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', '_filter_theme_wp_title', 10, 2 );


/**
 * Flush out the transients used in fw_theme_categorized_blog.
 * @internal
 */
function _action_theme_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'fw_theme_category_count' );
}
add_action( 'edit_category', '_action_theme_category_transient_flusher' );
add_action( 'save_post',     '_action_theme_category_transient_flusher' );

/**
 * Theme Customizer support
 */
{
	/**
	 * Implement Theme Customizer additions and adjustments.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @internal
	 */
	function _action_theme_customize_register( $wp_customize ) {
		// Add custom description to Colors and Background sections.
		$wp_customize->get_section( 'colors' )->description           = __( 'Background may only be visible on wide screens.', 'fw' );
		$wp_customize->get_section( 'background_image' )->description = __( 'Background may only be visible on wide screens.', 'fw' );

		// Add postMessage support for site title and description.
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		// Rename the label to "Site Title Color" because this only affects the site title in this theme.
		$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'fw' );

		// Rename the label to "Display Site Title & Tagline" in order to make this option extra clear.
		$wp_customize->get_control( 'display_header_text' )->label = __( 'Display Site Title &amp; Tagline', 'fw' );

		// Add the featured content section in case it's not already there.
		$wp_customize->add_section( 'featured_content', array(
			'title'       => __( 'Featured Content', 'fw' ),
			'description' => sprintf( __( 'Use a <a href="%1$s">tag</a> to feature your posts. If no posts match the tag, <a href="%2$s">sticky posts</a> will be displayed instead.', 'fw' ),
				esc_url( add_query_arg( 'tag', _x( 'featured', 'featured content default tag slug', 'fw' ), admin_url( 'edit.php' ) ) ),
				admin_url( 'edit.php?show_sticky=1' )
			),
			'priority'    => 130,
		) );

		// Add the featured content layout setting and control.
		$wp_customize->add_setting( 'featured_content_layout', array(
			'default'           => 'grid',
			'sanitize_callback' => '_fw_theme_sanitize_layout',
		) );

		$wp_customize->add_control( 'featured_content_layout', array(
			'label'   => __( 'Layout', 'fw' ),
			'section' => 'featured_content',
			'type'    => 'select',
			'choices' => array(
				'grid'   => __( 'Grid',   'fw' ),
				'slider' => __( 'Slider', 'fw' ),
			),
		) );
	}
	add_action( 'customize_register', '_action_theme_customize_register' );

	/**
	 * Sanitize the Featured Content layout value.
	 *
	 * @param string $layout Layout type.
	 * @return string Filtered layout type (grid|slider).
	 * @internal
	 */
	function _fw_theme_sanitize_layout( $layout ) {
		if ( ! in_array( $layout, array( 'grid', 'slider' ) ) ) {
			$layout = 'grid';
		}

		return $layout;
	}

	/**
	 * Bind JS handlers to make Theme Customizer preview reload changes asynchronously.
	 * @internal
	 */
	function _action_theme_customize_preview_js() {
		wp_enqueue_script(
			'fw-theme-customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			fw()->theme->manifest->get_version(),
			true
		);
	}
	add_action( 'customize_preview_init', '_action_theme_customize_preview_js' );
}

/**
 * Register widget areas.
 * @internal
 */
function _action_theme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'General Widget Area', 'fw' ),
		'id'            => 'sidebar-1',
		'description'   => __( '', 'fw' ),
        'before_widget' => '<div id="%1$s" class="space x2 %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<div class="tittle-line tittle-sml-mg">
                            <h5>',
        'after_title' => '</h5>
                            <div class="divider-1 small">
                              <div class="divider-small"></div>
                            </div>
                          </div>',
	) );
}
add_action( 'widgets_init', '_action_theme_widgets_init' );


//remove sidebars for portfolio taxonomy
function _filter_remove_taxonomy_from_sidebars($taxonomy_list) {

    unset($taxonomy_list['fw-portfolio-category']);
    unset($taxonomy_list['fw-members']);

    return $taxonomy_list;
}
add_filter('fw_ext_sidebars_taxonomies', '_filter_remove_taxonomy_from_sidebars');

function _filter_remove_post_type_from_sidebars($post_types_list) {

    unset($post_types_list['page']);
    unset($post_types_list['fw-portfolio']);
    return $post_types_list;
}
add_filter('fw_ext_sidebars_post_types', '_filter_remove_post_type_from_sidebars' );

/** @internal */
function _filter_fw_ext_sidebars_add_conditional_tag($conditional_tags) {

    unset($conditional_tags['is_404']);

    return $conditional_tags;
}
add_filter('fw_ext_sidebars_conditional_tags', '_filter_fw_ext_sidebars_add_conditional_tag' );


add_filter('wp_list_categories', '_filter_add_span_cat_count');
function _filter_add_span_cat_count($links) {
    $links = str_replace('</a> (', '</a> <span>', $links);
    $links = str_replace(')', '</span>', $links);
    return $links;
}

add_filter('get_archives_link','_filter_archive_link',99);
if (!function_exists('_filter_archive_link')) :
    function _filter_archive_link($url) {
        $url = str_replace( '</a>&nbsp;(', '</a><span>', $url );
        $url = str_replace( ')</li>', '</span></li>', $url );
        return $url;
    }
endif;

if (!function_exists('_action_theme_count_post_visits')) :
    function _action_theme_count_post_visits() {
        /**
         * Count posts visits
         */
        if ( !is_single() ) return;
        global $post;
        $views = get_post_meta($post->ID, 'fw_post_views', true);
        $views = intval($views);
        update_post_meta( $post->ID, 'fw_post_views', ++$views);
    }
endif;
add_action('wp_head', '_action_theme_count_post_visits');


if ( ! function_exists( '_action_theme_footer_widgets_init' ) ) :
    function _action_theme_footer_widgets_init() {
        /**
         * Register widget areas
         * @internal
         */
        $beforeWidget = '<div class="w-col w-col-4 col-footer">';
        $afterWidget  = '</div>';
        $beforeTitle  = '<div class="footer-tittle"><h6>';
        $afterTitle   = '</h6></div>';
        register_sidebar(array('name' => __('Footer Column 1','fw'), 'id' => 'footer-1', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));
        register_sidebar(array('name' => __('Footer Column 2','fw'), 'id' => 'footer-2', 'before_widget' => $beforeWidget, 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));
        register_sidebar(array('name' => __('Footer Column 3','fw'), 'id' => 'footer-3', 'before_widget' => '<div class="w-col w-col-4 col-footer no-line">', 'after_widget' => $afterWidget, 'before_title' => $beforeTitle, 'after_title' => $afterTitle, 'description' => ''));
    }
endif;
add_action( 'widgets_init', '_action_theme_footer_widgets_init' );

if ( ! function_exists( '_filter_active_slider' ) ) :
    /**
     * Filter for disable framework sliders
     *
     * @param array $sliders
     */
    function _filter_active_slider( $sliders ) {
        $sliders = array_diff( $sliders, array( 'bx-slider', 'nivo-slider', 'owl-carousel' ) );

        return $sliders;
    }

    add_filter( 'fw_ext_slider_activated', '_filter_active_slider' );
endif;


if ( ! function_exists( 'fw_theme_tab_slider_population_method_custom_options' ) ) :
    /**
     * Filter for disable standard slider fields for tab slider
     *
     * @param array $arr
     */
    function fw_theme_tab_slider_population_method_custom_options( $arr ) {
        unset(
            $arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['title'],
            $arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['desc']
        );

        return $arr;
    }

    add_filter( 'fw_ext_tab_slider_population_method_custom_options', 'fw_theme_tab_slider_population_method_custom_options' );
endif;

if ( ! function_exists( 'fw_theme_boxed_slider_population_method_custom_options' ) ) :
    /**
     * Filter for disable standard slider fields for boxed slider
     *
     * @param array $arr
     */
    function fw_theme_boxed_slider_population_method_custom_options( $arr ) {
        unset(
            $arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['title'],
            $arr['wrapper-population-method-custom']['options']['custom-slides']['slides_options']['desc']
        );

        return $arr;
    }

    add_filter( 'fw_ext_boxed_slider_population_method_custom_options', 'fw_theme_boxed_slider_population_method_custom_options' );
endif;

function fw_remove_woo_actions(){
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
    remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10 );
    //remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description', 10 );
}
add_action('init','fw_remove_woo_actions');

if ( ! function_exists( 'fw_woocommerce_taxonomy_archive_description' ) ) {
    /**
     * Show an archive description on taxonomy archives
     *
     * @subpackage	Archives
     */
    function fw_woocommerce_taxonomy_archive_description() {
        if ( is_tax( array( 'product_cat', 'product_tag' ) ) && get_query_var( 'paged' ) == 0 ) {
            $description = wc_format_content( term_description() );
            if ( $description ) {
                $p_array = array('<p>','</p>');
                echo '&nbsp;<span class="lighter"><span>|</span> <em>'.str_replace($p_array, "", $description).'</em></span>';
            }
        }
    }
    add_action( 'woocommerce_archive_description', 'fw_woocommerce_taxonomy_archive_description', 10 );
}