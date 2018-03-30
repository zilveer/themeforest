<?php
/**
 * Experience functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/


 /** 
 * Defines constants for theme use
 * 
 * @var			string
 * @since		Experience 1.0
 **/


/*-----------------------------------------------------------------------------------
	OPTIONS FRAMEWORK
-----------------------------------------------------------------------------------*/
 
/** 
 * Load additional framework files
 * 
 * @var			string
 * @since		Experience 1.0
 **/

add_action( 'after_setup_theme', 'experience_framework_setup' );
function experience_framework_setup () {
 
	// Template Options
	require_once( get_template_directory() .'/inc/template-options/template-options.php' );
	
	// Theme Options
	require_once( get_template_directory() .'/inc/redux-framework/theme-options.php' );	
	
	// Visual Composer
	require_once( get_template_directory() .'/inc/visual-composer/vc.php' );
	
	// Comments markup
	require_once( get_template_directory() .'/inc/comment.php' );

}


/*-----------------------------------------------------------------------------------
	THEME SETUP
-----------------------------------------------------------------------------------*/


/**
 * Displays theme related admin notices.
 *
 * @since		Experience 1.0
 **/
add_action( 'admin_notices', 'experience_show_admin_notices' );
function experience_show_admin_notices() {

	if ( !defined( 'WPB_VC_VERSION' ) && get_option( 'experience-notice-dismissed' ) != '1' ) {
		
		echo '<div class="notice error experience-vc-notice is-dismissible">
				<p>'. wp_kses( __( "The Experience theme is best used with the <strong><a href='http://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431?ref=EugeneO' target='_blank'>WPBakery Visual Composer</a></strong> plugin. If you have Visual Composer, install and activate it on the Plugins screen of your Dashboard.", 'experience' ), 
				array( 'a' => array( 'href'	=> array(), 'target'=> array() ), 'strong' => array() ) ) .'</p>
			</div>';
		
		
	}

}


/**
 * Enqueues script that updates admin notice dismissed flag in options database
 *
 * @since		Experience 1.0
 **/
add_action( 'admin_enqueue_scripts', 'experience_admin_notice_scripts' );
function experience_admin_notice_scripts() {
	if ( !defined( 'WPB_VC_VERSION' ) && get_option( 'experience-notice-dismissed' ) != '1' ) {
		wp_enqueue_script( 'experience-notice-update', get_template_directory_uri() .'/inc/js/notice-update.js', array( 'jquery' ), '1.0', true  );
	}
}


/**
 * AJAX action that updates admin notice dismissed flag in options database
 *
 * @since		Experience 1.0
 **/
add_action( 'wp_ajax_experience_dismiss_notice', 'experience_update_dismiss_notice_option' );
function experience_update_dismiss_notice_option() {
	
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) { 
		update_option( 'experience-notice-dismissed', '1' );
	}
	
	die();
	
}

/**
 * Removes admin notice flag from options database when theme is deactivated
 *
 * @since		Experience 1.0
 **/
add_action( 'switch_theme', 'experience_remove_dismiss_notice_option');
function experience_remove_dismiss_notice_option() {	
	delete_option( 'experience-notice-dismissed' );	
}


/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *
 * @since 		Experience 1.0
 */
add_action( 'after_setup_theme', 'experience_content_width', 0 );
function experience_content_width() {
	$GLOBALS['content_width'] = 1140;
}

	
/**
 * Sets up theme defaults and registers the various supported WordPress features.
 *
 * @since		Experience 1.0
 **/

add_action( 'after_setup_theme', 'experience_theme_setup' );
function experience_theme_setup() {

	/**
	 * Makes the theme available for translation.
	 **/
	load_theme_textdomain( 'experience', get_template_directory() .'/locale' );
	
	
	/**
	 * Adds RSS feed links to <head> for posts and comments.
	 **/
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * This theme supports all available post formats although none have unique post layouts.
	 * See http://codex.wordpress.org/Post_Formats
	 **/
	//add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );

	
	/**
	 * This theme uses wp_nav_menu() in two locations.
	 **/
	register_nav_menus(
		array(
			'primary'	=> esc_html__( 'Primary Navigation', 'experience' )
		)
	);
	
	
	/**
	 * Enable support for Post Thumbnails.
	 **/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'experience-post-grid', 768, 468, true );	// Post grid background image
	
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery' ) );

	
	/**
	 * This theme uses its own gallery styles.
	 **/
	add_filter( 'use_default_gallery_style', '__return_false' );
	
	
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded title tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	
	
	
	/**
	 * Adds site icons
	 **/
	add_theme_support( 'site-icon' );
	
}


/*-----------------------------------------------------------------------------------
	LOAD STYLES
-----------------------------------------------------------------------------------*/

/**
 * Constructs google font URL for enqueue function
 *
 * @since		Experience 1.0
 * @return		string	Google fonts URL
 **/
function experience_fonts_url() {

    $font_url = '';
	
	/**
	* Translators: If there are characters in your language that are not
	* supported by Montserrat, translate this to 'Montserrat off'. Do not translate
	* into your own language.
	**/
	$montserrat = _x( 'Montserrat on', 'Montserrat font: Montserrat on or Montserrat off', 'experience' );
	
	/**
	* Translators: If there are characters in your language that are not
	* supported by Lato, translate this to 'Lato off'. Do not translate
	* into your own language.
	**/
	$lato = _x( 'Lato on', 'Lato font: Lato on or Lato off', 'experience' );
	
	if ( 'Montserrat off' !== $montserrat || 'Lato off' !== $lato ) {
		
		$font_families = array();
		
		if ( 'Montserrat off' !== $montserrat ) {
			$font_families[] = 'Montserrat:400,700';
		}
		
		if ( 'Lato off' !== $lato ) {
			$font_families[] = 'Lato:400,700';
		}
		
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
	
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	
	}
	
	return esc_url_raw( $fonts_url );
	
}


/**
 * Enqueue front end styles and generate dynamic CSS and add to head as style tag.
 *
 * @since		Experience 1.0
 * @return		void
 **/

add_action( 'wp_enqueue_scripts', 'experience_enqueue_styles' );
function experience_enqueue_styles() {
	
	global $post, $experience_theme_settings;
	
	$theme = wp_get_theme();	
	$version = $theme->Version;	
	
	/* ---------- CSS ---------- */
 
	# Google Fonts (Montserrat/Lato)
	wp_enqueue_style( 'experience-fonts', experience_fonts_url(), array(), '1.0.0' );
	
	# Fancybox
	wp_enqueue_style( 'fancybox', get_template_directory_uri().'/css/jquery.fancybox.css' );		
	
	# MediaElement
	wp_enqueue_style( 'wp-mediaelement' );
	
	# Visual Composer
	if( function_exists( 'vc_asset_url' ) ) {
		wp_enqueue_style( 'js_composer_front', vc_asset_url( 'css/js_composer.min.css' ), false, WPB_VC_VERSION );
	}
	
	# Main stylesheet
	wp_enqueue_style( 'experience', get_stylesheet_uri(), false, $version );
	
	# Dynamic stylesheet
	if ( isset( $experience_theme_settings ) ) {
	
		$upload_url = wp_upload_dir();
		$upload_url = trailingslashit( $upload_url['baseurl'] ) .'experience';		
		wp_enqueue_style( 'experience-dynamic', $upload_url .'/style-dynamic-'. get_current_blog_id() .'.css', array( 'experience' ) );		

	}
	
	# Responsive stylesheet
	wp_enqueue_style( 'experience-responsive',	get_template_directory_uri() .'/css/responsive.css', array( 'experience' ) );
	

	/* ---------- Dynamic CSS Generated ---------- */

	$output = '';
	
	// ----- Navigation Text Colour ----- //
	
	$transparent_nav_text_color = '';
	
	if( is_singular() ) {
		$transparent_nav_text_color = esc_html( get_post_meta( $post->ID, 'experience_transparent_nav_text_color', true ) );
	}
	
	// Page & Post
	if (
		( is_single() || is_page() )
		&& (
			get_post_meta( $post->ID, 'experience_transparent_nav_bg', true ) == 'on'
			&& $transparent_nav_text_color != ''
		)
	) {
		
		$output .= '.unscrolled .logo,
					.unscrolled .header-nav,
					.unscrolled .header-nav a,
					.unscrolled .header-nav > li > span { color: '. esc_html( $transparent_nav_text_color ) .'; }
					
					.unscrolled .menu-icon .line { background-color: '. esc_html( $transparent_nav_text_color ) .'; }';
		
		$output .= '.unscrolled .header-nav-wrapper ul > li:after {
						background-color: '. esc_html( $transparent_nav_text_color ) .';						
					}';			
		
	
	}
	
	// Post Archives
	if (
		(
			is_home()
			|| ( is_archive() && !is_archive( 'portfolio' ) )
		)
		&& (
			!empty( $experience_theme_settings['blog-transparent-nav'] )
			&& $experience_theme_settings['blog-transparent-nav'] == '1'
		)
		&& !empty( $experience_theme_settings['blog-transparent-nav-text-color'] )
	) {
		
		$output .= '.unscrolled .logo,
					.unscrolled .header-nav,
					.unscrolled .header-nav a,
					.unscrolled .header-nav > li > span { color: '. esc_html( $experience_theme_settings['blog-transparent-nav-text-color'] ) .'; }
					
					.unscrolled .menu-icon .line { background-color: '. esc_html( $experience_theme_settings['blog-transparent-nav-text-color'] ) .'; }';
		
		$output .= '.unscrolled .header-nav-wrapper ul > li:after {
						background-color: '. esc_html( $experience_theme_settings['blog-transparent-nav-text-color'] ) .';
					}';


	}
	
	// Search
	if (
		is_search()
		&& (
			!empty( $experience_theme_settings['search-transparent-nav'] )
			&& $experience_theme_settings['search-transparent-nav'] == '1'
		)
		&& !empty( $experience_theme_settings['search-transparent-nav-text-color'] )
	) {
		
		$output .= '.unscrolled .logo,
					.unscrolled .header-nav,
					.unscrolled .header-nav a,
					.unscrolled .header-nav > li > span { color: '. esc_html( $experience_theme_settings['search-transparent-nav-text-color'] ) .'; }
					
					.unscrolled .menu-icon .line { background-color: '. esc_html( $experience_theme_settings['search-transparent-nav-text-color'] ) .'; }';
		
		$output .= '.unscrolled .header-nav-wrapper ul > li:after {
						background-color: '. esc_html( $experience_theme_settings['search-transparent-nav-text-color'] ) .';
					}';


	}
	
	// Portfolio Archives
	if (
		( is_tax( 'portfolio_category' ) || is_tax( 'portfolio_tag' ) || is_archive( 'portfolio' ) )
		&& (
			!empty( $experience_theme_settings['portfolio-transparent-nav'] )
			&& $experience_theme_settings['portfolio-transparent-nav'] == '1'
		)
		&& !empty( $experience_theme_settings['portfolio-transparent-nav-text-color'] )
	) {
		
		$output .= '.unscrolled .logo,
					.unscrolled .header-nav,
					.unscrolled .header-nav a,
					.unscrolled .header-nav > li > span { color: '. esc_html( $experience_theme_settings['portfolio-transparent-nav-text-color'] ) .'; }
					
					.unscrolled .menu-icon .line { background-color: '. esc_html( $experience_theme_settings['portfolio-transparent-nav-text-color'] ) .'; }';
					
		$output .= '.unscrolled .header-nav-wrapper ul > li:after {
						background-color: '. esc_html( $experience_theme_settings['portfolio-transparent-nav-text-color'] ) .';
					}';

	}

	// 404
	if (
		is_404()
		&& (
			!empty( $experience_theme_settings['404-transparent-nav'] )
			&& $experience_theme_settings['404-transparent-nav'] == '1'
		)	
		&& !empty( $experience_theme_settings['404-transparent-nav-text-color'] )
	) {
	
		$output .= '.unscrolled .logo,
					.unscrolled .header-nav,
					.unscrolled .header-nav a,
					.unscrolled .header-nav > li > span { color: '. esc_html( $experience_theme_settings['404-transparent-nav-text-color'] ) .'; }
					
					.unscrolled .menu-icon .line { background-color: '. esc_html( $experience_theme_settings['404-transparent-nav-text-color'] ) .'; }';
					
		$output .= '.unscrolled .header-nav-wrapper ul > li:after {
						background-color: '. esc_html( $experience_theme_settings['404-transparent-nav-text-color'] ) .';
					}';

	}
	
	// Compress the CSS
	$output = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $output );
	$output = str_replace( ': ', ':', $output );
	$output = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $output );
	
	// Output dynamic styles
	wp_add_inline_style( 'experience', $output );
	
}


/*-----------------------------------------------------------------------------------
	LOAD SCRIPTS
-----------------------------------------------------------------------------------*/

/**
 * Enqueues front end scripts.
 *
 * @since		Experience 1.0
 * @return		void
 **/

add_action( 'wp_enqueue_scripts', 'experience_enqueue_scripts' );
function experience_enqueue_scripts() {
	
	global $wp_styles, $experience_theme_settings, $post;	

	// Comment reply
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	// Fancybox
	wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() .'/js/jquery.fancybox.pack.js', array( 'jquery' ), false, 1 );
	wp_enqueue_script( 'jquery-fancybox-media', get_template_directory_uri() .'/js/jquery.fancybox-media.js', array( 'fancybox' ), false, 1 );
	

	// Flexslider
	wp_enqueue_script( 'jquery-flexslider', get_template_directory_uri() .'/js/jquery.flexslider.min.js', array( 'jquery' ), false, 1  );
	
	// Masonry
	wp_enqueue_script( 'jquery-masonry' );
	
	// MediaElement
	wp_enqueue_script( 'mediaelement' );
	wp_enqueue_script( 'wp-mediaelement' );
	
	// Preloader
	wp_enqueue_script( 'preloader', get_template_directory_uri() .'/js/preloader.js' );
	
	// Stellar
	//wp_enqueue_script( 'stellar', get_template_directory_uri() .'/js/jquery.stellar.min.js', array( 'jquery' ), false, 1 );	
	
	// Waypoints
	if ( is_singular() && get_post_meta( $post->ID, 'experience_section_pagination', true ) == 'on' ) {
		wp_enqueue_script( 'jquery-waypoints', get_template_directory_uri(). '/js/waypoints.min.js', array( 'jquery' ), false, 1 );
	}
	
	// ------ Visual Composer ------ //
	if( function_exists( 'vc_asset_url' ) ) {
		wp_enqueue_script( 'wpb_composer_front_js', vc_asset_url( 'dist/js_composer_front.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_enqueue_script( 'vc_jquery_skrollr_js', vc_asset_url( 'lib/bower/skrollr/dist/skrollr.min.js' ), array( 'jquery' ), WPB_VC_VERSION, true );
		wp_enqueue_script( 'vc_youtube_iframe_api_js', '//www.youtube.com/iframe_api', array(), WPB_VC_VERSION, true );
	}
	
	// jQuery Custom (Must load last)
	wp_enqueue_script( 'experience-custom', get_template_directory_uri() .'/js/jquery.custom.js', array( 'jquery' ), "1.0.0", 1 );
	
	
	/* ---------- LOCALIZE JS ---------- */
	
	if ( !is_singular() ) {

		$load_more_button_text_string = esc_html__( 'Load More', 'experience' );
		$loading_text_string = esc_html__( 'Loading', 'experience' );
		
		wp_localize_script(
			'experience-custom',
			'experience_load_posts',
			array(
				'load_more_button_text'	=> $load_more_button_text_string,
				'loading_text'			=> $loading_text_string
			)
		);
	
	}
	
}


/**
 * Enqueues admin dashboard scripts.
 *
 * @since Experience 1.0
 *
 * @return void
 **/
 
add_action( 'admin_enqueue_scripts', 'experience_enqueue_admin_scripts' );
function experience_enqueue_admin_scripts( $hook ) {

	if ( 
		'post.php' != $hook
		&& 'edit.php' != $hook
		&& 'post-new.php' != $hook
	) {	
		return;
	}	
	
	// Admin JS
	wp_enqueue_script( 'experience-admin-custom', get_template_directory_uri() .'/inc/js/jquery.admin.js', array( 'jquery' ), false );
	
}


/**
 * Enqueues admin dashboard styles for.
 *
 * @since Experience 1.0
 *
 * @return void
 **/
 
add_action( 'admin_enqueue_scripts', 'experience_enqueue_admin_styles' );
function experience_enqueue_admin_styles( $hook ) {

	if ( 
		'post.php' != $hook
		&& 'edit.php' != $hook
		&& 'post-new.php' != $hook
	) {	
		return;
	}	
	
	// Admin CSS
	wp_enqueue_style( 'experience-admin', get_template_directory_uri() .'/inc/css/admin.css' );
	
}


/**
 * Retrieves Redux Framework theme options array for use in template files
 *
 * @since 		Experience 1.0
 * @return		string title.
 **/
 
if ( !function_exists( 'experience_get_options' ) ) {
	
	function experience_get_options() {
		
		global $experience_theme_settings;
		
		return $experience_theme_settings;
		
	}
	
}

// Pagination
if ( !function_exists( 'experience_pagination_links' ) ) {
	
	function experience_pagination_links() {
	
		global $wp_query;
		
		if ( $wp_query->max_num_pages > 1 ) {			
			
			$output = '';
			
			$big = 999999999;
			
			$output .= '<div class="post-navigation padding-v">';
				
				$output .= paginate_links( array(
					'base'		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format'	=> '?paged=%#%',
					'current'	=> max( 1, get_query_var( 'paged' ) ),
					'total'		=> $wp_query->max_num_pages,
					'prev_text' => esc_html__( "&lsaquo; Prev", 'experience' ),
					'next_text' => esc_html__( "Next &rsaquo;", 'experience' )
				) );
			
			$output .= '</div>';
			
			echo $output;
			
		}
		
	}
	
}


/**
 * Outputs title of current page or post
 *
 * @since 		Experience 1.0
 * @return		string title.
 **/
 
if ( !function_exists( 'experience_the_title' ) ) {

	function experience_the_title() {		
		echo experience_get_the_title();
	}

}

if ( !function_exists( 'experience_get_the_title' ) ) {

	function experience_get_the_title() {
		
		global $post;
		
		$custom_page_title = get_post_meta( $post->ID, 'experience_page_title', true );
		
		if ( $custom_page_title != "" ) {
			$title = esc_html( $custom_page_title );
			apply_filters( 'the_title', $title );
		} else {
			$title = get_the_title();
		}

		return $title;

	}

}


if ( !function_exists( 'experience_resize_text' ) ) {

	function experience_resize_text( $string = false, $resize = 9 ) {
		
		if ( $string != false ) {
		
			$long_word = false;			
			$words = explode( " ", $string );
			
			foreach ( $words as $word ) {
				
				if ( strlen( $word ) > intval( $resize ) ) {
					$long_word = true;
				}
			
			}
			
			if (
				$long_word == true 
				|| count( $words ) > 3
			) {
				$string = '<span class="small-text">'. $string .'</span>';				
			}
			
			// Sanitize string
			$string = wp_kses( $string, array( 'span' => array( 'class' => array() ) ) );
			
			return $string;
			
		} else {
			
			return false;
			
		}

	}

}


/**
 * Outputs site logo depending on theme options and template options setting
 *
 * @since Experience 1.0
 *
 * @return void
 **/

if ( !function_exists( 'experience_the_logo' ) ) {

	function experience_the_logo() {
		
		global $experience_theme_settings, $post;
		
		$output = '';
		
		$title_attr = get_bloginfo( 'name' );
		if ( get_bloginfo( 'description' ) != "" ) { 
			$title_attr .= $title_attr .' - '. get_bloginfo( 'description' ); 
		}

		if (
			isset( $experience_theme_settings['logo-header']['url'] ) 
			&& $experience_theme_settings['logo-header']['url'] != "" 
		) {
			
			// First look for a logo from transparent logo option.
			
			// Posts & Pages
			if (
				is_singular()
				&& get_post_meta( $post->ID, 'experience_transparent_nav_bg', true ) == 'on'
				&& get_post_meta( $post->ID, 'experience_alt_site_logo', true ) != ''
			) {
				
				$output = '<img class="logo-image transparent" src="'. esc_url( get_post_meta( $post->ID, 'experience_alt_site_logo', true ) ) .'" alt="'. esc_attr( $title_attr ) .'" />';
				
			// Post Archives
			} else if (
				(
					is_home()
					|| ( is_archive() && !is_archive( 'portfolio' ) )
				)
				&& (
					!empty( $experience_theme_settings['blog-transparent-nav'] )
					&& !empty( $experience_theme_settings['blog-transparent-nav-logo']['url'] )
				)
			) {
				
				$output = '<img class="logo-image transparent" src="'. esc_url( $experience_theme_settings['blog-transparent-nav-logo']['url'] ) .'" alt="'. esc_attr( $title_attr ) .'" />';			
			
			// Portfolio Archives
			} else if (
				(
					is_tax( 'portfolio_category' )
					|| is_tax( 'portfolio_tag' )
					|| is_archive( 'portfolio' )
				)
				&& (
					!empty( $experience_theme_settings['portfolio-transparent-nav'] )
					&& !empty( $experience_theme_settings['portfolio-transparent-nav-logo']['url'] )
				)
			) {
				
				$output = '<img class="logo-image transparent" src="'. esc_url( $experience_theme_settings['portfolio-transparent-nav-logo']['url'] ) .'" alt="'. esc_attr( $title_attr ) .'" />';
			
			// 404
			} else if (
				is_404()
				&& (
					!empty( $experience_theme_settings['404-transparent-nav'] )
					&& !empty( $experience_theme_settings['404-transparent-nav-logo']['url'] )
				)
			) {
			
				$output = '<img class="logo-image transparent" src="'. esc_url( $experience_theme_settings['404-transparent-nav-logo']['url'] ) .'" alt="'. esc_attr( $title_attr ) .'" />';						
			
			}
		
			// Default image logo (set in theme options)
			$output .= '<img class="logo-image default" src="'. esc_url( $experience_theme_settings['logo-header']['url'] ) .'" alt="'. esc_attr( $title_attr ) .'" />';
			
		} else if (
			isset( $experience_theme_settings['logo-text'] ) 
			&& $experience_theme_settings['logo-text'] != "" 
		) {
		
			// Text logo
			$output = '<span class="logo-text">'. esc_html( $experience_theme_settings['logo-text'] ) .'</span>';
			
		} else {
		
			// Text logo
			$output = '<span class="logo-text">'. get_bloginfo( 'name' ) .'</span>';
			
		}
		
		echo $output;

	}

}


/*-----------------------------------------------------------------------------------
	BODY CLASS
-----------------------------------------------------------------------------------*/

/**
 * Extends the default WordPress body class to denote:
 * 1. Number of navigation links rows
 *
 * @since		Experience 1.0
 * @param		array $classes Existing class values.
 * @return		array Filtered class values.
 **/

add_filter( 'body_class', 'experience_body_class' );
function experience_body_class ( $classes ) {
	
	global $post, $experience_theme_settings;
	
	if (
		// Pages & Posts
		( is_singular() && get_post_meta( $post->ID, 'experience_transparent_nav_bg', true ) == 'on' )
		|| ( // Post Archives
			(
				( is_archive() && get_post_type() != 'portfolio' )
				|| is_home()
				|| is_search()
			)
			&& (
				!empty( $experience_theme_settings['blog-transparent-nav'] )
				&& $experience_theme_settings['blog-transparent-nav'] == '1'
			)
		)		
		|| ( // Portfolio Archives
			(
				is_tax( 'portfolio_category' )
				|| is_tax( 'portfolio_tag' )
				|| is_archive( 'portfolio' )
			)
			&& (
				!empty( $experience_theme_settings['portfolio-transparent-nav'] )
				&& $experience_theme_settings['portfolio-transparent-nav'] == '1'
			)
		)		
		|| ( // 404
			is_404()
			&& (
				!empty( $experience_theme_settings['404-transparent-nav'] )
				&& $experience_theme_settings['404-transparent-nav'] == '1'
			)			
		)
	) {
		$classes[] = 'nav-transparent unscrolled';
	}
	
	return $classes;
	
}

	
/*-----------------------------------------------------------------------------------
  ADD CUSTOM CSS
-----------------------------------------------------------------------------------*/

/**
 * Output custom CSS from theme options in page head.
 *
 * @since		Experience 1.0
 * @return		string Custom CSS styles
 **/
 
add_action( 'wp_head', 'experience_add_custom_css' );
function experience_add_custom_css () {
	
	global $experience_theme_settings;
	
	if (
		!empty( $experience_theme_settings['custom-css'] )
		|| !empty( $experience_theme_settings['custom-css-desktop'] )
		|| !empty( $experience_theme_settings['custom-css-mobile'] )
	) {
	
		echo "<!-- Custom CSS -->\n
		<style type=\"text/css\">";
			
			if ( !empty( $experience_theme_settings['custom-css'] ) ) {
				echo esc_attr( $experience_theme_settings['custom-css'] );
			}
			
			if ( !empty( $experience_theme_settings['custom-css-desktop'] ) ) {
				echo "@media only screen and ( min-width: 768px ) { ". esc_html( $experience_theme_settings['custom-css-desktop'] ) ." }";				
			}
			
			if ( !empty( $experience_theme_settings['custom-css-mobile'] ) ) {
				echo "@media only screen and ( max-width: 767px ) { ". esc_attr( $experience_theme_settings['custom-css-mobile'] ) ." }";			
			}
			
		echo "</style>";

	}
	
}


/*-----------------------------------------------------------------------------------
  CLEAN PROTECTED / PRIVATE POST TITLES
-----------------------------------------------------------------------------------*/

/**
 * Remove "Protected" and "Private" text in passworded page's title.
 *
 * @since		Experience 1.0
 * @return		string Modified page title.
 **/
  
add_filter( 'the_title', 'experience_change_protected_title' );
function experience_change_protected_title( $title ) {

	$find = array(
		'#Protected:#',
		'#Private:#'
	);

	$replace = array(
		'', // What to replace "Protected:" with
		'' 	// What to replace "Private:" with
	);

	$title = preg_replace( $find, $replace, $title );
	
	return $title;
	
}


/*-----------------------------------------------------------------------------------
  EXCERPTS
-----------------------------------------------------------------------------------*/

/**
 * Remove the default more link from excerpts
 *
 * @since		Experience 1.0
 * @return		string
 **/
 
add_filter( 'excerpt_more', 'experience_new_excerpt_more' );
function experience_new_excerpt_more( $more ) {
	return '...';
}


/**
 * Sets generated excerpt length
 *
 * @since		Experience 1.0
 * @return		integer 
 **/

add_filter( 'excerpt_length', 'experience_excerpt_length' );
function experience_excerpt_length( $length ) {
	return 30;
}

/**
 * Enable excerpts on pages.
 *
 * @since		Experience 1.0
 * @return		void
 **/
 
add_action( 'init', 'experience_add_excerpts_to_pages' );
function experience_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}


/*-----------------------------------------------------------------------------------
  REGISTER SIDEBARS
-----------------------------------------------------------------------------------*/

/**
 * Register theme sidebar areas
 *
 * @since		Experience 1.0
 * @return		void
 **/
 
add_action( 'widgets_init', 'experience_register_sidebars' );
function experience_register_sidebars() {

	$experience_sidebar_attr = array(
		'name'          => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	);
	
	// "Sidebar Name" => "Description"
	$experience_sidebars = array(
		esc_html__( "Footer", 'experience' ) => esc_html__( "Widgets placed here appear in the site footer on all pages where the footer is enabled.", 'experience' )
	);
	
	$i = 1;
	
	foreach ( $experience_sidebars as $sidebar_name => $sidebar_desc ) {
		
		$experience_sidebar_attr['id']			= experience_get_sidebar_name( $sidebar_name );
		$experience_sidebar_attr['name']		= esc_html( $sidebar_name );
		$experience_sidebar_attr['description']	= esc_html( $sidebar_desc );
		
		register_sidebar( $experience_sidebar_attr );
		$i++;
		
	};

}


/**
 * Escape and prefix sidebar name.
 *
 * @since		Experience 1.0
 * @return		string	escaped and prefixed sidebar name
 **/
 
if ( ! function_exists( 'experience_get_sidebar_name' ) ) {

	function experience_get_sidebar_name( $sidebar_name ) {
		
		//Lower case everything
		$sidebar_name_clean = strtolower( esc_html( $sidebar_name ) );
		//Make alphanumeric (removes all other characters)
		$sidebar_name_clean = preg_replace( "/[^a-z0-9_\s-]/", "", $sidebar_name_clean );
		//Clean up multiple dashes or whitespaces
		$sidebar_name_clean = preg_replace( "/[\s-]+/", " ", $sidebar_name_clean );
		//Convert whitespaces and underscore to dash
		$sidebar_name_clean = preg_replace( "/[\s_]/", "-", $sidebar_name_clean );
		// prefix
		$sidebar_name_clean = 'sidebar-'. $sidebar_name_clean;
		
		return $sidebar_name_clean;
	
	}
	
}

/*-----------------------------------------------------------------------------------
	SECTION BACKGROUNDS
-----------------------------------------------------------------------------------*/

/**
 * Conditional to check if post has background media attached.
 *
 * @since Experience 1.0
 *
 * @return booleen 
 **/

if ( ! function_exists( 'experience_has_background' ) ) {
	
	function experience_has_background() {
		
		global $post;
		
		if ( 
			get_post_meta( $post->ID, 'experience_content_bg_image', true ) != ""
			|| get_post_meta( $post->ID, 'experience_content_bg_video_mp4', true ) != ""
			|| get_post_meta( $post->ID, 'experience_content_bg_video_webm', true ) != ""
		) {		
			return true;
		} else {
			return false;
		}
	
	}

}


/**
 * Outputs Header background from template options
 *
 * @since Experience 1.0
 *
 * @param		string $image			The background image file path.
 * @param		string $mp4_url			The background MP4 file path.
 * @param		string $webm_url		The background WebM file path.
 * @param		string $parallax_speed	Parallax scroll speed.
 *
 * @return string section background HTML mark up.
 **/
 
if ( ! function_exists( 'experience_get_background' ) ) {

	function experience_get_background( $image = false, $mp4 = false, $webm = false, $parallax_speed = false, $v_offset = false, $h_offset = false, $echo = true ) {
		
		global $post;
		
		if (
			$image != ""
			//|| $mp4 != ""
			//|| $webm != ""
		) {
			
			$output = '<div class="background-holder">';
			
				//if (
				//	$mp4 != ""
				//	|| $webm != ""
				//) {

					// Video Source
					//$output .= '<div class="video-container">
					//	<video class="background-video" preload="auto" autoplay="autoplay" loop>';
					//		if ( $mp4 != "" ) {
					//			$output .= '<source src="'. esc_url( $mp4 ) .'" type="video/mp4">';
					//		}
					//		if ( $webm != "" ) {
					//			$output .= '<source src="'. esc_url( $webm ) .'" type="video/webm">';
					//		}
					//	$output .= '</video>
					//</div>';
					
				//}
				
				// Background Image
				//if ( $image != "" ) {					
					$output .= '<div class="background-image" style="background-image: url('. esc_url( $image ) .');"></div>';				
				//}
				
				$output .= '<div class="background-overlay"></div>';
			
			$output .= '</div>';
			
			if ( $echo == true ) {
				echo $output;
			} else {
				return $output;
			}
			
		}

	}
	
}


/*-----------------------------------------------------------------------------------
	OEMBED
-----------------------------------------------------------------------------------*/

/**
 * Returns oEmbed HTML markup from supplied URL
 *
 * @since Experience 1.0
 *
 * @return string oEmbed HTML mark up.
 **/
 
if ( ! function_exists( 'experience_oembed' ) ) {

	function experience_oembed( $url = false, $post_id = false ) {

		global $wp_embed, $post;
		
		// Check for a URL passed to the function
		if ( $url == false ) {
			
			// Check for a post ID passed to the function
			if ( $post_id == false ) {
			
				// Set the post_id variable to the supplied post ID
				$post_id = $post->ID;
			
			}
			
			// Get URL from post custom field
			$embed_code = $wp_embed->shortcode( false, esc_url( get_post_meta( $post_id, 'experience_embed_url', true ) ) );
			
		} else {
		
			// Set variable using supplied URL
			$embed_code = esc_url( $url );
			
		}
	
		// Check that there's a URL to work with (either passed to the function
		// or retrieved from the post's custom field.
		if ( $embed_code == '' ) {
			
			print_r( 'Error: No URL found.' );
			
		} else {
		
			$pattern = get_shortcode_regex();
			
			// Output embed code
			if ( preg_match( '/'. $pattern .'/s', $embed_code, $matches ) ) {
				echo do_shortcode( $embed_code );					
			} else {
				echo $embed_code;
			}
		
		}
		
	}
	
}


/*-----------------------------------------------------------------------------------
	SOCIAL BUTTONS
-----------------------------------------------------------------------------------*/

/**
 * Outputs social buttons
 *
 * @since Experience 1.0
 *
 * @return string Social buttons HTML mark up.
 **/

if ( ! function_exists( 'experience_social_buttons' ) ) {

	function experience_social_buttons() {		
		do_action( 'experience_social_buttons_before' );		
		do_action( 'experience_social_buttons' );		
		do_action( 'experience_social_buttons_after' );		
	}

}


/**
 * Outputs social buttons wrapper opening
 *
 * @since Experience 1.0
 *
 * @return string HTML mark up.
 **/
add_action( 'experience_social_buttons_before', 'experience_social_buttons_open' );
function experience_social_buttons_open() {
	echo '<div class="social-buttons narrow-width">';
	echo '<div class="social-buttons-holder">';
}


/**
 * Social buttons
 *
 * @since Experience 1.0
 *
 * @return string HTML mark up.
 **/
 
// Facebook
add_action( 'experience_social_buttons', 'experience_social_buttons_facebook' );
function experience_social_buttons_facebook() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['facebook-url'] ) ) {
		echo '<a class="social-button facebook" href="'. esc_url( $experience_theme_settings['facebook-url'] ) .'" title="'. esc_attr__( "Find us on Facebook", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-facebook"></span><span class="social-button-text">'. esc_html__( "Facebook", 'experience' ) .'</span>
			</a>';
	}
	
}


// Twitter
add_action( 'experience_social_buttons', 'experience_social_buttons_twitter' );
function experience_social_buttons_twitter() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['twitter-url'] ) ) {
		echo '<a class="social-button twitter" href="'. esc_url( $experience_theme_settings['twitter-url'] ) .'" title="'. esc_attr__( "Find us on Twitter", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-twitter"></span><span class="social-button-text">'. esc_html__( "Twitter", 'experience' ) .'</span>
			</a>';
	}

}


// Google+
add_action( 'experience_social_buttons', 'experience_social_buttons_googleplus' );
function experience_social_buttons_googleplus() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['google-plus-url'] ) ) {
		echo '<a class="social-button google" href="'. esc_url( $experience_theme_settings['google-plus-url'] ) .'" title="'. esc_attr__( "Find us on Google+", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-googleplus"></span><span class="social-button-text">'. esc_html__( "Google", 'experience' ) .'</span>
			</a>';
	}

}

// YouTube
add_action( 'experience_social_buttons', 'experience_social_buttons_youtube' );
function experience_social_buttons_youtube() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['youtube-url'] ) ) {
		echo '<a class="social-button youtube" href="'. esc_url( $experience_theme_settings['youtube-url'] ) .'" title="'. esc_attr__( "Find us on YouTube", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-youtube"></span><span class="social-button-text">'. esc_html__( "YouTube", 'experience' ) .'</span>
			</a>';
	}

}

// Vimeo
add_action( 'experience_social_buttons', 'experience_social_buttons_vimeo' );
function experience_social_buttons_vimeo() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['vimeo-url'] ) ) {
		echo '<a class="social-button vimeo" href="'. esc_url( $experience_theme_settings['vimeo-url'] ) .'" title="'. esc_attr__( "Find us on Vimeo", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-vimeo"></span><span class="social-button-text">'. esc_html__( "Vimeo", 'experience' ) .'</span>
			</a>';
	}

}

// Flickr
add_action( 'experience_social_buttons', 'experience_social_buttons_flickr' );
function experience_social_buttons_flickr() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['flickr-url'] ) ) {
		echo '<a class="social-button flickr" href="'. esc_url( $experience_theme_settings['flickr-url'] ) .'" title="'. esc_attr__( "Find us on Flickr", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-flickr"></span><span class="social-button-text">'. esc_html__( "Flickr", 'experience' ) .'</span>
			</a>';
	}

}

// Dribbble
add_action( 'experience_social_buttons', 'experience_social_buttons_dribbble' );
function experience_social_buttons_dribbble() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['dribbble-url'] ) ) {
		echo '<a class="social-button dribbble" href="'. esc_url( $experience_theme_settings['dribbble-url'] ) .'" title="'. esc_attr__( "Find us on Dribbble", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-dribbble"></span><span class="social-button-text">'. esc_html__( "Dribbble", 'experience' ) .'</span>
			</a>';
	}

}

// Instagram
add_action( 'experience_social_buttons', 'experience_social_buttons_instagram' );
function experience_social_buttons_instagram() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['instagram-url'] ) ) {
		echo '<a class="social-button instagram" href="'. esc_url( $experience_theme_settings['instagram-url'] ) .'" title="'. esc_attr__( "Find us on Instagram", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-instagram"></span><span class="social-button-text">'. esc_html__( "Instagram", 'experience' ) .'</span>
			</a>';
	}

}

// Pinterest
add_action( 'experience_social_buttons', 'experience_social_buttons_pinterest' );
function experience_social_buttons_pinterest() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['pinterest-url'] ) ) {
		echo '<a class="social-button pinterest" href="'. esc_url( $experience_theme_settings['pinterest-url'] ) .'" title="'. esc_attr__( "Find us on Pinterest", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-pinterest"></span><span class="social-button-text">'. esc_html__( "Pinterest", 'experience' ) .'</span>
			</a>';
	}

}


// Behance
add_action( 'experience_social_buttons', 'experience_social_buttons_behance' );
function experience_social_buttons_behance() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['behance-url'] ) ) {
		echo '<a class="social-button behance" href="'. esc_url( $experience_theme_settings['behance-url'] ) .'" title="'. esc_attr__( "Find us on Behance", 'experience' ) .'" target="_blank">
				<span class="social-button-icon funky-icon-behance"></span><span class="social-button-text">'. esc_html__( "Behance", 'experience' ) .'</span>
			</a>';		
	}

}


// FourSquare
add_action( 'experience_social_buttons', 'experience_social_buttons_foursquare' );
function experience_social_buttons_foursquare() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['foursquare-url'] ) ) {
		echo '<a class="social-button foursquare" href="'. esc_url( $experience_theme_settings['foursquare-url'] ) .'" title="'. esc_attr__( "Find us on Foursquare", 'experience' ) .'" target="_blank">
				<span class="funky-icon-foursquare"></span><span class="social-button-text">'. esc_html__( "Foursquare", 'experience' ) .'</span>
			</a>';
	}

}

// Github
add_action( 'experience_social_buttons', 'experience_social_buttons_github' );
function experience_social_buttons_github() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['github-url'] ) ) {
		echo '<a class="social-button github" href="'. esc_url( $experience_theme_settings['github-url'] ) .'" title="'. esc_attr__( "Find us on Github", 'experience' ) .'" target="_blank">
				<span class="funky-icon-github"></span><span class="social-button-text">'. esc_html__( "Github", 'experience' ) .'</span>
			</a>';
	}

}

// LinkedIn
add_action( 'experience_social_buttons', 'experience_social_buttons_linkedin' );
function experience_social_buttons_linkedin() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['linkedin-url'] ) ) {
		echo '<a class="social-button linkedin" href="'. esc_url( $experience_theme_settings['linkedin-url'] ) .'" title="'. esc_attr__( "Find us on LinkedIn", 'experience' ) .'" target="_blank">
				<span class="funky-icon-linkedin"></span><span class="social-button-text">'. esc_html__( "LinkedIn", 'experience' ) .'</span>
			</a>';
	}

}

// Tumblr
add_action( 'experience_social_buttons', 'experience_social_buttons_tumblr' );
function experience_social_buttons_tumblr() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['tumblr-url'] ) ) {
		echo '<a class="social-button tumblr" href="'. esc_url( $experience_theme_settings['tumblr-url'] ) .'" title="'. esc_attr__( "Find us on Tumblr", 'experience' ) .'" target="_blank">
				<span class="funky-icon-tumblr"></span><span class="social-button-text">'. esc_html__( "Tumblr", 'experience' ) .'</span>
			</a>';
	}

}

// Apple
add_action( 'experience_social_buttons', 'experience_social_buttons_apple' );
function experience_social_buttons_apple() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['apple-url'] ) ) {
		echo '<a class="social-button apple" href="'. esc_url( $experience_theme_settings['apple-url'] ) .'" title="'. esc_attr__( "Find us on the App Store", 'experience' ) .'" target="_blank">
				<span class="funky-icon-apple"></span><span class="social-button-text">'. esc_html__( "App Store", 'experience' ) .'</span>
			</a>';
	}

}

// Android
add_action( 'experience_social_buttons', 'experience_social_buttons_android' );
function experience_social_buttons_android() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['android-url'] ) ) {
		echo '<a class="social-button android" href="'. esc_url( $experience_theme_settings['android-url'] ) .'" title="'. esc_attr__( "Find us on Google Play", 'experience' ) .'" target="_blank">
				<span class="funky-icon-android"></span><span class="social-button-text">'. esc_html__( "Google Play", 'experience' ) .'</span>
			</a>';
	}

}

// Skype
add_action( 'experience_social_buttons', 'experience_social_buttons_skype' );
function experience_social_buttons_skype() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['skype-url'] ) ) {
		echo '<a class="social-button skype" href="'. esc_url( $experience_theme_settings['skype-url'] ) .'" title="'. esc_attr__( "Find us on Skype", 'experience' ) .'" target="_blank">
				<span class="funky-icon-skype"></span><span class="social-button-text">'. esc_html__( "Skype", 'experience' ) .'</span>
			</a>';
	}

}

// VK
add_action( 'experience_social_buttons', 'experience_social_buttons_vk' );
function experience_social_buttons_vk() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['vk-url'] ) ) {
		echo '<a class="social-button vk" href="'. esc_url( $experience_theme_settings['vk-url'] ) .'" title="'. esc_attr__( "Find us on VK", 'experience' ) .'" target="_blank">
				<span class="funky-icon-vk"></span><span class="social-button-text">'. esc_html__( "VK", 'experience' ) .'</span>
			</a>';
	}

}

// Stack Overflow
add_action( 'experience_social_buttons', 'experience_social_buttons_stackoverflow' );
function experience_social_buttons_stackoverflow() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['stackoverflow-url'] ) ) {
		echo '<a class="social-button stackoverflow" href="'. esc_url( $experience_theme_settings['stackoverflow-url'] ) .'" title="'. esc_attr__( "Find us on Stack Overflow", 'experience' ) .'" target="_blank">
				<span class="funky-icon-stackoverflow"></span><span class="social-button-text">'. esc_html__( "Stack Overflow", 'experience' ) .'</span>
			</a>';
	}

}

// Steam
add_action( 'experience_social_buttons', 'experience_social_buttons_steam' );
function experience_social_buttons_steam() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['steam-url'] ) ) {
		echo '<a class="social-button steam" href="'. esc_url( $experience_theme_settings['steam-url'] ) .'" title="'. esc_attr__( "Find us on Steam", 'experience' ) .'" target="_blank">
				<span class="funky-icon-steam"></span><span class="social-button-text">'. esc_html__( "Steam", 'experience' ) .'</span>
			</a>';
	}

}

// Twitch
add_action( 'experience_social_buttons', 'experience_social_buttons_twitch' );
function experience_social_buttons_twitch() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['twitch-url'] ) ) {
		echo '<a class="social-button twitch" href="'. esc_url( $experience_theme_settings['twitch-url'] ) .'" title="'. esc_attr__( "Find us on Twitch", 'experience' ) .'" target="_blank">
				<span class="funky-icon-twitch"></span><span class="social-button-text">'. esc_html__( "Twitch", 'experience' ) .'</span>
			</a>';
	}

}

// Trip Advisor
add_action( 'experience_social_buttons', 'experience_social_buttons_tripadvisor' );
function experience_social_buttons_tripadvisor() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['tripadvisor-url'] ) ) {
		echo '<a class="social-button tripadvisor" href="'. esc_url( $experience_theme_settings['tripadvisor-url'] ) .'" title="'. esc_attr__( "Find us on Trip Advisor", 'experience' ) .'" target="_blank">
				<span class="funky-icon-tripadvisor"></span><span class="social-button-text">'. esc_html__( "Trip Advisor", 'experience' ) .'</span>
			</a>';
	}

}

// Yelp
add_action( 'experience_social_buttons', 'experience_social_buttons_yelp' );
function experience_social_buttons_yelp() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['yelp-url'] ) ) {
		echo '<a class="social-button yelp" href="'. esc_url( $experience_theme_settings['yelp-url'] ) .'" title="'. esc_attr__( "Find us on Yelp", 'experience' ) .'" target="_blank">
				<span class="funky-icon-yelp"></span><span class="social-button-text">'. esc_html__( "Yelp", 'experience' ) .'</span>
			</a>';
	}

}

// SoundCloud
add_action( 'experience_social_buttons', 'experience_social_buttons_soundcloud' );
function experience_social_buttons_soundcloud() {
	
	global $experience_theme_settings;
	
	if ( !empty( $experience_theme_settings['soundcloud-url'] ) ) {
		echo '<a class="social-button soundcloud" href="'. esc_url( $experience_theme_settings['soundcloud-url'] ) .'" title="'. esc_attr__( "Find us on SoundCloud", 'experience' ) .'" target="_blank">
				<span class="funky-icon-soundcloud"></span><span class="social-button-text">'. esc_html__( "SoundCloud", 'experience' ) .'</span>
			</a>';
	}

}


// Social button after
add_action( 'experience_social_buttons_after', 'experience_social_buttons_close' );
function experience_social_buttons_close() {
	echo '</div></div>';
}


/*-----------------------------------------------------------------------------------
	WMPL Selector
-----------------------------------------------------------------------------------*/

if ( !function_exists( 'experience_lang_selector' ) ) {

	function experience_lang_selector() {
	
		if ( function_exists( 'icl_get_languages' ) ) {
		
			$languages = icl_get_languages( 'skip_missing=0&orderby=custom' );
			
			if( !empty( $languages ) ) {			
			
				$output = '<ul class="menu languages-menu">';
			
					foreach( $languages as $l ) {				
						$output .= '<li><a href="'. esc_url( $l['url'] ) .'">'. esc_html( $l['native_name'] ) .'</a></li>';
					}
			
				$output .= '</ul>';
				
				echo $output;
		
			}
			
		} else {
			
			return false;
			
		}
	
	}
	
}

if ( !function_exists( 'experience_get_active_lang' ) ) {

	function experience_get_active_lang() {
	
		if ( function_exists( 'icl_get_languages' ) ) {
		
			$languages = icl_get_languages( 'skip_missing=0&orderby=custom' );
			
			if( !empty( $languages ) ) {
			
				$output = '';
			
				foreach( $languages as $l ) {			
					if( $l['active'] ) {					
						$output = '<span class="language-toggle">'. esc_html( $l['language_code'] ) .'</span>';
					}			
				}
			
				return $output;			
		
			} else {
				
				return false;
		
			}
		
		} else {
			
			return false;
			
		}
	
	}
	
}

/*-----------------------------------------------------------------------------------
	COMMENT FORM HTML
-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'experience_remove_recent_comments_style' );
function experience_remove_recent_comments_style() {  
    global $wp_widget_factory;  
    remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
}  


/**
 * Add additional HTML to comment forms
 *
 * @since Experience 1.0
 *
 * @return string HTML mark up.
 **/
 
add_action( 'comment_form_top', 'experience_comment_from_before' );
function experience_comment_from_before () {

	if ( is_page() ) {
		$comment_width = 'site-width';
	} else {
		$comment_width = 'narrow-width';
	}
	
	echo '<div class="comment-form-content padding-h '. esc_attr( $comment_width ) .'">
			<div class="col-padding">';
}

add_action( 'comment_form', 'experience_comment_form_after' );
function experience_comment_form_after () {
		echo '</div>
	</div>';
}


/*-----------------------------------------------------------------------------------
	TGM PLUGIN ACTIVATION CLASS
-----------------------------------------------------------------------------------*/

/**
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Experience for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 **/
 
//Include the TGM_Plugin_Activation class.
require_once get_template_directory() .'/inc/plugins/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'experience_register_required_plugins' );
function experience_register_required_plugins() {	

	$plugins = array(
		
		// CMB2
		array(
			'name' 					=> 'CMB2',
			'slug' 					=> 'cmb2',
			'required'			 	=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'version'            	=> '', 
		),
		
		// Contact Form 7
		array(
			'name' 					=> 'Contact Form 7',
			'slug' 					=> 'contact-form-7',
			'required'			 	=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'version'            	=> '', 
		),
		
		// Experience Visual Composer Extension
		array(
			'name' 					=> 'Experience Visual Composer Extension',
			'slug' 	  	            => 'js_composer_experience',
			'source'   				=> get_template_directory_uri() .'/inc/plugins/js_composer_experience.zip',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'version'            	=> '1.0.6',
		),
		
		// Portfolio Post Type
		array(
			'name'			 		=> 'Portfolio Post Type',
			'slug' 					=> 'portfolio-post-type',
			'required' 				=> false,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'version'            	=> '',
		),
		
		// Redux Framework
		array(
			'name' 					=> 'Redux Framework',
			'slug' 					=> 'redux-framework',
			'required'			 	=> true,
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'version'            	=> '',
		)
		
	);

	/**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id'           => 'experience',                 					// Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory_uri() .'/inc/plugins/', 		// Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins', 								// Menu slug.
		'parent_slug'  => 'themes.php',            								// Parent menu slug.
        'capability'   => 'edit_theme_options',   								// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                   								// Show admin notices or not.
        'dismissable'  => true,                    								// If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      								// If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   								// Automatically activate plugins after installation or not.
        'message'      => '',                     								// Message to output right before the plugins table.		
    );

    tgmpa( $plugins, $config );

}