<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
function progression_setup() {
	
	if(function_exists( 'set_revslider_as_theme' )){
		add_action( 'init', 'pro_ezio_custom_slider_rev' );
		function pro_ezio_custom_slider_rev() { set_revslider_as_theme(); }
	}
	
	// Post Thumbnails
	add_theme_support('post-thumbnails');
	add_image_size('progression-blog', 900, 525, true); // Blog Post Image
	add_image_size('progression-page-title', 1800, 600, true); // Blog Post Image	
	add_image_size('progression-portfolio-thumb', 600, 338, true); //600 wide by 338 tall Image is cropped due to true setting
	add_image_size('progression-portfolio-single', 1200, 500, true);   //1200 wide x 800 tall with cropping
	
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery', 'video', 'audio', 'link' ) );
	add_post_type_support( 'portfolio', 'post-formats' );
	
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary-left' => __( 'Primary Left Menu', 'progression' ),
		'primary-right' => __( 'Primary Right Menu', 'progression' ),
	) );

	if (!current_user_can('manage_options')) {
		add_filter('show_admin_bar', '__return_false');
	}
	// show admin bar only for admins and editors
	if (!current_user_can('edit_posts')) {
		add_filter('show_admin_bar', '__return_false');
	}

	
	
}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );




 function template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'recipe' )   
  {
    return locate_template('archive-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'template_chooser');   



/**
 * Registering Custom Post Type
 */
add_action('init', 'progression_portfolio_init');
function progression_portfolio_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-type'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_type', 'portfolio', array('hierarchical' => true, 'label' => 'Portfolio Categories', 'query_var' => true, 'rewrite' => true));
	
	
	register_post_type(
		'testimonial',
		array(
			'labels' => array(
				'name' => 'Testimonials',
				'singular_name' => 'Testimonial'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'testimonial-type'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_taxonomy('testimonial_type', 'testimonial', array('hierarchical' => true, 'label' => 'Testimonial Categories', 'query_var' => true, 'rewrite' => true));

	register_post_type(
		'service',
		array(
			'labels' => array(
				'name' => 'Services',
				'singular_name' => 'Service'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'service-type'),
			'supports' => array('title', 'editor', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_taxonomy('service_type', 'service', array('hierarchical' => true, 'label' => 'Service Categories', 'query_var' => true, 'rewrite' => true));
	
}


/* WooCommerce */
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'description'   => 'Default Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'description' => __( 'Footer widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Homepage Widgets', 'progression' ),
		'id' => 'homepage-widgets',
		'description'   => 'Display Home: widgets on the homepage page template',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Home: Widgets on all Pages', 'progression' ),
		'id' => 'homepage-all-widgets',
		'description'   => 'Display Home: widgets on all pages above footer',
		'before_widget' => '<div id="%1$s" class="widget home-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="title-homepage">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Portfolio Sidebar', 'progression' ),
		'id' => 'sidebar-portfolio',
		'description'   => 'Optional portfolio Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Services Sidebar', 'progression' ),
		'id' => 'sidebar-service',
		'description'   => 'Optional services Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Shop Sidebar', 'progression' ),
		'id' => 'sidebar-shop',
		'description'   => 'WooCommerce Sidebar',
		'before_widget' => '<div id="%1$s" class="sidebar-item widget %2$s">',
		'after_widget' => '<div class="sidebar-divider"></div></div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );
	
}
add_action( 'widgets_init', 'progression_widgets_init' );


/* custom portfolio posts per page */
function my_post_queries( $query ) {
	$portfolio_count = get_theme_mod('portfolio_pages_progression');
	if ($query->is_main_query()){
	
	if(is_tax( 'portfolio_type' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $portfolio_count);
    }
	
	}
	

	if(is_post_type_archive( 'portfolio' )){
      $query->set('posts_per_page', $portfolio_count);
    }
	
	
	$testimonial_count = get_theme_mod('testimonial_pages_progression');
	if ($query->is_main_query()){
	
	if(is_tax( 'testimonial_type' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $testimonial_count);
    }
	
	}
	

	if(is_post_type_archive( 'testimonial' )){
      $query->set('posts_per_page', $testimonial_count);
    }
	
	
	
	$servicecount = get_theme_mod('service_pages_progression');
	if ($query->is_main_query()){
	
	if(is_tax( 'service_type' )){
      // show 50 posts on custom taxonomy pages
      $query->set('posts_per_page', $servicecount);
    }
	
	}
	

	if(is_post_type_archive( 'service' )){
      $query->set('posts_per_page', $servicecount);
    }
	
	
	
  }
add_action( 'pre_get_posts', 'my_post_queries' );





/* remove more link jump */
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'progression-style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'progression-style' ) );
	wp_enqueue_style( 'fira-font', '//code.cdn.mozilla.net/fonts/fira.css', array( 'progression-style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow', array( 'progression-style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.6.2.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', true );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );


function pro_mobile_menu_insert()
{
    ?>
	<script type="text/javascript">
	jQuery(document).ready(function($) {
	$('#mobile-menu .width-container').mobileMenu({
	    defaultText: '<?php _e( "Navigate to...", "progression" ); ?>',
	    className: 'select-menu',
	    subMenuDash: '&ndash;&ndash;'
	});
	});
	</script>
    <?php
}
add_action('wp_footer', 'pro_mobile_menu_insert');


/*
	MetaBox Options from Dev7studios
*/
require get_template_directory() . '/inc/dev7_meta_box_framework.php';
require get_template_directory() . '/inc/custom-fields.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


/**
 * Load Plugin Activiation
 */
require get_template_directory() . '/tgm-plugin-activation/plugin-activation.php';

