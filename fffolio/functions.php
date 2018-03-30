<?php
$fffolio = get_option('fffolio');
add_action( 'after_setup_theme', 'vp_setup' );
if ( ! function_exists( 'vp_setup' ) ){
	function vp_setup(){
		global $fffolio;
		require get_template_directory() . '/teoPanel/custom-functions.php';
		require get_template_directory() . '/includes/shortcodes.php';
		require get_template_directory() . '/includes/comments.php';
		require get_template_directory() . '/includes/additional_functions.php';
		require get_template_directory() . '/teoPanel/shortcodes/shortcodes.php';
		load_theme_textdomain('SCRN', get_template_directory() . '/languages');
		$current_user = wp_get_current_user();
		if($fffolio['superadmin'] == '' || $current_user->user_login == $fffolio['superadmin'])
			require 'teoPanel/nhp-options.php';
	}
}
// Loading js files into the theme
add_action('wp_head', 'vp_scripts');
if ( !function_exists('vp_scripts') ) {
	function vp_scripts() {
		global $fffolio;
		wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array(), '1.0');
		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), '1.0');
		wp_enqueue_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), '1.0');
		wp_enqueue_script( 'sorting', get_template_directory_uri() . '/js/sorting.js', array(), '1.0');
		wp_enqueue_script( 'jquery.elastislide', get_template_directory_uri() . '/js/jquery.elastislide.js', array(), '1.0');
		wp_enqueue_script( 'smooth-scroll2', get_template_directory_uri() . '/js/smooth-scroll2.js', array(), '1.0');
		wp_enqueue_script( 'contact-form', get_template_directory_uri() . '/js/contact-form.js', array(), '1.0');
		wp_enqueue_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', array(), '1.0');
		if ( is_singular() && get_option( 'thread_comments' ) )
    		wp_enqueue_script( 'comment-reply' );
	}

}

//Loading the CSS files into the theme
add_action('wp_enqueue_scripts', 'vp_load_css');
if( !function_exists('vp_load_css') ) {
	function vp_load_css() {
		global $fffolio;
		wp_enqueue_style( 'stylecss', get_stylesheet_directory_uri() . '/style.css', array(), '1.0');
		wp_enqueue_style( 'base', get_template_directory_uri() . '/css/base.css', array(), '1.0');
		wp_enqueue_style( 'skeleton', get_template_directory_uri() . '/css/skeleton.css', array(), '1.0');
		if(isset($fffolio['color_scheme']) && $fffolio['color_scheme'] == 2)
			wp_enqueue_style( 'layout-blue', get_template_directory_uri() . '/css/layout-blue.css', array(), '1.0');
		else
			wp_enqueue_style( 'layout-orange', get_template_directory_uri() . '/css/layout-orange.css', array(), '1.0');
		wp_enqueue_style( 'elastislide', get_template_directory_uri() . '/css/elastislide.css', array(), '1.0');
		wp_enqueue_style( 'prettyPhoto', get_template_directory_uri() . '/css/prettyPhoto.css', array(), '1.0');
		wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/css/flexslider.css', array(), '1.0');
		wp_enqueue_style( 'marck-script', 'http://fonts.googleapis.com/css?family=Marck+Script', array());
		wp_enqueue_style( 'open-sans', 'http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700,800', array());
		wp_enqueue_style( 'source-sans', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700', array());
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider.js', array(), '1.0');
	}
}

add_action('wp_head', 'vp_custom_css', 11);
function vp_custom_css() {
	global $fffolio;
	if(isset($fffolio['custom_css']) && $fffolio['custom_css'] != '')
			echo '<style type="text/css">' . $fffolio['custom_css'] . '</style>';
}

add_action('init', 'vp_misc');
function vp_misc() {
	add_theme_support( 'automatic-feed-links' );
	
}
if ( ! isset( $content_width ) ) $content_width = 960;

function encEmail ($orgStr) {
    $encStr = "";
    $nowStr = "";
    $rndNum = -1;

    $orgLen = strlen($orgStr);
    for ( $i = 0; $i < $orgLen; $i++) {
        $encMod = rand(1,2);
        switch ($encMod) {
        case 1: // Decimal
            $nowStr = "&#" . ord($orgStr[$i]) . ";";
            break;
        case 2: // Hexadecimal
            $nowStr = "&#x" . dechex(ord($orgStr[$i])) . ";";
            break;
        }
        $encStr .= $nowStr;
    }
    return $encStr;
} 

function register_menus() {
	register_nav_menus( array( 'top-menu' => 'Top primary menu')
						);
}
add_action('init', 'register_menus');

add_filter( 'posts_orderby', 'sort_query_by_post_in', 10, 2 );
function sort_query_by_post_in( $sortby, $thequery ) {
	if ( !empty($thequery->query['post__in']) && isset($thequery->query['orderby']) && $thequery->query['orderby'] == 'post__in' )
		$sortby = "find_in_set(ID, '" . implode( ',', $thequery->query['post__in'] ) . "')";
	return $sortby;
}

add_action('init', 'vp_sidebars');
function vp_sidebars() {
	$args = array(
				'name'          => 'Right sidebar',
				'before_widget' => '<div id="%1$s" class="padding-bottom %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widgettitle">',
				'after_title'   => '</h3>' );
	register_sidebar($args);
}
?>