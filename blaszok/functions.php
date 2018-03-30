<?php

define('MPC_OPTIONS_NAME', 'mpcth_options_theme_customizer');
define('MPC_THEME_PATH', get_template_directory());
define('MPC_THEME_URI', get_template_directory_uri());
define('MPC_THEME_ENABLED', true);

global $page_id;
global $mpcth_options;

$mpcth_options = get_option(MPC_OPTIONS_NAME);

/* ---------------------------------------------------------------- */
/* Theme setup
/* ---------------------------------------------------------------- */
add_action('after_setup_theme', 'mpcth_theme_setup');
function mpcth_theme_setup(){
	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-formats', array('gallery', 'video', 'audio', 'link', 'aside', 'quote', 'status', 'chat'));
		add_theme_support('woocommerce');

		add_image_size('mpcth-horizontal-columns-1', 1200, 900, true);
		add_image_size('mpcth-horizontal-columns-2', 600, 450, true);
		add_image_size('mpcth-horizontal-columns-3', 400, 300, true);
		add_image_size('mpcth-horizontal-columns-4', 300, 225, true);

		add_image_size('mpcth-vertical-columns-1', 1200, 1600, true);
		add_image_size('mpcth-vertical-columns-2', 600, 800, true);
		add_image_size('mpcth-vertical-columns-3', 400, 533, true);
		add_image_size('mpcth-vertical-columns-4', 300, 400, true);

		add_editor_style();
	}
	/* Enabling translations */
	load_theme_textdomain('mpcth', MPC_THEME_PATH . '/languages');
	load_child_theme_textdomain( 'mpcth', get_stylesheet_directory() . '/languages' );

	if (function_exists('vc_set_default_editor_post_types')) {
		$list = array('page', 'post', 'mpc_portfolio', 'mpc_grid', 'product');
		vc_set_default_editor_post_types( $list );
	}
}

/* WooCommerce jquery.cookie server issue workaround */
add_action('init', 'mpcth_woo_fix');
function mpcth_woo_fix() {
	wp_register_script('jquery-cookie', MPC_THEME_URI . '/js/jquery.cokies' . (defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min') . '.js', array('jquery'), '1.3.1', true);
}

/* ---------------------------------------------------------------- */
/* WP Title
/* ---------------------------------------------------------------- */
add_filter('wp_title', 'mpcth_wp_title', 10, 2);
function mpcth_wp_title($title, $sep) {
	global $paged;

	if (is_feed())
		return $title;

	// Add the blog name.
	$title .= get_bloginfo('name');

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo('description', 'display');
	if ($site_description && (is_home() || is_front_page()) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ($paged > 1)
		$title = "$title $sep " . __('Page ', 'mpcth') . $paged;

	return $title;
}

/* ---------------------------------------------------------------- */
/* Forced excerpt length
/* ---------------------------------------------------------------- */
if( isset( $mpcth_options['mpcth_enable_excerpt_trim'] ) && $mpcth_options['mpcth_enable_excerpt_trim'] ) {
//	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
//	add_filter( 'get_the_excerpt', 'mpcth_trim_excerpt' );

	add_filter( 'excerpt_length', function() { return 50; } );
	add_filter( 'excerpt_more', function() { return ' ' . '[&hellip;]'; } );
}

function mpcth_trim_excerpt( $text ) {
	global $post;

	$raw_excerpt = $text;
	if ( $text == '' ) {
		$text = get_the_content( '' );
		$text = strip_shortcodes( $text );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );
	}

	$text = strip_tags( $text, 'br' );
	$excerpt_length = apply_filters( 'excerpt_length', 55 );
	$excerpt_more = apply_filters( 'excerpt_more', ' ' . '[…]' );
	$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

	return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
}

/* ---------------------------------------------------------------- */
/* Panel notice
/* ---------------------------------------------------------------- */
add_action('admin_notices', 'mpcth_theme_update');
function mpcth_theme_update() {
	$mpc_theme = wp_get_theme();
	$saved_version = get_option('mpc_theme_version');

	if($mpc_theme->get('Version') !== $saved_version) {
		echo '<div id="mpcth_theme_update" class="updated fade"><p><strong>' . __('Blaszok theme', 'mpcth') . '</strong> ' . __('was successfully updated. Please go to', 'mpcth') . ' <em>' . __('Theme Options', 'mpcth') . '</em>.</p></div>';
	}
}
add_action('admin_head', 'mpcth_admin_styles', 999 );
function mpcth_admin_styles() {
	echo '<style type="text/css">.vc_license.notice { display: none !important; }</style>';
}

/* ---------------------------------------------------------------- */
/* Enqueue theme scripts and styles
/* ---------------------------------------------------------------- */
add_action('wp_enqueue_scripts', 'mpcth_enqueue_scripts');
function mpcth_enqueue_scripts() {
	global $mpcth_options;
	global $page_id;
	$protocol = is_ssl() ? 'https' : 'http';

	if (isset($mpcth_options['mpcth_content_font']) && is_array($mpcth_options['mpcth_content_font'])) {
		if ($mpcth_options['mpcth_content_font']['type'] == 'google') {
			$content_family = str_replace(' ', '+', $mpcth_options['mpcth_content_font']['family']);
			$content_style = $mpcth_options['mpcth_content_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_content_font']['style'] : '';
			wp_enqueue_style('mpc-content-font', apply_filters( 'blaszok/font', "$protocol://fonts.googleapis.com/css?family={$content_family}{$content_style}" ) );
		}
	}
	if (isset($mpcth_options['mpcth_heading_font']) && is_array($mpcth_options['mpcth_heading_font'])) {
		if ($mpcth_options['mpcth_heading_font']['type'] == 'google') {
			$heading_family = str_replace(' ', '+', $mpcth_options['mpcth_heading_font']['family']);
			$heading_style = $mpcth_options['mpcth_heading_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_heading_font']['style'] : '';
			wp_enqueue_style('mpc-heading-font', apply_filters( 'blaszok/font', "$protocol://fonts.googleapis.com/css?family={$heading_family}{$heading_style}" ) );
		} else {
			wp_enqueue_style('mpc-heading-font', apply_filters( 'blaszok/font', "$protocol://fonts.googleapis.com/css?family=Lato:700" ) );
		}
	}
	if (isset($mpcth_options['mpcth_menu_font']) && is_array($mpcth_options['mpcth_menu_font'])) {
		if ($mpcth_options['mpcth_menu_font']['type'] == 'google') {
			$menu_family = str_replace(' ', '+', $mpcth_options['mpcth_menu_font']['family']);
			$menu_style = $mpcth_options['mpcth_menu_font']['style'] != 'regular' ? ':' . $mpcth_options['mpcth_menu_font']['style'] : '';
			wp_enqueue_style('mpc-menu-font', apply_filters( 'blaszok/font', "$protocol://fonts.googleapis.com/css?family={$menu_family}{$menu_style}" ) );
		}
	}

	if (! is_rtl()){
		wp_enqueue_style('mpc-styles', get_template_directory_uri() . '/style.css');
		
		if ( class_exists( 'WooCommerce' ) ){
			wp_enqueue_style('mpc-woo-styles', get_template_directory_uri() . '/style-woo.css');
		}
	
		if ( class_exists( 'bbPress' ) ){
			wp_enqueue_style('mpc-forum-styles', get_template_directory_uri() . '/style-forum.css');
		}

	}else{
		wp_enqueue_style('mpc-styles', get_template_directory_uri() . '/style-rtl.css');

		if ( class_exists( 'WooCommerce' ) ){
			wp_enqueue_style('mpc-woo-styles', get_template_directory_uri() . '/style-woo-rtl.css');
		}
	
		if ( class_exists( 'bbPress' ) ){
			wp_enqueue_style('mpc-forum-styles', get_template_directory_uri() . '/style-forum-rtl.css');
		}
	}

	if ($mpcth_options['mpcth_theme_skin'] != 'default')
		wp_enqueue_style('mpc-skins-styles', get_template_directory_uri() . '/css/' . $mpcth_options['mpcth_theme_skin'] . '.css');

	wp_enqueue_style('mpc-styles-custom', get_stylesheet_directory_uri() . '/style_custom.css');

	/* Transparent Header */
	$custom_styles = "";
	$enable_transparent_header = get_field('mpc_enable_transparent_header', $page_id);
	if ($enable_transparent_header) {
		$force_simple_buttons = $enable_transparent_header && get_field('mpc_force_simple_buttons', $page_id);
		$background_opacity = $enable_transparent_header ? get_field('mpc_background_opacity', $page_id) : false;
		$force_background_color = $enable_transparent_header ? get_field('mpc_force_background_color', $page_id) : false;
		$force_font_color = $enable_transparent_header ? get_field('mpc_force_font_color', $page_id) : false;
		$sticky_force_background_color = $enable_transparent_header ? get_field('mpc_force_background_color_sticky', $page_id) : false;
		$sticky_force_font_color = $enable_transparent_header ? get_field('mpc_force_font_color_sticky', $page_id) : false;

		$rgba_background = mpcth_hex_to_rgba($force_background_color, $background_opacity / 100);
		$sticky_rgba_background = mpcth_hex_to_rgba($sticky_force_background_color, .95);

		if ($force_font_color !== '')
			$custom_styles .= "
#mpcth_header_second_section #mpcth_page_header_secondary_content,
#mpcth_header_second_section #mpcth_page_header_secondary_content a,
#mpcth_header_second_section,
#mpcth_page_header_wrap #mpcth_header_section,
#mpcth_page_header_wrap #mpcth_header_section a,
#mpcth_page_header_wrap #mpcth_header_section #mpcth_nav a,
#mpcth_page_header_wrap.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a
		{ color: $force_font_color; }

#mpcth_nav .mpcth-menu > .page_item.menu-item-has-children > a:after,
#mpcth_nav .mpcth-menu > .menu-item.menu-item-has-children > a:after,
#mpcth_header_section #mpcth_page_header_content #mpcth_mega_menu .menu-item-has-children > a:after
		{ border-color: $force_font_color; }";

		if ($sticky_force_font_color !== '')
			$custom_styles .= "
.mpcth-sticky-header #mpcth_header_second_section #mpcth_page_header_secondary_content,
.mpcth-sticky-header #mpcth_header_second_section #mpcth_page_header_secondary_content a,
.mpcth-sticky-header #mpcth_header_second_section,
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section,
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section a,
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav .mpcth-menu > li > a,
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section #mpcth_nav .menu > li > a,
#mpcth_page_header_wrap.mpcth-sticky-header.mpcth-simple-buttons-enabled #mpcth_header_section #mpcth_controls_wrap #mpcth_controls_container > a
		{ color: $sticky_force_font_color; }

.mpcth-sticky-header #mpcth_nav .mpcth-menu > .page_item.menu-item-has-children > a:after,
.mpcth-sticky-header #mpcth_nav .mpcth-menu > .menu-item.menu-item-has-children > a:after,
.mpcth-sticky-header #mpcth_header_section #mpcth_page_header_content #mpcth_mega_menu .menu-item-has-children > a:after
		{ border-color: $sticky_force_font_color; }";

		if ($force_background_color !== '')
			$custom_styles .= "
#mpcth_page_header_wrap #mpcth_header_section,
#mpcth_page_header_wrap #mpcth_header_second_section
		{
			background-color: transparent;
			background-color: rgba($rgba_background[0], $rgba_background[1], $rgba_background[2], $rgba_background[3]);
		}";

		if ($sticky_force_background_color !== '')
			$custom_styles .= "
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_section,
#mpcth_page_header_wrap.mpcth-sticky-header:hover #mpcth_header_section,
#mpcth_page_header_wrap.mpcth-sticky-header #mpcth_header_second_section
		{
			background-color: $sticky_force_background_color;
			background-color: rgba($sticky_rgba_background[0], $sticky_rgba_background[1], $sticky_rgba_background[2], $sticky_rgba_background[3]);
		}";

		$custom_styles .= "
#mpcth_page_header_wrap #mpcth_header_second_section,
#mpcth_page_header_wrap #mpcth_header_section
		{ border: none; }";
	}
	/* END - Transparent Header */

	/* Header Image Background */
	$enable_header_background = get_field('mpc_header_enable_image', $page_id);
	if( !$enable_transparent_header && $enable_header_background ) {
			$header_bg_color = get_field('mpc_header_background_color', $page_id);
			$header_image = get_field('mpc_header_image', $page_id);
			$header_image_position = get_field('mpc_header_image_position', $page_id);
			$header_image_repeat = get_field('mpc_header_image_repeat', $page_id);
			$header_image_size = get_field('mpc_header_image_size', $page_id);

			$custom_styles .= '
#mpcth_page_header_wrap #mpcth_header_section
				{ background-color: ' . $header_bg_color . '; ';

			$custom_styles .= $header_image_repeat ? 'background-repeat:' . $header_image_repeat . ';' : '';
			$custom_styles .= $header_image_size ? 'background-size:' . $header_image_size . ';' : '';
			$custom_styles .= $header_image_position ? 'background-position:' . $header_image_position . ';' : '';

			$custom_styles .= 'background-image:url('. $header_image .');}';
	}

	/* Footer Image */
	$enable_footer_background = get_field('mpc_footer_enable_image', $page_id);
	if( !empty( $enable_footer_background ) && $enable_footer_background ) {
			$footer_bg_color = get_field('mpc_footer_background_color', $page_id);
			$footer_image = get_field('mpc_footer_image', $page_id);
			$footer_image_position = get_field('mpc_footer_image_position', $page_id);
			$footer_image_repeat = get_field('mpc_footer_image_repeat', $page_id);
			$footer_image_size = get_field('mpc_footer_image_size', $page_id);

			$custom_styles .= '
#mpcth_footer_section
	{ background-color: ' . $footer_bg_color . '; ';

			$custom_styles .= $footer_image_repeat ? 'background-repeat:' . $footer_image_repeat . ';' : '';
			$custom_styles .= $footer_image_size ? 'background-size:' . $footer_image_size . ';' : '';
			$custom_styles .= $footer_image_position ? 'background-position:' . $footer_image_position . ';' : '';

			$custom_styles .= 'background-image:url('. $footer_image .');}';
	}

	/* Extended Footer Image */
	$enable_footer_ex_background = get_field('mpc_footer_ex_enable_image', $page_id);
	if( !empty( $enable_footer_ex_background ) && $enable_footer_ex_background ) {
			$footer_ex_bg_color = get_field('mpc_footer_ex_background_color', $page_id);
			$footer_ex_image = get_field('mpc_footer_ex_image', $page_id);
			$footer_ex_image_position = get_field('mpc_footer_ex_image_position', $page_id);
			$footer_ex_image_repeat = get_field('mpc_footer_ex_image_repeat', $page_id);
			$footer_ex_image_size = get_field('mpc_footer_ex_image_size', $page_id);

			$custom_styles .= '
#mpcth_footer_extended_section
	{ background-color: ' . $footer_ex_bg_color . '; ';

			$custom_styles .= $footer_ex_image_repeat ? 'background-repeat:' . $footer_ex_image_repeat . ';' : '';
			$custom_styles .= $footer_ex_image_size ? 'background-size:' . $footer_ex_image_size . ';' : '';
			$custom_styles .= $footer_ex_image_position ? 'background-position:' . $footer_ex_image_position . ';' : '';

			$custom_styles .= 'background-image:url('.$footer_ex_image.');}';
	}

	wp_add_inline_style('mpc-styles-custom', $custom_styles);

	wp_enqueue_style('font-awesome', MPC_THEME_URI . '/fonts/font-awesome.css');
	wp_enqueue_style('mpc-theme-plugins-css', MPC_THEME_URI . '/css/plugins.min.css');

	wp_enqueue_script('mpc-theme-plugins-js', MPC_THEME_URI . '/js/plugins.min.js', array('jquery'), '1.0', true);
	wp_enqueue_script('mpc-theme-main-js', MPC_THEME_URI . '/js/main.min.js', array('jquery', 'mpc-theme-plugins-js'), '1.0', true);

	$comment_form_labels = array(
		'field_name' => __('NAME', 'mpcth'),
		'field_email' => __('EMAIL', 'mpcth'),
		'field_url' => __('WEBSITE', 'mpcth'),
		'field_comment' => __('MESSAGE', 'mpcth')
	);
	wp_localize_script('mpc-theme-main-js', 'mpc_cf', $comment_form_labels);

	$countdown_labels = array(
		'label_years' => __('Years', 'mpcth'),
		'label_months' => __('Months', 'mpcth'),
		'label_weeks' => __('Weeks', 'mpcth'),
		'label_days' => __('Days', 'mpcth'),
		'label_hours' => __('Hours', 'mpcth'),
		'label_minutes' => __('Months', 'mpcth'),
		'label_seconds' => __('Seconds', 'mpcth'),
		'label_year' => __('Year', 'mpcth'),
		'label_month' => __('Month', 'mpcth'),
		'label_week' => __('Week', 'mpcth'),
		'label_day' => __('Day', 'mpcth'),
		'label_hour' => __('Hour', 'mpcth'),
		'label_minute' => __('Month', 'mpcth'),
		'label_second' => __('Second', 'mpcth')
	);
	wp_localize_script('mpc-theme-plugins-js', 'mpc_cdl', $countdown_labels);


}

/* ---------------------------------------------------------------- */
/* Add theme options panel
/* ---------------------------------------------------------------- */
if (!function_exists('mpcth_optionsframework_init')) {
	require_once(MPC_THEME_PATH . '/panel/options-framework.php');
	require_once(MPC_THEME_PATH . '/panel/admin-visual-options.php');
}

/* ---------------------------------------------------------------- */
/* Add ACF fallback
/* ---------------------------------------------------------------- */
if (! is_admin() && ! function_exists('get_field')) {
	function get_field($name) {
		return false;
	}
}

/* ---------------------------------------------------------------- */
/* Cache Google Webfonts
/* ---------------------------------------------------------------- */
add_action('wp_ajax_mpcth_cache_google_webfonts', 'mpcth_cache_google_webfonts');
function mpcth_cache_google_webfonts() {
	$google_webfonts = isset($_POST['google_webfonts']) ? $_POST['google_webfonts'] : '';

	if(!empty($google_webfonts)) {
		set_transient('mpcth_google_webfonts', $google_webfonts, DAY_IN_SECONDS);
	}

	die();
}

/* ---------------------------------------------------------------- */
/* Register header area
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_header_area',
		'name' => __('Main Header Area', 'mpcth'),
		'description' => __('This is a standard header area.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title sidebar-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	));
}

/* ---------------------------------------------------------------- */
/* Register main sidebar
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_sidebar',
		'name' => __('Main Sidebar', 'mpcth'),
		'description' => __('This is a standard sidebar.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title sidebar-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	));
}

/* ---------------------------------------------------------------- */
/* Register main menu area
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_main_menu',
		'name' => __('Main Menu', 'mpcth'),
		'description' => __('This is a mega menu.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title sidebar-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	));
}

/* ---------------------------------------------------------------- */
/* Register smart search area
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_smart_search',
		'name' => __('Smart Search', 'mpcth'),
		'description' => __('This is a smart search.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="mpcth-smart-search-field %2$s">',
		'after_widget' => '</li>',
		'before_title' => '',
		'after_title' => ''
	));
}

/* ---------------------------------------------------------------- */
/* Register main footer
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_footer',
		'name'=> __('Main Footer', 'mpcth'),
		'description' => __('This is a standard footer.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title footer-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	));
}

/* ---------------------------------------------------------------- */
/* Register additional footer
/* ---------------------------------------------------------------- */
if(function_exists('register_sidebar')) {
	register_sidebar(array(
		'id' => 'mpcth_footer_extended',
		'name'=> __('Extended Footer', 'mpcth'),
		'description' => __('This is an extended footer.', 'mpcth'),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h5 class="widget-title footer-widget-title"><span class="mpcth-color-main-border">',
		'after_title' => '</span></h5>'
	));
}

/* ---------------------------------------------------------------- */
/* Register main menu
/* ---------------------------------------------------------------- */
if (function_exists('register_nav_menus')) {
	register_nav_menus(array(
		'mpcth_menu' => __('Main Navigation Menu', 'mpcth'),
		'mpcth_mobile_menu' => __('Mobile Navigation Menu', 'mpcth'),
	));

	if (isset($mpcth_options['mpcth_header_secondary_enable_menu']) && $mpcth_options['mpcth_header_secondary_enable_menu'])
		register_nav_menus(array(
			'mpcth_secondary_menu' => __('Secondary Navigation Menu', 'mpcth'),
		));

	if (isset($mpcth_options['mpcth_copyright_enable_menu']) && $mpcth_options['mpcth_copyright_enable_menu'])
		register_nav_menus(array(
			'mpcth_copyright_menu' => __('Copyright Menu', 'mpcth'),
		));
}

/* ---------------------------------------------------------------- */
/* Get sidebar position
/* ---------------------------------------------------------------- */
function mpcth_get_sidebar_position() {
	global $page_id;
	global $mpcth_options;

	if (! empty($_GET['sidebar-pos'])) {
		if ($_GET['sidebar-pos'] == 'left')
			return 'left';
		elseif ($_GET['sidebar-pos'] == 'right')
			return 'right';
		elseif ($_GET['sidebar-pos'] == 'none')
			return 'none';
	}

	$post_type = '';

	if ($page_id != 0) {
		$post_type = get_post_type($page_id);
		$post_meta = get_post_meta($page_id);
	}

	$enable_custom_sidebar_position = get_field('mpc_custom_sidebar_position', $page_id);
	$custom_sidebar_position = get_field('mpc_sidebar_position', $page_id);

	$sidebar_position = $mpcth_options['mpcth_default_sidebar'];
	if (is_search()) {
		$sidebar_position = $mpcth_options['mpcth_search_sidebar'];
	} elseif (is_archive()) {
		$sidebar_position = $mpcth_options['mpcth_archive_sidebar'];

		if (function_exists('is_woocommerce') && is_woocommerce() && $enable_custom_sidebar_position)
			$sidebar_position = $custom_sidebar_position;

		if (function_exists('is_woocommerce') && is_product_taxonomy()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$term_sidebar_position = get_field('mpc_sidebar_position', $term);

			if ($term_sidebar_position !== false && $term_sidebar_position != 'default')
				$sidebar_position = $term_sidebar_position;
		}
	} elseif (is_404()) {
		$sidebar_position = $mpcth_options['mpcth_error_sidebar'];
	} elseif ($enable_custom_sidebar_position) {
		$sidebar_position = $custom_sidebar_position;
	} elseif (is_single()) {
		if ($post_type == 'post')
			$sidebar_position = $mpcth_options['mpcth_blog_post_sidebar'];
		elseif ($post_type == 'mpc_portfolio' && isset($mpcth_options['mpcth_portfolio_post_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_portfolio_post_sidebar'];
	}

	if (isset($post_meta['_wp_page_template'][0]) && ($post_meta['_wp_page_template'][0] == 'template-lookbook.php' || $post_meta['_wp_page_template'][0] == 'template-fullwidth.php'))
			$sidebar_position = 'none';

	if (class_exists('bbPress') && is_bbpress()) {
		if (isset($mpcth_options['mpcth_forum_sidebar']))
			$sidebar_position = $mpcth_options['mpcth_forum_sidebar'];
		else
			$sidebar_position = 'none';
	}

	return $sidebar_position;
}

/* ---------------------------------------------------------------- */
/* Add social list
/* ---------------------------------------------------------------- */
function mpcth_display_social_list() {
	global $mpcth_options;

	$target = '';
	if (! empty($mpcth_options['mpcth_socials_target']))
		$target = 'target="_blank"';

	if (! empty($mpcth_options['mpcth_socials']))
		foreach($mpcth_options['mpcth_socials'] as $name => $enable) {
			if($enable) {
				$prefix = '';
				if ($name == 'envelope') $prefix = 'mailto:';
				if ($name == 'skype') $prefix = 'skype:';

				echo '<li>';
					echo '<a target="_blank" href="' . ($prefix != '' ? $prefix . $mpcth_options['mpcth_social_' . $name] : esc_url($mpcth_options['mpcth_social_' . $name])) . '" class="mpcth-social-' . $name . '" ' . $target . '>';
						echo '<i class="fa fa-' . $name . '"></i>';
					echo '</a>';
				echo '</li>';
			}
		}
}

/* ---------------------------------------------------------------- */
/* Single comment template
/* ---------------------------------------------------------------- */
function mpcth_single_comment_template($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $post;
	extract($args, EXTR_SKIP);

	$is_post_author = '';
	if(get_comment_author_email() == get_the_author_meta('email'))
		$is_post_author = "mpcth-post-author";

	?>

	<li <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">

	<?php if ($comment->comment_type == 'pingback' || $comment->comment_type == 'trackback') { ?>
		<?php _e('Pingback:', 'mpcth'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(__('[Edit]', 'mpcth'), '<span class="mpcth-edit-link">', '</span>' ); ?>
	<?php } else { ?>
		<article class="mpcth-comment">
			<div class="mpcth-comment-header">
				<div class="mpcth-comment-avatar-wrap">
					<?php echo get_avatar($comment, $avatar_size); ?>
				</div>
				<span class="mpcth-comment-author <?php echo $is_post_author; ?>">
					<?php comment_author_link(); ?>
				</span>
				<a href="<?php echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>" class="mpcth-comment-permalink">
					<time class="mpcth-comment-date" datetime="<?php comment_time('c'); ?>">
						<span>- </span><?php comment_date(); ?><span> <?php _e('at', 'mpcth'); ?> </span><?php comment_time(); ?>
					</time>
				</a>
				<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $max_depth, 'reply_text' => '<i class="fa fa-reply"></i>'))); ?>
				<?php edit_comment_link('<i class="fa fa-pencil"></i>'); ?>
			</div>
			<section class="mpcth-comment-content">
				<?php comment_text(); ?>
			</section>
			<div class="mpcth-comment-footer">
				<?php if (! $comment->comment_approved) { ?>
					<p class="mpcth-comment-not-approved"><?php _e('Your comment is awaiting moderation.', 'mpcth'); ?></p>
				<?php } ?>
			</div>
		</article><!-- #comment-## -->
	<?php }
}

/* ---------------------------------------------------------------- */
/* Display pagination
/* ---------------------------------------------------------------- */
function mpcth_display_pagination($query = '') {
	global $paged;

	if(empty($query)) {
		global $wp_query;
		$query = $wp_query;
	}

	echo paginate_links(array(
		'base' => str_replace(999999, '%#%', esc_url(get_pagenum_link(999999))),
		'current' => max(1, $paged),
		'prev_text' => '<i class="fa fa-angle-' . (is_rtl() ? 'right' : 'left') . '"></i>',
		'next_text' => '<i class="fa fa-angle-' . (is_rtl() ? 'left' : 'right') . '"></i>',
		'total' => $query->max_num_pages
	));
}

/* ---------------------------------------------------------------- */
/* Display load more
/* ---------------------------------------------------------------- */
function mpcth_display_load_more($query) {
	if ($query->max_num_pages <= 1)
		return;
	?>
	<a href="#" id="mpcth_load_more" class="mpcth-color-main-background-hover"><?php _e('Load more', 'mpcth'); ?><span class="mpcth-load-more-icon"></span></a>
	<?php
		echo paginate_links(array(
			'base' 			=> str_replace(999999, '%#%', get_pagenum_link(999999)),
			'format' 		=> '',
			'current' 		=> max(1, get_query_var('paged')),
			'total' 		=> $query->max_num_pages,
			'prev_text' 	=> '',
			'next_text' 	=> '',
			'type'			=> 'list',
			'end_size'		=> 1,
			'mid_size'		=> 1
		));
	?>
	<div id="mpcth_load_more_wrapper" data-max-pages="<?php echo $query->max_num_pages; ?>"></div>
	<?php
}

/* ---------------------------------------------------------------- */
/* Add lightbox
/* ---------------------------------------------------------------- */
function mpcth_add_lightbox() {
	$lightbox_enabled = get_field('mpc_enable_lightbox');
	$lightbox_type = get_field('mpc_lightbox_type');
	$lightbox_source = get_field('mpc_lightbox_source');
	$lightbox_source_url = get_field('mpc_lightbox_source_url');
	$lightbox_caption = get_field('mpc_lightbox_caption');

	if ($lightbox_enabled && $lightbox_type == 'image' && !empty($lightbox_source)) {
		echo '<a class="mpcth-lightbox mpcth-lightbox-type-image" href="' . $lightbox_source['url'] . '" title="' . $lightbox_source['caption'] . '"><i class="fa fa-expand"></i></a>';
	} elseif ($lightbox_enabled && $lightbox_type == 'iframe' && !empty($lightbox_source_url)) {
		$lightbox_caption = !empty($lightbox_caption) ? $lightbox_caption : '';
		$src_type = strtolower($lightbox_source_url);
		$search = preg_match('/.(jpg|jpeg|gif|png|bmp)/', $src_type);

		$type = 'iframe';
		if($search == 1)
			$type = 'image';

		$force_type = '';
		if($type == 'iframe')
			$force_type = ' mfp-iframe';

		echo '<a class="mpcth-lightbox mpcth-lightbox-type-' . $type . $force_type . '" href="' . $lightbox_source_url . '" title="' . $lightbox_caption . '"><i class="fa fa-expand"></i></a>';
	}
}

/* ---------------------------------------------------------------- */
/* Add secondary menu
/* ---------------------------------------------------------------- */
function mpcth_display_secondary_menu() {
	global $yith_wcwl;

	echo '<div id="mpcth_secondary_menu">';
		echo '<span class="mpcth-language">';
			do_action('icl_language_selector');
		echo '</span>';
		echo '<span class="mpcth-currency">';
			do_action('currency_switcher');
		echo '</span>';

		if (! empty($yith_wcwl)) {
			// echo '<span class="mpcth-menu-divider"></span>';
			$wishlist_name = get_option('yith_wcwl_wishlist_title');
			echo '<a href="' . $yith_wcwl->get_wishlist_url( "" ) . '" class="mpcth-wc-wishlist">' . $wishlist_name . '</a>';
		}

		if (class_exists('WooCommerce'))
			if (! is_user_logged_in() && get_option('woocommerce_myaccount_page_id') !== false) {
				echo '<a href="' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" class="mpcth-wp-login">' . __('Login', 'mpcth') . '</a>';
			} else {
				echo '<a href="' . get_permalink(get_option('woocommerce_myaccount_page_id')) . '" class="mpcth-wp-login">' . __('My Account', 'mpcth') . '</a>';
			}

		if(has_nav_menu('mpcth_secondary_menu'))
			wp_nav_menu(array(
				'theme_location' => 'mpcth_secondary_menu',
				'container' => '',
				'menu_id' => 'mpcth_secondary_mini_menu',
				'menu_class' => 'mpcth-secondary-mini-menu'
			));
	echo '</div>';
}

add_filter('woocommerce_product_description_tab_title', 'my_product_description_tab_title');
function my_product_description_tab_title($default) {
	global $mpcth_options;

	if (isset($mpcth_options['mpcth_tab_description_label']) && $mpcth_options['mpcth_tab_description_label'] != '')
		$default = $mpcth_options['mpcth_tab_description_label'];

	echo $default;
}

add_filter('woocommerce_product_additional_information_tab_title', 'my_product_additional_information_tab_title');
function my_product_additional_information_tab_title($default) {
	global $mpcth_options;

	if (isset($mpcth_options['mpcth_tab_additional_information_label']) && $mpcth_options['mpcth_tab_additional_information_label'] != '')
		$default = $mpcth_options['mpcth_tab_additional_information_label'];

	echo $default;
}

/* ---------------------------------------------------------------- */
/* Add secondary newsletter
/* ---------------------------------------------------------------- */
function mpcth_display_newsletter() {
	global $mpcth_options;

	$enable_subscribe = true;
	if (isset($mpcth_options['mpcth_header_secondary_enable_subscribe']) && ! $mpcth_options['mpcth_header_secondary_enable_subscribe'])
		$enable_subscribe = false;

	if ($enable_subscribe) {
		$message = '';
		if (isset($mpcth_options['mpcth_header_secondary_message']) && $mpcth_options['mpcth_header_secondary_message'])
			$message = $mpcth_options['mpcth_header_secondary_message'];

		if ($message) {
			echo '<div id="mpcth_newsletter">';
				echo '<span class="mpcth-newsletter-message">';
					echo $message;
				echo '</span>';
			echo '</div>';
		} elseif (shortcode_exists('subscribe2') || shortcode_exists('mc4wp_form')) {
			echo '<div id="mpcth_newsletter">';
				echo '<a href="#" class="mpcth-newsletter-toggle">';
					if(isset($mpcth_options['mpcth_newsletter_text']))
						echo $mpcth_options['mpcth_newsletter_text'];
					else
						_e('Sign up for our newsletter', 'mpcth');
				echo '</a>';

				if (shortcode_exists('subscribe2'))
					echo do_shortcode('[subscribe2]');
				else
					echo do_shortcode('[mc4wp_form]');
			echo '</div>';
		}
	}
}

/* ---------------------------------------------------------------- */
/* Add secondary header
/* ---------------------------------------------------------------- */
function mpcth_display_secondary_header() {
	global $mpcth_options;

	$header_order = 'n_s_m';
	if ($mpcth_options['mpcth_header_secondary_layout'])
		$header_order = $mpcth_options['mpcth_header_secondary_layout'];

	echo '<div id="mpcth_page_header_secondary_content" class="mpcth-header-order-' . $header_order . ' mpcth-header-position-' . $mpcth_options['mpcth_header_secondary_position'] . '">';
		if ($header_order == 'n_s_m') {
			mpcth_display_newsletter();
			mpcth_display_secondary_menu();
			echo '<ul id="mpcth_header_socials" class="mpcth-socials-list">';
				mpcth_display_social_list();
			echo '</ul>';
		} elseif ($header_order == 's_m_n') {
			echo '<ul id="mpcth_header_socials" class="mpcth-socials-list">';
				mpcth_display_social_list();
			echo '</ul>';
			mpcth_display_newsletter();
			mpcth_display_secondary_menu();
		} elseif ($header_order == 'm_n_s') {
			mpcth_display_secondary_menu();
			mpcth_display_newsletter();
			echo '<ul id="mpcth_header_socials" class="mpcth-socials-list">';
				mpcth_display_social_list();
			echo '</ul>';
		}
	echo '</div>';
}

/* ---------------------------------------------------------------- */
/* Add post meta
/* ---------------------------------------------------------------- */
function mpcth_add_meta( $id = '') {
	$id = $id == '' ? get_the_ID() : $id;
	echo '<span class="mpcth-date"><span class="mpcth-static-text">' . __('Posted on', 'mpcth') . ' </span><a href="' . get_month_link(get_the_time('Y',$id), get_the_time('m',$id)) . '"><time datetime="' . get_the_time(get_option('date_format'),$id) . '">' . get_the_time(get_option('date_format'),$id) . '</time></a></span>';
	echo '<span class="mpcth-author"><span class="mpcth-static-text">' . __(' by', 'mpcth') . ' </span><a href="' . get_author_posts_url( get_the_author_meta( 'ID') ) . '">' . get_the_author() . '</a></span>';

	if (get_post_type() == 'mpc_portfolio')
		$categories = get_the_term_list(get_the_ID(), 'mpc_portfolio_cat', '', ', ', '');
	else
		$categories = get_the_category_list(__(', ', 'mpcth'));

	if ($categories)
		echo '<span class="mpcth-categories"><span class="mpcth-static-text"> ' . __('in', 'mpcth') . ' </span>' . $categories . '</span>';

	if(comments_open()) {
		echo '<span class="mpcth-comments"><a href="' . get_comments_link($id) . '" title="' . esc_attr(__( 'View post comments', 'mpcth')) . '" rel="comments">';
			comments_number(__('0 comments', 'mpcth'), __('1 comment', 'mpcth') , __('% comments', 'mpcth'));
		echo '</a></span>';
	}
}

/* ---------------------------------------------------------------- */
/* Excerpt
/* ---------------------------------------------------------------- */
function mpcth_excerpt_ending($more) {
	return '...';
}
add_filter('excerpt_more', 'mpcth_excerpt_ending');

/* ---------------------------------------------------------------- */
/* ACF theme fields
/* ---------------------------------------------------------------- */
if( file_exists( get_stylesheet_directory() . '/autoimport/custom_metaboxes.php' ) ) {
    require_once get_stylesheet_directory() . '/autoimport/custom_metaboxes.php';
}else{
    require_once MPC_THEME_PATH . '/autoimport/custom_metaboxes.php';
}

/* ---------------------------------------------------------------- */
/* Install required plugins
/* ---------------------------------------------------------------- */
require_once(MPC_THEME_PATH . '/php/class-tgm-plugin-activation.php');

require_once(MPC_THEME_PATH . '/php/mpc-bundle-plugins.php');

/* ---------------------------------------------------------------- */
/* Breadcrumbs
/* ---------------------------------------------------------------- */
require_once(MPC_THEME_PATH . '/php/mpc-breadcrumbs.php');

/* ---------------------------------------------------------------- */
/* Activation theme
/* ---------------------------------------------------------------- */
add_action('after_switch_theme', 'mpcth_theme_activation', 10 , 2);
//add_action('admin_init', 'mpcth_theme_activation', 1 , 2);
function mpcth_theme_activation($old_name, $old_theme = false) {
	global $mpcth_options;

	if( !isset( $mpcth_options ) || empty( $mpcth_options ) || !$mpcth_options ) {
		mpcth_optionsframework_setdefaults();
	}
}


/* ---------------------------------------------------------------- */
/* Fix for 404 on custom post types
/* ---------------------------------------------------------------- */
add_action('after_switch_theme', 'mpcth_flush_rewrite_rules');
function mpcth_flush_rewrite_rules() {
	flush_rewrite_rules();
}

/* ---------------------------------------------------------------- */
/* bbPress
/* ---------------------------------------------------------------- */

// add_filter('bbp_register_forum_post_type', 'mpcth_bbp_register_post_type');
// add_filter('bbp_register_topic_post_type', 'mpcth_bbp_register_post_type');
// add_filter('bbp_register_reply_post_type', 'mpcth_bbp_register_post_type');
// function mpcth_bbp_register_post_type($args) {
// 	$args['menu_position'] = 60;

// 	return $args;
// }

add_filter('bbp_topic_pagination', 'mpcth_bbp_change_pagination_arrows');
add_filter('bbp_search_results_pagination', 'mpcth_bbp_change_pagination_arrows');
add_filter('bbp_replies_pagination', 'mpcth_bbp_change_pagination_arrows');
function mpcth_bbp_change_pagination_arrows($args) {
	$args['prev_text'] = '<i class="fa fa-angle-' . (is_rtl() ? 'right' : 'left') . '"></i>';
	$args['next_text'] = '<i class="fa fa-angle-' . (is_rtl() ? 'left' : 'right') . '"></i>';

	return $args;
}

add_filter('bbp_before_get_breadcrumb_parse_args', 'mpcth_bbp_change_separator_arrows', 1);
function mpcth_bbp_change_separator_arrows($args) {
	$args['sep'] = '<i class="fa fa-angle-' . (is_rtl() ? 'left' : 'right') . '"></i>';

	return apply_filters('bbpsswap_filter_breadcrumb_sep', $args);
}

add_action('bbp_theme_before_topic_form_tags', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_topic_form_forum', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_topic_form_type', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_topic_form_status', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_topic_form_revisions', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_reply_form_tags', 'mpcth_bbp_open_form_section_wrapper');
add_action('bbp_theme_before_reply_form_revisions', 'mpcth_bbp_open_form_section_wrapper');
function mpcth_bbp_open_form_section_wrapper() {
	echo '<div class="mpcth-bbp-form-section">';
}

add_action('bbp_theme_after_topic_form_tags', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_topic_form_forum', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_topic_form_type', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_topic_form_status', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_topic_form_revisions', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_reply_form_tags', 'mpcth_bbp_close_form_section_wrapper');
add_action('bbp_theme_after_reply_form_revisions', 'mpcth_bbp_close_form_section_wrapper');
function mpcth_bbp_close_form_section_wrapper() {
	echo '</div>';
}

add_action('bbp_theme_before_topic_form_subscriptions', 'mpcth_bbp_open_form_subscriptions_wrapper');
add_action('bbp_theme_before_reply_form_subscription', 'mpcth_bbp_open_form_subscriptions_wrapper');
function mpcth_bbp_open_form_subscriptions_wrapper() {
	echo '<div class="mpcth-bbp-form-subscriptions">';
}

add_action('bbp_theme_after_topic_form_subscriptions', 'mpcth_bbp_close_form_subscriptions_wrapper');
add_action('bbp_theme_after_reply_form_subscription', 'mpcth_bbp_close_form_subscriptions_wrapper');
function mpcth_bbp_close_form_subscriptions_wrapper() {
	echo '</div>';
}

add_action('bbp_theme_before_topic_form_title', 'mpcth_bbp_open_form_title_wrapper');
function mpcth_bbp_open_form_title_wrapper() {
	echo '<div class="mpcth-bbp-form-title">';
}

add_action('bbp_theme_after_topic_form_title', 'mpcth_bbp_close_form_title_wrapper');
function mpcth_bbp_close_form_title_wrapper() {
	echo '</div>';
}

add_filter('bbp_get_single_forum_description', 'mpcth_bbp_blank_notice');
add_filter('bbp_get_single_topic_description', 'mpcth_bbp_blank_notice');
function mpcth_bbp_blank_notice() {
	return '';
}

/* ---------------------------------------------------------------- */
/* WooCommerce
/* ---------------------------------------------------------------- */

// Disable default wrappers
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
// Enable Theme wrappers
add_action('woocommerce_before_main_content', 'mpcth_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'mpcth_theme_wrapper_end', 10);

function mpcth_theme_wrapper_start() {
	global $mpcth_options;
	global $sidebar_position;
	global $shop_style;

	if (! empty($_GET['product_style'])) {
		if ($_GET['product_style'] == 1)
			$shop_style = 'default';
		elseif ($_GET['product_style'] == 2)
			$shop_style = 'slim';
		elseif ($_GET['product_style'] == 3)
			$shop_style = 'center';
	} elseif (! empty($_GET['product-style'])) {
		if ($_GET['product-style'] == 1)
			$shop_style = 'default';
		elseif ($_GET['product-style'] == 2)
			$shop_style = 'slim';
		elseif ($_GET['product-style'] == 3)
			$shop_style = 'center';
	} else {
		$shop_style = 'default';
		if (isset($mpcth_options['mpcth_shop_style']) && $mpcth_options['mpcth_shop_style'])
			$shop_style = $mpcth_options['mpcth_shop_style'];
	}

	if (! is_shop() && !is_product_taxonomy())
		$shop_style = 'default';

	if ($sidebar_position == 'none')
		$columns = 4;
	else
		$columns = 3;

	if ($shop_style == 'default' && isset($mpcth_options['mpcth_shop_columns_def']) && $mpcth_options['mpcth_shop_columns_def'])
		$columns = $mpcth_options['mpcth_shop_columns_def'];
	elseif ($shop_style != 'default' && isset($mpcth_options['mpcth_shop_columns_ext']) && $mpcth_options['mpcth_shop_columns_ext'])
		$columns = $mpcth_options['mpcth_shop_columns_ext'];

	if (! is_shop() && !is_product_taxonomy())
		$columns = '';
	else
		$columns = ' mpcth-shop-columns-' . $columns;

	echo '<div id="mpcth_main">';
		if (is_shop()) {
			$shop_id = get_option('woocommerce_shop_page_id');
			$header_content = get_field('mpc_header_content', $shop_id);

			echo '<div class="mpcth-page-custom-header">';
				echo do_shortcode($header_content);
			echo '</div>';
		} else {
			mpcth_print_category_header();
		}
		echo '<div id="mpcth_main_container">';
			get_sidebar();
			echo '<div id="mpcth_content_wrap">';
				echo '<div id="mpcth_content" class="mpcth-shop-style-' . $shop_style . $columns . '">';
}

function mpcth_theme_wrapper_end() {
				echo '</div><!-- end #mpcth_content -->';
			echo '</div><!-- end #mpcth_content_wrap -->';
		echo '</div><!-- end #mpcth_main_container -->';
	echo '</div><!-- end #mpcth_main -->';
}

function mpcth_print_category_header() {
	if (function_exists('is_woocommerce') && is_product_taxonomy()) {
		$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
		$header_content_type = get_field('mpc_header_content_type', $term);
		$custom_header = get_field('mpc_custom_header', $term);
		$image_header = get_field('mpc_image_header', $term);

		if ($header_content_type !== false && $header_content_type != 'none') {
			if ($header_content_type == 'image')
				echo '<img class="mpcth-category-header-image" width="' . $image_header['width'] . '" height="' . $image_header['height'] . '" alt="' . $image_header['alt'] . '" title="' . $image_header['title'] . '" src="' . $image_header['url'] . '" />';
			else
				echo '<div class="mpcth-category-header-custom">' . $custom_header . '</div>';
		}
	}
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action( 'woocommerce_before_shop_loop_item_title', 'mpcth_sold_out_badge' );
add_action( 'woocommerce_product_thumbnails', 'mpcth_sold_out_badge' );

function mpcth_sold_out_badge() {
	global $product;
	if ( !$product->is_in_stock() ) {
		echo '<div class="mpcth-sale-wrap sold"><span class="onsale sold">' . __( 'Sold Out', 'mpcth' ) . '</span></div>';
	}
};

// Loop product title
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// Single product summary
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
// remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );

// From price
add_filter('woocommerce_variable_price_html', 'mpcth_custom_price', 10);
add_filter('woocommerce_grouped_price_html', 'mpcth_custom_price', 10);
// add_filter('woocommerce_variable_sale_price_html', 'mpcth_custom_price', 10);

// WooCommerce Social Login
if( function_exists( 'woocommerce_social_login_buttons' ) ) {
	add_action( 'login_form', 'mpcth_social_login' );
	add_action( 'register_form', 'mpcth_social_login' );
	add_action( 'comment_form_must_log_in_after', 'mpcth_social_login' );
	function mpcth_social_login() {
		// Displays login buttons to non-logged in users + redirect back to login
		woocommerce_social_login_buttons();
	}
}

function mpcth_custom_price($price){
	$prices = explode('&ndash;', $price);

	if (count($prices) == 2)
		return '<span class="mpcth-from-price">' . __('From: ', 'mpcth') . '</span>' . $prices[0];
	else
		return $price;
}

add_action('mpcth_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('mpcth_before_shop_loop_item_title', 'mpcth_wc_second_product_image', 20);

function mpcth_wc_second_product_image() {
	global $product, $mpcth_options;

	// Check for second image
	$product_gallery = $product->get_gallery_attachment_ids();

	$disable_hover_slide = get_field('mpc_disable_hover_slide');
	$custom_hover_image = get_field('mpc_custom_hover_image');
	$display_second_image = false;

	if (!$disable_hover_slide && (! empty($product_gallery) || $custom_hover_image))
		$display_second_image = true;

	if (! empty($mpcth_options['mpcth_disable_product_hover']) && $mpcth_options['mpcth_disable_product_hover'])
		$display_second_image = false;


	if ( $display_second_image ) {
		if ($custom_hover_image) {
			echo '<img width="' . $custom_hover_image['sizes']['shop_catalog-width'] . '" height="' . $custom_hover_image['sizes']['shop_catalog-height'] . '" src="' . $custom_hover_image['sizes']['shop_catalog'] . '" class="attachment-shop_catalog mpcth-second-thumbnail" alt="' . $custom_hover_image['title'] . '">';
		} else {
			$thumbs = $product->get_gallery_attachment_ids();

			if (! empty($thumbs)) {
				$attr = array('class' => "attachment-shop_catalog mpcth-second-thumbnail");

				echo wp_get_attachment_image($thumbs[0], 'shop_catalog', false, $attr);
			}
		}
	}
}

function mpcth_wc_product_categories() {
	global $product;

	echo '<div class="mpcth-post-categories">';
	echo get_the_term_list($product->ID, 'product_cat', '', ', ', '');
	echo '</div>';
}

add_action('mpcth_before_shop_loop', 'woocommerce_breadcrumb', 10 );
add_action('mpcth_before_shop_loop', 'woocommerce_result_count', 20);
add_action('mpcth_before_shop_loop', 'mpcth_wc_products_per_page', 30);
add_action('mpcth_before_shop_loop', 'woocommerce_catalog_ordering', 40);

/* Breadcrumbs setup */
add_filter( 'woocommerce_breadcrumb_home_url', 'mpc_custom_breadrumb_home_url' );
function mpc_custom_breadrumb_home_url() {
	$shop_page_id = wc_get_page_id( 'shop' );
	$frontpage_id = get_option('page_on_front');

	if( $shop_page_id != $frontpage_id ) {
		return get_permalink( wc_get_page_id( 'shop' ) );
	}

	return home_url();
}
add_filter( 'woocommerce_breadcrumb_defaults', 'mpc_change_breadcrumb_home_text' );
function mpc_change_breadcrumb_home_text( $defaults ) {
	global $post;
	$shop_page_id = wc_get_page_id( 'shop' );
	$frontpage_id = get_option('page_on_front');

	if( $shop_page_id != $frontpage_id ) {
		$defaults['home'] = _x( 'Shop', 'woo_breadcrumbs', 'mpcth' );
	}
	
	$current_page_id = $post->ID;
	if ( is_product( $current_page_id ) ) {
		$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
	}
	
	return $defaults;
}

function mpcth_wc_products_per_page() {
    global $mpcth_options, $wp_rewrite;     // Added $wp_rewrite
    // global $sidebar_position;

    $number = 9;

    if (isset($mpcth_options['mpcth_products_number']) && $mpcth_options['mpcth_products_number'])
        $number = $mpcth_options['mpcth_products_number'];

    // if ($sidebar_position == 'none' && $number % 2 !== 0)
    // 	$number -= 1;

    $protocol = is_ssl() ? 'https://' : 'http://';
    $host = $_SERVER["HTTP_HOST"];
    $request_uri = $_SERVER["REQUEST_URI"];
    $query_string = $_SERVER["QUERY_STRING"];

    $pagination_base = $wp_rewrite->pagination_base;            // Get pagination slug
    $paged = get_query_var( 'paged', 1 );                       // Get current page number (0 if on 1st page)
    $needle = '';

    $current_per_page = $number;                                    // Start with default products per page
    if(isset($_GET['products_per_page'])) {
        $current_per_page = absint($_GET['products_per_page']);     // Adjust if needed
    }

    if(absint($paged)>0) {
        $needle = $pagination_base . "/" . $paged;              // Construct the string we're searching for
        $request_uri = str_replace($needle, '', $request_uri);  // Remove the pagination stuff
        $request_uri = str_replace('//', '/', $request_uri);    // Make sure we do not leave double slashes in uri
    }

    $url = '';
    $after_url = '';
    if (empty($query_string)) {
        $url = $protocol . $host . $request_uri . '?products_per_page=';
    } elseif (strpos($query_string, 'products_per_page') === false) {
        $url = $protocol . $host . $request_uri . '&products_per_page=';
    } else {
        $parts = explode('products_per_page=' . $_GET['products_per_page'], $request_uri);

        $url = $protocol . $host . $parts[0] . 'products_per_page=';
        $after_url = $parts[1];
    }

    // Show or hide certain choices
    $double = $number * 2;
    $quadruple = $number * 4;
    echo '<p class="mpcth-products-per-page">';
    echo'<span>' . __('View', 'mpcth') . ': </span>';
    if($current_per_page != $number)
        echo '<a href="' . $url . $number . $after_url . '">' . $number . '</a> / ';
    if($current_per_page != $double)
        echo '<a href="' . $url . $double . $after_url . '">' . $double . '</a> / ';
    if($current_per_page != $quadruple)
        echo '<a href="' . $url . $quadruple . $after_url . '">' . $quadruple . '</a> / ';
    echo '<a href="' . $url . 'all' . $after_url . '">' . __('All', 'mpcth') . '</a>';
    echo '</p>';
}

add_filter('woocommerce_product_tabs', 'mpcth_custom_product_tabs');
function mpcth_custom_product_tabs($tabs) {
	$custom_tabs = get_field('mpc_custom_tab');

	if (! empty($custom_tabs)) {

		foreach ($custom_tabs as $index => $custom_tab) {
			$tabs['custom_tab_' . str_replace( '%', '', sanitize_title( $custom_tab['mpc_custom_tab_title'] ) )] = array(
				'title' 	=> $custom_tab['mpc_custom_tab_title'],
				'priority' 	=> (int) $custom_tab['mpc_custom_tab_priority'],
				'callback' 	=> 'mpcth_print_custom_product_tabs',
				'index' 	=> $index
			);

		}
	}

	return $tabs;
}
function mpcth_print_custom_product_tabs($title, $atts) {
	// global $product;
	$custom_tabs = get_field('mpc_custom_tab');
	$index = $atts['index'];

	echo $custom_tabs[$index]['mpc_custom_tab_content'];
}

add_filter('add_to_cart_fragments', 'mpcth_wc_ajaxify_mini_cart_icon');
function mpcth_wc_ajaxify_mini_cart_icon($fragments) {
	global $mpcth_options;

	if (isset($mpcth_options['mpcth_subtotal_text'])) $subtotal = $mpcth_options['mpcth_subtotal_text'];
	else $subtotal = __('Subtotal:', 'mpcth');

	ob_start();

	?>
	<span class="mpcth-mini-cart-icon-info">
		<?php if (sizeof( WC()->cart->get_cart()) > 0) { ?>
			<span class="mpcth-mini-cart-subtotal"><?php echo $subtotal; ?> </span><?php echo WC()->cart->get_cart_subtotal(); ?> (<?php echo WC()->cart->cart_contents_count; ?>)
		<?php } ?>
	</span>

	<?php

	$fragments['span.mpcth-mini-cart-icon-info'] = ob_get_clean();
	$fragments['span.mpcth-mini-cart-icon-info'] = apply_filters( 'blaszok/cart/mini/subtotal', $fragments['span.mpcth-mini-cart-icon-info'] );

	return $fragments;
}

add_filter('add_to_cart_fragments', 'mpcth_wc_ajaxify_mini_cart');
function mpcth_wc_ajaxify_mini_cart($fragments) {
	ob_start();

	mpcth_wc_print_mini_cart();

	$fragments['div#mpcth_mini_cart_wrap'] = ob_get_clean();
	$fragments['div#mpcth_mini_cart_wrap'] = apply_filters( 'blaszok/cart/mini', $fragments['div#mpcth_mini_cart_wrap'] );

	return $fragments;
}

function mpcth_wc_print_mini_cart() {
	if (function_exists('is_woocommerce')) {
	?>
	<div id="mpcth_mini_cart_wrap">
		<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
			<ul class="mpcth-mini-cart-products">
				<?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) :
					$_product = $cart_item['data'];

					// Only display if allowed
					if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )
						continue;

					// Get variations
					$variations_data = '';
					if( !empty( $_product->variation_id ) )
						$variations_data = WC()->cart->get_item_data( $cart_item, true );

					// Get price
					$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key );
					?>

					<li class="mpcth-mini-cart-product">
						<span class="mpcth-mini-cart-thumbnail">
							<?php echo $_product->get_image(); ?>
							<?php echo apply_filters( 'woocommerce_cart_item_remove_link', '<a href="' . esc_url( WC()->cart->get_remove_url( $cart_item_key ) ) . '" class="mpcth-mini-cart-remove mpcth-color-main-color" title="' . __( 'Remove this item', 'woocommerce' ) . '">&times;</a>', $cart_item_key ); ?>
						</span>
						<span class="mpcth-mini-cart-info">
							<a class="mpcth-mini-cart-title" href="<?php echo get_permalink( $cart_item['product_id'] ); ?>">
								<?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?>
							</a>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_price', '<span class="mpcth-mini-cart-price">' . __('Unit Price', 'mpcth') . ': ' . $product_price . '</span>', $cart_item, $cart_item_key ); ?>
							<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="mpcth-mini-cart-quantity">' . __('Quantity', 'mpcth') . ': ' . $cart_item['quantity'] . '</span>', $cart_item, $cart_item_key ); ?>
							<?php
							if( !empty( $variations_data ) ) {
								echo '<span class="mpcth-mini-cart-variations">' . __('Variation', 'mpcth') . ': ' . $variations_data . '</span>';
							} ?>
						</span>
					</li>

				<?php endforeach; ?>
			</ul><!-- end .mpcth-mini-cart-products -->
		<?php else : ?>
			<p class="mpcth-mini-cart-product-empty"><?php _e( 'No products in the cart.', 'mpcth' ); ?></p>
		<?php endif; ?>

		<?php if (sizeof( WC()->cart->get_cart()) > 0) : ?>
			<p class="mpcth-mini-cart-subtotal mpcth-color-main-color"><?php _e( 'Cart Subtotal', 'mpcth' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></p>

			<a href="<?php echo wc_get_cart_url(); ?>" class="button cart mpcth-color-main-background-hover"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
			<a href="<?php echo wc_get_checkout_url(); ?>" class="button alt checkout mpcth-color-main-background"><?php _e( 'Proceed to Checkout', 'woocommerce' ); ?></a>
		<?php endif; ?>
	</div>
	<?php
	}
}

add_action('woocommerce_after_add_to_cart_button', 'mpcth_add_wishlist', 5);
function mpcth_add_wishlist() {
	if (shortcode_exists('yith_wcwl_add_to_wishlist')) echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}

add_filter('loop_shop_per_page', 'mpcth_products_per_page', 20);
function mpcth_products_per_page() {
	global $mpcth_options;

	$number = 9;

	// if ($sidebar_position == 'none' && $number % 2 !== 0)
	// 	$number -= 1;

	if (isset($mpcth_options['mpcth_products_number']) && $mpcth_options['mpcth_products_number'])
		$number = $mpcth_options['mpcth_products_number'];

	if (! empty($_GET['products_per_page']))
		if (is_numeric($_GET['products_per_page']))
			$number = (int)$_GET['products_per_page'];
		elseif ($_GET['products_per_page'] == 'all')
			$number = -1;

	return $number;
}

add_filter('loop_shop_columns', 'mpcth_products_columns');
function mpcth_products_columns() {
	return 3;
}

/* WooCommerce Cart link/remove link SSL support */
add_filter( 'woocommerce_get_cart_url', 'mpcth_add_ssl_to_cart' );
add_filter( 'woocommerce_get_remove_url', 'mpcth_add_ssl_to_cart' );
function mpcth_add_ssl_to_cart( $cart_url ) {
    if ( is_ssl() ) {
        $cart_url = str_replace( 'http:', 'https:', $cart_url );
    }

    return $cart_url;
}

/* WooCommerce Product shortcode class */
add_filter( 'shortcode_atts_product', 'mpcth_wc_product_shortcode_class', '', 3 );
function mpcth_wc_product_shortcode_class( $out, $pairs, $atts ) {
	return;
}

/* Disable the WordPress Admin Bar for all but admins. */
if (! current_user_can('edit_posts')):
	show_admin_bar(false);
endif;

/* ---------------------------------------------------------------- */
/* VC Activation
/* ---------------------------------------------------------------- */
add_action( 'vc_before_init', 'mpcth_vc_update' );
function mpcth_vc_update() {
	if( function_exists( 'vc_manager' ) ) {
		vc_manager()->disableUpdater( true );
	}
}

/* Fix ACF + VC FrontEnd issue */
add_action( 'acf/save_post', 'mpcth_acf_vc_compability', 9 );
function mpcth_acf_vc_compability() {
	if( isset( $_POST[ 'vc_inline' ] ) && $_POST[ 'vc_inline' ] == true ) {
		if( isset( $_POST[ 'fields' ] ) ) unset( $_POST[ 'fields' ] );
	}
}

/* ---------------------------------------------------------------- */
/* Helpers
/* ---------------------------------------------------------------- */
add_filter('widget_text', 'do_shortcode');

function mpcth_adjust_brightness($hex, $adjust) {
	$adjust = max(-255, min(255, $adjust));

	$rgba = mpcth_hex_to_rgba($hex);

	$r = $rgba[0];
	$g = $rgba[1];
	$b = $rgba[2];

	$r = max(0, min(255, $r + $adjust));
	$g = max(0, min(255, $g + $adjust));
	$b = max(0, min(255, $b + $adjust));

	$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

	return '#'.$r_hex.$g_hex.$b_hex;
}

function mpcth_hex_to_rgba($hex, $alpha = 1) {
	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
		$g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
		$b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
	} else {
		$r = hexdec(substr($hex, 0, 2));
		$g = hexdec(substr($hex, 2, 2));
		$b = hexdec(substr($hex, 4, 2));
	}

	return array($r, $g, $b, $alpha);
}

function mpcth_random_ID($length = 5) {
	return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

/* Visual Composer backward compability */
function mpc_get_row_css_class() {
	$custom = vc_settings()->get( 'row_css_class' );

	return ! empty( $custom ) ? $custom : 'vc_row-fluid';
}

function mpcBuildStyle( $bg_image = '', $bg_color = '', $bg_image_repeat = '', $font_color = '', $padding = '', $margin_bottom = '' ) {
	$has_image = false;
	$style = '';
	if ( (int) $bg_image > 0 && false !== ( $image_url = wp_get_attachment_url( $bg_image ) ) ) {
		$has_image = true;
		$style .= 'background-image: url(' . $image_url . ');';
	}
	if ( ! empty( $bg_color ) ) {
		$style .= vc_get_css_color( 'background-color', $bg_color );
	}
	if ( ! empty( $bg_image_repeat ) && $has_image ) {
		if ( 'cover' === $bg_image_repeat ) {
			$style .= 'background-repeat:no-repeat;background-size: cover;';
		} elseif ( 'contain' === $bg_image_repeat ) {
			$style .= 'background-repeat:no-repeat;background-size: contain;';
		} elseif ( 'no-repeat' === $bg_image_repeat ) {
			$style .= 'background-repeat: no-repeat;';
		}
	}
	if ( ! empty( $font_color ) ) {
		$style .= vc_get_css_color( 'color', $font_color );
	}
	if ( '' !== $padding ) {
		$style .= 'padding: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $padding ) ? $padding : $padding . 'px' ) . ';';
	}
	if ( '' !== $margin_bottom ) {
		$style .= 'margin-bottom: ' . ( preg_match( '/(px|em|\%|pt|cm)$/', $margin_bottom ) ? $margin_bottom : $margin_bottom . 'px' ) . ';';
	}

	return empty( $style ) ? '' : ' style="' . esc_attr( $style ) . '"';
}

/* Wishlist URL */
add_filter( 'yith_wcwl_wishlist_page_url', 'mpcth_wishlist_url' );
function mpcth_wishlist_url( $base_url ) {
	return esc_url_raw( str_replace( '/view', '', $base_url ) );
}