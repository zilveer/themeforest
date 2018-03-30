<?php
/**
 * Register jQuery scripts and 
 * CSS Styles only for the front-end
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/

function fave_theme_scripts(){
	global $ft_option;
	/**
	 * Register CSS styles
	 */

	wp_register_style( 'fave-owl.carousel.all.min', get_template_directory_uri(). '/css/owl.carousel.all.min.css', array(), '2.0.0', 'all' );

	wp_register_style( 'fave-bootstrap.min', get_template_directory_uri(). '/css/bootstrap.min.css', array(), '', 'all' );
	wp_register_style( 'fave-bootstrap-theme.min', get_template_directory_uri(). '/css/bootstrap-theme.min.css', array(), '', 'all' );
	wp_register_style( 'fave-font-awesome.min', get_template_directory_uri(). '/css/font-awesome.min.css', array(), '4.5.0', 'all' );
	wp_register_style( 'fave-jquery.jscrollpane', get_template_directory_uri(). '/css/jquery.jscrollpane.css', array(), '', 'all' );
	wp_register_style( 'fave-magnific-popup', get_template_directory_uri(). '/css/magnific-popup.css', array(), '1.0.0', 'all' );
	wp_register_style( 'fave-main', get_template_directory_uri(). '/css/main.css', array(), '', 'all' );
	wp_register_style( 'fave-options', get_template_directory_uri(). '/css/options.css', array(), '', 'all' );

	wp_enqueue_style( 'fave-bootstrap.min' );
	wp_enqueue_style( 'fave-bootstrap-theme.min' );
	wp_enqueue_style( 'fave-font-awesome.min' );
	wp_enqueue_style( 'fave-jquery.jscrollpane' );
	wp_enqueue_style( 'fave-owl.carousel.all.min' );
	wp_enqueue_style( 'fave-magnific-popup' );
	wp_enqueue_style( 'fave-main' );
	wp_enqueue_style( 'fave-options' );
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), '1', 'all' );

	if ( is_rtl() ) {
		wp_enqueue_style(  'magzilla-rtl',  get_template_directory_uri() ."/css/rtl.css", array(), '1', 'screen' );
	}
	 

    wp_enqueue_script( 'fave-bootstrap.min', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), THEME_VERSION, true );
    wp_enqueue_script( 'fave-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), THEME_VERSION, true );
	wp_enqueue_script( 'fave-custom.min', get_template_directory_uri() . '/js/custom.min.js', array('jquery'), THEME_VERSION, true );
	
	
	if ( ( is_singular('post') || is_singular('gallery') || is_singular('video') ) && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}

if(!is_admin()){
	add_action( 'wp_enqueue_scripts', 'fave_theme_scripts' );
}

if (is_admin() ){
	function fave_admin_scripts(){

		global $pagenow, $typenow;

		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' || $pagenow == 'nav-menus.php' ) {
			wp_register_script( 'fave-metajs', get_template_directory_uri() . '/js/admin/init.js', array( 'jquery' ) );
			wp_enqueue_script( 'fave-metajs' );
		}

		wp_register_style( 'fave-admin.css', get_template_directory_uri(). '/css/admin/admin.css', array(), '1.0', 'all' );
		wp_enqueue_style( 'fave-admin.css' );

		if ( ( $pagenow == 'edit-tags.php' || $pagenow == 'term.php' ) && isset( $_GET['taxonomy'] ) && ( $_GET['taxonomy'] == 'category' || $_GET['taxonomy'] == 'video-categories'  || $_GET['taxonomy'] == 'gallery-categories' ) ) {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'fave_category', get_template_directory_uri().'/js/metaboxes-category.js', array( 'jquery', 'wp-color-picker' ), 'magzilla' );
		}

		//Load post & page metaboxes css and js
		if ( $pagenow == 'post.php' || $pagenow == 'post-new.php' ) {
			if ( $typenow == 'post' ) {
				wp_enqueue_script( 'fave_post_metaboxes', get_template_directory_uri().'/js/metaboxes-post.js', array( 'jquery' ), 'magzilla' );
			} elseif ( $typenow == 'page' || $typenow == 'gallery' || $typenow == 'video' ) {
				wp_enqueue_script( 'fave_post_metaboxes', get_template_directory_uri().'/js/metaboxes-page.js', array( 'jquery' ), 'magzilla' );
			}
		}

	}
}

add_action('admin_enqueue_scripts', 'fave_admin_scripts');

// Header custom JS
function fave_header_scripts(){
	global $ft_option;
	
	if ( isset($ft_option['custom_js_header']) != '' ){
		echo '<script type="text/javascript">'."\n",
				$ft_option['custom_js_header']."\n",
			 '</script>'."\n";
	}
}
if(!is_admin()){
	add_action('wp_head', 'fave_header_scripts');
}

// Footer custom JS
function fave_footer_scripts(){
	global $ft_option;
	
	if ( isset($ft_option['custom_js_footer']) != '' ){
		echo '<script type="text/javascript">'."\n",
				$ft_option['custom_js_footer']."\n",
			 '</script>'."\n";
	}
}
if(!is_admin()){
	add_action( 'wp_footer', 'fave_footer_scripts', 100 );
}