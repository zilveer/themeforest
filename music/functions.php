<?php
/**
 * WP-Church functions & definitions
 *
 */
 
  
 /******************************************************************
 * custom paths
 ******************************************************************/
 
define("NETLABS_INCLUDES_PATH", TEMPLATEPATH . '/includes');
define("NETLABS_CUSTPAGES_PATH", TEMPLATEPATH . '/options');

require_once (NETLABS_INCLUDES_PATH . '/custom_functions.php');
require_once (NETLABS_INCLUDES_PATH . '/widgets.php');
require_once (NETLABS_CUSTPAGES_PATH . '/custom-post-types.php');
require_once (NETLABS_CUSTPAGES_PATH . '/meta-box-extended-functions.php');
include_once 'options/meta-box-functions.php';
include 'options/meta-box-options.php';



 /******************************************************************
 * setup the admin
 ******************************************************************/
define("NTL_ADMINPAGES_PATH", TEMPLATEPATH . '/admin');
require_once (NTL_ADMINPAGES_PATH . '/admin-functions.php');
require_once (NTL_ADMINPAGES_PATH . '/admin-layouts.php');
require_once (NTL_ADMINPAGES_PATH . '/admin-helper.php');
require_once (NTL_ADMINPAGES_PATH . '/theme-settings.php');
require_once (NTL_ADMINPAGES_PATH . '/slide-settings.php');
require_once (NTL_ADMINPAGES_PATH . '/video-settings.php');
require_once (NTL_ADMINPAGES_PATH . '/utility-settings.php');
require_once (NTL_ADMINPAGES_PATH . '/facebook-settings.php');


 /******************************************************************
 * theme setup functions
 ******************************************************************/

 
if ( ! isset( $content_width ) ) $content_width = 900;

add_action( 'after_setup_theme', 'netlabs_setup' );

if ( ! function_exists( 'netlabs_setup' ) ):

function netlabs_setup() {
	add_custom_background( 'cp_cust_bg_callback' );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'slider', 464, 249, true );
	add_image_size( 'fmenu', 306, 280, true );
	add_image_size( 'teamthumb', 138, 207, true );
	add_image_size( 'imlink', 286, 140, true );
	add_image_size( 'albmlink', 274, 274, true );
	add_image_size( 'fppost', 90, 90, true ); 
	add_image_size( 'fslide', 520, 280, true );  
	add_theme_support( 'automatic-feed-links' );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'localize' ),
		'facebook' => __( 'Facebook Navigation', 'localize' ),
	) );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'localize');
}

endif;


function netlabs_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'netlabs_page_menu_args' );



/**********************************************************
 * Returns a "Continue Reading" link for excerpts
 *********************************************************/
function ntl_continue_reading_link() {
	return ' <p class="more-class clear"><a class="more-link" href="'. get_permalink() . '">' . __( '<span>Read more</span>', 'localize' ) . '</a></p>';
}





/**********************************************************
 * shortens the excerpt length
 *********************************************************/

function ntl_excerpt_length( $length ) {
	return 50;
}
add_filter( 'excerpt_length', 'ntl_excerpt_length' );


/**********************************************************
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and wp_church_continue_reading_link().
 *********************************************************/

function ntl_auto_excerpt_more( $more ) {
	return '' . ntl_continue_reading_link();
}
add_filter( 'excerpt_more', 'ntl_auto_excerpt_more' );



/**********************************************************
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *********************************************************/
 
function ntl_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= ntl_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'ntl_custom_excerpt_more' );



/**********************************************************
 * Remove inline styles printed when the gallery shortcode is used.
 *********************************************************/
 
function ntl_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
add_filter( 'gallery_style', 'ntl_remove_gallery_css' );


/**********************************************************
 * functions for comments and pingbacks.
 *********************************************************/

if ( ! function_exists( 'feast_comment' ) ) :
function feast_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 60 ); ?>
			<?php printf( __( '%s ', 'feast' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'localize' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'localize' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'localize' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'localize' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'localize'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;



 /******************************************************************
 * register the widgets
 ******************************************************************/
 
function ntl_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'localize' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'localize' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s clear">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title vfont">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page left', 'localize' ),
		'id' => 'index-left',
		'description' => __( 'Index page left side', 'localize' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title vfont">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page center', 'localize' ),
		'id' => 'index-center',
		'description' => __( 'Index page center', 'localize' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title vfont">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Index page right', 'localize' ),
		'id' => 'index-right',
		'description' => __( 'Index page right', 'localize' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title vfont">',
		'after_title' => '</h3>',
	) );
		
	register_sidebar( array(
		'name' => __( 'Facebook page', 'localize' ),
		'id' => 'fbleft',
		'description' => __( 'Facebook page left', 'localize' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title vfont">',
		'after_title' => '</h3>',
	) );
	


}

add_action( 'widgets_init', 'ntl_widgets_init' );




add_action( 'widgets_init', 'ntl_unregister_widgets' );

function ntl_unregister_widgets() {
	unregister_widget( 'WP_Widget_Calendar' );
	unregister_widget( 'WP_Widget_Recent_Posts' );
	unregister_widget( 'WP_Widget_Tag_Cloud' );
	unregister_widget( 'WP_Nav_Menu_Widget' );
	unregister_widget( 'WP_Widget_Links' );
}



 /******************************************************************
 * Removes the default styles that are packaged with the Recent Comments widget.
 ******************************************************************/
function ntl_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'ntl_remove_recent_comments_style' );




 /******************************************************************
 * Prints HTML with meta information for the current post—date/time and author.
 ******************************************************************/

if ( ! function_exists( 'ntl_posted_on' ) ) :
function ntl_posted_on() {
	printf( __( 'Posted in %4$s by ', 'localize' ),
		' ',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'localize' ), get_the_author() ),
			get_the_author()
		),
		sprintf( '%1$s',
			get_the_category_list( ', ' )
		)
	);
}
endif;


 /******************************************************************
 * Prints HTML with meta information for the current post (category, tags and permalink).
 ******************************************************************/

if ( ! function_exists( 'ntl_posted_in' ) ) :
function ntl_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'localize' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'localize' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'localize' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;
