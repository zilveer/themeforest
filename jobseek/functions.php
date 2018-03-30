<?php

/* Theme setup
-------------------------------------------------------------------------------------------------------------------*/

if ( ! function_exists( 'jobseek_setup' ) ) :

	function jobseek_setup() {

		if ( ! isset( $content_width ) ) {
			$content_width = 1140;
		}

		load_theme_textdomain( 'jobseek', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'job-manager-templates' );
        add_theme_support( 'resume-manager-templates' ); 

        add_theme_support( 'woocommerce' );

        update_option('thumbnail_size_w', 360);
        update_option('thumbnail_size_h', 600);
        update_option('thumbnail_crop', 0);

		add_image_size('blog', 750, 9999, false);
	    add_image_size('gallery', 475, 356, true);
        add_image_size('testimonial', 140, 140, true);

		register_nav_menus( array(
			'primary' => __( 'Main Menu', 'jobseek' ),
		) );

		// Enable support for HTML5 markup.
		add_theme_support( 'html5', array(
			'comment-list',
			'search-form',
			'comment-form',
			'gallery',
			'caption',
		) );

	}

endif; // jobseek_setup

add_action( 'after_setup_theme', 'jobseek_setup' );

/* Remove license message
-------------------------------------------------------------------------------------------------------------------*/

function remove_license_window() {
    echo '<style type="text/css">#verify-purchase-code, #vc_license-activation-notice { display: none !important; }</style>'; 
}

add_action('admin_head', 'remove_license_window');

/* Main menu fallback
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_menu_fallback() {
    echo( '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . __('Add a menu', 'jobseek') . '</a></li>' );
}
 
/* Enqueue CSS and JS
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_scripts() {

	/* === CSS ==== */

    wp_enqueue_style( 'icomoon', get_template_directory_uri() . '/css/icomoon.css' );

    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/css/magnific-popup.css' );

    wp_enqueue_style( 'jobseek-style', get_stylesheet_uri() );

	wp_enqueue_style( 'jobseek-js_composer_front' );

    wp_enqueue_style('uber-google-maps', get_template_directory_uri() . '/css/uber-google-maps.css');

    // Remove CSS
    wp_dequeue_style( 'gjm-frontend' );
    wp_dequeue_style( 'grm-frontend' );    

    wp_dequeue_style( 'jquery-ui-style' );
    wp_dequeue_style( 'wp-job-manager-frontend' );
    wp_dequeue_style( 'wp-job-manager-resume-frontend' );

    wp_dequeue_style( 'wp-job-manager-apply-with-facebook-styles' );
    wp_dequeue_style( 'wp-job-manager-apply-with-xing-styles' );
    wp_dequeue_style( 'wp-job-manager-tags-frontend' );

    wp_dequeue_style( 'job-alerts-frontend' );
    
    wp_dequeue_style( 'wp-job-manager-applications-frontend' );

    wp_dequeue_style( 'wp-job-manager-bookmarks-frontend' );

    wp_dequeue_style( 'wc-paid-listings-packages' );

    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    // check for plugin using plugin name
    if ( !is_plugin_active( 'easy-google-fonts/easy-google-fonts.php' ) ) {
        $query_args = array(
            'family' => 'Montserrat:700|Roboto:400,400i,700'
        );
        wp_enqueue_style( 'google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
    } 

	/* === JS ==== */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
 
    wp_enqueue_script( 'jquery' );

    wp_enqueue_script( 'slimmenu', get_template_directory_uri() . '/js/jquery.slimmenu.js', 'jquery', '1.0', true );

    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js','jquery', '1.0', true );

    wp_register_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js','jquery', '1.0', true );

    wp_register_script('uber-google-maps', get_template_directory_uri() . '/js/uber-google-maps.min.js', array('jquery'), '1.0', true);

    wp_enqueue_script( 'stacktable', get_template_directory_uri() . '/js/stacktable.js', 'jquery', '1.0', true );

	wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', 'jquery', '1.0', true );

    if (class_exists('WPBakeryVisualComposerAbstract')) {
        $front_css_file = vc_asset_url( 'css/js_composer.min.css' );
        $upload_dir = wp_upload_dir();
        $vc_upload_dir = vc_upload_dir();
        if ( '1' === vc_settings()->get( 'use_custom' ) && is_file( $upload_dir['basedir'] . '/' . $vc_upload_dir . '/js_composer_front_custom.css' ) ) {
            $front_css_file = $upload_dir['baseurl'] . '/' . $vc_upload_dir . '/js_composer_front_custom.css';
            $front_css_file = vc_str_remove_protocol( $front_css_file );
        }
        wp_enqueue_style( 'js_composer_front', $front_css_file, array(), WPB_VC_VERSION );
    }

    // Prevent an job application and bookmark forms sliding
    wp_deregister_script( 'wp-job-manager-job-application' );
    wp_deregister_script( 'wp-job-manager-bookmarks-bookmark-js' );

    wp_deregister_script( 'wp-resume-manager-resume-contact-details' );

}
add_action( 'wp_enqueue_scripts', 'jobseek_scripts' );

// Rmove jQuery Migrate
add_filter( 'wp_default_scripts', 'remove_jquery_migrate' );

function remove_jquery_migrate( &$scripts) {
    if(!is_admin()) {
        $scripts->remove( 'jquery');
        $scripts->add( 'jquery', false, array( 'jquery-core' ), '1.10.2' );
    }
}

/* Register widgetized locations
-------------------------------------------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'jobseek_widgets_init' );

function jobseek_widgets_init() {

    // H5 title sidebars

    $sidebars_h5 = array(
        'blog' => __('Blog / Archives', 'jobseek'),
        'page' => __('Page', 'jobseek'),
        'job-before' => __('Job Single Before', 'jobseek'),
        'job-after' => __('Job Single After', 'jobseek'),
        'resume' => __('Resume Single', 'jobseek'),
        'testimonials' => __('Testimonials', 'jobseek'),
        );

    foreach ($sidebars_h5 as $key => $value) {

        // Register widgetized locations
        register_sidebar(array(
            'name'          => $value,
            'id'            => $key,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h5>',
            'after_title'   => '</h5>'
        ));
        
    }

    // H2 title sidebars

    $sidebars_h2 = array(
        'footer-sidebar-1' => __('Footer Sidebar 1', 'jobseek'),
        'footer-sidebar-2' => __('Footer Sidebar 2', 'jobseek'),
        'footer-sidebar-3' => __('Footer Sidebar 3', 'jobseek'),
        'footer-sidebar-4' => __('Footer Sidebar 4', 'jobseek'),
        );

    foreach ($sidebars_h2 as $key => $value) {

        // Register widgetized locations
        register_sidebar(array(
            'name'          => $value,
            'id'            => $key,
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));
        
    }

}

/* Visual Composer
-------------------------------------------------------------------------------------------------------------------*/

if (class_exists('WPBakeryVisualComposerAbstract')) {

	function requireVcExtend(){
		require_once get_template_directory() . '/vc_templates/extend-vc.php';
	}
	add_action('init', 'requireVcExtend', 2); 

    require_once( get_template_directory() . '/vc_templates/recent-blog-posts.php' );
    require_once( get_template_directory() . '/vc_templates/title.php' );
    require_once( get_template_directory() . '/vc_templates/logo-carousel.php' );
    require_once( get_template_directory() . '/vc_templates/logo-item.php' ); 
    require_once( get_template_directory() . '/vc_templates/counterup.php' ); 
    require_once( get_template_directory() . '/vc_templates/counterup-item.php' ); 
    require_once( get_template_directory() . '/vc_templates/testimonials-carousel.php' ); 
    require_once( get_template_directory() . '/vc_templates/pricing-table.php' );
    require_once( get_template_directory() . '/vc_templates/js-button.php' );
    require_once( get_template_directory() . '/vc_templates/job-resume-categories.php' );
    require_once( get_template_directory() . '/vc_templates/job-resume-spotlight.php' );
    require_once( get_template_directory() . '/vc_templates/search-form.php' );
    require_once( get_template_directory() . '/vc_templates/counters.php' );
    require_once( get_template_directory() . '/vc_templates/map.php' );
    require_once( get_template_directory() . '/vc_templates/map_item.php' );

    vc_remove_element("vc_button");
    vc_remove_element("vc_button2");

	vc_remove_element("vc_widget_sidebar");
	vc_remove_element("vc_wp_search");
	vc_remove_element("vc_wp_meta");
	vc_remove_element("vc_wp_recentcomments");
	vc_remove_element("vc_wp_calendar");
	vc_remove_element("vc_wp_pages");
	vc_remove_element("vc_wp_tagcloud");
	vc_remove_element("vc_wp_custommenu");
	vc_remove_element("vc_wp_text");
	vc_remove_element("vc_wp_posts");
	vc_remove_element("vc_wp_links");
	vc_remove_element("vc_wp_categories");
	vc_remove_element("vc_wp_archives");
	vc_remove_element("vc_wp_rss");

}

/* Login & Registration
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/login-registration.php';

/* Job Manager
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/job-manager.php';

/* Plugins installation
-------------------------------------------------------------------------------------------------------------------*/

require get_template_directory() . '/inc/plugins.php';

/* Customizer
-------------------------------------------------------------------------------------------------------------------*/

if (class_exists('Kirki')) {
    require get_template_directory() . '/inc/customizer.php';
}

/* Move Jetpack Share
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    if ( class_exists( 'Jetpack_Likes' ) ) {
        remove_filter( 'the_content', array( Jetpack_Likes::init(), 'post_likes' ), 30, 1 );
    }

}
 
add_action( 'loop_start', 'jobseek_jptweak_remove_share' );

/* Set homepage, blog page and menus after import
-------------------------------------------------------------------------------------------------------------------*/

function jobseek_after_import() {
    // Use a static front page
    $home = get_page_by_title( 'Home' );
    update_option( 'page_on_front', $home->ID );
    update_option( 'show_on_front', 'page' );

    // Set the blog page
    $blog = get_page_by_title( 'Blog' );
    update_option( 'page_for_posts', $blog->ID );

    // Set menus
    $theme_locations = get_registered_nav_menus();

    foreach ($theme_locations as $location => $description ) {

        switch($location) {
            case 'primary':
                $menu = get_term_by('name', 'Main Menu', 'nav_menu');
            break;
        }

        if( isset($menu) ) {
            $theme_locations[$location] = $menu->term_id;
        }

    }

    set_theme_mod( 'nav_menu_locations', $theme_locations );

}

add_action( 'import_end', 'jobseek_after_import' );