<?php

/*--------------------------------------------------------------------------------------------------

	File: functions.php

	Description: Here are a set of custom functions used for this theme framework.
	Please be extremely careful when you are editing this file, because when things
	tend to go bad, they go bad big time. Well, you have been warned ! :-)

--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
	Registering WP3.0+ Custom Menu 
--------------------------------------------------------------------------------------------------*/

function register_menu() {
	register_nav_menu('main-menu', __('Main Menu'));
}
add_action('init', 'register_menu');

/*--------------------------------------------------------------------------------------------------
	Loading the Theme Translation Feature
--------------------------------------------------------------------------------------------------*/

load_theme_textdomain('framework');

/*--------------------------------------------------------------------------------------------------
	Registering the Sidebars
--------------------------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {

	register_sidebar(array(
		'name' => 'Main Sidebar',
		'description' => 'Appears in the blog page.',
		'before_widget' => '<div class="widget-separator"></div><div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}


/*--------------------------------------------------------------------------------------------------
	Configuring WP2.9+ Thumbnails
--------------------------------------------------------------------------------------------------*/

function jpeg_quality_callback($arg)
{
	return (int)100;
}
add_filter('jpeg_quality', 'jpeg_quality_callback');

if ( function_exists('add_theme_support')) {

	add_theme_support( 
        'post-formats', 
            array(                   
                'image',                                
                'gallery',                
                'video',            
            ) 
    );

	add_theme_support( 'post-thumbnails' ); //Adding theme support for post thumbnails
	add_theme_support( 'automatic-feed-links' ); //Adding support for automatic feed links
	add_theme_support( 'custom-background' ); //Adding suppor for custom background
	set_post_thumbnail_size( 75, 75, true );
	add_image_size( 'thumbnail-large', 1500, '', false );
}



/*--------------------------------------------------------------------------------------------------
	Custom Wordpress Customisation
		a. Custom Gravatar
		b. Custom Excerpt Length
		c. Custom Excerpt String
		d. Separated Pings Listing
		e. Custom Useful is_multiple function
		f. Custom Login Logo
		g. Breadcrumbs
--------------------------------------------------------------------------------------------------*/

/*--------------------------------------------------------------------------------------------------
		a. Custom Gravatar Image
--------------------------------------------------------------------------------------------------*/


if( !function_exists( 'icy_custom_gravatar' ) ) {
    function icy_custom_gravatar( $avatar_defaults ) {
        $icy_avatar = get_template_directory_uri() . '/images/gravatar.png';
        $avatar_defaults[$icy_avatar] = 'Custom Gravatar (/images/gravatar.png)';
        return $avatar_defaults;
    }
    
    add_filter( 'avatar_defaults', 'icy_custom_gravatar' );
}

/*--------------------------------------------------------------------------------------------------
		b. Custom Excerpt Length
--------------------------------------------------------------------------------------------------*/

function icy_custom_excerpt_length( $length ) {
	global $post;
	if ($post->post_type == 'post')
		return 20;
}
add_filter('excerpt_length', 'icy_custom_excerpt_length');


/*--------------------------------------------------------------------------------------------------
		c. Custom Excerpt String Text
--------------------------------------------------------------------------------------------------*/

function icy_excerpt($excerpt) {
	return str_replace('[...]', '...', $excerpt); 
}
add_filter('wp_trim_excerpt', 'icy_excerpt');


/*--------------------------------------------------------------------------------------------------
		d. Separated Pings Listing
--------------------------------------------------------------------------------------------------*/

function icy_list_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment; ?>

		<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>

<?php }

/*--------------------------------------------------------------------------------------------------
		e. Custom is_multiple - Helpful function
--------------------------------------------------------------------------------------------------*/

function is_multiple($number, $multiple) 
{ 
    return ($number % $multiple) == 0; 
}

/*--------------------------------------------------------------------------------------------------
		f. Custom Login Logo Support
--------------------------------------------------------------------------------------------------*/

function icy_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image:url('.get_template_directory_uri().'/images/custom-login-logo.png) !important; }
    </style>';
}
add_action('login_head', 'icy_custom_login_logo');

/*--------------------------------------------------------------------------------------------------
		e. Setting Content Width
--------------------------------------------------------------------------------------------------*/

if( ! isset( $content_width ) ) $content_width = 900;


/*--------------------------------------------------------------------------------------------------
	Register and load common JS
--------------------------------------------------------------------------------------------------*/

function icy_register_js() {
	if (!is_admin()) {
		
		//Registering Javascripts
		// comment out the next two lines to load the local copy of jQuery
		wp_register_script('superfish',     	get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);
		wp_register_script('jPlayer', 			get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1', TRUE);
		wp_register_script('flexslider-2', 		get_template_directory_uri() . '/js/jquery.flexslider-min.js', 'jquery', '2.2', TRUE);	
		wp_register_script('fitvids',     		get_template_directory_uri() . '/js/jquery.fitvids.min.js', 'jquery', TRUE);
		wp_register_script('icy_custom',     	get_template_directory_uri() . '/js/jquery.custom.js', array('jquery', 'fitvids', 'flexslider-2', 'superfish'), '1.2', TRUE);


		//Registering Stylesheets
		wp_register_style('style_css',			get_template_directory_uri() . '/style.css');
		wp_register_style('flexslider-css',		get_template_directory_uri() . '/includes/css/flexslider.css');		
				
		//Enqueueing javascript
		wp_enqueue_script('jquery');
		wp_enqueue_script('superfish');
		wp_enqueue_script('fitvids');
		wp_enqueue_script('icy_custom');

		//Enqueue stylesheets
		wp_enqueue_style('style_css');

		if ( is_child_theme() && 'ravage' == get_template() ) { 
 	                wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'style_css' ), '1.0'); 
 	    } 
	}
}
add_action('wp_enqueue_scripts', 'icy_register_js');


//register my own styles
function icy_enqueue_scripts() {

    	// load jPlayer on appropriate pages
    	if( is_home() ||  has_post_format('video') || has_post_format('audio') ) {
    	    wp_enqueue_script('jPlayer');
    	}

    	if ( is_home() || has_post_format('gallery') ) {
    		wp_enqueue_script('flexslider-2');
    		wp_enqueue_style('flexslider-css');
    	}

		if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 

}
add_action('wp_print_scripts', 'icy_enqueue_scripts');

/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'icy_admin_js' ) ) {
    function icy_admin_js($hook) {
    	if ($hook == 'post.php' || $hook == 'post-new.php') {
    		wp_register_script('icy-admin', get_template_directory_uri() . '/js/jquery.custom.admin.js', 'jquery');
    		wp_enqueue_script('icy-admin');
    	}
    }
    add_action('admin_enqueue_scripts','icy_admin_js',10,1);
}

/*-----------------------------------------------------------------------------------*/
/*	Adding Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'icy_browser_body_class' ) ) {
    function icy_browser_body_class($classes) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	
		if($is_lynx) $classes[] = 'lynx';
		elseif($is_gecko) $classes[] = 'gecko';
		elseif($is_opera) $classes[] = 'opera';
		elseif($is_NS4) $classes[] = 'ns4';
		elseif($is_safari) $classes[] = 'safari';
		elseif($is_chrome) $classes[] = 'chrome';
		elseif($is_IE){ 
			$classes[] = 'ie';
			if(preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version)) $classes[] = 'ie'.$browser_version[1];
		} else $classes[] = 'unknown';
	
		if($is_iphone) $classes[] = 'iphone';
		return $classes;
    }
    
    add_filter('body_class','icy_browser_body_class');
}


/*-----------------------------------------------------------------------------------*/
/*	Comment Styling
/*-----------------------------------------------------------------------------------*/

function icy_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>

    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     	<!--BEGIN .comment -->
    	<div id="comment-<?php comment_ID(); ?>" class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>bypostauthor<?php endif; ?>">
    		<!--BEGIN .comment-author -->
    		<div class="comment-author commentary">
    			<figure><?php echo get_avatar($comment,$size='48'); ?></figure>
    			<span><?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?></span>
         	<!--END .comment-author -->
    		</div>
    		<!--BEGIN .comment-meta -->
      		<div class="comment-meta">
      			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('[Edit]'),' / ','') ?>
      		<!--END .comment-meta -->
    		</div>
      
    	<?php if ($comment->comment_approved == '0') : ?>
        	<em class="moderation"><?php _e('Your comment is awaiting moderation.') ?></em>     
      	<?php endif; ?>
	  		
	  		<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary span12">
    			<?php comment_text() ?>
      		<!--END .comment-entry -->
      			<span class="reply-to"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets, Shortcodes
/*-----------------------------------------------------------------------------------*/

// Add the Custom Flickr Photos Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom Twitter Widget
include("functions/widget-tweets.php");

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('ICY_FILEPATH', get_template_directory());
define('ICY_DIRECTORY', get_template_directory_uri());

// Deprecated as of 1.6
//require_once (ICY_FILEPATH . '/admin/admin-functions.php');
//require_once (ICY_FILEPATH . '/admin/admin-interface.php');
//require_once (ICY_FILEPATH . '/functions/theme-options.php');
require_once (ICY_FILEPATH . '/functions/theme-functions.php');
require_once (ICY_FILEPATH . '/functions/theme-metabox.php');
require_once (ICY_FILEPATH . '/functions/class-pixelentity-theme-update.php');
require_once (ICY_FILEPATH . '/customizer/customizer.php' );


/**
 * Auto update setup
 *
 * @uses 	PixelentityThemeUpdate::init
 * @return  void;
 */

$theme_options = thsp_cbp_get_options_values();
$user = $theme_options['buyer_username'];
$api = $theme_options['buyer_apikey'];
PixelentityThemeUpdate::init($user,$api, 'Icy Pixels');

?>