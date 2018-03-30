<?php 
/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/

/*-----------------------------------------------------------------------------------*/
/*  Set Max Content Width
/* ----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) )
	$content_width = 1170;

/*-----------------------------------------------------------------------------------*/
/*	Default Theme Constant
/*-----------------------------------------------------------------------------------*/

define('AZ_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/framework/');
define('AZ_THEME_NAME', 'ibuki');
$options_ibuki = get_option('ibuki');


/*-----------------------------------------------------------------------------------*/
/*	No Header/Footer Global
/*-----------------------------------------------------------------------------------*/

$az_options_show_header = true;
$az_options_show_footer = true;

/*-----------------------------------------------------------------------------------*/
/*	Enqueue Admin Style
/*-----------------------------------------------------------------------------------*/

function az_admin_scripts() {
	wp_enqueue_style( 'az-admin', get_template_directory_uri() . '/_include/css/admin-style.css' );
}
add_action( 'admin_enqueue_scripts', 'az_admin_scripts' );

/*-----------------------------------------------------------------------------------*/
/*	Theme Setup
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_theme_setup' ) ) {
	function az_theme_setup(){
		// Load Translation Domain
		load_theme_textdomain(AZ_THEME_NAME, get_template_directory() . '/languages');

		// Register Menus
		register_nav_menus(array('primary_menu' => __('Primary Menu', AZ_THEME_NAME) ));
		register_nav_menus(array('one_page_menu' => __('One Page Menu', AZ_THEME_NAME) ));

		// Add RSS Feed links to HTML
		add_theme_support('automatic-feed-links');

		// Add Support for Post Formats
		add_theme_support('post-formats', array('quote','video','audio', 'image', 'gallery','link'));

		// Configure Thumbnails
		add_theme_support('post-thumbnails');

		add_image_size('latest-blog-thumb', 578, 384, true); // Blog Latest Posts Thumb Only
		add_image_size('latest-masonry-blog-thumb', 578 ); // Blog Latest Posts Masonry Thumb Only

		add_image_size('listed-blog-thumb', 578, 384, true); // Blog Listed Thumb Only
		add_image_size('center-blog-thumb', 1000, 500, true); // Blog Center Thumb Only
		add_image_size('masonry-blog-thumb', 578 ); // Portfolio Thumb Masonry Only
		add_image_size('standard-blog-thumb', 800, 390, true ); // Portfolio Thumb Grid Only

		add_image_size('team-thumb', 478, 384, true); // Team Thumb Only

		add_image_size('portfolio-thumb', 578, 384, true); // Portfolio Thumb Grid Only
		add_image_size('portfolio-masonry-thumb', 578 ); // Portfolio Thumb Grid Only
		add_image_size('portfolio-wall-thumb', 578, 384, true); // Portfolio Thumb Wall Only

		add_image_size('gallery-thumb', 500, 500, true); // Gallery Thumb Grid Only
		add_image_size('gallery-masonry-thumb', 500 ); // Gallery Thumb Masonry Only
		add_image_size('gallery-wall-thumb', 500, 500, true); // Gallery Wall Thumb Grid Only

		add_image_size('masonry-block-normal-size', 500, 500, true); // Masonry Block Normal Size Only
		add_image_size('masonry-block-wide-size', 1000, 500, true); // Masonry Block Wide Size Only
		add_image_size('masonry-block-tall-size', 500, 1000, true); // Masonry Block Tall Size Only
		add_image_size('masonry-block-big-size', 1000, 1000, true); // Masonry Block Big Size Only

		// Remove Emoji's
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}
}
add_action('after_setup_theme', 'az_theme_setup');

/*-----------------------------------------------------------------------------------*/
/*	Custom Login Logo
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_custom_login_logo' ) ) {
	function az_custom_login_logo() {
	    echo '<style type="text/css">
	        h1 a { background-image:url('.get_template_directory_uri().'/_include/img/logo-admin.png) !important; height: 98px !important; width: auto !important; background-size: auto auto !important; }
	    </style>';
	}
}
add_action('login_enqueue_scripts', 'az_custom_login_logo');

if ( !function_exists( 'az_wp_login_url' ) ) {
	function az_wp_login_url() {
		return home_url();
	}
}
add_filter('login_headerurl', 'az_wp_login_url');

if ( !function_exists( 'az_wp_login_title' ) ) {
	function az_wp_login_title() {
		return get_option('blogname');
	}
}
add_filter('login_headertitle', 'az_wp_login_title');

/*-----------------------------------------------------------------------------------*/
/*	Register / Enqueue Google Fonts or Custom Fonts
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'ibuki_google_fonts' ) ) {
	function ibuki_google_fonts() {
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'ibuki-font', "$protocol://fonts.googleapis.com/css?family=Lato:400,300italic,300,100italic,100,400italic,700,700italic,900italic,900|Montserrat:400,700" );
	}
}
add_action( 'wp_enqueue_scripts', 'ibuki_google_fonts' );

if ( !function_exists( 'az_enqueue_custom_fonts_css' ) ) {
	function az_enqueue_custom_fonts_css() {
		wp_register_style('custom-fonts', get_template_directory_uri() . '/_include/css/custom-fonts.css.php');
		wp_enqueue_style('custom-fonts');
	}
} 

if( !empty($options_ibuki['enable-custom-fonts']) && $options_ibuki['enable-custom-fonts'] == 1 ) {
	// Enqueue Custom Fonts CSS 
	add_action('wp_enqueue_scripts', 'az_enqueue_custom_fonts_css', 100);
}

/*-----------------------------------------------------------------------------------*/
/*	Register / Enqueue JS
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_register_js' ) ) {
	function az_register_js() {	
		
		if (!is_admin()) {
			
			// Register 
			wp_register_script('modernizer', get_template_directory_uri() . '/_include/js/modernizr.js', 'jquery', '2.7.1');
			wp_register_script('plugins', get_template_directory_uri() . '/_include/js/plugins.js', 'jquery', '1.0.0', TRUE);
			wp_register_script('isotope-js', get_template_directory_uri() . '/_include/js/isotope.js', 'jquery', '1.0.0', TRUE);
			wp_register_script('main', get_template_directory_uri() . '/_include/js/main.js', 'jquery', '1.0.0', TRUE);
			
			// Enqueue
			wp_enqueue_script('jquery');
			wp_enqueue_script('modernizer');
			wp_enqueue_script('isotope-js');
			wp_enqueue_script('plugins');
			wp_enqueue_script('main');

			wp_localize_script(
				'main', 
				'theme_objects',
				array(
					'base' => get_template_directory_uri()
				)
			);
			
		}
	}
}
add_action('wp_enqueue_scripts', 'az_register_js');

if ( !function_exists( 'az_page_specific_js' ) ) {
	function az_page_specific_js() {
		// Loads the javascript required for threaded comments
		if( is_singular() && comments_open() && get_option( 'thread_comments') ) 
	        wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'az_page_specific_js'); 

/*-----------------------------------------------------------------------------------*/
/*	Register / Enqueue CSS
/*-----------------------------------------------------------------------------------*/

//Main Styles
if ( !function_exists( 'az_main_styles' ) ) {
	function az_main_styles() {		 
		// Register 
		wp_register_style('bootstrap', get_template_directory_uri() . '/_include/css/bootstrap.min.css');
		wp_register_style('main-styles', get_stylesheet_directory_uri() . '/style.css');
			 
		// Enqueue
		wp_enqueue_style('bootstrap'); 
		wp_enqueue_style('main-styles');
	}
}
add_action('wp_enqueue_scripts', 'az_main_styles');

//Gravity Forms
if(class_exists('GFForms') )
{
	add_action('wp_enqueue_scripts', 'az_add_gravity_scripts');
}
function az_add_gravity_scripts()
{
	wp_register_style( 'az-gravity' , get_template_directory_uri(). '/_include/css/gravity-mod.css' , array('gforms_formsmain_css'), '');
	wp_enqueue_style( 'az-gravity');
}

/*-----------------------------------------------------------------------------------*/
/*	Dynamic Styles
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_enqueue_dynamic_css_color' ) ) {
	function az_enqueue_dynamic_css_color() {
		wp_register_style('dynamic-colors', get_template_directory_uri() . '/_include/css/color.css.php', 'style');
		wp_enqueue_style('dynamic-colors'); 
	} 
}

if ( !function_exists( 'az_enqueue_dynamic_css_custom' ) ) {
	function az_enqueue_dynamic_css_custom() {
		wp_register_style('custom', get_template_directory_uri() . '/_include/css/custom.css.php', 'style');
		wp_enqueue_style('custom');
	} 
}

if( !empty($options_ibuki['enable-custom-color']) && $options_ibuki['enable-custom-color'] == 1 ) {
	// Enqueue Custom Colors CSS 
	add_action('wp_enqueue_scripts', 'az_enqueue_dynamic_css_color');
}

if( !empty($options_ibuki['enable-custom-css']) && $options_ibuki['enable-custom-css'] == 1 ) {
	// Enqueue Custom CSS 
	add_action('wp_enqueue_scripts', 'az_enqueue_dynamic_css_custom');
}


/*-----------------------------------------------------------------------------------*/
/*	Widget Area
/*-----------------------------------------------------------------------------------*/

if(function_exists('register_sidebar')) {
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', AZ_THEME_NAME), 
		'description' => __('Widget area for blog pages.', AZ_THEME_NAME),
		'id' => 'sidebar-blog',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  =>
		'<h3 class="widget-title">',
		'after_title'   => '</h3>'
		)
	);
	
	register_sidebar(array(
		'name' => __('Page Sidebar', AZ_THEME_NAME), 
		'description' => __('Widget area for pages.', AZ_THEME_NAME),
		'id' => 'sidebar-page', 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3 class="widget-title">', 
		'after_title'   => '</h3>'
		)
	);

	register_sidebar(array(
		'name' => __('WooCommerce Sidebar', AZ_THEME_NAME), 
		'description' => __('Widget area for pages.', AZ_THEME_NAME),
		'id' => 'sidebar-woocommerce', 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3 class="widget-title">', 
		'after_title'   => '</h3>'
		)
	);
	
	register_sidebar(array(
		'name' => __('Footer Area 1', AZ_THEME_NAME), 
		'description' => __('Widget area for footer area.', AZ_THEME_NAME),
		'id' => 'footer-area-one', 
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3>', 
		'after_title'   => '</h3>'
		)
	);
	
	register_sidebar(array(
		'name' => __('Footer Area 2', AZ_THEME_NAME), 
		'description' => __('Widget area for footer area.', AZ_THEME_NAME),
		'id' => 'footer-area-two',  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3>', 
		'after_title'   => '</h3>'
		)
	);
	
	register_sidebar(array(
		'name' => __('Footer Area 3', AZ_THEME_NAME), 
		'description' => __('Widget area for footer area.', AZ_THEME_NAME),
		'id' => 'footer-area-three',  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3>', 
		'after_title'   => '</h3>'
		)
	);

	register_sidebar(array(
		'name' => __('Footer Area 4', AZ_THEME_NAME), 
		'description' => __('Widget area for footer area.', AZ_THEME_NAME),
		'id' => 'footer-area-four',  
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>', 
		'before_title'  => '<h3>', 
		'after_title'   => '</h3>'
		)
	);
}

/*------------------------------------------------------------------------------*/
/*	Widgets: Twitter - Flickr - Dribbble - Social Icons
/*------------------------------------------------------------------------------*/

include('framework/widgets/flickr-widget.php');
include('framework/widgets/twitter-widget.php');
include('framework/widgets/dribbble-widget.php');
include('framework/widgets/social-widget.php');

/*-----------------------------------------------------------------------------------*/
/*	Common Fix
/*-----------------------------------------------------------------------------------*/

// Twitter Filter
function TwitterFilter($string)
{
$content_array = explode(" ", $string);
$output = '';

foreach($content_array as $content)
{
//starts with http://
if(substr($content, 0, 7) == "http://")
$content = '<a href="' . $content . '">' . $content . '</a>';

//starts with www.
if(substr($content, 0, 4) == "www.")
$content = '<a href="http://' . $content . '">' . $content . '</a>';

if(substr($content, 0, 8) == "https://")
$content = '<a href="' . $content . '">' . $content . '</a>';

if(substr($content, 0, 1) == "#")
$content = '<a href="https://twitter.com/search?src=hash&q=' . $content . '">' . $content . '</a>';

if(substr($content, 0, 1) == "@")
$content = '<a href="https://twitter.com/' . $content . '">' . $content . '</a>';

$output .= " " . $content;
}

$output = trim($output);
return $output;
}

function attr($s,$attrname) { // return html attribute
	preg_match_all('#\s*('.$attrname.')\s*=\s*["|\']([^"\']*)["|\']\s*#i', $s, $x);
	if (count($x)>=3) return $x[2][0]; else return "";
}

/*-----------------------------------------------------------------------------------*/
/* Exclude Pages from search
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'az_exclude_pages_in_search' ) ) {
    function az_exclude_pages_in_search($query) {
        if( !$query->is_admin && $query->is_search ) {
            $query->set('post_type', 'post');
        }
    return $query;
    }
}
//add_filter('pre_get_posts','az_exclude_pages_in_search');

/*-----------------------------------------------------------------------------------*/
/*	Excerpt Length
/*-----------------------------------------------------------------------------------*/

if ( ! function_exists( 'az_excerptlength_post' ) ) {
	function az_excerptlength_post($length) {
	    return 15;
	}
}

if ( ! function_exists( 'az_excerptmore' ) ) {
	function az_excerptmore($more) {
	    return ' ...';
	}
}

if ( ! function_exists( 'az_excerpt' ) ) {	
	function az_excerpt( $length_callback = '', $more_callback = 'az_excerptmore' ) {

	    global $post;
		
	    if ( function_exists( $length_callback ) ) {
			add_filter( 'excerpt_length', $length_callback );
	    }
		
	    if ( function_exists( $more_callback ) ){
			add_filter( 'excerpt_more', $more_callback );
	    }
		
	    $output = get_the_excerpt();
	    $output = apply_filters( 'wptexturize', $output );
	    $output = apply_filters( 'convert_chars', $output );
	    $output = $output;
		
	    return $output;
	}   
}

/*-----------------------------------------------------------------------------------*/
/*	Meta Config
/*-----------------------------------------------------------------------------------*/

function enqueue_media(){
	
	//enqueue the correct media scripts for the media library 
	$wp_version = floatval(get_bloginfo('version'));
	
	if ( $wp_version < "3.5" ) {
	    wp_enqueue_script(
	        'redux-opts-field-upload-js', 
	        AZ_FRAMEWORK_DIRECTORY . 'assets/upload/field_upload_3_4.js', 
	        array('jquery', 'thickbox', 'media-upload'),
	        time(),
	        true
	    );
	    wp_enqueue_style('thickbox');// thanks to https://github.com/rzepak
	} else {
	    wp_enqueue_script(
	        'redux-opts-field-upload-js', 
	        AZ_FRAMEWORK_DIRECTORY . 'assets/upload/field_upload.js', 
	        array('jquery'),
	        time(),
	        true
	    );
	    wp_enqueue_script(
	        'redux-field-gallery-js', 
	        AZ_FRAMEWORK_DIRECTORY . 'assets/gallery/field_gallery.js', 
	        array('jquery'),
	        time(),
	        true
	    );

	 	wp_enqueue_style( 'wp-color-picker' );
	 	
		wp_enqueue_script(
			'redux-field-color-js', 
			AZ_FRAMEWORK_DIRECTORY . 'assets/color/field_color.js',
			array( 'jquery', 'wp-color-picker' ),
			time(),
			true
		);
		wp_enqueue_style(
			'redux-field-color-css', 
			AZ_FRAMEWORK_DIRECTORY . 'assets/color/field_color.css', 
			time(),
			true
		);
	    wp_enqueue_media();
	}
	
}

//Meta Styling
function  az_metabox_styles() {
	wp_enqueue_style('az_meta_css', AZ_FRAMEWORK_DIRECTORY .'assets/css/az_meta.css');
}

//Meta Scripts
function az_metabox_scripts() {
	wp_register_script('az-upload', AZ_FRAMEWORK_DIRECTORY .'assets/js/az-meta.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('az-upload');
	wp_localize_script('redux-opts-field-upload-js', 'redux_upload', array('url' => AZ_FRAMEWORK_DIRECTORY .'assets/upload/blank.png'));
}
add_action('admin_enqueue_scripts', 'az_metabox_scripts');
add_action('admin_enqueue_scripts', 'az_metabox_styles');
add_action('admin_enqueue_scripts', 'enqueue_media');

//Meta Core functions
include("framework/meta/meta-config.php");

// Page Header Meta
include("framework/meta/page-meta.php");

// Team Meta
include("framework/meta/team-meta.php");

// Portfolio Meta
include("framework/meta/portfolio-meta.php");

// Post Meta
include("framework/meta/post-meta.php");

// Footer Meta
include("framework/meta/footer-meta.php");

// Preloader Meta
if( !empty($options_ibuki['enable-preloader']) && $options_ibuki['enable-preloader'] == 1) {
    $preloader = (!empty($options_ibuki['preloader-selection'])) ? $options_ibuki['preloader-selection'] : '2';
    if($preloader == '2'){
    	include("framework/meta/preloader-meta.php");
    }
}

// Transparent Header
if( !empty($options_ibuki['use-transparent-header']) && $options_ibuki['use-transparent-header'] == 1) {
	include("framework/meta/transparent-header-meta.php");
}

/*-----------------------------------------------------------------------------------*/
/*  Custom Output Page Title / Custom Output Caption Title
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'az_custom_get_page_title' ) ) {
    function az_custom_get_page_title() {
        $page_title = '';
        if( is_archive() ) {
                if( is_category() ) {
                    $page_title = sprintf( __( 'All Posts in <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), single_cat_title('', false) );
                } elseif( is_tag() ) {
                    $page_title = sprintf( __( 'All Posts in <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), single_tag_title('', false) );
                } elseif( is_date() ) {
                    if( is_month() ) {
                        $page_title = sprintf( __( 'Archive for <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), get_the_time( 'F, Y' ) );
                    } elseif( is_year() ) {
                        $page_title = sprintf( __( 'Archive for <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), get_the_time( 'Y' ) );
                    } elseif( is_day() ) {
                        $page_title = sprintf( __('Archive for <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), get_the_time( get_option('date_format') ) );
                    } else {
                        $page_title = __('Blog Archives<span class="color-text">.</span>', AZ_THEME_NAME);
                    }
                } elseif( is_author() ) {
                    if(get_query_var('author_name')) {
                        $curauth = get_user_by( 'login', get_query_var('author_name') );
                    } else {
                        $curauth = get_userdata(get_query_var('author'));
                    }
                    $page_title = __('All Posts By <span class="color-text">&#8220;</span>'.$curauth->display_name.'<span class="color-text">&#8221;</span>', AZ_THEME_NAME);
                } 
            } 
		elseif( is_search() ) {
       		$page_title = sprintf( __( 'Search Results for <span class="color-text">&#8220;</span>%s<span class="color-text">&#8221;</span>', AZ_THEME_NAME ), get_search_query() );
        }

        return $page_title;
    }
}

if( !function_exists( 'az_custom_get_caption' ) ) {
    function az_custom_get_caption() {
        $page_caption = '';
        if( is_archive() ) {
                if( is_category() ) {
                    $page_caption = sprintf( __( 'Category', AZ_THEME_NAME ) );
                } elseif( is_tag() ) {
                    $page_caption = sprintf( __( 'Tag', AZ_THEME_NAME ) );
                } elseif( is_date() ) {
                    if( is_month() ) {
                        $page_caption = sprintf( __( 'Month', AZ_THEME_NAME ) );
                    } elseif( is_year() ) {
                        $page_caption = sprintf( __( 'Year', AZ_THEME_NAME ) );
                    } elseif( is_day() ) {
                        $page_caption = sprintf( __('Day', AZ_THEME_NAME ) );
                    } else {
                        $page_caption = __('Archives', AZ_THEME_NAME);
                    }
                } elseif( is_author() ) {
                	$page_caption = __('Author', AZ_THEME_NAME);
                }
            } 
		elseif( is_search() ) {
       		$page_caption = sprintf( __( 'Search', AZ_THEME_NAME ) );
        } 

        return $page_caption;
    }
}

/*-----------------------------------------------------------------------------------*/
/*	Portfolio Exclude External Projects / Lightbox From Next/Prev 
/*-----------------------------------------------------------------------------------*/

$excluded_projects = array();
$exlcuded_projects_string = '';
								
$portfolio = array( 'post_type' => 'portfolio' );
$the_query = new WP_Query($portfolio);

if ( $the_query->have_posts() ) {
	while ( $the_query->have_posts() ) {
		$the_query->the_post();
		
		$custom_project_type = get_post_meta($post->ID, '_az_project_type', true);
		if( $custom_project_type == "output-mode" || $custom_project_type == "fancybox-mode" ) $excluded_projects[] = $post->ID;
	}

	
	$exlcuded_projects_string = implode(",", $excluded_projects);
	
	if(!empty($exlcuded_projects_string)){
		add_filter( 'get_previous_post_where', 'az_exclude_project_adj' );
		add_filter( 'get_next_post_where', 'az_exclude_project_adj' );
	}
}

wp_reset_postdata();

function az_exclude_project_adj( $where ) {
    global $wpdb;
	global $exlcuded_projects_string;
    return $where . " AND p.ID NOT IN ($exlcuded_projects_string)";
}

/*-----------------------------------------------------------------------------------*/
/*	Active Class for Portfolio
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_additional_active_item_classes' ) ) {
	function az_additional_active_item_classes($classes = array(), $menu_item = false){
		global $wp_query;

		if(in_array('current-menu-item', $menu_item->classes)){
		    $classes[] = 'current-menu-item';
		}
		if ( $menu_item->post_name == 'portfolio' && is_post_type_archive('portfolio') ) {
		    $classes[] = 'current-menu-item';
		}
		if ( $menu_item->post_name == 'portfolio' && is_singular('portfolio') ) {
		    $classes[] = 'current-menu-item';
		}
		return $classes;
	}
}
add_filter( 'nav_menu_css_class', 'az_additional_active_item_classes', 10, 2 );

/*-----------------------------------------------------------------------------------*/
/*	Navigation
/*-----------------------------------------------------------------------------------*/

// Simple Navigation Blog
if ( !function_exists( 'az_pagination' ) ) {
	
	function az_pagination() {	
		global $options_ibuki;
		
		if( get_next_posts_link() || get_previous_posts_link() ) { 
			echo '
				<!-- Navigation Area -->
        		<section class="post-type-navi">
        			<nav class="blog-navigation">
		        		<div class="prev-blog">'.get_previous_posts_link( __('Older Entries<i class="prev-icon"></i>', AZ_THEME_NAME) ).'</div>
		        		<div class="next-blog">'.get_next_posts_link( __('New Entries<i class="next-icon"></i>', AZ_THEME_NAME) ).'</div>
		        	</nav>
		        </section>
		        <!-- End Navigation Area -->';
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_comment' ) ) {
	
	function az_comment($comment, $args, $depth) {
	
        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-section">              
                <div class="comment-side">
                	<?php echo get_avatar($comment,$size='50'); ?>
                </div>
             
                <div class="comment-cont">
                    <div class="comment-author">
                        <cite class="fn"><?php comment_author_link(); ?></cite>
                    </div>
                    
                    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf( __('%1$s at %2$s', AZ_THEME_NAME), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link(__('Edit', AZ_THEME_NAME), ' / ','') ?> / <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
                    
                    <?php if ( $comment -> comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', AZ_THEME_NAME) ?></em><br />
                    <?php endif; ?>
                    
                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>
                </div>
            </div>
	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Seperated Pings Styling
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_comment_list_pings' ) ) {
	function az_comment_list_pings($comment, $args, $depth) {
	    $GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
		<?php 
	}
}

/*-----------------------------------------------------------------------------------*/
/*	Remove the page jump when clicking read more button
/*-----------------------------------------------------------------------------------*/

function az_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}
add_filter('the_content_more_link', 'az_remove_more_jump_link');

/*-----------------------------------------------------------------------------------*/
/*	Social Profiles
/*-----------------------------------------------------------------------------------*/

$socials_profiles = array ('500px', 'behance', 'bebo', 'blogger', 'deviant-art', 'digg', 'dribbble', 'email', 'envato', 'evernote', 'facebook', 'flickr', 'forrst', 'github', 'google-plus', 'grooveshark', 'instagram', 'last-fm', 'linkedin', 'paypal', 'pinterest', 'quora', 'share-this', 'skype', 'soundcloud', 'stumbleupon', 'tumblr', 'twitter', 'viddler', 'vimeo', 'virb', 'wordpress', 'yahoo', 'yelp', 'youtube', 'xing', 'zerply');

/*-----------------------------------------------------------------------------------*/
/*	Extend Body Class
/*-----------------------------------------------------------------------------------*/

/**
 * Add browser detection and post name to body class
 * Add post title to body class on single pages
 *
 * @link http://www.wprecipes.com/wordpress-hack-automatically-add-post-name-to-the-body-class
 * @param array $classes The current body classes
 * @return array The new body classes
 */
if ( !function_exists( 'az_body_classes' ) ) {
	function az_body_classes($classes) {
		if(!isset($_SERVER['HTTP_USER_AGENT'])) return false;
		
	    // Add our browser class
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';

		if( strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') ) {
			$classes[] = 'iphone';
		}
		else if ( strstr($_SERVER['HTTP_USER_AGENT'],'iPad') ) {
			$classes[] = 'ipad';
		}
		
		if ( stristr( $_SERVER['HTTP_USER_AGENT'],"mac") ) {
             $classes[] = 'osx';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"linux") ) {
             $classes[] = 'linux';
        } elseif ( stristr( $_SERVER['HTTP_USER_AGENT'],"windows") ) {
             $classes[] = 'windows';
        }
        return $classes;

		// Add the post title
		if( is_singular() ) {
    		global $post;
    		array_push( $classes, "{$post->post_type}-{$post->post_name}" );
    	}
    	
    	// Add 'az'
    	array_push( $classes, "az" );
    	
		return $classes;

	}
}
add_filter('body_class','az_body_classes');

/*-----------------------------------------------------------------------------------*/
/*	Open Graph
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'az_add_opengraph' ) ) {
	function az_add_opengraph() {
		global $post;

		echo "<meta property='og:site_name' content='". get_bloginfo('name') ."'/>\n";
		echo "<meta property='og:url' content='" . get_permalink() . "'/>\n";

		if (is_singular()) { // If we are on a blog post/page
	        echo "<meta property='og:title' content='" . get_the_title() . "'/>\n";
	        echo "<meta property='og:type' content='article'/>\n";
	        if(has_post_thumbnail( $post->ID )) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>\n";
			} 
	    } elseif(is_front_page() or is_home()) {
	    	echo "<meta property='og:title' content='" . get_bloginfo("name") . "'/>\n";
	    	echo "<meta property='og:type' content='website'/>\n";
	    	if(has_post_thumbnail( $post->ID )) {
				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
				echo "<meta property='og:image' content='" . esc_attr( $thumbnail[0] ) . "'/>\n";
			} 
	    }

	}
}
add_action( 'wp_head', 'az_add_opengraph', 2 );

/*-----------------------------------------------------------------------------------*/
/*  Enable SVG on Wordpress Media
/* ----------------------------------------------------------------------------------*/

// If you want you can use this function for enabled the SVG file for Media Uploader

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

/*-----------------------------------------------------------------------------------*/
/*  Maintenace Mode
/* ----------------------------------------------------------------------------------*/

// If you want you can use this function for set into Maintenance your Site.
/*
function go_maintenance_mode() {
    if ( !current_user_can( 'edit_themes' ) || !is_user_logged_in() ) {
        wp_die('Sorry, but we are doing Maintenance on the site, please check back soon.');
    }
}
add_action('get_header', 'go_maintenance_mode');
*/

/*-----------------------------------------------------------------------------------*/
/*	Include the framework
/*-----------------------------------------------------------------------------------*/

$tempdir = get_template_directory();
require_once($tempdir .'/framework/meta/custom-functions-meta.php');
require_once($tempdir .'/framework/options/framework.php');
require_once($tempdir .'/framework/options/az_framework/config.php');

/*-----------------------------------------------------------------------------------*/
/*	Extend Visual Composer
/*-----------------------------------------------------------------------------------*/

require_once($tempdir .'/vc_extend/extend-vc.php');

/*-----------------------------------------------------------------------------------*/
/*	Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once($tempdir .'/framework/plugin-activation/init.php');

/*-----------------------------------------------------------------------------------*/
/*	Custom Walker
/*-----------------------------------------------------------------------------------*/

require_once($tempdir .'/framework/onepage/custom_walker.php');
require_once($tempdir .'/framework/onepage/edit_custom_walker.php');

/*-----------------------------------------------------------------------------------*/
/*	WP Automatic Updates
/*-----------------------------------------------------------------------------------*/

// Get user envato license as provided in theme panel
// $license_key = $options_ibuki['envato-license-key'];

// If envato license is defined load the auto update class and pass the license to it
// require_once($tempdir .'/framework/wp-automatic-updates/wp-updates-theme.php');
// if ( $license_key && $options_ibuki['enable-auto-updates'] == 1 ) {
	// new WPUpdatesThemeUpdater_878( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ), $license_key  );
// }

/*-----------------------------------------------------------------------------------*/
/*	WooCommerce
/*-----------------------------------------------------------------------------------*/

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

add_theme_support( 'woocommerce' );
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Set Thumbnail Size
global $pagenow;
//if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) 
add_action( 'init', 'az_woocommerce_image_dimensions', 1 );

// Define image sizes 
function az_woocommerce_image_dimensions() {
	$catalog = array(
		'width' => '292',	
		'height'	=> '311',	
		'crop'	=> 1 
	);
	 
	$single = array(
		'width' => '600',	
		'height'	=> '630',	
		'crop'	=> 1 
	);
	 
	$thumbnail = array(
		'width' => '100',	
		'height'	=> '100',	
		'crop'	=> 1 
	);
	 
	
	update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
	update_option( 'shop_single_image_size', $single ); // Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}

//change how many products are displayed per page	
add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 12;' ), 20 );

//change the position of add to cart
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action('woocommerce_before_shop_loop_item_title', 'product_thumbnail_with_cart', 10 );
function product_thumbnail_with_cart() { ?>
    <div class="product-wrap">
	   	<?php 
	   	echo  woocommerce_get_product_thumbnail(); 
	   	woocommerce_get_template( 'loop/add-to-cart.php' ); ?>
   	</div>
<?php 
}

//add link to item titles
add_action('woocommerce_before_shop_loop_item_title','product_item_title_link_open');
add_action('woocommerce_after_shop_loop_item_title','product_item_title_link_close');
function product_item_title_link_open(){
	echo '<a href="'.get_permalink().'">';
}
function product_item_title_link_close(){
	echo '</a>';
}

// update the cart with ajax
add_filter('add_to_cart_fragments', 'add_to_cart_fragment');
function add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	$fragments['a.cart-parent'] = ob_get_clean();
	return $fragments;
}

add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start(); ?>
	<a class="woo-cart cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>"><i class="font-icon-bag"></i><span class="woocommerce-notification-bubble"><?php echo $woocommerce->cart->cart_contents_count; ?></a>
	<?php
	
	$fragments['a.cart-contents'] = ob_get_clean();
	
	return $fragments;
}

//change summary html markup to fit responsive
add_action( 'woocommerce_before_single_product_summary', 'summary_div', 35);
add_action( 'woocommerce_after_single_product_summary',  'close_div', 4);
function summary_div() {
	echo "<div class='col-description'>";
}
function close_div() {
	echo "</div>";
}

//wrap single product image in an extra div
add_action( 'woocommerce_before_single_product_summary', 'images_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'close_div', 20);
function images_div()
{
	echo "<div class='col-image'>";
}

// display upsells and related products within dedicated div with different column and number of products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

function woocommerce_output_related_products() {
	$output = null;

	ob_start();
	woocommerce_related_products(array('columns' => 4, 'posts_per_page' => 4)); 
	$content = ob_get_clean();
	if($content) { $output .= $content; }

	echo '<div class="clear"></div>' . $output;
}

?>