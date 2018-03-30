<?php
/*-----------------------------------------------------------------------------------*/
/* Theme Functions
/*
/* In premium Theme Blvd themes, this file will contains everything that's needed
/* to modify the framework's default setting to construct the current theme.
/*-----------------------------------------------------------------------------------*/

// Define theme constants
define( 'TB_THEME_ID', 'alyeska' );
define( 'TB_THEME_NAME', 'Alyeska' );

// Modify framework's theme options
require_once( get_template_directory() . '/includes/options.php' );

// Automatic updates
include_once( get_template_directory() . '/includes/updates.php' );

/**
 * Alyeska Setup
 *
 * @since 2.0.0
 */
function alyeska_setup() {
	// Custom background support
	add_theme_support( 'custom-background' ); // Only supported with WP v3.4+
}
add_action( 'after_setup_theme', 'alyeska_setup' );

/**
 * Alyeska CSS Files
 *
 * @since 2.0.0
 */
function alyeska_css() {

	// For plugins not inserting their scripts/stylesheets
	// correctly in the admin.
	if ( is_admin() ) {
		return;
	}

	// Get theme version for stylesheets
	$theme_data = wp_get_theme( get_template() );
	$theme_version = $theme_data->get('Version');

	// Get stylesheet API
	$api = Theme_Blvd_Stylesheets_API::get_instance();

	// Register all CSS files
	wp_register_style( 'themeblvd_alyeska', get_template_directory_uri() . '/assets/css/theme.min.css', $api->get_framework_deps(), $theme_version );
	wp_register_style( 'themeblvd_alyeska_menu', get_template_directory_uri() . '/assets/css/menus.min.css', array('themeblvd_alyeska'), $theme_version );
	wp_register_style( 'themeblvd_alyeska_shape', get_template_directory_uri() . '/assets/css/shape/'.themeblvd_get_option( 'body_shape' ).'-'.themeblvd_get_option( 'body_style' ).'.min.css', array('themeblvd_alyeska'), $theme_version );
	wp_register_style( 'themeblvd_dark', get_template_directory_uri() . '/assets/css/dark.min.css', array('themeblvd_alyeska'), $theme_version );
	wp_register_style( 'themeblvd_responsive', get_template_directory_uri() . '/assets/css/responsive.min.css', array('themeblvd_alyeska'), $theme_version );
	wp_register_style( 'themeblvd_ie', get_template_directory_uri() . '/assets/css/ie.css', array('themeblvd_alyeska'), $theme_version );
	wp_register_style( 'themeblvd_theme', get_stylesheet_uri(), array('themeblvd_alyeska'), $theme_version );

	// Enqueue CSS files as needed
	wp_enqueue_style( 'themeblvd_alyeska' );
	wp_enqueue_style( 'themeblvd_alyeska_menu' );
	wp_enqueue_style( 'themeblvd_alyeska_shape' );

	$add_to = 'themeblvd_alyeska_shape';

	if ( themeblvd_get_option( 'body_style' ) == 'dark' ) {
		$add_to = 'themeblvd_dark';
		wp_enqueue_style( 'themeblvd_dark' );
	}

	if ( themeblvd_supports( 'display', 'responsive' ) ) {
		$add_to = 'themeblvd_responsive';
		wp_enqueue_style( 'themeblvd_responsive' );
	}

	// IE Styles
	$GLOBALS['wp_styles']->add_data( 'themeblvd_ie', 'conditional', 'lt IE 9' ); // Add IE conditional
	wp_enqueue_style( 'themeblvd_ie' );

	// Inline styles from theme options -- Find closest
	// stylesheet to come just before style.css
	wp_add_inline_style( $add_to, alyeska_styles() );

	// style.css -- This is mainly for WP continuity and Child theme modifications.
	wp_enqueue_style( 'themeblvd_theme' );

	// Level 3 client API-added styles
	$api->print_styles(3);

}
add_action( 'wp_enqueue_scripts', 'alyeska_css', 20 );

if ( !function_exists( 'alyeska_styles' ) ) :
/**
 * Alyeska Styles
 *
 * @since 2.0.0
 *
 * @return string $styles Inline styles for wp_add_inline_style()
 */
function alyeska_styles() {
	$styles = '';
	$custom_styles = themeblvd_get_option( 'custom_styles' );
	$body_font = themeblvd_get_option( 'typography_body' );
	$header_font = themeblvd_get_option( 'typography_header' );
	$special_font = themeblvd_get_option( 'typography_special' );
	ob_start();
	?>
	/* Links */
	a {
		color: <?php echo themeblvd_get_option('link_color'); ?>;
	}
	a:hover,
	article .entry-title a:hover,
	.widget ul li a:hover,
	#breadcrumbs a:hover,
	.tags a:hover,
	.entry-meta a:hover,
	#footer_sub_content .copyright .menu li a:hover {
		color: <?php echo themeblvd_get_option('link_hover_color'); ?>;
	}
	/* Fonts */
	html,
	body {
		font-family: <?php echo themeblvd_get_font_face( $body_font ); ?>;
		font-size: <?php echo themeblvd_get_font_size( $body_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $body_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $body_font ); ?>;
	}
	h1, h2, h3, h4, h5, h6, .slide-title {
		font-family: <?php echo themeblvd_get_font_face( $header_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $header_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $header_font ); ?>;
	}
	#branding .header_logo .tb-text-logo,
	#featured .media-full .slide-title,
	#content .media-full .slide-title,
	#featured_below .media-full .slide-title,
	.tb-slogan .slogan-text,
	.element-tweet,
	.special-font {
		font-family: <?php echo themeblvd_get_font_face( $special_font ); ?>;
		font-style: <?php echo themeblvd_get_font_style( $special_font ); ?>;
		font-weight: <?php echo themeblvd_get_font_weight( $special_font ); ?>;
	}
	<?php
	// Compress inline styles
	$styles = themeblvd_compress( ob_get_clean() );

	// Add in user's custom CSS
	if ( $custom_styles ) {
		$styles .= "\n/* User Custom CSS */\n";
		$styles .= $custom_styles;
	}

	return $styles;
}
endif;

/**
 * Alyeska Scripts
 *
 * @since 2.0.0
 */
function alyeska_js() {

	global $themeblvd_framework_scripts;

	// Theme-specific script
	wp_enqueue_script( 'themeblvd_theme', get_template_directory_uri() . '/assets/js/alyeska.min.js', $themeblvd_framework_scripts, '3.0.0', true );

}
add_action( 'wp_enqueue_scripts', 'alyeska_js' );

/**
 * Alyeska Google Fonts
 *
 * If any fonts need to be included from Google based
 * on the theme options, here's where we do it.
 *
 * @since 2.0.0
 */
function alyeska_include_fonts() {
	themeblvd_include_google_fonts(
		themeblvd_get_option('typography_body'),
		themeblvd_get_option('typography_header'),
		themeblvd_get_option('typography_special')
	);
}
add_action( 'wp_head', 'alyeska_include_fonts', 5 );

/**
 * Alyeska Body Classes
 *
 * Here we filter WordPress's default body_class()
 * function to include necessary classes for Main
 * Styles selected in Theme Options panel.
 *
 * @since 2.0.0
 */
function alyeska_body_class( $classes ) {

	$classes[] = 'layout_'.themeblvd_get_option( 'body_shape' );
	$classes[] = 'style_'.themeblvd_get_option( 'body_style' );
	$classes[] = 'menu_'.themeblvd_get_option( 'menu_color' );
	$classes[] = 'menu_'.themeblvd_get_option( 'menu_shape' );

	if ( themeblvd_supports( 'display', 'responsive' ) ) {
		$classes[] = 'responsive';
		$classes[] = 'mobile_nav_'.themeblvd_get_option( 'mobile_nav' );
	}

	if ( ! get_background_image() && ! get_background_color() ) {
		$classes[] = 'theme-background';
	}

	return $classes;
}
add_filter( 'body_class', 'alyeska_body_class' );

/**
 * Add viewport meta to wp_head for non repsonsive design.
 *
 * @since 3.0.0
 */
function alyeska_non_responsive_viewport() {
	if ( ! themeblvd_supports( 'display', 'responsive' ) ) {
		echo '<meta name="viewport" content="width=1100">'."\n";
	}
}
add_action( 'wp_head', 'alyeska_non_responsive_viewport' );

/*-----------------------------------------------------------------------------------*/
/* Add Sample Layout
/*
/* Here we add a sample layout to the layout builder's sample layouts.
/*-----------------------------------------------------------------------------------*/

/**
 * Add sample layouts to Layout Builder plugin.
 *
 * @since 2.0.0
 */
function alyeska_sample_layouts() {

	$elements = array(
		array(
			'type' => 'slider',
			'location' => 'featured'
		),
		array(
			'type' => 'slogan',
			'location' => 'featured',
			'defaults' => array(
				'slogan' => 'Your company rocks. This theme rocks. It\'s a perfect match.',
				'text_size' => 'large',
	            'button' => 0,
	            'button_text' => 'Get Started Today!',
	            'button_color' => 'default',
	            'button_url' => 'http://www.google.com',
	            'button_target' => '_blank'
			)
		),
		array(
			'type' => 'columns',
			'location' => 'primary',
			'defaults' => array(
	           'setup' => array(
					'num' => '3',
					'width' => array(
						'2' => 'grid_6-grid_6',
						'3' => 'grid_4-grid_4-grid_4',
						'4' => 'grid_3-grid_3-grid_3-grid_3',
						'5' => 'grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1-grid_fifth_1'
					)
				),
		        'col_1' => array(
					'type' => 'raw',
					'page' => null,
					'raw' => "<h2>It's Time For Alyeska</h2>\n[icon image=\"clock\" align=\"left\"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\n[button link=\"#\"]Learn More[/button]",
				),
		        'col_2' => array(
					'type' => 'raw',
					'page' => null,
					'raw' => "<h2>Totally Responsive</h2>\n[icon image=\"mobile\" align=\"left\"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\n[button link=\"#\"]Learn More[/button]",
				),
		        'col_3' => array(
					'type' => 'raw',
					'page' => null,
					'raw' => "<h2>It's Pixel Perfect</h2>\n[icon image=\"computer\" align=\"left\"]Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.\n\n[button link=\"#\"]Learn More[/button]"
				)
		    )
		)
	);
	themeblvd_add_sample_layout( 'alyeska', 'Alyeska Homepage', get_template_directory_uri().'/assets/images/sample-alyeska.png', 'full_width', $elements );

}
add_action( 'after_setup_theme', 'alyeska_sample_layouts' );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Filters
/*
/* Here we can take advantage of modifying anything in the framework that is
/* filterable.
/*-----------------------------------------------------------------------------------*/

/**
 * Theme Blvd Setup
 *
 * @since 2.0.0
 */
function alyeska_global_config( $config ) {

	// If user turned off responsive CSS, then
	// filter the global config that applies
	// this throughout the framework.
	if ( themeblvd_get_option( 'responsive_css' ) == 'false' ) {
		$config['display']['responsive'] = false;
	}

	return $config;
}
add_filter( 'themeblvd_global_config', 'alyeska_global_config' );

/**
 * Image Sizes
 *
 * @since 2.0.0
 */
function alyeska_image_sizes( $sizes ) {
	$sizes['slider-large']['width'] = 940;
	$sizes['slider-large']['height'] = 350;
	$sizes['slider-staged']['width'] = 542;
	$sizes['slider-staged']['height'] = 312;
	return $sizes;
}
add_filter( 'themeblvd_image_sizes', 'alyeska_image_sizes' );

/**
 * Element CSS Classes
 *
 * @since 2.0.0
 */
function alyeska_element_classes( $all_classes ) {
	$all_classes['element_columns'][] = 'manual-gutters';
	$all_classes['element_content'][] = 'boxed-layout';
	$all_classes['element_post_grid_paginated'][] = 'boxed-layout';
	$all_classes['element_post_grid'][] = 'boxed-layout';
	$all_classes['element_slogan'][] = 'manual-gutters';
	$all_classes['element_tweet'][] = 'boxed-layout';
	return $all_classes;
}
add_filter( 'themeblvd_element_classes', 'alyeska_element_classes' );

/**
 * Theme Blvd WPML Bridge support
 *
 * @since 2.0.0
 */
function alyeska_wpml_theme_locations( $current_locations ) {
	$new_locations = array();
	$new_locations['social_media_addon'] = array(
		'name' 		=> __( 'Social Media Addon', 'themeblvd' ),
		'desc' 		=> __( 'This will display your language flags next to your social icons in the header of your website.', 'themeblvd' ),
		'action' 	=> 'alyeska_header_wpml'
	);
	$new_locations = array_merge( $new_locations, $current_locations );
	return $new_locations;
}
add_filter( 'tb_wpml_theme_locations', 'alyeska_wpml_theme_locations' );

/**
 * Modify recommended plugins.
 *
 * @since 3.0.0
 */
function alyeska_plugins( $plugins ){

	// Add Twitter
	$plugins['tweeple'] = array(
		'name'		=> 'Tweeple',
		'slug'		=> 'tweeple',
		'required'	=> false
	);

	return $plugins;
}
add_filter( 'themeblvd_plugins', 'alyeska_plugins' );

/**
 * Apply gradient buttons, which were default
 * before Bootstrap 3.
 *
 * @since 3.1.0
 */
function alyeska_btn_gradient( $class ) {
	$class[] = 'tb-btn-gradient';
	return $class;
}
add_filter( 'body_class', 'alyeska_btn_gradient' );

/*-----------------------------------------------------------------------------------*/
/* Theme Blvd Hooked Functions
/*
/* The following functions either add elements to unsed hooks in the framework,
/* or replace default functions. These functions can be overridden from a child
/* theme.
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'alyeska_header_menu' ) ) :
/**
 * Main Menu
 *
 * @since 2.0.0
 */
function alyeska_header_menu() {

	$responsive = themeblvd_supports( 'display', 'responsive' );
	$mobile_nav = themeblvd_get_option( 'mobile_nav' );

	do_action( 'themeblvd_header_menu_before' );
	?>
	<div id="menu-wrapper">
		<?php if ( $responsive && 'style_3' == $mobile_nav ) : ?>
			<?php echo themeblvd_nav_menu_select( apply_filters( 'themeblvd_responsive_menu_location', 'primary' ) ); ?>
		<?php endif; ?>
		<div id="main-top">
			<div class="main-top-left"></div>
			<div class="main-top-right"></div>
			<div class="main-top-middle"></div>
		</div>
		<div class="menu-wrapper-inner">
			<?php if ( $responsive && 'style_1' == $mobile_nav ) : ?>
				<a href="#main-menu" class="btn-navbar">
					<?php echo apply_filters( 'themeblvd_btn_navbar_text', '<i class="fa fa-bars"></i>' ); ?>
				</a>
			<?php endif; ?>
			<div id="main-menu">
				<div id="menu-inner" class="<?php echo themeblvd_get_option( 'menu_shape' ); ?>-menu <?php echo themeblvd_get_option( 'menu_shape' ); ?>-<?php echo themeblvd_get_option( 'menu_color' ); ?>">
					<div class="menu-left"><!-- --></div>
					<div class="menu-middle">
						<div class="menu-middle-inner">

							<!-- PRIMARY NAV (start) -->

							<?php wp_nav_menu( apply_filters( 'themeblvd_primary_menu_args', array( 'menu_id' => 'primary-menu', 'menu_class' => 'sf-menu', 'container' => '', 'theme_location' => 'primary', 'fallback_cb' => 'themeblvd_primary_menu_fallback' ) ) ); ?>

							<?php if ( $responsive && 'style_2' == $mobile_nav) : ?>
								<div id="primary-responsive-nav">
									<?php echo themeblvd_nav_menu_select( apply_filters( 'themeblvd_responsive_menu_location', 'primary' ) ); ?>
									<span class="responsive-nav-text">
										<?php echo apply_filters( 'alyeska_responsive_nav_text', '<i class="icon-reorder"></i>'.themeblvd_get_local('navigation') ); ?>
									</span>
								</div>
							<?php endif; ?>

							<!-- PRIMARY NAV (end) -->

							<?php do_action( 'themeblvd_header_menu_addon' ); ?>
						</div><!-- .menu-middle-inner (end) -->
					</div><!-- .menu-middle (end) -->
					<div class="menu-right"><!-- --></div>
				</div><!-- #menu-inner (end) -->
			</div><!-- #main-menu (end) -->
		</div><!-- .menu-wrapper-inner (end) -->
	</div><!-- #menu-wrapper (end) -->
	<?php
	do_action( 'themeblvd_header_menu_after' );
}
endif;

if ( !function_exists( 'alyeska_header_addon' ) ) :
/**
 * Header Addon
 *
 * @since 2.0.0
 */
function alyeska_header_addon() {
	$header_text = themeblvd_get_option( 'header_text' );
	?>
	<div class="header-addon<?php if ($header_text) echo ' header-addon-with-text'; if (has_action('alyeska_header_wpml')) echo ' header-addon-with-wpml';?>">
		<div class="social-media">
			<?php echo themeblvd_contact_bar(); ?>
		</div><!-- .social-media (end) -->
		<?php do_action('alyeska_header_wpml'); ?>
		<?php if ( $header_text ) : ?>
			<div class="header-text">
				<?php echo $header_text; ?>
			</div><!-- .header-text (end) -->
		<?php endif; ?>
	</div><!-- .header-addon (end) -->
	<?php
}
endif;

if ( !function_exists( 'alyeska_header_menu_addon' ) ) :
/**
 * Header Menu Addon
 *
 * @since 2.0.0
 */
function alyeska_header_menu_addon() {
	if ( themeblvd_get_option( 'menu_search' ) != 'hide') :
	?>
	<div id="search-popup-wrapper">
		<a href="#" title="<?php echo themeblvd_get_local( 'search' ); ?>" id="search-trigger"><?php echo themeblvd_get_local( 'search' ); ?></a>
		<div class="search-popup-outer">
			<div class="search-popup">
			    <div class="search-popup-inner">
			        <form method="get" action="<?php bloginfo('url'); ?>">
			            <fieldset>
			                <input type="text" class="search-input" name="s" onblur="if (this.value == '') {this.value = '<?php echo themeblvd_get_local( 'search' ); ?>';}" onfocus="if (this.value == '<?php echo themeblvd_get_local( 'search' ); ?>') {this.value = '';}" value="<?php echo themeblvd_get_local( 'search' ); ?>" />
			                <input type="submit" class="submit" value="" />
			            </fieldset>
			        </form>
			    </div><!-- .search-popup-inner (end) -->
			</div><!-- .search-popup (end) -->
		</div><!-- .search-popup-outer (end) -->
	</div><!-- #search-popup-wrapper (end) -->
	<?php
	endif;
}
endif;

if ( !function_exists( 'alyeska_content_top' ) ) :
/**
 * Titles for pages
 *
 * @since 2.0.0
 */
function alyeska_content_top() {
	global $post;
	?>
	<?php if ( is_page() && !is_page_template( 'template_builder.php' ) ) : ?>
		<?php if ( 'hide' != get_post_meta( $post->ID, '_tb_title', true ) ) : ?>
			<header class="sidebar-layout-top entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php endif; ?>
	<?php elseif ( is_archive() ) : ?>
		<?php if ( 'true' == themeblvd_get_option( 'archive_title' ) ) : ?>
			<header class="sidebar-layout-top entry-header">
				<h1 class="entry-title"><?php themeblvd_archive_title(); ?></h1>
			</header><!-- .entry-header -->
		<?php endif; ?>
	<?php endif; ?>
	<?php
}
endif;

if ( !function_exists( 'alyeska_blog_meta' ) ) :
/**
 * Blog Meta
 *
 * @since 2.0.0
 */
function alyeska_blog_meta() {
	?>
	<div class="entry-meta">
		<time class="entry-date updated" datetime="<?php the_time('c'); ?>"><i class="fa fa-calendar"></i> <?php the_time( get_option( 'date_format' ) ); ?></time>
		<span class="sep"> / </span>
		<span class="author vcard"><i class="fa fa-user"></i> <a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo sprintf( esc_attr__( 'View all posts by %s', 'themeblvd_frontend' ), get_the_author() ); ?>" rel="author"><?php the_author(); ?></a></span>
		<span class="sep"> / </span>
		<?php if ( 'portfolio_item' == get_post_type() ) : ?>
			<span class="category"><?php echo get_the_term_list( get_the_id(), 'portfolio', '<i class="fa fa-bars"></i>  ', ', ' ); ?></span>
		<?php else : ?>
			<span class="category"><i class="fa fa-bars"></i>  <?php the_category(', '); ?></span>
		<?php endif; ?>
	</div><!-- .entry-meta -->
	<?php
}
endif;

if ( !function_exists( 'alyeska_footer_sub_content_default' ) ) :
/**
 * Content below footer
 *
 * @since 2.0.0
 */
function alyeska_footer_sub_content_default() {
	?>
	<div id="footer_sub_content">
		<div class="footer_sub_content-inner">
			<div class="footer_sub_content-content">
				<div class="copyright">
					<span class="text"><?php echo apply_filters( 'themeblvd_footer_copyright', themeblvd_get_option( 'footer_copyright' ) ); ?></span>
					<span class="menu"><?php wp_nav_menu( array( 'menu_id' => 'footer-menu', 'container' => '', 'fallback_cb' => '', 'theme_location' => 'footer', 'depth' => 1 ) ); ?></span>
				</div><!-- .copyright (end) -->
				<div class="clear"></div>
			</div><!-- .content (end) -->
		</div><!-- .container (end) -->
	</div><!-- .footer_sub_content (end) -->
	<?php
}
endif;

if ( !function_exists( 'alyeska_footer_after' ) ) :
/**
 * Bottom of layout, for CSS styling to round corners
 * of main boxed layout.
 *
 * @since 2.0.0
 */
function alyeska_footer_after() {
	?>
	<div id="after-footer">
		<div class="after-footer-left"></div>
		<div class="after-footer-right"></div>
		<div class="after-footer-middle"></div>
	</div>
	<?php
}
endif;

/*-----------------------------------------------------------------------------------*/
/* Hook Adjustments on framework
/*-----------------------------------------------------------------------------------*/

// Remove Hooks
remove_action( 'themeblvd_header_menu', 'themeblvd_header_menu_default' );
remove_action( 'themeblvd_blog_meta', 'themeblvd_blog_meta_default' );
remove_action( 'themeblvd_footer_sub_content', 'themeblvd_footer_sub_content_default' );
remove_action( 'themeblvd_content_top', 'themeblvd_content_top_default');

// Add Hooks
add_action( 'themeblvd_header_addon', 'alyeska_header_addon' );
add_action( 'themeblvd_header_menu', 'alyeska_header_menu' );
add_action( 'themeblvd_header_menu_addon', 'alyeska_header_menu_addon' );
add_action( 'themeblvd_content_top', 'alyeska_content_top' );
add_action( 'themeblvd_blog_meta', 'alyeska_blog_meta' );
add_action( 'themeblvd_footer_sub_content', 'alyeska_footer_sub_content_default' );
add_action( 'themeblvd_footer_after', 'alyeska_footer_after' );