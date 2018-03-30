<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework is in a parent theme or child theme */

	define('OF_FILEPATH', TEMPLATEPATH);
	define('OF_DIRECTORY', get_template_directory_uri());


/* These files build out the options interface.  Likely won't need to edit these. */

require_once (OF_FILEPATH . '/admin/admin-functions.php');		// Custom functions and plugins
require_once (OF_FILEPATH . '/admin/admin-interface.php');		// Admin Interfaces (options,framework, seo)

/* These files build out the theme specific options and associated functions. */

require_once (OF_FILEPATH . '/admin/theme-options.php'); 		// Options panel settings and custom settings
require_once (OF_FILEPATH . '/admin/theme-functions.php'); 	// Theme actions based on options settings

/*-----------------------------------------------------------------------------------*/
/* Add Theme Shortcodes
/*-----------------------------------------------------------------------------------*/
include("functions/shortcodes.php");

/*-----------------------------------------------------------------------------------*/
/* Register Widget Sidebars
/*-----------------------------------------------------------------------------------*/

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Blog Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));

		register_sidebar(array(
		'name' => 'Portfolio Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));
		register_sidebar(array(
		'name' => 'Contact Sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	));

	register_sidebar(array( //Footer
		'name' => 'Footer Left',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Footer
		'name' => 'Footer Left Center',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Footer
		'name' => 'Footer Right Center',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Footer
		'name' => 'Footer Right',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array( //Footer
		'name' => 'Below Navigation',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	));

}

/*-----------------------------------------------------------------------------------*/
/*	Add Widget Shortcode Support
/*-----------------------------------------------------------------------------------*/

add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');

// Add the Project Thumbnail Custom Widget
include("functions/widget-project.php");
// Add the Project Thumbnail Custom Widget
include("functions/widget-recent-projects.php");
// Add the News Custom Widget
include("functions/widget-news.php");
// Add the Divider Custom Widget
include("functions/widget-divider.php");
// Add the Twitter Custom Widget
include("functions/widget-twitter.php");
// Add the Contact Custom Widget
include("functions/widget-contact.php");
// Add the Custom Fields for Pages
include("functions/customfields.php");
// Add the Custom Fields for Pages
include("functions/custompagefields.php");

/*-----------------------------------------------------------------------------------*/
/*	Register and load common JS
/*-----------------------------------------------------------------------------------*/

function ag_register_js() {
	if ( ! is_admin() ) {
		wp_register_script( 'cycle', get_template_directory_uri() . '/js/jquery.cycle.all.js', 'jquery', '2.9994', false );
		wp_register_script( 'masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', 'jquery', '2.0.110526', false );
		wp_register_script( 'modernizer', get_template_directory_uri() . '/js/modernizr-transitions.js', 'jquery', '1.7', false );
		wp_register_script( 'scrollto', get_template_directory_uri() . '/js/jquery.scrollTo-min.js', 'jquery', '1.4.2', false );
		wp_register_script( 'validation', 'http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js', 'jquery', '1.8.0', false );
		wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery', '1.4.8', false );
		wp_register_script( 'prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery', '3.1.6', false );
		wp_register_script( 'easing', get_template_directory_uri() . '/js/jquery.easing.js', 'jquery', '1.3', false );
		wp_register_script( 'tabs', get_template_directory_uri() . '/js/jquery.ui.tabs.js', array( 'jquery', 'jquery-ui-tabs' ), '1.8.11', false );
		wp_register_script( 'jquery-ui-custom', get_template_directory_uri() . '/js/jquery-ui-1.8.5.custom.min.js', 'jquery', '1.8.11', false );
		wp_register_script( 'coda', get_template_directory_uri() . '/js/jquery.coda-slider-2.0.js', 'jquery', '2.0', false );

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'modernizer' );
		wp_enqueue_script( 'cycle' );
		wp_enqueue_script( 'scrollto' );
		wp_enqueue_script( 'superfish' );
		wp_enqueue_script( 'easing' );
		wp_enqueue_script( 'prettyPhoto' );
		wp_enqueue_script( 'validation' );
		wp_enqueue_script( 'tabs' );
	}
}

add_action( 'init', 'ag_register_js' );

// load Coda slider scripts only on slider pages
function ag_coda_scripts() {
	if (is_page_template('template-contact.php'))
	wp_enqueue_script('coda');
}
add_action('wp_print_scripts', 'ag_coda_scripts');

/*-----------------------------------------------------------------------------------*/
/*	Stylesheets
/*-----------------------------------------------------------------------------------*/

function ag_register_iecss () {
		if (!is_admin()) {
global $wp_styles;
wp_enqueue_style(  "ie7",  get_template_directory_uri() . "/css/ie7.css", false, 'ie7', "all");
$wp_styles->add_data( "ie7", 'conditional', 'IE 7' );
	}
}
add_action('init', 'ag_register_iecss');

function ag_contact_styles() {
	if ( is_page_template('template-contact.php')) {
		 $myStyleUrl =  get_template_directory_uri() . '/css/coda-slider-contact.css';
         wp_register_style('contact', $myStyleUrl);
	     wp_enqueue_style( 'contact');
	}
}
add_action('wp_print_styles', 'ag_contact_styles');

/*-----------------------------------------------------------------------------------*/
/* Register Navigation
/*-----------------------------------------------------------------------------------*/

add_theme_support('menus');

if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(
        array(
          'top_nav_menu' => 'Main Navigation Menu'
        )
    );

// remove menu container div
function my_wp_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
}

/*-----------------------------------------------------------------------------------*/
/*	Change Default Excerpt Length
/*-----------------------------------------------------------------------------------*/

function ag_excerpt_length($length) {
return 15; }
add_filter('excerpt_length', 'ag_excerpt_length');

/*-----------------------------------------------------------------------------------*/
/*	Set Max Content Width (use in conjuction with ".blogpost .featuredimage img" css)
/*-----------------------------------------------------------------------------------*/

if ( ! isset( $content_width ) ) $content_width = 620;

/*-----------------------------------------------------------------------------------*/
/*	Automatic Feed Links
/*-----------------------------------------------------------------------------------*/

if(function_exists('add_theme_support')) {
    add_theme_support('automatic-feed-links');
    //WP Auto Feed Links
}

/*-----------------------------------------------------------------------------------*/
/*	Configure Excerpt String
/*-----------------------------------------------------------------------------------*/

function ag_excerpt_more($excerpt) {
return str_replace('[...]', '...', $excerpt); }
add_filter('wp_trim_excerpt', 'ag_excerpt_more');

/*------------------------------------------------------------------------------*/
/*	Remove More Link Anchor
/*------------------------------------------------------------------------------*/

function remove_more_jump_link($link) {
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}

add_filter('the_content_more_link', 'remove_more_jump_link');


/*------------------------------------------------------------------------------*/
/*	Get Attachement ID from URL function
/*------------------------------------------------------------------------------*/

function get_attachment_id( $url ) {

    $dir = wp_upload_dir();
    $dir = trailingslashit($dir['baseurl']);

    if( false === strpos( $url, $dir ) )
        return false;

    $file = basename($url);

    $query = array(
        'post_type' => 'attachment',
        'fields' => 'ids',
        'meta_query' => array(
            array(
                'value' => $file,
                'compare' => 'LIKE',
            )
        )
    );

    $query['meta_query'][0]['key'] = '_wp_attached_file';
    $ids = get_posts( $query );

    foreach( $ids as $id )
        if( $url == array_shift( wp_get_attachment_image_src($id, 'full') ) )
            return $id;

    $query['meta_query'][0]['key'] = '_wp_attachment_metadata';
    $ids = get_posts( $query );

    foreach( $ids as $id ) {

        $meta = wp_get_attachment_metadata($id);

        foreach( $meta['sizes'] as $size => $values )
            if( $values['file'] == $file && $url == array_shift( wp_get_attachment_image_src($id, $size) ) ) {
				if(isset($id->attachment_size)){
                $id->attachment_size = $size;
				}
                return $id;
            }
    }

    return false;
}

/*-----------------------------------------------------------------------------------*/
/*	Add Browser Detection Body Class
/*-----------------------------------------------------------------------------------*/

add_filter('body_class','ag_browser_body_class');
function ag_browser_body_class($classes) {
	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;

	if($is_lynx) $classes[] = 'lynx';
	elseif($is_gecko) $classes[] = 'gecko';
	elseif($is_opera) $classes[] = 'opera';
	elseif($is_NS4) $classes[] = 'ns4';
	elseif($is_safari) $classes[] = 'safari';
	elseif($is_chrome) $classes[] = 'chrome';
	elseif($is_IE) $classes[] = 'ie';
	else $classes[] = 'unknown';

	if($is_iphone) $classes[] = 'iphone';
	return $classes;
}


/*-----------------------------------------------------------------------------------*/
/*	Configure WP2.9+ Thumbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 56, 56, true ); // Normal post thumbnails
	add_image_size( 'large', 960, '', true ); // Large thumbnails
	add_image_size( 'medium', 460, '310', true ); // Medium thumbnails
	add_image_size( 'small', 125, '', true ); // Small thumbnails
	add_image_size( 'blog', 500, 270, true ); // Blog thumbnail
	add_image_size( 'portfoliowidget', 50, 50, true ); // Portfolio widget thumbnail
	add_image_size( 'portfoliosmall', 240, 155, true ); // Portfolio Small thumbnail
	add_image_size( 'portfoliomedium', 460, 310, true ); // Portfolio Medium thumbnail
}

/*
Check to see if the function exists
*/

if(function_exists('add_theme_support')) {
    /** Exists! So add the post-thumbnail */
    add_theme_support('post-thumbnails');

    /** Now Set some image sizes */

    /** #1 for our featured content slider */
    add_image_size( $name = 'itg_featured', $width = 500, $height = 300, $crop = true );

    /** #2 for post thumbnail */
    add_image_size( 'itg_post', 250, 250, true );

    /** #3 for widget thumbnail */
    add_image_size( 'itg_widget', 40, 40, true );

    /** Set default post thumbnail size */
    set_post_thumbnail_size($width = 50, $height = 50, $crop = true);
}

add_filter("manage_upload_columns", 'upload_columns');
add_action("manage_media_custom_column", 'media_custom_columns', 0, 2);

function upload_columns($columns) {

	unset($columns['parent']);
	$columns['better_parent'] = "Parent";

	return $columns;

}
 function media_custom_columns($column_name, $id) {

	$post = get_post($id);

	if($column_name != 'better_parent')
		return;

		if ( $post->post_parent > 0 ) {
			if ( get_post($post->post_parent) ) {
				$title =_draft_or_post_title($post->post_parent);
			}
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->post_parent ); ?>"><?php echo $title ?></a></strong>, <?php echo get_the_time(__('Y/m/d', 'framework')); ?>
			<br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Re-Attach', 'framework'); ?></a>

			<?php
		} else {
			?>
			<?php _e('(Unattached)', 'framework'); ?><br />
			<a class="hide-if-no-js" onclick="findPosts.open('media[]','<?php echo $post->ID ?>');return false;" href="#the-list"><?php _e('Attach', 'framework'); ?></a>
			<?php
		}

}


function mytheme_enqueue_comment_reply() {
    // on single blog post pages with comments open and threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        // enqueue the javascript that performs in-link comment reply fanciness
        wp_enqueue_script( 'comment-reply' );
    }
}
// Hook into wp_enqueue_scripts
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_comment_reply' );

/*------------------------------------------------------------------------------*/
/*	Comments Template
/*------------------------------------------------------------------------------*/

function ag_comment($comment, $args, $depth) {

    $isByAuthor = false;

    if($comment->comment_author_email == get_the_author_meta('email')) {
        $isByAuthor = true;
    }

    $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
   <div id="comment-<?php comment_ID(); ?>" class="singlecomment">
      <p class="commentsmetadata"><cite>
            <?php comment_date('F j, Y'); ?>
            </cite></p>
    <div class="author">
            <div class="reply"><?php echo comment_reply_link(array('depth' => $depth, 'max_depth' => $args['max_depth'])); ?></div>

            <div class="name"><?php comment_author_link() ?></div>
        </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <p class="moderation"><?php _e('Your comment is awaiting moderation.', 'framework') ?></p>

      <?php endif; ?>

        <div class="commenttext">
            <?php comment_text() ?>
        </div>
</div>
<?php
}

/*------------------------------------------------------------------------------*/
/*	Add CSS Options
/*------------------------------------------------------------------------------*/

add_filter('query_vars', 'add_new_var_to_wp');
function add_new_var_to_wp($public_query_vars) {
    $public_query_vars[] = 'ag_custom_var';
    //ag_custom_var is the name of the custom query variable that is created and how you reference it in the call to the file
    return $public_query_vars;
}

add_action('template_redirect', 'my_theme_css_display');
function my_theme_css_display(){
    $css = get_query_var('ag_custom_var');
    if ($css == 'css'){
        include_once (TEMPLATEPATH . '/style.php');
        exit;  //This stops WP from loading any further
    }
}

/*------------------------------------------------------------------------------*/
/*	Add Javascript Options
/*------------------------------------------------------------------------------*/

add_filter('query_vars', 'add_new_jsvar_to_wp');
function add_new_jsvar_to_wp($public_query_vars) {
    $public_query_vars[] = 'ag_customjs_var';
    //my_theme_custom_var is the name of the custom query variable that is created and how you reference it in the call to the file
    return $public_query_vars;
}

add_action('template_redirect', 'my_theme_js_display');
function my_theme_js_display(){
    $js = get_query_var('ag_customjs_var');
    if ($js == 'js'){
        include_once (TEMPLATEPATH . '/js/custom.js.php');
        exit;  //This stops WP from loading any further
    }
}


/*-----------------------------------------------------------------------------------*/
/*	Add Custom Portfolio Post Type
/*-----------------------------------------------------------------------------------*/

add_action( 'init', 'create_portfolio_post_types' );

function create_portfolio_post_types() {
	register_post_type( 'portfolio',
		array(
			  'labels' => array(
			  'name' => __( 'Portfolio', 'framework'),
			  'singular_name' => __( 'Portfolio Item', 'framework'),
			  'add_new' => __( 'Add New', 'framework' ),
		   	  'add_new_item' => __( 'Add New Portfolio Item', 'framework'),
			  'edit' => __( 'Edit', 'framework' ),
	  		  'edit_item' => __( 'Edit Portfolio Item', 'framework'),
	          'new_item' => __( 'New Portfolio Item', 'framework'),
			  'view' => __( 'View Portfolio', 'framework'),
			  'view_item' => __( 'View Portfolio Item', 'framework'),
			  'search_items' => __( 'Search Portfolio Items', 'framework'),
	  		  'not_found' => __( 'No Portfolios found', 'framework'),
	  		  'not_found_in_trash' => __( 'No Portfolio Items found in Trash', 'framework'),
			  'parent' => __( 'Parent Portfolio', 'framework'),
			),
			'menu_icon' => get_stylesheet_directory_uri() . '/admin/images/icons/photos.png',
			'public' => true,
			'supports' => array(
				'title',
				'editor',
				'thumbnail',
				'comments'),
		)
	);
}


//hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'ag_create_taxonomies', 0 );

//create two taxonomies, genres and writers for the post type "book"
function ag_create_taxonomies()
{
  // Add new taxonomy, make it hierarchical (like categories)
  $labels = array(
    'name' => _x( 'Skills', 'taxonomy general name', 'framework'),
    'singular_name' => _x( 'Skill', 'taxonomy singular name', 'framework'),
    'search_items' =>  __( 'Search Skills', 'framework'),
    'all_items' => __( 'All Skills', 'framework'),
    'parent_item' => __( 'Parent Skill', 'framework'),
    'parent_item_colon' => __( 'Parent Skill:', 'framework'),
    'edit_item' => __( 'Edit Skill', 'framework'),
    'update_item' => __( 'Update Skill', 'framework'),
    'add_new_item' => __( 'Add New Skill', 'framework'),
    'new_item_name' => __( 'New Skill Name', 'framework'),
    'menu_name' => __( 'Skills', 'framework'),
  );

  register_taxonomy('skills',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'skills' ),
  ));

}

/*-----------------------------------------------------------------------------------*/
/*	Load Text Domain
/*-----------------------------------------------------------------------------------*/

$lang = get_template_directory_uri(). '/lang';
load_theme_textdomain('framework', $lang);

/*-----------------------------------------------------------------------------------*/
/*	Add Shortcode Buttons to WYSIWIG
/*-----------------------------------------------------------------------------------*/

add_action('init', 'add_ag_shortcodes');

function add_ag_shortcodes() {
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
   {

   	 //Add "button" button
     add_filter('mce_external_plugins', 'add_plugin_button');
     add_filter('mce_buttons', 'register_button');

     //Add "divider" button
     add_filter('mce_external_plugins', 'add_plugin_divider');
     add_filter('mce_buttons', 'register_divider');

	 //Add "tabs" button
     add_filter('mce_external_plugins', 'add_plugin_featuredfulltabs');
     add_filter('mce_buttons', 'register_featuredfulltabs');

	 //Add "lightbox" button
     add_filter('mce_external_plugins', 'add_plugin_lightbox');
     add_filter('mce_buttons', 'register_lightbox');

	 //Add "shortcodes" buttons - 3rd row

	 add_filter('mce_external_plugins', 'add_plugin_onehalf');
     add_filter('mce_buttons_3', 'register_onehalf');

	 add_filter('mce_external_plugins', 'add_plugin_onehalflast');
     add_filter('mce_buttons_3', 'register_onehalflast');

	 add_filter('mce_external_plugins', 'add_plugin_onethird');
     add_filter('mce_buttons_3', 'register_onethird');

	 add_filter('mce_external_plugins', 'add_plugin_onethirdlast');
     add_filter('mce_buttons_3', 'register_onethirdlast');

	 add_filter('mce_external_plugins', 'add_plugin_twothird');
     add_filter('mce_buttons_3', 'register_twothird');

	 add_filter('mce_external_plugins', 'add_plugin_twothirdlast');
     add_filter('mce_buttons_3', 'register_twothirdlast');

	 add_filter('mce_external_plugins', 'add_plugin_onefourth');
     add_filter('mce_buttons_3', 'register_onefourth');

	 add_filter('mce_external_plugins', 'add_plugin_onefourthlast');
     add_filter('mce_buttons_3', 'register_onefourthlast');

	 add_filter('mce_external_plugins', 'add_plugin_threefourth');
     add_filter('mce_buttons_3', 'register_threefourth');

	 add_filter('mce_external_plugins', 'add_plugin_threefourthlast');
     add_filter('mce_buttons_3', 'register_threefourthlast');

	 add_filter('mce_external_plugins', 'add_plugin_onefifth');
     add_filter('mce_buttons_3', 'register_onefifth');

	 add_filter('mce_external_plugins', 'add_plugin_onefifthlast');
     add_filter('mce_buttons_3', 'register_onefifthlast');

	 add_filter('mce_external_plugins', 'add_plugin_twofifth');
     add_filter('mce_buttons_3', 'register_twofifth');

	 add_filter('mce_external_plugins', 'add_plugin_twofifthlast');
     add_filter('mce_buttons_3', 'register_twofifthlast');

	 add_filter('mce_external_plugins', 'add_plugin_threefifth');
     add_filter('mce_buttons_3', 'register_threefifth');

	 add_filter('mce_external_plugins', 'add_plugin_threefifthlast');
     add_filter('mce_buttons_3', 'register_threefifthlast');

	 add_filter('mce_external_plugins', 'add_plugin_fourfifth');
     add_filter('mce_buttons_3', 'register_fourfifth');

	 add_filter('mce_external_plugins', 'add_plugin_fourfifthlast');
     add_filter('mce_buttons_3', 'register_fourfifthlast');

	 add_filter('mce_external_plugins', 'add_plugin_onesixth');
     add_filter('mce_buttons_3', 'register_onesixth');

	 add_filter('mce_external_plugins', 'add_plugin_onesixthlast');
     add_filter('mce_buttons_3', 'register_onesixthlast');

	 add_filter('mce_external_plugins', 'add_plugin_fivesixth');
     add_filter('mce_buttons_3', 'register_fivesixth');

	 add_filter('mce_external_plugins', 'add_plugin_fivesixthlast');
     add_filter('mce_buttons_3', 'register_fivesixthlast');

   }
}

function register_button($buttons) {
   array_push($buttons, "button");
   return $buttons;
}
function add_plugin_button($plugin_array) {
   $plugin_array['button'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_divider($buttons) {
   array_push($buttons, "divider");
   return $buttons;
}
function add_plugin_divider($plugin_array) {
   $plugin_array['divider'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_featuredfulltabs($buttons) {
   array_push($buttons, "featuredfulltabs");
   return $buttons;
}
function add_plugin_featuredfulltabs($plugin_array) {
   $plugin_array['featuredfulltabs'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}
function register_lightbox($buttons) {
   array_push($buttons, "lightbox");
   return $buttons;
}
function add_plugin_lightbox($plugin_array) {
   $plugin_array['lightbox'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onehalf($buttons) {
   array_push($buttons, "onehalf");
   return $buttons;
}
function add_plugin_onehalf($plugin_array) {
   $plugin_array['onehalf'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onehalflast($buttons) {
   array_push($buttons, "onehalflast");
   return $buttons;
}
function add_plugin_onehalflast($plugin_array) {
   $plugin_array['onehalflast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onethird($buttons) {
   array_push($buttons, "onethird");
   return $buttons;
}
function add_plugin_onethird($plugin_array) {
   $plugin_array['onethird'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onethirdlast($buttons) {
   array_push($buttons, "onethirdlast");
   return $buttons;
}
function add_plugin_onethirdlast($plugin_array) {
   $plugin_array['onethirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twothird($buttons) {
   array_push($buttons, "twothird");
   return $buttons;
}
function add_plugin_twothird($plugin_array) {
   $plugin_array['twothird'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twothirdlast($buttons) {
   array_push($buttons, "twothirdlast");
   return $buttons;
}
function add_plugin_twothirdlast($plugin_array) {
   $plugin_array['twothirdlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one fourth buttons

function register_onefourth($buttons) {
   array_push($buttons, "onefourth");
   return $buttons;
}
function add_plugin_onefourth($plugin_array) {
   $plugin_array['onefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onefourthlast($buttons) {
   array_push($buttons, "onefourthlast");
   return $buttons;
}
function add_plugin_onefourthlast($plugin_array) {
   $plugin_array['onefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}


// three fourth buttons

function register_threefourth($buttons) {
   array_push($buttons, "threefourth");
   return $buttons;
}
function add_plugin_threefourth($plugin_array) {
   $plugin_array['threefourth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_threefourthlast($buttons) {
   array_push($buttons, "threefourthlast");
   return $buttons;
}
function add_plugin_threefourthlast($plugin_array) {
   $plugin_array['threefourthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one fifth buttons

function register_onefifth($buttons) {
   array_push($buttons, "onefifth");
   return $buttons;
}
function add_plugin_onefifth($plugin_array) {
   $plugin_array['onefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onefifthlast($buttons) {
   array_push($buttons, "onefifthlast");
   return $buttons;
}
function add_plugin_onefifthlast($plugin_array) {
   $plugin_array['onefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// two fifth buttons

function register_twofifth($buttons) {
   array_push($buttons, "twofifth");
   return $buttons;
}
function add_plugin_twofifth($plugin_array) {
   $plugin_array['twofifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_twofifthlast($buttons) {
   array_push($buttons, "twofifthlast");
   return $buttons;
}
function add_plugin_twofifthlast($plugin_array) {
   $plugin_array['twofifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// three fifth buttons

function register_threefifth($buttons) {
   array_push($buttons, "threefifth");
   return $buttons;
}
function add_plugin_threefifth($plugin_array) {
   $plugin_array['threefifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_threefifthlast($buttons) {
   array_push($buttons, "threefifthlast");
   return $buttons;
}
function add_plugin_threefifthlast($plugin_array) {
   $plugin_array['threefifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// four fifth buttons

function register_fourfifth($buttons) {
   array_push($buttons, "fourfifth");
   return $buttons;
}
function add_plugin_fourfifth($plugin_array) {
   $plugin_array['fourfifth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_fourfifthlast($buttons) {
   array_push($buttons, "fourfifthlast");
   return $buttons;
}
function add_plugin_fourfifthlast($plugin_array) {
   $plugin_array['fourfifthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// one sixth buttons

function register_onesixth($buttons) {
   array_push($buttons, "onesixth");
   return $buttons;
}
function add_plugin_onesixth($plugin_array) {
   $plugin_array['onesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_onesixthlast($buttons) {
   array_push($buttons, "onesixthlast");
   return $buttons;
}
function add_plugin_onesixthlast($plugin_array) {
   $plugin_array['onesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

// five sixth buttons

function register_fivesixth($buttons) {
   array_push($buttons, "fivesixth");
   return $buttons;
}
function add_plugin_fivesixth($plugin_array) {
   $plugin_array['fivesixth'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}

function register_fivesixthlast($buttons) {
   array_push($buttons, "fivesixthlast");
   return $buttons;
}
function add_plugin_fivesixthlast($plugin_array) {
   $plugin_array['fivesixthlast'] = get_template_directory_uri().'/js/ag_customcodes.js';
   return $plugin_array;
}


function parse_shortcode_content( $content ) {

    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

function get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}

add_action( 'parse_query','changept' );
function changept() {
	if( is_category() && !is_admin() )
		set_query_var( 'post_type', array( 'post', 'portfolio' ) );
	return;
}
?>