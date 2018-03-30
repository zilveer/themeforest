<?php

//layout configuration, customizations of standard elements etc.
include('functions/comments.php');
include('functions/breadcrumb.php');
include('functions/menus.php');
include('functions/metaboxes.php');
include('functions/related-posts.php');
if (class_exists('Woocommerce')) {
    include('functions/woocommerce-support.php');
}

// sidebars
include('functions/sidebars.php');
include('functions/metaboxes-sidebars.php');

//widgets
include('widgets/address.php');
include('widgets/map.php');
include('widgets/social.php');
include('widgets/recent-blog-posts.php');
include('widgets/recent-comments.php');
include('widgets/recent-projects.php');
include('widgets/class-multipurpose-tabs-widget.php');
include('widgets/twitter.php');
include('lib/twitteroauth/twitteroauth.php'); //required by the twitter widget
include('widgets/custom-categories-widget.php');

// post types
include('post-types/project.php');

//theme customizations
include('functions/customize.php');
include('customize/general.php');
include('customize/layout.php');
include('customize/header.php');
include('customize/social.php');
include('customize/breadcrumb.php');
include('customize/sidebar.php');
include('customize/footer.php');
include('customize/blog.php');
include('customize/portfolio.php');
include('customize/typography.php');
include('customize/colors.php');
include('customize/maps.php');

//admin panel settings pages
// include('functions/settings.php');
include('functions/settings-contact.php');
//include('functions/admin-panel.php');

//other functions
include('functions/contact.php');
include('functions/social.php');
include('functions/footer.php');
include('functions/categories.php');

//TGM Plugin Activation
include('functions/tgm-plugin-activation/plugins.php');

add_filter('widget_text', 'do_shortcode');

if ( ! isset( $content_width ) )
$content_width = 680;

add_action('after_setup_theme', 'multipurpose_setup');

function multipurpose_setup() {
    add_editor_style();
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support('html5');
    add_theme_support('custom-background');
    add_theme_support('woocommerce');

    set_post_thumbnail_size( 800, 250, true ); // Default size
    add_image_size('thumbnail-small', 300, 160, true);
    add_image_size('thumbnail-medium', 460, 300, true);
    add_image_size('thumbnail-large', 940, 340, true);
    add_image_size('thumbnail-related', 220, 159, true);
    add_image_size('thumbnail-slider', 220, 160, true);
    add_image_size('thumbnail-masonry', 460, 9999, false);
    add_image_size('thumbnail-product', 600, 9999, false);
    add_image_size('admin-thumbnail', 120, 90, false);
	add_image_size('thumbnail-widget', 50, 50, true);

    add_image_size('thumbnail-high-large', 680, 99999, false);
    add_image_size('thumbnail-high-extra-large', 940, 99999, false);

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    load_theme_textdomain('multipurpose', get_template_directory() . '/languages'); 

    register_nav_menus(
        array(
          'primary' => esc_attr__('Main menu', 'multipurpose'),
          'secondary' => esc_attr__('Top bar menu', 'multipurpose')
        )
    );
}

function multipurpose_widgets() {
    register_sidebar(array(
        'name' => esc_attr__( 'Sidebar Widget Area', 'multipurpose'),
        'id' => 'sidebar-widget-area',
        'description' => esc_attr__( 'The sidebar widget area', 'multipurpose'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ));

    $column_count = get_theme_mod('column_count') ? get_theme_mod('column_count') : 4;
    $col_class = 'col' . $column_count;
    register_sidebar(array(
        'name' => esc_attr__( 'Footer Widget Area', 'multipurpose'),
        'id' => 'footer-widget-area',
        'description' => esc_attr__( 'Widgetized area in the footer', 'multipurpose'),
        'before_widget' => '<article class="widget col '.$col_class.'">',
        'after_widget' => '</article>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ));

    
    register_sidebar(array(
        'name' => esc_attr__( 'Contact page sidebar', 'multipurpose'),
        'id' => 'contact-sidebar',
        'description' => esc_attr__( 'Sidebar on the contact page', 'multipurpose'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ));

    register_sidebar(array(
        'name' => esc_attr__( 'Coming soon page widget area', 'multipurpose'),
        'id' => 'coming-soon',
        'description' => esc_attr__( 'Widget area on the coming soon page', 'multipurpose'),
        'before_widget' => '<section class="widget">',
        'after_widget' => '</section>',
        'before_title' => '<h3><span>',
        'after_title' => '</span></h3>'
    ));

    $custom_sidebar = get_option('custom_sidebar') ? get_option('custom_sidebar') : array();
    if(count($custom_sidebar) > 0) {
        foreach($custom_sidebar as $sidebar) {  
            register_sidebar( array(  
                'name' => $sidebar,  
                'id' => generateSlug($sidebar, 45),  
                'before_widget' => '<section id="%1$s" class="widget %2$s">',  
                'after_widget' => "</section>",  
                'before_title' => '<h3><span>',  
                'after_title' => '</span></h3>',  
            ) );  
        }  
    }
}

add_action ('widgets_init', 'multipurpose_widgets' );

add_filter('the_title', 'multipurpose_title');

function multipurpose_title($title) {
    if ($title == '') {
        return 'Untitled';
    } else {
        return $title;
    }
} 

function generateSlug($phrase, $maxLength) {  
    $result = strtolower($phrase);  
    $result = preg_replace("/[^a-z0-9\s-]/", "", $result);  
    $result = trim(preg_replace("/[\s-]+/", " ", $result));  
    $result = trim(substr($result, 0, $maxLength));  
    $result = preg_replace("/\s/", "-", $result);  
  
    return $result;  
} 

function multipurpose_scripts() {
    wp_enqueue_script('masonry');
    wp_enqueue_script('basic', get_template_directory_uri().'/js/scripts.js', array('jquery'), 1, true);
    wp_enqueue_script('sliders', get_template_directory_uri().'/js/sliders.js', array('jquery', 'basic'), 1, true);
	
	$maps_script = 'https://maps.googleapis.com/maps/api/js';
	$maps_api_key = get_theme_mod("map_api_key");
	if (isset($maps_api_key) && !empty($maps_api_key)) {
		$maps_script .= '?key='.multipurpose_sanitize_text_decode($maps_api_key);
	}
	
	wp_enqueue_script('googlemaps', $maps_script, array(), 1, true);
	wp_enqueue_script('map', get_template_directory_uri().'/js/map.js', array('jquery', 'googlemaps'), 1, true);

    global $is_IE;
    if ( $is_IE ) {
        wp_enqueue_script('html5', get_template_directory_uri() . '/js/html5.js');
    }
}
add_action( 'wp_enqueue_scripts', 'multipurpose_scripts');

function multipurpose_styles() {
    wp_register_style('main-style', get_stylesheet_uri(), false, 1.0);
    wp_enqueue_style('main-style');
    wp_register_style('headers', get_template_directory_uri().'/styles/headers.css');
    wp_enqueue_style('headers');

    $color_scheme = get_theme_mod('color_scheme') ? get_theme_mod('color_scheme') : false;
    if($color_scheme) {
        if($color_scheme != 'custom') {
			wp_register_style('color-version', get_template_directory_uri().'/styles/colors/'.$color_scheme.'.css');  
        	wp_enqueue_style('color-version');
		}
        wp_register_style('color-override', get_template_directory_uri().'/styles/color-override.css');  
        wp_enqueue_style('color-override');
    }
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'revslider/revslider.php' ) ) {
	    wp_register_style('revolution-slider-custom-styles', get_template_directory_uri().'/styles/revolution-slider.css');
	    wp_enqueue_style('revolution-slider-custom-styles');
	}	
}
add_action( 'wp_enqueue_scripts', 'multipurpose_styles', 99);

function multipurpose_filter_wp_title($title = '', $sep = '') {
    global $page, $paged;

    if( is_feed() ) {
        return $title;
    }

    // Add the site name.
    $title .= get_bloginfo( 'name' );

    // Add the site description for the home/front page.
    $site_description = get_bloginfo( 'description', 'display' );
    if( $site_description && ( is_home() || is_front_page() ) ) {
        $title .= " $sep $site_description";
    }

    // Add a page number if necessary.
    if( $paged >= 2 || $page >= 2 ) {
        $title .= " $sep " . sprintf( esc_attr__( 'Page %s', 'multipurpose' ), max( $paged, $page ) );
    }

    return $title;
 }
add_filter( 'wp_title', 'multipurpose_filter_wp_title' ); 

function current_page_url() {
    $pageURL = 'http';
    if( isset($_SERVER["HTTPS"]) ) {
        if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }
    return $pageURL;
}

add_filter('gallery_style', create_function('$a', 'return "<div class=\'gallery\'>";'));

function multipurpose_custom_excerpt($limit, $post) {
    $more = '<!--more-->';
    $found = strpos($post->post_content, $more);
    if(!$found) {
        $excerpt = explode(' ', get_the_excerpt(), $limit);
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ", $excerpt).'...';
        } else {
            $excerpt = implode(" ", $excerpt);
        }   
        $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
    } else {
        $excerpt = substr($post->post_content, 0, $found);
    }
    return $excerpt;
}

function default_comments_off( $data ) {
    if( $data['post_type'] == 'page') {
        $data['comment_status'] = 0;
    }

    return $data;
}
add_filter( 'wp_insert_post_data', 'default_comments_off' );

/*fix for tooltip*/
function multipurpose_admin_bar_fix() {
    if(!is_admin() && is_admin_bar_showing()) {
        remove_action('wp_head', '_admin_bar_bump_cb');
        $output  = '<style type="text/css">'."\n\t";
        $output .= 'body.admin-bar { padding-top: 28px; }'."\n";
        $output .= '</style>'."\n";
    echo $output;
    }
}
add_action('wp_head', 'multipurpose_admin_bar_fix', 5);

/* disable contact form 7 styles */
add_filter('wpcf7_load_css', '__return_false');

/* Sliders config and templates directory */
if ( class_exists( 'IworksSliders' ) ) {
	add_filter('iworks_sliders_get_template', 'my_iworks_sliders_get_template', 10, 3 );
	function my_iworks_sliders_get_template( $file, $kind, $name )
	{
		return sprintf(
			'%s/multipurpose-sliders-templates/%s/%s.php',
			dirname(__FILE__),
			$kind,
			$name
		);
	}
}

//add_filter('deprecated_constructor_trigger_error', '__return_false');

/* Remove query strings from static resources */
function multipurpose_remove_script_version( $src ){
	$src = remove_query_arg( 'ver', $src );
	return $src;
}
add_filter( 'script_loader_src', 'multipurpose_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'multipurpose_remove_script_version', 15, 1 );

/*security improvements*/

/*remove generator from src*/
remove_action('wp_head', 'wp_generator');

/*remove generator from RSS feed*/
function multipurpose_secure_generator( $generator, $type ) {
	return '';
}
add_filter( 'the_generator', 'multipurpose_secure_generator', 10, 2 );


/* sanitization */
function multipurpose_stripslashes( $string ) {
    if(get_magic_quotes_gpc()) {
        return stripslashes($string);
    } else {
        return $string;
    }
}

function multipurpose_sanitize_text( $string ) {
	return multipurpose_stripslashes(htmlspecialchars($string));
}

function multipurpose_sanitize_text_decode( $string ) {
	return multipurpose_stripslashes(htmlspecialchars_decode($string));
}