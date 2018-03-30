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
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="widget-separator"></div>',
	));
	register_sidebar(array(
		'name' => 'Homepage Newsletter',
		'before_widget' => '<div class="five columns newsletter-background"><div id="%1$s" class="widget newsletter-title %2$s">',
		'after_widget' => '</div></div>',
		'before_title' => '<div class="title"><h1><span>',
		'after_title' => '</span></h1></div>',
	));
	register_sidebar(array(
		'name' => 'Homepage Widgets - First Row - 2/3',
		'before_widget' => '<div id="%1$s" class="firstrow-widget-1 firstrow-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="firstrow-widget-title widget-title">',
		'after_title' => '</h3>',
	));
		register_sidebar(array(
		'name' => 'Homepage Widgets - First Row - 1/3',
		'before_widget' => '<div id="%1$s" class="firstrow-widget-2 firstrow-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="firstrow-widget-title widget-title">',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage Widgets - Second Row - 1 of 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span><span class="star"></span></h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage Widgets - Second Row - 2 of 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span><span class="star"></span></h3>',
	));
	register_sidebar(array(
		'name' => 'Homepage Widgets - Second Row - 3 of 3',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title"><span>',
		'after_title' => '</span><span class="star"></span></h3>',
	));		
	register_sidebar(array(
		'name' => 'Footer One',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="footer-title-separator-1"></div>',
	));
	register_sidebar(array(
		'name' => 'Footer Two',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="footer-title-separator-2"></div>',
	));
	register_sidebar(array(
		'name' => 'Footer Three',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><div class="footer-title-separator-3"></div>',
	));
}

/*-----------------------------------------------------------------------------------*/
/*	Post Formats
/*-----------------------------------------------------------------------------------*/

$formats = array( 
			'audio',
			'gallery', 
			'image', 
			'video');

add_theme_support( 'post-formats', $formats ); 


/*--------------------------------------------------------------------------------------------------
	Configuring WP2.9+ Thumbnails
--------------------------------------------------------------------------------------------------*/

function jpeg_quality_callback($arg)
{
	return (int)100;
}
add_filter('jpeg_quality', 'jpeg_quality_callback');

if ( function_exists('add_theme_support')) {
	add_theme_support('post-thumbnails'); //Adding theme support for post thumbnails
	add_theme_support('automatic-feed-links'); //Adding support for automatic feed links
	add_theme_support('custom-background');
	set_post_thumbnail_size( 75, 75, true );
	add_image_size( 'thumbnail-large', 700, 350, false);
	add_image_size( 'thumbnail-archive-small', 100, 70, true);
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

if( ! isset( $content_width ) ) $content_width = 700;


/*--------------------------------------------------------------------------------------------------
	Register and load common JS
--------------------------------------------------------------------------------------------------*/

function icy_register_js() {
	if (!is_admin()) {
		
		//Registering Javascripts
		// comment out the next two lines to load the local copy of jQuery
		wp_register_script('validation', 	   'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', 'jquery', '1.9');
		wp_register_script('jquery-ui-custom', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js', 'jquery', TRUE);
		wp_register_script('superfish',     	get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.0', TRUE);
		wp_register_script('jPlayer', 			get_template_directory_uri() . '/js/jquery.jplayer.min.js', 'jquery', '2.1', TRUE);
		wp_register_script('flexslider', 		get_template_directory_uri() . '/js/jquery.flexslider.min.js', 'jquery', TRUE);
		wp_register_script('icy_custom',     	get_template_directory_uri() . '/js/jquery.custom.js', 'jquery', '1.1', TRUE);
		wp_register_script('buddypress',     	get_template_directory_uri() . '/js/jquery.buddypress.js', 'jquery');


		//Registering Stylesheets
		wp_register_style('style_css',			get_template_directory_uri() . '/style.css');
		wp_register_style('skeleton_css',   	get_template_directory_uri() . '/css/skeleton.css');
		wp_register_style('light_css',      	get_template_directory_uri() . '/css/light.css');
		wp_register_style('flexslider_css',		get_template_directory_uri() . '/css/flexslider.css');
		wp_register_style('buddypress_css', 	get_template_directory_uri() . '/css/buddypress.css');
				
		//Enqueueing javascript		
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-custom');
		wp_enqueue_script('superfish');
		wp_enqueue_script('icy_custom');

		//Enqueue stylesheets
		wp_enqueue_style('style_css');
		wp_enqueue_style('skeleton_css');
		wp_enqueue_style('light_css');
		if ( is_child_theme() && 'politic' == get_template() ) { 
 	                wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'style_css' ), '1.0'); 
 	    } 

		// Localize the jquery.buddies.js script - COURTESY OF PEAPOD STUDIOS - HTTP://PEAPOD.CA/
	    // Add words that we need to use in JS to the end of the page so they can be translated and still used.
	    $params = array(
	      'my_favs'           => __( 'My Favorites', 'buddypress' ),
	      'accepted'          => __( 'Accepted', 'buddypress' ),
	      'rejected'          => __( 'Rejected', 'buddypress' ),
	      'show_all_comments' => __( 'Show all comments for this thread', 'buddypress' ),
	      'show_all'          => __( 'Show all', 'buddypress' ),
	      'comments'          => __( 'comments', 'buddypress' ),
	      'close'             => __( 'Close', 'buddypress' ),
	      'view'              => __( 'View', 'buddypress' ),
	      'mark_as_fav'        => __( 'Favorite', 'buddypress' ),
	      'remove_fav'        => __( 'Remove Favorite', 'buddypress' )
	    );

	    wp_localize_script('buddypress', 'BP_DTheme', $params);
	}
}
add_action('wp_enqueue_scripts', 'icy_register_js');


//register my own styles
function icy_enqueue_scripts() {

    	// load jPlayer on appropriate pages
    	if( is_home() || ('portfolio' == get_post_type()) || has_post_format('video') || has_post_format('audio') ) {
    	    wp_enqueue_script('jPlayer');
    	}
	
    	// load Slides on appropriate pages
    	if( is_home() || is_page_template( 'template-home.php' ) || ( 'portfolios' == get_post_type() ) || has_post_format('gallery') ) {
    	    wp_enqueue_script('flexslider');
    	    wp_enqueue_style('flexslider_css');
    	}

		if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 

		if ( is_page_template( 'template-contact.php' ) ) 
			wp_enqueue_script('validation');

		if ( !is_admin() && function_exists('bp_is_active') ) {
			wp_enqueue_script('buddypress');
			wp_enqueue_style('buddypress_css');
		}
	
}
add_action('wp_print_scripts', 'icy_enqueue_scripts');

if( !function_exists( 'icy_contactform_validate' ) ) {
    function icy_contactform_validate() {

    	if (is_page_template('template-contact.php')) { ?>
    	
    		<script type="text/javascript">
    			jQuery(document).ready(function(){
    				jQuery("#contact-form").validate();
    			});
    		</script>
    	
    	<?php }
    }
    
    add_action('wp_head', 'icy_contactform_validate');
}

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
    	<div class="comment-content commentary-no-<?php comment_ID(); ?> <?php if($isByAuthor == true) : ?>bypostauthor<?php endif; ?>">
      
    	<?php echo get_avatar($comment,$size='35'); ?>
    		
    		<!--BEGIN .comment-author -->
    		<div class="comment-author commentary">
      
    			<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
         
         	<!--END .comment-author -->
    		</div>

    		<!--BEGIN .comment-meta -->
      		<div class="comment-meta">
      
      			<a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('[Edit]'),'  ','') ?> &middot; <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

      		<!--END .comment-meta -->
    		</div>
      
    	<?php if ($comment->comment_approved == '0') : ?>
      
        	<em class="moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
        	<br />
         
      	<?php endif; ?>
	  		
	  		<!--BEGIN .comment-entry -->
      		<div class="comment-entry commentary">
      
    			<?php comment_text() ?>

      		<!--END .comment-entry -->
			</div>
      
		<!--END .comment -->      
    	</div>

<?php
}

/*-----------------------------------------------------------------------------------*/
/*	Load Widgets, Shortcodes
/*-----------------------------------------------------------------------------------*/

// Add the Theme Shortcodes
include("functions/theme-shortcodes.php");

// Add the post meta
include("functions/theme-postmeta.php");

// Add the page meta
//include("functions/theme-pagemeta.php");

// Add the Custom Blog Posts Widget 
include("functions/widget-blogposts.php");

// Add the Custom Flickr Photos Widget
include("functions/widget-flickr.php");

// Add the Custom Video Widget
include("functions/widget-video.php");

// Add the Custom Facebook Widget
//include("functions/widget-facebook.php");

// Add the Custom Twitter Widget
//include("functions/widget-tweets.php");

// Add the Custom Resolutions Widget
include("functions/widget-resolutions.php");

// Add the Custom Campaign Builder Widget
include("functions/widget-buildcampaign.php");

/*-----------------------------------------------------------------------------------*/
/*	Filters that allow shortcodes in Text Widgets
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	BuddyPress
/*-----------------------------------------------------------------------------------*/
function icy_bp_theme_setup() {
	global $bp;

	// Load the default BuddyPress AJAX functions if it isn't explicitly disabled
	if (function_exists('bp_is_active'))
		require_once(ICY_FILEPATH . '/includes/ajax.php' );

	if ( !is_admin() && function_exists('bp_is_active') ) {
		// Register buttons for the relevant component templates
		// Friends button
		if ( bp_is_active( 'friends' ) )
			add_action( 'bp_member_header_actions',    'bp_add_friend_button' );

		// Activity button
		if ( bp_is_active( 'activity' ) )
			add_action( 'bp_member_header_actions',    'bp_send_public_message_button' );

		// Messages button
		if ( bp_is_active( 'messages' ) )
			add_action( 'bp_member_header_actions',    'bp_send_private_message_button' );

		// Group buttons
		if ( bp_is_active( 'groups' ) ) {
			add_action( 'bp_group_header_actions',     'bp_group_join_button' );
			add_action( 'bp_group_header_actions',     'bp_group_new_topic_button' );
			add_action( 'bp_directory_groups_actions', 'bp_group_join_button' );
		}

		// Blog button
		if ( bp_is_active( 'blogs' ) )
			add_action( 'bp_directory_blogs_actions',  'bp_blogs_visit_blog_button' );
	}
}

add_action( 'after_setup_theme', 'icy_bp_theme_setup', 11 );


/*-----------------------------------------------------------------------------------*/
/*	Load Theme Options
/*-----------------------------------------------------------------------------------*/

define('ICY_FILEPATH', TEMPLATEPATH);
define('ICY_DIRECTORY', get_template_directory_uri());

require_once (ICY_FILEPATH . '/admin/admin-functions.php');
require_once (ICY_FILEPATH . '/admin/admin-interface.php');
require_once (ICY_FILEPATH . '/functions/theme-options.php');
require_once (ICY_FILEPATH . '/functions/theme-functions.php');
require_once (ICY_FILEPATH . '/tinymce/tinymce.loader.php');
require_once (ICY_FILEPATH . '/functions/theme-plugin-activation-class.php');
require_once (ICY_FILEPATH . '/functions/theme-plugins-activator.php');
require_once (ICY_FILEPATH . '/functions/class-pixelentity-theme-update.php');


$user = $theme_options['icy_buyer_user'];
$api = $theme_options['icy_buyer_api'];
PixelentityThemeUpdate::init($user,$api, 'Icy Pixels');

?>