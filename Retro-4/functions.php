<?php
/*
*	editing this file may stop the theme from functioning correctly.
*
*/

/* openframe */
require_once( get_template_directory() . '/includes/config/start.php' );

/* theme setup */	
function retro_setup() {

	/* load current language */
	load_theme_textdomain( 'openframe', get_template_directory() . '/languages' );
	
	$locale_file = get_template_directory() . '/languages/' . get_locale() . '.php'; 	
	
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );	
	
	/* menus */
	register_nav_menu( 'primary', __( 'Navigation Menu', 'openframe' ) );
		
	/* features support */
	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'post-thumbnails' );
	
	add_theme_support( 'post-formats', array( 'video', 'image', 'gallery', 'link' ) );
	
	/* image sizes */
	set_post_thumbnail_size( 480, 360, true );

	add_image_size( 'retro-big', 940 );

	add_image_size( 'retro-slides', 940, 400, true );
		
	add_image_size( 'retro-mini', 80, 80, true );
	
}

add_action( 'after_setup_theme', 'retro_setup' );

/* theme functions */
require_once( op_config( 'theme_includes' ) . '/helper.php' );

/* custom post types */
require_once( op_config( 'theme_includes' ) . '/custom-types.php' );

/* nav walker */
require_once( op_config( 'theme_includes' ) . '/nav-walker.php' );

/* commentlist */
require_once( op_config( 'theme_includes' ) . '/commentlist.php' );

/* ajax */
require_once( op_config( 'theme_includes' ) . '/ajax.php' );

/* contact form */
require_once( op_config( 'theme_includes' ) . '/contact-form-html.php' );

/* retro icons list */
if ( is_admin() )
	require_once( op_config( 'theme_includes' ) . '/icons.php' );

/* metaboxes */
if ( is_admin() )
	require_once( op_config( 'theme_includes' ) . '/metabox/start.php');

/* content size */
if ( ! isset( $content_width ) )
	$content_width = 940;

/* sets google fonts families */
function retro_google_fonts() {
	if ( $body = op_theme_opt( 'google-fonts-body' ) )
		echo '<style>body, input, textarea, .blog-list .post-title h3, .blog-list h4.post-meta, .portfolio-list ul li h3, .single h2.post-title, .page h2.post-title { font-family: "' . retro_get_font_name( $body ) . '", sans-serif; }</style>';		
	if ( $secondary = op_theme_opt( 'google-fonts-secondary' ) )
		echo '<style>.hentry-content h1, .hentry-content h2, .hentry-content h3, .hentry-content h4, .hentry-content h5, .hentry-content h6, .section-subtitle, .blog-list h4.post-meta, .single h4.post-meta, .widget h3, .comments h3, .comments h4, .comment-author, .more-posts { font-family: "' . retro_get_font_name( $secondary ) . '", serif; }</style>';
}

add_action( 'wp_head', 'retro_google_fonts' );

/* theme's fonts */
function retro_enqueue_google_fonts() {
	
	$fonts = array();
	$subsets = array();

	if ( $body = op_theme_opt( 'google-fonts-body' ) ) {
		$body = explode( '=', $body );
		if ( isset( $body[ 1 ] ) )
			$fonts[] = str_replace( '&subset', '', $body[ 1 ] );
		if ( isset( $body[ 2 ] ) )	
			$subsets = array_merge( $subsets, explode( ',', $body[ 2 ] ) );
	}
				
	if ( $secondary = op_theme_opt( 'google-fonts-secondary' ) ) {
		$secondary = explode( '=', $secondary );
		if ( isset( $secondary [ 1 ] ) )
			$fonts[] = str_replace( '&subset', '', $secondary[ 1 ] );
		if ( isset( $secondary[ 2 ] ) )	
			$subsets = array_merge( $subsets, explode( ',', $secondary[ 2 ] ) );
	}
	
	$subsets = array_unique( $subsets );

	$protocol = is_ssl() ? 'https' : 'http';
	
	wp_enqueue_style( 'retro-fonts', $protocol . '://fonts.googleapis.com/css?family=' . join( '|', $fonts ) . '&subset=' . join( ',', $subsets ) );
	
}

add_action( 'wp_enqueue_scripts', 'retro_enqueue_google_fonts' );

/* theme's icons */
function retro_enqueue_icons() {
	
	wp_enqueue_style( 'retro-icons', get_template_directory_uri() . '/fonts/retro-icons.css' );
	
}

add_action( 'wp_enqueue_scripts', 'retro_enqueue_icons' );
add_action( 'admin_enqueue_scripts', 'retro_enqueue_icons' );

/* theme's javascript */ 
function retro_enqueue_scripts() {
	
	wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.js', array(), '2.7.1' );
	wp_register_script( 'retro-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), op_theme_version, 1 );
	wp_register_script( 'retro-init', get_template_directory_uri() . '/js/retro.js', array( 'retro-plugins' ), op_theme_version, 1 );
	wp_register_script( 'retro-mail', get_template_directory_uri() . '/js/retro.mail.js', array( 'jquery' ), op_theme_version, 1 );	

	wp_enqueue_script( array( 'modernizr', 'jquery', 'retro-plugins', 'retro-init' ) );

	if ( is_page_template( 'template-home.php' ) ) {

		/* Pass custom variables for the slider */
		$homeVars = array(
			'speed' => ( $i = op_theme_opt( 'slider-speed' ) ) ? $i : 500,
			'pausetime' => ( $i = op_theme_opt( 'slider-pause-time' ) ) ? $i : 4000,
			'autosliding' => op_theme_opt('slider-auto-sliding'),
			'pausehover' => op_theme_opt('slider-pause-hover'),
			'url' => admin_url( 'admin-ajax.php' ),
			'ref' => wp_create_nonce( 'retro-home-query' ),
			'articlenr' => op_theme_opt('article-number'),
			'portfolionr' => op_theme_opt('portfolio-number')
		);	
		wp_localize_script('retro-init', 'retro_home_vars', $homeVars );

	}

}

add_action( 'wp_enqueue_scripts', 'retro_enqueue_scripts' );


/* manage extra features through special classes */
function custom_classes( $classes ) {

	if ( op_theme_opt( 'disable-fixed' ) == false ) {

		$classes[] = 'fixed-header';

	}

	if ( op_theme_opt( 'logo-left' ) == true ) {

		$classes[] = 'left-logo';

	} else {

		$classes[] = 'centered-logo';		

	}

	if ( op_theme_opt( 'logo-up' ) == true ) {

		$classes[] = 'anim-logo';

	}	

	return $classes;

}

add_filter( 'body_class', 'custom_classes' );

/* sidebars */
function retro_widgets() {
		
	$sidebar = array(
		'name' => __( 'Main Sidebar', 'openframe' ),
		'id' => 'retro_main_sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><hr>'
	);
	
	register_sidebar( $sidebar );
	
}

add_action( 'widgets_init', 'retro_widgets' );

/* analytics code */
if ( op_theme_opt( 'analytics' ) )
	add_action( 'wp_head', create_function( '', 'echo op_theme_opt( \'analytics\' );' ) );

/* custom jquery code */
if ( $i = op_theme_opt( 'jquery-code' ) )
	add_action( 'wp_footer', create_function( '', 'echo \'<script>jQuery( document ).ready( function( $ ) { \' . op_theme_opt( \'jquery-code\' ) . \' } );</script>\';' ) );

/* search form */
function retro_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" ><input type="text" value="' . get_search_query() . '" placeholder="' . __( 'Type and hit enter', 'openframe' ) . '" name="s" id="s" /></form>';
    return $form;
}

add_filter( 'get_search_form', 'retro_search_form' );


/* display navigation to next/previous post when applicable */
if ( ! function_exists( 'retro_paging_nav' ) ) :

	function retro_paging_nav() {
		// Don't print empty markup if there's only one page.
		if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
			return;
		}
		?>
		<nav class="navigation paging-navigation">
		  <div class="nav-links clear">

				<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous left"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'openframe' ) ); ?></div>
				<?php endif; ?>

				<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next right"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'openframe' ) ); ?></div>
				<?php endif; ?>

			 </div><!-- nav-links -->
		</nav>
		<?php
	}

endif;

/* update notifier */
if ( op_theme_opt( 'update-check' ) )
	op_version_check();
?>