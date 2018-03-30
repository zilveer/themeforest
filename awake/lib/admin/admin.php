<?php
/**
 * The Mysitemyway admin class.
 * The theme admin functions & classes are included & initialized from this file.
 *
 * @package Mysitemyway
 * @subpackage Admin
 */

class mysiteAdmin {
	
	/**
	 * Initializes the theme admin framework by loading
	 * required files and functions for the theme options,
	 * meta boxes, skin generator, etc...
	 *
	 * @since 1.0
	 */
	function init() {
		self::functions();
		self::classes();
		self::actions();
		self::filters();
		self::metaboxes();
		self::activation();
		self::update();
		new mysiteSkinGenerator();
	}
	
	/**
	 * Loads the theme admin functions.
	 *
	 * @since 1.0
	 */
	function functions() {
		require_once( THEME_ADMIN_FUNCTIONS . '/core.php' );
		require_once( THEME_ADMIN_FUNCTIONS . '/scripts.php' );
		require_once( THEME_ADMIN_FUNCTIONS . '/media-upload.php');
	}
	
	/**
	 * Loads the theme admin classes.
	 *
	 * @since 1.0
	 */
	function classes() {
		require_once( THEME_ADMIN_CLASSES . '/option-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/metaboxes-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/shortcode-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/skin-generator.php' );
		require_once( THEME_ADMIN_CLASSES . '/testimonials.php' );
		require_once( THEME_ADMIN_CLASSES . '/update.php' );
	}
	
	/**
	 * Adds the theme admin actions.
	 *
	 * @since 1.0
	 */
	function actions() {
		add_action( 'admin_init', 'mysite_options_init', 1 );
		add_action( 'admin_init', 'mysite_tinymce_init_size' );
		add_action( 'admin_init', array( 'mysiteTestimonial', 'init' ) );
		add_action( 'admin_notices', array( 'mysiteAdmin', 'warnings' ) );
		add_action( 'admin_menu', array( 'mysiteAdmin', 'menus' ) );
		add_action( 'admin_enqueue_scripts', 'mysite_admin_enqueue_scripts' );
		add_action( 'admin_head-toplevel_page_mysite-options', 'mysite_admin_print_scripts' );
		add_action( 'admin_head-toplevel_page_mysite-options', 'mysite_admin_tinymce' );
		add_action( 'wp_ajax_mysite_skin_upload', array( 'mysiteSkinGenerator', 'skin_upload' ) );
		add_action( 'save_post', 'mysite_dependencies' );
		add_action( 'save_post', 'delete_mysite_postspage_keywords' );
		
		if ( isset( $_GET['mysite_upload_button'] ) || isset( $_POST['mysite_upload_button'] ) )
			add_action( 'admin_init', 'mysite_image_upload_option' );
	}
	
	/**
	 * Adds the theme admin filters.
	 *
	 * @since 1.0
	 */
	function filters() {
		if( isset( $_GET['page'] ) && $_GET['page'] == 'mysite-options' )
			add_filter( 'tiny_mce_before_init', 'mysite_tiny_mce_before_init' );
	}
	
	/**
	 * Adds the theme options menu.
	 *
	 * @since 1.0
	 */
	function menus() {
		add_menu_page( THEME_NAME, THEME_NAME, 'edit_theme_options', 'mysite-options', array( 'mysiteAdmin', 'options' ) );
	}
	
	/**
	 * Creates the theme options menu.
	 *
	 * @since 1.0
	 */
	function options() {
		$page = include( THEME_ADMIN_OPTIONS . '/mysite-options.php' );
		
		if( $page['load'] ) {
			new mysiteOptionGenerator( $page['options'] );
		}
	}
	
	/**
	 * Adds the theme post/page metaboxes.
	 *
	 * @since 1.0
	 */
	function metaboxes() {
		$portfolio = include( THEME_ADMIN_OPTIONS . '/meta-portfolio.php' );
		$slideshow = include( THEME_ADMIN_OPTIONS . '/meta-post-slideshow.php' );
		$seo = include( THEME_ADMIN_OPTIONS . '/meta-seo.php' );
		$testimonial = include( THEME_ADMIN_OPTIONS . '/meta-testimonial.php' );
		$page = include( THEME_ADMIN_OPTIONS . '/meta-page.php' );
		$post = include( THEME_ADMIN_OPTIONS . '/meta-post.php' );
		
		new mysiteShortcodeMetaBox( $pages = array( 'page', 'post', 'portfolio' ) );
		
		if( $portfolio['load'] ) {
			new mysiteMetaBox( $portfolio['options'] );
		}
		
		if( $page['load'] ) {
			new mysiteMetaBox( $page['options'] );
		}
			
		if( $post['load'] ) {
			new mysiteMetaBox( $post['options'] );
		}
			
		if( $slideshow['load'] ) {
			new mysiteMetaBox( $slideshow['options'] );
		}
		
		if( $seo['load'] ) {
			new mysiteMetaBox( $seo['options'] );
		}
		
		if( $testimonial['load'] ) {
			new mysiteMetaBox( $testimonial['options'] );
		}
	}
	
	/**
	 * Checks & functions to run on theme activation.
	 *
	 * @since 1.0
	 */
	function activation() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {

			# Check php version
			if( version_compare( PHP_VERSION, '5', '<' ) ) {
				switch_theme( 'twentyeleven', 'twentyeleven' );
				$error_msg = 'Your PHP version is too old, please upgrade to a newer version. Your version is %s, %s requires %s<br /><a href="%s">Return to theme activation &raquo</a>';
				wp_die(sprintf( __( $error_msg, MYSITE_ADMIN_TEXTDOMAIN ), phpversion(), THEME_NAME, '5.0', admin_url( 'themes.php' ) ) );
			}
			
			# Add defualt widgets && show_on_front 'posts'
			if( get_option( MYSITE_SETTINGS ) == false ) {
				mysite_default_options( 'widgets' );
				update_option( 'show_on_front', 'posts' );
			}
				
			# Call mysite_post_types() & flush rewrite rules
			mysite_post_types();
			$wp_rewrite->flush_rules();

			# Redirect to admin panel
			wp_redirect(admin_url( "admin.php?page=mysite-options&activated=true" ));
		}
	}
	
	/**
	 * Checks frameworks current version and runs upgrade class if needed
	 *
	 * @since 1.6
	 */
	function update() {
		# only run on our options page
		if( isset( $_GET['page'] ) && $_GET['page'] == 'mysite-options' ) {
			# Get old framework version from database
			$internal_settings = get_option( MYSITE_INTERNAL_SETTINGS );

			# Check if current version is greater than the old one from database
			# If it is run our update class
			if( isset( $internal_settings['framework_version'] ) ) {
				if( version_compare( FRAMEWORK_VERSION, $internal_settings['framework_version'], '>' ) ) {
					new mysiteUpdate( $internal_settings['framework_version'] );

					# Update framework to new framework version in database
					update_option( MYSITE_INTERNAL_SETTINGS, mysite_default_options( 'internal' ) );
				}
			}
		}
	}
	
	/**
	 * Check current environment is supported for the theme.
	 * 
	 * @since 1.0
	 */
	function warnings(){
		global $wp_version;

		$errors = array();
		
		if( !mysite_check_wp_version() )
			$errors[]='Wordpress version('.$wp_version.') is too low. Please upgrade to 3.3';
		
		if( !empty( $errors ) ) {
			$str = '<ul>';
			foreach($errors as $error){
				$str .= '<li>'.$error.'</li>';
			}
			$str .= '</ul>';
			echo '<div class="error fade"><p><strong>' . sprintf( __( '%1$s Error Messages', MYSITE_ADMIN_TEXTDOMAIN ), THEME_NAME ) . '</strong><br />' . $str . '</p></div>';
		}
	}
	
}

?>