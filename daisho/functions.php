<?php
// Load Core
require get_template_directory() . '/core/auto-install/auto-install.php';
require get_template_directory() . '/core/plugins/init.php';
require get_template_directory() . '/core/plugins/layerslider.php';
require get_template_directory() . '/core/plugins/woocommerce.php';
require get_template_directory() . '/core/plugins/visual-composer.php';
require get_template_directory() . '/core/post-type-news.php';
require get_template_directory() . '/core/post-type-portfolio.php';
require get_template_directory() . '/core/add-image-size.php';
require get_template_directory() . '/core/allowed-upload-mimes.php';
require get_template_directory() . '/core/attachment.php';
require get_template_directory() . '/core/body-class.php';
require get_template_directory() . '/core/comments.php';
require get_template_directory() . '/core/content-width.php';
require get_template_directory() . '/core/excerpt.php';
require get_template_directory() . '/core/fonts.php';
require get_template_directory() . '/core/nav.php';
require get_template_directory() . '/core/search.php';
require get_template_directory() . '/core/setup.php';
require get_template_directory() . '/core/sidebars.php';

// Load Admin
require get_template_directory() . '/admin/pages.php';
require get_template_directory() . '/admin/metaboxes.php';

function flow_wp_admin_scripts() {
	wp_enqueue_media();
	wp_enqueue_script( 'flow-uploader', get_template_directory_uri() . '/admin/js/flow-uploader.js', array( 'jquery', 'media-upload' ) );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_style( 'flow-admin-css', get_template_directory_uri() . '/admin/css/admin.css' );
	wp_enqueue_script( 'flow-admin-js', get_template_directory_uri() . '/admin/js/admin.js' );
	wp_localize_script( 'flow-admin-js', 'flowAdmin', array(
		'siteUrl' => get_site_url()
	) );
}
add_action( 'admin_enqueue_scripts', 'flow_wp_admin_scripts' );

// Load Front End
require get_template_directory() . '/inc/shortcodes.php';
require get_template_directory() . '/inc/info-box.php';
require get_template_directory() . '/inc/wpml-language-switcher.php';
require get_template_directory() . '/inc/gmap.php';

function flow_scripts() {

	// Load libraries.
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', array( 'jquery' ), '2.6.2', true );
	wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/js/iscroll.js', array( 'jquery' ), '4.1.9', true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'jquery' ), '2.0', true );
	wp_enqueue_script( 'jquery-bbq', get_template_directory_uri() . '/js/jquery.ba-bbq.min.js', array( 'jquery' ), '1.2.1', true );
	wp_enqueue_script( 'infinite-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ), '2.0b2.120519', true );
	
	// Load JavaScript files with functionality specific to this theme.
	wp_enqueue_script( 'flow-scripts', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'flow-portfolio-script', get_template_directory_uri() . '/js/portfolio.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'ns-isotope', get_template_directory_uri() . '/js/ns-isotope.js', array( 'jquery', 'isotope' ), false, true );
	wp_localize_script( 'flow-portfolio-script', 'daishoData', array(
			'date' => __( 'Date', 'flowthemes' ),
			'client' => __( 'Client', 'flowthemes' ),
			'agency' => __( 'Agency', 'flowthemes' ),
			'ourrole' => __( 'Our Role', 'flowthemes' )
		)
	);
	
	/*
	 * Adds JavaScript to pages with the comment form to support sites with
	 * threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	// Loads our main stylesheet.
	wp_enqueue_style( 'flow-style', get_stylesheet_uri() );
	
	// Loads other stylesheets.
	wp_enqueue_style( 'flow-fonts', get_template_directory_uri() . '/css/fonts.css' );
	wp_enqueue_style( 'fontawesome', get_template_directory_uri() . '/css/fontawesome/font-awesome.css' );
	wp_enqueue_style( 'flow-portfolio-style', get_template_directory_uri() . '/css/portfolio.css' );
	wp_enqueue_style( 'ns-isotope', get_template_directory_uri() . '/css/ns-isotope.css' );
}
add_action( 'wp_enqueue_scripts', 'flow_scripts' );

require get_template_directory() . '/inc/customizer.php';
