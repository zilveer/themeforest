<?php
/**
 * Functions and definitions
 */

/**
 * Set the content width
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1180;
}

$dd_sn = 'dd_biosphere_';
$dd_lang_curr = '';
$dd_lang_default = '';

define( 'DD_THEME_VERSION', '1.0' );

if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {
	global $sitepress;
	$dd_lang_curr = ICL_LANGUAGE_CODE;
	$dd_lang_default = $sitepress->get_default_language();
}

if ( !defined( 'BP_AVATAR_THUMB_WIDTH' ) ) {
	define( 'BP_AVATAR_THUMB_WIDTH', 200 );
}
 
if ( !defined( 'BP_AVATAR_THUMB_HEIGHT' ) ) {
	define( 'BP_AVATAR_THUMB_HEIGHT', 200 );
}

if ( !defined( 'BP_AVATAR_FULL_WIDTH' ) ) {
	define( 'BP_AVATAR_FULL_WIDTH', 200 );
}
 
if ( !defined( 'BP_AVATAR_FULL_HEIGHT' ) ) {
	define( 'BP_AVATAR_FULL_HEIGHT', 200 ); 
}

require get_template_directory() . '/inc/functions.php';

/**
 * Hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );

/**		 
 * Hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );

/**
 * Theme mode activate
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Required: include OptionTree.
 */
include_once( 'option-tree/ot-loader.php' );
include_once( 'inc/admin/theme-options.php' );
include_once( 'inc/admin/post-options.php' );

/**
 * Include Widgets
 */
include_once( get_template_directory() . '/inc/widgets/widget.dribbble.php' );
include_once( get_template_directory() . '/inc/widgets/widget.social.php' );
include_once( get_template_directory() . '/inc/widgets/widget.causes.php' );
include_once( get_template_directory() . '/inc/widgets/widget.events.php' );
include_once( get_template_directory() . '/inc/widgets/widget.flickr.php' );
include_once( get_template_directory() . '/inc/widgets/widget.events-calendar.php' );

/* Paypal Sandbox */

if ( ot_get_option( $dd_sn . 'paypal_sandbox', 'disabled' ) == 'disabled' ) {
	$dd_paypal_sandbox = false;
} else {
	$dd_paypal_sandbox = true;
}

if ( $dd_paypal_sandbox ) {
	$dd_paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
} else {
	$dd_paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
}

$dd_donation_currency = ot_get_option( $dd_sn . 'paypal_currency_char', '$' );

/**
 * WooCommerce Product Thumbnail
 */

global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) { add_action( 'init', 'dd_wc_image_sizes', 1 ); }
function dd_wc_image_sizes() {
  	
  	$catalog = array(
		'width' 	=> '400',
		'height'	=> '400',
		'crop'		=> 1
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );
}

add_action( 'after_setup_theme', 'dd_theme_setup' );
if ( ! function_exists( 'dd_theme_setup' ) ) {
	
	/**
	 * Set up theme defaults and register support for various WordPress features.
	 */
	function dd_theme_setup() {

		global $dd_sn;

		require get_template_directory() . '/inc/shortcodes.php';

		/**
		 * Editor Style
		 */
		add_editor_style();

		/**
		 * Load translations
		 */
		load_theme_textdomain( 'dd_string', get_template_directory() . '/languages' );

		/**
		 * Add default posts and comments RSS feed links to head
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Enable support for Post Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Add Support for WooCommerce
		 */
		add_theme_support( 'woocommerce' );

		/**
		 * Register menus
		 */
		register_nav_menus( array(
			'primary_1' => __( 'Header First Column', 'dd_string' ),
			'primary_2' => __( 'Header Second Column', 'dd_string' ),
			'primary_3' => __( 'Header Third Column', 'dd_string' ),
			'footer' => __( 'Footer Menu', 'dd_string' ),
		) );

		/**
		 * Add custom image sizes
		 */

		$slider_height = ot_get_option( $dd_sn . 'slider_height', 570 );

		add_image_size( 'dd-slider', 1280, $slider_height, true );

		add_image_size( 'dd-one-half', 580, 9999, false );
		add_image_size( 'dd-one-third', 380, 9999, false );
		add_image_size( 'dd-one-fourth', 280, 9999, false );
		add_image_size( 'dd-full', 1180, 9999, false );
		add_image_size( 'dd-one-fourth-crop', 280, 250, true );
		add_image_size( 'dd-tiny', 57, 57, true );

		add_image_size( 'dd-home-blog', 280, 121, true );
		add_image_size( 'dd-home-events', 380, 190, true );
		add_image_size( 'dd-home-causes', 280, 186, true );

	}

} // dd_theme_setup

/**
 * Register sidebars
 */
add_action( 'widgets_init', 'dd_theme_sidebars' );
function dd_theme_sidebars() {

	global $dd_sn;

	$footer_widgets_class = ot_get_option( $dd_sn . 'footer_widget_cols', 'four' );

	register_sidebar( array(
		'name' => __( 'Blog Widgets', 'dd_string' ),
		'id' => 'sidebar-blog',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Page Widgets', 'dd_string' ),
		'id' => 'sidebar-page',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Causes Widgets', 'dd_string' ),
		'id' => 'sidebar-causes',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Events Widgets', 'dd_string' ),
		'id' => 'sidebar-events',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Staff Widgets', 'dd_string' ),
		'id' => 'sidebar-staff',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'dd_string' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<div id="%1$s" class="widget ' . $footer_widgets_class . ' column columns %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'WooCommerce Widgets', 'dd_string' ),
		'id' => 'sidebar-woocommerce',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

	register_sidebar( array(
		'name' => __( 'BuddyPress Widgets', 'dd_string' ),
		'id' => 'sidebar-buddypress',
		'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
		'after_widget' => '</div></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );	

}

/**
 * Register post types
 */
add_action( 'init', 'dd_theme_register_post_types' );
function dd_theme_register_post_types() {

	global $dd_sn;	

	$causes_slug = ot_get_option( $dd_sn . 'slug_causes', 'cause-view' );
	$causes_tax_slug = ot_get_option( $dd_sn . 'slug_causes_tax', 'dd_causes_cats' );
	$events_slug = ot_get_option( $dd_sn . 'slug_events', 'event-view' );
	$staff_slug = ot_get_option( $dd_sn . 'slug_staff', 'staff-view' );
	$staff_tax_slug = ot_get_option( $dd_sn . 'slug_staff_tax', 'dd_staff_cats' );
	
	register_post_type( 'dd_causes', array(
		'labels' => array(
			'name' => __( 'Causes', 'dd_string' ),
			'singular_name' => __( 'Cause', 'dd_string' ),
			'add_new' => __( 'Add Cause', 'dd_string' ),
			'add_new_item' => __( 'Add Cause', 'dd_string' ),
			'edit' => __( 'Edit', 'dd_string' ),
			'edit_item' => __( 'Edit Cause', 'dd_string' ),
			'new_item' => __( 'New Cause', 'dd_string' ),
			'view' => __( 'View Cause', 'dd_string' ),
			'view_item' => __( 'View Cause', 'dd_string' ),
			'search_items' => __( 'Search Causes', 'dd_string' ),
			'not_found' => __( 'No Causes found', 'dd_string' ),
			'not_found_in_trash' => __( 'No Causes found in Trash', 'dd_string' ),
			'parent' => __( 'Parent Cause', 'dd_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => $causes_slug ),
		'supports' => array( 'title', 'excerpt', 'custom-fields', 'editor', 'author', 'thumbnail', 'comments'  ),
	));
	register_taxonomy('dd_causes_cats', 'dd_causes', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => $causes_tax_slug ) ));

	register_post_type( 'dd_events', array(
		'labels' => array(
			'name' => __( 'Events', 'dd_string' ),
			'singular_name' => __( 'Event', 'dd_string' ),
			'add_new' => __( 'Add Event', 'dd_string' ),
			'add_new_item' => __( 'Add Event', 'dd_string' ),
			'edit' => __( 'Edit', 'dd_string' ),
			'edit_item' => __( 'Edit Event', 'dd_string' ),
			'new_item' => __( 'New Event', 'dd_string' ),
			'view' => __( 'View Event', 'dd_string' ),
			'view_item' => __( 'View Event', 'dd_string' ),
			'search_items' => __( 'Search Events', 'dd_string' ),
			'not_found' => __( 'No Events found', 'dd_string' ),
			'not_found_in_trash' => __( 'No Events found in Trash', 'dd_string' ),
			'parent' => __( 'Parent Event', 'dd_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => $events_slug ),
		'supports' => array( 'title', 'excerpt', 'custom-fields', 'editor', 'author', 'thumbnail', 'comments'  ),
	));

	register_post_type( 'dd_staff', array(
		'labels' => array(
			'name' => __( 'Staff', 'dd_string' ),
			'singular_name' => __( 'Staff Member', 'dd_string' ),
			'add_new' => __( 'Add Staff Member', 'dd_string' ),
			'add_new_item' => __( 'Add Staff Member', 'dd_string' ),
			'edit' => __( 'Edit', 'dd_string' ),
			'edit_item' => __( 'Edit Staff Member', 'dd_string' ),
			'new_item' => __( 'New Staff Member', 'dd_string' ),
			'view' => __( 'View Staff Member', 'dd_string' ),
			'view_item' => __( 'View Staff Member', 'dd_string' ),
			'search_items' => __( 'Search Staff Members', 'dd_string' ),
			'not_found' => __( 'No Staff Members found', 'dd_string' ),
			'not_found_in_trash' => __( 'No Staff Members found in Trash', 'dd_string' ),
			'parent' => __( 'Parent Staff Member', 'dd_string' ),
		),
		'public' => true,
		'rewrite' => array( 'slug' => $staff_slug ),
		'supports' => array( 'title', 'excerpt', 'custom-fields', 'editor', 'author', 'thumbnail', 'comments'  ),
	));
	register_taxonomy('dd_staff_cats', 'dd_staff', array( 'label' => 'Categories', 'hierarchical' => true, 'public' => true, 'rewrite' => array( 'slug' => $staff_tax_slug ) ));

	register_post_type( 'dd_sponsors', array(
		'labels' => array(
			'name' => __( 'Sponsors', 'dd_string' ),
			'singular_name' => __( 'Sponsor', 'dd_string' ),
			'add_new' => __( 'Add Sponsor', 'dd_string' ),
			'add_new_item' => __( 'Add Sponsor', 'dd_string' ),
			'edit' => __( 'Edit', 'dd_string' ),
			'edit_item' => __( 'Edit Sponsor', 'dd_string' ),
			'new_item' => __( 'New Sponsor', 'dd_string' ),
			'view' => __( 'View Sponsor', 'dd_string' ),
			'view_item' => __( 'View Sponsor', 'dd_string' ),
			'search_items' => __( 'Search Sponsors', 'dd_string' ),
			'not_found' => __( 'No Sponsors Found', 'dd_string' ),
			'not_found_in_trash' => __( 'No Sponsors Found in Trash', 'dd_string' ),
			'parent' => __( 'Parent Staff Member', 'dd_string' ),
		),
		'public' => true,
		'supports' => array( 'title', 'excerpt', 'custom-fields', 'editor', 'author', 'thumbnail', 'comments'  ),
	));

}

/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'dd_theme_scripts' );
function dd_theme_scripts() {
	
	/* CSS */
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'fonts', get_template_directory_uri() . '/css/font.css' );

	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	}

	wp_enqueue_style( 'dd-revslider', get_template_directory_uri() . '/css/revslider.css' );

	/* Plugins JS */
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), DD_THEME_VERSION, true );

	wp_enqueue_script( 'dd-paypal', 'https://www.paypalobjects.com/js/external/apdg.js', '', DD_THEME_VERSION, true );

	/* Custom JS */
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), DD_THEME_VERSION, true );
	wp_localize_script( 'main-js', 'DDAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );

	/* Comment Reply JS */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}

/**
 * Enqueue scripts and styles in the admin
 */
function dd_theme_scripts_admin( $hook ) {	

	if ( $hook == 'post.php' || $hook = 'post-new.php' ) {
		wp_enqueue_script( 'theme-options-js', get_template_directory_uri() . '/inc/admin/js/admin.js' );
	}

	wp_enqueue_style( 'theme-options-css', get_template_directory_uri() . '/inc/admin/css/theme-options.css' );
	wp_enqueue_style( 'dd-rev-slider-css-admin', get_template_directory_uri() . '/css/revslider.css' );

}
add_action( 'admin_enqueue_scripts', 'dd_theme_scripts_admin' );

/**
 * Custom CSS and JS code from Theme Options.
 */

add_action( 'wp_footer', 'dd_custom_js_code');
function dd_custom_js_code() {

	global $dd_sn;	

	if ( ot_get_option( $dd_sn . 'code_js' ) ) {
		echo '<script>' . ot_get_option( $dd_sn . 'code_js' ) . '</script>';
	}

}

add_action( 'wp_head', 'dd_custom_css_code' );
function dd_custom_css_code() {

	global $dd_sn;
    
	if ( ot_get_option( $dd_sn . 'code_css' ) ) {
		echo '<style>' . ot_get_option( $dd_sn . 'code_css' ) . '</style>';
	}

}

/**
 * Get id of a post by using different methods
 */
function dd_get_post_id($by, $needle){
		
	global $wpdb;

	$to_return = '';
	
	if( $by == 'name' ) { $to_return = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$needle."'"); }
	
	if( $by == 'title' ) { $to_return = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '".$needle."'"); }
	
	if( $by == 'template' ) { $pages = $wpdb->get_row("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_wp_page_template' AND meta_value='".$needle."'", ARRAY_A); $to_return = $pages['post_id']; }

	if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

		$to_return = icl_object_id( $to_return, get_post_type( $to_return ), true );

	}

	return $to_return;
	
}

/**
 * Events AJAX
 */
add_action( 'wp_ajax_nopriv_dd-events-calendar', 'dd_events_calendar_ajx' );
add_action( 'wp_ajax_dd-events-calendar', 'dd_events_calendar_ajx' );
function dd_events_calendar_ajx( $atts ) {

	$response = array();

	$month = $_POST['month'];
	$year = $_POST['year'];

	$response['output'] = dd_get_calendar( array( 'dd_events'), false, false, $month, $year );

	$response_json = json_encode( $response );	

	header( "Content-Type: application/json" );
	echo $response_json;

	exit;

}

if ( ! function_exists( 'dd_slider' ) ) {

	/**
	 * Homepage Slider
	 */
	function dd_slider() {

		global $dd_sn;
		global $dd_donation_currency;

		$slider = ot_get_option( $dd_sn . 'slider' );
			
		if ( ! empty ( $slider ) ) :

			?>

				<div id="slider" data-animation="<?php echo ot_get_option( $dd_sn . 'slider_animation', 'slide' ); ?>" data-autoplay="<?php echo ot_get_option( $dd_sn . 'slider_autoplay', '0' ); ?>" data-loop="<?php echo ot_get_option( $dd_sn . 'slider_loop', 'enabled' ); ?>">

					<div id="slider-inner" class="container">

						<div class="flexslider">

							<ul class="slides">

								<?php foreach ( $slider as $key => $slide ) : ?>

									<li class="slide">

										<?php if ( $slide['type'] == 'custom' ) : ?>
										
											<img class="slide-img" src="<?php $slide_img = wp_get_attachment_image_src( dd_get_image_id( $slide['image'] ), 'dd-slider' ); echo $slide_img[0]; ?>" alt="<?php echo esc_attr($slide['title']); ?>" />

											<?php if (  ! empty( $slide['title'] ) ||  ! empty( $slide['description'] ) ||  ! empty( $slide['link'] ) ) : ?>

												<div class="slide-info">
													
													<?php if ( ot_get_option( $dd_sn . 'multicol_colors', '' ) != '' ) : ?>

														<?php $header_colors = ot_get_option( $dd_sn . 'multicol_colors' ); ?>

														<div class="slide-info-colors multicol-colors">
															<ul class="clearfix">
																<?php foreach ( $header_colors as $header_color ) : ?>
																	<li data-color="<?php echo $header_color[$dd_sn . 'color']; ?>"></li>
																<?php endforeach; ?>
															</ul>
														</div><!-- #header-colors -->

													<?php endif; ?>

													<div class="slide-info-inner clearfix">
														
														<?php if ( ! empty( $slide['title'] ) ) : ?>
															<div class="slide-title"><?php echo $slide['title']; ?></div>
														<?php endif; ?>

													</div>

													<div class="slide-info-extra">
														
														<?php if ( ! empty( $slide['description'] ) ) : ?>
															<div class="slide-description"><?php echo $slide['description']; ?></div>
														<?php endif; ?>
														
														<?php if ( ! empty( $slide['link'] ) ) : ?>
															<a href="<?php echo $slide['link']; ?>" class="dd-button small orange slide-link"><?php _e( 'MORE INFO', 'dd_string' ); ?></a>
														<?php endif; ?>

													</div><!-- .slide-info-extra -->
												</div><!-- .slide-info -->

											<?php endif; ?>

											<?php if ( ! empty( $slide['link'] ) ) : ?>
												<a href="<?php echo $slide['link']; ?>" class="slide-link-mobile"></a>
											<?php endif; ?>

										<?php else : ?>

											<?php 
												if ( $slide['type'] == 'blog' ) {

													$post_id = $slide['blog_post']; 
													$more_details_link = get_permalink( $slide['blog_post'] );

												} elseif ( $slide['type'] == 'event' ) {

													$post_id = $slide['event'];
													$fb_link = get_post_meta( $post_id, $dd_sn . 'event_facebook_link', true );
													$more_details_link = get_permalink( $slide['event'] );

												} elseif ( $slide['type'] == 'cause' ) {
													
													$post_id = $slide['cause'];

													/**
													 * Translation Sync
													 */

													$cause_id = $post_id;

													if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

														global $dd_lang_curr;
														global $dd_lang_default;

														if ( $dd_lang_curr != $dd_lang_default ) {

															$cause_id = icl_object_id( $post_id, 'dd_causes', true, $dd_lang_default );

														}

													}

													$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
													$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

													$show_donation_bar = true;
													if ( $donation_goal == '' || $donation_goal == 0 ) {
														$show_donation_bar = false;
													}

													if ( $donation_current == '' || $donation_current == 0 ) {
														$donation_percentage = 0;
														$donation_current = 0;
													} else {
														if ( $show_donation_bar ) {
															$donation_percentage = round ( $donation_current / $donation_goal * 100, 2 );
														} else {
															$donation_percentage = '0';
														}
													}

													/**
													 * Custom Links
													 */

													$more_details_link = get_post_meta( $post_id, $dd_sn . 'cause_custom_more_details_link', true );
													$make_donation_link = get_post_meta( $post_id, $dd_sn . 'cause_custom_make_donation_link', true );

													if ( ! $more_details_link ) {
														$more_details_link = get_permalink( $post_id );
													}

													if ( ! $make_donation_link ) {
														$make_donation_link = add_query_arg( 'dd_donate', 'yes', get_permalink( $post_id ) );
													}

												}
											?>

											<?php echo get_the_post_thumbnail( $post_id, 'dd-slider' ); ?>

											<div class="slide-info">
												
												<?php if ( ot_get_option( $dd_sn . 'multicol_colors', '' ) != '' ) : ?>

													<?php $header_colors = ot_get_option( $dd_sn . 'multicol_colors' ); ?>

													<div class="slide-info-colors multicol-colors">
														<ul class="clearfix">
															<?php foreach ( $header_colors as $header_color ) : ?>
																<li data-color="<?php echo $header_color[$dd_sn . 'color']; ?>"></li>
															<?php endforeach; ?>
														</ul>
													</div><!-- #header-colors -->

												<?php endif; ?>

												<div class="slide-info-inner">
													
													<div class="slide-title"><a href="<?php echo $more_details_link; ?>"><?php echo get_the_title( $post_id ); ?></a></div>

												</div><!-- .slide-info-inner -->

												<?php if ( $slide['type'] == 'cause' ) : ?>

													<div class="slide-info-extra">

														<div class="cause-info-content clearfix">
						
															<div class="fl cause-info-donated">
																<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e ( 'Donated', 'dd_string' ); ?>
															</div><!-- .cause-info-donated -->


															<?php if ( $show_donation_bar ) : ?>

																<div class="fr cause-info-funded">
																	<span><?php echo $donation_percentage; ?>%</span> <?php _e ( 'Funded', 'dd_string' ); ?>
																</div><!-- .cause-info-funded -->

															<?php endif; ?>

														</div><!-- .cause-info-content -->

														<?php if ( $show_donation_bar ) : ?>

															<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
																<span></span>
															</div><!-- .cause-info-bar -->

														<?php endif; ?>

														<div class="cause-info-links">
															<a href="<?php echo $more_details_link; ?>" class="dd-button orange-light small"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
															<span><?php _e( 'or', 'dd_string' ); ?></span>
															<a href="<?php echo $make_donation_link; ?>" class="dd-button green small"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?></a>
														</div><!-- .cause-info-links -->

													</div><!-- .slider-info-extra -->

												<?php elseif ( $slide['type'] == 'blog' ) : ?>

													<div class="slide-info-extra">

														<a href="<?php echo get_permalink( $post_id ); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>

													</div><!-- .slide-info-extra -->

												<?php elseif ( $slide['type'] == 'event' ) : ?>

													<div class="slide-info-extra">

														<a href="<?php echo get_permalink( $post_id ); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
													
														<?php if ( $fb_link != '' ) : ?>
															<span class="or">or</span>
															<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?></a>
														<?php endif; ?>

													</div><!-- .slide-info-extra -->

												<?php endif; ?>

											</div><!-- .slide-info -->

										<?php endif; ?>
											
										<a href="<?php echo $more_details_link; ?>" class="slide-link-mobile"></a>

									</li>

								<?php endforeach; ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<div id="slider-nav">
							<div id="slider-nav-inner">
								<ul class="slides">
									<?php foreach ( $slider as $key => $slide ) : ?>

										<li class="slide">

											<?php if ( $slide['type'] == 'custom' ) : ?>

												<div class="slide-inner">
													
													<div class="slider-nav-thumb">
														<img src="<?php $image_id = dd_get_image_id( $slide['image'] ); $img_array = wp_get_attachment_image_src( $image_id, 'dd-tiny' ); echo $img_array[0]; ?>">
													</div><!-- .slider-nav-thumb -->
													
													<div class="slider-nav-info">
														<span class="slider-nav-title"><?php echo $slide['title']; ?></span>
													</div><!-- .slider-nav-info -->

												</div><!-- .slide-inner -->

											<?php else : ?>

												<?php 
													if ( $slide['type'] == 'blog' ) {
														$post_id = $slide['blog_post']; 
													} elseif ( $slide['type'] == 'event' ) {
														$post_id = $slide['event'];
													} elseif ( $slide['type'] == 'cause' ) {
														
														$post_id = $slide['cause'];

														/**
														 * Translation Sync
														 */

														$cause_id = $post_id;

														if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

															global $dd_lang_curr;
															global $dd_lang_default;

															if ( $dd_lang_curr != $dd_lang_default ) {

																$cause_id = icl_object_id( $post_id, 'dd_causes', true, $dd_lang_default );

															}

														}

														$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
														$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

														$show_donation_bar = true;
														if ( $donation_goal == '' || $donation_goal == 0 ) {
															$show_donation_bar = false;
														}

														if ( $donation_current == '' || $donation_current == 0 ) {
															$donation_percentage = 0;
															$donation_current = 0;
														} else {
															if ( $show_donation_bar ) {
																$donation_percentage = round ( $donation_current / $donation_goal * 100, 2 );
															} else {
																$donation_percentage = '0';
															}
														}
													}
												?>

												<div class="slide-inner">
													<div class="slider-nav-thumb">
														<?php echo get_the_post_thumbnail( $post_id, 'dd-tiny' ); ?>
													</div><!-- .slider-nav-thumb -->
													<div class="slider-nav-info">
														<span class="slider-nav-title"><?php echo get_the_title( $post_id ); ?></span>
														<?php if ( $slide['type'] == 'cause' && $show_donation_bar ) : ?>
															<span class="slider-nav-funded"><span><?php echo $donation_percentage; ?>%</span> <?php _e( 'Funded', 'dd_string' ); ?></span>
														<?php endif; ?>
													</div><!-- .slider-nav-info -->
												</div><!-- .slide-inner -->

											<?php endif; ?>

										</li>
									<?php endforeach; ?>
								</ul>
								<a href="#" id="slider-nav-prev"><span class="icon-chevron-up"></span></a>
								<a href="#" id="slider-nav-next"><span class="icon-chevron-down"></span></a>
							</div><!-- .slider-nav-inner -->
						</div><!-- #slider-navigation -->

					</div><!-- #slider-inner -->

				</div><!-- #slider -->

			<?php

		endif;

	}

}

if ( ! function_exists( 'dd_home_section_causes' ) ) {

	/**
	 * Home section- Causes
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_causes( $atts ) {

		global $dd_sn;
		global $dd_donation_currency;

		$wrapper_class = '';
		$container_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		// Container class
		if ( $atts['type'] == 'carousel' )
			$container_class .= 'carousel ';

		// Should funded be shown in regular listing
		$show_funded = ot_get_option( $dd_sn . 'cause_funded_show', 'enabled' );
		if ( $show_funded == 'enabled' ) {
			$show_funded = true;
		} else {
			$show_funded = false;
		}

		if ( $show_funded ) {

			if ( $atts['category'] == 'all' ) {

				$args = array(
					'post_type' => 'dd_causes',
					'posts_per_page' => $atts['amount']
				);	

			} else {

				$args = array(
					'post_type' => 'dd_causes',
					'posts_per_page' => $atts['amount'],
					'tax_query' => array(
						array(
							'taxonomy' => 'dd_causes_cats',
							'field' => 'slug',
							'terms' => $atts['category']
						)
					)
				);	

			}

		} else {

			if ( $atts['category'] == 'all' ) {

				$args = array(
					'post_type' => 'dd_causes',
					'posts_per_page' => $atts['amount'],
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_dd_cause_status',
							'value' => 'funded',
							'compare' => '!=',
						)
					)
				);

			} else {

				$args = array(
					'post_type' => 'dd_causes',
					'posts_per_page' => $atts['amount'],
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => '_dd_cause_status',
							'value' => 'funded',
							'compare' => '!=',
						)
					),
					'tax_query' => array(
						array(
							'taxonomy' => 'dd_causes_cats',
							'field' => 'slug',
							'terms' => $atts['category']
						)
					)
				);

			}

		}

		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $count = 0; ?>

			<div class="causes-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_causes.php' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						
						<?php if ( $atts['type'] == 'carousel' ) : ?>

							<span class="carousel-nav fr">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->

						<?php endif; ?>

					</h2>

					<div class="causes <?php echo $container_class; ?> clearfix" data-autoplay="<?php echo $atts['autoplay']; ?>">

						<?php if ( $atts['type'] == 'carousel' ) : ?>

						<div class="flexslider">

							<ul class="slides">

						<?php endif; ?>

								 <?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++; ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										/**
										 * Translation Sync
										 */

										$cause_id = get_the_ID();	
										
										if ( defined( 'ICL_SITEPRESS_VERSION' ) ) {

											global $dd_lang_curr;
											global $dd_lang_default;

											if ( $dd_lang_curr != $dd_lang_default ) {

												$cause_id = icl_object_id( get_the_ID(), 'dd_causes', true, $dd_lang_default );

											}

										}

										$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
										$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

										$show_donation_bar = true;
										if ( $donation_goal == '' || $donation_goal == 0 ) {
											$show_donation_bar = false;
										}

										if ( $donation_current == '' || $donation_current == 0 ) {
											$donation_percentage = 0;
											$donation_current = 0;
										} else {
												if ( $show_donation_bar ) {
													$donation_percentage = round ( $donation_current / $donation_goal * 100, 2 );
												} else {
													$donation_percentage = '0';
												}
										}

										/**
										 * Custom Links
										 */

										$more_details_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_more_details_link', true );
										$make_donation_link = get_post_meta( get_the_ID(), $dd_sn . 'cause_custom_make_donation_link', true );

										if ( ! $more_details_link ) {
											$more_details_link = get_permalink();
										}

										if ( ! $make_donation_link ) {
											$make_donation_link = add_query_arg( 'dd_donate', 'yes', get_permalink( get_the_ID() ) );
										}


										if ( $atts['post_width'] == 'one_fourth' ) {
											$post_width_class = 'four columns';
											$thumb_id = 'dd-home-causes';
											$max_count = 4;
										} elseif ( $atts['post_width'] == 'one_third' ) {
											$post_width_class = 'one-third column';
											$thumb_id = 'dd-one-third';
											$max_count = 3;
										} elseif ( $atts['post_width'] == 'one_half' ) {
											$post_width_class = 'eight columns';
											$thumb_id = 'dd-one-half';
											$max_count = 2;
										}

										// Calculate last classes
										$last_class = '';
										if ( $count == $max_count ) {
											$last_class = ' last';
											$count = 0;
										} else if ( $count == 1 ) {
											$last_class = 'clear';
										}

										// If carousel clear the last classes
										if ( $atts['type'] == 'carousel' )
											$last_class = '';

								 	?>

									<li class="cause <?php echo $post_width_class . ' ' . $post_class_append . ' ' . $last_class; ?>">

										<div class="cause-inner">

											<div class="cause-thumb">

												<a href="<?php echo $more_details_link; ?>"><?php the_post_thumbnail( $thumb_id ); ?></a>

											</div><!-- .cause-thumb -->

											<div class="cause-main">

												<div class="cause-meta clearfix">

													<h2 class="cause-title"><a href="<?php echo $more_details_link; ?>"><?php the_title(); ?></a></h2>
													
													<div class="cause-excerpt">
														<?php the_excerpt(); ?>
													</div><!-- .cause-excerpt -->

												</div><!-- .cause-meta -->

											</div><!-- .cause-main -->

											<div class="cause-info">
												
												<div class="cause-info-arrow"></div>

												<div class="cause-info-content clearfix">
													
													<div class="fl cause-info-donated">
														<span><?php echo $dd_donation_currency . dd_add_commas( $donation_current ); ?></span> <?php _e( 'Donated', 'dd_string' ); ?>
													</div><!-- .cause-info-donated -->

													<?php if ( $show_donation_bar ) : ?>

														<div class="fr cause-info-funded">
															<span><?php echo $donation_percentage; ?>%</span> <?php _e( 'Funded', 'dd_string' ); ?>
														</div><!-- .cause-info-funded -->

													<?php endif; ?>

												</div><!-- .cause-info-content -->

												<?php if ( $show_donation_bar ) : ?>

													<div class="cause-info-bar" data-raised="<?php echo $donation_percentage; ?>%">
														<span></span>
													</div><!-- .cause-info-bar -->

												<?php endif; ?>

												<div class="cause-info-links">
													<a href="<?php echo $more_details_link; ?>" class="dd-button orange-light small"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
													<span><?php _e( 'or', 'dd_string' ); ?></span>
													<a href="<?php echo $make_donation_link; ?>" class="dd-button green small"><?php _e( 'MAKE A DONATION', 'dd_string' ); ?></a>
												</div><!-- .cause-info-links -->

											</div><!-- .cause-info -->

										</div><!-- .cause-inner -->

									</li><!-- .cause -->

								<?php endwhile; ?>

							<?php if ( $atts['type'] == 'carousel' ) : ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<?php endif; ?>

					</div><!-- .causes -->
					
				</div><!-- .container -->

			</div><!-- .causes-wrapper -->

		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_blog' ) ) {

	/**
	 * Home section - Blog
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_blog( $atts ) {

		global $dd_sn;

		$wrapper_class = '';
		$container_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		// Container class
		if ( $atts['type'] == 'carousel' )
			$container_class .= 'carousel ';

		if ( $atts['category'] == 'all' ) {

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $atts['amount'],
				'suppress_filter' => 0
			);

		} else {

			$args = array(
				'post_type' => 'post',
				'posts_per_page' => $atts['amount'],
				'category__in' => array( $atts['category'] ),
				'suppress_filter' => 0
			);

		}

		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $count = 0; ?>

			<div class="blog-posts-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-blog.php' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>

						<?php if ( $atts['type'] == 'carousel' ) : ?>

							<span class="carousel-nav fr">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->

						<?php endif; ?>

					</h2>

					<div class="blog-posts <?php echo $container_class; ?> clearfix" data-autoplay="<?php echo $atts['autoplay']; ?>">

						<?php if ( $atts['type'] == 'carousel' ) : ?>

						<div class="flexslider">

							<ul class="slides">

						<?php endif; ?>

								 <?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++; ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										if ( $atts['post_width'] == 'one_fourth' ) {
											$post_width_class = 'four columns';
											$thumb_id = 'dd-home-blog';
											$max_count = 4;
										} elseif ( $atts['post_width'] == 'one_third' ) {
											$post_width_class = 'one-third column';
											$thumb_id = 'dd-one-third';
											$max_count = 3;
										} elseif ( $atts['post_width'] == 'one_half' ) {
											$post_width_class = 'eight columns';
											$thumb_id = 'dd-one-half';
											$max_count = 2;
										}

										// Calculate last classes
										$last_class = '';
										if ( $count == $max_count ) {
											$last_class = ' last';
											$count = 0;
										} else if ( $count == 1 ) {
											$last_class = 'clear';
										}

										// If carousel clear the last classes
										if ( $atts['type'] == 'carousel' )
											$last_class = '';

								 	?>

									<li class="blog-post <?php echo $post_width_class . ' ' . $post_class_append . ' ' . $last_class; ?>">

										<div class="blog-post-inner">

											<div class="blog-post-thumb">

												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_id ); ?></a>

											</div><!-- .blog-post-thumb -->

											<div class="blog-post-main">

												<h2 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

												<div class="blog-post-date"><?php the_time( get_option( 'date_format' ) ); ?></div>
													
												<div class="blog-post-excerpt">
													<?php the_excerpt(); ?>
												</div><!-- .blog-post-excerpt -->

												<div class="blog-post-category">
													<?php _e( 'Posted In:', 'dd_string' ); ?> <?php the_category( ', ' ); ?>
												</div><!-- .blog-post-category -->

												<div class="blog-post-permalink">
													<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
												</div><!-- .blog-post-permalink -->

											</div><!-- .blog-post-main -->

										</div><!-- .blog-post-inner -->

									</li><!-- .blog-post -->

								<?php endwhile; ?>

						<?php if ( $atts['type'] == 'carousel' ) : ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<?php endif; ?>

					</div><!-- .blog-posts -->

				</div><!-- .container -->

			</div><!-- .blog-posts-wrapper -->
			
		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_staff' ) ) {

	/**
	 * Home section - Staff
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_staff( $atts ) {		

		global $dd_sn;

		$wrapper_class = '';
		$container_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		// Container class
		if ( $atts['type'] == 'carousel' )
			$container_class .= 'carousel ';

		$args = array(
			'post_type' => 'dd_staff',
			'posts_per_page' => $atts['amount'],
			'suppress_filter' => 0
		);
		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $count = 0; ?>

			<div class="staff-members-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_staff.php' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						
						<?php if ( $atts['type'] == 'carousel' ) : ?>

							<span class="carousel-nav fr">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->

						<?php endif; ?>

					</h2>

					<div class="staff-members <?php echo $container_class; ?> clearfix" data-autoplay="<?php echo $atts['autoplay']; ?>">

						<?php if ( $atts['type'] == 'carousel' ) : ?>

						<div class="flexslider">

							<ul class="slides">

						<?php endif; ?>

								 <?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++; ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										$staff_position = get_post_meta( get_the_ID(), $dd_sn . 'position', true );
										$staff_twitter = get_post_meta( get_the_ID(), $dd_sn . 'twitter', true );
										$staff_facebook = get_post_meta( get_the_ID(), $dd_sn . 'facebook', true );
										$staff_gplus = get_post_meta( get_the_ID(), $dd_sn . 'gplus', true );
										$staff_linkedin = get_post_meta( get_the_ID(), $dd_sn . 'linkedin', true );

										$max_count = 4;

										// Calculate last classes
										$last_class = '';
										if ( $count == $max_count ) {
											$last_class = ' last';
											$count = 0;
										} else if ( $count == 1 ) {
											$last_class = 'clear';
										}

										// If carousel clear the last classes
										if ( $atts['type'] == 'carousel' )
											$last_class = '';

								 	?>

									<li class="staff-member four columns <?php echo $post_class_append . ' ' . $last_class; ?>">

										<div class="staff-member-thumb">

											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-one-fourth' ); ?></a>

										</div><!-- .staff-member-thumb -->

										<div class="staff-member-main">

											<h2 class="staff-member-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

											<?php if ( $staff_position ) : ?>

												<div class="staff-member-position"><?php echo $staff_position; ?></div>

											<?php endif; ?>
												
											<div class="staff-member-excerpt">
												<?php the_excerpt(); ?>
											</div><!-- .staff-member-excerpt -->

											<?php if ( $staff_twitter || $staff_facebook || $staff_gplus || $staff_linkedin ) : ?>

												<div class="staff-member-social">
													
													<?php if ( $staff_twitter ) : ?>

														<a href="<?php echo $staff_twitter; ?>"><span class="icon-social-twitter"></span></a>

													<?php endif; ?>

													<?php if ( $staff_facebook ) : ?>

														<a href="<?php echo $staff_facebook; ?>"><span class="icon-social-facebook"></span></a>

													<?php endif; ?>

													<?php if ( $staff_gplus ) : ?>

														<a href="<?php echo $staff_gplus; ?>"><span class="icon-social-gplus"></span></a>

													<?php endif; ?>

													<?php if ( $staff_linkedin ) : ?>

														<a href="<?php echo $staff_linkedin; ?>"><span class="icon-social-linkedin"></span></a>

													<?php endif; ?>

												</div><!-- .staff-member-social -->

											<?php endif; ?>

											<div class="staff-member-permalink">
												<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'CONTINUE READING', 'dd_string' ); ?></a>
											</div><!-- .staff-member-permalink -->

										</div><!-- .staff-member-main -->

									</li><!-- .staff-member -->

								<?php endwhile; ?>

							<?php if ( $atts['type'] == 'carousel' ) : ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<?php endif; ?>

					</div><!-- .staff-members -->

				</div><!-- .container -->

			</div><!-- .staff-members-wrapper -->
			
		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_events' ) ) {

	/**
	 * Home section - Events
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_events( $atts ) {

		global $dd_sn;

		$wrapper_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		$args = array(
			'post_type' => 'dd_events',
			'posts_per_page' => ot_get_option( $dd_sn . 'home_events_amount', '100' ),
			'post_status' => array( 'future', 'publish' ),
			'order' => 'ASC',
		);
		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $start_at = true; ?>

			<div class="events-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container clearfix">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_events.php' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						<span class="carousel-nav fr">
							<span class="carousel-nav-inner">
								<a href="#" class="carousel-prev"></a>
								<a href="#" class="carousel-next"></a>
							</span>
						</span><!-- .carousel-nav -->
					</h2>

					<div class="events-calendar-wrapper one-third column">
						<div class="events-calendar-wrapper-inner">
							<?php dd_get_calendar( array( 'dd_events' ), false ); ?>
						</div><!-- .events-calendar-wrapper-inner -->
					</div><!-- .one-third -->

					<div class="events carousel clearfix two-thirds column last"  data-autoplay="<?php echo $atts['autoplay']; ?>">

						<div class="flexslider">

							<ul class="slides">

								 <?php $start_at = true; while ( $dd_query->have_posts() ) : $dd_query->the_post();  ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										$fb_link = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

										// Date of event
										$event_date = get_post_meta( get_the_ID(), $dd_sn . 'event_date', true );
										if ( ! $event_date )
											$event_date = get_the_time( get_option( 'date_format' ) );

										$start_at_class = '';

										if ( $start_at && get_post_status( get_the_ID() ) == 'future' ) {
											
											$start_at = false;
											$start_at_class = 'start-at';

										}
								 	?>

									<li class="event one-third column <?php echo $post_class_append . $start_at_class; ?>" data-day="<?php the_time( 'j m Y' ); ?>">

										<div class="event-inner">

											<div class="event-thumb">

												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'dd-home-events' ); ?></a>

												<div class="event-date"><span class="icon-calendar"></span><?php echo $event_date; ?></div>

											</div><!-- .event-thumb -->

											<div class="event-main">

												<h2 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
													
												<div class="event-excerpt">
													<?php the_excerpt(); ?>
												</div><!-- .event-excerpt -->

											</div><!-- .event-main -->

											<div class="event-info">
												
												<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
												
												<?php if ( $fb_link != '' ) : ?>
													<em><?php _e( 'or', 'dd_string' ); ?></em>
													<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?></a>
												<?php endif; ?>

											</div><!-- event-info -->

										</div><!-- .event-inner -->

									</li><!-- .event -->

								<?php endwhile; ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

					</div><!-- .blog-posts -->

				</div><!-- .container -->

			</div><!-- .events-wrapper -->
			
		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_events_no_cal' ) ) {

	/**
	 * Home section - Events Without Calendar
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_events_no_cal( $atts ) {

		global $dd_sn;

		$wrapper_class = '';
		$container_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		// Container class
		if ( $atts['type'] == 'carousel' )
			$container_class .= 'carousel ';

		$args = array(
			'post_type' => 'dd_events',
			'posts_per_page' => $atts['amount'],
			'post_status' => array( 'future' ),
			'order' => 'ASC',
		);
		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $start_at = true; $count = 0; ?>

			<div class="events-no-cal-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container clearfix">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						<a href="<?php echo get_permalink( dd_get_post_id( 'template', 'template-dd_events.php' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						
						<?php if ( $atts['type'] == 'carousel' ) : ?>

							<span class="carousel-nav fr">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->

						<?php endif; ?>

					</h2>

					<div class="events carousel clearfix" data-autoplay="<?php echo $atts['autoplay']; ?>">

						<?php if ( $atts['type'] == 'carousel' ) : ?>

						<div class="flexslider">

							<ul class="slides">

						<?php endif; ?>

								 <?php $start_at = true; while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++; ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										if ( $atts['post_width'] == 'one_fourth' ) {
											$post_width_class = 'four columns ';
											$thumb_id = 'dd-home-events';
											$max_count = 4;
										} elseif ( $atts['post_width'] == 'one_third' ) {
											$post_width_class = 'one-third column ';
											$thumb_id = 'dd-one-third';
											$max_count = 3;
										} elseif ( $atts['post_width'] == 'one_half' ) {
											$post_width_class = 'eight columns ';
											$thumb_id = 'dd-one-half';
											$max_count = 2;
										}

										// Calculate last classes
										$last_class = '';
										if ( $count == $max_count ) {
											$last_class = ' last';
											$count = 0;
										} else if ( $count == 1 ) {
											$last_class = 'clear';
										}

										// If carousel clear the last classes
										if ( $atts['type'] == 'carousel' )
											$last_class = '';

										$fb_link = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

										// Date of event
										$event_date = get_post_meta( get_the_ID(), $dd_sn . 'event_date', true );
										if ( ! $event_date )
											$event_date = get_the_time( get_option( 'date_format' ) );

										$start_at_class = '';

										if ( $start_at && get_post_status( get_the_ID() ) == 'future' ) {
											
											$start_at = false;
											$start_at_class = 'start-at';

										}
								 	?>

									<li class="event <?php echo $post_width_class . $post_class_append . $start_at_class . ' ' . $last_class; ?>" data-day="<?php the_time( 'j m Y' ); ?>">

										<div class="event-inner">

											<div class="event-thumb">

												<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( $thumb_id ); ?></a>

												<div class="event-date"><span class="icon-calendar"></span><?php echo $event_date; ?></div>

											</div><!-- .event-thumb -->

											<div class="event-main">

												<h2 class="event-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
													
												<div class="event-excerpt">
													<?php the_excerpt(); ?>
												</div><!-- .event-excerpt -->

											</div><!-- .event-main -->

											<div class="event-info">
												
												<a href="<?php the_permalink(); ?>" class="dd-button small orange-light"><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
												
												<?php if ( $fb_link != '' ) : ?>
													<em><?php _e( 'or', 'dd_string' ); ?></em>
													<a href="<?php echo $fb_link; ?>" target="_blank" class="dd-button small blue-light"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?></a>
												<?php endif; ?>

											</div><!-- event-info -->

										</div><!-- .event-inner -->

									</li><!-- .event -->

								<?php endwhile; ?>

							<?php if ( $atts['type'] == 'carousel' ) : ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<?php endif; ?>

					</div><!-- .blog-posts -->

				</div><!-- .container -->

			</div><!-- .events-wrapper -->
			
		<?php endif; wp_reset_postdata();

	}

}

if ( ! function_exists( 'dd_home_section_products' ) ) {

	/**
	 * Home section - Products
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_products( $atts ) {

		if ( class_exists( 'woocommerce' ) ) :

			global $dd_sn;
			global $woocommerce; 

			$woo_cart_url = $woocommerce->cart->get_cart_url();

			$wrapper_class = '';

			// Wrapper classes
			if ( $atts['parity'] == 'even' ) {
				$wrapper_class .= 'even ';
			} else {
				$wrapper_class .= 'odd ';
			}

			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $atts['amount']
			);
			$dd_query = new WP_Query( $args );
			
			if ( $dd_query->have_posts() ) : $carousel_content = ''; ?>

				<div class="products-wrapper home-section <?php echo $wrapper_class; ?>">

					<div class="container">

						<h2 class="section-title">
							<?php if ( ! empty( $atts['title'] ) ) : ?>
								<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
							<?php endif; ?>
							<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>" class="dd-button medium orange-light"><?php _e( 'VIEW ALL', 'dd_string' ); ?></a>
						</h2>

						<div class="slider-container-loader"><img src="<?php echo get_template_directory_uri() . '/images/misc/ajax-loader.gif'; ?>"></div>

						<div class="products-slider">

							<div class="flexslider">

								<ul class="slides">

									<?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); global $product;  ?>

										<?php 
											$product_bg_color = get_post_meta( get_the_ID(), $dd_sn . 'product_bg', true ); 
											if ( ! $product_bg_color ) {
												$product_bg_color = 'default';
											}
										?>

										<li data-bg-color="<?php echo $product_bg_color; ?>">

											<div class="product-slide-thumb">

												<?php if ( has_post_thumbnail() ) : ?>
													<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'full' ); ?></a>
												<?php endif; ?>

											</div><!-- .product-slide-thumb -->

											<div class="product-slide-main">

												<a href="<?php the_permalink(); ?>" class="product-slide-title"><?php the_title(); ?></a>

												<div class="product-slide-meta clearfix">
													
													<?php if ( $product->get_price_html() !== '' ) : ?>
														<a href="<?php the_permalink(); ?>" class="product-slide-price"><?php echo $product->get_price_html(); ?></a>
													<?php endif; ?>
													
													<div class="product-slide-excerpt"><?php the_excerpt(); ?></div>

												</div><!-- .product-slide-meta -->

												<div class="product-slide-links">
													<a href="<?php the_permalink(); ?>" class="dd-button medium blue"><span class="icon-text-doc"></span><?php _e( 'MORE DETAILS', 'dd_string' ); ?></a>
													<a href="<?php echo do_shortcode( '[add_to_cart_url id="' . get_the_ID() . '"]' ); ?>" data-view-cart-url="<?php echo $woo_cart_url; ?>" data-view-cart-text="<?php _e( 'VIEW CART', 'dd_string' ); ?>" class="dd-button medium orange-light add-to-cart-ajax"><span class="icon-cart"></span><?php _e( 'ADD TO CART', 'dd_string' ); ?></a>
												</div><!-- .product-slide-links -->

											</div><!-- .product-slide-main -->

										</li>

									<?php
										$carousel_content .= '<li>' . get_the_post_thumbnail( get_the_ID(), 'dd-tiny' ) . '</li>';
									?>

									<?php endwhile; ?>

								</ul><!-- .slides -->

							</div><!-- .flexslider -->

						</div><!-- .products-slider -->

						<div class="products-carousel">

							<div class="flexslider">

								<ul class="slides">
									<?php echo $carousel_content; ?>
									<li class="products-carousel-fake-slide"></li>
								</ul><!-- .slides -->

							</div><!-- .flexslider -->

							<div class="products-carousel-nav">

								<a href="#" class="products-carousel-nav-prev"><span class="icon-chevron-left"></span></a>
								<a href="#" class="products-carousel-nav-next"><span class="icon-chevron-right"></span></a>

							</div><!-- .products-carousel-nav -->

							<div class="products-carousel-overlay-left"></div>
							<div class="products-carousel-overlay-right"></div>

						</div><!-- .products-carousel -->

					</div><!-- .container -->

				</div><!-- .products-wrapper -->

			<?php endif; wp_reset_postdata();

		endif;

	}

}

if ( ! function_exists( 'dd_home_section_tabs' ) ) {

	function dd_home_section_tabs( $atts ) { 

		global $dd_sn;

		$tabs = ot_get_option( $dd_sn . 'home_tabs_section', 'disabled' );

		if ( $tabs !== 'disabled' && ! empty ( $tabs ) ) :

			$wrapper_class = '';

			// Wrapper classes
			if ( $atts['parity'] == 'even' ) {
				$wrapper_class .= 'even ';
			} else {
				$wrapper_class .= 'odd ';
			}

			?>

				<div class="tabs-wrapper home-section <?php echo $wrapper_class; ?>">

					<div class="container clearfix">

						<div class="tabs-container">

							<div class="tabs-nav four columns">

								<ul>
									<?php foreach ( $tabs as $tab ) : ?>
										<li><span class="tabs-nav-connect"></span><a href="#"><img src="<?php $thumb = wp_get_attachment_image_src( dd_get_image_id( $tab['image'] ), 'dd-tiny' ); echo $thumb[0]; ?>" alt="<?php echo esc_attr( $tab['title'] ); ?>"><span class="tabs-nav-title"><?php echo $tab['title']; ?></span></a></li>
									<?php endforeach; ?>
								</ul>

							</div><!-- .tabs-nav -->

							<div class="tabs-content twelve columns last">

								<?php foreach ( $tabs as $tab ) : ?>
									<div class="tab-content">
										<?php echo $tab['content']; ?>
									</div><!-- .tab-content -->
								<?php endforeach; ?>

							</div><!-- .tabs-content -->

						</div><!-- .tabs-container -->

					</div><!-- .container -->

				</div><!-- .tabs-wrapper -->

			<?php

		endif;

	}

}

if ( ! function_exists( 'dd_home_section_text' ) ) {

	/**
	 * Home section - Text
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_text( $atts ) {

		global $dd_sn;

		$wrapper_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		?>
			<div class="text-module-wrapper home-section <?php echo $wrapper_class; ?>">
				<div class="container clearfix">
					<?php echo do_shortcode( $atts['content'] ); ?>
				</div>
			</div>
		<?php

	}

}

if ( ! function_exists( 'dd_home_section_sponsors' ) ) {

	/**
	 * Home section- Sponsors
	 *
	 * Output contents for the section on the homepage.
	 */
	function dd_home_section_sponsors( $atts ) {

		global $dd_sn;
		global $dd_donation_currency;

		$wrapper_class = '';
		$container_class = '';

		// Wrapper classes
		if ( $atts['parity'] == 'even' ) {
			$wrapper_class .= 'even ';
		} else {
			$wrapper_class .= 'odd ';
		}

		// Container class
		if ( $atts['type'] == 'carousel' )
			$container_class .= 'carousel ';

		$args = array(
			'post_type' => 'dd_sponsors',
			'posts_per_page' => $atts['amount']
		);	
		
		$dd_query = new WP_Query( $args );
		
		if ( $dd_query->have_posts() ) : $count = 0; ?>

			<div class="sponsors-wrapper home-section <?php echo $wrapper_class; ?>">

				<div class="container">

					<h2 class="section-title">
						<?php if ( ! empty( $atts['title'] ) ) : ?>
							<span class="dd-button medium blue"><?php echo $atts['title']; ?></span>
						<?php endif; ?>
						
						<?php if ( $atts['type'] == 'carousel' ) : ?>

							<span class="carousel-nav fr">
								<span class="carousel-nav-inner">
									<a href="#" class="carousel-prev"></a>
									<a href="#" class="carousel-next"></a>
								</span>
							</span><!-- .carousel-nav -->

						<?php endif; ?>

					</h2>

					<div class="sponsors <?php echo $container_class; ?> clearfix" data-autoplay="<?php echo $atts['autoplay']; ?>">

						<?php if ( $atts['type'] == 'carousel' ) : ?>

						<div class="flexslider">

							<ul class="slides">

						<?php endif; ?>

								 <?php while ( $dd_query->have_posts() ) : $dd_query->the_post(); $count++;  ?>

								 	<?php

										if ( has_post_thumbnail() ) {
											$post_class_append = 'has-thumb ';
										} else {
											$post_class_append = '';
										}

										/**
										 * Custom Links
										 */

										$sponsor_link = get_post_meta( get_the_ID(), $dd_sn . 'sponsor_link', true );

										if ( $atts['post_width'] == 'one_fourth' ) {
											$post_width_class = 'four columns';
											$max_count = 4;
										} elseif ( $atts['post_width'] == 'one_third' ) {
											$post_width_class = 'one-third column';
											$max_count = 3;
										} elseif ( $atts['post_width'] == 'one_half' ) {
											$post_width_class = 'eight columns';
											$max_count = 2;
										}

										$thumb_id = 'full';

										// Calculate last classes
										$last_class = '';
										if ( $count == $max_count ) {
											$last_class = ' last';
											$count = 0;
										} else if ( $count == 1 ) {
											$last_class = 'clear';
										}

										// If carousel clear the last classes
										if ( $atts['type'] == 'carousel' )
											$last_class = '';

								 	?>

									<li class="sponsor <?php echo $post_width_class . ' ' . $post_class_append . ' ' . $last_class; ?>">

										<div class="sponsor-inner">

											<div class="sponsor-thumb">
												<?php if ( $sponsor_link ) : ?>
													<a href="<?php echo $sponsor_link; ?>" target="_blank"><?php the_post_thumbnail( $thumb_id ); ?></a>
												<?php else : ?>
													<?php the_post_thumbnail( $thumb_id ); ?>
												<?php endif; ?>
											</div><!-- .sponsor-thumb -->

										</div><!-- .sponsor-inner -->

									</li><!-- .sponsor -->

								<?php endwhile; ?>

						<?php if ( $atts['type'] == 'carousel' ) : ?>

							</ul><!-- .slides -->

						</div><!-- .flexslider -->

						<?php endif; ?>

					</div><!-- .sponsors -->
					
				</div><!-- .container -->

			</div><!-- .sponsors-wrapper -->

		<?php endif; wp_reset_postdata();

	}

}

function dd_multicol_colors() {

	global $dd_sn;

	if ( ot_get_option( $dd_sn . 'multicol_colors', '' ) != '' ) :

		$header_colors = ot_get_option( $dd_sn . 'multicol_colors' );

		?>

			<div class="multicol-colors">
				<ul class="clearfix">
					<?php foreach ( $header_colors as $header_color ) : ?>
						<li data-color="<?php echo $header_color[$dd_sn . 'color']; ?>"></li>
					<?php endforeach; ?>
				</ul>
			</div><!-- #header-colors -->

		<?php

	endif;

}

function dd_query_events_upcoming( $where ) {

	global $wpdb;

	if ( isset( $_GET['dd_year'] ) && is_numeric( $_GET['dd_year'] ) ) {
		$year = $_GET['dd_year'];
	} else {
		$year = gmdate( 'Y' );
	}

	$curr_date = gmdate( 'Y-m-d');

	$where .= " AND post_date >= '$curr_date'";
	$where .= " AND YEAR (post_date) = '$year'";

	return $where;

}

function dd_query_events_past( $where ) {

	global $wpdb;

	$curr_date = gmdate( 'Y-m-d');

	$where .= " AND post_date < '$curr_date'";

	return $where;

}

add_filter('the_posts', 'dd_show_future_events');
function dd_show_future_events( $posts ) {

	global $wp_query, $wpdb;

	if( is_single() && $wp_query->post_count == 0 && $wp_query->query_vars['post_type'] == 'dd_events') {
		$posts = $wpdb->get_results($wp_query->request);
	}

	return $posts;

}

function dd_additional_cause_meta( $cause_id ) {
    
	global $dd_sn;

	// Verify post is not a revision
	if ( !wp_is_post_revision( $cause_id ) && get_post_type( $cause_id ) == 'dd_causes' ) {

		// Get current donation info
		$donation_goal = get_post_meta( $cause_id, $dd_sn . 'cause_amount_needed', true );
		$donation_current = round( get_post_meta( $cause_id, $dd_sn . 'cause_amount_current', true ) );

		// Calculate percentage
		if ( $donation_current == '' || $donation_current == 0 ) {
			$donation_percentage = 0;
			$donation_current = 0;
		} else {
			
			if ( $donation_goal == '' ) {
				$donation_percentage = 0;
			} else {
				$donation_percentage = round ( $donation_current / $donation_goal * 100, 0 );
			}

		}

		// Make sure it doesn't go over 100
		if ( $donation_percentage > 100 ) {
			$donation_percentage = 100;
		}

		// Get donation status
		if ( $donation_percentage == 100 ) {
			$donation_status = 'funded';
		} else if ( $donation_percentage >= 90 ) {
			$donation_status = 'lastmiles';
		} else {
			$donation_status = 'regular';
		}

		// Update percentage field
		update_post_meta( $cause_id, '_dd_cause_percentage', $donation_percentage );
		update_post_meta( $cause_id, '_dd_cause_status', $donation_status );

	}

}
add_action('save_post', 'dd_additional_cause_meta');		

/**
 * Google Fonts
 */
function dd_google_fonts() {

	$protocol = is_ssl() ? 'https' : 'http';

	wp_enqueue_style( 'dd-gf-oswald', "$protocol://fonts.googleapis.com/css?family=Oswald:400,300,700&subset=latin,latin-ext" );
	wp_enqueue_style( 'dd-gf-droidserif', "$protocol://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" );
	wp_enqueue_style( 'dd-gf-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );
	wp_enqueue_style( 'dd-gf-arimo', "$protocol://fonts.googleapis.com/css?family=Arimo:400,700,400italic,700italic" );
	wp_enqueue_style( 'dd-gf-bitter', "$protocol://fonts.googleapis.com/css?family=Bitter:400,700,400italic" );

}
add_action( 'wp_enqueue_scripts', 'dd_google_fonts' );

/**
 * Change the columns per row in WooCommerce
 */
add_filter( 'loop_shop_columns', 'dd_woo_columns' );
if ( ! function_exists( 'dd_woo_columns' ) ) {
	function dd_woo_columns() {
		return 3;
	}
}

/**
 * Get event translated versions
 */

function dd_wpml_get_event_translations( $event_id ) {

	global $wpdb;

	$translations = array();
	$languages = array();

	if ( is_numeric( $event_id ) ) {

		// Translation ID
		$trid = $wpdb->get_var( "SELECT trid FROM {$wpdb->prefix}icl_translations WHERE element_id = '$event_id'" );

		// If trid exists
		if ( is_numeric( $trid ) ) {

			// Get all translations for the post
			$translations_raw = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}icl_translations WHERE trid = '$trid'" );

			// Get all active languages
			$languages_raw = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}icl_languages WHERE active = '1'" );

			// Generate languages array
			foreach ( $languages_raw as $language_raw ) {

				$languages[$language_raw->code] = $language_raw->english_name;

			}

			// Generate translations array
			foreach ( $translations_raw as $translation_raw ) {

				$translations[] = array(
					'url' => get_permalink( $translation_raw->element_id ),
					'language_code' => $translation_raw->language_code,
					'native_name' => $languages[$translation_raw->language_code],
				);

			}

		}


	}

	return $translations;

}

/**
 * Cause Archives query
 */

function dd_cause_archive_query( $query ) {

	if ( $query->is_archive && isset ( $query->query_vars['dd_causes_cats'] ) ) {

		global $dd_sn;

		// Should funded be shown
		$show_funded = ot_get_option( $dd_sn . 'cause_funded_show', 'enabled' );
		if ( $show_funded == 'enabled' ) {
			$show_funded = true;
		} else {
			$show_funded = false;
		}

		if ( $show_funded === false ) {

			$meta_query = array(
				'relation' => 'AND',
				array(
					'key' => '_dd_cause_status',
					'value' => 'funded',
					'compare' => '!=',
				)
			);

			$query->set( 'meta_query', $meta_query );

		}

	}

	return $query;

} add_filter( 'pre_get_posts', 'dd_cause_archive_query' );